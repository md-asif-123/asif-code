<?php

  if(isset($_POST['submit']))
	 
     
  {
	 
			  
	  include_once('config.php');
	  
     
	  if((isset($_FILES['pic'])) && $_FILES['pic']['size']>0)
	  {
	   
		  $tmp=$_FILES['pic']['tmp_name'];
		  
		 if(is_uploaded_file($tmp))
		   {
			  $oname=$_FILES['pic']['name'];
              $name=time().'-'.$oname;
			  
              $dst="image/pic/".$name;
              move_uploaded_file($tmp,$dst);			  
		   }
	  }
  }
?>