<?php 	/* get all options: */
include (TEMPLATEPATH . '/functions/bfa_get_options.php');

$image_path = '/images/';

get_header(); 

?>



<?php /* If there are any posts: */

if (have_posts() || is_author() || is_category() ) : $bfa_ata['postcount'] == 0; /* Postcount needed for option "XX first posts full posts, rest excerpts" */ 

?>

	<?php /* This outputs the next/previous post or page navigation. 
	This can be edited at Atahualpa Theme Options -> Style & edit the Center column */
	//bfa_center_content($bfa_ata['content_above_loop']); ?>

<?php 

$main_category = FALSE;
$with_comments_form = TRUE;

// *************************
// Home
// *************************
if(is_home())
{ 
	// page id wrapper
	print '<div id="home">';
	print '<div class="posts_top">Recent posts';
	print '<div id="small_email_link"><a href="/subscribe-by-email/">Subscribe by Email</a></div>';
	print '<div id="small_rss_link"><a href="/feed/">
	<img src="/wp-content/themes/atahualpa/images/rss18.png" alt="RSS feed link" title="Subscribe to all posts" width="18" height="18" border="0"/></a><a href="/feed/">RSS</a>
	
	</div>
	<div id="social">
	<a href="http://www.facebook.com/UCBerkeley"><img src="/wp-content/themes/atahualpa/images/facebook18.png" alt="Facebook" title="Like UC Berkeley on Facebook" width="18" height="18" border="0"/></a>
<a href="https://twitter.com/#!/UCBerkeley"><img src="/wp-content/themes/atahualpa/images/twitter18.png" alt="Twitter" title="Follow UC Berkeley on Twitter" width="18" height="18" border="0"/></a>
<a href="https://www.youtube.com/channel/UCZAXKyvvIV4uU4YvP5dmrmA/"><img src="/wp-content/themes/atahualpa/images/youtube18.png" alt="YouTube" title="UC Berkeley video channel" width="18" height="18" border="0"/></a>
<a href="http://e-news.berkeley.edu/"><img src="/wp-content/themes/atahualpa/images/berkeleyan18.png" alt="Berkeleyan" title="The Berkeyelan e-Newsletter" width="18" height="18" border="0"/></a>
	</div>
	</div>';
	//print '<h2>Topical questions, campus experts, public opinion</h2>'; 
	//print '<table id="home_current_posts"><tr><td id="left-col">';	
	print '<div class="posts_bottom">';

   $post_count = 0;
   $do_not_duplicate = array();

}

// *************************
// Main or subcategory
// *************************
if (is_category() || is_tag() ) 
{
  $main_category = TRUE;
  global $wp_query;
  $cat_obj = $wp_query->get_queried_object();
  // Set for comments if this is subcategory, without form
  if($cat_obj->parent != 0)
  {
      $withcomments = TRUE;
      $withtruncation = TRUE;
      $with_comments_form = FALSE;
      $main_category = FALSE;
  } 

  // page id wrapper
  if($main_category || is_tag())
  {
    print '<div id="main_category">';
  }
  else
  {
		$parent_category = get_category($cat_obj->parent);
		// Question
		 print '<div id="sub_category">';
		 
		print '<div class="posts_top">' . $parent_category->description .'</div>';
		print '<div class="posts_bottom">';
		
		print '<div id="question">';
		print '<div class="sbl"><div class="sbr"><div class="stl"><div class="str"><h1>' . $cat_obj->description .' ';
		
		if ($cat_obj->description != "Arts, Culture &amp; Humanities: What's on your mind?" &&
			$cat_obj->description != "Business &amp; Economics: What's on your mind?" &&
			$cat_obj->description != "Energy &amp; Environment: What's on your mind?" &&
			$cat_obj->description != "Health &amp; Medicine: What's on your mind?" &&
			$cat_obj->description != "Politics &amp; Law: What's on your mind?" &&
			$cat_obj->description != "Science &amp; Technology: What's on your mind?" &&
			$cat_obj->description != "Other Subjects: What's on your mind?")
		  {	  
		  		print '<span class="question_date">(' . date('F j, Y', strtotime(substr($cat_obj->slug,0,8))) . ')</span>';
		  }
		
		// rss
		print '<div id="small_email_link"><a href="/subscribe-by-email/">Subscribe by Email</a></div>';
		print '<div id="small_rss_link"><a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] . 'feed/" ><img src="/wp-content/themes/atahualpa/images/rss-yellow.gif" alt="RSS feed link" width="14" height="14" border="0"/></a><a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] . 'feed/" >RSS</a></div>';
		
		if ( is_user_logged_in() ) 
		{
		print  ' <span class="post_link">| <a href="/wp-admin/post-new.php?cat=' . $cat_obj->cat_ID .'">Write a post</a></span>';
		}
	
		print '</h1></div></div></div></div></div><div class="sb">&nbsp;</div>';
		if($_REQUEST[full] != 1)
 		{
			print '<p class="read_full"><a href="http://' .$_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] .'?full=1">' .  'Read full discussion ></a></p>';
		}
	}
}


// *************************
// Main category
// *************************
if($main_category || is_tag() )

	if ($_REQUEST[full] == 1)
	{
		if (is_tag() )
		{
			print '<div class="posts_top"><h2>All posts in tag: ' . $cat_obj->name .'</h2></div>';
		}
		else
		{
			print '<div class="posts_top"><h2>All posts in ' . $cat_obj->description .'</h2></div>';
		}
		print '<div class="posts_bottom">';
	}
	else
	{
		if (is_tag() )
		{
			print '<div class="posts_top"><h2>All posts in tag: ' . $cat_obj->name .'';
		}
		else
		{
			print '<div class="posts_top"><h2>' . $cat_obj->description .'';
		}
		print '<div id="small_email_link"><a href="/subscribe-by-email/">Subscribe by Email</a></div>';
		print '<div id="small_rss_link"><a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] . 'feed/" ><img src="/wp-content/themes/atahualpa/images/rss18.png" alt="RSS feed link" title="Subscribe to ' . $cat_obj->description .' posts" width="18" height="18" border="0"/></a><a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] . 'feed/" >RSS</a></div></h2></div>';
		print '<div class="posts_bottom">';
	}

{
  $categories = get_categories('child_of='.$cat_obj->cat_ID); 
  $questions_unsorted = array();
  $mind_question = array();
  foreach($categories as $subcategory)
  {
     if ($subcategory->description == "Arts, Culture &amp; Humanities: What's on your mind?" ||
			$subcategory->description == "Business &amp; Economics: What's on your mind?" ||
			$subcategory->description == "Energy &amp; Environment: What's on your mind?" ||
			$subcategory->description == "Health &amp; Medicine: What's on your mind?" ||
			$subcategory->description == "Politics &amp; Law: What's on your mind?" ||
			$subcategory->description == "Science &amp; Technology: What's on your mind?" ||
			$subcategory->description == "Other Subjects: What's on your mind?")
	{
		$mind_question = $subcategory;
	}
	else
	{
	 	$questions_unsorted[$subcategory->slug] = $subcategory;
	}
	
  }
  
  krsort($questions_unsorted);
  $questions = array();
  foreach($questions_unsorted as $subcategory)
  {
      $questions[] = $subcategory;
  }

   if($_REQUEST[full] != 1)
   {
     if ($questions[0]->cat_ID != '')
     {
       $recentquestion_id = $questions[0]->cat_ID;
     }
   }

   $post_count = 0;
   $do_not_duplicate_posts = array();
   
   if (!have_posts() && !is_author())
   {
   		print '<p class="no_posts_yet">There are no posts on this topic yet.</p>';
   }
}

// *************************
// Subcategory (question page)
// *************************
if(!$main_category && is_category())
{
  if($_REQUEST[full] == 1)
  {
	  $withtruncation = FALSE;
  }
  
   if (!have_posts())
   {
   		print '<p class="no_posts_yet">There are no posts on this topic yet.</p>';
   }
}

// **************************
// All Questions
// **************************
if(is_page('whats-on-your-mind'))
{
print '<div id="write_a_post">';
print '<div class="posts_top"><h1>Write a post on a subject below</h1></div>';
print '<div class="posts_bottom">';

print 'Site update in progress. Please check back later.</div></div>';
  
 /* $categories = get_categories("hide_empty=0"); 
  $questions_unsorted = array();
  $main_categories = array();
  foreach($categories as $subcategory)
  {
      // Get subcategories only
      if($subcategory->parent !=0 &&
	  	($subcategory->description == "Arts, Culture &amp; Humanities: What's on your mind?" ||
			$subcategory->description == "Business &amp; Economics: What's on your mind?" ||
			$subcategory->description == "Energy &amp; Environment: What's on your mind?" ||
			$subcategory->description == "Health &amp; Medicine: What's on your mind?" ||
			$subcategory->description == "Politics &amp; Law: What's on your mind?" ||
			$subcategory->description == "Science &amp; Technology: What's on your mind?" ||
			$subcategory->description == "Other Subjects: What's on your mind?"))
      {
         $questions_unsorted[$subcategory->slug] = $subcategory;
      }

  }
  
  krsort($questions_unsorted);
  $questions = array();
  print '<table id="all_questions">';
  foreach($questions_unsorted as $subcategory)
  {
	   $parent_category = get_category($subcategory->parent); 
	   if ($subcategory->count > 0)
	   {
	   		$question_link = '<a href="' . get_category_link($subcategory->cat_ID) .'">'; 
	   }
	   else
	   {
	   		$question_link = '';
	   }
	   	   
	   print  '<td class:><a href="' . get_category_link($parent_category->cat_ID) . '">' . $parent_category->description . '</a></td>';
	  // print  '<td>' . $question_link . $subcategory->description . '</a></td>';
	   //if ( is_user_logged_in() ) { ... }
	   print  '<td nowrap><a href="/wp-admin/post-new.php?cat=' . $subcategory->cat_ID .'"> Write a post</a></td></tr>';
  }
   print "</table>";
   
     print '<p><a href = "/all-questions/">Previous questions ></a></p></div></div>';
	 */
}



// **************************
// All Questions
// **************************
if(is_page('all-questions'))
{
  print '<div id="all-questions">';	
  print '<div class="posts_top"><h1>All Questions</a></h1></div>';
  print '<div class="posts_bottom">';
  print '<p><a href = "/whats-on-your-mind/">What\'s on Your Mind?</a></p>';
  
  $categories = get_categories("hide_empty=0"); 
  $questions_unsorted = array();
  $main_categories = array();
  foreach($categories as $subcategory)
  {
      // Get subcategories only
      if($subcategory->parent !=0 &&
	  		$subcategory->description != "Arts, Culture &amp; Humanities: What's on your mind?" &&
			$subcategory->description != "Business &amp; Economics: What's on your mind?" &&
			$subcategory->description != "Energy &amp; Environment: What's on your mind?" &&
			$subcategory->description != "Health &amp; Medicine: What's on your mind?" &&
			$subcategory->description != "Politics &amp; Law: What's on your mind?" &&
			$subcategory->description != "Science &amp; Technology: What's on your mind?" &&
			$subcategory->description != "Other Subjects: What's on your mind?")
      {
         $questions_unsorted[$subcategory->slug] = $subcategory;
      }

  }
  krsort($questions_unsorted);
  $questions = array();
  print '<table id="all_questions">';
  foreach($questions_unsorted as $subcategory)
  {
	   $parent_category = get_category($subcategory->parent); 
	   if ($subcategory->count > 0)
	   {
	   		$question_link = '<a href="' . get_category_link($subcategory->cat_ID) .'">'; 
	   }
	   else
	   {
	   		$question_link = '';
	   }
	   	   
	   print  '<tr><td nowrap>' .  date('n-j-y', strtotime(substr($subcategory->slug,0,8))) . '</td>';
	   print  '<td class:><a href="' . get_category_link($parent_category->cat_ID) . '">' . $parent_category->description . '</a></td>';
	   print  '<td>' . $question_link . $subcategory->description . '</a></td>';
	   //if ( is_user_logged_in() ) { ... }
	   print  '<td nowrap><a href="/wp-admin/post-new.php?cat=' . $subcategory->cat_ID .'"> Write a post</a></td></tr>';
  }
   print "</table></div></div>";
 
}


// **************************
// Author Archive
// ***********************
if(is_author())
{ 
    
	print '<div class="posts_top">Our cast of authors</div>';
  	print '<div class="posts_bottom">';
	
	// page id wrapper
    print '<div id="author">'; 

    if(isset($_GET['author_name'])) :
        $curauth = get_userdatabylogin($author_name);
    else :
        $curauth = get_userdata(intval($author));
    endif;
	
	if ($curauth->nickname == 'ovoices')
	{
		print "<h1>$curauth->first_name $curauth->last_name</h1>";
	}
	else
	{
   	  print "<h1>$curauth->first_name $curauth->last_name, $curauth->nickname</h1>";  
	}
	userphoto($wp_query->get_queried_object());
	
	$order   = array("\r\n\r\n", "\n\n", "\r\r");
	$replace = '</p><p>';
	$bio = str_replace($order, $replace, $curauth->user_description);
	print '<div id="bio"><p>' .  $bio . '</p></div>';

	//if($curauth->user_url !='')
	//{
		//print '<p><a href="' . $curauth->user_url . '">More about our author ></a></p>';		
	//} 
	if (function_exists('wp_authorbox')) echo wp_authorbox();
	print '<div style="clear:both;"></div>';
	
	if (have_posts())
	{	
		print "<h3>Posts by $curauth->first_name $curauth->last_name";
		
		// Get RSS link for all posts by this author
		print '<div id="small_rss_link"><a href="http://' .$_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] .'feed/"><img src="/wp-content/themes/atahualpa/images/rss-white.gif" alt="RSS feed link" width="14" title="Subscribe to posts by '. $curauth->first_name . ' ' . $curauth->last_name . '" height="14" border="0"/></a><a href="http://' .$_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] .'feed/">RSS</a></div></h3>';
		
		print '<table>';
		// The LOOP. Do this for all posts:
		while (have_posts()) : the_post(); $bfa_ata['postcount']++;		
			print '<tr>';
			
			ob_start(); 
				the_time('n-j-y'); 
				$thisDate = ob_get_contents(); 
			ob_end_clean(); 
			print '<td>' . $thisDate . '</td>';
			
			ob_start(); 
				the_category( '</td><td>');
				$thisCategory = ob_get_contents(); 
			ob_end_clean();
			print '<td>' . $thisCategory . '</td>';
			
			ob_start(); 
				the_title();
				$thistitle = ob_get_contents(); 
			ob_end_clean();
			$this_post_link = get_permalink();
			print '<td><a href="' . $this_post_link . '">' . $thistitle . '</a></td>';
			
			print '</tr>';
		endwhile;
		print '</table>';
	}
	print '</div>';
}


// **************************
// All Author Photos Au Natural
// added some css in atahualpa theme options
// ***********************
if(is_page('all-author-photos-au-naturale')) :
			echo 'test';
			$args = array(
				'fields' => 'id'
			);
			$users = get_users($args);
			
			foreach($users as $user){
				echo '<div class="author_photos_au_natural">';
				echo esc_html_e( get_the_author_meta( 'first_name', $user ) . ' ' . get_the_author_meta( 'last_name', $user ), 'textdomain' ) . '<br>';
				userphoto($user);
				echo '</div>';
			}
endif;


// **************************
// All Authors
// ***********************
if(is_page('all-authors')) :

  // page id wrapper
  print '<div id="all_authors">'; 
 
  print '<div class="posts_top"><h1>Our cast of authors</h1></div>';
  print '<div class="posts_bottom">';

// Get the authors from the database ordered by user nicename
	global $wpdb;
	//$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY user_nicename";
	$query = "SELECT * from $wpdb->users ORDER BY user_nicename";

	$author_ids = $wpdb->get_results($query);
	
	$curauth_array = array();
	
	// Loop through and find each author
	foreach($author_ids as $author)
	{
		$this_author = get_userdata($author->ID);
		if($this_author->user_level == 2  && $this_author->nickname != 'ovoices') 
		{
			$curauth_array[] = $this_author;
		}
	}
	
	// Sort by last name
	function compare($x, $y)
	{
	 if ( strtolower($x->last_name) == strtolower($y->last_name) )
		  if ( strtolower($x->first_name) == strtolower($y->first_name) )
		  return 0;
		 else if ( strtolower($x->first_name) < strtolower($y->first_name) )
		  return -1;
		 else
		  return 1;
	 else if ( strtolower($x->last_name) < strtolower($y->last_name) )
	  return -1;
	 else
	  return 1;
	}		
	usort($curauth_array, 'compare');
	
	foreach($curauth_array as $curauth)
	{
		// Only print active authors
		if ($curauth->user_description != '')
		{
			$user_link = get_author_posts_url($curauth->ID);
			print '<div class="post"><h3>';
			print '<a href="' . $user_link . '" title="' . $curauth->display_name . '">';
			print $curauth->first_name . ' ' . $curauth->last_name; 
			if($curauth->nickname != $curauth->user_login)
			{
				print ', ' . $curauth->nickname; 
			}		
			print '</a></h3>';
			userphoto_thumbnail($curauth->ID);
			$this_description = truncateStringOnBoundary($curauth->description, 450);
			print $this_description;	
			if ($curauth->description != ''  && $curauth->description != $this_description)
			{						
				if ( substr_count($curauth->description, '</em>') != substr_count($this_description, '</em>'))
				{
					// close the <em> tag
					print '</em>'; 
				}
				if ( substr_count($curauth->description, '</a>') != substr_count($this_description, '</a>'))
				{
					// close the <a href> tag
					print '</a>'; 
				}
				print '<a href="' . $user_link . '">More ></a>'; 		
			}
			print '<div style="clear:both;"></div>';
			print '</div>';
		}	
	}
print '</div>';
endif; 

?>


<?php
// **************************
// Single Post
// ***********************
if (is_single())
{
  // page id wrapper
  print '<div id="single">'; 
  
  $post_obj = $wp_query->get_queried_object();
  $cat_ID = wp_get_post_categories($post_obj->ID);
  $category = get_category($cat_ID[0]);

  if($category->parent == 0)
  {
	$this_main_category = $category;
	$category = get_category($cat_ID[1]);
  }
  else
  {
  	$this_main_category = get_category($category->parent);
  }

  // Main Category
  print '<div class="posts_top">' . $this_main_category->description .'</div>';
  print '<div class="posts_bottom">';
   
   // Question  
   if ($category->description != "Arts, Culture &amp; Humanities: What's on your mind?" &&
			$category->description != "Business &amp; Economics: What's on your mind?" &&
			$category->description != "Energy &amp; Environment: What's on your mind?" &&
			$category->description != "Health &amp; Medicine: What's on your mind?" &&
			$category->description != "Politics &amp; Law: What's on your mind?" &&
			$category->description != "Science &amp; Technology: What's on your mind?" &&
			$category->description != "Other Subjects: What's on your mind?")
		  {	
		  print '<div id="question"><div class="sbl"><div class="sbr"><div class="stl"><div class="str"><h2><a href="' . get_category_link($category->cat_ID) .'">' .  $category->description . '</a> ';
		  print '<span class="question_date">(' . date('F j, Y', strtotime(substr($category->slug,0,8))) . ')</span>';
		  print '<div id="small_email_link"><a href="/subscribe-by-email/">Subscribe by Email</a></div>';
		  print '<div id="small_rss_link"><a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] . 'feed/" ><img src="/wp-content/themes/atahualpa/images/rss-yellow.gif" alt="RSS feed link" width="14" height="14" border="0"/></a><a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] . 'feed/" >RSS</a></div>';
		  if ( is_user_logged_in() ) 
			{
				print  ' <span class="post_link">| <a href="/wp-admin/post-new.php?cat=' . $category->cat_ID .'">Write a post</a></span>';
			}
   print '</h2></div></div></div></div></div><div class="sb">&nbsp;</div>';
	
	
   print '<p class="read_full"><a href="' . get_category_link($category->cat_ID) .'?full=1">' .  "Read full discussion ></a></p>";
       $footer_after_comments .= '<p class="read_full"><a href="' . get_category_link($category->cat_ID) .'?full=1">' .  "Read full discussion ></a></p>";
		  } 
}

// Search Results
if ( is_search() || is_page('Search'))
{
     print '<div class="posts_top">Search Results</div>';
     print '<div class="posts_bottom">';
     print '<style>.post-headline {display:none !important;} div.post table td {border:none;}</style>';
}
?>

	<?php /* The LOOP starts here. Do this for all posts: */
	while (have_posts()) : the_post(); $bfa_ata['postcount']++; ?>

<?php
// Limit posts on home and main category pages; otherwise print all posts
//if ( (in_category($recentquestion_id) && $post_count < 3) || ( !is_home() && !$main_category) && !is_page('all-authors') && !is_page('all-questions') && !is_page('whats-on-your-mind') && !is_author() )

if ( 
	((is_home() && $post_count < 9) || 
	($main_category && $post_count < 9 && $_REQUEST[full] != 1) ||
	(!$main_category && in_category($recentquestion_id) && $post_count < 3) ||
	(!is_home() && !$main_category))
	 && 
		!is_page('all-authors') && 
		!is_page('all-questions') && 
		!is_page('whats-on-your-mind') && 
		!is_author()  
	) 
{
	$post_count = $post_count + 1; 
	$do_not_duplicate_posts[] = $post->ID; 
	$do_not_duplicate[] = $post->post_author; 	
?>

		<?php /* Add Odd or Even post class so post containers can get alternating CSS style (optional) */
		$odd_or_even = (($bfa_ata['postcount'] % 2) ? 'odd-post' : 'even-post' ); ?> 

        
        <?php /* This is the actual Wordpress LOOP. 
		The output can be edited at Atahualpa Theme Options -> Style & edit the Center column */	
		bfa_center_content($bfa_ata['content_inside_loop']); ?>
        
        <?php    
        if (is_home() && $post_count == 1)
		{									

			if (function_exists('best_of_comments') )
			{
				//Featured comments(s)
				ob_start(); 
					best_of_comments();	
					$featured_content = ob_get_contents(); 
				ob_end_clean();
				if ($featured_content != '')
				{
					print '<div class="editor_selected_comment">' . $featured_content . '</div>';
				} 				
			}
			
			if(function_exists('featuredposts') && $featured_content == '' )
			{ 
				//Featured post(s)
				ob_start(); 
					featuredposts(); 
					$featured_content = ob_get_contents(); 
				ob_end_clean();				
				if ($featured_content != '')
				{
					print '<div class="editor_selected_post">';
					print '<span class="editor_selected_content_top">Featured post: </span>';
					print '<span class="editor_selected_content_bottom">';
					print $featured_content;
					print '</span></div>'; 
				}				
			}	
		}
        ?>

<?php
	if(is_single())
   {
		print '<div id="addthis">';
			//do_action( 'addthis_widget' ); 
		print "<script type=\"text/javascript\">var addthis_pub=\"ucberkeley\"; var addthis_options = 'digg, email, facebook, furl, google, linkedin, myspace, stumbleupon, twitter, more';</script>";
   		 print "<a href=\"http://www.addthis.com/bookmark.php\" onmouseover=\"return addthis_open(this, '', '[URL]', '[TITLE]')\" onmouseout=\"addthis_close()\" onclick=\"return addthis_sendto()\"><img src=\"http://s7.addthis.com/static/btn/lg-share-en.gif\" width=\"125\" height=\"16\" border=\"0\" alt=\"Bookmark and Share\" style=\"margin-bottom: -2px; margin-right: 10px; margin-left: 3px; margin-top: 4px\"/></a><script type=\"text/javascript\" src=\"http://s7.addthis.com/js/152/addthis_widget.js\"></script>";
		print '</div>';
	}
   
   if($withcomments)
   {				
		bfa_get_comments();	
		print $footer_after_comments;	  
   }  
}
?>

						
	<?php /* END of the LOOP */
	endwhile; ?>
    
 

<?php

   $withcomments = FALSE;  //reset so that we do not get an extra comment

// *************************
// Main category
// *************************
if ($main_category)
  {   	
	
	$post_count = 0;

	while (have_posts()) : the_post(); $bfa_ata['postcount']++; 
		if (!in_array($post->ID , $do_not_duplicate_posts) )
		{
			// heading for first one
			if ($post_count == 0 && $_REQUEST[full] != 1)
			{
				//print '<h2>Additional Posts</h2>';
				print '<a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] . '?full=1"  onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage(\'Image12\',\'\',\'/images/add-posts-on.gif\',12)">
<img src="/wp-content/themes/atahualpa/images/add-posts.gif" alt="Additional posts" name="Image12" width="130" height="40" border="0" id="Image12" /></a></h1>'; 
			}
			

			if ($_REQUEST[full] == 1)
			{
				print '<h2 class="additional_discussions">';
				print '<span class="additional_discussions_question_date">' . date('F j, Y', strtotime(substr($post->post_date,0,10))) . ' | </span>';
				print  '<a href="';
				the_permalink(); 
				print '">';
				the_title();                
				print '</a></h2>';
				$post_count = $post_count + 1;
			}
			else
			{
				$more_posts = TRUE;
				break;
			}
		}
 	endwhile;
	
	
	if($_REQUEST[full] != 1  && have_posts())
	{
		 if (is_tag() )
		 {
		 	 print ' <p><a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] . '?full=1">See all posts in tag: '. $cat_obj->name .' ></a></p>';
		 }
		 else
		 {
			 print ' <p><a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] . '?full=1">See all posts in '. $cat_obj->description .' ></a></p>';
		}
	 }
	 print "</div>";
}

// *************************
// Subcategory  (question page)
// *************************
if (is_category() and !$main_category)
{ 
	if($_REQUEST[full] != 1)
	{
		print '<p class="read_full"><a href="http://' .$_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] .'?full=1">' .  'Read full discussion ></a></p></div></div>';
	} 
}

// *************************
// Home
// *************************
if (is_home() )
{ 
		
	//print '</td></tr></table>';
	print '</div>';
	
	print '<div id="more_posts">';
	print '<div class="posts_top">More posts</div>';
	print '<div class="posts_bottom">';
	print '<ul>';
	print '<li><a href="/category/arts/">
	Arts, Culture, &amp; Humanities
	</a></li>
	<li><a href="/category/economics/">Economics
	</a></li>
	<li><a href="/category/energy/">Energy &amp; Environment
	</a></li>
	<li><a href="/category/health/">Health &amp; Medicine
	</a></li>
	<li><a href="/category/politics/">Politics &amp; Law
	</a></li>
	<li><a href="/category/science/">Science &amp; Technology
	</a></li>
	<li><a href="/category/othersubjects/">Other Subjects
	</a></li>';
	print '</ul></div></div>';

}

?>


	<?php /* This outputs the next/previous post or page navigation and the comment template.
	This can be edited at Atahualpa Theme Options -> Style & edit the Center column */
	if(!is_home() && !is_author() && !is_category() ) 
	{
		bfa_center_content($bfa_ata['content_below_loop']); 
	}
	?>

<?php /* END of: If there are any posts */
else : /* If there are no posts: */ ?>

<?php /* This outputs the "Not Found" content, if neither posts, pages nor attachments are available for the requested page.
This can be edited at Atahualpa Theme Options -> Style & edit the Center column */
bfa_center_content($bfa_ata['content_not_found']); ?>

<?php endif; /* END of: If there are no posts */ ?>

<?php   
   // link to full discussion from single post
   if (is_single() || is_search() )
   {
	  /* This outputs the next/previous post or page navigation. 
	  This can be edited at Atahualpa Theme Options -> Style & edit the Center column */
	  //bfa_center_content($bfa_ata['content_above_loop']);
	  print $footer_after_comments;	
		
	  print '</div>';  
   }
?>

<?php bfa_center_content($bfa_ata['center_content_bottom']); ?>


<?php
// closing page id wrapper
if(is_home() || is_category() || is_author() || is_page('all-authors') || is_single())
{
   print '</div><!--page id wrapper-->';
}
?>

<?php get_footer(); ?>
