<?php


// Callback function for image replacement
function image_files($matches) {
	return '<img src="' . get_bloginfo('template_directory') . 
	'/images/icons/' . $matches[1] . '" alt="" />';
}



// Callback function for post meta replacement
function meta_values($matches) {
	$meta_key = $matches[1];
	// "get_post_custom_values" returns an array. Turn it into a string, separated by commata
	$meta_values = implode(", ", get_post_custom_values($meta_key));
	return $meta_values;
}



function postinfo($postinfo_string) {

	// one theme option needed below for nofollow trackback / RSS links yes/no
	global $bfa_ata;
	global $main_category;
	
	/* replace date format escape placeholders(#) with the actual escpae
	character (=backslashes). This function removes all backslashes from
	post info strings to avoid issues with hosts that have magic_quotes_gpc ON.
	But we want to keep the backslashes inside date items, because they are
	needed to escape literal strings inside dates */
	$postinfo_string = str_replace("#", "\\", $postinfo_string);

	$postinfo = $postinfo_string;

    // Author full name with link
	if ( strpos($postinfo_string,'%author-linked-first-last%') !== FALSE ) {
        ob_start(); 
			the_author_firstname(); 
			$author_firstname = ob_get_contents(); 
		ob_end_clean();
        ob_start(); 
			the_author_lastname(); 
			$author_lastname = ob_get_contents(); 
		ob_end_clean(); 
		ob_start(); 
			the_author_meta('nickname');
			$author_nickname = ob_get_contents(); 
		ob_end_clean(); 
		ob_start(); 
			the_author(); 
			$author = ob_get_contents(); 
		ob_end_clean();
		ob_start(); 
			the_author_id(); 
			$author_id = ob_get_contents(); 
		ob_end_clean();			
				
		$curauth = get_userdata(intval($author_id));
		if ($curauth->description == '')
		{
			$author_link = $curauth->user_url;
		}
		else
		{
			$author_link = get_author_posts_url($author_id);
		}
		
        $author_full_name = '<a href="' . $author_link . '">' . $author_firstname . ' ' . $author_lastname . '</a>';
				
		if ($author_nickname != '' && $author_nickname != 'ovoices')
		{
			$author_full_name .= ', ' . $author_nickname;
		}
		$postinfo = str_replace("%author-linked-first-last%", $author_full_name, $postinfo);
	}


	// Author public name
	if ( strpos($postinfo_string,'%author%') !== FALSE ) {
		ob_start(); 
			the_author(); 
			$author = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%author%", $author, $postinfo);
	}



	// Public name of Author who last modified a post, since WordPress 2.8. 
	// Check first if function is available (= if this is WP 2.8+)
	if ( function_exists('the_modified_author') ) { 
		if ( strpos($postinfo_string,'%modified-author%') !== FALSE ) {
			ob_start(); 
				the_modified_author(); 
				$modified_author = ob_get_contents(); 
			ob_end_clean();
			$postinfo = str_replace("%modified-author%", $modified_author, $postinfo);
		}
	}



	// Author about yourself
	if ( strpos($postinfo_string,'%author-description%') !== FALSE ) {
		ob_start(); 
			the_author_description(); 
			$author_description = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%author-description%", $author_description, $postinfo);
	}



	// Author login name
	if ( strpos($postinfo_string,'%author-login%') !== FALSE ) {
		ob_start(); 
			the_author_login(); 
			$author_login = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%author-login%", $author_login, $postinfo);
	}



	// Author first name
	if ( strpos($postinfo_string,'%author-firstname%') !== FALSE ) {
		ob_start(); 
			the_author_firstname(); 
			$author_firstname = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%author-firstname%", $author_firstname, $postinfo);
	}



	// Author last name
	if ( strpos($postinfo_string,'%author-lastname%') !== FALSE ) {
		ob_start(); 
			the_author_lastname(); 
			$author_lastname = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%author-lastname%", $author_lastname, $postinfo);
	}



	// Author nickname
	if ( strpos($postinfo_string,'%author-nickname%') !== FALSE ) {
		ob_start(); 
			the_author_nickname(); 
		 	$author_nickname = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%author-nickname%", $author_nickname, $postinfo);
	}



	// Author ID
	if ( strpos($postinfo_string,'%author-id%') !== FALSE ) {
		ob_start(); 
			the_author_ID(); 
			$author_ID = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%author-id%", $author_ID, $postinfo);
	}



	// Author email address, clear text in HTML source code
	if ( strpos($postinfo_string,'%author-email-clear%') !== FALSE ) {
		ob_start(); 
			the_author_email(); 
			$author_email_clear = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%author-email-clear%", $author_email_clear, $postinfo);
	}



	// Author email address obfuscated
	if ( strpos($postinfo_string,'%author-email%') !== FALSE ) {
		$postinfo = str_replace("%author-email%", antispambot(get_the_author_email()), $postinfo);
	}



	// Author website URL
	if ( strpos($postinfo_string,'%author-url%') !== FALSE ) {
		ob_start(); 
			the_author_url(); 
			$author_url = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%author-url%", $author_url, $postinfo);
	}



	// Author website link
	if ( strpos($postinfo_string,'%author-link%') !== FALSE ) {
		ob_start(); 
			the_author_link(); 
			$author_link = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%author-link%", $author_link, $postinfo);
	}



	// Author posts archive link
	if ( strpos($postinfo_string,'%author-posts-link%') !== FALSE ) {
		ob_start(); 
			the_author_posts_link(); 
			$author_posts_link = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%author-posts-link%", $author_posts_link, $postinfo);
	}
	
	//  LEGACY: %author-linked% replaced by %author-posts-link% in 3.3.2, but displays the same: Author posts archive link
	if ( strpos($postinfo_string,'%author-linked%') !== FALSE ) {
		ob_start(); 
			the_author_posts_link(); 
			$author_posts_link = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%author-linked%", $author_posts_link, $postinfo);
	}

	

	// Author post count
	if ( strpos($postinfo_string,'%author-post-count%') !== FALSE ) {
		ob_start(); 
			the_author_posts(); 
			$author_post_count = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%author-post-count%", $author_post_count, $postinfo);
	}



	// Author AOL Instant Messenger screenname
	if ( strpos($postinfo_string,'%author-aim%') !== FALSE ) {
		ob_start(); 
			the_author_aim(); 
			$author_aim = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%author-aim%", $author_aim, $postinfo);
	}



	// Author Yahoo IM ID
	if ( strpos($postinfo_string,'%author-yim%') !== FALSE ) {
		ob_start(); 
			the_author_yim(); 
			$author_yim = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%author-yim%", $author_yim, $postinfo);
	}



	// Date & Time
	if ( strpos($postinfo_string,'%date(') !== FALSE ) {
		$date_param = preg_match("/(.*)\%date\('(.*?)'\)(.*)/i",$postinfo_string,$date_matches);
		ob_start(); 
			the_time($date_matches[2]); 
			$date = ob_get_contents(); 
		ob_end_clean();
		$postinfo = preg_replace("/(.*)%date\((.*?)\)%(.*)/i", "\${1}" .
        $date. "\${3}", $postinfo);
	}



	// Date & Time, last modified
	if ( strpos($postinfo_string,'%date-modified(') !== FALSE ) {
		$date_param = preg_match("/(.*)\%date-modified\('(.*?)'\)(.*)/i",
        $postinfo_string,$date_matches);
		ob_start(); 
			the_modified_time($date_matches[2]); 
			$date_modified = ob_get_contents(); 
		ob_end_clean();
		$postinfo = preg_replace("/(.*)%date-modified\((.*?)\)%(.*)/i", "\${1}" .
        $date_modified. "\${3}", $postinfo);
	}



	// Tags, linked - since WP 2.3
	if ( strpos($postinfo_string,'%tags-linked') !== FALSE ) {
		$tag_link_options = preg_match("/(.*)%tags-linked\('(.*?)'(.*?)'(.*?)'(.*?)'(.*?)'(.*)/i",
        $postinfo_string,$tag_link_matches);
		$tags_linked = get_the_tag_list($tag_link_matches[2], $tag_link_matches[4],
        $tag_link_matches[6]);
		$postinfo = preg_replace("/(.*)%tags-linked\((.*?)\)%(.*)/i", "\${1}" .
        $tags_linked. "\${3}", $postinfo);
	}



	// Tags, linked. If post has no tags, categories are displayed instead -  since WP 2.3
	if ( strpos($postinfo_string,'%tags-cats-linked') !== FALSE ) {
		$tag_link_options = preg_match("/(.*)%tags-cats-linked\('(.*?)'(.*?)'(.*?)'(.*?)'(.*?)'(.*)/i",
        $postinfo_string,$tag_link_matches);
		ob_start(); 
			the_tags($tag_link_matches[2], $tag_link_matches[4], $tag_link_matches[6]); 
			$tags_cats_linked = ob_get_contents(); 
		ob_end_clean();
		$postinfo = preg_replace("/(.*)%tags-cats-linked\((.*?)\)%(.*)/i", "\${1}" .
        $tags_cats_linked. "\${3}", $postinfo);
	}



	// Tags, not linked - since WP 2.3
	if ( strpos($postinfo_string,'%tags(') !== FALSE ) {
		
		$tag_options = preg_match("/(.*)%tags\('(.*?)'(.*?)'(.*?)'(.*?)'(.*?)'(.*)/i",
        $postinfo_string,$tag_matches);
		$posttags = get_the_tags();
		
		if ($posttags) { 
			foreach($posttags as $tag) {
			$tag_list .= $tag->name . $tag_matches[4]; 
			}
			// remove last separator
			$tag_list = preg_replace("/".$tag_matches[4]."$/mi", "", $tag_list);
			$tags = $tag_matches[2] . $tag_list . $tag_matches[6];
		} else { 
			$tags = ""; 
		}
		
		$postinfo = preg_replace("/(.*)%tags\((.*?)\)%(.*)/i", "\${1}" .$tags.
        "\${3}", $postinfo);
        
	}



	// 1st category
	if ( strpos($postinfo_string,'%category%') !== FALSE ) {
		$all_categories = get_the_category(); 
		$category = $all_categories[0]->cat_name;
		$category_notlinked = $category; 
		$postinfo = str_replace("%category%", $category_notlinked, $postinfo);
	}



	// 1st category, linked
	if ( strpos($postinfo_string,'%category-linked%') !== FALSE ) {
		$all_categories = get_the_category(); 
		$category = $all_categories[0]->cat_name;
		$category_linked = '<a href="' . get_category_link($all_categories[0]->cat_ID) .
        '">' . $category . '</a>';
		$postinfo = str_replace("%category-linked%", $category_linked, $postinfo);
	}



	// Categories, linked
	if ( strpos($postinfo_string,'%categories-linked') !== FALSE ) {
		$category_linked_separator = preg_match("/(.*)%categories-linked\('(.*?)'\)(.*)/i",
        $postinfo_string,$category_linked_matches);
		ob_start(); 
			the_category($category_linked_matches[2]);
      		$categories_linked = ob_get_contents();
		ob_end_clean();
		$postinfo = preg_replace("/(.*)%categories-linked\((.*?)\)%(.*)/i", "\${1}" .
        $categories_linked. "\${3}", $postinfo);
	}



	// Categories, not linked
	if ( strpos($postinfo_string,'%categories(') !== FALSE ) {
		$category_separator = preg_match("/(.*)%categories\('(.*?)'\)(.*)/i",
        $postinfo_string,$category_matches);
		$categories = "";
		foreach((get_the_category()) as $category) { 
			$categories .= $category->cat_name . $category_matches[2]; 
		} 
		// remove last separator
		$categories = preg_replace("/".$category_matches[2]."$/mi", "", $categories);
		$postinfo = preg_replace("/(.*)%categories\((.*?)\)%(.*)/i", "\${1}" .
        $categories. "\${3}", $postinfo);
	}



	// Comment link
	if ( strpos($postinfo_string,'%comments(') !== FALSE ) {
		$comment_options = preg_match("/(.*)%comments\('(.*?)'(.*?)'(.*?)'(.*?)'(.*?)'(.*?)'(.*?)'(.*)/i",
        $postinfo_string,$comment_matches);

		if ( !comments_open() AND $comment_matches[8] == "dontshow")  { 
			$comment_link = ''; 
		} else { 
			ob_start(); 
				comments_popup_link($comment_matches[2], $comment_matches[4],
         		 $comment_matches[6], 'comments-link', $comment_matches[8]);
				$comment_link = ob_get_contents(); 
			ob_end_clean(); 
		}
		$postinfo = preg_replace("/(.*)%comments\((.*?)\)%(.*)/i", "\${1}" .
        $comment_link. "\${3}", $postinfo); 
		if ( strpos($postinfo, "Leave a comment") == 0  && !is_home()  && !$main_category)
		{
			$postinfo .= ' | <a class="comments-link" href="' . get_permalink() . '#respond">Leave a comment</a>'; 
		}
      
	}



	// Comments Feed link
	if ( strpos($postinfo_string,'%comments-rss') !== FALSE ) {
		
		$comments_rss_link_text = preg_match("/(.*)%comments-rss\('(.*?)'(.*)/i",
        $postinfo_string,$comments_rss_matches);
        
		ob_start(); 
			//  "post_comments_feed_link" since WP 2.5, else "comments_rss_link"
			if ( function_exists('post_comments_feed_link') ) { 
				post_comments_feed_link($comments_rss_matches[2]); 
			} else { 
				comments_rss_link($comments_rss_matches[2]); 
			}
			$comments_rss_link = ob_get_contents(); 
		ob_end_clean();
		
		// make link nofollow if set in theme options
		if ( $bfa_ata['nofollow'] == "Yes" ) {
			$comments_rss_link = str_replace('href=', 'rel="nofollow" href=',
            $comments_rss_link);
		}
		
		$postinfo = preg_replace("/(.*)%comments-rss\((.*?)\)%(.*)/i", "\${1}" .
        $comments_rss_link. "\${3}", $postinfo);
	}



	// Trackback URL
	if ( strpos($postinfo_string,'%trackback%') !== FALSE ) {
		$trackback_url = trackback_url(FALSE);
		$postinfo = str_replace("%trackback%", $trackback_url, $postinfo);
	}



	// Trackback Link
	if ( strpos($postinfo_string,'%trackback-linked(') !== FALSE ) {
		$trackback_url = trackback_url(FALSE);
		$trackback_link_text = preg_match("/(.*)%trackback-linked\('(.*?)'(.*)/i",
        $postinfo_string,$trackback_matches);
		$trackback_link = '<a href="' . $trackback_url . '">' . $trackback_matches[2] . '</a>';
		
		// make link nofollow if set in theme options
		if ( $bfa_ata['nofollow'] == "Yes" ) {
			$trackback_link = str_replace('href=', 'rel="nofollow" href=', $trackback_link); 
		}
		
		$postinfo = preg_replace("/(.*)%trackback-linked\((.*?)\)%(.*)/i", "\${1}" .
        $trackback_link. "\${3}", $postinfo);
	}



	// Trackback RDF
	if ( strpos($postinfo_string,'%trackback-rdf%') !== FALSE ) {
		ob_start(); 
			trackback_rdf(); 
			$trackback_rdf = "<!-- " . ob_get_contents() . " -->"; 
		ob_end_clean();
		$postinfo = str_replace("%trackback-rdf%", $trackback_rdf, $postinfo);
	}



	// Permalink
	if ( strpos($postinfo_string,'%permalink%') !== FALSE ) {
		ob_start(); 
			the_permalink(); 
			$permalink = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%permalink%", $permalink, $postinfo);
	}



	// Post ID
	if ( strpos($postinfo_string,'%post-id%') !== FALSE ) {
		ob_start(); 
			the_ID(); 
			$post_id = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%post-id%", $post_id, $postinfo);
	}



	// Post Title
	if ( strpos($postinfo_string,'%post-title%') !== FALSE ) {
		ob_start(); 
			the_title(); 
			$post_title = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%post-title%", $post_title, $postinfo);
	}



	// Edit post
	if ( strpos($postinfo_string,'%edit(') !== FALSE ) {
		$edit_options = preg_match("/(.*)%edit\('(.*?)'(.*?)'(.*?)'(.*?)'(.*?)'(.*)/i",
        $postinfo_string,$edit_matches);
		ob_start(); 
			edit_post_link($edit_matches[4], $edit_matches[2], $edit_matches[6]);
        	$edit_link = ob_get_contents();
		ob_end_clean();
		$postinfo = preg_replace("/(.*)%edit\((.*?)\)%(.*)/i", "\${1}" .
        $edit_link. "\${3}", $postinfo);
	}



	// Print
	if ( strpos($postinfo_string,'%print(') !== FALSE ) {
		$print_text = preg_match("/(.*)%print\('(.*?)'(.*)/i",$postinfo_string,$print_text_matches);
		$print_link = '<a href="javascript:window.print()">' .$print_text_matches[2]. '</a>';
		$postinfo = preg_replace("/(.*)%print\((.*?)\)%(.*)/i", "\${1}" .
        $print_link. "\${3}", $postinfo);
	}



	// For the "WP-Email" plugin
	if ( strpos($postinfo_string,'%wp-email%') !== FALSE ) {
		$wp_email = ( function_exists('wp_email') ? email_link($email_post_text = '',
        $email_page_text = '', $echo = FALSE) : "" );
		$postinfo = str_replace("%wp-email%", $wp_email, $postinfo);
	}



	// For the "WP-Print" plugin
	if ( strpos($postinfo_string,'%wp-print%') !== FALSE ) {
		$wp_print = ( function_exists('wp_print') ? print_link($print_post_text = '',
        $print_page_text = '', $echo = FALSE) : "" );
		$postinfo = str_replace("%wp-print%", $wp_print, $postinfo);
	}



	// For the "WP-PostViews" plugin
	if ( strpos($postinfo_string,'%wp-postviews%') !== FALSE ) {
		$wp_postviews = ( function_exists('the_views') ? the_views($display = FALSE) : "" );
		$postinfo = str_replace("%wp-postviews%", $wp_postviews, $postinfo);
	}



	// For the "WP-PostRatings" plugin
	if ( strpos($postinfo_string,'%wp-postratings%') !== FALSE ) {
		$wp_postratings = ( function_exists('the_ratings') ?
        the_ratings($start_tag = 'span', $custom_id = 0, $display = FALSE) : "" );
		$postinfo = str_replace("%wp-postratings%", $wp_postratings, $postinfo);
	}



	// For the "Sociable" plugin
	if ( strpos($postinfo_string,'%sociable%') !== FALSE ) {
		$sociable = ( (function_exists('sociable_html2') AND
        function_exists('sociable_html'))? $sociable = sociable_html2() : "" );
		$postinfo = str_replace("%sociable%", $sociable, $postinfo);
	}



	// For the "Share This" plugin
	if ( strpos($postinfo_string,'%share-this%') !== FALSE ) {
		ob_start();
			if ( function_exists('sharethis_button') ) { 
				sharethis_button(); 
				$share_this = ob_get_contents(); 
			} else { 
				$share_this = ""; 
			}
		ob_end_clean();
		$postinfo = str_replace("%share-this%", $share_this, $postinfo);
	} 



	// Images
	if ( strpos($postinfo_string,'<image(') !== FALSE ) {
		$postinfo = preg_replace_callback("|<image\((.*?)\)>|","image_files",$postinfo);
	}



	/* The meta = ALL custom fields:values, formatted by Wordpress as
	unordered list <ul><li>..</li><li>..</li></ul> */
	if ( strpos($postinfo_string,'%meta%') !== FALSE ) {
		ob_start(); 
			the_meta(); 
			$the_meta = ob_get_contents(); 
		ob_end_clean();
		$postinfo = str_replace("%meta%", $the_meta, $postinfo);
	}



	// Single post meta values, not formatted
	if ( strpos($postinfo_string,'%meta(') !== FALSE ) {
		$postinfo = preg_replace_callback("|%meta\('(.*?)'\)%|","meta_values",$postinfo);
	}



	/* PHP code in Post Info Items.
	But not for WPMU */
	if ( !file_exists(ABSPATH."/wpmu-settings.php") ) {
		if ( strpos($postinfo_string,'<?php ') !== FALSE ) {
			ob_start(); 
				eval('?>'.$postinfo); 
				$postinfo = ob_get_contents(); 
			ob_end_clean();
		}
	}

	$postinfo = str_replace('|   |', ' |', $postinfo);

	return $postinfo;
	
}
?>