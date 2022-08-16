<?php
include_once('config.php');
  $id=$_GET['id'];
  $sql="SELECT * FROM photo where id=$id";
  $stmt=$dbh->prepare($sql);
  $stmt->execute();
  $result=$stmt->fetchAll();
  
?>

<html>
<body>
<?php
foreach($result as $row)
{
	echo $row[0];
	?>
<form name="myForm" method="post" action="update.php" enctype="multipart/form-data">
<input type='hidden' name='id' value='<?php echo $row[0] ?>'/>
<table id='test' border='2' width='40%'>
<tr><td colspan='2' align='center' bgcolor='#cccccc'><b>Upload Image&nbsp&nbsp&nbsp <a href='view.php'>View All Image</a></b></td></tr>


<tr><td><input type='file' name='pic'/></td><td><img src='image/pic/<?php echo $row[1] ?>' height=60px width=60px>
<input type='hidden' name='oldpic' value='<?php echo $row[1] ?>'/></td></tr>
<?php
}
?>
</table>
<table border='2' align='center'>

<input type='submit' name='submit' value='UPDATE'>

</table>
</form>
</body>
</html>