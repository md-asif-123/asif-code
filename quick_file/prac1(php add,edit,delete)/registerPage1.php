
        <?php
		   require_once('config.php');
		  if(isset($_POST['submit'])){
		      			  
		      $fname=$_POST['fname'];
			  $email=$_POST['email'];
		      $pass=$_POST['pass'];
			  //$photo=$_POST['pic'];
		       //echo $fname;exit;
		      if((isset($_FILES['pic'])) && $_FILES['pic']['size']>0){
			  
			      $tmp=$_FILES['pic']['tmp_name'];
				 // echo $tmp;exit;
				  if(is_uploaded_file($tmp)){
				      $oname=$_FILES['pic']['name'];
					  $pic=time().'_'.$oname;
					  $dest="image/".$pic;
					  move_uploaded_file($tmp,$dest);
				  }
			  }
			   $file_ext   = pathinfo($pic, PATHINFO_EXTENSION);
			 // echo $file_ext;exit;
			  $expensions = array('jpeg', 'jpg', 'png', 'gif');
					if( !in_array($file_ext, $expensions) ){
						$err_msg="not a valid extension";
					}
					
			  	
			  elseif(empty($fname)){
			     $err_msg="please enter name";
			  }
			  elseif(empty($email)){
			      $err_msg="please enter email";
			  }
			  elseif(empty($pass)){
                  $err_msg="please enter password";
			  }
			  
			  else{ 
			     
		        //echo "asif";exit;
		      $sql="INSERT INTO register(name,email,password,photo) VALUES('$fname','$email','$pass','$pic')";
				 
				// $sql=mysql_query("INSERT INTO register SET `name`='".$name."',`email`='".$email."',`password`='".$pass."'");
				 
				if(mysql_query($sql)){
				    echo "inserted successfully";
				}
			  }
				
		  }				
        ?>
		<html>
		<body>
		<form name='regLogin' method='post' action='' enctype='multipart/form-data'>
        <?php if(isset($err_msg)): echo $err_msg; endif; ?>
		<table align='center' border='2' width='40%' cellpadding='6'>
		<tr><td  colspan='2' align='center' bgcolor='#cccccc'>Register</td></tr>
		<tr><td>Name</td><td><input type='text' name='fname' value='<?php if(isset($fname)): echo $fname; endif; ?>'/></td></tr>
		<tr><td>Email</td><td><input type='text' name='email' value='<?php if(isset($email)): echo $email; endif; ?>'/></td></tr>
		<tr><td>Password</td><td><input type='password' name='pass' value='<?php if(isset($pass)): echo $pass; endif; ?>'/></td></tr>
		<tr><td>Photo</td><td><input type='file' name='pic'/></td></tr>
		
		<tr><td colspan='2' align='right'><input type='submit' name='submit' value='Go'/></td></tr>
		</table>
		 
	    </form>
		</body>
		</html>