<?php
/**
 * Template Name: Homepage Template
 * The template for displaying full-width Hero pages.
 * Doesnt have a Hero
 * @package Alien Ship
 * @since Alien Ship 0.2
 */

get_header('hero-band-web-founders-rock'); ?>
        
        <section class="top_homepage"><?php
		
			do_action( 'alienship_loop_before' );
			?><div class="col-xs-12 col-lg-9"><div class="row-fluid"><?php
			
			
			$args = array(
				'posts_per_page' => 5,
				'orderby' => 'date',
				'order' => 'DESC',
			);
			$recent_posts = new WP_Query($args);
			
			if ( $recent_posts->have_posts() ) {
				?><div class="hidden-xs"><?php
					get_template_part('/templates/parts/featured', 'homepage');
				?></div><?php //}
				while ( $recent_posts->have_posts() ) {
					$recent_posts->the_post(); 
						?>
						<div class="homepage_recent_post">
							<div class="blogs_recent_post_title">
								<a href="<?php the_permalink(); ?>" >
									<h2><?php the_title(); ?></h2>
								</a>
							</div><!--post title-->
							<div class="blogs_recent_post_meta">
								<span>
									<a href="<?php echo esc_url( '/author/' . get_the_author_meta( 'user_nicename' ) ); ?>">
											<?php  
												echo esc_html_e( get_the_author_meta( 'first_name' ) . ' ' . get_the_author_meta( 'last_name' ) . ', ' . get_the_author_meta( 'nickname' ) . ' | ', 'textdomain' );
											?>
									</a><?php echo esc_html_e( get_the_date(), 'textdomain' ); ?>
								</span> 
							</div><!--post meta-->
							<div class="blogs_recent_post_excerpt">
								<p><?php the_excerpt(); ?></p>
							</div><!-- post excerpt -->
						</div>
						<?
                        
                } // end while
				
				//if ($recent_posts->current_post == 0) { 
				?><div class="col-xs-12 visible-xs"><?php
					get_template_part('/templates/parts/featured', 'homepage');
				?></div><?php //}
            } // end if
			
			
			
			?></div></div><?php
		get_sidebar();
		?></section><!--row top_homepage--><?php
		?>
	</div><!-- /container -->

<div id="hero-widgets-container" class="widget widget-area container-fluid" role="complementary">
	<?php
	do_action( 'before_sidebar' );
	if ( is_front_page() || is_home() || is_page( 'home' )) alienship_do_sidebar( 'herowidgets' ); 
	?>
</div>

<?php get_footer(); ?>