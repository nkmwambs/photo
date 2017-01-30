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
		$this->load->helper('watermark');
		
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
    
  	
	function upload_photo(){
		$data = array();
		if($this->input->post('fileSubmit') && !empty($_FILES['userFiles']['name'])){
			$filesCount = count($_FILES['userFiles']['name']);
			for($i = 0; $i < $filesCount; $i++){
				$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
				$_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
				$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
				$_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
				$_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
				
				if(!file_exists('uploads/photos/'.$this->input->post('project'))){
					mkdir('uploads/photos/'.$this->input->post('project'));
				}

				$uploadPath = 'uploads/photos/'.$this->input->post('project');
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'gif|jpg|png';
				//$config['max_size']	= '100';
				//$config['max_width'] = '1024';
				//$config['max_height'] = '768';
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('userFile')){
					$fileData = $this->upload->data();
					$uploadData[$i]['file_name'] = $fileData['file_name'];
					$uploadData[$i]['created'] = date("Y-m-d H:i:s");
					$uploadData[$i]['modified'] = date("Y-m-d H:i:s");
					$uploadData[$i]['group'] = $this->input->post('project');
				}
							
				
			}
			if(!empty($uploadData)){
				//Insert files data into the database
				$insert = $this->file->insert($uploadData);
				$statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
				$this->session->set_flashdata('flash_message' , $statusMsg);
			}
		}

       redirect(base_url() . 'index.php?sdsa/gallery/', 'refresh');
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
		
}
