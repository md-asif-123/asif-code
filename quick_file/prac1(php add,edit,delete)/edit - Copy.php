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
		  
		  if((isset($_FILES['pic'])) && $_FILES['pic']['size']>0){
			  unlink('image/'.$oldpic);
			  $tmp=$_FILES['pic']['tmp_name'];
			  $photo=$_FILES['pic']['name'];
			  $pic=time().'-'.$photo;
			  $dst="image/".$pic;
			  move_uploaded_file($tmp,$dst);
			  
			$sql1="UPDATE register SET name='$name',photo='$pic' WHERE id=$id";
			
		  }
		  else{
		  //$photo=$_POST['pic'];
		$sql1="UPDATE register SET name='$name' WHERE id=$id";
		  }
		  $rec1=mysql_query($sql1);
          
		  if($rec1){
			  header("location:list.php");
		  }
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
		<tr><td>Gender</td><td><input type='radio' name='gend' value='M'/>Male<input type='radio' name='gend' value='F'/>Female</td></tr>
		<tr><td>Country</td><td><select name='coun'>
		<option value=''>Select Country</option>
		<option value=''>India</option>
		<option value=''>Pakistan</option>
		<option value=''>UAE</option></select></td></tr>
		<tr><td>Message</td><td><textarea name='msg' cols='50' rows='5' ></textarea></td></tr>
		<tr><td colspan='2' align='right'><input type='submit' name='submit' value='Go'/></td></tr>
		</table>
		 
	    </form>
		</body>
		</html>
		
		