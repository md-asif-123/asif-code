<?php
include_once('config.php');
  $sql="SELECT * FROM photo";
  $stmt=$dbh->prepare($sql);
  $stmt->execute();
  $result=$stmt->fetchAll();
  
 
?>

<html>
<body>


<table id='test' border='2' width='25%'>
<tr><td colspan='4' align='center' bgcolor='#cccccc'><b>Image</b></td></tr>
<?php
foreach($result as $row)
		{
			
echo"<tr><td>".$row[1]."</td><td><img src='image/pic/".$row[1]."' height='60px' width='60px'></td><td><a href='delete.php?id=$row[0]'>Delete</a></td><td><a href='edit.php?id=$row[0]'>Edit</a></td></tr>";
		}
?>
</table>

</body>
</html>