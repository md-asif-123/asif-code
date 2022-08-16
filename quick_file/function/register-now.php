<?php 
if($source == ''):
$source=0;
endif;
if ($last_registration_date == '0000-00-00 00:00:00'):
	$last_registration_date = '2020-08-29 04:18:27';
else:
	$last_registration_date = $last_registration_date;
endif;

$currentDateTime = date("Y-m-d H:i:s")."<br>";
$lastRegDatetime = $last_registration_date;

if(($lastRegDatetime <= $currentDateTime) ):
	header('location:index.php?page=registration-expired');
	exit;
endif;

if($_POST['SUBMIT']):	
	$foundEmail = checkEmail($email);
	
	$referEmail = checkrefEmail($refer);
	//$checkEmail = checEmailExit($email,$dbh);
	$checkcontactNumber = checNumber($contact_number);
	if(empty($fname)):
		$message = $lang['PLEASE_ENTER_FIRST_NAME'];
	elseif(empty($surname)):
		$message = $lang['PLEASE_ENTER_SURNAME'];
	elseif(empty($business_type)):
		$message = $lang['PLEASE_ENTER_BUSINESS_NAME'];
	elseif(empty($email)):
		$message = $lang['PLEASE_ENTER_YOUR_EMAIL_ADDRESS'];
	elseif(!empty($foundEmail) && !empty($email)):
		$message = $lang['INVALID_EMAIL_ADDRESS_REENTER_PLEASE'];
	//elseif(empty($checkEmail)):
		//$message = $lang['EMAIL_ALLRAEDY_EXIT'];		
	elseif(empty($area_code)):
		$message = $lang['PLEASE_ENTER_AREA_CODE'];		
	elseif(empty($contact_number)):
		$message = $lang['PLEASE_ENTER_YOUR_CONTACT_NO'];		
	elseif(empty($checkcontactNumber)):
		$message = $lang['PLEASE_ENTER_YOUR_CONTACT_NO_AS_NUMBER'];		
	elseif(empty($city)):
		$message = $lang['PLEASE_ENTER_CITY'];
	elseif(empty($country)):
		$message = $lang['PLEASE_SELECT_COUNTRY'];
	elseif($referEmail=='1' && !empty($refer)):
		$message = $lang['INVALID_REFEMAIL_ADDRESS_REENTER_PLEASE'];
	elseif($product_type == "0"):
		$message = $lang['PLEASE_ENTER_YOUR_PRODUCT_TYPE'];
	else:
		$activated_time = time();
		$actived_id = md5($activated_time.$email);
		$active_id = $actived_id;
		$_SESSION['active_id'] = $actived_id;
		$code = $chl->generateRegistrationCode('register',$website_id,$website_scope,$website_code,'',$dbh);
		echo $code;
		$_SESSION['code_register'] = $code;
		$_SESSION['fname'] = $fname;
		$_SESSION['surname'] = $surname;
		$_SESSION['country'] = $country;	
		
		if($country=='others'):
			$country=$country1;			
		endif;
		
		if($product_type=='other'):
			$product_type=$product_type1;
		endif;
		
		$_SESSION['value'] = 'register-now';
		$contact_no = $area_code.$contact_number;
		
		$sql="INSERT INTO `register` (`code`,`fname`,`lname`,`surname`,`email`,`country`,`city`,`refer`,`contact_no`,`business_type`,`source`,`apply_vip`,`product_type`,`product_id`,
		`country_id`,`active_id`) values (:code,:fname,:lname,:surname,:email,:country,:city,:refer,:contact_no,:business_type,:source,:apply_vip,:product_type,:product_id,
		:country_id,:active_id)";
		$stmt = $dbh->prepare($sql);
		
		$result = $stmt->execute(array(':code'=>"$code", ':fname'=>"$fname", ':lname'=>"$lname", ':surname'=>"$surname", ':email'=>"$email", ':country'=>"$country", 
		':city'=>"$city",':refer'=>"$refer", ':contact_no'=>"$contact_no", ':business_type'=>"$business_type", ':source'=>"$source", ':apply_vip'=>"$apply_vip", ':product_type'=>"$product_type", ':product_id'=>"$productId", ':country_id'=>$website_id,':active_id'=>"$active_id"));
		$message_success = $lang['THANK_YOU_FOR_REGITRATION'];
		$lastId = $dbh->lastInsertId();		
		
		#####################################################################################################
		#######Start::Get categories#########################################################################
		#####################################################################################################
		$str_supplier = '';
		$get_category_details = array();
		if($product_type != 'other'):		
			$get_category_details = $chl->getParentCategories($website_id,$dbh,$product_type);
			if(count($get_category_details) > 0):
				$category_id = $get_category_details[0]['id'];
				if($category_id):				
					$get_exhibitor_details = $chl->getExhibitorList($category_id, $website_id, $dbh, $limit=4);					
					if(count($get_exhibitor_details) > 0):
						$no_of_exhibitor = count($get_exhibitor_details);
						$str_supplier = $chl->getExhibitorListToMailTemplate($get_exhibitor_details, $no_of_exhibitor);
						
						$show_more = '<tr><td><div style="text-align:center;"><a href="'.$getSiteUrl.'/index.php?page=exhibitor-list&id='.$category_id.'" style="background:#000;padding:10px 40px;display:inline-block;color:#fff;text-decoration:none;text-transform:uppercase;font-size: 14px;">See More</a></div></td></tr>';						
					endif;
				endif;
			endif;
		endif;
		#####################################################################################################
		#######End::Get categories###########################################################################
		#####################################################################################################		
		if($website_language == "en"):			
			
			$pdfPhysicalPath = $physical_path.$installationDir.'var/badges/pdf/';
			$bgImage = $physical_path.$installationDir.'media/images/badge.jpg';
			$name = $fname.' '.$surname;
			$business_type = $business_type."\n";
			$cityCountry = $city.', '.$country;	
			$visitorType = 0;
			$generateTicket->generatePDF($pdfPhysicalPath,$bgImage,$name,$business_type,$cityCountry,$email,$contact_no,$visitorType,$code);
			#####################################################################################################
			#######Start::Email##################################################################################
			#####################################################################################################
			$mailTemplate = new mailTemplate();
			$site_url = 'http://'.$website_url.'/'.$installationDir;		
			
			$file_path = $pdfPhysicalPath.$code.'.pdf';
			$download_link = $chl->getDownloadFile($salt, $file_path, $code,'download.php');
					
			$exhibition_duration = '';
			if((($exhibition_start_date != '') && ($exhibition_start_date != '0000-00-00')) && (($exhibition_end_date != '') && ($exhibition_end_date != '0000-00-00'))):			
				$exhibition_start_date = date("d", strtotime($exhibition_start_date));
				$exhibition_end_date = date("d M Y", strtotime($exhibition_end_date));
				$exhibition_duration = $exhibition_start_date." - ".$exhibition_end_date;
			endif;
			
			$download_link ='<div> <a href="'.$site_url.$download_link.'" style="text-align:center;background: #48a13a;padding: 10px 0; display:block; color:#fff; text-decoration:none;">Downloading</a> </div>';
			
			if(($website_machinex != '#') && ($website_machinex != '')):
				$message = $mailTemplate->sendRegistrationMailMachinexTemplate($name,$site_url,$country, $code, $download_link, $str_supplier, $website_language,$physical_path,$installationDir,$show_more,$website_name,$exhibition_center,$exhibition_duration);				
			else:
				$message = $mailTemplate->sendRegistrationMailTemplate($name,$site_url,$country, $code, $download_link, $str_supplier, $website_language,$physical_path,$installationDir,$show_more,$website_name,$exhibition_center,$exhibition_duration);
			endif;
			
			$subject = $altMessage = 'Registration successful';
			$message = html_entity_decode($message,ENT_QUOTES);	
			
			$user_data = array(
								'receiver_email' => $email,
								'receiver_name' => $name,
								'subject' => $subject,
								'message' => $message,								
								'files' => array($pdfPhysicalPath.$code.'.pdf')
							  );
			
			$mailTemplate->sendMailWithAttachment($dbh,$website_id,$user_data,$physical_path,$installationDir);			
			#####################################################################################################
			#######End::Email####################################################################################
			#####################################################################################################				
			
		else:
			$name = $fname.' '.$surname;
			$business_type = $business_type."\n";
			$cityCountry = $city.', '.$country;	
			$visitorType = 0;
						
			#####################################################################################################
			#######Start::Email##################################################################################
			#####################################################################################################
			$mailTemplate = new mailTemplate();
			$site_url = 'http://'.$website_url.'/'.$installationDir;
			
			$exhibition_duration = '';
			if((($exhibition_start_date != '') && ($exhibition_start_date != '0000-00-00')) && (($exhibition_end_date != '') && ($exhibition_end_date != '0000-00-00'))):			
				$exhibition_start_date = date("d", strtotime($exhibition_start_date));
				$exhibition_end_date = date("d M Y", strtotime($exhibition_end_date));
				$exhibition_duration = $exhibition_start_date." - ".$exhibition_end_date;
			endif;			
			if(($website_machinex != '#') && ($website_machinex != '')):
				$message = $mailTemplate->sendRegistrationMailMachinexTemplate($name,$site_url,$country, $code, $download_link='', $str_supplier, $website_language,$physical_path,$installationDir,$show_more,$website_name,$exhibition_center,$exhibition_duration);				
			else:
				$message = $mailTemplate->sendRegistrationMailTemplate($name,$site_url,$country, $code, $download_link='', $str_supplier, $website_language,$physical_path,$installationDir,$show_more,$website_name,$exhibition_center,$exhibition_duration);
			endif;			
			$subject = $altMessage = 'Registration successful';
			$message = html_entity_decode($message,ENT_QUOTES);
			$user_data = array(
								'receiver_email' => $email,
								'receiver_name' => $name,
								'subject' => $subject,
								'message' => $message
							  );
			
			$mailTemplate->sendMailWithAttachment($dbh,$website_id,$user_data,$physical_path,$installationDir);			
			#####################################################################################################
			#######End::Email####################################################################################
			#####################################################################################################
		endif;
		if($website_id =='6' || $website_id =='7'):
			$saveRedballoon = $chl->saveBallon($lastId,$website_id,$website_scope,'register',$dbh);
		endif;		
		header("location:index.php?page=success-message&buyerstatus=$apply_vip&product_type=$product_type");
	endif;
endif;

$productName = '';
if(!empty($id)):
	$sql_product = "SELECT id,name from products WHERE id = :id and country_id=:website_id";
	$stmt_product = $dbh->prepare( $sql_product );
	$stmt_product->execute(array(':id'=>$id,':website_id'=>$website_id));
	if($stmt_product->rowCount() > 0):
		$result_product = $stmt_product->fetchObject();
		$productName = $result_product->name;
		$productId = $result_product->id;
	endif;
endif;
?>
<script language="javascript" type="text/javascript">
function checkvalue(val) {
if (val === "others")
document.getElementById('color').style.display = 'block';
else
document.getElementById('color').style.display = 'none';
}

function checkvaluesource(val) {
if (val === "other")
document.getElementById('source').style.display = 'block';
else
document.getElementById('source').style.display = 'none';
}
</script>
<form name="reg-form" id="unique-code-form" method="post" >

<!------Register-------->
<section id="register">
	<div class="col-xs-12">
    	<div class="row">
        	<div class="col-sm-6 text-right">
				<div class="Reg-text-box col-xs-12">
					<?php 		
					$record=$chl->getCMS('register_now_content',$dbh,'cms',0,$website_id);
					echo  html_entity_decode($record['contents']);
					?>
                </div>
            </div>
			
            <div class="col-sm-6">
			<?php if($message_success != ""):?>
			
			<div class="alert alert-success"><i aria-hidden"true"="" class="fa fa-success"></i> &nbsp;<?php echo $message_success;?></div>
		  	 		
			<?php endif; ?>
			
			<?php if($message != ""):?>			
				<div class="alert alert-warning"><i aria-hidden"true"="" class="fa fa-warning"></i> &nbsp;<?php echo $message;?></div>		  	 		
			<?php endif; ?>
			
			
			
            	<div class="Reg-form">
				
				<?php if($productName):?>
				<div class="alert alert-success" style="color:#000;"><i aria-hidden"true"="" class="fa fa-success"></i> &nbsp;
					Product : <?php echo $productName;?></div>
					<input type="hidden" value="<?php echo $productId ?>" name="productId" />
				<?php endif; ?>
				
                	<form>
                      <?php /*?><div class="form-group">
                        <input type="text" class="form-control" name="title" id="Name" value="<?php if(isset($title)): echo $title;endif;?>" placeholder="Title*">
                      </div><?php */?>
					  
					  <div class="form-group">
                        <input type="text" class="form-control" name="fname" id="Name" value="<?php if(isset($fname)): echo $fname;endif;?>" placeholder="<?php echo $lang['FIRST_NAME'];?>">
                      </div>
					  
					  <div class="form-group">
                        <input type="text" class="form-control" name="surname" id="Name" value="<?php if(isset($surname)): echo $surname;endif;?>" placeholder="<?php echo $lang['SURNAME'];?>">
                      </div>
					  
					   <div class="form-group">
                        <input type="text" class="form-control" name="business_type" id="Email" value="<?php if(isset($business_type)): echo $business_type;endif;?>" placeholder="<?php echo $lang['COMPANY_NAME'];?>">
                      </div>
					  					  
                      <div class="form-group">
                        <input type="text" class="form-control" name="email" id="Email" value="<?php if(isset($email)): echo $email;endif;?>" placeholder="<?php echo $lang['EMAIL'];?>">
                      </div>
					  
					  <div class="form-group">
                        <input type="text" class="form-control" style="float:left;width:33%" name="area_code" id="Email" value="<?php if(isset($area_code)): echo $area_code;endif;?>" placeholder="<?php echo $lang['AREA_CODE'];?>">
                        <input type="text" class="form-control" style="float:right;width:65%" name="contact_number" id="Email" value="<?php if(isset($contact_number)): echo $contact_number;endif;?>" placeholder="<?php echo $lang['CONTACT_NUMBER'];?>">
                      </div>
					  <div style="clear:both; height:12px;"></div>
					  
                      
					  
					  
					   <div class="form-group">
					  <input type="text" class="form-control" name="city" id="Email" value="<?php if(isset($city)): echo $city;endif;?>" placeholder="<?php echo $lang['CITY'];?>">
					   </div>
					   
					   <div class="form-group">
                      	<select class="form-control" name="country" onchange="checkvalue(this.value)">
							<option value='0'><?php echo $lang['COUNTRY'];?></option>
								<?php 
								$returnCountryname = $chl->getCountry($website_id,$website_custom_country,$dbh);
								foreach($returnCountryname as $results):?>
								<option <?php if($country == $results['countryName']): echo "selected=selected";endif;?> value="<?php echo $results['countryName'];?>"><?php echo $results['countryName'];?></option>
								<?php
								endforeach;
								?>
						</select>
                      </div>
					  
					   <div class="form-group">
                         <input type="text" name="country1" class="form-control" value="<?php if(isset($country1)): echo $country1;endif;?>" placeholder="<?php echo $lang['COUNTRY'];?>" name="color" id="color" style='display:none'/>
                       </div>
					  
					  
					    <div class="form-group">
                      	<select class="form-control" name="product_type" onchange="checkvaluesource(this.value)">
                          <option value="0"><?php echo $lang['PRODUCTS_INTERESTED_SOURCING'];?></option>
						  <?php 
						  $result = $chl->getParentCategories($website_id,$dbh);
						  foreach($result as $data):?>
                          <option value="<?php echo ucwords(strtolower($data['name']));?>"><?php echo ucwords(strtolower($data['name']));?></option>						  
                          <?php endforeach;?>
						  <option <?php if($product_type == "other"): echo "selected=selected";endif;?> value="other"><?php echo $lang['OTHER'];?></option>
                        </select>
                      </div>
					  
					  
					  <div class="form-group">
                         <input type="text" name="product_type1" class="form-control" value="<?php if(isset($product_type1)): echo $product_type1;endif;?>" placeholder="<?php echo $lang['PRODUCTS_INTERESTED_SOURCING'];?>" name="source" id="source" style='display:none'/>
                      </div>
					   
					    <span style="font-size:13px; color:rgb(135, 127, 127);"><?php echo $lang['SOMEONE_LIKE_ATTEND_OUR_SHOWS'];?></span>
					  
					    <div class="form-group">
                        <input type="text" class="form-control" name="refer" id="Email" value="<?php if(isset($refer)): echo $refer;endif;?>" placeholder="<?php echo $lang['REFER_SOMEONE'];?>">
                      </div>
					 
					 
					  
                     <?php /*?>
					  
					  <div class="form-group">
                    
						<span style="font-size:14px; color:rgb(135, 127, 127);">
						<?php echo $lang['APPLY_FOR_VIP_HOSTED_BUYER_STATUS'];?>
						</span>
						
						<lable style="font-size:14px; color:rgb(135, 127, 127);"><input name="apply_vip" id="optionsRadios1" value="1" type="radio">&nbsp;&nbsp;<?php echo $lang['YES'];?></label>
                        &nbsp;&nbsp;<lable style="font-size:14px; color:rgb(135, 127, 127);"><input name="apply_vip" id="0" value="0" type="radio">&nbsp;&nbsp;<?php echo $lang['NO'];?></label>
                     
                    </div>
					
					<?php */?>
						
                     				  
					<input type="submit" class="btn btn-default" value="<?php echo $lang['SUBMIT'];?>" name="SUBMIT">
                     
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!------Register-------->
</form>