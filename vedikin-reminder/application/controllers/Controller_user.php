<?php
class Controller_user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->module_name="user";
        $this->module_redirect='user';
        $this->load->model('menu_model');
        $this->load->model('user_model');
        if(isset($this->session->userdata['user_rights']['user-list']) == ''){
            redirect('dashboard');
        }
    }
    public function index()
    {
        $config = array(
			'base_url' => SITE_URL.'user-list',
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
       
        $config['total_rows']=$this->menu_model->paginations(DB_PREFIX.'user_master');
       
		$this->pagination->initialize($config);
		
        $ArrUserData['page_title'] = 'User List';
       
        $ArrUserData['button_url'] =  base_url() . $this->module_name.'-add';
       
		$ArrUserData['button_label'] = 'Add User';
        $ArrUserData['view_name'] = 'view_'.$this->module_name.'_list.php';
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    
        $ArrUserData['get_data'] = $this->user_model->get($config['per_page'],$start_index);
        //$ArrUserData['menus']=$this->menu_model->get_all_menu();
       // echo $this->db->last_query();exit;
       if($this->session->userdata['logged_in']['user_role_id'] == 1)
       {
           $ArrUserData['menus']=$this->menu_model->get_all_menu();
       }
       else
       {
           $ArrUserData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
       }
       
        $this->load->view('admin_panel',$ArrUserData);
    }
    public function add()
    {
        $ArrUserData = array();
        $ArrUserData['page_title'] = 'Add User';
        $ArrUserData['user_types']=$this->user_model->get_user_type();
        $ArrUserData['view_name'] = 'view_'.$this->module_name.'_add.php';	
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
        {
           $ArrUserData['menus']=$this->menu_model->get_all_menu();
        }
        else
        {
           $ArrUserData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
        }
        $this->load->view('admin_panel',$ArrUserData); 
    }
    public function save()
    {
        if($this->user_validation())
        {
            $data = array(
                'user_role_id'=>$_POST['user_type'],
                'user_name'=>$_POST['user_name'],
                'email'=>$_POST['email'],
                'password'=>$_POST['password'],
                'phone'=>$_POST['phone'],
                'is_active'=>$_POST['is_active'],
                "created_by"=>$this->session->userdata["logged_in"]["user_id"]
            );
            $user_id=$this->user_model->insert($data);

            // if($_POST['user_type'] == 2)
            // {
            //     $data_update=array(
            //         'subscription_id'=>$user_id
            //     );
            //     $this->user_model->update($data_update,$user_id);
            // }
            if($_POST['user_type'] == 3)
            {
                $data_update=array(
                    'subscription_id'=>$user_id
                );
                $this->user_model->update($data_update,$user_id);
            }
            else
            {
                $data_update=array(
                    'subscription_id'=>$this->session->userdata["logged_in"]["subscription_id"]
                );
                $this->user_model->update($data_update,$user_id);
            }
            if($user_id > 0){
                $this->session->set_flashdata('success_message', 'User has been saved successfully');
                redirect('user-list');exit;
                
            }else{
                $this->session->set_flashdata('error_message', 'User has not been saved successfully');
                redirect($this->module_name.'-add');exit;
            }      
            
        }
        else
        {
            $ArrUserData = array();
            $ArrUserData['page_title'] = 'Add User';
            $ArrUserData['user_types']=$this->user_model->get_user_type();
            $ArrUserData['view_name'] = 'view_'.$this->module_name.'_add.php';	
            // $ArrUserData['menus']=$this->menu_model->get_all_menu();
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
                $ArrUserData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
                $ArrUserData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
            $this->load->view('admin_panel',$ArrUserData); 
        }
    }
    public function edit($user_id)
    {
        $ArrUserData = array();
        $ArrUserData['page_title'] = 'Update User';
        $ArrUserData['view_name'] = 'view_'.$this->module_name.'_edit.php';
        $ArrUserData['user_types']=$this->user_model->get_user_type();
        $ArrUserData['get_data'] = $this->user_model->getUserById($user_id);
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
        {
            $ArrUserData['menus']=$this->menu_model->get_all_menu();
        }
        else
        {
            $ArrUserData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
        }
        $this->load->view('admin_panel',$ArrUserData); 
    }
    public function save_update()
    {
        if($this->user_validation())
        {
            $user_id=$_POST['user_id'];
            $data = array(
                'user_role_id'=>$_POST['user_type'],
                'user_name'=>$_POST['user_name'],
                'email'=>$_POST['email'],
                'password'=>$_POST['password'],
                'phone'=>$_POST['phone'],
                'is_active'=>$_POST['is_active']
                
            );
            $user_id=$this->user_model->update($data,$user_id);
               
                if($user_id > 0){
                    $this->session->set_flashdata('success_message', 'User has been updated successfully');
                    redirect('user-list');exit;
                    
                }else{
                    $this->session->set_flashdata('error_message', 'User has not been updated successfully');
                    redirect($this->module_name.'-update/'.$user_id);exit;
                }
        }
        else
        {
            $ArrUserData = array();
            $ArrUserData['page_title'] = 'Update User';
            $ArrUserData['view_name'] = 'view_'.$this->module_name.'_edit.php';
            $ArrUserData['user_types']=$this->user_model->get_user_type();
            $ArrUserData['get_data'] = $this->user_model->getUserById($_POST['user_id']);
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
                $ArrUserData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
                $ArrUserData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
            $this->load->view('admin_panel',$ArrUserData); 
        }
    }
    public function delete($user_id)
    {
        $result = $this->user_model->delete($user_id);
		if($result){
			echo 'Yes';
		}else{
			echo 'No';
		}
    }
    public function user_validation()
    {
        $this->form_validation->set_rules('user_name','User Name','required');
        $this->form_validation->set_rules('email','User Email','required|valid_email');
        $this->form_validation->set_rules('password','User Password','required|min_length[6]');

        if($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    public function search_user()
    {
        if(isset($_POST['txtSearchKeyWord']) && $_POST['txtSearchKeyWord'] != "")
        {
            $keyword = trim($_POST['txtSearchKeyWord']);
            $ArrUserData = array();
            $ArrUserData['page_title'] = 'User List';
            $ArrUserData['button_url'] =  base_url() . $this->module_name.'-add';
            $ArrUserData['button_label'] = 'Add User';
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
                $ArrUserData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
                $ArrUserData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
          //  $ArrMenuData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            /*if($this->session->userdata['logged_in']['user_role_id'] == '3'){
                $ArrAuditData['services']=$this->menu_model->get_services($this->session->userdata['logged_in']['entity_id']);
            }*/
            $ArrUserData['get_data']=$this->user_model->search_user($keyword);
            //echo $this->db->last_query();exit;
            $ArrUserData['view_name'] = 'view_'.$this->module_name.'_list.php';
            
            $this->load->view('admin_panel',$ArrUserData);

        }
        else
        {
            return redirect('user-list');
        }
    }
    public function delete_all()
    {
        if (isset($_POST['ids'])) {
			$ids = explode(',', $_POST['ids']);
			$results = $this->user_model->delete_all($ids);
		}
    }
}