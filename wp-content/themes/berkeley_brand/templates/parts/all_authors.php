<?php
//get all users who are authors, order by their last name, exclude a_guest
/*<div class="thumbnail"><?php userphoto_thumbnail($one_author->ID); ?></div>*/
$args = array(
	'meta_key' => 'last_name',
	'orderby' => 'meta_value',
	'order' => 'ASC',
	'role' => 'author'
);
$users = new WP_User_Query( $args );

if(!empty($users->results)){
	foreach ($users->results as $key=>$one_author) {
		if( (count_user_posts( $one_author->ID ) >= 1) && ($one_author->ID != 301) ) {
			$image_link = get_user_meta($one_author->ID, 'userphoto_thumb_file', true);
			$thumbnail_url = !empty($image_link) ? '<div class="circular" style="background-image:url(../wp-content/uploads/userphoto/' . $image_link . ');"></div>' : '';
			$description = truncateStringOnBoundary($one_author->user_description, 150);
			?>
			<div class="author">
            	<div class="top">
					<?php echo $thumbnail_url; ?>
                    <a href="<?php echo get_author_posts_url($one_author->ID); ?>" />
                        <div class="caption"><h3>
                            <?php echo $one_author->first_name . ' ' . $one_author->last_name; ?>
                        </h3></div>
                    </a>
                 </div>
                 <div class="middle"><p class="meta"><?php echo $one_author->nickname; ?></p></div>
                 <div class="bottom">
                    <p class="meta">
                        <?php echo closetags(truncateStringOnBoundary($one_author->user_description, 150)); ?>... <a href="<?php echo get_author_posts_url($one_author->ID); ?>" />Read more</a>
                    </p>
                 </div>
			</div>
			<?php
		}
	}
}
