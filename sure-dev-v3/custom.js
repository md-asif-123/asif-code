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

      var isQuestion_2_1 = $("#Question_2_1").val();
      if (!isQuestion_2_1) {
        //console.log( isQuestion_2 );
        $(".err_Question_2_1").html("<span class='red'>Please fill It</span>");
      } else {
        $(".err_Question_2_1").html("");
      }

      var isQuestion_2_2 = $("#Question_2_2").val();
      if (!isQuestion_2_2) {
        //console.log( isQuestion_2 );
        $(".err_Question_2_2").html("<span class='red'>Please fill It</span>");
      } else {
        $(".err_Question_2_2").html("");
      }

      var isQuestion_2_3 = $("#Question_2_3").val();
      if (!isQuestion_2_3) {
        //console.log( isQuestion_2 );
        $(".err_Question_2_3").html("<span class='red'>Please fill It</span>");
      } else {
        $(".err_Question_2_3").html("");
      }

      var isQuestion_2_4 = $("#Question_2_4").val();
      if (!isQuestion_2_4) {
        //console.log( isQuestion_2 );
        $(".err_Question_2_4").html("<span class='red'>Please fill It</span>");
      } else {
        $(".err_Question_2_4").html("");
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
      var isQuestion_6_2 = validate_groupOfRadiobtn(
        $("input[name=Question_6_2]")
      );
      var isQuestion_6_3 = validate_groupOfRadiobtn(
        $("input[name=Question_6_3]")
      );
      var isQuestion_6_4 = validate_groupOfRadiobtn(
        $("input[name=Question_6_4]")
      );
      var isQuestion_6_5 = validate_groupOfRadiobtn(
        $("input[name=Question_6_5]")
      );
      if (
        !isQuestion_6 &&
        !isQuestion_6_2 &&
        !isQuestion_6_3 &&
        !isQuestion_6_4 &&
        !isQuestion_6_5
      ) {
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
      var isQuestion_82_ischeck = $("#Question_82").prop("checked");
      if (!isQuestion_8) {
        //console.log(isQuestion_8);
        $(".err_Question_8").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_8").html("");
      }

      var isQuestion_9 = validate_groupOfRadiobtn($("input[name=Question_9]"));
      if (!isQuestion_9) {
        //console.log(isQuestion_9);
        $(".err_Question_9").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_9").html("");
      }

      var isQuestion_10_1 = $("#Question_10_1").val();
      if (!isQuestion_10_1) {
        //console.log( isQuestion_10 );
        $(".err_Question_10_1").html("<span class='red'>Please fill It</span>");
      } else {
        $(".err_Question_10_1").html("");
      }

      var isQuestion_10_2 = $("#Question_10_2").val();
      if (!isQuestion_10_2) {
        //console.log( isQuestion_10 );
        $(".err_Question_10_2").html("<span class='red'>Please fill It</span>");
      } else {
        $(".err_Question_10_2").html("");
      }

      var isQuestion_10_3 = $("#Question_10_3").val();
      if (!isQuestion_10_3) {
        //console.log( isQuestion_10 );
        $(".err_Question_10_3").html("<span class='red'>Please fill It</span>");
      } else {
        $(".err_Question_10_3").html("");
      }

      var isQuestion_10_4 = $("#Question_10_4").val();
      if (!isQuestion_10_4) {
        //console.log( isQuestion_10 );
        $(".err_Question_10_4").html("<span class='red'>Please fill It</span>");
      } else {
        $(".err_Question_10_4").html("");
      }

      var isQuestion_11 = validate_groupOfRadiobtn(
        $("input[name=Question_11]")
      );
      if (!isQuestion_11) {
        //console.log(isQuestion_9);
        $(".err_Question_11").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_11").html("");
      }

      var isQuestion_12 = validate_groupOfRadiobtn(
        $("input[name=Question_12]")
      );
      //var isQuestion_12 = validate_groupOfRadiobtn($("input[name=Question_12][name=isQuestion_12_2]"));
      var isQuestion_12_2 = validate_groupOfRadiobtn(
        $("input[name=Question_12_2]")
      );
      var isQuestion_12_3 = validate_groupOfRadiobtn(
        $("input[name=Question_12_3]")
      );
      var isQuestion_12_4 = validate_groupOfRadiobtn(
        $("input[name=Question_12_4]")
      );
      var isQuestion_12_5 = validate_groupOfRadiobtn(
        $("input[name=Question_12_5]")
      );
      if (
        !isQuestion_12 &&
        !isQuestion_12_2 &&
        !isQuestion_12_3 &&
        !isQuestion_12_4 &&
        !isQuestion_12_5
      ) {
        //alert(isQuestion_3_2);
        //if (!isQuestion_3_2) {
        //console.log(isQuestion_3);
        $(".err_Question_12").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_12").html("");
      }

      var isQuestion_13 = validate_groupOfRadiobtn(
        $("input[name=Question_13]")
      );
      //var isQuestion_132_val = $('#Question_132').val();
      var isQuestion_132_ischeck = $("#Question_132").prop("checked");
      //alert(isQuestion_132_val + isQuestion_132_ischeck);
      if (!isQuestion_13) {
        //console.log(isQuestion_9);
        $(".err_Question_13").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_13").html("");
      }

      var isQuestion_14 = validate_groupOfRadiobtn(
        $("input[name=Question_14]")
      );
      if (!isQuestion_14) {
        //console.log(isQuestion_9);
        $(".err_Question_14").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_14").html("");
      }

      // var isQuestion_6 = $('input[name=Question_3]').prop('checked');
      // if(!isQuestion_6){
      //     //console.log(isQuestion_6);
      //     return false;
      // }

      if (
        isQuestion_1 == true &&
        isQuestion_2_1 != "" &&
        isQuestion_2_2 != "" &&
        isQuestion_2_3 != "" &&
        isQuestion_2_4 != "" &&
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
        // (
        // (isQuestion_9 == false && isQuestion_8 == true) ||
        // (isQuestion_9 == true && isQuestion_8 == true)
        // ) &&
        ((isQuestion_9 == false && isQuestion_82_ischeck == true) ||
          (isQuestion_9 == true && isQuestion_82_ischeck == false) ||
          (isQuestion_9 == true && isQuestion_82_ischeck == true)) &&
        isQuestion_10_1 != "" &&
        isQuestion_10_2 != "" &&
        isQuestion_10_3 != "" &&
        isQuestion_10_4 != "" &&
        isQuestion_11 == true &&
        (isQuestion_12 == true ||
          isQuestion_12_2 == true ||
          isQuestion_12_3 == true ||
          isQuestion_12_4 == true ||
          isQuestion_12_5 == true) &&
        isQuestion_13 == true &&
        // (
        // (isQuestion_14 == false && isQuestion_13 == true) ||
        // (isQuestion_14 == true && isQuestion_13 == true)
        // )
        ((isQuestion_14 == false && isQuestion_132_ischeck == true) ||
          (isQuestion_14 == true && isQuestion_132_ischeck == false) ||
          (isQuestion_14 == true && isQuestion_132_ischeck == true))
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
              window.location.href = "https://lifecare.docmode.org/thank-you";
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
      let isValid_ac_name,
        isValid_ac_number,
        isValid_ac_ifsc,
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

      var Isvalid_I_agree = validate_groupOfRadiobtn($("input[name=I_agree]"));
      if (!Isvalid_I_agree) {
        console.log(Isvalid_I_agree);
        $(".err_I_agree").html(
          "<span class='red'>This field is mandatory</span>"
        );
      } else {
        $(".err_I_agree").html("");
      }

      if (
        !Isvalid_I_agree ||
        //  !Isvalid_payment_choice ||
        !isValid_ac_name ||
        !isValid_ac_number ||
        !isValid_ac_ifsc ||
        !isValid_ac_canecel_cheque
      ) {
        //  console.log(Isvalid_I_agree + Isvalid_payment_choice);
        e.preventDefault();
        console.log("it is not working!");
        return false;
      } else {
        //console.log(Isvalid_I_agree + Isvalid_payment_choice);
        //return true;
      }
    });

    /**
     *
     * patient experience form
     *
     */
    // $("input[name=Question_8]").change(function (){
    //  console.log ( $("input[name=Question_8]:checked") ) ;
    // });

    $("input[type=radio][name=Is_it_a_CRE_case_questionmark_]").change(
      function () {
        // alert(this.value  + " Hi");
        if (this.value == "Yes") {
          //alert("Allot Thai Gayo Bhai");
          $("input[type=radio][name=What_type_of_Carbapenamase_it_is]").attr(
            "disabled",
            false
          );
          // $('input[type=radio][name=What_type_of_Carbapenamase_it_is]').attr("required",true);
          $("input[type=radio][id=Question_104]").attr("checked", false);
          $("#9_note").html("");
        } else if (this.value == "No") {
          $("input[type=radio][id=Question_104]").attr("checked", true);
          $("input[type=radio][name=What_type_of_Carbapenamase_it_is]").attr(
            "disabled",
            true
          );
          $("#9_note").html(
            "<span style='color:#4caf50;font-size:13px;'> Question 9 need not to be answered. <span>"
          );
        }
      }
    );

    $("input[type=radio][name=Adverse_event_seen]").change(function () {
      // alert(this.value  + " Hi");
      if (this.value == "Yes") {
        //alert("Allot Thai Gayo Bhai");
        //$('input[type=text][name=Adverse_event_seen_RLBRACKETS_other_RRBRACKETS_]').attr("disabled",false);
        $(
          "input[type=text][name=Adverse_event_seen_RLBRACKETS_other_RRBRACKETS_]"
        ).attr("required", true);
        // $('input[type=radio][id=Question_96]').attr("checked",false);
        // $('#9_note').html("");
      } else if (this.value == "No") {
        //$('input[type=radio][id=Question_96]').attr("checked",true);
        //$('input[type=text][name=Adverse_event_seen_RLBRACKETS_other_RRBRACKETS_]').attr("disabled",true);
        $(
          "input[type=text][name=Adverse_event_seen_RLBRACKETS_other_RRBRACKETS_]"
        ).val("");
        $(
          "input[type=text][name=Adverse_event_seen_RLBRACKETS_other_RRBRACKETS_]"
        ).attr("required", false);
        // $('#9_note').html("<span style='color:#e53935;font-size:13px;'> Question 9 need not to be answered. <span>");
      }
    });

    $("input[type=radio][name=Is_it_a_CRE_case_questionmark_]").change(
      function () {
        // alert(this.value  + " Hi");
        var Day1_Antibiotic_is_MSE = $(
          'input[name="Day1_Antibiotic_is_MSE"]:checked'
        ).serialize();
        var Day3_Antibiotic_is_MSE = $(
          'input[name="Day3_Antibiotic_is_MSE"]:checked'
        ).serialize();
        var Day5_Antibiotic_is_MSE = $(
          'input[name="Day5_Antibiotic_is_MSE"]:checked'
        ).serialize();
        var Antibiotic_End_of_treatment_is_MSE = $(
          'input[name="Antibiotic_End_of_treatment_is_MSE"]:checked'
        ).serialize();
        if (
          this.value == "No" ||
          Day1_Antibiotic_is_MSE == "Day1_Antibiotic_is_MSE=No" ||
          Day3_Antibiotic_is_MSE == "Day3_Antibiotic_is_MSE=No"
        ) {
          //$('#btn-submit-survey').hide();
          //$('#btn-submit-diable').show();
        } else if (this.value == "Yes") {
          //$('#btn-submit-survey').show();
          //$('#btn-submit-diable').hide();
        }
        if (this.value == "No") {
          $("input[type=radio][name=is_NDM]").attr("disabled", true);
          //$('input[type=radio][name=Is_it_a_CRE_case_questionmark_]').attr("disabled",true);
          //$('input[type=radio][name=What_type_of_Carbapenamase_it_is]').attr("disabled",true);

          $("input[type=radio][id=Question_103]").attr("checked", true);

          //$('input[type=radio][id=Question_93]').attr("checked",true);
          //$('input[type=radio][id=Question_104]').attr("checked",true);

          $(
            "input[type=text][name=Question_7_RLBRACKETS_other_RRBRACKETS_]"
          ).attr("disabled", true);
          $(
            "input[type=text][name=Question_7_RLBRACKETS_other_RRBRACKETS_]"
          ).attr("required", false);

          $("#10_note").html(
            "<span style='color:#4caf50;font-size:13px;'> Question 10 need not to be answered. <span>"
          );
        } else if (this.value == "Yes") {
          $("input[type=radio][id=Question_103]").attr("checked", false);
          //$('input[type=radio][id=Question_93]').attr("checked",false);
          //$('input[type=radio][id=Question_104]').attr("checked",false);

          $("input[type=radio][name=is_NDM]").attr("disabled", false);
          //$('input[type=radio][name=Is_it_a_CRE_case_questionmark_]').attr("disabled",false);
          //$('input[type=radio][name=What_type_of_Carbapenamase_it_is]').attr("disabled",false);

          $(
            "input[type=text][name=Question_7_RLBRACKETS_other_RRBRACKETS_]"
          ).attr("disabled", false);
          //$('input[type=text][name=Question_7_RLBRACKETS_other_RRBRACKETS_]').attr("required",true);

          $("#10_note").html("");
        }
      }
    );

    $("input[type=radio][name=Day1_Antibiotic_is_MSE]").change(function () {
      // alert(this.value  + " Hi");
      var Is_it_a_CRE_case_questionmark_ = $(
        'input[name="Is_it_a_CRE_case_questionmark_"]:checked'
      ).serialize();
      var Day5_Antibiotic_is_MSE = $(
        'input[name="Day5_Antibiotic_is_MSE"]:checked'
      ).serialize();
      var Day3_Antibiotic_is_MSE = $(
        'input[name="Day3_Antibiotic_is_MSE"]:checked'
      ).serialize();
      var Antibiotic_End_of_treatment_is_MSE = $(
        'input[name="Antibiotic_End_of_treatment_is_MSE"]:checked'
      ).serialize();
      if (
        this.value == "No" ||
        Is_it_a_CRE_case_questionmark_ == "Is_it_a_CRE_case_questionmark_=No" ||
        Day3_Antibiotic_is_MSE == "Day3_Antibiotic_is_MSE=No"
      ) {
        // $('#btn-submit-survey').hide();
        // $('#btn-submit-diable').show();
      } else if (this.value == "Yes") {
        // $('#btn-submit-survey').show();
        // $('#btn-submit-diable').hide();
      }
    });

    $("input[type=radio][name=Day3_Antibiotic_is_MSE]").change(function () {
      // alert(this.value  + " Hi");
      var Is_it_a_CRE_case_questionmark_ = $(
        'input[name="Is_it_a_CRE_case_questionmark_"]:checked'
      ).serialize();
      var Day1_Antibiotic_is_MSE = $(
        'input[name="Day1_Antibiotic_is_MSE"]:checked'
      ).serialize();
      var Day5_Antibiotic_is_MSE = $(
        'input[name="Day5_Antibiotic_is_MSE"]:checked'
      ).serialize();
      var Antibiotic_End_of_treatment_is_MSE = $(
        'input[name="Antibiotic_End_of_treatment_is_MSE"]:checked'
      ).serialize();
      if (
        this.value == "No" ||
        Is_it_a_CRE_case_questionmark_ == "Is_it_a_CRE_case_questionmark_=No" ||
        Day1_Antibiotic_is_MSE == "Day1_Antibiotic_is_MSE=No"
      ) {
        // $('#btn-submit-survey').hide();
        // $('#btn-submit-diable').show();
      } else if (this.value == "Yes") {
        // $('#btn-submit-survey').show();
        // $('#btn-submit-diable').hide();
      }
    });

    $("input[type=radio][name=Day5_Antibiotic_is_MSE]").change(function () {
      // alert(this.value  + " Hi");
      var Is_it_a_CRE_case_questionmark_ = $(
        'input[name="Is_it_a_CRE_case_questionmark_"]:checked'
      ).serialize();
      var Day1_Antibiotic_is_MSE = $(
        'input[name="Day1_Antibiotic_is_MSE"]:checked'
      ).serialize();
      var Day3_Antibiotic_is_MSE = $(
        'input[name="Day3_Antibiotic_is_MSE"]:checked'
      ).serialize();
      var Antibiotic_End_of_treatment_is_MSE = $(
        'input[name="Antibiotic_End_of_treatment_is_MSE"]:checked'
      ).serialize();
      if (
        Is_it_a_CRE_case_questionmark_ == "Is_it_a_CRE_case_questionmark_=No" ||
        Day1_Antibiotic_is_MSE == "Day1_Antibiotic_is_MSE=No" ||
        Day3_Antibiotic_is_MSE == "Day3_Antibiotic_is_MSE=No"
      ) {
        // $('#btn-submit-survey').hide();
        // $('#btn-submit-diable').show();
      } else if (this.value == "Yes") {
        // $('#btn-submit-survey').show();
        // $('#btn-submit-diable').hide();
      }
    });

    $("input[type=radio][name=Antibiotic_End_of_treatment_is_MSE]").change(
      function () {
        // alert(this.value  + " Hi");
        //alert($("#Question_12_1_2").is(":checked"));
        //alert($('input[name="Day1_Antibiotic_is_MSE"]:checked').serialize());
        var Is_it_a_CRE_case_questionmark_ = $(
          'input[name="Is_it_a_CRE_case_questionmark_"]:checked'
        ).serialize();
        var Day1_Antibiotic_is_MSE = $(
          'input[name="Day1_Antibiotic_is_MSE"]:checked'
        ).serialize();
        var Day3_Antibiotic_is_MSE = $(
          'input[name="Day3_Antibiotic_is_MSE"]:checked'
        ).serialize();
        var Day5_Antibiotic_is_MSE = $(
          'input[name="Day5_Antibiotic_is_MSE"]:checked'
        ).serialize();
        if (
          this.value == "No" ||
          Is_it_a_CRE_case_questionmark_ ==
            "Is_it_a_CRE_case_questionmark_=No" ||
          Day1_Antibiotic_is_MSE == "Day1_Antibiotic_is_MSE=No" ||
          Day3_Antibiotic_is_MSE == "Day3_Antibiotic_is_MSE=No"
        ) {
          // $('#btn-submit-survey').hide();
          // $('#btn-submit-diable').show();
        } else if (this.value == "Yes") {
          // $('#btn-submit-survey').show();
          // $('#btn-submit-diable').hide();
        }
      }
    );

    $("input[type=radio][name=MSE_Treatment_status]").change(function () {
      // alert(this.value  + " Hi");
      if (this.value == "Completed") {
        //$('input[type=radio][name=If_MSE_therapy_is_Discontinued_Replaced_Reason]').attr("disabled",true);
        $(
          "input[type=radio][name=If_MSE_therapy_is_Discontinued_Replaced_Reason]"
        ).attr("style", "display:none");

        $("input[type=radio][id=Question_175]").attr("checked", true);

        //$('input[type=text][name=Question_7_RLBRACKETS_other_RRBRACKETS_]').attr("disabled",true);
        //$('input[type=text][name=Question_7_RLBRACKETS_other_RRBRACKETS_]').attr("required",false);

        $("#16_note").html(
          "<span style='color:#4caf50;font-size:13px;'> Question 17 need not to be answered. <span>"
        );
      }
      //else if (this.value == 'Discontinued' || this.value == 'Replaced with other antibiotic') {
      else if (this.value == "Stopped or Replaced with other antibiotic") {
        $("input[type=radio][id=Question_175]").attr("checked", false);

        $(
          "input[type=radio][name=If_MSE_therapy_is_Discontinued_Replaced_Reason]"
        ).attr("style", "display:block");

        //$('input[type=text][name=Question_7_RLBRACKETS_other_RRBRACKETS_]').attr("disabled",false);
        //$('input[type=text][name=Question_7_RLBRACKETS_other_RRBRACKETS_]').attr("required",true);

        $("#16_note").html("");
      }
    });

    $(
      "input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]"
    ).hide();
    $(
      "input[type=radio][name=At_the_time_of_admission_patient_is_hemodynamically]"
    ).change(function () {
      if (this.value == "Unstable") {
        $(
          "input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]"
        ).show();
        $(
          "input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]"
        ).attr("disabled", false);
        $(
          "input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]"
        ).attr("required", true);
      } else if (this.value == "Stable") {
        $(
          "input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]"
        ).hide();
        $(
          "input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]"
        ).attr("disabled", true);
        $(
          "input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]"
        ).val("");
        $(
          "input[type=text][name=At_the_time_of_admission_patient_is_hemodynamically_RLBRACKETS_Unstable_RRBRACKETS_]"
        ).attr("required", false);
      }
    });

    $("#pef_response_date").text(get_created_date());

    var Question_12_11 = $("#Question_12_11").val();
    var Question_12_12 = $("#Question_12_12").val();
    var Question_131 = $("#Question_131").val();
    var isQuestion_13 = validate_groupOfRadiobtn(
      $("input[name=MSE_treatment_discontinued_COMMA_as_the_patient_BLANK_]")
    );
    //alert(Question_12_11);
    $("#Question_12_11").click(function (e) {
      //alert(isQuestion_13);
      $("#Question_131").prop("checked", false);
      $("#Question_132").prop("checked", false);
      $("#Question_133").prop("checked", false);
      $("#q13").hide();
    });

    $("#Question_12_12").click(function (e) {
      //alert(Question_12_11);
      $("#Question_131").prop("checked", false);
      $("#Question_132").prop("checked", false);
      $("#Question_133").prop("checked", false);
      $("#q13").hide();
    });

    $("#btn-submit-survey").click(function (e) {
      //alert(ajax_param.ajaxurl);
      e.preventDefault();
      ////console.log ($('#frm-survey').serialize() );
      var name_of_respondent = $("#name_of_respondent").text();
      //var val_question_12_11 = $('#Question_12_11').val();
      //var val_question_12_12 = $('#Question_12_12').val();
      //alert(name_of_respondent);
      var isQuestion_12_sub = validate_groupOfRadiobtn(
        $("input[name=MSE_treatment_incomplete_due_to]")
      );
      //var isQuestion_17 = validate_groupOfRadiobtn( $("input[name=If_MSE_therapy_is_Discontinued_Replaced_Reason]") );
      //alert(isQuestion_17);
      //alert($("#frm-PEF"));
      var isQuestion_9_proto = true;
      var isQuestion_11_1_proto = true;
      var isQuestion_12_1_proto = true;
      var JSONformdata = getFormData($("#frm-PEF"));
      //alert(JSONformdata);
      //alert(val_question_12_11+'/'+val_question_12_12+'/'+isQuestion_12_sub);

      var isQuestion_1_0 = $("#Question_1_0").val();
      if (!isQuestion_1_0) {
        //console.log( isQuestion_2 );
        $(".err_Question_1_0").html("<span class='red'>Please fill It</span>");
      } else {
        $(".err_Question_1_0").html("");
      }

      var isQuestion_1 = $("#Question_1").val();
      if (!isQuestion_1) {
        //console.log( isQuestion_2 );
        $(".err_Question_1").html("<span class='red'>Please fill It</span>");
      } else {
        $(".err_Question_1").html("");
      }

      var isQuestion_2 = validate_groupOfRadiobtn(
        $("input[name=Sex_of_the_patient]")
      );
      if (!isQuestion_2) {
        //console.log( isQuestion_2 );
        $(".err_Question_2").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_2").html("");
      }

      var isQuestion_3 = validate_groupOfRadiobtn($("input[name=ckd]"));
      if (!isQuestion_3) {
        //console.log(isQuestion_3);
        $(".err_Question_3").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_3").html("");
      }

      var isQuestion_4 = validate_groupOfRadiobtn(
        $("input[name=Hemodynamically_Stable]")
      );
      if (!isQuestion_4) {
        //console.log(isQuestion_4);
        $(".err_Question_4").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_4").html("");
      }

      var isQuestion_5 = validate_groupOfRadiobtn(
        $("input[name=Source_of_Infection]")
      );
      if (!isQuestion_5) {
        //console.log(isQuestion_5);
        $(".err_Question_5").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_5").html("");
      }

      var multiselect_unchecked_length = $(
        ".form-check-input._multiselect_Q6:not(:checked)"
      ).length;
      var multiselect_length = $(".form-check-input._multiselect_Q6").length;
      var isQuestion_6;
      if (multiselect_unchecked_length == multiselect_length) {
        isQuestion_6 = false;
        $(".err_Question_6").html(
          "<span class='red'>Please select any option</span>"
        );
        // return true;
      } else {
        isQuestion_6 = true;
        $(".err_Question_6").html("");
      }

      // var isQuestion_7 = validate_groupOfRadiobtn($("input[name=Culture_grown_in_sample]"));
      // if (!isQuestion_7) {
      //   //console.log(isQuestion_7);
      //   $(".err_Question_7").html(
      //     "<span class='red'>Please select any option</span>"
      //   );
      // } else {
      //   $(".err_Question_7").html("");
      // }

      var isQuestion_8 = validate_groupOfRadiobtn(
        $("input[name=Culture_positive_for]")
      );
      if (!isQuestion_8) {
        //console.log(isQuestion_8);
        $(".err_Question_8").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_8").html("");
      }

      var isQuestion_9 = validate_groupOfRadiobtn(
        $("input[name=Is_it_a_CRE_case_questionmark_]")
      );

      if (!isQuestion_9) {
        //console.log(isQuestion_9);
        $(".err_Question_9").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_9").html("");
      }

      if ($("#Question_92").prop("checked")) {
        isQuestion_9_proto = false;
        $(".err_Question_9_proto").html(
          "<span class='red'>As per protocol, this patient cannot be enrolled being CRE negative</span>"
        );
      }
      $("#Question_91").change(function () {
        isQuestion_9_proto = true;
        $(".err_Question_9_proto").html("");
      });

      var isQuestion_10 = validate_groupOfRadiobtn($("input[name=is_NDM]"));
      if (!isQuestion_10) {
        //console.log(isQuestion_10);
        $(".err_Question_10").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_10").html("");
      }

      var isQuestion_11_1 = validate_groupOfRadiobtn(
        $("input[name=Day1_Antibiotic_is_MSE]")
      );
      if (!isQuestion_11_1) {
        //console.log(isQuestion_10);
        $(".err_Question_11_1").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_11_1").html("");
      }

      if ($("#Question_11_1_2").prop("checked")) {
        isQuestion_11_1_proto = false;
        $(".err_Question_11_1_proto").html(
          "<span class='red'>As per protocol, this patient cannot be enrolled being MSE negative</span>"
        );
      }
      $("#Question_11_1").change(function () {
        isQuestion_11_1_proto = true;
        $(".err_Question_11_1_proto").html("");
      });

      var isQuestion_11_2 = $("#Question_11_2").val();
      if (!isQuestion_11_2) {
        //console.log( isQuestion_2 );
        $(".err_Question_11_2").html("<span class='red'>Please Select</span>");
      } else {
        $(".err_Question_11_2").html("");
      }

      // var isQuestion_11_3 = $('#Question_11_3').val();
      // if (!isQuestion_11_3) {
      //   //console.log( isQuestion_2 );
      //   $(".err_Question_11_3").html(
      //     "<span class='red'>Please Select</span>"
      //   );
      // } else {
      //   $(".err_Question_11_3").html("");
      // }

      var isQuestion_12_1 = validate_groupOfRadiobtn(
        $("input[name=Day3_Antibiotic_is_MSE]")
      );
      if (!isQuestion_12_1) {
        //console.log(isQuestion_10);
        $(".err_Question_12_1").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_12_1").html("");
      }

      if ($("#Question_12_1_2").prop("checked")) {
        isQuestion_12_1_proto = false;
        $(".err_Question_12_1_proto").html(
          "<span class='red'>As per protocol, this patient cannot be enrolled being MSE negative</span>"
        );
      }
      $("#Question_12_1").change(function () {
        isQuestion_12_1_proto = true;
        $(".err_Question_12_1_proto").html("");
      });

      var isQuestion_12_2 = $("#Question_12_2").val();
      if (!isQuestion_12_2) {
        //console.log( isQuestion_2 );
        $(".err_Question_12_2").html("<span class='red'>Please select</span>");
      } else {
        $(".err_Question_12_2").html("");
      }

      // var isQuestion_12_3 = $('#Question_12_3').val();
      // if (!isQuestion_12_3) {
      //   //console.log( isQuestion_2 );
      //   $(".err_Question_12_3").html(
      //     "<span class='red'>Please select</span>"
      //   );
      // } else {
      //   $(".err_Question_12_3").html("");
      // }

      var isQuestion_13_1 = validate_groupOfRadiobtn(
        $("input[name=Day5_Antibiotic_is_MSE]")
      );
      if (!isQuestion_13_1) {
        //console.log(isQuestion_10);
        $(".err_Question_13_1").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_13_1").html("");
      }

      var isQuestion_13_2 = $("#Question_13_2").val();
      if (!isQuestion_13_2) {
        //console.log( isQuestion_2 );
        $(".err_Question_13_2").html("<span class='red'>Please select</span>");
      } else {
        $(".err_Question_13_2").html("");
      }

      // var isQuestion_13_3 = $('#Question_13_3').val();
      // if (!isQuestion_13_3) {
      //   //console.log( isQuestion_2 );
      //   $(".err_Question_13_3").html(
      //     "<span class='red'>Please select</span>"
      //   );
      // } else {
      //   $(".err_Question_13_3").html("");
      // }

      var isQuestion_13_4 = validate_groupOfRadiobtn(
        $("input[name=Antibiotic_End_of_treatment_is_MSE]")
      );
      if (!isQuestion_13_4) {
        //console.log(isQuestion_10);
        $(".err_Question_13_4").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_13_4").html("");
      }

      var isQuestion_13_5 = $("#Question_13_5").val();
      if (!isQuestion_13_5) {
        //console.log( isQuestion_2 );
        $(".err_Question_13_5").html("<span class='red'>Please select</span>");
      } else {
        $(".err_Question_13_5").html("");
      }

      // var isQuestion_13_6 = $('#Question_13_6').val();
      // if (!isQuestion_13_6) {
      //   //console.log( isQuestion_2 );
      //   $(".err_Question_13_6").html(
      //     "<span class='red'>Please select</span>"
      //   );
      // } else {
      //   $(".err_Question_13_6").html("");
      // }

      var isQuestion_14 = validate_groupOfRadiobtn($("input[name=Fever_Day1]"));
      if (!isQuestion_14) {
        //console.log(isQuestion_10);
        $(".err_Question_14").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_14").html("");
      }

      var isQuestion_14_2 = validate_groupOfRadiobtn(
        $("input[name=Fever_Day3]")
      );
      if (!isQuestion_14_2) {
        //console.log(isQuestion_10);
        $(".err_Question_14_2").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_14_2").html("");
      }

      var isQuestion_14_3 = validate_groupOfRadiobtn(
        $("input[name=Fever_Day5]")
      );
      if (!isQuestion_14_3) {
        //console.log(isQuestion_10);
        $(".err_Question_14_3").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_14_3").html("");
      }

      var isQuestion_14_4 = validate_groupOfRadiobtn(
        $("input[name=Fever_End_of_the_treatment]")
      );
      if (!isQuestion_14_4) {
        //console.log(isQuestion_10);
        $(".err_Question_14_4").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_14_4").html("");
      }

      var isQuestion_15 = validate_groupOfRadiobtn(
        $("input[name=Culture_Status]")
      );
      if (!isQuestion_15) {
        //console.log(isQuestion_10);
        $(".err_Question_15").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_15").html("");
      }

      // var isQuestion_15_2 = validate_groupOfRadiobtn( $("input[name=End_of_Treatment]") );
      // if (!isQuestion_15_2) {
      //   //console.log(isQuestion_10);
      //   $(".err_Question_15_2").html(
      //     "<span class='red'>Please select any option</span>"
      //   );
      // } else {
      //   $(".err_Question_15_2").html("");
      // }

      var isQuestion_16 = validate_groupOfRadiobtn(
        $("input[name=MSE_Treatment_status]")
      );
      if (!isQuestion_16) {
        //console.log(isQuestion_10);
        $(".err_Question_16").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_16").html("");
      }

      var isQuestion_17 = validate_groupOfRadiobtn(
        $("input[name=If_MSE_therapy_is_Discontinued_Replaced_Reason]")
      );
      if (!isQuestion_17) {
        //console.log(isQuestion_10);
        $(".err_Question_17").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_17").html("");
      }

      var isQuestion_18 = validate_groupOfRadiobtn(
        $("input[name=Adverse_event_seen]")
      );
      if (!isQuestion_18) {
        //console.log(isQuestion_9);
        $(".err_Question_18").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_18").html("");
      }

      var isQuestion_19 = validate_groupOfRadiobtn(
        $("input[name=Survival_at_the_end_of_MSE_treatment]")
      );
      if (!isQuestion_19) {
        //console.log(isQuestion_10);
        $(".err_Question_19").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_19").html("");
      }

      if (
        isQuestion_1_0 != "" &&
        isQuestion_1 != "" &&
        isQuestion_2 == true &&
        isQuestion_3 == true &&
        isQuestion_4 == true &&
        isQuestion_5 == true &&
        isQuestion_6 == true &&
        //isQuestion_7 == true &&
        isQuestion_8 == true &&
        isQuestion_9 == true &&
        isQuestion_10 == true &&
        isQuestion_11_1 == true &&
        isQuestion_11_2 != "" &&
        // isQuestion_11_3 != '' &&
        isQuestion_12_1 == true &&
        isQuestion_9_proto == true &&
        isQuestion_11_1_proto == true &&
        isQuestion_12_1_proto == true &&
        isQuestion_12_2 != "" &&
        // isQuestion_12_3 != '' &&
        isQuestion_13_1 == true &&
        isQuestion_13_2 != "" &&
        // isQuestion_13_3 != '' &&
        isQuestion_13_4 == true &&
        isQuestion_13_5 != "" &&
        // isQuestion_13_6 != '' &&
        isQuestion_14 == true &&
        isQuestion_14_2 == true &&
        isQuestion_14_3 == true &&
        isQuestion_14_4 == true &&
        isQuestion_15 == true &&
        isQuestion_16 == true &&
        isQuestion_17 == true &&
        isQuestion_18 == true &&
        isQuestion_19 == true
        // (
        //   (isQuestion_12_sub == true) ||
        //   (isQuestion_13 == true)
        // ) &&
        // isQuestion_14 == true
      ) {
        //if(1)
        let dateandtime = get_created_date();
        let survey_id = $("#frm-PEF #pef_form_id").val();
        let page_slug = $("#frm-PEF #pef_page_slug").val();
        let patient_id = $("#frm-PEF #pef_patient_id").val();
        let form_url = $("#frm-PEF #form_url").val();
        //let form_status = $("#frm-PEF #form_status").val();
        let form_status = "Completed";
        let steps_completed = $("#frm-PEF #steps_completed").val();
        var $form = $("#frm-PEF");

        var quest = {};
        $("#frm-PEF input").each(function () {
          quest[$(this).attr("name")] = $(this).attr("data-question");
          //console.log($(this).attr('name') +" : "+$(this).attr('data-question'));
        });
        console.log(quest);

        var JSONformdata = getFormData($form);
        //console.log(JSONformdata);

        var parameters = {
          action: "asf_submit_survey_form",
          survey_id       : survey_id,
          page_slug       : page_slug,
          patient_id      : patient_id,
          form_url        : form_url,
          form_status     : form_status,
          steps_completed : steps_completed,
          form_data       : JSONformdata,
          created_date    : dateandtime,
          respondent_name : name_of_respondent,
          // question_set      : quest,
          nonce: ajax_param.nonce,
        };
        console.log(parameters);
        jQuery.ajax({
          type: "POST",
          url: ajax_param.ajaxurl,
          data: parameters,
          dataType: "json",
          beforeSend: function (arr, $form, options) {
            //check your conditions and return false to prevent the form submission
            // console.log("beforesend");
            $("#frm-PEF .response").html(
              '<span style = "color : orange" >Processing..</span>'
            );
          },
          success: function (response) {
            console.log("success");
            // let response_json = $.parseJSON(response);
            // console.log ( response);

            if (response.insID > 0) {
              $("#frm-PEF .response").html(
                "<span class = 'green' >Entry Submitted successfully!</span>"
              );
              window.location.href = response.redirect_url;
              // "https://lifecare.docmode.org/account-details/?sid=" + survey_id + "&sr=" + response;
            } else {
              $("#frm-PEF .response").html(
                "<span class = 'red' >Something went wrong </span>"
              );
            }
          }, //success end
          complete: function () {
            // console.log("complete");
            $("#frm-PEF .response").html(
              '<span style = "color : green" >Entry Submitted successfully!!</span>'
            );
            $("#btn-submit-survey").attr("disable", "disabled");
            $("#btn-submit-survey").prop("disabled", true);
          },
        }); //ajax end
      } else {
        //console.log("validation error");
      }
    });

    // partial submit

    $("#btn-partial-survey").click(function (e) {
      //alert(ajax_param.ajaxurl);
      e.preventDefault();
      ////console.log ($('#frm-survey').serialize() );
      var name_of_respondent = $("#name_of_respondent").text();
      //var val_question_12_11 = $('#Question_12_11').val();
      //var val_question_12_12 = $('#Question_12_12').val();
      //alert(name_of_respondent);
      var isQuestion_12_sub = validate_groupOfRadiobtn(
        $("input[name=MSE_treatment_incomplete_due_to]")
      );
      //var isQuestion_17 = validate_groupOfRadiobtn( $("input[name=If_MSE_therapy_is_Discontinued_Replaced_Reason]") );
      //alert(isQuestion_17);
      //alert($("#frm-PEF"));
      var isQuestion_9_proto = true;
      var isQuestion_11_1_proto = true;
      var isQuestion_12_1_proto = true;
      var JSONformdata = getFormData($("#frm-PEF"));
      //alert(JSONformdata);
      //alert(val_question_12_11+'/'+val_question_12_12+'/'+isQuestion_12_sub);

      var isQuestion_1_0 = $("#Question_1_0").val();
      if (!isQuestion_1_0) {
        //console.log( isQuestion_2 );
        $(".err_Question_1_0").html("<span class='red'></span>");
      } else {
        $(".err_Question_1_0").html("");
      }

      var isQuestion_1 = $("#Question_1").val();
      if (!isQuestion_1) {
        //console.log( isQuestion_2 );
        $(".err_Question_1").html("<span class='red'></span>");
      } else {
        $(".err_Question_1").html("");
      }

      var isQuestion_2 = validate_groupOfRadiobtn(
        $("input[name=Sex_of_the_patient]")
      );
      if (!isQuestion_2) {
        //console.log( isQuestion_2 );
        $(".err_Question_2").html("<span class='red'></span>");
      } else {
        $(".err_Question_2").html("");
      }

      var isQuestion_3 = validate_groupOfRadiobtn($("input[name=ckd]"));
      if (!isQuestion_3) {
        //console.log(isQuestion_3);
        $(".err_Question_3").html("<span class='red'></span>");
      } else {
        $(".err_Question_3").html("");
      }

      var isQuestion_4 = validate_groupOfRadiobtn(
        $("input[name=Hemodynamically_Stable]")
      );
      if (!isQuestion_4) {
        //console.log(isQuestion_4);
        $(".err_Question_4").html("<span class='red'></span>");
      } else {
        $(".err_Question_4").html("");
      }

      var isQuestion_5 = validate_groupOfRadiobtn(
        $("input[name=Source_of_Infection]")
      );
      if (!isQuestion_5) {
        //console.log(isQuestion_5);
        $(".err_Question_5").html("<span class='red'></span>");
      } else {
        $(".err_Question_5").html("");
      }

      var multiselect_unchecked_length = $(
        ".form-check-input._multiselect_Q6:not(:checked)"
      ).length;
      var multiselect_length = $(".form-check-input._multiselect_Q6").length;
      var isQuestion_6;
      if (multiselect_unchecked_length == multiselect_length) {
        isQuestion_6 = false;
        $(".err_Question_6").html("<span class='red'></span>");
        // return true;
      } else {
        isQuestion_6 = true;
        $(".err_Question_6").html("");
      }

      // var isQuestion_7 = validate_groupOfRadiobtn($("input[name=Culture_grown_in_sample]"));
      // if (!isQuestion_7) {
      //   //console.log(isQuestion_7);
      //   $(".err_Question_7").html(
      //     "<span class='red'></span>"
      //   );
      // } else {
      //   $(".err_Question_7").html("");
      // }

      var isQuestion_8 = validate_groupOfRadiobtn(
        $("input[name=Culture_positive_for]")
      );
      if (!isQuestion_8) {
        //console.log(isQuestion_8);
        $(".err_Question_8").html("<span class='red'></span>");
      } else {
        $(".err_Question_8").html("");
      }

      var isQuestion_9 = validate_groupOfRadiobtn(
        $("input[name=Is_it_a_CRE_case_questionmark_]")
      );

      if (!isQuestion_9) {
        //console.log(isQuestion_9);
        $(".err_Question_9").html("<span class='red'></span>");
      } else {
        $(".err_Question_9").html("");
      }

      if ($("#Question_92").prop("checked")) {
        isQuestion_9_proto = false;
        $(".err_Question_9_proto").html(
          "<span class='red'>As per protocol, this patient cannot be enrolled being CRE negative</span>"
        );
      }
      $("#Question_91").change(function () {
        isQuestion_9_proto = true;
        $(".err_Question_9_proto").html("");
      });

      var isQuestion_10 = validate_groupOfRadiobtn($("input[name=is_NDM]"));
      if (!isQuestion_10) {
        //console.log(isQuestion_10);
        $(".err_Question_10").html("<span class='red'></span>");
      } else {
        $(".err_Question_10").html("");
      }

      var isQuestion_11_1 = validate_groupOfRadiobtn(
        $("input[name=Day1_Antibiotic_is_MSE]")
      );
      if (!isQuestion_11_1) {
        //console.log(isQuestion_10);
        $(".err_Question_11_1").html("<span class='red'></span>");
      } else {
        $(".err_Question_11_1").html("");
      }

      if ($("#Question_11_1_2").prop("checked")) {
        isQuestion_11_1_proto = false;
        $(".err_Question_11_1_proto").html(
          "<span class='red'>As per protocol, this patient cannot be enrolled being MSE negative</span>"
        );
      }
      $("#Question_11_1").change(function () {
        isQuestion_11_1_proto = true;
        $(".err_Question_11_1_proto").html("");
      });

      var isQuestion_11_2 = $("#Question_11_2").val();
      if (!isQuestion_11_2) {
        //console.log( isQuestion_2 );
        $(".err_Question_11_2").html("<span class='red'></span>");
      } else {
        $(".err_Question_11_2").html("");
      }

      // var isQuestion_11_3 = $('#Question_11_3').val();
      // if (!isQuestion_11_3) {
      //   //console.log( isQuestion_2 );
      //   $(".err_Question_11_3").html(
      //     "<span class='red'>    //   );
      // } else {
      //   $(".err_Question_11_3").html("");
      // }

      var isQuestion_12_1 = validate_groupOfRadiobtn(
        $("input[name=Day3_Antibiotic_is_MSE]")
      );
      if (!isQuestion_12_1) {
        //console.log(isQuestion_10);
        $(".err_Question_12_1").html("<span class='red'></span>");
      } else {
        $(".err_Question_12_1").html("");
      }

      if ($("#Question_12_1_2").prop("checked")) {
        isQuestion_12_1_proto = false;
        $(".err_Question_12_1_proto").html(
          "<span class='red'>As per protocol, this patient cannot be enrolled being MSE negative</span>"
        );
      }
      $("#Question_12_1").change(function () {
        isQuestion_12_1_proto = true;
        $(".err_Question_12_1_proto").html("");
      });

      var isQuestion_12_2 = $("#Question_12_2").val();
      if (!isQuestion_12_2) {
        //console.log( isQuestion_2 );
        $(".err_Question_12_2").html("<span class='red'></span>");
      } else {
        $(".err_Question_12_2").html("");
      }

      // var isQuestion_12_3 = $('#Question_12_3').val();
      // if (!isQuestion_12_3) {
      //   //console.log( isQuestion_2 );
      //   $(".err_Question_12_3").html(
      //     "<span class='red'>    //   );
      // } else {
      //   $(".err_Question_12_3").html("");
      // }

      var isQuestion_13_1 = validate_groupOfRadiobtn(
        $("input[name=Day5_Antibiotic_is_MSE]")
      );
      if (!isQuestion_13_1) {
        //console.log(isQuestion_10);
        $(".err_Question_13_1").html("<span class='red'></span>");
      } else {
        $(".err_Question_13_1").html("");
      }

      var isQuestion_13_2 = $("#Question_13_2").val();
      if (!isQuestion_13_2) {
        //console.log( isQuestion_2 );
        $(".err_Question_13_2").html("<span class='red'></span>");
      } else {
        $(".err_Question_13_2").html("");
      }

      // var isQuestion_13_3 = $('#Question_13_3').val();
      // if (!isQuestion_13_3) {
      //   //console.log( isQuestion_2 );
      //   $(".err_Question_13_3").html(
      //     "<span class='red'>    //   );
      // } else {
      //   $(".err_Question_13_3").html("");
      // }

      var isQuestion_13_4 = validate_groupOfRadiobtn(
        $("input[name=Antibiotic_End_of_treatment_is_MSE]")
      );
      if (!isQuestion_13_4) {
        //console.log(isQuestion_10);
        $(".err_Question_13_4").html("<span class='red'></span>");
      } else {
        $(".err_Question_13_4").html("");
      }

      var isQuestion_13_5 = $("#Question_13_5").val();
      if (!isQuestion_13_5) {
        //console.log( isQuestion_2 );
        $(".err_Question_13_5").html("<span class='red'></span>");
      } else {
        $(".err_Question_13_5").html("");
      }

      // var isQuestion_13_6 = $('#Question_13_6').val();
      // if (!isQuestion_13_6) {
      //   //console.log( isQuestion_2 );
      //   $(".err_Question_13_6").html(
      //     "<span class='red'>    //   );
      // } else {
      //   $(".err_Question_13_6").html("");
      // }

      var isQuestion_14 = validate_groupOfRadiobtn($("input[name=Fever_Day1]"));
      if (!isQuestion_14) {
        //console.log(isQuestion_10);
        $(".err_Question_14").html("<span class='red'></span>");
      } else {
        $(".err_Question_14").html("");
      }

      var isQuestion_14_2 = validate_groupOfRadiobtn(
        $("input[name=Fever_Day3]")
      );
      if (!isQuestion_14_2) {
        //console.log(isQuestion_10);
        $(".err_Question_14_2").html("<span class='red'></span>");
      } else {
        $(".err_Question_14_2").html("");
      }

      var isQuestion_14_3 = validate_groupOfRadiobtn(
        $("input[name=Fever_Day5]")
      );
      if (!isQuestion_14_3) {
        //console.log(isQuestion_10);
        $(".err_Question_14_3").html("<span class='red'></span>");
      } else {
        $(".err_Question_14_3").html("");
      }

      var isQuestion_14_4 = validate_groupOfRadiobtn(
        $("input[name=Fever_End_of_the_treatment]")
      );
      if (!isQuestion_14_4) {
        //console.log(isQuestion_10);
        $(".err_Question_14_4").html("<span class='red'></span>");
      } else {
        $(".err_Question_14_4").html("");
      }

      var isQuestion_15 = validate_groupOfRadiobtn(
        $("input[name=Culture_Status]")
      );
      if (!isQuestion_15) {
        //console.log(isQuestion_10);
        $(".err_Question_15").html("<span class='red'></span>");
      } else {
        $(".err_Question_15").html("");
      }

      // var isQuestion_15_2 = validate_groupOfRadiobtn( $("input[name=End_of_Treatment]") );
      // if (!isQuestion_15_2) {
      //   //console.log(isQuestion_10);
      //   $(".err_Question_15_2").html(
      //     "<span class='red'></span>"
      //   );
      // } else {
      //   $(".err_Question_15_2").html("");
      // }

      var isQuestion_16 = validate_groupOfRadiobtn(
        $("input[name=MSE_Treatment_status]")
      );
      if (!isQuestion_16) {
        //console.log(isQuestion_10);
        $(".err_Question_16").html("<span class='red'></span>");
      } else {
        $(".err_Question_16").html("");
      }

      var isQuestion_17 = validate_groupOfRadiobtn(
        $("input[name=If_MSE_therapy_is_Discontinued_Replaced_Reason]")
      );
      if (!isQuestion_17) {
        //console.log(isQuestion_10);
        $(".err_Question_17").html("<span class='red'></span>");
      } else {
        $(".err_Question_17").html("");
      }

      var isQuestion_18 = validate_groupOfRadiobtn(
        $("input[name=Adverse_event_seen]")
      );
      if (!isQuestion_18) {
        //console.log(isQuestion_9);
        $(".err_Question_18").html("<span class='red'></span>");
      } else {
        $(".err_Question_18").html("");
      }

      var isQuestion_19 = validate_groupOfRadiobtn(
        $("input[name=Survival_at_the_end_of_MSE_treatment]")
      );
      if (!isQuestion_19) {
        //console.log(isQuestion_10);
        $(".err_Question_19").html("<span class='red'></span>");
      } else {
        $(".err_Question_19").html("");
      }

      if (
        // isQuestion_1_0 != '' &&
        // isQuestion_1 != '' &&
        // isQuestion_2 == true &&
        // isQuestion_3 == true &&
        // isQuestion_4 == true &&
        // isQuestion_5 == true &&
        // isQuestion_6 == true &&
        // //isQuestion_7 == true &&
        // isQuestion_8 == true &&
        isQuestion_9_proto == true &&
        // isQuestion_10 == true &&
        isQuestion_11_1_proto == true &&
        // isQuestion_11_2 != '' &&
        // // isQuestion_11_3 != '' &&
        isQuestion_12_1_proto == true
        // isQuestion_12_2 != '' &&
        // // isQuestion_12_3 != '' &&
        // isQuestion_13_1 == true &&
        // isQuestion_13_2 != '' &&
        // // isQuestion_13_3 != '' &&
        // isQuestion_13_4 == true &&
        // isQuestion_13_5 != '' &&
        // // isQuestion_13_6 != '' &&
        // isQuestion_14 == true &&
        // isQuestion_14_2 == true &&
        // isQuestion_14_3 == true &&
        // isQuestion_14_4 == true &&
        // isQuestion_15 == true &&
        // isQuestion_16 == true &&
        // isQuestion_17 == true &&
        // isQuestion_18 == true &&
        // isQuestion_19 == true
        // (
        //   (isQuestion_12_sub == true) ||
        //   (isQuestion_13 == true)
        // ) &&
        // isQuestion_14 == true
      ) {
        //if(1)
        let dateandtime = get_created_date();
        let survey_id = $("#frm-PEF #pef_form_id").val();
        let page_slug = $("#frm-PEF #pef_page_slug").val();
        let patient_id = $("#frm-PEF #pef_patient_id").val();
        let form_url = $("#frm-PEF #form_url").val();
        //let form_status = $("#frm-PEF #form_status").val();
        let form_status = "Partial";
        let steps_completed = $("#frm-PEF #steps_completed").val();
        var $form = $("#frm-PEF");

        var quest = {};
        $("#frm-PEF input").each(function () {
          quest[$(this).attr("name")] = $(this).attr("data-question");
          //console.log($(this).attr('name') +" : "+$(this).attr('data-question'));
        });
        console.log(quest);

        var JSONformdata = getFormData($form);
        //console.log(JSONformdata);

        var parameters = {
          action: "asf_submit_survey_form",
          survey_id: survey_id,
          page_slug: page_slug,
          patient_id: patient_id,
          form_url: form_url,
          form_status: form_status,
          steps_completed: steps_completed,
          form_data: JSONformdata,
          created_date: dateandtime,
          respondent_name: name_of_respondent,
          // question_set      : quest,
          nonce: ajax_param.nonce,
        };
        console.log(parameters);
        jQuery.ajax({
          type: "POST",
          url: ajax_param.ajaxurl,
          data: parameters,
          dataType: "json",
          beforeSend: function (arr, $form, options) {
            //check your conditions and return false to prevent the form submission
            // console.log("beforesend");
            $("#frm-PEF .response").html(
              '<span style = "color : orange" >Processing..</span>'
            );
          },
          success: function (response) {
            console.log("success");
            // let response_json = $.parseJSON(response);
            // console.log ( response);

            if (response.insID > 0) {
              $("#frm-PEF .response").html(
                "<span class = 'green' >Entry Submitted successfully!</span>"
              );
              window.location.href = response.redirect_url;
              // "https://lifecare.docmode.org/account-details/?sid=" + survey_id + "&sr=" + response;
            } else {
              $("#frm-PEF .response").html(
                "<span class = 'red' >Something went wrong </span>"
              );
            }
          }, //success end
          complete: function () {
            // console.log("complete");
            $("#frm-PEF .response").html(
              '<span style = "color : green" >Entry Submitted successfully!!</span>'
            );
            $("#btn-submit-survey").attr("disable", "disabled");
            $("#btn-submit-survey").prop("disabled", true);
          },
        }); //ajax end
      } else {
        //console.log("validation error");
      }
    });

    // survey 4230

    $("#submitBtn-4230").click(function (e) {
      alert("ajax_param.ajaxurl");
      e.preventDefault();
      var name_of_respondent = $("#name_of_respondent").val();
      var JSONformdata = getFormData($("#frm-PEF"));
      
      alert(JSONformdata);
      //alert(val_question_12_11+'/'+val_question_12_12+'/'+isQuestion_12_sub);

      var isQuestion_1 = $("#Question_1").val();
      if (!isQuestion_1) {
        //console.log( isQuestion_2 );
        $("#err_Question_1").html("<span class='red'>Please fill It</span>");
      } else {
        $("#err_Question_1").html("");
      }

      var isQuestion_2 = $("#Question_2").val();
      if (!isQuestion_2) {
        //console.log( isQuestion_2 );
        $("#err_Question_2").html("<span class='red'>Please fill It</span>");
      } else {
        $("#err_Question_2").html("");
      }

      var isQuestion_3 = $("#Question_3").val();
      if (!isQuestion_3) {
        //console.log( isQuestion_2 );
        $("#err_Question_3").html("<span class='red'>Please fill It</span>");
      } else {
        $("#err_Question_3").html("");
      }

      var isQuestion_4 = validate_groupOfRadiobtn(
        $("input[name=Gender]")
      );
      if (!isQuestion_4) {
        //console.log( isQuestion_2 );
        $("#err_Question_4").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $("#err_Question_4").html("");
      }

      var isQuestion_5_1a = $("#Question_5_1a").val();
      if (!isQuestion_5_1a) {
        //console.log( isQuestion_2 );
        $("#err_Question_5_1a").html("<span class='red'>Please fill It</span>");
      } else {
        $("#err_Question_5_1a").html("");
      }

      var isQuestion_5 = validate_groupOfRadiobtn(
        $("input[name=Dose_administered]")
      );
      if (!isQuestion_5) {
        //console.log( isQuestion_2 );
        $("#err_Question_5").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $("#err_Question_5").html("");
      }

      // var isQuestion_6 = $("#Question_6").val();
      // if (!isQuestion_6) {
      //   //console.log( isQuestion_2 );
      //   $("#err_Question_6").html("<span class='red'>Please fill It</span>");
      // } else {
      //   $("#err_Question_6").html("");
      // }

      var isQuestion_7 = validate_groupOfRadiobtn(
        $("input[name=What_is_the_primary_solid_tumor_diagnosis]")
      );
      if (!isQuestion_7) {
        //console.log( isQuestion_2 );
        $("#err_Question_7").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $("#err_Question_7").html("");
      }

      var isQuestion_8 = validate_groupOfRadiobtn(
        $("input[name=Was_the_scheduled_denosumab_dose]")
      );
      if (!isQuestion_8) {
        //console.log( isQuestion_2 );
        $("#err_Question_8").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $("#err_Question_8").html("");
      }

      var isQuestion_9 = $("#Question_9").val();
      if (!isQuestion_9) {
        //console.log( isQuestion_2 );
        $("#err_Question_9").html("<span class='red'>Please fill It</span>");
      } else {
        $("#err_Question_9").html("");
      }

      if (
        isQuestion_1 != "" &&
        isQuestion_2 != "" &&
        isQuestion_3 != "" &&
        isQuestion_4 == true &&
        isQuestion_5 != "" &&
        isQuestion_5_1a != "" &&
        // isQuestion_6 != "" &&
        isQuestion_7 == true &&
        isQuestion_8 == true &&
        isQuestion_9 != ""
        
      ) {

        alert("well");
        let dateandtime = get_created_date();
        let survey_id = $("#frm-PEF #pef_form_id").val();
        let page_slug = $("#frm-PEF #pef_page_slug").val();
        let patient_id = $("#frm-PEF #pef_patient_id").val();
        let visit_id;
        let respondent_name;
        let form_url = $("#frm-PEF #form_url").val();
        //let form_status = $("#frm-PEF #form_status").val();
        let form_status = "Completed";
        let steps_completed = $("#frm-PEF #steps_completed").val();
        var $form = $("#frm-PEF");

        alert(dateandtime+'/'+survey_id+'/'+page_slug+'/'+patient_id);
        var quest = {};
        $("#frm-PEF input").each(function () {
          quest[$(this).attr("name")] = $(this).attr("data-question");
          //console.log($(this).attr('name') +" : "+$(this).attr('data-question'));
        });
        console.log(quest);

        var JSONformdata = getFormData($form);
        //console.log(JSONformdata);

        var parameters = {
          action: "asf_submit_survey_form_multi_visit",
          survey_id       : survey_id,
          page_slug       : page_slug,
          patient_id      : patient_id,
          form_url        : form_url,
          form_status     : form_status,
          steps_completed : steps_completed,
          form_data       : JSONformdata,
          created_date    : dateandtime,
          respondent_name : name_of_respondent,
          visit_id        : 1,
          // question_set      : quest,
          nonce: ajax_param.nonce,
        };
        console.log(parameters);
        jQuery.ajax({
          type: "POST",
          url: ajax_param.ajaxurl,
          data: parameters,
          dataType: "json",
          beforeSend: function (arr, $form, options) {
            //check your conditions and return false to prevent the form submission
            // console.log("beforesend");
            $("#frm-PEF .response").html(
              '<span style = "color : orange" >Processing..</span>'
            );
          },
          success: function (response) {
            console.log("success");
            // let response_json = $.parseJSON(response);
            // console.log ( response);

            if (response.insID > 0) {
              $("#frm-PEF .response").html(
                "<span class = 'green' >Entry Submitted successfully!</span>"
              );
              window.location.href = response.redirect_url;
              // "https://lifecare.docmode.org/account-details/?sid=" + survey_id + "&sr=" + response;
            } else {
              $("#frm-PEF .response").html(
                "<span class = 'red' >Something went wrong </span>"
              );
            }
          }, //success end
          complete: function () {
            // console.log("complete");
            $("#frm-PEF .response").html(
              '<span style = "color : green" >Entry Submitted successfully!!</span>'
            );
            $("#btn-submit-survey").attr("disable", "disabled");
            $("#btn-submit-survey").prop("disabled", true);
          },
        }); //ajax end

      } else {
        //console.log("validation error");
      }

    });

    $("#submitBtn-4230-visit-2").click(function (e) {
      alert("ajax_param.ajaxurl");
      e.preventDefault();
      var name_of_respondent = $("#name_of_respondent").val();
      var JSONformdata = getFormData($("#frm-PEF"));
      alert(name_of_respondent);
      alert(JSONformdata);
      //alert(val_question_12_11+'/'+val_question_12_12+'/'+isQuestion_12_sub);

      var isQuestion_1 = $("#Question_1").val();
      if (!isQuestion_1) {
        //console.log( isQuestion_2 );
        $("#err_Question_1").html("<span class='red'>Please fill It</span>");
      } else {
        $("#err_Question_1").html("");
      }

      if (
        isQuestion_1 != ""
        
      ) {

        alert("well");
        //alert(name_of_respondent);
        let dateandtime = get_created_date();
        let survey_id = $("#frm-PEF #pef_form_id").val();
        let page_slug = $("#frm-PEF #pef_page_slug").val();
        let patient_id = $("#frm-PEF #pef_patient_id").val();
        let visit_id;
        let respondent_name;
        let form_url = $("#frm-PEF #form_url").val();
        //let form_status = $("#frm-PEF #form_status").val();
        let form_status = "Completed";
        let steps_completed = $("#frm-PEF #steps_completed").val();
        var $form = $("#frm-PEF");

        alert(dateandtime+'/'+survey_id+'/'+page_slug+'/'+patient_id);
        var quest = {};
        $("#frm-PEF input").each(function () {
          quest[$(this).attr("name")] = $(this).attr("data-question");
          //console.log($(this).attr('name') +" : "+$(this).attr('data-question'));
        });
        console.log(quest);

        var JSONformdata = getFormData($form);
        //console.log(JSONformdata);

        var parameters = {
          action: "asf_submit_survey_form_multi_visit",
          survey_id       : survey_id,
          page_slug       : page_slug,
          patient_id      : patient_id,
          form_url        : form_url,
          form_status     : form_status,
          steps_completed : steps_completed,
          form_data       : JSONformdata,
          created_date    : dateandtime,
          respondent_name : name_of_respondent,
          visit_id        : 2,
          // question_set      : quest,
          nonce: ajax_param.nonce,
        };
        console.log(parameters);
        jQuery.ajax({
          type: "POST",
          url: ajax_param.ajaxurl,
          data: parameters,
          dataType: "json",
          beforeSend: function (arr, $form, options) {
            //check your conditions and return false to prevent the form submission
            // console.log("beforesend");
            $("#frm-PEF .response").html(
              '<span style = "color : orange" >Processing..</span>'
            );
          },
          success: function (response) {
            console.log("success");
            // let response_json = $.parseJSON(response);
            // console.log ( response);

            if (response.insID > 0) {
              $("#frm-PEF .response").html(
                "<span class = 'green' >Entry Submitted successfully!</span>"
              );
              window.location.href = response.redirect_url;
              // "https://lifecare.docmode.org/account-details/?sid=" + survey_id + "&sr=" + response;
            } else {
              $("#frm-PEF .response").html(
                "<span class = 'red' >Something went wrong </span>"
              );
            }
          }, //success end
          complete: function () {
            // console.log("complete");
            $("#frm-PEF .response").html(
              '<span style = "color : green" >Entry Submitted successfully!!</span>'
            );
            $("#btn-submit-survey").attr("disable", "disabled");
            $("#btn-submit-survey").prop("disabled", true);
          },
        }); //ajax end

      } else {
        //console.log("validation error");
      }

    });

    $("#submitBtn-4230-visit-3").click(function (e) {
      alert("ajax_param.ajaxurl");
      e.preventDefault();
      var name_of_respondent = $("#name_of_respondent").val();
      var JSONformdata = getFormData($("#frm-PEF"));
      alert(name_of_respondent);
      alert(JSONformdata);
      //alert(val_question_12_11+'/'+val_question_12_12+'/'+isQuestion_12_sub);

      var isQuestion_1 = $("#Question_1").val();
      if (!isQuestion_1) {
        //console.log( isQuestion_2 );
        $("#err_Question_1").html("<span class='red'>Please fill It</span>");
      } else {
        $("#err_Question_1").html("");
      }

      if (
        isQuestion_1 != ""
        
      ) {

        alert("well");
        //alert(name_of_respondent);
        let dateandtime = get_created_date();
        let survey_id = $("#frm-PEF #pef_form_id").val();
        let page_slug = $("#frm-PEF #pef_page_slug").val();
        let patient_id = $("#frm-PEF #pef_patient_id").val();
        let visit_id;
        let respondent_name;
        let form_url = $("#frm-PEF #form_url").val();
        //let form_status = $("#frm-PEF #form_status").val();
        let form_status = "Completed";
        let steps_completed = $("#frm-PEF #steps_completed").val();
        var $form = $("#frm-PEF");

        alert(dateandtime+'/'+survey_id+'/'+page_slug+'/'+patient_id);
        var quest = {};
        $("#frm-PEF input").each(function () {
          quest[$(this).attr("name")] = $(this).attr("data-question");
          //console.log($(this).attr('name') +" : "+$(this).attr('data-question'));
        });
        console.log(quest);

        var JSONformdata = getFormData($form);
        //console.log(JSONformdata);

        var parameters = {
          action: "asf_submit_survey_form_multi_visit",
          survey_id       : survey_id,
          page_slug       : page_slug,
          patient_id      : patient_id,
          form_url        : form_url,
          form_status     : form_status,
          steps_completed : steps_completed,
          form_data       : JSONformdata,
          created_date    : dateandtime,
          respondent_name : name_of_respondent,
          visit_id        : 3,
          // question_set      : quest,
          nonce: ajax_param.nonce,
        };
        console.log(parameters);
        jQuery.ajax({
          type: "POST",
          url: ajax_param.ajaxurl,
          data: parameters,
          dataType: "json",
          beforeSend: function (arr, $form, options) {
            //check your conditions and return false to prevent the form submission
            // console.log("beforesend");
            $("#frm-PEF .response").html(
              '<span style = "color : orange" >Processing..</span>'
            );
          },
          success: function (response) {
            console.log("success");
            // let response_json = $.parseJSON(response);
            // console.log ( response);

            if (response.insID > 0) {
              $("#frm-PEF .response").html(
                "<span class = 'green' >Entry Submitted successfully!</span>"
              );
              window.location.href = response.redirect_url;
              // "https://lifecare.docmode.org/account-details/?sid=" + survey_id + "&sr=" + response;
            } else {
              $("#frm-PEF .response").html(
                "<span class = 'red' >Something went wrong </span>"
              );
            }
          }, //success end
          complete: function () {
            // console.log("complete");
            $("#frm-PEF .response").html(
              '<span style = "color : green" >Entry Submitted successfully!!</span>'
            );
            $("#btn-submit-survey").attr("disable", "disabled");
            $("#btn-submit-survey").prop("disabled", true);
          },
        }); //ajax end

      } else {
        //console.log("validation error");
      }

    });



    $("#submitBtn-4233-visit-2").click(function (e) {
      alert("ajax_param.ajaxurl");
      e.preventDefault();
      var name_of_respondent = $("#name_of_respondent").val();
      var JSONformdata = getFormData($("#frm-PEF"));
      alert(name_of_respondent);
      alert(JSONformdata);
      //alert(val_question_12_11+'/'+val_question_12_12+'/'+isQuestion_12_sub);

      var isQuestion_1 = $("#Question_1").val();
      if (!isQuestion_1) {
        //console.log( isQuestion_2 );
        $("#err_Question_1").html("<span class='red'>Please fill It</span>");
      } else {
        $("#err_Question_1").html("");
      }

      var upload_invoice_4230_2_file = $("#upload_invoice_4230_2")[0];

      var flag_upload_invoice_4230_2_file = false;
      alert(upload_invoice_4230_2_file.files.length); 
      if (upload_invoice_4230_2_file.files.length === 0) {
          $("#err_upload_invoice_4230_2").html("<span class='red'>Please upload a file</span>");
          flag_upload_invoice_4230_2_file = false;
      } else {
          $("#err_upload_invoice_4230_2").html("");
          flag_upload_invoice_4230_2_file = true;
      }


      if ( isQuestion_1 != ""  ) {

        alert("well");
        //alert(name_of_respondent);
        let dateandtime = get_created_date();
        let survey_id = $("#frm-PEF #pef_form_id").val();
        let page_slug = $("#frm-PEF #pef_page_slug").val();
        let patient_id = $("#frm-PEF #pef_patient_id").val();
        let visit_id;
        let respondent_name;
        let form_url = $("#frm-PEF #form_url").val();
        //let form_status = $("#frm-PEF #form_status").val();
        let form_status = "Completed";
        let steps_completed = $("#frm-PEF #steps_completed").val();
        var $form = $("#frm-PEF");

        alert(dateandtime+'/'+survey_id+'/'+page_slug+'/'+patient_id);
        var quest = {};
        $("#frm-PEF input").each(function () {
          quest[$(this).attr("name")] = $(this).attr("data-question");
          //console.log($(this).attr('name') +" : "+$(this).attr('data-question'));
        });
        console.log(quest);

        var JSONformdata = getFormData($form);
        //console.log(JSONformdata);

        var parameters = {
          action: "asf_submit_survey_form_multi_visit",
          survey_id       : survey_id,
          page_slug       : page_slug,
          patient_id      : patient_id,
          form_url        : form_url,
          form_status     : form_status,
          steps_completed : steps_completed,
          form_data       : JSONformdata,
          created_date    : dateandtime,
          respondent_name : name_of_respondent,
          visit_id        : 3,
          // question_set      : quest,
          nonce: ajax_param.nonce,
        };
        console.log(parameters);
        jQuery.ajax({
          type: "POST",
          url: ajax_param.ajaxurl,
          data: parameters,
          dataType: "json",
          beforeSend: function (arr, $form, options) {
            //check your conditions and return false to prevent the form submission
            // console.log("beforesend");
            $("#frm-PEF .response").html(
              '<span style = "color : orange" >Processing..</span>'
            );
          },
          success: function (response) {
            console.log("success");
            // let response_json = $.parseJSON(response);
            // console.log ( response);

            if (response.insID > 0) {
              $("#frm-PEF .response").html(
                "<span class = 'green' >Entry Submitted successfully!</span>"
              );
              window.location.href = response.redirect_url;
              // "https://lifecare.docmode.org/account-details/?sid=" + survey_id + "&sr=" + response;
            } else {
              $("#frm-PEF .response").html(
                "<span class = 'red' >Something went wrong </span>"
              );
            }
          }, //success end
          complete: function () {
            // console.log("complete");
            $("#frm-PEF .response").html(
              '<span style = "color : green" >Entry Submitted successfully!!</span>'
            );
            $("#btn-submit-survey").attr("disable", "disabled");
            $("#btn-submit-survey").prop("disabled", true);
          },
        }); //ajax end

      } else {
        //console.log("validation error");
      }

    });

    // ajax photo upload

    $('body').on('change', '#upload_invoice_4230_1', function() {
        //$('#cust_photo').on( 'change', function (e) {
        // var ajaxurl = '<?php //echo admin_url('admin-ajax.php'); ?>';
        alert('bbb');

        var isValid_photo;
        var ext = $("#upload_invoice_4230_1")
            .val()
            .split(".")
            .pop()
            .toLowerCase();
          if ($.inArray(ext, ["png", "jpg", "jpeg", "pdf"]) == -1) {
            console.log("invalid extension!");
            isValid_photo = false;
            $("#err_upload_invoice_4230_1").html(
              "<span class='red'>File type not allowed</span>"
            );
          } else {
            isValid_photo = true;
            $("#err_upload_invoice_4230_1").html("");
          
            var file_data = $(this).prop('files')[0];
            var form_data = new FormData();
            form_data.append('invoice', file_data);
            //form_data.append('action', 'file_upload_post_derma');
            form_data.append('visit_id', 1);

            jQuery.ajax({
              url: "/wp-content/themes/docmode_sure/inc/upload-invoice.php",
              type: 'POST',
              //patient_id: patient_id,
              contentType: false,
              processData: false,
              data: form_data,
              // beforeSend: function(){
              //   $('#loadingImage-post').show();
              //   $('#btn-disabled-survey-3044').show();
              //   $('#btn-submit-survey-3044').hide();
              // },
              success: function (response) {
                 //alert(response);
                 $('.field_cust_photo').html('<input type="hidden" name="invoice_file_upload" id="invoice_file_upload" value="'+response+'">');
              }

            });
        }
    

    });

    $('body').on('change', '#upload_invoice_4230_2', function() {
        //$('#cust_photo').on( 'change', function (e) {
        // var ajaxurl = '<?php //echo admin_url('admin-ajax.php'); ?>';
        alert('bbb');

        var isValid_photo;
        var ext = $("#upload_invoice_4230_2")
            .val()
            .split(".")
            .pop()
            .toLowerCase();
          if ($.inArray(ext, ["png", "jpg", "jpeg", "pdf"]) == -1) {
            console.log("invalid extension!");
            isValid_photo = false;
            $("#err_upload_invoice_4230_2").html(
              "<span class='red'>File type not allowed</span>"
            );
          } else {
            isValid_photo = true;
            $("#err_upload_invoice_4230_2").html("");
          
            var file_data = $(this).prop('files')[0];
            var form_data = new FormData();
            form_data.append('invoice', file_data);
            //form_data.append('action', 'file_upload_post_derma');
            form_data.append('visit_id', 2);

            jQuery.ajax({
              url: "/wp-content/themes/docmode_sure/inc/upload-invoice.php",
              type: 'POST',
              //patient_id: patient_id,
              contentType: false,
              processData: false,
              data: form_data,
              // beforeSend: function(){
              //   $('#loadingImage-post').show();
              //   $('#btn-disabled-survey-3044').show();
              //   $('#btn-submit-survey-3044').hide();
              // },
              success: function (response) {
                 //alert(response);
                 $('.field_cust_photo').html('<input type="hidden" name="invoice_file_upload" id="invoice_file_upload" value="'+response+'">');
              }

            });
        }
    

    });

    $('body').on('change', '#upload_invoice_4230_3', function() {
        //$('#cust_photo').on( 'change', function (e) {
        // var ajaxurl = '<?php //echo admin_url('admin-ajax.php'); ?>';
        alert('bbb');

        var isValid_photo;
        var ext = $("#upload_invoice_4230_3")
            .val()
            .split(".")
            .pop()
            .toLowerCase();
          if ($.inArray(ext, ["png", "jpg", "jpeg", "pdf"]) == -1) {
            console.log("invalid extension!");
            isValid_photo = false;
            $("#err_upload_invoice_4230_3").html(
              "<span class='red'>File type not allowed</span>"
            );
          } else {
            isValid_photo = true;
            $("#err_upload_invoice_4230_3").html("");
          
            var file_data = $(this).prop('files')[0];
            var form_data = new FormData();
            form_data.append('invoice', file_data);
            //form_data.append('action', 'file_upload_post_derma');
            form_data.append('visit_id', 3);

            jQuery.ajax({
              url: "/wp-content/themes/docmode_sure/inc/upload-invoice.php",
              type: 'POST',
              //patient_id: patient_id,
              contentType: false,
              processData: false,
              data: form_data,
              // beforeSend: function(){
              //   $('#loadingImage-post').show();
              //   $('#btn-disabled-survey-3044').show();
              //   $('#btn-submit-survey-3044').hide();
              // },
              success: function (response) {
                 //alert(response);
                 $('.field_cust_photo').html('<input type="hidden" name="invoice_file_upload" id="invoice_file_upload" value="'+response+'">');
              }

            });
        }
    

    });

    //Dropbox

    $("#upload_invoice_4230_12").click(function(){
      alert("aaa");
      $('input[type=file]').on('change', fileUpload);
    });

    function fileUpload(event){
          //alert("2111");
          var allowedFileTypes = 'image.*|application/pdf';
          //var allowedFileTypes = 'application/pdf';

          var allowedFileSize = 2024;

          // jQuery('#btn_submit_disable').css("display", "block");
          // jQuery('#btn_submit').css("display", "none");
          $('#err_upload_invoice_4230_12').html("uploading...");

          files = event.target.files;

          var data = new FormData();

          for(var i = 0; i < files.length; i++){
            var file = files[i];

            if(!file.type.match(allowedFileTypes)){
              $('#err_upload_invoice_4230_12').html("<span style='color:red;'>File type not supported! Only ['pdf'] allowed.</span>");
              // jQuery('#cert_validate').css("display", "none");
              // jQuery('#btn_submit_disable').css("display", "block");
              // jQuery('#btn_submit').css("display", "none");
                  
            }
            else if(file.size > (allowedFileSize*1024)){
              $('#err_upload_invoice_4230_12').html("<span style='color:red;'>File is larger</span>");
              // jQuery('#cert_validate').css("display", "none");
              //  jQuery('#btn_submit_disable').css("display", "block");
              // jQuery('#btn_submit').css("display", "none");
            }else{
              data.append('file', file, file.name);
              data.append('visit_id', 1);

              var xhr = new XMLHttpRequest();

              //xhr.open('POST', 'https://ispen.org.in/upload-photo/', true);
              xhr.open('POST', '/wp-content/themes/docmode_sure/inc/upload-invoice-2.php', true);
              xhr.send(data);
              xhr.onload = function(){

                var response = JSON.parse(xhr.responseText);

                if(xhr.status === 200 && response.status == 'ok'){
                  //$('#dropBox').html("<span style='color:green;'>File uploded</span>");
                  $('#err_upload_invoice_4230_12').html("");
                  $('.field_cust_photo2').html('<input type="hidden" name="invoice_file_upload2" id="invoice_file_upload2" value="'+response.filename+'">');
                 // jQuery('#btn_submit_disable').css("display", "none");
                 //  jQuery('#btn_submit').css("display", "block");
                 //  jQuery('#cert_validate').css("display", "none");
                  //jQuery('#btn_submit').css("display", "none");
                }
                else if(response.status == 'type_err'){
                  $('#err_upload_invoice_4230_12').html("<span style='color:red;'>File extention err</span>");
                //   jQuery('#cert_validate').css("display", "none");
                //   jQuery('#btn_submit_disable').css("display", "block");
                // jQuery('#btn_submit').css("display", "none");
                }else{
                  $('#err_upload_invoice_4230_12').html("<span style='color:red;'>Something went wrong</span>");
                  // jQuery('#cert_validate').css("display", "none");
                  //  jQuery('#btn_submit_disable').css("display", "block");
                  // jQuery('#btn_submit').css("display", "none");
                }

              };
            }
          }
    }

    // save NMFe form

    $("#btn-submit-survey-nmfe").click(function (e) {
      //alert(ajax_param.ajaxurl);
      e.preventDefault();
      var name_of_respondent = $("#name_of_respondent").text();

      var JSONformdata = getFormData($("#frm-PEF"));
      

      var isQuestion_1 = validate_groupOfRadiobtn(
        $("input[name=how_many_cases_of_severe_dry_skin]")
      );
      if (!isQuestion_1) {
        //console.log( isQuestion_2 );
        $(".err_Question_1").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_1").html("");
      }

      var isQuestion_2 = validate_groupOfRadiobtn(
        $("input[name=treatment_in_your_practice_for_severe_dry_skin]")
      );
      if (!isQuestion_2) {
        //console.log( isQuestion_2 );
        $(".err_Question_2").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_2").html("");
      }

      var isQuestion_3 = validate_groupOfRadiobtn(
        $("input[name=how_many_of_your_patients_with_eczema]")
      );
      if (!isQuestion_3) {
        //console.log( isQuestion_3 );
        $(".err_Question_3").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_3").html("");
      }

      var isQuestion_4 = validate_groupOfRadiobtn(
        $("input[name=what_percentage_of_your_patients_with_psoriasis]")
      );
      if (!isQuestion_4) {
        //console.log( isQuestion_4 );
        $(".err_Question_4").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_4").html("");
      }

      var isQuestion_5 = validate_groupOfRadiobtn(
        $("input[name=in_which_condition_do_you_find_nmfe_max_cream]")
      );
      if (!isQuestion_5) {
        //console.log( isQuestion_5 );
        $(".err_Question_5").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_5").html("");
      }

      var isQuestion_6 = validate_groupOfRadiobtn(
        $("input[name=What_key_benefit_do_you_observe_when_using_NMFe_Max_Cream]")
      );
      if (!isQuestion_6) {
        //console.log( isQuestion_6 );
        $(".err_Question_6").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_6").html("");
      }

      var isQuestion_7 = validate_groupOfRadiobtn(
        $("input[name=How_would_you_rate_the_effectiveness_of_NMFe_Max]")
      );
      if (!isQuestion_7) {
        //console.log( isQuestion_7 );
        $(".err_Question_7").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_7").html("");
      }

      var isQuestion_8 = validate_groupOfRadiobtn(
        $("input[name=What_improvement_do_patients_most_commonly_report_after_using_NMFe_Max_Cream]")
      );
      if (!isQuestion_8) {
        //console.log( isQuestion_8 );
        $(".err_Question_8").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_8").html("");
      }

      var isQuestion_9 = validate_groupOfRadiobtn(
        $("input[name=How_soon_do_patients_experience_relief_from_dry_skin_after_using_NMFe_Max]")
      );
      if (!isQuestion_9) {
        //console.log( isQuestion_9 );
        $(".err_Question_9").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_9").html("");
      }

      var isQuestion_10 = validate_groupOfRadiobtn(
        $("input[name=What_patient_group_benefits_the_most_from_NMFe_Max]")
      );
      if (!isQuestion_10) {
        //console.log( isQuestion_10 );
        $(".err_Question_10").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_10").html("");
      }

      var isQuestion_11 = validate_groupOfRadiobtn(
        $("input[name=How_does_NMFe_Max_compare_to_other_formulations_in_patient_outcomes]")
      );
      if (!isQuestion_11) {
        //console.log( isQuestion_11 );
        $(".err_Question_11").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_11").html("");
      }

      var isQuestion_12 = validate_groupOfRadiobtn(
        $("input[name=Which_feature_of_NMFe_Max_differentiates_it_from_competitors]")
      );
      if (!isQuestion_12) {
        //console.log( isQuestion_12 );
        $(".err_Question_12").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_12").html("");
      }

      var isQuestion_13 = validate_groupOfRadiobtn(
        $("input[name=In_terms_of_safety_how_does_NMFe_Max_compare_to_other_options]")
      );
      if (!isQuestion_13) {
        //console.log( isQuestion_13 );
        $(".err_Question_13").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_13").html("");
      }

      var isQuestion_14 = validate_groupOfRadiobtn(
        $("input[name=How_do_plant_derived_ceramides_in_NMFe_Max_improve_therapy_outcomes]")
      );
      if (!isQuestion_14) {
        //console.log( isQuestion_14 );
        $(".err_Question_14").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_14").html("");
      }

      var isQuestion_15 = validate_groupOfRadiobtn(
        $("input[name=How_important_is_the_use_of_plant_derived_ceramides_for_sensitive_skin_conditions]")
      );
      if (!isQuestion_15) {
        //console.log( isQuestion_15 );
        $(".err_Question_15").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_15").html("");
      }

      var isQuestion_16 = validate_groupOfRadiobtn(
        $("input[name=How_does_the_lamellar_liquid_crystalline_form_of_ceramide_enhance_its_functionality]")
      );
      if (!isQuestion_16) {
        //console.log( isQuestion_16 );
        $(".err_Question_16").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_16").html("");
      }

      var isQuestion_17 = validate_groupOfRadiobtn(
        $("input[name=What_benefit_does_the_lamellar_structure_provide_in_treating_severe_dry_skin]")
      );
      if (!isQuestion_17) {
        //console.log( isQuestion_17 );
        $(".err_Question_17").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_17").html("");
      }

      var isQuestion_18 = validate_groupOfRadiobtn(
        $("input[name=Which_ingredient_in_NMFe_Max_is_most_effective_in_reducing_environmental_damage]")
      );
      if (!isQuestion_18) {
        //console.log( isQuestion_18 );
        $(".err_Question_18").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_18").html("");
      }

      var isQuestion_19 = validate_groupOfRadiobtn(
        $("input[name=How_would_you_rate_the_overall_patient_compliance_with_NMFe_Max_Cream]")
      );
      if (!isQuestion_19) {
        //console.log( isQuestion_19 );
        $(".err_Question_19").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_19").html("");
      }

      var isQuestion_20 = validate_groupOfRadiobtn(
        $("input[name=How_well_do_patients_tolerate_NMFe_Max_Cream_compared_to_other_moisturizing_treatments]")
      );
      if (!isQuestion_20) {
        //console.log( isQuestion_20 );
        $(".err_Question_20").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_20").html("");
      }

      var isQuestion_21 = validate_groupOfRadiobtn(
        $("input[name=How_satisfied_are_your_patients_with_the_results_of_NMFe_Max_Cream]")
      );
      if (!isQuestion_21) {
        //console.log( isQuestion_21 );
        $(".err_Question_21").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_21").html("");
      }

      var isQuestion_22 = validate_groupOfRadiobtn(
        $("input[name=percentage_of_your_patients_report_improved_skin_hydration_and_barrier_function_with_NMFe_Max]")
      );
      if (!isQuestion_22) {
        //console.log( isQuestion_22 );
        $(".err_Question_22").html(
          "<span class='red'>Please select any option</span>"
        );
      } else {
        $(".err_Question_22").html("");
      }

      

      if (
        isQuestion_1 == true &&
        isQuestion_2 == true &&
        isQuestion_3 == true &&
        isQuestion_4 == true &&
        isQuestion_5 == true &&
        isQuestion_6 == true &&
        isQuestion_7 == true &&
        isQuestion_8 == true &&
        isQuestion_9 == true &&
        isQuestion_10 == true &&
        isQuestion_11 == true &&
        isQuestion_12 == true &&
        isQuestion_13 == true &&
        isQuestion_14 == true &&
        isQuestion_15 == true &&
        isQuestion_16 == true &&
        isQuestion_17 == true &&
        isQuestion_18 == true &&
        isQuestion_19 == true &&
        isQuestion_20 == true &&
        isQuestion_21 == true &&
        isQuestion_22 == true
      ) {
        //if(1)
        let dateandtime = get_created_date();
        let survey_id = $("#frm-PEF #pef_form_id").val();
        let page_slug = $("#frm-PEF #pef_page_slug").val();
        let patient_id = $("#frm-PEF #pef_patient_id").val();
        let form_url = $("#frm-PEF #form_url").val();
        //let form_status = $("#frm-PEF #form_status").val();
        let form_status = "Completed";
        let steps_completed = $("#frm-PEF #steps_completed").val();
        var $form = $("#frm-PEF");

        var quest = {};
        $("#frm-PEF input").each(function () {
          quest[$(this).attr("name")] = $(this).attr("data-question");
          //console.log($(this).attr('name') +" : "+$(this).attr('data-question'));
        });
        console.log(quest);

        var JSONformdata = getFormData($form);
        //console.log(JSONformdata);

        var parameters = {
          action: "asf_submit_survey_form",
          survey_id       : survey_id,
          page_slug       : page_slug,
          patient_id      : patient_id,
          form_url        : form_url,
          form_status     : form_status,
          steps_completed : steps_completed,
          form_data       : JSONformdata,
          created_date    : dateandtime,
          respondent_name : name_of_respondent,
          // question_set      : quest,
          nonce: ajax_param.nonce,
        };
        console.log(parameters);
        jQuery.ajax({
          type: "POST",
          url: ajax_param.ajaxurl,
          data: parameters,
          dataType: "json",
          beforeSend: function (arr, $form, options) {
            //check your conditions and return false to prevent the form submission
            // console.log("beforesend");
            $("#frm-PEF .response").html(
              '<span style = "color : orange" >Processing..</span>'
            );
          },
          success: function (response) {
            console.log("success");
            // let response_json = $.parseJSON(response);
            // console.log ( response);

            if (response.insID > 0) {
              $("#frm-PEF .response").html(
                "<span class = 'green' >Entry Submitted successfully!</span>"
              );
              window.location.href = response.redirect_url;
              // "https://lifecare.docmode.org/account-details/?sid=" + survey_id + "&sr=" + response;
            } else {
              $("#frm-PEF .response").html(
                "<span class = 'red' >Something went wrong </span>"
              );
            }
          }, //success end
          complete: function () {
            // console.log("complete");
            $("#frm-PEF .response").html(
              '<span style = "color : green" >Entry Submitted successfully!!</span>'
            );
            $("#btn-submit-survey").attr("disable", "disabled");
            $("#btn-submit-survey").prop("disabled", true);
          },
        }); //ajax end
      } else {
        //console.log("validation error");
      }
    });

    // partial save NMFe form

    $("#btn-partial-survey-nmfe").click(function (e) {
      //alert(ajax_param.ajaxurl);
      e.preventDefault();
      ////console.log ($('#frm-survey').serialize() );
      var name_of_respondent = $("#name_of_respondent").text();
      
      var JSONformdata = getFormData($("#frm-PEF"));
      //alert(JSONformdata);
      //alert(val_question_12_11+'/'+val_question_12_12+'/'+isQuestion_12_sub);

      

      if (1==1) {
        //if(1)
        let dateandtime = get_created_date();
        let survey_id = $("#frm-PEF #pef_form_id").val();
        let page_slug = $("#frm-PEF #pef_page_slug").val();
        let patient_id = $("#frm-PEF #pef_patient_id").val();
        let form_url = $("#frm-PEF #form_url").val();
        //let form_status = $("#frm-PEF #form_status").val();
        let form_status = "Partial";
        let steps_completed = $("#frm-PEF #steps_completed").val();
        var $form = $("#frm-PEF");

        var quest = {};
        $("#frm-PEF input").each(function () {
          quest[$(this).attr("name")] = $(this).attr("data-question");
          //console.log($(this).attr('name') +" : "+$(this).attr('data-question'));
        });
        console.log(quest);

        var JSONformdata = getFormData($form);
        //console.log(JSONformdata);

        var parameters = {
          action: "asf_submit_survey_form",
          survey_id: survey_id,
          page_slug: page_slug,
          patient_id: patient_id,
          form_url: form_url,
          form_status: form_status,
          steps_completed: steps_completed,
          form_data: JSONformdata,
          created_date: dateandtime,
          respondent_name: name_of_respondent,
          // question_set      : quest,
          nonce: ajax_param.nonce,
        };
        console.log(parameters);
        jQuery.ajax({
          type: "POST",
          url: ajax_param.ajaxurl,
          data: parameters,
          dataType: "json",
          beforeSend: function (arr, $form, options) {
            //check your conditions and return false to prevent the form submission
            // console.log("beforesend");
            $("#frm-PEF .response").html(
              '<span style = "color : orange" >Processing..</span>'
            );
          },
          success: function (response) {
            console.log("success");
            // let response_json = $.parseJSON(response);
            // console.log ( response);

            if (response.insID > 0) {
              $("#frm-PEF .response").html(
                "<span class = 'green' >Entry Submitted successfully!</span>"
              );
              window.location.href = response.redirect_url;
              // "https://lifecare.docmode.org/account-details/?sid=" + survey_id + "&sr=" + response;
            } else {
              $("#frm-PEF .response").html(
                "<span class = 'red' >Something went wrong </span>"
              );
            }
          }, //success end
          complete: function () {
            // console.log("complete");
            $("#frm-PEF .response").html(
              '<span style = "color : green" >Entry Submitted successfully!!</span>'
            );
            $("#btn-submit-survey").attr("disable", "disabled");
            $("#btn-submit-survey").prop("disabled", true);
          },
        }); //ajax end
      } else {
        //console.log("validation error");
      }
    });
  }); //document

  /**
   * 
   * For Smile code Start
   * 
   */
  
  $('input[name="diabetes_medication"]').change(function() {
    // console.log($(this).val() );
    if ($(this).val() === 'Others') {
        $('input[name="diabetes_medication_others"]').show();
    } else {
        $('input[name="diabetes_medication_others"]').hide();
    }

    if ($(this).val() === 'Both') {
      if ($(this).is(':checked')) {
        $('input[name="diabetes_medication"][value="Only_OHA"]').prop('checked', false);
        $('input[name="diabetes_medication"][value="Only_Insulin"]').prop('checked', false);
      }
    }

    if ($(this).val() === 'Only_OHA' || $(this).val() === 'Only_Insulin' ) {
      if ($(this).is(':checked')) {
        $('input[name="diabetes_medication"][value="Both"]').prop('checked', false);
        // $('input[name="diabetes_medication"][value="Only_Insulin"]').prop('checked', false);
      }
    }
    
  });

  // laboratory_results_HBA1C
  // laboratory_results_FPBS
  // laboratory_results_PPBS
  $('input[name="laboratory_results"]').change(function() {
     console.log($(this).val() );
     if ($(this).val() === 'Not_Available') {
      if ($(this).is(':checked')) {
        $('input[name="laboratory_results"][value="HBA1C"]').prop('checked', false);
        $('input[name="laboratory_results"][value="FPBS"]').prop('checked', false);
        $('input[name="laboratory_results"][value="PPBS"]').prop('checked', false);
        $('input[name = "laboratory_results_HBA1C" ]').hide();
        $('input[name = "laboratory_results_FPBS" ]').hide();
        $('input[name = "laboratory_results_PPBS" ]').hide();
      }

    }

    // if ($(this).val() === 'Both') {
    //   if ($(this).is(':checked')) {
    //     $('input[name="diabetes_medication"][value="Only_OHA"]').prop('checked', false);
    //     $('input[name="diabetes_medication"][value="Only_Insulin"]').prop('checked', false);
    //   }
    // }

    if ($(this).val() === 'HBA1C' || $(this).val() === 'FPBS' || $(this).val() === 'PPBS' ) {
      if ($(this).is(':checked')) {
        $('input[name="laboratory_results"][value="Not_Available"]').prop('checked', false);
        $('input[name = "laboratory_results_'+ $(this).val() +'" ]').show();
      }else{
        $('input[name = "laboratory_results_'+ $(this).val() +'" ]').hide();
      }
    }
    
  });

  

  $('input[name="How_often_you_do_exercise"]').change(function() {
    // console.log($(this).val() );
    if ($(this).val() === 'Others') {
        $('input[name="How_often_you_do_exercise_others"]').show();
    } else {
        $('input[name="How_often_you_do_exercise_others"]').hide();
    }
  });
  

  

  $("#btn-submit-survey-smile").click(function (e) {
    e.preventDefault();
    let isQuestion_sub_initial = $("#pef_subject_initial").val();
    let isQuestion_age = $("#pef_age_in_years").val();
    let isQuestion_gender = $("#pef_gender").val();
    let pef_weight = $("#pef_weight").val();
    let pef_height = $("#pef_height").val();
    let diabetes_age = $("#diabetes_age").val();

    var diabetes_medication = [];
    $('input[name="diabetes_medication"]:checked').each(function() {
      diabetes_medication.push($(this).val());
    });
    let diabetes_medication_val = diabetes_medication.join(", ")
    //console.log(diabetes_medication.length);

    let diabetes_medication_others = $('input[name="diabetes_medication_others"]').val();

    // let laboratory_results = $('input[name="laboratory_results"]:checked').val();

    var laboratory_results = [];
    $('input[name="laboratory_results"]:checked').each(function() {
      laboratory_results.push($(this).val());
    });

    let laboratory_results_val = laboratory_results.join(", ")
     console.log(laboratory_results); 
    

    let laboratory_results_HBA1C = $("input[name='laboratory_results_HBA1C']").val();
    let laboratory_results_FPBS = $("input[name='laboratory_results_FPBS']").val();
    let laboratory_results_PPBS = $("input[name='laboratory_results_PPBS']").val();
    // let Do_you_have_with_any_diabetic_complications = $('input[name="Do_you_have_with_any_diabetic_complications"]:checked').val();
    //let Yes_diabetic_complication = $('input[name="Yes_diabetic_complication"]').val();
    let Do_you_have_with_any_diabetic_complications_diabetic_retinopathy = $('input[name="Do_you_have_with_any_diabetic_complications_diabetic_retinopathy"]:checked').val();
    let Do_you_have_with_any_diabetic_complications_neuropathy = $('input[name="Do_you_have_with_any_diabetic_complications_neuropathy"]:checked').val();
    let Do_you_have_with_any_diabetic_complications_nephropathy = $('input[name="Do_you_have_with_any_diabetic_complications_nephropathy"]:checked').val();

    let Regarding_diabetes_have_you_recently_felt_Angry = $('input[name="Regarding_diabetes_have_you_recently_felt_Angry"]:checked').val();
    let Regarding_diabetes_have_you_recently_felt_Sad = $('input[name="Regarding_diabetes_have_you_recently_felt_Sad"]:checked').val();
    let Regarding_diabetes_have_you_recently_felt_Scared = $('input[name="Regarding_diabetes_have_you_recently_felt_Scared"]:checked').val();
    let Regarding_diabetes_have_you_recently_felt_Stressed = $('input[name="Regarding_diabetes_have_you_recently_felt_Stressed"]:checked').val();
    let Smoke = $('input[name="Smoke"]:checked').val()
    let How_often_you_do_exercise = $('input[name="How_often_you_do_exercise"]:checked').val();
    let How_often_you_do_exercise_others = $('input[name="How_often_you_do_exercise_others"]').val();
    let little_interest_or_pleasure_in_doing_things = $('input[name="little_interest_or_pleasure_in_doing_things"]:checked').val();
    let feeling_down_depressed_or_hopeless = $('input[name="feeling_down_depressed_or_hopeless"]:checked').val();
    let trouble_falling_or_staying_asleep_or_sleeping_too_much = $('input[name="trouble_falling_or_staying_asleep_or_sleeping_too_much"]:checked').val();
    let feeling_tired_or_having_little_energy = $('input[name="feeling_tired_or_having_little_energy"]:checked').val();
    let poor_appetite_or_overeating = $('input[name="poor_appetite_or_overeating"]:checked').val();
    let feeling_bad_about_yourself = $('input[name="feeling_bad_about_yourself"]:checked').val();
    let trouble_concentrating_on_things = $('input[name="trouble_concentrating_on_things"]:checked').val();
    let moving_or_speaking_so_slowly_that_other_people_could_have_noticed = $('input[name="moving_or_speaking_so_slowly_that_other_people_could_have_noticed"]:checked').val();
    let thoughts_that_you_would_be_better_off_dead_or_of_hurting_yourself_in_some_way = $('input[name="thoughts_that_you_would_be_better_off_dead_or_of_hurting_yourself_in_some_way"]:checked').val();

    let flag_isQuestion_sub_initial = false;
    let flag_isQuestion_age = false;
    let flag_isQuestion_gender = false;
    let flag_pef_weight = false;
    let flag_pef_height = false;
    let flag_diabetes_age = false;
    let flag_diabetes_medication = false;
    let flag_laboratory_results = false;
    let flag_Do_you_have_with_any_diabetic_complications_diabetic_retinopathy = false;
    let flag_Do_you_have_with_any_diabetic_complications_neuropathy = false;
    let flag_Do_you_have_with_any_diabetic_complications_nephropathy = false;
    let flag_Smoke = false;
    let flag_How_often_you_do_exercise = false;
    let flag_Regarding_diabetes_have_you_recently_felt_Angry = false;
    let flag_Regarding_diabetes_have_you_recently_felt_Sad = false;
    let flag_Regarding_diabetes_have_you_recently_felt_Scared = false;
    let flag_Regarding_diabetes_have_you_recently_felt_Stressed = false;
    let flag_little_interest_or_pleasure_in_doing_things = false;
    let flag_feeling_down_depressed_or_hopeless = false;
    let flag_trouble_falling_or_staying_asleep_or_sleeping_too_much = false;
    let flag_feeling_tired_or_having_little_energy = false;
    let flag_poor_appetite_or_overeating = false;
    let flag_feeling_bad_about_yourself = false;
    let flag_trouble_concentrating_on_things = false;
    let flag_moving_or_speaking_so_slowly_that_other_people_could_have_noticed = false;
    let flag_thoughts_that_you_would_be_better_off_dead_or_of_hurting_yourself_in_some_way = false;
    let flag_laboratory_results_HBA1C = true;
    let flag_laboratory_results_FPBS = true;
    let flag_laboratory_results_PPBS = true;

    let flag_diabetes_medication_others = false;
   // let flag_Yes_diabetic_complication = false;
    let flag_How_often_you_do_exercise_others = false;

    if (!isQuestion_sub_initial) {
      $(".err_pef_subject_initial").html("<span class='red'>Please provide an input.</span>");
      flag_isQuestion_sub_initial = false;
    } else {
      $(".err_pef_subject_initial").html("");
      flag_isQuestion_sub_initial = true;
    }


    if (!isQuestion_age) {
      $(".err_pef_age_in_years").html("<span class='red'>Please provide an input.</span>");
      flag_isQuestion_age = false;
    }else if (isNaN(isQuestion_age)) {
      $(".err_pef_age_in_years").html("<span class='red'>Please enter a valid number.</span>");
      flag_isQuestion_age = false;
    } else if (isQuestion_age < 1 || isQuestion_age > 99) {
      $(".err_pef_age_in_years").html("<span class='red'>Age should be between 1 to 99.</span>");
      flag_isQuestion_age = false;
    } else {
      $(".err_pef_age_in_years").html("");
      flag_isQuestion_age = true;
    }

    if (isQuestion_gender=="") {
      $(".err_pef_gender").html("<span class='red'>Please Select</span>");
      flag_isQuestion_gender = false;
    } else {
      $(".err_pef_gender").html("");
      flag_isQuestion_gender = true;
    }

    if (!pef_weight) {
      $(".err_weight").html("<span class='red'>Please provide an input.</span>");
      flag_pef_weight = false;
    }else if (isNaN(pef_weight)) {
      $(".err_weight").html("<span class='red'>Please enter a valid Weight.</span>");
      flag_pef_weight = false;
    } else if (pef_weight < 1 || pef_weight > 200) {
      $(".err_weight").html("<span class='red'>Weight should be between 1 to 200.</span>");
      flag_pef_weight = false;
    } else {
      $(".err_weight").html("");
      flag_pef_weight = true;
    }

    if (!pef_height) {
      $(".err_pef_height").html("<span class='red'>Please provide an input.</span>");
      flag_pef_height = false;
    }else if (isNaN(pef_height)) {
      $(".err_pef_height").html("<span class='red'>Please enter a valid Height.</span>");
      flag_pef_height = false;
    } else if (pef_height < 3 || pef_height > 7) {
      $(".err_pef_height").html("<span class='red'>Height should be between 3 to 7.</span>");
      flag_pef_height = false;
    } else {
      $(".err_pef_height").html("");
      flag_pef_height = true;
    }

    if (!diabetes_age) {
      $(".err_diabetes_age").html("<span class='red'>Please provide an input.</span>");
      flag_diabetes_age = false;
    }else if (isNaN(diabetes_age)) {
      $(".err_diabetes_age").html("<span class='red'>Please enter a valid number.</span>");
      flag_diabetes_age = false;
    } else if (diabetes_age < 1 || diabetes_age > 99) {
      $(".err_diabetes_age").html("<span class='red'>Age should be between 1 to 99.</span>");
      flag_diabetes_age = false;
    } else {
      $(".err_diabetes_age").html("");
      flag_diabetes_age = true;
    }

    

    if (diabetes_medication.length == 0 ) {
      $(".err_diabetes_medication").html("<span class='red'>Please select any option</span>");
      flag_diabetes_medication = false;
    } else {
      $(".err_diabetes_medication").html("");
      flag_diabetes_medication = true;
    }


    if (laboratory_results == undefined ) {
      $(".err_laboratory_results").html("<span class='red'>Please select any option</span>");
      flag_laboratory_results = false;
    } else {
      $(".err_laboratory_results").html("");
      flag_laboratory_results = true;
    }
    
    
 

    // Check for specific values in selected checkboxes
    var requiredValues = ['HBA1C', 'FPBS','PPBS']; // Example values to check for
    requiredValues.forEach(function(value) {
      if (laboratory_results.includes(value)) {

        if(value == 'HBA1C'){
          if(!laboratory_results_HBA1C ){
            $('.err_laboratory_results_HBA1C').html('<span class="red">Please provide this value</span>');
            flag_laboratory_results_HBA1C = false;        
          }else if (isNaN( laboratory_results_HBA1C )){
            $('.err_laboratory_results_HBA1C').html('<span class="red">Please provide numeric input</span>');
            flag_laboratory_results_HBA1C = false;
          }else if (laboratory_results_HBA1C < 5 || laboratory_results_HBA1C > 25) {
            $(".err_laboratory_results_HBA1C").html("<span class='red'>Value should be between 5 to 25.</span>");
            flag_laboratory_results_HBA1C = false;
          }else{
            $('.err_laboratory_results_HBA1C').html('');
            flag_laboratory_results_HBA1C = true;
          }  
        }


        if(value == 'FPBS'){
          if( !laboratory_results_FPBS ){
            flag_laboratory_results_FPBS = false; 
            $('.err_laboratory_results_FPBS').html('<span class="red">Please provide this value</span>');       
          }else if (isNaN( laboratory_results_FPBS )){
            $('.err_laboratory_results_FPBS').html('<span class="red">Please provide numeric input</span>');
            flag_laboratory_results_FPBS = false;
          }else if (laboratory_results_FPBS < 10 || laboratory_results_FPBS > 999) {
            $(".err_laboratory_results_FPBS").html("<span class='red'>Value should be between 10 to 999.</span>");
            flag_laboratory_results_FPBS = false;
          }else{
            $('.err_laboratory_results_FPBS').html('');
            flag_laboratory_results_FPBS = true;
          }
        }


        if(value == 'PPBS'){
          if( !laboratory_results_PPBS){
            flag_laboratory_results_PPBS = false;   
            $('.err_laboratory_results_PPBS').html('<span class="red">Please provide this value</span>');      
          }else if (isNaN( laboratory_results_PPBS )){
            $('.err_laboratory_results_PPBS').html('<span class="red">Please provide numeric input</span>');
            flag_laboratory_results_PPBS = false;
          }else if (laboratory_results_PPBS < 10 || laboratory_results_PPBS > 999) {
            $(".err_laboratory_results_PPBS").html("<span class='red'>Value should be between 10 to 999.</span>");
            flag_laboratory_results_PPBS = false;
          }else{
            $('.err_laboratory_results_PPBS').html('');
            flag_laboratory_results_PPBS = true;
          }
        }

      }
    });

    

    

    if (Do_you_have_with_any_diabetic_complications_diabetic_retinopathy == undefined ) {
      $(".err_Do_you_have_with_any_diabetic_complications_diabetic_retinopathy").html("<span class='red'>Please select any option</span>" );
      flag_Do_you_have_with_any_diabetic_complications_diabetic_retinopathy = false;
    } else {
      $(".err_Do_you_have_with_any_diabetic_complications_diabetic_retinopathy").html("");
      flag_Do_you_have_with_any_diabetic_complications_diabetic_retinopathy = true;
    }

    if (Do_you_have_with_any_diabetic_complications_neuropathy == undefined ) {
      $(".err_Do_you_have_with_any_diabetic_complications_neuropathy").html("<span class='red'>Please select any option</span>" );
      flag_Do_you_have_with_any_diabetic_complications_neuropathy = false;
    } else {
      $(".err_Do_you_have_with_any_diabetic_complications_neuropathy").html("");
      flag_Do_you_have_with_any_diabetic_complications_neuropathy = true;
    }

    if (Do_you_have_with_any_diabetic_complications_nephropathy == undefined ) {
      $(".err_Do_you_have_with_any_diabetic_complications_nephropathy").html("<span class='red'>Please select any option</span>" );
      flag_Do_you_have_with_any_diabetic_complications_nephropathy = false;
    } else {
      $(".err_Do_you_have_with_any_diabetic_complications_nephropathy").html("");
      flag_Do_you_have_with_any_diabetic_complications_nephropathy = true;
    }


    if (Smoke == undefined ) {
      $(".err_Smoke").html("<span class='red'>Please select any option</span>" );
      flag_Smoke = false;
    } else {
      $(".err_Smoke").html("");
      flag_Smoke = true;
    }

    if (How_often_you_do_exercise == undefined ) {
      $(".err_How_often_you_do_exercise").html("<span class='red'>Please select any option</span>" );
      flag_How_often_you_do_exercise = false;
    } else {
      $(".err_How_often_you_do_exercise").html("");
      flag_How_often_you_do_exercise = true;
    }

    if (Regarding_diabetes_have_you_recently_felt_Angry == undefined ) {
      $(".err_Regarding_diabetes_have_you_recently_felt_Angry").html("<span class='red'>Please select any option</span>" );
      flag_Regarding_diabetes_have_you_recently_felt_Angry = false;
    } else {
      $(".err_Regarding_diabetes_have_you_recently_felt_Angry").html("");
      flag_Regarding_diabetes_have_you_recently_felt_Angry = true;
    }

    if (Regarding_diabetes_have_you_recently_felt_Sad == undefined ) {
      $(".err_Regarding_diabetes_have_you_recently_felt_Sad").html("<span class='red'>Please select any option</span>" );
      flag_Regarding_diabetes_have_you_recently_felt_Sad = false;
    } else {
      $(".err_Regarding_diabetes_have_you_recently_felt_Sad").html("");
      flag_Regarding_diabetes_have_you_recently_felt_Sad = true;
    }
    
    if (Regarding_diabetes_have_you_recently_felt_Scared == undefined ) {
      $(".err_Regarding_diabetes_have_you_recently_felt_Scared").html("<span class='red'>Please select any option</span>" );
      flag_Regarding_diabetes_have_you_recently_felt_Scared = false;
    } else {
      $(".err_Regarding_diabetes_have_you_recently_felt_Scared").html("");
      flag_Regarding_diabetes_have_you_recently_felt_Scared = true;
    }
    

    if (Regarding_diabetes_have_you_recently_felt_Stressed == undefined ) {
      $(".err_Regarding_diabetes_have_you_recently_felt_Stressed").html("<span class='red'>Please select any option</span>");
      flag_Regarding_diabetes_have_you_recently_felt_Stressed = false;
    } else {
      $(".err_Regarding_diabetes_have_you_recently_felt_Stressed").html("");
      flag_Regarding_diabetes_have_you_recently_felt_Stressed = true;
    }



    //table validation
    if (little_interest_or_pleasure_in_doing_things == undefined ) {
      $(".err_little_interest_or_pleasure_in_doing_things").html("<span class='red'>Please select any option</span>");
      flag_little_interest_or_pleasure_in_doing_things = false;
    } else {
      $(".err_little_interest_or_pleasure_in_doing_things").html("");
      flag_little_interest_or_pleasure_in_doing_things = true;
    }

    if (feeling_down_depressed_or_hopeless == undefined ) {
      $(".err_feeling_down_depressed_or_hopeless").html("<span class='red'>Please select any option</span>");
      flag_feeling_down_depressed_or_hopeless = false;
    } else {
      $(".err_feeling_down_depressed_or_hopeless").html("");
      flag_feeling_down_depressed_or_hopeless = true;
    }

    if (trouble_falling_or_staying_asleep_or_sleeping_too_much == undefined ) {
      $(".err_trouble_falling_or_staying_asleep_or_sleeping_too_much").html("<span class='red'>Please select any option</span>");
      flag_trouble_falling_or_staying_asleep_or_sleeping_too_much = false;
    } else {
      $(".err_trouble_falling_or_staying_asleep_or_sleeping_too_much").html("");
      flag_trouble_falling_or_staying_asleep_or_sleeping_too_much = true;
    }

    if (feeling_tired_or_having_little_energy == undefined ) {
      $(".err_feeling_tired_or_having_little_energy").html("<span class='red'>Please select any option</span>");
      flag_feeling_tired_or_having_little_energy = false;
    } else {
      $(".err_feeling_tired_or_having_little_energy").html("");
      flag_feeling_tired_or_having_little_energy = true;
    }

    if (poor_appetite_or_overeating == undefined ) {
      $(".err_poor_appetite_or_overeating").html("<span class='red'>Please select any option</span>");
      flag_poor_appetite_or_overeating = false;
    } else {
      $(".err_poor_appetite_or_overeating").html("");
      flag_poor_appetite_or_overeating = true;
    }

    if (feeling_bad_about_yourself == undefined ) {
      $(".err_feeling_bad_about_yourself").html("<span class='red'>Please select any option</span>");
      flag_feeling_bad_about_yourself = false;
    } else {
      $(".err_feeling_bad_about_yourself").html("");
      flag_feeling_bad_about_yourself = true;
    }

    if (trouble_concentrating_on_things == undefined ) {
      $(".err_trouble_concentrating_on_things").html("<span class='red'>Please select any option</span>");
      flag_trouble_concentrating_on_things = false;
    } else {
      $(".err_trouble_concentrating_on_things").html("");
      flag_trouble_concentrating_on_things = true;
    }

    if (moving_or_speaking_so_slowly_that_other_people_could_have_noticed == undefined ) {
      $(".err_moving_or_speaking_so_slowly_that_other_people_could_have_noticed").html("<span class='red'>Please select any option</span>");
      flag_moving_or_speaking_so_slowly_that_other_people_could_have_noticed = false;
    } else {
      $(".err_moving_or_speaking_so_slowly_that_other_people_could_have_noticed").html("");
      flag_moving_or_speaking_so_slowly_that_other_people_could_have_noticed = true;
    }


    if (thoughts_that_you_would_be_better_off_dead_or_of_hurting_yourself_in_some_way == undefined ) {
      $(".err_thoughts_that_you_would_be_better_off_dead_or_of_hurting_yourself_in_some_way").html("<span class='red'>Please select any option</span>");
      flag_thoughts_that_you_would_be_better_off_dead_or_of_hurting_yourself_in_some_way = false;
    } else {
      $(".err_thoughts_that_you_would_be_better_off_dead_or_of_hurting_yourself_in_some_way").html("");
      flag_thoughts_that_you_would_be_better_off_dead_or_of_hurting_yourself_in_some_way = true;
    }





    if(
      flag_isQuestion_sub_initial && 
      flag_isQuestion_age && 
      flag_isQuestion_gender && 
      flag_pef_weight && 
      flag_pef_height && 
      flag_diabetes_age && 
      flag_diabetes_medication && 
      flag_laboratory_results && 
      flag_laboratory_results_HBA1C &&
      flag_laboratory_results_FPBS &&
      flag_laboratory_results_PPBS &&
      flag_Do_you_have_with_any_diabetic_complications_diabetic_retinopathy && 
      flag_Do_you_have_with_any_diabetic_complications_neuropathy && 
      flag_Do_you_have_with_any_diabetic_complications_nephropathy && 
      flag_Smoke && 
      flag_How_often_you_do_exercise && 
      flag_Regarding_diabetes_have_you_recently_felt_Angry && 
      flag_Regarding_diabetes_have_you_recently_felt_Sad && 
      flag_Regarding_diabetes_have_you_recently_felt_Scared && 
      flag_Regarding_diabetes_have_you_recently_felt_Stressed && 
      flag_little_interest_or_pleasure_in_doing_things && 
      flag_feeling_down_depressed_or_hopeless && 
      flag_trouble_falling_or_staying_asleep_or_sleeping_too_much && 
      flag_feeling_tired_or_having_little_energy && 
      flag_poor_appetite_or_overeating && 
      flag_feeling_bad_about_yourself && 
      flag_trouble_concentrating_on_things && 
      flag_moving_or_speaking_so_slowly_that_other_people_could_have_noticed && 
      flag_thoughts_that_you_would_be_better_off_dead_or_of_hurting_yourself_in_some_way )
      {
        console.log("Hi");

        let sd = $('#sd').val();
        let vst = $('#vst').val();
        let survey_id = $("#frm-PEF #pef_form_id").val();
        let patient_id = $("#frm-PEF #pef_patient_id").val();
        let form_url = $("#frm-PEF #form_url").val();
        let name_of_respondent = $("#name_of_respondent").html();
        let form_status = "Completed";
        let steps_completed = $("#frm-PEF #steps_completed").val();
        let page_slug = $("#frm-PEF #pef_page_slug").val();
        let created_date = get_created_date();
        let JSONformdata = {
          "sd":sd,
          "vst":vst,
          "form_url":form_url,
          "form_status":form_status,
          "steps_completed":steps_completed,
          "pef_form_id":survey_id,
          "pef_page_slug":page_slug,
          "pef_patient_id":patient_id,
          'isQuestion_sub_initial': isQuestion_sub_initial,
          'isQuestion_age': isQuestion_age,
          'isQuestion_gender': isQuestion_gender,
          'pef_weight': pef_weight,
          'pef_height': pef_height,
          'diabetes_age': diabetes_age,
          'diabetes_medication': diabetes_medication_val,
          'laboratory_results': laboratory_results_val,
          'laboratory_results_HBA1C':laboratory_results_HBA1C,
          'laboratory_results_FPBS':laboratory_results_FPBS,
          'laboratory_results_PPBS':laboratory_results_PPBS,
          'Do_you_have_with_any_diabetic_complications_diabetic_retinopathy' : Do_you_have_with_any_diabetic_complications_diabetic_retinopathy,
          'Do_you_have_with_any_diabetic_complications_neuropathy' : Do_you_have_with_any_diabetic_complications_neuropathy,
          'Do_you_have_with_any_diabetic_complications_nephropathy' : Do_you_have_with_any_diabetic_complications_nephropathy,
          'Smoke': Smoke,
          'How_often_you_do_exercise': How_often_you_do_exercise,
          'Regarding_diabetes_have_you_recently_felt_Angry': Regarding_diabetes_have_you_recently_felt_Angry,
          'Regarding_diabetes_have_you_recently_felt_Sad': Regarding_diabetes_have_you_recently_felt_Sad,
          'Regarding_diabetes_have_you_recently_felt_Scared': Regarding_diabetes_have_you_recently_felt_Scared,
          'Regarding_diabetes_have_you_recently_felt_Stressed': Regarding_diabetes_have_you_recently_felt_Stressed,
          'little_interest_or_pleasure_in_doing_things': little_interest_or_pleasure_in_doing_things,
          'feeling_down_depressed_or_hopeless': feeling_down_depressed_or_hopeless,
          'trouble_falling_or_staying_asleep_or_sleeping_too_much': trouble_falling_or_staying_asleep_or_sleeping_too_much,
          'feeling_tired_or_having_little_energy': feeling_tired_or_having_little_energy,
          'poor_appetite_or_overeating': poor_appetite_or_overeating,
          'feeling_bad_about_yourself': feeling_bad_about_yourself,
          'trouble_concentrating_on_things': trouble_concentrating_on_things,
          'moving_or_speaking_so_slowly_that_other_people_could_have_noticed': moving_or_speaking_so_slowly_that_other_people_could_have_noticed,
          'thoughts_that_you_would_be_better_off_dead_or_of_hurting_yourself_in_some_way': thoughts_that_you_would_be_better_off_dead_or_of_hurting_yourself_in_some_way,
      
          'diabetes_medication_others': diabetes_medication_others,
          //'Yes_diabetic_complication': Yes_diabetic_complication,
          'How_often_you_do_exercise_others': How_often_you_do_exercise_others,
        };
        console.log (JSONformdata); 

        var parameters = {
              action: "srb_submit_PEF_form",
              survey_id: survey_id,
              page_slug: page_slug,
              patient_id: patient_id,
              form_url: form_url,
              form_status: form_status,
              steps_completed: steps_completed,
              form_data: JSONformdata,
              created_date: created_date,
              respondent_name: name_of_respondent,
              nonce: ajax_param.nonce,
            };


        jQuery.ajax({
          type: "POST",
          url: ajax_param.ajaxurl,
          data: parameters,
          dataType: "json",
          beforeSend: function (arr, $form, options) {
            $("#frm-PEF .response").html(
              '<span style = "color : orange" >Processing..</span>'
            );
          },
          success: function (response) {
            console.log("success");
            // let response_json = $.parseJSON(response);
            console.log ( response);
            $("#frm-PEF .response").html("");
            if (response.insID > 0) {
              $("#frm-PEF .response").html("<span class = 'green' >Entry Submitted successfully!</span>");
              window.location.href = response.redirect_url;
            } else {
              $("#frm-PEF .response").html("<span class = 'red' >Something went wrong </span>");
            }
          }, //success end
          complete: function () {
            $("#frm-PEF .response").html(
              '<span style = "color : green" >Entry Submitted successfully!!</span>'
            );
            $("#btn-submit-survey").attr("disable", "disabled");
            $("#btn-submit-survey").prop("disabled", true);
          },
        }); //ajax end
      } else {
        $("#frm-PEF .response").html("<span class = 'red' >Please check the form for the errors</span>");
        console.log("false flag");
      }

      
  });

  // Smile Code Ends

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
