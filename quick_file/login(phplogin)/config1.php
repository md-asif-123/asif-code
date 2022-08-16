<?php
$host='localhost';
$user='root';
$pass='';
$con=mysql_connect($host,$user,$pass);
$db=mysql_select_db('registerdb');
if($db)
{
	echo 'connected to database successfully';
	
}
else
{
	echo 'not connected';
}
?>