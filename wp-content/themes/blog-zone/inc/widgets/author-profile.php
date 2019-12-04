<?php
/**
 * Author Profile widget
 *
 * @package Blog_Zone
 */

if ( ! class_exists( 'Blog_Zone_Author_Widget' ) ) :

    /**
     * Author widget class.
     *
     * @since 1.0.0
     */
    class Blog_Zone_Author_Widget extends WP_Widget {

        function __construct() {
            $opts = array(
                    'classname'   => 'widget_author',
                    'description' => esc_html__( 'Widget to display author profile.', 'blog-zone' ),
            );
            parent::__construct( 'blog-zone-author', esc_html__( 'BZ: Author Profile', 'blog-zone' ), $opts );
        }

        function widget( $args, $instance ) {

            $author_page        = !empty( $instance['author_page'] ) ? $instance['author_page'] : ''; 

            echo $args['before_widget']; ?>

            <div class="author-profile">
                    
                    <div class="profile-wrapper">

                        <?php if ( $author_page ) { 

                            $author_args = array(
                                            'posts_per_page' => 1,
                                            'page_id'        => absint( $author_page ),
                                            'post_type'      => 'page',
                                            'post_status'    => 'publish',
                                        );

                            $author_query = new WP_Query( $author_args ); 

                            if( $author_query->have_posts()){

                                while( $author_query->have_posts()){

                                    $author_query->the_post(); ?>

                                    <?php 
                                    if ( has_post_thumbnail() ) { ?>
                                        <div class="profile-image">
                                            <?php the_post_thumbnail('thumbnail'); ?>
                                        </div>
                                        <?php
                                    } ?>

                                    <div class="profile-info">
                                        <h2><?php the_title(); ?></h2>
                                        <?php the_content(); ?>
                                    </div>

                                    <?php

                                }

                                wp_reset_postdata();

                            } ?>
                            
                        <?php } ?>

                    </div><!-- .profile-wrapper -->

            </div><!-- .author-profile -->

            <?php 

            echo $args['after_widget'];

        }

        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;

            $instance['author_page']        = absint( $new_instance['author_page'] );

            return $instance;
        }

        function form( $instance ) {

            // Defaults.
            $defaults = array(
                'author_page'       => '',
            );

            $instance = wp_parse_args( (array) $instance, $defaults );
            ?>
            
            <p>
                <label for="<?php echo $this->get_field_id( 'author_page' ); ?>">
                    <strong><?php esc_html_e( 'Author Page:', 'blog-zone' ); ?></strong>
                </label>
                <?php
                wp_dropdown_pages( array(
                    'id'               => $this->get_field_id( 'author_page' ),
                    'class'            => 'widefat',
                    'name'             => $this->get_field_name( 'author_page' ),
                    'selected'         => $instance[ 'author_page' ],
                    'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'blog-zone' ),
                    )
                );
                ?>
                <small>
                    <?php esc_html_e('Title, Content and Featured Image of this page will be used for Author title, Bio and Profile picture.', 'blog-zone'); ?>  
                </small>
            </p>

        <?php
                
        }
    }

endif;