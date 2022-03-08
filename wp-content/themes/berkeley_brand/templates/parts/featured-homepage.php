<?php
/**
 * @package Alien Ship
 * @since Alien Ship 0.1
 */
 //get data for featured post
 
 $featured_post = getHomepageFeaturedPost();
 $featured_comment = getHomepageFeaturedComment();

 if ( is_object($featured_post) || is_object($featured_comment) ) {
?>
<div class="col-sm-4 alignleft">
	<!--featured post-->
    <?php if( $featured_post !== false ) { ?>
        <div class="block promo <?php if ( $featured_post->image[0] == "" ) { echo 'no-image'; } ?> solid-background <?php echo esc_html_e( $featured_post->color, 'textdomain' ); ?>">
            <a href="<?php echo esc_html_e($featured_post->permalink, 'textdomain' ); ?>">
                <div class="thumbnail">
                    <?php if ( $featured_post->image[0] != "" ) { ?>
                    <img src="<?php echo esc_html_e($featured_post->image[0], 'textdomain' ); ?>" />
                    <?php } ?>
                </div>
                <div class="caption"><div class="caption-inner">
                    <h3><?php echo esc_html_e( $featured_post->title, 'textdomain' ); ?></h3>
                    by <?php echo esc_html_e( get_the_author_meta( 'first_name', $featured_post->author ) . ' ' . get_the_author_meta( 'last_name', $featured_post->author ) ); ?>
                </div></div>
            </a>
        </div>
    <?php } ?>
    <!--feautured quote-->
    <?php if( $featured_comment !== false ) { ?>
        <div class="block quote solid-background <?php echo esc_html_e( $featured_comment->color, 'textdomain'); ?>">
            <div class="header">A reader weighs in on:</div>
            <div class="caption">
                <a href="<?php echo esc_html_e($featured_comment->parent_permalink, 'textdomain' ); ?>" />
                <div class="quotetitle"><?php echo esc_html_e( get_the_title($featured_comment->parent_post), 'textdomain' ); ?></div>
				<div class="quotename"><?php echo esc_html_e( $featured_comment->author . ' said:', 'textdomain'); ?></div>
                <blockquote><?php echo esc_html_e( $featured_comment->quote, 'textdomain' ); ?>...</blockquote>
                </a>
            </div>
        </div>
    <?php } ?>
</div>
<?php } ?>