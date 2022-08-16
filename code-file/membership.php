<?php
/**
 * Template Name: membership template
 */
?>

<?php get_header(); 
if ( is_user_logged_in() ):
$user = wp_get_current_user();
//print_r($user);
$user_email = $user->user_email;
$user_country = $user->country;
$user_name = $user->first_name;
$academic_background = $user->academic_background;
$academic_background1 = $user->academic_background1;
$academic_background2 = $user->academic_background2;
$academic_background3 = $user->academic_background3;
$academic_background4 = $user->academic_background4;
$academic_background5 = $user->academic_background5;
$user_type = $user->user_type;
$academic_year = $user->academic_year;
$academic_year1 = $user->academic_year1;
$academic_year2 = $user->academic_year2;
$academic_year3 = $user->academic_year3;
$academic_year4 = $user->academic_year4;
$academic_year5 = $user->academic_year5;
$professional_category = $user->professional_category;
$designation = $user->designation;
$physician_speciality = $user->physician_speciality;
$other_specify = $user->other_specify;
$permanent_address = $user->permanent_address;
$mobile_number = $user->mobile_number;
$billing_phone = $user->billing_phone;
$mo_num = $user->mo_num;
//echo $user->user_email."<br>";
//echo $user->user_password."<br>";
//echo $user->mo_num;
//echo $user->academic_background1;
//echo $user->country;
$regDate = $user->user_registered;
$timeperiod = $user->timeperiod;
$curDate = date('Y-m-d');
$futureDate=date('Y-m-d', strtotime('+'.$timeperiod.' year', strtotime($regDate)) );
// echo $regDate."<br>";
// echo $timeperiod."<br>";
// echo $curDate."<br>";
// echo $futureDate."<br>";

$regDate = date('F jS, Y', strtotime($regDate));
$futureDate = date('F jS, Y', strtotime($futureDate));

endif;



$current_year = date('Y');
$date_range = range('1970', $current_year);
$year = array_combine($date_range, $date_range);
//print_r($years);

?>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
  #mform {
  margin: 0px 0px 0px 97px;
  font-size: 20px;
}
#blist{
  
  line-height: 2.2;
}
#speciality{
  height: 27px;
  width: 181px;
margin-left: 10px;
}
#specify{
  margin: -3px 0px -1px 8px;
  width: 175px;
}
ul#blist {
    border: 2px solid #EBEBEB;
}
#returning_member{
  margin: -29px 0px 0px 910px;
  color: #FFFFFF;
  font-size: 16px;
}

#tmbutton{
  margin: -72px 0px 0px 933px;
  color: #FFFFFF;
}

#checkmark{
    font-size: 7rem;
    padding: 20px;
   line-height: 1;
   color: #1C3F77;
   float: center;
  }
  #checkmark{
  font-size:  6rem;
  border-radius: 100px;
  background: green;
  color: white;
  padding: 15px 15px;
 }

 /*#plus{
    font-size: 7rem;
    padding: 20px;
   line-height: 1;
   color: #1C3F77;
   float: center;
  }*/
  #plus{
  font-size: 1rem;
  border-radius: 41px;
  background: green;
  color: white;
  padding: 5px 6px;
  }

  #minus{
  font-size: 1rem;
  border-radius: 41px;
  background: green;
  color: white;
  padding: 5px 6px;
  }
</style>

<br><br><br>
<?php 
if ( !is_user_logged_in() ):
?>
<p>&nbsp;</p>
  <h2 style="text-align: center;"> </h2>
  <h3 style="text-align: center;">Please login to access this page.</h3>
<?php
elseif(in_array( 'um_permanent-member', (array) $user->roles ) && $user->timeperiod == 'permanent'): 
  //elseif(2<1):
  ?>

<p>&nbsp;</p>
  <h2 style="text-align: center;"> </h2>
  <h3 style="text-align: center;">Congratulations! You are now a Life Time Member.</h3>
  <h3 style="text-align: center;">You can now access to all the <a href="https://ispen.org.in/resources/">resources</a>.</h3>
<?php else: ?>

<!-- Button trigger modal -->
<?php if(in_array( 'um_temporary-member', (array) $user->roles )){ ?>
<button type="button" id="tmbutton" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">

  <strong>You are a temporary member.See details.</strong>
  
</button>
<?php 
  }
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><span style="font-size: 21px;"><strong>Please become a Life Time Member</strong></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </h5>
        
      </div>
      <div class="modal-body">
        <h3>Your Registration Date is<?php echo "<span style='color:red;''><strong> ".$regDate."</strong></span>"; ?></h3>
        <?php if(empty($timeperiod) || $timeperiod == 'Time Period Required'){ ?>
          <h3>Your Expiry Date is</h3>
        <?php } else { ?>
        <h3>Your Expiry Date is<?php echo "<span style='color:red;''><strong> ".$futureDate."</strong></span>"; ?></h3>
        <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <a id="returning_member" href="<?php echo home_url()."/returning-member"; ?>" class="btn btn-primary"><strong>I am an existing member</strong></a>
      <!-- <button id="returning_member"><a href="<?php //echo home_url()."/returning-member"; ?>" style="text-decoration: none;"><strong>I am an existing member</strong></a></button> -->

      <form id="basic-form" class="form-horizontal">
        <div class="form-group">
          <label id="mform" class="control-label col-sm-6" for="email">Membership Registration</label>
          <!-- <div class="col-sm-8">
            <input type="email" class="form-control" id="email" placeholder="Enter email">
          </div> -->
        </div>
        <input type="hidden" name="user_email" id="user_email" value="<?php echo $user_email; ?>">
        <input type="hidden" name="user_country" id="user_country" value="<?php echo $user_country; ?>">
        <input type="hidden" name="mobile_number" id="mobile_number" value="<?php echo $mobile_number; ?>">
        <input type="hidden" name="billing_phone" id="billing_phone" value="<?php echo $billing_phone; ?>">
        <input type="hidden" name="mo_num" id="mo_num" value="<?php echo $mo_num; ?>">
        <!-- <input type="hidden" name="academic_background1" class="academic_background1" value="1">
        <input type="hidden" name="academic_background2" class="academic_background2" value="2"> -->
        <input required type="hidden" name="user_name" id="user_name" value="<?php if(isset($user_name)): echo $user_name; else: echo ''; endif; ?>">
        <div class="form-group">
          <label class="control-label col-sm-5" for="amount">Your Designation at your Institution/Hospital</label>
          <div class="col-sm-7">
            <input required type="text" class="form-control" id="designation" name="designation" value="<?php if(isset($designation)): echo $designation; else: echo ''; endif; ?>">
          </div>
        </div>
        <div style="display: none;" id="dvalidate" class="form-group">
          <label class="control-label col-sm-5" for="amount"></label>
          <div class="col-sm-7">
            <p style="color:red">This field is required</p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-5" for="amount">Permanent Address</label>
          <div class="col-sm-7">
            
            <textarea required class="form-control" id="permanent_address" name="permanent_address"><?php if(isset($permanent_address)): echo $permanent_address; else: echo ''; endif; ?></textarea>
          </div>
        </div>
        <div style="display: none;" id="pavalidate" class="form-group">
          <label class="control-label col-sm-5" for="amount"></label>
          <div class="col-sm-7">
            <p style="color:red">This field is required</p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-5" for="name">User type</label>
          <div class="col-sm-7">
            <select required name="user_type" id="user_type" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option value="">Select your user type</option>
            <option id="physicians" value="physicians" <?php if(isset($user_type) && $user_type == 'physicians'): echo 'selected="selected"'; endif; ?>>Physicians</option>
            <option id="non-physicians" value="non-physicians" <?php if(isset($user_type) && $user_type == 'non-physicians'): echo 'selected="selected"'; endif; ?>>Non-Physicians</option>
            <option id="industry" value="industry" <?php if(isset($user_type) && $user_type == 'industry'): echo 'selected="selected"'; endif; ?>>Industry</option>
            </select>
          </div>
        </div>
        <div style="display: none;" id="utvalidate" class="form-group">
          <label class="control-label col-sm-5" for="amount"></label>
          <div class="col-sm-7">
            <p style="color:red">This field is required</p>
          </div>
        </div>

        <div id="test">
          <span>
            <div class="form-group">
              <label class="control-label col-sm-5" for="amount">Academic Background</label>
              <div class="col-sm-4">
                <input required type="text" class="form-control" id="academic_background" name="academic_background" placeholder="Degrees/Diplomas" value="<?php if(isset($academic_background)): echo $academic_background; else: echo ''; endif; ?>">
              </div>
              <div class="col-sm-3">
                <select required type="text"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="academic_year" name="academic_year">
                  <option value="">Select Academic Year</option>
                  <?php foreach($year as $key => $val): ?>
                  <option value="<?php echo $key; ?>" <?php if(isset($academic_year) && $academic_year == $key): echo 'selected="selected"'; endif; ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
                </select>
              </div>
            </div>
          </span>
          <div style="display: none;" id="abvalidate" class="form-group">
          <label class="control-label col-sm-5" for="amount"></label>
          <div class="col-sm-7">
            <p style="color:red">This field is required</p>
          </div>
        </div>
        <div style="display: none;" id="ayvalidate" class="form-group">
          <label class="control-label col-sm-5" for="amount"></label>
          <div class="col-sm-7">
            <p style="color:red">Year is required</p>
          </div>
        </div>
          <?php if(!empty($academic_background1)): ?>
          <span>
            <div class="form-group">
              <label class="control-label col-sm-5" for="amount"></label>
              <div class="col-sm-4">
                <input required type="text" class="form-control academic_background1" name="academic_background1" placeholder="Degrees/Diplomas" value="<?php if(isset($academic_background1)): echo $academic_background1; else: echo ''; endif; ?>">
              </div>
              <div class="col-sm-3">
                <select required type="text"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="academic_year1" name="academic_year1">
                  <option value="">Select Academic Year</option>
                  <?php foreach($year as $key => $val): ?>
                  <option value="<?php echo $key; ?>" <?php if(isset($academic_year1) && $academic_year1 == $key): echo 'selected="selected"'; endif; ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
                </select>
              </div>
            </div>
          </span>
          <?php endif; ?>

          <?php if(!empty($academic_background2)): ?>
          <span>
            <div class="form-group">
              <label class="control-label col-sm-5" for="amount"></label>
              <div class="col-sm-4">
                <input required type="text" class="form-control academic_background2" name="academic_background2" placeholder="Degrees/Diplomas" value="<?php if(isset($academic_background2)): echo $academic_background2; else: echo ''; endif; ?>">
              </div>
              <div class="col-sm-3">
                <select required type="text"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="academic_year2" name="academic_year2">
                  <option value="">Select Academic Year</option>
                  <?php foreach($year as $key => $val): ?>
                  <option value="<?php echo $key; ?>" <?php if(isset($academic_year2) && $academic_year2 == $key): echo 'selected="selected"'; endif; ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
                </select>
              </div>
            </div>
          </span>
          <?php endif; ?>

          <?php if(!empty($academic_background3)): ?>
          <span>
            <div class="form-group">
              <label class="control-label col-sm-5" for="amount"></label>
              <div class="col-sm-4">
                <input required type="text" class="form-control academic_background3" name="academic_background3" placeholder="Degrees/Diplomas" value="<?php if(isset($academic_background3)): echo $academic_background3; else: echo ''; endif; ?>">
              </div>
              <div class="col-sm-3">
                <select required type="text"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="academic_year3" name="academic_year3">
                  <option value="">Select Academic Year</option>
                  <?php foreach($year as $key => $val): ?>
                  <option value="<?php echo $key; ?>" <?php if(isset($academic_year3) && $academic_year3 == $key): echo 'selected="selected"'; endif; ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
                </select>
              </div>
            </div>
          </span>
          <?php endif; ?>

          <?php if(!empty($academic_background4)): ?>
          <span>
            <div class="form-group">
              <label class="control-label col-sm-5" for="amount"></label>
              <div class="col-sm-4">
                <input required type="text" class="form-control academic_background4" name="academic_background4" placeholder="Degrees/Diplomas" value="<?php if(isset($academic_background4)): echo $academic_background4; else: echo ''; endif; ?>">
              </div>
              <div class="col-sm-3">
                <select required type="text"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="academic_year4" name="academic_year4">
                  <option value="">Select Academic Year</option>
                  <?php foreach($year as $key => $val): ?>
                  <option value="<?php echo $key; ?>" <?php if(isset($academic_year4) && $academic_year4 == $key): echo 'selected="selected"'; endif; ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
                </select>
              </div>
            </div>
          </span>
          <?php endif; ?>

          <?php if(!empty($academic_background5)): ?>
          <span>
            <div class="form-group">
              <label class="control-label col-sm-5" for="amount"></label>
              <div class="col-sm-4">
                <input required type="text" class="form-control academic_background5" name="academic_background5" placeholder="Degrees/Diplomas" value="<?php if(isset($academic_background5)): echo $academic_background5; else: echo ''; endif; ?>">
              </div>
              <div class="col-sm-3">
                <select required type="text"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="academic_year5" name="academic_year5">
                  <option value="">Select Academic Year</option>
                  <?php foreach($year as $key => $val): ?>
                  <option value="<?php echo $key; ?>" <?php if(isset($academic_year5) && $academic_year5 == $key): echo 'selected="selected"'; endif; ?>><?php echo $val; ?></option>
                <?php endforeach; ?>
                </select>
              </div>
            </div>
          </span>
          <?php endif; ?>

        </div>
        <?php if(empty($academic_background1)): ?>
        <div class="form-group">

          <label class="col-sm-5" for="amount"></label>
          <div class="col-sm-3">
            <button type="button" class="btn btn-default plusbtn"><i id="plus" class="fa fa-plus" aria-hidden="true"></i> Add More</button>
          </div>
          <div class="col-sm-3">
            <button style="display: none;" type="button" class="btn btn-default minusbtn"><i id="minus" class="fa fa-minus" aria-hidden="true"></i> Remove</button>
          </div>
        </div>
        <?php endif; ?>
        <div style="display: none;" id="ab1validate" class="form-group"><label class="control-label col-sm-5" for="amount"></label><div class="col-sm-7"><span style="color:red">Both the field are required</span></div></div>

        <div style="display: none;" id="ab2validate" class="form-group"><label class="control-label col-sm-5" for="amount"></label><div class="col-sm-7"><span style="color:red">Both the field are required</span></div></div>
        <div class="form-group">
          <label class="control-label col-sm-5" for="amount">Professional Category</label>
          <div class="col-sm-3">
            <input <?php if(empty($professional_category)): ?> checked <?php endif; ?> type="radio" id="physician2" name="professional_category" <?php if(isset($professional_category) && $professional_category == 'Physician'): ?> checked <?php endif; ?> value="Physician">&nbsp&nbsp Physician 
          </div>
          <div id="speciality" class="col-sm-4">
            <input class="form-control" type="text" placeholder="Mention Your Speciality" id="physician_speciality" name="physician_speciality" value="<?php if(isset($physician_speciality)): echo $physician_speciality; else: echo ''; endif; ?>">
          </div>
          <div style="display: none;" id="pvalidate" class="form-group"><label class="control-label col-sm-5" for="amount"></label><div class="col-sm-7"><span style="color:red">Physician speciality required</span></div></div>

          <label class="control-label col-sm-5" for="amount"></label>
          <div class="col-sm-7">
            <input type="radio" id="dietition" <?php if(isset($professional_category) && $professional_category == 'Dietition/Nutritionist'): ?> checked <?php endif; ?> name="professional_category" value="Dietition/Nutritionist">&nbsp&nbsp Dietition/Nutritionist<br>

            <input type="radio" id="pharmacist" <?php if(isset($professional_category) && $professional_category == 'Pharmacist'): ?> checked <?php endif; ?> name="professional_category" value="Pharmacist">&nbsp&nbsp Pharmacist<br>

            <input type="radio" id="pharmacologist" <?php if(isset($professional_category) && $professional_category == 'Pharmacologist'): ?> checked <?php endif; ?> name="professional_category" value="Pharmacologist">&nbsp&nbsp Pharmacologist<br>

            <input type="radio" id="nurse" <?php if(isset($professional_category) && $professional_category == 'Nurse'): ?> checked <?php endif; ?> name="professional_category" value="Nurse">&nbsp&nbsp Nurse<br>

            <input type="radio" id="biochemist" <?php if(isset($professional_category) && $professional_category == 'Biochemist'): ?> checked <?php endif; ?> name="professional_category" value="Biochemist">&nbsp&nbsp Biochemist<br>

            <input type="radio" id="industry2" <?php if(isset($professional_category) && $professional_category == 'Industry'): ?> checked <?php endif; ?> name="professional_category" value="Industry">&nbsp&nbsp Industry<br>

            <!-- <input type="radio" id="others" <?php if($professional_category == 'Others'): ?> checked <?php endif; ?> name="professional_category" value="Others">&nbsp&nbsp Others<br> -->

          </div>
          <div class="form-group">
          <label class="control-label col-sm-5" for="amount"></label>
          <div class="col-sm-3">
            <input type="radio" id="others" <?php if(isset($professional_category) && $professional_category == 'Others'): ?> checked <?php endif; ?> name="professional_category" value="Others">&nbsp&nbsp Others
          </div>
          <div id="specify" class="col-sm-4">
            <input class="form-control" id="other_specify" type="text" placeholder="Please Specify" name="other_specify" value="<?php if(isset($other_specify)): echo $other_specify; else: echo ''; endif; ?>">
          </div>
          <div style="display: none;" id="ovalidate" class="form-group"><label class="control-label col-sm-5" for="amount"></label><div class="col-sm-7"><span style="color:red">If other please specify</span></div></div>
        </div>
        </div>
        <div style="display: none;" id="lvalidate" class="form-group">
          <label class="control-label col-sm-5" for="amount"></label>
          <div class="col-sm-7">
            <span style="color:red">Please login to become a member..</span>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-6 col-sm-10">
            <!-- <button type="submit" name="pay" value="Submit And Pay" class="btn btn-default" onclick="pay_now();">Submit And Pay</button> -->
            <button type="submit" name="pay" value="Submit And Pay" class="btn btn-info" id="pay">Submit And Pay</button>
          </div>
        </div>
      </form>
    </div>

    <div class="col-sm-6">
      <h4><strong>Benefits</strong></h4>
      <ul id="blist">
        <li> Access to the ISPEN journal</li>
        <li> Access to ISPEN Newsletter and information/updates on online events</li>
        <li> Discount on registration fees for national and other conferences of the ISPEN</li>
        <li> Automatically become a member of your ISPEN local branch and get invited to all branch
        meetings and regular updates</li>
        <li> A chance to get your Hospital recognized to conduct ISPEN endorsed and accredited courses
        if they meet the criteria</li>
        <li> Ability to register your Hospital/ICU with ISPEN and participate in ISPEN research projects</li>
        <li> Discounts on nutrition related books and more</li>
        <li> Access to ISPEN Interdisciplinary Partners programs (Ex:ISPEN and ISCCM for Critical
        Care Nutrition, ISPEN and FOGSI for Women's Nutrition etc.)</li>
        <li> Connect with programs with International Partners of ISPEN such as ASPEN, ESPEN and
        PENSA</li>
        <li> Access to our resources page where we have put up tons of study materials and research
        papers and more coming your way</li>
      </ul>
    </div>


  </div>
</div>
<?php endif; ?>

<script>
  //function pay_now(){
   
    $(document).ready(function(){
      
  $("#pay").click(function(e){
    //$("#basic-form").validate (e);
    //e.preventDefault();
    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    //alert(ajaxurl);
    var user_email = jQuery('#user_email').val();
    var user_country = jQuery('#user_country').val();
    var user_types = jQuery('#user_type').val();
    var academic_year = jQuery('#academic_year').val();
    var academic_year1 = jQuery('#academic_year1').val();
    var academic_year2 = jQuery('#academic_year2').val();
    var academic_year3 = jQuery('#academic_year3').val();
    var academic_year4 = jQuery('#academic_year4').val();
    var academic_year5 = jQuery('#academic_year5').val();
    var academic_background1 = jQuery('.academic_background1').val();
    var academic_background2 = jQuery('.academic_background2').val();
    var academic_background3 = jQuery('.academic_background3').val();
    var academic_background4 = jQuery('.academic_background4').val();
    var academic_background5 = jQuery('.academic_background5').val();
    var user_name = jQuery('#user_name').val();
    var designation = jQuery('#designation').val();
    var physician_speciality = jQuery('#physician_speciality').val();
    var other_specify = jQuery('#other_specify').val();
    var academic_background = jQuery('#academic_background').val();
    var mobile_number = jQuery('#mobile_number').val();
    var billing_phone = jQuery('#billing_phone').val();
    var mo_num = jQuery('#mo_num').val();
    
    var permanent_address = jQuery('#permanent_address').val();
    //alert(user_types+'/'+user_name);
    if(mobile_number != ''){
      var ph_num = jQuery('#mobile_number').val();
    }
    else
      if(billing_phone != ''){
        var ph_num = jQuery('#billing_phone').val();
      }
    else
      if(mo_num != ''){
        var ph_num = jQuery('#mo_num').val();
      }
      else{
        var ph_num = '';
      }


    if(user_name != ''){
      //alert("Please provide user type");
      jQuery('#lvalidate').css("display", "none");
      //e.preventDefault();
    }

    if(designation != ''){
      //alert("Please provide user type");
      jQuery('#dvalidate').css("display", "none");
      e.preventDefault();
    }

    if(permanent_address != ''){
      //alert("Please provide user type");
      jQuery('#pavalidate').css("display", "none");
      e.preventDefault();
    }

    if(academic_background != ''){
      //alert("Please provide user type");
      jQuery('#abvalidate').css("display", "none");
      e.preventDefault();
    }

    if(academic_year != ''){
      //alert("Please provide user type");
      jQuery('#ayvalidate').css("display", "none");
      e.preventDefault();
    }    

    if(academic_background1 != '' && academic_year1 != ''){
      //alert("Please provide user type");
      jQuery('#ab1validate').css("display", "none");
      e.preventDefault();
    }

    if(academic_background2 != '' && academic_year2 != ''){
      //alert("Please provide user type");
      jQuery('#ab2validate').css("display", "none");
      e.preventDefault();
    }

    if(academic_background3 != '' && academic_year3 != ''){
      //alert("Please provide user type");
      jQuery('#ab3validate').css("display", "none");
      e.preventDefault();
    }

    if(academic_background4 != '' && academic_year4 != ''){
      //alert("Please provide user type");
      jQuery('#ab4validate').css("display", "none");
      e.preventDefault();
    }

    if(academic_background5 != '' && academic_year5 != ''){
      //alert("Please provide user type");
      jQuery('#ab5validate').css("display", "none");
      e.preventDefault();
    }
    
    if(user_types != ''){
      //alert("Please provide user type");
      jQuery('#utvalidate').css("display", "none");
      //jQuery('#lvalidate').css("display", "block");
      //jQuery('#dvalidate').css("display", "block");

      //e.preventDefault();
    }
    
    
    //alert(designation+'/'+permanent_address);
    //var user_type = jQuery('#user_type').val();
    //var professional_category = jQuery('#professional_category').val();

    var physician2 = jQuery('#physician2').val();
    var dietition = jQuery('#dietition').val();
    var pharmacist = jQuery('#pharmacist').val();
    var pharmacologist = jQuery('#pharmacologist').val();
    var nurse = jQuery('#nurse').val();
    var biochemist = jQuery('#biochemist').val();
    var industry2 = jQuery('#industry2').val();
    var others = jQuery('#others').val();

    //alert(physician2+'/'+dietition);

    var physicians = jQuery('#physicians').val();
    var nonphysicians = jQuery('#non-physicians').val();
    var industry = jQuery('#industry').val();


    if((physician2 != '') && $("#physician2").prop("checked") && physician_speciality != ''){
      //alert("Please provide user type");
      jQuery('#pvalidate').css("display", "none");
      //jQuery('#lvalidate').css("display", "block");
      //jQuery('#dvalidate').css("display", "block");

      //e.preventDefault();
    }
    if((others != '') && $("#others").prop("checked") && other_specify != ''){
      //alert("Please provide user type");
      jQuery('#ovalidate').css("display", "none");
      //jQuery('#lvalidate').css("display", "block");
      //jQuery('#dvalidate').css("display", "block");

      //e.preventDefault();
    }

    if(physicians != '' && $("#physicians").prop("selected") && user_country != '' && user_country != 'India'){
      user_type = physicians;
      amount = 78*200;
      var ptype = 'Physicians';
      //alert(industry);
    }
    else
      if(nonphysicians != '' && $("#non-physicians").prop("selected") && user_country != '' && user_country != 'India'){
        user_type = nonphysicians;
      amount = 78*100;
      var ptype = 'Non Physicians';
      //alert(industry);
    }
    else
      if(physicians != '' && $("#physicians").prop("selected")){
        user_type = physicians;
      //amount = 3000;
      amount = 3000;
      var ptype = 'Physicians';
      //alert(industry);
    }
    else
      if(nonphysicians != '' && $("#non-physicians").prop("selected")){
        user_type = nonphysicians;
      amount = 1500;
      var ptype = 'Non Physicians';
      //alert(industry);
    }
    else
      if(industry != '' && $("#industry").prop("selected")){
      user_type = industry;
      amount = 50000;
      var ptype = 'Industry';
      //alert(industry);
    }

    
      if((physician2 != '') && $("#physician2").prop("checked")){
      professional_category = jQuery('#physician2').val();
      jQuery('#ovalidate').css("display", "none");
    }
    else
      if((dietition != '') && $("#dietition").prop("checked")){
      professional_category = jQuery('#dietition').val();
      jQuery('#pvalidate').css("display", "none");
      jQuery('#ovalidate').css("display", "none");
    }
    else
      if((pharmacist != '') && $("#pharmacist").prop("checked")){
      professional_category = jQuery('#pharmacist').val();
      jQuery('#pvalidate').css("display", "none");
      jQuery('#ovalidate').css("display", "none");
    }
    else
      if((pharmacologist != '') && $("#pharmacologist").prop("checked")){
      professional_category = jQuery('#pharmacologist').val();
      jQuery('#pvalidate').css("display", "none");
      jQuery('#ovalidate').css("display", "none");
    }
    else
      if((nurse != '') && $("#nurse").prop("checked")){
      professional_category = jQuery('#nurse').val();
      jQuery('#pvalidate').css("display", "none");
      jQuery('#ovalidate').css("display", "none");
    }
    else
      if((biochemist != '') && $("#biochemist").prop("checked")){
      professional_category = jQuery('#biochemist').val();
      jQuery('#pvalidate').css("display", "none");
      jQuery('#ovalidate').css("display", "none");
    }
    else
      if((industry2 != '') && $("#industry2").prop("checked")){
      professional_category = jQuery('#industry2').val();
      jQuery('#pvalidate').css("display", "none");
      jQuery('#ovalidate').css("display", "none");
    }
    else
      if((others != '') && $("#others").prop("checked")){
      professional_category = jQuery('#others').val();
      jQuery('#pvalidate').css("display", "none");
    }
    // else{
    //   amount = '';
    // }

    //alert(name+amount);

    if(designation == ''){
      //alert("Please provide user type");
      jQuery('#dvalidate').css("display", "block");
      e.preventDefault();
    }
    else
    if(permanent_address == ''){
      //alert("Please provide user type");
      jQuery('#pavalidate').css("display", "block");
      //jQuery('#lvalidate').css("display", "block");
      //jQuery('#dvalidate').css("display", "block");

      e.preventDefault();
    }else
    if(user_types == ''){
      //alert("Please provide user type");
      jQuery('#utvalidate').css("display", "block");
      //jQuery('#lvalidate').css("display", "block");
      //jQuery('#dvalidate').css("display", "block");

      e.preventDefault();
    }
    else
    if(academic_background == ''){
      //alert("Please provide user type");
      jQuery('#abvalidate').css("display", "block");
      //jQuery('#lvalidate').css("display", "block");
      //jQuery('#dvalidate').css("display", "block");

      e.preventDefault();
    }else
    if(academic_year == ''){
      //alert("Please provide user type");
      jQuery('#ayvalidate').css("display", "block");
      //jQuery('#lvalidate').css("display", "block");
      //jQuery('#dvalidate').css("display", "block");

      e.preventDefault();
    }else
    if((academic_background1 != '' && academic_year1 == '') || (academic_background1 == '' && academic_year1 != '') || (academic_background1 == '' && academic_year1 == '')){
      //alert("Please provide user type");
      jQuery('#ab1validate').css("display", "block");
      //jQuery('#lvalidate').css("display", "block");
      //jQuery('#dvalidate').css("display", "block");

      e.preventDefault();
    }
    else
    if((academic_background2 != '' && academic_year2 == '') || (academic_background2 == '' && academic_year2 != '') || (academic_background2 == '' && academic_year2 == '')){
      //alert("Please provide user type");
      jQuery('#ab2validate').css("display", "block");
      //jQuery('#lvalidate').css("display", "block");
      //jQuery('#dvalidate').css("display", "block");

      e.preventDefault();
    }else
    if((academic_background3 != '' && academic_year3 == '') || (academic_background3 == '' && academic_year3 != '') || (academic_background3 == '' && academic_year3 == '')){
      //alert("Please provide user type");
      jQuery('#ab3validate').css("display", "block");
      //jQuery('#lvalidate').css("display", "block");
      //jQuery('#dvalidate').css("display", "block");

      e.preventDefault();
    }else
    if((academic_background4 != '' && academic_year4 == '') || (academic_background4 == '' && academic_year2 != '') || (academic_background4 == '' && academic_year4 == '')){
      //alert("Please provide user type");
      jQuery('#ab4validate').css("display", "block");
      //jQuery('#lvalidate').css("display", "block");
      //jQuery('#dvalidate').css("display", "block");

      e.preventDefault();
    }else
    if((academic_background5 != '' && academic_year5 == '') || (academic_background5 == '' && academic_year5 != '') || (academic_background5 == '' && academic_year5 == '')){
      //alert("Please provide user type");
      jQuery('#ab5validate').css("display", "block");
      //jQuery('#lvalidate').css("display", "block");
      //jQuery('#dvalidate').css("display", "block");

      e.preventDefault();
    }
    else
    if((physician2 != '') && $("#physician2").prop("checked") && physician_speciality == ''){
    //alert("Please provide user type");
      jQuery('#pvalidate').css("display", "block");
      //jQuery('#lvalidate').css("display", "block");
      //jQuery('#dvalidate').css("display", "block");

      e.preventDefault();
    }else
    if((others != '') && $("#others").prop("checked") && other_specify == ''){

      //alert("Please provide user type");
      jQuery('#ovalidate').css("display", "block");
      //jQuery('#lvalidate').css("display", "block");
      //jQuery('#dvalidate').css("display", "block");

      e.preventDefault();

    }
    else
    if(user_name == ''){
      //alert("Please provide user type");
      jQuery('#lvalidate').css("display", "block");
      e.preventDefault();
    }
    else{

    var data = {
    'action': 'my_action_membership',
    'academic_background': academic_background,
    'academic_background1': academic_background1,
    'academic_background2': academic_background2,
    'academic_background3': academic_background3,
    'academic_background4': academic_background4,
    'academic_background5': academic_background5,
    'user_email': user_email,
    'user_type': user_type,
    'academic_year': academic_year,
    'academic_year1': academic_year1,
    'academic_year2': academic_year2,
    'academic_year3': academic_year3,
    'academic_year4': academic_year4,
    'academic_year5': academic_year5,
    'professional_category': professional_category,
    'designation': designation,
    'physician_speciality': physician_speciality,
    'other_specify': other_specify,
    'permanent_address': permanent_address
    //'academic_background': academic_background
    };

    var options = {
    //"key": "rzp_test_gGMHBbRj9sbvgr",
    "key": "rzp_live_qcXjzYsxJf9BxR",
    //"amount": 5000,
    "amount": amount*100,
    "currency": "INR",
    "name": "Membership Registration",
    "description": "Ispen Membership ( "+ ptype +" )",
    "image": "https://ispen.org.in/wp-content/uploads/2022/04/logo3.jpg",
    //"order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
    // alert(response.razorpay_payment_id);
    // alert(response.razorpay_order_id);
    // alert(response.razorpay_signature)
      //console.log(response);

    //alert("Done");
    jQuery.post(ajaxurl, data, function(response) {
      //alert("Test");
      
      location.href = "https://ispen.org.in/membership-form/"
    });

    },
    "prefill": {
    "name": user_name,
    "email": user_email,
    "contact": ph_num
    },
    "notes": {
    "address": "Razorpay Corporate Office"
    },
    "theme": {
    "color": "#3399cc"
    }
    };
  }
    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function (response){
    alert(response.error.code);
    alert(response.error.description);
    alert(response.error.source);
    alert(response.error.step);
    alert(response.error.reason);
    alert(response.error.metadata.order_id);
    alert(response.error.metadata.payment_id);
    });
    //document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
    //}
  });
  });
</script>


<script>
$(document).ready(function(){
  var i=1;
  var j=2;
  $('.plusbtn').click(function() {
    jQuery('.minusbtn').css("display", "block");
  //alert(i);
$("#test").append('<span><div class="form-group"><label class="control-label col-sm-5" for="amount"></label><div class="col-sm-4"><input required type="text" class="form-control academic_background' + i + '" name="academic_background' + i + '" placeholder="Degrees/Diplomas"></div><div class="col-sm-3"><select required type="text"  class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="academic_year' + i + '" name="academic_year' + i + '"><option value="">Select Academic Year</option><?php foreach($year as $key => $val): ?>
                  <option value="<?php echo $key; ?>"><?php echo $val; ?></option><?php endforeach; ?>
                </select></div></div><div style="display: none;" id="ab' + i + 'validate" class="form-group"><label class="control-label col-sm-5" for="amount"></label><div class="col-sm-7"><p style="color:red">Both the field are required</p></div></div></span>');
i++;j++;
  });
$('.minusbtn').click(function() {
if($("#test span").length > 1)
  {
    $("#test span:last-child").remove();
  }
i--;
if($("#test span").length == 1)
  {
    jQuery('.minusbtn').css("display", "none");
  }
});
});

</script>

<?php get_footer(); ?>