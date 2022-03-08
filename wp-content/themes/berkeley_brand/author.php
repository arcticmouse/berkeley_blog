<?php
/**
 * The template for displaying Author pages.
 * The template for displaying full-width Hero pages.
 * <img src="<?php echo $thumbnail_url; ?>">
 */

get_header(); 

$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

$image_link = get_user_meta($curauth->ID, 'userphoto_image_file', true);
$img_url = isset($image_link) ? '../../wp-content/uploads/userphoto/' . $image_link : '';

$linkedin_full = get_user_meta($curauth->ID, 'linkedin', true);
if( !empty($linkedin_full) ) {
	$linkedin = ( strrpos($linkedin_full, '/') !== false ) ? $linkedin_full : 'https://www.linkedin.com/in/' . $linkedin_full;
}

$twitter_full = get_user_meta($curauth->ID, 'twitter', true);
if( !empty($twitter_full) ) {
	if ( strrpos($twitter_full, '@') !== false ) {
		$twitter = 'https://twitter.com/' . substr($twitter_full, strrpos($twitter_full, '@') + 1);
	} elseif ( strrpos($twitter_full, '/') !== false ) {
		$twitter = 'https://twitter.com/' . substr($twitter_full, strrpos($twitter_full, '/') + 1);
	} else {
		$twitter = 'https://twitter.com/' . $twitter_full;
	}
}

$social_links = '<div>';
$social_links .= !empty($curauth->user_url) ? '<a class="entypo home" href="'. $curauth->user_url . '"></a>' : '';
$social_links .= !empty($linkedin) ? '<a class="entypo linkedin" href="'. $linkedin . '"></a>' : '';
$social_links .= !empty($twitter) ? '<a class="entypo twitter" href="'. $twitter . '"></a>' : '';
$social_links .= '</div>';
?>
	<div class="container author-detail">
        <div class="row">
        
        <div class="col-sm-7">
            <div class="block profile profile-image-circle solid-background berkeley-blue">
              <?php if ($img_url != '') { ?>
                  <div class="thumbnail">
                    <div class="circular" style="background-image:url(<?php echo $img_url; ?>);"></div>
                  </div> <!--thumbnail-->
              <?php } ?>
              <div class="caption">
                  <div class="caption-inner">
                    <h1><?php echo $curauth->first_name . ' ' . $curauth->last_name; ?></h1>
            
                    <div class="profile-title">
                      <?php echo $curauth->nickname; ?>
                    </div>
                    <div class="profile-social">
                      <?php echo $social_links; ?>
                    </div>
                    
                  </div><!--caption inner-->
                </div><!--caption-->
            </div><!--block-->
            
            <div class="profile-description"><p><?php echo __($curauth->description, 'textdomain'); ?></p></div>
        </div><!--col-->
        
        <div class="col-sm-5">
        	<div class="title-posts"><h2><?php echo __('Posts by ' . $curauth->first_name . ' ' . $curauth->last_name, 'textdomain' ); ?></h2>
                <p><a class="entypo rss" href="<?php echo $_SERVER['REQUEST_URI']; ?>feed/">RSS</a></p>
            </div>
			<?php if ( have_posts() ) { ?>
                <div class="profile-posts">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="row-fluid">
                            <div class="col-xs-3 date"><?php the_time('m-d-y'); ?></div>
                            <div class="col-xs-3 category"><?php 
								$the_cat = get_the_category();
								$the_cat_parent = get_category($the_cat[0]->parent);
								echo '<a href="/category/' . $the_cat_parent->slug . '" />';
								echo str_replace( ": What's on your mind?", "", $the_cat[0]->name ); 
								echo '</a>';
							?></div>
                            <div class="col-xs-6 title"><a href="<?php the_permalink(); ?>" /><?php the_title(); ?></a></div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php } ?>
        </div>
        
        </div><!--row-->
	</div><!-- /container -->

</div><!-- #content -->

<?php get_footer(); ?>