<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up to <div id="content">
 *
 * @package Alien Ship
 * @since Alien Ship 0.1
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php get_template_part( '/templates/parts/meta' ); ?>
<title><?php wp_title( '&#8226;', true, 'right' ); ?></title>
<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js" type="text/javascript"></script><![endif]-->
<?php get_template_part( '/templates/parts/typekit'); ?>
<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600,700'>
<?php
wp_head();
do_action( 'alienship_head' ); ?>
<!--<script src="/wp-content/themes/alienship/js/bootstrap.min.js"></script>-->
</head>

<body <?php body_class(); ?>>
	<!--[if lt IE 9]><p class="browsehappy alert alert-danger">You are using an outdated browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

	<?php
	if ( of_get_option( 'alienship_show_top_navbar', 1 ) )
		get_template_part( '/templates/parts/menu', 'top' ); ?>
<a class="sr-only sr-only-focusable skip-to-content" href="#content">Skip to main content</a>
	<!--<div id="page" class="container hfeed site">-->

		<?php do_action( 'alienship_header_before' ); ?>
		<header id="site-header" class="light nav-right">
			<?php

			/**
			 * Display site title and description.
			 * Hooked in /inc/template-tags.php
			do_action( 'alienship_site_title' );
			do_action( 'alienship_site_description' );
			 */

			// Header image
			do_action( 'alienship_header_image' );

			// Main menu
			if ( has_nav_menu('main') ) {
				get_template_part( '/templates/parts/menu', 'main' );
			} ?>
		</header><!-- #masthead -->
		<?php do_action( 'alienship_header_after' );

	do_action( 'alienship_content_before' ); ?>

	<div id="content" class="site-content" role="main">
    
   <?php 
   		$hero_image_id = get_post_thumbnail_id($post->ID);
   		$url = wp_get_attachment_url($hero_image_id); 
		$caption = get_post($hero_image_id)->post_excerpt; 
		$background_color = get_post($hero_image_id)->be_background_color;
		$credit = get_post($hero_image_id)->be_photo_credit;
		$external_url = get_post($hero_image_id)->be_external_url;
		$subheading = get_post($hero_image_id)->be_subheading;  
   ?>

        <!-- 1-Story Hero -->
         <?php 
		 	$heading = is_front_page() ? 'h2' : 'h1'; 
			$section_class = is_front_page() ? 'homepage-hero' : 'page-header-hero'; 
		 ?>
		<?php // Customization for blogs.berkeley.edu
		if (strlen($external_url)>0) { ?>
        	<a href="<?php echo $external_url;?>"  class="home-hero-link">
        <?php } ?>
        <section class="<?php echo $section_class .' ' . $background_color;?>" style="background-image:url('<?php echo $url;?>');">
          
            <div class="container">
              <div class="caption">
                <div class="caption-inner">
                   <?php echo '<'.$heading.'>'.$caption .'</'.$heading.'>'; ?>  
                  <div class="caption-body">
                    <p><?php echo $subheading;?></p>
                  </div>
                </div>
              </div>
            </div><span class="credit"><?php echo $credit;?></span>
         
        </section>
		<?php // Customization for blogs.berkeley.edu
		if (strlen($external_url)>0) { ?></a><?php } ?>
        
        <div class="container">
                    <div class="row">
    
			<?php if ( function_exists( 'breadcrumb_trail' ) && !is_front_page() )
                breadcrumb_trail( array(
                    'container'   => 'div',
                    'separator'   => '/',
                    'show_browse' => false
                    )
                );


