<?php
class Controller_cron extends CI_Controller
{
    public function index()
    {
        $this->load->model('cron_model');
        $data=$this->cron_model->get_reminder();
        if(count($data) > 0)
        {
            $domains=array();
            $str_domains="";
            for($i=0;$i<count($data);$i++)
            {
                $domains=$data[$i];
                $str_domains .= implode(",",$domains).',';
            }
            $subject='About SSL Renew';
            $message=$str_domains;
            send_mail(TO_EMAIL_ID,$subject,$message);
        }
       
    }
}