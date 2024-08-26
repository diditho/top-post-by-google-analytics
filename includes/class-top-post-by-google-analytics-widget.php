<?php

class Top_Post_By_Google_Analytics_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'top_post_by_google_analytics_widget',
            __( 'Top Post by Google Analytics', 'top-post-by-google-analytics' ),
            array( 'description' => __( 'Displays top posts based on Google Analytics data via Site Kit by Google.', 'top-post-by-google-analytics' ) )
        );
    }

    public function widget( $args, $instance ) {
        if ( ! is_plugin_active( 'google-site-kit/google-site-kit.php' ) ) {
            echo '<p>' . __( 'The Site Kit by Google plugin is required to display Google Analytics data.', 'top-post-by-google-analytics' ) . '</p>';
            return;
        }

        $response = wp_remote_get( admin_url( 'index.php' ), array(
            'timeout' => 10,
            'body'    => array(
                'module'    => 'analytics',
                'endpoint'  => 'top-pages',
                'request'   => array(
                    'dateRange' => 'last-7-days',
                    'limit'     => isset( $instance['limit'] ) ? $instance['limit'] : 5,
                ),
            ),
        ) );

        if ( is_wp_error( $response ) ) {
            echo '<p>' . __( 'Error fetching Google Analytics data.', 'top-post-by-google-analytics' ) . '</p>';
            return;
        }

        $body = wp_remote_retrieve_body( $response );
        $data = json_decode( $body, true );

        if ( ! empty( $data['top-pages'] ) ) {
            foreach ( $data['top-pages'] as $page ) {
                echo '<p><a href="' . esc_url( $page['url'] ) . '">' . esc_html( $page['title'] ) . '</a></p>';
            }
        } else {
            echo '<p>' . __( 'No Google Analytics data available.', 'top-post-by-google-analytics' ) . '</p>';
        }
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Top Posts', 'top-post-by-google-analytics' );
        $limit = ! empty( $instance['limit'] ) ? $instance['limit'] : 5;
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'top-post-by-google-analytics' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php _e( 'Number of Posts:', 'top-post-by-google-analytics' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="number" value="<?php echo esc_attr( $limit ); ?>">
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['limit'] = absint( $new_instance['limit'] );
        return $instance;
    }
}
