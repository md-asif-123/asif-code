<?php
$cookie_name = "user";
$cookie_value = "asif Doe";
setcookie($cookie_name, $cookie_value, time()+10, "/"); // 86400 = 1 day
?>