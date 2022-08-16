
<html>
<body>
<head>
<script src="<?php echo base_url(); ?>assets/js/validation.js" type="application/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/validation.js" type="application/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>
	$(document).ready(function(){
	  

   // Document is ready

   $("#search").keyup(function()
   
   {
		
		var isTyping = $('#search').val();
		$.ajax({
          type: "post",
          url: "http://localhost/asifci/index.php/index/user_list1",
		  
          data:{key:isTyping},
          dataType: "text",
		  
		
		  
          success: function(result)
          {
			  
			  
			  $('#tdiv1').html(result);
          }
		   
       });
	  

   });

  

	});
</script>
</head>
<div  id="tdiv1"  >
 
<div style="float:right;">
		
		<th><input type="text" name="search" class="form-control form-paddding" id="search" placeholder="Search.." style="width:250px;" onkeyup='search();'></th>

</div>

<a href='<?php echo base_url();?>index.php/index/logout'>Logout</a>
<br/><br/>

<form name="regForm" id="regForm" action="<?php echo base_url();?>index.php/index/delete_usercheck" method="post">
<table border='2' align='center' width='70%'>
<tr><td colspan='7' bgcolor='#cccccc' align='center'><b>Student List</b></td></tr>
<tr><td><input type='checkbox' name='check' onclick="checkedAll(regForm);" /></td><td>Name</td><td>Age</td><td>Hobby</td><td>Address</td><td>Edit</td><td>Delete</td></tr>
<?php
foreach($h->result() as $row)
		{
?>
         <tr>
			
			<td><input type="checkbox" name="list[]" value="<?php echo $row->id; ?>" /></td>
			<td><a href='<?php echo base_url();?>index.php/index/view_user?id=<?php echo $row->id;?>'><?php echo $row->name;?></a></td>
			
			<td><?php echo $row->age;?></td>
			
			<td>hobby</td>
			<td><?php echo $row->address;?></td>
			<td><a href='<?php echo base_url();?>index.php/index/edit_user?id=<?php echo $row->id;?>'>Edit</a></td>
            <td><a href='<?php echo base_url();?>index.php/index/delete_user?id=<?php echo $row->id;?>' onclick="return doDelete();">Delete</a></td>
			
			</tr>
            
<?php
		}
?>
     <tr><td colspan='6' onclick="return checkboxes();"><input type='submit' name='submit' value='delete'/></td></tr>
</table>

</form>
</div>
</body>
</html>