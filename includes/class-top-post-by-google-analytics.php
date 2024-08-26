<?php

class Top_Post_By_Google_Analytics {

    public function __construct() {
        add_action( 'admin_notices', array( $this, 'check_site_kit_installation' ) );
        add_action( 'admin_init', array( $this, 'check_google_analytics_setup' ) );
        add_action( 'widgets_init', array( $this, 'register_widget' ) );
    }

    public function run() {
        // Add any additional initialization here.
    }

    /**
     * Check if Site Kit by Google is installed and activated.
     */
    public function check_site_kit_installation() {
        if ( ! is_plugin_active( 'google-site-kit/google-site-kit.php' ) ) {
            echo '<div class="notice notice-error"><p>';
            echo __( 'The "Top Post by Google Analytics" plugin requires the "Site Kit by Google" plugin. Please install and activate it.', 'top-post-by-google-analytics' );
            echo '</p></div>';
        }
    }

    /**
     * Check if Google Analytics is set up in Site Kit.
     */
    public function check_google_analytics_setup() {
        if ( is_plugin_active( 'google-site-kit/google-site-kit.php' ) ) {
            $analytics_active = get_option( 'googlesitekit_analytics_settings' );
            if ( empty( $analytics_active ) || empty( $analytics_active['propertyID'] ) ) {
                add_action( 'admin_notices', function() {
                    echo '<div class="notice notice-error"><p>';
                    echo __( 'Please complete the Google Analytics setup in the Site Kit by Google plugin.', 'top-post-by-google-analytics' );
                    echo '</p></div>';
                });
            }
        }
    }

    /**
     * Register the widget with WordPress.
     */
    public function register_widget() {
        if ( is_plugin_active( 'google-site-kit/google-site-kit.php' ) ) {
            register_widget( 'Top_Post_By_Google_Analytics_Widget' );
        }
    }
}
