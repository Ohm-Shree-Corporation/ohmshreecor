<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Manufacturer
 */

get_header();
$main_sidebar = 'col-md-9';
if ( class_exists( 'ReduxFramework' ) ) { 
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

?>

<div class="container">
	<div class="row">
			<div class="<?php echo esc_attr($main_sidebar); ?> man_main_sidebar">

				<div id="primary" class="content-area">
					<main id="main" class="site-main">
					
					
					<?php if ( have_posts() ) : ?>


						<?php
						/* Start the Loop */
						echo '<div class="man_blog_archive row">';
						while ( have_posts() ) :
							the_post();

							if ($theme_options['blogsettings-category_type'] == 1) {
								get_template_part( 'template-parts/content');
							}else{
								get_template_part( 'template-parts/content','grid');
							}

						endwhile;
						echo '</div>';

						man_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
					

					</main><!-- #main -->
				</div><!-- #primary -->

			</div>
			<?php if ( class_exists( 'ReduxFramework' ) ) { ?>
				<?php 
				if (isset($theme_options['blogsettings-fullwidth'])) {
				if ($theme_options['blogsettings-fullwidth'] == 1) {?>
					<div class="col-lg-3 man_sidebar_col">
						<div class="man_sidebar">
						<?php dynamic_sidebar('sidebar-main'); ?>
						</div>
					</div>
				<?php }} ?>
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
