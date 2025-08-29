<?php
/** Template name:tp page
*/
get_header();


    $form_username      = urldecode ( get_query_var( 'form_username' ) );
    $form_user_role     = get_query_var( 'form_user_role' );

    // wordpress user
    // $current_user       = wp_get_current_user();
    // $loggedin_username  = $current_user->user_login;
    // $firstname          = $current_user->user_firstname;
    // $Lastname           = $current_user->user_lastname; 
    //$fullname           = $firstname . ' ' . $Lastname;

    $data = fetch_userdata( $form_username );
    // echo "<pre>"; print_r($data);echo "</pre>";

    $form_entry_url         =   esc_url( home_url() )  .'/get/'.$form_user_role.'/'.$form_username.'/form_entries/';

    $patient_id             =   get_patient_id( $data['username'] );
    $new_patient_id         =   $patient_id + 1; 
    $pt_displayname         =   "Patient ". $new_patient_id;

?>


<style>

    .survey_space {
        padding-bottom: 20px;
    }

    .survey_new {
        display: flex;
        flex-wrap: wrap;
    }

    .form-check.form-check-inline {
        display: flex;
        flex-direction: row;
        align-items: stretch;
    }

    .radio-icon {
        margin-right: 5px;
    }

    .label-icon {
        width: 100%;
    }

    /* On screens that are 700px or less, set the background color to blue */
    @media screen and (max-width: 700px) {
        .radio-icon {
            width: 9%;
        }
    }

    /* On screens that are 700px or less, set the background color to olive */
    @media screen and (max-width: 500px) {
        .radio-icon {
            width: 19%;
        }
    }

    .btn_submit {
        background: #76307D !important;
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

    label {
        display: block !important;
        text-align: left;
    }

    .horizontal-radio {
        display: inline-flex !important;
        padding: 7px 10px;
    }

    .label-icon label {
        font-size: 13px;
        color: gray;
    }
    input[type="text"] {
        padding: 5px 10px;
        border: 0;
        border-bottom: 1px solid #bdbdbd;
        width: 100%;
        font-size: 13px;

    }
    header {
         box-shadow: unset;
    }
    .pageTitle {
        width: 100%;
        display: inline-block;
        padding: 30px 0;
    }
    .form-wrap{
        display: block;
        width: 100%;
        padding: 20px 0;
    }
    a.class_62722 {
        display: inline-block;
        color: white;
        font-size: 13px;
        background-color: #95c12b;
        padding: 7px 30px;
        margin: 20px 0;
        border-radius: 5px;
        font-weight: normal;
    }
    .actionButtons{
        text-align: right;
    }
    .red {
    color: #ff5722;font-size: 13px;
    }
    label.defaultlabel {
        display: inline-block !important;
        text-align: left;
        padding: 8px 10px;
        background: #e8f4f5;
        border: 1px solid #90a4ae;
        font-size: small;
        color: #455a64;
    }
</style>

<div class="row" style="background-color: #e5e5e5;">
    <div class="container">
        <div class="pageTitle">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3>Patient Experience Form</h3>
            </div>
        </div>
        
    </div>
</div>

    <?php if(is_user_logged_in() ) { ?>
    
<div class="row">
    <div class="container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 actionButtons">
        <a href= '<?php echo home_url()."/get/$form_user_role/$form_username/form_entries";?>' class='class_62722'> View Patient Entries</a>
        <!-- <a href= '<?php echo home_url()."/account-details";?>' class='class_62722'> Submit Account Details</a> -->
    </div>
    </div>
</div>    

<div class="container">

  <?php $current_user   = wp_get_current_user(); ?>

    <!-- form -->
    <div class="form-wrap">        
        <form action="" method="get" id="frm-tp" name ="frm-tp">
            <div class="row">
                <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <label class="defaultlabel"  ><b>Name of Respondent : <?php echo $data['displayname'] ; ?></b>
                        <span id = "name_of_respondent" style="display:none;"><?php echo $data['username'] ; ?></span>
                    </label>
                    <label class="defaultlabel" ><b>Date :</b> <span name="response_date" id="pef_response_date"> </span></label>
                    <label class="defaultlabel"><b>Patient Name :</b> <?php echo $pt_displayname; ?></label>
                    <input type="hidden" id="pef_form_id" name= "pef_form_id"  value="<?php echo "1"; ?>">
                    <input type="hidden" id="pef_page_slug" name= "pef_page_slug" value="<?php echo $form_entry_url; ?>">
                </div>
            </div>
            <div class = "col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 10px;">
                <label><b>Hospital</b></label>
                <input type="text" name="hospital_name" id="pef_hospital_name" placeholder = "">
            </div>
            <!-- question 1 -->
            <ol style="display: inline-block;" >
                <li>
                    <div class="survey_space">
                        <!-- Question 1 -->
                        <label for=""><b>Age of the patient:</b></label>
                        <!-- Question 1 -->
                        <!-- Question 1 option 1 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Age_of_the_patient" id="Question_11"
                                    value="18-30yrs"
                                    data-question="Age of the patient:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_11">18-30yrs</label>
                            </div>
                        </div>
                        <!-- Question 1 option 2 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Age_of_the_patient" id="Question_12"
                                    value="30-45yrs"
                                    data-question="Age of the patient:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_12">30-45yrs</label>
                            </div>
                        </div>
                        <!-- Question 1 option 3 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Age_of_the_patient" id="Question_13"
                                    value="45-60yrs"
                                    data-question="Age of the patient:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_13">45-60yrs</label>
                            </div>
                        </div>
                        <!-- Question 1 option 4 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Age_of_the_patient" id="Question_14"
                                    value="60 years and above"
                                    data-question="Age of the patient:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_14" data-question="Age of the patient:">60 years and above</label>
                            </div>
                        </div>
                        <div class="err_Question_1"></div>
                    </div>
                </li>

                <li>
                    <!-- question 2 -->
                    <div class="survey_space">
                        <label for="">
                            <b>Sex of the patient:</b>
                        </label>
                        <!-- Question 2 option 1 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Sex_of_the_patient" id="Question_21"
                                    value="Male"
                                    data-question="Sex of the patient:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_21">Male</label>
                            </div>
                        </div>
                        <!-- Question 2 option 2 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Sex_of_the_patient" id="Question_22"
                                    value="Female"
                                    data-question="Sex of the patient:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_22"> Female</label>
                            </div>
                        </div>
                        <!-- Question 2 option 3 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Sex_of_the_patient" id="Question_23"
                                    value="Others"
                                    data-question="Sex of the patient:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_23"> Others</label>
                            </div>
                        </div>
                        <div class="err_Question_2"></div>
                    </div>
                </li>

                <li>
                    <!-- question 3 -->
                    <div class="survey_space">
                        <label for="">
                            <b>At the time of admission patient is hemodynamically:</b>
                        </label>
                        <!-- Question 3 option 1 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="At_the_time_of_admission_patient_is_hemodynamically" id="Question_31" value="Stable" 
                                    data-question="At the time of admission patient is hemodynamically:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_31">Stable</label>
                            </div>
                        </div>
                        <!-- Question 3 option 2 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="At_the_time_of_admission_patient_is_hemodynamically" id="Question_32" value="Unstable" data-question="At the time of admission patient is hemodynamically:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_32">Unstable</label>
                                <input type="text" name="Question_3_RLBRACKETS_Unstable_RRBRACKETS_" placeholder="What type here..." data-question="At the time of admission patient is hemodynamically:" disabled  style="margin-top: 10px;" >
                            </div>
                        </div>
                        <div class="err_Question_3"></div>
                    </div>
                </li>

                <li>
                    <!-- question 4 -->
                    <div class="survey_space">
                        <label for="">
                            <b>Patient has ......... Infection:</b>
                        </label>
                        <!-- Question 4 option 1 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Patient_has_BLANK_Infection" id="Question_41" value="Respiratory"
                                    data-question="Patient has ______ Infection:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_41"> Respiratory</label>
                            </div>
                        </div>
                        <!-- Question 4 option 2 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Patient_has_BLANK_Infection" id="Question_42" value="GI"
                                    data-question="Patient has ______ Infection:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_42"> GI</label>
                            </div>
                        </div>
                        <!-- Question 4 option 3 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Patient_has_BLANK_Infection" id="Question_43" value="UTI"
                                    data-question="Patient has ______ Infection:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_43"> UTI</label>
                            </div>
                        </div>
                        <!-- Question 4 option 4 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Patient_has_BLANK_Infection" id="Question_44" value="Any Other"
                                    data-question="Patient has ______ Infection:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_44"> Any Other</label>
                            </div>
                        </div>
                        <div class="err_Question_4"></div>
                    </div>
                </li>

                <li>
                    <!-- question 5 -->
                    <div class="survey_space">
                        <label for="">
                            <b>What sample sent for culture:</b>
                        </label>
                        <!-- Question 5 option 1 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input _multiselect_Q5" type="checkbox" name="What_sample_sent_for_culture[1]" id="Question_51" value="Sputum" data-question="What sample sent for culture:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_51"> Sputum</label>
                            </div>
                        </div>
                        <!-- Question 5 option 2 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input _multiselect_Q5" type="checkbox" name="What_sample_sent_for_culture[2]" id="Question_52" value="Blood" data-question="What sample sent for culture:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_52"> Blood</label>
                            </div>
                        </div>
                        <!-- Question 5 option 3 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input _multiselect_Q5" type="checkbox" name="What_sample_sent_for_culture[3]" id="Question_53" value="Urine" data-question="What sample sent for culture:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_53"> Urine</label>
                            </div>
                        </div>
                        <!-- Question 5 option 4 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input _multiselect_Q5" type="checkbox" name="What_sample_sent_for_culture[4]" id="Question_54" value="Pus" data-question="What sample sent for culture:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_54"> Pus</label>
                            </div>
                        </div>
                        <div class="err_Question_5"></div>
                    </div>
                </li>

                <li>
                    <!-- question 6 -->
                    <div class="survey_space">
                        <label for="">
                            <b>Culture grown in sample:</b>
                        </label>
                        <!-- Question 6 option 1 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Culture_grown_in_sample" id="Question_61" value="Yes" data-question="Culture grown in sample:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_61"> Yes </label>
                            </div>
                        </div>
                        <!-- Question 6 option 2 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Culture_grown_in_sample" id="Question_62" value="No" data-question="Culture grown in sample:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_62"> No </label>
                            </div>
                        </div>
                        <div class="err_Question_6"></div>
                    </div>
                </li>

                <div id="6_note"></div>
                <li>
                    <!-- question 7 -->
                    <div class="survey_space">
                        <label for=""><b>If Yes, What bacteria grown?</b></label>
                        <!-- Question 7 option 1 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="If_Yes_COMMA_What_bacteria_grown_questionmark_" id="Question_71" value="E Coli" data-question="If Yes, What bacteria grown?">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_71">E Coli</label>
                            </div>
                        </div>
                        <!-- Question 7 option 2 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="If_Yes_COMMA_What_bacteria_grown_questionmark_" id="Question_72" value="Klebsiella P" data-question="If Yes, What bacteria grown?">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_72"> Klebsiella P</label>
                            </div>
                        </div>
                        <!-- Question 7 option 3 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="If_Yes_COMMA_What_bacteria_grown_questionmark_" id="Question_73" value="Pseudomonas A" data-question="If Yes, What bacteria grown?">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_73">Pseudomonas A</label>
                            </div>
                        </div>
                        <!-- Question 7 option 4 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="If_Yes_COMMA_What_bacteria_grown_questionmark_" id="Question_74" value="Acinetobacter B" data-question="If Yes, What bacteria grown?">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_74"> Acinetobacter B </label>
                            </div>
                        </div>

                        <!-- Question 7 option 5 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="If_Yes_COMMA_What_bacteria_grown_questionmark_" id="Question_75" value="Any Other (please specify)" data-question="If Yes, What bacteria grown?">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_74"> Any Other (please specify) </label>
                                <input type="text" name="Question_7_RLBRACKETS_other_RRBRACKETS_" placeholder="Type here..." data-question="If Yes, What bacteria grown?"  style="margin-top: 10px;" >
                            </div>
                        </div>

                        <!-- Question 7 option 6 -->
                        <div class="form-check form-check-inline" style="display:none">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="If_Yes_COMMA_What_bacteria_grown_questionmark_" id="Question_76" value="Not Applicable" data-question="If Yes, What bacteria grown?">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_76" data-question ="What type of Carbapenamase it is:"> Not Applicable </label>
                            </div>
                        </div>

                        <div class="err_Question_7"></div>
                    </div>
                </li>

                <li>
                    <!-- question 8 -->
                    <div class="survey_space">
                        <label for="">
                            <b>Is it a CRE case?</b>
                        </label>
                        <!-- Question 8 option 1 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Is_it_a_CRE_case_questionmark_" id="Question_81" value="Yes" data-question="Is it a CRE case?">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_81">Yes</label>
                            </div>
                        </div>
                        <!-- Question 8 option 2 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Is_it_a_CRE_case_questionmark_" id="Question_82" value="No" data-question="Is it a CRE case?">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_82"> No</label>
                            </div>
                        </div>

                        <!-- Question 8 option 3 -->
                        <div class="form-check form-check-inline" style="display:none">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Is_it_a_CRE_case_questionmark_" id="Question_83" value="Not Applicable" data-question="Is it a CRE case?">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_83" data-question ="Is it a CRE case?"> Not Applicable </label>
                            </div>
                        </div>
                        
                        <div class="err_Question_8"></div>
                    </div>
                </li>

                <div id="9_note"></div>
                <li>
                    <!-- question 9 -->
                    <div class="survey_space">
                        <label for="">
                            <b>What type of Carbapenamase it is: </b>
                        </label>
                        <!-- Question 9 option 1 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="What_type_of_Carbapenamase_it_is" id="Question_91" value="NDM" data-question="What type of Carbapenamase it is:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_91"> NDM</label>
                            </div>
                        </div>
                        <!-- Question 9 option 2 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="What_type_of_Carbapenamase_it_is" id="Question_92" value="OXA" data-question="What type of Carbapenamase it is:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_92"> OXA </label>
                            </div>
                        </div>

                        <!-- Question 9 option 3 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="What_type_of_Carbapenamase_it_is" id="Question_93" value="KPC" data-question="What type of Carbapenamase it is:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_93"> KPC </label>
                            </div>
                        </div>

                        <!-- Question 9 option 4 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="What_type_of_Carbapenamase_it_is" id="Question_94" value="VIM" data-question="What type of Carbapenamase it is:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_94"> VIM </label>
                            </div>
                        </div>

                        <!-- Question 9 option 5 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="What_type_of_Carbapenamase_it_is" id="Question_95" value="IMP" data-question="What type of Carbapenamase it is:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_95"> IMP </label>
                            </div>
                        </div>
                        <!-- Question 9 option 6 -->
                        <div class="form-check form-check-inline" style="display:none">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="What_type_of_Carbapenamase_it_is" id="Question_96" value="Not Applicable" data-question="What type of Carbapenamase it is:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_96" data-question ="What type of Carbapenamase it is:"> Not Applicable </label>
                            </div>
                        </div>
                        <div class="err_Question_9"></div>
                    </div>
                </li>

                <li>
                    <!-- question 10 -->
                    <div class="survey_space">
                        <label for="">
                            <b>Antibiotics Used: (Multiple Choices) </b>
                        </label>
                        <!-- Question 10 option 1 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input _multiselect" type="checkbox" name="Antibiotics_Used[0] " id="Question_101" value="Colistin" data-question="Antibiotics Used:" >
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_101"> Colistin</label>
                            </div>
                        </div>
                        <!-- Question 10 option 2 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input _multiselect" type="checkbox" name="Antibiotics_Used[1] " id="Question_102" value="Polymyxin B" data-question="Antibiotics Used: ">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_102"> Polymyxin B </label>
                            </div>
                        </div>
                        <!-- Question 10 option 3 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input _multiselect" type="checkbox" name="Antibiotics_Used[2] " id="Question_103" value="Tigecycline" data-question="Antibiotics Used:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_103"> Tigecycline</label>
                            </div>
                        </div>
                        <!-- Question 10 option 4 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input _multiselect" type="checkbox" name="Antibiotics_Used[3] " id="Question_104" value="Ceftazidime Avibactam" data-question="Antibiotics Used: ">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_104">Ceftazidime Avibactam </label>
                            </div>
                        </div>
                        <!-- Question 10 option 5 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input _multiselect" type="checkbox" name="Antibiotics_Used[4] " id="Question_105" value="Meropenem Sulbactam EDTA" data-question="Antibiotics Used: ">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_105">Meropenem Sulbactam EDTA</label>
                            </div>
                        </div>

                        <!-- Question 10 option 6 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input _multiselect" type="checkbox" name="Antibiotics_Used[5] " id="Question_106" value="any Other (please mention)" data-question="Antibiotics Used: ">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_106">Any Other (please mention)</label>
                                <input type="text" name="Antibiotics_Used_RLBRACKETS_other_RRBRACKETS_" placeholder="Type here..." data-question="Antibiotics Used: "  style="margin-top: 10px;" >

                            </div>
                        </div>
                        <div class="err_Question_10"></div>
                    </div>
                </li>

                <li>
                    <!-- question 11 -->
                    <div class="survey_space">
                        <label for="">
                            <b>Patient intitated on Meropenam Sulbactum EDTA (MSE) on day .........  from admission</b>
                        </label>
                        <!-- Question 11 option 1 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Patient_intitated_on_Meropenam_Sulbactum_EDTA_RLBRACKETS_MSE_RRBRACKETS_on_day_BLANK_from_admission" id="Question_111" value="day 1" data-question="Patient intitated on Meropenam Sulbactum EDTA (MSE) on day _______  from admission">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_111">day 1</label>
                            </div>
                        </div>
                        <!-- Question 11 option 2 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Patient_intitated_on_Meropenam_Sulbactum_EDTA_RLBRACKETS_MSE_RRBRACKETS_on_day_BLANK_from_admission" id="Question_112" value="day 3" data-question="Patient intitated on Meropenam Sulbactum EDTA (MSE) on day _______  from admission">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_112"> day 3</label>
                            </div>
                        </div>

                        <!-- Question 11 option 3 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Patient_intitated_on_Meropenam_Sulbactum_EDTA_RLBRACKETS_MSE_RRBRACKETS_on_day_BLANK_from_admission" id="Question_113" value="day 5" data-question="Patient intitated on Meropenam Sulbactum EDTA (MSE) on day _______  from admission">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_113"> day 5</label>
                            </div>
                        </div>

                        
                        
                        <div class="err_Question_11"></div>
                    </div>
                </li>

                <li>
                    <!-- question 12 -->
                    <div class="survey_space">
                        <label for="">
                            <b>Patient discontinued after ......... days of MSE</b>
                        </label>
                        <!-- Question 12 option 1 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Patient_discontinued_after_BLANK_days_of_MSE" id="Question_121" value="4 days" data-question="Patient discontinued after __________days of MSE">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_121">4 days</label>
                            </div>
                        </div>
                        <!-- Question 12 option 2 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Patient_discontinued_after_BLANK_days_of_MSE" id="Question_122" value="5 days" data-question="Patient discontinued after __________days of MSE">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_122"> 5 days</label>
                            </div>
                        </div>

                        <!-- Question 12 option 3 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Patient_discontinued_after_BLANK_days_of_MSE" id="Question_123" value="6 days" data-question="Patient discontinued after __________days of MSE">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_123"> 6 days</label>
                            </div>
                        </div>

                        <!-- Question 12 option 4 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Patient_discontinued_after_BLANK_days_of_MSE" id="Question_124" value="more than 7 days" data-question="Patient discontinued after __________days of MSE">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_124"> more than 7 days</label>
                            </div>
                        </div>
                        <div class="err_Question_12"></div>
                    </div>
                    <ol >
                        <li value="1">
                           


                            <!-- question 12.1 -->
                            <div class="survey_space">
                                <label for="">
                                    <b>MSE treatment incomplete due to :-</b>
                                </label>
                                <!-- Question 12.1 option 1 -->
                                <div class="form-check form-check-inline">
                                    <div class="radio-icon">
                                        <input class="form-check-input" type="radio" name="MSE_treatment_incomplete_due_to" id="Question_12_11" value="DAMA" data-question="MSE treatment incomplete due to">
                                    </div>
                                    <div class="label-icon">
                                        <label class="form-check-label" for="Question_12_11">DAMA</label>
                                    </div>
                                </div>
                                <!-- Question 12.1 option 2 -->
                                <div class="form-check form-check-inline">
                                    <div class="radio-icon">
                                        <input class="form-check-input" type="radio" name="MSE_treatment_incomplete_due_to" id="Question_12_12" value="Death" data-question="MSE treatment incomplete due to">
                                    </div>
                                    <div class="label-icon">
                                        <label class="form-check-label" for="Question_12_12">Death</label>
                                    </div>
                                </div>

                                <div class="err_Question_12_1"></div>
                            </div>




                        </li>
                    </ol>
                </li>
                
                <li>
                    <!-- question 13 -->
                    <div class="survey_space">
                        <label for="">
                            <b>MSE treatment discontinued, as the patient .........</b>
                        </label>
                        <!-- Question 13 option 1 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="MSE_treatment_discontinued_COMMA_as_the_patient_BLANK_" id="Question_131" value="afebrile" data-question="MSE treatment discontinued, as the patient _________">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_131">Afebrile</label>
                            </div>
                        </div>
                        <!-- Question 13 option 2 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="MSE_treatment_discontinued_COMMA_as_the_patient_BLANK_" id="Question_132" value="culture negative" data-question="MSE treatment discontinued, as the patient _________">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_132"> Culture negative</label>
                            </div>
                        </div>

                        <!-- Question 13 option 3 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="MSE_treatment_discontinued_COMMA_as_the_patient_BLANK_" id="Question_133" value="poor response" data-question="MSE treatment discontinued, as the patient _________">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_133">Poor response</label>
                            </div>
                        </div>
                        
                        <div class="err_Question_13"></div>
                    </div>
                </li>

                <li>
                    <!-- question 14 -->
                    <div class="survey_space">
                        <label for="">
                            <b>Adverse event seen:</b>
                        </label>
                        <!-- Question 14 option 1 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Adverse_event_seen" id="Question_141" value="Yes" data-question="Adverse event seen:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_141">Yes</label>
                                <input type="text" name="Question_14_RLBRACKETS_other_RRBRACKETS_" placeholder="What type here..." data-question="Adverse event seen:" disabled  style="margin-top: 10px;" >
                            </div>
                        </div>
                        <!-- Question 14 option 2 -->
                        <div class="form-check form-check-inline">
                            <div class="radio-icon">
                                <input class="form-check-input" type="radio" name="Adverse_event_seen" id="Question_142" value="No" data-question="Adverse event seen:">
                            </div>
                            <div class="label-icon">
                                <label class="form-check-label" for="Question_142"> No</label>
                            </div>
                        </div>

                        
                        
                        <div class="err_Question_14"></div>
                    </div>
                </li>


            </ol>
            <div class="">
                <input type="submit" value="Submit" id="btn-submit-survey"
                    class="wpcf7-form-control has-spinner wpcf7-submit btn_submit">
            </div>
            <div class="response"></div>
        </form>
    </div>
    <!-- form -->
</div>
<?php } else { ?>
        <div class="container">
            <div class="row"> 
                <div  class="form-wrap"> Please logged in to proceed.</div>
            </div>
        </div>
<?php }
get_footer();
?>