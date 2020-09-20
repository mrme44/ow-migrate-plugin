<?php
/*
Plugin Name: WordPress Overwatch Maintenance Mode for Website Migrations
Plugin URI: https://wp-overwatch.com
Description: This plugin puts the backend in maintenance mode while it is being migrated
Version: 1.1.0
Author: WP Overwatch
Author URI:  http://wp-overwatch.com
Contributors: Russell, Scotty
 */


function admin_maintenace_mode() {
    global $current_user;
    get_currentuserinfo();
    if ( $current_user->user_login == 'wpoverwatch' || isset($_GET['wpoverwatch']) || isset($_COOKIE['wpoverwatch']) ) {
        return;
    } else {
      $msg = "Howdy. You're website is currently being migrated to a different webhost by WordPress Overwatch. Once the migration is complete you will be able to login again. If we forgot to disable maintenance mode, or if you notice any other problems, send an email to russell@wordpressoverwatch.com.";
      echo '<style> .updated{margin:30px !important;} </style>';
      wp_die('<div id="message" class="updated"><p><b>Maintenance mode:</b>'.$msg.'</p></div>');
    }
}
add_action('admin_head', 'admin_maintenace_mode');



// UPDATER CODE

// set our defined items
DEFINE( 'RKV_UPDATE_URL', 'https://github.com/mrme44/ow-migrate-plugin.git' );
DEFINE( 'RKV_ITEM', 'WordPress Overwatch Utilities' );
DEFINE( 'RKV_VERS', '1.1.0' );

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
