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
			
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('SDSA_dashboard');
        $this->load->view('backend/index', $page_data);
    }
	
	function download($param1=""){
		
		$path_arr = $this->db->get_where('files',array('id'=>$param1))->row();
		
		force_download('uploads/photos/'.$path_arr->group.'/'.$path_arr->file_name, NULL);
		
		$this->gallery();
	}
	
	function search_photo($param1="",$param2=""){
        if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url(), 'refresh');
		
		$this->session->set_userdata('locate',$this->input->post('project'));
		
		$this->session->set_userdata('status',$this->input->post('status'));
		
		if($param1!==""){
			$this->session->set_userdata('locate',$param1);
		}

		$config = array();
		$config["base_url"] = base_url() . "index.php?sdsa/search_photo/".$this->session->userdata('locate')."/";
		
		//if($param2!==""){
			//$config["base_url"] = base_url() . "index.php?sdsa/search_photo/".$this->session->userdata('locate')."/".$param2;
		//}
		
		$total_row = $this->pagination_model->record_count();
		$config["total_rows"] = $total_row;
		$config["per_page"] = 9;
		$config["num_links"] = 5;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		
		$this->pagination->initialize($config);
		if($this->uri->segments['4']){
			$page = ($this->uri->segments['4']) ;
		}
		else{
			$page = 1;
		}
		
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
		$page_data["links"] = explode('&nbsp;',$str_links );
		$page_data['page'] = $this->uri->segments['4'];
		
        $page_data['page_name']  = 'gallery';
        $page_data['page_title'] = get_phrase('gallery');
        $this->load->view('backend/index', $page_data);			
	}
	
	function gallery($param1=""){
        if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url(), 'refresh');
	
			
        $page_data['page_name']  = 'gallery';
        $page_data['page_title'] = get_phrase('gallery');
        $this->load->view('backend/index', $page_data);		
	}
    
	function upload_zone(){
        if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url(), 'refresh');
	
			
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
				$statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
				$this->session->set_flashdata('flash_message' , $statusMsg);
			}
		

       //redirect(base_url() . 'index.php?sdsa/gallery/', 'refresh');
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
		redirect(base_url() . 'index.php?sdsa/search_photo/', 'refresh');
		
	}

	function reinstate_photo($param1=""){
        if ($this->session->userdata('sdsa_login') != 1)
            redirect(base_url(), 'refresh');
		
		$this->db->where('id',$param1);
		$data['status'] = '4';
		
		$this->db->update('files',$data);
		
		//$data2['photo_id'] = $param1;
		//$data2['reason_by'] = $this->session->userdata('login_user_id');
		//$data2['reason'] = $this->input->post('reject_reason');
		//$data2['comment_status'] = '3';
		
		//$this->db->insert('reasons',$data2);
		
		$this->session->set_flashdata('flash_message',get_phrase('reinstated_successful'));
		redirect(base_url() . 'index.php?sdsa/search_photo/', 'refresh');
		
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
		
		$page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $this->load->view('backend/index', $page_data);
	}
	
	function download_all(){
		
		$param1="KE0200";
		$param2="1";
		
		$files = $this->db->get_where('files',array('group'=>$param1,'status'=>$param2))->result_object();
		
		$archive_file_name = 'my_photo_achive_'.date("Y_m_d_H_i_s").'.zip';
		
		$file_path = 'uploads/';
		
		$file_names = array();
		
		foreach($files as $rows):
			$file_names[] = 'uploads/photos/'.$param1.'/'.$rows->file_name;
		endforeach;	
		
		zipArchive($file_names,$archive_file_name, $file_path);
	}
		
}
