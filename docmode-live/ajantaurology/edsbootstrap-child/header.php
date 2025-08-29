<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package edsBootstrap
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!-- <link rel="stylesheet" href="style.css"> -->
<!-- <script src="js/manisha.js"></script> -->
<?php
    $coursetitle = $wp_query->get( 'cust_course_name' );
?>


<?php wp_head(); ?>
    <style>
        body{
            font-family: 'Muli',sans-serif;
        }

        .label{
            color: #000;
            font-size: 16px;
            font-weight: 600;
            padding:0px;
            margin-top: -20px;
        }

        .form_element_new{
            height: 40px !important;
            width: 100% !important;
            background: #fff !important;
            border: none !important;
            border: 1px #787878 solid !important;
            color: #222 !important;
            font-size: 17px;
            font-weight: normal !important;
            border-radius: 10px;
            padding: 10px;
            margin-bottom:20px;
        }

        span.wpcf7-not-valid-tip {
            font-size: 15px;
            font-weight: 600;
            text-align: left !important;
        }

        .wpcf7 form.sent .wpcf7-response-output {
            border-color: #36883d;
            color: #36883d;
            font-size: 18px !important;
            font-family: "Calibri";
        }

        .wpcf7 form.invalid .wpcf7-response-output, .wpcf7 form.unaccepted .wpcf7-response-output {
            border-color: #b3634a;
            color: #b3634a;
            font-size: 15px !important;
        }

        div#otp_login_form label, button, input {
            width: unset; 
            margin-bottom: 20px;
        }

        #navigation {
            padding: 15px 0;
            border-bottom: 1px solid;
        }
    </style>
</head>
<body <?php body_class(); ?> onload="checkCookie()">
<?php
	$edsbootstrap_options = get_theme_mod( 'edsbootstrap_theme_options' );
?>
<!-- Preloader -->
<!--<div id="preloader">
    <div class="loader"></div>
</div>-->
<!-- /Preloader -->
<!-- Header -->
<header id="home" class="header">
    <!-- Navigation -->
    <nav id="navigation" class="navbar affix">
		<?php if( get_theme_mod( 'edsbootstrap_theme_options_contact_info','0') == 1 ||  get_theme_mod( 'edsbootstrap_theme_options_socialheader','0') == 1):?>  
        <!-- Company Information -->
        <div class="information hidden-sm hidden-xs">
            <div class="container">
                <div class="row">
                	<!-- Feedback -->
					<?php if( get_theme_mod( 'edsbootstrap_theme_options_contact_info','0') == 1 ):?>   
                    <div class="col-md-7">
                    	<?php foreach ($edsbootstrap_options['info'] as $key => $info):?>
                            <span><i class="icon <?php echo esc_html($key);?>"></i> <?php echo esc_html( $info );?></span>
                        <?php endforeach;?>
                    </div>
                    <?php endif; ?>
                    <!-- /Feedback -->
					<?php if( get_theme_mod( 'edsbootstrap_theme_options_socialheader','0') == 1 ):?> 
                    <!-- Social -->
                    <div class="col-md-5 pull-right">
                        <ul class="social">
                         <?php foreach ($edsbootstrap_options['social'] as $key => $social):?>
                            <li><a href="<?php echo esc_url( $social );?>" class="fa fa-fw <?php echo esc_html($key);?>" target="_blank"></a></li>
                          <?php endforeach;?>
                        </ul>
                    </div>
                    <!-- /Social -->
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- /Company Information -->
		<?php endif; ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Navigation Header -->
                    <div class="navbar-header">
                        <!-- Toggle Button -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu" aria-expanded="false" aria-controls="main-menu">
                            <span class="sr-only"><?php esc_html_e('Toggle Navigation', 'edsbootstrap'); ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- /Toggle Button -->
                        <!-- Brand -->
                         <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"> 
							<?php
                            if (has_custom_logo()) {
                                 the_custom_logo();
                            } else { ?>
                                <h1 class='logo_text'><?php bloginfo( 'name' ) ?></h1>
                                <?php
                                $description = get_bloginfo( 'description' );
                                if ( $description ) {
                                    echo  '<p class="site-description">' . esc_attr( $description ) . '</p>' ;
                                }
                            }
                            ?>
                       </a>
                        <!-- /Brand -->
                    </div>
                    <!-- /Navigation Header -->
                    <!-- Navigation -->
					<?php
                    // echo '<img class="img-fluig class_062920220223" src="https://lifecare.docmode.org/wp-content/uploads/2022/06/LIFECARE-BIOSCIENCES-logo.png" style="float: right;margin-left: 30px;margin: 10px 20px;width:150px">';
                        wp_nav_menu( array(
                            'theme_location'    => 'primary',
                            'depth'             => 3,
                            'container'         => 'div',
                            'container_class'   => 'navbar-collapse collapse',
                            'container_id'      => 'main-menu',
                            'menu_class'        => 'nav navbar-nav navbar-right',
                            'fallback_cb'       => 'edsbootstrap_bootstrap_navwalker::fallback',
                            'walker'            => new edsbootstrap_bootstrap_navwalker())
                        );
                    ?>
                    <!-- /Navigation -->
                </div>
            </div>
        </div>
    </nav>
    <!-- /Navigation -->
</header>
<!-- /Header -->