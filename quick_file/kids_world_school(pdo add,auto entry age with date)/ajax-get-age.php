<?php 
error_reporting(0);
function ageCalculator($dob){
    if(!empty($dob)){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        
		$years = $birthdate->diff($today)->y;
		$months = $birthdate->diff($today)->m;
		$days = $birthdate->diff($today)->d;
		
		$age = '';
		if($years > 0): $age = $years ." years "; endif;
		if($months > 0): $age .= $months ." months "; endif;
		if($days > 0): $age .= $days . " days "; endif;
		
        return $age;
    }else{
        return 0;
    }
}

$dob = date("Y-m-d",strtotime($_REQUEST['value']));
$age = ageCalculator($dob);
if($_REQUEST):
	$arr = array('age'=>$age);
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($arr);
	exit;
endif;?>