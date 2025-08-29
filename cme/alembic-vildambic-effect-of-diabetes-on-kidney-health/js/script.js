$(() => {
    //set this parameters
    var projectname = "alembic-vildambic-effect-of-diabetes-on-kidney-health";
    var openingtime = "2023-6-29 00:00:00";

    onload_default_setting();
    var valid_mobile_patter = new RegExp("^[0-9]{10}$");
    var valid_email_patter = new RegExp("^([a-zA-Z0-9_.+-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$");
    var valid_referral_patter = new RegExp("^[A-Za-z0-9]+$");
    var valid_referral_number_patter = '^[0-9]+$';
    //var numberRegex = '/^\d+$/';

    if (window.location.protocol == 'http:') {                             
        window.location.href = window.location.href.replace( 'http:', 'https:');
    }

    //hide go to lecture link on login page
    if( new Date(srb_get_today()) >= new Date( openingtime ) ){
        $('#go-to-lecture-link').removeClass('d-none');
    }else{
        $('#go-to-lecture-link').addClass('d-none');
    }
    $('#lecture_login_link').attr('href','https://'+ window.location.host + "/" + projectname);
    //console.log(window.location);

    $('#signInLink').on('click', () => {
        $('.login-section').removeClass('d-none');
        $('.register-section').addClass('d-none');
    });
    $('#registerLink').on('click', () => {
        $('.login-section').addClass('d-none');
        $('.register-section').removeClass('d-none');
    });

    // const swiper = new Swiper('.swiper', {
    //     direction: 'horizontal',
    //     loop: true,
    //     slidesPerView: 1,
    //     spaceBetween: 10,
    //     autoplay: { delay: 2000, },
    //     pagination: { el: '.swiper-pagination', }
    // });

    /**
     * Ajax call for registration 
     * @author Saurabh Raut
     *   
     */

    // jQuery('#cust_specialty').on('change', function(){
    //    // alert(this.value);
    //   if (this.value == "others"){
    //     jQuery('#cust_specialty_other').show();
    //     jQuery('#cust_specialty_other').attr('required',true);
    //   }else{
    //     jQuery('#cust_specialty_other').hide();
    //     jQuery('#cust_specialty_other').attr('required',false);
    //   }
    // });

    // jQuery('#cust_pir').on('change', function(){
    //   // alert(this.value);
    //   if (this.value == "others"){
    //     jQuery('#cust_pir_other').show();
    //     jQuery('#cust_pir_other').attr('required',true);
    //   }else{
    //     jQuery('#cust_pir_other').hide();
    //     jQuery('#cust_pir_other').attr('required',false);
    //   }
    // });

    $('#frm_registration').on( 'submit', function (e) {
        
        e.preventDefault();
        //var form_action = $("#frm_cust_registration").attr("action");
        var doctorname = $('#cust_doctorname').val();
        var mobile = $('#cust_mobile').val();
        var reg_email = $('#cust_reg_email').val();
        var pin_code = $('#cust_pin_code').val();
        var state = $('#cust_state').val();
        var city = $('#cust_city').val();
        var employee_sap_code = $('#cust_employee_sap_code').val();
        var hq = $('#cust_hq').val();
        var level = $('#cust_level').val();
        var zone = $('#cust_zone').val();
        var region = $('#cust_region').val();
        
        
        //alert(doctortitle+','+doctorname+','+mobile+','+reg_email+','+reg_employee_id+','+country+','+state+','+speciality+','+city+','+pin_code);
        
        var flag_reg_email  = true;
        var flag_doctorname = true;
        var flag_mobile     = true;
        var flag_state      = true;
        var flag_city      = true;
        var flag_pin_code   = true;
        //var flag_registration_number   = true;
        var flag_employee_sap_code   = true;
        var flag_hq   = true;
        var flag_level   = true;
        var flag_zone   = true;
        var flag_region   = true;

       
        //Full name validation
        if (doctorname == "") {
            jQuery(".doctorname_error").html("Please provide your full name");
            flag_doctorname = true;
        } else {
            jQuery(".doctorname_error").html("");
            flag_doctorname = false;
        }

        //qualification
        // if (qualification == "") {
        //     jQuery(".reg_qualification_error").html("Please provide qualification");
        //     flag_qualification = true;
        // } else {
        //     jQuery(".reg_qualification_error").html("");
        //     flag_qualification = false;
        // }

        //Email validation
        if (reg_email == "") {
            jQuery(".reg_email_error").html("Please provide your email id");
            flag_reg_email = true;
        } else if (!valid_email_patter.test(reg_email)) {
            jQuery(".reg_email_error").html("Please provide valid email");
            flag_reg_email = true;
        } else {
            jQuery(".reg_email_error").html("");
            flag_reg_email = false;
        }


        if (mobile == "") {
            jQuery(".mobile_error").html("Please provide your mobile number");
            flag_mobile = true;
        } else if (!valid_mobile_patter.test(mobile)) {
            jQuery(".mobile_error").html("Please provide 10 digit number");
            flag_mobile = true;
        } else {
            jQuery(".mobile_error").html("");
            flag_mobile = false;
        }

        //employee_sap_code
        if (employee_sap_code == "") {
            jQuery(".employee_sap_code_error").html("Please provide Employee SAP Code");
            flag_employee_sap_code = true;
        } else {
            jQuery(".employee_sap_code_error").html("");
            flag_employee_sap_code = false;
        }

        
        //state
        if (state == "") {
            jQuery(".state_error").html("Please provide state");
            flag_state = true;
        } else {
            jQuery(".state_error").html("");
            flag_state = false;
        }

        //city
        if (city == "") {
            jQuery(".city_error").html("Please provide city name");
            flag_city = true;
        } else {
            jQuery(".city_error").html("");
            flag_city = false;
        }

        //pincode
        if (pin_code == "") {
            jQuery(".pin_code_error").html("Please provide Pincode");
            flag_pin_code = true;
        } else {
            jQuery(".pin_code_error").html("");
            flag_pin_code = false;
        }

        //zone
        if (hq == "") {
            jQuery(".hq_error").html("Please provide hq");
            flag_hq = true;
        } else {
            jQuery(".hq_error").html("");
            flag_hq = false;
        }

        //zone
        if (level == "") {
            jQuery(".level_error").html("Please provide level");
            flag_level = true;
        } else {
            jQuery(".level_error").html("");
            flag_level = false;
        }

        //zone
        if (zone == "") {
            jQuery(".zone_error").html("Please provide zone");
            flag_zone = true;
        } else {
            jQuery(".zone_error").html("");
            flag_zone = false;
        }

        //region
        if (region == "") {
            jQuery(".region_error").html("Please provide region");
            flag_region = true;
        } else {
            jQuery(".region_error").html("");
            flag_region = false;
        }

        

        //state
        // if (employee_code == "") {
        //     jQuery(".employee_code_error").html("Please provide employee code");
        //     flag_employee_code = true;
        // }
        // else if (!valid_referral_number_patter.test(employee_code)) {
        //     jQuery(".employee_code_error").html("Only integer allowed");
        //     flag_employee_code = true;
        // } 
        // else {
        //     jQuery(".employee_code_error").html("");
        //     flag_employee_code = false;
        // }

        


        //console.log(flag_reg_email , flag_doctorname , flag_mobile , flag_country , flag_employee_id , flag_state,doctortitle);
        //alert(flag_reg_email+','+flag_doctorname+','+flag_mobile+','+flag_country+','+flag_employee_id+','+flag_state+','+flag_speciality+','+flag_city+','+flag_pin_code);

        if ( !flag_reg_email && !flag_doctorname && !flag_state && !flag_mobile && !flag_city && !flag_employee_sap_code && !flag_pin_code && !flag_hq && !flag_level && !flag_zone && !flag_region ){
        //alert("33");
        $.ajax({
            url: "../" + projectname + "/inc/user-registration.php",
            type:'POST',
            dataType: 'json',
            data:{
                name                : doctorname,
                email               : reg_email,
                city                : city,
                mobile              : mobile,
                state               : state,
                pin_code            : pin_code,
                employee_sap_code   : employee_sap_code,
                hq                  : hq,
                level               : level,
                zone                : zone,
                region              : region,
                created_date        : srb_get_today()
            },
            success:function(r){
                //console.log(r);
                if ( r == 1 ){
                    // if( new Date(srb_get_today()) >= new Date( openingtime ) ){
                        $('#reg_ajxRes').html('<span class="green">Registered succesfully!! Please wait you will be redirected.</span>');
                        
                        setTimeout(function(){
                            window.location.assign(window.location.href+'view/');
                        }, 3000);
                    // }else{
                    //     $('#reg_ajxRes').html('<span class="green">Registered succesfully!! Please login on '+ openingtime +'</span>');
                    //     setTimeout(function(){
                    //         window.location.reload(1);
                    //     }, 3000);

                    // }
                }else if ( r == 0 ){
                    $('#reg_ajxRes').html('<span class="red">This emailid is already registered with us. Please use same emailid to Sign in</span>');
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                //console.log(jqXHR, textStatus, errorThrown);
            }
        });//end of ajax call
    }
    });//end of registration form submit event 

    // $('#frm_login').on( 'load', function (e) {
    //     $('#vc-user-full-name').val( 'adadas' );
    //     // $('#vc-user-email').val();

    // });
    $('#frm_login').on( 'submit', function (e) {
        ////console.log(srb_get_today());
        e.preventDefault();
        var login_email = $('#cust_login_email').val();

        
        $.ajax({
            url:  "../" + projectname + "/inc/user-login.php",
            type:'POST',
            dataType: 'json',
            xhrFields: {
                withCredentials: true
             },
            data:{
                email           : login_email,
                created_date    : srb_get_today()
            },
            success:function(r){
                //console.log(r);
                if(!r){
                    $('#login_ajxRes').html('<span class="red">This Email ID is not registered with us. Kindly click on create an account and fill the registration form.</span>');
                    $('#cust_reg_email').val(login_email);
                }else{
                    // if( new Date(srb_get_today()) >= new Date( openingtime ) ){
                        $('#login_ajxRes').html('<span class="green">Login successful. Please wait you will be redirected</span>');
                        
                        setTimeout(function(){
                            window.location.assign(window.location.href+'view/');
                        }, 3000);
                    // }else{
                    //     $('#login_ajxRes').html('<span class="green">Login succesful. Please visit on '+openingtime+'</span>');

                    //     setTimeout(function(){
                    //         window.location.reload(1);
                    //     }, 3000);
                    // }
                }
            },
            error:function(jqXHR, textStatus, errorThrown){
                //console.log(jqXHR, textStatus, errorThrown);
            }
        });//end of ajax call
    });//end of registration form submit event 



    /**
     * Ajax call for qna 
     * @author Saurabh Raut
     *   
     */

    // $('#frm-qna').on( 'submit', function (e) {
    //     // alert("hi");
    //     e.preventDefault();

    //     var fullname        = $('#vc-user-full-name').val();
    //     var email           = $('#vc-user-email').val();
    //     var location        = $('#vc-user-location').val();
    //     var ask_question    = $('#vc-user-ask-question').val();
    //     var vc_pageurl      = $('#vc-pageurl').val();
        
    //     //alert("Hi");
    //     $.ajax({
    //         url: "../vc-qna-update.php",
    //         type:'POST',
    //         dataType: 'json',
    //         data:{
    //             fullname        : fullname,
    //             email           : email,
    //             location        : location,
    //             ask_question    : ask_question,
    //             page            : vc_pageurl,
    //             created_date    : srb_get_today()
    //         },
    //         success:function(r){
    //             //console.log(r);
    //             if(r){
    //                 $('.responce_msg').html('<span style="color:green">Thank you for submission.</space>');
    //             }
    //         }
    //     });//end of ajax call
    // });//end of qna form submit event 


    //$('#doctorecode').on('blur', function() {
    $('#cust_employee_sap_code').keyup(function(){
        const sap_code = $(this).val().trim();

        //alert(sap_code);

        if (sap_code) {
                $.ajax({
                    url: "../" + projectname + "/inc/fetch_sapcode_info.php",
                    type: 'GET',
                    data: { sap_code: sap_code },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#cust_hq').val(response.data.hq).prop('disabled', false);
                            $('#cust_level').val(response.data.level).prop('disabled', false);
                            $('#cust_zone').val(response.data.zone).prop('disabled', false);
                            $('#cust_region').val(response.data.region).prop('disabled', false);

                            $('#cust_hq').css({'pointer-events':'none' , 'background-color':'#e5e5e5'});
                            $('#cust_level').css({'pointer-events':'none' , 'background-color':'#e5e5e5'});
                            $('#cust_zone').css({'pointer-events':'none' , 'background-color':'#e5e5e5'});
                            $('#cust_region').css({'pointer-events':'none' , 'background-color':'#e5e5e5'});
                        } else {
                            console.log(response.success);
                            $('#cust_hq').val('').prop('disabled', true);
                            $('#cust_level').val('').prop('disabled', true);
                            $('#cust_zone').val('').prop('disabled', true);
                            $('#cust_region').val('').prop('disabled', true);
                            $('.employee_sap_code_error').text('SAP code not found.').show();
                        }
                    },
                    error: function() {
                        $('.employee_sap_code_error').text('Error fetching data. Please try again.').show();
                    }
                });
            } else {
                $('#cust_hq').val('').prop('disabled', true);
                $('#cust_level').val('').prop('disabled', true);
                $('#cust_zone').val('').prop('disabled', true);
                $('#cust_region').val('').prop('disabled', true);
                $('.employee_sap_code_error').text('').hide(); // Clear any error message
        }

        
    });

    jQuery("#form2").submit(function(e){
        
        e.preventDefault();
        // var form2_ask_question =  jQuery("#form2_ask_question").val();

        jQuery.ajax({
            url:"https://docs.google.com/forms/u/0/d/e/1FAIpQLSfp6V_cxK9V1kqW0stOTyuf4Q6mVhHxAS-_Ob1neLwSdvsO6Q/formResponse",
            data:{
                //"entry.1863727820":$('#useremail').val(),
                "entry.1560975139":$('#username').val(),
                "entry.296790761":$('#usercity').val(),
                "entry.1116069121":$('#form2_ask_question').val()

            },
            type: "POST",
            datatype: "xml",
            statusCode: {
                0: function () {
                   //console.log("success code : 0");
                   jQuery(".responce_msg").css('color','green');
                   jQuery(".responce_msg").html("Thank you !! Your Question is submitted successfully");
                   jQuery("#form2_ask_question").val("");
                    jQuery(".responce_msg").fadeIn('fast').delay(2000).fadeOut('fast');

                },
                200: function () {
                    //console.log("success code : 200");
                    jQuery(".responce_msg").css('color','green');
                    jQuery(".responce_msg").html("Thank you !! Your Question is submitted successfully");
                    jQuery("#form2_ask_question").val("");
                    jQuery(".responce_msg").fadeIn('fast').delay(2000).fadeOut('fast');
                }
            }//statuscode
        });//ajjax
  
    return "Are you sure you want to exit";
    });//form2

    jQuery("#form-2").submit(function(e){
        
        e.preventDefault();
        // var form2_ask_question =  jQuery("#form2_ask_question").val();

        jQuery.ajax({
            url:"https://docs.google.com/forms/u/0/d/e/1FAIpQLSd3EjdXPEDle86TudnbHKBkQt0jtrY9J8fDF9MBL9eRumtzhA/formResponse",
            data:{
                "entry.1560975139":$('#username').val(),
                "entry.296790761":$('#usercity').val(),
                "entry.1116069121":$('#form2_ask_question').val()

            },
            type: "POST",
            datatype: "xml",
            statusCode: {
                0: function () {
                   //console.log("success code : 0");
                   jQuery(".responce_msg").css('color','green');
                   jQuery(".responce_msg").html("Thank you !! Your Question is submitted successfully");
                   jQuery("#form2_ask_question").val("");
                    jQuery(".responce_msg").fadeIn('fast').delay(2000).fadeOut('fast');

                },
                200: function () {
                    //console.log("success code : 200");
                    jQuery(".responce_msg").css('color','green');
                    jQuery(".responce_msg").html("Thank you !! Your Question is submitted successfully");
                    jQuery("#form2_ask_question").val("");
                    jQuery(".responce_msg").fadeIn('fast').delay(2000).fadeOut('fast');
                }
            }//statuscode
        });//ajjax
  
    return "Are you sure you want to exit";
    });//form2


    // form3

    jQuery("#form-3").submit(function(e){
        
        e.preventDefault();
        // var form2_ask_question =  jQuery("#form2_ask_question").val();

        jQuery.ajax({
            url:"https://docs.google.com/forms/u/0/d/e/1FAIpQLSfBEPSg38SXWK4p_ZJMPG3bwHPSdwhwjmJxStcjftxFL8tqtA/formResponse",
            data:{
                "entry.1560975139":$('#username').val(),
                "entry.296790761":$('#usercity').val(),
                "entry.1116069121":$('#form2_ask_question').val()

            },
            type: "POST",
            datatype: "xml",
            statusCode: {
                0: function () {
                   //console.log("success code : 0");
                   jQuery(".responce_msg").css('color','green');
                   jQuery(".responce_msg").html("Thank you !! Your Question is submitted successfully");
                   jQuery("#form2_ask_question").val("");
                    jQuery(".responce_msg").fadeIn('fast').delay(2000).fadeOut('fast');

                },
                200: function () {
                    //console.log("success code : 200");
                    jQuery(".responce_msg").css('color','green');
                    jQuery(".responce_msg").html("Thank you !! Your Question is submitted successfully");
                    jQuery("#form2_ask_question").val("");
                    jQuery(".responce_msg").fadeIn('fast').delay(2000).fadeOut('fast');
                }
            }//statuscode
        });//ajjax
  
    return "Are you sure you want to exit";
    });//form2




    $('#cust_logout').on('click', function (){
        $.ajax({
            url:  "../" + projectname + "/inc/user-logout.php",
            type:'POST',            
            success:function(){
                location.reload(true);
            },
            error:function(jqXHR, textStatus, errorThrown){
                //console.log(jqXHR, textStatus, errorThrown);
            }
        });//end of ajax call


    });

    $('#cust_lecture_logout').on('click', function (){
        $.ajax({
            url:  "../inc/user-logout.php",
            type:'POST', 
            //dataType: 'json',
            data:{
                
                created_date    : srb_get_today()
            },           
            success:function(){
                //alert('1');
                location.href= "https://" + window.location.host + "/" + projectname;
            },
            error:function(jqXHR, textStatus, errorThrown){
                //alert('2');
                //console.log(jqXHR, textStatus, errorThrown);
            }
        });//end of ajax call


    });

    function onload_default_setting(){
      // jQuery('.spinner').hide();
      
      // jQuery('#login_spinner').hide();
      // jQuery('#reg_spinner').hide();
      // jQuery('#20220915_specialty_other').hide();
      // jQuery('#reg_loadingImage').hide();
      // jQuery('#20220915_specialty_other').attr('required',false);

    //   jQuery('#cust_specialty_other').hide();
    //   jQuery('#cust_specialty_other').attr('required',false);

      // jQuery('#20220915_pir_other').hide();
      // jQuery('#20220915_pir_other').attr('required',false);

    //   jQuery('#cust_pir_other').hide();
    //   jQuery('#cust_pir_other').attr('required',false);

      // jQuery("#wrapp_macleods_register").hide();
    }


    function srb_get_today() {
      const client_today = new Date();
      var date =
        client_today.getFullYear() +
        "-" +
        (client_today.getMonth() + 1) +
        "-" +
        client_today.getDate();
      var time =
        client_today.getHours() +
        ":" +
        client_today.getMinutes() +
        ":" +
        client_today.getSeconds();
      var dateTime = date + " " + time;
      return dateTime;
    }

    // function srb_reload_page(ms){
    //     setTimeout(function () {
    //         location.reload(true);
    //     }, ms);
    // }

    /**
     * End of code block 
     * @author Saurabh Raut
     */

}); //end of document.ready

// let country = `
//     `;
// $('#cust_country').html(country);