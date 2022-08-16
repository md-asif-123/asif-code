<?php 

class chl {
	
	function getEmailInfo(){
		$sql= "SELECT email, password, smtp, sender FROM email_accounts where website_id = 1 and status = 1 limit 0,1";
		
		$rec=mysql_query($sql);
		$row=mysql_fetch_assoc($rec);
		//print_r()
		if($row>0)
		{
			return $row;
		}
		else
		{
			return false;
		}
		//echo $website_id;exit;
		//return $row;
		
	}	
}
$chl = new chl();





