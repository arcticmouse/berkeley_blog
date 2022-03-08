<?php
//display post author and meta information above title

$author_name = get_the_author_meta( 'first_name', get_the_author_id() ) . ' ' . get_the_author_meta( 'last_name', get_the_author_id() );
$author_title = get_the_author_meta( 'nickname', get_the_author_id() );
$author_url = '/author/' . get_the_author_meta( 'user_nicename', get_the_author_id() );

?>
<section id="post-metadata">
<p>
<a href="<?php echo $author_url; ?>" /><?php echo $author_name;?></a><?php echo ', ' . $author_title; ?> | <?php the_date(); ?>
</p>
<p><a href="#comments" /><?php comments_number( 'No comments', 'One comment', '% comments' ); ?></a> | <a href="#respond" />Leave a comment</a></p>
<?php edit_post_link(); ?>
</section>