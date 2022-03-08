<?php
/**
 * Template Name: All Author Photos
 * The template for displaying all author photos au naturale.
 *
 */

get_header(); ?>
	<div class="container">
		<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post(); 

			$args = array(
				'fields' => 'id'
			);
			$users = get_users($args);
			
			foreach($users as $user){
				echo '<div class="col-xs-6 author_photos_au_natural">';
				echo '<hr /><br />';
				echo esc_html_e( get_the_author_meta( 'first_name', $user ) . ' ' . get_the_author_meta( 'last_name', $user ), 'textdomain' ) . '<br>';
				userphoto($user);
				echo '<br /><hr />';
				echo '</div>';
			}
		endwhile; else : ?>
            <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
        <?php 
		endif; 
		?>
	</div><!-- /container -->

<div id="hero-widgets-container" class="widget widget-area container" role="complementary">
	<?php
	do_action( 'before_sidebar' );
	if ( is_front_page() || is_page( 'Home' ) || is_page( 'home' )) alienship_do_sidebar( 'herowidgets' ); 
	?>
</div>

</div><!-- #content -->

<?php get_footer(); ?>