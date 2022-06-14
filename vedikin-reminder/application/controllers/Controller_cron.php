<?php
class Controller_cron extends CI_Controller
{
    public function index()
    {
        if($_GET['url'] == '5s123jfloqisou6qxb51wbtlr0xyb8lfzh4652v8el39325y4abxrh9p8l3d3q2xxfisqi19yq01l1ms37f0k42ged9yty9g7sbp')
        {
            $this->load->model('cron_model');
            $data=$this->cron_model->get_reminder();
          
            if(count($data) > 0)
            {
                
                $domains=array();
                $str_domains="";
                for($i=0;$i<count($data);$i++)
                {
                    $domains[]=$data[$i];
                   
                }
                $message="<table><tr><th>Reminder Title</th><th>Reminder Type</th><th>Reminder Date</th><th>Remarks</th></tr>";
                foreach($domains as $domain){
                    $message .= "<tr>";
                    $message .= "<td>".$domain['reminder_title']."</td>";
                    $message .= "<td>".$domain['reminder_type']."</td>";
                    $message .= "<td>".date('Y-m-d',strtotime($domain['reminder_date']))."</td>";
                    $message .= "<td>".$domain['remarks']."</td>";
                    $message .= "</tr>";
                }
                $message .= "</table>";
                $subject=' Renewal Reminder for '.date('Y-m-d',strtotime($data[0]['reminder_date']));
                
                send_mail(TO_EMAIL_ID,$subject,$message);
            }
        }
        else
        {
            echo "Please enter valid URL";
        }
    }
}