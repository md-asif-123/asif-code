<?php session_start();?>
<html>
<body>
<form name="regform" method="post" action="register-logincode.php" enctype="multipart/form-data">
<table width='40%' border='2' align='center'>
<tr><td colspan='2' align='center'>Register Login</td></tr>

<tr><td>Email</td>
<td><input type='text' name='ename' /></td></tr>
<tr><td>Password</td>
<td><input type='password' name='password' /></td></tr>
<tr><td colspan='2' align='right'><input type='submit' name='submit' value='SUBMIT'/></td></tr>
</table>
</body></html>