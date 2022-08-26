<div class="control-group" id="fields">
            <label class="control-label" for="field1">type your desire combination for drug</label>
            <div class="controls"> 
                <form role="form" autocomplete="off">
                   <!--  <div class="entry input-group col-xs-3">
                        <input class="form-control" name="fields[]" type="text" list ="brands" placeholder="Type something" />
                        <datalist id="brands_datalist"></datalist>
                        <span class="input-group-btn">
                            <button class="btn-add" type="button"></button>
                        </span>
                    </div> -->

                    <div class="control-group">
                      <div id="DrugArea"class="controls">
                        <input type="text" id="txt_drug" name="fields[]" list ="brands_datalist" placeholder="Type something">
                        <datalist id="brands_datalist"></datalist>
                        <input type="text" id="txt_drug" name="fields[]" list ="brands_datalist" placeholder="Type something">
                        <datalist id="brands_datalist"></datalist>
                      </div>
                      <a id="addNewDrug" class="fill">Add more drug</a>
                    </div>

                </form>
                <center><img id="loading-image" src="https://docmode.org/wp-content/uploads/2022/08/loader.gif" style="display:none;"/></center>
            <input type="submit" id="drugs_submit" value="Submit" class="drugs_submit">
            <br>
            
            </div>
        </div>
<?php
// function.php
if( is_page_template( 'generic-aadhar.php' ) ){
            wp_enqueue_script( 'srb_gd_script', get_stylesheet_directory_uri() .'/js/srb_generic_drugs.js', array('jquery'), time(),true );
            wp_localize_script( 'srb_gd_script' , 'gd_ajax' , array(
                'ajaxurl'   => admin_url ( 'admin-ajax.php' ),
                'nonce'    => wp_create_nonce ( 'srb_gd_nonce' )
            ) );
        }

function srb_get_brand_name(){
        check_ajax_referer('srb_gd_nonce', 'nonce');

        //$apiUrl = 'https://sxcllygo2b.execute-api.ap-south-1.amazonaws.com/test?brandname='. $_POST['key_pressed'] .'&genericname=';
        if( isset ( $_POST['search_choice'] ) && $_POST['search_choice'] == 'viaBrand'){
            $apiUrl = 'https://sxcllygo2b.execute-api.ap-south-1.amazonaws.com/test?brandnames='. $_POST['key_pressed'] .'&genericnames=';
        }
        else if(isset ( $_POST['search_choice'] ) && $_POST['search_choice'] == 'viaGeneric'){
            $apiUrl = 'https://sxcllygo2b.execute-api.ap-south-1.amazonaws.com/test?brandnames=&genericnames='. $_POST['key_pressed'] ;
        }
        else{
            $apiUrl = 'https://sxcllygo2b.execute-api.ap-south-1.amazonaws.com/test?brandname=&genericname=';
        }
        $args = array(
              'headers' => array(
                'Content-Type' => 'application/json',
                'X-Api-Key' => 'wQQK6i2TtW9NtFLSKxrYC4m82tYxxBWPaEXmrxxB'
              )
          );
        $response = wp_remote_get($apiUrl,$args);
        $responseBody = wp_remote_retrieve_body( $response );
        $result = json_decode( $responseBody,true );
        //return $result; 
        //$resultBody = array_unique($result->body);
        //echo json_encode($resultBody) ;
        echo json_encode($result) ;
        
        die();       
    }

?>
<?php // js code ?>
<script type="text/javascript">
jQuery("#DrugArea").on('keyup', 'input[name="fields[]"]', function(){
        jQuery('#brands_datalist').empty();
        var rdo = jQuery('input[name="rdo_brand_generic_choice"]:checked').val();
        console.log(jQuery(this).val());
        var arg = {
                'action': 'srb_get_brand_name',
                'key_pressed' :  jQuery(this).val(),
            'search_choice': rdo,
                'nonce' : gd_ajax.nonce
        }
        console.log(arg);

        jQuery.ajax({
                type    : 'POST',
                url     : gd_ajax.ajaxurl,            
                data    : arg,
                success : function(r){
                //alert(r);
                var ra = JSON.parse(r);
                        //console.log(ra.body);
                //alert(ra.body);
                        //jQuery('#drug_responce').html(ra.body);
                jQuery.each(ra.body, function(i, item) {
                  jQuery("#brands_datalist").append('<option value="' + item + '">');

                });
                jQuery('#brands').html();

                }
        });
        });
</script>