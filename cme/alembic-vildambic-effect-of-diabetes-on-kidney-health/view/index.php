<?php 
    session_start();
    include('../inc/db-config.php');
    include('../inc/srb-function.php');
    //print_r($_SESSION);
    if(isset($_GET['page'])):
        
        date_default_timezone_set("Asia/Kolkata");
        // $_SESSION["name"]   = $data['name'];
        // $_SESSION["email"]  = $data['email'];
        // $_SESSION["city"]   = $data['city'];
        $data['email'] = $_SESSION["email"];
        $data['activity'] = $_GET['page'];
        $data['record_time'] = date("d-m-Y H:i");
        
        $id = srb_view_record($data, $analytics_connection);
    endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webinar | Alembic - The Effect of Diabetes on Kidney Health</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/x-icon" href="../img/indoco-fav1.png">
    <!-- Google tag (gtag.js) --> 
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0ENXS6GH2J"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-0ENXS6GH2J'); 
    </script>
</head>
<body>
<?php if( isset($_SESSION['name'] )  && isset( $_SESSION['email']) ) { ?>
    <section class="event-section container-fluid">
        <div class="sponser-section ">
            <div class="row" style="margin:20px 0 0 0">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-4" >
                    <div class="column" style="width: 100%;display: inline-block;">
                        <!-- <img src="../img/DRL-Logo.png"/> -->
                    </div>
                </div>  
                <!-- <div class="col-xs-12 col-sm-12 col-md-3 col-lg-8" >
                    <div class="row">
                        <div class="col-12 text-center">
                            A scientific initiative from
                        </div>
                    
                        <div class="column" style="width: 50%;display: inline-block;    margin-top: -20px;">
                            <img style="margin-top: 10px;" src="../img/olmesar.png"/>
                        </div>
                        <div class="column" style="width: 50%;display: inline-block;    margin-top: -20px;">
                            <img style="margin-top: 10px;" src="../img/triolmesar.png"/>
                        </div>
                    </div>
                </div> -->
            </div> 
        </div>
        <div class="event-section-div container">
            <div class="event-left">
                <div class="">
                    <div class="background-overlay ">
                        <!-- <video width="100%" height="100%" controls>
  <source src="../video/promo.mp4" type="video/mp4">
  <source src="../video/promo.ogg" type="video/ogg">
  Your browser does not support the video tag.
</video> -->

                        <div class="event-container">
                            <!--iframe class="responsive-iframe"  src="https://www.youtube.com/embed/Mja6mw7a3rY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe-->
                            <iframe class="responsive-iframe"  src="https://d3030h7whein66.cloudfront.net/Alembic/ALB008/Dr_Sanjay_Kalra.mp4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>

                    </div>
                </div>
            </div>
            <div class="event-right">
                    <div class='logout_container text-right'>
                        <button id='cust_lecture_logout'>Logout </button>
                    </div>
                    <?php echo "Hello " . $_SESSION["name"] . ",";?>
                    <div class="login_email" style="display: inline;color:gray;">
                        <?php  echo "<br>(". $_SESSION["email"] .")"; ?>
                    </div>
                    
                    <div class='form_container'>
                        <form id="form2" action="">      
                            <!--<h4><span id="user_name"></span></h4>-->
                            <input type="hidden" id="useremail" value="<?php echo $_SESSION['email'];?>">
                            <input type="hidden" id="username" value="<?php echo $_SESSION['name'];?>">
                            <input type="hidden" id="usercity" value="<?php echo $_SESSION['city'];?>">
                            <p class="form2_ask_question">Do you have any questions? </p>
                                <textarea id="form2_ask_question" class= "form-control " name="form2_ask_question" placeholder="Write something.." style="height:100px" required=""></textarea>
                            <div class="form_submit">
                                <input id="form2_submit" type="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                    <div class="responce_msg"></div>

                    <!-- <div class="row" style="margin:0;">
                        <div class="w-50 mx-auto" style=" margin: 0; padding: 0;">
                            <img class="banner_image" src="../img/1-03.png">
                        </div>
                    </div> -->
            </div>
        </div>
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