<?php
add_action('load-themes.php', 'pearl_after_switch_theme');
add_action('after_switch_theme', 'pearl_after_switch_theme');
function pearl_after_switch_theme($data)
{
	$theme = wp_get_theme();
	$theme_version = $theme->get('Version');

	update_option('stm_theme_version', $theme_version);



	pearl_update_custom_styles();
}

add_action('switch_theme', 'pearl_switch_theme');
function pearl_switch_theme()
{
	delete_option('stm_theme_version');
}


add_action('init', 'pearl_remove_woo_redirect', 10);

function pearl_remove_woo_redirect() {
	delete_transient( '_wc_activation_redirect' );
	if(get_option('stm_custom_styles_v', 1) === 1) {
		pearl_update_custom_styles();
	}
}

add_action('pearl_importer_done', 'pearl_reset_styles_after_action');
add_action('woocommerce_installed', 'pearl_reset_styles_after_action');

function pearl_reset_styles_after_action() {
	pearl_update_custom_styles();

	global $wp_filesystem;
	if ( empty( $wp_filesystem ) ) {
		require_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem();
	}

	$fxml = get_temp_dir() . get_option('stm_layout') . '.xml';
	$fzip = get_temp_dir() . get_option('stm_layout') . '.zip';
	if( file_exists($fxml) ) @unlink($fxml);
	if( file_exists($fzip) ) @unlink($fzip);
}