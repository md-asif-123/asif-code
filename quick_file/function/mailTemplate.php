<?php
class mailTemplate{	
	#####Mail template send to all when there is machinex and registration is completed###### 
	function sendRegistrationMailMachinexTemplate($user_name, $url, $country, $regcode, $download_link, $str_supplier, $website_language='', $physical_path='', $installationDir='', $show_more='', $website_name='', $exhibition_center='', $exhibition_duration=''){		
		$language = $this->isDirectoryExist($website_language, $physical_path, $installationDir);
		$contents = file_get_contents($url.'locale/'.$language.'/email/registration-successful-machinex.html');
		$contents = str_replace("[[name]]", $user_name, $contents);
		$contents = str_replace("[[url]]", $url, $contents);		
		$contents = str_replace("[[country]]", $country, $contents);
		$contents = str_replace("[[regcode]]", $regcode, $contents);
		$contents = str_replace("[[barimg]]", $barimg, $contents);
		$contents = str_replace("[[qrimg]]", $qrimg, $contents);
		$contents = str_replace("[[download_link]]", $download_link, $contents);
		$contents = str_replace("[[str_supplier]]", $str_supplier, $contents);
		$contents = str_replace("[[show_more]]", $show_more, $contents);
		$contents = str_replace("[[website_name]]", $website_name, $contents);
		$contents = str_replace("[[exhibition_center]]", $exhibition_center, $contents);
		$contents = str_replace("[[exhibition_duration]]", $exhibition_duration, $contents);
		return $contents;
	}
	
	#####Mail template send to all when machinex have no url and registration is completed######
	function sendRegistrationMailTemplate($user_name, $url, $country, $regcode, $download_link, $str_supplier, $website_language='', $physical_path='', $installationDir='', $show_more='', $website_name='', $exhibition_center='', $exhibition_duration=''){		
		$language = $this->isDirectoryExist($website_language, $physical_path, $installationDir);
		$contents = file_get_contents($url.'locale/'.$language.'/email/registration-successful.html');
		$contents = str_replace("[[name]]", $user_name, $contents);
		$contents = str_replace("[[url]]", $url, $contents);		
		$contents = str_replace("[[country]]", $country, $contents);
		$contents = str_replace("[[regcode]]", $regcode, $contents);
		$contents = str_replace("[[barimg]]", $barimg, $contents);
		$contents = str_replace("[[qrimg]]", $qrimg, $contents);
		$contents = str_replace("[[download_link]]", $download_link, $contents);
		$contents = str_replace("[[str_supplier]]", $str_supplier, $contents);
		$contents = str_replace("[[show_more]]", $show_more, $contents);
		$contents = str_replace("[[website_name]]", $website_name, $contents);
		$contents = str_replace("[[exhibition_center]]", $exhibition_center, $contents);
		$contents = str_replace("[[exhibition_duration]]", $exhibition_duration, $contents);
		return $contents;
	}
	
	function isDirectoryExist($website_language, $physical_path, $installationDir){		
		if(($website_language != '')):
			$file_path = $physical_path.$installationDir.'locale/'.$website_language;			
			if (file_exists($file_path)):
				$language = $website_language;
			else:
				$language = 'en';
			endif;
		else:
			$language = 'en';	
		endif;		
		return $language;
	}
	
	function sendMailWithAttachment($dbh,$website_id,$user_data,$physical_path, $installationDir){
		require 'phpmailer/PHPMailerAutoload.php';
		$mail = new PHPMailer();
		$mail->SMTPAutoTLS = false;
		$mail->isSMTP();		
		
		$chl = new chl();		
		$emailInfo = $chl->getEmailInfo($website_id,$dbh);
				
		$mail->Host 	= $emailInfo['smtp'];  											// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               							// Enable SMTP authentication
		$mail->Port 	= 587; //25;                                   					// TCP port to connect to
		$mail->Username = $emailInfo['email'];                 							// SMTP username
		$mail->Password = $emailInfo['password'];                           			// SMTP password
		$mail->setFrom($emailInfo['email'], $emailInfo['sender']);
		$mail->addAddress($user_data['receiver_email'], $user_data['receiver_name']);   // Add a recipient
		
		if(isset($user_data['files'])):
			if(count($user_data['files']) > 0):
				foreach($user_data['files'] as $filepath):
					if($filepath):
						$mail->addAttachment($filepath);
					endif;
				endforeach;
			endif;
		endif;
		
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