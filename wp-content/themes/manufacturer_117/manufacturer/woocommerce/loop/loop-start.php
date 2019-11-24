<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$theme_options = man_theme_options();
if ( class_exists( 'ReduxFramework' ) ) { 
?>
	<?php if ($theme_options['shopsettings-category_type'] == 1 ) { ?>
	<ul class="products products_grid_type columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?>">
	<?php }elseif( $theme_options['shopsettings-category_type'] == 2 ){ ?>
	<ul class="products-default products_list_type">
	<?php }elseif($theme_options['shopsettings-category_type'] == 3 ){ ?>
	<ul class="products woo_products man_vertical_products_default columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?>"">
	<?php } ?>

<?php }else{ ?>
<ul class="products columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?>">
<?php } ?>
