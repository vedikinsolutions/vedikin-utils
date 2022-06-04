<?php 
class Menu_model extends CI_Model
{

    public function __construct()
    {
        if (!ISSET($this->session->userdata['logged_in']) && strpos( $_SERVER['REQUEST_URI'], 'login') === FALSE)
        {
            redirect(base_url() . 'login');
        }
    }

    public function get_menu($id)
    {

        $menu=$this->db->select('m.*,ur.*')
                        ->FROM('user_role as u')
                        ->JOIN('user_right as ur','u.user_role_id=ur.user_role_id')
                        ->JOIN('menu as m','ur.menu_id=m.menu_id','left')
                        ->WHERE('u.user_role_id',$id)
                        ->WHERE('m.is_active','Y')
                        ->GROUP_BY('ur.menu_id')
                        //->WHERE('ur.user_rights','1')
                        ->order_by('m.menu_order','ASC')
                        ->get();
                        //echo $this->db->last_query();exit;
        return $menu->result();
    }
    public function get_all_menu()
    {
        $menu=$this->db->order_by('menu_order')
                        ->where('is_active','Y')
                        ->get('menu');
        return $menu->result();
    }

    public function get($limit,$offset)
    {
        $query=$this->db->order_by('menu.menu_id','desc')
                        ->limit($limit,$offset)
                        ->get('menu');
                       // echo $this->db->last_query();exit;
        return $query->result();
    }
    public function paginations($table)
    {
        $q=$this->db->get($table);
        return $q->num_rows();
    }
    public function insert($data)
    {
        $this->db->insert('menu', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}
		else {
			return false;
		}
    }
    public function update($data,$id)
    {
        $this->db->where('menu_id', $id);
		$update = $this->db->update('menu', $data);
		return  $this->db->affected_rows();
    }
    public function delete($menu_id)
    {
        $this->db->where('menu_id', $menu_id);
		$this->db->delete('menu');
		if($this->db->affected_rows() > 0) {
			return true;
		}
		else {
			return false;
		}
    }
    public function getMenuById($menu_id)
    {
        $query=$this->db->where('menu_id',$menu_id)
                        ->get('menu');
                        return $query->result();
    }
    public function search_menu($keyword)
    {
        $query=$this->db->where('menu_name like \'%'.$keyword.'%\'')
                        ->order_by('menu_name','ASC')
                        ->get('menu');
                        	
        return $query->result();
    }
        
    public function getFiles($upload_id)
    {
        $user=$this->db->select('menu_id, menu_icon')
						->from('menu')
                        ->where('menu_id', $upload_id)
						->get();
		return $user->result();
    }
    public function delete_all($ids)
    {
        $query = $this->db->where_in('menu_id', $ids);
		$query = $this->db->delete('menu');
		if($query) {
			return TRUE;
		} else {
			return FALSE;
		}
    }
}