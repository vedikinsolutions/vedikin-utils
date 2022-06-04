<?php
class Update_history_model extends CI_Model
{
    public function get($limit,$offset)
    {
        $query=$this->db->select('update_history.update_history_id,reminder.reminder_title,update_history.next_reminder_date,update_history.modified_datetime,update_history.is_active,user_master.user_name')
                        ->join('reminder','reminder.reminder_id=update_history.reminder_id')
                        ->join('user_master','user_master.user_id=update_history.modified_by')
                        ->get('update_history');
        return $query->result();
    }
    public function paginations()
    {
        $q=$this->db->join('reminder r','r.reminder_id=uh.reminder_id')
                    ->get('update_history uh');
        return $q->num_rows();
    }
  
    public function insert($data)
    {
        $this->db->insert('update_history', $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		}
		else {
			return false;
		}
    }
    public function getHistoryById($update_history_id)
    {
        $query=$this->db->select('reminder.reminder_title,update_history.next_reminder_date,update_history.modified_datetime,update_history.is_active,update_history.remarks,update_history.update_history_id')
                        ->join('reminder','reminder.reminder_id=update_history.reminder_id')
                        ->where('update_history.update_history_id',$update_history_id)
                        ->get('update_history');
        return $query->result();
    }
    public function update($data,$id)
    {
        $this->db->where('update_history_id', $id);
		$update = $this->db->update('update_history', $data);
		return  $this->db->affected_rows();
    }
    public function delete($update_history_id)
    {
        $this->db->where('update_history_id', $update_history_id);
		$this->db->delete('update_history');
       
		if($this->db->affected_rows() > 0) {
			return true;
		}
		else {
			return false;
		}
    }
    public function search_history($keyword)
    {   
        
        $query=$this->db->select('reminder.reminder_title,update_history.next_reminder_date,update_history.modified_datetime,update_history.is_active,update_history.update_history_id,user_master.user_name')
                        ->join('reminder','reminder.reminder_id=update_history.reminder_id')
                        ->join('user_master','update_history.modified_by=user_master.user_id')
                        ->where('reminder.reminder_title like \'%'.$keyword.'%\'')
                        ->get('update_history');
                        // echo $this->db->last_query();
        return $query->result();
    }
    public function delete_all($ids)
    {
        $query = $this->db->where_in('update_history_id', $ids);
		$query = $this->db->delete('update_history');
		if($query) {
			return TRUE;
		} else {
			return FALSE;
		}
    }
    public function get_reminders(){
        $query=$this->db->get('reminder');
        return $query->result();
    }
}