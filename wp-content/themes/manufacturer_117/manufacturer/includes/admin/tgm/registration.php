<?php
/*Require TGM CLASS*/
require_once $pearl_include_path . 'admin/tgm/class-tgm-plugin-activation.php';

/*Register plugins to activate*/
add_action('tgmpa_register', 'pearl_require_plugins');

function pearl_require_plugins($return = false)
{
	$plugins_path = get_template_directory() . '/includes/admin/tgm/plugins';

	$plugins = array(   
		'elementor' => array(
			'name' => 'Elementor',
			'slug' => 'elementor',
			'required' => true,
		),
		'elementor-sm-widgets' => array(
			'name' => 'Elementor Stylemix Plugin',
			'slug' => 'elementor-sm-widgets',
			'source' => get_template_directory() . ('/includes/admin/tgm/plugins/elementor-sm-widgets.zip'),
			'required' => false,
			'version' => '1.1.7',
		),
		'header-footer-elementor' => array(
			'name' => 'Header Foooter Plugin for Elementor',
			'slug' => 'header-footer-elementor',
			'required' => true,
		),
		'contact-form-7' => array(
			'name' => 'Contact Form 7',
			'slug' => 'contact-form-7',
			'required' => false,
			'force_activation' => false,
		),
		'breadcrumb-navxt' => array(
			'name' => 'Breadcrumb NavXT',
			'slug' => 'breadcrumb-navxt',
			'required' => false,
		),
		'mailchimp-for-wp' => array(
			'name' => 'MailChimp for WordPress',
			'slug' => 'mailchimp-for-wp',
			'required' => false,
			'external_url' => 'https://mc4wp.com/'
		),
		'woocommerce' => array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => false,
			'force_activation' => false,
		),
		'yikes-inc-easy-custom-woocommerce-product-tabs' => array(
			'name'      => 'WooCommerce Product Tabs',
			'slug'      => 'yikes-inc-easy-custom-woocommerce-product-tabs',
			'required'  => false,
			'force_activation' => false,
		),
		'manufacturer-tables' => array(
			'name' => 'Manufacturer Related Tables',
			'slug' => 'manufacturer-tables',
			'source' => get_template_directory() . ('/includes/admin/tgm/plugins/manufacturer-tables.zip'),
			'required' => false,
			'version' => '1.2',
		),
		'redux-framework' => array(
			'name'      => 'Redux Framework',
			'slug'      => 'redux-framework',
			'required'  => true,
			'force_activation' => false,
		),
		'extended-google-map-for-elementor' => array(
			'name'      => 'Elementor Google Map Extended',
			'slug'      => 'extended-google-map-for-elementor',
			'required'  => false,
			'force_activation' => false,
		),
		'stm-gdpr-compliance' => array(
	        'name' => 'GDPR Compliance & Cookie Consent',
	        'slug' => 'stm-gdpr-compliance',
	        'source' => get_template_directory() . ('/includes/admin/tgm/plugins/stm-gdpr-compliance.zip'),
	        'required' => false,
	        'version' => '1.1',
	        'external_url' => 'http://stylemixthemes.com/'
	    ),

	);


	if($return) {
		return $plugins;
	} else {
		$config = array(
			'id'           => 'pearl_id23432432432',
			'is_automatic' => false
		);

		tgmpa($plugins, $config);
	}
}