<?php 
error_reporting(0);
require_once('lib/config.php');
//if($_POST):		
	$status	= 0;
	$message = 'Error';
	$data = $_REQUEST;	
	$str = '';
	//echo $_REQUEST['id'];
	$sql_product_sub_cat = "SELECT * from `categories` WHERE `parent_id`='".$data['id']."' AND `website_id`='".$data['country_id']."'";
	echo $sql_product_sub_cat;
	$stmt_product_sub_cat = $dbh->prepare( $sql_product_sub_cat );
	$stmt_product_sub_cat->execute();
	if($stmt_product_sub_cat->rowCount() > 0):
		$status	= 1;
		$data_product_sub_cat = $stmt_product_sub_cat->fetchAll(PDO::FETCH_ASSOC);
		?>
		<div class="form-group"><label for="inputEmail" class="col-lg-2 control-label">Sub-category</label>
					<div class="col-lg-10" ><select class="form-control" id="sub_category_id" name="sub_category_id">
					<?php
		$str_options = '';
		foreach($data_product_sub_cat as $key_sub_cat => $val_sub_cat):?>
			<option value="<?php echo $val_sub_cat['id'] ?>"><?php echo $val_sub_cat['name']  ?></option>
			<?php
		endforeach;
		?></select></div></div>
		<?php
	endif;
	
	
//endif;?>