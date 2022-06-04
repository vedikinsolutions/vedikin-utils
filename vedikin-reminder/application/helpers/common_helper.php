<?php
/* Return phone number string */
if (!function_exists('getPhoneNumber')) {
	function getPhoneNumber($phone)
	{
		$total_char = strlen($phone);
		$temp_phone = $phone * 21;
		if ($total_char < 10)
			$total_char = 10;
		$phone_number = substr($phone, 0, 4);
		for ($i = 1; $i <= $total_char - 4; $i++)
			$phone_number .= "*";
		return "<a href='javascript:void(0);' onClick='phoneNumberView($temp_phone);' title='Click here to view contact details'>$phone_number</a>";
	}
}
/* Return mobile number string */
if (!function_exists('getMobileNumber')) {
	function getMobileNumber($mobile)
	{
		$total_char = strlen($mobile);
		$temp_mobile = $mobile * 21;
		if ($total_char < 10)
			$total_char = 10;
		$mobile_number = substr($mobile, 0, 4);
		for ($i = 1; $i <= $total_char - 4; $i++)
			$mobile_number .= "*";
		return "<a href='javascript:void(0);' onClick='phoneNumberView($temp_mobile);' title='Click here to view contact details'>$mobile_number</a>";
	}
}
/* Get Marketplace category */
if (!function_exists('getMarketplaceType')) {
	function getMarketplaceType()
	{
		$Array[''] = 'Select';
		$Array['Property'] = 'Property';
		$Array['Materail'] = 'Materail';
		$Array['Equipment'] = 'Equipment';
		return $Array;
	}
}
/* CHANGE DATE FORMAT */
if (!function_exists('changeDateFormat')) {
	function changeDateFormat($date)
	{
		return date("d-M-Y", strtotime($date));
	}
}
/* CHANGE DATE FORMAT */
if (!function_exists('changeDateTimeFormat')) {
	function changeDateTimeFormat($date)
	{
		return date("d-M-Y H:i:s", strtotime($date));
	}
}
/* RETURN IS ACTIVE BUTTON IN LIST PAGE */
if (!function_exists('getIsactiveButtonForList')) {
	function getIsactiveButtonForList($is_active, $primary_key_value, $table_name, $primary_key_name)
	{
		$is_active = ($is_active == '0') ? '<a href="javascript:void(0)" onclick=\'updateIsActiveValue(' . $primary_key_value . ',"' . $table_name . '","' . $primary_key_name . '")\'class="update_status_i' . $primary_key_value . '"><small class="label label-warning">No</small></a>' : '<a href="javascript:void(0)" onclick=\'updateIsActiveValue(' . $primary_key_value . ',"' . $table_name . '","' . $primary_key_name . '")\' class="update_status_i' . $primary_key_value . '"><small class="label label-info">Yes</small></a>';
		return $is_active;
	}
}
if (!function_exists('getIsactiveForHomeList')) {
	function getIsactiveForHomeList($is_active, $primary_key_value, $table_name, $primary_key_name)
	{
		$is_active = ($is_active == '0') ? '<a href="javascript:void(0)" onclick=\'updateIsactiveForHomeList(' . $primary_key_value . ',"' . $table_name . '","' . $primary_key_name . '")\'class="flag_status_i' . $primary_key_value . '"><small class="label label-warning">No</small></a>' : '<a href="javascript:void(0)" onclick=\'updateIsactiveForHomeList(' . $primary_key_value . ',"' . $table_name . '","' . $primary_key_name . '")\' class="flag_status_i' . $primary_key_value . '"><small class="label label-info">Yes</small></a>';
		return $is_active;
	}
}
if (!function_exists('updateIsFeatured')) {
	function getIsFeatured($is_active, $primary_key_value, $table_name, $primary_key_name)
	{
		$is_active = ($is_active == '0') ? '<a href="javascript:void(0)" onclick=\'updateIsFeatured(' . $primary_key_value . ',"' . $table_name . '","' . $primary_key_name . '")\'class="flag_is_featured_i' . $primary_key_value . '"><small class="label label-warning">No</small></a>' : '<a href="javascript:void(0)" onclick=\'updateIsFeatured(' . $primary_key_value . ',"' . $table_name . '","' . $primary_key_name . '")\' class="flag_is_featured_i' . $primary_key_value . '"><small class="label label-info">Yes</small></a>';
		return $is_active;
	}
}
if (!function_exists('getIsactiveForSideBarList')) {
	function getIsactiveForSideBarList($is_active, $primary_key_value, $table_name, $primary_key_name)
	{
		$is_active = ($is_active == '0') ? '<a href="javascript:void(0)" onclick=\'updateIsactiveForSideBaerList(' . $primary_key_value . ',"' . $table_name . '","' . $primary_key_name . '")\'class="flag_sidebar_i' . $primary_key_value . '"><small class="label label-warning">No</small></a>' : '<a href="javascript:void(0)" onclick=\'updateIsactiveForSideBaerList(' . $primary_key_value . ',"' . $table_name . '","' . $primary_key_name . '")\' class="flag_sidebar_i' . $primary_key_value . '"><small class="label label-info">Yes</small></a>';
		return $is_active;
	}
}
/* RETURN IS ACTIVE BUTTON IN LIST PAGE */
if (!function_exists('getActionButtonForList')) {
	function getActionButtonForList($primary_key_value, $module_name, $ArrButton = array("V", "E", "D"))
	{
		$action = '<div class="btn-group">';
		if (in_array("V", $ArrButton)) {
			$module_name = str_replace("_", "-", $module_name);
			$action .= '<a href="' . base_url() . $module_name . '-update/' . $primary_key_value . '" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>';
		}
		if (in_array("D", $ArrButton)) {
			$module_name = str_replace("_", "-", $module_name);
			$action .= '<a rel="' . base_url() . $module_name . '-delete/' . $primary_key_value . '" class="deleteRecord btn btn-default btn-sm"><i class="fa fa-trash-o"></i></a>';
		}
		if (in_array("E", $ArrButton)) {
			$module_name = str_replace("_", "-", $module_name);
			$action .= '<a href="' . base_url() . $module_name . '-update/' . $primary_key_value . '" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>';
		}
		$action .= '</div>';
		return $action;
	}
}
if (!function_exists('getActionButtonForRightsList')) {
	function getActionButtonForRightsList($primary_key_value,$primary_key_value1, $module_name, $ArrButton = array("V", "E", "D"))
	{
		$action = '<div class="btn-group">';
		if (in_array("V", $ArrButton)) {
			$module_name = str_replace("_", "-", $module_name);
			$action .= '<a href="' . base_url() . $module_name . '-update/' . $primary_key_value . '/'.$primary_key_value1.'" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>';
		}
		if (in_array("D", $ArrButton)) {
			$module_name = str_replace("_", "-", $module_name);
			$action .= '<a rel="' . base_url() . $module_name . '-delete/' . $primary_key_value . '/'.$primary_key_value1.'" class="deleteRecord btn btn-default btn-sm"><i class="fa fa-trash-o"></i></a>';
		}
		if (in_array("E", $ArrButton)) {
			$module_name = str_replace("_", "-", $module_name);
			$action .= '<a href="' . base_url() . $module_name . '-update/' . $primary_key_value . '/'.$primary_key_value1.'" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>';
		}
		$action .= '</div>';
		return $action;
	}
}
if (!function_exists('IsUserUpdatePassword')) {
	function IsUserUpdatePassword($user_id)
	{
		$result = false;

		$ci = &get_instance();
		$ci->db->select('*');
		$ci->db->from(DB_PREFIX.'user_master');
		$ci->db->where('user_id', $user_id);
		$query = $ci->db->get();
		if ($query->num_rows() > 0) {
			$ArrData =  $query->result_array();
			if (strtotime($ci->session->userdata['logged_in']['login_time']) < strtotime($ArrData[0]['after_password_update_login_time'])) {
				$result = true;
			}
		}
		return $result;
	}
}
if (!function_exists('getUserProfileVisitCount')) {
	function getUserProfileVisitCount($user_id)
	{
		$ci = &get_instance();
		$ci->db->select('*');
		$ci->db->from(DB_PREFIX.'user_master');
		$ci->db->where('user_id', $user_id);
		$query = $ci->db->get();
		if ($query->num_rows() > 0) {
			$ArrData =  $query->result_array();
			return $ArrData[0]['profile_detail_page_visit_count'];
		}
		return 0;
	}
}
/* IS User Login*/
if (!function_exists('IsUserLogin')) {
	function IsUserLogin($user_role_id)
	{
		$ci = &get_instance();
		$Is_login = false;
		$session_user_role_id = false;

		if (isset($ci->session->userdata['logged_in'])) {
			$Is_login = $ci->session->userdata['logged_in']['Is_login'];
			$session_user_role_id = $ci->session->userdata['logged_in']['user_role_id'];
			$user_id = $ci->session->userdata['logged_in']['user_id'];
		}

		if ($user_role_id == 1) {

			if ($Is_login && $session_user_role_id == 1) {
				return true;
			} else {
				return false;
			}
		} elseif ($user_role_id == 2) {

			if ($Is_login && $session_user_role_id == 2) {
				return true;
			} else {
				return false;
			}
		} elseif ($user_role_id == 3) {

			if ($Is_login && $session_user_role_id == 3) {
				return true;
			} else {
				return false;
			}
		}
		elseif ($user_role_id == 4) {

			if ($Is_login && $session_user_role_id == 4) {
				return true;
			} else {
				return false;
			}
		}
		elseif ($user_role_id == 5) {

			if ($Is_login && $session_user_role_id == 5) {
				return true;
			} else {
				return false;
			}
		}
		else {
			return false;
		}
	}
}

if (!function_exists('get_current_admin_id')) {
	function get_current_admin_id()
	{
		$ci = &get_instance();
		$user_id = 0;
		if (isset($ci->session->userdata['logged_in'])) {
			$user_id = $ci->session->userdata['logged_in']['user_id'];
		}
		return $user_id;
	}
}
if (!function_exists('get_current_user_id')) {
	function get_current_user_id()
	{
		$ci = &get_instance();
		$user_id = 0;
		if (isset($ci->session->userdata['website_user_logged_in'])) {
			$user_id = $ci->session->userdata['website_user_logged_in']['website_user_id'];
		}
		return $user_id;
	}
}
if (!function_exists('get_current_user_type')) {
	function get_current_user_type()
	{
		$ci = &get_instance();
		$user_type = 0;
		if (isset($ci->session->userdata['website_user_logged_in'])) {
			$user_type = $ci->session->userdata['website_user_logged_in']['website_user_user_role_id'];
		}
		return $user_type;
	}
}

if (!function_exists('check_website_user_is_login')) {
	function check_website_user_is_login()
	{
		$ci = &get_instance();
		$website_user_is_login = 0;
		if (isset($ci->session->userdata['website_user_logged_in'])) {
			$website_user_is_login = $ci->session->userdata['website_user_logged_in']['website_user_is_login'];
		}
		if ($website_user_is_login == 1)
			return true;
		else
			return false;
	}
}
if (!function_exists('get_admin_detail')) {
	function get_admin_detail()
	{
		$ArrData = array();
		$user_id = get_current_admin_id();
		$ci = &get_instance();
		$ci->db->select('*');
		$ci->db->from(DB_PREFIX.'user_master');
		$ci->db->where('user_id', $user_id);
		$query = $ci->db->get();
		if ($query->num_rows() > 0) {
			$ArrData =  $query->result_array()[0];
		}
		return $ArrData;
	}
}
if (!function_exists('get_admin_role')) {
	function get_admin_role()
	{
		$user_id = get_current_admin_id();
		$ci = &get_instance();
		$user_type = $ci->session->userdata['logged_in']['user_role_id'];
		if ($user_type == 1) {
			$user = 'Developer';
		} elseif ($user_type == 2) {
			$user = 'Master Admin';
		} elseif ($user_type == 3) {
			$user = 'Normal Admin';
		}elseif ($user_type == 4) {
			$user = 'Data Operator';
		}
		else{
			$user='Other';
		}
		return $user;
	}
}
if (!function_exists('send_sms')) {
	function send_sms($mobileNumber, $message, $routeId = 3)
	{
		/*$senderId="BLDGSQ";
		$serverUrl="sms.mysmpp.com";
		$authKey="95daf171b82377b77f7887c16fa0e188";
		$getData = 'mobileNos='.$mobileNumber.'&message='.urlencode($message).'&senderId='.$senderId.'&routeId='.$routeId;
		//API URL
		$url="http://sms.mysmpp.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$authKey."&".$getData;
		// init the resource
		$ch = curl_init();
		curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0
		));

		//get response
		$output = curl_exec($ch);
		curl_close($ch);
		*/

		/*$senderId="DEMOOS";
		$authKey="95daf171b82377b77f7887c16fa0e188";
		$url = "http://msg.msgclub.net/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$authKey."&message=".urlencode($message)."&senderId=".$senderId."&routeId=".$routeId."&mobileNos=".$mobileNumber."&smsContentType=english";
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_PORT => "8080",
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"Cache-Control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		//echo "<pre>Response:";print_r($response);exit;
		
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}*/

		$authKey="33f5da26cce22976f4c4c538118011";
		$senderId="BLDGSQ";
		$serverUrl="http://websms.textidea.com/app/smsapi/index.php";
		 //Prepare you post parameters
		$postData = array(
			'mobileNumbers' => $mobileNumber,
			'smsContent' => $message,
			'senderId' => $senderId,
			'routeId' => $routeId,
			"smsContentType" => 'english'
		);


		$data_json = json_encode($postData);
		// init the resource
		$ch = curl_init();

		curl_setopt_array($ch, array(
			CURLOPT_URL => $serverUrl,
			CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Content-Length: ' . strlen($data_json)),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $data_json,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0
		));

		//get response
		$output = curl_exec($ch);

		//Print error if any
		if (curl_errno($ch)) {
			echo 'error:' . curl_error($ch);
		}
		curl_close($ch);
		return $output;
	}
	if (!function_exists('getActionButtonForGSTList')) {
		function getActionButtonForGSTList($primary_key_value1, $primary_key_value2, $module_name, $ArrButton = array("V", "E", "D"))
		{
			$action = '<div class="btn-group">';
			if (in_array("V", $ArrButton)) {
				$module_name = str_replace("_", "-", $module_name);
				$action .= '<a href="' . base_url() . $module_name . '-update/' . $primary_key_value1 . '/' . $primary_key_value2 . '" class="btn btn-default btn-sm" )"><i class="fa fa-eye"></i></a>';
			}
			if (in_array("D", $ArrButton)) {
				$module_name = str_replace("_", "-", $module_name);
				$action .= '<a rel="' . base_url() . $module_name . '-delete/' . $primary_key_value1 . '/' . $primary_key_value2 . '" class="deleteRecord btn btn-default btn-sm"><i class="fa fa-trash-o"></i></a>';
			}
			if (in_array("E", $ArrButton)) {
				$module_name = str_replace("_", "-", $module_name);
				$action .= '<a href="' . base_url() . $module_name . '-update/' . $primary_key_value1 . '/' . $primary_key_value2 . '" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>';
			}
			$action .= '</div>';
			return $action;
		}
	}
}
function sms_send($MobileNumber, $subscription, $message)
{
	
	foreach($MobileNumber as $mobile)
	{
		if(strlen(trim($mobile)) == 10)
		{
			$final_mobile_nos[] = trim($mobile);
		}
	}

	if(count($final_mobile_nos) == 0)
	{
		return false;
	}
	
	
	if (SMS_ENABLED) {

		if ($subscription == OTP_SMS) {
			$USERNAME = OTP_SMS_USERNAME;
			$PASSWORD = OTP_SMS_PASSWORD;
			$SENDER_ID = OTP_SENDER_ID; // 'ESYOFZ';
			$URL=OTP_SMS_URL;
		} else if ($subscription == PROMOTIONAL_SMS) {
			$USERNAME = PROMOTIONAL_SMS_USERNAME;
			$PASSWORD = PROMOTIONAL_SMS_PASSWORD;
			$SENDER_ID = PROMOTIONAL_SENDER_ID; // 'ESYOFZ';
			$URL=PROMOTIONAL_SMS_URL;
		}
		
		$sms_text = urlencode($message);
		/*$api_key = '55FD0AF2CCC511';
	
		$from = 'TXTSMS';
		$sms_text = urlencode('Hello People, have a great day');*/

		//Submit to server


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "key=" . $USERNAME . "&routeid=16&type=text&contacts=" . implode(',', $final_mobile_nos) . "&senderid=" . $SENDER_ID . "&msg=" . $sms_text);
		$response = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if ($httpcode == 200) {
			if($subscription == OTP_SMS)
			{
				
				//$count=count($final_mobile_nos);
				$result="UPDATE cadms_configration_master SET configration_value =  CAST(configration_value AS UNSIGNED)  + " . count($final_mobile_nos) . " 
				WHERE configration_key='OTP_counter'";
				
			}
			else if($subscription == PROMOTIONAL_SMS)
			{
				
				// $count=count($final_mobile_nos);
				$result="UPDATE cadms_configration_master SET configration_value =  CAST(configration_value AS UNSIGNED) + " . count($final_mobile_nos) . " 
				WHERE configration_key='Promotional_counter'";
			}
			$CI =& get_instance();
			$CI->db->query($result);

			return true;
		} else {
			return false;
		}
	} else {
		return true;
	}

}
function send_mail($email, $subject, $message)
{
	$ci = &get_instance();
	$config = array();
	$config['protocol'] = 'smtp';
	$config['smtp_host'] = 'thcitsolutions.com';
	$config['smtp_user'] = 'test@thcitsolutions.com';
	$config['smtp_pass'] = 'VedikIn@231';
	$config['smtp_port'] = 587;
	$config['mailtype'] = 'html';
	$config['charset'] = 'utf-8';
	$config['wordwrap'] = true;

	$ci->email->initialize($config);
	$ci->email->set_mailtype("html");
	$ci->email->from("test@thcitsolutions.com", "VedikIn Solutions");
	$ci->email->to($email);
	$ci->email->subject($subject);
	$ci->email->message($message);
	if ($ci->email->send()) {
		return true;
	} else {
		return false;
	}
}
function password_encryption($password)
{
	$simple_string = $password; 
  
		
		// Store the cipher method 
		$ciphering = "AES-128-CTR"; 
		
		// Use OpenSSl Encryption method 
		$iv_length = openssl_cipher_iv_length($ciphering); 
		$options = 0; 
		
		// Non-NULL Initialization Vector for encryption 
		$encryption_iv = '1234567891011121'; 
		
		// Store the encryption key 
		$encryption_key = "VedikIn"; 
		
		// Use openssl_encrypt() function to encrypt the data 
		$encryption = openssl_encrypt($simple_string, $ciphering, 
					$encryption_key, $options, $encryption_iv); 
		return $encryption;
  
}
function password_decryption($password)
{
	$ciphering = "AES-128-CTR";
	$decryption_iv = '1234567891011121'; 
	$options = 0; 
	// Store the decryption key 
	$decryption_key = "VedikIn"; 
	
	// Use openssl_decrypt() function to decrypt the data 
	$decryption=openssl_decrypt ($password, $ciphering,  
			$decryption_key, $options, $decryption_iv); 
			return $decryption;
}
function getFileCount($path) {
	$size = 0;
	$ignore = array('.','..','cgi-bin','.DS_Store');
	$files = scandir($path);
	foreach($files as $t) {
		if(in_array($t, $ignore)) continue;
		if (is_dir(rtrim($path, '/') . '/' . $t)) {
			$size += getFileCount(rtrim($path, '/') . '/' . $t);
		} else {
			$size++;
		}   
	}
	return $size;
}

function AddMultipleFile($file_path,$file_name,$inputFileName,$file_size,$file_type,$i)
{
	$arr_file_upload_path = explode("/", $file_path);
	$directory_path = '';
	/* to create directory */
	for ($i=0; $i < count($arr_file_upload_path) - 1 ; $i++) { 
		$directory_path .= $arr_file_upload_path[$i] . "/";

		if (!is_dir($directory_path))
		mkdir($directory_path, 0755, true);
	}
	// foreach ($arr_file_upload_path as $single_folder_path) {
	// 	$directory_path .= $single_folder_path . "/";

	// 	if (!is_dir($directory_path))
	// 	mkdir($directory_path, 0755, true);
	// }
	$ci = &get_instance();

	$config = array();
	$config['allowed_types']        = $file_type;
	$config['max_size']             = $file_size;
	$config['upload_path']          = './' . $directory_path;
	$config['file_name']            = $file_name;

	$ci->load->library('upload', $config);
	$ci->upload->initialize($config);

	$result = $ci->upload->do_upload($inputFileName);
	if($result == TRUE){
		return true;
	}else{
		return false;
	}
}