<?php // create new text widgets
function widget_text($args, $widget_args = 1) {
	extract( $args, EXTR_SKIP );
	if ( is_numeric($widget_args) )
		$widget_args = array( 'number' => $widget_args );
	$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
	extract( $widget_args, EXTR_SKIP );

	$options = get_option('widget_text');
	if ( !isset($options[$number]) )
		return;

	$title = apply_filters('widget_title', $options[$number]['title']);
	$text = apply_filters( 'widget_text', $options[$number]['text'] );
?>
		<?php echo $before_widget; ?>
			<?php if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
			<div class="textwidget"><?php echo $text; ?></div>
		<?php if ( !empty( $title ) ) { echo $after_widget; } else { echo "</div>"; } ?>
<?php
}
// create new text widget controls
function widget_text_control($widget_args = 1) {
	global $wp_registered_widgets;
	static $updated = false;

	if ( is_numeric($widget_args) )
		$widget_args = array( 'number' => $widget_args );
	$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
	extract( $widget_args, EXTR_SKIP );

	$options = get_option('widget_text');
	if ( !is_array($options) )
		$options = array();

	if ( !$updated && !empty($_POST['sidebar']) ) {
		$sidebar = (string) $_POST['sidebar'];

		$sidebars_widgets = wp_get_sidebars_widgets();
		if ( isset($sidebars_widgets[$sidebar]) )
			$this_sidebar =& $sidebars_widgets[$sidebar];
		else
			$this_sidebar = array();

		foreach ( $this_sidebar as $_widget_id ) {
			if ( 'widget_text' == $wp_registered_widgets[$_widget_id]['callback'] && isset($wp_registered_widgets[$_widget_id]['params'][0]['number']) ) {
				$widget_number = $wp_registered_widgets[$_widget_id]['params'][0]['number'];
				if ( !in_array( "text-$widget_number", $_POST['widget-id'] ) ) // the widget has been removed.
					unset($options[$widget_number]);
			}
		}

		foreach ( (array) $_POST['widget-text'] as $widget_number => $widget_text ) {
			if ( !isset($widget_text['text']) && isset($options[$widget_number]) ) // user clicked cancel
				continue;
			$title = strip_tags(stripslashes($widget_text['title']));
			if ( current_user_can('unfiltered_html') )
				$text = stripslashes( $widget_text['text'] );
			else
				$text = stripslashes(wp_filter_post_kses( $widget_text['text'] ));
			$options[$widget_number] = compact( 'title', 'text' );
		}

		update_option('widget_text', $options);
		$updated = true;
	}

	if ( -1 == $number ) {
		$title = '';
		$text = '';
		$number = '%i%';
	} else {
		$title = attribute_escape($options[$number]['title']);
		$text = format_to_edit($options[$number]['text']);
	}
?>
		<p>
			<input class="widefat" id="text-title-<?php echo $number; ?>" name="widget-text[<?php echo $number; ?>][title]" type="text" value="<?php echo $title; ?>" />
			<textarea class="widefat" rows="16" cols="20" id="text-text-<?php echo $number; ?>" name="widget-text[<?php echo $number; ?>][text]"><?php echo $text; ?></textarea>
			<input type="hidden" name="widget-text[<?php echo $number; ?>][submit]" value="1" />
		</p>
<?php
}

// unregister old / register new text widgets

function widget_text_un_re_register() {
	if ( !$options = get_option('widget_text') )
		$options = array();
	$widget_ops = array('classname' => 'widget_text', 'description' => __('Arbitrary text or HTML','atahualpa'));
	$control_ops = array('width' => 400, 'height' => 350, 'id_base' => 'text');
	$name = __('Text','atahualpa');

	$id = false;
	foreach ( array_keys($options) as $o ) {
		// Old widgets can have null values for some reason
		if ( !isset($options[$o]['title']) || !isset($options[$o]['text']) )
			continue;
		$id = "text-$o"; // Never never never translate an id
		unregister_sidebar_widget($id, $name, 'wp_widget_text', $widget_ops, array( 'number' => $o ));
		unregister_widget_control($id, $name, 'wp_widget_text_control', $control_ops, array( 'number' => $o ));
		wp_register_sidebar_widget($id, $name, 'widget_text', $widget_ops, array( 'number' => $o ));
		wp_register_widget_control($id, $name, 'widget_text_control', $control_ops, array( 'number' => $o ));
	}

	// If there are none, we register the widget's existance with a generic template
	if ( !$id ) {
		unregister_sidebar_widget( 'text-1', $name, 'wp_widget_text', $widget_ops, array( 'number' => -1 ) );
		unregister_widget_control( 'text-1', $name, 'wp_widget_text_control', $control_ops, array( 'number' => -1 ) );
		wp_register_sidebar_widget( 'text-1', $name, 'widget_text', $widget_ops, array( 'number' => -1 ) );
		wp_register_widget_control( 'text-1', $name, 'widget_text_control', $control_ops, array( 'number' => -1 ) );
	}
}
add_action( 'widgets_init', 'widget_text_un_re_register' )
?>