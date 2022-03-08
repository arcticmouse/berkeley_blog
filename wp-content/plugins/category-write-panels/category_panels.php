<?php
/*
Plugin Name: Category Write Panels
Plugin URI: http://www.seo-jerusalem.com/home/seo-friendly-web-development/wordpress-category-write-panels-plugin/
Description: DO NOT UPDATE. Modified by SL 8-23-10. Automaticly creates seperate write and edit panels for each category.  
Version: 1.0.2
Author: SEO Jerusalem
Author URI: http://www.seo-jerusalem.com
*/


// rearange the admin menu to add the custom panels
add_action('admin_head', 'cwp_do_panels');
// get the post category
add_action('admin_head-post-new.php', 'cwp_postcat');
add_action('admin_head-post.php', 'cwp_postcat');
add_action('admin_head-edit.php', 'cwp_postcat');
// modified category box
add_action('do_meta_boxes', 'cwp_categories');


function cwp_do_panels($hook) {
	global $menu, $submenu, $categories, $cwp_postcat, $user_ID;
	
	$the_user = get_userdata($user_ID); 
	// Hide Contact settings for authors
	if ($the_user->user_level == 2)
	{
		unset($menu[100]);
	}
	
	// Save dashboard
	$menu[0] = $menu[2];
	unset($menu[2]);
	
	// move second menu to bottom to make room
	$menu[1] = $menu[4];
	unset($menu[4]);
	// move posts menu to after pages
	$menu[24] = $menu[5];
	unset($menu[5]);
	// change posts menu to categories
	$menu[24][4] = 'menu-top';
	$menu[24][0] = 'Categories';
	// move menus to clear room for categories
	$menu[22] = $menu[10];
	unset($menu[10]);
	$menu[23] = $menu[15];
	unset($menu[15]);
	// give pages menu style for first item
	$menu[20][4] = 'open-if-no-js menu-top menu-top-first';

	
	// remove post parts from menu
	unset($submenu['edit.php'][5]);
	unset($submenu['edit.php'][10]);
	// SL:  do not remove categories from submenu
	//unset($submenu['edit.php'][15]);
	
	// get categories
	
	$newcats = array();
	
	//if (empty($cwp_postcat) || current_user_can( 'add_users' )) 
	if (empty($cwp_postcat) ) 
	{	
		// Get all the categories if this is the administrator
		$categories = get_categories('hide_empty=0');
		foreach ($categories as $cat) 
		{
			if ($cat->category_parent == 0) 
			{
			$newcats[] = $cat;
			}
		}
	}
	else
	{
		// Get only current category
		$selected_category = get_category($cwp_postcat);
		if ($selected_category->category_parent == 0)
		{
			$newcats[] = $selected_category;
		}
		else
		{
			$newcats[] = get_category($selected_category->category_parent);
		}
	}

	


	// the position we can start at in the $menu array
	$count = 2;
	
	foreach ($newcats as $cat) {			
		if ($count == 2) {
			$class = 'open-if-no-js menu-top menu-top-first';
		} else if( ($count -1) == count($newcats) ) {
			$class = 'menu-top  menu-top-last';
		} else {
			$class = 'menu-top';
		}
	
		$menu[$count] = array(
			$cat->name,
			'edit-' . $cat->slug, 
			'edit-' . $cat->slug,
			'',
			$class,
			'menu-pages-' . $cat->slug,
			'div'			
		);
			
		$submenu['edit-' . $cat->slug][0] = array(
			'Edit',
			'edit_posts',
			'edit.php?cat=' . $cat->term_id
		);
			
		$submenu['edit-' . $cat->slug][1] = array(
			'Add New',
			'edit_posts',
			'post-new.php?cat=' . $cat->term_id
		);			
			
		$count++;
		
	}
	
	// add seperator
	$menu[$count] = array(
		'',
		'edit_posts',
		'separator1.5',
		'',
		'wp-menu-separator'
	);

	// reorder menu based on keys	
	ksort($menu);	
}


function cwp_postcat() {
	// figure out what category we are dealing with
	global $cwp_postcat, $post, $cwp_postcatname, $title;
	if (is_numeric($_GET['cat'])) {
		$cwp_postcat = $_GET['cat'];
	} else {
		$cwp_postcat = wp_get_post_categories($post->ID);
		$cwp_postcat = $cwp_postcat[0];
	}
	if (empty($cwp_postcat)) {
		$cwp_postcat = (int) get_option('default_category');
	}

	// set page title	
	$cwp_postcatname = get_cat_name($cwp_postcat);
	$title = $title . ' &raquo; ' . $cwp_postcatname;
	
	//echo $cwp_postcat;
	
	echo '<style type="text/css">
		#category-' . $cwp_postcat . ' label, #category-' . $cwp_postcat . ' input {
			display: none;
		}
		#category-' . $cwp_postcat . ' {
			padding-left: 0;
			padding-right: 0;
		}
		#category-' . $cwp_postcat . ' ul {
			margin-left: 0 !important;
			margin-right: 0 !important;
		}
		#category-' . $cwp_postcat . ' ul label, #category-' . $cwp_postcat . ' ul input {
			display: inline;
		}		
		</style>';
}


function cwp_categories() {
	global $wp_meta_boxes;
	$wp_meta_boxes['post']['side']['core']['categorydiv']['callback'] = 'cwp_categories_meta_box';	
}

function cwp_categories_meta_box() {
	global $cwp_postcat, $post, $box;

// from function post_categories_meta_box	

	$defaults = array('taxonomy' => 'category');
	if ( !isset($box['args']) || !is_array($box['args']) )
		$args = array();
	else
		$args = $box['args'];
	extract( wp_parse_args($args, $defaults), EXTR_SKIP );
	$tax = get_taxonomy($taxonomy);

	?>
	<div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv">
		<ul id="<?php echo $taxonomy; ?>-tabs" class="category-tabs">
			<li class="tabs"><a href="#<?php echo $taxonomy; ?>-all" tabindex="3"><?php echo $tax->labels->all_items; ?></a></li>
			<li class="hide-if-no-js"><a href="#<?php echo $taxonomy; ?>-pop" tabindex="3"><?php _e( 'Most Used' ); ?></a></li>
		</ul>

		<div id="<?php echo $taxonomy; ?>-pop" class="tabs-panel" style="display: none;">
			<ul id="<?php echo $taxonomy; ?>checklist-pop" class="categorychecklist form-no-clear" >
				<?php $popular_ids = wp_popular_terms_checklist($taxonomy); ?>
			</ul>
		</div>

		<div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">
			<?php
            $name = ( $taxonomy == 'category' ) ? 'post_category' : 'tax_input[' . $taxonomy . ']';
            echo "<input type='hidden' name='{$name}[]' value='0' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.
            ?>
			<ul id="<?php echo $taxonomy; ?>checklist" class="list:<?php echo $taxonomy?> categorychecklist form-no-clear">
				<?php 
				// Custom code goes here
				if (is_numeric($_GET['cat'])) {
					$cats = array($cwp_postcat);		
				} else {
				$cats = wp_get_post_categories($post->ID); 
				}
				if (empty($cats)){
					$cats = array($cwp_postcat);
				}
				
				//wp_category_checklist($post->ID, $cwp_postcat, $cats, $popular_ids)
				wp_terms_checklist($post->ID, array( 'selected_cats' => $cats, 'taxonomy' => $taxonomy, 'popular_cats' => $popular_ids ) ) 
				?>
			</ul>
		</div>

	</div>
	<?php
}

function cwp_popular_terms_checklist( $taxonomy, $default = 0, $number = 10, $echo = true ) {
	global $post_ID, $cwp_postcat;
	if ( $post_ID )
		$checked_categories = wp_get_post_categories($post_ID);
	else
		$checked_categories = array();
	$categories = get_terms( $taxonomy, array( 'orderby' => 'count', 'order' => 'DESC', 'number' => $number, 'hierarchical' => false, 'child_of' => $cwp_postcat ) );

	$popular_ids = array();
	foreach ( (array) $categories as $category ) {
		$popular_ids[] = $category->term_id;
		if ( !$echo ) // hack for AJAX use
			continue;
		$id = "popular-category-$category->term_id";
		?>

		<li id="<?php echo $id; ?>" class="popular-category">
			<label class="selectit">
			<input id="in-<?php echo $id; ?>" type="checkbox" value="<?php echo (int) $category->term_id; ?>" />
				<?php echo esc_html( apply_filters( 'the_category', $category->name ) ); ?>
			</label>
		</li>

		<?php
	}
	return $popular_ids;
}
?>