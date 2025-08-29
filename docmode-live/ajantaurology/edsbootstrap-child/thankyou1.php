<?php
/*
*Template name:Thankyou end
*/
get_header(); ?>
<style>
  #thankyou h1{
    text-align:center;
    padding: 50px 0px 0px 0px;
    font-size:45px;
    font-weight:900;

  }

 #thankyou #checkmark{
    font-size: 7rem;
    padding: 20px;
 	 line-height: 1;
	 color: #00AFF0;
   float: center;
  }

 #thankyou #main-content-body{
     font-size:18px; 
    text-align:center; 
    font-weight:400;                   
    line-height: 1.2;
    letter-spacing: 0.5px;
    margin-bottom: 100px;
  }
  

  /* On screens that are 600px or less, set the background color to olive */
@media screen and (max-width: 600px) {
 #thankyou #main-content-body {
    padding: 0px 20px;
  }

  #thankyou h1{
    font-size: 4rem;}

  #thankyou   #checkmark{
    font-size:  6rem; }

   #thankyou_form{
   padding: 10px;
}

#thankyou_form h2{ 
   font-size: 1.5rem;
}
}

#thankyou_form{
   box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
   padding: 50px;
   border-radius:10px;
}

#thankyou_form h2{ 
   font-size: 2.5rem;
   font-weight: 500;
}

.wpcf7 form.sent .wpcf7-response-output {
    margin-top: 20px;
    border-color: #36883d;
    color: #36883d;
    font-size: 1.2em !important;
    font-family: "Calibri";
    padding-top: 14px;
}

.affix-top img.custom-logo {
    max-height: 60px;
    width: auto;
    margin-top: 3px;
    display: none;
}

.affix img.custom-logo {
    max-height: 60px;
    /* width: 170px; */
    margin-top: 5px;
    display: none;
}
</style>
<?php                
//$b = srb_get_LMS_cookie_data('edxloggedin');
?>
<?php// if ( $b == 1 ){ ?>
<div id="thankyou">
<div class="container">
  <div class="row">
    <div class="col-12">
      <h1>THANK YOU!</h1>
      <center>   <i class="fa fa-check" id="checkmark"></i></center>
      <p id="main-content-body">Your response has been successfully captured
      <!--  Thank you for sharing your information. 
         <br> You will receive a call from one of our representatives <br>as part of our verification within 2-3 working days. -->

</p>  
    </div>
  </div>
</div>
</div>

</div>

   <?php //} else { ?>
                     <!-- <a href="https://switch-to-basalog.docmode.org/">Please Login to access</a> -->
                    <?php // echo "<script>location.href='https://switch-to-basalog.docmode.org/';</script>";
                   //die(); 
                   // } ?>

<?php get_footer();?>