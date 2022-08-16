
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
   <br/>
   
   <?php echo $img=$row->image;
   
   if($img=='N'){?>
   
   <img src="<?php echo base_url(); ?>uploads/noimage.png" height="30" width="40"/>
   
   <?
   
   
   }else{?>
	   
	   
	 <img src="<?php echo base_url(); ?>uploads/<?php echo $img=$row->image;?>" height="30" width="40"/>   
	   
   <?php }
   ?>
   
  
   
   
  </div>
	
     <div class="form-group">
		<label for="exampleInputname">Category</label>
		
		<select name="category" class="form-control form-margin">
			<option value="" class="form-paddding">Select Category</option>
			
			<option value="Textile & garments" <?php if($cat=='Textile & garments'){ echo 'selected="selected"'; }?> class="form-paddding">Textile & garments</option>
			<option value="Furniturte" <?php if($cat=='Furniturte'){ echo 'selected="selected"'; }?> class="form-paddding">Furniturte </option>
			<option value="Building materials" <?php if($cat=='Building materials'){ echo 'selected="selected"'; }?> class="form-paddding">Building materials</option>
			<option value="Electronic" <?php if($cat=='Electronic'){ echo 'selected="selected"'; }?> class="form-paddding">Electronic </option>
			<option value="Lighting" <?php if($cat=='Lighting'){ echo 'selected="selected"'; }?> class="form-paddding">Lighting</option>
			<option value="Household & lifts" <?php if($cat=='Household & lifts'){ echo 'selected="selected"'; }?> class="form-paddding">Household & lifts</option>
			<option value="Automobiles & motorcycle" <?php if($cat=='Automobiles & motorcycle'){ echo 'selected="selected"'; }?> class="form-paddding">Automobiles & motorcycle</option>
			<option value="Electricity & new energy" <?php if($cat=='Electricity & new energy'){ echo 'selected="selected"'; }?> class="form-paddding">Electricity & new energy</option>
			<option value="Machinery" <?php if($cat=='Machinery'){ echo 'selected="selected"'; }?> class="form-paddding">Machinery</option>
			<option value="Food" <?php if($cat=='Food'){ echo 'selected="selected"'; }?> class="form-paddding">Food</option>
		
	
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