<?php
// if (is_admin()) {

    // add_filter('pearl_theme_options', 'stm_pearl_theme_options');

    // function stm_pearl_theme_options($theme_options)
    // {
    //     /*Google Settings*/
    //     $google_settings = array(
    //         'divider_api_1' => array(
    //             'type' => 'divider',
    //             'data' => array(
    //                 'title' => esc_html__('Google API settings', 'pearl'),
    //                 'value' => ''
    //             )
    //         ),
    //         'google_api_key' => array(
    //             'type' => 'text',
    //             'data' => array(
    //                 'title' => esc_html__('Google API key', 'pearl'),
    //                 'value' => ''
    //             )
    //         ),
    //         'ga' => array(
    //             'type' => 'text',
    //             'data' => array(
    //                 'title' => esc_html__('Google analytics ID', 'pearl'),
    //                 'value' => ''
    //             )
    //         ),
    //     );
    //     $current_options = $theme_options['general']['options']['global']['options'];
    //     $theme_options['general']['options']['global']['options'] = array_merge($current_options, $google_settings);

    //     /*Custom Taxonomies Slug*/
    //     $taxonomies = stm_pearl_custom_taxonomies_data();
    //     $theme_options['post_types']['options'] = array_merge($theme_options['post_types']['options'], $taxonomies);

    //     return $theme_options;
    // }

    // if (function_exists('vc_add_shortcode_param')) {
    //     vc_add_shortcode_param('stm_animator', 'pearl_animator_param');
    // }

//     if (!function_exists('pearl_animator_param')) {
//         function pearl_animator_param($settings, $value)
//         {
//             global $wp_filesystem;

//             if (empty($wp_filesystem)) {
//                 require_once ABSPATH . '/wp-admin/includes/file.php';
//                 WP_Filesystem();
//             }
//             $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
//             $type = isset($settings['type']) ? $settings['type'] : '';
//             $class = isset($settings['class']) ? $settings['class'] : '';
//             $animations = json_decode($wp_filesystem->get_contents(get_template_directory() . '/assets/js/animate-config.json'), true);
//             if ($animations) {
//                 $output = '<select name="' . esc_attr($param_name) . '" class="wpb_vc_param_value ' . esc_attr($param_name . ' ' . $type . ' ' . $class) . '">';
//                 foreach ($animations as $key => $val) {
//                     if (is_array($val)) {
//                         $labels = str_replace('_', ' ', $key);
//                         $output .= '<optgroup label="' . ucwords(esc_attr($labels)) . '">';
//                         foreach ($val as $label => $style) {
//                             $label = str_replace('_', ' ', $label);
//                             if ($label == $value) {
//                                 $output .= '<option selected value="' . esc_attr($label) . '">' . esc_html($label) . '</option>';
//                             } else {
//                                 $output .= '<option value="' . esc_attr($label) . '">' . esc_html($label) . '</option>';
//                             }
//                         }
//                     } else {
//                         if ($key == $value) {
//                             $output .= "<option selected value=" . esc_attr($key) . ">" . esc_html($key) . "</option>";
//                         } else {
//                             $output .= "<option value=" . esc_attr($key) . ">" . esc_html($key) . "</option>";
//                         }
//                     }
//                 }

//                 $output .= '</select>';
//             }

//             return $output;
//         }
//     }
// }


// add_action('pearl_gmap_end', 'stm_pearl_gmap_end');

// function stm_pearl_gmap_end()
// {
//     if (!empty($_SERVER['HTTP_X_BARBA']) && $_SERVER['HTTP_X_BARBA'] === 'yes') {
//         ob_start();
//         require_once(locate_template("assets/js/StmMarker.js"));
//         $custom_js_script = str_replace('<script type="text/javascript">', '<script type="text/javascript">' . ob_get_clean() . ' ', $custom_js_script);

//         $js = array('document.body.addEventListener("stm_gmap_api_loaded", stm_init_map, false);', 'function stm_init_map');
//         $js_code = array('', 'window.stm_init_map_barba = function');

//         echo html_entity_decode(str_replace($js, $js_code, $custom_js_script));
//     }
// }

add_filter('script_loader_tag', 'pearl_add_async_attribute', 10, 2);

function pearl_add_async_attribute($tag, $handle)
{
    $handles = array(
        'gmap'
    );

    if (!in_array($handle, $handles)) {
        return $tag;
    } else {
        return str_replace(array(' src', "type='text/javascript'"), array(' data-src', ''), $tag);
    }
}

// add_filter('pearl_base_encode', 'stm_pearl_base_encode');

// function stm_pearl_base_encode($data)
// {
//     return base64_encode($data);
// }

// function stm_pearl_custom_taxonomies()
// {
//     return array(
//         'stm_projects',
//         'stm_events',
//         'stm_services',
//         'stm_testimonials',
//         'stm_stories',
// //        'stm_vacancies',
//         'stm_albums',
//         'stm_video',
// //        'stm_media_events',
//         'stm_staff',
//         'stm_products'
//     );
// }

// function stm_pearl_custom_taxonomies_data()
// {
//     $r = array(
//         'terms_slug' => array(
//             'title' => esc_html__('Custom Categories', 'pearl'),
//             'options' => array()
//         )
//     );
//     $taxes = stm_pearl_custom_taxonomies();
//     foreach ($taxes as $tax) {

//         $tax_name = explode('_', ucfirst(str_replace('stm_', '', $tax)));


//         $r['terms_slug']['options'][$tax] = array(
//             'type' => 'text',
//             'data' => array(
//                 'title' => sprintf(esc_html__('%s category slug', 'pearl'), implode(' ', $tax_name)),
//                 'value' => ''
//             )
//         );

//     }

//     return $r;
// }