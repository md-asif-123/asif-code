<?php
    class Insertmodel extends CI_Model {

		function __construct()
		{
				
		}
		
		
		function Fetch_Data($db)
		{
		
		$query = $this->db->get($db);
		return $query; 
	
		}	
		
		
		function Get_Scorebyid($id)
		{
		$this->db->where('id', $id);
		$query = $this->db->get('score');

		return $query->row(); 
	
		}	

		function Get_Scorebychildid($id){
		$this->db->where('parent_id', $id);
		$query = $this->db->get('score');
		return $query;  	
			
		}
				
	
		function insert_db($filename)
		{
			
			
			$message= $this->input->post('comments');
			
		$word_count=41;
		
		$this->db->where('parent_id', '34');
			$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
			foreach($query->result() as $row){
			
			$end = $row->value;
			$unit_value[]=$row->value;
		
			}
			
		$num = $query->num_rows();
		
		$i=0;
		$j=1;
		
			
		
		for($x=0;$x<$num-1;$x++){
			
		if(1<=$word_count && $word_count<=$unit_value[0]){
		$start=1;
		$end=$unit_value[0];
				
		
		$this->db->where('value', $end);
		$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
		$row=$query->row(); // the data
		
		
		$score_unitprice=$row->score;	
		}
			
			
		
		$start1=$unit_value[$i];
		
		$start=$start1+1;
		
		$end=$unit_value[$j];
		  
		
		
		if($start<=$word_count && $word_count<=$end){
			
		
		$this->db->where('value', $end);
		$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
		$row=$query->row(); // the data
		
		
		$score_unitprice=$row->score;		
			
		}	
		
		
		$start = $start+1;
		
		$i++;
		$j++;
		
		
		
		
			
		}
			
		
		 
		 
		echo $score_unitprice ;
		 
		 
		 exit;
		 
		 
		
			
			
		//start for comments word check
			
		if(0<$word_count && $word_count<=10)
			{
					
			$this->db->where('value', 10);
			$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
			$row=$query->row(); // the data
			$score_enquiredescription=$row->score;
			
			}
		
		else
			{
			$this->db->where('parent_id', '34');
			$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
			foreach($query->result() as $row){
			$message='5';
			$end = $row->value;
			$my_value[]=$row->value;
			}
		$i=0;
		$j=1;
		
		for($x=0;$x<9;$x++)
		
		{
		
		$start=$my_value[$i];
		$end=$my_value[$j];

		if($start<=$word_count && $end<=$word_count){
			
		$end=$my_value[$j];
		$this->db->where('value', $end);
		$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
		$row=$query->row(); // the data
		$score_enquiredescription=$row->score;		
			
		}	
		
		$i++;
		$j++;	
			
		}
		
		
		}
		//end comments word check
			
			
		exit;
		
		
		
		$company_name=$this->input->post('companyname');
		if($company_name!=''){
			
			$this->db->where('id', '13');
			$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
			$row=$query->row(); // the data
			$score_companyname=$row->score;
			
			
		
		}
		
		if($company_name=''){
			
			$this->db->where('id', '14');
			$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
			$row=$query->row(); // the data
			$score_companyname=$row->score;
		
		}
		
		
		
		$filename;
		
		if($filename!='N'){
			
			$this->db->where('id', '53');
			$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
			$row=$query->row(); // the data
			echo $score_attachedment=$row->score;
			
			
		
		}
		
		if($filename='N'){
			
			$this->db->where('id', '54');
			$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
			$row=$query->row(); // the data
			$score_attachedment=$row->score;
		
		}
		
		
		
		
		
		//start for email check		
			
			$email=$this->input->post('email');
			if($email!='')
			{
			$exp=explode('@',$email);
			$extention = $exp[1];
			$this->db->where('email_id', $extention);
			$this->db->select('*');
			$query = $this->db->get('email_check'); //get all data from user_profiles table that belong to the respective user
			$num = $query->num_rows();
			
			if ($num>0){
				
			$this->db->where('id', '28');
			$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
			$row=$query->row(); // the data
			echo $score_email=$row->score;	
			
			}
			
			if ($num==0){
			
			$score_email=0;		
				
				
			}
			
		
			
		}
		
		
		//end for email check
		
	
		
	
		$message=$this->input->post('needsample');
		
		
		//start for telephone number check
		
		$tele_phone=$this->input->post('telephone');
		
		if (is_numeric($tele_phone)) {
        $this->db->where('id', '29');
			$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
			$row=$query->row(); // the data
			echo $score_telephone=$row->score;
		} 
		
		else {
        $score_telephone=0;
		}
		
		//end for telephone number check
		
		$fax=$this->input->post('fax');
		
		if (is_numeric($fax)) {
        $this->db->where('id', '30');
			$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
			$row=$query->row(); // the data
			echo $score_fax=$row->score;
		} 
		
		else {
        echo $score_fax=0;
		}
		
		//start for mobile number check
		
		
		echo $mobile=$this->input->post('mobile');
		
		if (is_numeric($mobile)) {
        $this->db->where('id', '31');
			$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
			$row=$query->row(); // the data
			echo $score_mobile=$row->score;
		} 
		
		else {
        echo $score_mobile=0;
		}
		
		//end for mobile number check
		
		
		//start for website check
		echo $url=$this->input->post('website');
		
		if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
		
		$this->db->where('id', '32');
			$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
			$row=$query->row(); // the data
			echo $score_website=$row->score;
		} else {
		
		$this->db->where('id', '33');
			$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
			$row=$query->row(); // the data
			echo $score_website=$row->score;
		
		}
		
		//end for website check
		
		//total contact information
		
		$score_contactinformation=$score_fax+$score_mobile+$score_telephone+$score_email+$score_website;
		
		
		
		
		//total unit price
		
		
		?><br/><?
		$price=$this->input->post('unitprice');
		
		$this->db->where('parent_id', '45');
			$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
			foreach($query->result() as $row){
			
			$end = $row->value;
			$unit_value[]=$row->value;
		
			}
			
		$num = $query->num_rows();
		
		$i=0;
		$j=1;
		
		
		for($x=0;$x<$num-1;$x++){
			
		if(1<=$price && $price<=$unit_value[0]){
		$start=1;
		$end=$unit_value[0];
				
		
		$this->db->where('value', $end);
		$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
		$row=$query->row(); // the data
		
		
		$score_unitprice=$row->score;	
			}
			
			
		
		 $start=$unit_value[$i];
		 $end=$unit_value[$j];	
		
		
		
		if($start<=$price && $price<=$end){
			
		$end=$unit_value[$j];
		$this->db->where('value', $end);
		$query = $this->db->get('score'); //get all data from user_profiles table that belong to the respective user
		$row=$query->row(); // the data
		
		
		$score_unitprice=$row->score;		
			
		}	
		
		
		
		
		$i++;
		$j++;
		
		
		
		
			
		}
			
		 $score_unitprice=$row->score;
		
		// Country score
		
		
		$country_score=$this->input->post('country');
		
		$industry_score=$this->input->post('industry');
		
		exit;
		
		
		
		$message=$this->input->post('comments');	
		$key="AIzaSyAyWQYSko3EH_GgO4gOcPgK5jg-CqMai9g";
		$url = "https://www.googleapis.com/language/translate/v2?key=$key&target=de&q=$message";
		header('Content-Type: application/json; charset=utf-8');
		$postData = '';
		$ch = curl_init();	
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
		curl_setopt($ch,CURLOPT_HEADER, false);
		$output=curl_exec($ch);					
		$err = false;
		$err_msg = '';
		if($output === false) { 			
			$err_msg = 'Error: ' . curl_errno($ch).' '. curl_error($ch); 
			$err = true;
		}
		curl_close($ch);
		if($err == 'true')
			return $err_msg;
		else

			$aa=$output;

			
		$json=json_decode($aa,'JSON_UNESCAPED_UNICODE');
	
		$detected_language_code=$json['data']['translations'][0]['detectedSourceLanguage'];
		
		
		
		$this->db->set('name', $this->input->post('name'));
		$this->db->set('email', $this->input->post('email'));
		$this->db->set('website', $this->input->post('website'));
		$this->db->set('tele_phone', $this->input->post('telephone'));
		$this->db->set('fax', $this->input->post('fax'));
		$this->db->set('mobile', $this->input->post('mobile'));
		$this->db->set('country', $this->input->post('country'));
		$this->db->set('company_name', $this->input->post('companyname'));
		$this->db->set('industry', $this->input->post('industry'));
		$this->db->set('business_type', $this->input->post('businesstype'));
		$this->db->set('unit_price', $this->input->post('unitprice'));
		$this->db->set('need_sample', $this->input->post('needsample'));
		$this->db->set('attached', $filename);
		$this->db->set('user_history', $this->input->post('userhistory'));
		$this->db->set('data_source', $this->input->post('datasource'));
		
		$this->db->set('comments', $this->input->post('comments'));
		
		$this->db->set('detected_languagecode', $detected_language_code);
		$this->db->set('ipaddress', $_SERVER['REMOTE_ADDR']);
		
		$query=$this->db->insert('enquires');
		
		return $query;
	
			  
		}
	 
// for sending message code

		public function send_message(){
			
		
		$query = $this->db->get('enquires');

		
		
		
		foreach($query->result() as $row){
			
			$manual_language_code=$row->manual_languagecode;
			$detected_language_code=$row->detected_languagecode;
		
			
		
// condition for manual language and detected language exist
		
		   if($manual_language_code && $detected_language_code){ 
			
			$language_code=$row->manual_languagecode;
			
			}
			
			elseif(!$manual_language_code && $detected_language_code){ 
			
			
			$language_code=$row->detected_languagecode;
			
			}
			
			elseif($manual_language_code && !$detected_language_code){ 
			
			
			echo $language_code=$row->manual_languagecode;
			
			}
			
			else {
				
				echo "Unsupported language format";
			}
			
			
			$comment=$row->comments;
			$industry=$row->industry;
			$email=$row->email;
			$enquiry_id=$row->id;
			echo $company_name=$row->company_name;
			//echo $language_code;
			
			
			$this->db->select('language_code');
			//$this->db->distinct('language_code');
			$this->db->where('industry', $industry);
			$language = $this->db->get("company_details");
			foreach ($language->result() as $row)
					{
					
				    echo $row->language_code;
					//echo $row->company_name;
					
					
					$data = array(
					
					'industry_id' => "$industry" ,
					'language_code' => "$language_code"
					);

					$this->db->insert('translated_message', $data); 
					
					
				  
				}
			
			$row = $language->row_array();
			//echo $row['language_code'];

			$this->db->select('language_code');
			//$this->db->distinct('language_code');
			$this->db->where('industry', $industry);
			$fetch_language = $this->db->get("company_details");
			
			
			
			
			echo $fetch_language->num_rows();
			
			foreach ($fetch_language->result() as $row)
					{
					
				    $row->language_code;
				  
				}
				
			$this->db->where('industry',$industry);
			$fetch_data = $this->db->get('company_details');			
			
			
			foreach ($fetch_data->result() as $row)
					{
				  
				    $row->email;
					$row->language_code;
				
			
				}
				
				
				
				
			
			
		
		 
			
		}
		
		
			

		 
	 }	


			//$row = $query->row();
			//echo $row->language_code;	 

 }