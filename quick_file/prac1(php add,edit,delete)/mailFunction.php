<?php
        	 require_once('config.php');

        require_once('functionEmailAsif.php');

class mailTemplate{	
	
	
	function sendMailWithAttachment($user_data){
		require 'phpmailer/PHPMailerAutoload.php';
		$mail = new PHPMailer();
		$mail->SMTPAutoTLS = false;
		$mail->isSMTP();		
		
		$chl = new chl();		
		$emailInfo = $chl->getEmailInfo();
				
		$mail->Host 	= $emailInfo['smtp'];  											// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               							// Enable SMTP authentication
		$mail->Port 	= 587; //25;                                   					// TCP port to connect to
		$mail->Username = $emailInfo['email'];                 							// SMTP username
		$mail->Password = $emailInfo['password'];                           			// SMTP password
		$mail->setFrom($emailInfo['email'], $emailInfo['sender']);
		$mail->addAddress($user_data['receiver_email'], $user_data['receiver_name']);   // Add a recipient
		$mail->addAttachment('asif.txt');
		
		
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = $user_data['subject'];
		$mail->Body    = $user_data['message'];
		if(!$mail->send()) {
			#return false;
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo 'Message has been sent';
			#return true;
		}
	}
}