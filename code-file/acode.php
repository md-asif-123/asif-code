<?php

/*
resource post type custom
*/

function asf_custom_scripts()
{
    wp_enqueue_style('css-main-one',get_template_directory_uri().'/assets/css/acode.css');
    
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
    $columns['user_id'] = 'User ID';
    $columns['phone'] = 'Phone';
    $columns['city'] = 'City';
    return $columns;
}
add_filter('manage_users_columns', 'asf_modify_user_table');
//Adds Content To The Custom Added Column
function asf_users_custom_column_values($value, $column_name, $user_id) {
    $user = get_userdata( $user_id );
    if ( 'member_id' == $column_name ){
        $roles = get_user_meta( $user_id, 'wp_capabilities', true );
        if($roles['um_temporary-member'] == 1):
            //return 'TM00'.$user_id;
            return get_user_meta( $user_id, 'membership_id', true );
        elseif($roles['um_permanent-member'] == 1):
            //return 'LTM00'.$user_id;
            return get_user_meta( $user_id, 'membership_id', true );
        else:
            return '-';
        endif;
        //return print_r(get_user_meta( $user_id, 'wp_capabilities', true ));
        }
    if ( 'user_id' == $column_name )
        return $user_id;
    if ( 'phone' == $column_name )
        //return get_user_meta( $user_id, 'mobile_number', true );
        if(!empty(get_user_meta( $user_id, 'billing_phone', true ))):
            return get_user_meta( $user_id, 'billing_phone', true );
        elseif(get_user_meta( $user_id, 'mobile_number', true )):
            return get_user_meta( $user_id, 'mobile_number', true );
        endif;
    if ( 'city' == $column_name )
        return get_user_meta( $user_id, 'city', true );
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
if(in_array('um_permanent-member', $role)): 
?>

    <h3><?php _e("Permanent Membership", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="timeperiod"><?php _e("Time Period"); ?></label></th>
        <td>
            <!-- <input type="text" name="address" id="address" value="<?php //echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /> -->
            <select required name="timeperiod" id="timeperiod">
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
    //echo $_POST['timeperiod'].$user_id;die;
    if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
        return;
    }
    
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }

    if($_POST['role'] == 'um_permanent-member'):
        update_user_meta( $user_id, 'timeperiod', 'permanent' );
        //update_user_meta( $user_id, 'membership_id', 'LTM00'.$user_id );
    endif;
    if($_POST['role'] == 'um_temporary-member' && $_POST['timeperiod'] == 'permanent'):
        update_user_meta( $user_id, 'timeperiod', 'Time Period Required' );
    endif;
    if($_POST['role'] == 'um_temporary-member' && $_POST['timeperiod'] == '0'):
        update_user_meta( $user_id, 'timeperiod', 'Time Period Required' );
    elseif($_POST['role'] == 'um_temporary-member' && $_POST['timeperiod'] != 'permanent'):
        update_user_meta( $user_id, 'timeperiod', $_POST['timeperiod'] );
        //update_user_meta( $user_id, 'membership_id', 'TM00'.$user_id );
    elseif($_POST['role'] != 'um_temporary-member' && $_POST['role'] != 'um_permanent-member'):
        update_user_meta( $user_id, 'timeperiod', '0' );
    endif;
    //update_user_meta( $user_id, 'timeperiod', $_POST['timeperiod'] );
    update_user_meta( $user_id, 'mo_num', $_POST['mo_num'] );
    //update_user_meta( $user_id, 'city', $_POST['city'] );
    //update_user_meta( $user_id, 'postalcode', $_POST['postalcode'] );
}



/* membership reg */

add_action( 'wp_ajax_my_action_membership', 'asf_my_action_membership' );
add_action( 'wp_ajax_nopriv_my_action_membership', 'asf_my_action_membership' );

function asf_my_action_membership() {

    $user_id = get_current_user_id();
    $academic_background = $_POST['academic_background'];
    $academic_background1 = $_POST['academic_background1'];
    $academic_background2 = $_POST['academic_background2'];
    $academic_background3 = $_POST['academic_background3'];
    $academic_background4 = $_POST['academic_background4'];
    $academic_background5 = $_POST['academic_background5'];
    $user_email = $_POST['user_email'];
    $user_type = $_POST['user_type'];
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
    //echo $academic_background;

    wp_update_user( array( 'ID' => $user_id, 'role' => 'um_permanent-member' ) );
    update_user_meta( $user_id, 'academic_background', $academic_background );
    update_user_meta( $user_id, 'academic_background1', $academic_background1 );
    update_user_meta( $user_id, 'academic_background2', $academic_background2 );
    update_user_meta( $user_id, 'academic_background3', $academic_background3 );
    update_user_meta( $user_id, 'academic_background4', $academic_background4 );
    update_user_meta( $user_id, 'academic_background5', $academic_background5 );
    update_user_meta( $user_id, 'user_type', $user_type );
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
    update_user_meta( $user_id, 'membership_id', 'LTM00'.$user_id );
    update_user_meta( $user_id, 'timeperiod', 'permanent' );

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
    //echo $academic_background;

    wp_update_user( array( 'ID' => $user_id, 'role' => 'subscriber' ) );
    update_user_meta( $user_id, 'academic_background', $academic_background );
    update_user_meta( $user_id, 'academic_background1', $academic_background1 );
    update_user_meta( $user_id, 'academic_background2', $academic_background2 );
    update_user_meta( $user_id, 'academic_background3', $academic_background3 );
    update_user_meta( $user_id, 'academic_background4', $academic_background4 );
    update_user_meta( $user_id, 'academic_background5', $academic_background5 );
    update_user_meta( $user_id, 'user_type', $user_type );
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
    update_user_meta( $user_id, 'membership_id', 'LTM00'.$user_id );
    update_user_meta( $user_id, 'timeperiod', 'permanent' );



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

    
    //if ( isset( $args['user_email'] ) && $args['user_email'] == 'ss@gmail.com' ) {
    if (!preg_match($regex, $args['user_email'])) {
        UM()->form()->add_error( 'user_email', 'Please enter a valid email' );
    }
    elseif($json['status'] == 'invalid'){
        UM()->form()->add_error( 'user_email', 'This email is invalid' );
    }
}


function asf_send_ltm_mail( $email, $membership_id, $user_name ){    
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
            <p style="line-height: 1.5;margin-top: 0;margin-bottom:0.7rem;font-weight: 600;">
                You can now login at <span style="color: #ff0000;font-weight: 700;">ISPEN</span> using the below mentioned credentials:
            </p>
            <p style="line-height: 1.5;margin-top: 0;">
                Email ID : <a href="mailto:'.$email.'">'.$email.'</a> <br>
                Password : <span style="font-weight: 700;">Ispen@0123</span>
            </p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">Also, for your reference your Membership id is <strong>'.$membership_id.'<strong></p>
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
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                Also, here is the link to the archived videos of the recent 
                <a href="https://docmode.org/nutrition-boot-camp-2022/" style="color: #ff0000;font-weight: 800;font-size: 15px;">
                    Nutrition Bootcamp 2022 - 6th Edition
                </a>. 
                You can login to your DocMode account and watch the videos.
            </p>
            <div style="text-align: center;margin: 1rem 0;">
                <a href="https://ispen.org.in/" style="background: #ff0000; text-decoration: none; color: #fff !important;padding: 0.7rem 1.2rem;border: none;font-size: 18px;font-weight: 600;border-radius: 5px;">Visit ISPEN</a>
            </div>
            
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Best Regards,</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Dr. Sanjith Saseedharan</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">Head of Department - Critical Care, SL Raheja</p>
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.2rem;">ISPEN</p>
        </div>
        <div style="text-align: center;padding: 1rem 0 0;font-size: 0.8rem;color: #666;font-weight: 600;">
            <p style="line-height: 1.5;margin-top: 0;margin-bottom: 0.7rem;">
                This e-mail has been sent to <a href="mailto:'.$email.'">'.$email.'</a>, <a href="http://0sv8u.mjt.lu/unsub2?hl=en&m=AbIAAE5sGHgAAAAAAAAAAAQkQfoAAAAAAsAAAAAAABov_wBisujYOqeIipZOTDemOxlm7LwnOQAZRqU&b=37b147ea&e=f3b13a9a&x=3_2BFclUhira4HaBA1jDOTratJdT62Vn4P4EcIvYOAA">click here to unsubscribe</a>.
            </p>
            <p style="line-height: 1.5;margin-top: 0;">201/ Kalpataru Plaza, Chincholi Bunder Road, Opp Nadiyawala Colony 2, Malad (W) 400064 Mumbai IN</p>
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

        $header = array('Name','Email','Designation','Permanent address','User type','Academic background','Academic year','Academic background1','Academic year1','Academic background2','Academic year2','Professional category','Physician speciality','Other specify','Registration Date');
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
            // if(!empty($record->name)):
            //     $name = $record->name;
            // else:
            //     $name = 'Unknown';
            // endif;
        //if(empty($user->designation)):
            $table = array($user->first_name,$user->user_email,$user->designation,$user->permanent_address,$user->user_type,$user->academic_background,$user->academic_year,$user->academic_background1,$user->academic_year1,$user->academic_background2,$user->academic_year2,$user->professional_category,$user->physician_speciality,$user->other_specify,$user->user_registered);
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

        $header = array('Name','Email','Designation','Permanent address','User type','Amount','Academic background','Academic year','Academic background1','Academic year1','Academic background2','Academic year2','Professional category','Physician speciality','Other specify','Registration Date');
        //$filename= "register-$fromdate-$todate.xls";
        $filename= "ltm_payment_user-list.csv";
            $args = array(
            'role'    => 'um_permanent-member',
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
                $amount = '15,600';
            elseif($user->country == 'India' && $user->user_type == 'physicians'):
                $amount = '3,000';
            elseif($user->country == '' && $user->user_type == 'physicians'):
                $amount = '3,000';
            endif;

        //non-physicians

            if($user->country != '' && $user->country != 'India' && $user->user_type == 'non-physicians'):
                $amount = '7,800';
            elseif($user->country == 'India' && $user->user_type == 'non-physicians'):
                $amount = '1,500';
            elseif($user->country == '' && $user->user_type == 'non-physicians'):
                $amount = '1,500';
            endif;

        //industry

            if($user->user_type == 'industry'):
                $amount = '50,000';
            endif;

        //if(empty($user->designation)):
            $table = array($user->first_name,$user->user_email,$user->designation,$user->permanent_address,$user->user_type,$amount,$user->academic_background,$user->academic_year,$user->academic_background1,$user->academic_year1,$user->academic_background2,$user->academic_year2,$user->professional_category,$user->physician_speciality,$user->other_specify,$user->user_registered);
        //endif;
        
        
        fputcsv($output, $table);
    endforeach;
//die();
}