<?php


  if(isset($_POST['submit']))
  {  
    include_once('config.php');
  $id=$_POST['id'];
  //echo $_POST['oldpic'];exit;	
  if(isset($_POST['oldpic']))
  {
	$oi=$_POST['oldpic'];
	//echo $oi;exit;
  }
  if(isset($_FILES['pic']) && $_FILES['pic']['size']>0)
  {
	  $tmp=$_FILES['pic']['tmp_name'];
	  if(is_uploaded_file($tmp))
	  {
		  $oname=$_FILES['pic']['name'];
		  $name=time().'-'.$oname;
		  $dst="image/pic/".$name;
		  move_uploaded_file($tmp,$dst);
		  if(file_exists("image/pic/".$oi))
		  {
			  unlink("image/pic/".$oi);
		  }
	  }
	  $sql = "UPDATE `photo` SET `photo` = '".$name."' WHERE `id` = '".$id."'";		
		//exit;
		$stmt = $dbh->prepare( $sql );
		$stmt->execute();
		 header("location:view.php");
  }
  else
  {
	  header("location:view.php");
  }
 
  }
?>
