<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Manufacturer
 */
$theme_options = man_theme_options();
?>

	</div><!-- #content -->
	

	<?php 
		if ( class_exists( 'ReduxFramework' ) && function_exists( 'hfe_render_footer' ) ) {
			if ($theme_options['default_header'] == 0) {
				hfe_render_footer();
			}else{?>
				<div class="man_footer_default">
					<div class="container">
			      <div class="row">
			          <div class="col-md-12">
			              <!-- Copyrights -->
			              <h3><?php echo esc_html(bloginfo($name));  ?></h3>
			              <p><?php echo esc_html(get_bloginfo('description'));  ?></p>
			          </div>
			      </div>
			  	</div>
				</div>
			<?php }
		}else{
	?>
	<div class="man_footer_default">
		<div class="container">
      <div class="row">
          <div class="col-md-12">
              <!-- Copyrights -->
              <h3><?php echo esc_html(bloginfo($name));  ?></h3>
              <p><?php echo esc_html(get_bloginfo('description'));  ?></p>
          </div>
      </div>
  	</div>
	</div>

	<?php } ?>


</div><!-- #page -->

<?php wp_footer(); ?>


</body>
</html>
