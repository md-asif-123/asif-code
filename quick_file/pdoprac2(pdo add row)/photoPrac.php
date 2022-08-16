<?php

  if(isset($_POST['submit']))
	 
     
  {  
         include_once('config.php');
     $i=0;
	  foreach($_FILES['pic']['name'] as $k)
	  {
		 
		  if((isset($_FILES['pic'])) && $_FILES['pic']['size']>0)
	  {
	
		  $tmp=$_FILES['pic']['tmp_name'][$i];
		  
		 if(is_uploaded_file($tmp))
		   {
			  $oname=$_FILES['pic']['name'][$i];
              $name=time().'-'.$oname;
			  
              $dst="image/pic/".$name;
              move_uploaded_file($tmp,$dst);			  
		   }
	  }
	  
		 $sql = "INSERT INTO `photo` (`photo`) 
			VALUES (:photo)";
			$stmt = $dbh->prepare( $sql );
			$count=$stmt->execute(array(':photo'=>$name));
            if($count>0)
			{
				header("location:view.php");
			}
            else
			{
				echo "photo not inserted";
			}
	
		  $i++;
		  
	  }
	  
  }
  ?>