
<?php
require_once('config1.php');

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
 <script type="text/javascript" src="resources/jquerylib.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>
$(document).ready(function(){
     	$('#r').click(function(){
			$('#tdiv1').show();
			$('#tdiv2').hide();
			 $('#m1').hide();
			 $('#btn22').show();
			 $('#btn11').hide();
			 $('#btn33').hide();
			});
			
			$('#b3').click(function(){
				var mobile=$('#mobile1').val();
			if(mobile==''){
				$('#m1').show();
			$('#msg1').html('Please submit your mobile number or register');
			}
			else
			{
				  $('#tdiv2').hide();
				$('#m1').show();
			$('#msg1').html('Please submit your mobile number');
			}
			});
			
			$('#r3').click(function(){
				
			 
			var mobile=$('#mobile1').val();
			if(mobile==''){
				$('#tdiv1').hide();
				$('#btn22').hide();
				$('#btn11').hide();
				$('#btn33').show();
			 $('#m1').show();
			 $('#tdiv2').hide();
          $('#msg1').html('Enter your mobile number');
		}
		   else{
			   
          $.ajax({
			  
           type:'post',
           url:'mb.php',
           data:{m1:mobile},
           success: function(result){
			   //$('#btn22').hide();
				//$('#btn11').show();
				//$('#btn33').hide();
			   $('#m1').hide();
          $('#tdiv2').show();
		  $('#tdiv1').hide();
          $('#msg4').html(result);
           }
          });
         }
			});
			
			
			$('#b1').click(function(){
			
			var name=$('#fname').val();
			var email=$('#email').val();
			var mobile=$('#mobile').val();
			var product1=$('#pd1').val();
			var product2=$('#pd2').val();
			var product3=$('#pd3').val();
         if(name==''){
			 $('#m1').show();
          $('#msg1').html('Enter your name');
         }
		 else
			 if(email==''){
			 $('#m1').show();
          $('#msg1').html('Enter your email');
		}
		else
			 if(mobile==''){
			 $('#m1').show();
          $('#msg1').html('Enter your mobile');
		}
		else
			 if(product1==''){
			 $('#m1').show();
          $('#msg1').html('Enter atleast two products');
		}
		 else{
          $.ajax({
           type:'post',
           url:'db1.php',
           data:{n:name,e:email,m:mobile,p1:product1,p2:product2,p3:product3},
           success: function(result){
          $('#m1').show();
          $('#msg1').html('inserted into database');
           }
          });
         }
			});
			
			
			$('#b2').click(function(){
			
			var name=$('#fname1').val();
			var email=$('#email1').val();
			var mobile=$('#mobile2').val();
			var product1=$('#pd1').val();
			var product2=$('#pd2').val();
			var product3=$('#pd3').val();
         if(name==''){
			 $('#m1').show();
          $('#msg1').html('Enter your name');
         }
		 else
			 if(email==''){
			 $('#m1').show();
          $('#msg1').html('Enter your email');
		}
		else
			 if(mobile==''){
			 $('#m1').show();
          $('#msg1').html('Enter your mobile');
		}
		else
			 if(product1==''){
			 $('#m1').show();
          $('#msg1').html('Enter atleast two products');
		}
		 else{
          $.ajax({
           type:'post',
           url:'db1.php',
           data:{n:name,e:email,m:mobile,p1:product1,p2:product2,p3:product3},
           success: function(result){
          $('#m1').show();
          $('#msg1').html('inserted into database');
           }
          });
         }
			});
			
			 });
</script>
	
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
		<?php
		       $p=$_REQUEST['product_id'];
			   $sql="SELECT * FROM products WHERE id=$p";
			   $rec=mysql_query($sql);
			  $row=mysql_fetch_row($rec);
			  $c=$row[1]; 
			  $sql1="SELECT * FROM company WHERE id=$c";
			   $rec1=mysql_query($sql1);
			  $row1=mysql_fetch_row($rec1);
		?>
        	<h3 class="mainheding"><?php echo $row1[1]; ?></h3>
                <img src="img/pro.jpg" class="img-responsive">
                <div class="product-detils">
                    <h2 class="heading"><?php echo $row[2]; ?></h2>
                    <p class="all-text"><?php echo $row[5]; ?></p>
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
    	
		<h4 class="sub-heading">Already Registered with CHL,Serach your information by name or unique registration no</h4>
		<div class="mobile-number"><input type='text' value='' name='mobile_no1' id='mobile1'/><input type='submit' value='SUBMIT' class="btn btn-default" name="submit1" id='r3' /></div>
		 
		 
		
		<input type='submit' value='Not Registered with CHL' class="btn btn-default" name="submit1" id="r" />
		
    </div>
</section>

<!-----RED AREA END----->

<!----REG FORM------>
<div style="display:none" id="tdiv2" >
<div id='msg4'>
<!----to display SDSFDFDFDFGDGDGGGGGGG------>
</div>

</div>
<div style="display:none" id="tdiv1" >

<section class="regform">
	<div class="container">
    	<div class="title"> 
		
		
       
        </div>
    	 
			  <div class="form-group col-lg-6 col-md-6 col-xs-12">
				<label for="exampleInputEmail1">Name</label>
		<input type="text" name="firstname1" value="" class="form-control" id="fname1" placeholder="Name" />
			  </div>
			  
			  <div class="form-group col-lg-6 col-md-6 col-xs-12">
				<label for="exampleInputEmail1">E-mail</label>
				<input type="email1" name="email" value="" class="form-control" id="email1" placeholder="E-mail"/>
			  </div>
			  <div class="form-group col-lg-6 col-md-6 col-xs-12 ">
				<label for="exampleInputPassword1">Phone Number</label>
				<input type="text" name="mobile_no1" value="" class="form-control" id="mobile2" placeholder="Phone Number" />
				<input type="hidden" name="registerType" value="1">
			  </div>
		
    </div>
</section>
</div>
<!----REG FORM------>

<!-----INTRESTED PRODUCT------>

<section class="interested-product text-center">
<div align='center' style="display:none" id="m1" >
 <table border="0">
   <tr id="msg1"></tr>
 </table>
 </div>
	<div class="container">
    	<span class="heading">Tell us about other products you are interested in and we will recomnend matching suppliers</span>
        <div class="product-form">
        	<form class="form">
              <div class="one-form col-md-12 col-xs-12 col-sm-12">
              	<div class="form-group col-lg-6 col-md-6 col-xs-12">
                <input type="text" class="form-control" name="product1" value="" id="pd1" placeholder="Product Name">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-xs-12">
                    <input type="text" class="form-control" name="quantity1" id="exampleInputSurname" placeholder="Average Quantity">
                  </div>
              </div>
              
              <div class="one-form col-md-12 col-xs-12 col-sm-12">
              	<div class="form-group col-lg-6 col-md-6 col-xs-12">
                    <input type="text" class="form-control" name="product2" value="" id="pd2" placeholder="Product Name">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-xs-12 ">
                    <input type="text" class="form-control" name="quantity2" id="exampleInputSurname" placeholder="Average Quantity">
                  </div>
              </div>
              
              <div class="one-form col-md-12 col-xs-12 col-sm-12">
              	<div class="form-group col-lg-6 col-md-6 col-xs-12">
                    <input type="text" class="form-control" name="product3" id="pd3" placeholder="Product Name">
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
		<div style="display:none" id="btn11" >
<div id='btn1'>
<input type='submit' value='SEND' class="send-button" name="submit" id='b1'/>
</div>

</div>
        <div style="display:none" id="btn22" >
<div id='btn2'>
<input type='submit' value='SUBMIT' class="send-button" name="submit" id='b2'/>
</div>

</div>
        <div id="btn33" >
<div id='btn2'>
<input type='submit' value='SUBMIT1' class="send-button" name="submit" id='b3'/>
</div>

</div>
		
    </div>
</section>

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
