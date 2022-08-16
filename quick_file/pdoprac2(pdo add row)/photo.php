<?php
include_once('config.php');
  $sql="SELECT * FROM photo";
  $stmt=$dbh->prepare($sql);
  $stmt->execute();
  $result=$stmt->fetchAll();
?>

<html>
<body>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>



$(document).ready(function(){
	var i=3;
	var j=4;
	$('.plusbtn').click(function() {
	
$("#test").append('<tr><td><input type="file" name="pic[]"></td></tr>');
i++;j++;
	});
$('.minusbtn').click(function() {
if($("#test tr").length > 2)
	{
		$("#test tr:last-child").remove();
	}

});
});

</script>
</head>
<form name="myForm" method="post" action="photoPrac.php" enctype="multipart/form-data">
<table id='test' border='2' width='40%'>
<tr><td colspan='2' align='center' bgcolor='#cccccc'><b>Upload Image&nbsp&nbsp&nbsp <a href='view.php'>View All Image</a></b></td></tr>
<tr><td><input type='file' name='pic[]'/></tr>
</table>
<table border='2' align='center'>

<input type='submit' name='submit' value='send'>
<input type="button" value="ADD ROW" class="plusbtn" />				 
<input type="button" value="REMOVE ROW" class="minusbtn" />
</table>
</form>
</body>
</html>