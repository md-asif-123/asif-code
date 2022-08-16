<?php
require_once('config.php');

if(!empty($_POST)){	
	foreach($_POST as $variable => $value){
		 ${$variable} = $value;
	}
	
	if($submit):	
		if($fname == ""){
			$_SESSION['error_msg'] = "Please enter your name correctly.";
			echo $_SESSION['error_msg'];
			
		}elseif($class == ""){
			$_SESSION['error_msg'] = "Please enter the class.";
			echo $_SESSION['error_msg'];
		}
		elseif($age == ""){
			$_SESSION['error_msg'] = "Please enter your age.";
			echo $_SESSION['error_msg'];
		}elseif($address == ""){
			$_SESSION['error_msg'] = "Please enter your address";
			echo $_SESSION['error_msg'];
		}		
		else{	
			 $sql = "UPDATE `registration` SET `name` = '".$fname."', `class` = '".$class."', `age` = '".$age."',address='".$address."',gender='".$gend."' WHERE `id` = '".$id."'";		
		//exit;
		$stmt = $dbh->prepare( $sql );
		$stmt->execute();
			   echo '<pre>';
			   print_r($_REQUEST);
			   $sql1="DELETE FROM `hobby` WHERE `uid` = '".$id."'";
			   echo $sql1;
			   $stmt1 = $dbh->prepare( $sql1 );
		$stmt1->execute();
			   foreach($_REQUEST['hobby'] as $h):
			  
				 echo $h; 
				 //$sql="UPDATE `hobby` SET `hobby` = '".$h."' WHERE `uid` = '".$id."'";	
			  $sql = "INSERT INTO `hobby` SET `hobby` = '".$h."',uid='".$id."' ";
              echo $sql;			  
		//exit;
		$stmt = $dbh->prepare( $sql );
		$stmt->execute();
			  endforeach;
			  
				header("location: table.php");
			
			
			}
			
	endif;
	
	
}
?>

