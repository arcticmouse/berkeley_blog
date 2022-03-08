<?php
/**
 * The template used to load the Main Menu in header*.php
 *
 * @package Alien Ship
 * @since Alien Ship 0.70
 */
?>
<!-- Main menu -->
<div class="<?php echo apply_filters( 'alienship_main_navbar_class' , 'navbar navbar-default navbar-static-top yamm' ); ?>" role="navigation">
	<div class="container">
         	 <a href="http://berkeley.edu" class="home-link">UC Berkeley</a>           
<?php		do_action( 'alienship_site_title' );
			//do_action( 'alienship_site_description' ); ?>
            
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex2-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php if (of_get_option('alienship_name_in_navbar',1) ) { ?>
				<a class="navbar-brand" href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a>
			<?php } ?>
		</div>

		<div class="collapse navbar-collapse navbar-ex2-collapse" id="main-nav">
			<div id="tools-nav">
				<div class="container">
				
					<?php get_search_form(); ?>

				</div>
	      	</div>
			<nav id="primary-nav" role="navigation">
			<?php 
			wp_nav_menu( array(
				'theme_location' => 'main',
				'depth'          => 2,
				'container'      => false,
				'menu_class'     => 'nav navbar-nav',
				'walker'         => new wp_bootstrap_navwalker(),
				'fallback_cb'    => 'wp_bootstrap_navwalker::fallback'
				)
			);
			?>
			</nav><!-- #site-navigation -->
		</div>
	</div>
</div>
<!-- End Main menu -->
