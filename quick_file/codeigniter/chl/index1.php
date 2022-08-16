
<?php
require_once('config.php');
if(!empty($_POST)){	
	foreach($_POST as $variable => $value){
		 ${$variable} = trim($value);
		 $f=$_POST['title'];
		 
	}
	
	if($submit):	
		if($firstname == ""){
			$_SESSION['error_msg'] = "Please enter your name correctly.";
			echo "<center>".$_SESSION['error_msg']."</center>";
			
		}elseif($mobile_no == ""){
			$_SESSION['error_msg'] = "Please enter your phone correctly.";
			echo "<center>".$_SESSION['error_msg']."</center>";
		}
		elseif($email == ""){
			$_SESSION['error_msg'] = "Please enter your email correctly.";
			echo "<center>".$_SESSION['error_msg']."</center>";
		}	
          elseif($product1 == ""){
			$_SESSION['error_msg'] = "Please enter atleast two products.";
			echo "<center>".$_SESSION['error_msg']."</center>";
		}	
		 elseif($product2 == ""){
			$_SESSION['error_msg'] = "Please enter atleast two products.";
			echo "<center>".$_SESSION['error_msg']."</center>";
		}
		
		else{	
			$sql = "INSERT INTO `product` (`title`,`firstname`,`surname`,`mobile_no`,`email`,`product1`,`product2`,`product3`,
			`product4`,`quantity1`,`quantity2`,`quantity3`,`quantity4`) 
			VALUES (:title,:firstname,:surname,:mobile_no,:email,:product1,:product2,:product3,:product4,:quantity1,:quantity2,
			:quantity3,:quantity4)";
			$stmt = $dbh->prepare( $sql );
			//print_r($stmt);exit;
			$stmt->execute(array(':title'=>$title,':firstname'=>$firstname,':surname'=>$surname,':mobile_no'=>$mobile_no,
			':email'=>$email,':product1'=>$product1,':product2'=>$product2,':product3'=>$product3,':product4'=>$product4,
			':quantity1'=>$quantity1,':quantity2'=>$quantity2,':quantity3'=>$quantity3,':quantity4'=>$quantity4));
			//print_r($stmt);exit;
			$d= "successfully stored into the database";
		}
		     
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
            	<span class="imp-text">Oder Quntity</span><br>
                	<input type='text' name='quantity' value='' placeholder='quantity'/><br><br>
					<input type='text' name='date' value='' placeholder='date'/>
					
                    
                 
                
            </div>
        </div>
    </div>
</section>

<!-------- PRODUCT END --------->

<!-----RED AREA----->

<section class="red-area">
	<div class="container">
    	<form action="index.php" method="post" enctype="contact_form" id="contact_form">
		<h4 class="sub-heading">Already Registered with CHL,Serach your information by name or unique registration no
		<input type='text' name='mobile_no' value=''/> <input type='submit' value='SUBMIT' class="btn btn-default" name="submit1" /></h4>
		</form> 
		<form action="index.php?stat=enable" method="post" enctype="contact_form" id="contact_form">
		<input type='submit' value='Not Registered with CHL' class="btn btn-default" name="submit1" />
		</form> 
    </div>
</section>

<!-----RED AREA END----->

<!----REG FORM------>
<form action="index.php" method="post" enctype="contact_form" id="contact_form">
<section class="regform">
	<div class="container">
    	<div class="title"> 
		<?php echo "<center>".$d."</center>"?>
		
       
        </div>
    	 <?php /*
		if($registerType==1):	
		$m=$_POST['mobile_no'];
		$sql="SELECT * FROM product where mobile_no=$m";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetch();
		
		if($row)
		{*/
			?>
			  <div class="form-group col-lg-6 col-md-6 col-xs-12">
				<label for="exampleInputEmail1">Name</label>
		<input type="text" name="firstname" value="<?php echo $row['firstname'] ?>" class="form-control" id="Surname" placeholder="Name" <?php if(!$_REQUEST['stat']){echo "disable" ;}else {echo "enable";} ?>>
			  </div>
			  
			  <div class="form-group col-lg-6 col-md-6 col-xs-12">
				<label for="exampleInputEmail1">E-mail</label>
				<input type="email" name="email" value="<?php echo $row['email'] ?>" class="form-control" id="email" placeholder="E-mail"  >
			  </div>
			  <div class="form-group col-lg-6 col-md-6 col-xs-12 ">
				<label for="exampleInputPassword1">Phone Number</label>
				<input type="text" name="mobile_no" value="<?php echo $row['mobile_no'] ?>" class="form-control" id="exampleInputSurname" placeholder="Phone Number"  >
				<input type="hidden" name="registerType" value="1">
			  </div>
		<?php /*
		 }
		 else
		 {	?>
			 <div class="form-group col-lg-6 col-md-6 col-xs-12">
				<label for="exampleInputEmail1">Name</label>
				<input type="text" name="firstname" value="<?php echo $firstname ?>" class="form-control" id="Surname" placeholder="Name">
			  </div>
			  
			  <div class="form-group col-lg-6 col-md-6 col-xs-12">
				<label for="exampleInputEmail1">E-mail</label>
				<input type="email" name="email" value="<?php echo $email ?>" class="form-control" id="email" placeholder="E-mail">
			  </div>
			  <div class="form-group col-lg-6 col-md-6 col-xs-12 ">
				<label for="exampleInputPassword1">Phone Number</label>
				<input type="text" name="mobile_no" value="<?php echo $mobile_no ?>" class="form-control" id="exampleInputSurname" placeholder="Phone Number">
				<input type="hidden" name="registerType" value="2">
			  </div>
			<?php  
		 }
		 endif;*/
		?>
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
                <input type="text" class="form-control" name="product1" value="<?php echo $product1 ?>" id="Surname" placeholder="Product Name">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-xs-12">
                    <input type="text" class="form-control" name="quantity1" id="exampleInputSurname" placeholder="Average Quantity">
                  </div>
              </div>
              
              <div class="one-form col-md-12 col-xs-12 col-sm-12">
              	<div class="form-group col-lg-6 col-md-6 col-xs-12">
                    <input type="text" class="form-control" name="product2" value="<?php echo $product2 ?>" id="Surname" placeholder="Product Name">
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
