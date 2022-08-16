

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Login</title>

<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/style1.css" rel="stylesheet">
</head>

<body>
<div class="container">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div id="logo">
           <a href="#">  <img src="<?php echo base_url(); ?>images/leadtool-small-logo.png" class="img-responsive login-logo"></a>
   		 </div>
</div>
<!----Login Start----->    
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="login">
	<?php echo validation_errors(); ?>
	
	<form action="<?php echo base_url();?>" method="post">
    	
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="username" value="<?php echo set_value('username'); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control" id="password" placeholder="Password">
          </div>
          <input type="submit" name="submit" class="btn btn-default login-submit"/>
</form>
    </div>
</div>   
<!----Login END----->    
</div>

<footer class="page-footer text-center">
<a href="#">leadtool version 1.0</a>
</footer>



	<script src="<?php echo base_url(); ?>js/jquery-1.10.2.js" type="application/javascript"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.js" type="application/javascript"></script>
</body>
</html>
