

<body>


	<div class="container"><?php echo $this->session->flashdata('sess_message'); ?>
	
   
	<form action="<?php echo base_url();?>category/add/" method="post">
  <div class="form-group">
    <label for="exampleInputname">Name</label>
    <span class=""></span>
    <input type="text" name="category" value="" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Name">
  </div>
  
   
  
 
  <input type="submit" name="submit" value="Add" class="btn btn-default"/>
</form>

		 
    </div>
    
	















