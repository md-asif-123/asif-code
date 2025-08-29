<?php get_header(); ?>
<?php

    $user = wp_get_current_user();
    //$form_username      = urldecode ( get_query_var( 'form_username' ) );
    $form_username      = $user->user_login;
    $user_id      = $user->ID;
    //$form_user_role     = get_query_var( 'form_user_role' );
    //echo $user_id;
    $study_id = srb_twoway_encryption ( get_query_var('study_id'),'d');
    //echo $study_id;
    $patient_data = srb_get_multiform_patients_by_study( srb_twoway_encryption ( get_query_var('study_id'),'d') );

    //$study_patient_id = substr(get_query_var('patient_id'),5);
    if($patient_data){
        foreach( $patient_data as $item){

            if($item->patient_unique_id == get_query_var('patient_id')){
                $study_patient_id = $item->patient_id;
            }
        }
    }
    //$study_patient_id = $patient_data[0]->patient_id;
    //echo $study_patient_id;
    $enrollment_details_by_patientid = asf_enrollment_details_by_patientid($study_patient_id);
    $json_data = $enrollment_details_by_patientid[0]->form_data;
    $json_row = json_decode($json_data);
    //echo "<pre>";
    //print_r($patient_data);
    //print_r($enrollment_details_by_patientid);
    //print_r($json_row);
    //foreach ($json_row as $key => $row) {
        //echo "<pre>";print_r($row);echo "</pre>";
        //if(isset($row->name) && $row->name == 'hospital_name'):
            //$hospital_name = $row->hospital_name;
        //endif;
    //}
    $data = fetch_userdata( $form_username );
    //echo "<pre>"; print_r($data);echo "</pre>";

    //$form_entry_url         =   esc_url( home_url() )  .'/get/'.$form_user_role.'/'.$form_username.'/form_entries/';
    //$form_entry_url         =   esc_url( home_url() )  .'/manage/visits/'.$user_id.'/1143/'.get_query_var('patient_id').'/1/view/';

    // $form_entry_url         =   esc_url( home_url() )  .'/manage/visits/'.$user_id.'/'.$study_id.'/'.get_query_var('patient_id').'/1/view/';

    $form_entry_url =  home_url().'/manage/visits/'.srb_twoway_encryption($user_id,'e')."/".srb_twoway_encryption($study_id,'e')."/?callback_url=https://sure-dev-v3.docmode.org/study/apex-study-test/" ;

    $patient_id             =   get_patient_id( $data['username'] );
    //print_r($patient_id);
    $new_patient_id         =   $patient_id + 1; 
    $pt_displayname         =   "Patient ". $new_patient_id;

    //echo substr(get_query_var('patient_id'),5);

?>
<section class="multi-form-section">
  <div class="align-items-end" style="color: #333; background-color: #e5e5e5; padding: 30px; margin-top: -13px;">
    <div class="container">
      <div class="row">
        <h4 class="fw-600" style="font-size: 2em;"><?php echo get_the_title(srb_twoway_encryption ( get_query_var('study_id'),'d') );?></h4>
        <div class="col-lg-8 col-md-8 col-sm-8 col-12">
          <p style="font-size: 1.1em;" class="multi-form-heading mb-0">Visit 1: (Screening/ Enrolment/ Baseline Visit-Day 1)</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-12 text-end">
          <p style="font-size: 1.1em;" class="fw-600 mb-0">Patient ID : <span id="patientId"><?php echo get_query_var('patient_id');?></span></p>
        </div>
      </div>
    </div>
  </div>
  <div class="container">    
    <form id="frm-PEF" name ="frm-PEF" class="multiform" accept-charset="multipart/form-data" novalidate>
      <input class="form-check-input" type="hidden" name="sd" id="sd" value="<?php echo get_query_var('study_id')?>">
      <input class="form-check-input" type="hidden" name="vst" id="vst" value="<?php echo get_query_var('visit_id')?>">
      <input class="form-check-input" type="hidden" name="form_url" id="form_url" value="<?php echo $form_url; ?>">
      <input class="form-check-input" type="hidden" name="form_status" id="form_status" value="Completed">
      <input class="form-check-input" type="hidden" name="steps_completed" id="steps_completed" value="1">
      <input  class="form-check-input required" type="hidden" name="sd" id="sd" value="<?php echo get_query_var('study_id')?>">
      <input  class="form-check-input required" type="hidden" name="vst" id="vst" value="<?php echo get_query_var('visit_id')?>">

      <input type="hidden" id="pef_form_id" name= "pef_form_id"  value="<?php echo $study_id; ?>">
      <input type="hidden" id="pef_page_slug" name= "pef_page_slug" value="<?php echo $form_entry_url; ?>">
      <input type="hidden" id="pef_patient_id" name= "pef_patient_id" value="<?php echo $study_patient_id; ?>">
      <input type="hidden" id="name_of_respondent" name= "name_of_respondent" value="<?php echo $data['username'] ; ?>">
      
      <div class="box page-1">
        
        <h5 class="fw-600">DENOSUMAB SURVEY</h5>
        <div class="row">
        
          <div class="col-lg-4 col-md-4 col-sm-4 col-6">
            <div class="form-group">
              <label class="form-label">Subject ID : </label>
              <input required class="form-control" id="Question_1" name="subject_id" type="text" >
              <div class="" id="err_Question_1"></div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-6">
            <div class="form-group">
              <label class="form-label">Date of enrolment : </label>
              <input required class="form-control" id="Question_2" name="date_of_enrolment" type="date">
              <div class="" id="err_Question_2"></div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-6">
            <div class="form-group">
              <label class="form-label">Age : </label>
              <input required class="form-control" id="Question_3" name="patient_age" type="text" placeholder="Patient Age" >
              <div class="" id="err_Question_3"></div>
            </div>
          </div>
          <div><br></div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="form-group">
              <div class="table-responsive">  
                <table class="table table-bordered incusion-criteria-table">
                  <tbody>
                    
                    <!-- <tr>
                      <td>(Please check all statements and tick (√) the appropriate box)</td>
                      <th class="text-center">Yes</th>
                      <th class="text-center">No</th>
                    </tr> -->
                    <tr>
                      <td> Sex:
                      <div class="" id="err_Question_4"></div>  
                      </td>
                      <td class="text-center"><div><b>Male</b></div><input required type="radio" class="form-check-input required" name="Gender" id="Question_4_1" value="Male" ></td>

                      <td class="text-center"><div><b>Female</b></div><input required type="radio" class="form-check-input required" name="Gender" id="Question_4_2" value="Female" ></td>

                      <td class="text-center"><div><b>Other</b></div><input required required type="radio" class="form-check-input required" name="Gender" id="Question_4_3" value="Other" ></td>
                      
                    </tr>
                    
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div><br></div>

          <div class="col-lg-4 col-md-4 col-sm-4 col-6">
            <div class="form-group">
              <label class="form-label">1. Date of current denosumab administration :  </label>
              <input required class="form-control" id="Question_5_1a" name="Date_of_current_denosumab_administration" type="date">
                      <div class="" id="err_Question_5_1a"></div>
              
              
            </div>
          </div>
          <div><br></div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-6">
            <div class="form-group">
              <div class="table-responsive">  
                <table class="table table-bordered incusion-criteria-table">
                  <tbody>
                    
                    <!-- <tr>
                      <td>(Please check all statements and tick (√) the appropriate box)</td>
                      <th class="text-center">Yes</th>
                      <th class="text-center">No</th>
                    </tr> -->
                    
                    <label class="form-label">Dose administered  </label>
                    <div class="" id="err_Question_5"></div>
                    <tr>
                      
                      <td class="text-center"><div><b>120 Mg</b></div><input required type="radio" class="form-check-input required" name="Dose_administered" id="Question_5_1" value="120 Mg" ></td>

                      <td class="text-center"><div><b>60 Mg</b></div><input required type="radio" class="form-check-input required" name="Dose_administered" id="Question_5_2" value="60 Mg" ></td>

                      <td class="text-center"><div><b>Other</b></div><input required required type="radio" class="form-check-input required" name="Dose_administered" id="Question_5_3" value="Other" ></td>
                      
                      
                      
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div><br></div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-6">
            <div class="form-group">
              <label class="form-label">2. What are the Concomitant Medications patient taking? (If Any): </label>
              <input required class="form-control" id="Question_6" name="What_are_the_Concomitant_Medications_patient_taking" type="text">
              <div class="" id="err_Question_6"></div>
            </div>
          </div>
          <div><br></div>

          <div class="col-lg-4 col-md-4 col-sm-4 col-6">
            <div class="form-group">
              <label class="form-label">3. What is the primary solid tumor diagnosis ? </label>
              
              <div class="" id="err_Question_7"></div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="form-group">
              <div class="table-responsive">  
                <table class="table table-bordered incusion-criteria-table">
                  <tbody>
                    
                    <!-- <tr>
                      <td>(Please check all statements and tick (√) the appropriate box)</td>
                      <th class="text-center">Yes</th>
                      <th class="text-center">No</th>
                    </tr> -->
                    

                    <tr>
                     
                      <td class="text-center"><div><b>Breast cancer</b></div><input required type="radio" class="form-check-input required" name="What_is_the_primary_solid_tumor_diagnosis" id="Question_7_1" value="Breast cancer" ></td>

                      <td class="text-center"><div><b>Prostate cancer</b></div><input required type="radio" class="form-check-input required" name="What_is_the_primary_solid_tumor_diagnosis" id="Question_7_2" value="Prostate cancer" ></td>

                      <td class="text-center"><div><b>Lung cancer </b></div><input required required type="radio" class="form-check-input required" name="What_is_the_primary_solid_tumor_diagnosis" id="Question_7_3" value="Lung cancer" ></td>
                      
                      <td class="text-center"><div><b>Renal cell carcinoma </b></div><input required type="radio" class="form-check-input required" name="What_is_the_primary_solid_tumor_diagnosis" id="Question_7_4" value="Renal cell carcinoma" ></td>

                      <td class="text-center"><div><b>Thyroid cancer</b></div><input required type="radio" class="form-check-input required" name="What_is_the_primary_solid_tumor_diagnosis" id="Question_7_5" value="Thyroid cancer" ></td>
                      
                      <td class="text-center"><div><b>Multiple myeloma </b></div><input required type="radio" class="form-check-input required" name="What_is_the_primary_solid_tumor_diagnosis" id="Question_7_5" value="Multiple myeloma" ></td>

                      <td class="text-center"><div><b>Other</b></div><input required type="radio" class="form-check-input required" name="What_is_the_primary_solid_tumor_diagnosis" id="Question_7_6" value="Other" ></td>
                      
                      <td class="text-center"><div><b>Histological grade/stage at diagnosis</b></div><input required type="radio" class="form-check-input required" name="What_is_the_primary_solid_tumor_diagnosis" id="Question_7_7" value="Histological grade/stage at diagnosis" ></td>
                      
                      
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div><br></div>

          <div class="col-lg-4 col-md-4 col-sm-4 col-6">
            <div class="form-group">
              <label class="form-label">4. Treatment Compliance  </label>
              <label class="form-label">Was the scheduled denosumab dose:  </label>
              <label class="form-label">Given on time (within 7 days of scheduled date)  </label>
              <div class="" id="err_Question_8"></div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-4">
            <div class="form-group">
              <div class="table-responsive">  
                <table class="table table-bordered incusion-criteria-table">
                  <tbody>
                    
                    <!-- <tr>
                      <td>(Please check all statements and tick (√) the appropriate box)</td>
                      <th class="text-center">Yes</th>
                      <th class="text-center">No</th>
                    </tr> -->
                    

                    <tr>
                      
                      <td class="text-center"><div><b>Yes</b></div><input required type="radio" class="form-check-input required" name="Was_the_scheduled_denosumab_dose" id="Question_8_1" value="Breast cancer" ></td>

                      <td class="text-center"><div><b>No</b></div><input required type="radio" class="form-check-input required" name="Was_the_scheduled_denosumab_dose" id="Question_8_2" value="Prostate cancer" ></td>

                      
                      
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
            
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
          <div class="form-group">
            <label class="form-label">Next scheduled dose date : </label>
            <input required class="form-control" id="Question_9" name="Next_scheduled_dose_date" type="date">
            <div class="" id="err_Question_9"></div>
          </div>
        </div>
        <br>
        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
          <div class="form-group">
            <label class="form-label">5. Upload Invoice (digital copy) : </label>
            <div class="field_cust_photo"><input type="hidden" name="invoice_file_upload" id="invoice_file_upload" value=""></div>
            <input required class="form-control" id="upload_invoice_4230_1" name="Upload_Invoice_digital_copy1" type="file">
            <div class="" id="err_upload_invoice_4230_1"></div>
          </div>
        </div>
        <br>
        <div class="col-lg-4 col-md-4 col-sm-4 col-6">
          <div class="form-group">
            <label class="form-label">6. Upload Invoice (digital copy) 2 : </label>
            <div class="field_cust_photo2"><input type="hidden" name="invoice_file_upload2" id="invoice_file_upload2" value=""></div>
            <input required class="form-control" id="upload_invoice_4230_12" name="Upload_Invoice_digital_copy12" type="file">
            <div class="" id="err_upload_invoice_4230_12"></div>
          </div>
        </div>
        
        
         <div class="form-group mb-0 text-end">
        
          <button type="submit" class="btn btn-success btn-submit" id="submitBtn-4230">Submit</button>
        </div>
      </div>

        
        <div class="form-group mb-0 text-end">
        
          <button></button>
        </div>
      </div>
    </form>
  </div>
</section>
<?php get_footer(); ?>