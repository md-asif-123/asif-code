<?php
// Add a shortcode calculator with post value...
add_shortcode('a-calculator', 'asf_a_calculator');

function asf_a_calculator()
{
    global $wpdb;
    $user_id = get_current_user_id();
    $first_char = 'A';
    $postids = $wpdb->get_col($wpdb->prepare("
    SELECT      ID
    FROM        $wpdb->posts
    WHERE       SUBSTR($wpdb->posts.post_title,1,1) = %s
    ORDER BY    $wpdb->posts.post_title",$first_char)); 
    $myposts = get_posts(array(
        'post_type' => 'post',
        'post__in' => $postids,
        'post_status' => 'publish',
        'category_name' => 'calculate',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order'   => 'ASC'
                    )
                       );
    //print_r($myposts);
    // $content = "<br><div id = 'loadingImage' style='display:none;'><center><img src='https://basaloginterchangeabilitysurvey.docmode.org/wp-content/uploads/2022/07/LOADER-BASALOG.gif'/></center></div>";
    $content = '';
    if(!empty($myposts)):
    
    foreach ($myposts as $mypost) {
    $cpd=get_post_meta($mypost->ID,'calculator_post_description',true);
    $fav_value=get_post_meta($mypost->ID,''.$user_id.'_favourite',true);
    $content_a = calculator_content($mypost,$mypost->post_title,$mypost->ID,$cpd,$user_id,$fav_value);
    echo $content_a;
    }
    else:
        $content = '';
    endif;
    echo $content;
    //die();
}
 
 // function.php

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
        $resBody = array_unique($result['body']);
        $str = '';
        foreach($resBody as $key=>$value){
        $str .= '<option value="'.$value.'">';
        //$str .= '<a href="">'.$value.'</a>';
        }
        echo $str;
        die();       
    }
    add_action( 'wp_ajax_nopriv_srb_get_brand_name', 'srb_get_brand_name' );
    add_action( 'wp_ajax_srb_get_brand_name', 'srb_get_brand_name' );
?>
//Shows dynamic values in dropdown as user type
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
          //       var ra = JSON.parse(r);
                // console.log(ra.body);
                // //jQuery('#drug_responce').html(ra.body);
          //       jQuery.each(ra.body, function(i, item) {
          //         jQuery("#brands_datalist").append('<option value="' + item + '">');

          //       });
          //       jQuery('#brands').html();
            $("#brands_datalist").html(r);

            }
        });
    });
</script>