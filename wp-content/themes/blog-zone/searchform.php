<?php
/**
 * Template for displaying search forms in Blog Zone
 *
 * @package WordPress
 * @subpackage Blog_Zone
 * @since Blog Zone 1.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'blog-zone' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'blog-zone' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'blog-zone' ); ?></span><i class="fa fa-search" aria-hidden="true"></i></button>
</form>