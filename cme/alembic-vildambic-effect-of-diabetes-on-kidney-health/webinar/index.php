<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webinar | Dr Reddy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/x-icon" href="../img/DRL-Logo.png">
    <!-- Google tag (gtag.js) --> 
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0ENXS6GH2J"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-0ENXS6GH2J'); 
    </script>
</head>
<body>
<?php 
//print_r($_SESSION);
if( isset($_SESSION['name'] )  && isset( $_SESSION['email']) ) { ?>
<?php //'https://www.cmeworld.org/Vololution-UnveilingthefutureofAcidSuppression/view?page=dr-reddy-webinar-1'; 
//$webinar_url = "https://".$_SERVER['HTTP_HOST']."/Vololution-UnveilingthefutureofAcidSuppression".$part[1]."/view?page=dr-reddy-webinar-1";
$part_url = explode('/',$_SERVER['REQUEST_URI']);
$webinar_url1 = "https://".$_SERVER['HTTP_HOST']."/".$part_url[1]."/view?page=dr-reddy-webinar-1";
$webinar_url2 = "https://".$_SERVER['HTTP_HOST']."/".$part_url[1]."/view2?page=dr-reddy-webinar-2";
$webinar_url3 = "https://".$_SERVER['HTTP_HOST']."/".$part_url[1]."/view3?page=dr-reddy-webinar-3";
?>
    <section class="event-section container-fluid">
        <div class="sponser-section ">
            <div class="row" style="margin:20px 0 0 0">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-4" >
                    <div class="column" style="width: 100%;display: inline-block;">
                        <!-- <img src="https://cmeworld-wp-uploads.s3.ap-south-1.amazonaws.com/wp-content/uploads/2023/05/05214453/MACLEODS-1536x436.png"/> -->
                    </div>
                </div>  
                
            </div> 
        </div>

        <div style="display: block;" class="event-section-div11 container">
            <button style="float: right;" id='cust_lecture_logout'>Logout </button><br><br>
            <h3>Upcoming Webinar</h3><br>
            <!-- <div class="row">
                
                <a href="<?php //echo $webinar_url3; ?>">
                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="card" style="width: 22rem;">
                      <img height="300px" class="card-img-top" src="../img/Webinar_3_Course_Card.png" alt="Card image cap">
                      <div class="card-body">
                        <button class="btn btn-info">Webinar</button>
                      </div>
                    </div>
                </div>
                </a>
            </div> -->
            <br>
            <h3>Previous Webinar</h3><br>
            <div class="row">
                <a href="<?php echo $webinar_url3; ?>">
                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="card" style="width: 22rem;">
                      <img height="300px" class="card-img-top" src="../img/Webinar_3_Course_Card.png" alt="Card image cap">
                      <div class="card-body">
                        <button class="btn btn-info">Webinar</button>
                      </div>
                    </div>
                </div>
                </a>
                <a href="<?php echo $webinar_url2; ?>">
                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="card" style="width: 22rem;">
                      <img height="300px" class="card-img-top" src="../img/LC-drl2.jpg" alt="Card image cap">
                      <div class="card-body">
                        <button class="btn btn-info">Webinar</button>
                      </div>
                    </div>
                </div>
                </a>
                <a href="<?php echo $webinar_url1; ?>">
                <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                    <div class="card" style="width: 22rem;">
                      <img height="300px" class="card-img-top" src="../img/WEB-01.png" alt="Card image cap">
                      <div class="card-body">
                        <button class="btn btn-info">Webinar</button>
                      </div>
                    </div>
                </div>
                </a>

            </div>
            
        </div>
        <!-- <div class="event-right">
            <div class='logout_container text-right'>
                <button id='cust_lecture_logout'>Logout </button>
            </div>
        </div> -->
    </section>
    
<?php }else{ ?>
    <div class="row" style="margin:0;">
        <?php 
            $part = explode('/',$_SERVER['REQUEST_URI']);
            $url = "https://".$_SERVER['HTTP_HOST']."/".$part[1];
        ?>
        <div class="w-50 mx-auto text-center py-5" style=" margin: 0; padding: 0;">         
            <?php echo "You are not authorized to view this page. Please <a id='lecture_login_link' href='".$url."' target='_self'> click here to login.</a>"; ?>
        </div>
    </div>
<?php } ?>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>