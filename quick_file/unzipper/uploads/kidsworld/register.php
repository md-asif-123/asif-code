<?php
$server = 'localhost';
$user =	'root';
$password	= '';
$database	= 'kidsworldenglish';
$dbh = new PDO("mysql:host=$server;dbname=$database", $user, $password);

if(!empty($_POST)):
	foreach($_POST as $variable => $value){
		 ${$variable} = $value;
	}
	
	if(isset($submit) && $submit=='SUBMIT'):	
		if($student_name == ""):
			$_SESSION['error_msg'] = "Please enter your name";
			
			
		elseif($gurdian_name == ""):
			$_SESSION['error_msg'] = "Please enter your gurdian name";
			
		
		elseif($contact_no == ""):
			$_SESSION['error_msg'] = "Please enter contact no.";
			
			
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
			header('location:register.php');
			exit;
		endif;
	endif;
endif;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<link href="css/bootstrap.min.css" rel="stylesheet" media="all">
<link href="css/style.css" rel="stylesheet" media="all">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#dob" ).datepicker();
  } );
  </script>

</head>

<body>
<?php if(isset($_SESSION['error_msg'])): echo $_SESSION['error_msg'];  unset($_SESSION['error_msg']); endif;?>
<div class="container">
	<form name='regForm' method='post' action='register.php'>
		<h2 class="text-center">School Registration Form</h2>
            <div class="form-group">
            <label for="exampleInputEmail1">Student Name</label>
			<input type='text' class="form-control" placeholder="Student Name" name='student_name' id='student_name' value='<?php if(isset($student_name)): echo $student_name; endif; ?>' />
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Gurdian Name</label>
			<input type='text' class="form-control" placeholder="Gurdian Name" name='gurdian_name' id='gurdian_name' value='<?php if(isset($gurdian_name)): echo $gurdian_name; endif; ?>'/>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Phone No</label>
			<input type='text' class="form-control" placeholder="Phone No" name='contact_no' id='contact_no' value='<?php if(isset($contact_no)): echo $contact_no; endif; ?>' />
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Age</label>
			<input type='text' class="form-control" placeholder="Age" name='age' id='age' value='<?php if(isset($age)): echo $age; endif; ?>'/>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Admission On Class</label>
			<input type='text' class="form-control" placeholder="Age" name='admission_on_class' id='admission_on_class' value='<?php if(isset($admission_on_class)): echo $admission_on_class; endif; ?>' />
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
			<input type='email' class="form-control" placeholder="Email" name='email' id='email' value='<?php if(isset($email)): echo $email; endif; ?>'/>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Date Of Birth</label>
			<input type='text' class="form-control" placeholder="Date Of Birth" name='dob' id='dob' value='<?php if(isset($dob)): echo $dob; endif; ?>'/>
          </div>
          <div class="form-group">
          <label for="exampleInputPassword1" class="btn-block">Gender</label>
          	   <label class="radio-inline">
				  <input type='radio' name='gender' id='gender1' value='m' <?php if(isset($gender) == 'm'):?> checked="checked" <?php else: echo 'checked="checked"'; endif; ?>> Male
                </label>
                <label class="radio-inline">
				  <input type='radio' name='gender' id='gender2' value='f' <?php if(isset($gender) == 'f'):?> checked="checked"; <?php endif; ?>>Female
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
			<input type='submit' class="btn btn-block btn-lg btn-danger" name='submit' value='SUBMIT'/>
          </div>
    </form>
</div>


</body>
</html>
