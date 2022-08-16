<?php
include_once('config.php');

  
  $id=$_GET['id'];
  
   $id=$_GET['id'];
  $sql="SELECT * FROM photo where id=$id";
  $stmt=$dbh->prepare($sql);
  $stmt->execute();
  $result=$stmt->fetchAll();
  foreach($result as $row)
{
	$op=$row[1];
	unlink("image/pic/".$op);
}
  
  
  
$sql1="DELETE FROM photo WHERE id=:id";
		$stmt1 = $dbh->prepare($sql1);
		$stmt1->execute(array(':id'=>$id));
		$result1=$stmt1->fetchAll();
		if($result1>0)
		{
			header("location:view.php");
		}
?>
