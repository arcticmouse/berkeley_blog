<?php
/***********************************
add sub menu to admin side menu with links for users to add new posts to categories
************************************/
function new_post_by_category_only(){
	add_menu_page('Page title', 'Culture & Humanities', 'edit_published_posts', 'post-new.php?cat=3', '', 'dashicons-welcome-write-blog' );
	add_menu_page('Page title', 'Economics', 'edit_published_posts', 'post-new.php?cat=4', '', 'dashicons-welcome-write-blog' );
	add_menu_page('Page title', 'Environment', 'edit_published_posts', 'post-new.php?cat=5', '', 'dashicons-welcome-write-blog' );
	add_menu_page('Page title', 'Mind & Body', 'edit_published_posts', 'post-new.php?cat=6', '', 'dashicons-welcome-write-blog' );
	add_menu_page('Page title', 'Other', 'edit_published_posts', 'post-new.php?cat=108', '', 'dashicons-welcome-write-blog' );
	add_menu_page('Page title', 'Politics & Law', 'edit_published_posts', 'post-new.php?cat=7', '', 'dashicons-welcome-write-blog' );
	add_menu_page('Page title', 'Science & Technology', 'edit_published_posts', 'post-new.php?cat=8', '', 'dashicons-welcome-write-blog' );
	//add_menu_page('Page title', 'Uncategorized', 'edit_published_posts', 'post-new.php?cat=1', '', 'dashicons-welcome-write-blog' );
}

add_action( 'admin_menu', 'new_post_by_category_only' );



/***********************************
// remove theme layout options sidebar meta box in post for authors
***********************************/
function change_meta_boxes_for_authors(){
	//if ( current_user_can('author') || current_user_can('editor') ) {
		remove_meta_box('theme-layouts-post-meta-box', 'post', 'normal');		
	//}	
}
add_action('admin_menu', 'change_meta_boxes_for_authors', 99);



/***********************************
// remove ability for authors to see ADD NEW button on edit.php page (the page that lists all of their posts)
***********************************/
function hide_new_post_button() {
	$screen = get_current_screen();
	if( $screen->id == 'edit-post' && !current_user_can( 'edit_others_posts' ) ) {
		echo '<style>a.page-title-action{display: none;}</style>';  
	  }
}
add_action('admin_head','hide_new_post_button');



/***********************************
// authors can see a list of their posts and only their posts
***********************************/
function posts_for_current_author($query) {
	global $pagenow;

	if( 'edit.php' != $pagenow || !$query->is_admin )
	    return $query;

	if( !current_user_can( 'edit_others_posts' ) ) {
		global $user_ID;
		$query->set('author', $user_ID );
	}
	return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');
?>