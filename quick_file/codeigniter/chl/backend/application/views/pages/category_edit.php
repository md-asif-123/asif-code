

<body>


	<div class="container"><?php echo $this->session->flashdata('sess_message'); ?>
	
   
	<form action="<?php echo base_url();?>category/edit/<?php echo $row->id;?>" method="post">
  <div class="form-group">
    <label for="exampleInputname">Name</label>
    <span class=""></span>
    <input type="text" name="category" value="<?php echo $row->category_name;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Name">
  </div>
  
   
  
 
  <input type="submit" name="submit" value="Update" class="btn btn-default"/>
</form>

		 
    </div>
    
	















