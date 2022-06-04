<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->module_name="menu";
        $this->module_redirect='menu';
        $this->load->model('menu_model');
        if($this->session->userdata['user_rights']['menu-list'] == ''){
            redirect('dashboard');
        }
    }
    public function index()
    {
        $config = array(
			'base_url' => SITE_URL.'menu-list',
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
       
        $config['total_rows']=$this->menu_model->paginations(DB_PREFIX.'menu');
       
		$this->pagination->initialize($config);
		
        $ArrMenuData['page_title'] = 'Menu List';
       
        $ArrMenuData['button_url'] = base_url() .  $this->module_name.'-add';
       
		$ArrMenuData['button_label'] = 'Add Menu';
        $ArrMenuData['view_name'] = 'view_'.$this->module_name.'_list.php';
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
    
        $ArrMenuData['get_data'] = $this->menu_model->get($config['per_page'],$start_index);
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
		{
			$ArrMenuData['menus']=$this->menu_model->get_all_menu();
		}
		else
		{
			$ArrMenuData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
		}
        // $ArrMenuData['menus']=$this->menu_model->get_all_menu();
        $this->load->view('admin_panel',$ArrMenuData);
    }
    public function add()
    {
        $ArrMenuData = array();
        $ArrMenuData['page_title'] = 'Add Menu';
        $ArrMenuData['view_name'] = 'view_'.$this->module_name.'_add.php';	
        $ArrMenuData['menus']=$this->menu_model->get_all_menu();
        $this->load->view('admin_panel',$ArrMenuData); 
    }
    public function save()
    {
        if($this->menu_validation())
        {
            $data = array(
                'menu_name'=>$_POST['menu_name'],
                'listing_page'=>$_POST['listing_page'],
                'menu_order'=>$_POST['menu_order'],
                'site_icon'=>$_POST['site_icon'],
                'is_active'=>$_POST['is_active']
            );
            $menu_id=$this->menu_model->insert($data);
            $result = true;
            if($_FILES['menu_icon']['name'] !="")
            {   
                $dir_exist = true; // flag for checking the directory exist or not
                if (!is_dir('themes/admin_panel/images/menu_icons')) {
                    mkdir('./themes/admin_panel/images/menu_icons', 0777, true);
                    $dir_exist = false; // dir not exist
                }
                if (!is_dir('themes/admin_panel/images/menu_icons')) {
                    mkdir('./themes/admin_panel/images/menu_icons' , 0777, true);
                    $dir_exist = false; // dir not exist
                }
                $config = array();
                $config['allowed_types']        = 'jpeg|jpg|png';
                $config['max_size']             = 10000;
                $config['upload_path']          = './themes/admin_panel/images/menu_icons';
                $config['file_name']            = 'menu_'.$menu_id;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('menu_icon'))
                {
                    $result = false;
                }
                else
                {
                    if(isset($_FILES['menu_icon']['name']) && $_FILES['menu_icon']['name'] !='')
                    {
                        $ext = $this->upload->get_extension($_FILES['menu_icon']['name']);
                        $file_upload_data = array(
                            'menu_icon' => 'themes/admin_panel/images/menu_icons/menu_'.$menu_id.$ext
                        );
                        $this->menu_model->update($file_upload_data,$menu_id);
                    }   
                }
            }
            if($menu_id > 0 && $result){
                $this->session->set_flashdata('success_message', 'Menu has been saved successfully');
                redirect($this->module_name.'-list');exit;
                
            }else{
                $this->session->set_flashdata('error_message', 'Menu has been added. There are some issue in the file you have uploaded. Please re-upload the file');
                redirect($this->module_name.'-add');exit;
            } 
        }
        else
        {
            $ArrMenuData = array();
            $ArrMenuData['page_title'] = 'Add Menu';
            $ArrMenuData['view_name'] = 'view_'.$this->module_name.'_add.php';	
            $ArrMenuData['menus']=$this->menu_model->get_all_menu();
            $this->load->view('admin_panel',$ArrMenuData);
        }
    }
    public function edit($menu_id)
    {
        $ArrMenuData = array();
        $ArrMenuData['page_title'] = 'Update Menu';
        $ArrMenuData['view_name'] = 'view_'.$this->module_name.'_edit.php';
        $ArrMenuData['get_data'] = $this->menu_model->getMenuById($menu_id);
        $ArrMenuData['menus']=$this->menu_model->get_all_menu();
        $this->load->view('admin_panel',$ArrMenuData); 
    }
    public function save_update()
    {
        if($this->menu_validation())
        {
            $data = array(
                'menu_name'=>$_POST['menu_name'],
                'listing_page'=>$_POST['listing_page'],
                'menu_order'=>$_POST['menu_order'],
                'site_icon'=>$_POST['site_icon'],
                'is_active'=>$_POST['is_active']
            );
            $menu_id=$_POST['menu_id'];
            $menu_updated=$this->menu_model->update($data,$menu_id);
            $result=true;
            if($_FILES['menu_icon']['name'] !="")
            {       
                $dir_exist = true; // flag for checking the directory exist or not
                if (!is_dir('themes/admin_panel/images/menu_icons')) {
                    mkdir('./themes/admin_panel/images/menu_icons', 0777, true);
                    $dir_exist = false; // dir not exist
                }
                if (!is_dir('themes/admin_panel/images/menu_icons')) {
                    mkdir('./themes/admin_panel/images/menu_icons' , 0777, true);
                    $dir_exist = false; // dir not exist
                }
                $file = $this->menu_model->getFiles($menu_id);
                if ($file[0] != null && $file[0]->menu_icon != "") {
                    if (file_exists($file[0]->menu_icon)) {
                        // chown($file->menu_icon, 0755);
                        unlink($file[0]->menu_icon);
                    }       
                }
                $config = array();
                $config['allowed_types']        = 'jpeg|jpg|png';
                $config['max_size']             = 10000;
                $config['upload_path']          = './themes/admin_panel/images/menu_icons';
                $config['file_name']            = 'menu_'.$menu_id;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('menu_icon'))
                {
                    $ArrMenuData = array();
                    $ArrMenuData['page_title'] = 'Add Menu';
                    $ArrMenuData['view_name'] = 'view_'.$this->module_name.'_edit.php';	
                    $ArrMenuData['menus']=$this->menu_model->get_all_menu();
                    $ArrMenuData['error'] = $this->upload->display_errors();
                    $this->load->view('admin_panel',$ArrMenuData);
                    $result=false; 
                }
                else
                {
                    if(isset($_FILES['menu_icon']['name']) && $_FILES['menu_icon']['name'] !='')
                    {
                        $ext = $this->upload->get_extension($_FILES['menu_icon']['name']);
                        $file_upload_data = array(
                            'menu_icon' => 'themes/admin_panel/images/menu_icons/menu_'.$menu_id.$ext
                        );
                        $this->menu_model->update($file_upload_data,$menu_id);
                    }
                }
            }
                
            if($menu_updated > 0 && $result){
                $this->session->set_flashdata('success_message', 'Menu has been saved successfully');
                redirect($this->module_name.'-list');exit;
                
            }else{
                $this->session->set_flashdata('error_message', 'Menu has not been saved successfully');
                redirect($this->module_name.'-update/'.$menu_id);exit;
            }      
        }
        else
        {
            $ArrMenuData = array();
            $ArrMenuData['page_title'] = 'Add Menu';
            $ArrMenuData['view_name'] = 'view_'.$this->module_name.'_add.php';	
            $ArrMenuData['menus']=$this->menu_model->get_all_menu();
            $this->load->view('admin_panel',$ArrMenuData);
        }
    }
    public function delete($menu_id)
    {
        $file = $this->menu_model->getFiles($menu_id);
        if ($file[0] != null && $file[0]->menu_icon != "") {
            if (file_exists($file[0]->menu_icon)) {
                // chown($file->menu_icon, 0755);
                unlink($file[0]->menu_icon);
            }       
        }
        $result = $this->menu_model->delete($menu_id);
		if($result){
			echo 'Yes';
		}else{
			echo 'No';
		}
    }
    public function menu_validation()
    {
        $this->form_validation->set_rules('menu_name','Menu Name','required');
        $this->form_validation->set_rules('listing_page','Menu Listing Page','required');
        $this->form_validation->set_rules('menu_order','Menu Order','required|numeric');
        if($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    public function search_menu()
    {
        if(isset($_POST['txtSearchKeyWord']) && $_POST['txtSearchKeyWord'] != "")
        {
            $keyword=$_POST['txtSearchKeyWord'];
            $ArrMenuData = array();
            $ArrMenuData['page_title'] = 'Menu List';
            $ArrMenuData['button_url'] =  base_url() . $this->module_name.'-add';
            $ArrMenuData['button_label'] = 'Add Menu';
            $ArrMenuData['menus']=$this->menu_model->get_all_menu();
            $ArrMenuData['get_data']=$this->menu_model->search_menu($keyword);
            $ArrMenuData['view_name'] = 'view_'.$this->module_name.'_list.php';
            
            $this->load->view('admin_panel',$ArrMenuData);
        }
        else
        {
            return redirect('menu-list');
        }
    }
    public function delete_all()
    {
        if (isset($_POST['ids'])) {
			$ids = explode(',', $_POST['ids']);
			$results = $this->menu_model->delete_all($ids);
		}
    }
}