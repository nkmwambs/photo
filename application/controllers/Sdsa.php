<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author 	: Joyonto Roy
 *	date		: 27 september, 2014
 *	FPS School Management System Pro
 *	http://codecanyon.net/user/FreePhpSoftwares
 *	support@freephpsoftwares.com
 */

class Sdsa extends CI_Controller
{
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
		$this->load->library('zip');
		$this->load->model('listing_model','listing');
		//$this->load->helper('zipArchive');
		
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url(), 'refresh');
		
		$page_data['trash_count']  = count(file_list('/uploads/trash/'));
		//$group = $this->db->get_where('projects',array('sdsa'=>$this->session->login_user_id))->row()->num;
		$page_data['new_count']  = $this->db->join('projects','projects.num=files.group')->get_where('files',array('status'=>'1','sdsa'=>$this->session->login_user_id))->num_rows();	
        	
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('SDSA_dashboard');
        $this->load->view('backend/index', $page_data);
    }
	
	function download($param1=""){
		
		$path_arr = $this->db->get_where('files',array('id'=>$param1))->row();
		
		force_download('uploads/photos/'.$path_arr->group.'/'.$path_arr->file_name, NULL);
		
		$this->gallery();
	}
	
	function set_num_pages($param1=""){
		//per_page
		if($param1==""){
			$this->session->set_userdata('per_page',"6");
		}else{
			$this->session->set_userdata('per_page',$param1);
		}
		
		$page = 1;
		
		if($this->uri->segments['4']){
			$page = ($this->uri->segments['4']) ;
		}
		
		
		$this->session->set_userdata('page_num',$page);
		
		$this->search_photo($this->session->userdata('locate'),$page);
	}
	
/**
	function search_photo($param1="",$param2=""){
        if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url(), 'refresh');
		
		$this->session->set_userdata('locate',$this->input->post('project'));
		
		if($param1!==""){
			$this->session->set_userdata('locate',$param1);
		}
		
		if(!$this->input->post('status')){
			$this->session->userdata('status');
		}else{
			$this->session->set_userdata('status',$this->input->post('status'));
		}

		$config = array();
		$config["base_url"] = base_url() . "index.php?sdsa/search_photo/".$this->session->userdata('locate')."/";
		
		
		$total_row = $this->pagination_model->record_count();
		$config["total_rows"] = $total_row;
		
		if(!$this->session->userdata('per_page')){
			$config["per_page"] = 6;
		}else{
			$config["per_page"] = $this->session->userdata('per_page');
		}
		
		
		$config["num_links"] = 5;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		//$config['cur_tag_open'] = '&nbsp;<a class="current">';
		//$config['cur_tag_close'] = '</a>';
		//$config['next_link'] = 'Next';
		//$config['prev_link'] = 'Previous';
		
		
		$config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$page = 1;
		
		if($this->uri->segments['4']){
			$page = ($this->uri->segments['4']) ;
		}
		
		
		$this->session->set_userdata('page_num',$page);
		
		//if($this->uri->segments['5']){
			//$status = ($this->uri->segments['5']) ;
		//}
		//else{
			$status = $this->session->userdata('status');
		//}
		
		$page_data["results"] = $this->pagination_model->fetch_data($config["per_page"], $page ,$this->session->userdata('locate'),$status);
		
		//if($param2!==""){
			//$page_data["results"] = $this->pagination_model->fetch_data($config["per_page"], $page ,$this->session->userdata('locate'),$param2);
		//}
		
		$str_links = $this->pagination->create_links();
		$page_data['project_num'] = $this->session->userdata('locate');
		$page_data["pagination"] = $str_links;//explode('&nbsp;',$str_links );
		//$page_data['page'] = $this->uri->segments['4'];
		
        $page_data['page_name']  = 'gallery';
        $page_data['page_title'] = get_phrase('gallery');
        $this->load->view('backend/index', $page_data);			
	}
	 
	**/ 
	
	function search_photo(){
   	$photos = $this->listing->get_datatables();
		$data = array();
		//$no = $_POST['start'];
		$photo_status = array("","New","Accepted","Rejected","Reinstated");
		foreach ($photos as $photo) {
			
			$row = array();
			$action_data['status'] = $photo->status;
			$action_data['id'] = $photo->id;
			$action_data['downloaded'] = $photo->downloaded;
			$row[] = "<input type='checkbox' class='chkPhoto' value='".$photo->file_name."'  name='image[]'/>";
			$row[] = $this->load->view("backend/sdsa/photo_action",$action_data,TRUE);
			$row[] = '<a href="#" onclick="showAjaxModal(\''.base_url().'index.php?modal/popup/modal_full_photo/'.$photo->id.'\');"><img src="'.base_url().'uploads/thumbnails/'.$photo->file_name.'"/></a>';
			$row[] = $photo->group;
			$row[] = $photo->file_name;
			$row[] = $photo->created;
			$row[] = $photo->modified;
			$row[] = $photo_status[$photo->status];
			
			
			
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->listing->count_all(),
						"recordsFiltered" => $this->listing->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);		
	}
	
	function gallery($param1=""){
        if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url(), 'refresh');
	
	
		$page_data['trash_count']  = count(file_list('/uploads/trash/'));
		//$group = $this->db->get_where('projects',array('sdsa'=>$this->session->login_user_id))->row()->num;
		$page_data['new_count']  = $this->db->join('projects','projects.num=files.group')->get_where('files',array('status'=>'1','sdsa'=>$this->session->login_user_id))->num_rows();	
        
		$page_data['delete_array'] = array('accepted'=>5,'new'=>10,'declined'=>1,'reinstated'=>0,'old'=>11);
		
        $page_data['page_name']  = 'gallery';
        $page_data['page_title'] = get_phrase('gallery');
        $this->load->view('backend/index', $page_data);		
	}
    
	function upload_zone(){
        if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url(), 'refresh');
	
		$page_data['trash_count']  = count(file_list('/uploads/trash/'));
		//$group = $this->db->get_where('projects',array('sdsa'=>$this->session->login_user_id))->row()->num;
		$page_data['new_count']  = $this->db->join('projects','projects.num=files.group')->get_where('files',array('status'=>'1','sdsa'=>$this->session->login_user_id))->num_rows();	
        	
        $page_data['page_name']  = 'upload_zone';
        $page_data['page_title'] = get_phrase('upload_zone');
        $this->load->view('backend/index', $page_data);		
	}
	
  	
	function upload_photo(){

				$project  = substr($_FILES['file']['name'], 0,6);
				
				if(!file_exists('uploads/photos/'.$project.'/')){
					mkdir('uploads/photos/'.$project.'/');
				}
				
				if(file_exists('uploads/photos/'.$project.'/'.$_FILES['file']['name'])){
					unlink('uploads/photos/'.$project.'/'.$_FILES['file']['name']);
				}

				//Check if thumbnail exists
						
				if(file_exists('uploads/thumbnails/'.$_FILES['file']['name'])){
					unlink('uploads/thumbnails/'.$_FILES['file']['name']);
				}

				$uploadPath = 'uploads/photos/'.$project.'/';
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'jpeg|jpg';
				//$config['max_size']	= '1024';
				//$config['max_width'] = '800';
				//$config['max_height'] = '1200';
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('file')){
					$fileData = $this->upload->data();
					$uploadData['file_name'] = $fileData['file_name'];
					$uploadData['created'] = date("Y-m-d H:i:s");
					$uploadData['modified'] = date("Y-m-d H:i:s");
					$uploadData['group'] = substr($fileData['file_name'], 0,6);
				}
							
				
		
			if(!empty($uploadData)){
				//Insert files data into the database
				$insert = $this->file->insert($uploadData);
				//$statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
				//$this->session->set_flashdata('flash_message' , $statusMsg);
			}
		
		
		
		thumbnail('uploads/photos/'.$project.'/'.$_FILES['file']['name'], 100, 100);

       
	}

	function process_photo($param1="",$param2=""){
		if($param1==='accept'){
			$this->db->where('id',$param2);
			$data['status'] = '2';
			
			$this->db->update('files',$data);			
		}
		
		$this->search_photo();
	}
    
	function accept_photo($param1=""){
        if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url(), 'refresh');
		
		$this->db->where('id',$param1);
		$data['status'] = '2';
		
		$this->db->update('files',$data);
		
		$this->session->set_flashdata('flash_message',get_phrase('accepted_successful'));
		redirect(base_url() . 'index.php?sdsa/gallery/', 'refresh');
	
	}
	
	function reject_photo($param1=""){//reinstate_photo
        if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url(), 'refresh');
		
		$this->db->where('id',$param1);
		$data['status'] = '3';
		
		$this->db->update('files',$data);
		
		$data2['photo_id'] = $param1;
		$data2['reason_by'] = $this->session->userdata('login_user_id');
		$data2['reason'] = $this->input->post('reject_reason');
		$data2['comment_status'] = '3';
		
		$this->db->insert('reasons',$data2);
		
		$this->session->set_flashdata('flash_message',get_phrase('rejected_successful'));
		redirect(base_url() . 'index.php?sdsa/gallery/', 'refresh');
		
	}

	function add_comment_photo($param1=""){
        if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url(), 'refresh');
		
		$this->db->where('id',$param1);
		//$data['status'] = '3';
		
		//$this->db->update('files',$data);
		
		$data2['photo_id'] = $param1;
		$data2['reason_by'] = $this->session->userdata('login_user_id');
		$data2['reason'] = $this->input->post('reject_reason');
		$data2['comment_status'] = $this->db->get_where('files',array('id'=>$param1))->row()->status;
		
		$this->db->insert('reasons',$data2);
		
		$this->session->set_flashdata('flash_message',get_phrase('comment_added_successful'));
		redirect(base_url() . 'index.php?sdsa/gallery/', 'refresh');
	
	}

	function reinstate_photo($param1=""){
        if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url(), 'refresh');
		
		$this->db->where('id',$param1);
		$data['status'] = '4';
		
		$this->db->update('files',$data);
		
		$this->session->set_flashdata('flash_message',get_phrase('reinstated_successful'));
		redirect(base_url() . 'index.php?sdsa/gallery/', 'refresh');
		
	}
	
	function projects($param1="",$param2=""){
        if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url(), 'refresh');
		
		if($param1==='add_project'){
			$data['name'] = $this->input->post('pname');
			$data['num'] = $this->input->post('num');
			
			//check if project exists
			
			$p_check = $this->db->get_where('projects',array('num'=>$this->input->post('num')))->num_rows();
			
			if($p_check===0){
				$this->db->insert('projects',$data);
				
				$this->session->set_flashdata('flash_message',get_phrase('project_created_successfully'));
			}else{
				$this->session->set_flashdata('flash_message',get_phrase('failure_cannot_create_duplicate'));
			}
			
			
		}
		
		if($param1==="delete"){
			
			//check if any image not accepted
			$project = $this->db->get_where('projects',array('projects_id'=>$param2))->row()->num;
			
			$pending_check = $this->db->get_where('files',array('group'=>$project,'status<>'=>2))->num_rows();
			
			if($pending_check===0){
				$this->db->where(array('projects_id'=>$param2));
			
				$this->db->delete('projects');
			
				$this->session->set_flashdata('flash_message',get_phrase('project_deleted'));
			}else{
				$this->session->set_flashdata('flash_message',get_phrase('delete_failure_unprocessed_images'));
			}
			
			
		}
		
		if($param1==='link_project'){
			
			$this->db->where(array('num'=>$this->input->post('num')));
			
			$data[$this->input->post('link_type')] = $param2;
			
			$this->db->update('projects',$data);
			
			$this->session->set_flashdata('flash_message',get_phrase('project_linked_successfully'));
		}
		
		
		redirect(base_url() . 'index.php?sdsa/manage_profile/', 'refresh');
		
	}
	
	function manage_user_links($param1="",$param2=""){
		//echo "Cool";
		$this->db->where('projects_id',$param2);
		
		$data[$param1] = 0;
		
		$this->db->update('projects',$data);
		
		if($this->db->affected_rows()){
			echo get_phrase('unlink_successful');
		}else{
			echo get_phrase('unlink_failure');
		}
	}	
	
	function manage_profile($param1="",$param2="",$param3=""){
		if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url(), 'refresh');
		
		if($param1==='add_user'){
			$data['name'] = $this->input->post('fname');
			$data['email'] = $this->input->post('email');
			$data['level'] = $this->input->post('level');
			$data['password'] = $this->input->post('password');
			
			//Check if email exists
			$e_check = $this->db->get_where('users',array('email'=>$this->input->post('email')))->num_rows();
			
			if($e_check===0){
				$this->db->insert('users',$data);
				
				$this->session->set_flashdata('flash_message',get_phrase('user_created_successfully'));
					
			}else{
				
				$this->session->set_flashdata('flash_message',get_phrase('process_failed_email_exists'));
			}
			
			redirect(base_url() . 'index.php?sdsa/manage_profile/', 'refresh');	
		}
		
		if($param1==='update'){
			
			$this->db->where(array('users_id'=>$param2));
			
			$data['name'] = $this->input->post('fname');
			$data['email'] = $this->input->post('email');
			if($this->input->post('password')!==""){
				$data['password'] = $this->input->post('password');
			}
			$data['level'] = $this->input->post('level');
			
			$this->db->update('users',$data);
			
			$this->session->set_flashdata('flash_message',get_phrase('profile_updated'));
			
			redirect(base_url() . 'index.php?sdsa/manage_profile/', 'refresh');
		}
		
		if($param1==='delete'){
				
			
				//Check if an project is link
				
				$level = array('none','none','sdsa','facilitator');
				
				$link_check = $this->db->get_where('projects',array($level[$param2]=>$param3))->num_rows();
				
				if($link_check===0){
					$this->db->where(array('users_id'=>$param3));
				
					$this->db->delete('users');
					
					$this->session->set_flashdata('flash_message',get_phrase('user_deleted'));
				}else{
					$this->session->set_flashdata('flash_message',get_phrase('user_with_linkage_cannot_delete'));	
				}
				
				redirect(base_url() . 'index.php?sdsa/manage_profile/', 'refresh');	
		}
		
		$page_data['trash_count']  = count(file_list('/uploads/trash/'));
		//$group = $this->db->get_where('projects',array('sdsa'=>$this->session->login_user_id))->row()->num;
		$page_data['new_count']  = $this->db->join('projects','projects.num=files.group')->get_where('files',array('status'=>'1','sdsa'=>$this->session->login_user_id))->num_rows();	
        
		$page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $this->load->view('backend/index', $page_data);
	}
	
	function check_projects($param1=""){
		//echo $param1;
		
		$projects = $this->db->distinct()->select('group')->get_where('files',array('status'=>$param1))->result_object();
			
		echo json_encode($projects);	
	}
	
	function download_selected(){
		
		$group = $this->input->post('group');	
		
		$status = $this->input->post('status');	
		
		$files = $this->db->get_where('files',array('group'=>$group,'status'=>$status))->result_object();
		
		if($status==='all' && $group!=='all'){
			$files = $this->db->get_where('files',array('group'=>$group))->result_object();
		}	
		
		if($group==='all' && $status!=='all'){
			$files = $this->db->get_where('files',array('status'=>$status))->result_object();
		}
			//$files = $this->db->get_where('files',array('group'=>$group,'status'=>$status))->result_object();
		
		if($group==='all' && $status==='all'){
			$files = $this->db->get_where('files')->result_object();
		}
		
		
		foreach($files as $rows):
			
			$name = $rows->file_name;
			
			$path = 'uploads/photos/'.$group.'/'.$rows->file_name;
			
			$data = file_get_contents($path);
		
			//Mark dowloaded
			$id = $this->db->get_where('files',array('file_name'=>$rows->file_name))->row()->id;
			$this->db->where('id',$id);
			$data_update['downloaded'] = '1';
				
			$this->db->update('files',$data_update);
			
			//Add to Zip File
			
			$this->zip->add_data($name, $data);
			
		endforeach;
		
		// Write the zip file to a folder on your server. Name it "my_backup.zip"
		$this->zip->archive('downloads/my_backup.zip');
		
		// Download the file to your desktop. Name it "my_backup.zip"
		
		$backup_file = 'my_photo_archive_'.date("Y_m_d_H_i_s").'.zip'; 
		
		$this->zip->download($backup_file);
		
		unlink('downloads/'.$backup_file);
		
		foreach($files as $rows){
			
			if($this->input->post('delete')==='1'){	
				$this->delete_all_photos($id);
			}
		}
		
	}
	
	function delete_photo($param1=""){
		
				
			$cnt_deleted = 0;	
				
			//foreach($selected_images as $key=>$image):
				if($this->db->get_where('files',array('id'=>$param1))->row()->status==='1' || $this->db->get_where('files',array('id'=>$param1))->row()->status==='3'){
					
					if(!file_exists('uploads/trash/')){
						mkdir('uploads/trash/');
					}	
						
					$this->db->where(array('id'=>$param1));
				
					$data['status'] = 5;
				
					$this->db->update('files',$data);
					
					//Move to trash
					
					$group = $this->db->get_where('files',array('id'=>$param1))->row()->group;
					
					$image = $this->db->get_where('files',array('id'=>$param1))->row()->file_name;
					
					copy('uploads/photos/'.$group.'/'.$image, 'uploads/trash/'.$image);
					
					
					//Delete the Image
					
					unlink('uploads/photos/'.$group.'/'.$image);
					
					++$cnt_deleted;
				}
				
				
				
			//endforeach;
			
			if($cnt_deleted>0){
				$this->session->set_flashdata('flash_message',get_phrase('photo_deleted').' ('.$cnt_deleted.')');
			}else{
				$this->session->set_flashdata('flash_message',get_phrase('no_photo_deleted'));
			}
				

			redirect(base_url() . 'index.php?sdsa/gallery/', 'refresh');	
		
		
	}

	function delete_all_photos($param1=""){
		
				
			$cnt_deleted = 0;	
				
			//foreach($selected_images as $key=>$image):
				//if($this->db->get_where('files',array('id'=>$param1))->row()->status==='1' || $this->db->get_where('files',array('id'=>$param1))->row()->status==='3'){
					
					if(!file_exists('uploads/trash/')){
						mkdir('uploads/trash/');
					}	
						
					$this->db->where(array('id'=>$param1));
				
					$data['status'] = 5;
				
					$this->db->update('files',$data);
					
					$cnt_deleted = $this->db->affected_rows();
					
					//Move to trash
					
					$group = $this->db->get_where('files',array('id'=>$param1))->row()->group;
					
					$image = $this->db->get_where('files',array('id'=>$param1))->row()->file_name;
					
					copy('uploads/photos/'.$group.'/'.$image, 'uploads/trash/'.$image);
					
					
					//Delete the Image
					
					unlink('uploads/photos/'.$group.'/'.$image);
					
					
				//}
				
				
				
			//endforeach;
			
			if($cnt_deleted>0){
				$this->session->set_flashdata('flash_message',get_phrase('photo_deleted').' ('.$cnt_deleted.')');
			}else{
				$this->session->set_flashdata('flash_message',get_phrase('no_photo_deleted'));
			}
				

			redirect(base_url() . 'index.php?sdsa/gallery/', 'refresh');	
		
		
	}
	
	function image_action($param1="",$param2=""){
			
		$selected_images = $this->input->post('image');
		
		if($param1==="download_selected"){
			
			foreach($selected_images as $key=>$image):
				
				$group = $this->db->get_where('files',array('file_name'=>$image))->row()->group;
				
				$path = base_url().'uploads/photos/'.$group.'/'.$image;
				
				$data = file_get_contents($path);
			
				$this->zip->add_data($image, $data);
			
			endforeach;
			
			// Write the zip file to a folder on your server. Name it "my_backup.zip"
			$this->zip->archive('downloads/my_backup.zip');
			
			// Download the file to your desktop. Name it "my_backup.zip"
			
			$backup_file = 'my_photo_archive_'.date("Y_m_d_H_i_s").'.zip'; 
			
			$this->zip->download($backup_file);
			
			unlink('downloads/'.$backup_file);
			
			foreach($selected_images as $key=>$image){
				$id = $this->db->get_where('files',array('file_name'=>$image))->row()->id;
				$this->db->where('id',$id);
				$data_update['downloaded'] = '1';
				
				$this->db->update('files',$data_update);
			}
			
		}elseif($param1==="del_selected") {
				
			$cnt_deleted = 0;	
				
			foreach($selected_images as $key=>$image):
				if($this->db->get_where('files',array('id'=>$key))->row()->status==='1' || $this->db->get_where('files',array('id'=>$key))->row()->status==='3'){
					
					if(!file_exists('uploads/trash/')){
						mkdir('uploads/trash/');
					}	
						
					$this->db->where(array('id'=>$key));
				
					$data['status'] = 5;
				
					$this->db->update('files',$data);
					
					//Move to trash
					
					copy('uploads/photos/'.$this->session->userdata('locate').'/'.$image, 'uploads/trash/'.$image);
					
					
					//Delete the Image
					
					unlink('uploads/photos/'.$this->session->userdata('locate').'/'.$image);
					
					++$cnt_deleted;
				}
				
				
				
			endforeach;
			
			if($cnt_deleted>0){
				$this->session->set_flashdata('flash_message',get_phrase('photo_deleted').'('.$cnt_deleted.')');
			}else{
				$this->session->set_flashdata('flash_message',get_phrase('no_photo_deleted'));
			}
				

				//redirect(base_url() . 'index.php?sdsa/search_photo/'.$this->session->userdata('locate').'/'.$this->session->userdata('page_num'), 'refresh');	
		
		}else{
			
			$status = '1';
			
			if($param2==="reject_selected") $status = '3';
			if($param2==="reinstate_selected") $status = '4';
			if($param2==="accept_selected") $status = '2';

			
			
			foreach($selected_images as $key=>$image):
				
				$this->db->where(array('id'=>$key));
				
				$data['status'] = $status;
				
				$this->db->update('files',$data);
				
			endforeach;
			
				//$this->session->set_flashdata('flash_message',get_phrase('photo_status_changed'));

				//redirect(base_url() . 'index.php?sdsa/search_photo/'.$this->session->userdata('locate').'/'.$this->session->userdata('page_num'), 'refresh');			
		}
				
		
		$this->gallery();
	}

	public function trash($param1=""){
        if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url(), 'refresh');
			
        $page_data['page_name']  = 'trash';
        $page_data['page_title'] = get_phrase('trash');
        $this->load->view('backend/index', $page_data);		
	}
	
	public function restore_image($param1=""){
		$source = 'uploads/trash/'.$param1;
		$locate = substr($param1, 0,6);
		$dest = "uploads/photos/".$locate.'/'.$param1;
		
		if(file_exists($dest)){
			$this->session->set_flashdata('flash_message',get_phrase('file_already_exists'));
		}else{
			copy($source, $dest);
			
			$data['file_name'] = $param1;
			$data['group'] = $locate;
			$data['created'] = date("Y-m-d H:i:s");
			$data['modified'] = date("Y-m-d H:i:s");
			$data['status'] = '1';
			
			$this->db->insert('files',$data);
			
			unlink($source);
			
			$this->session->set_flashdata('flash_message',get_phrase('file_restored'));
		}
		
		redirect(base_url() . 'index.php?sdsa/trash/', 'refresh');	
		
		
	}
		
	public function clear_image($param1=""){
		$source = 'uploads/trash/'.$param1;
		unlink($source);
		
		$this->session->set_flashdata('flash_message',get_phrase('file_cleared'));
		
		redirect(base_url() . 'index.php?sdsa/trash/', 'refresh');	
	}	
	
	function empty_trash(){
		$files = glob('uploads/trash/*'); // get all file names
			foreach($files as $file){ // iterate files
			  if(is_file($file))
			    unlink($file); // delete file
			}	
		$this->session->set_flashdata('flash_message',get_phrase('files_cleared'));
		
		redirect(base_url() . 'index.php?sdsa/trash/', 'refresh');		
	}
}
