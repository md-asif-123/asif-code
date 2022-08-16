<?php 

if(isset($_POST['SUBMIT'])):	
	
	 require_once('config.php');
        require_once('functionEmailAsif.php');

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
			
			
            $sql1="select * from registration where id=$uid";
            $stmp1=$dbh->prepare($sql1);
            $stmp1->execute();
			$result = $stmp1->fetch(PDO::FETCH_ASSOC);
            $msg=$result['msg']; 			
				
			$subject = 'You have successfully registered ';
			$message = '<html><body>';				
		    $message .= '<h1 style="color:#000000;text-align:left">Your Message: '.$msg.'</h1>';
			$message .= '<h1 style="color:#000000;text-align:left">Thank you for your registration.</h1>';		
			
			$message .= '</body></html>';
		
		
		
		
		
		$emailInfo = $chl->getEmailInfo($dbh);
			/*echo $emailInfo['smtp'];
			echo $emailInfo['email'];
			echo $emailInfo['sender'];
			echo $emailInfo['password'];
			echo $email;*/
			//$host=urlencode($emailInfo['smtp']);
			//echo $host;exit;
		$fields = array(
			'host' => urlencode($emailInfo['smtp']),	
			'sender' => urlencode($emailInfo['email']),
			'sender_name' => urlencode($emailInfo['sender']),
			'password' => urlencode($emailInfo['password']),
			'receiver' => urlencode($email),
			//'receiver_name' => urlencode($fname.' '.$surname),
			'subject' => urlencode($subject),
			'body' => urlencode($message),
			//'aBody' => urlencode($altMessage)
		);	
		
		
		$smtpMail = new smtpMail();
		$smtpMail->httpPost($emailSmtpUrlServer,$fields);
		
		
		echo "message sent";
	endif;




?>


<html>
<body>
<form name='regForm' action='contact.php' method='post' enctype='multipart/form-data'>
<table align='center' border='1'>



<tr><td>Email</td><td><input size="66" type='text' name='email'></td></tr>
<tr><td>Message</td><td><textarea rows="4" cols="50" name='msg'></textarea></td></tr>

<tr><td><input type='submit' name='SUBMIT' value='SEND'></td></tr>
</table>
</form>
</body>
</html> 

