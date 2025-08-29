<?php
/*
*Template name: Account Detail Page
*/
get_header(); ?>
<style>
    #thankyou h1 {
        text-align: center;
        padding: 50px 0px 0px 0px;
        font-size: 45px;
        font-weight: 900;

    }

    #thankyou #checkmark {
        font-size: 7rem;
        padding: 20px;
        line-height: 1;
        color: #76307D;
        float: center;
    }

    #thankyou #main-content-body {
        font-size: 18px;
        text-align: center;
        font-weight: 400;
        line-height: 1.2;
        letter-spacing: 0.5px;
        padding: 20px 20px;
    }


    /* On screens that are 600px or less, set the background color to olive */
    @media screen and (max-width: 600px) {
        #thankyou #main-content-body {
            padding: 20px 20px;
        }

        #thankyou h1 {
            font-size: 4rem;
        }

        #thankyou #checkmark {
            font-size: 6rem;
        }

        #thankyou_form {
            padding: 10px;
        }

        #thankyou_form h2 {
            font-size: 1.5rem;
        }
    }

    #thankyou_form {
        box-shadow: rgba(0, 0, 0, 0.25) 0 8px 15px;
        padding: 50px;
        border-radius: 10px;
    }

    #thankyou_form h2 {
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

    .heading{
        padding-bottom: 10px;
    }


    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }

/*    input[type="text"], input[type="email"], input[type="password"], input[type="tel"] {
        font-family: 'Muli', sans-serif !important;
        border-radius: 10px;
        font-weight: 900px;
    }*/

    .btn_submit {
        background: #76307D!important;
        color: #fff;
        padding: 8px 45px;
        border: 1px double #76307D;
        border-radius: 5px;
        transition: all 300ms cubic-bezier(.23, 1, 0.32, 1);
        line-height: 1.2;
        letter-spacing: 0.5px;
        width: 25%;
    }

    /* On screens that are 775 or less, set the background color to olive */
    @media screen and (max-width: 775px) {
          .btn_submit {
        width: 30%;
      }
    }


    /* On screens that are 600px or less, set the background color to olive */
    @media screen and (max-width: 600px) {
          .btn_submit {
        width: 100%;
      }
    }

 .form-check.form-check-inline {
    display: flex;
    flex-direction: row;
    align-items: stretch;
    }

    .radio-icon{
        width: 5%;
    }
    .label-icon{
          width: 100%;
    }

    /* On screens that are 700px or less, set the background color to blue */
    @media screen and (max-width: 700px) {
        .radio-icon{
            width: 9%;
        }
    }

    /* On screens that are 700px or less, set the background color to olive */
    @media screen and (max-width: 500px) {
        .radio-icon{
            width: 19%;
        }
    }
    input#opt_for_wallet , input#direct_payment , input#account_disclaimer_agree{
        width: 13px;
        display: inline-block;
    }
    label{display: unset;}
    input[type="text"], input[type="email"], input[type="password"], input[type="tel"] { padding: 9px 22px !important;}
    label {
            display: inline !important;
            text-align: left !important;
        }
</style>


<div id="thankyou">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p id="main-content-body">We really appreciate you giving us a moment of your time today. <br>
                    Kindly fill your account information in the below fields displayed.</p>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div id="thankyou_form">
            <div class="col-12">
                <?php if(is_user_logged_in() ) { ?>
                    <?php $data = check_useremail_in_acount(); 
                    //print_r($data);?>
                    <?php if ( true)  { 
 //
                        ?>
                        <h2 class="heading">Your Bank Account Information</h2>

                        <form id="frm_acc" method = "POST" enctype = "multipart/form-data">
                            <?php wp_nonce_field('acc_nonce'); ?>
                            <input type="hidden" id="sid" name="sid" value="<?php echo $_GET['sid'];?>">
                            <input type="hidden" id="sr" name="sr" value="<?php echo $_GET['sr'];?>">
                            <input type="hidden" id="ctime" name="ctime" value="">
                            <div class="form-group">
                                <input type="text" class="form-control" id="frm_acc_holder_name" name="account_holder_name" placeholder="Account Holder Name" value ="" >
                                <div class="err_ac_name"></div>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" id="frm_acc_number" name="account_number" placeholder="Account Number" value ="" >
                                <div class="err_ac_number"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="frm_acc_ifsc_code" name="account_ifsc_code" placeholder="IFSC Code" value ="" >
                                <div class="err_ac_ifsc"></div>
                            </div>
                            <div class="custom-file">
                                <label class="custom-file-label" for="frm_acc_cancelled_cheque"><b> Upload cancelled cheque:</b></label>
                                <input type="file" class="custom-file-input" id="account_cancelled_cheque" name="account_cancelled_cheque" required style="width: auto">
                                <div class="err_ac_canecel_cheque"></div>
                            </div> <br>
                            <!-- <a id="cheque_upload"> Upload </a> -->
                            <div class="form-group">
                                <input type="radio" id="account_disclaimer_agree" name="I_agree"  >
                                <label for="account_disclaimer_agree">I agree to receiving Honorarium for the scientific-medical activity which is strictly meant for research and education purposes only conducted by DocMode Health Technologies.</label>
                                <div class="err_I_agree"></div>
                            </div>


                            <!-- <div class="form-group">
                                Would you like to opt for Wallet payment / Direct payment?</br>
                                <input type="radio" id="opt_for_wallet" name="payment_choice" value="Wallet payment">
                                <label for="opt_for_wallet">Wallet payment</label><br>
                                <input type="radio" id="direct_payment" name="payment_choice" value="Direct payment">
                                <label for="direct_payment">Direct payment</label><br>
                                <div class="err_payment_choice"></div>
                            </div> -->


                            <div class="form-check form-check-inline"></div><br>

                            <input type="submit" value="Submit" name="submit" id = "frm_acc_submit" class="wpcf7-form-control has-spinner wpcf7-submit btn_submit">

                        </form>
                        <div class="response"></div>

<?php 

if(isset($_POST['submit'])) {
    if(!wp_verify_nonce($_REQUEST['_wpnonce'], 'acc_nonce')){
        echo "Operation terminated due to Security checks";
    } else {
        //echo "verified";
    
        //print_r($_FILES['account_cancelled_cheque']);
        //echo "<br>";
        //print_r($_POST);
        $current_user   = wp_get_current_user();

        $user_ID            = ( isset( $current_user->ID ) )  ? $current_user->ID : 0;
        $user_login         = ( isset( $current_user->user_login ) )  ? $current_user->user_login : NULL;
        $nm = $user_login . "+" . $user_ID . "+". time();

        $data = upload_image($_FILES['account_cancelled_cheque'], '/uploads/',$nm);
        //print_r($data);

        if($data['status']==1){
            //print_r($data);
            $acc_data = save_account_details($_POST, $data );
            //print_r($acc_data);
            if($acc_data > 0){
                echo "<div class='green'>Entry submitted successfully.</div>";
                echo "
                    <script type='text/javascript'>jQuery(document).ready(function(){
                        jQuery('#frm_acc').hide();
                    });</script>
                    ";
            }
        }else{
            //print_r($data);
        } 
    }      
}

      
?>

                    <?php }else{ ?>
                        <div class="already_participate"> You have already submitted the account details</div>
                    <?php } ?>
                
            <?php } else { ?>
                <div class="login_message"> 
                    You must logged in to submit your account details. To sign in please <a href ="<?php echo home_url('/login/');?>" > Click heare </a> 
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
</div>


<?php get_footer();?>