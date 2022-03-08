<?php 
/*Plugin Name: UCB Recent Comments
Description: This widget pulls a list of the most recent comments
Version: 0.1
Author: Public Affairs
Author URI:
License: GPLv2
*/

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

/*************************************
called by PUBLIC WIDGET FUNCTION
gets list of 6 more recent comments
loop through list
	prints
*************************************/
function get_the_comments(){
	$comments = get_comments( array('status' => 'approve', 'number' => '6') );
	
	foreach($comments as $comment){
		?>
		<li class="col-sm-4 col-md-2">
			<a href="<?php echo esc_url( get_permalink($comment->comment_post_ID) ); ?>/#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo get_the_title($comment->comment_post_ID) . get_the_date('F j, Y', $comment->comment_post_ID); ?>" />
            	<span class="comment_author"><?php echo $comment->comment_author; ?></span>
            	<?php echo truncateStringOnBoundary($comment->comment_content, 100); ?>...
            </a>
		</li>
        <?php
	} //foreach
} //end function get_the_comments




/**
 * Adds Recent_Comments_Widget widget.
 */
class Recent_Comments_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'recent_comments_widget', // Base ID
			__( 'Recent Comments', 'text_domain' ), // Name
			array( 'description' => __( 'Prints out a list of most recent comments on the homepage.', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 * calls GET_THE_COMMENTS
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		?><div class="author_sampling_widget"><?php
		if(is_home() || is_front_page()){
			if ( ! empty( $instance['title'] ) ) {
				?><div class="block"><?php
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
				?></div><?php
			}
			echo '<div id="get_recent_comments_wrap">';
			echo '<ul>';
				get_the_comments();
			echo '</ul>';
			echo '</div>';
		}
		
		?></div><?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title for home page recent comments list:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

} // class Sample_Authors_Widget





// register Recent_Comments_Widget widget
function register_recent_comments_widget() {
    register_widget( 'Recent_comments_Widget' );
}
add_action( 'widgets_init', 'register_recent_comments_widget' );