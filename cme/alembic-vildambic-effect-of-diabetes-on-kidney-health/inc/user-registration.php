<?php 
/**
 * Check wheather the user is exists or not
 * if exists 	return -1
 * not exists 	return true if record created
 * 				return false if record not crreated  
 */
session_set_cookie_params(0, "/app", ".cmeworld.org");
session_start();


include('db-config.php');
include('srb-function.php');

$sql1 = "SELECT * FROM `$table_name` where email = '". $_POST['email']."'";
$count = $connection->query($sql1);
$data = $count->fetch_assoc();



if ( is_null ( $data ) ){
	$sql = 
		"
		INSERT INTO `$table_name` 
			( `name`, `email`, `mobile`, `city`, `state`, `pin_code`, `employee_sap_code`, `hq`,`level`,`zone`, `region`, `created_date`) 
		VALUES 
			( '". 
				$_POST['name'] ."', '" .
				$_POST['email'] ."', '" .
				$_POST['mobile'] ."', '" .
				$_POST['city'] ."', '" .
				$_POST['state'] ."', '" .
				$_POST['pin_code'] ."', '" .
				$_POST['employee_sap_code'] ."', '" .
				$_POST['hq'] ."', '" .
				$_POST['level'] ."', '" .
				$_POST['zone'] ."', '" .
				$_POST['region'] ."', '" .
				$_POST['created_date'] .
			"')
		" ;
	$result = $connection->query($sql);

	$_SESSION["name"] 	= $_POST['name'];
	$_SESSION["email"] 	= $_POST['email'];
	$_SESSION["city"] 	= $_POST['state'];
	
	$data = array(
			'name' => $_POST['name'],
			'email' => $_POST['email'],
			'mobile' => $_POST['mobile'],
			'city' => $_POST['city'],
			'state' => $_POST['state'],
			'pin_code' => $_POST['pin_code'],
			'employee_sap_code' => $_POST['employee_sap_code'],
			'hq' => $_POST['hq'],
			'level' => $_POST['level'],
			'zone' => $_POST['zone'],
			'region' => $_POST['region'],
			'created_date' => $_POST['created_date'],
			'activity' => "Register",
			'record_time' => $_POST['created_date']
			);
	$data['activity'] = "Register";
	$data['record_time'] = $_POST['created_date'];
	//srb_log($data);
	srb_login_record($data, $analytics_connection);
	$data['activity'] = "Login";
	$id = srb_login_record($data, $analytics_connection);
	$_SESSION['login_id'] = $id;
	echo json_encode( 1 ); 
}else{
	echo json_encode( 0 );
}

?>
<?php session_write_close();?>
