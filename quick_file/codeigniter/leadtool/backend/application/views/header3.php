<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Lead generator</title>
<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/style1.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jsapi"></script>
</head>


<div class="header">
	<div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
        <div id="logo">
           <a href="http://192.168.0.74/nazir/leadtool/backend/index.php/index/dashboard">  <img src="<?php echo base_url(); ?>/assets/images/leadtool-small-logo.png" class="img-responsive"></a>
        </div>
    </div>
	<div class="col-lg-9 col-md-8 col-sm-8"> 
        <!---NAV--->
        
 <nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li><a href="<?php echo base_url(); ?>index/user_data">LEADS</a></li>
	  
	  <li><a href="<?php echo base_url(); ?>score/score_list">SCORE LIST</a></li>
	  
	  
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">STATICS <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>chart/by_country">BY COUNTRY</a></li>
          <li><a href="<?php echo base_url(); ?>chart/by_industry">BY INDUSTRY</a></li>
          <li><a href="<?php echo base_url(); ?>chart/by_language">BY LANGUAGE</a></li>
		  <li><a href="<?php echo base_url(); ?>chart/by_business">BY BUSINESS</a></li>
         
        </ul>
      </li>
	  
	  
	  
	   <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">EMAIL MANAGEMENT <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>email/add_email">ADD EMAIL</a></li>
          <li><a href="<?php echo base_url(); ?>email/email_list">EMAIL LIST</a></li>
         
        </ul>
      </li>
	  
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>
        
<!--NAV-end--->    
    </div>
    
    <div class="col-lg-2 col-sm-2 col-md-2">
            <div class="user">
           <a href="#" class="fa fa-user list-user dropdown-toggle" data-toggle="dropdown"></a>
          <ul class="dropdown-menu user-dropdown">
		  
		  
          <li><a href="<?php echo base_url(); ?>index/edit_myaccount">My Account</a></li>
		  
		  <li><a href="<?php echo base_url(); ?>index/user_list">User List</a></li>
          <li><a href="<?php echo base_url(); ?>index/logout">Logout</a></li>
        </ul>
        </div>
    </div>
</div>
<br><br><br><br><br>

