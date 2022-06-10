<?php
class Controller_update_history extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->module_name="update_history";
        $this->module_redirect='update_history';
        $this->load->model('menu_model');
        $this->load->model('update_history_model');
        if(isset($this->session->userdata['user_rights']['update-history-list']) == ''){
            redirect('dashboard');
        }
    }
    public function index()
    {
        
        $config = array(
			'base_url' => SITE_URL.'update-history-list',
			'full_tag_open' => "<ul class='pagination'>",
			'full_tag_close' => "</ul>",
			'next_tag_open' => "<li>",
			'next_tag_close' => "</li>",
			'prev_tag_open' => "<li>",
			'prev_tag_close' => "</li>",
			'num_tag_open' => "<li>",
			'num_tag_close' => "</li>",
			'cur_tag_open' => "<li class='active'><a>",
			'cur_tag_close' => "</a></li>",
			'first_tag_open' => "<li>",
			'first_link' => "First",
			'first_tag_close' => "</li>",
			'last_tag_open' => "<li>",
			'last_tag_close' => "</li>",
            'last_link' => "Last",
            'per_page' => PER_PAGE_RECORD,
           
        );
       
        $config['total_rows']=$this->menu_model->paginations(DB_PREFIX.'update_history');
       
		$this->pagination->initialize($config);
		
        $ArrHistoryData['page_title'] = 'Updated History List';
       
        $ArrHistoryData['button_url'] =  base_url() . $this->module_name.'_add';
        
		$ArrHistoryData['button_label'] = 'Add Updated History';
        $ArrHistoryData['view_name'] = 'view_'.$this->module_name.'_list.php';
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        
        $ArrHistoryData['get_data'] = $this->update_history_model->get($config['per_page'],$start_index);
        //$ArrUserData['menus']=$this->menu_model->get_all_menu();
       // echo $this->db->last_query();exit;
       if($this->session->userdata['logged_in']['user_role_id'] == 1)
       {
           $ArrHistoryData['menus']=$this->menu_model->get_all_menu();
       }
       else
       {
           $ArrHistoryData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
       }
       
        $this->load->view('admin_panel',$ArrHistoryData);
    }
    public function add()
    {
        $ArrHistoryData = array();
        $ArrHistoryData['page_title'] = 'Add Reminder';
        $ArrHistoryData['view_name'] = 'view_'.$this->module_name.'_add.php';
        $ArrHistoryData['reminders'] = $this->update_history_model->get_reminders();	
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
        {
           $ArrHistoryData['menus']=$this->menu_model->get_all_menu();
        }
        else
        {
           $ArrHistoryData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
        }
        $this->load->view('admin_panel',$ArrHistoryData); 
    }
    public function save()
    {
        if($this->updated_history_validation())
        {
            $data = array(
                'reminder_id'=>$_POST['reminder'],
                'next_reminder_date'=>date('Y-m-d',strtotime($_POST['reminder_date'])),
                'remarks'=>$_POST['remarks'],
                'is_active'=>$_POST['is_active'],
                'created_datetime'=>date('Y-m-d H:i:s'),
                'modified_datetime'=>date('Y-m-d H:i:s'),
                'created_by'=>$this->session->userdata["logged_in"]["user_id"],
                'modified_by'=>$this->session->userdata["logged_in"]["user_id"]
            );
            $history_id=$this->update_history_model->insert($data);
            
            
            if($history_id > 0){
                $reminder_date=array(
                    'reminder_date'=>date('Y-m-d',strtotime($_POST['reminder_date'])),
                    'modified_datetime'=>date('Y-m-d H:i:s')
                  );
                  $this->load->model('reminder_model');
                  $this->reminder_model->update($reminder_date,$_POST['reminder']); 
                $this->session->set_flashdata('success_message', 'Updated History has been saved successfully');
                redirect('update-history-list');exit;
                
            }else{
                $this->session->set_flashdata('error_message', 'Updated History has not been saved successfully');
                redirect($this->module_name.'-add');exit;
            }      
            
        }
        else
        {
            $ArrHistoryData = array();
            $ArrHistoryData['page_title'] = 'Add Reminder';
            $ArrHistoryData['reminders'] = $this->update_history_model->get_reminders();
            $ArrHistoryData['view_name'] = 'view_'.$this->module_name.'_add.php';	
            // $ArrUserData['menus']=$this->menu_model->get_all_menu();
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
                $ArrHistoryData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
                $ArrHistoryData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
            $this->load->view('admin_panel',$ArrHistoryData); 
        }
    }
    public function edit($history_id)
    {
        $ArrHistoryData = array();
        $ArrHistoryData['page_title'] = 'Update Reminder';
        $ArrHistoryData['view_name'] = 'view_'.$this->module_name.'_edit.php';
        $ArrHistoryData['reminders'] = $this->update_history_model->get_reminders();
        $ArrHistoryData['get_data'] = $this->update_history_model->getHistoryById($history_id);
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
        {
            $ArrHistoryData['menus']=$this->menu_model->get_all_menu();
        }
        else
        {
            $ArrHistoryData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
        }
        $this->load->view('admin_panel',$ArrHistoryData); 
    }
    public function save_update()
    {
        if($this->updated_history_validation())
        {
            
            $history_id=$_POST['history_id'];
            $data = array(
                'reminder_id'=>$_POST['reminder'],
                'next_reminder_date'=>date('Y-m-d',strtotime($_POST['reminder_date'])),
                'remarks'=>$_POST['remarks'],
                'is_active'=>$_POST['is_active'],
                'modified_datetime'=>date('Y-m-d H:i:s'),
                'modified_by'=>$this->session->userdata["logged_in"]["user_id"]
                
            );
            $history_id=$this->update_history_model->update($data,$history_id);
            
                if($history_id > 0){

                    $reminder_date=array(
                        'reminder_date'=>date('Y-m-d',strtotime($_POST['reminder_date'])),
                        'modified_datetime'=>date('Y-m-d H:i:s')
                      );
                      $this->load->model('reminder_model');
                      $this->reminder_model->update($reminder_date,$_POST['reminder']);
                    $this->session->set_flashdata('success_message', 'Updated History has been updated successfully');
                    redirect('update-history-list');exit;
                    
                }else{
                    $this->session->set_flashdata('error_message', 'Updated History has not been updated successfully');
                    redirect($this->module_name.'-update/'.$history_id);exit;
                }
        }
        else
        {
            $ArrHistoryData = array();
            $ArrHistoryData['page_title'] = 'Update Reminder';
            $ArrHistoryData['view_name'] = 'view_'.$this->module_name.'_edit.php';
            $ArrHistoryData['reminders'] = $this->update_history_model->get_reminders();
            $ArrHistoryData['get_data'] = $this->update_history_model->getHistoryById($_POST['history_id']);
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
                $ArrHistoryData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
                $ArrHistoryData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
            $this->load->view('admin_panel',$ArrHistoryData); 
        }
    }
    public function delete($history_id)
    {
        $result = $this->update_history_model->delete($history_id);
		if($result){
			echo 'Yes';
		}else{
			echo 'No';
		}
    }
    public function updated_history_validation()
    {
       
        $this->form_validation->set_rules('reminder_date','Reminder Date','required');

        if($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    public function search_update_history()
    {
        if(isset($_POST['txtSearchKeyWord']) && $_POST['txtSearchKeyWord'] != "")
        {
            $keyword = trim($_POST['txtSearchKeyWord']);
            $ArrReminderData = array();
            $ArrReminderData['page_title'] = 'Reminder List';
            $ArrReminderData['button_url'] =  base_url() . $this->module_name.'-add';
            $ArrReminderData['button_label'] = 'Add Reminder';
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
                $ArrReminderData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
                $ArrReminderData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
          //  $ArrMenuData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            /*if($this->session->userdata['logged_in']['user_role_id'] == '3'){
                $ArrAuditData['services']=$this->menu_model->get_services($this->session->userdata['logged_in']['entity_id']);
            }*/
            $ArrReminderData['get_data']=$this->update_history_model->search_history($keyword);
            //echo $this->db->last_query();exit;
            $ArrReminderData['view_name'] = 'view_'.$this->module_name.'_list.php';
            
            $this->load->view('admin_panel',$ArrReminderData);

        }
        else
        {
            return redirect('reminder-list');
        }
    }
    public function delete_all()
    {
        if (isset($_POST['ids'])) {
			$ids = explode(',', $_POST['ids']);
			$results = $this->user_model->delete_all($ids);
		}
    }
    public function history_sorting($sort_by)
    {
        $field=$_GET['field'];
        
        $ArrHistoryData['page_title'] = 'Updated History List';
       
        $ArrHistoryData['button_url'] =  base_url() . $this->module_name.'_add';
        
		$ArrHistoryData['button_label'] = 'Add Updated History';
        $ArrHistoryData['view_name'] = 'view_'.$this->module_name.'_list.php';
      
        
        $ArrHistoryData['get_data']=$this->update_history_model->history_sorting($field,$sort_by);
   
       if($this->session->userdata['logged_in']['user_role_id'] == 1)
       {
           $ArrHistoryData['menus']=$this->menu_model->get_all_menu();
       }
       else
       {
           $ArrHistoryData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
       }
       
        $this->load->view('admin_panel',$ArrHistoryData);
          
          
           
    
    }
}