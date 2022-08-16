<?php 
session_start();
$server = 'localhost';
$user =	'root';
$password	= '';
$database	= 'kidsworldenglish';
$dbh = new PDO("mysql:host=$server;dbname=$database", $user, $password);

if(!empty($_POST)):
	foreach($_POST as $variable => $value){
		 ${$variable} = $value;
	}
	
	if(isset($mode) && $mode=='SUBMIT'):	
		if($student_name == ""):
			$_SESSION['error_msg'] = "Please enter student name";
		elseif($gurdian_name == ""):
			$_SESSION['error_msg'] = "Please enter gurdian name";
		elseif($contact_no == ""):
			$_SESSION['error_msg'] = "Please enter phone no.";
		else:	
			$sql = "INSERT INTO `registration` SET 
					`student_name` = :student_name, 
					`gurdian_name` = :gurdian_name, 
					`contact_no` = :contact_no, 
					`age` = :age, 	
					`admission_on_class` = :admission_on_class,
					`email` = :email,
					`dob` = :dob,
					`gender` = :gender,
					`correspondance_address` = :correspondance_address,
					`permanent_address` = :permanent_address,
					`comment` = :comment";
			$stmt = $dbh->prepare( $sql );
			$count=$stmt->execute(
								  array(':student_name'=>$student_name,
										':gurdian_name'=>$gurdian_name,
										':contact_no'=>$contact_no,
										':age'=>$age,
										':admission_on_class'=>$admission_on_class,
										':email'=>$email,
										':dob'=>$dob,
										':gender'=>$gender,
										':correspondance_address'=>$correspondance_address,
										':permanent_address'=>$permanent_address,
										':comment'=>$comment
										)
								  );
			$_SESSION['error_msg'] = "Thank you for applying online at Kids World English School.";
			header('location:registration.php');
			exit;
		endif;
	endif;
endif;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">	
<link href="css/bootstrap.min.css" rel="stylesheet" media="all">
<link href="css/font-awesome.min.css" rel="stylesheet" media="all">
<link href="css/animate.css" rel="stylesheet" media="all">
<link href="css/school.css" rel="stylesheet" media="all">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
<!---- HEADER START ----->
<header id="header">
	<div class="TopHeader">
    	<div class="container">
        	<div class="row">
                <div class="phone">
                	<i class="fa fa-mobile" aria-hidden="true"></i>
                    <span>+91 90733 26366</span>
                </div>
                <div class="phone">
                	<i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <span>info@kidsworldenglish.school</span>
                </div>
                <div class="phone">
                	<i class="fa fa-globe" aria-hidden="true"></i>
                   <span>Haroa Road,Lauhati, Rajarhat, Kolkata - 700135</span>
                </div>
                <select class="form-control language">
                  <option>English</option>
                </select>
            </div>
        </div>
    </div>
	<div class="MainHeader">
    	<div class="container">
            <div class="row">
                <div class="logo">
                    <a href="index.html"></a>
                </div>
                <!------------- NAVIGATION ------------>
                <nav class="navbar navbar-default">
                  <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="academics.html">Academics</a></li>
                        <li><a href="news.html">News</a></li>
                        <li><a href="contact.html">Contacts</a></li>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
                </nav>
<!-------NAVIGATION END------->
            </div>
             <div class="BannerHeading text-center">
            	<h2>How to enroll your child to a class?</h2>
                <p class="clearfix">Our program is designed to enhance a student's self-confidence and
                encourage independence.</p>
                <a href="#" class="BtnMore">Read more <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</header>
<!---- HEADER END ----->

<!-------- APPLY ONLINE ---------->
<section id="ApplyOnline">
    <div class="container">
    	<div class="row">
            <div class="ApplyOnlineBox">
                <img src="img/applyOnlineImg.jpg" class="img-responsive"/>
                <p>
                	<span>Apply Admission</span>
                    <b>Lorem Ipsum is simply dummy text of the<br><a href="download.php" class="BtnDownloadPdf">Download PDF Format</a></b>
                </p>
            </div>
        </div>
    </div>
</section>
<!-------- APPLY ONLINE END ---------->

<!------ Discover our School -------->

<section id="DiscoverSchool">
	<div class="container">
    	<div class="row">
        	<div class="col-sm-12 nopaddingLeft">
            	<h2 class="MainHeading">Register <span></span></h2>
				<?php 
				if(isset($_SESSION['error_msg']) && ($_SESSION['error_msg'] != "")):
				?>		
					<div class="alert alert-danger"><i aria-hidden"true"="" class="fa fa-danger"></i> &nbsp;<?php echo $_SESSION['error_msg'];unset($_SESSION['error_msg']);?></div>
				<?php 
				endif; 
				?>
				<p>
					<form name='regForm' method='post' action='registration.php'>					
					  <div class="form-group">
						<label for="exampleInputEmail1">Student Name<span style="color:red">*</span></label>
						<input type='text' class="form-control" placeholder="" name='student_name' id='student_name' value='<?php if(isset($student_name)): echo $student_name; endif; ?>' />
					  </div>
					  <div class="form-group">
						<label for="exampleInputPassword1">Gurdian Name<span style="color:red">*</span></label>
						<input type='text' class="form-control" placeholder="" name='gurdian_name' id='gurdian_name' value='<?php if(isset($gurdian_name)): echo $gurdian_name; endif; ?>'/>
					  </div>
					  <div class="form-group">
						<label for="exampleInputPassword1">Phone No<span style="color:red">*</span></label>
						<input type='text' class="form-control" placeholder="" name='contact_no' id='contact_no' value='<?php if(isset($contact_no)): echo $contact_no; endif; ?>' />
					  </div>
					  
					  <div class="form-group">
						<label for="exampleInputPassword1">Admission On Class</label>
					    <select class="form-control"  name='admission_on_class' id='admission_on_class'>
							<option value="">Select Calss</option>
							<option value="Play Group" <?php if(isset($admission_on_class) && ($admission_on_class == 'Play Group')): echo 'selected="selected"'; endif; ?>>Play Group</option>
							<option value="Lower Nursery" <?php if(isset($admission_on_class) && ($admission_on_class == 'Lower Nursery')): echo 'selected="selected"'; endif; ?>>Lower Nursery</option>
							<option value="Class 1" <?php if(isset($admission_on_class) && ($admission_on_class == 'Class 1')): echo 'selected="selected"'; endif; ?>>Class 1</option>
							<option value="Class 2" <?php if(isset($admission_on_class) && ($admission_on_class == 'Class 2')): echo 'selected="selected"'; endif; ?>>Class 2</option>
							<option value="Class 3" <?php if(isset($admission_on_class) && ($admission_on_class == 'Class 3')): echo 'selected="selected"'; endif; ?>>Class 3</option>
							<option value="Class 4" <?php if(isset($admission_on_class) && ($admission_on_class == 'Class 4')): echo 'selected="selected"'; endif; ?>>Class 4</option>
					    </select>
					  </div>
					  
					  
					  <div class="form-group">
						<label for="exampleInputPassword1">Email</label>
						<input type='email' class="form-control" placeholder="" name='email' id='email' value='<?php if(isset($email)): echo $email; endif; ?>'/>
					  </div>
					  <div class="form-group">
						<label for="exampleInputPassword1">Date Of Birth</label>
						<input type='text' class="form-control" autocomplete="off" placeholder="dd-mm-yyyy" name='dob' id='dob' value='<?php if(isset($dob)): echo $dob; endif; ?>' readonly='readonly' />
					  </div>
					  
					  <div class="form-group">
						<label for="exampleInputPassword1">Age</label>
						<input type='text' class="form-control" placeholder="" name='age' id='age' value='<?php if(isset($age)): echo $age; endif; ?>'/>
					  </div>
					  
					  <div class="form-group">
					  <label for="exampleInputPassword1" class="btn-block">Gender</label>
					  
						   <label class="radio-inline">
							  <input type='radio' name='gender' id='gender1' value='m' <?php if(isset($_POST['gender']) && ($_POST['gender'] == 'm')): echo 'checked="checked"'; endif; ?>
							  <?php if(!isset($_POST['gender'])): echo 'checked="checked"'; endif; ?>
							  > Male
							</label>
							<label class="radio-inline">
							  <input type='radio' name='gender' id='gender2' value='f' <?php if(isset($_POST['gender']) && ($_POST['gender'] == 'f')):?> checked="checked" <?php endif; ?>>Female
							</label>
					  </div>
					  <div class="form-group">
						<label for="exampleInputPassword1" >Correspondance Address</label>
						<textarea class="form-control" rows="3" name='correspondance_address' id='correspondance_address'><?php if(isset($correspondance_address)): echo $correspondance_address; endif; ?></textarea>
					  </div>
					  <div class="form-group">
						<label for="exampleInputPassword1" >Permanent Address</label>
						<textarea class="form-control" rows="3" name='permanent_address' id='permanent_address'><?php if(isset($permanent_address)): echo $permanent_address; endif; ?></textarea>
					  </div>
					  <div class="form-group">
						<label for="exampleInputPassword1" >Comment</label>
						<textarea class="form-control" rows="10" name='comment' id='comment'><?php if(isset($comment)): echo $comment; endif; ?></textarea>
					  </div>
					  <div class="form-group text-center">
						<input type="hidden" name="mode" value="SUBMIT" />
						<button type='submit' class="btn btn-lg btn-success" name='submit'>SUBMIT</button>
					  </div>
					</form>
				</p>
            </div>
        </div>
    </div>
</section>

<!------ Discover our School end -------->

<!-------- FOOTER START --------->
<footer id="PageFooter">
	<div class="container">
        <div class="row">
        	<div class="FooterContent">
                <div class="col-sm-3 col-xs-12">
                    <h3 class="FooterHeading">Our School<span></span></h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <div class="SocialLinksFooter SocialLinksFooterTop">
                        <ul>
                            <li class="first"><a href="#" class="fb"><i class="fa  fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#" class="google"><i class="fa  fa-google-plus" aria-hidden="true"></i></a></li>
                            <li><a href="#" class="twitter"> <i class="fa  fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#" class="youtube"><i class="fa  fa-youtube" aria-hidden="true"></i></a></li>
                            <li><a href="#" class="instagram"><i class="fa  fa-instagram" aria-hidden="true"></i></a></li>
                            <li class="last"><a href="#" class="cloud"><i class="fa  fa-cloud" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                    <h3 class="FooterHeading">Resources<span></span></h3>
                    <ul class="ResourceUl">
                        <li class="first"><i class="fa fa-angle-right" aria-hidden="true"></i><a href="#">Careers</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true"></i><a href="#">Secondary School Blog</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true"></i><a href="#">Inspiring Minds Centre</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true"></i><a href="#">Academic Calendar</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true"></i><a href="#">Our School,s Policies</a></li>
                        <li class="last"><i class="fa fa-angle-right" aria-hidden="true"></i><a href="#">Sitemap</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 col-xs-12">
                    <h3 class="FooterHeading">Contacts<span></span></h3>
                    <ul class="ContactUl">
                        <li class="first"><i class="fa fa-fw fa-globe" aria-hidden="true"></i>Haroa Road,Lauhati, Rajarhat, Kolkata - 700135</li>
                        <li><i class="fa fa-fw fa-mobile" aria-hidden="true"></i>+91 90733 26366</li>
                        <li><i class="fa fa-fw fa-print" aria-hidden="true"></i>+91 90733 26366</li>
                        <li><i class="fa fw-fw fa-envelope" aria-hidden="true"></i> info@kidsworldenglish.school</li>
                        <li class="last"><i class="fa fa-fw fa-clock-o" aria-hidden="true"></i> Mon - Sat: 9AM - 6PM</li>
                    </ul>
                </div>
                <div class="col-sm-3 col-xs-12">
                    <h3 class="FooterHeading">Recent Posts<span></span></h3>
                    <ul class="PostUl">
                        <li class="first">Lorem Ipsum is simply dummy text of the printing
                        <span><i class="fa fa-fw fa-calendar" aria-hidden="true"></i>
                        December 1,2017</span>
                        </li>
                        <li>Lorem Ipsum is simply dummy text of the printing
                        <span><i class="fa fa-fw fa-calendar" aria-hidden="true"></i>
                        December 1,2017</span>
                        </li>
                        <li class="last">Lorem Ipsum is simply dummy text of the printing
                        <span><i class="fa fa-fw fa-calendar" aria-hidden="true"></i>
                        December 1,2017</span>
                        </li>
                    </ul>
                </div>
                <div class="SocialLinksFooter SocialLinksFooterDown">
                	<ul>
                    	<li class="first"><a href="#" class="fb"><i class="fa  fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="google"><i class="fa  fa-google-plus" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="twitter"> <i class="fa  fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="youtube"><i class="fa  fa-youtube" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="instagram"><i class="fa  fa-instagram" aria-hidden="true"></i></a></li>
                        <li class="last"><a href="#" class="cloud"><i class="fa  fa-cloud" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footerCopyrights text-center">
    	<p><span>Copyrights&copy; </span>Kid's World English School</p>
    </div>
</footer>
<!-------- FOOTER END --------->

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#dob" ).datepicker({		
		onSelect: function(value, ui) {		
			$.ajax({
				url: "ajax-get-age.php",
				type: 'post',
				data: "value="+value,
				dataType: 'json',
				success: function(json) {
					$('#age').val(json['age']);
				}
			});		  
		},
		maxDate: "<?php echo date("d-m-Y", strtotime("-2 year"));?>",
		dateFormat: 'dd-mm-yy',
		yearRange: '2005:<?php echo date("Y", strtotime("-2 year"));?>',
		changeYear: true,
		changeMonth: true
	});
  });
</script>
</body>
</html>