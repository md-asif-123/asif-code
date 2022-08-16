<?php
#include the database
require_once('config.php') ;



			
			
			$sql="SELECT * FROM registration";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$result=$stmt->fetchAll();
		
		
		
		
		
?>

<!DOCTYPE HTML>
<html>
<body>
<head>
<script src="validation.js" type="application/javascript"></script>
<script type="text/javascript" src="test.js"></script>
</head>
<form name="regForm" id="regForm" action="delete.php" method="post">
<table border='2' width='70%' align='center'>

<tr><td colspan='10' bgcolor='#cccccc'align='center'><b>Student List&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href='pdoReg.php'> Add Student</a></b></td></tr>
<tr><td><input type='checkbox' name='check' onclick="checkedAll(regForm);" /></td><td>#</td><td>Name</td><td>Class</td><td>Age</td><td>Address</td><td>Gender</td><td>Hobby</td><td>Edit</td><td>Delete</td></tr>
	
          
		  <?php
		foreach($result as $row)
		{
            echo "<tr><td><input type='checkbox' name='list[]' value='".$row[0]."' /></td><td>".$row[0]."</td><td><a href='viewprofile.php?id=".$row[0]."'>".$row['name']."</a></td><td>".$row['class']."</td><td>".$row['age']."</td><td>".$row['address']."</td><td>".$row['gender']."</td><td>"?>
			<?php
			
			$sql1="SELECT * FROM hobby WHERE uid=$row[0]";
		$stmt1 = $dbh->prepare($sql1);
		$stmt1->execute();
		$result1=$stmt1->fetchAll();
			foreach($result1 as $row1)
		{
			
			echo $row1[2].' ';
			
		}
		?>
			<?php echo
			"</td><td><a href='edit.php?id=".$row[0]."'>edit</a></td><td><a href='delete.php?id=".$row[0]."' onclick='return doDelete();'>delete</a></td></tr>"; 
            
		}
			?>
          
		 
         
        <td colspan='10'><input type="submit" name="submit" value="Delete" onclick="return checkboxes();" /></td>
      </table>
	  
	  </form>
      

</body>
</html>



