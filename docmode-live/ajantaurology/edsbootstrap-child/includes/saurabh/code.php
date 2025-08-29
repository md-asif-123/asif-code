<?php 
//add mobile number field to contact info for user profile in admin panel  
add_filter('user_contactmethods', 'srb_custom_user_contactmethods');
function srb_custom_user_contactmethods($user_contact){
	$user_contact['mobile_phone'] = 'Phone number';
	return $user_contact;
}
//create loogin form on page via shortcode
add_shortcode('login_form' , 'srb_login_form');
function srb_login_form(){
	$str = "";
	if ( !is_user_logged_in() ){
		// $str = "<div id='or'>OR</div> ";
		$str = '<div id="otp_login_form">';
		$str .= '<div class="Login-title">Log In</div>';
		$str .= '<form id = "me_login" autocomplete="off">';
		$str .= '<label> Registered Email or Mobile  </label> ';
		$str .= '<input id="email_mobile" name="email_mobile" class="email_mobile" placeholder = "" value = "" />';
		$str .=  "<button id = 'btn_mobile_login' name = 'btn_mobile_login' class = 'btn_mobile_login' > Continue </button>";
		$str .=  "</form>";
		$str .= '<form id = "me_otp" autocomplete="off" style="display:none">';
		$str .= '<label> Enter OTP </label> ';
		$str .= '<input id="OTP_area" name="OTP_area" class="OTP_area" placeholder = "" value = "" />';
		$str .=  "<button id = 'btn_otp_verify' name = 'btn_otp_verify' class = 'btn_otp_verify' > Verify </button>";
		$str .=  "</form>";
		$str .=  "<div id='me_responce' class='me_responce'></div>";
		$str .=  "<div id='me_timer' class='me_timer'></div>";
		$str .= '</div>';
	}
	return $str;
}

/**
 * callback function on login submission
 * @return array 0|1 0 if data found
 * 					 1 if no data found
 * 
 * */

function srb_ajax_login(){

	$res_data;
	$mail_sent = false;
    check_ajax_referer('custom_script_nonce', 'nonce');

    if ( isset ( $_POST['input'] ) ){
    	$input 	= sanitize_text_field($_POST['input']); 
    	$data 	= srb_check_user_in_db_with_ME( $input ); //where ME stands for MobileEmail
    }

    if ( !empty ( $data ) ){

    	//set random OTP;
		$otp = srb_generate_otp(4);

		//set OTP in transient for desire interval
    	set_transient( 'OTP'  , $otp , 2 * MINUTE_IN_SECONDS );

    	$user_input_type 		= ( isset( $data['user_entered_input_type'] ) ) ? $data['user_entered_input_type'] : NULL;
    	$user_input_type_value 	= ( isset( $data['user_entered_input_type_value'] ) ) ? $data['user_entered_input_type_value'] : NULL;
    	$user_name 				= ( isset( $data['display_name'] ) ) ? $data['display_name'] : NULL;
    	$user_id 				= ( isset( $data['ID'] ) ) ? $data['ID'] : NULL;
    	$user_login 			= ( isset( $data['user_login'] ) ) ? $data['user_login'] : NULL;

    	if( "email" == $user_input_type && !is_null( $user_input_type_value ) ){
    		$mail_sent = srb_send_otp_on_mail( $user_input_type_value , $user_name, $otp );

    		if ( $mail_sent ){
		    	$res_data = array(
		    		'Status' 				=> 0,
		    		'OTP' 					=> $otp,
		    		'Description' 			=> "<span class='gray'> We've sent a One Time Password (OTP) to the $input. Please enter it to complete verification.</span>",
		    		'uID'					=> $user_id,
		    		'uLogin' 				=> $user_login,
		    		'input_type' 			=> $user_input_type,
		    		'input_type_value' 		=> $user_input_type_value
		    	);  		
    		} else {
	    		$res_data = array(
		    		'Status' 				=> 1,
		    		'OTP' 					=> $otp,
		    		'Description' 			=> "<span class='red'> Sorry, we are unable to send OTP via mail.</span>",
		    		'uID'					=> $user_id,
		    		'uLogin' 				=> $user_login,
		    		'input_type' 			=> $user_input_type,
		    		'input_type_value' 		=> $user_input_type_value
		    	); 
    		}
    	}//email check 

    	if( "mobile" == $user_input_type && !is_null( $user_input_type_value ) ){
    		$mail_sent = srb_send_otp_on_mobile( $user_input_type_value , $user_name, $otp );

    		if ( $mail_sent == 200 ){
		    	$res_data = array(
		    		'Status' 				=> 0 ,
		    		'OTP' 					=> $otp,
		    		'Description' 			=> "<span class='gray'> We've sent a One Time Password (OTP) to the $input. Please enter it to complete verification.</span>",
		    		'uID'					=> $user_id,
		    		'uLogin' 				=> $user_login,
		    		'input_type' 			=> $user_input_type_value,
		    		'input_type_value' 		=> $user_input_type_value
		    	);  		
    		}else{
    			$res_data = array(
		    		'Status' 				=> 1 ,
		    		'OTP' 					=> $otp,
		    		'Description' 			=> "<span class='red'> Sorry, There are some techniqual difficulties to send OTP on given number. </span>",
		    		'uID'					=> $user_id,
		    		'uLogin' 				=> $user_login,
		    		'input_type' 			=> $user_input_type_value,
		    		'input_type_value' 		=> $user_input_type_value
		    	);
    		}
    	}//mobile check 
    }else{
    	//you are here because mobile and email does not found in db. Hence, empty $data return
    	$res_data = array(
    		'Status' 		=> 1, 
    		'Description' 	=> '<span class="red">'.$input .' is not registered with us.</span>'
    		//'data' 		=> $data
    	);
    }
	echo json_encode($res_data);  	
    die();
}
add_action( 'wp_ajax_nopriv_srb_ajax_login', 'srb_ajax_login' );
add_action( 'wp_ajax_srb_ajax_login', 'srb_ajax_login' );



//callback function for verify OTP submission
function srb_ajax_verify_otp(){
	$input_OTP;
	$res_data;
    check_ajax_referer('custom_script_nonce', 'nonce');

    if ( isset ( $_POST['input_OTP'] ) ){
    	$input_OTP = sanitize_text_field($_POST['input_OTP']);
    }

    // if ( isset ( $_POST['input'] ) ){
    // 	$input = sanitize_text_field($_POST['input']);
    // }

    if ( isset ( $_POST['user_id'] ) ){
    	$user_id = sanitize_text_field($_POST['user_id']);
    }

    if ( isset ( $_POST['user_login'] ) ){
    	$user_login = sanitize_text_field($_POST['user_login']);
    }

    if ( isset ( $_POST['user_input_type'] ) ){
    	$user_input_type = sanitize_text_field($_POST['user_input_type']);
    }

    if ( isset ( $_POST['user_input_type_value'] ) ){
    	$user_input_type_value = sanitize_text_field($_POST['user_input_type_value']);
    }

    $og_OTP = get_transient('OTP');
    $OTP_data = 'commented'; //send_otp($og_OTP);
    //if transient timeout then returns false thats means user has not input otpin given time 
    if (false === $og_OTP){
    	$res_data = array(
    		'Status' 					=> -1, 
    		'Description' 				=> "<span class='red'> OTP Expire</span>",
    		'user_id'					=> $user_id,
				'user_login'				=> $user_login,	
    		'user_input_type' 			=> $user_input_type,
    		'user_input_type_value' 	=> $user_input_type_value ,
    		'otp_data' 					=> $OTP_data 
    	);
    //if tranisient has not time out then it has value of original OTP
	}elseif ( isset ($og_OTP)  ){

    	if($og_OTP == $input_OTP){
    		
    		if (srb_auto_login( $user_id, $user_login )){
    			$res_data = array(
	    		'Status' 					=> 0 , 
	    		'Description' 				=> "<span class='green'> Perfect !! . </span>", 
	    		'user_id'					=> $user_id,
				'user_login'				=> $user_login,
	    		'user_input_type' 			=> $user_input_type,
	    		'user_input_type_value' 	=> $user_input_type_value ,
	    		'redirect_url'	=>	home_url(),
	    		'otp_data' 					=> $OTP_data 
	    		);
    		}
	    	
	    }else {
	    	$res_data = array(
	    		'Status' 					=> 1 , 
	    		'Description' 				=> "<span class='red'>You have entered wrong OTP.</span>",
	    		'user_id'					=> $user_id,
				'user_login'				=> $user_login,
	    		'user_input_type' 			=> $user_input_type,
	    		'user_input_type_value' 	=> $user_input_type_value ,
	    		'otp_data' 					=> $OTP_data
	    	);
	    }
	}

	echo json_encode($res_data);  	
    die();
}
add_action( 'wp_ajax_nopriv_srb_ajax_verify_otp', 'srb_ajax_verify_otp' );
add_action( 'wp_ajax_srb_ajax_verify_otp', 'srb_ajax_verify_otp' );





function srb_auto_login ( $user_id, $user_login ){
		// $user_id 			= $user_id;
		// $user_login 		= $user_login;

    	wp_clear_auth_cookie();
	    wp_set_current_user ( $user_id , $user_login);
	    wp_set_auth_cookie  ( $user_id );
	    //wp_redirect( '/' );
	    return true;
}

/**
 * Check user is exist or not based on mobile or email parameter
 * @param 	$input		string				Mobile number or email id provided by user in login form
 * @return 	$user_data 	Array (Data|Empty) 	returns array of data for a user if record found else return empty array.
 * */
function srb_check_user_in_db_with_ME( $input ){
	$user_data = array(); //empty array

	if ( email_exists ( $input ) ){
		$raw_user_data 	= get_user_by( 'email', $input );
    	$user_data 		= create_user_data( $raw_user_data, 'email', $input );
    }else{
    	//if user input mobile number
    	$args = array(
			'meta_query' => array(
					array(
						'key'     => 'mobile_phone',
						'value'   => $input,
						'compare' => '='

					)
			)
		 );
    	$raw_user_data = get_users($args);

    	//if data found then function return array having zero index
    	if(!empty ( $raw_user_data ) ) {
    		$raw_user_data 	= $raw_user_data[0];
    		$user_data 		= create_user_data( $raw_user_data, 'mobile', $input );
    	}
    }

    return $user_data;
}


// This function will return a random string of specified length
function srb_generate_otp($length_of_string) {
	// String of all alphanumeric character
	$str_result = '0123456789ABCDEFGHIJKLMNPQRTUVWXYZabcdefghijkmnpqrstuvwxyz';

	// Shuffle the $str_result and returns substring of specified length
	return substr(str_shuffle($str_result), 0, $length_of_string);
}


function create_user_data($user_data, $type, $type_value ){
	$new_arr =[];
	foreach ($user_data as $key => $value) {
		$new_arr['ID'] 								= 	$user_data->ID;
		$new_arr['display_name'] 					= 	$user_data->display_name;
		$new_arr['user_activation_key'] 			= 	$user_data->user_activation_key;
		$new_arr['user_email'] 						= 	$user_data->user_email;
		$new_arr['user_login'] 						= 	$user_data->user_login;
		$new_arr['user_nicename'] 					= 	$user_data->user_nicename;
		$new_arr['user_pass'] 						= 	$user_data->user_pass;
		$new_arr['user_registered'] 				= 	$user_data->user_registered;
		$new_arr['user_status'] 					= 	$user_data->user_status;
		$new_arr['user_url'] 						= 	$user_data->user_url;
		$new_arr['user_role'] 						= 	$user_data->roles;
		$new_arr['user_entered_input_type'] 		= 	$type;
		$new_arr['user_entered_input_type_value']	=	$type_value;
	}
	return $new_arr;
}



function srb_send_otp_on_mobile( $mobile, $user_name, $OTP ){
	$post_data = array(
	    'From'    			=> 'DOCMOD',
	    'To'      			=> $mobile,
	    'Body'    			=> 'OTP is '. $OTP .' to validate your login on Docmode.org. This OTP is only valid for 2 mins.',
	    'DltTemplateId' 	=> '1107160654212979263',
	    'DltEntityId' 		=> '1101546250000035700' ,
	    'SmsType'			=> 'transactional'
	);
	$api_key      = "d416fb06aafb39b7308aeb72696c4c115ce466a3ba69ec4d";
	$api_token    = "97dcb2e68beac8903f422de73a3df79151f453b7f209cc74"; 
	$exotel_sid   = "docmode1";
	#Replace <subdomain> with the region of your account 
	#<subdomain> of Singapore cluster is @api.exotel.com
	#<subdomain> of Mumbai cluster is @api.in.exotel.com
	$url    = "https://" . $api_key . ":" . $api_token ."@api.exotel.in/v1/Accounts/" . $exotel_sid ."/Sms/send.json"; 
	$ch     = curl_init();
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FAILONERROR, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data)); 
	//returns api responce
	$http_result = curl_exec($ch); 
	// api status code
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
	curl_close($ch);
	//return json_decode($http_result);
	return $httpcode;

}

function srb_send_otp_on_mail( $email , $user_name , $OTP ){	
	$to 		= $email;
	$subject 	= 'OTP Received | '. get_bloginfo();
	// $body = 'The email body content';
	$headers[] = 'Content-Type: text/html; charset=UTF-8';
	$headers[] = 'From: DocMode Health Technologies Pvt Ltd <no-reply@docmode.com>';
	//$headers[] = 'Cc: Richa <richa@docmode.com>';
	//$headers[] = 'Cc: hemant <hemant@docmode.com>';
	$body ='<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
				<div style="margin:50px auto;width:70%;padding:20px;border:1px solid #e5e5e5;border-radius : 5px">
					<div style="border-bottom:1px solid #eee">
						<a href="'. home_url() .'" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">'. get_bloginfo() . '</a>
					</div>
					<p style="font-size:1.1em">Hi ' . $user_name . ',</p>
					<p>Thank you for choosing Docmode. Use the following OTP to complete your Sign In procedure. OTP is valid for 2 minutes</p>
					<h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">'
					. $OTP .'</h2>
					
					<hr style="border:none;border-top:1px solid #eee" />
					<div style="text-align: center;padding:8px 0 0 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
						<p>©'. date('Y') . ' DocMode Health Technologies Pvt. Ltd. All rights reserved</p>
						
					</div>
				</div>
			</div>';
	
	if( wp_mail( $to, $subject, $body, $headers ) ){
		return true;
	}else{
		return false;
	}


}
function fetch_userdata ( $form_username ){
	$data = array();
	$user_data			= 	get_user_by( 'login' , $form_username );
	if( $user_data ){
		$data['id']				= 	$user_data->ID ;
		$data['useremail']		= 	$user_data->user_email;		
		$data['username']      	= 	$user_data->user_login;
		$data['firstname'] 		= 	$user_data->first_name;
		$data['Lastname']  		= 	$user_data->last_name;
		$data['displayname']	= 	$user_data->display_name;
		$data['roles']			= 	array_shift($user_data->roles);
	}

    return $data;
}

/**
 * submit survey form 
 */
function srb_submit_survey(){
	$data = array();
	check_ajax_referer( 'custom_script_nonce', 'nonce' );	
	$data = fetch_userdata ( $_POST['respondent_name'] );
	$data['doc_id']			= 	( isset( $data['id']	 ) )  ? $data['id']	 : 0;
	$data['doc_username'] 	= 	( isset( $data['username'] ) )  ? $data['username'] : NULL;
	$data['doc_name'] 		= 	$data['displayname'];
	$patient_id 			= 	get_patient_id( $data['username'] );
	$new_patient_id			= 	$patient_id + 1 ;
	$data['pt_id'] 			= 	"PT00" . $new_patient_id; 
	$data['pt_displayname'] = 	"Patient ". $new_patient_id;
	$data['type']			=	"new";
	$data['form_data'] 		=	 json_encode ( $_POST['form_data'] ) ; 
	$data['website'] 		= 	home_url();
	$data['created_date'] 	=	( isset ( $_POST['created_date'] ) ) ? $_POST['created_date'] : '0000-00-00 00:00:00';
	


		// $mydb = new wpdb('saurabh', '4uRebuNIbuju', 'wp-analytics', 'koa-lms-wp.c2woekolusus.ap-south-1.rds.amazonaws.com');
		$mydb = new wpdb('dmwp001', 'ekv9ofdzqQSfsfF7TKYuTX4fGe2d8oxzXas', 'wp-analytics', DB_READ_REPLICA);
		$rows = 
		$mydb->get_results(
					$mydb->prepare("INSERT INTO wp_patient_experience 
									(doc_id, doc_username , doc_name, pt_id, pt_displayname, type,form_data,website,created_date) 
									VALUES (%d, %s, %s, %s , %s , %s , %s, %s, %s)",
									$data['doc_id'], $data['doc_username'], $data['doc_name'],  $data['pt_id'], $data['pt_displayname'], $data['type'] ,
									$data['form_data'], $data['website'] , $data['created_date']
									)
							);
		$lastid = $mydb->insert_id;
		$response = array(
			'insID' => $lastid,
			'redirect_url' => $_POST['page_slug'],
			'id' => $data['id'],
			'patient_id'=>$data['pt_displayname']
			);

	//print_r(json_dencode ( $_POST['form_data'] ));

	echo json_encode( $response ) ;
	die();
}
add_action( 'wp_ajax_nopriv_srb_submit_survey', 'srb_submit_survey' );
add_action( 'wp_ajax_srb_submit_survey', 'srb_submit_survey' );

// submit survey

function srb_submit_survey2(){
	$data = array();

	$the_page = sanitize_post( $GLOBALS['wp_the_query']->get_queried_object() );
	
	$page_slug = $_POST['page_slug'];
	//$page_slug = $current_url;
	//echo $page_slug;
	check_ajax_referer( 'custom_script_nonce', 'nonce' );

	$current_user 	= wp_get_current_user();

	$user_ID 				= ( isset( $current_user->ID ) )  ? $current_user->ID : 0;
	$user_login 		= ( isset( $current_user->user_login ) )  ? $current_user->user_login : NULL;
	// $user_first 		= ( isset( $current_user->user_first_name ) )  ? $current_user->user_first_name : NULL;
	// $user_last 			= ( isset( $current_user->user_last_name ) ) ? $current_user->user_last_name : NULL;
	$user_email 		= ( isset( $current_user->user_email ) ) ? $current_user->user_email : NULL;
	$userform_data 	=	( isset ( $_POST['form-data'] ) ) ? $_POST['form-data'] : NULL;
	$created_date 	=	( isset ( $_POST['created_date'] ) ) ? $_POST['created_date'] : '0000-00-00 00:00:00';
	$survey_id 			=	( isset ( $_POST['survey_id'] ) ) ? $_POST['survey_id'] : 0;

	$data['user_id'] 			= $user_ID;
	$data['user_login'] 		= $user_login;
	$data['user_email'] 		= $user_email;
	$data['userform_data'] 		= json_encode ( $userform_data );
	$data['created_date']		= $created_date;
	$data['survey_id']			= $survey_id;
	$data['website']			= home_url();
	$data['page_slug']			= $page_slug;


	$mydb = new wpdb('dmwp001', 'ekv9ofdzqQSfsfF7TKYuTX4fGe2d8oxzXas', 'wp-analytics', DB_READ_REPLICA);
	$result = $mydb->get_row("SELECT `userid` FROM wp_biocon_2_0_survey_data WHERE useremail = '".$user_email."' AND website = '".home_url()."'");
    //print_r($result);
    //echo $result->userid;die;
	if(!empty($result->userid)):
		$lastid = 1;
	else:
	$rows = 
	$mydb->get_results(
				$mydb->prepare("INSERT INTO wp_biocon_2_0_survey_data 
												(surveyid, userid, username, useremail, form_data,created_date,website, page_slug) 
												VALUES (%d, %d, %s , %s , %s , %s, %s , %s)",
												$data['survey_id'], $data['user_id'],  $data['user_login'], $data['user_email'], $data['userform_data'] , $data['created_date'], 
												$data['website'] , $data['page_slug']
												)
										);
	$lastid = $mydb->insert_id;
	//print_r( $current_user );
	endif;

	echo json_encode($lastid) ;
	die();
}
add_action( 'wp_ajax_nopriv_srb_submit_survey2', 'srb_submit_survey2' );
add_action( 'wp_ajax_srb_submit_survey2', 'srb_submit_survey2' );


function upload_image($filedata, $folder_name, $desire_name_to_file){
	$response = array();


	$target_dir = dirname(__FILE__). $folder_name;
	
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo(basename($filedata["name"]),PATHINFO_EXTENSION));

	//create unique file name
	$temp = explode(".", $filedata["name"]);
	$newfilename = $desire_name_to_file . '.' . end($temp);
	$target_file = $target_dir . $newfilename;
	// Check if image file is a actual image or fake image
	  $check = getimagesize($filedata["tmp_name"]);
	  if($check !== false) {
	    //echo "File is an image - " . $check["mime"] . ".";
	    $uploadOk = 1;
	  } else {
	  	$response['status'] = 0;
	  	$response['imageCheck'] = 'File is not an image';
	    //echo "File is not an image.";
	    $uploadOk = 0;
	  }

	// // Check if file already exists
	// if (file_exists($target_file)) {
	//   echo "Sorry, file already exists.";
	//   $uploadOk = 0;
	// }

	// Check file size
	if ($filedata["size"] > 10*1024*1024) {
	  $response['status'] = 0;
	  $response['imagesize_Err'] = "Sorry, your file is too large.";
	  $uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"	&& $imageFileType != "gif" ) {
	  $response['status'] = 0;
	  $response['imageformat_Err'] =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed." ;
	  $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  $response['status'] = 0;
	  $response['error'] =  "Sorry, your file was not uploaded." ;
	// if everything is ok, try to upload file
	} else {
	  if (move_uploaded_file($filedata["tmp_name"], $target_file)) {
	    $response['status'] = 1;
	    $response['original_name'] = $filedata["name"];
	    $response['modified_name'] = $newfilename;
	    $response['path'] = $target_file;
	  	$response['message'] =  "The file ". htmlspecialchars( basename( $filedata["name"])). " has been uploaded." ;

	  } else {
	  	$response['status'] = 0;
	  	$response['message'] =  "Sorry, there was an error uploading your file." ;
	    
	  }
	}



	return $response;
}

function save_account_details($postdata, $fileupload_response ){

	$current_user 	= wp_get_current_user();

	$user_ID 				= ( isset( $current_user->ID ) )  ? $current_user->ID : 0;
	$user_email 		= ( isset( $current_user->user_email ) ) ? $current_user->user_email : NULL;

	$account_details=array(
		'account_holder_name'			=> $postdata['account_holder_name'],
		'account_number' 				=> $postdata['account_number'],
		'account_ifsc_code' 			=> $postdata['account_ifsc_code'],
		'canceled_cheque_name'			=> $fileupload_response['modified_name'],
		'I_agree' 						=> $postdata['I_agree'],
		'payment_choice' 				=> $postdata['payment_choice'],
	);
	$C_account_details = json_encode( $account_details );
	$mydb = new wpdb('dmwp001', 'ekv9ofdzqQSfsfF7TKYuTX4fGe2d8oxzXas', 'wp-analytics', DB_READ_REPLICA);
	$rows = 
		$mydb->get_results(
			$mydb->prepare("INSERT INTO wp_account 
							(user_id, user_email, survey_id, survey_data_id, acc_details, website,created_date) 
							VALUES (%d, %s, %d ,%d, %s , %s , %s)",
							$user_ID, $user_email , $postdata['sid'], $postdata['sr'], $C_account_details, home_url() , $postdata['ctime']
							)
									);

	$lastid = $mydb->insert_id;
	
	return $lastid;

}

function get_patient_id($username){
	$mydb = new wpdb('dmwp001', 'ekv9ofdzqQSfsfF7TKYuTX4fGe2d8oxzXas', 'wp-analytics', DB_READ_REPLICA);
	$rows = 
	$mydb->get_results( $mydb->prepare("select count(*) as row_count from wp_patient_experience where doc_username = '". $username . "'") );
	return $rows[0]->row_count;
}

/**
 * check user has submitted survey or not*
 */

 function check_useremail_in_survey(){
 	$current_user 	= wp_get_current_user();

 	$mydb = new wpdb('dmwp001', 'ekv9ofdzqQSfsfF7TKYuTX4fGe2d8oxzXas', 'wp-analytics', DB_READ_REPLICA);
	$rows = 
	$mydb->get_results( $mydb->prepare("select * from  wp_biocon_2_0_survey_data where useremail = %s and website = %s LIMIT 1", $current_user->user_email , home_url()	) );
	//echo "<pre>";print_r($rows);echo "</pre>";
	return $rows;
}

/**
 * check user has submitted account details or not*
 */

 function check_useremail_in_acount(){
 	$current_user 	= wp_get_current_user();

 	$mydb = new wpdb('dmwp001', 'ekv9ofdzqQSfsfF7TKYuTX4fGe2d8oxzXas', 'wp-analytics', DB_READ_REPLICA);
	$rows = 
	$mydb->get_results( $mydb->prepare("select * from  wp_account where user_email = %s and website = %s LIMIT 1 ", $current_user->user_email, home_url()	) );
	//echo "<pre>";print_r($rows);echo "</pre>";
	return $rows;
 }


//Disable the new user notification sent to the site admin
function smartwp_disable_new_user_notifications() {
	//Remove original use created emails
	remove_action( 'register_new_user', 'wp_send_new_user_notifications' );
	remove_action( 'edit_user_created_user', 'wp_send_new_user_notifications', 10, 2 );
	
	//Add new function to take over email creation
	add_action( 'register_new_user', 'smartwp_send_new_user_notifications' );
	add_action( 'edit_user_created_user', 'smartwp_send_new_user_notifications', 10, 2 );
}
function smartwp_send_new_user_notifications( $user_id, $notify = 'user' ) {
	if ( empty($notify) || $notify == 'admin' ) {
	  return;
	}elseif( $notify == 'both' ){
    	//Only send the new user their email, not the admin
		$notify = 'user';
	}
	wp_send_new_user_notifications( $user_id, $notify );
}
add_action( 'init', 'smartwp_disable_new_user_notifications' );


function my_callback($old_title){
    return "Patient Experience Form";
}


//
add_action( 'init',  function() {
    add_rewrite_rule( 
    '^get/([^/]*)/([^/]*)/([^/]*)/?',
    'index.php?page_id=46&form_user_role=$matches[1]&form_username=$matches[2]&form_action=$matches[3]',
    'top'
    );
    
} );
//
add_filter( 'query_vars', function( $query_vars ) {
	$query_vars[] = 'form_user_role';
    $query_vars[] = 'form_username';
    $query_vars[] = 'form_action';
    return $query_vars;
} );

//
add_action( 'template_include', function( $template ) {
    if ( get_query_var( 'form_user_role' ) == false || get_query_var( 'form_user_role' ) == '' ) {
        return $template;
    }
    if ( get_query_var( 'form_username' ) == false || get_query_var( 'form_username' ) == '' ) {
        return $template;
    }
    if ( get_query_var( 'form_action' ) == false || get_query_var( 'form_action' ) == '' ) {
        return $template;
    }
 	add_filter("pre_get_document_title", "my_callback");
    return get_stylesheet_directory() . '/content-general.php';
} );

function secondDB(){
	global $secondDB;
	// $secondDB = new wpdb('saurabh', '4uRebuNIbuju', 'wp-analytics', 'koa-lms-wp.c2woekolusus.ap-south-1.rds.amazonaws.com');
	$secondDB = new wpdb('dmwp001', 'ekv9ofdzqQSfsfF7TKYuTX4fGe2d8oxzXas', 'wp-analytics', DB_READ_REPLICA);
}
add_action( 'init', 'secondDB');



function get_entries_by_user($username, $userrole){
	global $secondDB;
	if( $userrole == 'um_doctor' || $userrole == 'subscriber'){
		$sec = $secondDB->get_results("select * from wp_patient_experience where doc_username = '". $username . "' AND website = '". home_url() . "' ORDER BY created_date DESC" );
	}elseif( $userrole == 'um_pi' || $userrole == 'administrator' || $userrole == 'editor'){
		$sec = $secondDB->get_results("select * from wp_patient_experience where website = '". home_url() . "' ORDER BY created_date DESC" );
	}
    
    return $sec;
}

function srb_replace_strings( $string ){
	
	$string = str_replace('_BLANK_',' ......... ',$string);
	$string = str_replace('_COMMA_',',',$string);
	$string = str_replace('_RLBRACKETS_',' ( ',$string);
	$string = str_replace('_RRBRACKETS_',' ) ',$string);
	$string = str_replace('_questionmark_','?',$string);
	// $string = str_replace('','',$string);
	$string = str_replace('_',' ',$string);// keep this line at last
	return $string;
}


//add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( 'Report Page', 'Report', 'manage_options', 'myplugin/myplugin-admin-page.php', 'customerview_admin_page', 'dashicons-tickets', 6  );
}
add_action( 'admin_menu', 'my_admin_menu' );
	
	function customerview_admin_page(){
	?>
	<div class="wrap">
		<h2>Report</h2>
		<a href="<?php echo home_url().'/wp-report.php';?>" > Download Reports </a>
		<?php
		// global $secondDB;
		// $customers = $secondDB->get_results("SELECT * from wp_patient_experience WHERE doc_username != 'dm_lifecare' AND doc_username != 'hemant' AND doc_username != 'saurabh01';");
		// echo "<table class='widefat fixed'>";
		// echo "<th>ID</th>";
		// echo "<th>Name</th>";
		// echo "<th>Patient name</th>";
		// // echo "<th>Service</th>";
		// // echo "<th>Date</th>";
		// // echo "<th>Address</th>";
		// // echo "<th>Phone</th>";
		// // echo "<th>Message</th>";
		// // echo "<th>Status</th>";
		// foreach($customers as $customer){
		// 	echo "<tr>";
		// 	echo "<td><input type='text' name='ID' value=".$customer->doc_id." size='1' readonly></input></td>";
		// 	$CusID = $customer->doc_id;
		// 	echo "<td>".$customer->doc_name."</td>";
		// 	echo "<td>".$customer->pt_displayname."</td>";
		// 	// echo "<td>".$customer->Service."</td>";
		// 	// echo "<td>".$customer->Date."</td>";
		// 	// echo "<td>".$customer->Address."</td>";
		// 	// echo "<td>".$customer->Phone."</td>";
		// 	// echo "<td>".$customer->Message."</td>";
		// 	// echo "<td>".$customer->status."</td>";
		// 	echo "</tr>";
		// }
		// echo "</table>";
		?>
	</div>
	<?php
	}

