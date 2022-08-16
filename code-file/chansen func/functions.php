<?php
//Define theme root url and path
if (!defined('CTL_URL'))
    define('CTL_URL', get_template_directory_uri());
if (!defined('CTL_PATH'))
    define('CTL_PATH', get_template_directory());
if (!defined('CTL_BASE')){
        $ctl_base='';
        if($_SERVER['REMOTE_ADDR']=='::1' || $_SERVER['REMOTE_ADDR']=='127.0.0.1')
        {
            //special checking for windows OS
            if (DIRECTORY_SEPARATOR === '\\')
            {                
                $root_base = str_replace ( "/","\\", $_SERVER['DOCUMENT_ROOT']);
                $ctl_base= untrailingslashit(str_replace($root_base.'\\','',ABSPATH));                
            }
            else{
                $ctl_base=untrailingslashit(str_replace($_SERVER['DOCUMENT_ROOT'],'',ABSPATH));
            }
        }
        define('CTL_BASE',$ctl_base );
    }

    

if ( ! function_exists( 'wpvue_setup' ) ) :
    function wpvue_setup() {
        load_theme_textdomain( 'wpvue', get_template_directory() . '/languages' );
        add_theme_support( 'menus' );
        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(
            array(
                'main-menu' => __( 'Main Menu', 'wpvue' ),
                'footer' => __( 'Footer Menu', 'wpvue' ),
            )
        );
        add_theme_support( 'custom-logo' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'editor-styles' );
        add_editor_style( 'style-editor.css' );

        //Global Variable declare for polylang
        global $current_lang;
        if(is_plugin_active( 'polylang-pro/polylang.php' ) && function_exists('pll_current_language')){
                $current_lang=pll_default_language()==pll_current_language('slug')?'option':pll_current_language('slug');
        }else{
                $current_lang = 'option';
        }

        //Remove shortlink tag from header
        remove_action('wp_head', 'wp_shortlink_wp_head', 10);
        remove_action( 'template_redirect', 'wp_shortlink_header', 11);
    }
endif;
add_action( 'after_setup_theme', 'wpvue_setup' );
// Remove all default WP template redirects/lookups
remove_action( 'template_redirect', 'redirect_canonical' );

// Redirect all requests to index.php so the Vue app is loaded and 404s aren't thrown
function remove_redirects() {
    add_rewrite_rule( '^/(.+)/?', 'index.php', 'top' );
}
add_action( 'init', 'remove_redirects' );

// Load scripts
function load_vue_scripts() {
    global $post;
    wp_enqueue_script(
            'wpvue-scripts',
            get_template_directory_uri() . '/dist/scripts/app.js',
            array( 'jquery' ),
            filemtime( get_template_directory() . '/dist/scripts/app.js' ),
            true
    );

    if(is_user_logged_in() && (current_user_can('administrator') || current_user_can('wpseo_manager')))
    {
        wp_enqueue_style('admin-bar-css', site_url('/').'wp-includes/css/admin-bar.min.css');        
        
    }
    wp_enqueue_style('dashicons', site_url('/').'wp-includes/css/dashicons.min.css');
    wp_enqueue_style('ctl-fonts-1', 'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap');
    wp_enqueue_style('ctl-fonts-2', 'https://fonts.googleapis.com/css?family=Titillium+Web:300,400,600&display=swap');
    //wp_enqueue_style('ctl-mobile-menu', CTL_URL . '/css/mobile-menu.css',array());
    wp_enqueue_style('ctl-style', CTL_URL . '/css/style.min.css',array(),filemtime(CTL_PATH.'/css/style.min.css'));

    wp_enqueue_script('jquery');
    wp_enqueue_script('ctl-slick', CTL_URL . '/js/slick.min.js', array('jquery'),false,true);
    wp_enqueue_script('ctl-mmenu', CTL_URL . '/js/mmenu.js', array('jquery'),false,true);
    wp_enqueue_script('ctl-script', CTL_URL . '/js/custom.js', array('jquery'), filemtime(CTL_PATH.'/js/custom.js'), true);

    wp_localize_script('ctl-script','ctlObj',array('ajax_url'=>admin_url('admin-ajax.php'),'home_url'=>home_url('/'),'theme_url'=>CTL_URL));

    if (is_singular() && comments_open()) {
        wp_enqueue_script('comment-reply');
    }

    //Subscription popup translation
    global $current_lang;
       $subscription_translation=array(
            'title'=>get_field('title',$current_lang),
            'placeholder'=>get_field('placeholder',$current_lang),
            'age_text'=>get_field('age_text',$current_lang),
            'terms_condition_text'=>get_field('terms_condition_text',$current_lang),
            'button_text'=>get_field('button_text',$current_lang),
            'email_field_error_message'=>get_field('email_field_error_message',$current_lang),
            'receive_newsletter_error_message'=>get_field('receive_newsletter_error_message',$current_lang),
            'age_field_error_message'=>get_field('age_field_error_message',$current_lang),
            'redirect_page'=>get_field('redirect_page',$current_lang),
        );

    $subscription_translation['list_id']=get_field('aweber_list_id','option');
    if(!empty(get_field('is_show_trusted_header', 'option'))){
            $trustedHeaderExist = TRUE ;
        }else{
            $trustedHeaderExist = FALSE ;
        }
    if(!empty(get_field('is_show_trusted_footer', 'option'))){
            $trustedFooterExist = TRUE ;
        }else{
            $trustedFooterExist = FALSE ;
        }
    if(!empty(get_field('do_you_want_to_show_loader', 'option'))){
            $loadershow = TRUE ;
        }else{
            $loadershow = FALSE ;
        }

    $home_url=function_exists('pll_home_url')?str_replace(site_url(),'',pll_home_url()):'/';
    if(function_exists('pll_default_language') && pll_default_language()!=pll_current_language())
    {
        $home_url=str_replace(site_url(),'',untrailingslashit(pll_home_url()));
    }
	
	$logo_cta_link=get_field('logo_cta_link','option');
	$bonus_cta_link=get_field('bonus_cta_link','option');
	$rel_attribute=get_field('rel_attribute','option');
	$disable_headless_navigation=get_field('disable_headless_navigation','option');
    // Localize the script with new data
    $script_data = array(
        'postID'        => ( $post && $post->ID ) ? $post->ID : false,
        'site_name'     => get_bloginfo( 'name' ),
        'home_url'=>$home_url,
        'site_url'      => site_url(),
        'site_base'     =>CTL_BASE,
        'site_desc'     => get_bloginfo( 'description' ),
        'rest_api_url'  => site_url('wp-json'),
        'rest_wpv'      => 'wp/v2',
        'is_mobile'     =>!empty(wp_is_mobile())?true:false,
        'enable_multilanguage'=> is_plugin_active( 'polylang-pro/polylang.php' )?true:false,
        'default_language'=>function_exists('pll_default_language')?pll_default_language():get_locale(),
        'polylang_urls'=>array(),
        'current_language'=>function_exists('pll_current_language')?pll_current_language():get_locale(),
        'languages'=>function_exists('pll_the_languages')?pll_the_languages(array('raw'=>1,'hide_if_empty'=>false)):false,
        'country'=>$_COOKIE['wp-country'],
        'state'=>$_COOKIE['wp-state'],		
		'disable_headless_navigation'=> !empty($disable_headless_navigation)?true:false,
		'logo_cta_link'      => empty($logo_cta_link) || $logo_cta_link=='Yes'?true:false,
		'bonus_cta_link'      => empty($bonus_cta_link) || $bonus_cta_link=='Yes'?true:false,
		'rel_attribute'      => empty($rel_attribute) || $rel_attribute=='nofollow'?'nofollow':'sponsored',
        'enable_lazyload'      => get_field('enable_lazyload','option'),
        'insert_data-nosnippet_under_the_body'      => get_field('insert_data-nosnippet_under_the_body','option'),
        'disable_lazyload_for_user_agents'      => get_field('disable_lazyload_for_user_agents','option'),
		'disable_image_lazyload_for_class'      => get_field('disable_image_lazyload_for_class','option'),
		'enable_image_lazyload'      => get_field('enable_image_lazyload','option'),
        'disable_image_lazyload_for_user_agents'      => get_field('disable_image_lazyload_for_user_agents','option'),
        'enable_subscription_popup'=>get_field('enable_subscription_popup','option'),
        'subscription_translation'=>$subscription_translation,
        'show_admin_bar'=>is_user_logged_in() && (current_user_can('manage_options') || current_user_can('wpseo_manager'))?true:false,
		'current_user'=>is_user_logged_in()?get_current_user_id():0,
        'trustedHeaderExist'=>$trustedHeaderExist,
        'trustedFooterExist'=>$trustedFooterExist,
        'loadershow'=>$loadershow,
        'language_switcher_position'=>get_field('language_switcher_shows_at','option')?get_field('language_switcher_shows_at','option'):["header"],
        'data'          => array(            
            'site_data'     => wpvue_wpoptions_callback(),
            'routes'        => wpvue_get_all_routes(),
            'notfound'        => wpvue_get_notfound(),
        )
    );
    wp_localize_script( 'wpvue-scripts', 'wpvue_script_data_params', $script_data );
}
add_action( 'wp_enqueue_scripts', 'load_vue_scripts', 100 );

add_filter('style_loader_tag', 'ctl_style_loader_tag_filter', 10, 2);

function ctl_style_loader_tag_filter($html, $handle) {
    if ($handle === 'ctl-fonts-1' || $handle === 'ctl-fonts-2') {
        return str_replace("rel='stylesheet'",
            "rel='preload' as='font' crossorigin='anonymous'", $html);
    }

    if ($handle === 'dashicons' || $handle === 'ctl-style') {
            return str_replace("rel='stylesheet'",
            "rel='preload' as='style' crossorigin='anonymous' onload='this.rel=`stylesheet`'", $html);
        }
    return $html;
}

function removeBOM($data) {
    if (0 === strpos(bin2hex($data), 'efbbbf')) {
       return substr($data, 3);
    }
    return $data;
}
function wpvue_get_all_routes(){
    $enable_auth=get_option('enable_auth');
    $enable_resolve=get_option('enable_resolve');

    $args = array();
    if(!empty($enable_auth))
    {        
        $auth_username=get_option('auth_username');
        $auth_password=get_option('auth_password');
        $args['headers'] = array(
        'Authorization' => 'Basic ' . base64_encode($auth_username.':'.$auth_password)
        );
        
    }
    $args['timeout']= 120;
    //$args['sslverify'] = false;
    if(empty($enable_resolve)){
        $response = wp_remote_get( untrailingslashit(site_url()).'/wp-json/casbase/v1/routes/?default=1',$args);    
        if ( is_array( $response ) && ! is_wp_error( $response ) ) {
           $body    = json_decode($response['body'],true);
           return $body['data'];
        }
    }else if(!empty($enable_resolve))
    {
        $headers = array(
        'Content-Type: application/json'        
        );
        if(!empty($enable_auth))
        {
             $headers[]='Authorization: Basic '. base64_encode("$auth_username:$auth_password");
        }

        $resolve_domain=get_option('resolve_domain');
        $resolve_disable_https=get_option('resolve_disable_https');
        $resolve_insecure=get_option('resolve_insecure');
        $resolve_port=get_option('resolve_port');
        $resolve_ip=get_option('resolve_ip');

        if(empty($resolve_domain) || empty($resolve_port) || empty($resolve_ip))
            return false;

        $check_ping=(!empty($resolve_disable_https)?'http://':'https://').$resolve_domain.'/wp-json/casbase/v1/routes/?default=1';


        $check_ping_resolve = ["$resolve_domain:$resolve_port:$resolve_ip"];

        $check_ping_curl = curl_init();
        curl_setopt($check_ping_curl, CURLOPT_SSL_VERIFYHOST,0);
        curl_setopt($check_ping_curl, CURLOPT_SSL_VERIFYPEER,(!empty($resolve_insecure)?0:1));
        curl_setopt($check_ping_curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($check_ping_curl, CURLOPT_DNS_CACHE_TIMEOUT, 0);
        curl_setopt($check_ping_curl, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
        curl_setopt($check_ping_curl, CURLOPT_RESOLVE,$check_ping_resolve);
        curl_setopt ($check_ping_curl, CURLOPT_FOLLOWLOCATION, true); // to follow the location when http response is 301
        curl_setopt ($check_ping_curl, CURLOPT_CONNECTTIMEOUT, 10); 
        curl_setopt($check_ping_curl, CURLOPT_URL, $check_ping);
        
        curl_setopt($check_ping_curl, CURLOPT_HTTPHEADER, $headers);
        $check_ping_curl_result = curl_exec($check_ping_curl);
        curl_close($check_ping_curl);
        
        $check_ping_curl_result=json_decode(removeBOM($check_ping_curl_result),true);
        return $check_ping_curl_result['data'];

    }

    return false;
}


function wpvue_get_notfound(){
    global $current_lang;
        $notfound['background_image'] = get_field('404_background_image', $current_lang);
        $notfound['description'] = get_field('404_description', $current_lang);
        $notfound['button_text'] = get_field('404_button_text', $current_lang);
    return $notfound;
}

function wpvue_wpoptions_callback() {
    return array(
        'site_logo' => get_template_directory_uri() . '/images/logo.svg',
    );
}


/*
=============================================
CUSTOM SECTION STARTS HERE
=============================================
*/
//Define theme root url and path
if (!defined('CTL_URL'))
    define('CTL_URL', get_template_directory_uri());
if (!defined('CTL_PATH'))
    define('CTL_PATH', get_template_directory());

if(file_exists(CTL_PATH.'/includes/post_types.php'))
require_once(CTL_PATH.'/includes/post_types.php');
if(file_exists(CTL_PATH.'/includes/shortcode.php'))
require_once(CTL_PATH.'/includes/shortcode.php');
if(file_exists(CTL_PATH.'/includes/blocks.php'))
require_once(CTL_PATH.'/includes/blocks.php');
if(file_exists(CTL_PATH.'/includes/api.php'))
require_once(CTL_PATH.'/includes/api.php');
if(file_exists(CTL_PATH.'/includes/ctl_widget.php'))
require_once(CTL_PATH.'/includes/ctl_widget.php');
if (file_exists(CTL_PATH . '/includes/i18n.php'))
require_once(CTL_PATH . '/includes/i18n.php');
if (file_exists(CTL_PATH . '/includes/pll_sitemap_support.php'))
require_once(CTL_PATH . '/includes/pll_sitemap_support.php');



//Add script and css for front end
add_action('admin_enqueue_scripts', 'ctl_admin_scripts');
function ctl_admin_scripts(){
    wp_localize_script('jquery','ctlAdmin',array('ajax_url'=>admin_url('admin-ajax.php'),'home_url'=>home_url('/'),'theme_url'=>CTL_URL,'upload_dir'=>wp_upload_dir()));
}

//Allow SVG files to upload
if (!function_exists('ctl_mime_types')) {

    function ctl_mime_types($file_types) {
        $new_filetypes = array();
        $new_filetypes['svg'] = 'image/svg';
        $file_types = array_merge($file_types, $new_filetypes);

        return $file_types;
    }

}
add_filter('upload_mimes', 'ctl_mime_types');

//Remove default favicon and use custom 
add_filter( 'get_site_icon_url', '__return_false' );
add_action( 'wp_head', 'ctl_prefix_favicon', 100 ); 
add_action( 'admin_head', 'ctl_prefix_favicon', 100 ); 
add_action( 'wp_head', 'ctl_prefix_favicon', 100 ); 
add_action( 'wp_head', 'ctl_link_url', 100 ); 
function ctl_prefix_favicon() { 
    $favicon=get_field('favicon','option');
if(!empty($favicon['url'])){
 ?> 
 <link rel="icon" href="<?php echo $favicon['url'];?>" />
 <link rel="icon" href="<?php echo $favicon['url'];?>" />
 <link rel="apple-touch-icon" href="<?php echo $favicon['url'];?>" />

<?php } }
function ctl_link_url()
{
?>
 <link rel="preload" href="<?php echo CTL_URL; ?>/images/loader.svg"
      as="image" type="image/svg+xml" />
<?php
}

//Breadcrumb functionality
if(!function_exists('ctl_breadcrumb')){
    function ctl_breadcrumb($resource_id,$terms ='') {
        global $pll_current_lang;
        if(is_plugin_active( 'polylang-pro/polylang.php' ) && function_exists('pll_current_language')){
                $pll_current_lang=pll_default_language()==$_COOKIE['pll_language']?'option':$_COOKIE['pll_language'];
        }else{
                $pll_current_lang = 'option';
        }
        
        $post_type = get_post_type($resource_id);
        if($terms !== '' ){
            $category = get_term_by('name', $terms);
        }

        if (is_home() || is_front_page())
            return;

        $breadcrumb=array(); 

        $homepageID = get_option('page_on_front');
        //front page id ,polylang support
        if(function_exists('pll_default_language'))
        {
          global $pll_current_lang;
          if($pll_current_lang!='option' && $pll_current_lang!=pll_default_language())
            $homepageID=pll_get_post($homepageID,$pll_current_lang);
        }

        $home_text=get_field('home_breadcrumb',$pll_current_lang);
        $home_text=!empty($home_text)?$home_text:__('Home','ctl');

        if($homepageID == $resource_id){ return; }else{
            $home_url='/';
            if(function_exists('pll_default_language') && $pll_current_lang!='option')
                $home_url=untrailingslashit(ctl_get_relative_url(pll_home_url($pll_current_lang)));
            
            if(wp_is_mobile()){
                //$breadcrumb[__('...','ctl')]=$home_url;
                $breadcrumb[$home_text]=$home_url;
            }else{
                $breadcrumb[$home_text]=$home_url;
            }
        
        }
        global $post, $wp_query;
        if (is_archive() && !is_tax() && !is_category() && !is_tag()) {
            $breadcrumb[post_type_archive_title($prefix, false)]='';
        }
        else if (is_archive() && is_tax() && !is_category() && !is_tag()) {

                // If post is a custom post type
                $post_type = get_post_type();

                // If it is a custom post type display name and link
                if ($post_type != 'post') {

                    $post_type_object = get_post_type_object($post_type);
                    $post_type_archive = get_post_type_archive_link($post_type);
                    $breadcrumb[$post_type_object->labels->name]=ctl_get_relative_url($post_type_archive);
                }

                $breadcrumb[get_queried_object()->name]='';

        }
        else if($resource_id == 'search' ){
            $breadcrumb['search']='';
        }elseif( $terms !== ''  ){
            $breadcrumb[$resource_id]='';
        }
        elseif (FALSE === get_post_status( $resource_id )) {

            // 404 page
            $breadcrumb[__('Page not found','ctl')]=$terms;
        }
        else if ($post_type != 'page') {
                $breadcrumbsrttings = get_field('breadcrumb_display_as', $resource_id);
                if(!$breadcrumbsrttings){
                    $breadcrumbsrttings = 2;
                }

                if( $breadcrumbsrttings == 1){

                    // If child page, get parents
                    $anc = get_post_ancestors($resource_id);
                    // Get parents in the right order
                    $anc = array_reverse($anc);
                    if($anc){
                        foreach ($anc as $ancestor) {
                            $breadcrumb[get_the_title($ancestor)]=ctl_get_relative_url(get_permalink($ancestor));
                        }
                    }

                    $breadcrumb[get_the_title($resource_id)]='';

                }else{

                    //Search categories for custom post type and add them to breadcrumb
                    $terms=wp_get_post_terms($resource_id,'category');
                    if(!is_wp_error($terms) && !empty($terms)){
                        foreach ( $terms as $term )
                        {
                            if($term->slug !== 'uncategorized'){
                            if ($term->parent == 0) // this gets the parent of the current post taxonomy
                            {
                                $linked_page=get_term_meta($term->term_id,'page_for_custom_link',true);
                                $breadcrumb[$term->name]=ctl_get_relative_url(get_permalink($linked_page));
                                $myparent = $term;
                            }
                            }
                        }
                            
                        // Right, the parent is set, now let's get the children
                        foreach ( $terms as $term ) {
                            if($term->slug !== 'uncategorized'){
                            if ($term->parent != 0) // this ignores the parent of the current post taxonomy
                            { 
                            $linked_page=get_term_meta($term->term_id,'page_for_custom_link',true);
                            $breadcrumb[$term->name]=ctl_get_relative_url(get_permalink($linked_page));
                            
                            }
                            }
                        }
                    }

                    $breadcrumb[get_the_title($resource_id)]='';

                }
            
        }
        else if (is_category()) {
            $breadcrumb[single_cat_title('', false)]='';
        }
        else if ($post_type == 'page') {

            // If child page, get parents
            $anc = get_post_ancestors($resource_id);
            // Get parents in the right order
            $anc = array_reverse($anc);
            if($anc){
                foreach ($anc as $ancestor) {
                    $breadcrumb[get_the_title($ancestor)]=ctl_get_relative_url(get_permalink($ancestor));
                }
            }
                
                $breadcrumb[get_the_title($resource_id)]='';
              

        }

        else if (is_tag()) {
            // Tag page
            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args = 'include=' . $term_id;
            $terms = get_terms($taxonomy, $args);
            $get_term_id = $terms[0]->term_id;
            $get_term_slug = $terms[0]->slug;
            $get_term_name = $terms[0]->name;
            $breadcrumb[$get_term_name]='';
        }
        elseif (is_day()) {
            // Day archive
            // Year link
            $breadcrumb[get_the_time('Y').' Archives']=ctl_get_relative_url(get_year_link(get_the_time('Y')));

            // Month link
            $breadcrumb[get_the_time('M') . ' Archives']=ctl_get_relative_url(get_month_link(get_the_time('Y'), get_the_time('m')));

            // Day display
             $breadcrumb[get_the_time('M') . ' Archives']='';

        }
        else if (is_month()) {

            // Month Archive
            // Year link
            $breadcrumb[get_the_time('Y') . ' Archives']=ctl_get_relative_url(get_year_link(get_the_time('Y')));

            // Month display
            $breadcrumb[get_the_time('M') . ' Archives']='';

        } else if (is_year()) {

            // Display year archive
            $breadcrumb[get_the_time('Y') . ' Archives']='';

        } else if (is_author()) {

            // Auhor archive
            // Get the author information
            global $author;
            $userdata = get_userdata($author);

            // Display author name
             $breadcrumb['Author: ' . $userdata->display_name]='';

        } elseif (is_search()) {

            // Search page
            $breadcrumb[__('Search','ctl')]='';
        }

        return $breadcrumb;
    }
}

//Get relative url from full url
function ctl_get_relative_url($url)
{
    $home_url=home_url();
    $relative_url=untrailingslashit(str_replace(array($home_url.'/',$home_url),'/',$url));

    $relative_url=!empty($relative_url)?$relative_url:'/';

    return $relative_url;
}


//Remove absolute url from content and make it relative
function ctl_replace_absolute_url($content,$route_tag=true)
{

    $home_url=untrailingslashit(home_url());
    $content=str_replace(array('href="'.$home_url.'/','href="'.$home_url),'href="/',$content);
   
    //Make anchor tag to VUE compatible tag
    //After replacing all the internal full url to relative url
    //Make acnhor to router-link only for inter links that have relative urls i.e. href starts with "/"
    if(!empty($route_tag)){           
       
        //$pattern='/<a[^>]+href="[\/](.*?)"[^>]*>(.*?)<\/a>/';
        //$replacement = '<router-link to="/$1">$2</router-link>';

        $pattern='/<a[^>]*href="[\/](.*?)"(.*?)>(.*?)<\/a>/';
        $replacement = '<router-link to="/$1"$2>$3</router-link>';
        $content = preg_replace($pattern, $replacement, $content);
    }

    return $content;
}


if( function_exists('acf_add_options_page') ) {
  // Language Specific Options
  // Translatable options specific languages. e.g., social profiles links
  // 

  $parent = acf_add_options_page(array(
        'page_title' => __('Theme Global Settings', 'ctl'),
        'menu_title' => __('Theme Global Settings', 'ctl'),
        'menu_slug' => 'theme-global-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));
  /*acf_add_options_page(array(
        'page_title' => __('Translation Settings', 'ctl'),
        'menu_title' => __('Translation Settings', 'ctl'),
        'menu_slug' => 'theme-translation-settings',
        'capability' => 'edit_posts',
        'parent_slug' => $parent['menu_slug'],
        'redirect' => false
    ));*/

  
  
  if(is_plugin_active( 'polylang-pro/polylang.php' )){


      $languages = function_exists('pll_languages_list')?pll_languages_list():array();

      foreach ( $languages as $lang ) {
        $is_default_lang=$lang==pll_default_language()?true:false;
        $parent = acf_add_options_page(array(
            'page_title' => __('Theme General Settings('.$lang.')', 'ctl'),
            'menu_title' => __('Theme Settings('.$lang.')', 'ctl'),
            'menu_slug' => 'theme-general-settings'.($is_default_lang?'':'-'.$lang),
            'capability' => 'edit_posts',
            'post_id'    => $is_default_lang?'option':$lang,
            'redirect' => false
        ));
        acf_add_options_page(array(
            'page_title' => __('Translation Settings('.$lang.')', 'ctl'),
            'menu_title' => __('Translation Settings('.$lang.')', 'ctl'),
            'menu_slug' => 'theme-translation-settings'.($is_default_lang?'':'-'.$lang),
            'capability' => 'edit_posts',
            'parent_slug' => $parent['menu_slug'],
            'post_id'    => $is_default_lang?'option':$lang,
            'redirect' => false
        ));
      }

  }else{
    $parent = acf_add_options_page(array(
            'page_title' => __('Theme General Settings', 'ctl'),
            'menu_title' => __('Theme Settings', 'ctl'),
            'menu_slug' => 'theme-general-settings',
            'capability' => 'edit_posts',
           // 'post_id'    => $is_default_lang?'option':$lang,
            'redirect' => false
        ));
        acf_add_options_page(array(
            'page_title' => __('Translation Settings', 'ctl'),
            'menu_title' => __('Translation Settings', 'ctl'),
            'menu_slug' => 'theme-translation-settings',
            'capability' => 'edit_posts',
            'parent_slug' => $parent['menu_slug'],
            //'post_id'    => $is_default_lang?'option':$lang,
            'redirect' => false
        ));
  }
  
}

if(!function_exists('ctl_post_type_permalinks')){
    function ctl_post_type_permalinks( $post_link, $post, $leavename ){
        if ( isset( $post->post_type ) && ('free_game' == $post->post_type || 'ppc' == $post->post_type || 'reviews' == $post->post_type || 'casino_type' == $post->post_type || 'payment_option' == $post->post_type || 'casino_game' == $post->post_type || 'casino_software'==$post->post_type) ) {
            $post_type_data = get_post_type_object( $post->post_type );

            $slug=!empty($post_type_data->rewrite['slug'])
    ?$post_type_data->rewrite['slug']:$post->post_type;
            $post_link = str_replace( '/' . $slug . '/', '/', $post_link );

        }

        return $post_link;
    }

}
add_filter('post_type_link', 'ctl_post_type_permalinks', 10, 3);
function get_current_url(){
        $REQUEST_URI = strtok( $_SERVER['REQUEST_URI'], '?' );
        $real_url = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' ) ? 'https://' : 'http://';
        $real_url .= $_SERVER['SERVER_NAME'] . $REQUEST_URI;
        return $real_url;
    }
function ctl_parse_request( $query ) {

    /*if (!$query->is_main_query()) {
            return;
        }
        if (!isset($query->query['page']) || 2 !== count($query->query)) {
            return;
        }
        if (empty($query->query['name'])) {
            return;
        }

       $query->set( 'post_type', array( 'post', 'page', 'reviews','free_game','casino_type','payment_option','casino_game','casino_software') );*/

    // make sure it's main query on frontend
    if( ! is_admin() && $query->is_main_query() && ! $query->get('queried_object_id') ){

        //Allowed post type
        $post_types=array( 'post', 'page', 'reviews','free_game','ppc','casino_type','payment_option','casino_game','casino_software');

        //Allowed post type with parent child relationship
        //1 for set relationship
        $keys=array();
        foreach($post_types as $p)
        {
            $keys[$p]=1;
        }

        // conditions investigated after many tests
        if( $query->is_404() || $query->get('pagename') || $query->get('attachment') || $query->get('name') || $query->get('category_name') ){
            // test both site_url and home_url
            $web_roots = array();
            $web_roots[] = site_url();
            if( site_url() != home_url() ){
                $web_roots[] = home_url();
            }
            // polylang fix
            if( function_exists('pll_home_url') ){
                if( site_url() != pll_home_url() ){
                    //don't use pll_home_url as it may be /en or /en/home-en
                    //Need home_url()/en
                    //$web_roots[] = pll_home_url();
                    $polylang_settings=get_option('polylang');
                    $rewrite=empty($polylang_settings['rewrite'])?'language/':'';
                    $web_roots[] = home_url('/').$rewrite.pll_current_language();
                }
            }

            foreach( $web_roots as $web_root ){
                // get clean current URL path
                $path = get_current_url();
                $path = str_replace( $web_root, '', $path );
                // fix missing slash
                if( substr( $path, 0, 1 ) != '/' ){
                    $path = '/' . $path;
                }
                // test for posts
                $post_data = get_page_by_path( $path, OBJECT, 'post' );
                //Polylang support with same slug
                if(function_exists('pll_default_language') && !empty($post_data))
                {
                    $post_data=get_post(pll_get_post($post_data->ID,pll_current_language()));
                }

                if( ! ( $post_data instanceof WP_Post ) ){
                    // test for pages
                    $post_data = get_page_by_path( $path );
                    //Polylang support with same slug
                    if(function_exists('pll_default_language') && !empty($post_data))
                    {
                        $post_data=get_post(pll_get_post($post_data->ID,pll_current_language()));
                    }
                    if( ! is_object( $post_data ) ){
                        // test for selected CPTs
                        $post_data = get_page_by_path( $path, OBJECT, $post_types );
                        //Polylang support with same slug
                        if(function_exists('pll_default_language') && !empty($post_data))
                        {
                            $post_data=get_post(pll_get_post($post_data->ID,pll_current_language()));
                        }
                        
                        if( is_object( $post_data ) ){
                            // maybe name with ancestors is needed
                            $post_name = $post_data->post_name;
                            if( $keys[ $post_data->post_type ] == 1 ){
                                $ancestors = get_post_ancestors( $post_data->ID );
                                foreach( $ancestors as $ancestor ){
                                    $post_name = get_post_field( 'post_name', $ancestor ) . '/' . $post_name;
                                }
                            }

                            // get CPT slug
                            $query_var = get_post_type_object( $post_data->post_type )->query_var;
                            // alter query
                            $query->is_404 = 0;
                            $query->tax_query = NULL;
                            $query->is_attachment = 0;
                            $query->is_category = 0;
                            $query->is_archive = 0;
                            $query->is_tax = 0;
                            $query->is_page = 0;
                            $query->is_single = 1;
                            $query->is_singular = 1;
                            $query->set( 'error', NULL );
                            unset( $query->query['error'] );
                            $query->set( 'page', '' );
                            $query->query['page'] = '';
                            $query->set( 'pagename', NULL );
                            unset( $query->query['pagename'] );
                            $query->set( 'attachment', NULL );
                            unset( $query->query['attachment'] );
                            $query->set( 'category_name', NULL );
                            unset( $query->query['category_name'] );
                            $query->set( 'post_type', $post_data->post_type );
                            $query->query['post_type'] = $post_data->post_type;
                            /*$query->set( 'name', $post_name );
                            $query->query['name'] = '';
                            $query->set( $query_var, $post_name );
                            $query->query[ $query_var ] = $post_name;*/                            
                            $query->set( 'page_id',$post_data->ID);
                            $query->query[ $query_var ] = $post_data->ID;
                            
                            break;
                        }else{
                            // deeper matching
                            global $wp_rewrite;
                            // test all selected CPTs
                            foreach( $post_types as $post_type ){
                                // get CPT slug and its length
                                $query_var = get_post_type_object( $post_type )->query_var;
                                // test all rewrite rules
                                foreach( $wp_rewrite->rules as $pattern => $rewrite ){
                                    // test only rules for this CPT
                                    if( strpos( $pattern, $query_var ) !== false ){
                                        if( strpos( $pattern, '(' . $query_var . ')' ) === false ){
                                            preg_match_all( '#' . $pattern . '#', '/' . $query_var . $path, $matches, PREG_SET_ORDER );
                                        }else{
                                            preg_match_all( '#' . $pattern . '#', $query_var . $path, $matches, PREG_SET_ORDER );
                                        }

                                        if( count( $matches ) !== 0 && isset( $matches[0] ) ){
                                            // build URL query array
                                            $rewrite = str_replace( 'index.php?', '', $rewrite );
                                            parse_str( $rewrite, $url_query );
                                            foreach( $url_query as $key => $value ){
                                                $value = (int)str_replace( array( '$matches[', ']' ), '', $value );
                                                if( isset( $matches[0][ $value ] ) ){
                                                    $value = $matches[0][ $value ];
                                                    $url_query[ $key ] = $value;
                                                }
                                            }

                                            // test new path for selected CPTs
                                            $post_data = get_page_by_path( '/' . $url_query[ $query_var ], OBJECT, $keys );
                                            //Polylang support with same slug
                                            if(function_exists('pll_default_language') && !empty($post_data))
                                            {
                                                $post_data=get_post(pll_get_post($post_data->ID,pll_current_language()));
                                            }
                                            if( is_object( $post_data ) ){
                                                // alter query
                                                $query->is_404 = 0;
                                                $query->tax_query = NULL;
                                                $query->is_attachment = 0;
                                                $query->is_category = 0;
                                                $query->is_archive = 0;
                                                $query->is_tax = 0;
                                                $query->is_page = 0;
                                                $query->is_single = 1;
                                                $query->is_singular = 1;
                                                $query->set( 'error', NULL );
                                                unset( $query->query['error'] );
                                                $query->set( 'page', '' );
                                                $query->query['page'] = '';
                                                $query->set( 'pagename', NULL );
                                                unset( $query->query['pagename'] );
                                                $query->set( 'attachment', NULL );
                                                unset( $query->query['attachment'] );
                                                $query->set( 'category_name', NULL );
                                                unset( $query->query['category_name'] );
                                                $query->set( 'post_type', $post_data->post_type );
                                                $query->query['post_type'] = $post_data->post_type;
                                                $query->set( 'name', $url_query[ $query_var ] );
                                                $query->query['name'] = $url_query[ $query_var ];
                                                // solve custom rewrites, pagination, etc.
                                                foreach( $url_query as $key => $value ){
                                                    if( $key != 'post_type' && substr( $value, 0, 8 ) != '$matches' ){
                                                        $query->set( $key, $value );
                                                        $query->query[ $key ] = $value;
                                                    }
                                                }
                                                break 3;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
add_action( 'pre_get_posts', 'ctl_parse_request',1 );

//Create widgets
add_action('widgets_init', 'ctl_widgets_init');
if (!function_exists('ctl_widgets_init')) {

    function ctl_widgets_init() {

        // register custom promotion widget
        register_widget( 'wpb_widget' );

        register_sidebar(
            array(
                'name' => __('Game Guides', 'ctl'),
                'id' => 'game-guide',
                'description' => __('Add widgets here to appear in your game guide page.', 'ctl'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            )
        );
        register_sidebar(
            array(
                'name' => __('Reviews Sidebar', 'ctl'),
                'id' => 'reviews-sidebar',
                'description' => __('Add widgets here to appear in your reviews details page.', 'ctl'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            )
        );
        register_sidebar(
            array(
                'name' => __('Casino Software Sidebar', 'ctl'),
                'id' => 'casino-software-sidebar',
                'description' => __('Add widgets here to appear in your casino software details page.', 'ctl'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            )
        );
        register_sidebar(
            array(
                'name' => __('Payment Options Sidebar', 'ctl'),
                'id' => 'payment-options-sidebar',
                'description' => __('Add widgets here to appear in your payment details page.', 'ctl'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            )
        );
        register_sidebar(
            array(
                'name' => __('Free Game Sidebar', 'ctl'),
                'id' => 'free-game-sidebar',
                'description' => __('Add widgets here to appear in your free game details page.', 'ctl'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            )
        );
        register_sidebar(
            array(
                'name' => __('PPC Sidebar', 'ctl'),
                'id' => 'ppc-sidebar',
                'description' => __('Add widgets here to appear in your PPC details page.', 'ctl'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            )
        );
        register_sidebar(
            array(
                'name' => __('Blog Sidebar', 'ctl'),
                'id' => 'blog-sidebar',
                'description' => __('Add widgets here to appear in your blog side.', 'ctl'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            )
        );
        register_sidebar(
            array(
                'name' => __('Footer 1', 'ctl'),
                'id' => 'footer-1',
                'description' => __('Add widgets here to appear in your footer.', 'ctl'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<h4 class="widget-title">',
                'after_title' => '</h4>',
            )
        );
        register_sidebar(
            array(
                'name' => __('Footer 2', 'ctl'),
                'id' => 'footer-2',
                'description' => __('Add widgets here to appear in your footer.', 'ctl'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<span class="widget-title">',
                'after_title' => '</span>',
            )
        );
        register_sidebar(
            array(
                'name' => __('Footer 3', 'ctl'),
                'id' => 'footer-3',
                'description' => __('Add widgets here to appear in your footer.', 'ctl'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<span class="widget-title">',
                'after_title' => '</span>',
            )
        );
        register_sidebar(
            array(
                'name' => __('Footer 4', 'ctl'),
                'id' => 'footer-4',
                'description' => __('Add widgets here to appear in your footer.', 'ctl'),
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '<span class="widget-title">',
                'after_title' => '</span>',
            )
        );
        register_sidebar(
            array(
                'name' => __('Footer 5', 'ctl'),
                'id' => 'footer-5',
                'description' => __('Add widgets here to appear in your footer.', 'ctl'),
                'before_widget' => '<div class="footer-legal">',
                'after_widget' => '</div>',
                'before_title' => '<span class="widget-title">',
                'after_title' => '</span>',
            )
        );
    }

}
//Get number of days left
if(!function_exists('ctl_days_left')){
    function ctl_days_left($date)
    {
        if(empty($date))
            return 0;
        
        $dateTimeLeft = array();
        //Convert to date
        $datestr=$date;//Your date
        $date=strtotime($datestr);//Converted to a PHP date (a second count)

        //Calculate difference
        $diff=$date-time();//time returns current time in seconds
        $dateTimeLeft['days']=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
        $dateTimeLeft['hours']=round(($diff-$dateTimeLeft['days']*60*60*24)/(60*60));
        $dateTimeLeft['minutes']=round(($diff-$dateTimeLeft['hours']*60*60*24)/(60*60*60));
        


        return $dateTimeLeft;
    }
}

add_action('wp_head','ctl_header_style');
function ctl_header_style()
{
    ?>    
    <script type="application/ld+json">
     <?php
      include(CTL_PATH.'/includes/schema.php');
      echo json_encode(ctl_get_website_schema());
     ?>
    </script>
    <?php
    //For polylang support 
    if(function_exists('pll_current_language') && empty($_COOKIE['pll_language']))
    {
    ?>
    <script type="text/javascript">        
            document.cookie = "pll_language=<?php echo pll_current_language();?>;";                    
    </script>
    <?php
    }
    ?>
    <?php

    //Set translations as local storage
      $upload_dir=wp_upload_dir();
      $translations=false;
      $enable_auth=get_option('enable_auth');
      $args = array();
      if(file_exists($upload_dir['basedir'].'/translations.json')){
                
          $translations=file_get_contents($upload_dir['basedir'].'/translations.json');
        
      }

      ?>
      <script>
       var translations=JSON.stringify(<?php echo $translations; ?>);
           localStorage.setItem('translation',translations );
      </script>

      <?php

}
add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
  show_admin_bar(false);
}

/*API setting admin menu*/
add_action( 'admin_init', 'ctl_api_settings_init' );
function ctl_api_settings_init()
{
    register_setting('ctl_api_settings','enable_auth' );
    register_setting('ctl_api_settings','auth_username' );
    register_setting('ctl_api_settings','auth_password' );
    register_setting('ctl_api_settings','enable_resolve' );
    register_setting('ctl_api_settings','resolve_disable_https' );
    register_setting('ctl_api_settings','resolve_insecure' );
    register_setting('ctl_api_settings','resolve_domain' );
    register_setting('ctl_api_settings','resolve_port' );
    register_setting('ctl_api_settings','resolve_ip' );
}
add_action("admin_menu", "ctl_api_settings_menu",999);
function ctl_api_settings_menu()
{
    add_submenu_page("theme-global-settings", "API Settings", "API Settings", 0, "api-settings", "ctl_api_settings_func");
}
function ctl_api_settings_func()
{
    settings_errors();

    $enable_auth=get_option('enable_auth');
    $auth_username=get_option('auth_username');
    $auth_password=get_option('auth_password');

    $enable_resolve=get_option('enable_resolve');
    $resolve_disable_https=get_option('resolve_disable_https');
    $resolve_insecure=get_option('resolve_insecure');
    $resolve_domain=get_option('resolve_domain');
    $resolve_port=get_option('resolve_port');
    $resolve_ip=get_option('resolve_ip');
    ?>
    <div class="wrap">
        <h1><?php _e('API Settings','ctl');?></h1>
        <form action="options.php" method="post" >
            <?php             
            settings_fields( 'ctl_api_settings' );
            do_settings_sections( 'ctl_api_settings' );
            ?>
            <table class="form-table" role="presentation">
                <tbody>                    
                    <tr>
                        <th scope="row"><?php _e('Use Authentication','ctl');?></th>
                        <td> 
                            <fieldset>
                                <legend class="screen-reader-text">     <span><?php _e('Use Authentication','ctl');?></span>
                                </legend>
                                <label for="enable_auth">
                                    <input name="enable_auth" type="checkbox" id="enable_auth" value="1" <?php checked($enable_auth,1,true);?>>
                                    <?php _e('Enable authentication','ctl');?>
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                    <tr id="auth_username_row" style="<?php echo empty($enable_auth)?'display:none;':'';?>">
                        <th scope="row">
                            <label for="auth_username"><?php _e('User Name','ctl');?></label>
                        </th>
                        <td>
                            <input name="auth_username" type="text" id="auth_username" value="<?php echo $auth_username;?>" class="regular-text">
                        </td>
                    </tr>
                    <tr id="auth_password_row" style="<?php echo empty($enable_auth)?'display:none;':'';?>">
                        <th scope="row">
                            <label for="auth_password"><?php _e('Password','ctl');?></label>
                        </th>
                        <td>
                            <input name="auth_password" type="password" id="auth_password" value="<?php echo $auth_password;?>" class="regular-text">
                        </td>
                    </tr> 
                    <tr>
                        <th scope="row"><?php _e('Use Ping Resolve','ctl');?></th>
                        <td> 
                            <fieldset>
                                <legend class="screen-reader-text">     <span><?php _e('Use Ping Resolve','ctl');?></span>
                                </legend>
                                <label for="enable_resolve">
                                    <input name="enable_resolve" type="checkbox" id="enable_resolve" value="1" <?php checked($enable_resolve,1,true);?>>
                                    <?php _e('Use Ping Resolve','ctl');?>
                                </label>
                            </fieldset>
                        </td>
                    </tr> 
                    <tr id="resolve_disable_https_row" style="<?php echo empty($enable_resolve)?'display:none;':'';?>">
                        <th scope="row">
                            <label for="resolve_disable_https"><?php _e('Disable HTTPS','ctl');?></label>
                        </th>
                        <td>
                            <input name="resolve_disable_https" type="checkbox" id="resolve_disable_https" value="1" <?php echo checked($resolve_disable_https,true,true);?>>
                        </td>
                    </tr> 
                    <tr id="resolve_insecure_row" style="<?php echo empty($enable_resolve)?'display:none;':'';?>">
                        <th scope="row">
                            <label for="resolve_insecure"><?php _e('Insecure','ctl');?></label>
                        </th>
                        <td>
                            <input name="resolve_insecure" type="checkbox" id="resolve_insecure" value="1" <?php echo checked($resolve_insecure,true,true);?>>
                        </td>
                    </tr>                    
                    <tr id="resolve_domain_row" style="<?php echo empty($enable_resolve)?'display:none;':'';?>">
                        <th scope="row">
                            <label for="resolve_domain"><?php _e('Domain Name','ctl');?></label>
                        </th>
                        <td>
                            <input name="resolve_domain" type="text" id="resolve_domain" value="<?php echo $resolve_domain;?>" class="regular-text">
                        </td>
                    </tr> 
                    <tr id="resolve_port_row" style="<?php echo empty($enable_resolve)?'display:none;':'';?>">
                        <th scope="row">
                            <label for="resolve_port"><?php _e('Port','ctl');?></label>
                        </th>
                        <td>
                            <input name="resolve_port" type="text" id="resolve_port" value="<?php echo $resolve_port;?>" class="regular-text">
                        </td>
                    </tr>   
                    <tr id="resolve_ip_row" style="<?php echo empty($enable_resolve)?'display:none;':'';?>">
                        <th scope="row">
                            <label for="resolve_ip"><?php _e('IP','ctl');?></label>
                        </th>
                        <td>
                            <input name="resolve_ip" type="text" id="resolve_ip" value="<?php echo $resolve_ip;?>" class="regular-text">
                        </td>
                    </tr>               
                </tbody>
            </table>
            <?php
            submit_button('Save Changes');
            ?>
        </form>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $(document).on('click','#enable_auth',function(){
                if($(this).is(":checked"))
                {
                    $('#auth_username_row').show();
                    $('#auth_password_row').show();
                }
                else{
                    $('#auth_username_row').hide();
                    $('#auth_password_row').hide();
                }
            });

            $(document).on('click','#enable_resolve',function(){
                if($(this).is(":checked"))
                {
                    $('#resolve_domain_row').show();
                    $('#resolve_disable_https_row').show();
                    $('#resolve_insecure_row').show();
                    $('#resolve_port_row').show();
                    $('#resolve_ip_row').show();
                }
                else{
                    $('#resolve_domain_row').hide();
                    $('#resolve_disable_https_row').hide();
                    $('#resolve_insecure_row').hide();
                    $('#resolve_port_row').hide();
                    $('#resolve_ip_row').hide();
                }
            });
            
        });
    </script>
    <?php
}
/*API setting admin menu*/


function GetCR($CurrencySign)
{
    $JsonContent = $json_currency_array = '{
    "currency":[
    {"type":"EUR","symbol":"€"}
    ,{"type":"GBP","symbol":"£"}
    ,{"type":"USD","symbol":"$"}
    ,{"type":"BGN","symbol":"лв"}
    ,{"type":"CAD","symbol":"CA$"}
    ,{"type":"CHF","symbol":"CHF"}
    ,{"type":"CZK","symbol":"Kč"}
    ,{"type":"DKK","symbol":"kr"}
    ,{"type":"HRK","symbol":"kn"}
    ,{"type":"HUF","symbol":"ft"}
    ,{"type":"NOK","symbol":"kr"}
    ,{"type":"PLN","symbol":"zł"}
    ,{"type":"RUB","symbol":"₽"}
    ,{"type":"RON","symbol":"lei"}
    ,{"type":"SEK","symbol":"kr"}
    ,{"type":"TRY","symbol":"₺"}
    ,{"type":"UAH","symbol":"₴"}
    ,{"type":"ILS","symbol":"₪"}
    ,{"type":"NGN","symbol":"₦"}
    ,{"type":"ZAR","symbol":"R"}
    ,{"type":"BRL","symbol":"R$"}
    ,{"type":"CAD","symbol":"$"}
    ,{"type":"CLP","symbol":"$"}
    ,{"type":"COP","symbol":"$"}
    ,{"type":"MXN","symbol":"$"}
    ,{"type":"PEN","symbol":"S/."}
    ,{"type":"AUD","symbol":"$"}
    ,{"type":"BDT","symbol":"৳"}
    ,{"type":"IDR","symbol":"Rp"}
    ,{"type":"INR","symbol":"₹"}
    ,{"type":"JPY","symbol":"¥"}
    ,{"type":"MYR","symbol":"RM"}
    ,{"type":"NZD","symbol":"$"}
    ,{"type":"SC","symbol":"Sweep coins"}    
    ]
    }';
    $jsonArray = json_decode($JsonContent, true);
    $search = $CurrencySign;
    foreach ($jsonArray["currency"] as $singleData) {
    if ($search == $singleData["type"]) {
    return $singleData["symbol"];
    }
    }
}
function FormatCurrency($symbol, $price)
{
    $country = $_COOKIE["wp-country"];
    $content = array (
    "FR",
    "DE",
    "ES",
    "NO",
    "FI",
    "DK",
    "GL",
    "FO",
    "SE",
    "AX",
    "BE",
    "LT",
    "LV",
    "SJ",
    "SX",
    "SS"
    );
    if($symbol=='Sweep coins'){
        return $price .' '. $symbol;
    }else{
        if(in_array($country,$content)){
        return $price . $symbol;
        }else{
        return $symbol . $price;
        }
    }
}


add_filter('the_title', 'ctl_filter_wpseo_title');
add_filter('wpseo_opengraph_title', 'ctl_filter_wpseo_title');
add_filter('wpseo_title', 'ctl_filter_wpseo_title');
function ctl_filter_wpseo_title($title) {
   
        $title = do_shortcode($title);
    
    return $title;
}

add_filter('wpseo_opengraph_desc', 'ctl_filter_wpseo_desc');
add_filter('wpseo_metadesc', 'ctl_filter_wpseo_desc');
function ctl_filter_wpseo_desc($desc) {
   
        $desc = do_shortcode($desc);
    
    return $desc;
}
//Stop json+ld output of yoast seo
add_filter('wpseo_json_ld_output','wpseo_json_ld_output');
function wpseo_json_ld_output()
{
    return false;
}

//Show plublished date from wpseo
add_filter('wpseo_opengraph_show_publish_date','ctl_wpseo_opengraph_show_publish_date');
function ctl_wpseo_opengraph_show_publish_date($return)
{
    global $post;
    if(!empty($post->ID))
    {
        $show_published_date=get_field('show_published_date_in_opengraph',$show_published_date);
        if(!empty($show_published_date))
            $return=true;
    }

    return $return;
}

//Show modified dat from seo
function remove_modifiedtime_presenter( $presenters ) {
    global $post;
    if(!empty($post->ID))
    {
        $show_modified_date=get_field('show_modified_date_in_opengraph',$post->ID);
        if(!empty($show_modified_date)){

            return array_map( function( $presenter ) {
                if ( ! $presenter instanceof Yoast\WP\SEO\Presenters\Open_Graph\Article_Modified_Time_Presenter ) {
                    return $presenter;
                }
            }, $presenters );

        }
    }
    
}

add_action( 'wpseo_frontend_presenters', 'remove_modifiedtime_presenter' );

//Filter permalinks to remove trailing slash for seo
add_filter('wpseo_opengraph_url','remove_trailing_slash_from_url');
add_filter('wpseo_canonical','remove_trailing_slash_from_url');
//add_filter('the_permalink','remove_trailing_slash_from_url');
//Filter all post type
foreach ( [ 'post', 'page','post_type' ] as $post_type ) {
    add_filter( $post_type . '_link', 'remove_trailing_slash_from_url', 99, 2 );
}
function remove_trailing_slash_from_url($url)
{
    return untrailingslashit($url);
}
add_filter('pll_check_canonical_url','remove_trailing_slash_from_polylang_home_url',10,2);
 function remove_trailing_slash_from_polylang_home_url($redirect_url, $language)
 {
    if(pll_default_language()!==pll_current_language() && $redirect_url==pll_home_url())
    return untrailingslashit($redirect_url);

    return $redirect_url;
 }

//for locale support,specifically during API call
add_filter('wp_date','ctl_date_locale_support',999,4);
function ctl_date_locale_support($date, $format, $timestamp, $gmt){

    if(!function_exists('pll_languages_list')) return $date;

    $current_lang = $_COOKIE['pll_language']; //pll_current_language();
    $get_pll_locale = pll_languages_list(array('fields'=>'locale'));
    $get_pll_slug = pll_languages_list(array('fields'=>'slug'));

    $pll = array_combine($get_pll_slug,$get_pll_locale);
    $locale = $pll[$current_lang];
    

    $Locale_Switcher=new WP_Locale_Switcher();
    $Locale_Switcher->switch_to_locale($locale);

    global $wp_locale;
    
    if ( null === $timestamp ) {
        $timestamp = time();
    } elseif ( ! is_numeric( $timestamp ) ) {
        return false;
    }
 
    if ( ! $timezone ) {
        $timezone = wp_timezone();
    }
 
    $datetime = date_create( '@' . $timestamp );
    $datetime->setTimezone( $timezone );
 
    if ( empty( $wp_locale->month ) || empty( $wp_locale->weekday ) ) {
        $date = $datetime->format( $format );
    } else {
        // We need to unpack shorthand `r` format because it has parts that might be localized.
        $format = preg_replace( '/(?<!\\\\)r/', DATE_RFC2822, $format );
 
        $new_format    = '';
        $format_length = strlen( $format );
        $month         = $wp_locale->get_month( $datetime->format( 'm' ) );
        $weekday       = $wp_locale->get_weekday( $datetime->format( 'w' ) );
 
        for ( $i = 0; $i < $format_length; $i ++ ) {
            switch ( $format[ $i ] ) {
                case 'D':
                    $new_format .= addcslashes( $wp_locale->get_weekday_abbrev( $weekday ), '\\A..Za..z' );
                    break;
                case 'F':
                    $new_format .= addcslashes( $month, '\\A..Za..z' );
                    break;
                case 'l':
                    $new_format .= addcslashes( $weekday, '\\A..Za..z' );
                    break;
                case 'M':
                    $new_format .= addcslashes( $wp_locale->get_month_abbrev( $month ), '\\A..Za..z' );
                    break;
                case 'a':
                    $new_format .= addcslashes( $wp_locale->get_meridiem( $datetime->format( 'a' ) ), '\\A..Za..z' );
                    break;
                case 'A':
                    $new_format .= addcslashes( $wp_locale->get_meridiem( $datetime->format( 'A' ) ), '\\A..Za..z' );
                    break;
                case '\\':
                    $new_format .= $format[ $i ];
 
                    // If character follows a slash, we add it without translating.
                    if ( $i < $format_length ) {
                        $new_format .= $format[ ++$i ];
                    }
                    break;
                default:
                    $new_format .= $format[ $i ];
                    break;
            }
        }
 
        $date = $datetime->format( $new_format );
        $date = wp_maybe_decline_date( $date, $format );
    }
    return $date;
}


/*Remove hreflang attr from pageutils ,to merge it into polylang*/
add_action( 'init', 'ctl_plugin_override' );
function ctl_plugin_override()
{
    //Remove hreflang tag from page utils
    if(class_exists('PU_Frontend') && function_exists('pll_default_language'))
    {
        $PU_Frontend=PU()->frontend;
        remove_action( 'wp_head', array( $PU_Frontend, 'wp_head_href_lang' ) );
    }
}

/*Add x-default and page-utils custom attrs to hreflang for all pages for polylang*/
add_filter('pll_rel_hreflang_attributes','ctl_pll_rel_hreflang_attributes');
function ctl_pll_rel_hreflang_attributes($hreflangs)
{
    if(class_exists('PU_Frontend'))
    {
        global $post;  
        $default_lang=pll_default_language();
        $current_lang=pll_current_language();

        // Don't output anything on paged archives: see https://wordpress.org/support/topic/hreflang-on-page2
        // Don't output anything on paged pages and paged posts
        if ( is_paged() || ( is_singular() && ( $page = get_query_var( 'page' ) ) && $page > 1 ) ) {
            //return;
            
        }

        $supported_content_types = hreflang_tags_get_settings('hreflang_tags_content_types');
        $supported_post_types = isset($supported_content_types['post_type']) ? $supported_content_types['post_type'] : array();
        $supported_taxonomy = isset($supported_content_types['taxonomy']) ? $supported_content_types['taxonomy'] : array();
        $supported_lang_code_only = (array)hreflang_tags_get_settings('supported_lang_code_only');
        //$translations = wp_get_available_translations();

        if(is_singular())
        {
            //Check  for page utils settings
            if(!empty($post->post_type) && !in_array($post->post_type,$supported_content_types['post_type']))
            return array();
            $enabled_hreflang=get_post_meta($post->ID,'enabled_hreflang',true);
            if(empty($enabled_hreflang))
                return array();
        }

        $hreflang_attributes = array();

        if ( is_category() || is_tax() || is_tag() ) {
            $term = get_queried_object();
            if( $term && in_array( $term->taxonomy, $supported_taxonomy ) ){
                $hreflang_attributes = get_pu_post_href_lang_data( $term, 'taxonomy', true );
            }
        }elseif((is_front_page() || is_home() ) && $post && in_array( $post->post_type, $supported_post_types ) ) {
                        
            $hreflang_attributes = get_pu_post_href_lang_data( $post, 'post', false, true );

        }elseif( $post && in_array( $post->post_type, $supported_post_types ) ) {            
            
            $hreflang_attributes = get_pu_post_href_lang_data( $post, 'post', true );
        }

        $hreflang_attributes = apply_filters( 'pu_rel_hreflang_attributes', $hreflang_attributes );

        //x-default set by plugin
        if( !check_has_default_hreflang_site_url() || hreflang_tags_get_settings('enable_x_default') == 'enabled' ) {
            $x_default=hreflang_tags_get_settings('default_domain_x_default');
            if(is_singular())
            {
                $hreflang_tags_supported_post_slug=get_post_meta($post->ID,'hreflang_tags_supported_post_slug',true);
                

                if(!empty($hreflang_tags_supported_post_slug['x-default']))
                    $x_default=untrailingslashit($x_default).'/'.$hreflang_tags_supported_post_slug['x-default'];

                if($default_lang!=$current_lang && $post->post_type!='post')
                {
                    $default_lang_post_id=pll_get_post($post->ID, $default_lang);
                    $x_default=get_the_permalink($default_lang_post_id);
                    /*$hreflang_tags_supported_post_slug=get_post_meta($default_lang_post_id,'hreflang_tags_supported_post_slug',true);*/

                }
            }
            $hreflang_attributes['x-default'] =$x_default;
        }
        
        $hreflangs=array_merge($hreflangs,$hreflang_attributes);
    }

    if(!array_key_exists('x-default',$hreflangs))
        $hreflangs['x-default'] =function_exists('pll_home_url')?pll_home_url(pll_default_language()):home_url( '/' );
    
    //Remove trail slash from url's
    foreach($hreflangs as $key=>$hreflang)
    {
        $hreflangs[$key]=untrailingslashit($hreflang);
    }

    return $hreflangs;
}
/*Add x-default and page-utils custom attrs to hreflang for all pages for polylang*/

// Disable REST API link tag
remove_action('wp_head', 'rest_output_link_wp_head', 10);

//Change lang attribute for spanish lang for html tag
/*add_filter('language_attributes','ctl_language_attributes',10,2);
function ctl_language_attributes($output,$doctype)
{
    return str_replace("es-ES","es",$output);
}*/

/*Get translation for specific key*/
function ctl_get_translated_str($key='',$lang='option')
{
    
    if(empty($key) || empty($lang))return;

    $upload_dir=wp_upload_dir();
    $translations=false;
    $args = array();
    if(file_exists($upload_dir['basedir'].'/translations.json')){    
        
          $translations=stripslashes(file_get_contents($upload_dir['basedir'].'/translations.json'));   
          $translations=json_decode($translations,true);
          if(!empty($translations[$lang][$key]))
            return $translations[$lang][$key];
    }

    return false;

}
/*Get translation for specific key*/

/*
===============================
DELETE TRANSIENT CACHE FOR HEADER API AFTER MENU AND THEME OPTION SAVE
===============================
*/
add_action('wp_update_nav_menu', 'ctl_on_menu_update_clear_header_api_cache');
function ctl_on_menu_update_clear_header_api_cache($nav_menu_selected_id) {
   
    $all_langs=array();
    $languages=function_exists('pll_the_languages')?get_terms('language'):false;

    if(!empty($languages)){
        foreach($languages as $lang)
            $all_langs[]=$lang->slug;        
    }

    $all_langs=array_merge($all_langs,array('option','options'));        
    foreach($all_langs as $lang)
    {
        delete_transient('ctl_header_api_'.$lang);
    }
     
}

function ctl_on_options_update_clear_header_api_cache($post_id) { 

    $all_langs=array();
    $languages=function_exists('pll_the_languages')?get_terms('language'):false;

    if(!empty($languages)){
        foreach($languages as $lang)
            $all_langs[]=$lang->slug;        
    }

    $all_langs=array_merge($all_langs,array('option','options'));
    if(in_array($post_id,$all_langs)){
        
        foreach($all_langs as $lang)
        {
            delete_transient('ctl_header_api_'.$lang);
        }
    }
    
    
   
}
add_action('acf/save_post', 'ctl_on_options_update_clear_header_api_cache', 20);

/*
===============================
DELETE TRANSIENT CACHE FOR HEADER API AFTER MENU AND THEME OPTION SAVE
===============================
*/


/*Sync lang cookie on load*/
add_action('wp_head','set_pll_current_language_on_load',1);
function set_pll_current_language_on_load()
{
if(function_exists('pll_current_language') && !empty($_COOKIE['pll_language']) && $_COOKIE['pll_language']!=pll_current_language()){
?>
<script type="text/javascript">document.cookie = "pll_language=<?php echo pll_current_language();?>";</script>
<?php
}

}
/*Sync lang cookie on load*/
function ContentUrlToLocalPath($url){
    return str_replace( 
      wp_get_upload_dir()['baseurl'], 
      wp_get_upload_dir()['basedir'], 
      $url
  );
}
function ctl_is_svg($url)
{
    if(pathinfo($url)['extension']=='svg')
    {
        
        $path=ContentUrlToLocalPath($url);
       
        /*$enable_auth=get_option('enable_auth');       
        if(!empty($enable_auth))
        {        
            $auth_username=get_option('auth_username');
            $auth_password=get_option('auth_password');
            $auth = base64_encode("$auth_username:$auth_password");            
            $context = stream_context_create([
            "http" => [
                "header" => "Authorization: Basic $auth"
                ]
            ]);
            //$svg_content=file_get_contents(/*$url, false, $context);
            $svg_content=file_get_contents($path, false, $context);
            
        }
        else
            $svg_content=file_get_contents($url);*/
        $svg_content=file_get_contents($path);       
        preg_match("#viewbox=[\"']\d* \d* (\d*) (\d*)#i", $svg_content, $d);
        $width = $d[1];
        $height = $d[2];
        if(!empty($width) && !empty($height))
            return array('width'=>$width,'height'=>$height);
        else
            return array('width'=>'100%','height'=>'100%');
    }
    else{
        return false;
    }
}

function ctl_add_img_size($content){
  $pattern = '/<img [^>]*?src="(https?:\/\/[^"]+?)"[^>]*?>/iu';
  preg_match_all($pattern, $content, $imgs);
  foreach ( $imgs[0] as $i => $img ) {
    if ( false !== strpos( $img, 'width=' ) && false !== strpos( $img, 'height=' ) ) {
      continue;
    }
    $img_url = $imgs[1][$i];
    //$img_size = @getimagesize( $img_url );
    $path=ContentUrlToLocalPath($img_url);
    $img_size = @getimagesize( $path );
      
    if ( false === $img_size ) {
      continue;
    }
    $replaced_img = str_replace( '<img ', '<img ' . $img_size[3] . ' ', $imgs[0][$i] );
    $content = str_replace( $img, $replaced_img, $content );
  }
  return $content;
}


function gb_gutenberg_admin_styles() {
    echo '
        <style>
            /* Main column width */
            .wp-block {
                max-width: 720px;
            }
 
            /* Width of "wide" blocks */
            .wp-block[data-align="wide"] {
                max-width: 1080px;
            }
 
            /* Width of "full-wide" blocks */
            .wp-block[data-align="full"] {
                max-width: none;
            }   
        </style>
    ';
}
add_action('admin_head', 'gb_gutenberg_admin_styles');


/*Preffered Payment option*/
function acf_load_color_field_choices( $field ) {

     global $wpdb;
    $sql="SELECT id,name from {$wpdb->prefix}CAS_payment_options";
    $payment_options=$wpdb->get_results($sql);
    
    if( is_array($payment_options) ) {
        $choices = array();
        foreach( $payment_options as $choice ) {
            $choices[ $choice->id ] = $choice->name;
        }
    }
    
    // reset choices
    $field['choices'] = array();
    
    // loop through array and add to field 'choices'
    if( is_array($choices) ) {
        $field['choices'][ 0 ] = 'No Prefference';
        foreach( $choices as $key => $choice ) {
            $field['choices'][ $key ] = $choice;
        }
    }

    natcasesort($field['choices']);
    // return the field
    return $field;
}

add_filter('acf/load_field/name=preferred_payment_option', 'acf_load_color_field_choices');

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