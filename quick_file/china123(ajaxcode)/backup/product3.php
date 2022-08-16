<?php
require_once('config.php');
if(!empty($_POST)){	
	foreach($_POST as $variable => $value){
		 ${$variable} = trim($value);
		 $f=$_POST['title'];
		 
	}
	
	if($submit):	
		
			echo $f;
			
			
			
			$sql = "INSERT INTO `product` (`title`,`firstname`,`surname`) 
			VALUES (:title,:firstname,:surname)";
			$stmt = $dbh->prepare( $sql );
			//print_r($stmt);exit;
			$stmt->execute(array(':title'=>$title,':firstname'=>$firstname,':surname'=>$surname));
			//print_r($stmt);exit;
	endif;
	
	
}
?>

<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>index</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/slick-theme.css" rel="stylesheet">
<link href="css/slick.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
</head>

<body>
<!------ HEADER ------->
<header class="header">
	<div class="container">
    	<div id="logo">
        	<a href="#"><img src="img/logo.jpg" class="img-responsive"></a>
        </div>
        <div class="event-date">
        	<span class="imp-text">JUNE 07 TO 09, AT WARSAW EXPO NADARZYN</span>
        </div>
        <div class="new-event">
        	<span>NEW EVENT</span>
        </div>
    </div>
</header>

<!------ HEADER END ------->

<section class="product">
	<div class="container">
    	<div class="col-md-9 col-sm-9 col-xs-12">
        	<h3 class="mainheding">ALBA GARDEN FURNITURE CO.LTD</h3>
                <img src="img/pro.jpg" class="img-responsive">
                <div class="product-detils">
                    <h2 class="heading">Pra Wiszacy Marina</h2>
                    <p class="all-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                </div>
        	</div>
        <div class="col-md-3 col-sm-3 col-xs-12">
			<div class="oder-quntity">
            	<span class="imp-text">Oder Quntity</span>
                	<select class="dropdownmenu">
                    <option>select</option>
                      <option>Ketchup</option>
                      <option>Relish</option>
                    </select>
                    
                    <select class="dropdownmenu">
                    <option>Enquire Deadline</option>
                      <option>Ketchup</option>
                      <option>Relish</option>
                    </select>
                
            </div>
        </div>
    </div>
</section>

<!-------- PRODUCT END --------->

<!-----RED AREA----->

<section class="red-area">
	<div class="container">
    	<h4 class="sub-heading">Already Registered with CHL,Serach your information by name or unique registration no</h4>
        <button class="btn btn-default" type="submit">Note Registered with CHL </button>
    </div>
</section>

<!-----RED AREA END----->

<!----REG FORM------>
<form action="product3.php" method="post" >
<section class="regform">
	<div class="container">
    	<div class="title"> 
		
        <span>Title</span>
            <select class="dropdown reg-button" name="title">
            <option>Mr</option>
            <option>Mrs</option>
            </select>
        </div>
    	
          <div class="form-group col-lg-6 col-md-6 col-xs-12">
            <label for="exampleInputEmail1">First Name</label>
            <input type="text" name="firstname" class="form-control" id="Surname" placeholder="First Name">
          </div>
          <div class="form-group col-lg-6 col-md-6 col-xs-12">
            <label for="exampleInputPassword1">Surname</label>
            <input type="text" name="surname" class="form-control" id="exampleInputSurname" placeholder="Surname">
          </div>
          <div class="form-group col-lg-6 col-md-6 col-xs-12">
            <label for="exampleInputEmail1">E-mail</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="E-mail">
          </div>
          <div class="form-group col-lg-6 col-md-6 col-xs-12 ">
            <label for="exampleInputPassword1">Phone Number</label>
            <input type="text" name="mobile_no" class="form-control" id="exampleInputSurname" placeholder="Phone Number">
          </div>
        
    </div>
</section>

<!----REG FORM------>

<!-----INTRESTED PRODUCT------>
<section class="interested-product text-center">
	<div class="container">
    	<span class="heading">Tell us about other products you are interested in and we will recomnend matching suppliers</span>
        <div class="product-form">
        	<form class="form">
              <div class="one-form col-md-12 col-xs-12 col-sm-12">
              	<div class="form-group col-lg-6 col-md-6 col-xs-12">
                <input type="text" class="form-control" name="product1" id="Surname" placeholder="Product Name">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-xs-12">
                    <input type="text" class="form-control" name="quantity1" id="exampleInputSurname" placeholder="Average Quantity">
                  </div>
              </div>
              
              <div class="one-form col-md-12 col-xs-12 col-sm-12">
              	<div class="form-group col-lg-6 col-md-6 col-xs-12">
                    <input type="text" class="form-control" name="product2" id="Surname" placeholder="Product Name">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-xs-12 ">
                    <input type="text" class="form-control" name="quantity2" id="exampleInputSurname" placeholder="Average Quantity">
                  </div>
              </div>
              
              <div class="one-form col-md-12 col-xs-12 col-sm-12">
              	<div class="form-group col-lg-6 col-md-6 col-xs-12">
                    <input type="text" class="form-control" name="product3" id="Surname" placeholder="Product Name">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-xs-12 ">
                    <input type="text" class="form-control" name="quantity3" id="exampleInputSurname" placeholder="Average Quantity">
                  </div>
              </div>
              <div class="one-form col-md-12 col-xs-12 col-sm-12">
              	<div class="form-group col-lg-6 col-md-6 col-xs-12">
                    <input type="text" class="form-control" name="product4" id="Surname" placeholder="Product Name">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-xs-12 ">
                    <input type="text" class="form-control" name="quantity4" id="exampleInputSurname" placeholder="Average Quantity">
                  </div>
              </div>
            </form>
        </div>
        <input type='submit' value='SEND' class="send-button" name="submit" />		
    </div>
</section>
</form>
<!-----INTRESTED PRODUCT END------>

<!-----CLIENT------>
<section class="client text-center">
	<div class="container">
    	<div class="col-md-3 col-sm-3 col-xs-12">
        	<h2 class="heading">Meet Face to Face Top Suppliers</h2>
            <img src="img/client1.jpg" class="img-responsive">
        </div>
        
         <div class="col-md-3 col-sm-3 col-xs-12">
         <h2 class="heading">Meet Leading Machinery Suppliers</h2>
         <img src="img/client2.jpg" class="img-responsive">
        </div>
        
        <div class="col-md-3 col-sm-3 col-xs-12">
        <h2 class="heading">Source Suppliers Online</h2>
        <img src="img/client3.jpg" class="img-responsive">
        </div>
        
        <div class="col-md-3 col-sm-3 col-xs-12">
        <h2 class="heading">Meet Your Partners In China</h2>
        <img src="img/client4.jpg" class="img-responsive">
        </div>
    </div>
</section>

<!-----CLIENT END------>

<!----------- PAGEFOOTER ------------>
<section class="pagefooter">
	<div class="container">
    	<div class="footer-nav">
        	<ul>
                <li><a href="#">India</a></li>
                <li><a href="#">Dubbai</a></li>
                <li><a href="#">Egypt</a></li>
                <li><a href="#">Jordan</a></li>
                <li><a href="#">Brazil</a></li>
                <li><a href="#">India</a></li>
                <li><a href="#">Dubbai</a></li>
                <li><a href="#">Egypt</a></li>
                <li><a href="#">Jordan</a></li>
            </ul>
          </div>
    </div>
</section>

<section class="footer-copy">
	<div class="container">
    	<div class="footer-copyright">
        	<a href="#" class="pull-left">Copyright 2016</a>
        </div>
        <div class="footer-social pull-right">
        	<ul>
            	<li><a href="#"><img src="img/fb.jpg" class="img-responsive"></a></li>
                <li><a href="#"><img src="img/g+.jpg" class="img-responsive"></a></li>
                <li><a href="#"><img src="img/in.jpg" class="img-responsive"></a></li>
            </ul>
        </div>
    </div>
</section>

<!----------------------Jquery Javascript---------------------------->
	<script src="js/jquery-1.10.2.js" type="application/javascript"></script>
    <script src="js/bootstrap.min.js" type="application/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="js/slick.min.js" type="application/javascript"></script>
<!----------------------Jquery Javascript---------------------------->

<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>

</body>
</html>








