(function ($) {
  $(document).ready(function () {
    //
    $(".menu-item-object-signout_openedx").click(function () {
      //alert('out');
    });
    //Cache.delete();
    $("input:radio[name=filter_radio]")
      .filter("[value=all]")
      .prop("checked", true);

    $(".container.course_list #all").show();
    $(".container.course_list #courses").hide();
    $(".container.course_list #lectures").hide();

    $("input[name='filter_radio']").click(function () {
      var test = $(this).val();
      //alert(test);
      if (test === "all") {
        $(".container.course_list #all").show();
        $(".container.course_list #courses").hide();
        $(".container.course_list #lectures").hide();
      } else if (test === "courses") {
        $(".container.course_list #all").hide();
        $(".container.course_list #courses").show();
        $(".container.course_list #lectures").hide();
      } else {
        $(".container.course_list #all").hide();
        $(".container.course_list #courses").hide();
        $(".container.course_list #lectures").show();
      }
    });

    $("#doctor_name_list").on("change", function (e) {
      // alert("Hi");
      var optionSelected = $("option:selected", this);
      var valueSelected = this.value;
      //console.log (valueSelected);

      //define ajax data parameter
      var parameters = {
        action: "srb_ajax_get_doctor_email",
        doctor_username: valueSelected,
        nonce: ajax_param.nonce,
      };
      ////console.log(parameters);
      //calling ajax for requesting course data
      jQuery.ajax({
        type: "POST",
        url: ajax_param.ajaxurl,
        data: parameters,
        //dataType: "json",
        success: function (response) {
          //console.log(response);

          $("#doctor_email").val(response);
        }, // end of success
      }); // end of ajax call
    });


    // $("._multiselect").change(function(){
    // });

    let input;
    let user_input_type;
    let user_input_type_value;
    let user_id;
    let user_login;
    //login form submit
    $("#me_login").submit(function (e) {
      e.preventDefault();
      input = $("#email_mobile").val();
      // if ( !isEmail(input) || !isMobile(input) ){
      //     $("#me_responce").html("Not Valid input");
      //     return false;
      // }
      //alert(input);

      var parameters = {
        action: "srb_ajax_login",
        input: input,
        nonce: ajax_param.nonce,
      };
      //console.log (parameters);
      jQuery.ajax({
        type: "POST",
        url: ajax_param.ajaxurl,
        data: parameters,
        
        beforeSend: function(){
        $('#loadingImage').show();
        $(".btn_mobile_login").hide();
        },
        success: function (response) {
          let response_json = $.parseJSON(response);
          //console.log( response_json );
          // //console.log( response_json.Status );
          // //console.log( response_json.data.user_entered_input_type );
          user_id = response_json.uID;
          user_login = response_json.uLogin;
          user_input_type = response_json.input_type;
          user_input_type_value = response_json.input_type_value;

          $("#me_responce").html(response_json.Description);
          if (response_json.Status == 0) {
            $("#me_login").css("display", "none");
            $("#me_otp").css("display", "block");
            countdown(2, 00);
          }
          ////console.log( jQuery.parseJSON( response ).data );
        }, //success end
      }); //ajax end
    }); //submit end

    $("#me_otp").submit(function (e) {
      e.preventDefault();
      let input_OTP = $("#OTP_area").val();
      //console.log (input_OTP);

      var parameters = {
        action: "srb_ajax_verify_otp",
        input_OTP: input_OTP,
        //'input'                 : input,
        user_id: user_id,
        user_login: user_login,
        user_input_type: user_input_type,
        user_input_type_value: user_input_type_value,
        nonce: ajax_param.nonce,
      };
      //console.log (parameters);
      jQuery.ajax({
        type: "POST",
        url: ajax_param.ajaxurl,
        data: parameters,
        success: function (response) {
          let response_json = $.parseJSON(response);
          $("#me_responce").html(response_json.Description);
          //console.log( response_json );
          if (response_json.Status == 0) {
            window.location.href = response_json.redirect_url;
          }
        }, //success end
      }); //ajax end
    });

    $("#frm-survey").submit(function (e) {
      e.preventDefault();
      ////console.log ($('#frm-survey').serialize() );

      var isQuestion_1 = validate_groupOfRadiobtn($("input[name=Question_1]"));

      if (!isQuestion_1) {
        //console.log( isQuestion_1 );
        $(".err_Question_1").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_1").html("");
      }

      var isQuestion_2 = validate_groupOfRadiobtn($("input[name=Question_2]"));

      if (!isQuestion_2) {
        //console.log( isQuestion_2 );
        $(".err_Question_2").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_2").html("");
      }


      var isQuestion_3 = validate_groupOfRadiobtn($("input[name=Question_3]"));
      if (!isQuestion_3) {
        //console.log(isQuestion_3);
        $(".err_Question_3").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_3").html("");
      }

      var isQuestion_4 = validate_groupOfRadiobtn($("input[name=Question_4]"));
      if (!isQuestion_4) {
        //console.log(isQuestion_4);
        $(".err_Question_4").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_4").html("");
      }

      var isQuestion_5 = validate_groupOfRadiobtn($("input[name=Question_5]"));
      if (!isQuestion_5) {
        //console.log(isQuestion_5);
        $(".err_Question_5").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_5").html("");
      }

      var isQuestion_6 = validate_groupOfRadiobtn($("input[name=Question_6]"));
      //var isQuestion_6 = validate_groupOfRadiobtn($("input[name=Question_6][name=isQuestion_6_2]"));
      var isQuestion_6_2 = validate_groupOfRadiobtn($("input[name=Question_6_2]"));
      var isQuestion_6_3 = validate_groupOfRadiobtn($("input[name=Question_6_3]"));
      var isQuestion_6_4 = validate_groupOfRadiobtn($("input[name=Question_6_4]"));
      var isQuestion_6_5 = validate_groupOfRadiobtn($("input[name=Question_6_5]"));
      if ((!isQuestion_6) && (!isQuestion_6_2) && (!isQuestion_6_3) && (!isQuestion_6_4) && (!isQuestion_6_5)) {
      //alert(isQuestion_3_2);
      //if (!isQuestion_3_2) {
        //console.log(isQuestion_3);
        $(".err_Question_6").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {

        $(".err_Question_6").html("");
      }

      var isQuestion_7 = validate_groupOfRadiobtn($("input[name=Question_7]"));
      if (!isQuestion_7) {
        //console.log(isQuestion_7);
        $(".err_Question_7").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_7").html("");
      }

      var isQuestion_8 = validate_groupOfRadiobtn($("input[name=Question_8]"));
      if (!isQuestion_8) {
        //console.log(isQuestion_8);
        $(".err_Question_8").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_8").html("");
      }

      var isQuestion_9 = validate_groupOfRadiobtn($("input[name=Question_9]"));
      //var isQuestion_9 = validate_groupOfRadiobtn($("input[name=Question_9][name=isQuestion_9_2]"));
      var isQuestion_9_2 = validate_groupOfRadiobtn($("input[name=Question_9_2]"));
      var isQuestion_9_3 = validate_groupOfRadiobtn($("input[name=Question_9_3]"));
      var isQuestion_9_4 = validate_groupOfRadiobtn($("input[name=Question_9_4]"));
      var isQuestion_9_5 = validate_groupOfRadiobtn($("input[name=Question_9_5]"));
      if ((!isQuestion_9) && (!isQuestion_9_2) && (!isQuestion_9_3) && (!isQuestion_9_4) && (!isQuestion_9_5)) {
      //alert(isQuestion_3_2);
      //if (!isQuestion_3_2) {
        //console.log(isQuestion_3);
        $(".err_Question_9").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {

        $(".err_Question_9").html("");
      }

      var isQuestion_10 = validate_groupOfRadiobtn($("input[name=Question_10]"));
      //var isQuestion_10 = validate_groupOfRadiobtn($("input[name=Question_10][name=isQuestion_10_2]"));
      var isQuestion_10_2 = validate_groupOfRadiobtn($("input[name=Question_10_2]"));
      var isQuestion_10_3 = validate_groupOfRadiobtn($("input[name=Question_10_3]"));
      var isQuestion_10_4 = validate_groupOfRadiobtn($("input[name=Question_10_4]"));
      var isQuestion_10_5 = validate_groupOfRadiobtn($("input[name=Question_10_5]"));
      if ((!isQuestion_10) && (!isQuestion_10_2) && (!isQuestion_10_3) && (!isQuestion_10_4) && (!isQuestion_10_5)) {
      //alert(isQuestion_3_2);
      //if (!isQuestion_3_2) {
        //console.log(isQuestion_3);
        $(".err_Question_10").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {

        $(".err_Question_10").html("");
      }

      var isQuestion_11 = validate_groupOfRadiobtn( $("input[name=Question_11]") );
      if (!isQuestion_11) {
        //console.log(isQuestion_9);
        $(".err_Question_11").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_11").html("");
      }

      var isQuestion_12 = validate_groupOfRadiobtn( $("input[name=Question_12]") );
      if (!isQuestion_12) {
        //console.log(isQuestion_9);
        $(".err_Question_12").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_12").html("");
      }

      
      var isQuestion_13 = validate_groupOfRadiobtn( $("input[name=Question_13]") );
      if (!isQuestion_13) {
        //console.log(isQuestion_9);
        $(".err_Question_13").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_13").html("");
      }

      var isQuestion_14 = validate_groupOfRadiobtn( $("input[name=Question_14]") );
      if (!isQuestion_14) {
        //console.log(isQuestion_9);
        $(".err_Question_14").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_14").html("");
      }

      var isQuestion_15_1 = $('#Question_15_1').val();
      if (!isQuestion_15_1) {
        //console.log( isQuestion_5 );
        $(".err_Question_15_1").html(
          "<span class='red'>Please fill It</span>"
        );
      } else {
        $(".err_Question_15_1").html("");
      }
     

      var isQuestion_16 = validate_groupOfRadiobtn( $("input[name=Question_16]") );
      if (!isQuestion_16) {
        //console.log(isQuestion_9);
        $(".err_Question_16").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_16").html("");
      }

      var isQuestion_17 = validate_groupOfRadiobtn( $("input[name=Question_17]") );
      if (!isQuestion_17) {
        //console.log(isQuestion_9);
        $(".err_Question_17").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_17").html("");
      }

      var isQuestion_18 = validate_groupOfRadiobtn($("input[name=Question_18]"));
      if (!isQuestion_18) {
        var isQuestion_18_val = '';
        //console.log(isQuestion_18);
        $(".err_Question_18").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        var isQuestion_18_val = $('#Question_184').val()
        if((isQuestion_18_val != '') && $("#Question_184").prop("checked"))
        {
        
        //alert(isQuestion_5_val);
            var isQuestion_18_If_Yes = $('#Question_185').val();
            if (!isQuestion_18_If_Yes) {
              //alert(isQuestion_6);
              $(".err_Question_18_If_No").html(
              "<span class='red'>Please fill it</span>"
              );
            }else {
              $(".err_Question_18_If_No").html("");
            } 
        }else {
              $(".err_Question_18_If_No").html("");
            }
        $(".err_Question_18").html("");
      }

      var isQuestion_19 = validate_groupOfRadiobtn( $("input[name=Question_19]") );
      if (!isQuestion_19) {
        //console.log(isQuestion_9);
        $(".err_Question_19").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_19").html("");
      }

      var isQuestion_20 = validate_groupOfRadiobtn( $("input[name=Question_20]") );
      if (!isQuestion_20) {
        //console.log(isQuestion_9);
        $(".err_Question_20").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_20").html("");
      }

      var isQuestion_21 = validate_groupOfRadiobtn( $("input[name=Question_21]") );
      if (!isQuestion_21) {
        //console.log(isQuestion_9);
        $(".err_Question_21").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_21").html("");
      }

      var isQuestion_22 = validate_groupOfRadiobtn($("input[name=Question_22]"));
      //var isQuestion_22 = validate_groupOfRadiobtn($("input[name=Question_22][name=isQuestion_22_2]"));
      var isQuestion_22_2 = validate_groupOfRadiobtn($("input[name=Question_22_2]"));
      var isQuestion_22_3 = validate_groupOfRadiobtn($("input[name=Question_22_3]"));
      var isQuestion_22_4 = validate_groupOfRadiobtn($("input[name=Question_22_4]"));
      var isQuestion_22_5 = validate_groupOfRadiobtn($("input[name=Question_22_5]"));
      if ((!isQuestion_22) && (!isQuestion_22_2) && (!isQuestion_22_3) && (!isQuestion_22_4) && (!isQuestion_22_5)) {
      //alert(isQuestion_3_2);
      //if (!isQuestion_3_2) {
        //console.log(isQuestion_3);
        $(".err_Question_22").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {

        $(".err_Question_22").html("");
      }

      var isQuestion_23 = validate_groupOfRadiobtn($("input[name=Question_23]"));
      //var isQuestion_23 = validate_groupOfRadiobtn($("input[name=Question_23][name=isQuestion_23_2]"));
      var isQuestion_23_2 = validate_groupOfRadiobtn($("input[name=Question_23_2]"));
      var isQuestion_23_3 = validate_groupOfRadiobtn($("input[name=Question_23_3]"));
      var isQuestion_23_4 = validate_groupOfRadiobtn($("input[name=Question_23_4]"));
      var isQuestion_23_5 = validate_groupOfRadiobtn($("input[name=Question_23_5]"));
      if ((!isQuestion_23) && (!isQuestion_23_2) && (!isQuestion_23_3) && (!isQuestion_23_4) && (!isQuestion_23_5)) {
      //alert(isQuestion_3_2);
      //if (!isQuestion_3_2) {
        //console.log(isQuestion_3);
        $(".err_Question_23").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {

        $(".err_Question_23").html("");
      }

      var isQuestion_24_1 = $('#Question_24_1').val();
      if (!isQuestion_24_1) {
        //console.log( isQuestion_5 );
        $(".err_Question_24_1").html(
          "<span class='red'>Please fill It</span>"
        );
      } else {
        $(".err_Question_24_1").html("");
      }
     

      // var isQuestion_6 = $('input[name=Question_3]').prop('checked');
      // if(!isQuestion_6){
      //     //console.log(isQuestion_6);
      //     return false;
      // }

      if (
        isQuestion_1 == true &&
        isQuestion_2 == true &&       
        isQuestion_3 == true &&
        isQuestion_4 == true &&
        isQuestion_5 == true &&
        (isQuestion_6 == true ||
         isQuestion_6_2 == true ||
          isQuestion_6_3 == true ||
           isQuestion_6_4 == true ||
           isQuestion_6_5 == true) &&
        isQuestion_7 == true &&
        isQuestion_8 == true &&
        (isQuestion_9 == true ||
          isQuestion_9_2 == true ||
           isQuestion_9_3 == true ||
            isQuestion_9_4 == true ||
            isQuestion_9_5 == true) &&
        (isQuestion_10 == true ||
          isQuestion_10_2 == true ||
            isQuestion_10_3 == true ||
            isQuestion_10_4 == true ||
            isQuestion_10_5 == true) &&          
        isQuestion_11 == true &&
        isQuestion_12 == true &&        
        isQuestion_13 == true &&        
        isQuestion_14 == true &&  
        isQuestion_15_1 != '' &&
        isQuestion_16 == true && 
        isQuestion_17 == true &&         
        (
          (isQuestion_18 == true &&
         isQuestion_18_val == ''
         ) || 
        (isQuestion_18 == true 
          && isQuestion_18_val != '' 
          && isQuestion_18_If_Yes != ''
          )
        ) &&
        isQuestion_19 == true && 
        isQuestion_20 == true && 
        isQuestion_21 == true && 
        (isQuestion_22 == true ||
          isQuestion_22_2 == true ||
           isQuestion_22_3 == true ||
            isQuestion_22_4 == true ||
            isQuestion_22_5 == true) &&
        (isQuestion_23 == true ||
          isQuestion_23_2 == true ||
            isQuestion_23_3 == true ||
            isQuestion_23_4 == true ||
            isQuestion_23_5 == true) &&        
        isQuestion_24_1 != ''   
      ) {
        let dateandtime = get_created_date();
        let survey_id = $("#frm-survey #survey_id").val();
        let page_slug = $("#frm-survey #page_slug").val();
        var $form = $("#frm-survey");
        var JSONformdata = getFormData($form);
        //console.log(JSONformdata);

        var parameters = {
          action: "srb_submit_survey2",
          survey_id: survey_id,
          page_slug: page_slug,
          "form-data": JSONformdata,
          created_date: dateandtime,
          nonce: ajax_param.nonce,
        };
        ////console.log ( parameters );
        jQuery.ajax({
          type: "POST",
          url: ajax_param.ajaxurl,
          data: parameters,
          success: function (response) {
            //let response_json = $.parseJSON(response);
            //console.log ( response );
            if (response > 0) {
              $("#frm-survey .response").html(
                "<span class = 'green' >Entry Submitted successfully!"
              );
              window.location.href = "https://ajantaurology.docmode.org/thank-you";
            } else {
              $("#frm-survey .response").html(
                "<span class = 'red' >Something went wrong"
              );
            }
            // //console.log(  response );
          }, //success end
        }); //ajax end
      } else {
        //console.log("validation error");
      }
    });

    $("#frm_acc").submit(function (e) {
      let DateAndTimeForAccForm = get_created_date();
      $("input#ctime").val(DateAndTimeForAccForm);

      let ac_name = $("#frm_acc_holder_name").val();
      let ac_number = $("#frm_acc_number").val();
      let ac_ifsc = $("#frm_acc_ifsc_code").val();
      let pan_no = $("#frm_pan_no").val();
      let isValid_ac_name,
        isValid_ac_number,
        isValid_ac_ifsc,
        isValid_pan_no,
        isValid_pan_photo,
        isValid_ac_canecel_cheque;

      var reg_ac_name = new RegExp("^([a-zA-Z]s?([a-zA-Z]{1,})?)+$");

      if (ac_name == "") {
        //console.log('in blank');
        isValid_ac_name = false;
        $(".err_ac_name").html(
          "<span class='red'>This field is mandatory</span>"
        );
      } else {
        //console.log('in true');
        isValid_ac_name = true;
        $(".err_ac_name").html("");
      }

      if (ac_number == "") {
        isValid_ac_number = false;
        $(".err_ac_number").html(
          "<span class='red'>This field is mandatory</span>"
        );
      } else if (ac_number == "") {
        isValid_ac_number = false;
        $(".err_ac_number").html(
          "<span class='red'>This field is mandatory</span>"
        );
      } else {
        isValid_ac_number = true;
        $(".err_ac_number").html("");
      }

      if (ac_ifsc == "") {
        isValid_ac_ifsc = false;
        $(".err_ac_ifsc").html(
          "<span class='red'>This field is mandatory</span>"
        );
      } else if (ac_number == "") {
        isValid_ac_ifsc = false;
        $(".err_ac_ifsc").html(
          "<span class='red'>This field is mandatory</span>"
        );
      } else {
        isValid_ac_ifsc = true;
        $(".err_ac_ifsc").html("");
      }

      if (pan_no == "") {
        isValid_pan_no = false;
        $(".err_pan_no").html(
          "<span class='red'>This field is mandatory</span>"
        );
      } else {
        isValid_pan_no = true;
        $(".err_pan_no").html("");
      }

      var ext = $("#account_cancelled_cheque")
        .val()
        .split(".")
        .pop()
        .toLowerCase();
      if ($.inArray(ext, ["png", "jpg", "jpeg"]) == -1) {
        console.log("invalid extension!");
        isValid_ac_canecel_cheque = false;
        $(".err_ac_canecel_cheque").html(
          "<span class='red'>File type not allowed</span>"
        );
      } else {
        isValid_ac_canecel_cheque = true;
        $(".err_ac_canecel_cheque").html("");
      }

      var ext = $("#pan_no_photo")
        .val()
        .split(".")
        .pop()
        .toLowerCase();
      if ($.inArray(ext, ["png", "jpg", "jpeg"]) == -1) {
        console.log("invalid extension!");
        isValid_pan_photo = false;
        $(".err_pan_no_photo").html(
          "<span class='red'>File type not allowed</span>"
        );
      } else {
        isValid_pan_photo = true;
        $(".err_pan_no_photo").html("");
      }

      var Isvalid_I_agree = validate_groupOfRadiobtn($("input[name=I_agree]"));
      if (!Isvalid_I_agree) {
        console.log(Isvalid_I_agree);
        $(".err_I_agree").html(
          "<span class='red'>This field is mandatory</span>"
        );
      } else {
        $(".err_I_agree").html("");
      }

      // var Isvalid_payment_choice = validate_groupOfRadiobtn( $('input[name=payment_choice]') );
      // if(!Isvalid_payment_choice){
      //     console.log(Isvalid_payment_choice);
      //     $('.err_payment_choice').html("<span class='red'>Please select any option</span>");

      // }else{
      //     $('.err_payment_choice').html("");
      // }

      if (
        !Isvalid_I_agree ||
        //  !Isvalid_payment_choice ||
        !isValid_ac_name ||
        !isValid_ac_number ||
        !isValid_ac_ifsc ||
        !isValid_ac_canecel_cheque ||
        !isValid_pan_no ||
        !isValid_pan_photo
      ) {
        //  console.log(Isvalid_I_agree + Isvalid_payment_choice);
        e.preventDefault();
        console.log("it is not working!");
        return false;
      } else {
        //console.log(Isvalid_I_agree + Isvalid_payment_choice);
        //return true;
      }
      //     e.preventDefault();

      //     let survey_id = $('#sid').val();
      //     // let frm_data = $('#frm-frm_acc').serializeArray();
      //     //let acc_ifsc_code = $('#frm_acc_ifsc_code').val();

      //     let dateandtime = get_created_date();
      //     //console.log ( $('#frm_acc').serializeArray() );
      //     let filename = document.getElementById("account_cancelled_cheque").files[0];
      //     let filesize;
      //     let filetype;

      //     if(undefined !== filename ){
      //          filename = document.getElementById("account_cancelled_cheque").files[0].name;
      //          filesize = document.getElementById("account_cancelled_cheque").files[0].size;
      //          filetype = document.getElementById("account_cancelled_cheque").files[0].type;

      //      }else{
      //         filename = "please upload file";
      //         return false;
      //     }

      //     var parameters = {
      //           'action'                  : 'srb_submit_acc_data',
      //           'form-data'               : $('#frm_acc').serializeArray(),
      //           'filename'                : filename,
      //           'filesize'                : filesize,
      //           'filetype'                : filetype,
      //           'survey_id'               : survey_id,
      //           'created_date'            : dateandtime,
      //           'nonce'                   : ajax_param.nonce
      //     };
      //     ////console.log (parameters);

      //     jQuery.ajax({
      //         type    : 'POST',
      //         url     : ajax_param.ajaxurl,
      //         data    : parameters,
      //         success : function(response){
      //             //let response_json = $.parseJSON(response);
      //             //console.log(  response ) ;
      //             if ( response > 0 ){
      //                 $(".response").html("<span class = 'green' >Entry Submitted successfully !");
      //                 $('#frm_acc').hide();
      //             }

      //         }//success end
      //     });//ajax end
    });


  /**
   * 
   * patient experience form
   * 
   */
   // $("input[name=Question_8]").change(function (){
   //  console.log ( $("input[name=Question_8]:checked") ) ;
   // });

  $('input[type=radio][name=Is_it_a_CRE_case_questionmark_]').change(function() {
      // alert(this.value  + " Hi");
      if (this.value == 'Yes') {
          //alert("Allot Thai Gayo Bhai");
          $('input[type=radio][name=What_type_of_Carbapenamase_it_is]').attr("disabled",false);
          // $('input[type=radio][name=What_type_of_Carbapenamase_it_is]').attr("required",true);
          $('input[type=radio][id=Question_96]').attr("checked",false);
          $('#9_note').html("");
      }
      else if (this.value == 'No') {
         $('input[type=radio][id=Question_96]').attr("checked",true);
         $('input[type=radio][name=What_type_of_Carbapenamase_it_is]').attr("disabled",true);
         $('#9_note').html("<span style='color:#4caf50;font-size:13px;'> Question 9 need not to be answered. <span>");
      }
  });


  $('input[type=radio][name=Adverse_event_seen]').change(function() {
      // alert(this.value  + " Hi");
      if (this.value == 'Yes') {
          //alert("Allot Thai Gayo Bhai");
          $('input[type=text][name=Adverse_event_seen_RLBRACKETS_other_RRBRACKETS_]').attr("disabled",false);
          $('input[type=text][name=Adverse_event_seen_RLBRACKETS_other_RRBRACKETS_]').attr("required",true);
          // $('input[type=radio][id=Question_96]').attr("checked",false);
          // $('#9_note').html("");
      }
      else if (this.value == 'No') {
         //$('input[type=radio][id=Question_96]').attr("checked",true);
         $('input[type=text][name=Adverse_event_seen_RLBRACKETS_other_RRBRACKETS_]').attr("disabled",true);
         $('input[type=text][name=Adverse_event_seen_RLBRACKETS_other_RRBRACKETS_]').val("");
         $('input[type=text][name=Adverse_event_seen_RLBRACKETS_other_RRBRACKETS_]').attr("required",false);
         // $('#9_note').html("<span style='color:#e53935;font-size:13px;'> Question 9 need not to be answered. <span>");
      }
  });


    $('input[type=radio][name=Culture_grown_in_sample]').change(function() {
      // alert(this.value  + " Hi");
        if (this.value == 'No') {
            $('input[type=radio][name=If_Yes_COMMA_What_bacteria_grown_questionmark_]').attr("disabled",true);
            $('input[type=radio][name=Is_it_a_CRE_case_questionmark_]').attr("disabled",true);
            $('input[type=radio][name=What_type_of_Carbapenamase_it_is]').attr("disabled",true);

            $('input[type=radio][id=Question_76]').attr("checked",true);
            $('input[type=radio][id=Question_83]').attr("checked",true);
            $('input[type=radio][id=Question_96]').attr("checked",true);

            $('input[type=text][name=Question_7_RLBRACKETS_other_RRBRACKETS_]').attr("disabled",true);
            $('input[type=text][name=Question_7_RLBRACKETS_other_RRBRACKETS_]').attr("required",false);

            $('#6_note').html("<span style='color:#4caf50;font-size:13px;'> Question 7,8,9 need not to be answered. <span>");
        }
        else if (this.value == 'Yes') {
            $('input[type=radio][id=Question_76]').attr("checked",false);
            $('input[type=radio][id=Question_83]').attr("checked",false);
            $('input[type=radio][id=Question_96]').attr("checked",false);

            $('input[type=radio][name=If_Yes_COMMA_What_bacteria_grown_questionmark_]').attr("disabled",false);
            $('input[type=radio][name=Is_it_a_CRE_case_questionmark_]').attr("disabled",false);
            $('input[type=radio][name=What_type_of_Carbapenamase_it_is]').attr("disabled",false);

            $('input[type=text][name=Question_7_RLBRACKETS_other_RRBRACKETS_]').attr("disabled",false);
            //$('input[type=text][name=Question_7_RLBRACKETS_other_RRBRACKETS_]').attr("required",true);

            $('#6_note').html("");
        }
    });

    $('input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]').hide();
    $('input[type=radio][name=At_the_time_of_admission_patient_is_hemodynamically]').change(function() {
        if (this.value == 'Unstable') {
            $('input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]').show();
            $('input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]').attr("disabled",false);
            $('input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]').attr("required",true);
        }
        else if (this.value == 'Stable') {
             $('input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]').hide();
             $('input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]').attr("disabled",true);
             $('input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]').val("");
             $('input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]').attr("required",false);
        }
    });


    $('#pef_response_date').text(get_created_date());

    var Question_12_11 = $('#Question_12_11').val();
    var Question_12_12 = $('#Question_12_12').val();
    var Question_131 = $('#Question_131').val();
    var isQuestion_13 = validate_groupOfRadiobtn( $("input[name=MSE_treatment_discontinued_COMMA_as_the_patient_BLANK_]") );
      //alert(Question_12_11);
    $("#Question_12_11").click( function (e) {
      //alert(isQuestion_13);
      $('#Question_131').prop('checked', false);
      $('#Question_132').prop('checked', false);
      $('#Question_133').prop('checked', false);
      $('#q13').hide();
    });

    $("#Question_12_12").click( function (e) {
      //alert(Question_12_11);
      $('#Question_131').prop('checked', false);
      $('#Question_132').prop('checked', false);
      $('#Question_133').prop('checked', false);
      $('#q13').hide();
    });

    $("#frm-PEF").submit( function (e) {
      e.preventDefault();
      ////console.log ($('#frm-survey').serialize() );
      var name_of_respondent = $('#name_of_respondent').text();
      //var val_question_12_11 = $('#Question_12_11').val();
      //var val_question_12_12 = $('#Question_12_12').val();
      
      var isQuestion_12_sub = validate_groupOfRadiobtn($("input[name=MSE_treatment_incomplete_due_to]"));

      //alert(isQuestion_12_sub);
      //alert(val_question_12_11+'/'+val_question_12_12+'/'+isQuestion_12_sub);

      var isQuestion_1 = validate_groupOfRadiobtn($("input[name=Question_1]"));

      if (!isQuestion_1) {
        //console.log( isQuestion_1 );
        $(".err_Question_1").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_1").html("");
      }

      var isQuestion_2 = validate_groupOfRadiobtn($("input[name=Question_2]"));

      if (!isQuestion_2) {
        //console.log( isQuestion_2 );
        $(".err_Question_2").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_2").html("");
      }


      var isQuestion_3 = validate_groupOfRadiobtn($("input[name=Question_3]"));
      if (!isQuestion_3) {
        //console.log(isQuestion_3);
        $(".err_Question_3").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_3").html("");
      }

      var isQuestion_4 = validate_groupOfRadiobtn($("input[name=Question_4]"));
      if (!isQuestion_4) {
        //console.log(isQuestion_4);
        $(".err_Question_4").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_4").html("");
      }

      var isQuestion_5 = validate_groupOfRadiobtn($("input[name=Question_5]"));
      if (!isQuestion_5) {
        //console.log(isQuestion_5);
        $(".err_Question_5").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_5").html("");
      }

      var isQuestion_6 = validate_groupOfRadiobtn($("input[name=Question_6]"));
      //var isQuestion_6 = validate_groupOfRadiobtn($("input[name=Question_6][name=isQuestion_6_2]"));
      var isQuestion_6_2 = validate_groupOfRadiobtn($("input[name=Question_6_2]"));
      var isQuestion_6_3 = validate_groupOfRadiobtn($("input[name=Question_6_3]"));
      var isQuestion_6_4 = validate_groupOfRadiobtn($("input[name=Question_6_4]"));
      var isQuestion_6_5 = validate_groupOfRadiobtn($("input[name=Question_6_5]"));
      if ((!isQuestion_6) && (!isQuestion_6_2) && (!isQuestion_6_3) && (!isQuestion_6_4) && (!isQuestion_6_5)) {
      //alert(isQuestion_3_2);
      //if (!isQuestion_3_2) {
        //console.log(isQuestion_3);
        $(".err_Question_6").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {

        $(".err_Question_6").html("");
      }

      var isQuestion_7 = validate_groupOfRadiobtn($("input[name=Question_7]"));
      if (!isQuestion_7) {
        //console.log(isQuestion_7);
        $(".err_Question_7").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_7").html("");
      }

      var isQuestion_8 = validate_groupOfRadiobtn($("input[name=Question_8]"));
      if (!isQuestion_8) {
        //console.log(isQuestion_8);
        $(".err_Question_8").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_8").html("");
      }

      var isQuestion_9 = validate_groupOfRadiobtn($("input[name=Question_9]"));
      //var isQuestion_9 = validate_groupOfRadiobtn($("input[name=Question_9][name=isQuestion_9_2]"));
      var isQuestion_9_2 = validate_groupOfRadiobtn($("input[name=Question_9_2]"));
      var isQuestion_9_3 = validate_groupOfRadiobtn($("input[name=Question_9_3]"));
      var isQuestion_9_4 = validate_groupOfRadiobtn($("input[name=Question_9_4]"));
      var isQuestion_9_5 = validate_groupOfRadiobtn($("input[name=Question_9_5]"));
      if ((!isQuestion_9) && (!isQuestion_9_2) && (!isQuestion_9_3) && (!isQuestion_9_4) && (!isQuestion_9_5)) {
      //alert(isQuestion_3_2);
      //if (!isQuestion_3_2) {
        //console.log(isQuestion_3);
        $(".err_Question_9").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {

        $(".err_Question_9").html("");
      }

      var isQuestion_10 = validate_groupOfRadiobtn($("input[name=Question_10]"));
      //var isQuestion_10 = validate_groupOfRadiobtn($("input[name=Question_10][name=isQuestion_10_2]"));
      var isQuestion_10_2 = validate_groupOfRadiobtn($("input[name=Question_10_2]"));
      var isQuestion_10_3 = validate_groupOfRadiobtn($("input[name=Question_10_3]"));
      var isQuestion_10_4 = validate_groupOfRadiobtn($("input[name=Question_10_4]"));
      var isQuestion_10_5 = validate_groupOfRadiobtn($("input[name=Question_10_5]"));
      if ((!isQuestion_10) && (!isQuestion_10_2) && (!isQuestion_10_3) && (!isQuestion_10_4) && (!isQuestion_10_5)) {
      //alert(isQuestion_3_2);
      //if (!isQuestion_3_2) {
        //console.log(isQuestion_3);
        $(".err_Question_10").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {

        $(".err_Question_10").html("");
      }

      var isQuestion_11 = validate_groupOfRadiobtn( $("input[name=Question_11]") );
      if (!isQuestion_11) {
        //console.log(isQuestion_9);
        $(".err_Question_11").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_11").html("");
      }

      var isQuestion_12 = validate_groupOfRadiobtn( $("input[name=Question_12]") );
      if (!isQuestion_12) {
        //console.log(isQuestion_9);
        $(".err_Question_12").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_12").html("");
      }

      
      var isQuestion_13 = validate_groupOfRadiobtn( $("input[name=Question_13]") );
      if (!isQuestion_13) {
        //console.log(isQuestion_9);
        $(".err_Question_13").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_13").html("");
      }

      var isQuestion_14 = validate_groupOfRadiobtn( $("input[name=Question_14]") );
      if (!isQuestion_14) {
        //console.log(isQuestion_9);
        $(".err_Question_14").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_14").html("");
      }

      var isQuestion_15_1 = $('#Question_15_1').val();
      if (!isQuestion_15_1) {
        //console.log( isQuestion_5 );
        $(".err_Question_15_1").html(
          "<span class='red'>Please fill It</span>"
        );
      } else {
        $(".err_Question_15_1").html("");
      }
     

      var isQuestion_16 = validate_groupOfRadiobtn( $("input[name=Question_16]") );
      if (!isQuestion_16) {
        //console.log(isQuestion_9);
        $(".err_Question_16").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_16").html("");
      }

      var isQuestion_17 = validate_groupOfRadiobtn( $("input[name=Question_17]") );
      if (!isQuestion_17) {
        //console.log(isQuestion_9);
        $(".err_Question_17").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_17").html("");
      }

      var isQuestion_18 = validate_groupOfRadiobtn($("input[name=Question_18]"));
      if (!isQuestion_18) {
        var isQuestion_18_val = '';
        //console.log(isQuestion_18);
        $(".err_Question_18").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        var isQuestion_18_val = $('#Question_184').val()
        if((isQuestion_18_val != '') && $("#Question_184").prop("checked"))
        {
        
        //alert(isQuestion_5_val);
            var isQuestion_18_If_Yes = $('#Question_185').val();
            if (!isQuestion_18_If_Yes) {
              //alert(isQuestion_6);
              $(".err_Question_18_If_No").html(
              "<span class='red'>Please fill it</span>"
              );
            }else {
              $(".err_Question_18_If_No").html("");
            } 
        }else {
              $(".err_Question_18_If_No").html("");
            }
        $(".err_Question_18").html("");
      }

      var isQuestion_19 = validate_groupOfRadiobtn( $("input[name=Question_19]") );
      if (!isQuestion_19) {
        //console.log(isQuestion_9);
        $(".err_Question_19").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_19").html("");
      }

      var isQuestion_20 = validate_groupOfRadiobtn( $("input[name=Question_20]") );
      if (!isQuestion_20) {
        //console.log(isQuestion_9);
        $(".err_Question_20").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_20").html("");
      }

      var isQuestion_21 = validate_groupOfRadiobtn( $("input[name=Question_21]") );
      if (!isQuestion_21) {
        //console.log(isQuestion_9);
        $(".err_Question_21").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_21").html("");
      }

      var isQuestion_22 = validate_groupOfRadiobtn($("input[name=Question_22]"));
      //var isQuestion_22 = validate_groupOfRadiobtn($("input[name=Question_22][name=isQuestion_22_2]"));
      var isQuestion_22_2 = validate_groupOfRadiobtn($("input[name=Question_22_2]"));
      var isQuestion_22_3 = validate_groupOfRadiobtn($("input[name=Question_22_3]"));
      var isQuestion_22_4 = validate_groupOfRadiobtn($("input[name=Question_22_4]"));
      var isQuestion_22_5 = validate_groupOfRadiobtn($("input[name=Question_22_5]"));
      if ((!isQuestion_22) && (!isQuestion_22_2) && (!isQuestion_22_3) && (!isQuestion_22_4) && (!isQuestion_22_5)) {
      //alert(isQuestion_3_2);
      //if (!isQuestion_3_2) {
        //console.log(isQuestion_3);
        $(".err_Question_22").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {

        $(".err_Question_22").html("");
      }

      var isQuestion_23 = validate_groupOfRadiobtn($("input[name=Question_23]"));
      //var isQuestion_23 = validate_groupOfRadiobtn($("input[name=Question_23][name=isQuestion_23_2]"));
      var isQuestion_23_2 = validate_groupOfRadiobtn($("input[name=Question_23_2]"));
      var isQuestion_23_3 = validate_groupOfRadiobtn($("input[name=Question_23_3]"));
      var isQuestion_23_4 = validate_groupOfRadiobtn($("input[name=Question_23_4]"));
      var isQuestion_23_5 = validate_groupOfRadiobtn($("input[name=Question_23_5]"));
      if ((!isQuestion_23) && (!isQuestion_23_2) && (!isQuestion_23_3) && (!isQuestion_23_4) && (!isQuestion_23_5)) {
      //alert(isQuestion_3_2);
      //if (!isQuestion_3_2) {
        //console.log(isQuestion_3);
        $(".err_Question_23").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {

        $(".err_Question_23").html("");
      }

      var isQuestion_24_1 = $('#Question_24_1').val();
      if (!isQuestion_24_1) {
        //console.log( isQuestion_5 );
        $(".err_Question_24_1").html(
          "<span class='red'>Please fill It</span>"
        );
      } else {
        $(".err_Question_24_1").html("");
      }
     

      

      if 
        (
          isQuestion_1 == true &&
          isQuestion_2 == true &&       
          isQuestion_3 == true &&
          isQuestion_4 == true &&
          isQuestion_5 == true &&
          (isQuestion_6 == true ||
           isQuestion_6_2 == true ||
            isQuestion_6_3 == true ||
             isQuestion_6_4 == true ||
             isQuestion_6_5 == true) &&
          isQuestion_7 == true &&
          isQuestion_8 == true &&
          (isQuestion_9 == true ||
            isQuestion_9_2 == true ||
             isQuestion_9_3 == true ||
              isQuestion_9_4 == true ||
              isQuestion_9_5 == true) &&
          (isQuestion_10 == true ||
            isQuestion_10_2 == true ||
              isQuestion_10_3 == true ||
              isQuestion_10_4 == true ||
              isQuestion_10_5 == true) &&          
          isQuestion_11 == true &&
          isQuestion_12 == true &&        
          isQuestion_13 == true &&        
          isQuestion_14 == true &&  
          isQuestion_15_1 != '' &&
          isQuestion_16 == true && 
          isQuestion_17 == true &&         
          (
            (isQuestion_18 == true &&
           isQuestion_18_val == ''
           ) || 
          (isQuestion_18 == true 
            && isQuestion_18_val != '' 
            && isQuestion_18_If_Yes != ''
            )
          ) &&
          isQuestion_19 == true && 
          isQuestion_20 == true && 
          isQuestion_21 == true && 
          (isQuestion_22 == true ||
            isQuestion_22_2 == true ||
             isQuestion_22_3 == true ||
              isQuestion_22_4 == true ||
              isQuestion_22_5 == true) &&
          (isQuestion_23 == true ||
            isQuestion_23_2 == true ||
              isQuestion_23_3 == true ||
              isQuestion_23_4 == true ||
              isQuestion_23_5 == true) &&        
          isQuestion_24_1 != ''   
        )
      {

        let dateandtime = get_created_date();
        let survey_id = $("#frm-PEF #pef_form_id").val();
        let page_slug = $("#frm-PEF #pef_page_slug").val();
        let follow_up = $("#frm-PEF #follow_up").val();
        //alert(follow_up);
        let patient_serial_id = $("#frm-PEF #patient_serial_id").val();
        let patient_unique_id = $("#frm-PEF #patient_unique_id").val();
        var $form = $("#frm-PEF");
        var patient_no = $('#Question_1_1_2').val();

        var quest = {};
           $("#frm-PEF input").each(function(){
              quest[ $(this).attr('name') ] = $(this).attr('data-question');
              //console.log($(this).attr('name') +" : "+$(this).attr('data-question'));
           });
              console.log(quest);
      
        var JSONformdata = getFormData($form);
        //console.log(JSONformdata);

        var parameters = {
          action            : "srb_submit_survey",
          survey_id         : survey_id,
          patient_no         : patient_no,
          page_slug         : page_slug,
          follow_up         : follow_up,
          patient_serial_id : patient_serial_id,
          patient_unique_id : patient_unique_id,
          "form_data"       : JSONformdata,
          created_date      : dateandtime,
          respondent_name   : name_of_respondent,
          // question_set      : quest,
          nonce             : ajax_param.nonce
        };
        console.log ( parameters );
        jQuery.ajax({
          type: "POST",
          url: ajax_param.ajaxurl,
          data: parameters,
          dataType: 'json',
          beforeSend: function (arr, $form, options) {
              //check your conditions and return false to prevent the form submission
              // console.log("beforesend");
              $("#frm-PEF .response").html('<span style = "color : orange" >Processing..</span>');
              
          },
          success: function (response) {
          console.log("success");
            // let response_json = $.parseJSON(response);
            // console.log ( response);

            if ( response.insID  > 0 ) {
              $("#frm-PEF .response").html("<span class = 'green' >Entry Submitted successfully!</span>");
              window.location.href = response.redirect_url;
              // "https://lifecare.docmode.org/account-details/?sid=" + survey_id + "&sr=" + response;
            } else {
              $("#frm-PEF .response").html( "<span class = 'red' >Something went wrong </span>");
            }

          }, //success end
          complete: function(){
            // console.log("complete");
            $("#frm-PEF .response").html('<span style = "color : green" >Entry Submitted successfully!!</span>');
            $("#btn-submit-survey").attr('disable','disabled');
            $("#btn-submit-survey").prop("disabled", true);
          },

        }); //ajax end
      } else {
        //console.log("validation error");
      }
    });

    $("#frm-PEF-followup").submit( function (e) {
      e.preventDefault();
      ////console.log ($('#frm-survey').serialize() );
      var name_of_respondent = $('#name_of_respondent').text();
      //var val_question_12_11 = $('#Question_12_11').val();
      //var val_question_12_12 = $('#Question_12_12').val();
      
      var isQuestion_12_sub = validate_groupOfRadiobtn($("input[name=MSE_treatment_incomplete_due_to]"));

      //alert(isQuestion_12_sub);
      //alert(val_question_12_11+'/'+val_question_12_12+'/'+isQuestion_12_sub);

      var isQuestion_1_1_1 = $('#Question_1_1_1').val();
      if (isQuestion_1_1_1 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_1_1_1").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_1_1_1").html("");
      }

      var isQuestion_1_1_2 = $('#Question_1_1_2').val();
      if (isQuestion_1_1_2 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_1_1_2").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_1_1_2").html("");
      }

      var isQuestion_1_1_3 = $('#Question_1_1_3').val();
      if (isQuestion_1_1_3 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_1_1_3").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_1_1_3").html("");
      }

      var isQuestion_1_1_4 = $('#Question_1_1_4').val();
      if (isQuestion_1_1_4 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_1_1_4").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_1_1_4").html("");
      }

      var isQuestion_1_1 = $('#Question_1_1').val();
      if (isQuestion_1_1 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_1_1").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_1_1").html("");
      }

      var isQuestion_1_2 = $('#Question_1_2').val();
      if (isQuestion_1_2 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_1_2").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_1_2").html("");
      }

      var isQuestion_1_3 = $('#Question_1_3').val();
      if (isQuestion_1_3 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_1_3").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_1_3").html("");
      }

      var isQuestion_1 = validate_groupOfRadiobtn($("input[name=Patient_is_put_on]"));
      if (!isQuestion_1) {
        //console.log( isQuestion_1 );
        $(".err_Question_1").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_1").html("");
      }

      var isQuestion_2 = $('#Question_21').val();
      if (isQuestion_2 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_2").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_2").html("");
      }

      var isQuestion_3 = validate_groupOfRadiobtn($("input[name=Will_you_prefer_Ummeed_Patient_Support_Program_for_the_patient]"));
      if (!isQuestion_3) {
        //console.log(isQuestion_3);
        $(".err_Question_3").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_3").html("");
      }

      var isQuestion_4 = $('#Question_41').val();
      if (isQuestion_4 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_4").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_4").html("");
      }

      var isQuestion_5 = validate_groupOfRadiobtn($("input[name=Gender]"));
      if (!isQuestion_5) {
        //console.log(isQuestion_3);
        $(".err_Question_5").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_5").html("");
      }

      var isQuestion_61 = $('#Question_61').val();
      if (isQuestion_61 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_61").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_61").html("");
      }

      var isQuestion_62 = $('#Question_62').val();
      if (isQuestion_62 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_62").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_62").html("");
      }

      var isQuestion_7 = $('#Question_71').val();
      if (isQuestion_7 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_7").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_7").html("");
      }

      var isQuestion_81 = $('#Question_81').val();
      if (isQuestion_81 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_81").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_81").html("");
      }

      var isQuestion_82 = $('#Question_82').val();
      if (isQuestion_82 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_82").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_82").html("");
      }

      var isQuestion_83 = validate_groupOfRadiobtn($("input[name=Was_the_Insulin_Glargine_taken]"));
      if (!isQuestion_83) {
        //console.log(isQuestion_83);
        $(".err_Question_83").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_83").html("");
      }

      var isQuestion_85 = $('#Question_85').val();
      if (isQuestion_85 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_85").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_85").html("");
      }

      var isQuestion_86 = validate_groupOfRadiobtn($("input[name=Did_the_patient_experience_any_new_hypoglycemic_event_since_the_last_visit]"));
      if (!isQuestion_86) {
        //console.log(isQuestion_86);
        $(".err_Question_86").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_86").html("");
      }

      var isQuestion_88 = $('#Question_88').val();
      if (isQuestion_88 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_88").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_88").html("");
      }

      // var isQuestion_9 = $('#Question_91').val();
      // if (isQuestion_9 == '') {
      //   //console.log( isQuestion_1 );
      //   $(".err_Question_9").html(
      //     "<span class='red'>Please fill it</span>"
      //   );
      // } else {
      //   $(".err_Question_9").html("");
      // }

      var isQuestion_101 = $('#Question_101').val();
      if (isQuestion_101 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_101").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_101").html("");
      }

      var isQuestion_102 = $('#Question_102').val();
      if (isQuestion_102 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_102").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_102").html("");
      }

      var isQuestion_104 = validate_groupOfRadiobtn($("input[name=Any_Adverse_Event_Experienced]"));
      if (!isQuestion_104) {
        //console.log(isQuestion_83);
        $(".err_Question_104").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_104").html("");
      }

      var isQuestion_106 = $('#Question_106').val();
      if (isQuestion_106 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_106").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_106").html("");
      }

      // var isQuestion_103 = $('#Question_103').val();
      // if (isQuestion_103 == '') {
      //   //console.log( isQuestion_1 );
      //   $(".err_Question_103").html(
      //     "<span class='red'>Please fill it</span>"
      //   );
      // } else {
      //   $(".err_Question_103").html("");
      // }

      var isQuestion_11 = validate_groupOfRadiobtn($("input[name=Newly_Diagnosed_Diabetes]"));
      if (!isQuestion_11) {
        //console.log(isQuestion_11);
        $(".err_Question_11").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_11").html("");
      }

      var isQuestion_12 = validate_groupOfRadiobtn($("input[name=Family_history_of_Diabetes]"));
      if (!isQuestion_12) {
        //console.log(isQuestion_12);
        $(".err_Question_12").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_12").html("");
      }

      var isQuestion_13 = validate_groupOfRadiobtn($("input[name=Dyslipidemia]"));
      if (!isQuestion_13) {
        //console.log(isQuestion_13);
        $(".err_Question_13").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_13").html("");
      }

      var isQuestion_14 = validate_groupOfRadiobtn($("input[name=Coronary_Artery_Disease]"));
      if (!isQuestion_14) {
        //console.log(isQuestion_14);
        $(".err_Question_14").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_14").html("");
      }

      var isQuestion_15 = validate_groupOfRadiobtn($("input[name=Stroke]"));
      if (!isQuestion_15) {
        //console.log(isQuestion_15);
        $(".err_Question_15").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_15").html("");
      }

      var isQuestion_16 = validate_groupOfRadiobtn($("input[name=Neuropathy]"));
      if (!isQuestion_16) {
        //console.log(isQuestion_16);
        $(".err_Question_16").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_16").html("");
      }

      var isQuestion_17 = validate_groupOfRadiobtn($("input[name=Retinopathy]"));
      if (!isQuestion_17) {
        //console.log(isQuestion_17);
        $(".err_Question_17").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_17").html("");
      }

      var isQuestion_18 = validate_groupOfRadiobtn($("input[name=Nephropathy]"));
      if (!isQuestion_18) {
        //console.log(isQuestion_18);
        $(".err_Question_18").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_18").html("");
      }

      var isQuestion_19 = validate_groupOfRadiobtn($("input[name=Biguanides]"));
      if (!isQuestion_19) {
        //console.log(isQuestion_19);
        $(".err_Question_19").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_19").html("");
      }

      var isQuestion_20 = validate_groupOfRadiobtn($("input[name=Sulphonylureas]"));
      if (!isQuestion_20) {
        //console.log(isQuestion_20);
        $(".err_Question_20").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_20").html("");
      }

      var isQuestion_21 = validate_groupOfRadiobtn($("input[name=Thiazolidinediones]"));
      if (!isQuestion_21) {
        //console.log(isQuestion_21);
        $(".err_Question_21").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_21").html("");
      }

      var isQuestion_22 = validate_groupOfRadiobtn($("input[name=GLP_1_Analogues]"));
      if (!isQuestion_22) {
        //console.log(isQuestion_22);
        $(".err_Question_22").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_22").html("");
      }

      var isQuestion_23 = validate_groupOfRadiobtn($("input[name=DPP4_Inhibitors]"));
      if (!isQuestion_23) {
        //console.log(isQuestion_23);
        $(".err_Question_23").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_23").html("");
      }

      var isQuestion_24 = validate_groupOfRadiobtn($("input[name=Glargine]"));
      if (!isQuestion_24) {
        //console.log(isQuestion_24);
        $(".err_Question_24").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_24").html("");
      }

      var isQuestion_25 = validate_groupOfRadiobtn($("input[name=Recombinant_Human_Insulin]"));
      if (!isQuestion_25) {
        //console.log(isQuestion_25);
        $(".err_Question_25").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_25").html("");
      }

      var isQuestion_26 = validate_groupOfRadiobtn($("input[name=Other_Insulin_Analogues]"));
      if (!isQuestion_26) {
        //console.log(isQuestion_26);
        $(".err_Question_26").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_26").html("");
      }

      var isQuestion_27 = $('#Question_27').val();
      if (isQuestion_27 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_27").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_27").html("");
      }

      var isQuestion_28 = $('#Question_28').val();
      if (isQuestion_28 == '') {
        //console.log( isQuestion_1 );
        $(".err_Question_28").html(
          "<span class='red'>Please fill it</span>"
        );
      } else {
        $(".err_Question_28").html("");
      }

         
      

      if 
        (
        // isQuestion_1_1 != '' &&
        // isQuestion_1_2 != '' &&
        // isQuestion_1_3 != '' &&
        isQuestion_1_1_1 != '' &&
        isQuestion_1_1_2 != '' &&
        isQuestion_1_1_3 != '' &&
        isQuestion_1_1_4 != '' &&
        // isQuestion_1 == true &&
        // isQuestion_2 != '' &&
        // isQuestion_3 == true &&
        // isQuestion_4 != '' &&
        // isQuestion_5 == true &&
        isQuestion_61 != '' &&
        isQuestion_62 != '' &&
        isQuestion_7 != '' &&
        isQuestion_81 != '' &&
        isQuestion_82 != '' &&
        isQuestion_83 == true &&
        isQuestion_85 != '' &&
        isQuestion_86 == true &&
        isQuestion_88 != '' &&
        // isQuestion_9 != '' &&
        isQuestion_101 != '' &&
        isQuestion_102 != '' &&
        isQuestion_104 == true &&
        isQuestion_106 != '' &&
        isQuestion_27 != '' &&
        isQuestion_28 != ''
        // isQuestion_103 != ''
        // isQuestion_11 == true &&
        // isQuestion_12 == true &&
        // isQuestion_13 == true &&
        // isQuestion_14 == true &&
        // isQuestion_15 == true &&
        // isQuestion_16 == true &&
        // isQuestion_17 == true &&
        // isQuestion_18 == true &&
        // isQuestion_19 == true &&
        // isQuestion_20 == true &&
        // isQuestion_21 == true &&
        // isQuestion_22 == true &&
        // isQuestion_23 == true &&
        // isQuestion_24 == true &&
        // isQuestion_25 == true &&
        // isQuestion_26 == true
        )
      {

        let dateandtime = get_created_date();
        let survey_id = $("#frm-PEF-followup #pef_form_id").val();
        let page_slug = $("#frm-PEF-followup #pef_page_slug").val();
        let follow_up = $("#frm-PEF-followup #follow_up").val();
        //alert(follow_up);
        let patient_serial_id = $("#frm-PEF-followup #patient_serial_id").val();
        let patient_unique_id = $("#frm-PEF-followup #patient_unique_id").val();
        var $form = $("#frm-PEF-followup");
        var patient_no = $('#Question_1_1_2').val();

        var quest = {};
           $("#frm-PEF-followup input").each(function(){
              quest[ $(this).attr('name') ] = $(this).attr('data-question');
              //console.log($(this).attr('name') +" : "+$(this).attr('data-question'));
           });
              console.log(quest);
      
        var JSONformdata = getFormData($form);
        //console.log(JSONformdata);

        var parameters = {
          action            : "srb_submit_survey",
          survey_id         : survey_id,
          patient_no         : patient_no,
          page_slug         : page_slug,
          follow_up         : follow_up,
          patient_serial_id : patient_serial_id,
          patient_unique_id : patient_unique_id,
          "form_data"       : JSONformdata,
          created_date      : dateandtime,
          respondent_name   : name_of_respondent,
          // question_set      : quest,
          nonce             : ajax_param.nonce
        };
        console.log ( parameters );
        jQuery.ajax({
          type: "POST",
          url: ajax_param.ajaxurl,
          data: parameters,
          dataType: 'json',
          beforeSend: function (arr, $form, options) {
              //check your conditions and return false to prevent the form submission
              // console.log("beforesend");
              $("#frm-PEF-followup .response").html('<span style = "color : orange" >Processing..</span>');
              
          },
          success: function (response) {
          console.log("success");
            // let response_json = $.parseJSON(response);
            // console.log ( response);

            if ( response.insID  > 0 ) {
              $("#frm-PEF-followup .response").html("<span class = 'green' >Entry Submitted successfully!</span>");
              window.location.href = response.redirect_url;
              // "https://lifecare.docmode.org/account-details/?sid=" + survey_id + "&sr=" + response;
            } else {
              $("#frm-PEF-followup .response").html( "<span class = 'red' >Something went wrong </span>");
            }

          }, //success end
          complete: function(){
            // console.log("complete");
            $("#frm-PEF-followup .response").html('<span style = "color : green" >Entry Submitted successfully!!</span>');
            $("#btn-submit-survey").attr('disable','disabled');
            $("#btn-submit-survey").prop("disabled", true);
          },

        }); //ajax end
      } else {
        //console.log("validation error");
      }
    });



  




  }); //document

  // $(window).load( function () {
  //   $(".trigger_popup_fricc").click(function () {
  //     $(".hover_bkgr_fricc").show();
  //   });
  //   $(".hover_bkgr_fricc").click(function () {
  //     $(".hover_bkgr_fricc").hide();
  //   });
  //   $(".popupCloseButton").click(function () {
  //     $(".hover_bkgr_fricc").hide();
  //   });
  // });

  //console.log ( $('name["Doctor_name"]:selected').value() ) ;

  // var timeoutHandle;
  // function countdown(minutes, seconds) {
  //   function tick() {
  //     var counter = document.getElementById("me_timer");
  //     counter.innerHTML =
  //       '<span class="remaining_time">Remaining time : ' +
  //       minutes.toString() +
  //       ":" +
  //       (seconds < 10 ? "0" : "") +
  //       String(seconds) +
  //       "</span>";
  //     seconds--;
  //     if (seconds >= 0) {
  //       timeoutHandle = setTimeout(tick, 1000);
  //     } else {
  //       if (minutes >= 1) {
  //         // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst
  //         setTimeout(function () {
  //           countdown(minutes - 1, 59);
  //         }, 1000);
  //       }
  //     }
  //   }
  //   tick();
  // }

  // function isEmail(email) {
  //   var reg = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  //   return reg.test(email);
  // }

  // function isMobile(mobile) {
  //   var reg = /^\d{10}$/;
  //   return reg.test(mobile);
  // }

  function get_created_date() {
    var current = new Date();
    let date = current.getDate();
    let month = current.getMonth() + 1;
    let year = current.getFullYear();
    let hours = current.getHours();
    let minutes = current.getMinutes();
    let seconds = current.getSeconds();
    let dateandtime =
      year +
      "-" +
      month +
      "-" +
      date +
      " " +
      hours +
      ":" +
      minutes +
      ":" +
      seconds;
    //console.log(dateandtime);
    return dateandtime;
  }

  function getFormData($form) {
    var unindexed_array = $form.serializeArray();
    
    var indexed_array = {};

    $.map(unindexed_array, function (n, i) {
      indexed_array[n["name"]] = n["value"];
    });
    return indexed_array;
  }
  function validate_groupOfRadiobtn(radio) {
    //Loop and verify whether at-least one RadioButton is checked.
    let isValid = false;
    for (var i = 0; i < radio.length; i++) {
      if (radio[i].checked) {
        isValid = true;
        break;
      }
    }
    return isValid;
  }
})(jQuery);
