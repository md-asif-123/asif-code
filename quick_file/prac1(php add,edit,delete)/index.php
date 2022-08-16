
        <?php
		   require_once('config.php');
		   //session_start();
		  // if(!isset($_SESSION['user'])){
			//   header('location:loginpage.php');
		  // }
		  if(isset($_POST['submit'])){
		       require_once('mailFunction.php');			  
		      $fname=$_POST['fname'];
			  $email=$_POST['email'];
		      $pass=$_POST['pass'];
			  $sub=$_POST['sub'];
			  $gend=$_POST['gend'];
			  $country=$_POST['coun'];
			  $message=$_POST['msg'];
			  //print_r($sub);exit;
			  $file = $_FILES['pic']['tmp_name'];
             //echo $file;
			  if(empty($fname)){
			     $err_msg="please enter your name";
			  }
			   elseif (!file_exists($file))
              {	
                 	$err_msg="please upload";	  
			  }
			  elseif(empty($email)){
			      $err_msg="please enter email";
			  }
			  elseif(empty($pass)){
                  $err_msg="please enter password";
			  }
			  
			  else{ 
			     if((isset($_FILES['pic'])) && $_FILES['pic']['size']>0){
			  
			      $tmp=$_FILES['pic']['tmp_name'];
				 // echo $tmp;exit;
				  if(is_uploaded_file($tmp)){
				      $oname=$_FILES['pic']['name'];
					  $pic=time().'_'.$oname;
					  $file_ext   = pathinfo($pic, PATHINFO_EXTENSION);
			         //echo $file_ext;exit;
			        $expensions = array('jpeg', 'jpg', 'png', 'gif');
					if( in_array($file_ext, $expensions) ){
						if( !file_exists('image') ):
							mkdir('image', 0777, true);
						endif;
					
					  $dest="image/".$pic;
					  move_uploaded_file($tmp,$dest);
					}
				  }
			  }
			  
			   $file_ext   = pathinfo($pic, PATHINFO_EXTENSION);
			   //echo $file_ext;exit;
			  $expensions = array('jpeg', 'jpg', 'png', 'gif');
					if( !in_array($file_ext, $expensions) ){
						$err_msg="not a valid extension";
					}
					else{
						//mkdir('images', 0777, true);
		        //echo "asif";exit;
		      echo $sql="INSERT INTO register(name,email,gender,password,photo,country,msg) VALUES('$fname','$email','$gend','$pass','$pic','$country','$message')";
				
              		  
				// $sql=mysql_query("INSERT INTO register SET `name`='".$name."',`email`='".$email."',`password`='".$pass."'");
				 
				if(mysql_query($sql)){
				    echo "inserted successfully";
				}
				$uid=mysql_insert_id();
				
				foreach($sub as $k=>$v){
					
              $sql1="INSERT INTO subject(uid,subject) VALUES ($uid,'$v')";
			  if(mysql_query($sql1)){
				    
				}
				
			  }	
					}
			  }
			$mailTemplate = new mailTemplate();
			
            $sql2="select * from register where id=$uid";
            $rec2=mysql_query($sql2);
		    $row2=mysql_fetch_object($rec2);
            $msg=$row2->msg; 			
				
			$subject = 'You have successfully registered from mailContact ';
			$message = '<html><body>';				
		    $message .= '<h1 style="color:#000000;text-align:left">Your Message: '.$msg.'</h1>';
			$message .= '<h1 style="color:#000000;text-align:left">Thank you for your registration.</h1>';		
			
			$message .= '</body></html>';
		
		
		
		
			
			$user_data = array(
								'receiver_email' => $email,
								'receiver_name' => 'asif',
								'subject' => $subject,
								'message' => $message,								
								//'files' => array($pdfPhysicalPath.$code.'.pdf')
							  );
			
			$mailTemplate->sendMailWithAttachment($user_data);
		
		
		
		//echo "message sent";	
		  }				
        ?>
		
		<html>
		<body>
		<a href='loginpage.php'>Login</a>
		<a href='list.php'>View</a>
		<form name='regLogin' method='post' action='' enctype='multipart/form-data'>
        <?php if(isset($err_msg)): echo $err_msg; endif; ?>
		<table align='center' border='2' width='40%' cellpadding='6'>
		<tr><td  colspan='2' align='center' bgcolor='#cccccc'>Register</td></tr>
		<tr><td>Name</td><td><input type='text' name='fname' value='<?php if(isset($fname)): echo $fname; endif; ?>'/></td></tr>
		<tr><td>Photo</td><td><input type='file' name='pic' value='<?php  echo "asif"; ?>'/></td></tr>
		<tr><td>Email</td><td><input type='text' name='email' value='<?php if(isset($email)): echo $email; endif; ?>'/></td></tr>
		<tr><td>Password</td><td><input type='password' name='pass' value='<?php if(isset($pass)): echo $pass; endif; ?>'/></td></tr>
		<tr><td>subject</td><td><input type='checkbox' name='sub[]' value='Math' />Math<input type='checkbox' name='sub[]' value='Physics' />Physics<input type='checkbox' name='sub[]' value='Chemistry' />Chemistry</td></tr>
		<tr><td>Gender</td><td><input type='radio' name='gend' value='M'/>Male<input type='radio' name='gend' value='F'/>Female</td></tr>
		<tr><td>Country</td><td><select name='coun'>
		<option value=''>Select Country</option>
		<option value='India'>India</option>
		<option value='Pakistan'>Pakistan</option>
		<option value='UAE'>UAE</option></select></td></tr>
		<tr><td>Message</td><td><textarea name='msg' cols='50' rows='5' ></textarea></td></tr>
		
		
		<tr><td colspan='2' align='right'><input type='submit' name='submit' value='Go'/></td></tr>
		</table>
		 
	    </form>
		</body>
		</html>
		