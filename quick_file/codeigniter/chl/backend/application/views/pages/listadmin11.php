

<script src="<?php echo base_url(); ?>assets/js/validation.js" type="application/javascript"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
<script>
	$(document).ready(function() {
    $("#save_value").click(function (e) 
   {
	
		 var final = [];
    $('#chk:checked').each(function(){
        
      
			
             final.push($(this).val());
                        
	
		
    });
   
	
	$.ajax({
          type: "post",
          url: "http://192.168.0.74/chl/backend/index/code_generate",
		  
          data:{id:final},
          dataType: "text",
		  
		
		  
          success: function(result)
          {
			  
			 
           $('#tdiv').show();
           $('#tdiv').html(result);
			  
          }
		   
       });
	  

   });
   
    });


</script>







<div style="float:right;">
		
		<th><input type="text" name="search" class="form-control form-paddding" id="search" placeholder="Search.." style="width:250px;" onkeyup='search();'></th>

</div>


<br/><br/>




<table class="table table-striped" style="font-size:14px;">
	<form name="regForm" id="regForm" action="<?php echo base_url();?>index/delete_usercheck" method="post">
	<p style="color:green;text-align:center;"><?php echo $this->session->flashdata('successs_msg'); ?></p>
      <thead>
          <tr>
		  <th></th>
		  <th><input type='checkbox' name='check' onclick="checkedAll(regForm);" /></th>
		  <th>ID</th>
          <th>Title</th>
		 
            <th>Image</th>
			<th>Description</th>
			<th>Category</th>
			
			
			<th>Action</th>
			</tr>
        </thead>
        <tbody>
          
		<?php
		
		if($total_rows!='0'){
		foreach($results as $data)
		{
			?>
			<tr>
			<td></td>
			<td><input type="checkbox" name="list[]" id="chk" value="<?php echo $data->id; ?>" /></td>
			<td><?php echo $data->id;?></td>
			
			<td><?php echo $data->title;?></td>
			
			
		
			
			<td>
			
			<?php $img = $data->image;?>
			
			<?php if($img=='N'){?>
				<img src="<?php echo base_url(); ?>uploads/noimage.png" height="40" width="60"/>
				
			<?php }else{
				
				?>
			
			<img src="<?php echo base_url(); ?>uploads/<?php echo $data->image;?>" height="40" width="60"/>
		<?php }?>
			
			</td>
			
			
			
			<td>
			<?php $com=$data->description;?>
			<?php echo substr("$com",0,35);?>...</td>
			
			<td><?php echo $data->category;?></td>
			
			<td><a href='<?php echo base_url(); ?>index/edit_product/<?php echo $data->id;?>'>
			<img src='<?php echo base_url(); ?>assets/images/btn_edit.gif'></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href='<?php echo base_url(); ?>index/delete_user?id=<?php echo $data->id;?>' onclick="return doDelete();">
			<img src='<?php echo base_url(); ?>assets/images/btn_remove.gif'></a></td>
			</tr> 
         <?php   
		}
		
		}
		else {
			?>
			
			<p style="text-align:center"><? echo "No data found";?></p>
		<?php }
		?>
        </tbody>
		
</table>
      <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value='Delete' onclick="return checkboxes();" class="btn btn-default" />
	  
	 
	  </form> 
	  
	  
	  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="save_value" type="button" class="btn btn-default">Generate code</button></p>
	</div>
      
       <br><br>
	   
	   <div style="display:none" id="tdiv">
	   
	   
	   </div>
	   
      <center><h4><?php echo $links; ?></h4></center>
  
