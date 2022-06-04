<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class controller_dashboard extends CI_Controller {
	public function __construct() {
	parent::__construct();
	/*	if (!ISSET($this->session->userdata['logged_in']))
        {
            redirect('login');
        }*/
		if (!ISSET($this->session->userdata['logged_in']) && strpos( $_SERVER['REQUEST_URI'], 'login') === FALSE)
		{
			redirect('login');
		}
		$this->load->model('user_login_model');
		$this->load->model('menu_model');
		$this->load->model('common_model');

		$this->module_name = 'dashboard';
		/*if(!IsUserLogin($this->session->userdata['logged_in']['user_role_id']) ){
			$authorized_error = "You are not authorized to view this page....!";
			$this->session->set_flashdata('authorized_error', $authorized_error);
			redirect('login');
		}*/
	}

	#DASHBOARD
	public function index()
	{
		$ArrPageData = array();
		
		$temp = array();
		
		$ArrPageData['view_name'] = 'view_dashboard.php';
	
		$ArrPageData['page_title'] = 'Dashboard';
		if($this->session->userdata['logged_in']['user_role_id'] == 1)
		{
			$ArrPageData['menus']=$this->menu_model->get_all_menu();
		}
		else
		{
			$ArrPageData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
		}
		//print_r($this->session->userdata);exit;
		$this->load->view('admin_panel',$ArrPageData);
	}

	

}
