<?php 
/**
 * Check wheather the user is exists or not
 * if exists 	return data
 * not exists 	return false  
 */
session_set_cookie_params(0, "/app", ".cmeworld.org");
session_start();


include('db-config.php');
include('srb-function.php');


$sql1 = "SELECT * FROM `$table_name` where email = '". $_POST['email']."'";
$count = $connection->query($sql1);
$data = $count->fetch_assoc();

if ( is_null( $data ) ){
	echo json_encode( false );
}else{
	echo json_encode($data);
	$_SESSION["name"] 	= $data['name'];
	$_SESSION["email"] 	= $data['email'];
	$_SESSION["city"] 	= $data['state'];
	$data['activity'] = "Login";
	$data['record_time'] = $_POST['created_date'];
	//srb_log($data);
	$id = srb_login_record($data, $analytics_connection);
	$_SESSION['login_id'] = $id;
	
}

?>

<?php session_write_close();?>

