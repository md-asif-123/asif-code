<?php
	//$GLOBALS['association_slug'] = "LVPEI";

	function divi_style(){
		//wp_enqueue_style("divi_style",get_stylesheet_directory_uri()."/css/divistyle.css");
		// wp_enqueue_style("divi_child_style",get_stylesheet_directory_uri()."/css/divichildstyle.css");
		// wp_enqueue_style("ogdocmode_style",get_stylesheet_directory_uri()."/css/ogstyle.css");
		// wp_enqueue_style("ogdocmode_style","//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css");	
		// <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		wp_enqueue_script("jquery3.6_script","https://code.jquery.com/jquery-3.6.0.min.js");	
		wp_enqueue_script("custom_script",get_stylesheet_directory_uri()."/js/custom.js");
		wp_localize_script( 'custom_script', 'ajax_param', array(
		    'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', 
		    'nonce'    => wp_create_nonce ( 'custom_script_nonce' )
		) );

	}
	add_action('wp_enqueue_scripts', 'divi_style');
	require_once(get_stylesheet_directory().'/includes/saurabh/code.php');
	require_once(get_stylesheet_directory().'/includes/asif/acode.php');


	/* Start of code to get user data from LMS */
	function srb_userBridge() {  
	$userdata = array();  
	    if ( is_user_logged_in() ) {
	        $current_user = wp_get_current_user();
	        $LMS_user_data = srb_get_LMS_userdata($current_user->user_email);
	        if ( isset ( $LMS_user_data[0] ) ){
	        $userdata["userID"] = $LMS_user_data[0]['value'][0]['user_id'];
	        $userdata["userType"] = $LMS_user_data[0]['value'][0]['user_type'];
	      }
	    }
	    return $userdata;
	}

	function srb_get_LMS_userdata($email){
    $api_data = wp_remote_retrieve_body(wp_remote_get("http://learn.docmode.org/api/v1/user_basic_data/".$email));        
    $json_api_data = json_decode($api_data,true);
    //print_r($json_api_data);
    return $json_api_data;
	}
	/* End of code to get user data from LMS */


  function mns_get_drug_therepistt(){
	  check_ajax_referer('srb_common_page_nonce', 'nonce');
	  $apiurl = "https://learn.docmode.org/api/v1/user_data_username/" .  $_POST['search_key'];
	  $response = wp_remote_retrieve_body ( wp_remote_get($apiurl) );
	  // $result = json_decode ( $response );
	  echo $response;   // to print response in console
	  die();
  }

  add_action( 'wp_ajax_nopriv_mns_get_drug_therepistt', 'mns_get_drug_therepistt' );
  add_action( 'wp_ajax_mns_get_drug_therepistt', 'mns_get_drug_therepistt' );



	/* country dropdown */
	function asf_country_list_dropdown() {
			$coutries = array( "IN" => "India" );
			return $coutries;
	}

	/* state dropdown */
	function asf_state_list_dropdown() {
	//$coutries = array( "FR" => "France", "ES" => "Spain" );
		$choice = $_POST['parent_option'];
				switch($choice) {
					case "IN":
				$states = array (
				'AP' => 'Andhra Pradesh',
				'AR' => 'Arunachal Pradesh',
				'AS' => 'Assam',
				'BR' => 'Bihar',
				'CT' => 'Chhattisgarh',
				'GA' => 'Goa',
				'GJ' => 'Gujarat',
				'HR' => 'Haryana',
				'HP' => 'Himachal Pradesh',
				'JK' => 'Jammu & Kashmir',
				'JH' => 'Jharkhand',
				'KA' => 'Karnataka',
				'KL' => 'Kerala',
				'MP' => 'Madhya Pradesh',
				'MH' => 'Maharashtra',
				'MN' => 'Manipur',
				'ML' => 'Meghalaya',
				'MZ' => 'Mizoram',
				'NL' => 'Nagaland',
				'OR' => 'Odisha',
				'PB' => 'Punjab',
				'RJ' => 'Rajasthan',
				'SK' => 'Sikkim',
				'TN' => 'Tamil Nadu',
				'TR' => 'Tripura',
				'TS' => 'Telangana',
				'UK' => 'Uttarakhand',
				'UP' => 'Uttar Pradesh',
				'WB' => 'West Bengal',
				'AN' => 'Andaman & Nicobar',
				'CH' => 'Chandigarh',
				'DN' => 'Dadra and Nagar Haveli',
				'DD' => 'Daman & Diu',
				'DL' => 'Delhi',
				'LD' => 'Lakshadweep',
				'PY' => 'Puducherry',
				);
				break;
				default:

				$states = array("no state");
			}
		return $states;
	}

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}

