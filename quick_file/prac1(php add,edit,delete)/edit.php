<?php
        require_once('config.php');
        session_start();
		if(!isset($_SESSION['user'])){
			  header('location:loginpage.php');
		  }
		$id=$_GET['id'];
		
		//echo $id;
		$sql="SELECT * FROM register WHERE id=$id";
		$rec=mysql_query($sql);
		$row=mysql_fetch_object($rec);
		$oldpic=$row->photo;
		//echo $oldpic;exit;
		
		$sqlsub="SELECT * FROM subject WHERE uid=$id";
		$recsub=mysql_query($sqlsub);
		//$rowsub=mysql_fetch_row($recsub);
		while($rowsub=mysql_fetch_row($recsub)){
			//echo "asif";
			$sub[]=$rowsub[2];
			//print_r($sub);
		}
		
		if(isset($_POST['submit'])):
		
		  $name=$_POST['fname'];
		  $sub=$_POST['sub'];
		  $gend=$_POST['gend'];
		  $country=$_POST['coun'];
		  if((isset($_FILES['pic'])) && $_FILES['pic']['size']>0){
			  unlink('image/'.$oldpic);
			  $tmp=$_FILES['pic']['tmp_name'];
			  $photo=$_FILES['pic']['name'];
			  $pic=time().'-'.$photo;
			  $dst="image/".$pic;
			  move_uploaded_file($tmp,$dst);
			  
			$sql1="UPDATE register SET photo='$pic' WHERE id=$id";
			$rec1=mysql_query($sql1);
		  }
		
		$sql2="UPDATE register SET name='$name',country='$country',gender='$gend' WHERE id=$id";
		 
		  $rec2=mysql_query($sql2);
          
		  if($rec2){
			 // header("location:list.php");
		  }
		$sql3="DELETE FROM subject WHERE uid=$id";
			 mysql_query($sql3);
			 
		 foreach($sub as $k=>$v){
					
           $sql4="INSERT INTO subject(uid,subject) VALUES ($id,'$v')";
			 mysql_query($sql4);
				    
				}
		  
		header("location:list.php");
		  
        endif;		
		?>
		
		<html>
		<body>
		<a href='list.php'>Profile</a>
		<form name='regEdit' method='post' action='' enctype='multipart/form-data'>
        <?php if(isset($err_msg)): echo $err_msg; endif; ?>
		<table align='center' border='2' width='40%' cellpadding='6'>
		<tr><td  colspan='2' align='center' bgcolor='#cccccc'>Edit Form</td></tr>
		<tr><td>Name</td><td><input type='text' name='fname' value='<?php echo $row->name;  ?>'/></td></tr>
		<tr><td>Photo</td><td><input type='file' name='pic' /><img src='<?php echo "image/".$row->photo; ?>' height='70' width='70'></td></tr>
		<tr><td>Email</td><td><input type='text' name='email' value='<?php echo $row->email;  ?>' size='33' disabled /></td></tr>
		<tr><td>subject</td><td><input type='checkbox' name='sub[]' value='Math' <?php if(in_array('Math',$sub)):echo 'checked'; endif; ?> />Math<input type='checkbox' name='sub[]' value='Physics' <?php if(in_array('Physics',$sub)):echo 'checked'; endif; ?> />Physics<input type='checkbox' name='sub[]' value='Chemistry' <?php if(in_array('Chemistry',$sub)):echo 'checked'; endif; ?> />Chemistry</td></tr>
		<tr><td>Gender</td><td><input type='radio' name='gend' value='M' <?php if($row->gender=='M'):echo 'checked'; endif; ?>/>Male<input type='radio' name='gend' value='F' <?php if($row->gender=='F'):echo 'checked'; endif; ?>/>Female</td></tr>
		<tr><td>Country</td><td><select name='coun' multiple='multiple'>
		<option value=''>Select Country</option>
		<option value='India' <?php if($row->country=='India'):echo 'selected'; endif; ?>>India</option>
		<option value='Pakistan' <?php if($row->country=='Pakistan'):echo 'selected'; endif; ?>>Pakistan</option>
		<option value='UAE' <?php if($row->country=='UAE'):echo 'selected'; endif; ?>>UAE</option></select></td></tr>
		<tr><td>Message</td><td><textarea name='msg' cols='50' rows='5' ></textarea></td></tr>
		<tr><td colspan='2' align='right'><input type='submit' name='submit' value='Go'/></td></tr>
		</table>
		 
	    </form>
		</body>
		</html>
		
		