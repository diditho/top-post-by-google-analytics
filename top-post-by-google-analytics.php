<?php
/**
 * Plugin Name: Top Post by Google Analytics
 * Plugin URI: https://diditho.com
 * Description: A plugin to display top posts in a widget using Google Analytics data.
 * Version: 1.0.0
 * Author: Banuardi Nugroho
 * Author URI: https://diditho.com
 * Text Domain: top-post-by-google-analytics
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Include the main class.
require_once plugin_dir_path( __FILE__ ) . 'includes/class-top-post-by-google-analytics.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_top_post_by_google_analytics() {
    $plugin = new Top_Post_By_Google_Analytics();
    $plugin->run();
}
run_top_post_by_google_analytics();
