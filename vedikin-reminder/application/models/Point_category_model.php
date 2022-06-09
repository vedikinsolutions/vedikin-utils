<?php
class Point_category_model extends CI_Model
{
    public function get($limit,$offset)
    {
        $query=$this->db->select('point_category.point_category_id,point_category.point_category_name,point_category.modified_datetime,point_category.is_active,user_master.user_name')
                        ->join('user_master','user_master.user_id=point_category.modified_by')
                        ->limit($limit,$offset)
                        ->get('point_category');
        return $query->result();
    }
    public function paginations()
    {
        $q=$this->db->get('point_category');
        return $q->num_rows();
    }
  
    public function insert($data)
    {
        $this->db->insert('point_category', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}
		else {
			return false;
		}
    }
    public function search_point_category($keyword)
    {   
        
        $query=$this->db->select('point_category.*,user_master.user_name')
                        ->join('user_master','point_category.modified_by=user_master.user_id')
                        ->where('point_category.point_category_name like \'%'.$keyword.'%\'')
                        ->get('point_category');
                        // echo $this->db->last_query();
        return $query->result();
    }
    public function getCategoryById($category_id)
    {
        $query=$this->db->select('point_category.*,user_master.user_name')
                        ->join('user_master','point_category.modified_by=user_master.user_id')
                        ->where('point_category.point_category_id',$category_id)
                        ->get('point_category');
                        // echo $this->db->last_query();
        return $query->result();
    }
    public function update($data,$id)
    {
        $this->db->where('point_category_id', $id);
		$update = $this->db->update('point_category', $data);
		return  $this->db->affected_rows();
    }
    public function delete($category_id)
    {
        $this->db->where('point_category_id', $category_id);
		$this->db->delete('point_category');
       
		if($this->db->affected_rows() > 0) {
			return true;
		}
		else {
			return false;
		}
    }
}