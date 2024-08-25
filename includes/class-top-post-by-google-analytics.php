<?php

class Top_Post_By_Google_Analytics {

    /**
     * The loader that's responsible for maintaining and registering all hooks.
     *
     * @since    1.0.0
     * @access   protected
     * @var      mixed    $loader
     */
    protected $loader;

    /**
     * Constructor function for the plugin.
     *
     * @since    1.0.0
     */
    public function __construct() {
        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_widget_hooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-top-post-by-google-analytics-widget.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-top-post-by-google-analytics-auth.php';
    }

    /**
     * Register all of the hooks related to the admin area functionality.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {
        $plugin_admin = new Top_Post_By_Google_Analytics_Auth();
        add_action( 'admin_menu', array( $plugin_admin, 'add_plugin_admin_menu' ) );
        add_action( 'admin_init', array( $plugin_admin, 'register_settings' ) );
    }

    /**
     * Register all of the hooks related to the widget functionality.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_widget_hooks() {
        $plugin_widget = new Top_Post_By_Google_Analytics_Widget();
        add_action( 'widgets_init', array( $plugin_widget, 'register_widget' ) );
    }

    /**
     * Run the plugin.
     *
     * @since    1.0.0
     */
    public function run() {
        // Add any additional initialization here.
    }
}
