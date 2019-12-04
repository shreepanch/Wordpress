<?php
/**
 * Social Profile widget
 *
 * @package Blog_Zone
 */

if ( ! class_exists( 'Blog_Zone_Social_Widget' ) ) :

    /**
     * Social widget class.
     *
     * @since 1.0.0
     */
    class Blog_Zone_Social_Widget extends WP_Widget {

        function __construct() {
            $opts = array(
                    'classname'   => 'social-widgets',
                    'description' => esc_html__( 'Widget to display social links.', 'blog-zone' ),
            );
            parent::__construct( 'blog-zone-social', esc_html__( 'BZ: Social Links', 'blog-zone' ), $opts );
        }

        function widget( $args, $instance ) {

            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base ); 

            echo $args['before_widget']; 

            if ( ! empty( $title ) ) {

                echo $args['before_title'] . $title . $args['after_title'];
            }

            ?>
            <ul>
              <?php 
                for( $j= 1; $j<=6; $j++ ){ 

                    $social_link = blog_zone_options('social_link_'.$j);

                    if( !empty( $social_link ) ){ ?>

                        <li><a target="_blank" href="<?php echo esc_url( $social_link ); ?>"><?php echo esc_url($social_link); ?></a></li>

                    <?php 
                    } 

                } ?>
            </ul> 

            <?php

            echo $args['after_widget'];

        }

        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;

            $instance['title'] = sanitize_text_field( $new_instance['title'] );

            return $instance;
        }

        function form( $instance ) {

            $instance = wp_parse_args( (array) $instance, array(
                'title' => '',
            ) ); ?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'blog-zone' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
            
                <small> 
                    <?php esc_html_e('Please add social links at Appearance >> Theme Options >> Social Links', 'blog-zone'); ?>  
                </small>
            </p>

        <?php
                
        }
    }

endif;