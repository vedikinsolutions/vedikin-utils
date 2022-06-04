<?php
class controller_user_right extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->module_name='user_right';
        $this->module_redirect='user-right';
        $this->load->model('user_right_model');
        $this->load->model('menu_model');
        
    }
    public function index()
    {
        $config = array(
			'base_url' => SITE_URL.'user-right-list',
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
       
        $config['total_rows']=$this->user_right_model->paginations(DB_PREFIX.'user_right');
       
		$this->pagination->initialize($config);
		
        $ArrUserRightData['page_title'] = 'User Right List';
       
        $ArrUserRightData['button_url'] =  base_url() . $this->module_name.'-add';
       
		$ArrUserRightData['button_label'] = 'Add User Right';
        $ArrUserRightData['view_name'] = 'view_'.$this->module_name.'_list.php';
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    
        $ArrUserRightData['get_data'] = $this->user_right_model->get($config['per_page'],$start_index);
    
       if($this->session->userdata['logged_in']['user_role_id'] == 1)
       {
           $ArrUserRightData['menus']=$this->menu_model->get_all_menu();
       }
       else
       {
           $ArrUserRightData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
       }
       
        $this->load->view('admin_panel',$ArrUserRightData);
    }
    public function add()
    {
        $ArrUserRightData = array();
        $ArrUserRightData['page_title'] = 'Add User Right';
        $ArrUserRightData['view_name'] = 'view_'.$this->module_name.'_add.php';	
        $ArrUserRightData['menu_list']=$this->user_right_model->get_menu();
        $ArrUserRightData['user_type_list']=$this->user_right_model->get_user_role();
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
        {
           $ArrUserRightData['menus']=$this->menu_model->get_all_menu();
        }
        else
        {
           $ArrUserRightData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
        }
        $this->load->view('admin_panel',$ArrUserRightData); 
    }
    public function save()
    {
        
        if(isset($_POST['right']))
        {
            $rights=$_POST['right'];
            foreach($rights as $right)
            {
                $data=array(
                    'user_role_id'=>$_POST['user_type'],
                    'menu_id'=>$_POST['menu_name'],
                    'user_rights'=>$right,
                    'is_active'=>$_POST['is_active'],
                    'created_datetime'=>date('Y-m-d H:i:s')
                );
                $id=$this->user_right_model->insert($data);
            }
            if($id > 0){
                $this->session->set_flashdata('success_message', 'User Type has been saved successfully');
                redirect('user-right-list');exit;
                
            }else{
                $this->session->set_flashdata('error_message', 'User Type has not been saved successfully');
                redirect($this->module_name.'-add');exit;
            }      
        }
        else
        {
            $ArrUserRightData = array();
            $ArrUserRightData['page_title'] = 'Add User Right';
            $ArrUserRightData['view_name'] = 'view_'.$this->module_name.'_add.php';	
            $ArrUserRightData['menu_list']=$this->user_right_model->get_menu();
            $ArrUserRightData['user_type_list']=$this->user_right_model->get_user_role();
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
               $ArrUserRightData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
               $ArrUserRightData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
            $this->load->view('admin_panel',$ArrUserRightData);   
        }
    }
    public function edit($menu_id,$role_id)
    {
        $ArrUserRightData = array();
        $ArrUserRightData['page_title'] = 'Update User Right';
        $ArrUserRightData['view_name'] = 'view_'.$this->module_name.'_edit.php';
        $ArrUserRightData['get_data'] = $this->user_right_model->getUserRightById($menu_id,$role_id);
        //echo $this->db->last_query();exit;
        $ArrUserRightData['menu_list']=$this->user_right_model->get_menu();
        $ArrUserRightData['user_type_list']=$this->user_right_model->get_user_role();
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
        {
           $ArrUserRightData['menus']=$this->menu_model->get_all_menu();
        }
        else
        {
           $ArrUserRightData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
        }
        $this->load->view('admin_panel',$ArrUserRightData); 
    }
    public function save_update()
    {
        $menu_id=$_POST['menu_name'];
        $role_id = $_POST['user_type'];
        $rights=$_POST['right'];
        $this->user_right_model->delete($menu_id,$role_id);
        foreach($rights as $right)
        {
            $data=array(
                'user_role_id'=>$_POST['user_type'],
                'menu_id'=>$_POST['menu_name'],
                'user_rights'=>$right,
                'is_active'=>$_POST['is_active'],
                'modified_datetime'=>date('Y-m-d H:i:s')
            );
            $id=$this->user_right_model->insert($data);
        }
        if($id > 0){
            $this->session->set_flashdata('success_message', 'User Right has been saved successfully');
            redirect('user-right-list');exit;
            
        }else{
            $this->session->set_flashdata('error_message', 'User Right has not been saved successfully');
            redirect('user-right-update/'.$menu_id);exit;
        }    
    }
    public function delete($menu_id,$role_id)
    {
        $result = $this->user_right_model->delete($menu_id,$role_id);
       // echo $this->db->last_query();exit;
		if($result){
			echo 'Yes';
		}else{
			echo 'No';
		}
    }
    public function search_user_right()
    {
        if(isset($_POST['txtSearchKeyWord']) && $_POST['txtSearchKeyWord'] != "")
        {
            $keyword=trim($_POST['txtSearchKeyWord']);
            $ArrUserRightData = array();
            $ArrUserRightData['page_title'] = 'User Right List';
            $ArrUserRightData['button_url'] = base_url() .  $this->module_name.'-add';
            $ArrUserRightData['button_label'] = 'Add User Right';
            $ArrUserRightData['view_name'] = 'view_'.$this->module_name.'_list.php';
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
                $ArrUserRightData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
                $ArrUserRightData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
            $ArrUserRightData['get_data']=$this->user_right_model->search_user_right($keyword);
            //echo $this->db->last_query();exit;
           
            
            $this->load->view('admin_panel',$ArrUserRightData);

        }
        else
        {
            return redirect('user-role-list');
        }
    }  
    public function delete_all()
    {
        if (isset($_POST['ids'])) {
			$ids = explode(',', $_POST['ids']);
			$results = $this->user_right_model->delete_all($ids);
		}
    }
}