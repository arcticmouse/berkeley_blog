<?php

// Load translation file 
load_theme_textdomain('atahualpa');


// Sidebars:
if ( function_exists('register_sidebar') ) {
	
	register_sidebar(array(
		'name'=>'Left Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h5>',
		'after_title' => '</h5></div>',
	));

	register_sidebar(array(
		'name'=>'Right Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h5>',
		'after_title' => '</h5></div>',
	));
	
	register_sidebar(array(
		'name'=>'Left Inner Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h5>',
		'after_title' => '</h5></div>',
	));

	register_sidebar(array(
		'name'=>'Right Inner Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h5>',
		'after_title' => '</h5></div>',
	));
			

	
	// Register additional extra widget areas:
	$bfa_ata_extra_widget_areas = maybe_unserialize(get_option('bfa_widget_areas'));
	
	for ($i =0; $i < count($bfa_ata_extra_widget_areas); $i++) { 
		register_sidebar(array(
			'name' => $bfa_ata_extra_widget_areas[$i]['name'],
			'before_widget' => $bfa_ata_extra_widget_areas[$i]['before_widget'],
			'after_widget' => $bfa_ata_extra_widget_areas[$i]['after_widget'],
			'before_title' => $bfa_ata_extra_widget_areas[$i]['before_title'],
			'after_title' => $bfa_ata_extra_widget_areas[$i]['after_title']
		));
	}

} 




// Load functions
include_once (TEMPLATEPATH . '/functions/bfa_header_config.php');
include_once (TEMPLATEPATH . '/functions/bfa_hor_cats.php');
include_once (TEMPLATEPATH . '/functions/bfa_hor_pages.php');
include_once (TEMPLATEPATH . '/functions/bfa_footer.php');
include_once (TEMPLATEPATH . '/functions/bfa_recent_comments.php');
include_once (TEMPLATEPATH . '/functions/bfa_popular_posts.php');
include_once (TEMPLATEPATH . '/functions/bfa_popular_in_cat.php');
include_once (TEMPLATEPATH . '/functions/bfa_subscribe.php');
include_once (TEMPLATEPATH . '/functions/bfa_postinfo.php');
include_once (TEMPLATEPATH . '/functions/bfa_rotating_header_images.php');
include_once (TEMPLATEPATH . '/functions/bfa_next_previous_links.php');
include_once (TEMPLATEPATH . '/functions/bfa_post_parts.php');
if (!function_exists('paged_comments'))  
	include_once (TEMPLATEPATH . '/functions/bfa_custom_comments.php');

// old, propretiary bodyclasses() of Atahualpa. Usage: bodyclasses()
// include_once (TEMPLATEPATH . '/functions/bfa_bodyclasses.php');
// new, default Wordpress body_class(). usage: body_class()
// include only in WP 2.7 and older. From WP 2.8 it's a core Wordpress function:
if (!function_exists('body_class'))
	include_once (TEMPLATEPATH . '/functions/bfa_body_class.php');

// For plugin "Sociable":
if (function_exists('sociable_html')) 
	include_once (TEMPLATEPATH . '/functions/bfa_sociable2.php'); 

// "Find in directory" function, needed for finding header images on WPMU
if (file_exists(ABSPATH."/wpmu-settings.php")) 
	include_once (TEMPLATEPATH . '/functions/bfa_m_find_in_dir.php');

// get default theme options
include_once (TEMPLATEPATH . '/functions/bfa_theme_options.php');
// Load options
include_once (TEMPLATEPATH . '/functions/bfa_get_options.php');
global $bfa_ata;

// add jquery function only to theme page or widgets won't work in 2.3 and older
#if ( $_GET['page'] == basename(__FILE__) ) { 

// CSS for admin area
include_once (TEMPLATEPATH . '/functions/bfa_css_admin_head.php');
// Add the CSS to the <head>...</head> of the theme option admin area
add_action('admin_head', 'bfa_add_stuff_admin_head');

include_once (TEMPLATEPATH . '/functions/bfa_ata_add_admin.php');
include_once (TEMPLATEPATH . '/functions/bfa_ata_admin.php');
add_action('admin_menu', 'bfa_ata_add_admin');

#}



// Escape single & double quotes
function bfa_escape($string) {
	$string = str_replace('"', '&#34;', $string);
	$string = str_replace("'", '&#39;', $string);
	return $string;
}


// change them back
function bfa_unescape($string) {
	$string = str_replace('&#34;', '"', $string);
	$string = str_replace('&#39;', "'", $string);
	return $string;
}

function bfa_escapelt($string) {
	$string = str_replace('<', '&lt;', $string);
	$string = str_replace('>', '&gt;', $string);
	return $string;
}



function footer_output($footer_content) {
	$footer_content .= '<br />Powered by <a href="http://wordpress.org/">WordPress</a> &amp; the <a href="http://wordpress.bytesforall.com/" title="Customizable WordPress themes">Atahualpa WP Theme</a> by <a href="http://www.bytesforall.com/" title="BFA Webdesign">BytesForAll</a>. Now with <a href="http://forum.bytesforall.com/" title="Discuss Atahualpa &amp; WordPress">Tutorials &amp; Support</a>';
	return $footer_content;
}


// new comment template for WP 2.7+, legacy template for old WP 2.6 and older
if ( !function_exists('paged_comments') ) {
	include_once (TEMPLATEPATH . '/functions/bfa_custom_comments.php'); 
	function legacy_comments($file) {
		if( !function_exists('wp_list_comments') ) 
			$file = TEMPLATEPATH . '/legacy.comments.php';
			
		return $file;
	}
	add_filter('comments_template', 'legacy_comments');
}


// remove WP default inline CSS for ".recentcomments a" from header
function remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}
add_filter( 'wp_head', 'remove_wp_widget_recent_comments_style', 1 );


/* Remove plugin CSS & JS and include them in the theme's main CSS and JS files
This will be extended and improved in upcoming versions */

// remove WP Pagenavi CSS, will be included in css.php
if (function_exists('wp_pagenavi')) {
remove_action('wp_head', 'pagenavi_css');
}

// remove Sociable CSS & JS, will be included in css.php and js.php
# if (function_exists('sociable_html')) {
# remove_action('wp_head', 'sociable_wp_head');
# }


// uncomment to remove meta tag <meta name="generator" content="WordPress x.x.x" /> from header
# remove_action('wp_head', 'wp_generator');

// If the plugin Share This is activated, disable its auto-output so we can control it 
// through the Atahualpa Theme Options
if ( function_exists('akst_share_link') ) {
@define('AKST_ADDTOCONTENT', false);
@define('AKST_ADDTOFOOTER', false);
}

// Register new query variable "bfa_ata_file" with Wordpress
add_filter('query_vars', 'add_new_var_to_wp');
function add_new_var_to_wp($public_query_vars) {
	$public_query_vars[] = 'bfa_ata_file';
	return $public_query_vars;
}

/* redirect the template if new var "bfa_ata_file" exists in URL
and is "css" or "js". That means that a request for 
mydomain.com/?bfa_ata_file=css would not try to display a
normal page but do whatever we define below. In this
case "get the saved options and display the CSS file" */
add_action('template_redirect', 'bfa_css_js_redirect');
function bfa_css_js_redirect() {
	global $bfa_ata;
	$bfa_ata_file_value = get_query_var('bfa_ata_file');
	$bfa_ata_preview = get_query_var('preview');
	if ( $bfa_ata_file_value == "css" OR $bfa_ata_file_value == "js" ) {
		#include_once (TEMPLATEPATH . '/functions/bfa_get_options.php');
		include_once (TEMPLATEPATH . '/' . $bfa_ata_file_value . '.php');
		exit; // this stops WordPress entirely
	}
}

/* The above code doesn't work if the theme is being previewed.
In this case we're just including the css.php inline in the header. Otherwise
the theme would look broken in the preview due to the missing CSS */
if ( get_query_var('preview') == 1 ) { 
	$bfa_ata['css_external'] == "Inline";
	$bfa_ata['javascript_external'] == "Inline";
}

/* If this is a preview, CSS was set to be displayed Inline at Theme Options: */
if ( $bfa_ata['css_external'] == "Inline" ) { 
	add_action('wp_head', 'bfa_inline_css');
}
	
function bfa_inline_css() {
	global $bfa_ata;
	include_once (TEMPLATEPATH . '/' . 'css.php');
}

if ( $bfa_ata['javascript_external'] == "Inline" ) { 
	add_action('wp_head', 'bfa_inline_javascript');
}
	
function bfa_inline_javascript() {
	global $bfa_ata;
	include_once (TEMPLATEPATH . '/' . 'js.php');
}




// Custom Excerpts 
function bfa_wp_trim_excerpt($text) { // Fakes an excerpt if needed
	
	global $bfa_ata;
	global $main_category;
	
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$text = strip_tags($text, $bfa_ata['dont_strip_excerpts']);
		if (is_home()  || $main_category)
		{
			$excerpt_length = 50;
		}
		else
		{
			$excerpt_length = $bfa_ata['excerpt_length'];
		}
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words) > $excerpt_length) {
			
			array_pop($words);	

			$custom_read_more = str_replace('%permalink%', get_permalink(), $bfa_ata['custom_read_more']);
						
			// get link to full discussion for this post
			/*
			$categories = get_the_category();
			if ($categories[0]->parent != 0)
			{
				$category_link = get_category_link($categories[0]->cat_ID) . '?full=1#' . get_the_id();
			}
			else
			{
				$category_link = get_category_link($categories[1]->cat_ID) . '?full=1#' . get_the_id();
			}
			$custom_read_more = str_replace('%full_discussion%', $category_link, $bfa_ata['custom_read_more']);
			*/
			$post_link = get_permalink();
				$custom_read_more = str_replace('%full_discussion%', $post_link, $bfa_ata['custom_read_more']);
			
			$custom_read_more = str_replace('%title%', the_title('','',FALSE), $custom_read_more);
			array_push($words, $custom_read_more);
			$text = implode(' ', $words);
			
		}
	}
	return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'bfa_wp_trim_excerpt');



/* Custom widget areas. 

Usage:
<?php bfa_widget_area([parameters]); ?>

Example: 
<?php bfa_widget_area('name=My widget area&cells=4&align=1&align_2=9&align_3=7&width_4=700&before_widget=<div id="%1$s" class="header-widget %2$s">&after_widget=</div>'); ?>

Can be used anywhere in templates, and in theme option text areas that allow usage of PHP code.

Available paramaters:

Mandatory:
name					Name under which all cells of this widget area will be listed at Site Admin -> Appearance -> Widgets
							A widget area with 3 cells and a name of "My widget area" creates 3 widget cells which appear as
							"My widget area 1", "My widget area 2" and "My widget area 3", 
							with the CSS ID's "my_widget_area_1", "my_widget_area_2" and "my_widget_area_3". 
						
Optional:
cells						Amount of (table) cells. Each cell is a new widget area. Default: 1
align						Default alignment for all cells. Default: 2 (= center top). 1 = center middle, 2 = center top, 3 = right top, 4 = right middle, 
							5 = right bottom, 6 = center bottom, 7 = left bottom, 8 = left middle, 9 = left top.
align_1					Alignment for cell 1: align_2, align_3 ... Non-specified cells get the default value of "align", which, if not defined, is 2 (= center top).
width_1				Width of cell 1: width_1, width_2, width_3 ... Non-specified cells get a equal share of the remaining width of the whole table
							containing all the widget area cells.
before_widget		HTML before each widget in any cell of this widget area. Default:  <div id="%1$s" class="widget %2$s">
after_widget		HMTL after each widget ... Default: </div>
before_title			HTML before the title of each widget in any cell of this widget area: Default: <div class="widget-title"><h3>
after_title			HMTL after the title ... Default: </h3></div>

*/
function bfa_widget_area($args = '') {
	$defaults = array(
		'cells' => 3,
		'align' => 2,
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h5>',
		'after_title' => '</h5></div>',
	);
	
	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	$area_id = strtolower(str_ireplace(" ", "_", $r['name']));
	
	echo '<table id="' . $area_id . '" class="bfa_widget_area" style="table-layout:fixed; width: 100%" cellpadding="0" cellspacing="0" border="0">';
	
	for ( $i = 1; $i <= $r['cells']; $i++ ) {
		
			$current_name = $r['name'] . ' ' . $i;
			$current_id = $area_id . '_' . $i;
			$current_align = "align_" . $i;
			
			echo "\n" . '<td id="' . $current_id .'" ';
			
			if ( $r[$current_align] ) { 
				$align_type = $r["$current_align"];
			} else {
				$align_type = $r['align'];
			}
			
			echo bfa_table_cell_align($align_type) . ">";
			
			// Register widget area
			#$bfa_ata_widget_areas[] = $current_name; 
	  		$bfa_ata_widget_areas[] = array(
	  			"name" => $current_name,
	  			"before_widget" => $r['before_widget'],
	  			"after_widget" => $r['after_widget'],
	  			"before_title" => $r['before_title'],
	  			"after_title" => $r['after_title']
	  			);
	  
	   		// Display widget area
			dynamic_sidebar("$current_name"); 
			
			echo "\n</td>";
	    
	}
	
	echo '</table>';     
	
	update_option("bfa_widget_areas", $bfa_ata_widget_areas);

}


function bfa_table_cell_align($align_type) {
	
	switch ($align_type) {
		case 1: $string = 'align="center" valign="middle"'; break;
		case 2: $string = 'align="center" valign="top"'; break;
		case 3: $string = 'align="right" valign="top"'; break;		
		case 4: $string = 'align="right" valign="middle"'; break;
		case 5: $string = 'align="right" valign="bottom"'; break;
		case 6: $string = 'align="center" valign="bottom"'; break;
		case 7: $string = 'align="left" valign="bottom"'; break;
		case 8: $string = 'align="left" valign="middle"'; break;
		case 9: $string = 'align="left" valign="top"'; 
	}
	
	return $string;
	
}
	


// This adds arbitrary content at various places in the center (= content) column:
function bfa_center_content($center_content) {

	global $bfa_ata;
	
	// PHP 
	// not for WPMU
	if ( !file_exists(ABSPATH."/wpmu-settings.php") ) {
		
		if ( strpos($center_content,'<?php ') !== FALSE ) {
			ob_start(); 
				eval('?>'.$center_content); 
				$center_content = ob_get_contents(); 
			ob_end_clean();
		}
		
	}
	
	echo $center_content;

}



/* CUSTOM BODY TITLE and meta title, meta keywords, meta description */

/* Use the admin_menu action to define the custom boxes */
#add_action('admin_menu', 'bfa_ata_add_custom_box');

/* Use the save_post action to do something with the data entered */
#add_action('save_post', 'bfa_ata_save_postdata');

/* Adds a custom section to the "advanced" Post and Page edit screens */
function bfa_ata_add_custom_box() {

  if( function_exists( 'add_meta_box' )) {
    add_meta_box( 'bfa_ata_sectionid', __( 'Atahualpa Post Options', 'myplugin_textdomain' ), 
                'bfa_ata_inner_custom_box', 'post', 'normal', 'high' );
    add_meta_box( 'bfa_ata_sectionid', __( 'Atahualpa Page Options', 'myplugin_textdomain' ), 
                'bfa_ata_inner_custom_box', 'page', 'normal', 'high' );
   } else {
    add_action('dbx_post_advanced', 'bfa_ata_old_custom_box' );
    add_action('dbx_page_advanced', 'bfa_ata_old_custom_box' );
  }
}
   
/* Prints the inner fields for the custom post/page section */
function bfa_ata_inner_custom_box() {

	global $post;
	
  // Use nonce for verification

  echo '<input type="hidden" name="bfa_ata_noncename" id="bfa_ata_noncename" value="' . 
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

  // The actual fields for data entry
  
  	$thePostID = $post->ID;
	$post_id = get_post($thePostID);
	$title = $post_id->post_title;
	
	$meta_title = get_post_meta($post->ID, 'bfa_ata_meta_title', true);
	$meta_keywords = get_post_meta($post->ID, 'bfa_ata_meta_keywords', true);
	$meta_description = get_post_meta($post->ID, 'bfa_ata_meta_description', true);	
	$body_title = get_post_meta($post->ID, 'bfa_ata_body_title', true);
  	if ( get_post_meta($post->ID, 'bfa_ata_body_title_saved', true) != 1 ) { 
  		$body_title = $title; 
  	}


	echo '<table cellpadding="5" cellspacing="0" border="0" style="table-layout:fixed;width:100%">';

	echo '<tr><td style="text-align:right;padding:2px 5px 2px 2px"><label for="bfa_ata_body_title">' . __("Body Title", 'atahualpa' ) . '</label></td>';
	echo '<td><input type="text" name="bfa_ata_body_title" value="' . 
	$body_title . '" size="70" style="width:97%" />';
	echo '<input type="hidden" name="bfa_ata_body_title_saved" value="1" /></td></tr>';
		
	echo '<colgroup><col style="width:140px"><col></colgroup>';
	echo '<tr><td style="text-align:right;padding:2px 5px 2px 2px"><label for="bfa_ata_meta_title">' . __("Meta Title", 'atahualpa' ) . '</label></td>';
	echo '<td><input type="text" name="bfa_ata_meta_title" value="' . 
	$meta_title . '" size="70" style="width:97%" /></td></tr>';
	
	echo '<tr><td style="text-align:right;padding:2px 5px 2px 2px"><label for="bfa_ata_meta_keywords">' . __("Meta Keywords", 'atahualpa' ) . '</label></td>';
	echo '<td><input type="text" name="bfa_ata_meta_keywords" value="' . 
	$meta_keywords . '" size="70" style="width:97%" /></td></tr>';
	
	echo '<tr><td style="text-align:right;vertical-align:top;padding:5px 5px 2px 2px"><label for="bfa_ata_meta_description">' . __("Meta Description", 'atahualpa' ) . '</label></td>';
	echo '<td><textarea name="bfa_ata_meta_description" cols="70" rows="4" style="width:97%">'.$meta_description.'</textarea></td></tr>';
	
	echo '</table>';

}

/* Prints the edit form for pre-WordPress 2.5 post/page */
function bfa_ata_old_custom_box() {

  echo '<div class="dbx-b-ox-wrapper">' . "\n";
  echo '<fieldset id="bfa_ata_fieldsetid" class="dbx-box">' . "\n";
  echo '<div class="dbx-h-andle-wrapper"><h3 class="dbx-handle">' . 
        __( 'Body copy title', 'atahualpa' ) . "</h3></div>";   
   
  echo '<div class="dbx-c-ontent-wrapper"><div class="dbx-content">';

  // output editing form

  bfa_ata_inner_custom_box();

  // end wrapper

  echo "</div></div></fieldset></div>\n";
}

/* When the post is saved, save our custom data */
function bfa_ata_save_postdata( $post_id ) {

  /* verify this came from the our screen and with proper authorization,
  because save_post can be triggered at other times */

  if ( !wp_verify_nonce( $_POST['bfa_ata_noncename'], plugin_basename(__FILE__) )) {
    return $post_id;
  }

  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ))
      return $post_id;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ))
      return $post_id;
  }

	// Save the data
	
	$new_body_title = $_POST['bfa_ata_body_title'];
	$new_body_title_saved = $_POST['bfa_ata_body_title_saved'];
	$new_meta_title = $_POST['bfa_ata_meta_title'];
	$new_meta_keywords = $_POST['bfa_ata_meta_keywords'];
	$new_meta_description = $_POST['bfa_ata_meta_description'];
	
	add_post_meta($post_id, 'bfa_ata_body_title_saved', $new_body_title_saved, true) 
	OR update_post_meta($post_id, 'bfa_ata_body_title_saved', $new_body_title_saved);
	add_post_meta($post_id, 'bfa_ata_meta_title', $new_meta_title, true) 
	OR update_post_meta($post_id, 'bfa_ata_meta_title', $new_meta_title);
	add_post_meta($post_id, 'bfa_ata_meta_keywords', $new_meta_keywords, true) 
	OR update_post_meta($post_id, 'bfa_ata_meta_keywords', $new_meta_keywords);
	add_post_meta($post_id, 'bfa_ata_meta_description', $new_meta_description, true) 
	OR update_post_meta($post_id, 'bfa_ata_meta_description', $new_meta_description);
	add_post_meta($post_id, 'bfa_ata_body_title', $new_body_title, true) 
	OR update_post_meta($post_id, 'bfa_ata_body_title', $new_body_title);

}

// SL added 7/23/09
/*
** Function: truncateStringOnBoundary
** Input: STRING string, INTEGER limit, STRING break, STRING pad
** Output: STRING, Truncated string on word boundary
** Description: Truncates a string to length ($limit), on boundary ($break),  
** appending string with padding ($pad)
*/
function truncateStringOnBoundary($string, $limit, $break=" ", $pad=" ... ")
{ 
	// Return with no change if string is shorter than $limit 
	if(strlen($string) <= $limit) return $string; 
 	
 	// Truncate string to length 
 	$string = substr($string, 0, ($limit-15)); 
 	
 	// Find last occurance of boundary and truncate further
 	if(($breakpoint = strrpos($string, $break)) !== false) 
 	{ 
		$string = substr($string, 0, $breakpoint); 
	} 
 	
 	// Return string with padding
 	return $string . $pad; 
 
 }
 
 // Our version of get comment reply link to use on pages other than the single post page
 function comment_reply_link_multi($args = array(), $comment = null, $post = null) {
	echo get_comment_reply_link_multi($args, $comment, $post);
}
 function get_comment_reply_link_multi($args = array(), $comment = null, $post = null) {
	global $user_ID;

	$defaults = array('add_below' => 'comment', 'respond_id' => 'respond', 'reply_text' => __('Reply'),
		'login_text' => __('Log in to Reply'), 'depth' => 0, 'before' => '', 'after' => '');

	$args = wp_parse_args($args, $defaults);

	if ( 0 == $args['depth'] || $args['max_depth'] <= $args['depth'] )
		return;

	extract($args, EXTR_SKIP);

	$comment = get_comment($comment);
	$post = get_post($post);

	if ( !comments_open($post->ID) )
		return false;

	$link = '';
	
	if ( get_option('comment_registration') && !$user_ID )
		$link = '<a rel="nofollow" class="comment-reply-login" href="' . esc_url( wp_login_url( get_permalink() ) ) . '">' . $login_text . '</a>';
	else;
		$this_post_link = get_permalink();
		$reply_link = $this_post_link . '?replytocom=' . $comment->comment_ID ;			
		$link = "<a rel='nofollow' class='comment-reply-link' href='" . $reply_link . "#" . $respond_id . "' onclick='return addComment.moveForm(\"$add_below-$comment->comment_ID\", \"$comment->comment_ID\", \"$respond_id\", \"$post->ID\")'>$reply_text</a>";
	return apply_filters('comment_reply_link', $before . $link . $after, $args, $comment, $post);
}
// end SL added 7/23/09

// Hook to update feature.xml on publish -- YK 05/13/13
//function feature_xml($new_status, $old_status, $postid){

   	function feature_xml($post_id, $post){
		
	if ( ! wp_is_post_revision( $post_id ) ){
	
		// unhook this function so it doesn't loop infinitely
		remove_action('save_post', 'test');
	
		// update the post, which calls save_post again
		wp_update_post($post);

		// re-hook this function
		add_action('save_post', 'test');
	}
	
		// update the post, which calls save_post again
	  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
	      return;
	  global $p;
	  $args = array( 'numberposts' => 30, 'order' => 'DESC' );
	  $myposts = get_posts( $args );
	  
	  if(!empty($myposts)){
		foreach( $myposts as $p ) {

			$UID = $p->post_author;
			$ID = $p->ID;
			$user_info = get_metadata('user',$UID);
			$meta = get_metadata('post', $ID);
			$link = get_permalink($ID);
			$author =  get_userdata($UID);
			if (intval($meta['feature'][0]) == 1) {
		    	$xml = new SimpleXMLElement('<xml/>');
				$xml->addChild('item');
				if (strlen($meta['alt_title'][0])>0) {
					$xml->item->addChild('title', $meta['alt_title'][0]);
				} else {
					$xml->item->addChild('title', $p->post_title);
				}
				$xml->item->addChild('link', $link);
				$xml->item->addChild('author', $author->user_firstname." ".$author->user_lastname);
				if (strlen($user_info['userphoto_thumb_file'][0])>0) {
					$xml->item->addChild('authorimage', $user_info['userphoto_thumb_file'][0]);
				}
				break;
			} 
		}
	}
	$docroot = $_SERVER['DOCUMENT_ROOT'];
	$file = $docroot.'/wp-content/uploads/feature.xml'; //Absolute path
   	$open = fopen($file, 'w+') or die ("File cannot be opened.");
    fwrite($open, $xml->asXML());
   	fclose($open); 

}

function test($post_id){
    $post = get_post($post_id);
    $post = get_object_vars($post);
    feature_xml($post_id, $post);
	wp_reset_postdata();
}

if (current_user_can('edit_posts')) {
	add_action( 'save_post', 'test');
}

?>