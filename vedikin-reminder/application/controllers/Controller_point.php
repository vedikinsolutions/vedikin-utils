<?php
class Controller_point extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->module_name="points";
        $this->module_redirect='points';
        $this->load->model('menu_model');
        $this->load->model('point_model');
        if(isset($this->session->userdata['user_rights']['points-list']) == ''){
            redirect('dashboard');
        }
    }
    public function index()
    {
        
        $config = array(
			'base_url' => SITE_URL.'point-list',
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
       
        $config['total_rows']=$this->menu_model->paginations(DB_PREFIX.'points');
       
		$this->pagination->initialize($config);
		
        $ArrPointData['page_title'] = 'Point List';
       
        $ArrPointData['button_url'] =  base_url() . $this->module_name.'-add';
        
		$ArrPointData['button_label'] = 'Add Point';
        $ArrPointData['view_name'] = 'view_'.$this->module_name.'_list.php';
        $start_index = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        
        $ArrPointData['get_data'] = $this->point_model->get($config['per_page'],$start_index);
        //$ArrUserData['menus']=$this->menu_model->get_all_menu();
       // echo $this->db->last_query();exit;
       if($this->session->userdata['logged_in']['user_role_id'] == 1)
       {
           $ArrPointData['menus']=$this->menu_model->get_all_menu();
       }
       else
       {
           $ArrPointData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
       }
       
        $this->load->view('admin_panel',$ArrPointData);
    }
    public function add()
    {
        $ArrPointData = array();
        $ArrPointData['page_title'] = 'Add Point';
        $ArrPointData['view_name'] = 'view_'.$this->module_name.'_add.php';
        $ArrPointData['get_categories'] = $this->point_model->get_point_category();
       
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
        {
           $ArrPointData['menus']=$this->menu_model->get_all_menu();
        }
        else
        {
           $ArrPointData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
        }
        $this->load->view('admin_panel',$ArrPointData); 
    }
    public function save()
    {
        if($this->points_validation())
        {
            if($_POST['date'] !="")
            {
                $date=date('Y-m-d',strtotime($_POST['date']));
            }
            else
            {
                $date=date('Y-m-d');
            }
            $data = array(
                'point_category_id'=>$_POST['point_category'],
                'user'=>$_POST['user_name'],
                'points'=>$_POST['points'],
                'date'=>$date,
                'remarks'=>$_POST['remarks'],
                'is_active'=>$_POST['is_active'],
                'created_datetime'=>date('Y-m-d H:i:s'),
                'modified_datetime'=>date('Y-m-d H:i:s'),
                'created_by'=>$this->session->userdata["logged_in"]["user_id"],
                'modified_by'=>$this->session->userdata["logged_in"]["user_id"]
            );
            $point_id=$this->point_model->insert($data);
            
            
            if($point_id > 0){
                $this->session->set_flashdata('success_message', 'Points has been saved successfully');
                redirect('points-list');exit;
                
            }else{
                $this->session->set_flashdata('error_message', 'Points has not been saved successfully');
                redirect($this->module_name.'-add');exit;
            }      
            
        }
        else
        {
            $ArrPointData = array();
            $ArrPointData['page_title'] = 'Add Point';
            $ArrPointData['view_name'] = 'view_'.$this->module_name.'_add.php';
            $ArrPointData['get_categories'] = $this->point_model->get_point_category();
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
               $ArrPointData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
               $ArrPointData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
            $this->load->view('admin_panel',$ArrPointData); 
        }
    }
    public function edit($point_id)
    {
        $ArrPointData = array();
        $ArrPointData['page_title'] = 'Update Points';
        $ArrPointData['view_name'] = 'view_'.$this->module_name.'_edit.php';
        $ArrPointData['get_categories'] = $this->point_model->get_point_category();
        $ArrPointData['get_data'] = $this->point_model->getPointsById($point_id);
        if($this->session->userdata['logged_in']['user_role_id'] == 1)
        {
            $ArrPointData['menus']=$this->menu_model->get_all_menu();
        }
        else
        {
            $ArrPointData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
        }
        $this->load->view('admin_panel',$ArrPointData); 
    }
    public function save_update()
    {
        if($this->points_validation())
        {
            if($_POST['date'] !="")
            {
                $date=date('Y-m-d',strtotime($_POST['date']));
            }
            else
            {
                $date=date('Y-m-d');
            }
            $point_id=$_POST['point_id'];
            $data = array(
                'point_category_id'=>$_POST['point_category'],
                'user'=>$_POST['user_name'],
                'points'=>$_POST['points'],
                'date'=>$date,
                'remarks'=>$_POST['remarks'],
                'is_active'=>$_POST['is_active'],
                'created_datetime'=>date('Y-m-d H:i:s'),
                'modified_datetime'=>date('Y-m-d H:i:s'),
                'created_by'=>$this->session->userdata["logged_in"]["user_id"],
                'modified_by'=>$this->session->userdata["logged_in"]["user_id"]
            );
            $point_id=$this->point_model->update($data,$point_id);
            
                if($point_id > 0){

                    $this->session->set_flashdata('success_message', 'Point has been updated successfully');
                    redirect('points-list');exit;
                    
                }else{
                    $this->session->set_flashdata('error_message', 'Point has not been updated successfully');
                    redirect($this->module_name.'-update/'.$point_id);exit;
                }
        }
        else
        {
            $ArrPointData = array();
            $ArrPointData['page_title'] = 'Update Point';
            $ArrPointData['view_name'] = 'view_'.$this->module_name.'_edit.php';
            $ArrPointData['get_data'] = $this->point_model->getPointById($_POST['point_id']);
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
                $ArrPointData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
                $ArrPointData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
            $this->load->view('admin_panel',$ArrPointData); 
        }
    }
    public function delete($point_id)
    {
        $result = $this->point_model->delete($point_id);
		if($result){
			echo 'Yes';
		}else{
			echo 'No';
		}
    }
    public function points_validation()
    {
       
        $this->form_validation->set_rules('user_name','User Name','required');
        $this->form_validation->set_rules('points','Points','required');

        if($this->form_validation->run() == FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    public function search_points()
    {
        if(isset($_POST['txtSearchKeyWord']) && $_POST['txtSearchKeyWord'] != "")
        {
            $keyword = trim($_POST['txtSearchKeyWord']);
            $ArrPointData = array();
            $ArrPointData['page_title'] = 'Point List';
            $ArrPointData['button_url'] =  base_url() . $this->module_name.'-add';
            $ArrPointData['get_categories'] = $this->point_model->get_point_category();
            $ArrPointData['button_label'] = 'Add Point';
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
                $ArrPointData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
                $ArrPointData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
          //  $ArrMenuData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            /*if($this->session->userdata['logged_in']['user_role_id'] == '3'){
                $ArrAuditData['services']=$this->menu_model->get_services($this->session->userdata['logged_in']['entity_id']);
            }*/
            $ArrPointData['get_data']=$this->point_model->search_point($keyword);
            //echo $this->db->last_query();exit;
            $ArrPointData['view_name'] = 'view_'.$this->module_name.'_list.php';
            
            $this->load->view('admin_panel',$ArrPointData);

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
    public function point_report()
    {
        $ArrPointData['page_title'] = 'Point Report';
       
        $ArrPointData['button_url'] =  base_url() . $this->module_name.'-add';
        
		//$ArrPointData['button_label'] = 'Add Point';
        $ArrPointData['view_name'] = 'view_'.$this->module_name.'_report.php';
        
        $ArrPointData['get_data'] = $this->point_model->get_report_data();
        //$ArrUserData['menus']=$this->menu_model->get_all_menu();
      //  echo $this->db->last_query();exit;
       if($this->session->userdata['logged_in']['user_role_id'] == 1)
       {
           $ArrPointData['menus']=$this->menu_model->get_all_menu();
       }
       else
       {
           $ArrPointData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
       }
       
        $this->load->view('admin_panel',$ArrPointData);
    }
    public function points_filter()
    {
            if($_POST['txtSearchKeyWord'] != "" || $_POST['txtSearchFromDate'] !="" || $_POST['txtSearchToDate'] !="")
            {
                $ArrPointData['page_title'] = 'Point Report';
            
                $ArrPointData['button_url'] =  base_url() . $this->module_name.'-add';
                
                //$ArrPointData['button_label'] = 'Add Point';
                $ArrPointData['view_name'] = 'view_'.$this->module_name.'_report.php';
                
                $ArrPointData['get_data'] = $this->point_model->get_report_filter_data();
            
            if($this->session->userdata['logged_in']['user_role_id'] == 1)
            {
                $ArrPointData['menus']=$this->menu_model->get_all_menu();
            }
            else
            {
                $ArrPointData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
            }
            
                $this->load->view('admin_panel',$ArrPointData);
        }
        else
        {
            return  $this->point_report();
        }
    }
}