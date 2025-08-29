<?php 
    session_start();
?>
<?php //echo "test";
//opcache_reset(); ?>
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="img/indoco-fav1.png">
    <!-- Google tag (gtag.js) --> 
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0ENXS6GH2J"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-0ENXS6GH2J'); 
    </script>
</head>
<body>
    <section class="event-section">
        <div class="event-section-div">
            <div class="event-left">
                <div class="event-background">
                    <div class="background-overlay">
                    <div class="box">
                        <?php $landing_img = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."img/ALEMBIC_May31.png"; ?>
                        <!-- <img src="img/drl2-landing.png"> -->
                        <img src="<?php echo $landing_img; ?>">
                    </div>
                        
                    
                    </div>
                </div>
            </div>
            <div class="event-right">
                
            
                <?php if( isset($_SESSION['name'] )  && isset( $_SESSION['email']) ) { ?>
                    <div class='logout_container text-right'>
                        <button id='cust_logout'>Logout </button>
                    </div>
                    <?php echo "Hello " . $_SESSION["name"] . ",";?>
                    <div class="login_email" style="display: inline;color:gray;">
                        <?php  echo "<br>(". $_SESSION["email"] .")"; ?>
                    </div>
                    <?php $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."view/";?>
                    <div style="display: block;margin: 10px 0;"><a href="<?php echo $actual_link;?>">Go to Lecture</a></div>
                    <div class='response_text' id='response_text'></div>
                <?php }else{ ?>
                    <div class="register-section">
                        <h6 style="font-weight: 400;font-size: 18px;text-align: center;margin: 0.5rem 0 1.5rem;">
                            Already registered?<button type="button" class="btn btn-link" style="font-weight: 500;" id="signInLink">Sign In.</button>
                        </h6>
                        <h6 style="margin: 0.5rem 0 1rem;font-size: 18px;font-weight: 600;text-align: center;">Registration form</h6>
                        <!-- Registration form -->
                        <form id="frm_registration">
                            <div class="form-group">
                                <label>Doctor Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="doctorname" id="cust_doctorname" value = "" required>
                                <div class="err doctorname_error"></div>
                            </div>

                            <div class="mb-2">
                                    <label class="form-label">Mobile number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder=""  name="mobile" id="cust_mobile" value = "" required>
                                    <div class="err mobile_error"></div>
                            </div>

                            <div class="form-group">
                                <label>Email ID<span class=" text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="cust_reg_email" value = "" required>
                                <div class="err reg_email_error"></div>
                            </div>

                            
                            <div class="form-group">
                                <label>State <span class="text-danger">*</span></label>
                                <select class="custom-select" name="state" id="cust_state">
                                    <option value="">-- Select state  --</option> 
                                    <option value="andaman &amp; nicobar">Andaman &amp; nicobar</option>
                                    <option value="andhra pradesh">Andhra pradesh</option>
                                    <option value="arunachal pradesh">Arunachal pradesh</option>
                                    <option value="assam">Assam</option>
                                    <option value="bihar">Bihar</option>
                                    <option value="chandigarh">Chandigarh</option>
                                    <option value="chattisgarh">Chattisgarh</option>
                                    <option value="dadra &amp; nagar">Dadra &amp; nagar</option>
                                    <option value="daman &amp; diu">Daman &amp; diu</option>
                                    <option value="delhi">Delhi</option>
                                    <option value="goa">Goa</option>
                                    <option value="gujarat">Gujarat</option>
                                    <option value="haryana">Haryana</option>
                                    <option value="himachal pradesh">Himachal pradesh</option>
                                    <option value="jammu &amp; kashmir">Jammu &amp; kashmir</option>
                                    <option value="jharkhand">Jharkhand</option>
                                    <option value="karnataka">Karnataka</option>
                                    <option value="kerala">Kerala</option>
                                    <option value="lakshdweep">Lakshdweep</option>
                                    <option value="madhya pradesh">Madhya pradesh</option>
                                    <option value="maharashtra">Maharashtra</option>
                                    <option value="manipur">Manipur</option>
                                    <option value="meghalaya">Meghalaya</option>
                                    <option value="mizoram">Mizoram</option>
                                    <option value="nagaland">Nagaland</option>
                                    <option value="orissa">Orissa</option>
                                    <option value="other">Other</option>
                                    <option value="pondichery">Pondichery</option>
                                    <option value="punjab">Punjab</option>
                                    <option value="rajasthan">Rajasthan</option>
                                    <option value="sikkim">Sikkim</option>
                                    <option value="tamil nadu">Tamil nadu</option>
                                    <option value="telangana">Telangana</option>
                                    <option value="tripura">Tripura</option>
                                    <option value="uttar pradesh">Uttar pradesh</option>
                                    <option value="uttarakhand">Uttarakhand</option>
                                    <option value="west bengal">West bengal</option>
                                </select>
                                <div class="err state_error"></div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder=""  name="city" id="cust_city" value = "" required>
                                <div class="err city_error"></div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Pin Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder=""  name="pin_code" id="cust_pin_code" value = "">
                                <div class="err pin_code_error"></div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Employee SAP Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder=""  name="employee_sap_code" id="cust_employee_sap_code" value = "">
                                <div class="err employee_sap_code_error"></div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">HQ<span class="text-danger">*</span></label>
                                <input disabled type="text" class="form-control" placeholder=""  name="hq" id="cust_hq" value = "">
                                <div class="err hq_error"></div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Level<span class="text-danger">*</span></label>
                                <input disabled type="text" class="form-control" placeholder=""  name="level" id="cust_level" value = "">
                                <div class="err level_error"></div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Zone<span class="text-danger">*</span></label>
                                <input disabled type="text" class="form-control" placeholder=""  name="zone" id="cust_zone" value = "">
                                <div class="err zone_error"></div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Region<span class="text-danger">*</span></label>
                                <input disabled type="text" class="form-control" placeholder=""  name="region" id="cust_region" value = "">
                                <div class="err region_error"></div>
                            </div>

                            
                            
                            
                            <div class="form-group"><button type="submit" class="btn btn-danger btn-block">Register</button></div>
                            <div id="reg_ajxRes"></div>
                        </form>
                        <strong>For already registered members, Kindly login 2 with your Email ID.</strong>
                    </div>
                    <div class="login-section d-none">
                        <h6 style="font-weight: 400;font-size: 18px;text-align: center;margin: 0.5rem 0 1rem;">
                            First time here? <button type="button" class="btn btn-link" style="font-weight: 500;" id="registerLink">Create an Account</button>
                        </h6>
                        <h6 style="margin: 0.5rem 0 1rem;font-size: 18px;font-weight: 600;text-align: center;">Sign In</h6>
                        <form id="frm_login">
                            <div class="form-group">
                                <label>Email <span class="text-muted text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="cust_login_email" value = "" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-block">Login</button>
                            </div>
                            <div id="login_ajxRes"></div>
                            <div id="countdown"></div>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- <div class="sponser-section ">
            <div class="row" style="margin:0">
                <div class="column" >
                    <img src="https://cmeworld-wp-uploads.s3.ap-south-1.amazonaws.com/wp-content/uploads/2023/05/05214453/MACLEODS-1536x436.png"/>
                </div>
                <div class="column" >
                    <img src="https://cmeworld-wp-uploads.s3.ap-south-1.amazonaws.com/wp-content/uploads/2023/08/31101104/1-08.png"/>
                </div>
                <div class="column" >
                    <img src="https://cmeworld-wp-uploads.s3.ap-south-1.amazonaws.com/wp-content/uploads/2023/08/31101118/1-09.png"/>
                </div>
            </div>
        </div> -->
        
    </section>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>