<?php

// Inialize session
session_start();
//$user = $_SESSION['username'];exit;
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
	
header('location:register-login.php');
}
?>
<html>

<head>
<title>Secured Page</title>
</head>

<body>

<p>This is secured page with session: <b><?php echo $_SESSION['username']; ?></b>
<br>You can put your restricted information here.</p>
<p><a href="signout.php">Logout</a></p>

</body>

</html>