<body>
	<div class="container">
	<p style="color:green"><?php echo $this->session->flashdata('success_msg'); ?></p>
    <?php echo validation_errors(); ?>
    <?php
	foreach($h->result() as $row)
	{?>
	<form action="<?php echo base_url();?>index/edit_user/<?php echo $row->id;?>" method="post">
	<div class="form-group">
    <label for="exampleInputname">Name</label>
    <span class=""></span>
    <input type="text" name="name" value="<?php echo $row->name;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Name">
	</div>
  
    <div class="form-group">
    <span class=""></span>
    <label for="exampleInputname">Phone</label>
    <input type="text" name="phone" value="<?php echo $row->tele_phone;?>" class="form-control form-paddding" id="exampleInputphone" placeholder="Phone">
	</div>
 
    <div class="form-group">
    <span class=""></span>
    <label for="exampleInputEmail1">Email address</label>
    <input type="text" name="email" value="<?php echo $row->email;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Enter email">
	</div>
  
    <div class="form-group">
    <span class=""></span>
    <label for="exampleInputname">Company Name</label>
    <input type="text" name="companyname" value="<?php echo $row->company_name;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Company Name">
	</div>
  
	<div class="form-group">
	<span class=""></span>
      <select name="categories" class="form-control form-margin">
      <option value="1" class="form-paddding">Product1</option>
      <option value="2" class="form-paddding">Product2</option>
      <option value="3" class="form-paddding">Product3</option>
      <option value="4" class="form-paddding">Product4</option>
      <option value="5" class="form-paddding">Product5</option>
    </select>
    </div>
    
	
	<div class="form-group">
    <span class=""></span>
    <label for="exampleInputname">Detected Language Code</label>
    <input type="text" name="dlc" value="<?php echo $row->detected_languagecode;?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="">
	</div>
  
	<div class="form-group">
	<span class=""></span>
	<label for="exampleInputname">Language</label>
      <select name="manual_languagecode" class="form-control form-margin">
	  <?php
	  //$data['l']=$this->db->query("SELECT * FROM languages");
	  foreach($l->result() as $row1){
	  ?>
      <option value="<?php echo $row1->language_code;?>" <?php if($row->manual_languagecode == 'eng') echo 'selected'?> class="form-paddding"><?php echo $row1->language;?></option>
	  <?php
	  }
      ?>
    </select>
    </div>
	
	
    <div class="form-group">
    <label for="exampleInputname">Comments</label>
    <textarea name="comments"  class="form-control" rows="3"><?php echo $row->comments;?></textarea>
	</div>
 
	<input type="submit" name="submit" value="Update" class="btn btn-default"/>
	</form>
	
	<?php  } ?>
		
	</div>
    <script src="<?php echo base_url(); ?>js/jquery-1.10.2.js" type="application/javascript"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="application/javascript"></script>
    
</body>
</html>

