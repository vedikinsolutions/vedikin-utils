<?php
class Cron_model extends CI_Model
{
    public function get_reminder()
    {
        $reminder_date=date("Y-m-d", strtotime("+3 day"));
        $query =$this->db->where('reminder_date',$reminder_date)->where('is_active','Y')->get('reminder');
        return  $query->result_array();
        //$query=$this->db->where
    }
}