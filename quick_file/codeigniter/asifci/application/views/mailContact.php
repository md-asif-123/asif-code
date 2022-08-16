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
			
			$download_link ='<div> <a href="http://localhost/mailAsif2/download.php" style="text-align:center;background: #48a13a;padding: 10px 0; display:block; color:#fff; text-decoration:none;">Downloading</a> </div>';
			
			$message = $mailTemplate->sendRegistrationMailTemplate($name,$site_url,$country, $code, $download_link, $str_supplier, $website_language,$physical_path,$installationDir,$show_more,$website_name,$exhibition_center,$exhibition_duration);
			
			$message .= '<h1 style="color:#000000;text-align:left">Your Message: '.$msg.'</h1>';
			$subject = $altMessage = 'Registration successful';
			$message = html_entity_decode($message,ENT_QUOTES);	
			
			$user_data = array(
								'receiver_email' => $email,
								'receiver_name' => 'asif',
								'subject' => $subject,
								'message' => $message,								
								//'files' => array($pdfPhysicalPath.$code.'.pdf')
							  );
			
			$mailTemplate->sendMailWithAttachment($dbh,$website_id,$user_data,$physical_path,$installationDir);
		
		
		
		$this->load->view("registration-successful1");exit;
	endif;




?>


<html>
<body>
<form name='regForm' action='<?php echo base_url();?>index.php/index/generateMail' method='post' enctype='multipart/form-data'>
<table align='center' border='1'>



<tr><td>Email</td><td><input size="66" type='text' name='email'></td></tr>
<tr><td>Message</td><td><textarea rows="4" cols="50" name='msg'></textarea></td></tr>

<tr><td><input type='submit' name='SUBMIT' value='SEND'></td></tr>
</table>
</form>
</body>
</html> 

