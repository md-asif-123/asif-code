<?php
require_once('lib/config.php');
ini_set('max_execution_time', 0);
$username_admin = isset($_SESSION["username_admin"]) ;
if(!empty($_POST)):
	if(!empty($_REQUEST)):
		foreach($_REQUEST as $variable => $value):
			$$variable = $value;
		endforeach;
	endif;
	
function filterData(&$str)
	{
		$str = preg_replace("/\t/", "\\t", $str);
		$str = preg_replace("/\r?\n/", "\\n", $str);
		if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
	}	
	$from_date = explode('.',$fromdate);		
	//$fromdate = $from_date[2].'-'.$from_date[1].'-'.$from_date[0];
	$txt_fromdate = date('Y-m-d',strtotime($fromdate));
	
	$to_date = explode('.',$todate);
	$txt_todate = date('Y-m-d',strtotime($todate));
	
	##############################################################################
	/*$txt_from_date = explode('/',str_replace("--","",$fromdate));		
	echo $txt_fromdate = $txt_from_date[2].'-'.$txt_from_date[0].'-'.$txt_from_date[1];	die;
	$txt_to_date = explode('/',str_replace("--","",$todate));
	$txt_todate = $txt_to_date[2].'-'.$txt_to_date[0].'-'.$txt_to_date[1];*/
	##############################################################################
	if($type==0):
	
		$header = array('Code','Title','Fname','Lname','Surname','Contact No','Mobile Number','Age Group','Nationality','Email','Country','City','Refer','product Type','Business Type','Added On');
		
		$filename= "register-$fromdate-$todate.xls";
		$sql = "SELECT `code`, `title`, `fname`, `lname`, `surname`, `contact_no`, `mobile_no`, `age_group`, `nationality`, `email`, `country`, `city`, `refer`, `product_type`, `business_type`, 
				`addedon` FROM `register` where country_id=".$_SESSION["country_id"]." 
				AND (( `addedon` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
							 (`addedon` LIKE '%".$txt_todate."%') OR 
							 (`addedon` LIKE '%".$txt_fromdate."%')) order by id desc"; 
	elseif($type==1):
	
		$header = array('Code','Title','Fname','Lname','Surname','Email','Contact No','Mobile No','Age Group','Nationality',
						'Company Name','Job Title','City','Province','Country','Refer','Purchasing Authority', 
						'Turnover from China','Import from China', 'Sourcing from China',
						'Match Making Process','Added On');
						
			
		$filename= "vip_register-$fromdate-$todate.xls";	
		
		$sql = "SELECT `code`, `title`, `fname`, `lname`, `surname`, `email`, `contact_no`, `mobile_no`, `age_group`,`nationality`, 
					   `company_name`, `job_title`, `city`, `province`, `country`, `refer`,`purchasing_authority`, 
					   `turnover_from_china`, `import_from_china`, `sourcing_from_China`, 
					   `match_making_process`, `addedon` 
				FROM `vip_register`  
				WHERE country_id=".$_SESSION["country_id"]." 
				AND (( `addedon` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
					 (`addedon` LIKE '%".$txt_todate."%') OR 
					 (`addedon` LIKE '%".$txt_fromdate."%')) order by id desc";	
					 
	elseif($type==2):
	
		$header = array('Code','Name','Email','Mobile Number','Age Group','Nationality','Product Type',
						'Start Date and time','End Date and time','Comments','Added On');
						
		$filename= "match_making-$fromdate-$todate.xls";
		
		$sql = "SELECT `code`, `fname`, `email`, `mobile_no`, `age_group`, `nationality`, `product_type`, 
				`date_time_start`, `date_time_end`, `comments`,`addedon`
				FROM `match_making`
				WHERE country_id=".$_SESSION["country_id"]."
				AND ((`addedon` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
					 (`addedon` LIKE '%".$txt_todate."%') OR 
					 (`addedon` LIKE '%".$txt_fromdate."%')
					 ) order by id desc";
					 
	elseif($type==3):
	
		$header = array('Name','Email','Mobile Number','Age Group','Nationality','Product Type',
						'Start Date and time','End Date and time','Comments','Code','Added On');
						
		$filename= "schedule_meeting-$fromdate-$todate.xls";
		$sql = "SELECT `code`, `fname`, `email`, `mobile_no`, `age_group`, `nationality`, `product_type`, 
				`date_time_start`, `date_time_end`, `comments`,`addedon` 
				FROM `schedule_meeting`
				WHERE country_id=".$_SESSION["country_id"]."
				AND ((`date_time_end` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
					 (`date_time_end` LIKE '%".$txt_todate."%') OR 
					 (`date_time_end` LIKE '%".$txt_fromdate."%')
					 ) order by id desc";	
					 
				
	elseif($type==4):
	
		$header = array('Code','Fname','Surname','Email','Contact Number','Mobile Number','Age group','nationality','Country','City','Refer Email','Company Name','Product Category','Added On');
		$filename= "callcenter_registration-$fromdate-$todate.xls";
		$sql = "SELECT `code`, `fname`, `surname`, `email`, `contact_no`, `mobile_no`, `age_group`, `nationality`, `country`, `city`, `refer`, `business_type`, `product_type`, `addedon` FROM `callcenter_registration` 
				WHERE country_id=".$_SESSION["country_id"]."
				AND (( `addedon` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
					 (`addedon` LIKE '%".$txt_todate."%') OR 
					 (`addedon` LIKE '%".$txt_fromdate."%')) order by id desc";
			
	elseif($type==5):
	
		$header = array('Fname','ContactNumber','Email','Contact Number','Mobile Number','Age group','nationality','Publication','JobTitle','Comments','Information','MoreInformation','Added On');
		$filename= "Media_registration-$fromdate-$todate.xls";
		$sql = "SELECT `fullname`,`contact_no`,`email`,`mobile_no`,`age_group`,`nationality`,`publication`,`job_title`,`comments`,`information`,`is_receive_info`,`created_date` FROM `media_registration` 
				WHERE website_id=".$_SESSION["country_id"]."
				AND ((`created_date` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
					 (`created_date` LIKE '%".$txt_todate."%') OR 
					 (`created_date` LIKE '%".$txt_fromdate."%')) order by id desc";
	
	
	elseif($type==6):
	
		$header = array('Name','Email','Contact Number','Added On');
		$filename= "Popup_registration-$fromdate-$todate.xls";
		$sql = "SELECT `fname`,`email`,`contact_no`,`mobile_no`,`addedon` FROM `register` 
				WHERE country_id=".$_SESSION["country_id"]." AND (`surname` = '' AND `business_type` = '' AND `email` != '') 
				AND `email` not in ('nazir@hayat.in','nazirmallick39@gmail.com','md.asif.558@gmail.com','aleem@hayat.in',
				'ekbul@hayat.in','hassanekbul786@gmail.com') 
				AND ((`addedon` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
					 (`addedon` LIKE '%".$txt_todate."%') OR 
					 (`addedon` LIKE '%".$txt_fromdate."%')) order by id desc";
					 
	elseif($type==7):
	
		$header = array('Name','Email','Company_name');
						
		$filename= "brochure_form-$fromdate-$todate.xls";
		
		$sql = "SELECT `name`, `email`, `company_name`
				FROM `brochure_form`
				WHERE ((`addedon` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
					 (`addedon` LIKE '%".$txt_todate."%') OR 
					 (`addedon` LIKE '%".$txt_fromdate."%')
					 ) order by id desc";
	endif;
	
	header('Content-Disposition: attachment; filename='.$filename);
	header("Content-Type: application/vnd.ms-excel;charset=utf-8");
		
	
	
	// fetch the data
	$stmt = $dbh->prepare( $sql );
	$stmt->execute();	
	$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
	//print_r($records);exit;
	$flag = false;	
	foreach($records as $record):		
			if(!$flag) {			
			echo implode("\t", array_values($header)) . "\n";
			$flag = true;
		}		
		array_walk($row, 'filterData');
		echo implode("\t", array_values($record)) . "\n";		
	endforeach;
	#header('location: csvrepoort.php');
	//exit;	
endif;

?>