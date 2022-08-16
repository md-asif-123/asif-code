<?php
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('http://192.168.0.74/china123', 'w');

// output the column headings
$list = array('firstname', 'surname', 'email');
fputcsv($output, $list);

// fetch the data
mysql_connect('localhost', 'root', '');
mysql_select_db('china');
$rows = mysql_query('SELECT firstname,surname,email FROM product');

// loop over the rows, outputting them
while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
?>