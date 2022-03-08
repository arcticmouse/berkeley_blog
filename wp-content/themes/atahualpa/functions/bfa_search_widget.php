<?php // create new search widget
function widget_search($args) {
	extract($args);
	$searchform_template = get_template_directory() . '/searchform.php';
	
	echo $before_widget;
	
	// Use current theme search form if it exists
	if ( file_exists($searchform_template) ) {
		include_once($searchform_template);
        
	} else { ?>
		<form id="searchform" method="get" action="<?php bloginfo('url'); ?>/"><div>
			<label class="hidden" for="s"><?php _e('Search for:','atahualpa'); ?></label>
			<input type="text" name="s" id="s" size="15" value="<?php the_search_query(); ?>" />
			<input type="submit" value="<?php echo attribute_escape(__('Search','atahualpa')); ?>" />
		</div></form>
<?php }
	echo "</div>";
}
?>
<?php // unregister old / register new search widget
	$widget_ops = array('classname' => 'widget_search', 'description' => __( "A search form for your blog","atahualpa") );
	unregister_sidebar_widget('search', __('Search','atahualpa'), 'wp_widget_search', $widget_ops);
	wp_register_sidebar_widget('search', __('Search','atahualpa'), 'widget_search', $widget_ops);
?>