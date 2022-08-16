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
	$from_date = explode('.',$fromdate);
   //print_r($from_date);
	$fromdate = $from_date[2].'-'.$from_date[1].'-'.$from_date[0];
	//echo $fromdate;exit;
	$to_date = explode('.',$todate);
	$todate = $to_date[2].'-'.$to_date[1].'-'.$to_date[0];
	
	##############################################################################
	$txt_from_date = explode('/',str_replace("--","",$fromdate));	
     //print_r($txt_from_date);exit;
	$txt_fromdate = $txt_from_date[2].'-'.$txt_from_date[0].'-'.$txt_from_date[1];	
	//echo $txt_fromdate;exit;
	$txt_to_date = explode('/',str_replace("--","",$todate));
	$txt_todate = $txt_to_date[2].'-'.$txt_to_date[0].'-'.$txt_to_date[1];
	##############################################################################
	if($type==0):
	    $header = array('Code','Title','Fname','Lname','Surname','Contact No','Email','Country','City','Refer','product Type','Product Id','Business Type','Apply Vip','Added On');
		$filename= "register-$fromdate-$todate.xls";
		$sql = "SELECT `code`, `title`, `fname`, `lname`, `surname`, `contact_no`, `email`, `country`, `city`, `refer`, `product_type`, `product_id`, `business_type`, `apply_vip`, 
				`addedon` FROM `register` where country_id=".$_SESSION["country_id"]."
				AND (( `addedon` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
							 (`addedon` LIKE '".$txt_todate."%') OR 
							 (`addedon` LIKE '".$txt_fromdate."%')) ";
	elseif($type==1):
		$header = array('Code','Title','Fname','Lname','Surname','Contact No','Mobile No',
						'Company Name','Job Title','City','Province','Country','Refer',
						'Status','Product Status','Email','Benefits','Qualification','Purchasing Authority', 
						'Turnover from China','Import from China', 'Sourcing from China',
						'Match Making Process','Scope','Added On', 'Active ID');
		$filename= "vip_register-$fromdate-$todate.csv";		
		$sql = "SELECT `code`, `title`, `fname`, `lname`, `surname`, `contact_no`, `mobile_no`, 
					   `company_name`, `job_title`, `city`, `province`, `country`, `refer`,
					   `status`,`productstatus`,`email`,`benefits`,`qualification`,`purchasing_authority`, 
					   `turnover_from_china`, `import_from_china`, `sourcing_from_China`, 
					   `match_making_process`, `scope`, `addedon`, `active_id` 
				FROM `vip_register`  
				WHERE country_id=".$_SESSION["country_id"]." 
				AND (( `addedon` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
					 (`addedon` LIKE '".$txt_todate."%') OR 
					 (`addedon` LIKE '".$txt_fromdate."%')) ";						 
	elseif($type==2):
		$header = array('Name','Email','Product Type','Product ID',
						'Start Date and time','End Date and time','Comments','Code','Scope');
		$filename= "match_making-$fromdate-$todate.csv";
		$sql = "SELECT `fname`, `email`, `product_type`, `product_id`, 
				`date_time_start`, `date_time_end`, `comments`, `code`, `scope` 
				FROM `match_making`
				WHERE country_id=".$_SESSION["country_id"]."
				AND ((`date_time_start` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
					 (`date_time_start` LIKE '".$txt_todate."%') OR 
					 (`date_time_start` LIKE '".$txt_fromdate."%') OR 
					 (`date_time_end` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
					 (`date_time_end` LIKE '".$txt_todate."%') OR 
					 (`date_time_end` LIKE '".$txt_fromdate."%')
					 ) ";
	elseif($type==3):
		$header = array('Name','Email','Product Type','Product ID',
						'Start Date and time','End Date and time','Comments','Code','Scope');
		$filename= "schedule_meeting-$fromdate-$todate.csv";
		$sql = "SELECT `fname`, `email`, `product_type`, `product_id`, 
				`date_time_start`, `date_time_end`, `comments`, `code`, `scope` 
				FROM `schedule_meeting`
				WHERE country_id=".$_SESSION["country_id"]."
				AND ((`date_time_start` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
					 (`date_time_start` LIKE '".$txt_todate."%') OR 
					 (`date_time_start` LIKE '".$txt_fromdate."%') OR 
					 (`date_time_end` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
					 (`date_time_end` LIKE '".$txt_todate."%') OR 
					 (`date_time_end` LIKE '".$txt_fromdate."%')
					 ) ";	
	elseif($type==4):
		$header = array('Code','Fname','Surname','Email','Added On');
		$filename= "callcenter_registration-$fromdate-$todate.csv";
		$sql = "SELECT `code`, `fname`, `surname`, `email`, `addedon` FROM `callcenter_registration` 
				WHERE country_id=".$_SESSION["country_id"]."
				AND (( `addedon` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
					 (`addedon` LIKE '".$txt_todate."%') OR 
					 (`addedon` LIKE '".$txt_fromdate."%')) ";	
	
	elseif($type==5):
		$header = array('Fname','ContactNumber','Email','MobileNumber','Publication','JobTitle','Comments','Information','MoreInformation','Added On');
		$filename= "Media_registration-$fromdate-$todate.csv";
		$sql = "SELECT `fullname`,`contact_no`,`email`,`mobile_no`,`publication`,`job_title`,`comments`,`information`,`is_receive_info`,`created_date` FROM `media_registration` 
				WHERE website_id=".$_SESSION["country_id"]."
				AND ((`created_date` BETWEEN '".$txt_fromdate."' AND '".$txt_todate."') OR 
					 (`created_date` LIKE '".$txt_todate."%') OR 
					 (`created_date` LIKE '".$txt_fromdate."%')) ";
	endif;
	
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename='.$filename);
		
	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');
	
	// output the column headings
	fputcsv($output, $header);
	
	// fetch the data
	$stmt = $dbh->prepare( $sql );
	$stmt->execute();	
	$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($records as $record):
		if($type==0):
			$table = array($record['code'],$record['title'],$record['fname'],$record['lname'],$record['surname'],$record['contact_no'],$record['email'],$record['country'],$record['city'],$record['refer'],$record['product_type'],$record['product_id'],$record['business_type'],$record['apply_vip'],$record['addedon'],$record['country_id'],$record['active_id'],$record['scope'],$record['status']);
		elseif($type==1): 
			$table = array($record['code'],$record['title'],$record['fname'],$record['lname'],$record['surname'],$record['contact_no'],
						   $record['mobile_no'],$record['company_name'],$record['job_title'],$record['city'],$record['province'],
						   $record['country'],$record['refer'],$record['status'],$record['productstatus'],$record['email'],
						   $record['benefits'],$record['qualification'],$record['purchasing_authority'],$record['turnover_from_china'],
						   $record['import_from_china'],$record['sourcing_from_China'],$record['match_making_process'],$record['scope'],
						   $record['addedon'],$record['active_id']);
		elseif($type==2):
			$table =array($record['fname'],$record['email'],$record['product_type'],$record['product_id'],
						  $record['date_time_start'],$record['date_time_end'],$record['comments'],
						  $record['code'],$record['scope']);
		elseif($type==3):
			$table =array($record['fname'],$record['email'],$record['product_type'],$record['product_id'],
						  $record['date_time_start'],$record['date_time_end'],$record['comments'],
						  $record['code'],$record['scope']);
		elseif($type==4):
			$table =array($record['code'],$record['fname'],$record['surname'],$record['email'],$record['addedon']);
		
		elseif($type==5):
			$table =array($record['fullname'],$record['contact_no'],$record['email'],$record['mobile_no'],$record['publication'],$record['job_title'],$record['comments'],
			$record['information'],$record['is_receive_info'],$record['created_date']);
		endif;
		
		fputcsv($output, $table);
	endforeach;
	#header('location: csvrepoort.php');
	//exit;	
endif;

?>