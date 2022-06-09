<?php
class Controller_point_category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->module_name="point_category";
        $this->module_redirect='point_category';
        $this->load->model('menu_model');
        $this->load->model('point_category_model');
        if(isset($this->session->userdata['user_rights']['point-category-list']) == ''){
            redirect('dashboard');
        }
    }
    public function index()
    {
        
        $config = array(
			'base_url' => SITE_URL.'point-category-list',
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
       
        $config['total_rows']=$this->menu_model->paginations(DB_PREFIX.'point_category');
       
		$this->pagination->initialize($config);
		
        $ArrCategoryData['page_title'] = 'Point Category List';
       
        $ArrCategoryData['button_url'] =  base_url() . $this->module_name.'_add';
        
		$ArrCategoryData['button_label'] = 'Add Point Category';
        $ArrCategoryData['view_name'] = 'view_'.$this->module_name.'_list.php';
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        
        $ArrCategoryData['get_data'] = $this->point_category_model->get($config['per_page'],$start_index);
        //$ArrUserData['menus']=$this->menu_model->get_all_menu();
       // echo $this->db->last_query();exit;
       if($this->session->userdata['logged_in']['user_role_id'] == 1)
       {
           $ArrCategoryData['menus']=$this->menu_model->get_all_menu();
       }
       else
       {
           $ArrCategoryData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
       }
       
        $this->load->view('admin_panel',$ArrCategoryData);
    }
    public function add()
    {
        $ArrCategoryData = array();
        $ArrCategoryData['page_title'] = 'Add Point Catgory';
        $ArrCategoryData['view_name'] = 'view_'.$this->module_name.'_add.php';
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
        {
           $ArrCategoryData['menus']=$this->menu_model->get_all_menu();
        }
        else
        {
           $ArrCategoryData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
        }
        $this->load->view('admin_panel',$ArrCategoryData); 
    }
    public function save()
    {
        if($this->point_category_validation())
        {
            $data = array(
                'point_category_name'=>$_POST['point_category_name'],
                'is_active'=>$_POST['is_active'],
                'created_datetime'=>date('Y-m-d H:i:s'),
                'modified_datetime'=>date('Y-m-d H:i:s'),
                'created_by'=>$this->session->userdata["logged_in"]["user_id"],
                'modified_by'=>$this->session->userdata["logged_in"]["user_id"]
            );
            $category_id=$this->point_category_model->insert($data);
            
            
            if($category_id > 0){
                $this->session->set_flashdata('success_message', 'Point Category has been saved successfully');
                redirect('point-category-list');exit;
                
            }else{
                $this->session->set_flashdata('error_message', 'Point Category has not been saved successfully');
                redirect($this->module_name.'-add');exit;
            }      
            
        }
        else
        {
            $ArrCategoryData = array();
            $ArrCategoryData['page_title'] = 'Add Point Catgory';
            $ArrCategoryData['view_name'] = 'view_'.$this->module_name.'_add.php';
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
               $ArrCategoryData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
               $ArrCategoryData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
            $this->load->view('admin_panel',$ArrCategoryData); 
        }
    }
    public function edit($category_id)
    {
        $ArrCategoryData = array();
        $ArrCategoryData['page_title'] = 'Update Point Catgory';
        $ArrCategoryData['view_name'] = 'view_'.$this->module_name.'_edit.php';
        $ArrCategoryData['get_data'] = $this->point_category_model->getCategoryById($category_id);
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
        {
            $ArrCategoryData['menus']=$this->menu_model->get_all_menu();
        }
        else
        {
            $ArrCategoryData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
        }
        $this->load->view('admin_panel',$ArrCategoryData); 
    }
    public function save_update()
    {
        if($this->point_category_validation())
        {
            
            $category_id=$_POST['point_category_id'];
            $data = array(
                'point_category_name'=>$_POST['point_category_name'],
                'is_active'=>$_POST['is_active'],
                'modified_datetime'=>date('Y-m-d H:i:s'),
                'modified_by'=>$this->session->userdata["logged_in"]["user_id"]
            );
            $category_id=$this->point_category_model->update($data,$category_id);
            
                if($category_id > 0){

                    $this->session->set_flashdata('success_message', 'Point Category has been updated successfully');
                    redirect('point-category-list');exit;
                    
                }else{
                    $this->session->set_flashdata('error_message', 'Point Category has not been updated successfully');
                    redirect($this->module_name.'-update/'.$category_id);exit;
                }
        }
        else
        {
            $ArrCategoryData = array();
            $ArrCategoryData['page_title'] = 'Update Point Catgory';
            $ArrCategoryData['view_name'] = 'view_'.$this->module_name.'_edit.php';
            $ArrCategoryData['get_data'] = $this->point_category_model->getCategoryById($_POST['point_category_id']);
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
                $ArrCategoryData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
                $ArrCategoryData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
            $this->load->view('admin_panel',$ArrCategoryData); 
        }
    }
    public function delete($category_id)
    {
        $result = $this->point_category_model->delete($category_id);
		if($result){
			echo 'Yes';
		}else{
			echo 'No';
		}
    }
    public function point_category_validation()
    {
       
        $this->form_validation->set_rules('point_category_name','Point Category Name','required');

        if($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    public function search_point_category()
    {
        if(isset($_POST['txtSearchKeyWord']) && $_POST['txtSearchKeyWord'] != "")
        {
            $keyword = trim($_POST['txtSearchKeyWord']);
            $ArrCategoryData = array();
            $ArrCategoryData['page_title'] = 'Point Category List';
            $ArrCategoryData['button_url'] =  base_url() . $this->module_name.'-add';
            $ArrCategoryData['button_label'] = 'Add Point Category';
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
                $ArrCategoryData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
                $ArrCategoryData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
          //  $ArrMenuData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            /*if($this->session->userdata['logged_in']['user_role_id'] == '3'){
                $ArrAuditData['services']=$this->menu_model->get_services($this->session->userdata['logged_in']['entity_id']);
            }*/
            $ArrCategoryData['get_data']=$this->point_category_model->search_point_category($keyword);
            //echo $this->db->last_query();exit;
            $ArrCategoryData['view_name'] = 'view_'.$this->module_name.'_list.php';
            
            $this->load->view('admin_panel',$ArrCategoryData);

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
}