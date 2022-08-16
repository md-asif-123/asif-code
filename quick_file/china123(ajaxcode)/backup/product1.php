<?php
require_once('config.php');
if(!empty($_POST)){	
	foreach($_POST as $variable => $value){
		 ${$variable} = trim($value);
	}
	
	if($submit):	
		
			
			
			
			
			$sql = "INSERT INTO `product` (`firstname`, `mobile_no`, `email`) 
			VALUES (:firstname,:mobile_no,:email)";
			$stmt = $dbh->prepare( $sql );
			$stmt->execute(array(':firstname'=>$firstname,':mobile_no'=>$mobile_no,':email'=>$email));
			
	endif;
	
	
}
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact</title>
<link href="html/skin/css/bootstrap.min.css" rel="stylesheet">
<link href="html/skin/css/font-awesome.min.css" rel="stylesheet">
<link href="html/skin/css/custom.css" rel="stylesheet">
</head>

<body>
	<div class="container">
    
    
	<form action="product.php" method="post" enctype="contact_form" id="contact_form">
  <div class="form-group">
    <label for="exampleInputname">Name</label>
    <span class="fa fa-user icon"></span>
    <input type="text" name="firstname" value="" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Name">
  </div>
  
    <div class="form-group">
    <span class="fa fa-phone icon"></span>
    <label for="exampleInputname">Phone</label>
    <input type="text" name="mobile_no" value="" class="form-control form-paddding" id="exampleInputphone" placeholder="Phone">
  </div>
 
    <div class="form-group">
    <span class="fa fa-envelope icon"></span>
    <label for="exampleInputEmail1">Email address</label>
    <input type="text" name="email" value="" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Enter email">
  </div>
  
      <div class="form-group">
      <span class="fa fa-building icon"></span>
    <label for="exampleInputname">Company Name</label>
    <input type="text" name="companyname" value="" class="form-control form-paddding" id="exampleInputEmail1" placeholder="Company Name">
  </div>
  
  <div class="form-group">
  <span class="fa fa-archive icon"></span>
      <select name="products" class="form-control form-margin">
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

    
    </div>
    
	<script src="admin/js/jquery-1.10.2.js" type="application/javascript"></script>
    <script src="admin/js/bootstrap.js" type="application/javascript"></script>
    
</body>
</html>


















