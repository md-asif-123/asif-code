
<html>
<body>
<?php
foreach($h->result() as $row)
		{
			
			$i=$row->id;
			$u=$this->db->where('uid', $i);
		
		    $query1=$this->db->get('hobby');
			foreach($query1->result() as $row1):
			   $hobbyArray[]=$row1->hobby;
			   
			  
            //print_r($r);			   
			endforeach;
?>
<form action="<?php echo base_url();?>index.php/index/update_user?id=<?php echo $row->id; ?>" method="post">
<table border='2' width='70%' align='center' cellpadding='6' cellspacing='6'>
<tr><td colspan='2' align='center' bgcolor='#cccccc'><b>School Registration Form&nbsp&nbsp&nbsp <a href='<?php echo base_url(); ?>index.php/index/user_list'>View User</a></b></td></tr>

<tr><td>Name</td><td><input type='text' name='fname' value='<?php echo $row->name; ?>' /></td></tr>

<tr><td>Age</td><td><input type='text' name='age' value='<?php echo $row->age; ?>' /></td></tr>
<tr><td>Address</td><td><input type='text' name='address' value='<?php echo $row->address; ?>' /></td></tr>
 <tr><td>Hobby</td><td>
		   <input type='checkbox' name='hobby[]' value='Math'<?php if(in_array('Math', $hobbyArray)) echo 'checked'; ?>/>Math
		   <input type='checkbox' name='hobby[]' value='Physics'<?php if(in_array('Physics', $hobbyArray)) echo 'checked'; ?>/>Physics
		   <input type='checkbox' name='hobby[]' value='Chemistry'<?php if(in_array('Chemistry', $hobbyArray)) echo 'checked'; ?>/>Chemistry
		   </td></tr>
<tr><td colspan='2' align='right' bgcolor='#cccccc'><input type='submit' name='submit' value='SUBMIT'/></td></tr>
</table>
</form>

<?php

		}
?>

</table>
</body>
</html>