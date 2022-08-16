<?php
#include the database
error_reporting(0);
require_once('config.php') ;
?>
<?php
if(!isset($_POST['mode'])){
$_POST['mode'] ="";
}
if($_REQUEST['mode']=="add"){
    add();
}
elseif($_POST['mode']=="insert"){
     insert($dbh);
}
elseif($_POST['mode']=="update"){
     update($dbh);
}
elseif($_REQUEST['mode']=="edit"){
     edit($dbh);
}
elseif($_REQUEST['mode']=="view"){
     view($dbh);
}
elseif($_REQUEST['mode']=="delete"){
     deleteStu($dbh);
}
else{
     listing($dbh);
}

?>
<?php
function listing($dbh)
{

?>
<?php


			
			
			$sql="SELECT * FROM registration";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$result=$stmt->fetchAll();
		
		
		
		
		
?>

<!DOCTYPE HTML>
<html>
<body>
<head>

<script language="JavaScript">


function editStudent(str)
{
	document.regForm.mode.value='edit';
         //document.regForm.strs.value=str;
         //document.regForm.submit();
	//var mode="edit";
	//alert(str);	 
}
function doDelete()
{ 
   c=confirm("are you sure want to delete");
   return c;
	
}
function selectAll()
{
	len=document.regForm.elements.length;
	for(i=0;i<len;i++){
		elt=document.regForm.elements[i];
		
		if(elt.type=='checkbox' && elt.name=='list'){
			elt.checked=true;
		}
		
	}
		
}


checked=false;
function checkedAll (regForm) {
    var aa= document.getElementById('regForm');
	
     if (checked == false)
          {
           checked = true
          }
        else
          {
          checked = false
          }
		  
    for (var i =0; i < aa.elements.length; i++) 
    {
		
     aa.elements[i].checked = checked;
    }
      }
	  
	  function checkboxes(){
    var inputElems = document.getElementsByTagName("input"),
    count = 0;
    for (var i=0; i<inputElems.length; i++) {
    if (inputElems[i].type === "checkbox" && inputElems[i].checked === true && inputElems[i].name == 'list[]'){
        count++;
        
    }
	
}
    if(count==0)
	{
		alert("no item selected");
		return false;
	}
	else
	{
   c=confirm("are you sure want to delete " +count+" details");
return c;
	}
}



</script>
</head>
<form name="regForm" id="regForm" action="table.php" method="post">
<input type="hidden" name="mode" value="delete"/>
	
<table border='2' width='70%' align='center'>

<tr><td colspan='10' bgcolor='#cccccc'align='center'><b>Student List&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href='table.php?mode=add'> Add Student</a></b></td></tr>
<tr><td><input type='checkbox' name='check' onclick="checkedAll(regForm);" /></td><td>#</td><td>Name</td><td>Class</td><td>Age</td><td>Address</td><td>Gender</td><td>Hobby</td><td>Edit</td><td>Delete</td></tr>
	
          
		  <?php
		foreach($result as $row)
		{
            echo "<tr><td><input type='checkbox' name='list[]' value='".$row[0]."' /></td><td>".$row[0]."</td><td><a href='table.php?mode=view&id=".$row[0]."'>".$row['name']."</a></td><td>".$row['class']."</td><td>".$row['age']."</td><td>".$row['address']."</td><td>".$row['gender']."</td><td>"?>
			<?php
			
			$sql1="SELECT * FROM hobby WHERE uid=$row[0]";
		$stmt1 = $dbh->prepare($sql1);
		$stmt1->execute();
		$result1=$stmt1->fetchAll();
			foreach($result1 as $row1)
		{
			
			echo $row1[2].' ';
			
		}
		?>
			<?php echo
			
			"</td><td><a href='table.php?mode=edit&id=".$row[0]."'>edit</a></td><td><a href='table.php?mode=delete&id=".$row[0]."' onclick='return doDelete();'>delete</a></td></tr>"; 
            
		}
			?>
          
		 
         
        <td colspan='10'><input type="submit" name="submit" value="Delete" onclick="return checkboxes();" /></td>
      </table>
	  
	  </form>
      

</body>
</html>

<?php
}
?>

<?php
function add()
{
	?>
	
	
	<html>

<body>

<form name='regForm' method='post' action='table.php'>
<input type='hidden' name='mode' value='insert'/>
<table border='2' width='70%' align='center' cellpadding='6' cellspacing='6'>
<tr><td colspan='2' align='center' bgcolor='#cccccc'><b>School Registration Form</b></td></tr>
<tr><td>Name</td><td><input type='text' name='fname' /></td></tr>
<tr><td>Class</td><td><input type='text' name='class' /></td></tr>
<tr><td>Age</td><td><input type='text' name='age' /></td></tr>
<tr><td>Address</td><td><input type='text' name='address' /></td></tr>
<tr><td>Gender</td><td><input type='radio' name='gend' value='m'>Male<input type='radio' name='gend' value='f'>Female</td></tr>
<tr><td>Hobby</td><td><input type='checkbox' name='hobby[]' value='cricket'>Cricket<input type='checkbox' name='hobby[]' value='football'>Football
<input type='checkbox' name='hobby[]' value='swimming'>Swimming</tr>
<tr><td>Uplaod Photo</td><td><input type='file' name='pic'></td></tr>
<tr><td colspan='2' align='right' bgcolor='#cccccc'><input type='submit' name='submit' value='SUBMIT'/></td></tr>
</table>
</form>
</body>
</html>
	<?php
   }
	?>
	
	<?php
function insert($dbh)
{
	?>
	<?php
//require_once('config.php');
if(!empty($_POST)){	
	foreach($_POST as $variable => $value){
		 ${$variable} = $value;
	}
	
	if($submit):	
		if($fname == ""){
			$_SESSION['error_msg'] = "Please enter your name correctly.";
			echo $_SESSION['error_msg'];
			
		}elseif($class == ""){
			$_SESSION['error_msg'] = "Please enter the class.";
			echo $_SESSION['error_msg'];
		}
		elseif($age == ""){
			$_SESSION['error_msg'] = "Please enter your age.";
			echo $_SESSION['error_msg'];
		}elseif($address == ""){
			$_SESSION['error_msg'] = "Please enter your address";
			echo $_SESSION['error_msg'];
		}		
		else{	
			$sql = "INSERT INTO `registration` (`name`, `class`, `age`, `address`,`gender`) 
			VALUES (:fname,:class,:age,:address,:gender)";
			$stmt = $dbh->prepare( $sql );
			$count=$stmt->execute(array(':fname'=>$fname,':class'=>$class,':age'=>$age,':address'=>$address,':gender'=>$gend));
			//echo '<pre>';
			//print_r($_REQUEST);
			  $uid=$dbh->lastInsertId();
			  
			  foreach($hobby as $h)
			  {
			  $sql = "INSERT INTO `hobby` (`uid`, `hobby`) 
			VALUES (:uid,:hobby)";
			$stmt = $dbh->prepare( $sql );
			$count=$stmt->execute(array(':uid'=>$uid,':hobby'=>$h));
			  }
				header("location: table.php");
			
			
			}
			
	endif;
	
	
}
?>
	<?php
}
	?>
	
	<?php
	function edit($dbh)
	{
	?>
	<?php


$id=$_GET['id'];
$sql="SELECT * FROM registration WHERE id=:id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$result=$stmt->fetchAll();
		
$sql1="SELECT * FROM hobby WHERE uid=:id";
		$stmt1 = $dbh->prepare($sql1);
		
		$stmt1->execute(array(':id'=>$id));
		$result1=$stmt1->fetchAll();
		foreach($result1 as $row1)
		{
			$hobbyArray[] = $row1['2'];
			//print_r($hobbyArray);
			echo $row1[2];
		}
		
	      
		?>

<!DOCTYPE HTML>
 <?php
		foreach($result as $row)
		{
			?>
<html>
<body>

<form name='regForm' method='post' action='table.php'>
<input type='hidden' name='mode' value='update'/>
<input type='hidden' name='id' value='<?php echo $row[0] ?>'/>
<table border='2' width='70%' align='center'>
<tr><td colspan='7' bgcolor='#cccccc'align='center'><b>Edit Form</b></td></tr>

	
          
		 
           <tr><td>Name</td><td><input type='text' name='fname' value='<?php echo $row[1] ?>'/></td></tr>
		   <tr><td>Class</td><td><input type='text' name='class' value='<?php echo $row[2] ?>'/></td></tr>
		   <tr><td>Age</td><td><input type='text' name='age' value='<?php echo $row[3] ?>'/></td></tr>
		   <tr><td>Address</td><td><input type='text' name='address' value='<?php echo $row[4] ?>'/></td></tr>
		   <tr><td>Gender</td><td><input type='radio' name='gend' value='m'<?php if($row[5]=='m') echo 'checked' ?>/>Male<input type='radio' name='gend' value='f'<?php if($row[5]=='f') echo 'checked' ?>/>Female</td></tr>
		   <tr><td>Hobby</td><td>
		   <input type='checkbox' name='hobby[]' value='cricket'<?php if(in_array('cricket', $hobbyArray)) echo 'checked'; ?>/>cricket
		   <input type='checkbox' name='hobby[]' value='football'<?php if(in_array('football', $hobbyArray)) echo 'checked'; ?>/>football
		   <input type='checkbox' name='hobby[]' value='swimming'<?php if(in_array('swimming', $hobbyArray)) echo 'checked'; ?>/>swimming
		   </td></tr>
           <tr><td colspan='2' align='right' bgcolor='#cccccc'><input type='submit' name='submit' value='UPDATE'/></td></tr>
		<?php   
		}
		
			?>
          
		 
         
        
      </table>
	  </form>
      

</body>
</html>
	
	
	
	
	<?php
	}
	?>
	
	<?php
	function update($dbh)
	{
	?>
	<?php


if(!empty($_POST)){	
	foreach($_POST as $variable => $value){
		 ${$variable} = $value;
	}
	
	if($submit):	
		if($fname == ""){
			$_SESSION['error_msg'] = "Please enter your name correctly.";
			echo $_SESSION['error_msg'];
			
		}elseif($class == ""){
			$_SESSION['error_msg'] = "Please enter the class.";
			echo $_SESSION['error_msg'];
		}
		elseif($age == ""){
			$_SESSION['error_msg'] = "Please enter your age.";
			echo $_SESSION['error_msg'];
		}elseif($address == ""){
			$_SESSION['error_msg'] = "Please enter your address";
			echo $_SESSION['error_msg'];
		}		
		else{	
			 $sql = "UPDATE `registration` SET `name` = '".$fname."', `class` = '".$class."', `age` = '".$age."',address='".$address."',gender='".$gend."' WHERE `id` = '".$id."'";		
		//exit;
		$stmt = $dbh->prepare( $sql );
		$stmt->execute();
			   echo '<pre>';
			   print_r($_REQUEST);
			   $sql1="DELETE FROM `hobby` WHERE `uid` = '".$id."'";
			   echo $sql1;
			   $stmt1 = $dbh->prepare( $sql1 );
		$stmt1->execute();
			   foreach($_REQUEST['hobby'] as $h):
			  
				 echo $h; 
				 //$sql="UPDATE `hobby` SET `hobby` = '".$h."' WHERE `uid` = '".$id."'";	
			  $sql = "INSERT INTO `hobby` SET `hobby` = '".$h."',uid='".$id."' ";
              echo $sql;			  
		//exit;
		$stmt = $dbh->prepare( $sql );
		$stmt->execute();
			  endforeach;
			  
				header("location: table.php");
			
			
			}
			
	endif;
	
	
}
?>


	<?php
	}
	?>
	
	<?php
	function view($dbh)
	{
	?>
	
	<?php


$id=$_GET['id'];
$sql="SELECT * FROM registration WHERE id=:id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$result=$stmt->fetchAll();
		
		


?>
<!DOCTYPE HTML>
<html>
<body>
<table border='2' width='70%' align='center'>
<tr><td colspan='7' bgcolor='#cccccc'align='center'><b>Details</b></td></tr>
<tr><td>#</td><td>Name</td><td>Class</td><td>Age</td><td>Address</td></tr>
	
          
		  <?php
		foreach($result as $row)
		{
            echo "<tr><td>".$row[0]."</td><td>".$row['name']."</td><td>".$row['class']."</td><td>".$row['age']."</td><td>".$row['address']."</td></tr>"; 
            
		}
			?>
          
		 
         
        
      </table>
      

</body>
</html>
	
	<?php
	}
	?>
	
	<?php
	function deleteStu($dbh)
	{
	?>
	<?php


$id=$_GET['id'];
$sql="DELETE FROM registration WHERE id=:id";
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$id));
		$result=$stmt->fetchAll();
		
		
$id1=$_POST['list'];
print_r($id1);
foreach ($id1 as $msg_id):
         $sql="DELETE FROM registration WHERE id=:id";
		 
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':id'=>$msg_id));
		$result=$stmt->fetchAll();
		echo $sql;

    endforeach;	
		header("location: table.php");
		
			


?>
	<?php
	}
	?>
