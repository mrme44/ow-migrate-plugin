<?php
/*
Plugin Name: WordPress Overwatch Utilities
Plugin URI: https://wp-overwatch.com
Description: This plugin helps us better manage your website
Version: 1.0.0
Author: WP Overwatch
Author URI:  http://wp-overwatch.com
Contributors: Russell, Scotty

Thanks to the developers of https://github.com/norcross/reaktiv-remote-repo
 */

//TODO MOVE ALL THIS STUFF TO SEPERATE FILES


//SETUP STUFF standard is to place this in a file called options.php
//CREATE THE MENU PAGE

if ( is_admin() ){
 function add_wp_overwatch_admin_menu() {
 	add_options_page( 'WP Overwatch Options', 'WP Overwatch', 'manage_options', 'wp-overwatch', 'wp_overwatch_settings_page_callback' );
 }
 add_action( 'admin_menu', 'add_wp_overwatch_admin_menu' );

	function register_wp_overwatch_settings() { // whitelist options
	  register_setting( 'wp-option-group', 'new_option_name' );
	  register_setting( 'wp-option-group', 'some_other_option' );
	  register_setting( 'wp-option-group', 'option_etc' );
	}
	add_action( 'admin_init', 'register_wp_overwatch_settings' );

	function wp_overwatch_settings_page_callback() {
  	if ( !current_user_can( 'manage_options' ) )  {
  		wp_die( __( 'The WP Overwatch plugin says hi. Unfortunately, it also says that you do not have sufficient permissions to access this page.' ) )
	 	?>
			<div class="wrap">';
			 	<h1>Options</h1>
				<p>These options are for internal use, to aid us in managing your website.</p>
				<p>I have no idea what this plugin will eventually look like, but we will continue to add utilites here as we create them.</p>
				<p>Feel free to contact russell@wordpressoverwatch.com if you need help</p>

				<form method="post" action="options.php">
				<?php

					settings_fields( 'wp-option-group' );
					//this code will replace the form field we are inside of
					do_settings_sections( 'wp-option-group' );
				?>

				<table class="form-table">
	        <tr valign="top">
	        <th scope="row">New Option Name</th>
	        <td><input type="text" name="new_option_name" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
	        </tr>

	        <tr valign="top">
	        <th scope="row">Some Other Option</th>
	        <td><input type="text" name="some_other_option" value="<?php echo esc_attr( get_option('some_other_option') ); ?>" /></td>
	        </tr>

	        <tr valign="top">
	        <th scope="row">Options, Etc.</th>
	        <td><input type="text" name="option_etc" value="<?php echo esc_attr( get_option('option_etc') ); ?>" /></td>
	        </tr>
		    </table>

		    <?php submit_button(); ?>

				</form>

			</div>
		<?php
	 }
}

} // end of is_admin()



function admin_maintenace_mode() {
    global $current_user;
    get_currentuserinfo();
    if($current_user->user_login != 'wpoverwatch') { ?>
                        <style> .updated{margin:30px !important;} </style><?
                        wp_die('<div id="message" class="updated"><p><b>Maintenance mode:</b> We are currently making updates. Everything will be online shortly :)</p></div>');
                }
}
//add_action('admin_head', 'admin_maintenace_mode');



// UPDATER CODE

// set our defined items
DEFINE( 'RKV_UPDATE_URL', 'https://github.com/mrme44/ow-plugin.git' );
DEFINE( 'RKV_ITEM', 'WordPress Overwatch Utilities' );
DEFINE( 'RKV_VERS', '1.0.0' );

// load the class if we haven't aready
if ( ! class_exists( 'RKV_Remote_Updater' ) ) {
	include( 'RKV_Remote_Updater.php' );
}


add_action ( 'admin_init', 'rkv_auto_updater' );
/**
 * load our auto updater function
 * @return [type] [description]
 */
function rkv_auto_updater() {
	// Setup the updater
	$updater = new RKV_Remote_Updater( RKV_UPDATE_URL, __FILE__, array(
		'item'		=> RKV_ITEM,
		'version'   => RKV_VERS,
		)
	);
}
