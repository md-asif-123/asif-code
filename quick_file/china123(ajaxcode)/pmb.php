<script type="text/javascript" src="resources/jquerylib.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<?php
require_once('config.php');

$mobile=$_POST['m1'];


 $sql="SELECT * FROM enquiry WHERE mobile_no='$mobile'";
$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$row=$stmt->fetch();

 if($row)
{?>
                <script>
                $('#btn22').hide();
				$('#btn11').show();
				$('#btn33').hide();
				</script>
	<section class="regform">
	<div class="container">
    	<div class="title"> 
		
		
       
        </div>
    	 
			  <div class="form-group col-lg-6 col-md-6 col-xs-12">
				<label for="exampleInputEmail1">Name</label>
		<input type="text" name="firstname" value="<?php echo $row[2] ?>" class="form-control" id="fname" placeholder="Name" disabled />
			  </div>
			  
			  <div class="form-group col-lg-6 col-md-6 col-xs-12">
				<label for="exampleInputEmail1">E-mail</label>
				<input type="email" name="email" value="<?php echo $row[4] ?>" class="form-control" id="email" placeholder="E-mail" disabled />
			  </div>
			  <div class="form-group col-lg-6 col-md-6 col-xs-12 ">
				<label for="exampleInputPassword1">Phone Number</label>
				<input type="text" name="mobile_no" value="<?php echo $row[5] ?>" class="form-control" id="mobile" placeholder="Phone Number" disabled />
				<input type="hidden" name="registerType" value="1">
			  </div>
		
    </div>
</section>

<?php
}
else
{
	?>
	<script>
              
			 $('#btn22').hide();
			 $('#btn11').hide();
			 $('#btn33').show();
			
			</script>
			<section class="interested-product text-center">

	<center>sorry mobile no not found</center>
	
	</section>
	<?php
}
?>
