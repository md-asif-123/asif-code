<?php 

if(isset($_POST['SUBMIT'])):	
	
	 //require_once('config.php');
        require_once('mailFunction.php');

	        $email=$_POST['email'];
	        $msg=$_POST['msg'];
			
			$sql="insert into registration(msg) VALUES ('$msg')";
			$stmt=$dbh->prepare($sql);
			$count=$stmt->execute();
			$uid=$dbh->lastInsertId();
			//echo $uid;
			if($count>0):
			    echo 'inserted successfully';
				else:
				echo 'not inserted';
			endif;
			
			$mailTemplate = new mailTemplate();
			
            $sql1="select * from registration where id=$uid";
            $stmp1=$dbh->prepare($sql1);
            $stmp1->execute();
			$result = $stmp1->fetch(PDO::FETCH_ASSOC);
            $msg=$result['msg']; 			
				
			$subject = 'You have successfully registered from mailContact ';
			$message = '<html><body>';				
		    $message .= '<h1 style="color:#000000;text-align:left">Your Message: '.$msg.'</h1>';
			$message .= '<h1 style="color:#000000;text-align:left">Thank you for your registration.</h1>';		
			$message .= '<a href="http://localhost/mailAsif2/download.php" style="text-align:center;background: #48a13a;padding: 10px 0; display:block; color:#fff; text-decoration:none;">Downloading</a>';
			$message .= '</body></html>';
		
		
		
		
			
			$user_data = array(
								'receiver_email' => $email,
								'receiver_name' => 'asif',
								'subject' => $subject,
								'message' => $message,								
								//'files' => array($pdfPhysicalPath.$code.'.pdf')
							  );
			
			$mailTemplate->sendMailWithAttachment($dbh,$website_id,$user_data,$physical_path,$installationDir);
		
		
		
		echo "message sent";
	endif;




?>


<html>
<body>
<form name='regForm' action='mailContact.php' method='post' enctype='multipart/form-data'>
<table align='center' border='1'>



<tr><td>Email</td><td><input size="66" type='text' name='email'></td></tr>
<tr><td>Message</td><td><textarea rows="4" cols="50" name='msg'></textarea></td></tr>

<tr><td><input type='submit' name='SUBMIT' value='SEND'></td></tr>
</table>
</form>
</body>
</html> 

