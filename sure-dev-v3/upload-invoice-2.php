<?php
  //echo $_POST['visit_id']."aa";
  $nm = "invoice_".time();
  $filename_before = basename($_FILES['file']['name']);

  $fileType = pathinfo($filename_before, PATHINFO_EXTENSION);
  //$filename = $user_id.'_certificate_';
  $filename = $nm.'.'.$fileType;
  $targetDir = "/var/www/html/sure-dev-v3/wp-content/themes/docmode_sure/inc/upload-invoice/visit1/";

  $targetFilePath = $targetDir.$filename;

 
  $allowTypes = array('jpg','png','jpeg','pdf');
  //$allowTypes = array('pdf');

  if(in_array($fileType, $allowTypes)){
    if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)){
      //update_user_meta( $user_id, 'life_member_certificate', $filename );
      $response['status'] = 'ok';
      $response['filename'] = $filename;
    }else{
      $response['status'] = 'error';
    }
  }else{
    $response['status'] = 'type error';
  }

  echo json_encode($response);


?>