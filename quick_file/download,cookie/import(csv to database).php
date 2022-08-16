<?php
error_reporting(0);
ini_set('max_execution_time', 0); //0=NOLIMIT
mysql_connect("localhost","root","");
mysql_select_db("schdb");
$f = fopen("asif.csv", "r");
$i=0;
while (($line = fgetcsv($f)) !== false) {
	if($i != 0){
	mysql_query("INSERT INTO `msite` SET 
				`name` = '".mysql_real_escape_string(stripslashes(trim($line[0])))."', 
				`password`  = '".mysql_real_escape_string(stripslashes(trim($line[1])))."'			
				
				");        
	}
	$i++;
}
fclose($f);
?>