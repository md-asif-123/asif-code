<?php

if(isset($_POST['submit']))
{
	
	require_once('config1.php');
	$name=$_POST['fname'];
	
	$email=$_POST['ename'];
	$pass=$_POST['password'];
	$sql="INSERT INTO register(name,email,password)VALUES('$name','$email','$pass')";
	
	if(mysql_query($sql))
	{
		echo "registered successfully";
	}
	else
	{
		echo "not registered";
	}
}
?>