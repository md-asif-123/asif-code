<?php
/*
Plugin Name: Course Api
Description: Course Api shortcode
Version: 1.0
*/

add_shortcode('fatchdata', 'handle_api');

function handle_api(){

    //return 'api data';

    $url = 'https://learn.docmode.org/api/v1/wp_course/search/discovery/?coursetype=Courses';

    $arguments = array('method' => 'GET');

    $response = wp_remote_get($url, $arguments);

    
    $results = json_decode(wp_remote_retrieve_body( $response ));
    
    $results1 = $results->results;

    //var_dump($results1);
    
        $html = '<div class="form-group row"><div id="fetch_more">';
        //$key = 4;
    foreach($results1 as $key=>$result):
        if($key < 9):
        $html .= '<a target="_blank" href=http://demo-asif.lovestoblog.com/'.$result->wp_url.'><img src=https://learn.docmode.org'.$result->media->course_image->uri.' height="500px" width="400px"></a>';

        // if($key == 3):
        //     break;
        // endif;

        // $post = array(
        // 'post_type' => "page",
        // 'post_title' => $result->wp_url,
        // 'post_content' => '[pagedetails]',
        // 'post_status' => 'publish'
        // );
        // wp_insert_post( $post );
        endif;
    endforeach;
    $html .='</div></div><div class="text-center" id="loader" style="display: none;">
      <img src="http://demo-asif.lovestoblog.com/wp-content/uploads/2022/03/Web-Loading-Image.gif" height="100px" width="100px"></div>';
    $html .= '<div><button id="load_more">Load More</button></div>';
    
    return $html;

}

add_shortcode('pagedetails', 'handle_api_details');

function handle_api_details(){
    global $post;
    $post_slug = $post->post_name;
    //return 'api data';

    $url = 'https://learn.docmode.org/api/courses/v1/wp_courses/'.$post_slug;

    $arguments = array('method' => 'GET');

    $response = wp_remote_get($url, $arguments);

    
    $results = json_decode(wp_remote_retrieve_body( $response ));
    
    $result = $results;

    //var_dump($results1);
    
        $html = '<div class="form-group row">';
    //foreach($results1 as $key=>$result):
        $html .= '<div class="col-sm-6"><div class="card">
        <img class="card-img-top" src=https://learn.docmode.org'.$result->media->course_image->uri.' alt="Card image cap">
        <div class="card-body">
        <h5 class="card-title">'.$result->name.'</h5>
        <p class="card-text">Date:'.$result->start.'</p>

        </div>
        </div></div>';

       
        
    return $html;

}