<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "theme_options";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'theme_options/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();
    
    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => false,
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'manufacturer' ),
        'page_title'           => __( 'Theme Options', 'manufacturer' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-admin-tools',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => 2,

        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => 'dashicons-admin-tools',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.


        'show_options_object' => false,

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        'output_location'           => array( 'frontend', 'admin' ),
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );



    


    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */



    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */


    // -> START MainSettings Fields
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Main', 'manufacturer' ),
        'id'               => 'mainsettigns',
        'customizer_width' => '400px',
        'icon'             => 'el el-laptop'
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => __( 'Main', 'manufacturer' ),
        'id'               => 'mainsettigns-body',
        'subsection'       => true,
        'icon'             => 'el el-photo',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'body-background',
                'type'     => 'background',
                'title'    => __( 'Body Background', 'manufacturer' ),
                'subtitle' => __( 'Body background with image, color, etc.', 'manufacturer' ),
                'output'    => array('.man_page, .site-content'),
                'default'  => array(
                    'background-color' => '#f5f5fa',
                )
            ),
            array(
                'id'       => 'sidebar-background',
                'type'     => 'color',
                'title'    => __( 'Sidebar Background', 'manufacturer' ),
                'output' => array(
                    'background-color' => '.man_page .man_sidebar:before, .man_page article.sticky .man_news_item_cont_list, .man_page .page-links a, .man_page table tr',
                ),
                'default'  => '#e7e7f0',
            ),
            array(
                'id'       => 'default_header',
                'type'     => 'switch',
                'title'    => __( 'Default Header/Footer', 'manufacturer' ),
                'default'  => true,
            ),
            
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( '404 ', 'manufacturer' ),
        'id'               => 'mainsettigns-404',
        'subsection'       => true,
        'icon'             => 'el el-photo',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'body-404-background',
                'type'     => 'background',
                'title'    => __( '404 Background', 'manufacturer' ),   
                'output'    => array('.man_404_section'),
                'default'  => '#f4f4f4',
            ),
            array(
                'id'       => 'body-404-text-color',
                'type'     => 'color',
                'title'    => __( '404 Background', 'manufacturer' ),   
                'output' => array(
                    'color' => '.man_404, .man_page .man_404_section, .man_page .man_404_section h2, .man_page .man_404_section p',
                ),
                'default'  => '#fff',
            ),
            
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Header on Inside Pages', 'manufacturer' ),
        'id'               => 'mainsettigns-insideheader',
        'subsection'       => true,
        'icon'             => 'el el-website',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'header-background',
                'type'     => 'background',
                'title'    => __( 'Header Background', 'manufacturer' ),
                'default'  => array(
                    'background-color' => '#fff',
                    'background-image' => get_template_directory_uri().'/images/inside_header.jpg',
                    'background-repeat' => 'no-repeat',
                    'background-position' => 'center bottom',
                    'background-attachment' => 'scroll',
                    'background-size' => 'cover',
                )
            ),
            array(
                'id'       => 'header-over',
                'type'     => 'color_rgba',
                'title'    => __( 'Over Color', 'manufacturer' ),
                'output' => array(
                    'background-color' => '.man_intro .man_over',
                ),
            ),
            array(
                'id'       => 'inside_header_title_color',
                'type'     => 'color_rgba',
                'title'    => __('Title Color', 'manufacturer'), 
                'output' => array(
                    'color' => '.man_page .man_intro_cont, .man_page .man_intro h1',
                ),
                'default'  => '#3a426d',
            ),
            array(
                'id'       => 'inside_header_breadcrumbs_color',
                'type'     => 'color_rgba',
                'title'    => __('Breadcrumbs Color', 'manufacturer'), 
                'output' => array(
                    'color' => '.breadcrumbs, .breadcrumbs a, .breadcrumbs a span',
                ),
                'default'  => '#848ab8',
            ),
            array(
                'id'       => 'header-featured',
                'type'     => 'switch',
                'title'    => __( 'Featured Image', 'manufacturer' ),
                'default'  => false,
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => __( 'Preloader', 'manufacturer' ),
        'id'               => 'mainsettigns-preloader',
        'subsection'       => true,
        'icon'             => 'el el-time',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'preloader-sw',
                'type'     => 'switch',
                'title'    => __( 'Featured Image', 'manufacturer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'preloader-background',
                'type'     => 'color_rgba',
                'title'    => __( 'Preloader Background', 'manufacturer' ),
                'output' => array(
                    'background-color' => '.preloader',
                ),
            ),
            array(
                'id'       => 'preloader-color',
                'type'     => 'color_rgba',
                'title'    => __('Preloader Color', 'manufacturer'), 
                'output' => array(
                    'background-color' => '.spinner',
                ),
            ),
            
        )
    ) );



    Redux::setSection( $opt_name, array(
        'title'            => __( 'Colors', 'manufacturer' ),
        'id'               => 'mainsettigns-elements',
        'subsection'       => true,
        'icon'             => 'el el-brush',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'elements_color',
                'type'     => 'color',
                'title'    => __('Elements Color', 'manufacturer'),
                'transparent'  => false, 
                'output' => array(
                    'color' => '.man_news_item_title h3 a:hover, .input[type="text"] a:hover, .elementor-widget ul.menu li a:hover, .elementor-widget ul.menu a:before, .man_single_page_footer span a, .man_single_page_footer span:before, .sm_nav_menu > li ul a:hover, .sm_nav_menu > li ul a:hover:before, .man_single_page_footer span, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce-LoopProduct-link:hover h3, .widget ul a:hover, .elementor-widget ul.menu a:before, .widget ul:not(.product_list_widget) a:hover:before, .btn_inline_style, .man_number_block_title span, .man_vertical_products h5,  .woocommerce ul.man_vertical_products_default li.product .man_product_cont h3, .man_demos:hover .man_demos_title, .woocommerce-message:before, .woocommerce-info:before, .man_news_item_date a:hover, .man_map_pin_cont b, .woocommerce-LoopProduct-link:hover, .breadcrumbs a:hover, .man_page h3 a, .man_navigation .current, .eicon-play:before',
                    'background-color' => '.man_navigation span:after, .elementor-widget ul.menu a:after, .man_single_page_footer span:after, .sm_nav_menu > .current-menu-item > a:before, .sm_nav_menu > .current-menu-parent > a:before, .sm_nav_menu > .current_page_parent > a:before, .sm_nav_menu > li ul a:hover:after, .woocommerce div.product .woocommerce-tabs ul.tabs li.active:after, .widget ul:not(.product_list_widget) a:after, .widget ul:not(.product_list_widget) a:after, .widget ul.woocommerce-widget-layered-nav-list li:hover span, .widget_categories ul li:hover span, .widget ul li.chosen span, .cat-item:hover span.count, body:after, .btn_inline_style:before, .btn_inline_style:after, .woocommerce-mini-cart__buttons .button:before, .man_timeline_point, .man_map_point_border, .man_map_point_second_border, .man_map_pin span.man_map_point, .man_map_pin span.man_map_point_second_border, .man_bordered_block a:hover, .sm_nav_menu > li > a:before, .man_timeline_pin_cont, .page-links a:hover, .man_page table thead tr, .sm_video_link span i:after, .sm_video_link span b:after',
                    'border-color' => '.owl-dot.active span, .man_search_block_bg .search-form .search-form-text',
                    'border-top-color' => '.woocommerce-message, .woocommerce-info',
                    'fill'   => '.man_timeline_pin_cont_corner svg, .man_map_pin:hover svg path, .man_map.active .man_map_pins .man_map_pin_wrapper:first-child .man_map_pin svg path',
                ),
                'default'  => '#566dfb',

            ),
            
        )
    ) );

    // -> START TypographySettings Fields
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Typography', 'manufacturer' ),
        'id'               => 'typosettings',
        'customizer_width' => '400px',
        'icon'             => 'el el-font'
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Titles H1-H6', 'manufacturer' ),
        'id'               => 'typosettings-titles',
        'subsection'       => true,
        'customizer_width' => '450px',
        'icon'             => 'el el-fontsize',
        'fields'           => array(
            array(
                'id'       => 'typosettings-h1-typo',
                'type'     => 'typography',
                'title'    => __( 'H1 Font', 'manufacturer' ),
                'google'   => true,
                'output'    => array('.man_page h1, .man_page h1 a'),
                'text-align' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'default'  => array(
                    'color'       => '#3a426d',
                    'font-size'   => '56px',
                    'line-height'   => '70px',
                    'font-family' => 'Roboto',
                    'font-weight' => '700',
                ),
            ),
            array(
                'id'       => 'typosettings-h2-typo',
                'type'     => 'typography',
                'title'    => __( 'H2 Font', 'manufacturer' ),
                'google'   => true,
                'output'    => array('.man_page h2, .man_page h2 a, .elementor-widget-heading.elementor-widget-heading h2.elementor-heading-title, .man_timeline_pin_cont, .man_page blockquote, address, .man_timeline_pin_title, .editor-post-title__block .editor-post-title__input, h2.editor-rich-text__editable'),
                'text-align' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'default'  => array(
                    'color'       => '#3a426d',
                    'font-size'   => '36px',
                    'line-height'   => '46px',
                    'font-family' => 'Roboto',
                    'font-weight' => '700',
                ),
            ),
            array(
                'id'       => 'typosettings-h3-typo',
                'type'     => 'typography',
                'title'    => __( 'H3 Font', 'manufacturer' ),
                'google'   => true,
                'output'    => array('.man_page h3, .elementor-widget-heading.elementor-widget-heading h3.elementor-heading-title, .woocommerce div.product p.price, .woocommerce div.product span.price, .comment-reply-title, .woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce ul.products li.product h3, .wp-block-heading h3'),
                'text-align' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'default'  => array(
                    'color'       => '#3a426d',
                    'font-size'   => '28px',
                    'line-height'   => '36px',
                    'font-family' => 'Roboto',
                    'font-weight' => '700',
                ),
            ),
            array(
                'id'       => 'typosettings-h4-typo',
                'type'     => 'typography',
                'title'    => __( 'H4 Font', 'manufacturer' ),
                'google'   => true,
                'output'    => array('.man_page h4, .man_page h4 a, .elementor-widget-heading.elementor-widget-heading h4.elementor-heading-title, h3.widget-title, .wp-block-heading h4'),
                'text-align' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'default'  => array(
                    'color'       => '#3a426d',
                    'font-size'   => '18px',
                    'line-height'   => '30px',
                    'font-family' => 'Roboto',
                    'font-weight' => '700',
                ),
            ),
            array(
                'id'       => 'typosettings-h5-typo',
                'type'     => 'typography',
                'title'    => __( 'H5 Font', 'manufacturer' ),
                'google'   => true,
                'output'    => array('.man_page h5, .man_page h5 a, .elementor-widget-heading.elementor-widget-heading h5.elementor-heading-title'),
                'text-align' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'default'  => array(
                    'color'       => '#3a426d',
                    'font-size'   => '17px',
                    'line-height'   => '25px',
                    'font-family' => 'Roboto',
                    'font-weight' => '700',
                ),
            ),
            array(
                'id'       => 'typosettings-h6-typo',
                'type'     => 'typography',
                'title'    => __( 'H6 Font', 'manufacturer' ),
                'google'   => true,
                'output'    => array('.man_page h6, .man_page h6 a, .elementor-widget-heading.elementor-widget-heading h6.elementor-heading-title'),
                'text-align' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'default'  => array(
                    'color'       => '#3a426d',
                    'font-size'   => '14px',
                    'line-height'   => '24px',
                    'font-family' => 'Roboto',
                    'font-weight' => '700',
                ),
            ),
            
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'After Title Icon', 'manufacturer' ),
        'id'               => 'typosettings-icon',
        'subsection'       => true,
        'icon'             => 'el el-star',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'typosettings-h2-icon-on',
                'type'     => 'switch',
                'title'    => __( 'H2 Title:after Icon On', 'manufacturer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'typosettings-h2-icon',
                'type'     => 'background',
                'required' => array( 'typosettings-h2-icon-on', '=', '1' ),
                'background-color' => false,
                'background-repeat' => false,
                'background-size' => false,
                'background-attachment' => false,
                'background-position' => false,
                'preview' => false,
                'title'    => __( 'H2 Title:after Icon', 'manufacturer' ),
                'output'    => array(
                    'background-image'   => 'h2:after',
                    'width'   => 'h2:after',
                ),
               
            ),
            array(
                'id'             => 'typosettings-h2-icon-dimension',
                'type'           => 'dimensions',
                'required' => array( 'typosettings-h2-icon-on', '=', '1' ),
                'title'          => __( 'H2 Title:after Icon Dimensions (Width/Height)', 'manufacturer' ),
                'default'        => array(
                    'width'  => 44,
                    'height' => 21,
                ),
                'output'    => array('h2:after'),
            ),
            array(
                'id'       => 'typosettings-h2-icon-spacing',
                'type'     => 'spacing',
                'output'   => array( 'h2:after' ),
                'mode'     => 'margin',
                'right'         => false,   
                'left'         => false,
                'top'         => true,
                'bottom'         => false,
                'units'         => 'px',
                'units_extended'=> 'true',
                'display_units' => 'true',
                'title'    => __( 'Icon Top Margin', 'manufacturer' ),
                'default'  => array(
                    'margin-top'    => '20px',
                )
            ),
            
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Spacing', 'manufacturer' ),
        'id'               => 'typosettings-spacing',
        'subsection'       => true,
        'icon'             => 'el el-text-height',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'h2-spacing',
                'type'     => 'spacing',
                'output'   => array( 'h2, .elementor-widget-heading h2.elementor-heading-title' ),
                'mode'     => 'margin',
                'right'         => false,   
                'left'         => false,
                'top'         => true,
                'bottom'         => true,
                'units'         => 'px',
                'units_extended'=> 'true',
                'display_units' => 'true',
                'title'    => __( 'H2 Margin Option', 'manufacturer' ),
                'default'  => array(
                    'margin-top'    => '0px',
                    'margin-bottom' => '15px',
                    'units' => 'px'
                )
            ),
            
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Body Typography', 'manufacturer' ),
        'id'               => 'typosettings-body',
        'subsection'       => true,
        'icon'             => 'el el-edit',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'typosettings-body-typo',
                'type'     => 'typography',
                'title'    => __( 'Body Font', 'manufacturer' ),
                'subtitle' => __( 'Specify the body font properties.', 'manufacturer' ),
                'google'   => true,
                'output'    => array('body .man_page, .elementor-widget-text-editor, .man_page input, textarea, .woocommerce-ordering .man_page select, .man_cart_block a, .man_news_item_date a, .man_news_item_date, .widget ul:not(.product_list_widget) a:before, .woocommerce-product-details__short-description p, .editor-default-block-appender textarea.editor-default-block-appender__content, .editor-styles-wrapper p, ul.editor-rich-text__editable, footer'),
                'text-align' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'default'  => array(
                    'color'       => '#848bb6',
                    'font-size'   => '18px',
                    'line-height'   => '28px',
                    'font-family' => 'Hind',
                    'font-weight' => '400',
                ),
            ),
            
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Default Buttons', 'manufacturer' ),
        'id'               => 'typosettings-button',
        'subsection'       => true,
        'icon'             => 'el el-website',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'button_default_color',
                'type'     => 'background',
                'output'   => array( '.btn, div.wpforms-container-full .wpforms-form input[type=submit], div.wpforms-container-full .wpforms-form button[type=submit], .man_page button, .man_page [type="button"], [type="reset"], .man_page [type="submit"], .woocommerce div.product form.cart .button, body div.wpforms-container-full .wpforms-form button[type=submit], .woocommerce #review_form #respond .form-submit input, .woocommerce ul.products li.product .button, .woocommerce #respond input#submit, .man_page .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce_checkout_place_order, .woocommerce button.button.alt, .products .man_product_photo .added_to_cart, .added_to_cart, .woocommerce a.added_to_cart, .man_product_cont_desc a.button, .add_to_cart_button, .product_type_simple, .wp-block-button__link, .added_to_cart' ),
                'title'    => __( 'Button Background Color', 'manufacturer' ),
                'default'  => array(
                    'background-color' => '#5872f7',
                ),
                'background-image' => false,
                'background-repeat' => false,
                'background-size' => false,
                'background-attachment' => false,
                'background-position' => false,
                'transparent' => false,
                'preview' => false,
            ),
            array(
                'id'       => 'button_default_color_hover',
                'type'     => 'background',
                'output'   => array( '.btn:hover, div.wpforms-container-full .wpforms-form input[type=submit]:hover, div.wpforms-container-full .wpforms-form button[type=submit]:hover, .man_page button:hover, .man_button [type="button"]:hover, [type="reset"]:hover, .man_page [type="submit"]:hover, .woocommerce div.product form.cart .button:hover, body div.wpforms-container-full .wpforms-form button[type=submit]:hover, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce ul.products li.product .button:hover, .woocommerce #respond input#submit:hover, .man_page .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-cart .wc-proceed-to-checkout a.checkout-.man_page button:hover, .woocommerce_checkout_place_order:hover, .woocommerce button.button.alt:hover, .products .man_product_photo .added_to_cart:hover, .added_to_cart:hover, .woocommerce a.added_to_cart:hover, .man_product_cont_desc .button:hover, .add_to_cart_.man_page button:hover, .product_type_simple:hover, .wp-block-button__link:hover, .added_to_cart:hover, .products-default .man_product_cont_desc a:hover' ),
                'title'    => __( 'Button Background Color Hover', 'manufacturer' ),
                'default'  => array(  
                    'background-color' => '#3f5ae4',
                ),
                'background-image' => false,
                'background-repeat' => false,
                'background-size' => false,
                'background-attachment' => false,
                'background-position' => false,
                'transparent' => false,
                'preview' => false,
            ),
            array(
                'id'       => 'button-typo',
                'type'     => 'typography',
                'title'    => __( 'Button Font', 'manufacturer' ),
                'google'   => true,
                'default'  => array(
                    'color'       => '#fff',
                    'font-size'   => '18px',
                    'line-height'   => '28px',
                    'font-family' => 'Hind',
                    'font-weight' => 'Normal',
                ),
                'output'    => array('.btn, .btn:hover, div.wpforms-container-full .wpforms-form input[type=submit], div.wpforms-container-full .wpforms-form button[type=submit], div.wpforms-container-full .wpforms-form input[type=submit]:hover, div.wpforms-container-full .wpforms-form button[type=submit]:hover, .man_page button, .man_page [type="button"], .man_page [type="reset"], .man_page [type="submit"], .woocommerce div.product form.cart .button, .woocommerce div.product form.cart .button:hover, body div.wpforms-container-full .wpforms-form button[type=submit], body div.wpforms-container-full .wpforms-form button[type=submit]:hover, .woocommerce #review_form #respond .form-submit input, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce ul.products li.product .button, .woocommerce ul.products li.product .button:hover, .woocommerce #respond input#submit, .man_page .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit:hover, .man_page .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .cart button, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce_checkout_place_order, .woocommerce button.button.alt, .products .man_product_photo .added_to_cart, .man_page input[type="text"], .man_page input[type="email"], .man_page input[type="url"], .man_page input[type="password"], .man_page input[type="search"], .man_page input[type="number"], .man_page input[type="tel"], .man_page input[type="range"], .man_page input[type="date"], .man_page input[type="month"], .man_page input[type="week"], .man_page input[type="time"], .man_page input[type="datetime"], .man_page input[type="datetime-local"], .man_page input[type="color"], .man_page textarea, .man_page select, .input-text, .added_to_cart, .woocommerce a.added_to_cart, .man_product_cont_desc .button, .add_to_cart_button, .add_to_cart_button:hover, .product_type_simple:hover, .product_type_simple, .wp-block-button__link, .added_to_cart, .added_to_cart:hover, .man_product_cont .button'),
                'text-align' => false,
            ),
            array(
                'id'       => 'button-round',
                'type'     => 'switch',
                'title'    => __( 'Round Button', 'manufacturer' ),
                'default'  => true,
            ),
            array(
                'id'       => 'button-square',
                'type'     => 'switch',
                'title'    => __( 'Square Button', 'manufacturer' ),
                'default'  => false,
                'required' => array( 'button-round', '=', '0' ),
            ),
            array(
                'id'       => 'button-padding',
                'type'     => 'spacing',
                'output'   => array( '.btn, div.wpforms-container-full .wpforms-form input[type=submit], div.wpforms-container-full .wpforms-form button[type=submit], .man_page button, .man_page [type="button"], [type="reset"], .man_page [type="submit"], .woocommerce div.product form.cart .button, body div.wpforms-container-full .wpforms-form button[type=submit], .woocommerce #review_form #respond .form-submit input, .woocommerce ul.products li.product .button, .woocommerce #respond input#submit, .man_page .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .cart .cart_item button, .woocommerce button.button:disabled, .woocommerce button.button:disabled[disabled], .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce_checkout_place_order, .woocommerce button.button.alt, .products .man_product_photo .added_to_cart, .man_page input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], .man_page input[type="number"], input[type="tel"], input[type="range"], input[type="date"], input[type="month"], input[type="week"], input[type="time"], input[type="datetime"], input[type="datetime-local"], input[type="color"], textarea, .man_page select, .input-text, .added_to_cart, .woocommerce a.added_to_cart, .woocommerce #respond input#submit.loading, .man_page .woocommerce a.button.loading, .woocommerce button.button.loading, .woocommerce input.button.loading, .woocommerce-cart table.cart td.actions .coupon .input-text, .man_product_cont_desc .button, .add_to_cart_button, .product_type_simple, .wp-block-button__link, .added_to_cart, .woocommerce a.added_to_cart,
                    .woocommerce-cart table.cart td.actions .coupon .input-text' ),
                'mode'     => 'padding',
                'units'         => 'px',
                'units_extended'=> 'true',
                'display_units' => 'true',
                'title'    => __( 'Button Padding', 'manufacturer' ),
                'default'            => array(
                    'padding-top'     => '12px', 
                    'padding-right'   => '20px', 
                    'padding-bottom'  => '12px', 
                    'padding-left'    => '20px',
                    'units'          => 'px', 
                )
            ),
            array(
                'id'       => 'button-shadow',
                'type'     => 'switch',
                'title'    => __( 'Shadow', 'manufacturer' ),
                'default'  => false,
            ),

            
        )
    ) );

    // -> START BlogSettings Fields
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Blog', 'manufacturer' ),
        'id'               => 'blogsettings',
        'customizer_width' => '400px',
        'icon'             => 'el el-folder-open'
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Archive', 'manufacturer' ),
        'id'               => 'blogsettings-archive',
        'subsection'       => true,
        'customizer_width' => '450px',
        'icon'             => 'el el-folder',
        'fields'           => array(
            array(
                'id'       => 'blogsettings-fullwidth',
                'type'     => 'switch',
                'title'    => __( 'Sidebar', 'manufacturer' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blogsettings-category_type',
                'type'     => 'image_select',
                'title'    => __('Main Layout', 'manufacturer'), 
                'options'  => array(
                    '1'      => array(
                        'alt'   => 'List Style', 
                        'img'   => get_template_directory_uri().'/images/admin/bl_t1.jpg'
                    ),
                    '2'      => array(
                        'alt'   => 'Grid Style', 
                        'img'   => get_template_directory_uri().'/images/admin/bl_t2.jpg'
                    ),
                ),
                'default' => '1'
            ),
            array(
                'id'       => 'blogsettings_columns',
                'type'     => 'select',
                'title'    => __('Grid Columns', 'manufacturer'), 
                'default'   => array(
                    'color'     => '#001443',
                    'alpha'     => 0.76
                ),
                'options'  => array(
                    '6' => '2 Columns',
                    '4' => '3 Columns',
                    '3' => '4 Columns'
                ),
                'default'  => '4',
                'required' => array('blogsettings-category_type','equals','2')
            ),

            array(
                'id'       => 'blogsettings_block_height',
                'type'     => 'dimensions',
                'title'    => __('Block Height', 'manufacturer'), 
                'units'    => array('px'),
                'default'  => array(
                    'height'  => '250'
                ),
                'width'     => false,
                'output' => array(
                    'height' => '.man_news_item_img',
                ),
            ),
            array( 
                'id'       => 'blogsettings_over_border',
                'type'     => 'border',
                'title'    => __('Over Border Option', 'manufacturer'),
                'output'   => array('.man_news_item:hover .man_news_item_over'),
                'all'     => false,
                'default'  => array(
                    'border-color'  => '#667bfb', 
                    'border-style'  => 'solid', 
                    'border-top'    => '2px', 
                    'border-right'  => '0px', 
                    'border-bottom' => '0px', 
                    'border-left'   => '0px'
                )
            ),

            array(
                'id'       => 'squared_block',
                'type'     => 'switch',
                'title'    => __( 'Squared Block', 'manufacturer' ),
                'default'  => false,
            ),
            
            
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Single Post', 'manufacturer' ),
        'id'               => 'blogsettings-post',
        'subsection'       => true,
        'icon'             => 'el el-file',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'singlesettings_over_color',
                'type'     => 'color_rgba',
                'title'    => __('Navigation Over Color', 'manufacturer'), 
                'default'   => array(
                    'color'     => '#001443',
                    'alpha'     => 0.4
                ),
                'output' => array(
                    'background-color' => '.man_nav_over',
                ),
            ),
            array(
                'id'       => 'singlesettings_over_color_hover',
                'type'     => 'color_rgba',
                'title'    => __('Navigation Over Hover Color', 'manufacturer'), 
                'default'   => array(
                    'color'     => '#001443',
                    'alpha'     => 0.76
                ),
                'output' => array(
                    'background-color' => '.nav-box:hover .man_nav_over',
                ),
            ),
            
            
        )
    ) );


    // -> START ShopSettings Fields
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Shop', 'manufacturer' ),
        'id'               => 'shopsettings',
        'customizer_width' => '400px',
        'icon'             => 'el el-shopping-cart'
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Shop', 'manufacturer' ),
        'id'               => 'shopsettings-category',
        'subsection'       => true,
        'icon'             => 'el el-th',
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'shopsettings-fullwidth',
                'type'     => 'switch',
                'title'    => __( 'Sidebar', 'manufacturer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'shopsettings-fullwidth-onsinglepage',
                'type'     => 'switch',
                'title'    => __( 'Sidebar on Product Page', 'manufacturer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'shopsettings-category_type',
                'type'     => 'image_select',
                'title'    => __('Main Layout', 'manufacturer'), 
                'options'  => array(
                    '1'      => array(
                        'alt'   => 'Grid', 
                        'img'   => get_template_directory_uri().'/images/admin/type1.jpg'
                    ),
                    '2'      => array(
                        'alt'   => 'Default', 
                        'img'   => get_template_directory_uri().'/images/admin/type2.jpg'
                    ),
                    '3'      => array(
                        'alt'   => 'Vertical', 
                        'img'   => get_template_directory_uri().'/images/admin/type3.jpg'
                    ),
                ),
                'default' => '2'
            ),
            array(
                'id'       => 'shopsettings_square',
                'type'     => 'switch',
                'title'    => __( 'Sqaured Blocks', 'manufacturer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'shopsettings_over_color',
                'type'     => 'color_rgba',
                'title'    => __('Over Color', 'manufacturer'), 
                'default'   => array(
                    'color'     => '#001443',
                    'alpha'     => 0.4
                ),
                'output' => array(
                    'background-color' => '.man_woo_cat_item_over, .products .man_product_photo a.woocommerce-LoopProduct-link:after, .products_grid_type .man_product_photo:after',
                ),
            ),
            array(
                'id'       => 'shopsettings_over_color_hover',
                'type'     => 'color_rgba',
                'title'    => __('Over Hover Color', 'manufacturer'), 
                'default'   => array(
                    'color'     => '#001443',
                    'alpha'     => 0.76
                ),
                'output' => array(
                    'background-color' => '.man_woo_cat_item:hover .man_woo_cat_item_over',
                ),
            ),
            array( 
                'id'       => 'shopsettings_over_border',
                'type'     => 'border',
                'title'    => __('Over Border Option', 'manufacturer'),
                'output'   => array('.man_woo_cat_item:hover .man_woo_cat_item_over'),
                'all'     => false,
                'default'  => array(
                    'border-color'  => '#667bfb', 
                    'border-style'  => 'solid', 
                    'border-top'    => '2px', 
                    'border-right'  => '0px', 
                    'border-bottom' => '0px', 
                    'border-left'   => '0px'
                )
            ),
            array(
                'id'       => 'shopsettings_text_color',
                'type'     => 'color_rgba',
                'title'    => __('Text Color', 'manufacturer'), 
                'default'   => array(
                    'color'     => '#fff',
                ),
                'output' => array(
                    'color' => '.man_woo_cat_item_cont .man_woo_cat_item_cont_name',
                ),
            ),
            array(
                'id'       => 'shopsettings_text_color_hover',
                'type'     => 'color_rgba',
                'title'    => __('Text Hover Color', 'manufacturer'), 
                'output' => array(
                    'color' => '.man_woo_cat_item:hover .man_woo_cat_item_cont_name, .man_woo_cat_item:hover .man_woo_cat_item_cont p, .man_service_block_II .man_woo_cat_item_cont_an div',
                ),
            ),
            array(
                'id'       => 'shopsettings_centered',
                'type'     => 'switch',
                'title'    => __( 'Centered', 'manufacturer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'shopsettings-navigation',
                'type'     => 'switch',
                'title'    => __( 'Single Product Navigation', 'manufacturer' ),
                'default'  => true,
            ),
            array(
                'id'       => 'shopsettings-related-columns',
                'type'     => 'text',
                'title'    => __( 'Related Products Columns', 'manufacturer' ),
                'default'  => 3,
            ),
            array(
                'id'       => 'shopsettings-columns',
                'type'     => 'text',
                'title'    => __( 'Products Columns', 'manufacturer' ),
                'default'  => 3,
            ),
            array(
                'id'       => 'shopsettings_items_per_page',
                'type'     => 'text',
                'title'    => __( 'Products Per Page', 'manufacturer' ),
                'default'  => 9,
            ),
            array(
                'id'       => 'shopsettings_attributes',
                'type'     => 'switch',
                'title'    => __( 'Attributes in Description Tab', 'manufacturer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'shopsettings-send',
                'type'     => 'switch',
                'title'    => __( 'Send Enquiry Button', 'manufacturer' ),
                'default'  => false,
            ),
            array(
                'id'       => 'shopsettings-send-link',
                'type'     => 'text',
                'title'    => __( 'Send Enquiry Button Link', 'manufacturer' ),
                'default'  => '#tab-title-enquiry',
                'required' => array( 'shopsettings-send', '=', '1' ),
            ),

            array(
                'id'       => 'shopsettings_block_height',
                'type'     => 'dimensions',
                'title'    => __('Block Height', 'manufacturer'), 
                'units'    => array('px'),
                'default'  => array(
                    'height'  => '250'
                ),
                'width'     => false,
                'output' => array(
                    'height' => '.elementor-widget-sm-woo-categories .man_woo_cat_item, .man_service_block_II a',
                ),
            ),
            array(
                'id'       => 'shopsettings_hover',
                'type'     => 'switch',
                'title'    => __( 'Hover Effect', 'manufacturer' ),
                'default'  => true,
            ),
            

        )
    ) );

    



    
    


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */


    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'manufacturer' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'manufacturer' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }


