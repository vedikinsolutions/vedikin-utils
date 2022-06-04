<?php
class User_right_model extends CI_Model
{
    public function paginations($table)
    {
        $q=$this->db->group_by('user_right.menu_id')
                    ->group_by('user_right.user_role_id')
                    ->get($table);
        return $q->num_rows();
    }
    public function get($limit,$offset)
    {
        $query=$this->db->select('user_right.menu_id,menu.menu_name,user_role.user_role_name,user_right.user_role_id')
                        ->join('menu','menu.menu_id=user_right.menu_id')
                        ->join('user_role','user_role.user_role_id=user_right.user_role_id')
                        ->limit($limit,$offset)
                        ->group_by('user_right.menu_id')
                        ->group_by('user_right.user_role_id')
                        ->order_by('user_right.user_right_id','desc')  
                        ->get('user_right');
                  //echo $this->db->last_query();exit;
        return $query->result();
    }
    public function get_menu()
    {
        $query=$this->db->where('is_active','Y')
                        ->get('menu');
        return $query->result();
    }
    public function get_user_role()
    {
        $query=$this->db->where('is_active','Y')
                        ->get('user_role');
        return $query->result();
    }
    public function insert($data)
    {
        $this->db->insert('user_right', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}
		else {
			return false;
		}
    }
    public function getUserRightById($id,$r_id)
    {
        $query=$this->db->select('user_right.*,menu.menu_name')
                        ->join('menu','menu.menu_id=user_right.menu_id')
                        // ->group_by('user_right.menu_id')
                        // ->group_by('user_right.user_role_id')
                        ->where('user_right.menu_id',$id)
                        ->where('user_right.user_role_id',$r_id)
                        ->get('user_right');
                       //echo $this->db->last_query();exit;
        return $query->result();
    }
    public function update($data,$id)
    {
        $this->db->where('menu_id', $id);
		$update = $this->db->update('user_right', $data);
      //  echo $this->db->last_query();
		return  $this->db->affected_rows();
    }
    public function delete($menu_id,$role_id)
    {
        $this->db->where('menu_id', $menu_id);
        $this->db->where('user_role_id', $role_id);
		$this->db->delete('user_right');
		if($this->db->affected_rows() > 0) {
			return true;
		}
		else {
			return false;
		}
    }
    public function search_user_right($keyword)
    {
         $query=$this->db->join('user_role','user_right.user_role_id=user_role.user_role_id')
                        ->join('menu','user_right.menu_id=menu.menu_id')
                        ->where('user_role.user_role_name like \'%'.$keyword.'%\' OR '. 'menu.menu_name like \'%'.$keyword.'%\'')
                        ->group_by('user_right.menu_id')
                        ->group_by('user_right.user_role_id')
                        ->order_by('user_right.user_right_id','desc')  
                        ->get('user_right');
        return $query->result();
    }
    public function delete_all($ids)
    {
        $query = $this->db->where_in('menu_id', $ids);
		$query = $this->db->delete('user_right');
		if($query) {
			return TRUE;
		} else {
			return FALSE;
		}
    }
}