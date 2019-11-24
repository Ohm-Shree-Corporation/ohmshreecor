<?php

/*Theme setups (image sizes, content width, post supports, sidebars, menus);*/
require_once( get_template_directory() . '/inc/functions/setup.php');

/*Register scripts/styles*/
require_once( get_template_directory() . '/inc/functions/enqueue.php');

/*Header/Footer*/
require_once( get_template_directory() . '/inc/functions/hf.php');

/*Blog Options*/
require_once( get_template_directory() . '/inc/functions/blog_setup.php');

/*WPML Options*/
if ( function_exists('wpml_object_id') ) {
require_once( get_template_directory() . '/inc/functions/wpml.php');
}

/*WooCommerce Setup*/
if ( class_exists( 'WooCommerce' ) ) {
require_once( get_template_directory() . '/inc/functions/woo_setup.php');
}



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Theme Options
 */
if ( !isset( $redux_demo ) && file_exists( get_template_directory() . '/inc/theme_options.php' ) ) {
    require_once( get_template_directory() . '/inc/theme_options.php' );
}




/*Admin includes*/
if (is_admin()) {
	$pearl_include_path = get_template_directory() . '/includes/';
	$pearl_admin_includes_path = $pearl_include_path . 'admin/';
	$pearl_theme_include_path = $pearl_include_path . 'theme/';
	$pearl_widgets_path = $pearl_include_path . '/widgets/';

	require_once($pearl_theme_include_path . 'print_styles.php');
	
	/*Product registration*/
	require_once($pearl_admin_includes_path . '/product_registration/admin.php');

	/*Custom theme functions*/
	require_once($pearl_theme_include_path . 'theme.php');

	/*TGM for plugins registration*/
	require_once($pearl_admin_includes_path . 'tgm/registration.php');

}


