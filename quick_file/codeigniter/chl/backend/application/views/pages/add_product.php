
<body>
	<div class="container">
	
	
    
    <?php echo validation_errors(); ?>
	
	<p style="color:green"><?php echo $this->session->flashdata('success_msg'); ?></p><br/>
	
	
	
	
		
	<form action="<?php echo base_url();?>index/add_product" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputname">Title</label>
    
    <input type="text" name="title" value="" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Name">
  </div>
  
    <div class="form-group">
    
    <label for="exampleInputname">Upload Image&nbsp;( * file type jpg | png |gif)</label>
   <input type="file" name="userfile" value=""  id="exampleInputEmail1">
   <br/>
   
  
   
   
  </div>
  
  
    <div class="form-group">
		<label for="exampleInputname">Category</label>
		
		<select name="category" class="form-control form-margin">
			<?php
		foreach($category->result() as $row)
		{
		?>
			<option value="<?php echo $row->category_name;?>" class="form-paddding"><?php echo ucfirst($row->category_name);?> </option>
			
			
			<?php }?>
		
	
		</select>
    </div>
  
  
  
	
    
  
   <div class="form-group">
    
    <label for="exampleInputEmail1">Description</label>
   <textarea name="description" value="" class="form-control" rows="3"></textarea>
  </div>
  
  
  <input type="submit" name="submit" value="Submit" class="btn btn-default"/>
</form>
</form>
  
			
			
			
			
			
			
    
    </div>
    
	
    
</body>
</html>
<script src="<?php echo base_url(); ?>js/jquery-1.10.2.js" type="application/javascript"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="application/javascript"></script>