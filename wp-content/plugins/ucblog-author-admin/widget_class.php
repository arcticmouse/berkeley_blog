<?php
/**
 * Adds Author_Admin_Menu_Widget widget.
 */
class Author_Admin_Menu_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'author_admin_menu_widget', // Base ID
			__( 'Author Admin Menu', 'text_domain' ), // Name
			array( 'description' => __( 'Adds administration menu to manage posts for logged in Authors, Editors, and Administrators', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		
		?><h3 class="widget-title">Admin</h3><?php
		if ( is_user_logged_in() && ( current_user_can('author') || current_user_can('editor') || current_user_can('administrator') )) {
			//add logged in menu
			?>
            <ul class="menu">
                <li><a href="<?php echo wp_logout_url(); ?>">Logout</a></li>
                <li><a href="/whats-on-your-mind/">Write a post</a></li>
                <li><a href="/wp-admin/edit.php">Edit posts</a></li>
                <li><a href="/wp-admin/profile.php">Edit profile</a></li>
                <li><a href="/how">Help</a></li>
            </ul>
            <?php
		} else {
			?>
            <ul class="menu">
            	<li><a href="/wp-login.php" />Log In</a></li>
			</ul>
			<?php
		}//end if logged in and certain role
		
		echo $args['after_widget'];
	}

} // class Author_Admin_Menu_Widget



/***********************************
// register Author_Admin_Menu_Widget widget
***********************************/
function register_author_admin_menu_widget() {
    register_widget( 'Author_Admin_Menu_Widget' );
}
add_action( 'widgets_init', 'register_author_admin_menu_widget' );
?>