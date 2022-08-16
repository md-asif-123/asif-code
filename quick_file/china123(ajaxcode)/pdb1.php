<?php
require_once('config.php');
$firstname=$_POST['n'];
$email=$_POST['e'];
$mobile=$_POST['m'];
$pro1=$_POST['p1'];
$pro2=$_POST['p2'];
$pro3=$_POST['p3'];
$pro4=$_POST['p4'];
$quant1=$_POST['q1'];
$quant2=$_POST['q2'];
$quant3=$_POST['q3'];
$quant4=$_POST['q4'];
$quant=$_POST['q'];
$date=$_POST['d'];
	
	
		
			
	
			$sql = "INSERT INTO `enquiry` (`firstname`,`email`,`mobile_no`,`product1`,`product2`,`product3`,`product4`,
			`quantity1`,`quantity2`,`quantity3`,`quantity4`,`quantity`,`date`) 
			VALUES (:firstname,:email,:mobile,:pro1,:pro2,:pro3,:pro4,:quant1,:quant2,:quant3,:quant4,:quant,:date)";
			$stmt = $dbh->prepare( $sql );
			//print_r($stmt);exit;
			$stmt->execute(array(':firstname'=>$firstname,':email'=>$email,':mobile'=>$mobile,
			':pro1'=>$pro1,':pro2'=>$pro2,':pro3'=>$pro3,':pro4'=>$pro4,':quant1'=>$quant1,':quant2'=>$quant2,':quant3'=>$quant3,':quant4'=>$quant4,':quant'=>$quant,':date'=>$date));
			//print_r($stmt);exit;
			
			
	
	
	

?>