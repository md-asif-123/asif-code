<?php

/*
resource post type custom
*/

function asf_custom_scripts()
{
    wp_enqueue_style('css-main-one',get_template_directory_uri().'/assets/css/acode.css');
    wp_enqueue_script("jquery_redirect_script",get_stylesheet_directory_uri()."/js/jquery.redirect.js");
    wp_enqueue_script('css-main-one',get_template_directory_uri().'/assets/js/acode.js', array('jquery') ,20161202 ,true);

}

add_action('wp_enqueue_scripts', 'asf_custom_scripts');

add_action('init', 'asf_create_custom_post_type_resource');
 
function asf_create_custom_post_type_resource() {
 
$supports = array(
'title', // post title
'editor', // post content
'author', // post author
'thumbnail', // featured images
'excerpt', // post excerpt
'custom-fields', // custom fields
'comments', // post comments
'revisions', // post revisions
'post-formats', // post formats
);
 
$labels = array(
'name' => _x('Resource', 'plural'),
'singular_name' => _x('Resource', 'singular'),
'menu_name' => _x('Resource', 'admin menu'),
'name_admin_bar' => _x('Resource', 'admin bar'),
'add_new' => _x('Add Resource', 'add new'),
'add_new_item' => __('Add New Resource'),
'new_item' => __('New Resource'),
'edit_item' => __('Edit Resource'),
'view_item' => __('View Resource'),
'all_items' => __('All Resource'),
'search_items' => __('Search Resource'),
'not_found' => __('No resource found.'),
);
 
$args = array(
'supports' => $supports,
'labels' => $labels,
'description' => 'Holds our Resource and specific data',
'public' => true,
//'taxonomies' => array( 'category', 'post_tag' ),
'show_ui' => true,
'show_in_menu' => true,
'show_in_nav_menus' => true,
'show_in_admin_bar' => true,
'can_export' => true,
'capability_type' => 'post',
 'show_in_rest' => true,
'query_var' => true,
'rewrite' => array('slug' => 'resource'),
'has_archive' => true,
'hierarchical' => false,
'menu_position' => 6,
'menu_icon' => 'dashicons-book',
);
 
register_post_type('resource', $args); // Register Post type
}

// display pdf list 

function asf_postsbycategory_pdf() {
// the query

	
// $the_query = new WP_Query( array( 
//     'post_type' => 'resource', 
//     'posts_per_page' => 16 
// ) ); 

$the_query = new WP_Query( "post_type=resource&meta_key=resource_type&meta_value=PDF&order=ASC&offset=0&posts_per_page=4" );

$the_query_pdf = new WP_Query( 'post_type=resource&meta_key=resource_type&meta_value=PDF&order=ASC' );
$row_pdf = $the_query_pdf->found_posts;
   
// The Loop
if ( $the_query->have_posts() ) {
    //$string .= '<div id="fetch_more">';
    
        
    //$i = 0; 
    ?>
    <!-- <div id='view'> -->
    <?php
    //$i = 1;
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        //echo $i;
            

        	if(get_field( "resource_type", $post->ID ) == 'PDF'):

                $original_url = get_field( "resource_url", $post->ID );

                $ext_url = '.'.pathinfo($original_url, PATHINFO_EXTENSION);

                $url_before_dot = substr($original_url, 0, strrpos( $original_url, '.') );
                
                $md5_url = md5($original_url);

                $encrypt_url = $url_before_dot.$md5_url.$ext_url;
                
	            
                $string .= '<div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">';
                $string .= '<div class="row resources d-flex justify-content-sm-center align-items-center">';      
                $string .= '<div class="col-md-9 col-xl-9 col-sm-12 col-xs-12">';
                $string .= '<h1 class="res-heading">'.get_field( "resource_title", $post->ID ).'</h1>';
                $string .= '</div>';
                $string .= '<div class="col-md-3 col-xl-3 col-sm-12 col-xs-12">';
                $string .= '<a href="' . home_url() .'/resource-details?url='.$encrypt_url.'" class="res-btn">View </a>';
                $string .= '</div>';
                $string .= '</div>';
                $string .= '</div>';
        

        	endif;

            if($row_pdf == 4):
                $string .= '<style>#load_more{ display: none; }</style>';
            endif;

            //$i++;

            // if($i == 3):
            //     break;
            // endif;
            
            }
            ?>

        <!-- </div> -->
     <?php
    } else {
    // no posts found
 $string .= '<li>No Posts Found</li><style>#load_more{ display: none; } #show_more_pdf{ display: none; }</style>';
}

 //$string .= '</div>';     
   
return $string;
   
/* Restore original Post Data */
wp_reset_postdata();
}
// Add a shortcode
add_shortcode('categoryposts-pdf', 'asf_postsbycategory_pdf');

// display pdf list in section

function asf_postsbycategory_pdf_section() {
// the query

    
// $the_query = new WP_Query( array( 
//     'post_type' => 'resource', 
//     'posts_per_page' => 16 
// ) ); 

$the_query = new WP_Query( "post_type=resource&meta_key=resource_type&meta_value=PDF&order=ASC&offset=0&posts_per_page=10" );

$the_query_pdf = new WP_Query( 'post_type=resource&meta_key=resource_type&meta_value=PDF&order=ASC' );
$row_pdf = $the_query_pdf->found_posts;
   
// The Loop
if ( $the_query->have_posts() ) {
    //$string .= '<div id="fetch_more">';
    
        
    //$i = 0; 
    ?>
    <!-- <div id='view'> -->
    <?php
    //$i = 1;
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        //echo $i;
            

            if(get_field( "resource_type", $post->ID ) == 'PDF'):

                $original_url = get_field( "resource_url", $post->ID );

                $ext_url = '.'.pathinfo($original_url, PATHINFO_EXTENSION);

                $url_before_dot = substr($original_url, 0, strrpos( $original_url, '.') );
                
                $md5_url = md5($original_url);

                $encrypt_url = $url_before_dot.$md5_url.$ext_url;
                
                
                $string .= '<div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">';
                $string .= '<div class="row resources d-flex justify-content-sm-center align-items-center">';      
                $string .= '<div class="col-md-9 col-xl-9 col-sm-12 col-xs-12">';
                $string .= '<h1 class="res-heading">'.get_field( "resource_title", $post->ID ).'</h1>';
                $string .= '</div>';
                $string .= '<div class="col-md-3 col-xl-3 col-sm-12 col-xs-12">';
                $string .= '<a href="' . home_url() .'/resource-details?url='.$encrypt_url.'" class="res-btn">View </a>';
                $string .= '</div>';
                $string .= '</div>';
                $string .= '</div>';
        

            endif;

            if($row_pdf <= 10):
                $string .= '<style>#load_more{ display: none; }</style>';
            endif;

            //$i++;

            // if($i == 3):
            //     break;
            // endif;
            
            }
            ?>

        <!-- </div> -->
     <?php
    } else {
    // no posts found
 $string .= '<li>No Posts Found</li><style>#load_more{ display: none; } #show_more_pdf{ display: none; }</style>';
}

 //$string .= '</div>';     
   
return $string;
   
/* Restore original Post Data */
wp_reset_postdata();
}
// Add a shortcode
add_shortcode('categoryposts-pdf-section', 'asf_postsbycategory_pdf_section');


// display docs list 

function asf_postsbycategory_docs() {
// the query

$the_query_docs = new WP_Query( 'post_type=resource&meta_key=resource_type&meta_value=DOCS&order=ASC' );
$row_docs = $the_query_docs->found_posts;

$the_query = new WP_Query( "post_type=resource&meta_key=resource_type&meta_value=DOCS&order=ASC&offset=0&posts_per_page=4" );
   
// The Loop
if ( $the_query->have_posts() ) {
    //$string .= '<tr>';
    //$i = 0; 
    while ( $the_query->have_posts() ) {
        $the_query->the_post();

        	if(get_field( "resource_type", $post->ID ) == 'DOCS'):

                $original_url = get_field( "resource_url", $post->ID );

                $ext_url = '.'.pathinfo($original_url, PATHINFO_EXTENSION);

                $url_before_dot = substr($original_url, 0, strrpos( $original_url, '.') );
                
                $md5_url = md5($original_url);

                $encrypt_url = $url_before_dot.$md5_url.$ext_url;
            
	            $string .= '<div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">';
                $string .= '<div class="row resources d-flex justify-content-sm-center align-items-center">';      
                $string .= '<div class="col-md-9 col-xl-9 col-sm-12 col-xs-12">';
                $string .= '<h1 class="res-heading">'.get_field( "resource_title", $post->ID ).'</h1>';
                $string .= '</div>';
                $string .= '<div class="col-md-3 col-xl-3 col-sm-12 col-xs-12">';
                $string .= '<a href="' . home_url() .'/resource-details?url='.$encrypt_url.'" class="res-btn">View </a>';
                $string .= '</div>';
                $string .= '</div>';
                $string .= '</div>';

        	endif;

            if($row_docs == 4):
                $string .= '<style>#load_more_document{ display: none; }</style>';
            endif;

            
            }
    } else {
    // no posts found
 $string .= '<li>No Posts Found</li><style>#load_more_document{ display: none; } #show_more_docs{ display: none; }</style>';
}
$string .= '</tr>';
   
return $string;
   
/* Restore original Post Data */
wp_reset_postdata();
}
// Add a shortcode
add_shortcode('categoryposts-document', 'asf_postsbycategory_docs');

// display docs list section

function asf_postsbycategory_docs_section() {
// the query

$the_query_docs = new WP_Query( 'post_type=resource&meta_key=resource_type&meta_value=DOCS&order=ASC' );
$row_docs = $the_query_docs->found_posts;

$the_query = new WP_Query( "post_type=resource&meta_key=resource_type&meta_value=DOCS&order=ASC&offset=0&posts_per_page=10" );
   
// The Loop
if ( $the_query->have_posts() ) {
    //$string .= '<tr>';
    //$i = 0; 
    while ( $the_query->have_posts() ) {
        $the_query->the_post();

            if(get_field( "resource_type", $post->ID ) == 'DOCS'):

                $original_url = get_field( "resource_url", $post->ID );

                $ext_url = '.'.pathinfo($original_url, PATHINFO_EXTENSION);

                $url_before_dot = substr($original_url, 0, strrpos( $original_url, '.') );
                
                $md5_url = md5($original_url);

                $encrypt_url = $url_before_dot.$md5_url.$ext_url;
            
                $string .= '<div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">';
                $string .= '<div class="row resources d-flex justify-content-sm-center align-items-center">';      
                $string .= '<div class="col-md-9 col-xl-9 col-sm-12 col-xs-12">';
                $string .= '<h1 class="res-heading">'.get_field( "resource_title", $post->ID ).'</h1>';
                $string .= '</div>';
                $string .= '<div class="col-md-3 col-xl-3 col-sm-12 col-xs-12">';
                $string .= '<a href="' . home_url() .'/resource-details?url='.$encrypt_url.'" class="res-btn">View </a>';
                $string .= '</div>';
                $string .= '</div>';
                $string .= '</div>';

            endif;

            if($row_docs <= 10):
                $string .= '<style>#load_more_document{ display: none; }</style>';
            endif;

            
            }
    } else {
    // no posts found
 $string .= '<li>No Posts Found</li><style>#load_more_document{ display: none; } #show_more_docs{ display: none; }</style>';
}
$string .= '</tr>';
   
return $string;
   
/* Restore original Post Data */
wp_reset_postdata();
}
// Add a shortcode
add_shortcode('categoryposts-document-section', 'asf_postsbycategory_docs_section');

// display ppt list 

function asf_postsbycategory_ppt() {
// the query

	
$the_query = new WP_Query( "post_type=resource&meta_key=resource_type&meta_value=PPT&order=ASC&offset=0&posts_per_page=4" );

$the_query_ppt = new WP_Query( 'post_type=resource&meta_key=resource_type&meta_value=PPT&order=ASC' );
$row_ppt = $the_query_ppt->found_posts;
   
// The Loop
if ( $the_query->have_posts() ) {
    //$string .= '<tr>';
    //$i = 0; 
    while ( $the_query->have_posts() ) {
        $the_query->the_post();

        	if(get_field( "resource_type", $post->ID ) == 'PPT'):

                $original_url = get_field( "resource_url", $post->ID );

                $ext_url = '.'.pathinfo($original_url, PATHINFO_EXTENSION);

                $url_before_dot = substr($original_url, 0, strrpos( $original_url, '.') );
                
                $md5_url = md5($original_url);

                $encrypt_url = $url_before_dot.$md5_url.$ext_url;
            
	            $string .= '<div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">';
                $string .= '<div class="row resources d-flex justify-content-sm-center align-items-center">';      
                $string .= '<div class="col-md-9 col-xl-9 col-sm-12 col-xs-12">';
                $string .= '<h1 class="res-heading">'.get_field( "resource_title", $post->ID ).'</h1>';
                $string .= '</div>';
                $string .= '<div class="col-md-3 col-xl-3 col-sm-12 col-xs-12">';
                $string .= '<a href="' . home_url() .'/resource-details?url='.$encrypt_url.'" class="res-btn">View </a>';
                $string .= '</div>';
                $string .= '</div>';
                $string .= '</div>';

        	endif;

            if($row_ppt == 4):
                $string .= '<style>#load_more_presentation{ display: none; }</style>';
            endif;


            
            }
    } else {
    // no posts found
 $string .= '<li>No Posts Found<style>#load_more_presentation{ display: none; } #show_more_ppt{ display: none; }</style></li>';
}
$string .= '</tr>';
   
return $string;
   
/* Restore original Post Data */
wp_reset_postdata();
}
// Add a shortcode
add_shortcode('categoryposts-presentation', 'asf_postsbycategory_ppt');

// display ppt list section

function asf_postsbycategory_ppt_section() {
// the query

    
$the_query = new WP_Query( "post_type=resource&meta_key=resource_type&meta_value=PPT&order=ASC&offset=0&posts_per_page=10" );

$the_query_ppt = new WP_Query( 'post_type=resource&meta_key=resource_type&meta_value=PPT&order=ASC' );
$row_ppt = $the_query_ppt->found_posts;
   
// The Loop
if ( $the_query->have_posts() ) {
    //$string .= '<tr>';
    //$i = 0; 
    while ( $the_query->have_posts() ) {
        $the_query->the_post();

            if(get_field( "resource_type", $post->ID ) == 'PPT'):

                $original_url = get_field( "resource_url", $post->ID );

                $ext_url = '.'.pathinfo($original_url, PATHINFO_EXTENSION);

                $url_before_dot = substr($original_url, 0, strrpos( $original_url, '.') );
                
                $md5_url = md5($original_url);

                $encrypt_url = $url_before_dot.$md5_url.$ext_url;
            
                $string .= '<div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">';
                $string .= '<div class="row resources d-flex justify-content-sm-center align-items-center">';      
                $string .= '<div class="col-md-9 col-xl-9 col-sm-12 col-xs-12">';
                $string .= '<h1 class="res-heading">'.get_field( "resource_title", $post->ID ).'</h1>';
                $string .= '</div>';
                $string .= '<div class="col-md-3 col-xl-3 col-sm-12 col-xs-12">';
                $string .= '<a href="' . home_url() .'/resource-details?url='.$encrypt_url.'" class="res-btn">View </a>';
                $string .= '</div>';
                $string .= '</div>';
                $string .= '</div>';

            endif;

            if($row_ppt <= 10):
                $string .= '<style>#load_more_presentation{ display: none; }</style>';
            endif;


            
            }
    } else {
    // no posts found
 $string .= '<li>No Posts Found<style>#load_more_presentation{ display: none; } #show_more_ppt{ display: none; }</style></li>';
}
$string .= '</tr>';
   
return $string;
   
/* Restore original Post Data */
wp_reset_postdata();
}
// Add a shortcode
add_shortcode('categoryposts-presentation-section', 'asf_postsbycategory_ppt_section');

// display research list 

function asf_postsbycategory_research() {
// the query

	
$the_query = new WP_Query( "post_type=resource&meta_key=resource_type&meta_value=RESEARCH&order=ASC&offset=0&posts_per_page=4" );

$the_query_research = new WP_Query( 'post_type=resource&meta_key=resource_type&meta_value=RESEARCH&order=ASC' );
$row_research = $the_query_research->found_posts;
   
// The Loop
if ( $the_query->have_posts() ) {
    //$string .= '<tr>';
    //$i = 0; 
    while ( $the_query->have_posts() ) {
        $the_query->the_post();

        	if(get_field( "resource_type", $post->ID ) == 'RESEARCH'):

                $original_url = get_field( "resource_url", $post->ID );

                $ext_url = '.'.pathinfo($original_url, PATHINFO_EXTENSION);

                $url_before_dot = substr($original_url, 0, strrpos( $original_url, '.') );
                
                $md5_url = md5($original_url);

                $encrypt_url = $url_before_dot.$md5_url.$ext_url;
            
	            $string .= '<div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">';
                $string .= '<div class="row resources d-flex justify-content-sm-center align-items-center">';      
                $string .= '<div class="col-md-9 col-xl-9 col-sm-12 col-xs-12">';
                $string .= '<h1 class="res-heading">'.get_field( "resource_title", $post->ID ).'</h1>';
                $string .= '</div>';
                $string .= '<div class="col-md-3 col-xl-3 col-sm-12 col-xs-12">';
                $string .= '<a href="' . home_url() .'/resource-details?url='.$encrypt_url.'" class="res-btn">View </a>';
                $string .= '</div>';
                $string .= '</div>';
                $string .= '</div>';

        	endif;

            if($row_research == 4):
                $string .= '<style>#load_more_research{ display: none; }</style>';
            endif;


            
            }
    } else {
    // no posts found
 $string .= '<li>No Posts Found</li><style>#load_more_research{ display: none; } #show_more_research{ display: none; }</style>';
}
$string .= '</tr>';
   
return $string;
   
/* Restore original Post Data */
wp_reset_postdata();
}
// Add a shortcode
add_shortcode('categoryposts-research', 'asf_postsbycategory_research');

// display research list 

function asf_postsbycategory_research_section() {
// the query

    
$the_query = new WP_Query( "post_type=resource&meta_key=resource_type&meta_value=RESEARCH&order=ASC&offset=0&posts_per_page=10" );

$the_query_research = new WP_Query( 'post_type=resource&meta_key=resource_type&meta_value=RESEARCH&order=ASC' );
$row_research = $the_query_research->found_posts;
   
// The Loop
if ( $the_query->have_posts() ) {
    //$string .= '<tr>';
    //$i = 0; 
    while ( $the_query->have_posts() ) {
        $the_query->the_post();

            if(get_field( "resource_type", $post->ID ) == 'RESEARCH'):

                $original_url = get_field( "resource_url", $post->ID );

                $ext_url = '.'.pathinfo($original_url, PATHINFO_EXTENSION);

                $url_before_dot = substr($original_url, 0, strrpos( $original_url, '.') );
                
                $md5_url = md5($original_url);

                $encrypt_url = $url_before_dot.$md5_url.$ext_url;
            
                $string .= '<div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">';
                $string .= '<div class="row resources d-flex justify-content-sm-center align-items-center">';      
                $string .= '<div class="col-md-9 col-xl-9 col-sm-12 col-xs-12">';
                $string .= '<h1 class="res-heading">'.get_field( "resource_title", $post->ID ).'</h1>';
                $string .= '</div>';
                $string .= '<div class="col-md-3 col-xl-3 col-sm-12 col-xs-12">';
                $string .= '<a href="' . home_url() .'/resource-details?url='.$encrypt_url.'" class="res-btn">View </a>';
                $string .= '</div>';
                $string .= '</div>';
                $string .= '</div>';

            endif;

            if($row_research <= 10):
                $string .= '<style>#load_more_research{ display: none; }</style>';
            endif;


            
            }
    } else {
    // no posts found
 $string .= '<li>No Posts Found</li><style>#load_more_research{ display: none; } #show_more_research{ display: none; }</style>';
}
$string .= '</tr>';
   
return $string;
   
/* Restore original Post Data */
wp_reset_postdata();
}
// Add a shortcode
add_shortcode('categoryposts-research-section', 'asf_postsbycategory_research_section');

/* resource page shortcode */

add_shortcode('resource_list' , 'asf_resource_list');

function asf_resource_list(){
?>
	<style type="text/css">
table {
  width: 100%;
}

 table.borderless td,table.borderless th{
     border: none !important;
}
#view {
  border: 1px solid;
  padding: 10px;
  box-shadow: 5px 10px #888888;
}
</style>

<br><br><br>
<div class="container">
  <div class="row">
    <h2 class="sub-header">PDFs</h2>
      <!-- <table class="table borderless">
        
        <tbody> -->
          <?php echo do_shortcode('[categoryposts-pdf]');  ?>
        
        <!-- </tbody>
      </table> -->
      
  </div>
</div>
<!-- <br><br>
<center><button type="button" class="btn btn-secondary">Load More</button></center> -->
<br><br><br>
<div class="container">
  <div class="row">
    <h2 class="sub-header">Documents</h2>
      <table class="table borderless">
        
        <tbody>
          <?php echo do_shortcode('[categoryposts-document]');  ?>
        
        </tbody>
      </table>
      
  </div>
</div>
<!-- <br><br>
<center><button type="button" class="btn btn-secondary">Load More</button></center> -->
<br><br><br>
<div class="container">
  <div class="row">
    <h2 class="sub-header">Presentation</h2>
      <table class="table borderless">
        
        <tbody>
          <?php echo do_shortcode('[categoryposts-presentation]');  ?>
        
        </tbody>
      </table>
      
  </div>
</div>
<!-- <br><br>
<center><button type="button" class="btn btn-secondary">Load More</button></center> -->
<br><br><br>
<div class="container">
  <div class="row">
    <h2 class="sub-header">Research</h2>
      <table class="table borderless">
        
        <tbody>
          <?php echo do_shortcode('[categoryposts-research]');  ?>
        
        </tbody>
      </table>
      
  </div>
</div>
<!-- <br><br>
<center><button type="button" class="btn btn-secondary">Load More</button></center> -->
<br><br><br>
<?php

}


/* custom column */

function asf_wp_custom_column($column)
{
    $column = array(
        'cb' => '<input type="checkbox"/>',
        'title' => 'Resource Title',
        'type' => 'Resource Type',
        'date' => 'Date',

    );

    return $column;
}

add_action('manage_resource_posts_columns','asf_wp_custom_column');

function resource_custom_column_values( $column, $post_id ) {
 
    switch ( $column ) {
 
        // in this example, a Product has custom fields called 'product_number' and 'product_name'
        
        case 'type':
            $resource_type = get_field( "resource_type", $post_id );
            //$pub_name = get_post_meta( $post_id , 'course_publisher_name' , true );
            echo $resource_type;
            break;
 
    }
}
add_action( 'manage_resource_posts_custom_column' , 'resource_custom_column_values', 10, 2 );

/* resource details page shortcode */

add_shortcode('resource_details' , 'asf_resource_details');

function asf_resource_details(){
    global $post;

    $ext = pathinfo($_GET['url'], PATHINFO_EXTENSION);

	//echo $_GET['url'];
	//echo '<iframe src="'.$_GET['url'].'&embedded=true" frameborder='0'></iframe>';
    if($ext == 'pdf'):

        $url_before_dot = substr($_GET['url'], 0, strrpos( $_GET['url'], '.') );
        $url = substr_replace($url_before_dot ,"", -32);

        $get_url = $url.'.'.$ext;
	   echo '<div class="hidestatusbarpdf"></div><iframe src="'.$get_url.'#toolbar=0 " width="100%" height="800px"></iframe>';
    
         
    elseif($ext == 'docx' || $ext == 'doc'):

        $url_before_dot = substr($_GET['url'], 0, strrpos( $_GET['url'], '.') );
        $url = substr_replace($url_before_dot ,"", -32);
        $get_url = $url.'.'.$ext;

        echo '<iframe src="https://view.officeapps.live.com/op/embed.aspx?src='.$get_url.'" width="100%" height="565px" frameborder="0"> </iframe><div class="hidestatusbardocs"></div>';

    elseif($ext == 'ppt' || $ext == 'pptx'):

        $url_before_dot = substr($_GET['url'], 0, strrpos( $_GET['url'], '.') );
        $url = substr_replace($url_before_dot ,"", -32);
        $get_url = $url.'.'.$ext;

        if($_GET['url'] == 'https://ispen-doc-files.s3.ap-south-1.amazonaws.com/nut articles and ppt/TPN When & howDr. IyerChennai4007e02c4016780031455e7d84d6c6e8.ppt'):
            echo '<iframe src="https://view.officeapps.live.com/op/embed.aspx?src=https://ispen-doc-files.s3.ap-south-1.amazonaws.com/nut+articles+and+ppt/TPN+When+%26+howDr.+IyerChennai.ppt" width="100%" height="565px" frameborder="0"> </iframe><div class="hidestatusbarppt"></div>';
        else:
         echo '<iframe src="https://view.officeapps.live.com/op/embed.aspx?src='.$get_url.'" width="100%" height="565px" frameborder="0"> </iframe><div class="hidestatusbarppt"></div>';
        endif;
        
    endif;



//        echo '<div class="responsive-container">

// <iframe src="https://drive.google.com/file/d/1vsivBz0PrBQ2XUoKbf7zu_w5Y4woJOsm/preview" frameborder="0" scrolling="no" seamless="" width="100%" height="800px"></iframe>
// <div style="width: 80px; height: 80px; position: absolute; opacity: 0; right: 0px; top: 0px;"> </div>';

	
?>
	

	<!-- <iframe src='//docs.google.com/gview?url=URLOFDOC.docx&embedded=true' frameborder='0'></iframe> -->
	<!-- <iframe src="'.<?php //echo $_GET['url']; ?>.'&embedded=true" frameborder='0'></iframe> -->

<?php
}

/* LOAD MORE */

add_shortcode('resource-load-more' , 'asf_resource_load_more');

function asf_resource_load_more(){

    //echo '<div class="col-sm-3"><button class="btn btn-danger" id="load_more">Load More</button></div>';
}


/* load more function */

add_action( 'wp_footer', 'asf_load_more' ); // Write our JS below here

function asf_load_more() { ?>
    <script type="text/javascript" >
    jQuery(document).ready(function($) {

        var pdf_row = '<?php $the_query = new WP_Query( 'post_type=resource&meta_key=resource_type&meta_value=PDF&order=ASC' ); echo $the_query->found_posts; ?>';
        var docs_row = '<?php $the_query = new WP_Query( 'post_type=resource&meta_key=resource_type&meta_value=DOCS&order=ASC' ); echo $the_query->found_posts; ?>';
        var ppt_row = '<?php $the_query = new WP_Query( 'post_type=resource&meta_key=resource_type&meta_value=PPT&order=ASC' ); echo $the_query->found_posts; ?>';
        var research_row = '<?php $the_query = new WP_Query( 'post_type=resource&meta_key=resource_type&meta_value=RESEARCH&order=ASC' ); echo $the_query->found_posts; ?>';

        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        // var divs_pdf = $('#fetch_more').children('div').length;
        // var divs_docs = $('#fetch_more_document').children('div').length;
        if(pdf_row){
        var page_pdf = 1;
        }
        if(docs_row){
        var page_docs = 1;
        }
        if(ppt_row){
        var page_ppt = 1;
        }
        if(research_row){
        var page_research = 1;
        }
        //var page = 2;
        jQuery('#load_more').click(function() {

            //var divs = $('#fetch_more').children('div').length;

            //alert(pdf_row);
        
        //alert("load more");
        var data = {
            'action': 'my_action',
            'page_pdf': page_pdf
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        jQuery.post(ajaxurl, data, function(response) {
            $('#fetch_more').append(response);
            var divs = $('#fetch_more').children('div').length;
            page_pdf = page_pdf + 1;
            if(divs == pdf_row){
            $('#load_more').hide();
            }
        });
        // page = page+1;
        // x = x+1
     });

        jQuery('#load_more_document').click(function() {
        
        //alert("load more");
        var data = {
            'action': 'my_action_document',
            'page_docs': page_docs
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        jQuery.post(ajaxurl, data, function(response) {
            $('#fetch_more_document').append(response);
            var divs = $('#fetch_more_document').children('div').length;
            page_docs = page_docs + 1;
            if(divs == docs_row){
            $('#load_more_document').hide();
            }
        });
        // page = page+1;
        // x = x+1
     });

        jQuery('#load_more_presentation').click(function() {
        
        //alert("load more");
        var data = {
            'action': 'my_action_presentation',
            'page_ppt': page_ppt
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        jQuery.post(ajaxurl, data, function(response) {
            $('#fetch_more_presentation').append(response);
            var divs = $('#fetch_more_presentation').children('div').length;
            page_ppt = page_ppt + 1;
            if(divs == ppt_row){
            $('#load_more_presentation').hide();
            }
        });
        // page = page+1;
        // x = x+1
     });

        jQuery('#load_more_research').click(function() {
        
        //alert("load more");
        var data = {
            'action': 'my_action_research',
            'page_research': page_research
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        jQuery.post(ajaxurl, data, function(response) {
            $('#fetch_more_research').append(response);
            var divs = $('#fetch_more_research').children('div').length;
            page_research = page_research + 1;
            //alert(divs);
            //alert(research_row);
            if(divs == research_row){
            $('#load_more_research').hide();
            }
        });
        // page = page+1;
        // x = x+1
     });

    });
    </script>
<?php }

add_action( 'wp_ajax_my_action', 'asf_my_action' );
add_action( 'wp_ajax_nopriv_my_action', 'asf_my_action' );

function asf_my_action() {

    $count = $_POST['page_pdf'] * 10;
    //$count1 = $_POST['page'] * 5;
    
    $the_query = new WP_Query( "post_type=resource&meta_key=resource_type&meta_value=PDF&order=ASC&offset=$count&posts_per_page=10" );
   
        // The Loop
        if ( $the_query->have_posts() ) {


        //$i = 1;
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            //echo $i;
                

                if(get_field( "resource_type", $post->ID ) == 'PDF'):

                $original_url = get_field( "resource_url", $post->ID );

                $ext_url = '.'.pathinfo($original_url, PATHINFO_EXTENSION);

                $url_before_dot = substr($original_url, 0, strrpos( $original_url, '.') );
                
                $md5_url = md5($original_url);

                $encrypt_url = $url_before_dot.$md5_url.$ext_url;
                    
                    $string .= '<div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">';
                $string .= '<div class="row resources d-flex justify-content-sm-center align-items-center">';      
                $string .= '<div class="col-md-9 col-xl-9 col-sm-12 col-xs-12">';
                $string .= '<h1 class="res-heading">'.get_field( "resource_title", $post->ID ).'</h1>';
                $string .= '</div>';
                $string .= '<div class="col-md-3 col-xl-3 col-sm-12 col-xs-12">';
                $string .= '<a href="' . home_url() .'/resource-details?url='.$encrypt_url.'" class="res-btn">View </a>';
                $string .= '</div>';
                $string .= '</div>';
                $string .= '</div>';

                ?>

                

                <?php

                endif;

                //$i++;

                // if($i == 3):
                //     break;
                // endif;
                
                }
                ?>

            <!-- </div> -->
         <?php
        } else {
        // no posts found
        //$string .= '<li>No Posts Found</li>';
        $string .= '<style>#load_more{ display: none; }</style>';
        }
        $string .= '</tr>';

        //return $string;

        /* Restore original Post Data */
        wp_reset_postdata();

        //$html = "content";
        echo $string;

        wp_die(); 
}

/* load more documents */

add_action( 'wp_ajax_my_action_document', 'asf_my_action_document' );
add_action( 'wp_ajax_nopriv_my_action_document', 'asf_my_action_document' );

function asf_my_action_document() {

    $count = $_POST['page_docs'] * 10;
    //$count1 = $_POST['page'] * 5;
    
    $the_query = new WP_Query( "post_type=resource&meta_key=resource_type&meta_value=DOCS&order=ASC&offset=$count&posts_per_page=10" );
   
        // The Loop
        if ( $the_query->have_posts() ) {


        //$i = 1;
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            //echo $i;
                

                if(get_field( "resource_type", $post->ID ) == 'DOCS'):

                $original_url = get_field( "resource_url", $post->ID );

                $ext_url = '.'.pathinfo($original_url, PATHINFO_EXTENSION);

                $url_before_dot = substr($original_url, 0, strrpos( $original_url, '.') );
                
                $md5_url = md5($original_url);

                $encrypt_url = $url_before_dot.$md5_url.$ext_url;
                    
                $string .= '<div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">';
                $string .= '<div class="row resources d-flex justify-content-sm-center align-items-center">';      
                $string .= '<div class="col-md-9 col-xl-9 col-sm-12 col-xs-12">';
                $string .= '<h1 class="res-heading">'.get_field( "resource_title", $post->ID ).'</h1>';
                $string .= '</div>';
                $string .= '<div class="col-md-3 col-xl-3 col-sm-12 col-xs-12">';
                $string .= '<a href="' . home_url() .'/resource-details?url='.$encrypt_url.'" class="res-btn">View </a>';
                $string .= '</div>';
                $string .= '</div>';
                $string .= '</div>';

                endif;

                //$i++;

                // if($i == 3):
                //     break;
                // endif;
                
                }
                ?>

            <!-- </div> -->
         <?php
        } else {
        // no posts found
        //$string .= '<li>No Posts Found</li>';
        $string .= '<style>#load_more_document{ display: none; }</style>';
        }
        $string .= '</tr>';

        //return $string;

        /* Restore original Post Data */
        wp_reset_postdata();

        //$html = "content";
        echo $string;

        wp_die(); 
}

/* load more presentation */

add_action( 'wp_ajax_my_action_presentation', 'asf_my_action_presentation' );
add_action( 'wp_ajax_nopriv_my_action_presentation', 'asf_my_action_presentation' );

function asf_my_action_presentation() {

    $count = $_POST['page_ppt'] * 10;
    //$count1 = $_POST['page'] * 5;
    
    $the_query = new WP_Query( "post_type=resource&meta_key=resource_type&meta_value=PPT&order=ASC&offset=$count&posts_per_page=10" );
   
        // The Loop
        if ( $the_query->have_posts() ) {


        //$i = 1;
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            //echo $i;
                

                if(get_field( "resource_type", $post->ID ) == 'PPT'):

                $original_url = get_field( "resource_url", $post->ID );

                $ext_url = '.'.pathinfo($original_url, PATHINFO_EXTENSION);

                $url_before_dot = substr($original_url, 0, strrpos( $original_url, '.') );
                
                $md5_url = md5($original_url);

                $encrypt_url = $url_before_dot.$md5_url.$ext_url;
                    
                $string .= '<div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">';
                $string .= '<div class="row resources d-flex justify-content-sm-center align-items-center">';      
                $string .= '<div class="col-md-9 col-xl-9 col-sm-12 col-xs-12">';
                $string .= '<h1 class="res-heading">'.get_field( "resource_title", $post->ID ).'</h1>';
                $string .= '</div>';
                $string .= '<div class="col-md-3 col-xl-3 col-sm-12 col-xs-12">';
                $string .= '<a href="' . home_url() .'/resource-details?url='.$encrypt_url.'" class="res-btn">View </a>';
                $string .= '</div>';
                $string .= '</div>';
                $string .= '</div>';

                endif;

                //$i++;

                // if($i == 3):
                //     break;
                // endif;
                
                }
                ?>

            <!-- </div> -->
         <?php
        } else {
        // no posts found
        //$string .= '<li>No Posts Found</li>';
        $string .= '<style>#load_more_presentation{ display: none; }</style>';
        }
        $string .= '</tr>';

        //return $string;

        /* Restore original Post Data */
        wp_reset_postdata();

        //$html = "content";
        echo $string;

        wp_die(); 
}

/* load more research */

add_action( 'wp_ajax_my_action_research', 'asf_my_action_research' );
add_action( 'wp_ajax_nopriv_my_action_research', 'asf_my_action_research' );

function asf_my_action_research() {

    $count = $_POST['page_research'] * 10;
    //$count1 = $_POST['page'] * 5;
    
    $the_query = new WP_Query( "post_type=resource&meta_key=resource_type&meta_value=RESEARCH&order=ASC&offset=$count&posts_per_page=10" );
   
        // The Loop
        if ( $the_query->have_posts() ) {


        //$i = 1;
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
            //echo $i;
                

                if(get_field( "resource_type", $post->ID ) == 'RESEARCH'):

                $original_url = get_field( "resource_url", $post->ID );

                $ext_url = '.'.pathinfo($original_url, PATHINFO_EXTENSION);

                $url_before_dot = substr($original_url, 0, strrpos( $original_url, '.') );
                
                $md5_url = md5($original_url);

                $encrypt_url = $url_before_dot.$md5_url.$ext_url;
                    
                    $string .= '<div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">';
                $string .= '<div class="row resources d-flex justify-content-sm-center align-items-center">';      
                $string .= '<div class="col-md-9 col-xl-9 col-sm-12 col-xs-12">';
                $string .= '<h1 class="res-heading">'.get_field( "resource_title", $post->ID ).'</h1>';
                $string .= '</div>';
                $string .= '<div class="col-md-3 col-xl-3 col-sm-12 col-xs-12">';
                $string .= '<a href="' . home_url() .'/resource-details?url='.$encrypt_url.'" class="res-btn">View </a>';
                $string .= '</div>';
                $string .= '</div>';
                $string .= '</div>';

                endif;

                //$i++;

                // if($i == 3):
                //     break;
                // endif;
                
                }
                ?>

            <!-- </div> -->
         <?php
        } else {
        // no posts found
        //$string .= '<li>No Posts Found</li>';
        $string .= '<style>#load_more_research{ display: none; }</style>';
        }
        $string .= '</tr>';

        //return $string;

        /* Restore original Post Data */
        wp_reset_postdata();

        //$html = "content";
        echo $string;

        wp_die(); 
}

//Adds Custom Column To Users List Table
function asf_modify_user_table($columns) {
    $columns['member_id'] = 'MemberShip ID';
    //$columns['user_id'] = 'User ID';
    $columns['user_type'] = 'User Type';
    $columns['phone'] = 'Phone';
    //$columns['city'] = 'City';
    $columns['country'] = 'Country';
    $columns['receipt'] = 'Receipt';
    return $columns;
}
add_filter('manage_users_columns', 'asf_modify_user_table');
//Adds Content To The Custom Added Column
function asf_users_custom_column_values($value, $column_name, $user_id) {
    $user = get_userdata( $user_id );
    $timeperiod = esc_attr( get_the_author_meta( 'timeperiod', $user_id ) );
    $life_membership_applied = esc_attr( get_the_author_meta( 'life_membership_applied', $user_id ) );
    if ( 'member_id' == $column_name ){
        $roles = get_user_meta( $user_id, 'wp_capabilities', true );
        if(isset($roles['um_temporary-member']) && $roles['um_temporary-member'] == 1):
            //return 'TM00'.$user_id;
            return get_user_meta( $user_id, 'membership_id', true );
        elseif($roles['subscriber'] == 1 && $life_membership_applied == 'pending'):
            //return 'LTM00'.$user_id;
            return '<b style="color:red;">Pending<b>';    
        elseif(isset($roles['um_permanent-member']) && $roles['um_permanent-member'] == 1 && $timeperiod == 'select'):
            //return 'LTM00'.$user_id;
            return '<b style="color:red;">Pending<b>';
        elseif(isset($roles['um_permanent-member']) && $roles['um_permanent-member'] == 1):
            //return 'LTM00'.$user_id;
            return get_user_meta( $user_id, 'membership_id', true );
            //return $timeperiod;
        elseif(isset($roles['um_pre-2019-ispen-members']) && $roles['um_pre-2019-ispen-members'] == 1):
            //return 'LTM00'.$user_id;
            return get_user_meta( $user_id, 'membership_id', true );
            //return $timeperiod;
        else:
            return '-';
        endif;
        //return print_r(get_user_meta( $user_id, 'wp_capabilities', true ));
        }
    // if ( 'user_id' == $column_name )
    //     return $user_id;
        if ( 'user_type' == $column_name )
        return get_user_meta( $user_id, 'user_type', true );
        //return get_the_author_meta( 'life_member_certificate', $user_id );
    if ( 'phone' == $column_name )
        //return get_user_meta( $user_id, 'mobile_number', true );
        if(!empty(get_user_meta( $user_id, 'billing_phone', true ))):
            return get_user_meta( $user_id, 'billing_phone', true );
        elseif(get_user_meta( $user_id, 'mobile_number', true )):
            return get_user_meta( $user_id, 'mobile_number', true );
        endif;
    if ( 'country' == $column_name )
        return get_user_meta( $user_id, 'country', true );
    if('receipt' == $column_name):
        $roles = get_user_meta( $user_id, 'wp_capabilities', true );
        if(isset($roles['um_permanent-member']) && $roles['um_permanent-member'] == 1):
            //return '<a target="_blank" href="https://ispen.org.in/wp-content/uploads/membership-receipt/"'.$user_id.'" style="color:blue;">Receipt<a>';
            return "<a target='_blank' href='https://ispen.org.in/wp-content/uploads/membership-receipt/$user_id.pdf' style='color:blue;'>Receipt<a>"; 
        endif;
    endif; 
    return $value;

}
add_filter('manage_users_custom_column',  'asf_users_custom_column_values', 10, 3);

/* add extra field in edit user form */

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { 

    $roles = get_user_meta( $user->ID, 'wp_capabilities', true );
    foreach($roles as $key=>$val):
        $role[] = $key;
    endforeach;

    // common field
    ?>

    <!-- approved/disapproved -->
    <?php
    $life_membership_status = esc_attr( get_the_author_meta( 'life_membership_applied', $user->ID ) );
    
    if($life_membership_status == 'pending' && $roles['subscriber'] == 1):
    ?>
    <h3><?php _e("Approved/Disapproved", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="approved_disapproved"><?php _e("Approved/Disapproved"); ?></label></th>
        <td>
            <!-- <input type="text" name="address" id="address" value="<?php //echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /> -->
            <select name="approved_disapproved" id="approved_disapproved">
                <option value="select">Select</option>
                <option value="Approved" <?php if(esc_attr( get_the_author_meta( 'approved_disapproved', $user->ID ) ) == 'Approved'): echo 'selected="selected"'; endif; ?>>Approved</option>
                <option value="Disapproved" <?php if(esc_attr( get_the_author_meta( 'approved_disapproved', $user->ID ) ) == 'Disapproved'): echo 'selected="selected"'; endif; ?>>Disapproved</option>
            </select>
        </td>
    </tr>

    </table>
    <?php endif; ?>

    <h3><?php _e("Extra Info", "blank"); ?></h3>

    <table class="form-table">
    

    <tr>
        
        <th><label for="mo_num"><?php _e("City"); ?>: <?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?></label></th>
        <th><label for="mo_num"><?php _e("State"); ?>: <?php echo esc_attr( get_the_author_meta( 'state', $user->ID ) ); ?></label></th>
        <th><label for="mo_num"><?php _e("Country"); ?>: <?php echo esc_attr( get_the_author_meta( 'country', $user->ID ) ); ?></label></th>
        <th><label for="mo_num"><?php _e("Hospital Name"); ?>: <?php echo esc_attr( get_the_author_meta( 'institution_hospital', $user->ID ) ); ?></label></th>
        <th><label for="mo_num"><?php _e("Designation"); ?>: <?php echo esc_attr( get_the_author_meta( 'designation', $user->ID ) ); ?></label></th>
        <th><label for="mo_num"><?php _e("Mobile"); ?>: <?php echo esc_attr( get_the_author_meta( 'mobile_number', $user->ID ) ); ?></label></th>
        <th><label for="mo_num"><?php _e("Address"); ?>: <?php echo esc_attr( get_the_author_meta( 'permanent_address', $user->ID ) ); ?></label></th>
        <th><label for="mo_num"><?php _e("User Type"); ?>: <?php echo esc_attr( get_the_author_meta( 'user_type', $user->ID ) ); ?></label></th>
        <th><label for="membership_amount"><?php _e("Membership Payment"); ?>: <?php echo esc_attr( get_the_author_meta( 'membership_amount', $user->ID ) ); ?></label></th>
        <th><label for="registration_date"><?php _e("Registration Date"); ?>: <?php echo esc_attr( get_the_author_meta( 'user_registered', $user->ID ) ); ?></label></th>
        <th><label for="payment_date"><?php _e("Payment Date"); ?>: <?php echo esc_attr( get_the_author_meta( 'membership_reg_date', $user->ID ) ); ?></label></th>
        
    </tr>
    
    </table>
    <?php
        if(in_array('um_temporary-member', $role)):
    ?>
    <h3><?php _e("Temporary Membership", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="timeperiod"><?php _e("Time Period"); ?></label></th>
        <td>
            <!-- <input type="text" name="address" id="address" value="<?php //echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /> -->
            <select required name="timeperiod" id="timeperiod">
                <option value="0" >Select</option>
                <option value="1" <?php if(esc_attr( get_the_author_meta( 'timeperiod', $user->ID ) ) == 1): echo 'selected="selected"'; endif; ?>>1 Year</option>
                <option value="2" <?php if(esc_attr( get_the_author_meta( 'timeperiod', $user->ID ) ) == 2): echo 'selected="selected"'; endif; ?>>2 Year</option>
                <option value="3" <?php if(esc_attr( get_the_author_meta( 'timeperiod', $user->ID ) ) == 3): echo 'selected="selected"'; endif; ?>>3 Year</option>
                <option value="4" <?php if(esc_attr( get_the_author_meta( 'timeperiod', $user->ID ) ) == 4): echo 'selected="selected"'; endif; ?>>4 Year</option>
            </select>
        </td>
    </tr>

    <tr>
        
        <th><label for="mo_num"><?php _e("Mobile Number"); ?></label></th>
        <td>
            <input type="text" name="mo_num" id="mo_num" value="<?php echo esc_attr( get_the_author_meta( 'mo_num', $user->ID ) ); ?>" class="regular-text" />
            
        </td>
    </tr>
    
    </table>

<?php 
endif;
if(in_array('um_permanent-member', $role) || in_array('um_pre-2019-ispen-members', $role)): 
?>

    <h3><?php _e("Permanent Membership", "blank"); ?></h3>

    <table class="form-table">

    <tr>
        
        <th><label for="mo_num"><?php _e("Membership Id"); ?></label></th>
        <td>
            <input type="text" name="membership_id" id="membership_id" value="<?php echo esc_attr( get_the_author_meta( 'membership_id', $user->ID ) ); ?>" class="regular-text" />
            
        </td>
    </tr>

    <tr>
        <th><label for="timeperiod"><?php _e("Time Period"); ?></label></th>
        <td>
            <!-- <input type="text" name="address" id="address" value="<?php //echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /> -->
            <select required name="timeperiod" id="timeperiod">
                <option value="select" <?php if(esc_attr( get_the_author_meta( 'timeperiod', $user->ID ) ) == 'select'): echo 'selected="selected"'; endif; ?>>Select</option>
                <option value="permanent" <?php if(esc_attr( get_the_author_meta( 'timeperiod', $user->ID ) ) == 'permanent'): echo 'selected="selected"'; endif; ?>>Permanent</option>
            </select>
        </td>
    </tr>

    <tr>
        
        <th><label for="mo_num"><?php _e("Mobile Number"); ?></label></th>
        <td>
            <input type="text" name="mo_num" id="mo_num" value="<?php echo esc_attr( get_the_author_meta( 'mo_num', $user->ID ) ); ?>" class="regular-text" />
            
        </td>
    </tr>
    
    </table>

<?php   
    endif;
}

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    $arr1 = array();
    $arr2 = array();
    //echo $_POST['timeperiod'].$user_id;die;
    $approved_disapproved = esc_attr( get_the_author_meta( 'approved_disapproved', $user_id ) );
    $timeperiod_check = esc_attr( get_the_author_meta( 'timeperiod', $user_id ) );
    if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
        return;
    }
    
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }

    if($_POST['role'] == 'subscriber' && $_POST['approved_disapproved'] == "Approved" && $approved_disapproved != 'Approved'):

        // price section

            $user_arg = array(
            'role'    => 'subscriber',
            'meta_query' => array(
                    array(
                        'key' => 'user_type',
                        'value' => '',
                        'compare' => '!='
                    )
                ),
            'orderby' => 'ID',
            'order'   => 'DESC'
            );
            $users_details = get_users( $user_arg );

            foreach($users_details as $user):
                //physicians

                    if($user->ID == $user_id && $user->country != '' && $user->country != 'India' && $user->user_type == 'physicians'):
                        $utype = 'Physicians';
                        $amount = '15,600';
                        break;
                    elseif($user->ID == $user_id && $user->country == 'India' && $user->user_type == 'physicians'):
                        $utype = 'Physicians';
                        $amount = '3,000';
                        break;
                    elseif($user->ID == $user_id && $user->country == '' && $user->user_type == 'physicians'):
                        $utype = 'Physicians';
                        $amount = '3,000';
                        break;
                    endif;

                //dietician

                    if($user->ID == $user_id && $user->country != '' && $user->country != 'India' && $user->user_type == 'dietician'):
                        $utype = 'Dietician';
                        $amount = '7,800';
                        break;
                    elseif($user->ID == $user_id && $user->country == 'India' && $user->user_type == 'dietician'):
                        $utype = 'Non Physicians';
                        $amount = '3,000';
                        break;
                    elseif($user->ID == $user_id && $user->country == '' && $user->user_type == 'dietician'):
                        $utype = 'Dietician';
                        $amount = '3,000';
                        break;
                    endif;

                //other user type

                    if($user->ID == $user_id && $user->country != '' && $user->country != 'India' && $user->user_type == 'othertype'):
                        $utype = $user->otherutype;
                        $amount = '7,800';
                        break;
                    elseif($user->ID == $user_id && $user->country == 'India' && $user->user_type == 'othertype'):
                        $utype = $user->otherutype;
                        $amount = '3,000';
                        break;
                    elseif($user->ID == $user_id && $user->country == '' && $user->user_type == 'othertype'):
                        $utype = $user->otherutype;
                        $amount = '3,000';
                        break;
                    endif;

                //industry

                    if($user->ID == $user_id && $user->user_type == 'industry'):
                        $utype = 'Industry';
                        $amount = '50,000';
                        break;
                    endif;

                
            endforeach;
            //echo $user_id."/".$utype."/".$amount;die;
            update_user_meta( $user_id, 'membership_amount', $amount );

            $mail_sent = asf_send_ltm_mail_approved( $_POST['email'], $_POST['first_name'], $utype, $amount );
    endif;

    if($_POST['role'] == 'subscriber' && $_POST['approved_disapproved'] == "Disapproved" && $approved_disapproved != 'Disapproved'):
        $mail_sent = asf_send_ltm_mail_disapproved( $_POST['email'], $_POST['first_name'] );
    endif;

    // Pre-2019 ISPEN Members


    if($_POST['role'] == 'um_pre-2019-ispen-members'):
        $user_meta = get_userdata($user_id);
       $user_roles = $user_meta->roles;
        //echo "<pre>";
        //print_r($_POST);die;
        // echo $user_id;die;
        // $arr1 = array();
        // $arr2 = array();
            // fetch membership id
        //echo "test";die;
        $users1 = get_user_by( 'email', $_POST['email'] );
        //echo $users1->user_registered."asdas";die;
        //echo $users1->membership_reg_date."asdas";die;
        //echo date("Y-m-d")."asdas";die;
            global $wpdb;

            $table_name = 'wp_users';


            $args = array(
            //'role'    => 'administrator',
            'meta_query' => array(
            array(
            'key' => 'membership_id',
            'value' => '',
            'compare' => '!='
            )
            ),
            'orderby' => 'ID'
            //'order'   => 'ASC'
            );
            $users = get_users( $args );

            //echo "<pre>";
            //print_r($users);

            foreach ($users as $val) {
            //echo $val->billing_city."<br>";

            $membership_id = $val->membership_id;

            if(strstr($membership_id, '/') && strpos($membership_id, "o")){

            $sec1 = substr($membership_id, strrpos($membership_id, '/') + 1)."<br>";

            //echo date('Y');

            $arr1[] = $sec1;
            //print_r($arr1);die;

            // sec2

            $membership_sid1 = substr($membership_id, strpos($membership_id, "/") + 1);    

            $sec2 = explode("/", $membership_sid1, 2);
            $arr2[] = $sec2[1];



            }
            }
            //echo $membership_id;
            //echo strpos($membership_id, "o");die;
            //if(strstr($membership_id, '/') && strpos($membership_id, "o")){
                //echo $user_id."11111";die;
                rsort($arr1);
                rsort($arr2);
                //print_r($arr1);
                //print_r($arr2);
                $s1 = $arr2[0]+1;
                $s2 = $arr1[0]+1;

                //$mid = "Lm/".$s1."/".date('Y')."/".$s2;
                $mid = "Lm/o/".date('Y')."/00".$s2;
                //echo $mid;die;
                if(!in_array('um_pre-2019-ispen-members', $user_roles)):
                    update_user_meta( $user_id, 'membership_reg_date', date("Y-m-d") );
                    update_user_meta( $user_id, 'membership_id', $mid );
                endif;
                if(in_array('um_pre-2019-ispen-members', $user_roles) && empty($_POST['membership_id'])):
                    update_user_meta( $user_id, 'membership_reg_date', date("Y-m-d") );
                    update_user_meta( $user_id, 'membership_id', $mid );
                endif;
            //} 
            //else{
                //echo $user_id."2222";
                //update_user_meta( $user_id, 'membership_reg_date', date("Y-m-d") );
                //update_user_meta( $user_id, 'membership_id', 'Lm/o/2024/001' );
            //}  
            
        //update_user_meta( $user_id, 'membership_id', 'LTM00'.$user_id );
        //$mail_sent = asf_send_ltm_mail_backend( $_POST['email'], 'LTM00'.$user_id, $_POST['first_name'] );
    endif;

    if($_POST['role'] == 'um_permanent-member'):
        $user_meta = get_userdata($user_id);
        $user_roles = $user_meta->roles;
        if(!in_array('um_permanent-member', $user_roles)):
            update_user_meta( $user_id, 'membership_id', '' );
        endif;
            // fetch membership id
        //echo "test";die;
        $users1 = get_user_by( 'email', $_POST['email'] );
        //echo $users1->user_registered."asdas";die;
        //echo $users1->membership_reg_date."asdas";die;
        //echo date("Y-m-d")."asdas";die;
            global $wpdb;

            $table_name = 'wp_users';


            $args = array(
            //'role'    => 'administrator',
            'meta_query' => array(
            array(
            'key' => 'membership_id',
            'value' => '',
            'compare' => '!='
            )
            ),
            'orderby' => 'ID'
            //'order'   => 'ASC'
            );
            $users = get_users( $args );

            //echo "<pre>";
            //print_r($users);

            foreach ($users as $val) {
            //echo $val->billing_city."<br>";

            $membership_id = $val->membership_id;

            if(strstr($membership_id, '/') && !strpos($membership_id, "o")){

            $sec1 = substr($membership_id, strrpos($membership_id, '/') + 1)."<br>";

            //echo date('Y');

            $arr1[] = $sec1;

            // sec2

            $membership_sid1 = substr($membership_id, strpos($membership_id, "/") + 1);    

            $sec2 = explode("/", $membership_sid1, 2);
            $arr2[] = $sec2[0];



            }
            }

            rsort($arr1);
            rsort($arr2);
            //print_r($arr1);
            //print_r($arr2);
            $s1 = $arr2[0]+1;
            $s2 = $arr1[0]+1;

            $mid = "Lm/".$s1."/".date('Y')."/".$s2;

        update_user_meta( $user_id, 'timeperiod', $_POST['timeperiod'] );
        if($_POST['timeperiod'] == 'permanent' && $timeperiod_check == 'permanent'):
            generate_receipt($_POST['email']);
        endif;
        if($_POST['timeperiod'] == 'permanent' && $timeperiod_check != 'permanent'):
            
            //echo "aaa";die;
            
            update_user_meta( $user_id, 'membership_reg_date', date("Y-m-d") );
            update_user_meta( $user_id, 'membership_id', $mid );
            generate_receipt($_POST['email']);

            // user info
            $user_type = esc_attr( get_the_author_meta( 'user_type', $user_id ) );
            $membership_amount = esc_attr( get_the_author_meta( 'membership_amount', $user_id ) );
            $mail_sent = asf_send_ltm_mail_backend( $_POST['email'], $mid, $_POST['first_name'], $user_type, $membership_amount );
        endif;
        //update_user_meta( $user_id, 'membership_id', 'LTM00'.$user_id );
        //$mail_sent = asf_send_ltm_mail_backend( $_POST['email'], 'LTM00'.$user_id, $_POST['first_name'] );
    endif;
    $users2 = get_user_by( 'email', $_POST['email'] );
    if($_POST['role'] == 'um_temporary-member' && $_POST['timeperiod'] == 'permanent'):
        update_user_meta( $user_id, 'timeperiod', 'Time Period Required' );
    endif;
    if($_POST['role'] == 'um_temporary-member' && $_POST['timeperiod'] == '0'):
        update_user_meta( $user_id, 'timeperiod', 'Time Period Required' );
    //elseif($_POST['role'] == 'um_temporary-member' && $_POST['timeperiod'] != 'permanent'):
    elseif($_POST['role'] == 'um_temporary-member' && $_POST['timeperiod'] != 'permanent' && $_POST['timeperiod'] != $users2->timeperiod):
        //echo $users2->timeperiod;die;
        update_user_meta( $user_id, 'timeperiod', $_POST['timeperiod'] );
        update_user_meta( $user_id, 'membership_reg_date', date("Y-m-d") );
        //update_user_meta( $user_id, 'membership_id', 'TM00'.$user_id );
    elseif($_POST['role'] != 'um_temporary-member' && $_POST['role'] != 'um_permanent-member'):
            update_user_meta( $user_id, 'timeperiod', '0' );
            //update_user_meta( $user_id, 'membership_id', '' );
        if($_POST['role'] == 'um_pre-2019-ispen-members'):
            update_user_meta( $user_id, 'timeperiod', 'select' );
        endif;
        if($_POST['role'] != 'um_pre-2019-ispen-members'):
            update_user_meta( $user_id, 'membership_id', '' );
        //else:
            //update_user_meta( $user_id, 'membership_id', '' );
        endif;
        $user_meta = get_userdata($user_id);
        $user_roles = $user_meta->roles;
        if(!in_array('um_pre-2019-ispen-members', $user_roles)):
            update_user_meta( $user_id, 'membership_id', '' );
        endif;

    endif;
    //update_user_meta( $user_id, 'timeperiod', $_POST['timeperiod'] );
    update_user_meta( $user_id, 'mo_num', $_POST['mo_num'] );
    update_user_meta( $user_id, 'approved_disapproved', $_POST['approved_disapproved'] );
    //update_user_meta( $user_id, 'city', $_POST['city'] );
    //update_user_meta( $user_id, 'postalcode', $_POST['postalcode'] );
}



/* membership reg */

add_action( 'wp_ajax_my_action_membership', 'asf_my_action_membership' );
add_action( 'wp_ajax_nopriv_my_action_membership', 'asf_my_action_membership' );

function asf_my_action_membership() {
    $arr1 = array();
    $arr2 = array();
    //echo $_POST['academic_background']; die;

    $user_id = get_current_user_id();
    $academic_background = $_POST['academic_background'];
    $academic_background1 = $_POST['academic_background1'];
    $academic_background2 = $_POST['academic_background2'];
    $academic_background3 = $_POST['academic_background3'];
    $academic_background4 = $_POST['academic_background4'];
    $academic_background5 = $_POST['academic_background5'];
    $user_email = $_POST['user_email'];
    $user_type = $_POST['user_type'];
    $otherutype = $_POST['otherutype'];
    $academic_year = $_POST['academic_year'];
    $academic_year1 = $_POST['academic_year1'];
    $academic_year2 = $_POST['academic_year2'];
    $academic_year3 = $_POST['academic_year3'];
    $academic_year4 = $_POST['academic_year4'];
    $academic_year5 = $_POST['academic_year5'];
    $professional_category = $_POST['professional_category'];
    $designation = $_POST['designation'];
    $physician_speciality = $_POST['physician_speciality'];
    $other_specify = $_POST['other_specify'];
    $permanent_address = $_POST['permanent_address'];
    $curDate = date('Y-m-d');
    $curDate = date('d-m-Y', strtotime($curDate));
    //echo $academic_background;

    ///// Dynamic membership id /////

    global $wpdb;
            
    $table_name = 'wp_users';
    

    $args = array(
    //'role'    => 'administrator',
    'meta_query' => array(
            array(
                'key' => 'membership_id',
                'value' => '',
                'compare' => '!='
            )
        ),
    'orderby' => 'ID'
    //'order'   => 'ASC'
    );
    $users = get_users( $args );

    //echo "<pre>";
    //print_r($users);

    foreach ($users as $val) {
        //echo $val->billing_city."<br>";

        $membership_id = $val->membership_id;

        if(strstr($membership_id, '/') && !strpos($membership_id, "o")){

        $sec1 = substr($membership_id, strrpos($membership_id, '/') + 1)."<br>";

        //echo date('Y');

        $arr1[] = $sec1;

        // sec2

        $membership_sid1 = substr($membership_id, strpos($membership_id, "/") + 1);    

        $sec2 = explode("/", $membership_sid1, 2);
        $arr2[] = $sec2[0];



        }
    }

    rsort($arr1);
    rsort($arr2);
    //print_r($arr1);
    //print_r($arr2);
    $s1 = $arr2[0]+1;
    $s2 = $arr1[0]+1;

    $mid = "Lm/".$s1."/".date('Y')."/".$s2;

    ///// end of code //////

    wp_update_user( array( 'ID' => $user_id, 'role' => 'subscriber' ) );
    update_user_meta( $user_id, 'academic_background', $academic_background );
    update_user_meta( $user_id, 'academic_background1', $academic_background1 );
    update_user_meta( $user_id, 'academic_background2', $academic_background2 );
    update_user_meta( $user_id, 'academic_background3', $academic_background3 );
    update_user_meta( $user_id, 'academic_background4', $academic_background4 );
    update_user_meta( $user_id, 'academic_background5', $academic_background5 );
    update_user_meta( $user_id, 'user_type', $user_type );
    update_user_meta( $user_id, 'otherutype', $otherutype );
    update_user_meta( $user_id, 'academic_year', $academic_year );
    update_user_meta( $user_id, 'academic_year1', $academic_year1 );
    update_user_meta( $user_id, 'academic_year2', $academic_year2 );
    update_user_meta( $user_id, 'academic_year3', $academic_year3 );
    update_user_meta( $user_id, 'academic_year4', $academic_year4 );
    update_user_meta( $user_id, 'academic_year5', $academic_year5 );
    update_user_meta( $user_id, 'professional_category', $professional_category );
    update_user_meta( $user_id, 'designation', $designation );
    update_user_meta( $user_id, 'physician_speciality', $physician_speciality );
    update_user_meta( $user_id, 'other_specify', $other_specify );
    update_user_meta( $user_id, 'permanent_address', $permanent_address );
    //update_user_meta( $user_id, 'membership_id', 'LTM00'.$user_id );
    //update_user_meta( $user_id, 'membership_id', $mid );
    update_user_meta( $user_id, 'membership_id', '' );
    update_user_meta( $user_id, 'timeperiod', 'select' );
    update_user_meta( $user_id, 'membership_reg_date', '' );
    update_user_meta( $user_id, 'life_membership_applied', 'pending' );

    $user = wp_get_current_user();
    $membership_id = $user->membership_id;
    $user_name = $user->first_name;

    /* email code */

    $mail_sent = asf_send_ltm_mail( $user_email, $membership_id, $user_name );

    die();
}


/* returning membership reg */

add_action( 'wp_ajax_my_action_returning_membership', 'asf_my_action_returning_membership' );
add_action( 'wp_ajax_nopriv_my_action_returning_membership', 'asf_my_action_returning_membership' );

function asf_my_action_returning_membership() {


    $user_id = get_current_user_id();
    $academic_background = $_POST['academic_background'];
    $academic_background1 = $_POST['academic_background1'];
    $academic_background2 = $_POST['academic_background2'];
    $academic_background3 = $_POST['academic_background3'];
    $academic_background4 = $_POST['academic_background4'];
    $academic_background5 = $_POST['academic_background5'];
    $user_email = $_POST['user_email'];
    $user_type = $_POST['user_type'];
    $otherutype = $_POST['otherutype'];
    $academic_year = $_POST['academic_year'];
    $academic_year1 = $_POST['academic_year1'];
    $academic_year2 = $_POST['academic_year2'];
    $academic_year3 = $_POST['academic_year3'];
    $academic_year4 = $_POST['academic_year4'];
    $academic_year5 = $_POST['academic_year5'];
    $professional_category = $_POST['professional_category'];
    $designation = $_POST['designation'];
    $mobile_number = $_POST['mobile_number'];
    $email_id = $_POST['email_id'];
    $old_membership_id = $_POST['old_membership_id'];
    $physician_speciality = $_POST['physician_speciality'];
    $other_specify = $_POST['other_specify'];
    $permanent_address = $_POST['permanent_address'];
    //echo $academic_background;

    wp_update_user( array( 'ID' => $user_id, 'role' => 'subscriber' ) );
    update_user_meta( $user_id, 'academic_background', $academic_background );
    update_user_meta( $user_id, 'academic_background1', $academic_background1 );
    update_user_meta( $user_id, 'academic_background2', $academic_background2 );
    update_user_meta( $user_id, 'academic_background3', $academic_background3 );
    update_user_meta( $user_id, 'academic_background4', $academic_background4 );
    update_user_meta( $user_id, 'academic_background5', $academic_background5 );
    update_user_meta( $user_id, 'user_type', $user_type );
    update_user_meta( $user_id, 'otherutype', $otherutype );
    update_user_meta( $user_id, 'academic_year', $academic_year );
    update_user_meta( $user_id, 'academic_year1', $academic_year1 );
    update_user_meta( $user_id, 'academic_year2', $academic_year2 );
    update_user_meta( $user_id, 'academic_year3', $academic_year3 );
    update_user_meta( $user_id, 'academic_year4', $academic_year4 );
    update_user_meta( $user_id, 'academic_year5', $academic_year5 );
    update_user_meta( $user_id, 'professional_category', $professional_category );
    update_user_meta( $user_id, 'designation', $designation );
    update_user_meta( $user_id, 'mobile_number', $mobile_number );
    update_user_meta( $user_id, 'email_id', $email_id );
    update_user_meta( $user_id, 'old_membership_id', $old_membership_id );
    update_user_meta( $user_id, 'physician_speciality', $physician_speciality );
    update_user_meta( $user_id, 'other_specify', $other_specify );
    update_user_meta( $user_id, 'permanent_address', $permanent_address );
    update_user_meta( $user_id, 'membership_id', '' );
    update_user_meta( $user_id, 'timeperiod', 'select' );



    /* email code */

    //$mail_sent = asf_send_ltm_mail( $user_email );

    die();
}

/* UM email validation */

add_action('um_submit_form_errors_hook_', 'um_custom_validate_username_nickname', 999, 1);

function um_custom_validate_username_nickname( $args ) {

    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

    // Complete API Libraries and Wrappers can be found here: 
    // https://www.zerobounce.net/docs/zerobounce-api-wrappers/#api_wrappers__v2__php

    //set the api key and email to be validated
    $api_key = 'd315bb1b62d44506b3319e32a23ee1a6';
    $emailToValidate = $args['user_email'];
    $IPToValidate = '';
    // use curl to make the request
    $url = 'https://api.zerobounce.net/v2/validate?api_key='.$api_key.'&email='.urlencode($emailToValidate).'&ip_address='.urlencode($IPToValidate);

    $ch = curl_init($url);
    //PHP 5.5.19 and higher has support for TLS 1.2
    curl_setopt($ch, CURLOPT_SSLVERSION, 6);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 150); 
    $response = curl_exec($ch);
    curl_close($ch);

    //decode the json response
    $json = json_decode($response, true);

    //print_r($json);die;

    //$email_exists = email_exists($args['user_email']);

    //if ( isset( $args['user_email'] ) && $args['user_email'] == 'ss@gmail.com' ) {
    // if(email_exists($args['user_email'])){
    //     UM()->form()->add_error( 'user_email', $args['user_email'] );
    // }
    // else
    if (!preg_match($regex, $args['user_email'])) {
        UM()->form()->add_error( 'user_email', 'Please enter a valid email' );
    }
    elseif($json['status'] == 'invalid'){
        UM()->form()->add_error( 'user_email', 'This email is invalid' );
    }
    // elseif($email_exists){
    //     UM()->form()->add_error( 'user_email', 'This email is already registered ' );
    // }
}


function asf_send_ltm_mail( $email, $membership_id, $user_name ){    
    $to         = $email;
    $subject    = 'Hi '.$user_name.', your lifetime member of '. get_bloginfo().' is in process! Here is what to do next.';
    // $body = 'The email body content';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: Dr. Sanjith from ISPEN <no-reply@docmode.com>';
    //$headers[] = 'Cc: asif@docmode.com';
    //$headers[] = 'Cc: Richa <richa@docmode.com>';
    //$headers[] = 'Cc: hemant <hemant@docmode.com>';
    $body ='<body style="margin: 0;padding: 0;font-family: sans-serif;color: #000;font-size: 15px;">
    <div style="max-width: 50%;margin: 2rem auto;">
    <center><img style="border: 1px solid #EBEBEB;" height="100px" width="150px" src="https://ispen.org.in/wp-content/uploads/2022/04/logo3.jpg"></center>
        <div style="padding: 1.3rem 0.8rem;border-top: 1px solid #000;border-bottom: 1px solid #000;">
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                Congratulations, you just joined an exclusive network of over 1,000 professionals in the industry.
            </p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                <span style="color: #ff0000;font-weight: 700;">ISPEN</span> was formed and registered as a Society in 1994 at Chennai and is the additional link to the already existing chain consisting of American Society for Parenteral and Enteral Nutrition [ASPEN], European [ESPEN], Australian [AusPEN], Parenteral and Enteral Society of Asia [PENSA], and South African [SASPEN] societies. Members of ISPEN automatically become members of PENSA.
            </p>
            
            <p style="line-height: 1.5;margin-top: 0;">
                Email ID : <a href="mailto:'.$email.'">'.$email.'</a>
            </p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem; color: red; font-weight: bold;">You will receive the notification for further process until the next committee meeting is conducted</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                As a member, here are some of the <span style="font-weight: 700;">benefits</span> you receive:
                <ul style="line-height: 1.7;">
                    <li>Access to the ISPEN journal</li>
                    <li>Access to ISPEN Newsletter and information/updates on online events</li>
                    <li>Discount on registration fees for national and other conferences of the ISPEN</li>
                    <li>Automatically become a member of your ISPEN local branch and get invited to all branch meetings and regular updates</li>
                    <li>A chance to get your Hospital recognized to conduct ISPEN endorsed and accredited courses if they meet the criteria</li>
                    <li>Ability to register your Hospital/ICU with ISPEN and participate in ISPEN research projects</li>
                    <li>Discounts on nutrition related books and more</li>
                    <li>
                        Access to ISPEN Interdisciplinary Partners programs (e.g. – ISPEN and ISCCM for Critical Care Nutrition, ISPEN and FOGSI for Women’s Nutrition etc.)
                    </li>
                    <li>Connect with programs with International Partners of ISPEN such as ASPEN, ESPEN and PENSA</li>
                    <li>Access to our resources page where we have put up tons of study materials and research papers and more coming your way</li>
                </ul>
            </p>
            
            <div style="text-align: center;margin: 1rem 0;">
                <a href="https://ispen.org.in/" style="background: #ff0000; text-decoration: none; color: #fff !important;padding: 0.7rem 1.2rem;border: none;font-size: 18px;font-weight: 600;border-radius: 5px;">Visit ISPEN</a>
            </div>
            
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Best Regards,</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Dr. Sanjith Saseedharan- President, ISPEN</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Dr.Ravinder B. Reddy- Immediate Past president, ISPEN</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Dr. Radha Reddy Chada- General Secretary, ISPEN</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Ms. Bamini M- Treasurer, ISPEN</p>
            
            
        </div>
        <div style="text-align: center;padding: 1rem 0 0;font-size: 0.8rem;color: #666;font-weight: 600;">
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                This e-mail has been sent to <a href="mailto:'.$email.'">'.$email.'</a>, <a href="http://0sv8u.mjt.lu/unsub2?hl=en&m=AbIAAE5sGHgAAAAAAAAAAAQkQfoAAAAAAsAAAAAAABov_wBisujYOqeIipZOTDemOxlm7LwnOQAZRqU&b=37b147ea&e=f3b13a9a&x=3_2BFclUhira4HaBA1jDOTratJdT62Vn4P4EcIvYOAA">click here to unsubscribe</a>.
            </p>
            
        </div>
    </div>
</body>';
    
    if( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    elseif( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    elseif( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    elseif( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    else{
        return false;
    }


}

// back end membership mail

function asf_send_ltm_mail_backend( $email, $membership_id, $user_name, $user_type, $membership_amount ){  

//echo $email.'/'.$membership_id.'/'.$user_name;die;  
    $to         = $email;
    $subject    = 'Welcome '.$user_name.', you are now a lifetime member of '. get_bloginfo().'! Here is what to do next.';
    // $body = 'The email body content';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: Dr. Sanjith from ISPEN <no-reply@docmode.com>';
    //$headers[] = 'Cc: asif@docmode.com';
    //$headers[] = 'Cc: Richa <richa@docmode.com>';
    //$headers[] = 'Cc: hemant <hemant@docmode.com>';
    $body ='<body style="margin: 0;padding: 0;font-family: sans-serif;color: #000;font-size: 15px;">
    <div style="max-width: 50%;margin: 2rem auto;">
    <center><img style="border: 1px solid #EBEBEB;" height="100px" width="150px" src="https://ispen.org.in/wp-content/uploads/2022/04/logo3.jpg"></center>
        <div style="padding: 1.3rem 0.8rem;border-top: 1px solid #000;border-bottom: 1px solid #000;">
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                Congratulations, you just joined an exclusive network of over 1,000 professionals in the industry.
            </p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                <span style="color: #ff0000;font-weight: 700;">ISPEN</span> was formed and registered as a Society in 1994 at Chennai and is the additional link to the already existing chain consisting of American Society for Parenteral and Enteral Nutrition [ASPEN], European [ESPEN], Australian [AusPEN], Parenteral and Enteral Society of Asia [PENSA], and South African [SASPEN] societies. Members of ISPEN automatically become members of PENSA.
            </p>
            
            <p style="line-height: 1.5;margin-top: 0;">
                Email ID : <a href="mailto:'.$email.'">'.$email.'</a>
            </p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">Also, for your reference your Membership id is <strong>'.$membership_id.'<strong></p>

            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                <span style="color:red"><strong>Your Payment information are given below.</strong></span>
                <table border="1px" width="100%">
                <thead>
                <tr>
                <th>Name</th>
                <th>User type</th>
                <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>'.$user_name.'</td>
                <td>'.$user_type.'</td>
                <td>'.$membership_amount.'</td>
                </tr>
                
                </tbody>
                </table><br>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
            
            <br>
                As a member, here are some of the <span style="font-weight: 700;">benefits</span> you receive:
                <ul style="line-height: 1.7;">
                    <li>Access to the ISPEN journal</li>
                    <li>Access to ISPEN Newsletter and information/updates on online events</li>
                    <li>Discount on registration fees for national and other conferences of the ISPEN</li>
                    <li>Automatically become a member of your ISPEN local branch and get invited to all branch meetings and regular updates</li>
                    <li>A chance to get your Hospital recognized to conduct ISPEN endorsed and accredited courses if they meet the criteria</li>
                    <li>Ability to register your Hospital/ICU with ISPEN and participate in ISPEN research projects</li>
                    <li>Discounts on nutrition related books and more</li>
                    <li>
                        Access to ISPEN Interdisciplinary Partners programs (e.g. – ISPEN and ISCCM for Critical Care Nutrition, ISPEN and FOGSI for Women’s Nutrition etc.)
                    </li>
                    <li>Connect with programs with International Partners of ISPEN such as ASPEN, ESPEN and PENSA</li>
                    <li>Access to our resources page where we have put up tons of study materials and research papers and more coming your way</li>
                </ul>
            </p>
            
            <div style="text-align: center;margin: 1rem 0;">
                <a href="https://ispen.org.in/" style="background: #ff0000; text-decoration: none; color: #fff !important;padding: 0.7rem 1.2rem;border: none;font-size: 18px;font-weight: 600;border-radius: 5px;">Visit ISPEN</a>
            </div>
            
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Best Regards,</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Dr. Sanjith Saseedharan- President, ISPEN</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Dr.Ravinder B. Reddy- Immediate Past president, ISPEN</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Dr. Radha Reddy Chada- General Secretary, ISPEN</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Ms. Bamini M- Treasurer, ISPEN</p>
            
        </div>
        <div style="text-align: center;padding: 1rem 0 0;font-size: 0.8rem;color: #666;font-weight: 600;">
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                This e-mail has been sent to <a href="mailto:'.$email.'">'.$email.'</a>, <a href="http://0sv8u.mjt.lu/unsub2?hl=en&m=AbIAAE5sGHgAAAAAAAAAAAQkQfoAAAAAAsAAAAAAABov_wBisujYOqeIipZOTDemOxlm7LwnOQAZRqU&b=37b147ea&e=f3b13a9a&x=3_2BFclUhira4HaBA1jDOTratJdT62Vn4P4EcIvYOAA">click here to unsubscribe</a>.
            </p>
            
        </div>
    </div>
</body>';
    
    if( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    elseif( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    elseif( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    elseif( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    else{
        return false;
    }


}


// approved mail for payment

function asf_send_ltm_mail_approved( $email, $user_name, $utype, $amount ){    
    $to         = $email;
    $subject    = 'Hi '.$user_name.', your lifetime member of '. get_bloginfo().' has been approved! Here is what to do next.';
    // $body = 'The email body content';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: Dr. Subhal Dixit from ISPEN <no-reply@docmode.com>';
    //$headers[] = 'Cc: asif@docmode.com';
    //$headers[] = 'Cc: Richa <richa@docmode.com>';
    //$headers[] = 'Cc: hemant <hemant@docmode.com>';
    $headers[] = 'Cc: Executive <executive@ispen.org.in>';
    //$headers[] = 'Cc: Vinayak <vinayak@docmode.com>';
    //$headers[] = 'Cc: Sudheerlakk <sudheerlakk@gmail.com>';
    $body ='<body style="margin: 0;padding: 0;font-family: sans-serif;color: #000;font-size: 15px;">
    <div style="max-width: 50%;margin: 2rem auto;">
    <center><img style="border: 1px solid #EBEBEB;" height="100px" width="150px" src="https://ispen.org.in/wp-content/uploads/2022/04/logo3.jpg"></center>
        <div style="padding: 1.3rem 0.8rem;border-top: 1px solid #000;border-bottom: 1px solid #000;">
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                Congratulations, you just joined an exclusive network of over 1,000 professionals in the industry.
            </p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                <span style="color: #ff0000;font-weight: 700;">ISPEN</span> was formed and registered as a Society in 1994 at Chennai and is the additional link to the already existing chain consisting of American Society for Parenteral and Enteral Nutrition [ASPEN], European [ESPEN], Australian [AusPEN], Parenteral and Enteral Society of Asia [PENSA], and South African [SASPEN] societies. Members of ISPEN automatically become members of PENSA.
            </p>
            
            <p style="line-height: 1.5;margin-top: 0;">
                Email ID : <a href="mailto:'.$email.'">'.$email.'</a>
            </p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem; color: red; font-weight: bold;">Congratulation! Your Life membership has been approved. Please make the payment to become a life member.</p>
                <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                <span style="color:red"><strong>Your Payment information are given below.</strong></span>
                <table border="1px" width="100%">
                <thead>
                <tr>
                <th>Name</th>
                <th>User type</th>
                <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>'.$user_name.'</td>
                <td>'.$utype.'</td>
                <td>'.$amount.'</td>
                </tr>
                
                </tbody>
                </table><br>
            
                <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem; color: black; font-weight: bold;">To make the payment please <a href="'.home_url().'/membership-live/">click the link</a> </p>

            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                As a member, here are some of the <span style="font-weight: 700;">benefits</span> you receive:
                <ul style="line-height: 1.7;">
                    <li>Access to the ISPEN journal</li>
                    <li>Access to ISPEN Newsletter and information/updates on online events</li>
                    <li>Discount on registration fees for national and other conferences of the ISPEN</li>
                    <li>Automatically become a member of your ISPEN local branch and get invited to all branch meetings and regular updates</li>
                    <li>A chance to get your Hospital recognized to conduct ISPEN endorsed and accredited courses if they meet the criteria</li>
                    <li>Ability to register your Hospital/ICU with ISPEN and participate in ISPEN research projects</li>
                    <li>Discounts on nutrition related books and more</li>
                    <li>
                        Access to ISPEN Interdisciplinary Partners programs (e.g. – ISPEN and ISCCM for Critical Care Nutrition, ISPEN and FOGSI for Women’s Nutrition etc.)
                    </li>
                    <li>Connect with programs with International Partners of ISPEN such as ASPEN, ESPEN and PENSA</li>
                    <li>Access to our resources page where we have put up tons of study materials and research papers and more coming your way</li>
                </ul>
            </p>
            
            <div style="text-align: center;margin: 1rem 0;">
                <a href="https://ispen.org.in/" style="background: #ff0000; text-decoration: none; color: #fff !important;padding: 0.7rem 1.2rem;border: none;font-size: 18px;font-weight: 600;border-radius: 5px;">Visit ISPEN</a>
            </div>
            
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Best Regards,</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Dr. Subhal Dixit- President</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Dr. Radha Reddy Chada- President Elect</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Dr. Sanjith Saseedharan- Immediate Past President</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Dr. Daphnee Lovesley- Secretary</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Dr. Raymond Savio- Treasurer</p>
            
            <p style="line-height: 1.5;margin-top: 0;">
                Kindly send a receipt / screenshot of your payment to <a href="mailto:executive@ispen.org.in">executive@ispen.org.in</a> for confirmation of Lifetime Membership
            </p>
        </div>
        <div style="text-align: center;padding: 1rem 0 0;font-size: 0.8rem;color: #666;font-weight: 600;">
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                This e-mail has been sent to <a href="mailto:'.$email.'">'.$email.'</a>, <a href="http://0sv8u.mjt.lu/unsub2?hl=en&m=AbIAAE5sGHgAAAAAAAAAAAQkQfoAAAAAAsAAAAAAABov_wBisujYOqeIipZOTDemOxlm7LwnOQAZRqU&b=37b147ea&e=f3b13a9a&x=3_2BFclUhira4HaBA1jDOTratJdT62Vn4P4EcIvYOAA">click here to unsubscribe</a>.
            </p>
            
        </div>
    </div>
</body>';
    
    if( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    elseif( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    elseif( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    elseif( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    else{
        return false;
    }


}


// disapproved mail for payment

function asf_send_ltm_mail_disapproved( $email, $user_name ){    
    $to         = $email;
    $subject    = 'Hi '.$user_name.', your lifetime member of '. get_bloginfo().' has been disapproved!';
    // $body = 'The email body content';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: Dr. Sanjith from ISPEN <no-reply@docmode.com>';
    //$headers[] = 'Cc: asif@docmode.com';
    //$headers[] = 'Cc: Richa <richa@docmode.com>';
    //$headers[] = 'Cc: hemant <hemant@docmode.com>';
    $body ='<body style="margin: 0;padding: 0;font-family: sans-serif;color: #000;font-size: 15px;">
    <div style="max-width: 50%;margin: 2rem auto;">
    <center><img style="border: 1px solid #EBEBEB;" height="100px" width="150px" src="https://ispen.org.in/wp-content/uploads/2022/04/logo3.jpg"></center>
        <div style="padding: 1.3rem 0.8rem;border-top: 1px solid #000;border-bottom: 1px solid #000;">
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                Congratulations, you just joined an exclusive network of over 1,000 professionals in the industry.
            </p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                <span style="color: #ff0000;font-weight: 700;">ISPEN</span> was formed and registered as a Society in 1994 at Chennai and is the additional link to the already existing chain consisting of American Society for Parenteral and Enteral Nutrition [ASPEN], European [ESPEN], Australian [AusPEN], Parenteral and Enteral Society of Asia [PENSA], and South African [SASPEN] societies. Members of ISPEN automatically become members of PENSA.
            </p>
            
            <p style="line-height: 1.5;margin-top: 0;">
                Email ID : <a href="mailto:'.$email.'">'.$email.'</a>
            </p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem; color: red; font-weight: bold;">Your Life membership has been disapproved due to invalid certificate.</p>
                

            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                As a member, here are some of the <span style="font-weight: 700;">benefits</span> you receive:
                <ul style="line-height: 1.7;">
                    <li>Access to the ISPEN journal</li>
                    <li>Access to ISPEN Newsletter and information/updates on online events</li>
                    <li>Discount on registration fees for national and other conferences of the ISPEN</li>
                    <li>Automatically become a member of your ISPEN local branch and get invited to all branch meetings and regular updates</li>
                    <li>A chance to get your Hospital recognized to conduct ISPEN endorsed and accredited courses if they meet the criteria</li>
                    <li>Ability to register your Hospital/ICU with ISPEN and participate in ISPEN research projects</li>
                    <li>Discounts on nutrition related books and more</li>
                    <li>
                        Access to ISPEN Interdisciplinary Partners programs (e.g. – ISPEN and ISCCM for Critical Care Nutrition, ISPEN and FOGSI for Women’s Nutrition etc.)
                    </li>
                    <li>Connect with programs with International Partners of ISPEN such as ASPEN, ESPEN and PENSA</li>
                    <li>Access to our resources page where we have put up tons of study materials and research papers and more coming your way</li>
                </ul>
            </p>
            
            <div style="text-align: center;margin: 1rem 0;">
                <a href="https://ispen.org.in/" style="background: #ff0000; text-decoration: none; color: #fff !important;padding: 0.7rem 1.2rem;border: none;font-size: 18px;font-weight: 600;border-radius: 5px;">Visit ISPEN</a>
            </div>
            
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Best Regards,</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Dr. Sanjith Saseedharan- President, ISPEN</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Dr.Ravinder B. Reddy- Immediate Past president, ISPEN</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Dr. Radha Reddy Chada- General Secretary, ISPEN</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Ms. Bamini M- Treasurer, ISPEN</p>
            
            
        </div>
        <div style="text-align: center;padding: 1rem 0 0;font-size: 0.8rem;color: #666;font-weight: 600;">
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                This e-mail has been sent to <a href="mailto:'.$email.'">'.$email.'</a>, <a href="http://0sv8u.mjt.lu/unsub2?hl=en&m=AbIAAE5sGHgAAAAAAAAAAAQkQfoAAAAAAsAAAAAAABov_wBisujYOqeIipZOTDemOxlm7LwnOQAZRqU&b=37b147ea&e=f3b13a9a&x=3_2BFclUhira4HaBA1jDOTratJdT62Vn4P4EcIvYOAA">click here to unsubscribe</a>.
            </p>
            
        </div>
    </div>
</body>';
    
    if( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    elseif( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    elseif( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    elseif( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    else{
        return false;
    }


}

/* time track */

add_action( 'wp_ajax_my_action_time', 'asf_my_action_time' );
add_action( 'wp_ajax_nopriv_my_action_time', 'asf_my_action_time' );

function asf_my_action_time() {
    date_default_timezone_set("Asia/Calcutta");
    global $current_user;
    $city = get_user_meta( $current_user->ID, 'city' , true );
    $state = get_user_meta( $current_user->ID, 'state' , true );
    $country = get_user_meta( $current_user->ID, 'country' , true );

    $duration = $_POST['duration'];
    $current_user = $_POST['current_user'];
    $current_user_email = $_POST['current_user_email'];
    $post_name = $_POST['post_name'];
    $user_ip = $_POST['user_ip'];
    $date = date('Y-m-d h:i A');

    echo $duration.'-'.$current_user.'-'.$date;
    //if($post_name != 'time-on-site'):
        global $wpdb;
        if (str_contains($post_name, 'resource-details') || $post_name == 'resources' || $post_name == 'resources-section'):
            $table = $wpdb->prefix.'user_acvt_resource';
        else:
            $table = $wpdb->prefix.'user_acvt_details';
        endif;
        $data = array('user_time' => $duration,'name' => $current_user,'email' => $current_user_email,'page' => $post_name,'user_ip' => $user_ip,'city' => $city,'state' => $state,'country' => $country,'added_on' => $date);
        $format = array('%s');
        $wpdb->insert($table,$data,$format);
        $my_id = $wpdb->insert_id;
         
    //endif; 
    die();  

}

add_shortcode('activity-download' , 'asf_activity_download');

function asf_activity_download() {
    //ob_start();
    ini_set('max_execution_time', 0);

        $header = array('Name','Email','Page','Time Spent In Secs','City','State','Country','Date');
        //$filename= "register-$fromdate-$todate.xls";
        //$filename= "activity-download.xls";
        global $wpdb;
            //$table_name = $wpdb->prefix . 'user_acvt_details';
            if ($_GET['download'] == 'user_resource_activity'):
                $filename= "resource-activity-download.csv";
                $table_name = $wpdb->prefix.'user_acvt_resource';
            else:
                $filename= "activity-download.csv";
                $table_name = $wpdb->prefix.'user_acvt_details';
            endif;
            $row = $wpdb->get_results("SELECT `name`,`email`,`page`,`user_time`,`city`,`state`,`country`,`added_on` FROM $table_name ORDER BY id DESC");
    
    // header('Content-Type: application/vnd.ms-excel;charset=utf-8');
    // header('Content-Disposition: attachment; filename='.$filename);

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename='.$filename);
        
    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');
    
    // output the column headings
    fputcsv($output, $header);
    
    // fetch the data
    // $stmt = $conn->prepare( $sql );
    // $stmt->execute();   
    // $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($row as $record):
            if(!empty($record->name)):
                $name = $record->name;
            else:
                $name = 'Unknown';
            endif;
            $table = array($name,$record->email,$record->page,$record->user_time/1000,$record->city,$record->state,$record->country,$record->added_on);
        
        
        fputcsv($output, $table);
    endforeach;
//die();
}


// Download report

add_shortcode('existing-users' , 'existing_user_download');


function existing_user_download() {
    //ob_start();
    ini_set('max_execution_time', 0);

        $header = array('Name','Email','Designation','Permanent address','User type','Phone Number','Email Id','Membership Id','Membership Proof','Academic background','Academic year','Academic background1','Academic year1','Academic background2','Academic year2','Professional category','Physician speciality','Other specify','Registration Date');
        //$filename= "register-$fromdate-$todate.xls";
        $filename= "existing-member-list.csv";
            $args = array(
            'role'    => 'subscriber',
            'meta_query' => array(
                    array(
                        'key' => 'user_type',
                        'value' => '',
                        'compare' => '!='
                    )
                ),
            'orderby' => 'ID',
            'order'   => 'DESC'
            );
            $users = get_users( $args );

            
    
    // header('Content-Type: application/vnd.ms-excel;charset=utf-8');
    // header('Content-Disposition: attachment; filename='.$filename);

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename='.$filename);
        
    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');
    
    // output the column headings
    fputcsv($output, $header);
    foreach($users as $user):

            if($user->country != '' && $user->country != 'India' && $user->user_type == 'physicians'):
                $utype = 'Physicians';
                $amount = '15,600';
            elseif($user->country == 'India' && $user->user_type == 'physicians'):
                $utype = 'Physicians';
                $amount = '3,000';
            elseif($user->country == '' && $user->user_type == 'physicians'):
                $utype = 'Physicians';
                $amount = '3,000';
            endif;

        //dietician

            if($user->country != '' && $user->country != 'India' && $user->user_type == 'dietician'):
                $utype = 'Dietician';
                $amount = '7,800';
            elseif($user->country == 'India' && $user->user_type == 'dietician'):
                $utype = 'Non Physicians';
                $amount = '3,000';
            elseif($user->country == '' && $user->user_type == 'dietician'):
                $utype = 'Dietician';
                $amount = '3,000';
            endif;

        //other user type

            if($user->country != '' && $user->country != 'India' && $user->user_type == 'othertype'):
                $utype = $user->otherutype;
                $amount = '7,800';
            elseif($user->country == 'India' && $user->user_type == 'othertype'):
                $utype = $user->otherutype;
                $amount = '3,000';
            elseif($user->country == '' && $user->user_type == 'othertype'):
                $utype = $user->otherutype;
                $amount = '3,000';
            endif;

        //industry

            if($user->user_type == 'industry'):
                $utype = 'Industry';
                $amount = '50,000';
            endif;

            if(!empty($user->membership_proof_photo)):
                $membership_proof_photo = get_stylesheet_directory_uri().'/includes/asif/uploads/'.$user->membership_proof_photo;
            else:
                $membership_proof_photo = '';
            endif;
        //if(empty($user->designation)):
            $table = array($user->first_name,$user->user_email,$user->designation,$user->permanent_address,$utype,$user->mobile_number,$user->email_id,$user->old_membership_id,$membership_proof_photo,$user->academic_background,$user->academic_year,$user->academic_background1,$user->academic_year1,$user->academic_background2,$user->academic_year2,$user->professional_category,$user->physician_speciality,$user->other_specify,$user->user_registered);
        //endif;
        
        
        fputcsv($output, $table);
    endforeach;
//die();
}


// Download LTM PAYMENT report

add_shortcode('ltm-payment-users' , 'ltm_payment_user_download');


function ltm_payment_user_download() {
    //ob_start();
    ini_set('max_execution_time', 0);

        //$header = array('Receipt Regenerate','Receipt','Name','Email','Designation','Permanent address','User type','Amount','Academic background','Academic year','Academic background1','Academic year1','Academic background2','Academic year2','Professional category','Physician speciality','Other specify','Registration Date','Membership Date','Receipt No','Membership Id','User Type','Country');
        $header = array('Name','Email','Designation','Permanent address','User type','Amount','Academic background','Academic year','Academic background1','Academic year1','Academic background2','Academic year2','Professional category','Physician speciality','Other specify','Registration Date','Membership Date','Receipt No','Membership Id','User Type','Country');
        //$filename= "register-$fromdate-$todate.xls";
        $filename= "ltm_payment_user-list.csv";
            $args = array(
            'role'    => 'um_permanent-member',
            // 'meta_query' => array(
            //         array(
            //             'key' => 'membership_amount',
            //             'value' => '',
            //             'compare' => '!='
            //             //'compare' => '='
            //         )
            //     ),
            'orderby' => 'ID',
            'order'   => 'DESC'
            );
            $users = get_users( $args );

            
    
    // header('Content-Type: application/vnd.ms-excel;charset=utf-8');
    // header('Content-Disposition: attachment; filename='.$filename);

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename='.$filename);
        
    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');
    
    // output the column headings
    fputcsv($output, $header);
    foreach($users as $user):
        $utype = '';
        $amount = '';
        //physicians
            $user_regDate = $user->user_registered;
            $user_regDate = date('d-m-Y', strtotime($user_regDate));
            $membership_id = $user->membership_id;
            $membership_sid1 = substr($membership_id, strpos($membership_id, "/") + 1);    
            $membership_sid_last = substr($membership_id, strrpos($membership_id, '/') + 1);
            $user_type = $user->user_type;
            $user_country = $user->country;
            $membership_amounts = $user->membership_amount;
            
            if(!empty($user_country) && $user_country != 'India' && !empty($user_type)){
                if($user_type == 'physicians')
                {
                    //$membership_amount = '15,600';
                    //$membership_amount_inword = 'Fifteen Thousand And Six Hundred Only';
                    $utype = $user_type;
                    if(!empty($membership_amounts)):
                        $amount = $membership_amounts;
                    else:
                        $amount = '15,600';
                    endif;
                }
                else
                {
                    //$membership_amount = '7,800';
                    //$membership_amount_inword = 'Seven Thousand And Eight Hundred Only';
                    $utype = $user_type;
                    if(!empty($membership_amounts)):
                        $amount = $membership_amounts;
                    else:
                        $amount = '7,800';
                    endif;
                }
            }


            elseif(!empty($user_type) && $user_type == 'physicians')
            {
                //$membership_amount = '3,000';
                //$membership_amount_inword = 'Three Thousand Only';
                //echo $membership_amount;die;
                $utype = $user_type;
                if(!empty($membership_amounts)):
                        $amount = $membership_amounts;
                else:
                    if(!empty($user->membership_reg_date) && ($user->membership_reg_date > '2023-11-09')):
                        $amount = '3000';
                    elseif(!empty($user_regDate) && ($user_regDate > '2023-11-09')):
                        $amount = '3000';
                    else:
                        $amount = '1500';
                    endif;
                endif;
            }
            elseif(!empty($user_type))
            {
                //$membership_amount = '1,500';
                //$membership_amount_inword = 'One Thousand And Five Hundred Only';
                $utype = $user_type;
                if(!empty($membership_amounts)):
                        $amount = $membership_amounts;
                    else:
                        if(!empty($user->membership_reg_date) && ($user->membership_reg_date > '2023-11-09')):
                            $amount = '3000';
                        elseif(!empty($user_regDate) && ($user_regDate > '2023-11-09')):
                            $amount = '3000';
                        else:
                            $amount = '1500';
                        endif;
                endif;
            }


            else
            {
                $membership_amount = '';
            }
            
            if(!empty($user->membership_reg_date)):
                $membership_reg_date = $user->membership_reg_date;
            else:
                $membership_reg_date = $user->user_registered;
            endif;

        //if(empty($user->designation)):
            //$table = array('https://ispen.org.in/account-setting/?email='.$user->user_email,'https://ispen.org.in/wp-content/uploads/membership-receipt/'.$user->ID.'.pdf',$user->first_name,$user->user_email,$user->designation,$user->permanent_address,$user_type,$amount,$user->academic_background,$user->academic_year,$user->academic_background1,$user->academic_year1,$user->academic_background2,$user->academic_year2,$user->professional_category,$user->physician_speciality,$user->other_specify,$membership_reg_date,$user->membership_reg_date,$membership_sid_last,$membership_id,$user->user_type,$user->country);
            $table = array($user->first_name,$user->user_email,$user->designation,$user->permanent_address,$user_type,$amount,$user->academic_background,$user->academic_year,$user->academic_background1,$user->academic_year1,$user->academic_background2,$user->academic_year2,$user->professional_category,$user->physician_speciality,$user->other_specify,$user->user_registered,$user->membership_reg_date,$membership_sid_last,$membership_id,$user->user_type,$user->country);
        //endif;
        
        
        fputcsv($output, $table);
    endforeach;
//die();
}

// remove menu

function remove_menus(){

    global $wp;
    $current_url="https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];


    
// get current login user's role
$roles = wp_get_current_user()->roles;
 
// test role
if( !in_array('um_client',$roles)){
return;
}
?>  
    <?php
    if($current_url == 'https://ispen.org.in/wp-admin/' || $current_url == 'https://ispen.org.in/wp-admin/index.php'):
    ?>
    <script>

    window.location.href = "https://ispen.org.in/wp-admin/users.php";

    </script>
    <?php
    endif;
    ?>
<?php if(2<1){ ?>
<style>
    #wpadminbar{
        display: none;
    }
    #um_bulk_action{
        display: none;
    }
    
    #um_bulkedit{
        display: none;
    }
</style>
<?php } ?>
<?php
//remove menu from site backend.
remove_menu_page( 'index.php' ); //Dashboard
remove_menu_page( 'edit.php' ); //Posts
remove_menu_page( 'upload.php' ); //Media
remove_menu_page( 'edit-comments.php' ); //Comments
remove_menu_page( 'themes.php' ); //Appearance
remove_menu_page( 'plugins.php' ); //Plugins
//remove_menu_page( 'users.php' ); //Users
remove_menu_page( 'tools.php' ); //Tools
remove_menu_page( 'options-general.php' ); //Settings
remove_menu_page( 'edit.php?post_type=page' ); //Pages
remove_menu_page( 'edit.php?post_type=resource' ); //Pages
remove_menu_page( 'wpcf7' ); //Pages
//remove_submenu_page( 'users.php', 'q-export-user-data' );
remove_submenu_page( 'users.php', 'profile.php' );
remove_menu_page( 'edit.php?post_type=officeviewer' ); //Pages
remove_menu_page( 'edit.php?post_type=elementor_library' ); //Pages
remove_menu_page('edit.php?post_type=testimonial'); // Custom post type 1
remove_menu_page('edit.php?post_type=homeslider'); // Custom post type 2
}
add_action( 'admin_menu', 'remove_menus' , 100 ); 

function remove_screen_options_tab() 
{
    return current_user_can('manage_options' );
}   
add_filter('screen_options_show_screen', 'remove_screen_options_tab');

add_filter('manage_users_columns','remove_users_columns');
function remove_users_columns($column_headers) {
    if (current_user_can('um_client')) {
      unset($column_headers['posts']);
      unset($column_headers['member_id']);
    }
 
    return $column_headers;
}

// Download User report

add_shortcode('user-report' , 'user_report_download');


function user_report_download() {
    //ob_start();
    ini_set('max_execution_time', 0);

        $header = array('Name','Email','Time Period','Certificate Uploaded','City','City2','State','State2','Country','Institution','Mobile No','Mobile No2','Designation','Permanent address','Address2','User type','Academic background','Academic year','Professional category','Physician speciality','Other specify','Registration Date','Membership Id','Approved/Disapproved');
        //$filename= "register-$fromdate-$todate.xls";
        $filename= "ispen-user-list.csv";
            $args = array(
            //'role'    => 'subscriber',
            // 'meta_query' => array(
            //         array(
            //             'key' => 'user_type',
            //             'value' => '',
            //             'compare' => '!='
            //         )
            //     ),
            'orderby' => 'ID',
            'order'   => 'DESC'
            );
            $users = get_users( $args );

            
    
    // header('Content-Type: application/vnd.ms-excel;charset=utf-8');
    // header('Content-Disposition: attachment; filename='.$filename);

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename='.$filename);
        
    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');
    
    // output the column headings
    fputcsv($output, $header);
    foreach($users as $user):
        //physicians

            // if($user->country != '' && $user->country != 'India' && $user->user_type == 'physicians'):
            //     $amount = '15,600';
            // elseif($user->country == 'India' && $user->user_type == 'physicians'):
            //     $amount = '3,000';
            // elseif($user->country == '' && $user->user_type == 'physicians'):
            //     $amount = '3,000';
            // endif;

        //dietician

            // if($user->country != '' && $user->country != 'India' && $user->user_type == 'dietician'):
            //     $amount = '7,800';
            // elseif($user->country == 'India' && $user->user_type == 'dietician'):
            //     $amount = '1,500';
            // elseif($user->country == '' && $user->user_type == 'dietician'):
            //     $amount = '1,500';
            // endif;

        //industry

            // if($user->user_type == 'industry'):
            //     $amount = '50,000';
            // endif;

        if($user->life_member_certificate != ''):
            $life_member_certificate = 'https://ispen.org.in/wp-content/themes/techkit/includes/asif/upload-certificate/'.$user->life_member_certificate;
        else:
            $life_member_certificate = '-';
        endif;

        //if(empty($user->designation)):
            $table = array($user->first_name,$user->user_email,$user->timeperiod,$life_member_certificate,$user->city,$user->billing_city,$user->state,$user->billing_state,$user->country,$user->institution_hospital,$user->mobile_number,$user->billing_phone,$user->designation,$user->permanent_address,$user->billing_address_1,$user->user_type,$user->academic_background,$user->academic_year,$user->professional_category,$user->physician_speciality,$user->other_specify,$user->user_registered,$user->membership_id,$user->approved_disapproved);
        //endif;
        
        
        fputcsv($output, $table);
    endforeach;
//die();
}

// password change email

add_filter( 'password_change_email', 'change_password_mail_message', 10, 3 );
function change_password_mail_message( 
  $pass_change_mail, 
  $user, 
  $userdata 
) {

    $current_user = wp_get_current_user();
    $support_mail = 'support@docmode.com';

    //$new_message_txt =  __( 'Your Text' ). "\r\n\r\n";
    $new_message_txt = 'Hi '.$current_user->user_firstname.",\r\n\r\n";

    $new_message_txt .= __( 'This notice confirms that your password was changed on ISPEN.'). "\r\n\r\n";

    $new_message_txt .= 'If you did not change your password, please contact the Site Administrator at 
    '.$support_mail."\r\n\r\n";

    $new_message_txt .= 'This email has been sent to '.$current_user->user_email."\r\n\r\n";

    $new_message_txt .=  __( 'Regards,' ). "\r\n\r\n";
    $new_message_txt .= __( 'All at ISPEN' ). "\r\n\r\n";
    $new_message_txt .= home_url()."\r\n\r\n";

  $pass_change_mail[ 'message' ] = $new_message_txt;
  return $pass_change_mail;
}

// generate receipt

function generate_receipt($email){
    //echo $email;die;
    // if(is_user_logged_in()):
    //     $user = wp_get_current_user();
    // else:
        $user = get_user_by( 'email', $email );
        //$user = get_user_by( 'email', 'vishnupriyar1604@gmail.com' );
    //endif;
        //print_r($user);die;
    $user_regDate = $user->user_registered;
    $user_regDate = date('d-m-Y', strtotime($user_regDate));
    if(!empty($user->first_name)):
        $user_name = $user->first_name;
    else:
        $user_name = $user->display_name;
    endif;
    $user_type = $user->user_type;
    $user_country = $user->country;
    //echo $user_type."-".$user_country;die;
    if(!empty($user_country) && $user_country != 'India' && !empty($user_type)){
        if($user_type == 'physicians')
        {
            $membership_amount = '15,600';
            $membership_amount_inword = 'Fifteen Thousand And Six Hundred Only';
        }
        else
        {
            $membership_amount = '7,800';
            $membership_amount_inword = 'Seven Thousand And Eight Hundred Only';
        }
    }

    
    elseif(!empty($user_type) && $user_type == 'physicians')
    {
        if(!empty($user->membership_reg_date) && ($user->membership_reg_date > '2023-11-09')):
            $membership_amount = '3,000';
            $membership_amount_inword = 'Three Thousand Only';
            //echo $membership_amount;die;
        elseif(!empty($user_regDate) && ($user_regDate > '2023-11-09')):
            $membership_amount = '3,000';
            $membership_amount_inword = 'Three Thousand Only';
            //echo $membership_amount;die;
        else:
            $membership_amount = '1,500';
            $membership_amount_inword = 'One Thousand Five Hundred Only';
        endif;
    }
    elseif(!empty($user_type))
    {
        
        if(!empty($user->membership_reg_date) && ($user->membership_reg_date > '2023-11-09')):
            $membership_amount = '3,000';
            $membership_amount_inword = 'Three Thousand Only';
            //echo $membership_amount;die;
        elseif(!empty($user_regDate) && ($user_regDate > '2023-11-09')):
            $membership_amount = '3,000';
            $membership_amount_inword = 'Three Thousand Only';
            //echo $membership_amount;die;
        else:

            $membership_amount = '1,500';
            $membership_amount_inword = 'One Thousand Five Hundred Only';
        endif;
    }
    

    else
    {
        $membership_amount = '';
    }

    // pdf generate
            //$rand_no = rand(1000,9999);
            //$user_id = get_current_user_id();
            $user_id = $user->ID;
            $regDate = $user->user_registered;
            $curDate = date('Y-m-d');
            $membership_id = $user->membership_id;
            $membership_reg_date = $user->membership_reg_date;

            $membership_sid1 = substr($membership_id, strpos($membership_id, "/") + 1);    
            $membership_sid_last = substr($membership_id, strrpos($membership_id, '/') + 1);    
            //echo $membership_amount."-".$membership_sid1."-".$membership_sid_last;die;
            $arr = explode("/", $membership_sid1, 2);
            $membership_sid2 = $arr[0];
            //echo $membership_sid2;
            //$regDate = date('F jS, Y', strtotime($regDate));
            $regDate = date('d-m-Y', strtotime($regDate));
            $curDate = date('d-m-Y', strtotime($curDate));
            if(!empty($membership_reg_date)):
                //echo $membership_reg_date."aaa";die;
                $membership_reg_date = $user->membership_reg_date;
            else:
                //echo $regDate."bbb";die;
                $membership_reg_date = $regDate;
            endif;
            include_once('/var/www/html/ispen/wp-content/themes/techkit/tcpdf/tcpdf.php');
            //include_once('/var/www/html/ispen/wp-content/themes/techkit/tcpdf/examples/tcpdf_include.php');
            //$fileName = $_SESSION['user_name']."-".$_SESSION['user_id'];
            $fileName = $user_id;
            $upload_dir = wp_upload_dir();
            //echo $upload_dir['basedir'].'/Nutrition-Boot-camp-Tickets.png';die;
            //$pdf=new FPDF();
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



            $pdf->AddPage();
            $pdf->setJPEGQuality(100);
            $pdf->Image($upload_dir['basedir'].'/ispen-receipt.jpg', '', '', 195, 170, 'JPG', '', '', true, 300, 'L', false, false, 0, false, false, false);


            $pdf->SetY(53);
            $pdf->SetFont('helvetica', 'B', 14);

            $pdf->writeHTMLCell(60, 0, '', '', $membership_sid_last, 0, 1, 0, true, 'C', true);

            $pdf->SetY(53);
            $pdf->SetFont('helvetica', 'B', 14);

            $pdf->writeHTMLCell(330, 0, '', '', $membership_reg_date, 0, 1, 0, true, 'C', true);

            $pdf->SetY(70);
            $pdf->SetFont('helvetica', 'B', 14);

            $pdf->writeHTMLCell(200, 0, '', '', $user_name, 0, 1, 0, true, 'C', true);

            $pdf->SetY(81);
            $pdf->SetFont('helvetica', 'B', 14);

            $pdf->writeHTMLCell(200, 0, '', '', $membership_amount_inword, 0, 1, 0, true, 'C', true);

            $pdf->SetY(92);
            $pdf->SetFont('helvetica', 'B', 14);

            $pdf->writeHTMLCell(200, 0, '', '', 'Online', 0, 1, 0, true, 'C', true);

            $pdf->SetY(90);
            $pdf->SetFont('helvetica', 'B', 14);

            $pdf->writeHTMLCell(325, 0, '', '', $membership_reg_date, 0, 1, 0, true, 'C', true);

            $pdf->SetY(100);
            $pdf->SetFont('helvetica', 'B', 14);

            $pdf->writeHTMLCell(150, 0, '', '', 'ISPEN Life Membership', 0, 1, 0, true, 'C', true);

            $pdf->SetY(120);
            $pdf->SetFont('helvetica', 'B', 14);

            $pdf->writeHTMLCell(62, 0, '', '', $membership_amount, 0, 1, 0, true, 'C', true);

            // $pdf->SetY(135);
            // $pdf->Image($upload_dir['basedir'].'/Signature-drsanjith.jpg', '', '', 50, 25, 'JPG', '', '', true, 300, 'R', false, false, 0, false, false, false);

            $pdf->lastPage();
            //$pdf->Output();
            $upload_dir = wp_upload_dir();
            //ob_clean();
            $pdf->Output($upload_dir['basedir']."/membership-receipt/".$fileName. ".pdf", 'F');

}

// last membership id

//add_shortcode('last-membership-id' , 'last_membership_id');

function last_membership_id() {
    
        $arr1 = array();
        $arr2 = array();
        global $wpdb;
            
                $table_name = 'wp_users';
            

            $args = array(
            //'role'    => 'administrator',
            'meta_query' => array(
                    array(
                        'key' => 'membership_id',
                        'value' => '',
                        'compare' => '!='
                    )
                ),
            'orderby' => 'ID'
            //'order'   => 'ASC'
            );
            $users = get_users( $args );

            //echo "<pre>";
            //print_r($users);

            foreach ($users as $val) {
                //echo $val->billing_city."<br>";

                $membership_id = $val->membership_id;

                if(strstr($membership_id, '/') && !strpos($membership_id, "o")){

                $sec1 = substr($membership_id, strrpos($membership_id, '/') + 1)."<br>";

                //echo date('Y');

                $arr1[] = $sec1;

                // sec2

                $membership_sid1 = substr($membership_id, strpos($membership_id, "/") + 1);    

                $sec2 = explode("/", $membership_sid1, 2);
                $arr2[] = $sec2[0];



                }
            }

            rsort($arr1);
            rsort($arr2);
            //print_r($arr1);
            //print_r($arr2);
            $s1 = $arr2[0]+1;
            $s2 = $arr1[0]+1;

            echo "Lm/".$s1."/".date('Y')."/".$s2;

            
}

// file upload code

function upload_image($filedata, $folder_name, $desire_name_to_file){

    //echo $filedata["name"];
    $response = array();


    $target_dir = dirname(__FILE__). $folder_name;
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo(basename($filedata["name"]),PATHINFO_EXTENSION));

    //create unique file name
    $temp = explode(".", $filedata["name"]);
    $newfilename = $desire_name_to_file . '.' . end($temp);
    $target_file = $target_dir . $newfilename;
    //echo $target_file;
    // Check if image file is a actual image or fake image
      $check = getimagesize($filedata["tmp_name"]);
      //echo $check;
      if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        //echo $target_file;
      } else {
        //echo "fail0";
        $response['status'] = 0;
        $response['imageCheck'] = 'File is not an image';
        //echo "File is not an image.";
        $uploadOk = 0;
      }

    // // Check if file already exists
    // if (file_exists($target_file)) {
    //   echo "Sorry, file already exists.";
    //   $uploadOk = 0;
    // }

    // Check file size
    if ($filedata["size"] > 10*1024*1024) {
      $response['status'] = 0;
      $response['imagesize_Err'] = "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"   && $imageFileType != "gif" ) {
      $response['status'] = 0;
      $response['imageformat_Err'] =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed." ;
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "fail1";
      $response['status'] = 0;
      $response['error'] =  "Sorry, your file was not uploaded." ;
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($filedata["tmp_name"], $target_file)) {
        //echo "success";
        $response['status'] = 1;
        $response['original_name'] = $filedata["name"];
        $response['modified_name'] = $newfilename;
        $response['path'] = $target_file;
        $response['message'] =  "The file ". htmlspecialchars( basename( $filedata["name"])). " has been uploaded." ;

      } else {
        //echo "fail";
        $response['status'] = 0;
        $response['message'] =  "Sorry, there was an error uploading your file." ;
        
      }
    }



    return $response;
}

// file upload

add_action( 'wp_ajax_file_upload', 'asf_file_upload' );
add_action( 'wp_ajax_nopriv_file_upload', 'asf_file_upload' );

function asf_file_upload() {
    $user = wp_get_current_user();
    $user_id = get_current_user_id();
    $name = $user->first_name;

    $nm = $user_id."-". $name . "+". time();

    $data = upload_image($_FILES['file'], '/uploads/',$nm);

    //print_r($data);
    if($data['status']==1){
       update_user_meta( $user_id, 'membership_proof_photo', $data['modified_name'] ); 
    }

 //print_r($_FILES);
 wp_die();   
}

// user auto login api into lms docmode

function asf_get_user_basic_data(){
    if (is_user_logged_in()){
        
        $current_user = wp_get_current_user();
        $email = $current_user->user_email;
        //$email = 'asif12@docmode.com';

        $apiUrl = 'https://learn.docmode.org/api/v1/user_basic_data/'. $email;
        // $response = wp_remote_get($apiUrl);
        // $responseBody = wp_remote_retrieve_body( $response );
        // $result = json_decode( $responseBody,true );
        // return $result;

        $arguments = array('method' => 'GET');

        $response = wp_remote_get($apiUrl, $arguments);


        $results = json_decode(wp_remote_retrieve_body( $response ));

        //$results1 = $results->programs;
        return $results;
    }      
}

// auto register with LMS api

function asf_ajax_register_request(){


    $endpoint = 'https://learn.docmode.org/api/v1/cme_world/user_registration/';
 
    $body = [
  "HTTP_KEY"=> $_POST['http_key'],
  "HTTP_SECRET"=> $_POST['http_secret'],
  "web"=>$_POST['web'],
  "user_type"=>$_POST['user_type'],
  "city"=>$_POST['city'],
  "country"=>$_POST['country'],
  "state"=>$_POST['state'],
  "course_id"=>$_POST['course_id'],
  "name"=>$_POST['name'],
  "emailid"=>$_POST['emailid'],
  "phone"=>$_POST['phone']
    ];

    $body = wp_json_encode( $body );
     
    $options = [
        'body'        => $body,
        'headers'     => [
            'Content-Type' => 'application/json',
        ],
    ];
     
    $response = wp_remote_post( $endpoint, $options );
    //sau($response);

    echo json_encode($response);

    die();
}
add_action( 'wp_ajax_nopriv_asf_ajax_register_request', 'asf_ajax_register_request' );
add_action( 'wp_ajax_asf_ajax_register_request', 'asf_ajax_register_request' );

/**
 * Custom validation and error message for the E-mail Address field while registering.
 */
add_action( 'um_custom_field_validation_user_email_details', 'asf_custom_validate_user_email_details', 999, 3 );
function asf_custom_validate_user_email_details( $key, $array, $args ) {
    if ( $key == 'user_email' && isset( $args['user_email'] ) ) {
        if ( isset( UM()->form()->errors['user_email'] ) ) {
            unset( UM()->form()->errors['user_email'] );
        }
        if ( empty( $args['user_email'] ) ) {
            UM()->form()->add_error( 'user_email', __( 'E-mail Address is required', 'ultimate-member' ) );
        } elseif ( ! is_email( $args['user_email'] ) ) {
            UM()->form()->add_error( 'user_email', __( 'The email you entered is invalid', 'ultimate-member' ) );
        } elseif ( email_exists( $args['user_email'] ) ) {
            UM()->form()->add_error( 'user_email', __( 'The email you entered is already registered', 'ultimate-member' ) );
        }
    }
}


/**
 * Custom validation and error message for the E-mail Address field while login.
 */
// add_action( 'um_custom_field_validation_username', 'asf_custom_validate_username', 999, 3 );
// function asf_custom_validate_username( $key, $array, $args ) {
//     if ( $key == 'username' && isset( $args['username'] ) ) {
//         if ( isset( UM()->form()->errors['username'] ) ) {
//             unset( UM()->form()->errors['username'] );
//         }
//         if ( empty( $args['username'] ) ) {
//             UM()->form()->add_error( 'username', __( 'E-mail Address is required', 'ultimate-member' ) );
//         } elseif ( ! is_email( $args['username'] ) ) {
//             UM()->form()->add_error( 'username', __( 'The email you entered is invalid', 'ultimate-member' ) );
//         } elseif ( email_exists( $args['username'] ) == false ) {
//             UM()->form()->add_error( 'username', __( 'The email you entered is not registered', 'ultimate-member' ) );
//         }
//     }
// }

// function um_custom_validate_user_email_login_details( $key, $array, $args ) {
//     //echo $args['user_email'];die;
//     //if ( email_exists( $args['username'] ) == false ) {
//         UM()->form()->add_error( $key, __( 'The email you entered is not registered', 'ultimate-member' ) );
//     //}
// }
// add_action( 'um_custom_field_validation_user_email_login_details', 'um_custom_validate_user_email_login_details', 10, 3 );

function asf_submit_form_errors_hook_login( $args ) {
    


    if ( isset( $args['username'] ) && email_exists( $args['username'] ) == false ) {
        UM()->form()->add_error( 'username', __( 'The email you entered is not registered', 'ultimate-member' ) );
    }

    
}
add_action( 'um_submit_form_errors_hook_login', 'asf_submit_form_errors_hook_login', 10 );



add_action( 'um_after_form', 'my_after_form', 10, 1 );
function my_after_form( $args ) {
    // global $wp;
    // $curr_url = home_url( $wp->request );
    $curr_url = $_SERVER['HTTP_REFERER'];

    if($curr_url == 'https://ispen.org.in/register/' || $curr_url == 'https://ispen.org.in/resources/'):
        echo "<input type='hidden' name='redirect_to' value='".$_SERVER['HTTP_REFERER']."'>";
    endif;
}

// Download Temporary PAYMENT report

add_shortcode('tmp-payment-users' , 'tmp_payment_user_download');


function tmp_payment_user_download() {
    //ob_start();
    ini_set('max_execution_time', 0);

        $header = array('Receipt','Name','Email','Designation','Permanent address','User type','Amount','Academic background','Academic year','Academic background1','Academic year1','Academic background2','Academic year2','Professional category','Physician speciality','Other specify','Registration Date');
        //$filename= "register-$fromdate-$todate.xls";
        $filename= "tmp_payment_user-list.csv";
            $args = array(
            'role'    => 'um_temporary-member',
            'meta_query' => array(
                    array(
                        'key' => 'user_type',
                        'value' => '',
                        'compare' => '!='
                    )
                ),
            'orderby' => 'ID',
            'order'   => 'DESC'
            );
            $users = get_users( $args );

            
    
    // header('Content-Type: application/vnd.ms-excel;charset=utf-8');
    // header('Content-Disposition: attachment; filename='.$filename);

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename='.$filename);
        
    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');
    
    // output the column headings
    fputcsv($output, $header);
    foreach($users as $user):
        //physicians

            if($user->country != '' && $user->country != 'India' && $user->user_type == 'physicians'):
                $utype = 'Physicians';
                $amount = '15,600';
            elseif($user->country == 'India' && $user->user_type == 'physicians'):
                $utype = 'Physicians';
                $amount = '3,000';
            elseif($user->country == '' && $user->user_type == 'physicians'):
                $utype = 'Physicians';
                $amount = '3,000';
            endif;

        //dietician

            if($user->country != '' && $user->country != 'India' && $user->user_type == 'dietician'):
                $utype = 'Dietician';
                $amount = '7,800';
            elseif($user->country == 'India' && $user->user_type == 'dietician'):
                $utype = 'Non Physicians';
                $amount = '3,000';
            elseif($user->country == '' && $user->user_type == 'dietician'):
                $utype = 'Dietician';
                $amount = '3,000';
            endif;

        //other user type

            if($user->country != '' && $user->country != 'India' && $user->user_type == 'othertype'):
                $utype = $user->otherutype;
                $amount = '7,800';
            elseif($user->country == 'India' && $user->user_type == 'othertype'):
                $utype = $user->otherutype;
                $amount = '3,000';
            elseif($user->country == '' && $user->user_type == 'othertype'):
                $utype = $user->otherutype;
                $amount = '3,000';
            endif;

        //industry

            if($user->user_type == 'industry'):
                $utype = 'Industry';
                $amount = '50,000';
            endif;

        //if(empty($user->designation)):
            $table = array('https://ispen.org.in/wp-content/uploads/membership-receipt/'.$user->ID.'.pdf',$user->first_name,$user->user_email,$user->designation,$user->permanent_address,$utype,$amount,$user->academic_background,$user->academic_year,$user->academic_background1,$user->academic_year1,$user->academic_background2,$user->academic_year2,$user->professional_category,$user->physician_speciality,$user->other_specify,$user->user_registered);
        //endif;
        
        
        fputcsv($output, $table);
    endforeach;
//die();
}

/* conference registration test */

add_action( 'wp_ajax_my_action_conference_register_test', 'asf_my_action_conference_register_test' );
add_action( 'wp_ajax_nopriv_my_action_conference_register_test', 'asf_my_action_conference_register_test' );

function asf_my_action_conference_register_test() {

    echo "<pre>";
    print_r($_POST);

    $name = $_POST['name'];
    $occupation = $_POST['occupation'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $institute = $_POST['institute'];
    $amount = $_POST['amount'];
    $package = $_POST['package'];
    $date = date('Y-m-d h:i');
    $sig1 = 'https://ispen.org.in/wp-content/uploads/radha-reddy-sig.png';
    $sig2 = 'https://ispen.org.in/wp-content/uploads/Dr._ravindra_Reddy_Sign.png';
    $sig3 = 'https://ispen.org.in/wp-content/uploads/Signature-drsanjith.jpg';

    //$mail_sent = asf_send_conf_reg_mail( $email, $name, 'Registration + Gala dinner', '4000', 21, '06/11/2023', $sig1, $sig2, $sig3);
    

}

/* conference registration */

add_action( 'wp_ajax_my_action_conference_register', 'asf_my_action_conference_register' );
add_action( 'wp_ajax_nopriv_my_action_conference_register', 'asf_my_action_conference_register' );

function asf_my_action_conference_register() {

    date_default_timezone_set("Asia/Calcutta");
    global $current_user;
    // $city = get_user_meta( $current_user->ID, 'city' , true );
    // $state = get_user_meta( $current_user->ID, 'state' , true );
    // $country = get_user_meta( $current_user->ID, 'country' , true );

    $name = $_POST['name'];
    $occupation = $_POST['occupation'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $institute = $_POST['institute'];
    $amount = $_POST['amount'];
    $package = $_POST['package'];
    $date = date('Y-m-d h:i');

    //if($post_name != 'time-on-site'):
        global $wpdb;
        
            $table = $wpdb->prefix.'conference_registration';
        
        $data = array('name' => $name,'occupation' => $occupation,'age' => $age,'email' => $email,'address' => $address,'institute' => $institute,'amount' => $amount,'package' => $package,'created_at' => $date);
        $format = array('%s');
        $wpdb->insert($table,$data,$format);
        $my_id = $wpdb->insert_id;
         
    //endif; 
    $upload_dir = wp_upload_dir();
    //$sig = $upload_dir['basedir'].'/Signature-drsanjith.jpg';
    $sig1 = 'https://ispen.org.in/wp-content/uploads/radha-reddy-sig.png';
    $sig2 = 'https://ispen.org.in/wp-content/uploads/Dr._ravindra_Reddy_Sign.png';
    $sig3 = 'https://ispen.org.in/wp-content/uploads/Signature-drsanjith.jpg';
    $mail_sent = asf_send_conf_reg_mail( $email, $name, $package, $amount, $my_id, $date, $sig1, $sig2, $sig3);
    die();  

}


// approved mail for payment

function asf_send_conf_reg_mail( $email, $name, $package, $amount, $my_id, $date, $sig1, $sig2, $sig3 ){    
    $to         = $email;
    $subject    = 'Hi '.$name.', Your registration for the conference is successfull!';
    // $body = 'The email body content';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: Dr. Sanjith from ISPEN <no-reply@docmode.com>';
    //$headers[] = 'Cc: asif@docmode.com';
    //$headers[] = 'Cc: Richa <richa@docmode.com>';
    //$headers[] = 'Cc: hemant <hemant@docmode.com>';
    $body ='<body style="margin: 0;padding: 0;font-family: sans-serif;color: #000;font-size: 15px;">
    <div style="max-width: 50%;margin: 2rem auto;">
    <center><img style="border: 1px solid #EBEBEB;" height="100px" width="150px" src="https://ispen.org.in/wp-content/uploads/2022/04/logo3.jpg"></center>
        <div style="padding: 1.3rem 0.8rem;border-top: 1px solid #000;border-bottom: 1px solid #000;">
            
            
            <p style="line-height: 1.5;margin-top: 0;">
                Email ID : <a href="mailto:'.$email.'">'.$email.'</a>
            </p>
            
                <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                <span style="color:red"><strong>Your Payment information are given below.</strong></span>
                <p style="color:red;">* The Nutrition Boot camp will be “First Come First Serve basis” and the user will be intimated shortly.</p>
                <table border="1px" width="100%">
                <thead>
                <tr>
                <th>Serial No</th>
                <th>Name</th>
                <th>Package</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Signature</th>
                <th>Signature</th>
                <th>Signature</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>'.$my_id.'</td>
                <td>'.$name.'</td>
                <td>'.$package.'</td>
                <td>'.$amount.'</td>
                <td>'.$date.'</td>
                <td><img src="'.$sig1.'" height="50px" width="50px"></td>
                <td><img src="'.$sig2.'" height="50px" width="50px"></td>
                <td><img src="'.$sig3.'" height="50px" width="50px"></td>
                </tr>
                
                </tbody>
                </table><br>
            
        </div>
    </div>
</body>';
    
    if( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    elseif( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    elseif( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    elseif( wp_mail( $to, $subject, $body, $headers ) ){
        return true;
    }
    else{
        return false;
    }


}

// Webhook billdesk

add_action('init', function() {
    if (isset($_GET['billdesk-webhook']) && !empty($_GET['billdesk-webhook'])) {
    //if (1==2) {

        //echo "1";die;
        $data = file_get_contents("php://input");
        $headers = getallheaders();
        $en_headers = json_encode($headers);
        $filename1 = date('y'.'m'.'d'.'H'.'i'.'s')."body.json";
        $filename2 = date('y'.'m'.'d'.'H'.'i'.'s')."header.json";
        //file_put_contents("/var/www/html/ispen/wp-content/themes/techkit/includes/asif/webhooks/$filename1", $data);
        //file_put_contents("/var/www/html/ispen/wp-content/themes/techkit/includes/asif/webhooks/$filename2", $en_headers);
        $data = json_decode($data);
        $transactionStatus = $data->status;
        $transactionOrderId = $data->txnResponse->orderid;
        $transactionMercId = $data->txnResponse->mercid;
        $transactionFailedStatus = $data->txnResponse->status;
        $terminal_state = $data->txnResponse->terminal_state;
        //print_r($data);
        if($transactionStatus == 200 && $terminal_state != 'N'){

            $transaction_response = $data->txnResponse->transaction_response;
            header("location:https://ispen.org.in/billdesk-webhook/?tr=".$transaction_response);

            
        }

        
    }
});

add_action('init', function() {
    //if (isset($_GET['billdesk-webhook']) && !empty($_GET['billdesk-webhook'])) {
    if (1==1) {

        $data = file_get_contents("php://input");
        $data = json_decode($data);
        $transactionStatus = $data->status;
        //$transaction_response = $data->txnResponse->transaction_response;
        $terminal_state = $data->txnResponse->terminal_state;
        //$trn = strpos($transaction_response,"401");
        if($transactionStatus == 200 && $terminal_state != 'N'){
            $transaction_response = $data->txnResponse->transaction_response;
            //echo $transaction_response;die;
            $date_timestamps = date_format(new \DateTime(), 'YmdHis');
            $traceid = uniqid();
            $curl = curl_init();

            curl_setopt_array($curl, array(
              //CURLOPT_URL => 'https://uat1.billdesk.com/u2/payments/ve1_2/transactions/get',
              CURLOPT_URL => 'https://api.billdesk.com/payments/ve1_2/transactions/get',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>$transaction_response,
              CURLOPT_HTTPHEADER => array(
                'content-type: application/jose',
                'accept: application/jose',
                'BD-Traceid:'.$traceid,
                'BD-Timestamp:'.$date_timestamps,
                'Cookie: ; TS01904531=018ba61b741c15c721aa05ec27618654277f224e2f4bed10f415b2e6016968dd7362440233ceed866c192ca164776468b06e45f3a9; TS01d1e959=018ba61b741fca09f345446c19861232fd21fe63f16581f2e1cfbb3245fd009febe0f6c5b82ebe3695aa691ba7a671a3d8b3594157'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            //echo $response;

            //require "/var/www/html/ispen/wp-content/themes/techkit/vendor/autoload.php";
            //require "../vendor/autoload.php";
            //include_once('/var/www/html/ispen/wp-content/themes/techkit/vendor/autoload.php');
            //use '\var\www\html\ispen\wp-content\themes\techkit\vendor\Firebase\JWT\JWT';
            // use Firebase\JWT\Key;

            // $key = 'f2MORKLk2vSNEM3moFFZ5lh9d2N6ZgDq';

            header("location:".home_url()."/retrieve-transaction/?tr=".$response."&traceid=".$traceid."&date_timestamps=".$date_timestamps);

            
        }

        
    }
});



    
