<?php
Class common_model extends CI_Model {
	
	function getemailtemplate($tempname = '')
	{
		$tempdata = array();
		if($tempname != '')
		{
			$where_arra = array('configuration_name'=>$tempname,'is_active'=>'Y');
			$tempdata = $this->get_count_data_manual('configuration',$where_arra,1,'','','','','');
		}
		return $tempdata;
	}
    function get_count_data_manual($table,$where_arra='',$flag_count_data = 0,$select_f ='',$order_by='',$page='',$limit='',$disp_query = "")
	{
		if($table !='')
		{
			if($where_arra !='' && is_array($where_arra) && count($where_arra) >0)
			{
				foreach($where_arra as $key=>$val)
				{
					
					if(is_numeric($key))
					{ 
						$this->db->where($val);
					}
					else
					{ 
						$this->db->where($key,$val);
					}
				}
			}
			else if($where_arra !='')
			{
				$this->db->where($where_arra);
			}
			if(isset($select_f) && $select_f !='')
			{
				$this->db->select($select_f);
			}

			if($flag_count_data == 0)
			{
				//$search_data = $this->db->get_compiled_select($table);
				return $this->db->count_all_results($table);
			}
			else 
			{
				if(isset($order_by) && $order_by !='')
				{
					$this->db->order_by($order_by);
				}
				if($flag_count_data==1)
				{
					$this->db->limit(1);
				}
				else
				{
					/*if($limit =="")
					{
						$limit = $this->limit_per_page;
					}*/
					if($page !='' && $limit !='')
					{
						$start = (($page - 1) * $limit);
						$this->db->limit($limit,$start);
					}
					//$this->db->limit(1);
				}
				
				if($disp_query == 1)
				{
					echo $this->db->get_compiled_select($table);
				}
				
				$query = $this->db->get($table);
				if($flag_count_data == 1)
				{
					if($query->num_rows() == 0)
					{
						return '';
					}
					else
					{
						return $query->row_array();
					}
				}
				else
				{
					if($query->num_rows() == 0)
					{
						return '';	
					}
					else
					{ 
						return $query->result_array();
					}
				}
			}
		}
		else
		{
			return '';
		}
		
	}

    function getstringreplaced($actula_content,$array=array())
	{
		$email_template = strtr($actula_content, $array);
		return $email_template;
	}

    public function common_send_email($to_array,$subject,$message)
	{
		
		$config = array(
		    'smtp_host' =>'mail.thcitsolutions.com',
          	'smtp_port' =>587,
          	'smtp_user' =>'test@thcitsolutions.com',
			'smtp_pass' => 'VedikIn@231',
          	'protocol' => 'smtp',
          	'mailtype' => 'html',
          	'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
		);
		
        $this->load->library('email',$config);

		$this->email->set_newline("\r\n");
		$from_email = 'info@vedikin.com';
		
		$this->email->from($from_email);
		$this->email->to($to_array);
		
		
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->set_mailtype("html");
		$msg = 'Email sent.';
		
        if($this->email->send())
        {
            $msg = 'Email sent.';
        }
        else
        {
            $msg = $this->email->print_debugger();
            //show_error($this->email->print_debugger());
        }
		return $msg;
	}

	public function uploadPhotos($name)
	{
		$config1['upload_path']          = './uploads/photos_and_videos';
		$config1['allowed_types']        = 'gif|jpg|jpeg|png';
		$config1['max_size']             = 180000;
		$config1['max_width']            = 15000;
		$config1['max_height']           = 15000;
		$config1['encrypt_name'] = TRUE;
		
		$this->load->library('upload', $config1);

		$this->upload->initialize($config1);
		if ( ! $this->upload->do_upload($name))
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
	public function uploadDocument($name)
	{
		$config1['upload_path']          = './uploads/bidding_document';
		$config1['allowed_types']        = '*';
		/*$config1['max_size']             = 180000;
		$config1['max_width']            = 15000;
		$config1['max_height']           = 15000;*/
		$config1['encrypt_name'] = TRUE;
		
		$this->load->library('upload', $config1);

		$this->upload->initialize($config1);
		if ( ! $this->upload->do_upload($name))
		{
			$data['error'] = $this->upload->display_errors();
			//echo "<pre>";print_r($data);exit;
			return $data;
		}
		else
		{
			$data['upload_data'] = $this->upload->data();
			//echo "<pre>";print_r($data['upload_data']);exit;
			return $data;
		}
	}
	
	public function updateIsactiveForSideBaerList($primary_id,$column_name,$table_name)
	{
		$this->db->select("display_on_sidebar_listing");        
		$this->db->from($table_name);
		$this->db->where($column_name,$primary_id);
		echo $this->db->last_query();exit;
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			$dataArr=$query->result_array()[0];
			if($dataArr['display_on_sidebar_listing'] == "0"){
				$this->db->where($column_name, $primary_id);
				$arrData = array('display_on_sidebar_listing'=>'1');
				$this->db->update($table_name, $arrData);
				if($this->db->affected_rows() > 0) {
					return array('status' => '1','responce'=>true);
				}
				else {
					return false;
				}
			}else{
				$this->db->where($column_name, $primary_id);
				$arrData = array('display_on_sidebar_listing'=>'0');
				$this->db->update($table_name, $arrData);
				if($this->db->affected_rows() > 0) {
					return array('status' => '0','responce'=>true);
				}
				else {
					return false;
				}
			}
		}
	}
	public function updateIsFeatured($primary_id,$column_name,$table_name)
	{
		$this->db->select("is_featured");        
		$this->db->from($table_name);
		$this->db->where($column_name,$primary_id);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			$dataArr=$query->result_array()[0];
			if($dataArr['is_featured'] == "0"){
				$this->db->where($column_name, $primary_id);
				$arrData = array('is_featured'=>'1');
				$this->db->update($table_name, $arrData);
				if($this->db->affected_rows() > 0) {
					return array('status' => '1','responce'=>true);
				}
				else {
					return false;
				}
			}else{
				$this->db->where($column_name, $primary_id);
				$arrData = array('is_featured'=>'0');
				$this->db->update($table_name, $arrData);
				if($this->db->affected_rows() > 0) {
					return array('status' => '0','responce'=>true);
				}
				else {
					return false;
				}
			}
		}
	}
	public function updateIsactiveForHomeList($primary_id,$column_name,$table_name)
	{
		$this->db->select("display_on_home_listing");        
		$this->db->from($table_name);
		$this->db->where($column_name,$primary_id);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			$dataArr=$query->result_array()[0];
			if($dataArr['display_on_home_listing'] == "0"){
				$this->db->where($column_name, $primary_id);
				$arrData = array('display_on_home_listing'=>'1');
				$this->db->update($table_name, $arrData);
				if($this->db->affected_rows() > 0) {
					return array('status' => '1','responce'=>true);
				}
				else {
					return false;
				}
			}else{
				$this->db->where($column_name, $primary_id);
				$arrData = array('display_on_home_listing'=>'0');
				$this->db->update($table_name, $arrData);
				if($this->db->affected_rows() > 0) {
					return array('status' => '0','responce'=>true);
				}
				else {
					return false;
				}
			}
		}
	}
	public function updateIsActive($primary_id,$column_name,$table_name)
	{
		$this->db->select("is_active");        
		$this->db->from($table_name);
		$this->db->where($column_name,$primary_id);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			$dataArr=$query->result_array()[0];
			if($dataArr['is_active'] == "0"){
				$this->db->where($column_name, $primary_id);
				$arrData = array('is_active'=>'1');
				$this->db->update($table_name, $arrData);
				if($this->db->affected_rows() > 0) {
					return array('status' => '1','responce'=>true);
				}
				else {
					return false;
				}
			}else{
				$this->db->where($column_name, $primary_id);
				$arrData = array('is_active'=>'0');
				$this->db->update($table_name, $arrData);
				if($this->db->affected_rows() > 0) {
					return array('status' => '0','responce'=>true);
				}
				else {
					return false;
				}
			}
		}

	}
	
	public function select($vars,$table_name, $where = "", $order_by = "", $group_by = "")
	{
		$this->db->select($vars);        
		$this->db->from($table_name);
		$this->db->where($where);
		$this->db->where("is_active='Y'");
		$this->db->order_by($order_by,"asc");
		$this->db->group_by($group_by);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return false;
		}
	}

/* :)END */
}

?>