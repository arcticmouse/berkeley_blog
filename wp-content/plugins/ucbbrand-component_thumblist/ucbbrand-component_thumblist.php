<?php
/*
Plugin Name:  UCB Brand Component - Thumb List
Plugin URI: http://brand.berkeley.edu
Description: Display branded component thumb list (posts from selected category).  Outputs the shortcode:  [catlist ID={categoryid} orderby=ID order=ASC excerpt=yes thumbnail=yes thumbnail_size=full thumbnail_class=navthumb template=brand]
Author: Public Affairs
Version: 1.0
*/
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

// Create the widget 
class ucbbrand_component_thumblist extends WP_Widget {
	
	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'ucbbrand_component_thumblist', 
		
		// Widget name will appear in UI
		__('Component Thumb List', 'ucbbrand_component_thumblist_domain'), 
		
		// Widget description
		array( 'description' => __( 'Displays Thumb List which contains featured image and excerpt from posts in the selected category', 'ucbbrand_component_thumblist_domain' ), ) 
		);
	}
	
	// Creating widget front-end
	public function widget( $args, $instance ) {
		
	    $categoryid = apply_filters( 'categoryid', $instance['categoryid'] );
		
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		
		if ( intval($categoryid) != 0 ) {
			echo do_shortcode( '[catlist id=' . $categoryid . ' customfield_orderby=displayOrder order=ASC excerpt=yes excerpt_strip=no thumbnail=yes thumbnail_size=full thumbnail_class=navthumb customfield_display=externalURL customfield_display_name=no template=brand]' );
		}
		
		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {
		$default = array (
                    'title' => '',
                    'categoryid' => '',
                 );
		$instance = wp_parse_args( (array) $instance, $default);
		$title = strip_tags($instance['title']);
		$categoryid = strip_tags($instance['categoryid']);
?>		
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
    <?php _e("Title", 'list-category-posts')?>
  </label>
  <br/>
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
    name="<?php echo $this->get_field_name('title'); ?>" type="text"
    value="<?php echo esc_attr($title); ?>" />
</p>

<p>
  <label for="<?php echo $this->get_field_id('categoryid'); ?>">
    <?php _e("Category", 'list-category-posts')?>
  </label>
  <br/>
  <select id="<?php echo $this->get_field_id('categoryid'); ?>" name="<?php echo $this->get_field_name('categoryid'); ?>">
    <?php
      $categories=  get_categories();
      $option = '<option value="-1"';
      if ($categoryid == -1) :
        $option .= ' selected = "selected" ';
      endif;
      $option .= '">' . "Current category" . '</option>';
      echo $option;

      foreach ($categories as $cat) :
        $option = '<option value="' . $cat->cat_ID . '" ';
        if ($cat->cat_ID == $categoryid) :
          $option .= ' selected = "selected" ';
        endif;
        $option .=  '">';
        $option .= $cat->cat_name;
        $option .= '</option>';
        echo $option;
      endforeach;
    ?>
  </select>
</p>
<?php		
	}
		
	// Updating widget replacing old instances with new
	function update($new_instance, $old_instance) {
	    $instance = $old_instance;
	    $instance['title'] = strip_tags($new_instance['title']);
	    $instance['categoryid'] = strip_tags($new_instance['categoryid']);
	    return $instance;
	}
	
} // Class component_thumblist ends here

// Register and load the widget
function ucbbrand_load_thumblist_widget() {
	register_widget( 'ucbbrand_component_thumblist' );
}
add_action( 'widgets_init', 'ucbbrand_load_thumblist_widget' );

?>
