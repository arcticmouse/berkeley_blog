<?php
/**
 * @package Alien Ship
 * @since Alien Ship 0.1
 */
do_action( 'alienship_post_before' ); ?>
<article role="article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	do_action( 'alienship_post_top' );
	do_action( 'alienship_entry_header' );
	get_template_part('/templates/parts/post', 'metadata');
	do_action( 'alienship_entry_content_before' );
	?>
	<div class="entry-content">
		<?php

		// On archive views, display post thumbnail, if available, and excerpt.
		if ( ! is_singular() ) {

			if ( has_post_thumbnail() ) { ?>

				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Link to %s', 'alienship' ), the_title_attribute( 'echo=0' ) ); ?>">
					<?php echo get_the_post_thumbnail( $post->ID, 'post-thumbnail', array( 'class' => 'alignleft', 'title' => "" ) ); ?>
				</a>
			<?php
			} // has_post_thumbnail()
			the_excerpt();

		} else {
			the_content();
		}

		wp_link_pages(); ?>
	</div><!-- .entry-content -->
	<?php
	do_action( 'alienship_entry_content_after' );
	do_action( 'alienship_post_bottom' );
	?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php do_action( 'alienship_post_after' ); ?>