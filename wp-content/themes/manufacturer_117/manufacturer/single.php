<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
					
					
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', get_post_type() );

						

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

<div class="man_nearby_posts row">

	<?php $prevPost = get_previous_post(true);
	if($prevPost) {?>
	<div class="nav-box man_nav_previous man_image_bck col-md-6" data-image="<?php echo get_the_post_thumbnail_url( $prevPost->ID, 'medium_large'); ?>" data-color="#292929">
	<a href="<?php echo esc_url(get_permalink($prevPost->ID)); ?>"></a>
	<div class="man_nav_over"></div>
	<div class="man_nav_txt">
		<span><i class="ti ti-angle-left"></i>Previous</span> 
		<h3><?php echo get_the_title($prevPost->ID); ?></h3>
	</div>
	</div>
	<?php }else{ ?>
		<div class="nav-box man_nav_previous man_image_bck col-md-6" data-color="#333">
		<div class="man_nav_over"></div>
		<div class="man_nav_txt">
			<h3><?php echo get_the_title($post->ID); ?></h3>
		</div>
		</div>
	<?php } ?>
	 
	<?php $nextPost = get_next_post(true);
	if($nextPost) { ?>
	<div class="nav-box man_nav_next man_image_bck col-md-6" data-image="<?php echo get_the_post_thumbnail_url( $nextPost->ID, 'medium_large'); ?>" data-color="#292929">
	<a href="<?php echo esc_url(get_permalink($nextPost->ID)); ?>"></a>
	<div class="man_nav_over"></div>
	<div class="man_nav_txt">
		<span>Next <i class="ti ti-angle-right"></i></span> 
		<h3><?php echo get_the_title($nextPost->ID); ?></h3>
	</div>
	</div>
	<?php }else{ ?>
		<div class="nav-box man_nav_next man_image_bck col-md-6" data-color="#333">
		<div class="man_nav_over"></div>
		<div class="man_nav_txt">
			<h3><?php echo get_the_title($post->ID); ?></h3>
		</div>
		</div>
	<?php } ?>

</div>

<?php

get_footer();
