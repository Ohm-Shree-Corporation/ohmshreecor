<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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


<div class="container man_search_page">
	<div class="row">
			<div class="<?php echo esc_attr($main_sidebar); ?> man_main_sidebar">

				<div id="primary" class="content-area">
					<main id="main" class="site-main">
					
					
					<?php if ( have_posts() ) : ?>

					<header class="page-header">

					</header><!-- .page-header -->

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );

					endwhile;

					the_posts_navigation();

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