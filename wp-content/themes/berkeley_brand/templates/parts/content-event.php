<?php
/**
 * The template for displaying Event post type
 *
 * @package Alien Ship
 * @since Alien Ship 0.64
 */

do_action( 'alienship_post_before' ); ?>
<article role="article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'alienship_post_top' ); ?>

	<header class="entry-header">
		<h2 class="entry-title">
			<a class="entry-title zoomable-thumbnail" title="<?php printf( esc_attr__( 'Link to %s', 'alienship' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
	</header><!-- .entry-header -->

	<?php do_action( 'alienship_entry_content_before' ); ?>
	<div class="entry-content">
    <?php
		// On archive views, display post thumbnail, if available, and excerpt.

			if ( has_post_thumbnail() ) { ?>

				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Link to %s', 'alienship' ), the_title_attribute( 'echo=0' ) ); ?>">
					<?php echo get_the_post_thumbnail( $post->ID, 'post-thumbnail', array( 'class' => 'alignleft', 'title' => "" ) ); ?>
				</a>
			<?php
			} // has_post_thumbnail()


			the_content();

		wp_link_pages(); ?>
	</div><!-- .entry-content -->
	<?php
	do_action( 'alienship_entry_content_after' );
	//do_action( 'alienship_entry_footer' );
	do_action( 'alienship_post_bottom' );
	?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php do_action( 'alienship_post_after' ); ?>