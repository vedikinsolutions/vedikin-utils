<?php
class User_role_model extends CI_Model
{
    public function get($limit,$offset)
    {
        $query=$this->db->order_by('user_role.user_role_id','desc')
                        ->limit($limit,$offset)
                        ->get('user_role');
        return $query->result();
    }
    public function paginations($table)
    {
        $q=$this->db->get($table);
        return $q->num_rows();
    }
    public function insert($data)
    {
        $this->db->insert('user_role', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}
		else {
			return false;
		}
    }
    public function update($data,$id)
    {
        $this->db->where('user_role_id', $id);
		$update = $this->db->update('user_role', $data);
		return  $this->db->affected_rows();
    }
    public function getUserTypeById($user_role_id)
    {
        $query=$this->db->where('user_role_id',$user_role_id)
                        ->get('user_role');
                        return $query->result();
    }
    public function delete($user_role_id)
    {
        $this->db->where('user_role_id', $user_role_id);
		$this->db->delete('user_role');
		if($this->db->affected_rows() > 0) {
			return true;
		}
		else {
			return false;
		}
    }
    public function search_user_role($keyword)
    {
        $query=$this->db->where('user_role_name like \'%'.$keyword.'%\'')
                        ->order_by('user_role_name','DESC')
                        ->get('user_role');	
        return $query->result();
    }
    public function delete_all($ids)
    {
        $query = $this->db->where_in('user_role_id', $ids);
		$query = $this->db->delete('user_role');
		if($query) {
			return TRUE;
		} else {
			return FALSE;
		}
    }
}