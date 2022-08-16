
<html>

<body>


<form action="<?php echo base_url();?>index.php/index/add_user" method="post">
<table border='2' width='70%' align='center' cellpadding='6' cellspacing='6'>
<tr><td colspan='2' align='center' bgcolor='#cccccc'><b>School Registration Form&nbsp&nbsp&nbsp <a href='<?php echo base_url(); ?>index.php/index/user_list'>View User</a></b></td></tr>

<tr><td>Name</td><td><input type='text' name='fname' /></td></tr>
<tr><td>Class</td><td><input type='text' name='class' /></td></tr>
<tr><td>Age</td><td><input type='text' name='age' /></td></tr>
<tr><td>Address</td><td><input type='text' name='address' /></td></tr>

<tr><td colspan='2' align='right' bgcolor='#cccccc'><input type='submit' name='submit' value='SUBMIT'/></td></tr>
</table>
</form>
</body>
</html>