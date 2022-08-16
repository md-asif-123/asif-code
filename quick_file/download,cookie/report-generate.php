<?php require_once('lib/config.php');
require_once('lib/header.php');
$username_admin = $_SESSION["username_admin"];
if(!$username_admin):
header("Location: login.php");
endif;
?>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#inputFrom" ).datepicker();
	$( "#inputTo" ).datepicker();
  } );
  </script>
 <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <h3>Report Generate</h3>
           
<form class="form-horizontal" method="post" action="datadownload.php">
  <fieldset>
   
	
	 <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Report For *</label>
      <div class="col-lg-10">
        <select class="form-control" name="type" id="type">
		<option value="0">General Registration</option>
		<option  value="1">Vip Buyer Registration</option>
    	<option  value="2">Match Making</option>
		<option  value="3">Schedule Meeting</option>
		<option  value="4">Call center</option>
		<option  value="5">Media registration</option>
    </select>
      </div>
    </div>
	
	 <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">From</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputFrom" name="fromdate" placeholder="From Date" type="text" required />
      </div>
    </div>
	
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">To</label>
      <div class="col-lg-10">
        <input class="form-control" id="inputTo" name="todate" placeholder="To Date" type="text" required />
      </div>
    </div>
   
   
   
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
	  <input type="submit" class="btn btn-default" name="submit" value="Download">   
      </div>
    </div>
  </fiedset>
</form>
 
      </div>
        </div>
       
      </div><br/>
<?php require_once('lib/footer.php');