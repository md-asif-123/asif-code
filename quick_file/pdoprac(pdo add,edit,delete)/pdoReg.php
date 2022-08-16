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
			$sql = "INSERT INTO `registration` (`name`, `class`, `age`, `address`,`gender`) 
			VALUES (:fname,:class,:age,:address,:gender)";
			$stmt = $dbh->prepare( $sql );
			$count=$stmt->execute(array(':fname'=>$fname,':class'=>$class,':age'=>$age,':address'=>$address,':gender'=>$gend));
			  $uid=$dbh->lastInsertId();
			  
			  foreach($hobby as $h)
			  {
			  $sql = "INSERT INTO `hobby` (`uid`, `hobby`) 
			VALUES (:uid,:hobby)";
			$stmt = $dbh->prepare( $sql );
			$count=$stmt->execute(array(':uid'=>$uid,':hobby'=>$h));
			  }
				header("location: table.php");
			
			
			}
			
	endif;
	
	
}
?>
<html>

<body>

<form name='regForm' method='post' action='pdoReg.php'>
<table border='2' width='70%' align='center' cellpadding='6' cellspacing='6'>
<tr><td colspan='2' align='center' bgcolor='#cccccc'><b>School Registration Form</b></td></tr>
<tr><td>Name</td><td><input type='text' name='fname' /></td></tr>
<tr><td>Class</td><td><input type='text' name='class' /></td></tr>
<tr><td>Age</td><td><input type='text' name='age' /></td></tr>
<tr><td>Address</td><td><input type='text' name='address' /></td></tr>
<tr><td>Gender</td><td><input type='radio' name='gend' value='m'>Male<input type='radio' name='gend' value='f'>Female</td></tr>
<tr><td>Hobby</td><td><input type='checkbox' name='hobby[]' value='cricket'>Cricket<input type='checkbox' name='hobby[]' value='football'>Football
<input type='checkbox' name='hobby[]' value='swimming'>Swimming</tr>
<tr><td>Uplaod Photo</td><td><input type='file' name='pic'></td></tr>
<tr><td colspan='2' align='right' bgcolor='#cccccc'><input type='submit' name='submit' value='SUBMIT'/></td></tr>
</table>
</form>
</body>
</html>
