<?php
/** CAUTION:  EDIT THIS SECTION AT YOUR OWN RISK **/
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 */
function my_theme_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'UCB Brand Component - Bulleted List Block', // The plugin name.
			'slug'               => 'ucbbrand-component_list', // The plugin slug (typically the folder name).
			'source'             => $plugin_dir = ABSPATH . 'wp-content/plugins/ucbbrand-component_list.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'UCB Brand Component - Events List', // The plugin name.
			'slug'               => 'ucbbrand-component_events_list', // The plugin slug (typically the folder name).
			'source'             => $plugin_dir = ABSPATH . 'wp-content/plugins/ucbbrand-component_events_list.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'UCB Brand Component - Events RSS', // The plugin name.
			'slug'               => 'ucbbrand-component_events_rss', // The plugin slug (typically the folder name).
			'source'             => $plugin_dir = ABSPATH . 'wp-content/plugins/ucbbrand-component_events_rss.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'UCB Brand Component - Photo', // The plugin name.
			'slug'               => 'ucbbrand-component_photo', // The plugin slug (typically the folder name).
			'source'             => $plugin_dir = ABSPATH . 'wp-content/plugins/ucbbrand-component_photo.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'UCB Brand Component - Promo', // The plugin name.
			'slug'               => 'ucbbrand-component_promo', // The plugin slug (typically the folder name).
			'source'             => $plugin_dir = ABSPATH . 'wp-content/plugins/ucbbrand-component_promo.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'UCB Brand Component - Quote', // The plugin name.
			'slug'               => 'ucbbrand-component_quote', // The plugin slug (typically the folder name).
			'source'             => $plugin_dir = ABSPATH . 'wp-content/plugins/ucbbrand-component_quote.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'UCB Brand Component - Thumb List', // The plugin name.
			'slug'               => 'ucbbrand-component_thumblist', // The plugin slug (typically the folder name).
			'source'             => $plugin_dir = ABSPATH . 'wp-content/plugins/ucbbrand-component_thumblist.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'UCB Brand Component - Twitter Feed', // The plugin name.
			'slug'               => 'ucbbrand-component_twitterfeed', // The plugin slug (typically the folder name).
			'source'             => $plugin_dir = ABSPATH . 'wp-content/plugins/ucbbrand-component_twitterfeed.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'UCB Brand Component - Video', // The plugin name.
			'slug'               => 'ucbbrand-component_video', // The plugin slug (typically the folder name).
			'source'             => $plugin_dir = ABSPATH . 'wp-content/plugins/ucbbrand-component_video.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		/*array(
			'name'               => 'Page Builder Sandwich', // The plugin name.
			'slug'               => 'page-builder-sandwich', // The plugin slug (typically the folder name).
			'source'             => $plugin_dir = ABSPATH . 'wp-content/plugins/page-builder-sandwich.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '1.1.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),*/
		array(
			'name'         => 'Alien Ship Shortcodes', // The plugin name.
			'slug'         => 'alienship-shortcodes', // The plugin slug (typically the folder name).
			'source'       => $plugin_dir = ABSPATH . 'wp-content/plugins/alienship-shortcodes.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
			'external_url' => 'https://www.johnparris.com/deliver/wordpress/plugins/alienship-shortcodes/alienship-shortcodes.latest.zip', // If set, overrides default API URL and points to an external URL.
		),
		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Bootstrap Shortcodes',
			'slug'      => 'bootstrap-shortcodes',
			'required'  => true,
		),
		array(
			'name'      => 'Image Widget',
			'slug'      => 'image-widget',
			'required'  => true,
		),
		array(
			'name'      => 'Jetpack',
			'slug'      => 'jetpack',
			'required'  => true,
		),
		array(
			'name'      => 'List Category Posts',
			'slug'      => 'list-category-posts',
			'required'  => true,
		),
		array(
			'name'      => 'Max Mega Menu',
			'slug'      => 'megamenu',
			'required'  => true,
		),
		array(
			'name'      => 'Post Snippets',
			'slug'      => 'post-snippets',
			'required'  => true,
		),

	);

	/*
	 * Array of configuration settings. 
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

add_action( 'after_setup_theme', 'childtheme_formats', 11 );
function childtheme_formats(){
     add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'video', 'audio' ) );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function rename_post_formats( $safe_text ) {
    if ( $safe_text == 'Aside' )
        return 'Accordion';
    return $safe_text;
}
add_filter( 'esc_html', 'rename_post_formats' );
//rename Aside in posts list table
function live_rename_formats() {
    global $current_screen;
    if ( $current_screen->id == 'edit-post' ) { ?>
        <script type="text/javascript">
        jQuery('document').ready(function() {
            jQuery("span.post-state-format").each(function() {
                if ( jQuery(this).text() == "Accordion" )
                    jQuery(this).text("Tip");
            });
        });
        </script>
<?php }
}
add_action('admin_head', 'live_rename_formats');


function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

/* to add component js */	
function theme_enqueue_js() {   
	wp_enqueue_script( 'globalize-js', get_stylesheet_directory_uri() . '/js/globalize.min.js', array( 'jquery' ),null,true);
	wp_enqueue_script( 'imagesloaded-js', get_stylesheet_directory_uri() . '/js/imagesloaded.pkgd.min.js',array( 'jquery' ),null,true);
	wp_enqueue_script( 'debounce-js', get_stylesheet_directory_uri() . '/js/jquery.ba-throttle-debounce.min.js',array( 'jquery' ),null,true);
	wp_enqueue_script( 'modernizr-js', get_stylesheet_directory_uri() . '/js/modernizr.custom.js', array( 'jquery' ),null,true);
	wp_enqueue_script( 'owl-js', get_stylesheet_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ),null,true);
	wp_enqueue_script( 'component-js', get_stylesheet_directory_uri() . '/js/components.js', array( 'jquery' ),null,true);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_js' );

/** Override maxmegamenu.js for accessibility fixes **/
add_action( 'wp_enqueue_scripts', 'my_custom_scripts' );

function my_custom_scripts() {
    wp_dequeue_script( 'megamenu' );
	wp_enqueue_script( 'megamenu-new', get_stylesheet_directory_uri() . '/js/maxmegamenu.js', array( 'jquery', 'megamenu', 'hoverIntent'),null,true );
    wp_dequeue_script( 'pbsandwich' );
}

/**
 * Add fields to media uploader
 *
 * @param $form_fields array, fields to include in attachment form
 * @param $post object, attachment record in database
 * @return $form_fields, modified form fields
 * 
 * From:  http://www.wpbeginner.com/wp-tutorials/how-to-add-additional-fields-to-the-wordpress-media-uploader/ 
**/ 
function be_attachment_field_credit( $form_fields, $post ) {
	
	// Hero text background color	
	$options = array('berkeley-blue'=>'berkeley-blue',
		'web-founders-rock'=>'web-founders-rock',
		'web-medalist'=>'web-medalist',
		'wellman-tile'=>'wellman-tile',
		'rose-garden'=>'rose-garden',
		'golden-gate'=>'golden-gate',
		'web-lap-lane'=>'web-lap-lane',	
		'web-soybean'=>'web-soybean',
		'south-hall'=>'south-hall',			
		'web-pacific'=>'web-pacific',
		'stone-pine'=>'stone-pine',
		'web-gray'=>'web-gray');	// Set up options
	$selected = get_post_meta( $post->ID, 'be_background_color', true );	 // Get currently selected value
	if( !isset( $selected ) ) 
		$selected = '0';
	$html = '<select id="attachments-'.$post->ID.'-be-background-color" name="attachments['.$post->ID.'][be-background-color]">';		
	foreach ( $options as $value => $label ) {
		$checked = '';
		if ( $selected == $value ) {
			$checked = " selected='selected'";
		}
		$html .= "<option value='$value' $checked >$label</option>";
	}
	$html .='</select>';
	$form_fields['be-background-color'] = array(
		'label' => 'Background color',
		'input' => 'html',
		'html'  => $html,	
		'helps' => 'Background color for text',
	);
	
	$form_fields['be-subheading'] = array(
		'label' => 'Subheading',
		'input' => 'textarea',
		'value' => get_post_meta( $post->ID, 'be_subheading', true ),
		'helps' => 'Subheading follows caption',
	);
	
	$form_fields['be-photo-credit'] = array(
		'label' => 'Photo Credit',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'be_photo_credit', true ),
		'helps' => '',
	);

	$form_fields['be-external-url'] = array(
		'label' => 'External URL',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'be_external_url', true ),
		'helps' => '',
	);
	
	$form_fields['be-video-url'] = array(
		'label' => 'Video URL',
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'be_video_url', true ),
		'helps' => 'YouTube video URL, e.g. http://www.youtube.com/watch?v=0889hqXGXEg',
	);

	return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'be_attachment_field_credit', 10, 2 );

/**
 * Save values 
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */

function be_attachment_field_credit_save( $post, $attachment ) {
		
	if( isset( $attachment['be-background-color'] ) )
		update_post_meta( $post['ID'], 'be_background_color', $attachment['be-background-color'] );
	
	if( isset( $attachment['be-subheading'] ) )
		update_post_meta( $post['ID'], 'be_subheading', $attachment['be-subheading'] );
		
	if( isset( $attachment['be-photo-credit'] ) )
		update_post_meta( $post['ID'], 'be_photo_credit', $attachment['be-photo-credit'] );

	if( isset( $attachment['be-external-url'] ) )
		update_post_meta( $post['ID'], 'be_external_url', esc_url( $attachment['be-external-url'] ) );

	if( isset( $attachment['be-video-url'] ) )
		update_post_meta( $post['ID'], 'be_video_url', esc_url( $attachment['be-video-url'] ) );

	return $post;
}

add_filter( 'attachment_fields_to_save', 'be_attachment_field_credit_save', 10, 2 );

function bs_count_widgets( $sidebar_id ) {
	// If loading from front page, consult $_wp_sidebars_widgets rather than options
	// to see if wp_convert_widget_settings() has made manipulations in memory.
	global $_wp_sidebars_widgets;
	if ( empty( $_wp_sidebars_widgets ) ) :
		$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
	endif;
	
	$sidebars_widgets_count = $_wp_sidebars_widgets;
	
	if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
		$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
		if ( $widget_count == 4) :
			$widget_class = 'col-sm-3';
		elseif ( $widget_count == 3 )  :
			$widget_class = 'col-sm-4';
		elseif ( $widget_count  == 2 ) :
			$widget_class = 'col-sm-6';
		else :
			$widget_class = 'col-sm-12';		
		endif; 

		return $widget_class;
	endif;
}

/**
 * Extend RSS Widget 
 *
 * Adds branding and custom formatting to the default WordPress RSS Widget
 */
 
Class Brand_Widget_RSS extends WP_Widget_RSS {
	
 	function __construct() {
		$widget_ops = array( 'description' => __('Display news list from RSS feed') );
		$control_ops = array( 'width' => 400, 'height' => 200 );
		parent::__construct( 'component_news_rss', __('Component News RSS'), $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
	
		extract( $args );
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('RSS') : $instance['title'], $instance, $this->id_base);
				
		if ( isset($instance['error']) && $instance['error'] )
			return;

		$url = ! empty( $instance['url'] ) ? $instance['url'] : '';
		while ( stristr($url, 'http') != $url )
			$url = substr($url, 1);

		if ( empty($url) )
			return;

		// self-url destruction sequence
		if ( in_array( untrailingslashit( $url ), array( site_url(), home_url() ) ) )
			return;

		$rss = fetch_feed($url);
		$title = $instance['title'];
		$desc = '';
		$link = '';

		if ( ! is_wp_error($rss) ) {
			$desc = esc_attr(strip_tags(@html_entity_decode($rss->get_description(), ENT_QUOTES, get_option('blog_charset'))));
			if ( empty($title) )
				$title = esc_html(strip_tags($rss->get_title()));
			$link = esc_url(strip_tags($rss->get_permalink()));
			while ( stristr($link, 'http') != $link )
				$link = substr($link, 1);
		}

		if ( empty($title) )
			$title = empty($desc) ? __('Unknown Feed') : $desc;

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$url = esc_url(strip_tags($url));
		$icon = includes_url('images/rss.png');
		echo $args['before_widget'];
		if ( $title )
			$title = '
<div class="block list-block-bulleted">
	<h3 class="block-header"><a href="' . $url . '">'.$title. '</a></h3>';

		if ( $title ) {
			echo $title;
		}
		brand_widget_rss_output( $rss, $instance );
		echo $args['after_widget'];

		if ( ! is_wp_error($rss) )
			$rss->__destruct();
			unset($rss);
		echo '</div>';
	}
	
}

function brand_widget_rss_output( $rss, $args ){

	if ( is_string( $rss ) ) {
		$rss = fetch_feed($rss);
	} elseif ( is_array($rss) && isset($rss['url']) ) {
		$args = $rss;
		$rss = fetch_feed($rss['url']);
	} elseif ( !is_object($rss) ) {
		return;
	}
	if ( is_wp_error($rss) ) {
		if ( is_admin() || current_user_can('manage_options') )
			echo '<p>' . sprintf( __('<strong>RSS Error</strong>: %s'), $rss->get_error_message() ) . '</p>';
		return;
	}
	$morelink = $rss->get_link();

	$default_args = array( 'show_author' => 0, 'show_date' => 0, 'show_summary' => 0, 'items' => 0 );
	$args = wp_parse_args( $args, $default_args );

	$items = (int) $args['items'];
	if ( $items < 1 || 10 < $items )
		$items = 3;
	$show_summary  = (int) $args['show_summary'];
	$show_author   = (int) $args['show_author'];
	$show_date     = (int) $args['show_date'];

	if ( !$rss->get_item_quantity() ) {
		echo '<ul><li>' . __( 'An error has occurred, which probably means the feed is down. Try again later.' ) . '</li></ul>';
		$rss->__destruct();
		unset($rss);
		return;
	}

	echo '<ul class="list-group">';
	foreach ( $rss->get_items( 0, $items ) as $item ) {
		$link = $item->get_link();
		while ( stristr( $link, 'http' ) != $link ) {
			$link = substr( $link, 1 );
		}
		$link = esc_url( strip_tags( $link ) );

		$title = esc_html( trim( strip_tags( $item->get_title() ) ) );
		if ( empty( $title ) ) {
			$title = __( 'Untitled' );
		}

		$desc = @html_entity_decode( $item->get_description(), ENT_QUOTES, get_option( 'blog_charset' ) );
		$desc = esc_attr( wp_trim_words( $desc, 16, ' &hellip;' ) );

		$summary = '';
		if ( $show_summary ) {
			$summary = $desc;

			// Change existing [...] to [&hellip;].
			if ( '...' == substr( $summary, -5 ) ) {
				$summary = substr( $summary, 0, -5 ) . '&hellip;';
			}

			$summary = '<div class="rssSummary">' . esc_html( $summary ) . '</div>';
		}

		$date = '';
		if ( $show_date ) {
			$date = $item->get_date( 'U' );

			if ( $date ) {
				$date = ' <br /><span class="rss-date">' . date_i18n( get_option( 'date_format' ), $date ) . '</span>';
			}
		}

		$author = '';
		if ( $show_author ) {
			$author = $item->get_author();
			if ( is_object($author) ) {
				$author = $author->get_name();
				$author = ' <cite>' . esc_html( strip_tags( $author ) ) . '</cite>';
			}
		}

		if ( $link == '' ) {
			echo "<li class=\"list-group-item\">$title{$date}{$summary}{$author}</li>";
		} elseif ( $show_summary ) {
			echo "<li class=\"list-group-item\"><a href='$link'>$title</a>{$date}{$summary}{$author}</li>";
		} else {
			echo "<li class=\"list-group-item\"><a href='$link'>$title</a>{$date}{$author}</li>";
		}
	}
	echo '
</ul>
<div class="more-link">
    <a href="' . $morelink .'">More news</a>
</div>';
	
	$rss->__destruct();
	unset($rss);
}

function remove_unused_widgets() {
/* Remove unused widgets */
	unregister_widget('WP_Widget_Tag_Cloud'); 
	unregister_widget('WP_Widget_Recent_Comments'); 
/* Replace RSS widget output with custom branded output */
	unregister_widget('WP_Widget_RSS');
}
add_action('widgets_init', 'remove_unused_widgets');
add_action( 'widgets_init', create_function( '', "register_widget('Brand_Widget_RSS');" ) );

//* Adding attributes to main nav links for accessibility
$atts = array();

function add_menu_atts( $atts, $item, $args ) {
	$atts['class'] = 'dropdown-toggle';
	$atts['data-target'] = '#';
	$atts['title'] = '';
	$atts['data-toggle'] = 'dropdown';
	$atts['aria-expanded'] = 'false';
	$atts['aria-haspopup'] = 'true';
    return $atts;
}
add_filter( 'megamenu_nav_menu_link_attributes', 'add_menu_atts', 10, 3 );

// Change sort order on category page using custom field 'displayOrder'
/* Handle case with null value:  https://thethemefoundry.com/blog/query-posts-wordpress-false-null-meta-value/
function sortByDisplayOrder($query) {
    if (is_category()) {
		$meta_query = array(
		 'relation' => 'OR',
			array(
				'key' => 'displayOrder'
			),
			array(
				'key' => 'displayOrder',
				'compare' => 'NOT EXISTS'
			)
		);
		$query->set( 'meta_query', $meta_query );
		$query->set('order', 'DESC');//'ASC');
		$query->set('orderby','meta_value_num');
    }
	return $query;
}
add_filter('pre_get_posts','sortByDisplayOrder');


/** ADD YOUR CUSTOMIZATIONS BELOW THIS LINE **/
// SL added 7/23/09
/*
** Function: truncateStringOnBoundary
** Input: STRING string, INTEGER limit, STRING break, STRING pad
** Output: STRING, Truncated string on word boundary
** Description: Truncates a string to length ($limit), on boundary ($break),  
** appending string with padding ($pad)
*/
function truncateStringOnBoundary($string, $limit, $break=" ", $pad="</em></i></strong>")
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
 	return $string;// . $pad; 
 
 }



/*******************************************************/
/* http://wordpress.stackexchange.com/questions/215369/featured-image-on-post-edit-page-not-loading-over-https
/* WP 4.4.1 displaying featured post image with http instead of https, so it doesnt load in the edit-post.php page. below fixes that
/*******************************************************/
function fix_ssl( $url ) {
    if ( is_ssl() ) {
        if (stripos($url, 'http://') === 0) {
        $url = 'https' . substr($url, 4);
        }
    }
    return $url;
}

function uploadDir($uploads) {
    $uploads['url'] = fix_ssl($uploads['url']);
    $uploads['baseurl'] = fix_ssl($uploads['baseurl']);
    return $uploads;
}

add_filter('upload_dir', 'uploadDir');




/*******************************************************/
/* LN added 2/3/16
/* functions to get featured post and featured comment that are on the homepage
/*******************************************************/
function getHomepageFeaturedPost(){
	global $wpdb;
	$fpost = new stdClass();
	
	$front_page_featured_post = new stdClass();
	
	//$sql = $wpdb->prepare( 'SELECT post_id FROM wp_cfs_values WHERE field_id = %d ORDER BY post_id DESC LIMIT 1', 1 );
	$sql = $wpdb->prepare( "SELECT *  FROM wp_postmeta WHERE meta_key LIKE 'feature_post_on_homepage' AND meta_value = 1", OBJECT );
	$latest_featured_post = $wpdb->get_results( $sql );
	$front_page_featured_post = get_post( $latest_featured_post[0]->post_id );

	if( !empty($front_page_featured_post) && ($front_page_featured_post->post_title != 'Home') ) {
		$fpost->ID = $front_page_featured_post->ID;
		$fpost->title = $front_page_featured_post->post_title;
		$fpost->author = $front_page_featured_post->post_author;
		$fpost->permalink = get_permalink( $front_page_featured_post->ID );
		$fpost->image = wp_get_attachment_image_src( get_post_thumbnail_id( $fpost->ID ), 'single-post-thumbnail' );
		$fpost_color = get_post_meta( $fpost->ID, 'background_color');
		$fpost->color = $fpost_color[0];
	} else {
		$fpost = false;
	}

	return $fpost;
}

function getHomepageFeaturedComment(){
	$latest_featured_comment = new stdClass();
	
	//get data for featured quote
	$args = array(
		'number' => 1,
		'orderby' => 'comment_date',
		'meta_key' => 'featured',
		'meta_value' => 'y'
	);
	$latest_featured_comment = get_comments( $args );	
	
	if( !empty($latest_featured_comment) ) {
		$fquote = new stdClass();
		
		$fquote->ID = $latest_featured_comment[0]->comment_ID;
		$excerpt = get_comment_meta( $latest_featured_comment[0]->comment_ID, 'featured_comment_excerpt', true );
		if (!empty($excerpt)) {
			$fquote->quote = $excerpt;
			$fquote->quote .= '...';
		} else {
			$fquote->quote = truncateStringOnBoundary($latest_featured_comment[0]->comment_content, 140);
		}
		$fquote->author = $latest_featured_comment[0]->comment_author;
		$fquote->parent_post = $latest_featured_comment[0]->comment_post_ID;
		$fquote->parent_permalink = get_permalink($fquote->parent_post) . '#div-comment-' . $fquote->ID;
			
		$colors = get_comment_meta( $latest_featured_comment[0]->comment_ID, 'featured_comment_box_color', true );
		if( empty($colors) ) {
			$colors = 'web-founders-rock';
		}
		$fquote->color = $colors;
	} else {
		$fquote = false;
	}
	
	return $fquote;
}
 
 
 
 /*******************************************************/
 /* LN added 2/1/16
 /* function to remove featured posts and featured quotes from homepage post & quote listings
 /* using newscenter functions.php line 180 for reference
 /*13617*/
 /*******************************************************/
function exclude_single_posts_home($query) {
  if ( $query->is_home() && ! is_admin() ) {
	$exclude_post = getHomepageFeaturedPost();
    $query->set('post__not_in', array($exclude_post->ID));
  }
}

add_action('pre_get_posts', 'exclude_single_posts_home');



/*******************************************************/
/* close all open xhtml tags at the end of the string
/* @param string $html
/* @return string
/* @author Milian <mail@mili.de>
/* added by LN 2/19/16 - called from content.php 
/*******************************************************/
function closetags($html) {
    preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
    $openedtags = $result[1];
    preg_match_all('#</([a-z]+)>#iU', $html, $result);
    $closedtags = $result[1];
    $len_opened = count($openedtags);
    if (count($closedtags) == $len_opened) {
        return $html;
    }
    $openedtags = array_reverse($openedtags);
    for ($i=0; $i < $len_opened; $i++) {
        if (!in_array($openedtags[$i], $closedtags)) {
            $html .= '</'.$openedtags[$i].'>';
        } else {
            unset($closedtags[array_search($openedtags[$i], $closedtags)]);
        }
    }
    return $html;
} 



/*******************************************************/
/* Hook to update feature.xml on publish -- YK 05/13/13
/* function feature_xml($new_status, $old_status, $postid){
/*******************************************************/
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
		//if (intval($meta['feature'][0]) == 1) {
		if (intval($meta['feature_on_gateway'][0]) == 1) {
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



function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
 
add_action( 'loop_start', 'jptweak_remove_share' );



/*********************************************
change author pages to show all posts instead of limited amount set in SETTINGS > READING
**********************************************/
function change_numberposts_for_author( $query ) {
  if ( ! is_admin() && $query->is_main_query() && is_author() ) {
    $query->set('posts_per_page', -1); // 
  }
}

add_action('pre_get_posts','change_numberposts_for_author');


/**if "THEME OPTIONS > POST ELEMENT OPTIONS > Toggle open first element of a Toggle List" is checked, enqueue script**/
function add_custom_pb_sandwich_toggle_script(){
	$pb_toggle_option = get_option('berkeley_brand');
	if(!empty($pb_toggle_option)){
		if($pb_toggle_option['alienship_pbsandwich_toggle_list'] == 1)
			wp_enqueue_script( 'opentoggle-js', get_stylesheet_directory_uri() . '/js/opentoggle.js', array( 'jquery' ),null,true);
	}
}
	
add_action( 'wp_enqueue_scripts', 'add_custom_pb_sandwich_toggle_script' );


/*REQUIRE AUTHENTICATION FOR REST API																	*/
/*whitelist localhost																							*/
/*https://developer.wordpress.org/rest-api/using-the-rest-api/frequently-asked-questions/#require-authentication-for-all-requests */
add_filter( 'rest_authentication_errors', function( $result ) {
    if ( ! empty( $result ) ) {
        return $result;
    }
  
    $whitelist = array('127.0.0.1', "::1");
    if ( ! is_user_logged_in() || (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) ) {
        return new WP_Error( 'rest_not_logged_in', 'Go Bears! ʕ•ᴥ•ʔ', array( 'status' => 401 ) );
    }
    return $result;
});

?>
