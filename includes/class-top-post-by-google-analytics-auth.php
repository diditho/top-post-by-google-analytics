<?php

class Top_Post_By_Google_Analytics_Auth {

    /**
     * Constructor function for the authentication class.
     *
     * @since    1.0.0
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'register_settings' ) );
    }

    /**
     * Add options page under Settings.
     *
     * @since    1.0.0
     */
    public function add_plugin_admin_menu() {
        add_options_page(
            __( 'Google Analytics Auth', 'top-post-by-google-analytics' ),
            __( 'GA Auth Settings', 'top-post-by-google-analytics' ),
            'manage_options',
            'top-post-by-google-analytics',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Register settings for the Google Analytics authentication.
     *
     * @since    1.0.0
     */
    public function register_settings() {
        register_setting(
            'top_post_by_google_analytics_auth',
            'top_post_by_google_analytics_auth_token'
        );

        add_settings_section(
            'auth_section',
            __( 'Google Analytics Authentication', 'top-post-by-google-analytics' ),
            null,
            'top_post_by_google_analytics_auth'
        );

        add_settings_field(
            'auth_token',
            __( 'Auth Token', 'top-post-by-google-analytics' ),
            array( $this, 'auth_token_callback' ),
            'top_post_by_google_analytics_auth',
            'auth_section'
        );
    }

    /**
     * Display the Auth Token field.
     *
     * @since    1.0.0
     */
    public function auth_token_callback() {
        $value = get_option( 'top_post_by_google_analytics_auth_token', '' );
        echo '<input type="text" name="top_post_by_google_analytics_auth_token" value="' . esc_attr( $value ) . '" />';
    }

    /**
     * Render the settings page.
     *
     * @since    1.0.0
     */
    public function create_admin_page() {
        ?>
        <div class="wrap">
            <h1><?php _e( 'Google Analytics Authentication', 'top-post-by-google-analytics' ); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'top_post_by_google_analytics_auth' );
                do_settings_sections( 'top_post_by_google_analytics_auth' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}
