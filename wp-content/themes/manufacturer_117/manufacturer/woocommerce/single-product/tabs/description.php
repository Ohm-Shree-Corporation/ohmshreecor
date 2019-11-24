<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
global $product;
$theme_options = man_theme_options();
$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'manufacturer' ) ) );

?>

<div class="row">

	<?php if ($theme_options['shopsettings_attributes'] == 1){ ?>
		
		<div class="col-md-6">
			<?php the_content(); ?>
		</div>
		<div class="col-md-6">
			<h3><?php echo esc_html__( 'Details', 'manufacturer' ); ?></h3>
			<?php do_action( 'woocommerce_product_additional_information', $product ); ?>
		</div>


	<?php }else{ ?>
		
		<div class="col-md-12">
			<?php the_content(); ?>
		</div>

	<?php } ?>
	

</div>


