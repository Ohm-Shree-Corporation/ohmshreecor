<?php


/*
Register Fonts
*/

if ( !class_exists( 'ReduxFramework' ) ) {
function manufacturer_studio_fonts_url() {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'manufacturer' ) ) {
    		$font_url = add_query_arg( 'family', urlencode( 'Roboto:400,400i,700,700i,800' ), "//fonts.googleapis.com/css" );
        
    }
    return $font_url;
}

/*
Enqueue scripts and styles.
*/
function manufacturer_studio_scripts() {
    wp_enqueue_style( 'manufacturer-studio-fonts', manufacturer_studio_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'manufacturer_studio_scripts' );
}


/*
 * Editor Style
 */
add_editor_style(array( 'css/editor-style.css' ));

/**
 * Load CSS
 */
function manufacturer_theme_styles()  {  
	
  wp_enqueue_style( 'manufacturer-main-styles', get_template_directory_uri() . '/css/manufacturer_style.css', array(), time());
  wp_enqueue_style( 'manufacturer-responsive-styles', get_template_directory_uri() . '/css/responsive.css', array(), time());
  wp_enqueue_style( 'themify-icons', get_template_directory_uri() . '/fonts/themify-icons.css', array());
}
add_action( 'wp_enqueue_scripts', 'manufacturer_theme_styles' );


/**
 * init admin scripts and style
 */
function manufacturer_style_scripts_admin() {

	wp_enqueue_style( 'manufacturer-admins', get_template_directory_uri() . '/css/manufacturer_admins.css' );
  wp_enqueue_style( 'themify-icons', get_template_directory_uri() . '/fonts/themify-icons.css', array());
  wp_enqueue_style( 'dashicons-css', get_template_directory_uri() . '/fonts/themify-icons.css', array());
}

add_action( 'admin_enqueue_scripts', 'manufacturer_style_scripts_admin' );

// Dashicons

function manufacturer_dashicons() {
    wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'manufacturer_dashicons' );
/**
 * Enqueue scripts and styles.
 */
function manufacturer_scripts() {
	wp_enqueue_style( 'manufacturer-style', get_stylesheet_uri() );

	wp_enqueue_script( 'manufacturer-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
  wp_enqueue_script( 'skroll-r', get_template_directory_uri() . '/js/skroll-r.js', array('jquery'), '0.6.30');
	wp_enqueue_script( 'manufacturer-main-scripts', get_template_directory_uri() . '/js/manufacturer_script.js', array('jquery'), time(), true );
	wp_enqueue_script( 'manufacturer-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'manufacturer_scripts' );



//Demos 
function manufacturer_import_files() {
  return array(
    array(
      'import_file_name'             => 'Textile',
      
      'local_import_redux'           => array(
        array(
          'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/textile.json',
          'option_name' => 'theme_options',
        ),
      ),
      'import_preview_image_url'     => 'http://manufacturer.stylemixthemes.com/demos/demo1.jpg',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'manufacturer' ),
      'preview_url'                  => 'http://manufacturer.stylemixthemes.com/textile',
    ),
    array(
      'import_file_name'             => 'Industrial',
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demos/industrial.xml',
      'local_import_redux'           => array(
        array(
          'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/industrial.json',
          'option_name' => 'theme_options',
        ),
      ),
      'import_preview_image_url'     => 'http://manufacturer.stylemixthemes.com/demos/demo2.jpg',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'manufacturer' ),
      'preview_url'                  => 'http://manufacturer.stylemixthemes.com/textile',
    ),
    array(
      'import_file_name'             => 'Snacks',
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demos/snacks.xml',
      'local_import_redux'           => array(
        array(
          'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demos/snacks.json',
          'option_name' => 'theme_options',
        ),
      ),
      'import_preview_image_url'     => 'http://manufacturer.stylemixthemes.com/demos/demo3.jpg',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'manufacturer' ),
      'preview_url'                  => 'http://manufacturer.stylemixthemes.com/textile',
    ),

  );
}
add_filter( 'pt-ocdi/import_files', 'manufacturer_import_files' );

function manufacturer_after_import_setup() {
  // Assign menus to their locations.
  $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

  set_theme_mod( 'nav_menu_locations', array(
      'main-menu'   => $main_menu->term_id,
    )
  );

  // Assign front page and blog page.
  $front_page_id = get_page_by_title( 'Home' );

  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  global $wp_rewrite;
  $wp_rewrite->set_permalink_structure('/%postname%/');

}
add_action( 'pt-ocdi/after_import', 'manufacturer_after_import_setup' );
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );