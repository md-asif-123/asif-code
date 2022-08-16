<?php
/**
 * mycourse functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mycourse
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'mycourse_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mycourse_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on mycourse, use a find and replace
		 * to change 'mycourse' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'mycourse', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'mycourse' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'mycourse_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'mycourse_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mycourse_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mycourse_content_width', 640 );
}
add_action( 'after_setup_theme', 'mycourse_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mycourse_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'mycourse' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'mycourse' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'mycourse' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'mycourse' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'mycourse' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'mycourse' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'mycourse_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mycourse_scripts() {
	wp_enqueue_style( 'mycourse-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'mycourse-style', 'rtl', 'replace' );

	wp_enqueue_script( 'mycourse-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mycourse_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* classic editor
*/

function asif_function()
{
	return false;
}
add_filter('use_block_editor_for_post', 'asif_function');

function theme_one_scripts()
{
    wp_enqueue_style('main-one',get_template_directory_uri().'/css/bootstrap.css');
	wp_enqueue_style('main-one2',get_template_directory_uri().'/css/colors.css');
	wp_enqueue_style('main-one3',get_template_directory_uri().'/css/font-awesome.min.css');
	wp_enqueue_style('main-one4',get_template_directory_uri().'/css/responsive.css');
	wp_enqueue_style('main-one5',get_template_directory_uri().'/css/tech.css');
	wp_enqueue_style('main-one6',get_template_directory_uri().'/css/style.css');


    wp_enqueue_script('main-two',get_template_directory_uri().'/js/bootstrap.min.js', array('jquery') ,20161202 ,true);
	wp_enqueue_script('main-three',get_template_directory_uri().'/js/jquery.min.js', array('jquery') ,20161202 ,true);
	wp_enqueue_script('main-four',get_template_directory_uri().'/js/custom.js', array('jquery') ,20161202 ,true);
	wp_enqueue_script('main-five',get_template_directory_uri().'/js/tether.min.js', array('jquery') ,20161202 ,true);
	wp_enqueue_script('main-six',get_template_directory_uri().'/js/main.js', array('jquery') ,20161202 ,true);
	wp_localize_script('main-six', 'postdata', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
	));

}

add_action('wp_enqueue_scripts', 'theme_one_scripts');


/*
Course post type custom
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
'name' => _x('course', 'plural'),
'singular_name' => _x('course', 'singular'),
'menu_name' => _x('course', 'admin menu'),
'name_admin_bar' => _x('course', 'admin bar'),
'add_new' => _x('Add Course', 'add new'),
'add_new_item' => __('Add New course'),
'new_item' => __('New course'),
'edit_item' => __('Edit course'),
'view_item' => __('View course'),
'all_items' => __('All course'),
'search_items' => __('Search course'),
'not_found' => __('No course found.'),
);
 
$args = array(
'supports' => $supports,
'labels' => $labels,
'description' => 'Holds our course and specific data',
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
'rewrite' => array('slug' => 'course'),
'has_archive' => true,
'hierarchical' => false,
'menu_position' => 6,
'menu_icon' => 'dashicons-book',
);
 
register_post_type('course', $args); // Register Post type
}

/*
non hierarichal taxonomy topics
*/

function create_topics_tax() {

	$labels = array(
		'name'              => _x( 'Topics', 'taxonomy general name', 'mycourse' ),
		'singular_name'     => _x( 'Topic', 'taxonomy singular name', 'mycourse' ),
		'search_items'      => __( 'Search Topics', 'mycourse' ),
		'all_items'         => __( 'All Topics', 'mycourse' ),
		'parent_item'       => __( 'Parent Topics', 'mycourse' ),
		'parent_item_colon' => __( 'Parent Topics:', 'mycourse' ),
		'edit_item'         => __( 'Edit Topics', 'mycourse' ),
		'update_item'       => __( 'Update Topics', 'mycourse' ),
		'add_new_item'      => __( 'Add New Topics', 'mycourse' ),
		'new_item_name'     => __( 'New Topics Name', 'mycourse' ),
		'menu_name'         => __( 'Topics', 'mycourse' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( 'all topics', 'mycourse' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
	);
	register_taxonomy( 'topic', array('course'), $args );

}
add_action( 'init', 'create_topics_tax' );

/*
non hierarchical tags
*/
function create_level_tax() {

	$labels = array(
		'name'              => _x( 'Levels', 'taxonomy general name', 'mycourse' ),
		'singular_name'     => _x( 'Level', 'taxonomy singular name', 'mycourse' ),
		'search_items'      => __( 'Search Levels', 'mycourse' ),
		'all_items'         => __( 'All Level', 'mycourse' ),
		'parent_item'       => __( 'Parent Level', 'mycourse' ),
		'parent_item_colon' => __( 'Parent Level:', 'mycourse' ),
		'edit_item'         => __( 'Edit Level', 'mycourse' ),
		'update_item'       => __( 'Update Level', 'mycourse' ),
		'add_new_item'      => __( 'Add New Level', 'mycourse' ),
		'new_item_name'     => __( 'New Day Level', 'mycourse' ),
		'menu_name'         => __( 'Level', 'mycourse' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( 'levels', 'mycourse' ),
		'hierarchical' => false,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
	);
	register_taxonomy( 'level', array('course'), $args );

}
add_action( 'init', 'create_level_tax' );

add_filter( 'excerpt_length', 'reduce_length2', 99999999999999999999);

function reduce_length2( $length ) {
    return 15;
}

// function my_theme_excerpt_more( $more ) {
//     return 'read more';
// }
// add_filter( 'excerpt_more', 'my_theme_excerpt_more' );

function register_my_menu()
{
    register_nav_menu('header-menu',__('Header Menu'));
}

add_action('init', 'register_my_menu');

// function display_terms()
// {
// $args = array();
// $terms = get_taxonomies();

// }

// add_action( 'init', 'display_terms');

//echo $_POST['tname'];

//echo json_encode(array('message' => 'success'));

//add_action('wp_ajax_my_action', 'data_fetch');
add_action('wp_ajax_nopriv_my_action', 'data_fetch');

function data_fetch()
{
	//echo $_POST['name'];
	//echo $tname = $_POST['tname'];
	//echo $_POST['name2'];

	query_posts(
		array(
			'posts_per_page' => 5,
			'post_type' => 'course',
			'tax_query' => array(
				array(
					'taxonomy' => 'topic',
					'field' => 'term_id',
					'terms' => $_POST['name2'],
				)
			)
		)
	);

	while (have_posts()) : the_post(); ?>
	<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
	<p><?php echo get_the_excerpt(); ?>
	<a href="<?php the_permalink(); ?>">Read More</a>
	</p>
	
	<small><a href="tech-single.html" title=""><?php the_date('F j, y'); ?></a></small>
	<small><a href="tech-author.html" title="">by <?php the_author(); ?></a></small>
	
	<?php endwhile;
	
}

function cust_update_author($data)
{
	return 'Imran';
}

add_filter('update_post_author', 'cust_update_author');

add_action('init', 'create_custom_post_type_product');
 
function create_custom_post_type_product() {
 
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
'name' => _x('product', 'plural'),
'singular_name' => _x('product', 'singular'),
'menu_name' => _x('product', 'admin menu'),
'name_admin_bar' => _x('product', 'admin bar'),
'add_new' => _x('Add product', 'add new'),
'add_new_item' => __('Add New product'),
'new_item' => __('New product'),
'edit_item' => __('Edit product'),
'view_item' => __('View product'),
'all_items' => __('All product'),
'search_items' => __('Search product'),
'not_found' => __('No product found.'),
);
 
$args = array(
'supports' => $supports,
'labels' => $labels,
'description' => 'Holds our product and specific data',
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
//'rewrite' => array('slug' => 'product','with_front' => false),
'rewrite' => array('slug' => 'product'),
'has_archive' => true,
'hierarchical' => false,
'menu_position' => 6,
'menu_icon' => 'dashicons-book',
);
 
register_post_type('product', $args); // Register Post type
}
// rest api for products
add_action('rest_api_init', function () {
	register_rest_route( 'product/v1', 'get-posts',array(
				  'methods'  => 'GET',
				  'callback' => 'get_latest_posts',
		//           'permission_callback' => function() {
		//     return current_user_can('edit_posts');
		// }
  
		));
  });

function get_latest_posts() {
    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1; // setup pagination
       $the_query = new WP_Query( array(
        'post_type' => 'product',
        'paged' => $paged,
        //'p'     => 179,
		//'meta_key'      => 'price',
    	//'meta_value'    => 8,
		//'compare' => '>=',
		'meta_query' => array(
			array(
				'key' => 'price',
				'value' => 10,
				'type' => 'numeric',
				'compare' => '>'
			)
			),
        'orderby' =>'ID',
        'order' =>'desc',        
        'posts_per_page' => 20)
       ); 

       $post_id = $_GET['pid'];
       if(isset($post_id)):
      $queried_post = get_post($post_id);
      $title = $queried_post->post_title; 
	  $price = get_post_meta( $post_id, 'price' );    
      //$id = $queried_post->post_id;     
       //while ( $the_query->have_posts() ) : $the_query->the_post();        
       

      //$data[] = get_the_id();
      $data[] = array('id'=>$post_id,'title'=>$title,'price'=>$price);

    //endwhile;
    else:
      while ( $the_query->have_posts() ) : $the_query->the_post();        
       

        //$data[] = get_the_id();
        $data[] = array('id'=>get_the_id(),'title'=>get_the_title(),'price'=>get_post_meta( get_the_id(), 'price' ));

      endwhile;
    endif;
    if (empty($data)) {
    return new WP_Error( 'empty_category', 'there is no post in this category', array('status' => 404) );
    }

    echo json_encode(array('staus'=>0,'msg'=>'success','data'=>$data));
    //$response = new WP_REST_Response($data);
    //$response->set_status(200);
   // return $response;
}

/* FOR CUSTOM PERMALINKS */

add_action( 'init',  function() {
    add_rewrite_rule('^health/?([^/]*)/([^/]*)/?','index.php?page_id=225&food=$matches[1]&vitamin=$matches[2]','top');
} );

add_filter( 'query_vars', function( $query_vars ) {
    //$query_vars[] = 'myparamname';
    array_push($query_vars, 'food');
    array_push($query_vars, 'vitamin');
    return $query_vars;
} );



add_action( 'init',  function() {
	global $post;

	echo $post->ID;
	echo $meta_val = get_post_meta( 179, 'your_vision', true );

	the_field( "your_vision", 179 );

	//return $meta_val."/".$meta_value;
});

add_filter( 'register_post_type_args', 'change_custom_post_type', 10, 2 );
function change_custom_post_type( $args, $post_type ) {

    if ( 'product' === $post_type ) {
        $args['taxonomies']['category'] = 'category';
        //$args['taxonomies']['category'] = 'post_tag';
    }

    return $args;
}

//taxonomies' => array( 'category', 'post_tag' ),


