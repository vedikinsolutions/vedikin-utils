<?php
class User_model extends CI_Model
{
    public function get($limit,$offset)
    {
        $query=$this->db->select('user_role.user_role_id,user_role.user_role_name,user_master.*')
                        ->join('user_role','user_role.user_role_id=user_master.user_role_id')
                        ->limit($limit,$offset)
                        ->get('user_master');
        return $query->result();
    }
    public function paginations($table)
    {
        $q=$this->db->get($table);
        return $q->num_rows();
    }
    public function get_user_type()
    {
        $query=$this->db->get('user_role');
        return $query->result();
    }
    public function insert($data)
    {
        $this->db->insert('user_master', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}
		else {
			return false;
		}
    }
    public function getUserById($user_id)
    {
        $query=$this->db->select('user_role.user_role_id,user_role.user_role_name,user_master.*')
                        ->join('user_role','user_role.user_role_id=user_master.user_role_id')
                        ->where('user_master.user_id',$user_id)
                        ->get('user_master');
        return $query->result();
    }
    public function update($data,$id)
    {
        $this->db->where('user_id', $id);
		$update = $this->db->update('user_master', $data);
		return  $this->db->affected_rows();
    }
    public function delete($user_id)
    {
        $this->db->where('user_id', $user_id);
		$this->db->delete('user_master');
		if($this->db->affected_rows() > 0) {
			return true;
		}
		else {
			return false;
		}
    }
    public function search_user($keyword)
    {   
        
        $query=$this->db->join('user_role','user_master.user_role_id = user_role.user_role_id')
                        ->where('user_master.user_name like \'%'.$keyword.'%\' OR '. 'user_master.email like \'%'.$keyword.'%\' OR ' . 'user_role.user_role_name like \'%'.$keyword.'%\'')
                        ->order_by('user_master.user_name','ASC')
                        ->get('user_master');
                        // echo $this->db->last_query();
        return $query->result();
    }

    public function update_password($user_id, $password)
    {
        $this->db->where('user_id', $user_id);
        $update = $this->db->update('user_master', $password);
        return $this->db->affected_rows();
    }
    public function delete_all($ids)
    {
        $query = $this->db->where_in('user_id', $ids);
		$query = $this->db->delete('user_master');
		if($query) {
			return TRUE;
		} else {
			return FALSE;
		}
    }
    
}