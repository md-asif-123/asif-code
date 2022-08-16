

<body>


	<div class="container"><?php echo $this->session->flashdata('sess_message'); ?>
	
   
	<form action="<?php echo base_url();?>score/edit/<?php echo $row->id;?>" method="post">
  <div class="form-group">
    <label for="exampleInputname">Name</label>
    <span class=""></span>
    <input type="text" name="name" value="<?php echo $row->name;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Name" disabled>
  </div>
  
    <div class="form-group">
    <span class=""></span>
    <label for="exampleInputname">Score</label>
    <input type="text" name="score" value="<?php echo $row->score;?>" class="form-control form-paddding" id="exampleInputphone" placeholder="Score">
  </div>
 
  
 
  <input type="submit" name="submit" value="Update" class="btn btn-default"/>
</form>

		 
    </div>
    
	















