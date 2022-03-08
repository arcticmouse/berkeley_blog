<?php
/************************************************/
/*
/* Create the columns
/*
/************************************************/
//leta adding to add feautred post column in posts admin panel
//1/27
function post_columns($columns) {
	if((current_user_can( 'manage_options' ))) {
		$columns['featured_post'] = 'Featured Post';
		return $columns;
	} else {
		return $columns;
	}
}

add_filter('manage_posts_columns', 'post_columns');



/************************************************/
/*
/* Add data to the columns
/*
/************************************************/
//add data to the posts page custom column
function post_listing_show_columns($name){
    global $post;
    switch ($name) {
        case 'featured_post':
            $views = get_post_meta($post->ID, 'feature_post_on_homepage', true); //CFS()->get( 'feature_post_on_homepage', $post->ID ); //get_post_meta($post->ID, 'views', true);
            echo( $views == 1 ) ? 'Blog ' : '';
        case 'nc_post':
            $views = get_post_meta($post->ID, 'export_to_newscenter', true); //CFS()->get( 'feature_post_on_homepage', $post->ID ); //get_post_meta($post->ID, 'views', true);
            echo( $views == true ) ? 'NC' : '';
    }
}

add_action('manage_posts_custom_column',  'post_listing_show_columns');



/************************************************/
/*
/* Make Columns Sortable
/*
/************************************************
//make post featured column sortable
function featured_post_register_sortable($columns){
	$columns['featured_post'] = 'Featured Post';
	return $columns;	
}

add_filter('manage_edit-post_sortable_columns', 'featured_post_register_sortable' );



/************************************************/
/*
/* Sort Columns - doesnt work because couldnt figure out how to make it work
/*
/***********************************************
function manage_admin_posts_sort( $query ) {
	if( is_admin() ) {
		//if( 'post' == get_post_type()) {
			$orderby = $query->get('orderby');
			if('featured_post' == $orderby) {
				$query->set('meta_key', 'feature_post_on_homepage');
				$query->set('orderby', 'meta_value');
				//$query->set('order', 'DESC');
			}
		//} //is post
	} //is admin
}

add_action( 'pre_get_posts', 'manage_admin_posts_sort' );
*/
?>