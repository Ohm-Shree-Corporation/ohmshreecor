<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$theme_options = man_theme_options();



?>
<li <?php wc_product_class( '', $product ); ?>>
	




	<?php 

	//Type 3
	if($theme_options['shopsettings-category_type'] == 3 ){
	
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		?>
		<a href="<?php echo get_permalink(); ?>" class="man_vertical_product_link" >

		  	<?php echo woocommerce_get_product_vertical_thumbnail(); ?>
			<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
			<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
		  </a>
	 



	<?php } ?>

	<?php 

	//Type 2
	if($theme_options['shopsettings-category_type'] == 2 ){
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
		?>
		<div class="col-md-4 man_product_photo_col">

			<div class="man_product_photo man_image_bck" data-image="<?php echo wp_get_attachment_image_src( $product->get_image_id(), 'manufacturer_medium' )[0]; ?>">
			<a href="<?php echo get_permalink(); ?>" class="man_product_photo_link"></a>
		</div></div>
		<!-- photo end -->

		<div class="col-md-8 man_product_cont_col <?php if ($product->get_price() == '') {echo ' man_product_cont_no_price';} ?>">
			
			<div class="man_product_cont">
			
			<a href="<?php echo get_permalink(); ?>" >
			<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
			<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
			</a>
			
			<?php
			$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

			if ( ! $short_description ) {
				return;
			}

			?>
			<div class="woocommerce-product-details__short-description">
				<?php echo mb_strimwidth ($short_description, 0, 147, '...'); // WPCS: XSS ok. ?>
			</div>
			

			<div class="man_product_cont_desc">

			<?php	do_action( 'woocommerce_after_shop_loop_item' ); ?>

			</div>
			<?php

			

			?>
			</div></div>
			<!-- Man cont end -->

	<?php }

	//Type 1
	if ($theme_options['shopsettings-category_type'] == 1 ) { ?>

		<div class="man_product_photo man_image_bck">
			<img src="<?php echo wp_get_attachment_image_src( $product->get_image_id(), 'manufacturer_medium' )[0]; ?>">
			
			<?php if (isset($theme_options['shopsettings_hover'])) { ?>
			<?php if ($theme_options['shopsettings_hover'] == 1 ) { ?>

			<div class="man_product_photo_hover man_image_bck" 
				<?php if ( !empty($product->get_gallery_image_ids())){ ?>
				data-image="<?php echo wp_get_attachment_image_src($product->get_gallery_image_ids()[0],'manufacturer_medium')[0]; ?>">
				<?php } ?>
			</div>
			<a href="<?php echo get_permalink(); ?>" class="man_product_photo_link"></a>
			<?php } ?>
			<?php } ?>
			
		</div>
		<!-- photo end -->

		<div class="man_product_cont">

			
			<a href="<?php echo get_permalink(); ?>" >
				<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
				<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
				<span class="man_product_cont_btn">
					<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
				</span>
			</a>

		</div>
		<!-- Man cont end -->

	<?php } ?>
	
	

	


</li>
