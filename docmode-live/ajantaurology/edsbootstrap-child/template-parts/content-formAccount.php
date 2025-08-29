<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package edsBootstrap
 */

    $dbcolum_name_by_username;
    $form_username = get_query_var( 'form_username' );
    $url_user_role = get_query_var( 'form_user_role' );

    // wordpress user
    $user = wp_get_current_user();
    $loggedin_username = $user->user_login;
    $result = get_entries_by_user( $loggedin_username, $url_user_role );
    $data = array();
    //echo "<pre>"; print_r( $result );echo "</pre>";
?>

<style>
    .class_29062022{display: block;}
    table{font-size: 13px;}
    .pageTitle{
        width: 100%;
        display: inline-block;
        padding: 20px;
    }
    .table-wrap{
        display: block;
        width: 100%;
        padding: 20px 0;
    }
    a.class_62722 {
        display: inline-block;
        color: white;
        font-size: 13px;
        background-color: #29b6f6;
        padding: 7px 10px;
        margin: 3px;
    }
    .actionButtons{
        text-align: right;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

<div class="row" style="background-color: #e5e5e5;">
    <div class="container">
        <div class="pageTitle">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <h3>Patient Experience Entries</h3>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 actionButtons">
        <a href= '<?php echo home_url()."/get/$url_user_role/$form_username/form";?>' class='class_62722'> Submit New Patient Form</a>
        <a href= '<?php echo home_url()."/account-details";?>' class='class_62722'> Submit Account Details</a>
    </div>
    </div>
</div>




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

