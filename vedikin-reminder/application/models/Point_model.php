<?php
class Point_model extends CI_Model
{
    public function get($limit,$offset)
    {
        $query=$this->db->select('points.points_id,points.points,points.user,point_category.point_category_name,points.is_active,user_master.user_name')
                        ->join('point_category','points.point_category_id=point_category.point_category_id')
                        ->join('user_master','user_master.user_id=points.modified_by')
                        ->limit($limit,$offset)
                        ->get('points');
        return $query->result();
    }
    public function paginations()
    {
        $q=$this->db->get('points');
        return $q->num_rows();
    }
  
    public function insert($data)
    {
        $this->db->insert('points', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}
		else {
			return false;
		}
    }
    public function search_point($keyword)
    {   
        
        $query=$this->db->select('point_category.point_category_name,points.user')
                        ->join('point_category','point_category.point_category_id=points.point_category_id')
                        ->where('point_category.point_category_name like \'%'.$keyword.'%\'')
                        ->or_where('points.user like \'%'.$keyword.'%\'')
                        ->get('points');
                        // echo $this->db->last_query();
        return $query->result();
    }
    public function getPointsById($points_id)
    {
        $query=$this->db->select('points.*,point_category.point_category_name,user_master.user_name')
                        ->join('user_master','points.modified_by=user_master.user_id')
                        ->join('point_category','point_category.point_category_id=points.point_category_id ')
                        ->where('points.points_id',$points_id)
                        ->get('points');
                    //     echo $this->db->last_query();
        return $query->result();
    }
    public function update($data,$id)
    {
        $this->db->where('points_id', $id);
		$update = $this->db->update('points', $data);
		return  $this->db->affected_rows();
    }
    public function delete($point_id)
    {
        $this->db->where('points_id', $point_id);
		$this->db->delete('points');
       
		if($this->db->affected_rows() > 0) {
			return true;
		}
		else {
			return false;
		}
    }
    public function get_point_category()
    {
        $query=$this->db->where('is_active','Y')->get('point_category');
        return $query->result();
    }
    public function get_report_data()
    {
        $query=$this->db->select('SUM(points) AS total_points,user')->group_by('user')->get('points');
        return $query->result();
    }
    public function get_report_filter_data()
    {
     
        $query=$this->db->select('SUM(points) AS total_points,user');
       
        if($_POST['txtSearchKeyWord'] != "")
        {
            $query = $this->db->where('user',$_POST['txtSearchKeyWord'] );
        } 
        elseif($_POST['txtSearchFromDate'] != "")
        {
            $query = $this->db->where('date >',$_POST['txtSearchFromDate'] );
        } 
        elseif($_POST['txtSearchToDate'] != "")
        {
            $query = $this->db->where('date <',$_POST['txtSearchToDate'] );
        }
        $query =$this->db->group_by('user')->get('points');
      
        return $query->result();
    }
}