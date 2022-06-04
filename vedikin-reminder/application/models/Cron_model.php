<?php
class Cron_model extends CI_Model
{
    public function get_reminder()
    {
        $reminder_date=date("Y-m-d", strtotime("+3 day"));
        $query =$this->db->select('reminder_title,reminder_type')->where('reminder_date',$reminder_date)->get('reminder');
        return  $query->result_array();
        //$query=$this->db->where
    }
}