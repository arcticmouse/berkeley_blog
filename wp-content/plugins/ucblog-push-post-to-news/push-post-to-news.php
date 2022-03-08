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
			'posts_per_page' => 10
		);
		
		$posts_array = get_posts($args);
		
		if ( !empty($posts_array) ) {
			$xml = new SimpleXMLElement('<rss xmlns:atom="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/"></rss>');
			$xml->addAttribute('version', '2.0');
			$xml->addChild('channel');
			
			$xml->channel->addChild('title', 'Berkley Blog Posts to Import to NewsCenter');
			$xml->channel->addChild('url', get_site_url() . '/wp-content/uploads/news_center.xml');
			$xml->channel->addChild('updated', date('l jS \of F Y h:i:s A'));
			$xml->channel->addChild('description', 'Short curated list of posts to send to import to the newscenter');
			$xml->channel->addChild('language','en-us'); 
			
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
					$curr_img = 'https://blogs.berkeley.edu/wp-content/uploads/2016/03/berkeley-campus_4web.jpg';
				}
				//$curr_text = str_replace("&nbsp;", " ", $post->post_content);
				$curr_text = htmlentities($post->post_content, ENT_XML1);
				$blogpost = $xml->channel->addChild('item');
				$blogpost->addChild('title', $curr_title);
				$blogpost->addChild('link', $curr_link);
				$blogpost->addChild('pubDate', $curr_date);
				$blogpost->addChild('author', $curr_author);
				$blogpost->addChild('alink', $curr_user_link);
				$blogpost->addChild('ilink', $curr_img);
				//$blogpost->addChild('content', '<![CDATA[' . $curr_text . ']]>');
				$blogpost->addChild('content', $curr_text);

			} //end foreach
			
			$docroot = $_SERVER['DOCUMENT_ROOT'];
			$file = $docroot.'/wp-content/uploads/news_center.xml'; //Absolute path
			$open = fopen($file, 'w+') or die ("File cannot be opened.");
			fwrite($open, $xml->asXML());
			fclose($open); 
		} //if not empty post_array
	} //current user can
} //end function post_to_nc_rss

add_action( 'save_post', 'post_to_nc_rss');

?>