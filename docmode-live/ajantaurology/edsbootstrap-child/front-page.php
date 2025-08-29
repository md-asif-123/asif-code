<?php
/*
*Template name:front page
*/
get_header(); ?>


<style type="text/css">
    html {
        scroll-behavior: smooth;
        overflow-x: hidden;
    }

    .baslog_image {
        box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
        transform: translateY(-2px);
    }

    .btn_action,
    .btn_signin {
        background: #00AFF0 !important;
        color: #fff;
        padding: 8px 45px;
        border: 1px double #00AFF0;
        border-radius: 5px;
        transition: all 300ms cubic-bezier(.23, 1, 0.32, 1);
        line-height: 1.2;
        letter-spacing: 0.5px;
    }


    .btn_action:disabled,
    .btn_signin:disabled {
        pointer-events: none;
    }

    .btn_action:hover,
    .btn_signin:hover {
        box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
        transform: translateY(-2px);
        color: #ffffff;
    }

    .btn_action:active,
    .btn_signin:active {
        box-shadow: none;
        transform: translateY(0);
    }



    #promo_video {
        background: rgba(0, 0, 0, .9);
        cursor: pointer;
        display: none;
        height: 100%;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 10000;
    }

    .text_white {
        font-weight: normal !important;
        line-height: 1.2;
        letter-spacing: 0.5px;
        font-size: 16px;
        text-align: left;
    }

    .text-center h1 {
        line-height: 1.2;
        letter-spacing: 0.5px;
        font-size: 25px;
        text-align: left;
        font-weight: 600;
        padding: 20px 0px;
    }

    .text-center p {
        font-weight: normal !important;
        line-height: 1.2;
        letter-spacing: 0.5px;
        font-size: 16px;
        text-align: left;
    }

    #promo_video video {
        transform: translate(-50%, -50%);
        position: absolute;
        top: 50%;
        left: 50%;
    }

    video::-webkit-media-controls-timeline {
        display: none;
    }

    /* On screens that are 600px or less, set the background color to olive */
    @media screen and (max-width: 600px) {
        #promo_video video {
            width: 300px;
            height: 172px;
        }
    }

    .chnages_para {
        margin-top: -20px !important;
    }

    .banner_bg {
        background: #f3f3f3;
        padding: 50px 0 10px 0;
    }
</style>
<main class="main-container banner_bg">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-4 col-sm-12 col-xs-12">

                <img class="img-fluig baslog_image"
                    src="https://ajantaurology.docmode.org/wp-content/uploads/2023/05/Survey_Card_Mexlon.png" alt=""
                    width="100%">

            </div>

            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <h3 class="banner-title"> Marketing Research survey
                </h3>
                <div class="course-description">
                    <p class="text_white">
                        <!-- The scientific survey conducted is to evaluate the perspective and evolving recommendations related to insulin therapy in the treatment of Diabetes Mellitus -->
                        <?php //echo $data->short_description;?>
                    </p>
                </div>
                <div class="course-button" style="padding-bottom:20px;">


                    <?php 
                        $url;
                        $btn_label ;
                        if ( is_user_logged_in () ){
                            $userrole;
                            $current_user = wp_get_current_user();
                            $username = $current_user->user_login;
                            $roles = ( array ) $current_user->roles;

                            foreach ($roles as $role) {
                                $userrole = $role;
                            }

                            
                            $url = home_url() . '/get/' . $userrole . '/' . $username . '/form';
                            $btn_label = "Participate";
                        }else{
                            $url = home_url() . '/login/';
                            $btn_label = "Sign in";
                        }
                    ?>
                    <a id="btn_participate" class="btn_action" href="<?php echo $url;?>"> <?php echo $btn_label;?></a>
                </div>

                <p style="font-size:18px;"> <b>About the survey:</b>
                <p>


                <p class="chnages_para">

                    1. Click on <b> Sign In</b> button and login/register from your account.<br>
                    2. Click on <b>Participate</b> button, and you will be directed to the survey page.<br>
                    3. Fill in the survey and submit.



                </p>

            </div><!-- col-md-8 -->
        </div><!-- row -->
    </div><!-- Container -->

    <!-- <div id="promo_video">
        <div class="video_player">
            <video id="video_redirect" width="520" height="340" controls controlslist="nodownload" autoplay >
                <source
                    src="https://d3030h7whein66.cloudfront.net/Biocon/Biocon+Video.mp4"
                    type="video/mp4">
                <source
                    src="https://d3030h7whein66.cloudfront.net/Biocon/Biocon+Video.mp4"
                    type="video/ogg">
                Your browser does not support the video tag.
            </video>
        </div>
    </div> -->

</main>

<div class="row">
    <div class="container">
        <div class="col-12 pt-5" style="padding-top:20px;">
            <div class="text-center">
                <!-- <div><b>Unrestricted Educational Grant by Lifecare Biosciences Pvt Ltd</b></div> -->
                <div class="course_info">

                    <h1>About the Survey</h1>

                        <p style="padding-bottom:20px;">Kidney stones are a common condition, and the prevalence has been steadily increasing worldwide, affecting approximately 10% of the population. 
                        <br><br>
                        The management of kidney stones often involves a combination of medical interventions and lifestyle modifications. While treatment options such as extracorporeal shockwave lithotripsy (ESWL) and ureteroscopy with laser lithotripsy are commonly employed, the role of adjunctive therapies has gained attention.
                        <br><br>
                        Terpene combination therapy has emerged as a potential adjunct treatment for kidney stones. Terpenes are natural compounds found in many plants and possess anti-inflammatory and analgesic properties. The combination of terpenes with other medications has shown promise in facilitating stone passage, reducing pain, and preventing stone recurrence.
                        <br><br>
                        Nephrologists are exploring the potential benefits and considering factors such as stone size, patient history, and preferences when deciding on treatment approaches. 
                        <br><br>
                        As an adjunct therapy, terpene combination therapy may provide added benefits in terms of symptom relief and prevention of stone recurrence. 
                        <br><br>
                        This survey aims to gather insights from nephrologists regarding their practices and experiences in managing kidney stones and the utilization of terpene combination therapy. By collecting this information, a better understanding of current clinical practices and placement of terpene combinations can be gauged and utilized in the best interest of the patients.  

                        </p>


                        <h1>Objective of the Survey                          
                        </h1>

                            <p style="padding-bottom:20px;">1. Evaluate the preferred management approach for uncomplicated kidney stones less than 10mm in size.
                            <br><br>
                            2. Determine the factors that make a patient a suitable candidate for terpene combination therapy.
                            <br><br>
                            3. Assess the effectiveness and advantages of terpene combination therapy in managing kidney stones.
                            <br><br>
                            4. Explore cases where terpene combination therapy was ineffective and adjustments made to the treatment plan.


                            </p>

                        <h1>Target Audience</h1>

                            <p style="padding-bottom:20px;">•	Urologist, Nephrologist</p>
                </div>

            </div>


        </div>

    </div>


</div>




<!-- <script>
    const video = document.getElementById("promo_video");
    const video_redirect = document.getElementById("video_redirect");
    function myFunction() {
        video.style.display = "block";
        video_redirect.play();
        video_redirect.onended = function () {
        window.location.href  = 'https://switch-to-basalog.docmode.org/survey';
    };
    }    
</script> -->


<?php get_footer();?>