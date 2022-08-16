<?php
if(isset($_POST['submit'])):
extract($_POST);
    $error=array();
    $extension=array("jpeg","jpg","png","gif");
    foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
            {
                $file_name=$_FILES["files"]["name"][$key];
                $file_tmp=$_FILES["files"]["tmp_name"][$key];
                $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                if(in_array($ext,$extension))
                {
                   
                        $filename=basename($file_name,$ext);
                        $newFileName=$filename.time().".".$ext;
                     move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"photo_gallery/"."/".$newFileName);
                    
                }
                else
                {
                    array_push($error,"$file_name, ");
                }
            }
			endif;
?>


<form action="" method="post" enctype="multipart/form-data">
    <table width="100%">
        <tr>
            <td>Select Photo (one or multiple):</td>
            <td><input type="file" name="files[]" multiple/></td>
            <td><input type="file" name="files[]" multiple/></td>
            <td><input type="file" name="files[]" multiple/></td>
        </tr>
        <tr>
            <td colspan="2" align="center">Note: Supported image format: .jpeg, .jpg, .png, .gif</td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" name="submit" value="Create Gallery" id="selectedButton"/></td>
        </tr>
    </table>
</form>