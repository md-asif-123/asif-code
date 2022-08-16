
<?php
include_once('test1_cookie.php');
if(!isset($_COOKIE[$cookie_name])) {
     echo "logout!";
} else {
     echo "Cookie '" . $cookie_name . "' is set!<br>";
     echo "Value is: " . $_COOKIE[$cookie_name];
}
?>