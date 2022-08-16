<?php

date_default_timezone_set("Asia/Colombo");
#ini_set("display_errors", "1");
error_reporting(0);
session_start();

# Database connectivity
$server = 'localhost';
$user =	'root';
$password	= '';
$database	= 'chl_db';


# Airtel 

# Site configuration
$getStoreUrl = '';
$getSiteUrl	= '';
$getStoreAdminUrl = '';
$physical_path =  $_SERVER['DOCUMENT_ROOT']."/";

$getSkinUrl = $getSiteUrl.'skin/frontend/'; 
$getAdminSkinUrl = $getSiteUrl.'skin/admin/';
$title = ''; 
$footer = '';
# file path of imagesz
$imageFfilePathFrontend = $getStoreAdminUrl."upload/"; // add 'admin' path for frontend
$imageFfilePathBackend = $getStoreAdminUrl."upload/"; 

//pdo
$dbh = new PDO("mysql:host=$server;dbname=$database", $user, $password);

