
<html>

<body>

<?php echo validation_errors(); ?>
<form action="<?php echo base_url();?>" method="post">
<table border='2' width='40%' height='40%' align='center' cellpadding='6' cellspacing='6'>
<tr><td colspan='2' align='center' bgcolor='#cccccc'><b>Login&nbsp&nbsp&nbsp <a href='<?php echo base_url(); ?>index.php/index/user_add'>Add User</a></b></td></tr>

<tr><td>Name</td><td><input type='text' name='lname' /></td></tr>

<tr><td>Password</td><td><input type='password' name='pass' /></td></tr>

<tr><td colspan='2' align='right' bgcolor='#cccccc'><input type='submit' name='submit' value='SUBMIT'/></td></tr>
</table>
</form>
</body>
</html>