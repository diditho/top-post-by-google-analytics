<?php

class Top_Post_By_Google_Analytics_Widget extends WP_Widget {

    /**
     * The title of the widget.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $title
     */
    private $title;

    /**
     * The number of posts to display.
     *
     * @since    1.0.0
     * @access   private
     * @var      int    $limit
     */
    private $limit;

    /**
     * The excerpt length.
     *
     * @since    1.0.0
     * @access   private
     * @var      int    $excerpt_length
     */
    private $excerpt_length;

    /**
     * Constructor function for the widget.
     *
     * @since    1.0.0
     */
    public function __construct() {
        parent::__construct(
            'top_post_by_google_analytics_widget',
            __( 'Top Post by Google Analytics', 'top-post-by-google-analytics' ),
            array( 'description' => __( 'Displays top posts based on Google Analytics data.', 'top-post-by-google-analytics' ) )
        );
    }

    /**
     * Front-end display of the widget.
     *
     * @since    1.0.0
     * @param    array    $args     Widget arguments.
     * @param    array    $instance Saved values from the database.
     */
    public function widget( $args, $instance ) {
        $this->title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Top Posts', 'top-post-by-google-analytics' );
        $this->limit = ! empty( $instance['limit'] ) ? $instance['limit'] : 5;
        $this->excerpt_length = ! empty( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 100;

        echo $args['before_widget'];
        if ( ! empty( $this->title ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $this->title ) . $args['after_title'];
        }

        // Widget content: Display top posts from Google Analytics

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @since    1.0.0
     * @param    array    $instance Previously saved values from the database.
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Top Posts', 'top-post-by-google-analytics' );
        $limit = ! empty( $instance['limit'] ) ? $instance['limit'] : 5;
        $excerpt_length = ! empty( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 100;
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'top-post-by-google-analytics' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php _e( 'Number of Posts:', 'top-post-by-google-analytics' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="number" value="<?php echo esc_attr( $limit ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'excerpt_length' ) ); ?>"><?php _e( 'Excerpt Length:', 'top-post-by-google-analytics' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'excerpt_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excerpt_length' ) ); ?>" type="number" value="<?php echo esc_attr( $excerpt_length ); ?>">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @since    1.0.0
     * @param    array    $new_instance Values just sent to be saved.
     * @param    array    $old_instance Previously saved values from the database.
     * @return   array    Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? absint( $new_instance['limit'] ) : 5;
        $instance['excerpt_length'] = ( ! empty( $new_instance['excerpt_length'] ) ) ? absint( $new_instance['excerpt_length'] ) : 100;
        return $instance;
    }

    /**
     * Register the widget with WordPress.
     *
     * @since    1.0.0
     */
    public function register_widget() {
        register_widget( 'Top_Post_By_Google_Analytics_Widget' );
    }
}
