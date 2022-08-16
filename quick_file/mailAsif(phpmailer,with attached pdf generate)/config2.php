<?php
error_reporting(0);
ob_start();
session_start();
header("X-Frame-Options: sameorigin"); 
$server='localhost';
$user='root';
$password='';
$database='schdb';
$dbh = new PDO("mysql:host=$server;dbname=$database", $user, $password);
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$dbh->exec("set names utf8");
$host = $_SERVER['HTTP_HOST'];
//echo $host.'<br>';

$physical_path =  $_SERVER['DOCUMENT_ROOT']."/";
//echo $physical_path;
$installationDir = "chl_new_all/";
$emailSmtpUrlServer = "http://chinahomelife247.com/smtp/index.php"; // temporay email sending server

$salt = 'chlcmxall';

