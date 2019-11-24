<?php
/**
 * Plugin Name: SM Widgets
 * Description: Manufacturer Elementor Widgets.
 * Plugin URI:  https://themeforest.net/user/stylemixthemes
 * Version:     1.1.7
 * Author:      StylemixThemes 
 * Author URI:  https://themeforest.net/user/stylemixthemes
 * Text Domain: smwidgets
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'ELEMENTOR_SM_WIDGETS__FILE__', __FILE__ );
define( 'ELEMENTOR_SM_WIDGETS__PLUGINURL__', plugins_url( '/', ELEMENTOR_SM_WIDGETS__FILE__ ) );
define('STM_CONFIGURATIONS_PATH', dirname(__FILE__));
define('STM_CONFIGURATIONS_URL', plugin_dir_url(__FILE__));

/*Demo import*/
require_once STM_CONFIGURATIONS_PATH . '/importer/importer.php';

/*Theme helpers*/
require_once STM_CONFIGURATIONS_PATH . '/theme_helpers/main.php';

/**
 * Load Sm Widgets
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */
function sm_widgets_load() {
	// Load localization file
	load_plugin_textdomain( 'smwidgets' );

	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'sm_widgets_fail_load' );
		return;
	}

	// Check required version
	$elementor_version_required = '1.8.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'sm_widgets_fail_load_out_of_date' );
		return;
	}

	// Require the main plugin file
	require( __DIR__ . '/plugin.php' );
}
add_action( 'plugins_loaded', 'sm_widgets_load' );


function sm_widgets_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . __( 'Elementor SM Widgets is not working because you are using an old version of Elementor.', 'smwidgets' ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'smwidgets' ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}







// FRONTEND // After Elementor registers all styles.
add_action( 'elementor/frontend/after_register_styles', 'theme_after_frontend' );

function theme_after_frontend() {
    wp_enqueue_style( 'theme-icons', plugins_url('assets/fonts/icons.css', __FILE__), array(), '1.0');
    wp_enqueue_style( 'theme-widgets-style', plugins_url('assets/widgets_style.css', __FILE__), array(), '1.0.7');
    wp_enqueue_style( 'owl-carousel', plugins_url('assets/css/owl.carousel.min.css', __FILE__), array(), '2.3.4');

    // JS
    wp_enqueue_script( 'skroll-r', plugins_url('assets/js/skroll-r.js', __FILE__), array('jquery'), '0.6.30');
    wp_enqueue_script( 'theme-js', plugins_url('assets/js/scripts.js', __FILE__), array('jquery'), time());
    wp_enqueue_script( 'instafeed', plugins_url('assets/js/instafeed.min.js', __FILE__), array('jquery'), '1.9.3');
    wp_enqueue_script( 'owl-carousel', plugins_url('assets/js/owl.carousel.min.js', __FILE__), array('jquery'), '2.3.4');
    
}

// EDITOR // Before the editor scripts enqueuing.
add_action( 'elementor/editor/before_enqueue_scripts', 'theme_before_editor' );

function theme_before_editor() {
    wp_enqueue_style( 'theme-icons', plugins_url('assets/fonts/icons.css', __FILE__), array(), '1.0');
    wp_enqueue_style( 'theme-widgets-style', plugins_url('assets/widgets_style.css', __FILE__), array(), '1.0');
    wp_enqueue_style( 'theme-admin-style', plugins_url('assets/admin_style.css', __FILE__), array(), '1.0');
    wp_enqueue_style( 'owl-carousel', plugins_url('assets/css/owl.carousel.min.css', __FILE__), array(), '2.3.4');
    
    // JS for the Editor
    wp_enqueue_script( 'skroll-r', plugins_url('assets/js/skroll-r.js', __FILE__), array('jquery'), '0.6.30');
    wp_enqueue_script( 'theme-js', plugins_url('assets/js/scripts.js', __FILE__), array('jquery'), time());
    wp_enqueue_script( 'instafeed', plugins_url('assets/js/instafeed.min.js', __FILE__), array('jquery'), '1.9.3');
    wp_enqueue_script( 'owl-carousel', plugins_url('assets/js/owl.carousel.min.js', __FILE__), array('jquery'), '2.3.4');
}






// Menu

function menu_choices() {
	$menus = wp_get_nav_menus();
	$items = array();
	$i     = 0;
	foreach ( $menus as $menu ) {
		if ( $i == 0 ) {
			$default = $menu->slug;
			$i ++;
		}
		$items[ $menu->slug ] = $menu->name;
	}
	return $items;
}






// Video Widget

add_action( 'elementor/element/video/section_image_overlay/before_section_end', function( $element, $args ) {
	// add a control
	$element->add_control( 'overlay_color', // update the control
		[
			'label' => __( 'Overlay Color', 'smwidgets' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => '',
			'condition' => [
				'show_image_overlay' => 'yes',
			],
		]
	);
	$element->add_control( 'hover_margin', // update the control
		[
			'label' => __( 'Hover Effect', 'smwidgets' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
		]
	);
}, 10, 2);

add_action( 'elementor/frontend/widget/before_render', function( $element ) {
	
	// Make sure we are in a section element
	if( 'video' !== $element->get_name() ) {
		return;
	}
	// get the settings
	$settings = $element->get_settings();

	if ($element->get_settings( 'hover_margin') == 'yes') {
		$element->add_render_attribute( '_wrapper', 'class', 'man_hover_margin_parents' );
	}

	$element->add_render_attribute( '_wrapper', [
              'data-over-color' => $element->get_settings( 'overlay_color' ),
              'data-over' => 'overlay',
          ] );
	$element->add_render_attribute( 'i.eicon-play', 'class', 'eicon-play-o' );

});

// Default Button

add_action( 'elementor/frontend/widget/before_render', function( $element ) {
	
	// Make sure we are in a section element
	if( 'sm-default-button' !== $element->get_name() ) {
		return;
	}
	// get the settings
	$settings = $element->get_settings();

	if ($element->get_settings( 'inline') == 'yes') {
		$element->add_render_attribute( '_wrapper', 'class', 'sm_display_inline' );
	}

});


// Logo

add_action( 'elementor/frontend/widget/before_render', function( $element ) {
	
	if( 'sm-logo' !== $element->get_name() ) {
		return;
	}
	// get the settings
	$settings = $element->get_settings();

	if ($element->get_settings( 'inline') == 'yes') {
		$element->add_render_attribute( '_wrapper', 'class', 'sm_display_inline' );
	}

});


// Search

add_action( 'elementor/frontend/widget/before_render', function( $element ) {
	
	// Make sure we are in a section element
	if( 'sm-search' !== $element->get_name() ) {
		return;
	}
	// get the settings
	$settings = $element->get_settings();

	if ($element->get_settings( 'inline') == 'yes') {
		$element->add_render_attribute( '_wrapper', 'class', 'sm_display_inline' );
	}

});

// Basket

add_action( 'elementor/frontend/widget/before_render', function( $element ) {
	
	// Make sure we are in a section element
	if( 'sm-basket' !== $element->get_name() ) {
		return;
	}
	// get the settings
	$settings = $element->get_settings();

	if ($element->get_settings( 'inline') == 'yes') {
		$element->add_render_attribute( '_wrapper', 'class', 'sm_display_inline' );
	}

});


// Text Editor
add_action( 'elementor/element/text-editor/section_editor/before_section_end', function( $element, $args ) {
	
	// add a control
	$element->add_control(
		'inline',
		[
			'label' => __( 'Display Inline', 'smwidgets' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
		]
	);
	
}, 10, 2);
add_action( 'elementor/frontend/widget/before_render', function( $element ) {
	
	// Make sure we are in a section element
	if( 'text-editor' !== $element->get_name() ) {
		return;
	}
	// get the settings
	$settings = $element->get_settings();

	if ($element->get_settings( 'inline') == 'yes') {
		$element->add_render_attribute( '_wrapper', 'class', 'sm_display_inline' );
	}

});




// Menu

add_action( 'elementor/frontend/widget/before_render', function( $element ) {
	
	// Make sure we are in a section element
	if( 'sm-menu' !== $element->get_name() ) {
		return;
	}
	// get the settings
	$settings = $element->get_settings();

	if ($element->get_settings( 'inline') == 'yes') {
		$element->add_render_attribute( '_wrapper', 'class', 'sm_display_inline' );
	}

});


// Image Gallery

add_action( 'elementor/element/image-gallery/section_gallery/before_section_end', function( $element, $args ) {
	// add a control
	$element->add_control( 'slider', // update the control
		[
			'label' => __( 'Slider', 'smwidgets' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'render_type' => 'template',
		]
	);
}, 10, 2);

add_action( 'elementor/frontend/widget/before_render', function( $element ) {
	
	// Make sure we are in a image-gallery element
	if( 'image-gallery' !== $element->get_name() ) {
		return;
	}
	// get the settings
	$settings = $element->get_settings();

	if ($element->get_settings( 'slider') == 'yes') {
		$element->add_render_attribute( '_wrapper', 'class', 'man_gallery_slider' );
		$element->add_render_attribute( '_wrapper', 'data-items', $element->get_settings( 'gallery_columns') );
	}

});

add_action('elementor/widget/print_template', function($template, $widget) {
  if($widget->get_name() == 'image-gallery'){
   	

		?>
		
   	<script>
			jQuery(document).ready(function($) {
					/* Section Background */
					$('.man_gallery_slider').each(function(){
					var items = $(this).attr('data-items');
					$(this).find('.gallery').addClass('owl-carousel').owlCarousel({
						items:items,
						autoplay:0,
						dots:0,
						nav:0,
						navText:['<i class="ti ti-angle-left"></i>','<i class="ti ti-angle-right"></i>'],
						responsiveRefreshRate:200,
						responsive:{
				        0:{
				            items:2,
				        },
				        650:{
				            items:3,
				        },
				        767:{
				            items:4,
				        },
				        1024:{
				            items:items,
				        },
				    }
					});
				});
			});
		</script>
	<?php  
  }

  return $template;
}, 10, 2);






// Counter Widget

add_action( 'elementor/element/counter/section_counter/before_section_end', function( $element, $args ) {
	// add a control
	$element->add_control( 'icons', // update the control
		[
			'label' => __( 'Icons', 'smwidgets' ),
			'type' => \Elementor\Controls_Manager::ICON,
			'options' => theme_icons(),
			'exclude' => theme_fa_icons(),
			'label_block' => true,

		]
	);
	$element->add_control( 'icons_color', // update the control
		[
			'label' => __( 'Icon Color', 'smwidgets' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .elementor-icon i' => 'color: {{VALUE}};',
			],
		]
	);
	$element->add_control(
			'size',
			[
				'label' => __( 'Icon Size', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
	$element->add_responsive_control(
		'align',
		[
			'label' => __( 'Alignment', 'smwidgets' ),
			'type' => \Elementor\Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => __( 'Left', 'smwidgets' ),
					'icon' => 'fa fa-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'smwidgets' ),
					'icon' => 'fa fa-align-center',
				],
				'right' => [
					'title' => __( 'Right', 'smwidgets' ),
					'icon' => 'fa fa-align-right',
				],
				'justify' => [
					'title' => __( 'Justified', 'smwidgets' ),
					'icon' => 'fa fa-align-justify',
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-counter-flex' => 'justify-content: {{VALUE}};',
			],
		]
	);
}, 10, 2);



add_action( 'elementor/widget/render_content', function( $content, $widget ) {


  if ( 'counter' === $widget->get_name() ) {

		$settings = $widget->get_settings_for_display();


		if ( ! empty( $settings['thousand_separator'] ) ) {
			$delimiter = empty( $settings['thousand_separator_char'] ) ? ',' : $settings['thousand_separator_char'];
			$widget->add_render_attribute( 'counter', 'data-delimiter', $delimiter );
		}


		?>
		<div class="elementor-counter <?php if (!$settings['prefix']) { echo 'man_no_prefix';} ?> <?php if ($settings['icons']) { echo 'elementor-counter-flex';} ?> <?php if (!$settings['suffix']) { echo 'man_no_suffix';} ?>">	
			<?php if ($settings['icons']) {?>
			<div class="elementor-icon"><i class="<?php echo esc_attr($settings['icons']); ?>"></i></div>
			<?php } ?>
			
			<?php if ($settings['icons']) {?>
			<div class="elementor-counter-number-wrapper_flex">
			<?php } ?>
				
				<div class="elementor-counter-number-wrapper">

					<span class="elementor-counter-number-prefix"><?php echo esc_attr($settings['prefix']); ?></span>
					<span class="elementor-counter-number" data-delimiter="," data-duration="<?php echo esc_attr($settings['duration']); ?>"  data-to-value="<?php echo esc_attr($settings['ending_number']); ?>"><?php echo esc_attr($settings['starting_number']); ?></span>
					<span class="elementor-counter-number-suffix"><?php echo esc_attr($settings['suffix']); ?></span>
				</div>
				<?php if ( $settings['title'] ) : ?>
					<div class="elementor-counter-title"><?php echo esc_attr($settings['title']); ?></div>
				<?php endif; ?>
			
			<?php if ($settings['icons']) {?>
			</div>
			<?php } ?>

		</div>
		<?php
		
	} else {  
   return $content;
  }
   
   
}, 10, 2 );

add_action('elementor/widget/print_template', function($template, $widget) {
  if($widget->get_name() == 'counter'){
    ob_start();
    ?>

      <div class="elementor-counter elementor-counter-flex">
				

				<# if ( settings.icons ) {
					#><div class="elementor-icon"><i class="{{{ settings.icons }}}"></i></div><#
				} #>

      	<div class="elementor-counter-number-wrapper_flex">
					<div class="elementor-counter-number-wrapper">
						<span class="elementor-counter-number-prefix">{{{ settings.prefix }}}</span>
						<span class="elementor-counter-number" data-duration="{{ settings.duration }}" data-to-value="{{ settings.ending_number }}" data-delimiter="{{ settings.thousand_separator ? settings.thousand_separator_char || ',' : '' }}">{{{ settings.starting_number }}}</span>
						<span class="elementor-counter-number-suffix">{{{ settings.suffix }}}</span>
					</div>
					<# if ( settings.title ) {
						#><div class="elementor-counter-title">{{{ settings.title }}}</div><#
					} #>
				</div>
			</div>

    <?php

    $template = ob_get_clean();
  }

  return $template;
}, 10, 2);


// Map
add_action( 'elementor/element/eb-google-map-extended/section_map/before_section_end', function( $element, $args ) {


    $element->add_control(
		'map_background',
		[
			'label' => __( 'Map as Section Background', 'smwidgets' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'default' => 'no',
		]
	);
	$element->add_control(
		'map_column_background',
		[
			'label' => __( 'Map as Column Background', 'smwidgets' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
			'default' => 'no',
		]
	);
}, 10, 2);

add_action( 'elementor/frontend/widget/before_render', function( $element ) {
	
	// Make sure we are in a section element
	if( 'eb-google-map-extended' !== $element->get_name() ) {
		return;
	}
	// get the settings
	$settings = $element->get_settings();

	if ($element->get_settings( 'map_background') == 'yes') {
		$element->add_render_attribute( '_wrapper', 'class', 'sm_map_background' );
	}
	if ($element->get_settings( 'map_column_background') == 'yes') {
		$element->add_render_attribute( '_wrapper', 'class', 'sm_map_column_background' );
	}

});




// Heading Widget

add_action( 'elementor/element/heading/section_title/before_section_end', function( $element, $args ) {
	// add a control
	$element->add_control( 'color', // update the control
		[
			'label' => __( 'Title Bold Color', 'smwidgets' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'default' => '',
			'selectors' => [
				'{{WRAPPER}} b' => 'color: {{VALUE}};',
			],
		]
	);

	$element->update_responsive_control(
		'align',
		[
			'label' => __( 'Alignment', 'smwidgets' ),
			'type' => \Elementor\Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => __( 'Left', 'smwidgets' ),
					'icon' => 'fa fa-align-left',
				],
				'center' => [
					'title' => __( 'Center', 'smwidgets' ),
					'icon' => 'fa fa-align-center',
				],
				'right' => [
					'title' => __( 'Right', 'smwidgets' ),
					'icon' => 'fa fa-align-right',
				],
				'justify' => [
					'title' => __( 'Justified', 'smwidgets' ),
					'icon' => 'fa fa-align-justify',
				],
			],
			'render_type' => 'template',
			'default' => '',
			'selectors' => [
				'{{WRAPPER}}' => 'text-align: {{VALUE}};',
			],
		]
	);



	$element->add_control( 'icons', // update the control
		[
			'label' => __( 'Icon', 'smwidgets' ),
			'type' => \Elementor\Controls_Manager::ICON,
			'options' => theme_icons(),
			'exclude' => theme_fa_icons(),
			'label_block' => true,

		]
	);

	$element->add_control( 'icon_size',
		[
			'label' => __( 'Icon Size', 'smwidgets' ),
			'type' => \Elementor\Controls_Manager::SLIDER,
			'range' => [
				'px' => [
					'min' => 6,
					'max' => 300,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .elementor-heading-title i' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		]
	);

	// add a control
	$element->add_control(
		'inline',
		[
			'label' => __( 'Display Inline', 'smwidgets' ),
			'type' => \Elementor\Controls_Manager::SWITCHER,
		]
	);


}, 10, 2);




add_action( 'elementor/widget/render_content', function( $content, $widget ) {


  if ( 'heading' === $widget->get_name() ) {

		$settings = $widget->get_settings_for_display();

		if ( empty( $settings['title'] ) ) {
			return;
		}

		$widget->add_render_attribute( 'title', 'class', 'elementor-heading-title' );

		if ( ! empty( $settings['size'] ) ) {
			$widget->add_render_attribute( 'title', 'class', 'elementor-size-' . $settings['size'] );
		}

		if ( ! empty( $settings['align'] )  ) {
			$widget->add_render_attribute( 'title', 'class', 'elementor-align-after-' . $settings['align'] );
		}
		if ( ! empty( $settings['align_mobile'] )  ) {
			$widget->add_render_attribute( 'title', 'class', 'elementor-align-after-mobile-' . $settings['align_mobile'] );
		}
		if ( ! empty( $settings['align_tablet'] )  ) {
			$widget->add_render_attribute( 'title', 'class', 'elementor-align-after-tablet-' . $settings['align_tablet'] );
		}
		if ($settings['icons']) {
			$title = '<i class="'.$settings['icons'].'"></i><span>'.$settings['title'].'</span>';
		}else{
			$title = $settings['title'];
		}
		

		if ( ! empty( $settings['link']['url'] ) ) {
			$widget->add_render_attribute( 'url', 'href');

			if ( $settings['link']['is_external'] ) {
				$widget->add_render_attribute( 'url', 'target', '_blank' );
			}

			if ( ! empty( $settings['link']['nofollow'] ) ) {
				$widget->add_render_attribute( 'url', 'rel', 'nofollow' );
			}

			$title = sprintf( '<a %1$s>%2$s</a>', $widget->get_render_attribute_string( 'url' ), $title );
		}

		if ($settings['inline'] == 'yes') {
			$widget->add_render_attribute( '_wrapper', 'class', 'sm_display_inline' );
		}

		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $widget->get_render_attribute_string( 'title' ), $title );
		echo wp_kses_post($title_html);
		
	} else {  
   return $content;
  }
   
   
}, 10, 2 );

add_action('elementor/widget/print_template', function($template, $widget) {
  if($widget->get_name() == 'heading'){
    ob_start();
    ?>

      <#
			var title = settings.title;
			var icons = settings.icons;
			if ( '' !== settings.link.url ) {
				title = '<a href="' + settings.link.url + '"><i class="' +icons+ '"></i>' + title + '</a>';
			}
			var icons_html = '';
			if ( '' !== icons ) {
				icons_html = '<i class="' +icons+ '"></i>';
			}


			view.addRenderAttribute( 'title', 'class', [ 'elementor-heading-title', 'elementor-size-' + settings.size ] );
			view.addRenderAttribute( 'title', 'class', [ 'elementor-heading-title', 'elementor-align-after-' + settings.align ] );
			view.addRenderAttribute( 'title', 'class', [ 'elementor-heading-title', 'elementor-align-after-mobile-' + settings.align_mobile ] );
			view.addRenderAttribute( 'title', 'class', [ 'elementor-heading-title', 'elementor-align-after-tablet-' + settings.align_tablet ] );


			view.addInlineEditingAttributes( 'title' , 'advanced' );

			var title_html = '<' + settings.header_size  + ' ' + view.getRenderAttributeString( 'title' ) + '>'+ icons_html +''+ title + '</' + settings.header_size + '>';

			print( title_html );

			#>

    <?php

    $template = ob_get_clean();
  }

  return $template;
}, 10, 2);




// Column
add_action( 'elementor/element/column/layout/before_section_end', function( $element ) {

    $element->add_control(
        'sm_column_hover_text',
        [
            'label' => __( 'Hover Text White', 'smwidgets' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'none',
        ]
    );
 

});

add_action( 'elementor/frontend/column/before_render', function( $element ) {

	// Make sure we are in a section element
	if( 'column' !== $element->get_name() ) {
		return;
	}
	// get the settings
	$settings = $element->get_settings();

	

	if ( $settings['sm_column_hover_text'] == 'yes' ) {
		$element->add_render_attribute( '_wrapper', 'class', 'elementor-block-hover-white' );
	}
    
});


// Section

function add_elementor_section_background_controls( \Elementor\Element_Section $section ) {

    $section->add_control(
        'sm_hor_animation',
        [
            'label' => __( 'Horizontal Animation', 'smwidgets' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'no',
        ]
    );
    $section->add_control(
        'sm_gradient_animation',
        [
            'label' => __( 'Gradient Background Animation', 'smwidgets' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'no',
        ]
    );
    $section->add_control(
        'sm_parallax',
        [
            'label' => __( 'Parallax Effect', 'smwidgets' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'no',
        ]
    );

    $section->add_control(
        'sm_pointer',
        [
            'label' => __( 'Pointer Events', 'smwidgets' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'default' => 'no',
        ]
    );
}

add_action( 'elementor/element/section/section_background/before_section_end', 'add_elementor_section_background_controls' );


add_action( 'elementor/frontend/section/before_render', function( $element ) {

	// Make sure we are in a section element
	if( 'section' !== $element->get_name() ) {
		return;
	}
	// get the settings
	$settings = $element->get_settings();

	if ( ! empty( $settings['text_align'] ) ) {
		$element->add_render_attribute( '_wrapper', 'class', 'elementor-align-' . $settings['text_align'] );
	}

	if ( $settings['sm_pointer'] == 'yes' ) {
		$element->add_render_attribute( '_wrapper', 'class', 'sm_pointer');
	}

	if ( $settings['sm_hor_animation'] == 'yes' ) {
		$element->add_render_attribute( '_wrapper', 'class', 'man_horizontal_animation');
	}

	if ( $settings['sm_gradient_animation'] == 'yes' ) {
		$element->add_render_attribute( '_wrapper', 'class', 'man_gradient_animation');
	}

	if ( $settings['sm_parallax'] == 'yes' ) {
		$element->add_render_attribute( '_wrapper', 'class', 'man_fixed');
		$element->add_render_attribute( '_wrapper', 'data-stellar-background-ratio', '0.2');
	}
    
});



// Preloader
add_action( 'elementor/page_templates/canvas/before_content', function( $element ) {
	global $theme_options;
	if ($theme_options['preloader-sw'] == '1') {
		echo '<div class="preloader"><div class="preloader_content"><div class="spinner"></div></div></div>';
	}
});


// Canvas Page
add_action( 'elementor/page_templates/canvas/before_content', function( $element ) {
	echo '<div class="man_page">';
});
add_action( 'elementor/page_templates/canvas/after_content', function( $element ) {
	echo '</div>';
});

// Basket
add_filter( 'woocommerce_add_to_cart_fragments', 'wc_mini_cart_ajax_refresh' );
function wc_mini_cart_ajax_refresh( $fragments ){
    ## 1. Refreshing mini cart subtotal amount
    $fragments['.man_cart-items-count'] = '<span class="man_cart-items-count count">'.WC()->cart->get_cart_contents_count().'</span>';

    ## 2. Refreshing cart subtotal
    ob_start();
    echo '<div class="man_widget_shopping_cart_content_cart">';
    woocommerce_mini_cart();
    echo '</div>';
    $fragments['.man_widget_shopping_cart_content_cart'] = ob_get_clean();

    return $fragments;
}














