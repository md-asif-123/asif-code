<?php
        	 require_once('config.php');

        require_once('functionEmailAsif.php');

class mailTemplate{	
	
	function sendRegistrationMailTemplate($user_name, $url, $country, $regcode, $download_link, $str_supplier, $website_language='', $physical_path='', $installationDir='', $show_more='', $website_name='', $exhibition_center='', $exhibition_duration=''){		
		//$language = $this->isDirectoryExist($website_language, $physical_path, $installationDir);
		$contents = file_get_contents('registration-successful.html');
		$contents = str_replace("[[name]]", 'asif', $contents);
		
		$contents = str_replace("[[download_link]]", $download_link, $contents);
		
		return $contents;
	}
	function sendMailWithAttachment($dbh,$website_id,$user_data,$physical_path, $installationDir){
		require 'phpmailer/PHPMailerAutoload.php';
		$mail = new PHPMailer();
		$mail->SMTPAutoTLS = false;
		$mail->isSMTP();		
		
		$chl = new chl();		
		$emailInfo = $chl->getEmailInfo($dbh);
				
		$mail->Host 	= $emailInfo['smtp'];  											// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               							// Enable SMTP authentication
		$mail->Port 	= 587; //25;                                   					// TCP port to connect to
		$mail->Username = $emailInfo['email'];                 							// SMTP username
		$mail->Password = $emailInfo['password'];                           			// SMTP password
		$mail->setFrom($emailInfo['email'], $emailInfo['sender']);
		$mail->addAddress($user_data['receiver_email'], $user_data['receiver_name']);   // Add a recipient
		$mail->addAttachment('asif.pdf');
		
		
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