<?php 
error_reporting(0);
require_once('lib/config.php');
//if($_POST):		
	$status	= 0;
	$message = 'Error';
	$data = $_REQUEST;	
	$str = '';
	
	$sql_product_sub_cat = "SELECT * from `categories` WHERE `parent_id`='".$data['id']."' AND `website_id`='".$data['country_id']."'";
	//echo $sql_product_sub_cat;

	$stmt_product_sub_cat = $dbh->prepare( $sql_product_sub_cat );
	$stmt_product_sub_cat->execute();
	if($stmt_product_sub_cat->rowCount() > 0):
		$status	= 1;
		$data_product_sub_cat = $stmt_product_sub_cat->fetchAll(PDO::FETCH_ASSOC);
		$str .='<div class="form-group"><label for="inputEmail" class="col-lg-2 control-label">Sub-category</label>
					<div class="col-lg-10" ><select class="form-control" id="sub_category_id" name="sub_category_id">';
		$str_options = '';
		foreach($data_product_sub_cat as $key_sub_cat => $val_sub_cat):
			$str_options .= '<option value="'.$val_sub_cat['id'].'">'.$val_sub_cat['name'].'</option>'; 
		endforeach;
		$str .= $str_options.'</select></div></div>';
	endif;
	
	$arr = array('status'=>$status, 'str'=>$str, 'ssql'=>$sql_product_sub_cat, 'message' => 'Retrieved successfully');
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($arr);
	exit;
//endif;?>