<?php
/*
Plugin Name:  UCB Blog Push Post to News Center
Plugin URI: http://blogs.berkeley.edu
Description: Lets administrator push a post to an RSS feed that will be picked up by the blog
Author: Public Affairs
Version: 1.0

1. user checks box to send to NC
	field groups check box, true/false, name is export_to_newscenter
2. post put in RSS
*/
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

function post_to_nc_rss( $post_id ){
	
	if (current_user_can('publish_posts')) {
	
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		  return;
		  
		$args = array(
			'orderby' => 'date',
			'order' => DESC,
			'meta_key' => 'export_to_newscenter',
			'meta_value' => true,
			'posts_per_page' => 3
		);
		
		$posts_array = get_posts($args);
		
		if ( !empty($posts_array) ) {
			//$xml = new SimpleXMLElement('<xml></xml>');
			$xml = new SimpleXMLElement('<feed xmlns="http://www.w3.org/2005/Atom"></feed>');
			
			$xml->addAttribute('type', 'post');
			Header('Content-type: text/xml');
			
			foreach($posts_array as $post) {
				
				if( !empty(get_post_meta($post->ID, 'alternate_newscenter_title', true) ) ) {
					$curr_title = get_post_meta($post->ID, 'alternate_newscenter_title', true);
				} else { 
					$curr_title = $post->post_title;
				}
				$curr_date = $post->post_date;
				$curr_link = get_permalink($post->ID);
				$curr_author_info = get_userdata($post->post_author); 
				$curr_user_link = 'http://blogs.berkeley.edu/author/' . $curr_author_info->user_login;
				$curr_author = $curr_author_info->first_name . ' ' . $curr_author_info->last_name;
				if( !empty(wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) ) ) {
					$curr_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
				} else {
					$curr_img = 'https://berkeleyblog.staging.wpengine.com/wp-content/uploads/2013/10/grooming-chimps.jpg';
				}
				$curr_text = $post->post_content;

				$blogpost = $xml->addChild('item');
				$blogpost->addChild('title', $curr_title);
				$blogpost->addChild('date', $curr_date);
				$blogpost->addChild('author', $curr_author);
				$blogpost->addChild('author_link', $curr_user_link);
				$blogpost->addChild('img', $curr_img);
				$blogpost->addChild('post_link', $curr_link);
				$blogpost->addChild('text', $curr_text);
			
				/*
				$blogpost = $xml->addChild('post');
				$blogpost->addChild('title', $curr_title);
				$blogpost->addChild('date', $curr_date);
				$blogpost->addChild('author', $curr_author);
				$blogpost->addChild('author_link', $curr_user_link);
				$blogpost->addChild('img', $curr_img);
				$blogpost->addChild('post_link', $curr_link);
				$blogpost->addChild('text', $curr_text);
				*/
			} //end foreach
			
			$docroot = $_SERVER['DOCUMENT_ROOT'];
			$file = $docroot.'/wp-content/uploads/news_center.xml'; //Absolute path
			echo $file;
			$open = fopen($file, 'w+') or die ("File cannot be opened.");
			fwrite($open, $xml->asXML());
			fclose($open); 
		} //if not empty post_array
	} //current user can
} //end function post_to_nc_rss

add_action( 'save_post', 'post_to_nc_rss');

?>