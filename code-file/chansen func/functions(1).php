<?php
//* Start the engine
include_once(get_template_directory() . '/lib/init.php');

//* Setup Theme
include_once(get_stylesheet_directory() . '/lib/theme-defaults.php');
if (file_exists(get_template_directory() . '/includes/i18n.php'))
    require_once(get_template_directory() . '/includes/i18n.php');

//* Set Localization (do not remove)
load_child_theme_textdomain('digital', apply_filters('child_theme_textdomain', get_stylesheet_directory() . '/languages', 'digital'));

//* Add Image upload and Color select to WordPress Theme Customizer
require_once(get_stylesheet_directory() . '/lib/customize.php');

//* Include Customizer CSS
include_once(get_stylesheet_directory() . '/lib/output.php');

//* Child theme (do not remove)
define('CHILD_THEME_NAME', 'Digital Pro');
define('CHILD_THEME_URL', 'http://my.studiopress.com/themes/digital/');

$theme_path = get_stylesheet_directory() . '/style.css';  // add 27/8/2019
$style_ver = filemtime($theme_path);                     // add 27/8/2019

define('CHILD_THEME_VERSION', $style_ver);               // add 27/8/2019 '1.0.4' instead of $style_ver

//$pathcss = get_stylesheet_directory() . '/digital-pro/style.css';


//* Enqueue scripts and styles
add_action('wp_enqueue_scripts', 'digital_scripts_styles');
function digital_scripts_styles()
{
    
    if(is_front_page()) {
        global $wp_styles;
        foreach ($wp_styles->queue as $key => $q) {
            if ($q == 'animate' || $q == 'wp-quiz') {
                unset($wp_styles->queue [$key]);
            }
        }
    }

    
    global $template;
    $template_file_name = basename($template);

    $template_file = get_post_meta( get_the_ID(), '_wp_page_template', TRUE );

    //echo 'template:'.$template_file;
    if( is_front_page() && ($template_file_name == 'front-page.php')){
        wp_enqueue_style('home-template-style', get_stylesheet_directory_uri() . '/css/home-template.css');
    }
    //for page
    if(( ($template_file == 'default') || ($template_file == '') ) && ($template_file_name == 'page.php')){
        wp_enqueue_style('default-template-style', get_stylesheet_directory_uri() . '/css/default-template.css');
    }

    if(($template_file == '') && (($template_file_name == 'page.php') || ($template_file_name == 'single.php'))){
    wp_enqueue_style('card-style', get_stylesheet_directory_uri() . '/css/card-style.css');
    }

    if(($template_file == 'casinoreview-page-template.php') || ($template_file_name == 'single-reviews.php')){
        wp_enqueue_style('casinoreview-template-style', get_stylesheet_directory_uri() . '/css/casinoreview-page-template.css');
    }  

    if($template_file == 'natcasinon-page-template.php'){
        wp_enqueue_style('natcasinon-template-style', get_stylesheet_directory_uri() . '/css/natcasinon-page-template.css');
    }   
    //for single posts
    if(($template_file == '') && ($template_file_name == 'single.php')){
        wp_enqueue_style('single-post-style', get_stylesheet_directory_uri() . '/css/single-post.css');
    }  

    if($template_file == 'news-template.php'){
        wp_enqueue_style('news-template-style', get_stylesheet_directory_uri() . '/css/news-template.css');
    }   
    
    if($template_file == 'notop-page-template.php'){
        wp_enqueue_style('notop-template-style', get_stylesheet_directory_uri() . '/css/notop-page-template.css');
    }  
    
    if($template_file == 'nyacasinon-page-template.php'){
        wp_enqueue_style('nyacasinon-template-style', get_stylesheet_directory_uri() . '/css/nyacasinon-page-template.css');
    } 
    
    if($template_file == 'sund-operator-template.php'){
        wp_enqueue_style('sund-operator-template-style', get_stylesheet_directory_uri() . '/css/sund-operator-template.css');
    } 

    if($template_file_name == '404.php'){
        wp_enqueue_style('404-template-style', get_stylesheet_directory_uri() . '/css/404-template.css');
    }      

    if($template_file_name == 'search.php'){
        wp_enqueue_style('search-template-style', get_stylesheet_directory_uri() . '/css/search-template.css');
    } 
    
    wp_enqueue_style('header-footer-style', get_stylesheet_directory_uri() . '/css/header-footer.css');
    /**********************/


    wp_enqueue_style('bootstrap4', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');

    wp_enqueue_style('slick-style', get_stylesheet_directory_uri() . '/css/slick.css');
    wp_enqueue_style('slick-theme-style', get_stylesheet_directory_uri() . '/css/slick-theme.css');
    //wp_enqueue_style('load-fa', get_stylesheet_directory_uri() . '/css/all.min.css');
    //wp_enqueue_style('custom-css', get_stylesheet_directory_uri() . '/css/custom.css');
    // wp_enqueue_style('font', 'https://use.typekit.net/shp0owx.css');
    // wp_enqueue_style('flags', 'https://uloga.github.io/worldflags/css/flags.css');
    wp_enqueue_script('digital-slick-script', get_stylesheet_directory_uri() . '/js/slick.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('digital-fadeup-script', get_stylesheet_directory_uri() . '/js/fadeup.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('digital-site-header', get_stylesheet_directory_uri() . '/js/site-header.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('digital-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true);
    $output = array(
        'mainMenu' => __('', 'digital'),
        'subMenu' => __('Menu', 'digital'),
        'favicon' => get_site_icon_url(),
		'ajax_url' =>admin_url('admin-ajax.php'),
    );
    wp_localize_script('digital-responsive-menu', 'DigitalL10n', $output);

}

//* Add HTML5 markup structure
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

//* Add accessibility support
add_theme_support('genesis-accessibility', array('404-page', 'drop-down-menu', 'rems', 'search-form'));

//* Add screen reader class to archive description
add_filter('genesis_attr_author-archive-description', 'genesis_attributes_screen_reader_class');

//* Add viewport meta tag for mobile browsers
add_theme_support('genesis-responsive-viewport');

//* Add support for custom header
add_theme_support('custom-header', array(
    'width' => 600,
    'height' => 140,
    'header-selector' => '.site-title a',
    'header-text' => false,
    'flex-height' => true,
));

//* Add support for after entry widget
add_theme_support('genesis-after-entry-widget-area');

//* Rename primary and secondary navigation menus
add_theme_support('genesis-menus', array('primary' => __('Header Menu', 'digital'), 'secondary' => __('Footer Menu', 'digital'), 'hph-menu' => __('HPH Menu', 'digital')));

//* Remove output of primary navigation right extras
remove_filter('genesis_nav_items', 'genesis_nav_right', 10, 2);
remove_filter('wp_nav_menu_items', 'genesis_nav_right', 10, 2);

//* Remove navigation meta box
add_action('genesis_theme_settings_metaboxes', 'digital_remove_genesis_metaboxes');
function digital_remove_genesis_metaboxes($_genesis_theme_settings_pagehook)
{

    remove_meta_box('genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main');

}

//* Remove header right widget area
unregister_sidebar('header-right');

//* Add image sizes
add_image_size('front-page-featured', 1000, 700, TRUE);

//* Reposition post image
remove_action('genesis_entry_content', 'genesis_do_post_image', 8);
add_action('genesis_entry_header', 'genesis_do_post_image', 4);

//* Reposition primary navigation menu
remove_action('genesis_after_header', 'genesis_do_nav');
add_action('genesis_header', 'genesis_do_nav', 12);

//* Reposition secondary navigation menu
remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_footer', 'genesis_do_subnav', 12);

//* Reduce secondary navigation menu to one level depth
add_filter('wp_nav_menu_args', 'digital_secondary_menu_args');
function digital_secondary_menu_args($args)
{

    if ('secondary' != $args['theme_location']) {
        return $args;
    }

    $args['depth'] = 1;

    return $args;

}

//* Remove skip link for primary navigation
add_filter('genesis_skip_links_output', 'digital_skip_links_output');
function digital_skip_links_output($links)
{

    if (isset($links['genesis-nav-primary'])) {
        unset($links['genesis-nav-primary']);
    }

    return $links;

}

//* Remove WP REST API from header
function remove_api()
{
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
}

add_action('after_setup_theme', 'remove_api');

//* Remove seondary sidebar
unregister_sidebar('sidebar-alt');

//* Remove site layouts
genesis_unregister_layout('content-sidebar-sidebar');
genesis_unregister_layout('sidebar-content-sidebar');
genesis_unregister_layout('sidebar-sidebar-content');

//* Reposition entry meta in entry header
remove_action('genesis_entry_header', 'genesis_post_info', 12);
add_action('genesis_entry_header', 'genesis_post_info', 8);

//* Customize entry meta in the entry header
add_filter('genesis_post_info', 'digital_entry_meta_header');
function digital_entry_meta_header($post_info)
{

    $post_info = '[post_date] [post_edit]';

    return $post_info;

}

//* Remove entry meta in the post footer
remove_action('genesis_entry_footer', 'genesis_post_meta');

//* Customize the content limit more markup
add_filter('get_the_content_limit', 'digital_content_limit_read_more_markup', 10, 3);
function digital_content_limit_read_more_markup($output, $content, $link)
{

    $output = sprintf('<p>%s &#x02026;</p><p class="more-link-wrap">%s</p>', $content, str_replace('&#x02026;', '', $link));

    return $output;

}

add_filter('genesis_attr_sidebar-primary', 'digital_attributes_sidebar_primary');
function digital_attributes_sidebar_primary($attributes)
{

    $attributes['class'] = 'sidebar sidebar-primary widget-area';
    $attributes['role'] = '';
    $attributes['aria-label'] = __('Primary Sidebar', 'genesis');
    $attributes['itemscope'] = true;
    $attributes['itemtype'] = 'http://schema.org/WPSideBar';

    return $attributes;

}

//* Customize author box title
add_filter('genesis_author_box_title', 'digital_author_box_title');
function digital_author_box_title()
{

    return '<span itemprop="name">' . get_the_author() . '</span>';

}

//* Modify size of the Gravatar in the author box
add_filter('genesis_author_box_gravatar_size', 'digital_author_box_gravatar');
function digital_author_box_gravatar($size)
{

    return 160;

}

//* Modify size of the Gravatar in the entry comments
add_filter('genesis_comment_list_args', 'digital_comments_gravatar');
function digital_comments_gravatar($args)
{

    $args['avatar_size'] = 60;

    return $args;

}

//* Remove entry meta in the entry footer on category pages
add_action('genesis_before_entry', 'digital_remove_entry_footer');
function digital_remove_entry_footer()
{

    if (is_front_page() || is_archive() || is_search() || is_page_template('page_blog.php')) {
        remove_action('genesis_entry_footer', 'genesis_entry_footer_markup_open', 5);
        remove_action('genesis_entry_footer', 'genesis_post_meta');
        remove_action('genesis_entry_footer', 'genesis_entry_footer_markup_close', 15);
    }

}

//* Setup widget counts
function digital_count_widgets($id)
{

    global $sidebars_widgets;

    if (isset($sidebars_widgets[$id])) {
        return count($sidebars_widgets[$id]);
    }

}

//* Flexible widget classes
function digital_widget_area_class($id)
{

    $count = digital_count_widgets($id);

    $class = '';

    if ($count == 1) {
        $class .= ' widget-full';
    } elseif ($count % 3 == 1) {
        $class .= ' widget-thirds';
    } elseif ($count % 4 == 1) {
        $class .= ' widget-fourths';
    } elseif ($count % 2 == 0) {
        $class .= ' widget-halves uneven';
    } else {
        $class .= ' widget-halves even';
    }

    return $class;

}

//* Flexible widget classes
function digital_halves_widget_area_class($id)
{

    $count = digital_count_widgets($id);

    $class = '';

    if ($count == 1) {
        $class .= ' widget-full';
    } elseif ($count % 2 == 0) {
        $class .= ' widget-halves';
    } else {
        $class .= ' widget-halves uneven';
    }

    return $class;

}

/* Add support for 3-column footer widget
add_theme_support('genesis-footer-widgets', 3);


//* Add support for 4-column footer widget
add_theme_support('genesis-footer-widgets', 4);

//* Add support for 5-column footer widget
add_theme_support('genesis-footer-widgets', 5);
*/

//* Register widget areas
genesis_register_sidebar(array(
    'id' => 'front-page-1',
    'name' => __('Front Page 1', 'digital'),
    'description' => __('This is the 1st section on the front page.', 'digital'),
));
genesis_register_sidebar(array(
    'id' => 'front-page-2',
    'name' => __('Front Page 2', 'digital'),
    'description' => __('This is the 2nd section on the front page.', 'digital'),
));
genesis_register_sidebar(array(
    'id' => 'front-page-3',
    'name' => __('Front Page 3', 'digital'),
    'description' => __('This is the 3rd section on the front page.', 'digital'),
));

//Add in Wrap Content Widget Areas

function genesischild_fullwrap_widgets()
{
    register_sidebar(array(
        'name' => __('TopWrap', 'genesis'),
        'id' => 'topwrap',
        'description' => __('TopWrap', 'genesis'),
        'before_widget' => '<div class="wrap topwrap">',
        'after_widget' => '</div>',
    ));
    register_sidebar(array(
        'name' => __('SvenskaWrap', 'genesis'),
        'id' => 'svenskawrap',
        'description' => __('SvenskaWrap', 'genesis'),
        'before_widget' => '<div class="wrap svenskawrap">',
        'after_widget' => '</div>',
    ));
    register_sidebar(array(
        'name' => __('NyaCasinonWrap', 'genesis'),
        'id' => 'nyacasinonwrap',
        'description' => __('NyaCasinonWrap', 'genesis'),
        'before_widget' => '<div class="wrap topwrap">',
        'after_widget' => '</div>',
    ));
    register_sidebar(array(
        'name' => __('NatCasinonWrap', 'genesis'),
        'id' => 'natcasinonwrap',
        'description' => __('NatCasinonWrap', 'genesis'),
        'before_widget' => '<div class="wrap topwrap">',
        'after_widget' => '</div>',
    ));
    register_sidebar(array(
        'name' => __('AftonbladetWrap', 'genesis'),
        'id' => 'aftonbladetwrap',
        'description' => __('AftonbladetWrap', 'genesis'),
        'before_widget' => '<div class="wrap topwrap">',
        'after_widget' => '</div>',
    ));
    register_sidebar(array(
        'name' => __('ExpressenWrap', 'genesis'),
        'id' => 'expressenwrap',
        'description' => __('ExpressenWrap', 'genesis'),
        'before_widget' => '<div class="wrap topwrap">',
        'after_widget' => '</div>',
    ));
    register_sidebar(array(
        'name' => __('OptinWrap', 'genesis'),
        'id' => 'optinwrap',
        'description' => __('OptinWrap', 'genesis'),
        'before_widget' => '<div class="wrap optinwrap">',
        'after_widget' => '</div>',

    ));
    register_sidebar(array(
        'name' => __('BottomWrap', 'genesis'),
        'id' => 'bottomwrap',
        'description' => __('BottomWrap', 'genesis'),
        'before_widget' => '<div class="wrap botwrap">',
        'after_widget' => '</div>',
    ));
    register_sidebar(array(
        'name' => __('News', 'genesis'),
        'id' => 'news-sidebar',
        'description' => __('news sidebar', 'genesis'),
//        'before_widget' => '<div class="bonus-card-content">',
//        'after_widget' => '</div>',
    ));

}

add_action('widgets_init', 'genesischild_fullwrap_widgets');


//* Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');

//* Add social icons in sidebar
genesis_register_sidebar(array(
    'id' => 'nav-social-menu',
    'name' => __('Nav Social Menu', 'your-theme-slug'),
    'description' => __('This is the nav social menu section.', 'your-theme-slug'),
));

add_filter('genesis_nav_items', 'sws_social_icons', 10, 2);
add_filter('wp_nav_menu_items', 'sws_social_icons', 10, 2);

function sws_social_icons($menu, $args)
{
    $args = (array)$args;
    if ('primary' !== $args['theme_location'])
        return $menu;
    ob_start();

    // wrap the menu in a list item, otherwise it throws a validation error
    echo '<li class="menu-item">';
    genesis_widget_area('nav-social-menu');
    echo '</li>';

    $social = ob_get_clean();
    return $menu . $social;
}

function footerhtml_widgets_init()
{
    register_sidebar(array(
        'name' => __('Footer HTML', 'footerhtml'),
        'id' => 'footerhtml',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ));
}

add_action('widgets_init', 'footerhtml_widgets_init');

//* Customize the entire footer
remove_action('genesis_footer', 'genesis_do_footer');
add_action('genesis_footer', 'sp_custom_footer');
function sp_custom_footer()
{
    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footerhtml')) :

    endif;
    ?>

    <?php
}

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');




add_action('template_redirect', 'numbers_permalink_redirect', 0);
function numbers_permalink_redirect()
{
    if (is_singular()) {
        global $post, $page;
        $num_pages = substr_count($post->post_content, '<!--nextpage-->') + 1;
        if ($page > $num_pages) {
            include(get_template_directory() . '/404.php');
            exit;
        }
    }
}

// Header Search Function
add_filter('genesis_header', 'genesis_header_icon', 10, 2);
function genesis_header_icon()
{
//    if ( wp_is_mobile()){ ?>
    <div class="search-box-mobile js-superfish" >
<!--        --><?php //} ?>
        <div class="header-icons">
            <form class="form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <i class="dashicons dashicons-search"></i>
                <input class="form-control search-form-input" type="search" itemprop="name" name="s" id="searchform-1" placeholder="Sök" aria-label="Search">
            </form>
        </div>
<!--    --><?php //if ( wp_is_mobile()){ ?>
    </div>
<?php }
//}

function yst_wpseo_change_og_locale($locale)
{
    return 'sv_SE';
}

add_filter('wpseo_locale', 'yst_wpseo_change_og_locale');


// FOOTER

function casinochansen_footer_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area 1', 'digital-pro' ),
        'id'            => 'footer-widget-area-1',
        'description'   => __( 'Appears in the footer section 1 of the site.', 'digital-pro' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area 2', 'digital-pro' ),
        'id'            => 'footer-widget-area-2',
        'description'   => __( 'Appears in the footer section 2 of the site.', 'digital-pro' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area 3', 'digital-pro' ),
        'id'            => 'footer-widget-area-3',
        'description'   => __( 'Appears in the footer section 3 of the site.', 'digital-pro' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area 4', 'digital-pro' ),
        'id'            => 'footer-widget-area-4',
        'description'   => __( 'Appears in the footer section 4 of the site.', 'digital-pro' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area 5', 'digital-pro' ),
        'id'            => 'footer-widget-area-5',
        'description'   => __( 'Appears in the footer section 5 of the site.', 'digital-pro' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Logos Widget Area', 'digital-pro' ),
        'id'            => 'footer-logos-widget-area',
        'description'   => __( 'Appears in the footer sites logos section of the site.', 'digital-pro' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
}
add_action('widgets_init','casinochansen_footer_widgets_init');

// ADD TAG & CATEGORY on PAGES
// add tag and category support to pages
function tags_categories_support_all() {
    register_taxonomy_for_object_type('post_tag', 'page');
    register_taxonomy_for_object_type('category', 'page');
}

// ensure all tags and categories are included in queries
function tags_categories_support_query($wp_query) {
    if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
    if ($wp_query->get('category_name')) $wp_query->set('post_type', 'any');
}

// tag and category hooks
add_action('init', 'tags_categories_support_all');
add_action('pre_get_posts', 'tags_categories_support_query');


//function get_main_menu( ) {
//    $menu = get_term_by('name', 'NewTopMenu', 'nav_menu');
//    $menu_items = wp_get_nav_menu_items($menu->term_id);
//    $parent_id = 0;
//    $end_list = 0;
//
//
//
//    foreach( $menu_items as $menu_item ) {
//        $menu_icon = get_field("icon_for_top_menu", $menu_item->ID);
//        $menu_list .= include("nav-menu-list.php");
//    }
//}


//function genesis_markup_nav_link_wrap_open($open, $args)
//{
//    if($args['context'] != 'nav-link-wrap') {
//        return $open;
//    }
////    print_r($open);
//    $custom = ++$counter;
//
//    return $open . $custom;
//
////    return $open . 'gabriel';
//}
//
//add_filter('genesis_markup_open', 'genesis_markup_nav_link_wrap_open',10, 2);



/*  CUSTOM POST TYPE  */
add_action('init', 'cc_post_types');
if(!function_exists('cc_post_types')){
    function cc_post_types(){
        //Reviews post types

	    $labels = array(
	        'name' => _x('Casino Reviews', 'Casino Reviews', 'ctl'),
	        'singular_name' => _x('Review', 'Reviews', 'ctl'),
	        'menu_name' => __('Reviews', 'ctl'),
	        'parent_item_colon' => __('Reviews', 'ctl'),
	        'all_items' => __('All Reviews', 'ctl'),
	        'view_item' => __('View Reviews', 'ctl'),
	        'add_new_item' => __('Add New Review', 'ctl'),
	        'add_new' => __('Add New', 'ctl'),
	        'edit_item' => __('Edit Review', 'ctl'),
	        'update_item' => __('Update Review', 'ctl'),
	        'search_items' => __('Search Review', 'ctl'),
	        'not_found' => __('Not Found', 'ctl'),
	        'not_found_in_trash' => __('Not found in Trash', 'ctl'),
	    );

	    $args = array(
	        'labels' => $labels,
	        'description' => __('Description.', 'ctl'),
	        'public' => true,
	        'publicly_queryable' => true,
	        'show_ui' => true,
	        'show_in_menu' => true,
	        'query_var' => true,
	        'rewrite' => array('slug' => 'casino-review'),
	        'capability_type' => 'post',
	        'has_archive' => true,
	        'hierarchical' => false,
	        'menu_position' => null,
	        'show_in_rest'=>true,
	        'menu_icon' => 'dashicons-edit',
	        'supports' => array('title', 'editor','thumbnail')
	    );

	    // Registering Games Post Type
	    register_post_type('reviews', $args);

	    unset($labels);
	    unset($args);
    }
}



if(!function_exists('cc_post_type_permalinks')){
    function cc_post_type_permalinks( $post_link, $post, $leavename ){
        if ( isset( $post->post_type ) && ('reviews' == $post->post_type ) ) {
            $post_type_data = get_post_type_object( $post->post_type );

            $slug=!empty($post_type_data->rewrite['slug'])
    ?$post_type_data->rewrite['slug']:$post->post_type;
            $post_link = str_replace( '/' . $slug . '/', '/', $post_link );

        }

        return $post_link;
    }

}
add_filter('post_type_link', 'cc_post_type_permalinks', 10, 3);

function cc_parse_request( $query ) {

    if (!$query->is_main_query()) {
            return;
        }
        if (!isset($query->query['page']) || 2 !== count($query->query)) {
            return;
        }
        if (empty($query->query['name'])) {
            return;
        }

       $query->set( 'post_type', array( 'reviews','post') );
}
add_action( 'pre_get_posts', 'cc_parse_request' );


//Add theme settings
if (function_exists('acf_add_options_page')) {

    $parent = acf_add_options_page(array(
        'page_title' => __('Theme General Settings', 'digital'),
        'menu_title' => __('Theme Settings', 'digital'),
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
    acf_add_options_page(array(
        'page_title' => __('Translation Settings', 'digital'),
        'menu_title' => __('Translation Settings', 'digital'),
        'menu_slug' => 'theme-translation-settings',
        'capability' => 'edit_posts',
        'parent_slug' => $parent['menu_slug'],
        'redirect' => false
    ));
}
//add_filter( 'upload_mimes', 'custom_myme_types');
function custom_myme_types( $mime_types ) {
$mime_types['jfif'] = 'image/jfif+xml'; // Adding .jfif extension

return $mime_types;
}

add_action('genesis_after_header','genesis_after_header_func');
function genesis_after_header_func(){
$partner_id = get_field('sticky_header_casino_id','option');
$generated_shortcode = "[cas-product-details pid='$partner_id' review='return']";
$p =json_decode(do_shortcode($generated_shortcode),true);
include(get_template_directory().'/includes/product-info.php');
    ?>
 <!--Sticky bonus Bar Start-->
    <div class="get-bonus-sticky-bar">
      <div class="wrap">
        <div class="get-bonus-card-top">
            <div class="casino-logo"><a href="<?php echo $go_link; ?>" class="cas-link" target="_blank" rel="nofollow"><img src="<?php echo $logo; ?>" alt="<?php echo $title; ?>"></a></div>
          <div class="bonus-text">
            <div class="rating-wrapper">
                <span class="casino-title"><a href="<?php echo home_url().$review_link; ?>"><?php echo $title; ?></a></span>
              <div class="rating-value"><?php echo $rating;?></div>
              <div class="rating-stars">
				<span class="starating">
					   <span class="shortcode-star-rating">
						   <?php
							for($x=1;$x<=$rating;$x++) {
							  ?>
							   <span class="dashicons dashicons-star-filled"></span>
							  <?php
							}
							if (strpos($rating,'.')) {
								  ?>
								<span class="dashicons dashicons-star-half"></span>
								  <?php
								  $x++;
							}
							while ($x<=5) {
							?>
								<span class="dashicons dashicons-star-empty"></span>
								  <?php
								  $x++;
							}
							?>
						   
					   </span>
				  </span>
                <?php /*$i=0; while($i<5): ?>
                          <?php if($i<$rating): ?>  
                          <img src="<?php echo get_template_directory_uri(); ?>/images/star-yellow.svg" alt="" width="11.88" height="11.2"/>
                          <?php else: ?>
                          <img src="<?php echo get_template_directory_uri(); ?>/images/star-gray.svg" alt="" width="11.88" height="11.2"/>
                         <?php endif; ?> 
                         <?php $i++ ;endwhile;*/ ?>
              </div>
            </div>
              <span><?php echo $bonus; ?></span>
			  <div class="sectionterms"><?php echo $bonus_tc;?></div>
              <p class="hide-lg"><a href="<?php echo $go_link; ?>" class="cas-link" target="_blank" rel="nofollow"><?php echo $bonus; ?></a></p>
          </div>
          <a href="<?php echo $go_link; ?>" class="btn-bonus  cas-link" target="_blank" rel="nofollow"><?php echo $cta_button_text; ?></a>
        </div>
      </div>
    </div>
    <!--Sticky bonus Bar End-->
<?php 

}

// article shema
add_action('wp_head', 'wpcg_get_article_schema');
function wpcg_get_article_schema(){
    if (get_post_type() === 'post') {
      global $post;
      //$id = $post->ID;

      //print_r($post);

      $schema=array();
      
      $schema['@context'] = "https://schema.org/";
        $schema['@type'] = "Article";
        $schema['headline'] = $post->post_title;
        $schema['description'] = get_the_excerpt($post->ID);
        if(has_post_thumbnail($post->ID))
           $image=get_the_post_thumbnail_url($post->ID);
        if(!empty($image))
            $schema['image']=$image;
        
        $schema['author']=array(
              '@type'=>'Person',
              "name"=> get_the_author($post->ID),
              "url"=> get_author_posts_url(get_the_author_meta($post->ID))
            );
        $logo_obj=get_field('logo','option');
        $schema['publisher']=array(
              '@type'=>'Organization',
              "name"=> get_option('blogname'),
              "logo"=> array(
                  '@type'=>'ImageObject',
                  "url"=> $logo_obj['url']
                )
            );
        $schema['datePublished'] = $post->post_date;
        $permalink=get_the_permalink($post->ID);
        $schema['url']=$permalink;
        $schema['mainEntityOfPage']=array(
            "@type"=> "WebPage",
            '@id'=>$permalink
        );
        $keyword=get_post_meta($post->ID,'_yoast_wpseo_focuskw',true);
        if(!empty($keyword))
            $schema['keywords']=$keyword;

        ?> 
        <script type="application/ld+json">
         <?php
          echo json_encode($schema);
         ?>
        </script>
        
        <?php
    }
}

// breadcrumbs shema
add_action('wp_head', 'wpcg_get_breadcrumbs_schema');
function wpcg_get_breadcrumbs_schema(){
    if(get_post_type() === 'post'){
      global $home_url,$post;

      $permalink=get_the_permalink($post->ID);

      $schema=array();
      
      $schema['@context'] = "https://schema.org/";
        $schema['@type'] = "BreadcrumbList";
        $schema['itemListElement']=array(array(
              '@type'=>'ListItem',
              "position"=> 1,
              "name"=> "home",
              "item"=> home_url()
            ),
        array(
              '@type'=>'ListItem',
              "position"=> 2,
              "name"=> $post->post_title,
              "item"=> $permalink
                )
            );
            
        ?> 
        <script type="application/ld+json">
         <?php
          echo json_encode($schema);
         ?>
        </script>
        
        <?php
    }
}

//add_action('wp_head', 'wpcg_get_website_schema');
function wpcg_get_website_schema(){
  

  $schema=array();
  
  $schema['@context'] = "https://schema.org/";
    $schema['@type'] = "WebSite";
    $schema['url'] = home_url();
    $schema['potentialAction']=array(
          '@type'=>'SearchAction',
          "target"=> "{search_term_string}",
              "query-input"=> "required name=search_term_string"
        );
    
    


    ?> 
    <script type="application/ld+json">
     <?php
      echo json_encode($schema);
     ?>
    </script>
    
    <?php
}

// add_action('genesis_meta','genesis_meta_func');

// function genesis_meta_func(){
//     echo '<link rel="icon" href="'.get_site_icon_url().'" >';
// }

// function myfavicon() {
//     echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_site_icon_url().'?v=1.0" />';
// }
// add_action('wp_head', 'myfavicon',99999);

function get_icon($icon=false)
{
    $icons=array(
        'loopcircle'=>"&#10227;",
        'giftcircle'=>"&#9814;",
        'checkmark'=>"&#10003;",
        'infocircle'=>"&#9432;",
        'cross'=>"&#10007;",
    );
    
    $return=false;

    if(!empty($icon) && array_key_exists($icon,$icons))
        $return=$icons[$icon];

    return $return;

}

/*Customize gutenberg table block*/
add_filter( 'render_block', 'wrap_my_image_block', 10, 2 );
function wrap_my_image_block( $block_content, $block ) {
    if ( 'core/table' !== $block['blockName'] ) {
        return $block_content;
    }
    $return  = '<section class="table-area">
  <div class="table-nav">
      <button class="previous">Previous</button>
      <button class="next">Next</button>
  </div>';
    $return .= $block_content;
    $return .= '</section>';

    return $return;
}

add_action('wp_footer','custom_footer_script');
function custom_footer_script()
{
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            //Table block scroll
            $(document).on('click', '.table-nav .next', function(e) {
                const tableWidth = $(".wp-custom-table").width();
                e.preventDefault();
                $(".wp-custom-table").animate(
                  {
                     scrollLeft: `+=${tableWidth}`
                  },
                  "slow"
                  );
            });

            $(document).on('click', '.table-nav .previous', function(e) {
               const tableWidth = $(".wp-custom-table").width();
               e.preventDefault();
                $(".wp-custom-table").animate(
                   {
                      scrollLeft: `-=${tableWidth}`
                   },
                   "slow"
                );
            });
        });
    </script>

    <?php
}
/*Customize gutenberg table block*/


/*
How To post type custom
*/

add_action('init', 'create_custom_post_type');
 
function create_custom_post_type() {
 
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
'name' => _x('How To', 'plural'),
'singular_name' => _x('How To', 'singular'),
'menu_name' => _x('How To', 'admin menu'),
'name_admin_bar' => _x('How To', 'admin bar'),
'add_new' => _x('Add How To', 'add new'),
'add_new_item' => __('Add New How To'),
'new_item' => __('New How To'),
'edit_item' => __('Edit How To'),
'view_item' => __('View How To'),
'all_items' => __('All How To'),
'search_items' => __('Search How To'),
'not_found' => __('No How To found.'),
);
 
$args = array(
'supports' => $supports,
'labels' => $labels,
'description' => 'Holds our how to and specific data',
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
'rewrite' => array('slug' => 'howto'),
'has_archive' => true,
'hierarchical' => false,
'menu_position' => 6,
'menu_icon' => 'dashicons-nametag',
);
 
register_post_type('howto', $args); // Register Post type
}

//custom column How To

function wp_custom_column($column)
{
    $column = array(
        'cb' => '<input type="checkbox"/>',
        'title' => 'HowTo Title',
        'scode' => 'Short Code',
        'author' => 'Author',
        'date' => 'Date',

    );

    return $column;
}

add_action('manage_howto_posts_columns','wp_custom_column');

// ACF How To shortcode here


add_shortcode( 'how-to-data', 'addHowToData' );

function addHowToData( $atts )
{ 
    $atts = shortcode_atts( array(
            'id' => '',
         ), 
         $atts );


   //global $wpdb;

   $title = get_post_meta($atts['id'], 'title', true);

   if( !empty( $atts['id'] ) && !empty($title) ){

    //$title = get_post_meta($atts['id'], 'title', true);
    $intro = get_post_meta($atts['id'], 'intro', true);

    $schema=array();

    $schema['@context'] = "https://schema.org/";
    $schema['@type'] = "HowTo";
    $schema['name'] = $title;
    $schema['description'] = $intro;
    $schema['step'] = array();

    $data = '<div class="bonus-banner-block">
                <div class="container">
                    <div class="bonus-banner-cont">
                        <h2>'.$title.'</h2>
                        <p>'.$intro.'</p>
                        <div class="rank-math-steps">';

    $repeater_value = get_post_meta($atts['id'], 'step', true);
    if ($repeater_value) {
        for ($i=0; $i<$repeater_value; $i++) {
            $meta_key1 = 'step_'.$i.'_step_image';
            $meta_key2 = 'step_'.$i.'_step_title';
            $meta_key3 = 'step_'.$i.'_step_intro';
            $meta_key4 = 'step_'.$i.'_step_url';
            $step_image = get_post_meta($atts['id'], $meta_key1, true);
            $step_title = get_post_meta($atts['id'], $meta_key2, true);
            $step_intro = get_post_meta($atts['id'], $meta_key3, true);
            $step_url = get_post_meta($atts['id'], $meta_key4, true);
            $image = wp_get_attachment_image_src($step_image, 'medium');

            $schema['step'][]=array(
                '@type'=>'HowToStep',
                "text"=> $step_intro,
                "image"=>$image[0],
                "name"=> $step_title,
                "url"=> $step_url
                
            );

                $data .=    '<div class="rank-math-step">
                                <a href="' . $step_url . '"><h3 class="rank-math-step-title ">'.$step_title.'</h3></a>
                                <div class="rank-math-step-content">
                                <a href="' . $step_url . '"><img src="' . $image[0] . '" alt=""></a>
                                <p>'.$step_intro.'</p>
                                </div>
                            </div>';
       
        }
    }

                $data .= '</div>
                        </div>
                    </div>
              </div>';

    $output['schema']=$schema;
    
    //return json_encode($output['schema']);
    //return $data;

    $html = '<script type="application/ld+json">'.json_encode($output['schema']).'</script>';

      $html .= $data;

      return $html;    
   }

   //else{
      //return false;
      return "";
   //}

}

// Column value in How To

add_action( 'manage_howto_posts_custom_column' , 'howto_custom_column_values', 10, 2 );

function howto_custom_column_values( $column, $post_id ) {
 
    switch ( $column ) {
 
        case 'scode':
            
            echo '[how-to-data id='."'".$post_id."']";
        break;

        
    }
}


//Remove redirection plugin menu for other than administrator
function remove_redirection_menu(){
  if ( is_plugin_active('redirection/redirection.php') ){
	global $current_user;
	if(!in_array('administrator',$current_user->roles)){
		remove_submenu_page( 'tools.php','redirection.php' ); 
	}
  }     
}
add_action( 'admin_menu', 'remove_redirection_menu',9999 );

// ACF Table of content

add_shortcode( 'table-of-content', 'tableOfContent' );

function tableOfContent( $atts )
{ 
    $atts = shortcode_atts( array(
            'id' => '',
         ), 
         $atts );
    global $post;
    $id = $post->ID;

if( !empty( $id )){
    $table_of_content = get_post_meta( $id, 'table_of_content', true );
    if ($table_of_content) {
        $data_name .= "<div class='content-wrap row'>
                        <div class='col-lg-4'>
                        <div class='sticky'>
                        <div class='side-panel-menu'>";
        for ($i=0; $i<$table_of_content; $i++) {
            $j = $i+1;
            $tab_name_data = 'table_of_content_'.$i.'_tab_name';
            //$tab_content_data = 'table_of_content_'.$i.'_tab_content';
            $tab_name = get_post_meta($id, $tab_name_data, true);
            $tab_content = get_post_meta($id, $tab_content_data, true);

            $data_name .= "<li><a href='#table-content-".$j."'>".$tab_name."</a></li>";
            //$data_content .= "<div id='table-content-".$j."'>".$tab_content."</div><br><br>";

          }
          $data_name .= "</div></div></div>";
          ?>
          <?php
            $data_content .= "<div class='col-lg-8'><div class='right-panel'>";
        
            for ($i=0; $i<$table_of_content; $i++) {
            $j = $i+1;
            $tab_content_data = 'table_of_content_'.$i.'_tab_content';
            $tab_content = apply_filters('the_content', get_post_meta($id, $tab_content_data, true));
            $data_content .= "<div class='sticky-content' id='table-content-".$j."'>".$tab_content."</div>";
            }
        
            $data_content .="</div></div></div>";

        

        }

        return $data_name.$data_content;
    }
    return "";
}
