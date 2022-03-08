<?php
/************************************************/
/*
/* Create the columns
/*
/************************************************/
//add featured comment column in edit-comments in admin panel
function comment_columns($columns){
	if((current_user_can( 'manage_options' ))) {
		$columns['featured_comment'] = 'Featured Comment';
		return $columns;
	} else {
		return $columns;
	}
}

add_filter( 'manage_edit-comments_columns', 'comment_columns' );



/************************************************/
/*
/* Add data to the columns
/*
/************************************************/
//add data to the edit-comments page custom column
function myplugin_comment_column($column, $comment_ID){
	if ( 'featured_comment' == $column ) {
		$fcomment = get_comment_meta( $comment_ID, 'featured', true);
		echo ($fcomment == 'y') ? 'Featured' : '';
	}
}
add_filter( 'manage_comments_custom_column', 'myplugin_comment_column', 10, 2 );



/************************************************/
/*
/* Make Columns Sortable
/*
/***********************************************
//make comment featured column sortable
function featured_comment_register_sortable($columns){
	$columns['featured_comment'] = 'Featured Comment';
	return $columns;	
}

add_filter('manage_edit-comments_sortable_columns', 'featured_comment_register_sortable' );
*/
?>