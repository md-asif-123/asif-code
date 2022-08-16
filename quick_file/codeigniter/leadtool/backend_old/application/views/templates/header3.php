<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Index</title>
<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/style1.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet">
</head>


<div class="header">
	<div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
        <div id="logo">
           <a href="#">  <img src="<?php echo base_url(); ?>images/leadtool-small-logo.png" class="img-responsive"></a>
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
      <li><a href="file://///TERMINAL3-PC/htdocs/lead/html/list.html">LEADS</a></li>
      <li><a href="<?php echo base_url(); ?>index.php/index2/validateform2">USERS</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">STATICS <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>index.php/index2/map">by pie chart</a></li>
          <li><a href="<?php echo base_url(); ?>charts3/geochart.php">Example2</a></li>
          <li><a href="<?php echo base_url(); ?>charts3/linechart.php">Example3</a></li>
          <li><a href="<?php echo base_url(); ?>charts3/barchart.php">Example4</a></li>
		  <li><a href="<?php echo base_url(); ?>index.php/index2/getform">Example4</a></li>
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
		  
		  
          <li><a href="<?php echo base_url(); ?>index.php/index2/adminaccount">My Account</a></li>
		  
		  
          <li><a href="<?php echo base_url(); ?>index.php/index2/logout">Logout</a></li>
        </ul>
        </div>
    </div>
</div>
<br><br><br><br><br>

