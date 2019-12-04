<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Blog_Zone
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blog_zone_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class for global layout.
	$global_layout 	= blog_zone_options( 'blog_layout' );
	$global_layout 	= apply_filters( 'blog_zone_filter_theme_global_layout', $global_layout );
	$classes[] 		= 'global-layout-' . esc_attr( $global_layout );

	return $classes;
}
add_filter( 'body_class', 'blog_zone_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function blog_zone_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'blog_zone_pingback_header' );

if ( ! function_exists( 'blog_zone_implement_excerpt_length' ) ) :

	/**
	 * Implement excerpt length.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function blog_zone_implement_excerpt_length( $length ) {

		$excerpt_length = blog_zone_options( 'excerpt_length' );

		if ( absint( $excerpt_length ) > 0 ) {

			$length = absint( $excerpt_length );

		}

		return $length;

	}

endif;

if ( ! function_exists( 'blog_zone_content_more_link' ) ) :

	/**
	 * Implement read more in content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more_link Read More link element.
	 * @param string $more_link_text Read More text.
	 * @return string Link.
	 */
	function blog_zone_content_more_link( $more_link, $more_link_text ) {

		$read_more_text = blog_zone_options( 'readmore_text' );

		if ( ! empty( $read_more_text ) ) {

			$more_link = str_replace( $more_link_text, $read_more_text, $more_link );

		}

		return $more_link;

	}

endif;

if ( ! function_exists( 'blog_zone_implement_read_more' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function blog_zone_implement_read_more( $more ) {

		$output = $more;

		$read_more_text = blog_zone_options( 'readmore_text' );

		$hide_post_btn 	= blog_zone_options( 'hide_blog_post_btn' );

		if ( ! empty( $read_more_text ) ) {

			if( 1 === absint( $hide_post_btn ) ){

				$output = '&hellip;';

			}else{

				$output = '&hellip;<p><a href="' . esc_url( get_permalink() ) . '" class="read-more">' . esc_html( $read_more_text ) . '</a></p>';

			}

		}

		return $output;

	}
endif;

if ( ! function_exists( 'blog_zone_hook_read_more_filters' ) ) :

	/**
	 * Hook read more and excerpt length filters.
	 *
	 * @since 1.0.0
	 */
	function blog_zone_hook_read_more_filters() {

		if ( is_home() || is_category() || is_tag() || is_author() || is_date() || is_search() ) {

			add_filter( 'excerpt_length', 'blog_zone_implement_excerpt_length', 999 );
			
			add_filter( 'the_content_more_link', 'blog_zone_content_more_link', 10, 2 );
			
			add_filter( 'excerpt_more', 'blog_zone_implement_read_more' );

		}

	}
endif;

add_action( 'wp', 'blog_zone_hook_read_more_filters' );

if ( ! function_exists( 'blog_zone_gotop' ) ) :

	function blog_zone_gotop() {

		echo '<a href="#page" class="gotop" id="btn-gotop"><i class="fa fa-angle-up"></i></a>';

	}

endif;

add_action( 'wp_footer', 'blog_zone_gotop' );

//TGM Plugin activation.
require_once trailingslashit( get_template_directory() ) . '/inc/tgm/class-tgm-plugin-activation.php';
function blog_zone_register_required_plugins() {
	
	$plugins = array(
		array(
            		'name'      => esc_html__( 'HubSpot All-In-One Marketing - Forms, Popups, Live Chat', 'blog-zone' ),
			'slug'      => 'leadin',
			'required'  => false,
		),
	);

	tgmpa( $plugins );
}

add_action( 'tgmpa_register', 'blog_zone_register_required_plugins' );