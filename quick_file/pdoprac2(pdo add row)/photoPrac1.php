<?php

  if(isset($_POST['submit']))
	 
     
  {  
     $i=0;
	  foreach($_FILES['pic']['name'] as $k)
	  {
		 
		  print_r($_FILES['pic']['tmp_name'][$i]);
		  echo "<bR>";
		  
		  $i++;
		  
	  }
	  
  }
  ?>