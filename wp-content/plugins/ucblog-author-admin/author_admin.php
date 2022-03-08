<?php
/*
Plugin Name: UCB Blog Author Admin
Plugin URI: 
Description: Once authors are logged in, gives them a dropdown menu from the top toolbar & in front end footer order to manage posts. Adds submenu to admin toolbar so authors can add posts by category from toolbar. Adds USERS link in admin toolbar for administrators.
Version: 1
Author: Public Affairs
Author URI: 
*/
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;



include( plugin_dir_path( __FILE__ ) . 'admin_toolbar_additions.php' );
include( plugin_dir_path( __FILE__ ) . 'admin_sidebar_additions.php' ); 
include( plugin_dir_path( __FILE__ ) . 'widget_class.php' ); 



/***********************************
// redirect Author's logging in to choose a category page
//https://codex.wordpress.org/Plugin_API/Filter_Reference/login_redirect
***********************************/
/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return '/wp-admin/index.php';
		} else {
			return '/whats-on-your-mind/';
		}
	} else {
		return home_url();
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );



/***********************************
// pass category ID from link to WP 
// From http://w-shadow.com/blog/2012/11/20/pre-select-category-for-new-post/ 
// pass in the category ID like this: /wp-admin/post-new.php?category_id=5
***********************************/
 function ws_preselect_post_category() {
    if ( isset($_GET['cat']) && is_numeric($_GET['cat']) ) {
        $catId = intval($_GET['cat']);
        ?>
        <script type="text/javascript">
            jQuery(function() {
                var catId = <?php echo json_encode($catId); ?>;
                jQuery('#in-category-' + catId).click();
            });
        </script>
        <?php
    }
}
add_action('admin_footer-post-new.php', 'ws_preselect_post_category');
?>