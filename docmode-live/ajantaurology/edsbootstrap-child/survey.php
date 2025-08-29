<?php
/*
*Template name:Survey page
*/
get_header(); ?>

<style>
    body {
        overflow-x: hidden;
    }

    .contact_form .para {
        color: #003e76 !important;
    }

    .survey {
        display: flex;
        flex-wrap: wrap;
    }

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
        margin: 2px 0 5px !important;
    }

    .horizontal-radio .label-icon label {
        margin-top: 2px;
    }

    .sub-questions {
        display: block;
        margin-left: 20px;
    }

    input[type="text"] {
        border: 0;
        border-bottom: 1px solid #757575;
        padding: 10px;
        margin: 10px;
        width: 100%;

        /* padding: 10px; */
    }
    .form-check-input {
        width: auto !important;
    }
    .survey_space label b {
        font-weight: 500 !important;
        font-size: 16px !important;
    }
    .topics{
        display: table; /* keep the background color wrapped tight */
        margin: 0px auto 0px auto; /* keep the table centered */
        padding: 2px;
        font-size: 16px;
        background-color: #01CED3;
        color: black;
        font-weight: bold;
    }

</style>
<div class="container">
    <!-- form -->
    <?php //if ( $b == 1 ){ 
    if ( is_user_logged_in() ){
    ?>
    <?php $data = check_useremail_in_survey();
    // print_r($data);
    ?>

        <?php 
            if ( empty ($data) )  { 
              //if (1){
            ?> 
        <form action="" method="get" id="frm-survey">
        <input type="hidden" id="survey_id" value="<?php echo "1"; ?>">
        <input type="hidden" id="page_slug" value="<?php echo get_permalink($postid); ?>">
        <!-- question 1 -->
        <ol style="margin-top: 20px;">
        <p><span class="topics">Evaluation/Screening  </span></p>
                                                    <li>
                                                        <div class="survey_space">
                                                            <!-- Question 1 -->
                                                            <label for=""><b>Which type of kidney stone is present in this patient's case?</b></label>
                                                            <!-- Question 1 -->
                                                            <!-- Question 1 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_1" id="Question_11"
                                                                        value="Calcium oxalate" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_11">Calcium oxalate </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 1 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_1" id="Question_12"
                                                                        value="Calcium phosphate" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_12"> Calcium phosphate</label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 1 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_1" id="Question_13"
                                                                        value="Uric acid" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_13">Uric acid</label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 1 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_1" id="Question_14"
                                                                        value="Struvite" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_14"> Struvite</label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 1 option 5 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_1" id="Question_15"
                                                                        value="Cystine" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_15">Cystine</label>
                                                                </div>
                                                            </div>
                                                            <div class="err_Question_1"></div>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="survey_space">
                                                            <!-- Question 2 -->
                                                            <label for=""><b>For this patient, how many times have you performed ultrasound or CT scans to
                                                                    monitor the status of kidney stones? </b></label>
                                                            <!-- Question 2 -->
                                                            <!-- Question 2 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_2" id="Question_21" value="Once"
                                                                        data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_21">Once </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 2 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_2" id="Question_22"
                                                                        value="Twice" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_22"> Twice</label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 2 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_2" id="Question_23"
                                                                        value="Three times" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_23">Three time</label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 2 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_2" id="Question_24"
                                                                        value="Four times" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_24"> Four times</label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 2 option 5 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_2" id="Question_25"
                                                                        value="Five times or more" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_25">Five times and more</label>
                                                                </div>
                                                            </div>
                                                            <div class="err_Question_2"></div>
                                                        </div>
                                                    </li>

                                                    <li>

                                                        <!-- question 3 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>What other investigations, besides imaging studies, have been conducted for this patient?</b>
                                                            </label>
                                                            <!-- Question 3 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_3" id="Question_31"
                                                                        value="Complete Blood Count " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_31">Complete Blood Count </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 3 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_3" id="Question_32"
                                                                        value="Urinalysis" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_32">Urinalysis </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 3 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_3" id="Question_33"
                                                                        value="Urine Culture and Sensitivity " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_33">Urine Culture and Sensitivity </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 3 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_3" id="Question_34"
                                                                        value="Serum Electrolytes (Sodium, Potassium, Chloride)  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_34">Serum Electrolytes (Sodium, Potassium,
                                                                        Chloride) </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 3 option 5 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_3" id="Question_35"
                                                                        value="Renal Function Tests " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_35">Renal Function Tests </label>
                                                                </div>
                                                            </div>

                                                            <div class="err_Question_3"></div>
                                                        </div>
                                                    </li>
  
                                                    <p><span class="topics">Management  </span></p>



                                                    <li>
                                                        <!-- question 4 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>How do you typically manage uncomplicated kidney stones less than 10mm in size? </b>
                                                            </label>
                                                            <!-- Question 4 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_4" id="Question_41"
                                                                        value="Conservative management with hydration and pain management " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_41">Conservative management with hydration and
                                                                        pain management </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 4 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_4" id="Question_42"
                                                                        value="Medical expulsive therapy with alpha-blockers " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_42">Medical expulsive therapy with
                                                                        alpha-blockers </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 4 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_4" id="Question_43"
                                                                        value="Extracorporeal shockwave lithotripsy (ESWL) " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_43">Extracorporeal shockwave lithotripsy
                                                                        (ESWL) </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 4 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_4" id="Question_44"
                                                                        value="	Ureteroscopy with laser lithotripsy " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_44">Ureteroscopy with laser lithotripsy
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 4 option 5 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_4" id="Question_45"
                                                                        value="Terpene combination therapy along with  conservative management with hydration therapy"
                                                                        data-question="OXA">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_45">Terpene combination therapy along with
                                                                        conservative management with hydration therapy</label>
                                                                </div>
                                                            </div>

                                                            <div class="err_Question_4"></div>
                                                        </div>

                                                    </li>

                                                    <li>
                                                        <!-- question 5 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>Which of the following factors would make a patient a good candidate for terpene combination
                                                                    therapy for kidney stones? </b>
                                                            </label>
                                                            <!-- Question 5 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_5" id="Question_51"
                                                                        value="History of recurrent kidney stones " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_51">History of recurrent kidney stones
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 5 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_5" id="Question_52"
                                                                        value="A stone size smaller than 5mm " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_52">A stone size smaller than 5mm </label>
                                                                </div>
                                                            </div>

                                                            <!-- Question 5 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_5" id="Question_53"
                                                                        value="No evidence of urinary tract obstruction  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_53">No evidence of urinary tract obstruction
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 5 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_5" id="Question_54"
                                                                        value="No history of chronic kidney disease " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_54">No history of chronic kidney disease
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 5 option 5 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_5" id="Question_55"
                                                                        value="All the above " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_55">All the above</label>
                                                                </div>
                                                            </div>

                                                            <div class="err_Question_5"></div>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <!-- question 6 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>What factors do you consider when deciding to prescribe a Terpene combination for kidney
                                                                    stone patients after ESWL? </b>
                                                            </label>
                                                            <!-- Question 6 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="hidden" name="Question_6" id="Question_61" value="-"
                                                                        data-question="">
                                                                    <input class="form-check-input" type="checkbox" name="Question_6" id="Question_61"
                                                                        value="Stone size " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_61"> Stone size </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 6 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="hidden" name="Question_6_2" id="Question_62" value="-"
                                                                        data-question="">
                                                                    <input class="form-check-input" type="checkbox" name="Question_6_2" id="Question_62"
                                                                        value="Stone location " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_62"> Stone location </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 6 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="hidden" name="Question_6_3" id="Question_63" value="-"
                                                                        data-question="">
                                                                    <input class="form-check-input" type="checkbox" name="Question_6_3" id="Question_63"
                                                                        value="Patient age " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_63"> Patient age </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 6 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="hidden" name="Question_6_4" id="Question_64" value="-"
                                                                        data-question="">
                                                                    <input class="form-check-input" type="checkbox" name="Question_6_4" id="Question_64"
                                                                        value="Patient medical history " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_64">Patient medical history </label>
                                                                </div>
                                                            </div>

                                                            <!-- Question 6 option 5 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="hidden" name="Question_6_5" id="Question_65" value="-"
                                                                        data-question="">
                                                                    <input class="form-check-input" type="checkbox" name="Question_6_5" id="Question_65"
                                                                        value="Patient preference" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_65"> Patient preference</label>
                                                                </div>
                                                            </div>

                                                            <div class="err_Question_6"></div>
                                                        </div>
                                                    </li>



                                                    <li>
                                                        <!-- question 7 -->
                                                        <div class="survey_space">
                                                            <label for=""><b>How often do you prescribe a Terpene combination for managing kidney stones before
                                                                    surgery (pre-surgery)? </b></label>
                                                            <!-- Question 7 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_7" id="Question_71"
                                                                        value="Rarely " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_71">Rarely </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 7 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_7" id="Question_72"
                                                                        value="Occasionally " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_72"> Occasionally </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 7 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_7" id="Question_73"
                                                                        value="	Frequently " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_73">Frequently </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 7 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_7" id="Question_74"
                                                                        value="Very frequently " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_74">Very frequently </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 7 option 5 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_7" id="Question_75"
                                                                        value="I do not prescribe a Terpene combination for kidney stones before surgery."
                                                                        data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_75">I do not prescribe a Terpene combination
                                                                        for kidney stones before surgery. </label>
                                                                </div>
                                                            </div>

                                                            <div class="err_Question_7"></div>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <!-- question 8 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>How often do you prescribe a Terpene combination for managing kidney stones after surgery
                                                                    (post-surgery)? </b>
                                                            </label>
                                                            <!-- Question 8 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_8" id="Question_81"
                                                                        value="Rarely " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_81">Rarely </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 8 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_8" id="Question_82"
                                                                        value="Occasionally " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_82">Occasionally </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 8 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_8" id="Question_83"
                                                                        value="Frequently  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_83">Frequently </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 8 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_8" id="Question_84"
                                                                        value="Very frequently  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_84">Very frequently </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 8 option 5 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_8" id="Question_85"
                                                                        value="I do not prescribe a Terpene combination for kidney stones after surgery. "
                                                                        data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_85">I do not prescribe a Terpene combination
                                                                        for kidney stones after surgery. </label>
                                                                </div>
                                                            </div>

                                                            <div class="err_Question_8"></div>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <!-- question 9 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>What measures do you typically recommend for preventing recurrent kidney stones? </b>
                                                            </label>
                                                            <!-- Question 9 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="hidden" name="Question_9" id="Question_91" value="-"
                                                                        data-question="">
                                                                    <input class="form-check-input" type="checkbox" name="Question_9" id="Question_91"
                                                                        value="Increased fluid intake" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_91"> Increased fluid intake </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 9 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="hidden" name="Question_9_2" id="Question_92" value="-"
                                                                        data-question="">
                                                                    <input class="form-check-input" type="checkbox" name="Question_9_2" id="Question_92"
                                                                        value="Reduced intake of animal protein  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_92">Reduced intake of animal protein </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 9 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="hidden" name="Question_9_3" id="Question_93" value="-"
                                                                        data-question="">
                                                                    <input class="form-check-input" type="checkbox" name="Question_9_3" id="Question_93"
                                                                        value="Reduced intake of sodium " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_93"> Reduced intake of sodium </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 9 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="hidden" name="Question_9_4" id="Question_94" value="-"
                                                                        data-question="">
                                                                    <input class="form-check-input" type="checkbox" name="Question_9_4" id="Question_94"
                                                                        value="Potassium citrate supplementation  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_94">Potassium citrate supplementation </label>
                                                                </div>
                                                            </div>

                                                            <!-- Question 9 option 5 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="hidden" name="Question_9_5" id="Question_95" value="-"
                                                                        data-question="">
                                                                    <input class="form-check-input" type="checkbox" name="Question_9_5" id="Question_95"
                                                                        value="Soft gel Capsule containing terpene combination." data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_95"> Soft gel Capsule containing terpene
                                                                        combination.</label>
                                                                </div>
                                                            </div>

                                                            <div class="err_Question_9"></div>
                                                        </div>
                                                    </li>

                                                    
                                                    <li>
                                                        <!-- question 10 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>What alternative treatment options can be considered for managing kidney stones, aside from terpene combination therapy?: </b>
                                                            </label>
                                                            <!-- Question 10 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_10" id="Question_101"
                                                                        value="Extracorporeal shockwave lithotripsy (ESWL)  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_101">Extracorporeal shockwave lithotripsy (ESWL)  </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 10 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_10" id="Question_102"
                                                                        value="Ureteroscopy with laser lithotripsy  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_102">Ureteroscopy with laser lithotripsy  </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 10 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_10" id="Question_103"
                                                                        value="Percutaneous nephrolithotomy (PCNL)   " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_103">Percutaneous nephrolithotomy (PCNL)  </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 10 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_10" id="Question_104"
                                                                        value="Medical expulsive therapy with alpha-blockers " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_104">Medical expulsive therapy with alpha-blockers </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 10 option 5 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_10" id="Question_105"
                                                                        value="Conservative management with hydration and pain management "
                                                                        data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_105">Conservative management with hydration and pain management</label>
                                                                </div>
                                                            </div>

                                                            <div class="err_Question_10"></div>
                                                        </div>
                                                    </li>


                                                    <p><span class="topics">Outcome-based </span></p>


                                                    <li>

                                                        <!-- question 11 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>In your experience, how effective is the Terpene combination in managing kidney stones after ESWL?  </b>
                                                            </label>
                                                            <!-- Question 11 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_11" id="Question_111"
                                                                        value="	Very effective " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_111"> Very effective </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 11 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_11" id="Question_112"
                                                                        value="	Moderately effective " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_112"> Moderately effective </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 11 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_11" id="Question_113"
                                                                        value="	Slightly effective  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_113"> Slightly effective </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 11 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_11" id="Question_114"
                                                                        value="Not effective  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_114"> Not effective  </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 11 option 5 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_11" id="Question_115"
                                                                        value="Not applicable  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_115"> Not applicable   </label>
                                                                </div>
                                                            </div>


                                                            <div class="err_Question_11"></div>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <!-- question 12 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>What is the most important advantage that you have observed in patients taking the Terpene combination for kidney stones after ESWL? </b>
                                                            </label>
                                                            <!-- Question 12 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_12" id="Question_121"
                                                                        value="Minimal Nausea" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_121">Minimal Nausea</label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 12 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_12" id="Question_122" value="Minimal Diarrhea "
                                                                        data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_122">Minimal Diarrhea</label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 12 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_12" id="Question_123" value="Minimal Headache "
                                                                        data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_123">Minimal Headache </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 12 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_12" id="Question_124" value="Minimal Dizziness  "
                                                                        data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_124">Minimal Dizziness  </label>
                                                                </div>
                                                            </div>          
                                                            <!-- Question 12 option 5 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_12" id="Question_125" value="No significant side effects were observed "
                                                                        data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_125">No significant side effects were observed </label>
                                                                </div>
                                                            </div>                    

                                                            <div class="err_Question_12"></div>
                                                        </div>
                                                    </li>

                                                

                                                    <li>
                                                        <!-- question 13 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>Have you noticed any significant improvement in your patient’s condition after recommending a terpene combination for the treatment of urinary tract infections or kidney stones after ESWL?  </b>
                                                            </label>
                                                            <!-- Question 13 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_13" id="Question_131"
                                                                        value="Yes, a significant improvement" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_131">Yes, a significant improvement</label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 13 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_13" id="Question_132" value="Yes, some improvement. "
                                                                        data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_132">Yes, some improvement. </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 13 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_13" id="Question_133" value="Very less improvement "
                                                                        data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_133">Very less improvement </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 13 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_14" id="Question_134" value="	No improvement  "
                                                                        data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_134">No improvement  </label>
                                                                </div>
                                                            </div>                            

                                                            <div class="err_Question_13"></div>
                                                        </div>
                                                    </li>

                                                    <li >
                                                        <!-- question 14 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>How has your clinical experience been with the use of Terpene combination therapy as compared to other classes of drugs in managing kidney stones?</b>
                                                            </label>
                                                            <!-- Question 14 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_14" id="Question_141"
                                                                        value="Excellent" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_141">Excellent </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 14 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_14" id="Question_142"
                                                                        value="Very Good" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_142">Very Good </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 14 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_14" id="Question_143"
                                                                        value="Good" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_143">Good </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 14 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_14" id="Question_144"
                                                                        value="Average" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_144">Average </label>
                                                                </div>
                                                            </div>
                    

                                                            <div class="err_Question_14"></div>
                                                        </div>
                                                    </li>

                                                    <!-- Question 15 should be here -->
                                                    <li>
                                                        <div class="survey_space">
                                                                <label for="">
                                                                    <b>In your opinion, what are the key advantages of the Terpene combination as compared to other medications post-surgery? </b>
                                                                </label>

                                                                <!-- Question 15 option 1 -->

                                                                <div class="form-check form-check-inline">
                                                                        <div>
                                    
                                                                            <input class="form-control" type="text" name="Question_15_1" id="Question_151" data-question="">
                                                                        </div>
                                                                </div>
                                                                <div class="err_Question_15_1"></div>
                                                        </div>
                                                    </li>

                                                    <li >
                                                        <!-- question 16 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>Would you prefer prescribing a Terpene combination as a first-line medication or as an adjunct in all patients to prevent kidney stones or treat kidney stones?</b>
                                                            </label>
                                                            <!-- Question 16 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_16" id="Question_161"
                                                                        value="Always" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_161">Always </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 16 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_16" id="Question_162"
                                                                        value="Mostly" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_162">Mostly </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 16 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_16" id="Question_163"
                                                                        value="Sometime" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_163">Sometime </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 16 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_16" id="Question_164"
                                                                        value="Rarely" data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_164">Rarely </label>
                                                                </div>
                                                            </div>
                    

                                                            <div class="err_Question_16"></div>
                                                        </div>
                                                    </li>

                                                    <li >
                                                        <!-- question 17 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>How frequently do you typically follow up with patients who are receiving terpene combination therapy for kidney stones? </b>
                                                            </label>
                                                            <!-- Question 17 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_17" id="Question_171"
                                                                        value="Every 1-3 months " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_171">Every 1-3 months  </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 17 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_17" id="Question_172"
                                                                        value="Every 3-6 months " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_172">Every 3-6 months  </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 17 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_17" id="Question_173"
                                                                        value="Every 6-12 months  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_173">Every 6-12 months   </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 17 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_17" id="Question_174"
                                                                        value="Annually " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_174">Annually  </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 17 option 5 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_17" id="Question_175"
                                                                        value="Only as needed. " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_175">Only as needed.  </label>
                                                                </div>
                                                            </div>
                    

                                                            <div class="err_Question_17 "></div>
                                                        </div>
                                                    </li>

                                                    <li>
        
                                                <!-- question 18 -->
                                                <div class="survey_space">
                                                    <label for="">
                                                        <b>How do you typically monitor and assess the effectiveness of the Terpene combination in your kidney stone patients after ESWL? </b>
                                                    </label>
                                                    <!-- Question 18 option 1 -->
                                                    <div class="form-check form-check-inline">
                                                        <div class="radio-icon">
                                                            <input class="form-check-input" type="radio" name="Question_18" id="Question_181" value="Urine and blood tests " data-question="">
                                                        </div>
                                                        <div class="label-icon">
                                                            <label class="form-check-label" for="Question_181">Urine and blood tests </label>
                                                        </div>
                                                    </div>
                                                    <!-- Question 18 option 2 -->
                                                    <div class="form-check form-check-inline">
                                                        <div class="radio-icon">
                                                            <input class="form-check-input" type="radio" name="Question_18" id="Question_182" value="Imaging studies " data-question="">
                                                        </div>
                                                        <div class="label-icon">
                                                            <label class="form-check-label" for="Question_182">Imaging studies </label>
                                                        </div>
                                                    </div>
                                                    <!-- Question 18 option 3 -->
                                                    <div class="form-check form-check-inline">
                                                        <div class="radio-icon">
                                                            <input class="form-check-input" type="radio" name="Question_18" id="Question_183" value="Patient symptom reports" data-question="">
                                                        </div>
                                                        <div class="label-icon">
                                                            <label class="form-check-label" for="Question_183">Patient symptom reports</label>
                                                        </div>
                                                    </div>

                                                    <!-- Question 18 option 4 -->
                                                    <div class="form-check form-check-inline">
                                                        <div class="radio-icon">
                                                            <input class="form-check-input" type="radio" name="Question_18" id="Question_184" value="Other" data-question="">
                                                        </div>
                                                        <div class="label-icon">
                                                            <label class="form-check-label" for="Question_184">Any Other (Please Specify)</label>
                                                        </div>
                                                    </div>
            
            
                                                    <div class="err_Question_18"></div>
        
                                                <!-- question 18 If Yes -->
                                                <div class="survey_space">
            
                                                <!-- Question 18 If yes -->
                                                    <div class="form-check form-check-inline">
                                                        <div>
                    
                                                            <input class="form-control" type="text" name="Question_18_If_No" id="Question_185" data-question="">
                                                        </div>
                                                    </div>
                                                    <div class="err_Question_18_If_No"></div>
                                                </div>
                                            </div>
                                            </li>


                                            <li>
                                                        <!-- question 19 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>Which of the following laboratory parameters do you routinely monitor in patients receiving terpene combination therapy for kidney stones? </b>
                                                            </label>
                                                            <!-- Question 19 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_19" id="Question_191"
                                                                        value="Serum electrolytes  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_191">Serum electrolytes   </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 19 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_19" id="Question_192"
                                                                        value="Serum creatinine " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_192">Serum creatinine  </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 19 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_19" id="Question_193"
                                                                        value="Serum uric acid   " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_193">	Serum uric acid </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 19 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_19" id="Question_194"
                                                                        value="	Urine pH  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_194">	Urine pH   </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 19 option 5 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_19" id="Question_195"
                                                                        value="No routine monitoring of parameters required " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_195">No routine monitoring of parameters required  </label>
                                                                </div>
                                                            </div>
                    

                                                            <div class="err_Question_19 "></div>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <!-- question 20 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>What percentage of chances of recurrent kidney stones are there in patients on terpene combination therapy post-surgery?  </b>
                                                            </label>
                                                            <!-- Question 20 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_20" id="Question_201"
                                                                        value="Less than 5 %   " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_201">	Less than 5 %   </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 20 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_20" id="Question_202"
                                                                        value="Between 5-10 %  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_202">Between 5-10 %   </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 20 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_20" id="Question_203"
                                                                        value="Between 10-20 %   " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_203">Between 10-20 %  </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 20 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_20" id="Question_204"
                                                                        value="		Between 20-30 %  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_204">	Between 20-30 %   </label>
                                                                </div>
                                                            </div>
                            
                    

                                                            <div class="err_Question_20 "></div>
                                                        </div>
                                                    </li>


                                                    <li>
                                                        <!-- question 21 -->
                                                        <div class="survey_space">
                                                            <label for="">
                                                                <b>How effective is terpene combination therapy in providing relief from symptoms after kidney stone removal?   </b>
                                                            </label>
                                                            <!-- Question 21 option 1 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_21" id="Question_211"
                                                                        value="Highly effective in relieving symptoms   " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_211">	Highly effective in relieving symptoms    </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 21 option 2 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_21" id="Question_212"
                                                                        value="Moderately effective in relieving symptoms  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_212">Moderately effective in relieving symptoms    </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 21 option 3 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_21" id="Question_213"
                                                                        value="Slightly effective in relieving symptoms    " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_213">Slightly effective in relieving symptoms </label>
                                                                </div>
                                                            </div>
                                                            <!-- Question 21 option 4 -->
                                                            <div class="form-check form-check-inline">
                                                                <div class="radio-icon">
                                                                    <input class="form-check-input" type="radio" name="Question_21" id="Question_214"
                                                                        value="		Not effective in relieving symptoms  " data-question="">
                                                                </div>
                                                                <div class="label-icon">
                                                                    <label class="form-check-label" for="Question_214">	Not effective in relieving symptoms  </label>
                                                                </div>
                                                            </div>
                            
                    

                                                            <div class="err_Question_21 "></div>
                                                        </div>
                                                    </li>

                                                    <p><span class="topics">Prevention </span></p>


                                                    <li>
                                        <div class="survey_space">
                                            <label for="">
                                                <b>Based on National Kidney Foundation recommendations, what dietary interventions are recommended to prevent kidney stone formation?</b>
                                            </label>
                                            <!-- Question 22 option 1 -->
                                            <div class="form-check form-check-inline">
                                                <div class="radio-icon">
                                                    <input class="form-check-input" type="hidden" name="Question_22" id="Question_221" value="-" data-question="">
                                                    <input class="form-check-input" type="checkbox" name="Question_22" id="Question_221" value="Increasing fluid intake and maintaining adequate hydration" data-question="">
                                                </div>
                                                <div class="label-icon">
                                                    <label class="form-check-label" for="Question_221">	Increasing fluid intake and maintaining adequate hydration</label>
                                                </div>
                                            </div>
                                            <!-- Question 22 option 2 -->
                                            <div class="form-check form-check-inline">
                                                <div class="radio-icon">
                                                    <input class="form-check-input" type="hidden" name="Question_22_2" id="Question_222" value="-" data-question="">
                                                    <input class="form-check-input" type="checkbox" name="Question_22_2" id="Question_222" value="Dietary modifications, including reducing sodium and oxalate intake, and increasing consumption of vegetables, fruits, whole grains, and low-fat dairy products." data-question="">
                                                </div>
                                                <div class="label-icon">
                                                    <label class="form-check-label" for="Question_222">	Dietary modifications, including reducing sodium and oxalate intake, and increasing consumption of vegetables, fruits, whole grains, and low-fat dairy products.</label>
                                                </div>
                                            </div>
                                            <!-- Question 22 option 3 -->
                                            <div class="form-check form-check-inline">
                                                <div class="radio-icon">
                                                    <input class="form-check-input" type="hidden" name="Question_22_3" id="Question_223" value="-" data-question="">
                                                    <input class="form-check-input" type="checkbox" name="Question_22_3" id="Question_223" value="	Consuming sufficient dietary calcium through 3 servings of dairy products per day" data-question="">
                                                </div>
                                                <div class="label-icon">
                                                    <label class="form-check-label" for="Question_223">	Consuming sufficient dietary calcium through 3 servings of dairy products per day</label>
                                                </div>
                                            </div>
                                            <!-- Question 22 option 4 -->
                                            <div class="form-check form-check-inline">
                                                <div class="radio-icon">
                                                    <input class="form-check-input" type="hidden" name="Question_22_4" id="Question_224" value="-" data-question="">
                                                    <input class="form-check-input" type="checkbox" name="Question_22_4" id="Question_224" value="Avoiding excessive calcium supplementation" data-question="">
                                                </div>
                                                <div class="label-icon">
                                                    <label class="form-check-label" for="Question_224">	Avoiding excessive calcium supplementation </label>
                                                </div>
                                            </div>
                                                <!-- Question 22 option 5 -->
                                                <div class="form-check form-check-inline">
                                                <div class="radio-icon">
                                                    <input class="form-check-input" type="hidden" name="Question_22_5" id="Question_225" value="-" data-question="">
                                                    <input class="form-check-input" type="checkbox" name="Question_22_5" id="Question_225" value="Limiting vitamin C intake to 60mg/day and avoiding excessive intake" data-question="">
                                                </div>
                                                <div class="label-icon">
                                                    <label class="form-check-label" for="Question_225">	Limiting vitamin C intake to 60mg/day and avoiding excessive intake </label>
                                                </div>
                                            </div>
            
                                            <div class="err_Question_22"></div>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="survey_space">
                                            <label for="">
                                                <b>What is the likelihood of kidney stone recurrence after administering terpene combination therapy? </b>
                                            </label>
                                            <!-- Question 23 option 1 -->
                                            <div class="form-check form-check-inline">
                                                <div class="radio-icon">
                                                    <input class="form-check-input" type="hidden" name="Question_23" id="Question_231" value="-" data-question="">
                                                    <input class="form-check-input" type="checkbox" name="Question_23" id="Question_231" value="High probability of kidney stone recurrence " data-question="">
                                                </div>
                                                <div class="label-icon">
                                                    <label class="form-check-label" for="Question_231">High probability of kidney stone recurrence </label>
                                                </div>
                                            </div>
                                            <!-- Question 23 option 2 -->
                                            <div class="form-check form-check-inline">
                                                <div class="radio-icon">
                                                    <input class="form-check-input" type="hidden" name="Question_23_2" id="Question_232" value="-" data-question="">
                                                    <input class="form-check-input" type="checkbox" name="Question_23_2" id="Question_232" value="Moderate probability of kidney stone recurrence " data-question="">
                                                </div>
                                                <div class="label-icon">
                                                    <label class="form-check-label" for="Question_232">Moderate probability of kidney stone recurrence </label>
                                                </div>
                                            </div>
                                            <!-- Question 23 option 3 -->
                                            <div class="form-check form-check-inline">
                                                <div class="radio-icon">
                                                    <input class="form-check-input" type="hidden" name="Question_23_3" id="Question_233" value="-" data-question="">
                                                    <input class="form-check-input" type="checkbox" name="Question_23_3" id="Question_233" value="Low probability of kidney stone recurrence " data-question="">
                                                </div>
                                                <div class="label-icon">
                                                    <label class="form-check-label" for="Question_233">Low probability of kidney stone recurrence </label>
                                                </div>
                                            </div>
                                            <!-- Question 23 option 4 -->
                                            <div class="form-check form-check-inline">
                                                <div class="radio-icon">
                                                    <input class="form-check-input" type="hidden" name="Question_23_4" id="Question_234" value="-" data-question="">
                                                    <input class="form-check-input" type="checkbox" name="Question_23_4" id="Question_234" value="Very low probability of kidney stone recurrence " data-question="">
                                                </div>
                                                <div class="label-icon">
                                                    <label class="form-check-label" for="Question_234">Very low probability of kidney stone recurrence  </label>
                                                </div>
                                            </div>
                                            <!-- Question 23 option 5 -->
                                            <div class="form-check form-check-inline">
                                                <div class="radio-icon">
                                                    <input class="form-check-input" type="hidden" name="Question_23_5" id="Question_235" value="-" data-question="">
                                                    <input class="form-check-input" type="checkbox" name="Question_23_5" id="Question_235" value="Minimal to no chance of kidney stone recurrence" data-question="">
                                                </div>
                                                <div class="label-icon">
                                                    <label class="form-check-label" for="Question_235">Minimal to no chance of kidney stone recurrence  </label>
                                                </div>
                                            </div>
                                            
                                            <div class="err_Question_23"></div>
                                        </div>
                                    </li>

                                    <p><span class="topics">Other </span></p>

                                    <li>
                                        <div class="survey_space">
                                                <label for="">
                                                    <b>Have you encountered any patient cases where terpene combination therapy, either alone or in combination with other therapies, including alkalizers, was not effective in managing kidney stones? If so, how did you adjust the treatment plan?</b>
                                                </label>

                                                <!-- Question 24 option 1 -->

                                                <div class="form-check form-check-inline">
                                                        <div>
                    
                                                            <input class="form-control" type="text" name="Question_24_1" id="Question_241" data-question="">
                                                        </div>
                                                </div>
                                                <div class="err_Question_24_1"></div>
                                        </div>
                                    </li>
           

        </ol>
        <div class="">
            <input type="submit" value="Submit" id="btn-submit-survey"
                class="wpcf7-form-control has-spinner wpcf7-submit btn_submit">
        </div>
        <div class="response"></div>
    </form>
        <?php }else{ ?>
        <?php    // print_r($data[0]->surveyid );
        $surveyid = isset ( $data[0]->id ) ? $data[0]->id : 0;
        $surveydataid = isset ( $data[0]->surveyid ) ? $data[0]->surveyid : 0;
        ?>
        <br><br><br>
        <div class="already_participate"> You have already participated to this survey. </div>
        <!-- <div class = "acc_participate"> Please 
        <a href = "<?php //echo esc_url( home_url() )?>/account-details/?sid=<?php //echo $surveydataid; ?>&sr=<?php //echo $surveyid; ?>"> 
        click here</a> to submit your bank details</div> -->
        <?php } ?>
    <?php } else { ?>

        <h2><center>You must loggin to view this page</center></h2>

    <?php } ?>
    <!-- form -->
</div>
<?php get_footer();?>

<script>
    $(document).ready(function () {
        //var Question_12_11 = $('#Question_12_11').val();
        //alert(Question_12_11);
        $("#Question_82").click( function (e) {

            // alert("dsdd");
            // $('#Question_131').prop('checked', false);
            // $('#Question_132').prop('checked', false);
            // $('#Question_133').prop('checked', false);
            $('#q9').hide();

        });
        $("#Question_81").click( function (e) {

            // alert("dsdd");
            // $('#Question_131').prop('checked', false);
            // $('#Question_132').prop('checked', false);
            // $('#Question_133').prop('checked', false);
            $('#q9').show();

        });


        $("#Question_132").click( function (e) {

            
            $('#q14').hide();

        });
        $("#Question_131").click( function (e) {

            
            $('#q14').show();

        });




    });
</script>