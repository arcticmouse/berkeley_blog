<?php
/**
 * @package Alien Ship
 * @since Alien Ship 0.1
 */

	do_action( 'alienship_post_before' ); 
	do_action( 'alienship_post_top' );

		// On archive views, display as collapsible bootstrap accordion panels, and excerpt.
		if ( ! is_singular() ) {

			$id = get_the_id();
			
		// 'aside' format is accordion alias
?>
                <div class="panel panel-default">
		            <div class="panel-heading">
                    	<h4 class="panel-title">

<?php
					do_action( 'alienship_accordion_header' );
?>
						</h4>
		            </div>
        		    <div id="collapse-<?php echo $id; ?>" class="panel-collapse collapse">
                		<div class="panel-body">
<?php
		                    the_excerpt();
?>
                        </div>
        		    </div>
		        </div>
<?php
			
		} else {
?>
<article role="article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	do_action( 'alienship_entry_header' );
	do_action( 'alienship_entry_content_before' );
	?>
	<div class="entry-content">
    <?php
		// On singular views, display post thumbnails in the post body if it's not big enough to be a header image
			$header_image = alienship_get_header_image( get_the_ID() );
			if ( has_post_thumbnail() && 'yes' != $header_image['featured'] ) { ?>

				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Link to %s', 'alienship' ), the_title_attribute( 'echo=0' ) ); ?>">
					<?php echo get_the_post_thumbnail( $post->ID, 'post-thumbnail', array( 'class' => 'alignright', 'title' => "" ) ); ?>
				</a>
			<?php
			}

			the_content();
?>
	</div><!-- .entry-content -->
<?php

		wp_link_pages(); ?>
	<?php
		do_action( 'alienship_entry_content_after' );
	?>
    </article>
    <?php
		}
	do_action( 'alienship_post_bottom' );
	?>
<?php do_action( 'alienship_post_after' ); ?>