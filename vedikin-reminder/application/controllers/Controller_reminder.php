<?php
class Controller_reminder extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->module_name="reminder";
        $this->module_redirect='reminder';
        $this->load->model('menu_model');
        $this->load->model('reminder_model');
        if(isset($this->session->userdata['user_rights']['reminder-list']) == ''){
            redirect('dashboard');
        }
    }
    public function index()
    {
        
        $config = array(
			'base_url' => SITE_URL.'reminder-list',
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
       
        $config['total_rows']=$this->menu_model->paginations(DB_PREFIX.'reminder');
       
		$this->pagination->initialize($config);
		
        $ArrReminderData['page_title'] = 'Reminder List';
       
        $ArrReminderData['button_url'] =  base_url() . $this->module_name.'-add';
        
		$ArrReminderData['button_label'] = 'Add Reminder';
        $ArrReminderData['view_name'] = 'view_'.$this->module_name.'_list.php';
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        
        $ArrReminderData['get_data'] = $this->reminder_model->get($config['per_page'],$start_index);
        //$ArrUserData['menus']=$this->menu_model->get_all_menu();
       // echo $this->db->last_query();exit;
       if($this->session->userdata['logged_in']['user_role_id'] == 1)
       {
           $ArrReminderData['menus']=$this->menu_model->get_all_menu();
       }
       else
       {
           $ArrReminderData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
       }
       
        $this->load->view('admin_panel',$ArrReminderData);
    }
    public function add()
    {
        $ArrReminderData = array();
        $ArrReminderData['page_title'] = 'Add Reminder';
        $ArrReminderData['view_name'] = 'view_'.$this->module_name.'_add.php';	
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
        {
           $ArrReminderData['menus']=$this->menu_model->get_all_menu();
        }
        else
        {
           $ArrReminderData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
        }
        $this->load->view('admin_panel',$ArrReminderData); 
    }
    public function save()
    {
        if($this->reminder_validation())
        {
            $data = array(
                'reminder_title'=>$_POST['title'],
                'reminder_type'=>$_POST['type'],
                'reminder_date'=>date('Y-m-d',strtotime($_POST['reminder_date'])),
                'remarks'=>$_POST['remarks'],
                'is_active'=>$_POST['is_active'],
                'created_datetime'=>date('Y-m-d H:i:s'),
                'modified_datetime'=>date('Y-m-d H:i:s'),
                'created_by'=>$this->session->userdata["logged_in"]["user_id"],
                'modified_by'=>$this->session->userdata["logged_in"]["user_id"]
            );
            $reminder_id=$this->reminder_model->insert($data);

            
            if($reminder_id > 0){
                $this->session->set_flashdata('success_message', 'Reminder has been saved successfully');
                redirect('reminder-list');exit;
                
            }else{
                $this->session->set_flashdata('error_message', 'Reminder has not been saved successfully');
                redirect($this->module_name.'-add');exit;
            }      
            
        }
        else
        {
            $ArrReminderData = array();
            $ArrReminderData['page_title'] = 'Add Reminder';
            $ArrReminderData['view_name'] = 'view_'.$this->module_name.'_add.php';	
            // $ArrUserData['menus']=$this->menu_model->get_all_menu();
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
                $ArrReminderData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
                $ArrReminderData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
            $this->load->view('admin_panel',$ArrReminderData); 
        }
    }
    public function edit($reminder_id)
    {
        $ArrReminderData = array();
        $ArrReminderData['page_title'] = 'Update Reminder';
        $ArrReminderData['view_name'] = 'view_'.$this->module_name.'_edit.php';
        $ArrReminderData['get_data'] = $this->reminder_model->getReminderById($reminder_id);
        $ArrReminderData['get_history']=$this->reminder_model->get_history($reminder_id);
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
        {
            $ArrReminderData['menus']=$this->menu_model->get_all_menu();
        }
        else
        {
            $ArrReminderData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
        }
        $this->load->view('admin_panel',$ArrReminderData); 
    }
    public function save_update()
    {
        if($this->reminder_validation())
        {
            $reminder_id=$_POST['reminder_id'];
            $data = array(
                'reminder_title'=>$_POST['title'],
                'reminder_type'=>$_POST['type'],
                'reminder_date'=>date('Y-m-d',strtotime($_POST['reminder_date'])),
                'remarks'=>$_POST['remarks'],
                'is_active'=>$_POST['is_active'],
                'modified_datetime'=>date('Y-m-d H:i:s'),
                'modified_by'=>$this->session->userdata["logged_in"]["user_id"]
                
            );
            $user_id=$this->reminder_model->update($data,$reminder_id);
               
                if($user_id > 0){
                    $this->session->set_flashdata('success_message', 'Reminder has been updated successfully');
                    redirect('reminder-list');exit;
                    
                }else{
                    $this->session->set_flashdata('error_message', 'Reminder has not been updated successfully');
                    redirect($this->module_name.'-update/'.$reminder_id);exit;
                }
        }
        else
        {
            $ArrReminderData = array();
            $ArrReminderData['page_title'] = 'Update User';
            $ArrReminderData['view_name'] = 'view_'.$this->module_name.'_edit.php';
            $ArrReminderData['user_types']=$this->user_model->get_user_type();
            $ArrReminderData['get_data'] = $this->user_model->getUserById($_POST['user_id']);
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
                $ArrReminderData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
                $ArrReminderData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
            $this->load->view('admin_panel',$ArrReminderData); 
        }
    }
    public function delete($user_id)
    {
        $result = $this->reminder_model->delete($user_id);
		if($result){
			echo 'Yes';
		}else{
			echo 'No';
		}
    }
    public function reminder_validation()
    {
        $this->form_validation->set_rules('title','Title','required');
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
    public function search_reminder()
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
            $ArrReminderData['get_data']=$this->reminder_model->search_reminder($keyword);
          
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
    public function reminder_sorting($sort_by)
    {
        $field=$_GET['field'];
        
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
            $ArrReminderData['get_data']=$this->reminder_model->reminder_sorting($field,$sort_by);
          
            $ArrReminderData['view_name'] = 'view_'.$this->module_name.'_list.php';
            
            $this->load->view('admin_panel',$ArrReminderData);
    
    }
}