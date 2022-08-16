<?php
require_once('config1.php');
$firstname=$_POST['n'];
$email=$_POST['e'];
$mobile=$_POST['m'];
$pro1=$_POST['p1'];
$pro2=$_POST['p2'];
$pro3=$_POST['p3'];
$quant=$_POST['q'];
$date=$_POST['d'];

$sql="INSERT INTO enquiry(firstname,email,mobile_no,product1,product2,product3,quantity,date)VALUES('$firstname','$email','$mobile','$pro1','$pro2','$pro3','$quant','$date')";
if(mysql_query($sql))
{
	echo "entered into database";
}
else
{
	echo "not entered";
}
?>