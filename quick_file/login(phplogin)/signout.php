<?php

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (isset($_SESSION['username'])) {
	session_destroy();
header('location:register-login.php');
}
?>
<div class="main signout">
	<div class="page-title">
        <h2>Signout</h2>
    </div> 
    <div class="messages success">
  		You have successfully signout
    </div>
</div>    

