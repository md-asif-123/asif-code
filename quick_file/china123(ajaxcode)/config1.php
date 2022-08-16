<?php


$server = 'localhost';
$user =	'root';
$password	= '';
$database	= 'chl_db';

$con=mysql_connect($server,$user,$password);
$db=mysql_select_db($database);
if($db)
{
	echo "";
}
?>