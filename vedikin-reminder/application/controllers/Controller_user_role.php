<?php
class Controller_user_role extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->module_name="user_role";
        $this->module_redirect='user-role';
        $this->load->model('user_role_model');
        $this->load->model('menu_model');
        if($this->session->userdata['user_rights']['user-role-list'] == ''){
            redirect('dashboard');
        }
    }
    public function index()
    {
        $config = array(
			'base_url' => SITE_URL.'user-role-list',
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
       
        $config['total_rows']=$this->user_role_model->paginations(DB_PREFIX.'user_role');
       
		$this->pagination->initialize($config);
		
        $ArrUserTypeData['page_title'] = 'User Role List';
       
        $ArrUserTypeData['button_url'] =  base_url() . $this->module_name.'-add';
       
		$ArrUserTypeData['button_label'] = 'Add User Role';
        $ArrUserTypeData['view_name'] = 'view_'.$this->module_name.'_list.php';
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    
        $ArrUserTypeData['get_data'] = $this->user_role_model->get($config['per_page'],$start_index);
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
		{
            $ArrUserTypeData['menus']=$this->menu_model->get_all_menu();
        }
        else
        {
            $ArrUserTypeData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
        }
       
        $this->load->view('admin_panel',$ArrUserTypeData);
    }
    public function add()
    {
        $ArrUserTypeData = array();
        $ArrUserTypeData['page_title'] = 'Add User Role';
        $ArrUserTypeData['view_name'] = 'view_'.$this->module_name.'_add.php';	
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
		{
            $ArrUserTypeData['menus']=$this->menu_model->get_all_menu();
        }
        else
        {
            $ArrUserTypeData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
        }
        $this->load->view('admin_panel',$ArrUserTypeData); 
    }
    public function save()
    {
       
        if($this->user_role_validation())
                {
                    $data = array(
                        'user_role_name'=>$_POST['user_role'],
                        'is_active'=>$_POST['is_active']
                        
                    );
                    $user_role_id=$this->user_role_model->insert($data);
                       
                        if($user_role_id > 0){
                            $this->session->set_flashdata('success_message', 'User Role has been saved successfully');
                            redirect('user-role-list');exit;
                            
                        }else{
                            $this->session->set_flashdata('error_message', 'User Role has not been saved successfully');
                            redirect($this->module_name.'-add');exit;
                        }      
                }
                else
                {
                    $ArrUserTypeData = array();
                    $ArrUserTypeData['page_title'] = 'Add User Role';
                    $ArrUserTypeData['view_name'] = 'view_'.$this->module_name.'_add.php';	
                    if($this->session->userdata['logged_in']['user_role_id'] == 1)
                    {
                        $ArrUserTypeData['menus']=$this->menu_model->get_all_menu();
                    }
                    else
                    {
                        $ArrUserTypeData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
                    }
                    $this->load->view('admin_panel',$ArrUserTypeData);
                }
    }
    public function edit($user_role_id)
    {
        $ArrUserTypeData = array();
        $ArrUserTypeData['page_title'] = 'Update User Role';
        $ArrUserTypeData['view_name'] = 'view_'.$this->module_name.'_edit.php';
        $ArrUserTypeData['get_data'] = $this->user_role_model->getUserTypeById($user_role_id);
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
		{
            $ArrUserTypeData['menus']=$this->menu_model->get_all_menu();
        }
        else
        {
            $ArrUserTypeData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
        }
        $this->load->view('admin_panel',$ArrUserTypeData); 
    }
    public function save_update()
    {
       
        if($this->user_role_validation())
                {
                    $data = array(
                        'user_role_name'=>$_POST['user_role'],
                        'is_active'=>$_POST['is_active']
                        
                    );
                    $user_role_id=$_POST['user_role_id'];
                    $result=$this->user_role_model->update($data, $user_role_id);
                       
                        if($result > 0){
                            $this->session->set_flashdata('success_message', 'User Role has been updated successfully');
                            redirect('user-role-list');exit;
                            
                        }else{
                            $this->session->set_flashdata('error_message', 'User Role has not been updated successfully');
                            redirect('user-type-update/'.$user_role_id);exit;
                        }      
                    
                
                }
                else
                {
                    $ArrUserTypeData = array();
                    $ArrUserTypeData['page_title'] = 'Update User Role';
                    $ArrUserTypeData['view_name'] = 'view_'.$this->module_name.'_add.php';	
                    if($this->session->userdata['logged_in']['user_role_id'] == 1)
                    {
                        $ArrUserTypeData['menus']=$this->menu_model->get_all_menu();
                    }
                    else
                    {
                        $ArrUserTypeData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
                    }
                    $this->load->view('admin_panel',$ArrUserTypeData);
                }
    }
    public function delete($user_role_id)
    {
        $result = $this->user_role_model->delete($user_role_id);
       // echo $this->db->last_query();exit;
		if($result){
			echo 'Yes';
		}else{
			echo 'No';
		}
    }
    public function user_role_validation()
    {
        $this->form_validation->set_rules('user_role','User Role','required');
       
        if($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    public function search_user_role()
    {
        if(isset($_POST['txtSearchKeyWord']) && $_POST['txtSearchKeyWord'] != "")
        {
            $keyword=$_POST['txtSearchKeyWord'];
            $ArrUserTypeData = array();
            $ArrUserTypeData['page_title'] = 'User Role List';
            $ArrUserTypeData['button_url'] =  base_url() . $this->module_name.'-add';
            $ArrUserTypeData['button_label'] = 'Add User Role';
            $ArrUserTypeData['view_name'] = 'view_'.$this->module_name.'_list.php';
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
		    {
                $ArrUserTypeData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
                $ArrUserTypeData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
         
            $ArrUserTypeData['get_data']=$this->user_role_model->search_user_role($keyword);
            $this->load->view('admin_panel',$ArrUserTypeData);

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
			$results = $this->user_role_model->delete_all($ids);
		}
    }
}