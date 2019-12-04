<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blog_Zone
 */

$hide_blog_post_date 	= blog_zone_options( 'hide_blog_post_date' );
$hide_blog_post_cat  	= blog_zone_options( 'hide_blog_post_cat' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php 
		if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) { ?>
			<div class="entry-img">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
	       </div>
	       <?php
	    } 
		?>
	<div class="content-wrap">
		<header class="entry-header">
			<?php

			if ( 1 !== absint( $hide_blog_post_date ) ) { ?>

				<span class="posted-date"><?php blog_zone_posted_on(); ?><?php if( 1 !== absint( $hide_blog_post_cat ) && ( 'post' === get_post_type() ) ) { echo esc_html__( ' - ', 'blog-zone' ); } ?></span>
				<?php
			}

			if ( 1 !== absint( $hide_blog_post_cat ) && ( 'post' === get_post_type() ) ) {

				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( esc_html__( ', ', 'blog-zone' ) );

				if ( $categories_list ) {
					printf( '<span class="cat-links">%s</span>', $categories_list ); // WPCS: XSS OK.
				}

			}

			if ( is_singular() ) :

				the_title( '<h1 class="entry-title">', '</h1>' );

			else :

				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

			endif;

			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php

			if( is_single() ){
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blog-zone' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blog-zone' ),
					'after'  => '</div>',
				) );
			} else{

				the_excerpt();

			} ?>
		</div><!-- .entry-content -->
	</div>
</article>
