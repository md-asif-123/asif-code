<?php 

class chl {
	
	function getEmailInfo($dbh){
		$sql= "SELECT email, password, smtp, sender FROM email_accounts where website_id = 1 and status = 1 limit 0,1";
		
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		//echo $website_id;exit;
		return $result;
	}	
}
$chl = new chl();

class smtpMail{
	//echo $url;
	function httpPost($url,$fields){		
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');	 
		$ch = curl_init();	
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_HEADER, false);
		$output=curl_exec($ch);					
		$err = false;
		$err_msg = '';
		if($output === false) { 			
			$err_msg = 'Error: ' . curl_errno($ch).' '. curl_error($ch); 
			$err = true;
		}
		curl_close($ch);
		if($err == 'true'):
			return $err_msg;
		else:
			return $output;
		endif;	
	}
	
	
}



