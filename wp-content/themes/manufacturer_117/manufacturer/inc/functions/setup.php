<?php  
if ( ! function_exists( 'manufacturer_setup' ) ) :

	function manufacturer_setup() {
		load_theme_textdomain( 'manufacturer', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		if ( function_exists( 'add_image_size') ) add_theme_support( 'post-thumbnails');
		if( function_exists( 'add_image_size') ) {
			add_image_size( 'manufacturer_vertical_thumb', 285, 9999 );
			add_image_size( 'manufacturer_full', 1600, 9999 );
			add_image_size( 'manufacturer_medium', 600, 550, true );
		}

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'manufacturer' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'manufacturer_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'manufacturer_setup' );


// Ajax Nonces

add_action('wp_head', 'manufacturer_ajaxurl');
add_action('admin_head', 'manufacturer_ajaxurl');

if (!function_exists('manufacturer_ajaxurl')) {
 function manufacturer_ajaxurl()
 {
        $variables = array (
            'stm_ajax_add_review' => wp_create_nonce('stm_ajax_add_review'),
            'pearl_install_plugin' => wp_create_nonce('pearl_install_plugin'),
        );
        echo( '<script type="text/javascript">window.wp_data = '. json_encode( $variables ). ';</script>' );
 }
}



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function manufacturer_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'manufacturer_content_width', 940 );
}
add_action( 'after_setup_theme', 'manufacturer_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function manufacturer_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'manufacturer' ),
		'id'            => 'sidebar-main',
		'description'   => esc_html__( 'Add widgets here.', 'manufacturer' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Woo Sidebar', 'manufacturer' ),
		'id'            => 'sidebar-woo',
		'description'   => esc_html__( 'Add widgets here.', 'manufacturer' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'manufacturer_widgets_init' );


// Archive Title
add_filter( 'get_the_archive_title', function( $title ){
	return preg_replace('~^[^:]+: ~', '', $title );
});

// Buttons
add_filter( 'body_class', function( $classes ) {
	global $post;
	$theme_options = man_theme_options();
	if (isset($theme_options['button-round'])) {
		if ($theme_options['button-round'] == '1') {
			$my_classes = 'man_button_round';
			if ( $my_classes ) {
				$classes[] = $my_classes;
			}
		}
	}

	if (isset($theme_options['button-square'])) {
		if ($theme_options['button-square'] == '1') {
			$my_classes = 'man_button_square';
			if ( $my_classes ) {
				$classes[] = $my_classes;
			}
		}
	}

	if (isset($theme_options['squared_block'])) {
		if ($theme_options['squared_block'] == '1') {
			$my_classes = 'man_square_news';
			if ( $my_classes ) {
				$classes[] = $my_classes;
			}
		}
	}

	if (isset($theme_options['shopsettings_square'])) {
		if ($theme_options['shopsettings_square'] == '1') {
			$my_classes = 'man_square_shop';
			if ( $my_classes ) {
				$classes[] = $my_classes;
			}
		}
	}

	if ( isset($theme_options['button-shadow']) ) {

		if ($theme_options['button-shadow'] == '1') {
			$my_classes = 'man_button_shadow';
			if ( $my_classes ) {
				$classes[] = $my_classes;
			}
		}
		
	}
	
	return $classes;
} );


// Theme Options
function man_theme_options (){
	global $theme_options;
	return $theme_options;
}
function man_wpdb (){
	global $wpdb;
	return $wpdb;
}
function man_pagenow (){
	global $pagenow;
	return $pagenow;
}




/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
	$theme_options = man_theme_options();
	if (isset($theme_options['shopsettings_items_per_page'])) {
		$cols = $theme_options['shopsettings_items_per_page'];
	}else{
		$cols = 9;
	}
	
	return $cols;
}


// Gutenberg
add_theme_support( 'align-wide' );
add_theme_support('editor-styles');
add_theme_support( 'wp-block-styles' );	
add_theme_support( 'responsive-embeds' );


// Mega Menu
function megamenu_override_default_theme($value) {

  if ( !isset($value['primary']['theme']) ) {
    $value['primary']['theme'] = 'manufacturer_1560937368'; // change my_custom_theme_key to the ID of your exported theme
  }

  return $value;
}
add_filter('default_option_megamenu_settings', 'megamenu_override_default_theme');


function megamenu_add_theme_manufacturer_1560937368($themes) {
    $themes["manufacturer_1560937368"] = array(
        'title' => 'Manufacturer',
        'panel_header_border_color' => '#555',
        'panel_font_size' => '14px',
        'panel_font_color' => '#666',
        'panel_font_family' => 'inherit',
        'panel_second_level_font_color' => '#555',
        'panel_second_level_font_color_hover' => '#555',
        'panel_second_level_text_transform' => 'uppercase',
        'panel_second_level_font' => 'inherit',
        'panel_second_level_font_size' => '16px',
        'panel_second_level_font_weight' => 'bold',
        'panel_second_level_font_weight_hover' => 'bold',
        'panel_second_level_text_decoration' => 'none',
        'panel_second_level_text_decoration_hover' => 'none',
        'panel_second_level_border_color' => '#555',
        'panel_third_level_font_color' => '#666',
        'panel_third_level_font_color_hover' => '#666',
        'panel_third_level_font' => 'inherit',
        'panel_third_level_font_size' => '14px',
        'flyout_link_size' => '14px',
        'flyout_link_color' => '#666',
        'flyout_link_color_hover' => '#666',
        'flyout_link_family' => 'inherit',
        'responsive_breakpoint' => '1200px',
        'toggle_background_from' => '#222',
        'toggle_background_to' => '#222',
        'mobile_background_from' => '#222',
        'mobile_background_to' => '#222',
        'mobile_menu_item_link_font_size' => '14px',
        'mobile_menu_item_link_color' => '#ffffff',
        'mobile_menu_item_link_text_align' => 'left',
        'mobile_menu_item_link_color_hover' => '#ffffff',
        'mobile_menu_item_background_hover_from' => '#333',
        'mobile_menu_item_background_hover_to' => '#333',
        'custom_css' => '/** Push menu onto new line **/ 
#{$wrap} { 
    clear: both; 
}',
    );
    return $themes;
}
add_filter("megamenu_themes", "megamenu_add_theme_manufacturer_1560937368");

