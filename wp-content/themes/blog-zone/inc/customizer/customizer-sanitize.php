<?php
/**
 * Sanitize functions
 *
 * @package Blog_Zone
 */

if ( ! function_exists( 'blog_zone_sanitize_select' ) ) :

	/**
	 * Sanitize select.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed                $input The value to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return mixed Sanitized value.
	 */
	function blog_zone_sanitize_select( $input, $setting ) {

		// Ensure input is clean.
		$input = sanitize_text_field( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

endif;

if ( ! function_exists( 'blog_zone_sanitize_number' ) ) :

	/**
	 * Sanitize number.
	 *
	 * @since 1.0.0
	 *
	 * @param int                  $input Number to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return int Sanitized number; otherwise, the setting default.
	 */
	function blog_zone_sanitize_number( $input, $setting ) {

		$input = absint( $input );

		// If the input is an absolute integer, return it.
		// otherwise, return the default.
		return ( $input ? $input : $setting->default );

	}

endif;

if ( ! function_exists( 'blog_zone_sanitize_dropdown_pages' ) ) :

	/**
	 * Sanitize dropdown pages.
	 *
	 * @since 1.0.0
	 *
	 * @param int                  $page_id Page ID.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return int|string Page ID if the page is published; otherwise, the setting default.
	 */
	function blog_zone_sanitize_dropdown_pages( $page_id, $setting ) {

		// Ensure $input is an absolute integer.
		$page_id = absint( $page_id );

		// If $page_id is an ID of a published page, return it; otherwise, return the default.
		return ( 'publish' === get_post_status( $page_id ) ? $page_id : $setting->default );

	}

endif;


if ( ! function_exists( 'blog_zone_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function blog_zone_sanitize_checkbox( $checked ) {

		return ( ( isset( $checked ) && true === $checked ) ? true : false );

	}

endif;


//=============================================================
// For active callbacks used in theme
//=============================================================
if ( ! function_exists( 'blog_zone_notice_type_category' ) ) :

	function blog_zone_notice_type_category( $control ) { 

		if( 'category_posts' == $control->manager->get_setting('notice_type')->value() ){
			
			return true;

		} else {

			return false;

		}
	}
 
endif;

if ( ! function_exists( 'blog_zone_slider_active' ) ) :

	function blog_zone_slider_active( $control ) { 

		if( 'true' == $control->manager->get_setting('slider_status')->value() ){
			
			return true;

		} else {

			return false;

		}
	}
 
endif;

if ( ! function_exists( 'blog_zone_slider_type_category' ) ) :

	function blog_zone_slider_type_category( $control ) { 

		if( 'true' == $control->manager->get_setting('slider_status')->value() && 'category_posts' == $control->manager->get_setting('slider_type')->value() ){
			
			return true;

		} else {

			return false;

		}
	}
 
endif;

if ( ! function_exists( 'blog_zone_slider_type_page' ) ) :

	function blog_zone_slider_type_page( $control ) { 

		if(  'true' == $control->manager->get_setting('slider_status')->value() && 'pages' == $control->manager->get_setting('slider_type')->value() ){
			
			return true;

		} else {

			return false;

		}
	}
 
endif;


if ( ! function_exists( 'blog_zone_featured_post_type_category' ) ) :

	function blog_zone_featured_post_type_category( $control ) { 

		if( 'category_posts' == $control->manager->get_setting('featured_post_type')->value() ){
			
			return true;

		} else {

			return false;

		}
	}
 
endif;

if ( ! function_exists( 'blog_zone_featured_post_type_page' ) ) :

	function blog_zone_featured_post_type_page( $control ) { 

		if( 'pages' == $control->manager->get_setting('featured_post_type')->value() ){
			
			return true;

		} else {

			return false;

		}
	}
 
endif;


if ( ! function_exists( 'blog_zone_excerpt_active' ) ) :

	function blog_zone_excerpt_active( $control ) { 

		if( 'true' == $control->manager->get_setting('slider_status')->value() && 'excerpt' == $control->manager->get_setting('content_type')->value()){
			
			return true;

		} else {

			return false;

		}
	}
 
endif;