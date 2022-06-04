<?php
class Reminder_model extends CI_Model
{
    public function get($limit,$offset)
    {
        $query=$this->db->select('reminder.*,user_master.user_name')
                        ->join('user_master','reminder.modified_by=user_master.user_id')
                        ->get('reminder');
        return $query->result();
    }
    public function paginations($table)
    {
        $q=$this->db->get($table);
        return $q->num_rows();
    }
  
    public function insert($data)
    {
        $this->db->insert('reminder', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}
		else {
			return false;
		}
    }
    public function getReminderById($reminder_id)
    {
        $query=$this->db->where('reminder_id',$reminder_id)
                        ->get('reminder');
        return $query->result();
    }
    public function update($data,$id)
    {
        $this->db->where('reminder_id', $id);
		$update = $this->db->update('reminder', $data);
		return  $this->db->affected_rows();
    }
    public function delete($reminder_id)
    {
        $this->db->where('reminder_id', $reminder_id);
		$this->db->delete('reminder');
       
		if($this->db->affected_rows() > 0) {
			return true;
		}
		else {
			return false;
		}
    }
    public function search_reminder($keyword)
    {   
        
        $query=$this->db->select('reminder.*,user_master.user_name')
                        ->join('user_master','reminder.modified_by=user_master.user_id')
                        ->where('reminder.reminder_title like \'%'.$keyword.'%\'')
                        ->get('reminder');
                        // echo $this->db->last_query();
        return $query->result();
    }
    public function delete_all($ids)
    {
        $query = $this->db->where_in('reminder_id', $ids);
		$query = $this->db->delete('reminder');
		if($query) {
			return TRUE;
		} else {
			return FALSE;
		}
    }

}