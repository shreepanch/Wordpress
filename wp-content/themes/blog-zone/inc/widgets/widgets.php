<?php
/**
 * Custom functions for different widgets
 *
 * @package Blog_Zone
 */

/**
 * Load custom widgets
 */
if ( ! function_exists( 'blog_zone_custom_widgets' ) ) :

	function blog_zone_custom_widgets() {

		// Author profile widget
		register_widget( 'Blog_Zone_Author_Widget' );

		// Social profile widget
		register_widget( 'Blog_Zone_Social_Widget' );

	}

endif;

add_action( 'widgets_init', 'blog_zone_custom_widgets' );

/**
 * Author profile widget
 */
require get_template_directory() . '/inc/widgets/author-profile.php';

/**
 * Social profile widget
 */
require get_template_directory() . '/inc/widgets/social-profile.php';