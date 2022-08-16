

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact</title>
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet">
</head>

<body>
	<div class="container">
    <?php echo validation_errors(); ?>
    
	<form action="<?php echo base_url();?>index.php/index2/validateform2" method="post">
  <div class="form-group">
    <label for="exampleInputname">Name</label>
    <span class="fa fa-user icon"></span>
    <input type="text" name="name" value="<?php echo set_value('name'); ?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Name">
  </div>
  
    <div class="form-group">
    <span class="fa fa-phone icon"></span>
    <label for="exampleInputname">Phone</label>
    <input type="text" name="phone" value="<?php echo set_value('phone'); ?>" class="form-control form-paddding" id="exampleInputphone" placeholder="Phone">
  </div>
 
    <div class="form-group">
    <span class="fa fa-envelope icon"></span>
    <label for="exampleInputEmail1">Email address</label>
    <input type="text" name="email" value="<?php echo set_value('email'); ?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Enter email">
  </div>
  
      <div class="form-group">
      <span class="fa fa-building icon"></span>
    <label for="exampleInputname">Company Name</label>
    <input type="text" name="companyname" value="<?php echo set_value('companyname'); ?>" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Company Name">
  </div>
  
  <div class="form-group">
  <span class="fa fa-archive icon"></span>
      <select name="categories" class="form-control form-margin">
      <option value="1" class="form-paddding">Product1</option>
      <option value="2" class="form-paddding">Product2</option>
      <option value="3" class="form-paddding">Product3</option>
      <option value="4" class="form-paddding">Product4</option>
      <option value="5" class="form-paddding">Product5</option>
    </select>
    </div>
    
    <div class="form-group">
    <label for="exampleInputname">Comments</label>
    <textarea name="comments" class="form-control" rows="3"></textarea>
	</div>
 
  <input type="submit" name="submit" class="btn btn-default"/>
</form>
</form>
    
    </div>
    
	<script src="<?php echo base_url(); ?>js/jquery-1.10.2.js" type="application/javascript"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.js" type="application/javascript"></script>
    
</body>
</html>


















