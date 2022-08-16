
<body>
	<div class="container">
	
	
    
    <?php echo validation_errors(); ?>
	 <?php
		foreach($h->result() as $row)
		{?>
		
	<form action="<?php echo base_url();?>index/edit_myaccount"	method="post">
  <div class="form-group">
    <label for="exampleInputname">Name</label>
    
    <input type="text" name="name" value="<?php echo $row->name;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Name">
  </div>
  
    <div class="form-group">
    
    <label for="exampleInputname">Email</label>
    <input type="text" name="email" value="<?php echo $row->user_id;?>" class="form-control form-paddding" id="exampleInputphone" placeholder="Phone">
  </div>
 
    <div class="form-group">
    
    <label for="exampleInputEmail1">Password</label>
    <input type="text" name="pass" value="<?php echo $row->password;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Enter email">
  </div>
  
  
  <input type="submit" name="submit" value="Update" class="btn btn-default"/>
</form>
</form>
  <?php   
		}
			?>
    
    </div>
    
	
    
</body>
</html>
<script src="<?php echo base_url(); ?>js/jquery-1.10.2.js" type="application/javascript"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="application/javascript"></script>