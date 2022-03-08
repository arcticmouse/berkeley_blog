<?php /* if index.php or another page template (copied from index.php) was not used
(i.e. by a plugin such as WPG2), the global $bfa_ata will be empty */
global $bfa_ata; if ($bfa_ata == "")
	include_once (TEMPLATEPATH . '/functions/bfa_get_options.php'); ?>
</td>
<!-- / Main Column -->

<?php if ( $bfa_ata['right_col2'] == "on" ) { ?>
<!-- Right Inner Sidebar -->
<td id="right-inner">

	<?php // Widgetize the Right Inner Sidebar
	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Inner Sidebar') ) : ?>

		<!-- No default content for the RIGHT INNER sidebar -->

	<?php endif; ?>

</td>
<!-- / Right Inner Sidebar -->
<?php } ?>

<?php if ( $bfa_ata['right_col'] == "on" ) { ?>
<!-- Right Sidebar -->
<td id="right">

<?php
// Author sampler
wp_reset_query();
if (is_home() )
{
	global $do_not_duplicate;
	
	//print '<table><td id="right-col">';
	print '<div class="featured_author_top">Author sampling</div>';
  
	$uid = $wpdb->get_col("SELECT ID FROM $wpdb->users WHERE user_status = 0");
	shuffle($uid);
	array_rand($uid);
	
	$curauth_array = array();
	
	print '<div class="featured_author_bottom">';
		
	// Loop through and find each author
	foreach($uid as $author)
	{
		$this_author = get_userdata($author);
		query_posts("author=$this_author->ID");
		if($this_author->user_level == 2  && have_posts() && $this_author->nickname != 'ovoices') 
		{
			$curauth_array[] = $this_author;
		}
	}
	
	$author_count = 0;
	
	foreach($curauth_array as $curauth)
	{
		if( !in_array($curauth->ID , $do_not_duplicate)  && $author_count < 8) 
		{
	
			$user_link = get_author_posts_url($curauth->ID);
			print '<div class="post">';
			
			print '<div class="post-headline">';
			userphoto_thumbnail($curauth->ID);
			print '</div>';
			
			print '<div class="post-byline">';
			print '<a href="' . $user_link . '" title="' . $curauth->display_name . '">';
			print $curauth->first_name . ' ' . $curauth->last_name; 
			print '</a>';
			if($curauth->nickname != $curauth->user_login)
			{
				print '<br />' . $curauth->nickname; 
			}
			print '</div>';
			
			query_posts("author=$curauth->ID");
			$post_count = 0;
			print '<div style="clear:both;"></div>';
			print '<div class="featured_author_posts">';
			while (have_posts()) : the_post();
				if($post_count < 1) 
				{	
					print  '<a href="';
					the_permalink(); 
					print '">';
					the_title();                
					print '</a>';
					$post_count = $post_count + 1;
				}
			endwhile;
			print '</div>';								
			print '</div>';
	
			$author_count = $author_count + 1;
		}
	}
	unset($uid,$curauth_array);	
	print '<p class="all_authors_link"><a href="/all-authors/">All Authors ></a></p>';
	print '</div>';	
	//print '</td></tr></table>';
}
else
{
	print '<div class="author_link_top">Our authors</div>';
	print '<div class="author_link_bottom">';
	if (!is_page('all-authors'))
	{
		
		print '<a href="/all-authors/" >
	<img src="/wp-content/themes/atahualpa/images/allauthors.gif" alt="All Authors"  width="29" height="29" border="0" id="all_authors_link"/></a><a href="/all-authors/" >All Authors</a>';
	}
		print '<p>More than 300 UC Berkeley scholars share their perspectives on local, national and global issues.</p>';
		print '</div>';
}
// end author sampler
?>

	<?php // Widgetize the Right Sidebar
	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Sidebar') ) : ?>

    	<div class="widget"><div class="widget-title">
    	<h3>Recent Posts</h3></div><div class="widget-content">
    	<?php $r = new WP_Query(array(
    		'showposts' => 20,
    		'what_to_show' => 'posts',
    		'nopaging' => 0,
    		'post_status' => 'publish',
    		'caller_get_posts' => 1));
    	if ($r->have_posts()) : ?>
    	<ul>
    	<?php  while ($r->have_posts()) : $r->the_post(); ?>
    	<li><a href="<?php the_permalink() ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?> </a></li>
    	<?php endwhile; ?>
    	</ul>
    	<?php wp_reset_query();  // Restore global post data stomped by the_post().
    	endif; ?>
    	</div></div>

    	<div class="widget"><div class="widget-title">
    	<?php wp_list_bookmarks('category_before=&category_after=&title_before=<h3>&title_after=</h3></div><div class="widget-content">'); ?>
    	</div></div>

    	<div class="widget"><div class="widget-title">
    	<h3><?php _e('Meta','atahualpa'); ?></h3>
    	</div><div class="widget-content">
    	<ul>
    		<?php wp_register(); ?>
    		<li><?php wp_loginout(); ?></li>
    		<li><a href="http://wordpress.org/" title="
    		<?php _e('Powered by WordPress, state-of-the-art semantic personal publishing platform.','atahualpa'); ?>">
    		<?php _e('WordPress','atahualpa'); ?></a></li>
    		<?php wp_meta(); ?>
    	</ul>
    	</div></div>

	<?php endif; ?>

	<?php
	// RSS feeds
	$thisRSSFeed = '<div id="rss_link">';
	if (is_category())
	{
		// Get RSS link for main category or question (subcategory)
		$thisRSSFeed .= '<a href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] . 'feed/" ><img src="/wp-content/themes/atahualpa/images/rss.gif" alt="RSS feed link" width="28" height="28" border="0"/>';
	}
	elseif (is_single())
	{
		// Get RSS link for question (subcategory)
		global $wp_query;
		$cat_obj = $wp_query->get_queried_object();	
		$cat_ID = wp_get_post_categories($cat_obj->ID);
		$category = get_category($cat_ID[0]);
		if($category->parent != 0)
		{
			$category_link = get_category_link($category->cat_ID);
		}
		else
		{
			$category = get_category($cat_ID[1]);
			$category_link = get_category_link($category->cat_ID);
		}
		$thisRSSFeed .= '<a href="' . $category_link . 'feed/"><img src="/wp-content/themes/atahualpa/images/rss.gif" alt="RSS feed link" width="28" height="28" border="0"/>';
	}
	elseif (is_author())
	{
		// Get RSS link for all posts by this author
		$thisRSSFeed .= '<a href="http://' .$_SERVER['SERVER_NAME'] . $_SERVER['REDIRECT_URL'] .'feed/"><img src="/wp-content/themes/atahualpa/images/rss.gif" alt="RSS feed link" width="28" height="28" border="0"/>';
	}
	else
	{
		// Get RSS link for all posts
		$thisRSSFeed .= '<a href="/feed/"><img src="/wp-content/themes/atahualpa/images/rss.gif" alt="RSS feed link" width="28" height="28" border="0"/>';
	}
	$thisRSSFeed .= 'RSS</a></div>';

	// print $thisRSSFeed;


		
	// Blogrolls for each category and post
	if (is_category() || is_single()  )
	{
		global $wp_query;

		if (is_single() )
		{
			$cat_obj = get_the_category();
			if($cat_obj[0]->parent != 0)
			{
				$cat_obj = get_category($cat_obj[0]->parent);
			}
		}
		else
		{
			$cat_obj = $wp_query->get_queried_object();
			if($cat_obj->parent != 0)
			{
				$cat_obj = get_category($cat_obj->parent);
			}
		}
		
		$bm = get_bookmarks( array(
				'orderby'        => 'name', 
				'order'          => 'ASC',
				'limit'          => -1, 
				'category'       => null,
				'category_name'  => $cat_obj->name, 
				'hide_invisible' => 1,
				'show_updated'   => 0, 
				'include'        => null,
				'exclude'        => null,
				'search'         => '.'));
				
		 if (!empty($bm))
		 {
			 print '<div id="blogroll" ><h5>Blogroll</h5><ul>';			
			 foreach ($bm as $bookmark)
			 { 
				print '<li><a href="' . $bookmark->link_url . '" target=_blank>' . $bookmark->link_name . '</a></li>';
			 }
			 print "</ul></div>";
		}
	}
	
	//Admin links	
	print '<div id="more_admin_links" ><h5>Admin</h5><ul>';
	/*
	?>
	<li><?php wp_loginout(); ?></li>
    <?php
    if ( is_user_logged_in() ) 
    { 		
		print '<li><a href="/whats-on-your-mind">Write a post</a></li>';
		print '<li><a href="/wp-admin/edit.php">Edit posts</a></li>';
		print '<li><a href="/wp-admin/profile.php">Edit profile</a></li>';	
		print '<li><a href="/how/">Help</a></li>';	
    }
	*/
	print 'Site update in progress. Please check back later.';
	print "</ul></div>";
    ?>
    
</td>
<!-- / Right Sidebar -->
<?php } ?>

</tr>
<!-- / Main Body -->
<tr>

<!-- Footer -->
<td id="footer" colspan="<?php echo $bfa_ata['cols']; ?>">

    <p>
    <?php echo bfa_footer($bfa_ata['footer_style_content']); ?>
    </p>
    <?php if ($bfa_ata['footer_show_queries'] == "Yes - visible") { ?>
    <p>
    <?php echo $wpdb->num_queries; ?><?php _e(' queries. ','atahualpa'); ?><?php timer_stop(1); ?><?php _e(' seconds.','atahualpa'); ?>
    </p>
    <?php } ?>

    <?php if ($bfa_ata['footer_show_queries'] == "Yes - in source code") { ?>
    <!--
    <?php echo $wpdb->num_queries; ?><?php _e(' queries. ','atahualpa'); ?><?php timer_stop(1); ?><?php _e(' seconds.','atahualpa'); ?>
    -->
    <?php } ?>

    <?php wp_footer(); ?>

</td>
<!-- / Footer -->

</tr>
</table><!-- / layout -->
</div><!-- / container -->
</div><!-- / wrapper -->
<?php echo ($bfa_ata['html_inserts_body_bottom'] != "" ? apply_filters(widget_text, $bfa_ata['html_inserts_body_bottom']) : ''); ?>
</body>
</html>