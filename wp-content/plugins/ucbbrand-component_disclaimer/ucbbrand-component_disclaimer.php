<?php
/*
Plugin Name:  UCB Brand Component - Disclaimer
Plugin URI: http://brand.berkeley.edu
Description: Display branded Disclaimer Block with or without image
Author: Public Affairs
Version: 1.0
*/
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

define( 'COMPONENT_DISCLAIMER_URL', plugins_url( '', __FILE__ ) );
define( 'COMPONENT_DISCLAIMER_PATH', plugin_dir_path( __FILE__ ) );

class ucbbrand_component_disclaimer extends WP_Widget {

	private $cmp_defaults = array();
	
	function __construct() {
		parent::__construct(
		// Base ID of your widget
		'ucbbrand_component_disclaimer', 
		
		// Widget name will appear in UI
		__('Component Disclaimer Widget', 'ucbbrand_component_disclaimer_domain'), 
		
		// Widget description
		array( 'description' => __( 'Displays UC Berkeley-branded Disclaimer block', 'ucbbrand_component_disclaimer_domain' ), ) 
		);
		$this->cmp_defaults = array(
			'image_id'			 => 0
		);

		add_action( 'admin_enqueue_scripts', array( &$this, 'disclaimer_admin_scripts_styles' ) );
	}
	
	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
	
		$disclaimer_message = apply_filters( 'widget_message', $instance['disclaimer_message'] );
		$alt = apply_filters( 'widget_image_alt', (string) get_post_meta( $instance['image_id'], '_wp_attachment_image_alt', true ), $instance );

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];

		echo '<div class="block disclaimer no-image solid-image web-founders-rock ' . $disclaimer_block_type .'">';
  				if ($disclaimer_link != '') { echo '<a href="'. $disclaimer_link .'">';}
					echo '<div class="thumbnail">';
						echo '<div class="caption">
						 	 <div class="caption-inner">		
								<div>'.$disclaimer_message.'</div>
						  	</div>
						</div>
					  </div>';					
					if ($disclaimer_link != '') { echo '</a>';}
				echo '</div>';
		// This is where you run the code and display the output
		echo $args['after_widget'];
		
	}
			
	// Widget Backend 
	public function form( $instance ) {
		
		if ( isset( $instance[ 'disclaimer_message' ] ) ) {
			$disclaimer_message = $instance[ 'disclaimer_message' ];
		} else {
			$disclaimer_message =__( '', 'ucbbrand_component_disclaimer_domain' );
		}
	
		// Widget admin form
		?>
		<div class="component-disclaimer">
        
        <p>
		<label for="<?php echo $this->get_field_id( 'disclaimer_message' ); ?>"><?php _e( 'Disclaimer message:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'disclaimer_message' ); ?>" name="<?php echo $this->get_field_name( 'disclaimer_message' ); ?>" type="text" value="<?php echo esc_attr( $disclaimer_message ); ?>" />
		</p>
</div>		
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['disclaimer_message'] = ( ! empty( $new_instance['disclaimer_message'] ) ) ? strip_tags( $new_instance['disclaimer_message'] ) : '';
		return $instance;
		}

	/**
	 * Admin scripts and styles
	 */
	public function disclaimer_admin_scripts_styles( $page ) {
		if ( $page === 'widgets.php' ) {

			wp_register_script(
				'component-disclaimer-admin', COMPONENT_DISCLAIMER_URL . '/js/admin.js', array( 'jquery' )
			);

			wp_enqueue_script( 'component-disclaimer-admin' );

			wp_register_style(
				'component-disclaimer-admin', COMPONENT_DISCLAIMER_URL . '/css/admin.css'
			);

			wp_enqueue_style( 'component-disclaimer-admin' );
		}
	}

} // Class component_disclaimer ends here

// Register and load the widget
function ucbbrand_load_disclaimer_widget() {
	register_widget( 'ucbbrand_component_disclaimer' );
}
add_action( 'widgets_init', 'ucbbrand_load_disclaimer_widget' );


/* Stop Adding Functions Below this Line */
?>
