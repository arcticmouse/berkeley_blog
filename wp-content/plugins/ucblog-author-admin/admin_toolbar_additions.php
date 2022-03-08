<?php
/***********************************
add sub menu to admin toolbar with links for users to add new posts to categories
************************************/
function toolbar_links_for_authors( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'new-content' );
	
	$args = array(
		'id'     => 'new-post',     // id of the existing child node (New > Post)
		'title'  => 'Add New Post', // alter the title of existing node
		'parent' => false,          // set parent to false to make it a top level (parent) node
		'href'   => false,
	);
	$wp_admin_bar->add_node( $args );

	$args = array(
		'id'    => 'new_culture',
		'title' => 'Culture & Humanities',
		'href'  => '/wp-admin/post-new.php?cat=3',
		'parent' => 'new-post'
	);
	$wp_admin_bar->add_node( $args );
	
	$args = array(
		'id'    => 'new_economics',
		'title' => 'Economics',
		'href'  => '/wp-admin/post-new.php?cat=4',
		'parent' => 'new-post'
	);
	$wp_admin_bar->add_node( $args );
	
	$args = array(
		'id'    => 'new_environment',
		'title' => 'Environment',
		'href'  => '/wp-admin/post-new.php?cat=5',
		'parent' => 'new-post'
	);
	$wp_admin_bar->add_node( $args );
	
	$args = array(
		'id'    => 'new_body',
		'title' => 'Mind & Body',
		'href'  => '/wp-admin/post-new.php?cat=6',
		'parent' => 'new-post'
	);
	$wp_admin_bar->add_node( $args );
	
	$args = array(
		'id'    => 'new_politics',
		'title' => 'Politics & Law',
		'href'  => '/wp-admin/post-new.php?cat=7',
		'parent' => 'new-post'
	);
	$wp_admin_bar->add_node( $args );
	
	$args = array(
		'id'    => 'new_science',
		'title' => 'Science & Technology',
		'href'  => '/wp-admin/post-new.php?cat=8',
		'parent' => 'new-post'
	);
	$wp_admin_bar->add_node( $args );
	
	$args = array(
		'id'    => 'new_other',
		'title' => 'Other',
		'href'  => '/wp-admin/post-new.php?cat=108',
		'parent' => 'new-post'
	);
	$wp_admin_bar->add_node( $args );
}//end function toolbar_links_for_authors

add_action( 'admin_bar_menu', 'toolbar_links_for_authors', 999 );



/*******************************************************/
/* add ability to add posts ONLY by category from admin bar
/*******************************************************/
function change_post_object_new_post_title() {
    global $wp_post_types;
	
	$category_query = isset($_SERVER["QUERY_STRING"]) ? $_SERVER["QUERY_STRING"] : "";
	switch($category_query){
		case 'cat=3':
			$category_title = 'Culture & Humanities';
		break;
		case 'cat=4':
			$category_title = 'Economics';
		break;
		case 'cat=5':
			$category_title = 'Environment';
		break;
		case 'cat=6':
			$category_title = 'Mind & Body';
		break;
		case 'cat=108':
			$category_title = 'Other';
		break;
		case 'cat=7':
			$category_title = 'Politics & Law';
		break;
		case 'cat=8':
			$category_title = 'Science & Technology';
		break;
	}
	
    $labels = &$wp_post_types['post']->labels;
    $labels->add_new_item = 'Add News Post >> ' . $category_title;
}
 
add_action( 'init', 'change_post_object_new_post_title' );






/*******************************************************/
/* add user link to admin toolbar for cathy
/*******************************************************/
function toolbar_link_for_cathy( $wp_admin_bar ){
	$url = $_SERVER['REQUEST_URI'];
	$pos = strpos( '/wp-admin/', $url );
	$link = $pos === false ? '/wp-admin/users.php' : '/users.php';

	$args = array(
		'id'     => 'users',     // id of the existing child node (New > Post)
		'title'  => 'Users', // alter the title of existing node
		'parent' => false,          // set parent to false to make it a top level (parent) node
		'href'   => $link
	);
	$wp_admin_bar->add_node( $args );
}

add_action( 'admin_bar_menu', 'toolbar_link_for_cathy', 100 );
?>