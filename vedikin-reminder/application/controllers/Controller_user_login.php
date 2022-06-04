<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_user_login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->module_name = 'user';
		$this->load->model('menu_model');	
		$this->load->model('user_login_model');
	}

	#DASHBOARD
	public function index()
	{

	}
	
	
	/* Email DUBLICATE */
	public function ajaxCheckEmail()
	{
		$email_id = $_POST['email'];
		$user_id = $_POST['user_id'];
		$result = $this->user_login_model->CheckDuplicateEmailId($user_id,$email_id);
		if($result>0){
			echo 'Yes';
		}else{
			echo 'No';
		}

	}
	
	#LOGIN
	public function login()
	{
		if( IsUserLogin(1)){
			redirect('dashboard');
		}
		$ArrPageData = array();
		
		$this->load->view('view_login',$ArrPageData);
	}

	public function profile()
	{
		if(!IsUserLogin($this->session->userdata['logged_in']['user_role_id'])){
			$authorized_error = "You are not authorized to view this page....!";
			$this->session->set_flashdata('authorized_error', $authorized_error);
			redirect('login');
		}
		$ArrPageData = array();
		$user_id=get_current_admin_id();
		$ArrUser  = $this->user_login_model->getByUserDetailByID($user_id);
		$ArrPageData['ArrUser']  = $ArrUser[0];
		$ArrPageData['button_label1'] = 'Change Password';
		$ArrPageData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
		$ArrPageData['page_title'] = 'My Profile';
		$ArrPageData['button_url1'] =  base_url() . 'change-password';
		$ArrPageData['view_name'] = 'view_profile.php';
		
		
		$this->load->view('admin_panel',$ArrPageData);
	}
	public function change_password()
	{
		if(!IsUserLogin($this->session->userdata['logged_in']['user_role_id'])){
			$authorized_error = "You are not authorized to view this page....!";
			$this->session->set_flashdata('authorized_error', $authorized_error);
			redirect('login');
		}
		$ArrPageData = array();
		$ArrPageData['button_label1'] = 'Update Profile';
		$ArrPageData['page_title'] = 'My Profile';
		$ArrPageData['button_url1'] =  base_url() . 'profile';
		$ArrPageData['view_name'] = 'view_change_password.php';
		$ArrPageData['menus']=$this->menu_model->get_menu($this->session->userdata['logged_in']['user_role_id']);
		
		$this->load->view('admin_panel',$ArrPageData);
	}

	public function logout()
	{		
		if (!ISSET($this->session->userdata['logged_in']))
        {
            redirect('login');
		}
		else
		{
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_rights');
			redirect('login');
		}
		
	}

	#FORGOT PASSWORD
	public function forgot_password()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email');
		
		if ($this->form_validation->run() == FALSE) {
			$ArrPageData = array();
			
			
			$this->load->view('admin_panel/view_forgot_password',$ArrPageData);
		}else{
			$email= $this->input->post('email');
			$ArrUser = $this->user_login_model->getUserDetailsByEmailId($email);
			if(!empty($ArrUser) && count($ArrUser) == 1 ){
				$user_id = $ArrUser[0]['user_id'];
				$temp_pass = md5(uniqid());
				$ArrUpdateData = array('user_activation_key' => $temp_pass);
				$this->user_login_model->update($user_id,$ArrUpdateData);
				$this->session->set_flashdata('success_message', 'Confirmation link has been send to your email please check your E-mail');
				redirect('forgot-password');exit;
			}else{
				$this->session->set_flashdata('error_message', 'Email Id not found');
				redirect('forgot-password');exit;
			}
		}
		
	}
	
	#LOGIN PROCESS
	public function login_process()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			
			if(IsUserLogin(1)){
				redirect('dashboard','refresh');exit;
			}else{
				$this->load->view('view_login');
			}
		}
		else {
			
			$data = array(
			'user_name' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			//'user_type' => $this->input->post('user_type'),
			);
			$result1 = $this->user_login_model->login($data);
			
			if ($result1 == TRUE) {
			$email = $this->input->post('email');
 			$result = $this->user_login_model->getUserDetailsByEmailId($email);
			$rights=$this->user_login_model->getUserRightsById($result[0]['user_role_id']);
			//echo "<pre>";print_r($result);exit;
				if ($result1 != false) {
					$session_data = array(
					'user_id' => $result[0]['user_id'],
					'subscription_id'=> $result[0]['subscription_id'],
					'email' => $result[0]['user_name'],
					'name' => $result[0]['user_name'],
					'user_role_id' => $result[0]['user_role_id'],
					'Is_login' => true,
					'login_time' => date('Y-m-d H:i:s'),
					);
					
					// Add user data in session
					$ArrUpdateData = array('modified_datetime' => date('Y-m-d H:i:s'));
					$this->user_login_model->update($result[0]['user_id'],$ArrUpdateData);
					$this->session->set_userdata('logged_in', $session_data);
					$user_rights=array();
					if(isset($rights) && $rights !="" && $rights != null)
					{
						foreach($rights as $menus)
						{
							if(in_array($menus['listing_page'],$menus))
							{
								$user_rights[$menus['listing_page']][]=$menus['user_rights'];
							}
							else
							{
								$user_rights[$menus['listing_page']]=array($menus['user_rights']);
							}
						}
					}
					
					$this->session->set_userdata('user_rights', $user_rights);
					
					
					// if($result[0]['user_role_id'] == 1 || $result[0]['user_role_id'] == 2)
					// {
						redirect('dashboard','refresh');exit;
					// }
					// else
					// {
					// 	redirect($rights[0]['listing_page']);
					// }
				}
			} 
			else {
				$data = array(
				'error_message' => 'Invalid email or Password'
				);
				$this->load->view('view_login', $data);
			}
		}
	}

	public function update_user()
	{
		if( !isset($_POST['update_pass']) && !isset($_POST['update']) ){
			redirect('profile');exit;
		}
		if(isset($_POST['update']) && $_POST['update']!="" && $_POST['update']=="update")
		{
			$user_id=get_current_admin_id();
			$name = (trim($_POST['name']))?$_POST['name']:'';
			$user_email = (trim($_POST['user_email']))?$_POST['user_email']:'';
			$user_phone = (trim($_POST['user_phone']))?$_POST['user_phone']:'';
			$user_password = (trim($_POST['user_password']))?$_POST['user_password']:'';
			$admin_email_id = trim($_POST['user_email']);

			$ArrUser = $this->user_login_model->CheckDuplicateEmailId($user_id,$admin_email_id);
			if( $ArrUser ){
				$this->session->set_flashdata('error_message', 'Email id already exists');
				redirect('profile');exit;
			}
			
			$Arrdata = array(
				'user_name' => $name,
				'email' => $user_email,
				'phone' => $user_phone,
				'password'=>$user_password,
				'modified_datetime' => date('Y-m-d H:i:s'),
				'modified_by' => $user_id
			);
			$result = $this->user_login_model->update($user_id,$Arrdata);
			if($result){
				$this->session->set_flashdata('success_message', 'Profile details has been updated successfully');
				//echo $this->session->flashdata('success_message');exit;
				redirect('profile');exit;
			}else{
				$this->session->set_flashdata('error_message', 'Oops...! Something went wrong to update page details, please try again');
				redirect('profile');exit;
			}
		}
		/* UPDATE PASSWORD */
		if(isset($_POST['update_pass']) && $_POST['update_pass']!="" && $_POST['update_pass']=="update_password")
		{
			$this->form_validation->set_rules('oldpassword', 'Old Password', 'required|trim|xss_clean');
			$this->form_validation->set_rules('newPassword', 'New Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
		
			if ($this->form_validation->run() == FALSE) {
				$ArrPageData = array();
				$ArrPageData['button_label1'] = 'Update Profile';
				$ArrPageData['page_title'] = 'My Profile';
				$ArrPageData['button_url1'] =  base_url() . 'profile';
				$ArrPageData['view_name'] = 'view_change_password.php';
				$this->load->view('admin_panel',$ArrPageData);
			}else{
				$user_id=get_current_admin_id();
				$oldpassword = trim($_POST['oldpassword']);
				$newPassword = trim($_POST['newPassword']);
				$confirm_password = trim($_POST['confirm_password']);
						
				$ArrUserDetails = $this->user_login_model->getByUserDetailByID($user_id);
				
				$ArrUser  = $ArrUserDetails[0];
				
				if(trim($ArrUser['password'])!= $oldpassword){
					$this->session->set_flashdata('error_message', 'Please enter correct existing password.');
					redirect('change-password');exit;
				}
				if($newPassword != $confirm_password){
					$this->session->set_flashdata('error_message', 'Entered password and confirm password not match!');
					redirect('change-password');exit;
				}
				$current_data = date('Y-m-d H:i:s');
				$Arrdata = array(
					'password' => $newPassword,
					'modified_datetime' => $current_data,
					//'modified_by' => $user_id
				);

				$session_data = array(
					'user_id' => $this->session->userdata['logged_in']['user_id'],
					'email' => $this->session->userdata['logged_in']['email'],
					'name' => $this->session->userdata['logged_in']['name'],
					'user_role_id' => $this->session->userdata['logged_in']['user_role_id'],
					'Is_login' => true,
					'login_time' => $current_data,
					);
				// Add user data in session
				$this->session->set_userdata('logged_in', $session_data);

				$result = $this->user_login_model->update($user_id,$Arrdata);// FORCE TO LOGOUT FROM ALL BROWSER
				if($result){
					$this->session->set_flashdata('success_message', 'Password updated successfully');
					redirect('change-password');exit;
				}else{
					$this->session->set_flashdata('error_message', 'Oops...! Something went wrong to update page details, please try again');
					redirect('change-password');exit;
				}
			}
		}
		
	}

	/* UPLOAD PHOTOSS */
	public function uploadPhotos($user_id)
	{
		$ArrPhoto = $_FILES['user_photos'];
		
		for($i=0;$i<count($_FILES['user_photos']['name']);$i++)
		{
			$_FILES['temp_photo']['name'] = $ArrPhoto['name'][$i];
			$_FILES['temp_photo']['type'] = $ArrPhoto['type'][$i];
			$_FILES['temp_photo']['tmp_name'] = $ArrPhoto['tmp_name'][$i];
			$_FILES['temp_photo']['error'] = $ArrPhoto['error'][$i];
			$_FILES['temp_photo']['size'] = $ArrPhoto['size'][$i];
			//echo "<pre>";print_r($_FILES);
			$ArrPhotoDetails = $this->common_model->uploadPhotos('temp_photo');
			
			if(is_array($ArrPhotoDetails['upload_data']) && count($ArrPhotoDetails['upload_data'])>0)
			{
				$file_path = $ArrPhotoDetails['upload_data']['file_name'];
				$file_type = $ArrPhotoDetails['upload_data']['file_type'];
				$ArrData = array('photo_video_for'=>'user','photo_video_for_id'=>$user_id,'file_type'=>$file_type,'file_path'=>$file_path);
				$this->photo_video_master_model->add($ArrData);
			}
		}
		//exit;
	}
	
}
