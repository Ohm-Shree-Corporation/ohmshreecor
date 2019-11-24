<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Manufacturer
 */
get_header();
$main_sidebar = 'col-md-9';
if ( class_exists( 'ReduxFramework' ) ) { 
		if (  function_exists( 'is_woocommerce_activated' ) ) {
			if (is_cart() || is_checkout() || is_account_page() ) {
				if (isset($theme_options['shopsettings-fullwidth'])) {
		        if ($theme_options['shopsettings-fullwidth'] == 1){
		            $main_sidebar = 'col-md-12 col-lg-9';
		        }else{
		            $main_sidebar = 'col-md-12';
		        }
			    }else{
			        $main_sidebar = 'col-md-12 col-lg-9';
			    }
	    }else{
	        $main_sidebar = 'col-md-12 col-lg-9';
	    }
		}else{
			if (isset($theme_options['blogsettings-fullwidth'])) {
	        if ($theme_options['blogsettings-fullwidth'] == 1){
	            $main_sidebar = 'col-md-12 col-lg-9';
	        }else{
	            $main_sidebar = 'col-md-12';
	        }
	    }else{
	        $main_sidebar = 'col-md-12 col-lg-9';
	    }
		}
    
}
?>

<div class="container">
	<div class="row">
			<div class="<?php echo esc_attr($main_sidebar); ?> man_main_sidebar">

				<div id="primary" class="content-area">
					<main id="main" class="site-main">
					
					





					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
					

					</main><!-- #main -->
				</div><!-- #primary -->

			</div>

		

			<?php if ( class_exists( 'ReduxFramework' ) ) { ?>
				<?php if (  function_exists( 'is_woocommerce_activated' ) ) { ?>
					<?php if (is_cart() || is_checkout() || is_account_page() ) { ?>
						<?php if (isset($theme_options['shopsettings-fullwidth'])) { ?>
			              	<?php if ($theme_options['shopsettings-fullwidth'] == 1) {?>
			                  <div class="col-lg-3 man_sidebar_col">
			                  	<div class="man_sidebar">
			                      <?php dynamic_sidebar('sidebar-woo'); ?>
			                    </div>
			                  </div>
			            	<?php } ?>

			          	<?php }else{ ?>
			              <div class="col-lg-3 man_sidebar_col">
			              	<div class="man_sidebar">
								<?php dynamic_sidebar('sidebar-woo'); ?>
							</div>
			              </div>
	          			<?php } ?>

					<?php }else{ ?>
						<?php if ($theme_options['blogsettings-fullwidth'] == 1) {?>
							<div class="col-lg-3 man_sidebar_col">
								<div class="man_sidebar">
								<?php dynamic_sidebar('sidebar-main'); ?>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				<?php }else{ ?>
					<div class="col-lg-3 man_sidebar_col">
						<div class="man_sidebar">
							<?php dynamic_sidebar('sidebar-main'); ?>
						</div>
					</div>
				<?php } ?>
				
			<?php }else{ ?>
				<div class="col-lg-3 man_sidebar_col">
					<div class="man_sidebar">
					<?php dynamic_sidebar('sidebar-main'); ?>
					</div>
				</div>
			<?php } ?>
			
	</div>

	

</div>


<?php

get_footer();

