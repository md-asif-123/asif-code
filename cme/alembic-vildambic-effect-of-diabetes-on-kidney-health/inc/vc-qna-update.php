<?php 
/**
 * Update qna  
 */

session_start();


include('db-config.php');
include('srb-function.php');


	$sql = 
		"
		INSERT INTO `wp_vc_nbc_qna` 
			( `fullname`, `email`, `location`, `question`,  `website`, `page`, `created_date`) 
		VALUES 
			( '". 
				$_POST['fullname'] ."', '" . 
				$_POST['email'] ."', '" .
				$_POST['location'] ."', '" .
				$_POST['ask_question'] ."', '" .
				$_SERVER['SERVER_NAME'] ."', '" .
				$_POST['page'] ."', '" .
				$_POST['created_date'] .
			"')
		" ;
	$result = $analytics_connection->query($sql);

	echo json_encode( $result ); 


?>



