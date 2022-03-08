<?php
/**
 * The template used to load the Top Navbar Menu in header*.php
 *
 * @package Alien Ship
 * @since Alien Ship 0.70
 */
?>
<!-- Top Menu -->
	<div class="<?php echo apply_filters( 'alienship_top_navbar_class' , 'navbar navbar-default top-navigation' ); ?>" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php if (of_get_option('alienship_name_in_navbar',1) ) { ?>
				<a class="navbar-brand" href="berkeley.edu" target="_blank">UC Berkeley</a>
			<?php } ?>
		</div>

		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<?php wp_nav_menu( array(
				'theme_location' => 'top',
				'depth'          => 2,
				'container'      => false,
				'menu_class'     => 'nav navbar-nav',
				'walker'         => new wp_bootstrap_navwalker(),
				'fallback_cb'    => 'wp_bootstrap_navwalker::fallback'
				)
			);

			if ( of_get_option( 'alienship_search_bar', '1' ) ) { ?>
				<?php get_search_form(); ?>
			<?php } ?>

		</div>
	</div>
<!-- End Top Menu -->
