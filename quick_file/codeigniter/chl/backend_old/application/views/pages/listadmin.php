
<script src="<?php echo base_url(); ?>assets/js/validation.js" type="application/javascript"></script>
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
			<td><input type="checkbox" name="list[]" value="<?php echo $data->id; ?>" /></td>
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
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value='Delete' onclick="return checkboxes();" class="btn btn-default" />
	  </form> 
	</div>
      
       <br><br>
      <center><h4><?php echo $links; ?></h4></center>
  
