<?php require_once('lib/config.php');
require_once('lib/header.php');
$username_admin = isset($_SESSION["username_admin"]) ;

if($username_admin !='1'):
	header("Location: login.php");
endif;

$sql_products = "SELECT * FROM `categories` WHERE `status`='1' AND `parent_id` = '0' AND `website_id`='".$country_id."'";
$stmt_products = $dbh->prepare( $sql_products );
$stmt_products->execute();
$result_products = $stmt_products->fetchAll();


$sql_exhibitors = "SELECT * FROM `exhibitors` WHERE `status` = '1' AND `country_id`='".$country_id."' ORDER BY `company`";
$stmt_exhibitors = $dbh->prepare( $sql_exhibitors );
$stmt_exhibitors->execute();
$result_exhibitors = $stmt_exhibitors->fetchAll();
	

if($submit):
	$img = $_FILES['pic']['name'];
	if(empty($name)):
		$message = "Please enter product title";
	elseif(empty($img)):
		$message = "Please select product image";		
	else:
		$image = time().$_FILES['pic']['name'];
		$file_loc = $_FILES['pic']['tmp_name'];
		$file_size = $_FILES['pic']['size'];
		$file_type = $_FILES['pic']['type'];
		$folder="../media/catalog/products/$country_id/";
		move_uploaded_file($file_loc,$folder.$image);
		
		if(!isset($_REQUEST['sub_category_id'])):
			$sub_category_id = 0;
		endif;
		
		$array = array
					(	
					'name' => "$name",
					'image' => "$image",
					'price' => "$price",
					'qty' => "$qty",
					'unit' => "$unit",
					'custom_link' => "$customlink",
					'country_id' => "$country_id",
					'exhibitor_id' => "$exhibitor_id",
					'category_id' => "$category_id",
					'sub_category_id' => "$sub_category_id",
					'is_home' => "$is_home",
					'status' => "$status"
					);
				
		$lastID = $addadmin->addProduct($array,$dbh,products);	
		
		 
		if(count($_FILES['input_file']['name']) > 0):	
			foreach($_FILES['input_file']['name'] as $key_image => $val_image):
				if(isset($_FILES['input_file']['name'][$key_image]) && ($_FILES['input_file']['name'][$key_image]!='')):
					$image = time().rand().$_FILES['input_file']['name'][$key_image];				
					$file_loc = $_FILES['input_file']['tmp_name'][$key_image];
					$file_size = $_FILES['input_file']['size'][$key_image];
					$file_type = $_FILES['input_file']['type'][$key_image];
					$folder="../media/catalog/products/$country_id/";
					move_uploaded_file($file_loc,$folder.$image);
					
					$sql_insert_exhibitors = "INSERT INTO `product_images` SET `product_id` = '".$lastID."', `status`='1', `image`='".$image."'";
					$stmt_insert_exhibitors = $dbh->prepare( $sql_insert_exhibitors );
					$stmt_insert_exhibitors->execute();
				endif;
			endforeach;
		endif;
	endif;
endif;

?>
 <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <h3>Product Management</h3>
            <?php if($message != ""):?>			
				<div class="alert alert-success"><i aria-hidden"true"="" class="fa fa-success"></i> &nbsp;<?php echo $message;?></div>		  	 		
			<?php endif; ?>
			</br>
         <form class="form-horizontal" enctype="multipart/form-data" method="post">
  <fieldset>
	
	<div class="form-group">
	  <label for="inputEmail" class="col-lg-2 control-label">Exhibitor</label>
	  <div class="col-lg-10">
		<select class="form-control" id="exhibitor_id" name="exhibitor_id">
			<option value="">Please select exhibitor</option>
			<?php
			if(count($result_exhibitors) > 0):
				foreach($result_exhibitors as $key_exhibitors => $val_exhibitors):			
			?>
					<option value="<?php echo $val_exhibitors['id'];?>"><?php echo $val_exhibitors['company'];?></option>
			<?php
				endforeach;
			endif;
			?>
		</select>
	  </div>
	</div>
	
	
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Product Name</label>
      <div class="col-lg-10">
        <input class="form-control" id="Product-Name" name="name" placeholder="Product Name" type="text">
      </div>
    </div>
	
	<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Category</label>
      <div class="col-lg-10">
        <select class="form-control" id="category_id" name="category_id" onchange="getSubCategory(this.value);">
			<option value="55555">Please select category</option>
			
			<?php
			if(count($result_products) > 0):
				foreach($result_products as $key_products => $val_products):
			?>
					<option value="<?php echo $val_products['id'];?>"><?php echo $val_products['name'];?></option>
			<?php
				endforeach;
			endif;
			?>
			<option value="">other</option>
		</select>
      </div>
    </div>
	
	<span id="sub_cat_html"></span>
	
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Unit Price</label>
      <div class="col-lg-10">
        <input class="form-control" id="Unit-Price" name="price" placeholder="Unit Price" type="text">
      </div>
    </div>
	
	<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Unit </label>
      <div class="col-lg-10">
        <input class="form-control" id="Quantity" name="unit" placeholder="Product Unit" type="text">
      </div>
    </div>
	
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Quantity </label>
      <div class="col-lg-10">
        <input class="form-control" id="Quantity" name="qty" placeholder="Quantity" type="text">
      </div>
    </div>
	
	
	 <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Custom Link </label>
      <div class="col-lg-10">
        <input class="form-control" id="Quantity" name="customlink" placeholder="Custom link" type="text">
      </div>
    </div>
	
   
      <div class="form-group">
        <label for="exampleInputFile" class="col-lg-2 control-label">Product image</label>
        <div class="col-sm-10">
        	<input type="file" id="exampleInputFile" name="pic">
        	
        </div>
      </div>
	  <script type="text/javascript">
			function getSubCategory(sub_cat_id){				
				//alert(sub_cat_id);
				$.ajax({
					url: "ajax_get_sub_category1.php",
					type: 'post',
					data: "id="+sub_cat_id+"&country_id=<?php echo $country_id;?>",
					dataType: 'json',
					success: function(json) {
							$("#sub_cat_html").html(json['str']);
					},
					error: function(xhr, textStatus, errorThrown) {
						alert(errorThrown);
					}
				});
			}
			function alertUploadFile(){
				if ($(".newfile").is(":visible")){ 
					var empty = 0;
					$('.newfile').each(function(){
					   if (this.value == "") {
						   empty++;
					   } 
					});
					
					if(empty > 0){
						alert("Please upload file.");
						return false;
					}
				}
			}
			function deleterow(no){	
				alert(no);
				$('#id'+no).remove();
				//document.getElementById("options-table").deleteRow(no);
			}
			var counter = 2;
			function addRow(){					
				var appendTxt = "<tr id='id"+counter+"'><td><input type='file' name='input_file[]' id='input_file[]' class='newfile' /></td> <td><input type='button' class='del' value='Delete' onclick='deleterow("+counter+")' /></td></tr>";
				$("tr:last").after(appendTxt);
				counter = counter +1;
			}
		</script>
	  <div class="form-group">
		<label for="exampleInputFile" class="col-lg-2 control-label">More image</label>
		<div class="col-sm-10">
        	<table id="options-table">
				<tr>
					<td>&nbsp;</td>                     
					<td><input type="button" class="add" value="Add More Image" onclick="addRow()" /></td>
				</tr>
				<tr id="id1">
					<td><input type="file" class='newfile' name="input_file[]" id="input_file[]" /></td>                      
					<td>&nbsp;</td>
				</tr>  
			</table>
        </div>
	  </div>
	  
	  <div class="form-group">
      <label class="col-lg-2 control-label">Is Home</label>
	  <div class="col-lg-10">
		<div class="radio">
		  <label>
			<input name="is_home" id="is_home1" value="0" checked="" type="radio">
			Yes
		  </label>
		</div>
		<div class="radio">
		  <label>
			<input name="is_home" id="is_home2" value="1" type="radio">
			No
		  </label>
		</div>
	  </div>
    </div>
	  
	  
    <div class="form-group">
      <label class="col-lg-2 control-label">Status</label>
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input name="status" id="optionsRadios1" value="0" checked="" type="radio">
            No
          </label>
        </div>
        <div class="radio">
          <label>
            <input name="status" id="optionsRadios2" value="1" type="radio">
            Yes
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
       <input type="submit" onclick="return alertUploadFile();" class="btn btn-default" name="submit" value="Submit">
	  <input type="reset" class="btn btn-default" name="submit" value="Reset">
      </div>
    </div>
  </fieldset>
</form>
            
          </div>
        </div>
       
      </div>
<?php require_once('lib/footer.php');