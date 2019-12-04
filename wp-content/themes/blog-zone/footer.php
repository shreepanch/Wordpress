<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blog_Zone
 */

?>
			</div> <!-- inner-wrapper -->   
		</div><!-- .container -->
	</div><!-- #content -->

	<?php
	if ( is_active_sidebar( 'footer-1' ) ||
	 is_active_sidebar( 'footer-2' ) ||
	 is_active_sidebar( 'footer-3' ) ||
	 is_active_sidebar( 'footer-4' ) ) :
	?>
		<aside id="footer-widgets" class="widget-area">

		    <div class="container">
		        <div class="inner-wrapper">

		        	<?php
		        		$column_count = 0;
		        		for ( $i = 1; $i <= 4; $i++ ) {
		        			if ( is_active_sidebar( 'footer-' . $i ) ) {
		        				$column_count++;
		        			}
		        		}
		        	 ?>

		        	 <?php
		        	 $column_class = 'widget-column footer-active-' . absint( $column_count );
		        	 for ( $i = 1; $i <= 4 ; $i++ ) {
		        	 	if ( is_active_sidebar( 'footer-' . $i ) ) {
		        	 		?>
		        	 		<div class="<?php echo $column_class; ?>">
		        	 			<?php dynamic_sidebar( 'footer-' . $i ); ?>
		        	 		</div>
		        	 		<?php
		        	 	}
		        	 }
		        	 ?>
		        </div><!-- .inner-wrapper -->
		    </div><!-- .container -->

		</aside><!-- #footer-widgets -->

	<?php endif; ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
	   <div class="container">
	      <div class="site-info-holder">
	        <div class="copyright">
				<?php 

				$copyright = blog_zone_options('copyright_text');

				if( !empty( $copyright )){ ?>

				    <span class="copyright-text">

				        <?php echo wp_kses_data( $copyright ); ?>

				    </span>

				    <?php

				} ?>
				<span><?php echo esc_html( 'Blog Zone by ', 'blog-zone' ); ?><a href="<?php echo esc_url('https://www.prodesigns.com'); ?>" target="_blank"><?php echo esc_html( 'ProDesigns', 'blog-zone' ); ?></a></span>
	        </div>
	    </div>
	   </div><!-- .container -->
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
