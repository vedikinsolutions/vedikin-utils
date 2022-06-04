<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_common extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('user_login_model');
		$this->load->model('common_model');
	
	}

	public function ajaxStatusUpdate()
	{
		$primary_id = $_POST['page_id'];
		$tablename = $_POST['tablename'];
		$column_name = $_POST['column_name'];
		
		$result = $this->common_model->updateIsActive($primary_id,$column_name,$tablename);
		if($result['responce']){
			echo json_encode(array('message' => 'success','is_active' => $result['status'] ));
		}else{
			echo json_encode(array('message' => 'fail'));
		}
	}
	public function updateIsactiveForHomeList()
	{
		$primary_id = $_POST['page_id'];
		$tablename = $_POST['tablename'];
		$column_name = $_POST['column_name'];
		
		$result = $this->common_model->updateIsactiveForHomeList($primary_id,$column_name,$tablename);
		if($result['responce']){
			echo json_encode(array('message' => 'success','display_on_home_listing' => $result['status'] ));
		}else{
			echo json_encode(array('message' => 'fail'));
		}
	}
	public function updateIsactiveForSideBaerList()
	{
		$primary_id = $_POST['page_id'];
		$tablename = $_POST['tablename'];
		$column_name = $_POST['column_name'];
		
		$result = $this->common_model->updateIsactiveForSideBaerList($primary_id,$column_name,$tablename);
		if($result['responce']){
			echo json_encode(array('message' => 'success','display_on_sidebar_listing' => $result['status'] ));
		}else{
			echo json_encode(array('message' => 'fail'));
		}
	}
	public function updateIsFeatured()
	{
		$primary_id = $_POST['page_id'];
		$tablename = $_POST['tablename'];
		$column_name = $_POST['column_name'];
		
		$result = $this->common_model->updateIsFeatured($primary_id,$column_name,$tablename);
		if($result['responce']){
			echo json_encode(array('message' => 'success','is_featured' => $result['status'] ));
		}else{
			echo json_encode(array('message' => 'fail'));
		}
	}
		
	public function getUserMasterDetailsAsString()
	{
		$user_id = $_POST['user_id'];
		$ArrOwnerDetails = $this->user_login_model->getByUserDetailByID($user_id);
		$ArrMasterDetails = $ArrOwnerDetails['ArrMasterDetails'];
		echo json_encode(
			array('name' => $ArrMasterDetails['name'],
				'email' => $ArrMasterDetails['email'],
				'phone' => $ArrMasterDetails['phone'],
				'mobile' => $ArrMasterDetails['mobile'],
				'city' => $ArrMasterDetails['city'],
				'state' => $ArrMasterDetails['state'],
				'address' => $ArrMasterDetails['address']
				)
			);
	}
	
	public function GetCityDropDown($city=0)
	{
		$state = $_POST['state'];
		
		$ArrCity = $this->city_master_model->getCityDDArray($state);
		echo form_dropdown('city', $ArrCity, $city, 'class="form-control select2" id="city"');
	}	
	public function GetCityDropDownForFrontFilter($city=0)
	{
		$state = $_POST['state'];
		
		$ArrCity = $this->city_master_model->getCityDDArray($state);
		echo form_dropdown('ddCity', $ArrCity, $city, 'class="" id="ddCity"');
	}
	
	/* SAVE REVIEW FROM ALL MODULES */
	public function submit_review()
	{		
		$this->load->model('review_master_model');
		$pageURL = $_POST['pageURL'];
		$url = $pageURL."#review";
		if(isset($_POST['btnReviewSubmit']) && $_POST['btnReviewSubmit']=="Send a Review")
		{
			$ArrData['review_by_user_id'] = 3;
			$ArrData['review_for_id'] = $_POST['review_for_id'];
			$ArrData['review_for'] = $_POST['review_for'];
			$ArrData['rating'] = $_POST['review-rating'];
			$ArrData['review'] = $_POST['form-rating-message'];
			$ArrData['created_by'] = SYSTEM_USER_ID;
			$ArrData['created_date'] = date('Y-m-d H:i:s');
			$id = $this->review_master_model->add($ArrData);
			if($id>0)
			{
				$this->session->set_flashdata('review_success_message', 'Your review has been submited succcssfully.');
			}
			else
			{
				$this->session->set_flashdata('review_error_message', 'Oops...! Something went wrong to submit your review, please try again.');
			}
		}
		else
		{
			$this->session->set_flashdata('review_error_message', 'Oops...! Something went wrong to submit your review, please try again.');
		}
		redirect($url);
	}	
	
	/* SAVE INQUIRY MESSAGE FROM ALL MODULES */
	public function submit_message()
	{		
		$this->load->model('inquiry_by_user_model');
		$pageURL = $_POST['pageURL'];
		$url = $pageURL."#message";
		if(isset($_POST['btnSubmit']) && $_POST['btnSubmit']=="Send a Message")
		{
			$ArrData['inquiry_by_user_id'] = 0;
			$ArrData['inquiry_for_id'] = $_POST['inquiry_for_id'];
			$ArrData['inquiry_for'] = $_POST['inquiry_for'];
			$ArrData['name'] = $_POST['form-contact-name'];
			$ArrData['email'] = $_POST['form-contact-email'];
			$ArrData['phone'] = $_POST['form-contact-phone'];
			$ArrData['message'] = $_POST['form-contact-message'];
			$ArrData['created_by'] = SYSTEM_USER_ID;
			$ArrData['created_date'] = date('Y-m-d H:i:s');
			$id = $this->inquiry_by_user_model->add($ArrData);
			
			if($id>0)
			{
				if(isset($_POST['send_sms_to']) && $_POST['send_sms_to']!='')
				{
					$message = $ArrData['name']." is interesting in product/service. Please contact ".$ArrData['name']." to this number ".$ArrData['phone'].". For more detail visit your profile. http://www.buildingsquad.in";
					send_sms($_POST['send_sms_to'],$message,3);
				}
				$this->session->set_flashdata('msg_success_message', 'Your message has been submited succcssfully.');
			}
			else
			{
				$this->session->set_flashdata('msg_error_message', 'Oops...! Something went wrong to submit your message, please try again.');
			}
		}
		else
		{
			$this->session->set_flashdata('msg_error_message', 'Oops...! Something went wrong to submit your message, please try again.');
		}
		redirect($url);
	}	
	
	public function deletePhotoAndVideo()
	{
		$photo_video_id = $_POST['photo_video_id'];
		$photo_video_for_id = $_POST['photo_video_for_id'];
		$this->photo_video_master_model->delete($photo_video_id,$photo_video_for_id);
	}
	public function phone_number_popup($phone)
	{
		$phone = $phone / 21;
		$_SESSION['contact_to_phone_number'] = $phone;
		$ArrPageData['view_name'] = 'view_phone_number_popup.php';
		$this->load->view('pop_up_view',$ArrPageData);
	}
	public function phone_number_pop_up_process()
	{
		if(isset($_SESSION['contact_to_phone_number']) && $_SESSION['contact_to_phone_number']!='')
		{
			$send_sms_to = $_SESSION['contact_to_phone_number'];
	
			$message = $_POST['popup-contact-name']." is interesting to see your contact details, please contact ".$_POST['popup-contact-name']." to this number ".$_POST['popup-contact-phone'];
			send_sms($send_sms_to,$message,3);
		}
		echo "You request has been submitted successfully. We will get back to you soon.";
	}
	

}
