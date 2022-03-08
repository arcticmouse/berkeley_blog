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

<!--
Start of DoubleClick Floodlight Tag: Please do not remove
Activity name of this tag: UCB001CP Retargeting
URL of the webpage where the tag is expected to be placed: http://unknown
This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
Creation Date: 02/01/2017
-->
<script type="text/javascript">
var axel = Math.random() + "";
var a = axel * 10000000000000;
document.write('<iframe src="https://6492375.fls.doubleclick.net/activityi;src=6492375;type=retar0;cat=ucb000;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
</script>
<noscript>
<iframe src="https://6492375.fls.doubleclick.net/activityi;src=6492375;type=retar0;cat=ucb000;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
</noscript>
<!-- End of DoubleClick Floodlight Tag: Please do not remove -->

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
		 	$heading = is_front_page() ? 'h2' : 'h1'; 
			$section_class = is_front_page() ? 'homepage-header' : 'page-header'; 
	?>
          <section class="<?php echo $section_class .' ' .  'web-founders-rock'; ?>" >
          <div class="container">
          <?php 
		  	echo '<'.$heading.'>';
			if ( is_front_page() ) {
				echo "Campus scholars' perspectives on topical issues &mdash; in conversation with you";
			} elseif ( is_single() ) {
				$post_cat = get_the_category();
				if (!empty($post_cat[0]->category_parent)) {
					echo get_the_category_by_ID($post_cat[0]->category_parent);
				} else {
					echo $post_cat[0]->name;
				}
			} elseif ( is_category() ) {
				single_cat_title();
				echo ' <a class="rss" href="' . $_SERVER['REQUEST_URI'] . 'feed/"><span class="entypo rss"></span>RSS</a>';
			} elseif ( have_posts() )	{
		  		echo get_post()->post_title; 
			} 
			echo '</'.$heading.'>'; 
		  ?>
          </div>
        </section>
        
        <div class="container">
                    <div class="row">
    
			<?php /*if ( function_exists( 'breadcrumb_trail' ) && !is_front_page() )
                breadcrumb_trail( array(
                    'container'   => 'div',
                    'separator'   => '/',
                    'show_browse' => false
                    )
                );*/


