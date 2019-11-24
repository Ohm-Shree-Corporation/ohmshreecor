<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Manufacturer
 */
$theme_options = man_theme_options();
$columns = 3;
$columns = $theme_options['blogsettings_columns'];
?>



<?php
	if ( is_singular() ) {
?>


<?php 
	}else{
?>

	<div class="man_news_grid_item col-12 col-sm-6 col-md-<?php echo esc_attr($columns); ?>">
			<a href="<?php echo esc_url( get_permalink() ); ?>" class="man_news_item_link"></a>

			<div class="man_news_item_img">
				<img 
					src="<?php echo get_the_post_thumbnail_url( get_post(), 'woocommerce_thumbnail'); ?>"
					srcset="<?php echo wp_get_attachment_image_srcset( get_post_thumbnail_id(), 'large' ) ?>"
					sizes="<?php echo wp_get_attachment_image_sizes( $attachment_id, 'large' ) ?>"
				>	
				<div class="man_news_item_over"></div>	
				<div class="man_news_item_cont">
					<div class="man_news_item_title"><?php the_title(); ?></div>
					<div class="man_news_item_date"><?php manufacturer_posted_on();?></div>	
				</div>
			</div>

	</div>


<?php 
	}
?>

