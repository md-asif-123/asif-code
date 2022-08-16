<?php session_start();

if(isset($_POST['submit']))
{
	
	require_once('config1.php');
	
	$email=$_POST['ename'];
	$pass=$_POST['password'];
	$sql="SELECT * FROM register WHERE email='$email' AND password='$pass'";
	$rec=mysql_query($sql);
    while($row=mysql_fetch_row($rec))
	{
		$_SESSION['username']=$row[0];
		header("location:getin.php");
	}
	
}
?>