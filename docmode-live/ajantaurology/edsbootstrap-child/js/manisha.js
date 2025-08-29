jQuery(document).ready(function(){


	//document.cookie = "fdcuserLog=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	  var username = getCookie("fdcuserLog");

	  if (username != "") {
	  	jQuery('#fdc_video').show();
		jQuery('#fdc_frm').hide();
	  }else{
	  	jQuery('#fdc_video').hide();
		jQuery('#fdc_frm').show();
	  }

	  function getCookie(cname) {
		  var name = cname + "=";
		  var ca = document.cookie.split(';');
		  for(var i = 0; i < ca.length; i++) {
		    var c = ca[i];
		    while (c.charAt(0) == ' ') {
		      c = c.substring(1);
		    }
		    if (c.indexOf(name) == 0) {
		      return c.substring(name.length, c.length);
		    }
		  }
		  return "";
		}

// jQuery('#fdc_video').hide();
    jQuery('#btn_fdc40521').click(function(e){
       
        e.preventDefault();
        //set validation flags
  		var flg_fullname = flg_email = flg_mobile = flg_ifsc = flg_acc = false; 

        var name = jQuery('#fdc_name').val();
        var mobile = jQuery('#fdc_mobile').val();
        var email = jQuery('#fdc_email').val();

        var valid_mobile_patter = new RegExp('^[0-9]{10,12}$');
		var valid_email_patter = new RegExp('^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$');

 		console.log(name , mobile , email );


 		//Full name validation
		if(name == ""){
			jQuery("#fdc_full_name_error").text("Please provide your full name");
		}else{
			jQuery("#fdc_full_name_error").text("");
			flg_fullname = true;
		}

		//Email validation
		if(email == ""){
			jQuery("#fdc_email_error").text("Please provide your email id");
		}else if(!valid_email_patter.test(email)){
			jQuery("#fdc_email_error").text("Please provide valid email");
		}else{
			jQuery("#fdc_email_error").text("");
			flg_email = true;
		}

		//Mobile validation
		if(mobile == ""){
			jQuery("#fdc_mobile_error").text("Please provide your mobile number");
		}else if(!valid_mobile_patter.test(mobile)){
			jQuery("#fdc_mobile_error").text("Please provide 8 to 14 mobile number");
		}else{
			jQuery("#fdc_mobile_error").text("");
			flg_mobile = true;
		}

		if(flg_fullname == true && flg_email == true && flg_mobile == true){

	        var data = {
		          'action': 'srb_ajax_fdc_form_submit', 
		          'name': name,
		          'mobile': mobile,
		          'email': email,
		          'nonce': srb_commonPageAjax.nonce
		       };
		
			jQuery.post(srb_commonPageAjax.ajaxurl,data,function(response){
				console.log (response);
				if(response>0){
					jQuery("#fdc_response").text(response);

					var d = new Date();
					d.setTime(d.getTime() + (24*60*60*60*1000));
					var expires = "expires="+ d.toUTCString();
					document.cookie = "fdcuserLog" + "=" + "1" + ";" + expires + ";path=/";

					jQuery('#fdc_video').show();
					jQuery('#fdc_frm').hide();
				}else{
					jQuery("#fdc_response").text("There is some technical error.");
				}
				
			},'json');

		}//flag check
    });


    jQuery( '#frm_srb_reg_update' ). submit(function (e) {

    	e.preventDefault();

    	//console.log ('Hi');

    	var code = jQuery('#50821_code_number').val();
    	var reg_num = jQuery('#50821_MCI_number').val();
    	var email = jQuery('#50821_emailid').val();

    	var parameters = {
				          'abbott_code_no': code,
				          'reg_num': reg_num,
				          'email' : email
						};
		//console.log (parameters);

		jQuery.ajax({
			type : "POST",
			url : 'https://learn.docmode.org/api/v1/abbott/abbott_code_update/',
			data : parameters,
			dataType : "json",
			success : function(res){
				//console.log("ajax res : " + JSON.stringify(res));
				//console.log(res.status);
				if (res.status == 200 ){
					window.location.replace("https://learn.docmode.org/register?course_id=course-v1:Abbott+ABT00101+2021_Aug_ABT00101&enrollment_action=enroll");
				}
			},
			error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        	}
		});//ajax call end


    });//form submit end



    jQuery( '#frm_srb_code_update' ).submit( function (e) {
    	e.preventDefault();

    	//console.log ('Hello');
    	var code = jQuery('#50821_code_number').val();
    	var email = jQuery('#50821_emailid').val();
    	var reg_num = jQuery('#50821_MCI_number').val();

    	var parameters = {
				          'abbott_code_no': code,
				          'email' : email,
				          'reg_num' : reg_num
						};

		//console.log (parameters);

		jQuery.ajax({
			type : "POST",
			url : 'https://learn.docmode.org/api/v1/abbott/abbott_code_update/',
			data : parameters,
			dataType : "json",
			success : function(res){
				//JSON.stringify(res);
				//console.log("ajax res : " + JSON.stringify(res));
				//console.log(res.status);
				if (res.status == 200 ){
					window.location.replace("https://learn.docmode.org/register?course_id=course-v1:Abbott+ABT00101+2021_Aug_ABT00101&enrollment_action=enroll");
				}
			},
			error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        	}
		});//ajax call end
    });

    jQuery('#frm_submit_icmr_speciality').on ('submit', function(e){
		e.preventDefault();
		//alert(jQuery('#sct_icmr_speciality :selected').val());
		if(jQuery('#sct_icmr_speciality :selected').val() !=0){
			//
			// {
			//     "icmr":"scientist",
			//     "email":"dev@docmode.com"
			// }
			//alert ( jQuery('#icmr_user_email').val());

			var parameters = {
				          'icmr': jQuery('#sct_icmr_speciality :selected').val(),
				          'email' : jQuery('#icmr_user_email').val()
						};

			console.log("parameters");
			jQuery.ajax({
				type : "POST",
				url : 'https://learn.docmode.org/api/v1/docmode/icmr_specz_update/',
				data : parameters,
				dataType : "json",
				success : function(res){
					//JSON.stringify(res);
					//console.log("ajax res : " + JSON.stringify(res));
					console.log(res);
					if (res.status == 200 ){
						window.location.replace("https://learn.docmode.org/register?course_id=course-v1:ICMR+ICMR002+2021_Sep_ICMR002&enrollment_action=enroll");
					}
				},
				error : function(jqXHR, textStatus, errorThrown) {
	            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
	        	}
			});//ajax call end

		}else{
			alert("please choose designation ");
		}
		jQuery('#sct_icmr_speciality :selected').val();
	});

// drugs
$("#Drug_input").keyup(function(){
    console.log($(this).val());
    var s = $(this).val();
 
	var parameters = {
          'action': 'mns_get_drug_therepistt', 
          'search_key': s,
          'nonce': srb_commonPageAjax.nonce
    };

    jQuery.ajax({
        type: 'POST',
        url: srb_commonPageAjax.ajaxurl,
        data: parameters,
        dataType: "json",
        success: function (response) {
			console.log(response.body);
			 for(var i=0;i<response.body.length;i++)
			 {
				 console.log(response.body[i]);
                $("#Drug_input_list").append("<option value='" + response.body[i] + "'></option>");
            }
      	} // end of success
    }); // end of ajax call

//drugs
});




});//doccment redy
