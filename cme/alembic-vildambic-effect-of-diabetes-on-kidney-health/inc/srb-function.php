<?php 

function srb_view_record( $arg, $analytics_connection ){

	$partial_url = explode("/", $_SERVER['REQUEST_URI']); //  "/rv-14thNov/inc/user-login.php"
	$event_slug = $partial_url[1]; //rv-14thNov

	$sql = 
		"
		INSERT INTO `wp_vc_login_record` 
			( `email`, `website`, `page`, `action`,  `created_date`) 
		VALUES 
			( '". 
				$arg['email'] ."', '" . 
				$_SERVER['SERVER_NAME'] ."', '" .
				$event_slug."', '" .
				$arg['activity'] ."', '" .
				$arg['record_time'] .
			"')
		" ;
	$result = $analytics_connection->query($sql);
	$id = $analytics_connection->insert_id;
	return $id;

}

function srb_login_record( $arg, $analytics_connection ){

	$partial_url = explode("/", $_SERVER['REQUEST_URI']); //  "/rv-14thNov/inc/user-login.php"
	$event_slug = $partial_url[1]; //rv-14thNov

	$sql = 
		"
		INSERT INTO `wp_vc_login_record` 
			( `email`, `website`, `page`, `action`,  `created_date`) 
		VALUES 
			( '". 
				$arg['email'] ."', '" . 
				$_SERVER['SERVER_NAME'] ."', '" .
				$event_slug."', '" .
				$arg['activity'] ."', '" .
				$arg['record_time'] .
			"')
		" ;
	$result = $analytics_connection->query($sql);
	$id = $analytics_connection->insert_id;
	return $id;

}

function srb_logout_record( $arg, $analytics_connection ){

	$partial_url = explode("/", $_SERVER['REQUEST_URI']); //  "/rv-14thNov/inc/user-login.php"
	$event_slug = $partial_url[1]; //rv-14thNov

	// $sql = 
	// 	"
	// 	INSERT INTO `wp_vc_login_record` 
	// 		( `email`, `website`, `page`, `action`,  `created_date`) 
	// 	VALUES 
	// 		( '". 
	// 			$arg['email'] ."', '" . 
	// 			$_SERVER['SERVER_NAME'] ."', '" .
	// 			$event_slug."', '" .
	// 			$arg['activity'] ."', '" .
	// 			$arg['record_time'] .
	// 		"')
	// 	" ;
	$sql = "UPDATE wp_vc_login_record SET logout_time = '". $arg['record_time'] . "' WHERE id= '". $arg['login_id'] . "'";

	$result = $analytics_connection->query($sql);
	//echo $sql;
	//$id = $analytics_connection->insert_id;
	//return $id;

}


function srb_mark_attendence($arg, $analytics_connection ){
	$sql = 
		"
		INSERT INTO `wp_vc_nbc_attendence` 
			( `fullname`, `email`, `website`, `page`, `created_date`) 
		VALUES 
			( '". 
				$arg['username'] ."', '" . 
				$arg['email'] ."', '" .
				$arg['home_url']."', '" .
				$arg['page_slug'] ."', '" .
				$arg['record_time'] .
			"')
		" ;
	$result = $analytics_connection->query($sql);
}

// function srb_log($log_msg)
// {
//     $log_filename = $_SERVER['DOCUMENT_ROOT']."/log";
//     if (!file_exists($log_filename)) 
//     {
//         // create directory/folder uploads.
//         mkdir($log_filename, 0777, true);
//     }
//     $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
//     // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
//     file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
// } 


?>