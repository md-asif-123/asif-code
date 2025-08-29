<?php 
		

		$nm = "invoice_".time();

      if(!empty($_POST['visit_id']) && $_POST['visit_id'] == 1):    
	    
	     $data = upload_invoice_4320($_FILES['invoice'], '/upload-invoice/visit1/',$nm);
      endif;

      if(!empty($_POST['visit_id']) && $_POST['visit_id'] == 2):    
      
       $data = upload_invoice_4320($_FILES['invoice'], '/upload-invoice/visit2/',$nm);
      endif;

      if(!empty($_POST['visit_id']) && $_POST['visit_id'] == 3):    
      
       $data = upload_invoice_4320($_FILES['invoice'], '/upload-invoice/visit3/',$nm);
      endif;

	    //print_r($_FILES);
	    // if($data['status']==1){
	    //    update_user_meta( $user_id, 'membership_proof_photo', $data['modified_name'] ); 
	    // }
	    // echo $nm.".png";
     //  echo "<pre>";
    	//  print_r($_FILES);
     //   echo "<pre>";
     //   print_r($data);
     //   echo "<pre>";
      //print_r($_POST);
	 //wp_die(); 

// file upload code

function upload_invoice_4320($filedata, $folder_name, $desire_name_to_file){

    //echo $filedata["name"];
  //print_r($filedata);
    $response = array();


    $target_dir = dirname(__FILE__). $folder_name;
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo(basename($filedata["name"]),PATHINFO_EXTENSION));

    //create unique file name
    $temp = explode(".", $filedata["name"]);
    $newfilename = $desire_name_to_file . '.' . end($temp);
    //$newfilename = $desire_name_to_file . '.png';
    $target_file = $target_dir . $newfilename;
    //echo $target_file."/".$filedata["tmp_name"];
    // Check if image file is a actual image or fake image
      // $check = getimagesize($filedata["tmp_name"]);
      // //echo $check;
      // //if($check !== false) {
      // if($check !== false) {
      //   //echo "File is an image - " . $check["mime"] . ".";
      //   $uploadOk = 1;
      //   //echo $target_file;
      // } else {
      //   //echo "fail0";
      //   $response['status'] = 0;
      //   $response['imageCheck'] = 'File is not an image';
      //   //echo "File is not an image.";
      //   $uploadOk = 0;
      // }

    // // Check if file already exists
    // if (file_exists($target_file)) {
    //   echo "Sorry, file already exists.";
    //   $uploadOk = 0;
    // }

    // Check file size
    if ($filedata["size"] > 10*1024*1024) {
      //echo "too large";
      $response['status'] = 0;
      $response['imagesize_Err'] = "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"   && $imageFileType != "gif" && $imageFileType != "pdf" ) {
      $response['status'] = 0;
      $response['imageformat_Err'] =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed." ;
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "fail1";
      $response['status'] = 0;
      $response['error'] =  "Sorry, your file was not uploaded." ;
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($filedata["tmp_name"], $target_file)) {
        //echo "success";
        $response['status'] = 1;
        $response['original_name'] = $filedata["name"];
        $response['modified_name'] = $newfilename;
        $response['path'] = $target_file;
        $response['message'] =  "The file ". htmlspecialchars( basename( $filedata["name"])). " has been uploaded." ;

      } else {
        //echo "fail";
        $response['status'] = 0;
        $response['message'] =  "Sorry, there was an error uploading your file." ;
        
      }
    }

    //print_r($response);
    echo $response['modified_name'];

    return $response;
}
?>
