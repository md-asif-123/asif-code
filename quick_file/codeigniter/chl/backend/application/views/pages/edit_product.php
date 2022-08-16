
<body>
	<div class="container">
	
	
    
    <?php echo validation_errors(); ?>
	
	<p style="color:green"><?php echo $this->session->flashdata('success_msg'); ?></p><br/>
	
	
	
	
		<?php  $cat = $row->category;?>
	<form action="<?php echo base_url();?>index/edit_product/<?php echo $row->id;?>" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputname">Title</label>
    
    <input type="text" name="title" value="<?php echo $row->title;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Name">
  </div>
  
    <div class="form-group">
    
    <label for="exampleInputname">Upload Image&nbsp;( * file type jpg | png |gif)</label>
   <input type="file" name="userfile" value=""  id="exampleInputEmail1">
   <input type="hidden" name="preimage" value="<?php echo $row->image;?>"  id="exampleInputEmail1">
   <br/>
   
   <?php $base=base_url();?>
   
   <?php $img=$row->image;
   
   if($img==''){
   
   echo "<img src='$base/uploads/noimage.png' height='30' width='40'/>";
   
 
   }
   
   else{
   
   echo "<img src='$base/uploads/$img' height='30' width='40'/>";
   
 
   }
  
   
  
   ?>
   
  
   <?php $categoryname=$row->category;
   ?>
   
  </div>
  
    <div class="form-group">
	
	
		<label for="exampleInputname">Category</label>
		
		<select name="category" class="form-control form-margin">
			<?php
		foreach($category->result() as $data)
		{
			
			
  
		?>
			<option value="<?php echo $categoryname_cat=$data->category_name;?>" <?if("$categoryname"=="$categoryname_cat"){echo 'selected="selected"';}?> class="form-paddding"><?php echo ucfirst($data->category_name);?> </option>
			
			
			<?php }?>
		
	
		</select>
    </div>
  
  
  
	
    
   <div class="form-group">
    
    <label for="exampleInputEmail1">Description</label>
   <textarea name="description" value="" class="form-control" rows="3"><?php echo $row->description;?></textarea>
  </div>
  
  
  <input type="submit" name="submit" value="Submit" class="btn btn-default"/>
</form>
</form>
 
			
			
			
    
    </div>
    
	
    
</body>
</html>
<script src="<?php echo base_url(); ?>js/jquery-1.10.2.js" type="application/javascript"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="application/javascript"></script>