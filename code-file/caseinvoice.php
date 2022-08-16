<?php
include "config/config.php";
include "lib/function.php";

$id = $_POST['id'];
$is_check = $_POST['is_check'];

$updateInvoiceStatus = updateInvoiceStatus($conn,$id,$is_check);

$total = "<h3>Success<h3>";
//$total .= "<h3>Section Name1: ".$is_check."<h3>";
//$total .= "<h3>Section Name2: ".$updateInvoiceStatus['message']."<h3>";

$arr = array('total' => $total);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($arr);
  exit;

?>