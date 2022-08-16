
<html>
<body>
<head>
<script src="<?php echo base_url(); ?>assets/js/validation.js" type="application/javascript"></script>
</head>
<form name="regForm" id="regForm">
<table border='2' align='center' width='70%'>
<tr><td colspan='6' bgcolor='#cccccc' align='center'><b>Student List</b></td></tr>
<tr><td><input type='checkbox' name='check' onclick="checkedAll(regForm);" /></td><td>Name</td><td>Age</td><td>Address</td><td>Edit</td><td>Delete</td></tr>
<?php
foreach($h->result() as $row)
		{
?>
         <tr>
			
			<td><input type="checkbox" name="list[]" value="<?php echo $row->id; ?>" /></td>
			<td><?php echo $row->name;?></td>
			
			<td><?php echo $row->age;?></td>
			<td><?php echo $row->address;?></td>
			<td><a href='<?php echo base_url();?>index.php/index/edit_user?id=<?php echo $row->id;?>'>Edit</a></td>
            <td><a href='<?php echo base_url();?>index.php/index/delete_user?id=<?php echo $row->id;?>' onclick="return doDelete();">Delete</a></td>
			
			</tr>

<?php
		}
?>

</table>
</form>
</body>
</html>