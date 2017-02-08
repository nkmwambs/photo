<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class File extends CI_Model{

	public function getRows($id = ''){
		$this->db->select('id,file_name,created,group,status');
		$this->db->from('files');
		if($id){
			$this->db->where('id',$id);
			$query = $this->db->get();
			$result = $query->row_array();
		}else{
			$this->db->order_by('created','desc');
			$query = $this->db->get();
			$result = $query->result_array();
		}
		return !empty($result)?$result:false;
	}
	
	public function insert($data = array()){
		//$insert = $this->db->insert_batch('files',$data);
		$chk = $this->db->get_where('files',array('file_name'=>$data['file_name'],'status<>'=>5));
		
		if($chk->num_rows()>0):
			
			$this->db->where(array('file_name'=>$data['file_name'],'status<>'=>5));
			
			if($chk->row()->status==='3' || $chk->row()->status==='4'){
				
				$data2['modified'] = date("Y-m-d H:i:s");
				$data2['status'] = '4';
				$action = $this->db->update('files',$data2);
			
			}elseif($chk->row()->status==='1'){
			
				$data2['modified'] = date("Y-m-d H:i:s");
				$action = $this->db->update('files',$data2);	
			
			}elseif($chk->row()->status==='2'){
			
				$data2['modified'] = date("Y-m-d H:i:s");
				$data2['status'] = '5';
				
				$this->db->update('files',$data2);	
				
				$action = $this->db->insert('files',$data);						
			}else{
				$action = $this->db->insert('files',$data);
			}
			

		endif;
		
		
		return $action?true:false;
	}
	
}
