<?php
Class User_login_model extends CI_Model {
	
	public function getUserDDArray($ArrUserType=array(2,3,4))
	{
		$this->db->select("user_master.*,user_master.user_role_id");        
		$this->db->from('user_master');
		$this->db->join('user_role', 'user_role.user_role_id = user_master.user_role_id');
		$this->db->where_in('user_master.user_role_id',$ArrUserType);
		$this->db->where('user_master.is_active','Y');
		$query = $this->db->get();
		$options = array('' => 'Select User');
		if($query->num_rows() > 0) {
			$ArrState = $query->result_array();
			foreach ($ArrState as $data){
			$options[$data['user_id']] = $data['name']." [".$data['email']."]-".$data['user_role_id'];
			}
		}
		return $options;
	}
	public function add($data) {

		$this->db->insert('user_master', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}
		else {
			return false;
		}

	}
	
	public function delete($id)
	{
		$this->db->where('user_id', $id);
		$this->db->delete('user_master');
		if($this->db->affected_rows() > 0) {
			return true;
		}
		else {
			return false;
		}
	}

	public function getUserDetailsByEmailId($email_id)
	{
		$this->db->select("*");        
		$this->db->from('user_master');
		$this->db->where('user_name',$email_id);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	public function getUserRightsById($user_role_id)
	{
		$this->db->select("*");  
		$this->db->join('menu','menu.menu_id=user_right.menu_id');      
		$this->db->from('user_right');
		$this->db->where('user_right.user_role_id',$user_role_id);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return false;
		}
	}
	public function getByUserDetailByID($user_id=0,$user_role_id=0)
	{
		$ArrUser = array();
		
		$this->db->select("user_master.*,user_role.*");     
		$this->db->from('user_master');
		$this->db->join('user_role', 'user_role.user_role_id = user_master.user_role_id');
		
		if($user_id>0)
			$this->db->where('user_master.user_id',$user_id);
		if($user_role_id>0)
			$this->db->where('user_master.user_type',$user_role_id);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			$ArrUser = $query->result_array();
		}
		
		return $ArrUser;
	}
	

	public function CheckDuplicateEmailId($user_id,$email_id)
	{
		
		$query = $this->db->where('email',$email_id)
							->where('user_id',$user_id)
							->get('user_master');
		if($query->num_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function update($id,$arrData)
	{
		$this->db->where('user_id', $id);
		$update = $this->db->update('user_master', $arrData);
		return  $this->db->affected_rows();
	}
	
	public function updateIsActive($primary_id,$column_name,$table_name)
	{
		$this->db->select("is_active");        
		$this->db->from($table_name);
		$this->db->where($column_name,$primary_id);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			$dataArr=$query->result_array()[0];
			if($dataArr['is_active'] == "N"){
				$this->db->where($column_name, $primary_id);
				$arrData = array('is_active'=>'Y');
				$this->db->update($table_name, $arrData);
				if($this->db->affected_rows() > 0) {
					return array('status' => 'Y','responce'=>true);
				}
				else {
					return false;
				}
			}else{
				$this->db->where($column_name, $primary_id);
				$arrData = array('is_active'=>'N');
				$this->db->update($table_name, $arrData);
				if($this->db->affected_rows() > 0) {
					return array('status' => 'N','responce'=>true);
				}
				else {
					return false;
				}
			}
		}

	}
	public function mobile_login($data) {

		$mobile_no= $data['user_name'];
		$password = $data['password'];
		$user_type = $data['user_role_id'];
		//$result = $this->checkUserType($user_type);
	//	if($result){
			$this->db->where('user_name', $mobile_no);
			$this->db->where('password', $password);
			$this->db->where('is_active', 'Y');
			$this->db->where('user_role_id', $user_type);
			$query = $this->db->get('user_master');
			//echo $this->db->last_query();exit;
			if ($query->num_rows() == 1) {
				return true;
			} else {
				return false;
			}
	/*	}else{
			return false;
		}*/
	}
	// Read data using username and password
	public function login($data) {

		$email= $data['user_name'];
		$password = $data['password'];
		//$user_type = $data['user_role_id'];
		//$result = $this->checkUserType($user_type);
	//	if($result){
			$this->db->where('user_name', $email);
			$this->db->where('password', $password);
			$this->db->where('is_active', 'Y');
			//$this->db->where('user_role_id', $user_type);
			$query = $this->db->get('user_master');
			//echo $this->db->last_query();exit;
			if ($query->num_rows() == 1) {
				return true;
			} else {
				return false;
			}
	/*	}else{
			return false;
		}*/
	}
	// Read data using mobie and password
	public function user_login($data) {

		$mobile= $data['mobile'];
		$password = $data['password'];
		$user_type = $data['user_role_id'];
		
		if($mobile!='' && $password!='' && $user_type!=''){
			$this->db->select("*"); 
			$this->db->where('mobile', $mobile);
			$this->db->where('password', $password);
			$this->db->where('user_role_id', $user_type);
			$query = $this->db->get('user_master');
			if($query->num_rows() > 0) {
				return $query->result_array();
			}else{
				return array();
			}
		}else{
				return array();
			}
	}

	public function checkUserType($user_type) {

		$this->db->where('user_role_id', $user_type);
        $this->db->where('is_active', 'Y');
        $query = $this->db->get('user_role');
		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}
	
	public function uploadThumb()
	{
		$config['upload_path']          = './uploads/user_thumbs/';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['max_size']             = 180000;
		$config['max_width']            = 15000;
		$config['max_height']           = 15000;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('user_thumb_image'))
		{
			$data['error'] = $this->upload->display_errors();
			return $data;
		}
		else
		{
			$data['upload_data'] = $this->upload->data();
			return $data;
		}
	}
	
}

?>