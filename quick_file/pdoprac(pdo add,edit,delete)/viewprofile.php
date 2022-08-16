<?php

require_once('config.php');
$id=$_GET['id'];
$sql="SELECT * FROM registration WHERE id=:id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$result=$stmt->fetchAll();
		
		


?>
<!DOCTYPE HTML>
<html>
<body>
<table border='2' width='70%' align='center'>
<tr><td colspan='7' bgcolor='#cccccc'align='center'><b>Details</b></td></tr>
<tr><td>#</td><td>Name</td><td>Class</td><td>Age</td><td>Address</td></tr>
	
          
		  <?php
		foreach($result as $row)
		{
            echo "<tr><td>".$row[0]."</td><td>".$row['name']."</td><td>".$row['class']."</td><td>".$row['age']."</td><td>".$row['address']."</td></tr>"; 
            
		}
			?>
          
		 
         
        
      </table>
      

</body>
</html>