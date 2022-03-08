<?php
function bfa_header_config($header_items) {

global $bfa_ata;

// Page Menu Bar
if ( strpos($header_items,'%pages') !== FALSE OR strpos($header_items,'%page-center') !== FALSE OR strpos($header_items,'%page-right') !== FALSE ) {

	$page_menu_bar = '<div id="menu1">';
	
	// Left, Right or Centered
	if ( strpos($header_items,"%page-right") !== FALSE ) {
		$page_menu_bar .= '<ul id="rmenu2" class="clearfix rMenu-hor rMenu-hRight rMenu">' . "\n";
	} elseif ( strpos($header_items,"%page-center") !== FALSE ) {
		$page_menu_bar .= '<table cellpadding="0" cellspacing="0" style="margin: 0 auto"><tr><td align="center">
		<ul id="rmenu2" class="clearfix rMenu-hor rMenu">' . "\n";
	} else {
		$page_menu_bar .= '<ul id="rmenu2" class="clearfix rMenu-hor rMenu">' . "\n";	
	}
	
	
	// "Home" Link?
	if ( $bfa_ata['home_page_menu_bar'] != '' ) {
		$page_menu_bar .= '<li class="page_item';
		if (function_exists('is_front_page')) {
			if ( is_front_page() ) { 
				$page_menu_bar .= ' current_page_item';
			}
		} elseif ( is_home() ) { 
			$page_menu_bar .= ' current_page_item';	
		}
		$page_menu_bar .= '"><a href="' . $bfa_ata['get_option_home'] . '/" title="' . $bfa_ata['bloginfo_name'] . '">' . 
		$bfa_ata['home_page_menu_bar'] . '</a></li>' . "\n";	
	}
	
	// Empty setting "levels" same as 0
	if ( $bfa_ata['levels_page_menu_bar'] == '' ) {
		$bfa_ata['levels_page_menu_bar'] = 0; 
	}	
	
	$page_menu_bar .= bfa_hor_pages($bfa_ata['sorting_page_menu_bar'], $bfa_ata['levels_page_menu_bar'], 
	$bfa_ata['titles_page_menu_bar'], $bfa_ata['exclude_page_menu_bar']);
	
	// Close table if centered
	if ( strpos($header_items,"%page-center") !== FALSE ) {
		$page_menu_bar .= '</ul></td></tr></table></div>' . "\n";
	} else {
		$page_menu_bar .= '</ul></div>' . "\n";
	}

}




// Category Menu Bar 
if ( strpos($header_items,'%cats') !== FALSE OR strpos($header_items,'%cat-center') !== FALSE OR strpos($header_items,'%cat-right') !== FALSE ) {

	$cat_menu_bar = '<div id="menu2">';

	if ( strpos($header_items,"%cat-right") !== FALSE ) {	
		$cat_menu_bar .= '<ul id="rmenu" class="clearfix rMenu-hor rMenu-hRight rMenu">' . "\n";
	} elseif ( strpos($header_items,"%cat-center") !== FALSE ) {	
		$cat_menu_bar .= '<table cellpadding="0" cellspacing="0" style="margin: 0 auto"><tr><td align="center">
		<ul id="rmenu" class="clearfix rMenu-hor rMenu">' . "\n";
	} else {
		$cat_menu_bar .= '<ul id="rmenu" class="clearfix rMenu-hor rMenu">' . "\n";
	}	
	
	// Home Link?	
	if ( $bfa_ata['home_cat_menu_bar'] != '' ) {
		$cat_menu_bar .= '<li class="cat-item';
		if ( function_exists('is_front_page') ) {
			if ( is_front_page() OR is_home() ) { 
				$cat_menu_bar .= ' current-cat';
			}
		} elseif ( is_home() ) { 
			$cat_menu_bar .= ' current-cat';	
		}
	$cat_menu_bar .= '"><a href="' . $bfa_ata['get_option_home'] . '/" title="' . $bfa_ata['bloginfo_name'] . '">' . 
	$bfa_ata['home_cat_menu_bar'] . '</a></li>' . "\n";	
	}	

	// Empty setting "levels" same as 0
	if ( $bfa_ata['levels_cat_menu_bar'] == '' ) {
		$bfa_ata['levels_cat_menu_bar'] = 0; 
	}	
	
	// Create menu list
	$cat_menu_bar .= bfa_hor_cats($bfa_ata['sorting_cat_menu_bar'], $bfa_ata['order_cat_menu_bar'], 
	$bfa_ata['levels_cat_menu_bar'], $bfa_ata['titles_cat_menu_bar'], $bfa_ata['exclude_cat_menu_bar']);
	
	// Close table if centered
	if ( strpos($header_items,"%cat-center") !== FALSE ) {
		$cat_menu_bar .= '</ul></td></tr></table></div>' . "\n";
	} else {
		$cat_menu_bar .= '</ul></div>' . "\n";
	}
	
}




// Logo Area 
if ( strpos($header_items,'%logo') !== FALSE ) {
		
	$logo_area .= '<table id="logoarea" cellpadding="0" cellspacing="0" border="0" width="100%"><tr>';
	
	if ( $bfa_ata['show_search_box'] == "Yes" AND ($bfa_ata['show_posts_icon'] == "Yes" OR 
	$bfa_ata['show_email_icon'] == "Yes" OR $bfa_ata['show_comments_icon'] == "Yes") ) { 
		$header_rowspan = 'rowspan="2" '; 
	} else { 
		$header_rowspan = ''; 
	}

		// Logo Icon for Wordpress and WPMU
		if ( $bfa_ata['logo'] == "" )  
		{
			//$logo_area .= '<td ' . $header_rowspan . 'class="logoarea-logo">';
			$logo_area .= '<td valign="top">';
			$logo_area .= '<table id="above_banner"><tr><td><div id="links_above_banner"><a href="http://www.berkeley.edu">UC Berkeley</a> | <a href="http://newscenter.berkeley.edu">NewsCenter</a></div></td>';	
			
			// Search box
			if ( $bfa_ata['show_search_box'] == "Yes" ) 
			{ 
				$logo_area .= '<td valign="bottom" class="search-box" align="right" nowrap height="100%">';
				/*
				$logo_area .= '<div class="searchbox">
					<form method="get" class="searchform" action="' . get_bloginfo( 'url' ) . '/">
					<div class="searchbox-form">' .
						'<input type="text" name="s" size="17" align="bottom"/>' .
					'&nbsp;<input class="go" name="Submit" type="image" src="/wp-content/themes/atahualpa/images/bearpaw.gif" alt="Go" align="bottom"/>
	
					</div>
					</form>
				</div>
				</td>';
				*/
				
				$logo_area .= '<div class="searchbox">				
				<form action="' . get_bloginfo( 'url' ) . '/search/" id="searchform">
					<div class="searchbox-form">
						<input type="hidden" name="cx" value="005819902514904969462:iqgkgzcqbsm" />
						<input type="hidden" name="cof" value="FORID:9" />
						<input type="hidden" name="ie" value="UTF-8" />
						<input type="text" name="q" id="s"  />
						<input class="go" name="sa" type="image" src="/wp-content/themes/atahualpa/images/bearpaw.gif" alt="Go" align="bottom" />
					</div>
				</form>				
				<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=searchform&lang=en">
				</script>';
				$logo_area .= '</div></td>';
			} 
			$logo_area .= '</tr>';			
			$logo_area .= '</table>';			
			$logo_area .= '</td>';
		}
		else
		{
		//if ( $bfa_ata['logo'] != "" ) { 
			$logo_area .= '<td ' . $header_rowspan . 'valign="middle" class="logoarea-logo">';
			
			if(is_home() )
			{
				$logo_area .= '<h1>';
			}
			$logo_area .= '<a href="' . $bfa_ata['get_option_home'] . '/"><img class="logo" src="';

				// if this is WordPress MU 
				if ( file_exists(ABSPATH."/wpmu-settings.php") ) {
					// two ways to figure out the upload path on WPMU, first try easy version 1, :
					$upload_path1 = ABSPATH . get_option('upload_path');
					// Try the hard way, version 2: 
					$upload_path2 = str_replace('themes/' . get_option('stylesheet') . 
					'/functions', '', $_SERVER['DOCUMENT_ROOT']) . 
					'/wp-content/blogs.dir/' . $wpdb->blogid . '/files';
					// see if user has uploaded his own "logosymbol.gif" somewhere into his upload folder, version 1:
					$wpmu_logosymbol = m_find_in_dir($upload_path1,$bfa_ata['logo']); $upload_path = $upload_path1;
					// try version 2 if no logosymbol.gif was found:
					if ( !$wpmu_logosymbol ) {
						$wpmu_logosymbol = m_find_in_dir($upload_path2,$bfa_ata['logo']); $upload_path = $upload_path2;
					}
					
					// if we found logosymbol.gif one way or another, figure out the public URL
					if ( $wpmu_logosymbol ) {
						$new_logosymbol = str_replace($upload_path,
						get_option('fileupload_url'), $wpmu_logosymbol); 
						$logo_area .= $new_logosymbol[0] . '" alt="' . $bfa_ata['bloginfo_name'];
					// otherwise: print the one in the theme folder
					} else { 
						$logo_area .= $bfa_ata['template_directory'] . '/images/' . $bfa_ata['logo'] . 
						'" alt="' . $bfa_ata['bloginfo_name']; 
					}

				// if this is Wordpress and not WPMU, print the logosymbol.gif in the theme folder right away
				} else { 
					if(is_home() )
					{
						//images/banr-home.gif
						//$logo_area .= $bfa_ata['template_directory'] . '/images/' . 'banr-home.gif' . '" alt="' . 
						$logo_area .= $bfa_ata['template_directory'] . '/images/' . 'bnr.png' . '" alt="' . 
						$bfa_ata['bloginfo_name']; 
					}
					//Add category title to blog title
					elseif(is_category() || is_single() )
					{
						global $wp_query;
						$cat_obj = $wp_query->get_queried_object();	

						if (is_single())
						{
							// single post
							$cat_ID = wp_get_post_categories($cat_obj->ID);
							$category = get_category($cat_ID[0]);
							
							if($category->parent != 0)
							{
								$parent_category = get_category($category->parent);
								$category_text = $parent_category->description;
								$category_slug = $parent_category->slug;
								$category_link = get_category_link($parent_category->cat_ID);
							}
							else
							{
								$category_text = $category->description;
								$category_slug = $category->slug;
								$category_link = get_category_link($category->cat_ID);
							}
						}
						else
						{				
							if($cat_obj->parent != 0) 
							{
								// question 
								$parent_category = get_category($cat_obj->parent);
								$category_text = $parent_category->description;
								$category_slug = $parent_category->slug;
								$category_link = get_category_link($parent_category->cat_ID);				
							}
							else
							{
								// main category
								$category_text = $cat_obj->description;
								$category_slug = $cat_obj->slug;
								$category_link = get_category_link($cat_obj->cat_ID);
							}
						}	
						
						
						//if ($category_slug && $category_slug != '')
						//{
						//	$logo_area .= $bfa_ata['template_directory'] . '/images/banr-' . $category_slug . '.gif' . '" alt="' . 
						//$bfa_ata['bloginfo_name']; 
						//}
						//else
						//{
							$logo_area .= $bfa_ata['template_directory'] . '/images/' . $bfa_ata['logo'] . '" alt="' . 
						$bfa_ata['bloginfo_name']; 
											
						//}
					}
					else
					{	
						$logo_area .= $bfa_ata['template_directory'] . '/images/' . $bfa_ata['logo'] . '" alt="' . 
						$bfa_ata['bloginfo_name']; 
					}
				} 

		$logo_area .= '" /></a>';
		if(is_home() )
		{
			$logo_area .= '</h1>';
		}
		$logo_area .= '</td>';
		
		} 
		
		//Add category title to blog title
		if(is_category() || is_single() )
		{
			global $wp_query;
 			$cat_obj = $wp_query->get_queried_object();			
			if (is_single())
			{
				// single post
				$cat_ID = wp_get_post_categories($cat_obj->ID);
				$category = get_category($cat_ID[0]);
				
				if($category->parent != 0)
				{
					$parent_category = get_category($category->parent);
					$category_text = $parent_category->description;
					$category_slug = $parent_category->slug;
					$category_link = get_category_link($parent_category->cat_ID);
				}
				else
				{
					$category_text = $category->description;
					$category_slug = $category->slug;
					$category_link = get_category_link($category->cat_ID);
				}	
			}
			else
			{				
				if($cat_obj->parent != 0) 
				{
					// question 
					$parent_category = get_category($cat_obj->parent);
					$category_text = $parent_category->description;
					$category_link = get_category_link($parent_category->cat_ID);
				}
				else
				{
					// main category
					$category_text = $cat_obj->description;
					$category_link = get_category_link($cat_obj->cat_ID);
				}
			}			 
			$bfa_ata['bloginfo_name'] = $bfa_ata['bloginfo_name'] . ' | <a href="'  . $category_link . '">' . $category_text . '</a>';
		}

		// Blog title and description
		if ( $bfa_ata['blog_title_show'] == "Yes" OR $bfa_ata['blog_tagline_show'] == "Yes" ) {
			
			$logo_area .= '<td ' . $header_rowspan . 'valign="middle" class="logoarea-title">';
			
			if ( $bfa_ata['blog_title_show'] == "Yes" ) {
				$logo_area .= '<h' . $bfa_ata['h_blogtitle'] . ' class="blogtitle"><a href="' . 
				$bfa_ata['get_option_home'] . '/">' . $bfa_ata['bloginfo_name'] . '</a></h' . $bfa_ata['h_blogtitle'] . '>'; 
			}
			
			if ( $bfa_ata['blog_tagline_show'] == "Yes" ) {
				$logo_area .= '<p class="tagline">' . $bfa_ata['bloginfo_description'] . '</p>'; 
			}
			
			$logo_area .= '</td>';
		}




		// is any feed icon or link active?
		if ( $bfa_ata['show_posts_icon'] == "Yes" OR $bfa_ata['show_email_icon'] == "Yes" OR 
		$bfa_ata['show_comments_icon'] == "Yes" ) {
			$logo_area .= '<td class="feed-icons" valign="middle" align="right"><div class="clearfix rss-box">';
		}



		// COMMENT Feed link
		if ( $bfa_ata['show_comments_icon'] == "Yes" ) { 
			
			$logo_area .= '<a class="comments-icon" '; 
			
			if ( $bfa_ata['nofollow'] == "Yes" ) { 
				$logo_area .= 'rel="nofollow" '; 
			} 
			
			$logo_area .= 'href="' . $bfa_ata['bloginfo_comments_rss2_url'] . '" title="' . 
			$bfa_ata['comment_feed_link_title'] . '">' . $bfa_ata['comment_feed_link'] . '</a>';
			
		} 


		
		// Feedburner Email link
		if ( $bfa_ata['show_email_icon'] == "Yes" ) { 
			
			$logo_area .= '<a class="email-icon" '; 
			
			if ( $bfa_ata['nofollow'] == "Yes" ) { 
				$logo_area .= 'rel="nofollow" '; 
			} 
			
			$logo_area .= 'href="http://' . ($bfa_ata['feedburner_old_new'] == 'New - at feedburner.google.com' ? 
			'feedburner.google.com/fb/a/mailverify?uri=' : 'www.feedburner.com/fb/a/emailverifySubmit?feedId=') . 
			$bfa_ata['feedburner_email_id'] . '&amp;loc=' . get_locale() . '" title="' . 
			$bfa_ata['email_subscribe_link_title'] . '">' . $bfa_ata['email_subscribe_link'] . '</a>';
			
		} 

	
		
		// POSTS Feed link
		if ( $bfa_ata['show_posts_icon'] == "Yes" ) { 
			
			$logo_area .= '<a class="posts-icon" '; 
			
			if ( $bfa_ata['nofollow'] == "Yes" ) { 
				$logo_area .= 'rel="nofollow" '; 
			} 
			
			$logo_area .= 'href="' . $bfa_ata['bloginfo_rss2_url'] . '" title="' . 
			$bfa_ata['post_feed_link_title'] . '">' . 
			$bfa_ata['post_feed_link'] . '</a>';
			
		} 



		if ( $bfa_ata['show_posts_icon'] == "Yes" OR $bfa_ata['show_email_icon'] == "Yes" OR 
		$bfa_ata['show_comments_icon'] == "Yes" ) {
			$logo_area .= '</div></td>';
			if ( $bfa_ata['show_search_box'] == "Yes" ) { 
				$logo_area .= '</tr><tr>';
			}
		}	
		
		$logo_area .= '</tr>';
		$logo_area .= '<tr><td><a href="/index.php"/><img src="/wp-content/themes/atahualpa/images/clear.gif" id="home_link" alt="Nav: Home" /></a></td></tr>';
		$logo_area .= '</table>';
			
	// category navigation
    $logo_area .= '<div id="category_tabs">
	<ul>
	<li><h4><a href="/category/arts/" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'Image1\',\'\',\'/wp-content/themes/atahualpa/images/t-arts-on.png\',1)"><img src="/wp-content/themes/atahualpa/images/t-arts.png" alt="Arts, Culture, &amp; Humanities" name="Image1" width="138" height="36" border="0" id="Image1" />
</a></h4></li>

<li><h4><a href="/category/economics/" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'Image2\',\'\',\'/wp-content/themes/atahualpa/images/t-business-on.png\',2)">
<img src="/wp-content/themes/atahualpa/images/t-business.png" alt="Business &amp; Economics" name="Image2" width="138" height="36" border="0" id="Image2" />
</a></h4></li>

<li><h4><a href="/category/energy/" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'Image3\',\'\',\'/wp-content/themes/atahualpa/images/t-energy-on.png\',3)">
<img src="/wp-content/themes/atahualpa/images/t-energy.png" alt="Energy &amp; Environment" name="Image3" width="138" height="36" border="0" id="Image3" />
</a></h4></li>

<li><h4><a href="/category/health/" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'Image4\',\'\',\'/wp-content/themes/atahualpa/images/t-health-on.png\',4)">
<img src="/wp-content/themes/atahualpa/images/t-health.png" alt="Health &amp; Medicine" name="Image4" width="138" height="36" border="0" id="Image4" />
</a></h4></li>

<li><h4><a href="/category/politics/" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'Image6\',\'\',\'/wp-content/themes/atahualpa/images/t-politics-on.png\',6)">
<img src="/wp-content/themes/atahualpa/images/t-politics.png" alt="Politics &amp; Law" name="Image6" width="138" height="36" border="0" id="Image6" />
</a></h4></li>

<li><h4><a href="/category/science/" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'Image5\',\'\',\'/wp-content/themes/atahualpa/images/t-science-on.png\',5)">
<img src="/wp-content/themes/atahualpa/images/t-science.png" alt="Science &amp; Technology" name="Image5" width="138" height="36" border="0" id="Image5" />
</a></h4></li>

<li><h4><a href="/category/othersubjects/" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'Image11\',\'\',\'/wp-content/themes/atahualpa/images/t-other-on.png\',11)"><img src="/wp-content/themes/atahualpa/images/t-other.png" alt="Any Subject" name="Image11" width="138" height="36" border="0" id="Image11" />
</a></h4></li>
</ul>
</div>';

	
}




// Header Image
if ( strpos($header_items,'%image') !== FALSE ) {

	$bfa_header_images = bfa_rotating_header_images();
	if(is_home() )
	{
		//images/banr-home.gif
		$header_image = '<div id="imagecontainer" class="header-image-container" style="background: url(' . 
		'/wp-content/themes/atahualpa/images/bnr.png' . ') ' . $bfa_ata['headerimage_alignment'] . ' no-repeat;">';
	}		
	//Add category title to blog title
	elseif(is_category() || is_single() )
	{
		global $wp_query;
		$cat_obj = $wp_query->get_queried_object();			
		if (is_single())
		{
			// single post
			$cat_ID = wp_get_post_categories($cat_obj->ID);
			$category = get_category($cat_ID[0]);
			$parent_category = get_category($category->parent);
			$category_text = $parent_category->description;
			$category_slug = $parent_category->slug;
			$category_link = get_category_link($parent_category->cat_ID);
		}
		else
		{				
			if($cat_obj->parent != 0) 
			{
				// question 
				$parent_category = get_category($cat_obj->parent);
				$category_text = $parent_category->description;
				$category_slug = $parent_category->slug;
				$category_link = get_category_link($parent_category->cat_ID);				
			}
			else
			{
				// main category
				$category_text = $cat_obj->description;
				$category_slug = $cat_obj->slug;
				$category_link = get_category_link($cat_obj->cat_ID);
			}
		}			 
		//$bfa_ata['bloginfo_name'] = $bfa_ata['bloginfo_name'] . ' | <a href="'  . $category_link . '">' . $category_text . '</a>';
		$header_image = '<div id="imagecontainer" class="header-image-container" style="background: url(' . 
		//'/wp-content/themes/atahualpa/images/banr-' . $category_slug . '.gif' . ') ' . $bfa_ata['headerimage_alignment'] . ' no-repeat; background-color: #d4ab3d;">';
		'/wp-content/themes/atahualpa/images/bnr.png' . ') ' . $bfa_ata['headerimage_alignment'] . ' no-repeat; background-color: #d4ab3d;">';
	}
	else
	{
		$header_image = '<div id="imagecontainer" class="header-image-container" style="background: url(' . 
		$bfa_header_images[array_rand($bfa_header_images)] . ') ' . $bfa_ata['headerimage_alignment'] . ' no-repeat; background-color: #d4ab3d;">';
	}	
	
	$header_image .= ($bfa_ata['header_image_clickable'] == "Yes" ? '<div class="clickable">
		<a class="divclick" title="' . $bfa_ata['bloginfo_name'] . '" href ="' . $bfa_ata['get_option_home'] . '/">&nbsp;</a></div>' : '' );

		if ( $bfa_ata['header_opacity_left'] != 0 AND $bfa_ata['header_opacity_left'] != '' ) { 
			$header_image .= '<div class="opacityleft">&nbsp;</div>';
		}

		if ( $bfa_ata['header_opacity_right'] != 0 AND $bfa_ata['header_opacity_right'] != '' ) { 
			$header_image .= '<div class="opacityright">&nbsp;</div>';
		}
		// END: If Header Opacity 

		if ( $bfa_ata['overlay_blog_title'] == "Yes" OR $bfa_ata['overlay_blog_tagline'] == "Yes" ) {
			$header_image .= '<div class="titleoverlay">' . 
			( $bfa_ata['overlay_blog_title'] == "Yes" ? '<h' . $bfa_ata['h_blogtitle'] . ' class="blogtitle"><a href="' . $bfa_ata['get_option_home'] . '/">' . 
			$bfa_ata['bloginfo_name'] . '</a></h' . $bfa_ata['h_blogtitle'] . '>' : '' ) . ( $bfa_ata['overlay_blog_tagline'] == "Yes" ? '<p class="tagline">' . 
			$bfa_ata['bloginfo_description'] . '</p>' : '' ) . '</div>';
		}

	$header_image .= '</div>';

}




// Horizontal bar 1
if ( strpos($header_items,'%bar1') !== FALSE ) {
	$horizontal_bar1 = '<div class="horbar1">&nbsp;</div>';
}



// Horizontal bar 2
if ( strpos($header_items,'%bar2') !== FALSE ) {
	$horizontal_bar2 = '<div class="horbar2">&nbsp;</div>';
}


$header_item_numbers = array(
	"%pages", 
	"%page-center", 
	"%page-right", 
	"%cats", 
	"%cat-center", 
	"%cat-right", 
	"%logo", 
	"%image", 
	"%bar1", 
	"%bar2"
	);
	
$header_output = array(
	$page_menu_bar, 
	$page_menu_bar, 
	$page_menu_bar, 
	$cat_menu_bar, 
	$cat_menu_bar, 
	$cat_menu_bar, 
	$logo_area, 
	$header_image, 
	$horizontal_bar1, 
	$horizontal_bar2
	);

// Parse PHP code
if ( strpos($header_items,'<?php ') !== FALSE ) {
	ob_start(); 
		eval('?>'.$header_items); 
		$header_items = ob_get_contents(); 
	ob_end_clean();
}


$header_items = trim($header_items);
#$header_items = str_replace(" ", "", $header_items);
$final_header = str_replace($header_item_numbers, $header_output, $header_items);

		
echo $final_header;




}
?>