<?php

require_once('config.php');
$id=$_GET['id'];
$sql="SELECT * FROM registration WHERE id=:id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$result=$stmt->fetchAll();
		
$sql1="SELECT * FROM hobby WHERE uid=:id";
		$stmt1 = $dbh->prepare($sql1);
		
		$stmt1->execute(array(':id'=>$id));
		$result1=$stmt1->fetchAll();
		foreach($result1 as $row1)
		{
			$hobbyArray[] = $row1['2'];
			//print_r($hobbyArray);
			echo $row1[2];
		}
		
	      
		?>

<!DOCTYPE HTML>
 <?php
		foreach($result as $row)
		{
			?>
<html>
<body>
<form name='regForm' method='post' action='pdoRegUpdate.php'>
<input type='hidden' name='id' value='<?php echo $row[0] ?>'/>
<table border='2' width='70%' align='center'>
<tr><td colspan='7' bgcolor='#cccccc'align='center'><b>Edit Form</b></td></tr>

	
          
		 
           <tr><td>Name</td><td><input type='text' name='fname' value='<?php echo $row[1] ?>'/></td></tr>
		   <tr><td>Class</td><td><input type='text' name='class' value='<?php echo $row[2] ?>'/></td></tr>
		   <tr><td>Age</td><td><input type='text' name='age' value='<?php echo $row[3] ?>'/></td></tr>
		   <tr><td>Address</td><td><input type='text' name='address' value='<?php echo $row[4] ?>'/></td></tr>
		   <tr><td>Gender</td><td><input type='radio' name='gend' value='m'<?php if($row[5]=='m') echo 'checked' ?>/>Male<input type='radio' name='gend' value='f'<?php if($row[5]=='f') echo 'checked' ?>/>Female</td></tr>
		   <tr><td>Hobby</td><td>
		   <input type='checkbox' name='hobby[]' value='cricket'<?php if(in_array('cricket', $hobbyArray)) echo 'checked'; ?>/>cricket
		   <input type='checkbox' name='hobby[]' value='football'<?php if(in_array('football', $hobbyArray)) echo 'checked'; ?>/>football
		   <input type='checkbox' name='hobby[]' value='swimming'<?php if(in_array('swimming', $hobbyArray)) echo 'checked'; ?>/>swimming
		   </td></tr>
           <tr><td colspan='2' align='right' bgcolor='#cccccc'><input type='submit' name='submit' value='UPDATE'/></td></tr>
		<?php   
		}
		
			?>
          
		 
         
        
      </table>
	  </form>
      

</body>
</html>