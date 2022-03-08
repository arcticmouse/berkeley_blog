<?php
/* Template Name: What's On Your Mind */

get_header(); 
if ( is_user_logged_in() && ( current_user_can('author') || current_user_can('editor') || current_user_can('administrator') )) {
?>
<header class="entry-header">
	<?php the_title( sprintf( '<h1 class="entry-title">', '</h1>' ) ); ?>

	<?php if( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php alienship_posted_on(); ?>
		</div>
	<?php endif; ?>
</header>

<div class="container">
    <div class="row write_a_post">
    	<div class="col-xs-6 category">Culture & Humanities</div>
        <div class="col-xs-6 link"><a href="/wp-admin/post-new.php?cat=3">Write a post</a></div>
        <hr class="col-xs-12" />
    	<div class="col-xs-6 category">Economics</div>
        <div class="col-xs-6 link"><a href="/wp-admin/post-new.php?cat=4">Write a post</a></div>
        <hr class="col-xs-12" />
    	<div class="col-xs-6 category">Environment</div>
        <div class="col-xs-6 link"><a href="/wp-admin/post-new.php?cat=5">Write a post</a></div>
        <hr class="col-xs-12" />
    	<div class="col-xs-6 category">Mind & Body</div>
        <div class="col-xs-6 link"><a href="/wp-admin/post-new.php?cat=6">Write a post</a></div>
        <hr class="col-xs-12" />
    	<div class="col-xs-6 category">Politics & Law</div>
        <div class="col-xs-6 link"><a href="/wp-admin/post-new.php?cat=7">Write a post</a></div>
        <hr class="col-xs-12" />
    	<div class="col-xs-6 category">Science & Technology</div>
        <div class="col-xs-6 link"><a href="/wp-admin/post-new.php?cat=8">Write a post</a></div>
        <hr class="col-xs-12" />
    	<div class="col-xs-6 category">Other</div>
        <div class="col-xs-6 link"><a href="/wp-admin/post-new.php?cat=108">Write a post</a></div>                                                
    </div>
</div>

</div><!-- #content -->

<?php 
} else {
	get_404_template();
}

get_footer(); ?>