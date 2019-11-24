<?php

function pearl_layout_plugins($layout = 'textile', $get_layouts = false)
{
  $required = array(
    'elementor',
    'header-footer-elementor',
    'redux-framework',
  );
  $plugins = array(
    'textile' => array(
      'elementor',
      'elementor-sm-widgets', 
    	'breadcrumb-navxt',
    	'contact-form-7',
	    'mailchimp-for-wp',
	    'woocommerce',
	    'yikes-inc-easy-custom-woocommerce-product-tabs',
	    'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'industrial' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
    	'contact-form-7',
	    'mailchimp-for-wp',
	    'woocommerce',
	    'yikes-inc-easy-custom-woocommerce-product-tabs',
	    'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'factory' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance',
      'extended-google-map-for-elementor'
    ),
    'industrial2' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'industrial3' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance',
      'extended-google-map-for-elementor'
    ),
    'snacks' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
    	'contact-form-7',
	    'mailchimp-for-wp',
	    'woocommerce',
	    'yikes-inc-easy-custom-woocommerce-product-tabs',
	    'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'leather' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'lamps' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'furniture' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'dashcam' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'gimbal' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'sewing' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'packaging' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'cosmetics' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'pharmacy' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'paper' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'chemical' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'tubes' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'gates' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'bolt' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'parts' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    'ceramic' => array(
      'elementor',
      'elementor-sm-widgets', 
      'breadcrumb-navxt',
      'contact-form-7',
      'mailchimp-for-wp',
      'woocommerce',
      'yikes-inc-easy-custom-woocommerce-product-tabs',
      'manufacturer-tables',
      'stm-gdpr-compliance'
    ),
    
  );

  if ($get_layouts) return $plugins;

  return array_merge($required, $plugins[$layout]);
}



$includes = get_template_directory() . '/includes/admin/product_registration/includes/';
define('STM_ITEM_NAME', 'Manufacturer');
define('STM_API_URL', 'https://panel.stylemixthemes.com/api/');

/*Connect Envato market plugin.*/
if(!class_exists('Envato_Market')) {
	require_once($includes . 'envato-market/envato-market.php');
}

require_once $includes . 'theme.php';
require_once $includes . 'admin_screens.php';
require_once $includes . 'review-notice.php';