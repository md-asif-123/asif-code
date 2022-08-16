<?php


?>

<html>
<body>
<form name='regForm' action='' method='post' enctype='multipart/form-data'>
<table align='center' border='2' width='30%' cellpadding='0' cellspacing='6'>

<tr><td colspan='2' bgcolor='#5478966' align='center'><b>Registration Form</b></td></tr>
<tr><td>Name</td><td><input type='text' name='name'></td></tr>
<tr><td>Age</td><td><input type='text' name='name'></td></tr>
<tr><td>Email</td><td><input type='text' name='email'></td></tr>
<tr><td>Password</td><td><input type='password' name='password'></td></tr>
<tr><td>Country</td><td>
<select name='country'>
<option value='India'>India</option>
<option value='Bangladesh'>Bangladesh</option>
<option value='Shrilanka'>Shrilanka</option>
<option value='Pakistan'>Pakistan</option>
<option value='America'>America</option>
</select>
</td></tr>
<tr><td>Subject</td><td>
<input type='checkbox' name='sub[]' value='math'>Math
<input type='checkbox' name='sub[]' value='physics'>Physics
<input type='checkbox' name='sub[]' value='chemistry'>Chemistry
<input type='checkbox' name='sub[]' value='biology'>Biology
</td></tr>
<tr><td align='center' bgcolor='#5478966' colspan='2'><input type='submit' name='submit' value='SUBMIT'></td></tr>
</table>
</form>
</body>
</html> 

