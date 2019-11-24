<?php
$layouts_to_path = STM_CONFIGURATIONS_PATH . '/importer/helpers/theme_options';

function stm_get_layout_options($layout)
{
	$options = call_user_func('stm_theme_options_' . $layout);
	$options = json_decode($options, true);
	$options['show_page_title'] = 'false';
	return $options;
}

require_once $layouts_to_path . '/textile.php';
require_once $layouts_to_path . '/industrial.php';
require_once $layouts_to_path . '/snacks.php';
require_once $layouts_to_path . '/leather.php';
require_once $layouts_to_path . '/lamps.php';
require_once $layouts_to_path . '/furniture.php';
require_once $layouts_to_path . '/dashcam.php';
require_once $layouts_to_path . '/gimbal.php';
require_once $layouts_to_path . '/sewing.php';
require_once $layouts_to_path . '/factory.php';
require_once $layouts_to_path . '/industrial2.php';
require_once $layouts_to_path . '/industrial3.php';
require_once $layouts_to_path . '/packaging.php';
require_once $layouts_to_path . '/pharmacy.php';
require_once $layouts_to_path . '/cosmetics.php';
require_once $layouts_to_path . '/paper.php';
require_once $layouts_to_path . '/chemical.php';
require_once $layouts_to_path . '/tubes.php';
require_once $layouts_to_path . '/gates.php';
require_once $layouts_to_path . '/bolt.php';
require_once $layouts_to_path . '/parts.php';
require_once $layouts_to_path . '/ceramic.php';
