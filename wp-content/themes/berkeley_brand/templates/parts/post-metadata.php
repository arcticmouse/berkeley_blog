<?php
//display post author and meta information above title

$author_name = get_the_author_meta( 'first_name', get_the_author_id() ) . ' ' . get_the_author_meta( 'last_name', get_the_author_id() );
$author_title = get_the_author_meta( 'nickname', get_the_author_id() );
$author_url = '/author/' . get_the_author_meta( 'user_nicename', get_the_author_id() );
$image_link = get_user_meta(get_the_author_id(), 'userphoto_thumb_file', true);
$image_url = !empty($image_link) ? '<div class="circular" style="background-image:url(../../../../wp-content/uploads/userphoto/' . $image_link .');"></div>' : '';
?>
<section id="post-metadata" class="row-fluid">
		<?php 
            if ($image_url != '') { 
                echo $image_url; 
            }
        ?>
    
    <a class="author-name" href="<?php echo $author_url; ?>" /><?php echo $author_name;?></a><?php echo ', ' . $author_title; ?> | <?php the_date(); ?>
	
    <div class="metadata_secondline">
        <p><?php if (!is_category()) { 
			?><a href="#comments" /><?php comments_number( '', 'One comment</a> | ', '% comments</a> | ' ); ?><a href="#respond" />Leave a comment</a><? } 
            else { ?>
            <a href="<?php echo get_permalink(); ?>#comments" /><?php comments_number( '', 'One comment', '% comments' ); ?></a>
            <?php } ?>
        </p>
    
		<?php
            if ( function_exists( 'sharing_display' ) ) {
                sharing_display( '', true );
            }
             
            if ( class_exists( 'Jetpack_Likes' ) ) {
                $custom_likes = new Jetpack_Likes;
                echo $custom_likes->post_likes( '' );
            }
        ?>
    </div>

    <?php edit_post_link(); ?>
</section>