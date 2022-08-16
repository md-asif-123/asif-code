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





