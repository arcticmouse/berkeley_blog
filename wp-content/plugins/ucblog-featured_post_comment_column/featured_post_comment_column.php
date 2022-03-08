<?php
/*
Plugin Name:  UCB Blog Post & Comment Columns
Plugin URI: http://blogs.berkeley.edu
Description: Adds a FEATURED column in the posts admin screen. Adds a FEATURED COMMENT column in the edit comments admin screen. 'Y' or 'BLOG' will show in the column if the post/comment has been selected as a FEATURED POST/COMMENT using the CUSTOM FIELD SUITE (a plugin) 'feature_post_on_homepage' custom post field -or- custom plugin for comments. 'NC' will show if the post has been selected to be exported to the Newscenter using a CUSTOM FIELD SUITE (a plugin) 'export_to_nc' set as true.
Author: Public Affairs
Version: 1.0
*/
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

include( plugin_dir_path( __FILE__ ) . 'post_column.php' ); 
include( plugin_dir_path( __FILE__ ) . 'comment_column.php' ); 
?>