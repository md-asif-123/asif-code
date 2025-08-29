<?php
   session_start();
   // save

      include('db-config.php');
      include('srb-function.php');


         $data["login_id"]    = $_SESSION['login_id'];
         $data['record_time'] = $_POST['created_date'];
         //srb_log($data);
         srb_logout_record($data, $analytics_connection);
         
      

   unset($_SESSION["name"]);
   unset($_SESSION["email"]);
   //header('Refresh: 2; URL = ../index.php');
?>