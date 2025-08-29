<?php
ini_set('session.cookie_samesite', 'None');
session_set_cookie_params(['samesite' => 'None']);
session_start();
// print_r($_SERVER);
include('../db-config.php');
include('../srb-function.php');

  $partial_url = explode("/", $_SERVER['REQUEST_URI']); 
  $post_slug = $partial_url[1];
  $hall_slug = $partial_url[3];
  $name = ( $_SESSION["name"] ) ? $_SESSION["name"] : '';
  $email = ( $_SESSION["email"] ) ? $_SESSION["email"] : '';
?>

<html><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?php echo $post_slug.'-'.$hall_slug.' QnA';?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="../../js/script.js"></script>
    <style type="text/css">
          span.responce_msg {
              padding: 5px 15px;
              font-weight: bold;
          }
    </style>

</head>
<body>
<?php 

?>
        <div class="container">
          <h2>QnA</h2>
          <form id="frm-qna">
            <div class="form-group">
              <label for="vc-user-full-name">Full name <span style="color:red">*</span> </label>
              <input type="text" class="form-control" id="vc-user-full-name" placeholder="Enter full name" name="vc-user-full-name" required="" value="<?php echo $name;?>">
            </div>

            <div class="form-group">
              <label for="vc-user-email">Email <span style="color:red">*</span></label>
              <input type="email" class="form-control" id="vc-user-email" placeholder="Enter email" name="vc-user-email" required="" value="<?php echo $email;?>" >
            </div>
            <div class="form-group">
              <label for="vc-user-location">User location <span style="color:red">*</span></label>
              <input type="text" class="form-control" id="vc-user-location" placeholder="Enter location" name="vc-user-location" required="">
            </div>
            <div class="form-group">
              <label for="vc-user-ask-question">Question <span style="color:red">*</span> </label>
              <textarea class="form-control" id="vc-user-ask-question" name="vc-user-ask-question" placeholder="Write something.." style="height:100px" required=""></textarea>
            </div>
            <input type="hidden" name="vc-pageurl" id="vc-pageurl" value="<?php echo $post_slug.'-'.$hall_slug.'-QnA';?>">
            <input type="hidden" name="vc-website" id="vc-website" value="https://www.cmeworld.org">

            <button type="submit" class="btn btn-primary">Submit</button>

            <span class="responce_msg"></span>
          </form>
        </div>

        

</body>
</html>
<?php session_write_close();?>