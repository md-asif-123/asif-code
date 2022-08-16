<?php
        require_once('config.php');
        session_start();
		if(isset($_POST['submit']))
		{
		$uname=$_POST['uname'];
		$pass=$_POST['pass'];
        $sql="SELECT * FROM register WHERE email='$uname' AND password='$pass'";
		$rec=mysql_query($sql);
		$row=mysql_fetch_array($rec);
		//echo $row[1];
		$count=count($row);
		//echo $count;exit;
		if($count > 1)
		{
			$_SESSION['user']=$row[2];
			header('location:list.php');
		}
		else{
			echo "wrong credential";
		}
	    }  
		?>
		<html>
		<body>
		<form name='regLogin' method='post' action=''>
        
		<table align='center' border='2' width='40%' cellpadding='6'>
		<tr><td colspan='2' align='center' bgcolor='#cccccc'>Login</td></tr>
		<tr><td>Name</td><td><input type='text' name='uname'/>
		<tr><td>Password</td><td><input type='text' name='pass'/>
		<tr><td colspan='2' align='right'><input type='submit' name='submit' value='Go'/>
		</table>
		 
	    </form>
		</body>
		</html>