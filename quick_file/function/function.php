<?php 
require_once('generateTicket.php');
require_once('mailTemplate.php');

function checkEmail($email){
	if(!filter_var($email, FILTER_VALIDATE_EMAIL) === false):
	return 0;
	else:
	return 1;
	endif;
}
function checkrefEmail($refer){
	if(!filter_var($refer, FILTER_VALIDATE_EMAIL) === false)	{return false;}
	else {return true;}
}
function checNumber($contact_no){
	if(!preg_match("/^[0-9]*$/", $contact_no)){return false;}
	else {return true;}
}
function checEmailExit($email,$dbh){	
	$sql = "select id from `register` where `email`=:email";
	$stmt = $dbh->prepare( $sql );
	$stmt->execute(array(':email'=>$email));	
	if($stmt->rowCount() > 0):
		return false;
	else:
		return true;
	endif;	
}
function checkEmailExist($email,$table,$dbh){	
	$sql = "select id from ".$table." where `email`=:email";
	$stmt = $dbh->prepare( $sql );
	$stmt->execute(array(':email'=>$email));	
	if($stmt->rowCount() > 0):
		return false;
	else:
		return true;
	endif;	
}
class chl {
	function getDownloadFile($salt, $file_path, $file_name_without_extension,$downloadFile){
		if( isset($file_name_without_extension) ):
			if( file_exists($file_path) ):
				$salt = $salt.$file_name_without_extension;
				$url = $downloadFile.'?id='.md5($salt).strtolower($file_name_without_extension);
				return $url;
			else:
				return '#';
			endif;
		else:
			return '#';
		endif;
	}
	
	function getParentCategories($website_id,$dbh,$cat_name=""){
		$sql= "SELECT id, name FROM categories where parent_id = 0 and website_id=:website_id and status=1 ";
		
		if($cat_name != ''):
			$sql .= " AND `name` LIKE '%".$cat_name."%'";			
		endif;
		
		$stmt = $dbh->prepare($sql);	
		$stmt->execute(array(':website_id'=>$website_id));		
		$result = $stmt->fetchAll();
		return $result;
	}
	
	
	function generateRegistrationCode($tableName,$website_id,$website_scope,$website_code,$ext,$dbh){		
		$query = "SELECT max(id) as maxid FROM ".$tableName."";
		$sql = $dbh->prepare($query);
		$sql->execute();
		$stmt = $sql->fetch(PDO::FETCH_ASSOC);
		$count_id = $stmt['maxid'];
		$website_scope == 0 ? $strfixed = 'C'.$website_code : $strfixed = 'M'.$website_code;
		$count_num = $count_id+1;
		$length1 = strlen("$strfixed");
		$length2 = strlen("$count_num");
		$y = $length1+$length2;
		$x = 9-$y;
		if($x=='5'):
		$zero = "00000";
		elseif($x=='4'):
		$zero = "0000";
		elseif($x=='3'):
		$zero = "000";
		elseif($x=='2'):
		$zero = "00";
		elseif($x=='1'):
		$zero = "0";
		endif;	
		return $strfixed .$zero. $count_num.$ext;
	}	
	function includeFile($installationDir, $website_theme, $fileName){
		$ds = DIRECTORY_SEPARATOR;
		$theme_file = $_SERVER['DOCUMENT_ROOT'].$ds.$installationDir.$ds.'themes'.$ds.$website_theme.$ds.'pages'.$ds.$fileName;
		if(!is_file($theme_file)):
			$theme_file = $_SERVER['DOCUMENT_ROOT'].$ds.$installationDir.$ds.'themes'.$ds.'default'.$ds.'pages'.$ds.$fileName;		
		endif;		
		return $theme_file;
		//include($theme_file);
	}
	function getThemePage($installationDir, $website_theme){
		$ds = DIRECTORY_SEPARATOR;
		$theme_directory = $_SERVER['DOCUMENT_ROOT'].$ds.$installationDir.$ds.'themes'.$ds.$website_theme;
		if(!is_dir($theme_directory)):
			$theme_directory = $_SERVER['DOCUMENT_ROOT'].$ds.$installationDir.$ds.'themes'.$ds.'default'.$ds.'pages'.$ds;
		else:
			$theme_directory = $theme_directory.$ds.'pages'.$ds;
		endif;	
		return $theme_directory;
	}
	function getCss($installationDir, $website_theme, $filename){
		$ds = DIRECTORY_SEPARATOR;
		$theme_css = $_SERVER['DOCUMENT_ROOT'].$ds.$installationDir.$ds.'themes'.$ds.$website_theme.$ds.'skin'.$ds.'css'.$ds.$filename;
		//var_dump(file_exists($theme_css)); exit;
		if(!is_file($theme_css)):
			$theme_css = 'http://'.$_SERVER['HTTP_HOST'].$ds.$installationDir.$ds.'themes'.$ds.'default'.$ds.'skin'.$ds.'css'.$ds.$filename;		
		else:
			$theme_css = 'http://'.$_SERVER['HTTP_HOST'].$ds.$installationDir.$ds.'themes'.$ds.$website_theme.$ds.'skin'.$ds.'css'.$ds.$filename;
		endif;	
		return $theme_css;
	}	
	
	function getJs($installationDir, $website_theme, $filename){
		$ds = DIRECTORY_SEPARATOR;
		$theme_js = $_SERVER['DOCUMENT_ROOT'].$ds.$installationDir.$ds.'themes'.$ds.$website_theme.$ds.'skin'.$ds.'js'.$ds.$filename;
		//var_dump(file_exists($theme_css)); exit;
		if(!is_file($theme_js)):
			$theme_js = 'http://'.$_SERVER['HTTP_HOST'].$ds.$installationDir.$ds.'themes'.$ds.'default'.$ds.'skin'.$ds.'js'.$ds.$filename;		
		else:
			$theme_js = 'http://'.$_SERVER['HTTP_HOST'].$ds.$installationDir.$ds.'themes'.$ds.$website_theme.$ds.'skin'.$ds.'js'.$ds.$filename;
		endif;	
		return $theme_js;
	}

	function getImage($installationDir, $website_theme, $filename){
		$ds = DIRECTORY_SEPARATOR;
		$theme_image = $_SERVER['DOCUMENT_ROOT'].$ds.$installationDir.$ds.'themes'.$ds.$website_theme.$ds.'skin'.$ds.'images'.$ds.$filename;
		//var_dump(file_exists($theme_css)); exit;
		if(!is_file($theme_image)):
			$theme_image = 'http://'.$_SERVER['HTTP_HOST'].$ds.$installationDir.$ds.'themes'.$ds.'default'.$ds.'skin'.$ds.'images'.$ds.$filename;		
		else:
			$theme_image = 'http://'.$_SERVER['HTTP_HOST'].$ds.$installationDir.$ds.'themes'.$ds.$website_theme.$ds.'skin'.$ds.'images'.$ds.$filename;
		endif;	
		return $theme_image;
	}
	
	function getSkin($installationDir, $website_theme){
		$ds = DIRECTORY_SEPARATOR;
		$theme_directory = $_SERVER['HTTP_HOST'].$ds.$installationDir.$ds.'themes'.$ds.$website_theme;
		if(!is_dir($theme_file)):
			$theme_directory = $_SERVER['HTTP_HOST'].$ds.$installationDir.$ds.'themes'.$ds.'default'.$ds.'skin'.$ds;
		else:
			$theme_directory = $theme_directory.$ds.'skin'.$ds;
		endif;	
		return $theme_directory;
	}
	function getMedia($installationDir, $website_id){
		$ds = DIRECTORY_SEPARATOR;
		$theme_directory = $_SERVER['DOCUMENT_ROOT'].$ds.$installationDir.$ds.'media'.$ds.$website_id;
		if(!is_dir($theme_directory)):
			$theme_directory = $_SERVER['DOCUMENT_ROOT'].$ds.$installationDir.$ds.'media'.$ds.$website_id;
		else:
			$theme_directory = $theme_directory.$ds.'skin'.$ds;
		endif;	
		return $theme_directory;
	}	
	function getLocale($installationDir, $website_theme, $filename){
		$ds = DIRECTORY_SEPARATOR;
		$locale = $_SERVER['DOCUMENT_ROOT'].$ds.$installationDir.$ds.'locale'.$ds.$filename;
		if(!is_file($locale)):
			$locale = $_SERVER['DOCUMENT_ROOT'].$ds.$installationDir.$ds.'locale'.$ds.'en.php';
		endif;	
		return $locale;
	}
	// Get category list
	public function getCategoryList($website_id,$dbh){
		$sql= "SELECT `id`,`name` FROM categories where parent_id = 0 and website_id=:website_id and status = 1 order by ord asc";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':website_id'=>$website_id));
		while($data = $stmt->fetchAll(PDO::FETCH_ASSOC)){
			$returnaData = $data;
		}
		return $returnaData;
	}
	// Get Exhibitor list min ID
	public function getExhibitorId($id,$website_id, $dbh){
		$sql= "SELECT id from `categories` where ord=(SELECT min(ord) as ord FROM categories where website_id = :website_id and status = :status) and website_id = :country_id";
		//$sql= "SELECT MIN(`id`) as id FROM categories where website_id=:website_id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':website_id'=>$website_id,':status'=>'1',':country_id'=>$website_id));
		if($stmt->rowCount() > 0):
		return $record = $stmt->fetch(PDO::FETCH_ASSOC);
		endif;
		
	}
	// Get Exhibitor list
	public function getExhibitorList($id, $website_id, $dbh, $limit=""){
		$sql = "SELECT `id`, `company`, `description` FROM exhibitors where category = :id and status = 1 and country_id=:website_id";
		
		if(($limit != '') && ($limit > 0)):
			$sql .= " ORDER BY rand() LIMIT 0,".$limit."";			
		endif;
		
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id,':website_id'=>$website_id));
		while($data = $stmt->fetchAll(PDO::FETCH_ASSOC)){
			$returnaexhibitor = $data;
		}
		return $returnaexhibitor;
	}
	
	public function getExhibitorListToMailTemplate($arr_exhibitor_details, $no_of_exhibitor){		
		$str = '<table style="background:#fff;border:10px solid transparent; width:600px; margin:15px auto 0">';
		
		$ab = 0;
		$j = 0;
		$i = $no_of_exhibitor;		
		
		$rem = $i%2;
		
		foreach($arr_exhibitor_details as $key_exhibitor => $val_exhibitor):
			$j = $j+1;
			if($ab==0):
				$str .= '<tr>';			
			endif;
			
				$str .= '<td width="50%">
							<div style="border:1px solid #bababa;padding:0 20px;">
							<h2 style="color:#000;font-size:16px;display:block;text-decoration:none;margin:10px 0;">'.substr($val_exhibitor['company'],0,25).'...</h2>
							  <p style="font-size:14px;color:#666;">'.substr(strip_tags($val_exhibitor['description']),0,100).'</p>
							</div>
						</td>';	
			
				if($i == $j):
					if($rem > 0):		
						$str .= '<td width="50%">&nbsp;</td>';
					endif;
				endif;
						
			$ab++;
			if($ab==2):
				$ab=0;				
				$str .= '</tr>';			
			elseif($i==$j):
				$str .= '</tr>';
			endif;			
		endforeach;		
		
		$str .= '</table>';		
		return $str;
	}
	
	// Get India state list
	function getProvince($website_id,$dbh){
		$sql = "SELECT `province` from `province` order by `province`";		
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		while($data = $stmt->fetchAll(PDO::FETCH_ASSOC)){
			$returnCountryname = $data;
		}
		return $returnCountryname;
	}
	
	// Get Block not required
	public function getCMSs($block_id,$dbh,$table,$status,$country_id,$scope){
		//echo $block_id;echo $table;echo $status; echo $country_id; echo $scope;
		$sql= "SELECT contents,page_title,title FROM $table where block_id = :block_id and status = :status and country_id = :country_id and scope = :scope";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':block_id'=>$block_id,':status'=>$status,':country_id'=>$country_id,':scope'=>$scope));
		if($stmt->rowCount() > 0):
		return $record = $stmt->fetch(PDO::FETCH_ASSOC);
		endif;	
	}
	// Get Block
	
	public function getCMS($block_id,$dbh,$table,$status,$country_id){
		//echo $block_id;echo $table;echo $status; echo $country_id; echo $scope;
		$sql= "SELECT contents,page_title,title FROM $table where block_id = :block_id and status = :status and country_id = :country_id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':block_id'=>$block_id,':status'=>$status,':country_id'=>$country_id));
		if($stmt->rowCount() > 0):
		return $record = $stmt->fetch(PDO::FETCH_ASSOC);
		endif;	
	}
	
	// Get Content not requires
	public function getCmsContents($id,$dbh,$table,$status,$country_id,$scope){
		//echo $block_id;echo $table;echo $status; echo $country_id; echo $scope;
		$sql= "SELECT contents,page_title,title FROM $table where id = :id and status = :status and country_id = :country_id and scope = :scope";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id,':status'=>$status,':country_id'=>$country_id,':scope'=>$scope));
		if($stmt->rowCount() > 0):
		return $record = $stmt->fetch(PDO::FETCH_ASSOC);
		endif;	
	}
	// Get Content not requires
	public function getCmsContent($page_id,$dbh,$table,$status,$country_id){
		//echo $block_id;echo $table;echo $status; echo $country_id; echo $scope;
		$sql= "SELECT contents,page_title,title FROM $table where page_id = :id and status = :status and country_id = :country_id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$page_id,':status'=>$status,':country_id'=>$country_id));
		if($stmt->rowCount() > 0):
		return $record = $stmt->fetch(PDO::FETCH_ASSOC);
		endif;	
	}
	
	public function getFooterJs($page,$reference,$website_id,$dbh){
		if($reference == ''):
			$sql= "select js FROM footer_js where name = :name and website_id=$website_id limit 0,1";
			$stmt = $dbh->prepare($sql);
			$stmt->execute(array(':name'=>$page));
		else:
			$sql= "select js FROM footer_js where name = :name and value=:value and website_id=$website_id limit 0,1";
			$stmt = $dbh->prepare($sql);
			$stmt->execute(array(':name'=>$page,':value'=>$reference));
		endif;	
		if($stmt->rowCount() > 0):
			$record = $stmt->fetch(PDO::FETCH_ASSOC);				
			return $record['js'];
		else:
			return '';
		endif;	
	}
	
	public function getGalleryImage($dbh,$table,$country_id){
		$sql= "SELECT image FROM $table where country_id = :country_id and status = '0'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':country_id'=>$country_id));
		while($data = $stmt->fetchAll(PDO::FETCH_ASSOC)){
			$returnaexhibitor = $data;
		}
		return $returnaexhibitor;
	}
	
	function getEmailInfo($website_id,$dbh){
		$sql= "SELECT email, password, smtp, sender FROM email_accounts where website_id = :website_id and status = 1 limit 0,1";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':website_id'=>$website_id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}	

	function getCountry($website_id,$website_custom_country,$dbh){
		if($website_custom_country == 1):
		
			$sql = "SELECT IFNULL(countries.countryCode ,'Other') as countryCode, IFNULL(countries.countryName ,'Other') as countryName FROM `countries` 
			right join countries_custom on  countries.id=countries_custom.country_id where countries_custom.website_id=$website_id";		
		else:
			$sql= "SELECT countries.countryCode as countryCode, countries.countryName as countryName FROM countries order by countries.countryName asc";
		endif;
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		while($data = $stmt->fetchAll(PDO::FETCH_ASSOC)){
			$returnCountryname = $data;
		}
		return $returnCountryname;
	}
	// Get category name
	function getCategory($id,$website_id,$dbh){
		$sql= "SELECT name FROM categories where website_id = :website_id and id = :id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':website_id'=>$website_id,':id'=>$id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$name = strtolower($result['name']);
		$category_name = $name."_list";
		$sql= "SELECT contents FROM cms where block_id = :block_id and country_id= :website_id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':block_id'=>$category_name,':website_id'=>$website_id,));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		echo strtolower($result['contents']);
	
	}
	
	function saveBallon($lastId,$website_id,$website_scope,$table_name,$dbh){
		
		if(!empty($_REQUEST)):
		foreach($_REQUEST as $variable => $value):
			$$variable = strip_tags(trim($value));
		endforeach;
		endif;
		if($website_scope == '0'):
		$statusSAH = 'yes'; 
		$statusSAM = 'no'; 
		elseif($website_scope == '1'):
		$statusSAH = 'no'; 
		$statusSAM = 'yes'; 
		else:
		return false;
		endif;
		if($page == 'register-now' || $page == 'callcenter-reg'):
		$delegate = 'normal'; 
		elseif($page == 'vip-buyer-application'):
		$delegate = 'vip';
		$business_type = $company_name;	
		else:
		return false;
		endif;
		
		$sql= "SELECT `code`,`id`,`country_id` FROM ".$table_name." where id = :lastId and email = :email and country_id = :website_id ";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':lastId'=>$lastId,':email'=>$email,':website_id'=>$website_id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$userCode = $result['code'];
		
		$table_id = $result['id'];
		$website_id = $result['country_id'];
		
		$url = "http://www.redballoon.biz/china_reg/sendbadge?code=".urlencode($userCode)."&fname=".urlencode($fname)."&surname=".urlencode($surname)."&email=".urlencode($email)."&country=".urlencode($country)."&company=".urlencode($business_type)."&delegate=".urlencode($delegate)."&homelife=".urlencode($statusSAH)."&machinex=".urlencode($statusSAM)."";
		
		//$url = "http://www.redballoon.biz/china_reg/sendbadge?code=".$usercode."&fname=".$fname."&surname=".$surname."&email=".$email."&country=Zambia&company=test";
		#header('Content-Type: application/json; charset=utf-8');
		$postData = '';
		$ch = curl_init();	
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		curl_setopt($ch,CURLOPT_HEADER, false);
		$output=curl_exec($ch);					
		$err = false;
		curl_close($ch);
		$status = json_decode($output);
		$stat = $status->reply;
		if ( isset($stat) && ($stat != 'OK') ):
		$sql="INSERT INTO `batch_error_log` (`error`,`table_id`,`table_name`,`website_id`,`url`) values (:error,:table_id,:table_name,:website_id,:url)";
		$stmt = $dbh->prepare($sql);
		$result = $stmt->execute(array(':error'=>$stat,':table_id'=>$table_id,':table_name'=>$table_name,':website_id'=>$website_id,':url'=>$url));
		endif;
		
	}
	
	// 23/09/2016   Code by Nazir mallick
	
	// Get Product by Exhibitor id
	public function getProductDetails($exhibitor_id,$website_id, $dbh){
		
		$sql= "SELECT name, image FROM products where exhibitor_id = :exhibitor_id and status = '1' and country_id=:website_id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':exhibitor_id'=>$exhibitor_id,':website_id'=>$website_id));
		if($stmt->rowCount() > 0):
		$productDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $productDetails;
		endif;
	}
	
	// Get All Product image by id
	public function getAllProductimageByid($product_id,$dbh){
		
		$sql= "SELECT image FROM product_images where product_id = :product_id and status = '1'";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':product_id'=>$product_id));
		if($stmt->rowCount() > 0):
		$allProductImage = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $allProductImage;
		endif;
	}
	// 23/09/2016   Code End
	
	// get all nationality
	function getAllNationality($dbh){
		$sth = $dbh->prepare("SELECT * FROM nationality");
		$sth->execute();
		if($sth->rowCount() > 0):
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		endif;
		
	}
	
	
}
$chl = new chl();

/*class smtpMail{
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


$url = "http://192.168.0.75:1345/chl_new_all/api/phptopdf/test.php";
			$postData = '';
		$ch = curl_init();	
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		curl_setopt($ch,CURLOPT_HEADER, false);
		$output=curl_exec($ch);					
		$err = false;
		curl_close($ch); */


// bar code 
/*function barcode( $filepath="", $text="0", $size="20", $orientation="horizontal", $code_type="code128", $print=false, $SizeFactor=1 ) {
	$code_string = "";
	// Translate the $text into barcode the correct $code_type
	if ( in_array(strtolower($code_type), array("code128", "code128b")) ) {
		$chksum = 104;
		// Must not change order of array elements as the checksum depends on the array's key to validate final code
		$code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","\`"=>"111422","a"=>"121124","b"=>"121421","c"=>"141122","d"=>"141221","e"=>"112214","f"=>"112412","g"=>"122114","h"=>"122411","i"=>"142112","j"=>"142211","k"=>"241211","l"=>"221114","m"=>"413111","n"=>"241112","o"=>"134111","p"=>"111242","q"=>"121142","r"=>"121241","s"=>"114212","t"=>"124112","u"=>"124211","v"=>"411212","w"=>"421112","x"=>"421211","y"=>"212141","z"=>"214121","{"=>"412121","|"=>"111143","}"=>"111341","~"=>"131141","DEL"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","FNC 4"=>"114131","CODE A"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
		$code_keys = array_keys($code_array);
		$code_values = array_flip($code_keys);
		for ( $X = 1; $X <= strlen($text); $X++ ) {
			$activeKey = substr( $text, ($X-1), 1);
			$code_string .= $code_array[$activeKey];
			$chksum=($chksum + ($code_values[$activeKey] * $X));
		}
		$code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

		$code_string = "211214" . $code_string . "2331112";
	} elseif ( strtolower($code_type) == "code128a" ) {
		$chksum = 103;
		$text = strtoupper($text); // Code 128A doesn't support lower case
		// Must not change order of array elements as the checksum depends on the array's key to validate final code
		$code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","NUL"=>"111422","SOH"=>"121124","STX"=>"121421","ETX"=>"141122","EOT"=>"141221","ENQ"=>"112214","ACK"=>"112412","BEL"=>"122114","BS"=>"122411","HT"=>"142112","LF"=>"142211","VT"=>"241211","FF"=>"221114","CR"=>"413111","SO"=>"241112","SI"=>"134111","DLE"=>"111242","DC1"=>"121142","DC2"=>"121241","DC3"=>"114212","DC4"=>"124112","NAK"=>"124211","SYN"=>"411212","ETB"=>"421112","CAN"=>"421211","EM"=>"212141","SUB"=>"214121","ESC"=>"412121","FS"=>"111143","GS"=>"111341","RS"=>"131141","US"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","CODE B"=>"114131","FNC 4"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
		$code_keys = array_keys($code_array);
		$code_values = array_flip($code_keys);
		for ( $X = 1; $X <= strlen($text); $X++ ) {
			$activeKey = substr( $text, ($X-1), 1);
			$code_string .= $code_array[$activeKey];
			$chksum=($chksum + ($code_values[$activeKey] * $X));
		}
		$code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

		$code_string = "211412" . $code_string . "2331112";
	} elseif ( strtolower($code_type) == "code39" ) {
		$code_array = array("0"=>"111221211","1"=>"211211112","2"=>"112211112","3"=>"212211111","4"=>"111221112","5"=>"211221111","6"=>"112221111","7"=>"111211212","8"=>"211211211","9"=>"112211211","A"=>"211112112","B"=>"112112112","C"=>"212112111","D"=>"111122112","E"=>"211122111","F"=>"112122111","G"=>"111112212","H"=>"211112211","I"=>"112112211","J"=>"111122211","K"=>"211111122","L"=>"112111122","M"=>"212111121","N"=>"111121122","O"=>"211121121","P"=>"112121121","Q"=>"111111222","R"=>"211111221","S"=>"112111221","T"=>"111121221","U"=>"221111112","V"=>"122111112","W"=>"222111111","X"=>"121121112","Y"=>"221121111","Z"=>"122121111","-"=>"121111212","."=>"221111211"," "=>"122111211","$"=>"121212111","/"=>"121211121","+"=>"121112121","%"=>"111212121","*"=>"121121211");

		// Convert to uppercase
		$upper_text = strtoupper($text);

		for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
			$code_string .= $code_array[substr( $upper_text, ($X-1), 1)] . "1";
		}

		$code_string = "1211212111" . $code_string . "121121211";
	} elseif ( strtolower($code_type) == "code25" ) {
		$code_array1 = array("1","2","3","4","5","6","7","8","9","0");
		$code_array2 = array("3-1-1-1-3","1-3-1-1-3","3-3-1-1-1","1-1-3-1-3","3-1-3-1-1","1-3-3-1-1","1-1-1-3-3","3-1-1-3-1","1-3-1-3-1","1-1-3-3-1");

		for ( $X = 1; $X <= strlen($text); $X++ ) {
			for ( $Y = 0; $Y < count($code_array1); $Y++ ) {
				if ( substr($text, ($X-1), 1) == $code_array1[$Y] )
					$temp[$X] = $code_array2[$Y];
			}
		}

		for ( $X=1; $X<=strlen($text); $X+=2 ) {
			if ( isset($temp[$X]) && isset($temp[($X + 1)]) ) {
				$temp1 = explode( "-", $temp[$X] );
				$temp2 = explode( "-", $temp[($X + 1)] );
				for ( $Y = 0; $Y < count($temp1); $Y++ )
					$code_string .= $temp1[$Y] . $temp2[$Y];
			}
		}

		$code_string = "1111" . $code_string . "311";
	} elseif ( strtolower($code_type) == "codabar" ) {
		$code_array1 = array("1","2","3","4","5","6","7","8","9","0","-","$",":","/",".","+","A","B","C","D");
		$code_array2 = array("1111221","1112112","2211111","1121121","2111121","1211112","1211211","1221111","2112111","1111122","1112211","1122111","2111212","2121112","2121211","1121212","1122121","1212112","1112122","1112221");

		// Convert to uppercase
		$upper_text = strtoupper($text);

		for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
			for ( $Y = 0; $Y<count($code_array1); $Y++ ) {
				if ( substr($upper_text, ($X-1), 1) == $code_array1[$Y] )
					$code_string .= $code_array2[$Y] . "1";
			}
		}
		$code_string = "11221211" . $code_string . "1122121";
	}

	// Pad the edges of the barcode
	$code_length = 20;
	if ($print) {
		$text_height = 30;
	} else {
		$text_height = 0;
	}
	
	for ( $i=1; $i <= strlen($code_string); $i++ ){
		$code_length = $code_length + (integer)(substr($code_string,($i-1),1));
        }

	if ( strtolower($orientation) == "horizontal" ) {
		$img_width = $code_length*$SizeFactor;
		$img_height = $size;
	} else {
		$img_width = $size;
		$img_height = $code_length*$SizeFactor;
	}

	$image = imagecreate($img_width, $img_height + $text_height);
	$black = imagecolorallocate ($image, 0, 0, 0);
	$white = imagecolorallocate ($image, 255, 255, 255);

	imagefill( $image, 0, 0, $white );
	if ( $print ) {
		imagestring($image, 5, 31, $img_height, $text, $black );
	}

	$location = 10;
	for ( $position = 1 ; $position <= strlen($code_string); $position++ ) {
		$cur_size = $location + ( substr($code_string, ($position-1), 1) );
		if ( strtolower($orientation) == "horizontal" )
			imagefilledrectangle( $image, $location*$SizeFactor, 0, $cur_size*$SizeFactor, $img_height, ($position % 2 == 0 ? $white : $black) );
		else
			imagefilledrectangle( $image, 0, $location*$SizeFactor, $img_width, $cur_size*$SizeFactor, ($position % 2 == 0 ? $white : $black) );
		$location = $cur_size;
	}
	
	// Draw barcode to the screen or save in a file
	if ( $filepath=="" ) {
		header ('Content-type: image/png');
		imagepng($image);
		imagedestroy($image);
	} else {
		imagepng($image,$filepath);
		imagedestroy($image);		
	}
}*/





