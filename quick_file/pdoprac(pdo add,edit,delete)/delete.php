<?php

require_once('config.php');
$id=$_GET['id'];
$sql="DELETE FROM registration WHERE id=:id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$result=$stmt->fetchAll();
		
		
$id1=$_POST['list'];
print_r($id1);
foreach ($id1 as $msg_id):
         $sql="DELETE FROM registration WHERE id=:id";
		 
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$msg_id));
		$result=$stmt->fetchAll();
		echo $sql;

    endforeach;	
		header("location: table.php");
		
			


?>