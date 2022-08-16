<?php
        require_once('config.php');
		session_start();
		 if(!isset($_SESSION['user'])){
			  header('location:loginpage.php');
		  }
		  if(isset($_POST['submit']))
		{
			$list=$_POST['list'];
			foreach($list as $deleteId ){
				echo $sql1="DELETE FROM register WHERE id=$deleteId";
				$rec1=mysql_query($sql1);
				
			}
		}
		$sql="SELECT * FROM register";
		$rec=mysql_query($sql);
		$row=mysql_fetch_array($rec);
		//echo $row[4];
		
        ?>
		<script src="validation.js" type="application/javascript"></script>
		<a href='logoutPage.php'>Logout</a>
		<a href='index.php'>Register</a>
		<form name='regForm' id='regForm' method='post' action=''>
		<table border='1' width='50%' align='center' cellspacing='6' cellpadding='6'>
		<tr><td bgcolor='#cccccc' colspan='8' align='center'><b>Student List</b></td></tr>
		<tr><td><input type='checkbox' onclick='checkedAll(regForm);'/></td><td>Name</td><td>Email</td><td>Photo</td><td>Gender</td><td>Country</td><td>Subject</td><td align='center'>Action</td></tr>
		
		<?php
		  while($row=mysql_fetch_row($rec))
			{
		?>
		<tr><td><input type='checkbox' name='list[]' value='<?php echo $row[0]; ?>'/></td><td width='30%'><?php echo $row[1]; ?></td><td width='20%'><?php echo $row[2]; ?></td><td width='20%'><img src="image/<?php echo $row[6]; ?>" height='50' width='50'></td><td><?php echo $row[4]; ?></td><td><?php echo $row[3]; ?></td><td>
		<?php
		$sql3="SELECT * FROM subject WHERE uid=$row[0];";
		$rec3=mysql_query($sql3);
		while($row3=mysql_fetch_row($rec3)){?>
			<?php  echo $row3[2].'-'; ?>
		<?php }?>
		 </td>
		<td align='center' width='20%'><a href='edit.php?id=<?php echo $row[0]; ?>'>edit&nbsp&nbsp</a>&nbsp&nbsp<a href='delete.php?id=<?php echo $row[0]; ?> ' onclick='return doDelete();'>delete</a></td></tr>
		<?php
			}
		?>
		<tr><td><input type='submit' name='submit' value='Delete' onclick='return checkboxes();' /></td></tr>
		</table>
		</form>
		