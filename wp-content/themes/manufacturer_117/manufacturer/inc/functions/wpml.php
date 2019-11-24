<?php  


/*Repeater Widgets Options*/
require_once( get_template_directory() . '/inc/functions/wpml/class-wpml-elementor-sm-widgets-default-button.php');
require_once( get_template_directory() . '/inc/functions/wpml/class-wpml-elementor-sm-widgets-offices.php');
require_once( get_template_directory() . '/inc/functions/wpml/class-wpml-elementor-sm-widgets-timeline.php');
require_once( get_template_directory() . '/inc/functions/wpml/class-wpml-elementor-sm-widgets-testimonials.php');
require_once( get_template_directory() . '/inc/functions/wpml/class-wpml-elementor-sm-widgets-slider.php');
require_once( get_template_directory() . '/inc/functions/wpml/class-wpml-elementor-sm-widgets-advantages.php');

function add_translate_widget( $widgets ) {
  $widgets[ 'sm-service-block' ] = [
     'conditions' => [ 'widgetType' => 'sm-service-block' ],
     'fields'     => [
        [
           'field'       => 'title',
           'type'        => __( 'Service Title', 'manufacturer' ),
           'editor_type' => 'LINE'
        ],
        [
           'field'       => 'content',
           'type'        => __( 'Service Content', 'manufacturer' ),
           'editor_type' => 'VISUAL'
        ],
     ],
  ];
  $widgets[ 'sm-instagram' ] = [
     'conditions' => [ 'widgetType' => 'sm-instagram' ],
     'fields'     => [
        [
           'field'       => 'comments',
           'type'        => __( 'Instagram Comments Text', 'manufacturer' ),
           'editor_type' => 'LINE'
        ],
     ],
  ];
  $widgets[ 'sm-logo' ] = [
     'conditions' => [ 'widgetType' => 'sm-logo' ],
     'fields'     => [
        [
           'field'       => 'text',
           'type'        => __( 'Logo Text', 'manufacturer' ),
           'editor_type' => 'LINE'
        ],
        [
           'field'       => 'link',
           'type'        => __( 'Logo: Link URL', 'manufacturer' ),
           'editor_type' => 'LINK'
        ],
     ],
  ];
  $widgets[ 'sm-menu' ] = [
     'conditions' => [ 'widgetType' => 'sm-menu' ],
     'fields'     => [
        [
           'field'       => 'sm_nav_menu',
           'type'        => __( 'Select Menu', 'manufacturer' ),
           'editor_type' => 'LINE'
        ],
        [
           'field'       => 'sm_link_padding',
           'type'        => __( 'Padding', 'manufacturer' ),
           'editor_type' => 'LINE'
        ],
        [
           'field'       => 'menu_link_color',
           'type'        => __( 'color', 'manufacturer' ),
           'editor_type' => 'LINE'
        ],
     ],
  ];
  $widgets[ 'sm-number-block' ] = [
     'conditions' => [ 'widgetType' => 'sm-number-block' ],
     'fields'     => [
        [
           'field'       => 'title',
           'type'        => __( 'Number Block Title', 'manufacturer' ),
           'editor_type' => 'LINE'
        ],
        [
           'field'       => 'number',
           'type'        => __( 'Number Block Number', 'manufacturer' ),
           'editor_type' => 'LINE'
        ],
        [
           'field'       => 'text',
           'type'        => __( 'Number Block Text', 'manufacturer' ),
           'editor_type' => 'AREAA'
        ],
     ],
  ];
  $widgets[ 'sm-service-block-II' ] = [
     'conditions' => [ 'widgetType' => 'sm-service-block-II' ],
     'fields'     => [
        [
           'field'       => 'title',
           'type'        => __( 'Service Block II Title', 'manufacturer' ),
           'editor_type' => 'LINE'
        ],
        [
           'field'       => 'content',
           'type'        => __( 'Service Block II Content', 'manufacturer' ),
           'editor_type' => 'LINE'
        ],
        [
           'field'       => 'link',
           'type'        => __( 'Service Block II: Link URL', 'manufacturer' ),
           'editor_type' => 'LINE'
        ],
     ],
  ];
  $widgets[ 'sm-default-button' ] = [
     'conditions' => [ 'widgetType' => 'sm-default-button' ],
     'integration-class' => 'WPML_Elementor_SM_Widgets_Default_Buttons',
  ];

  $widgets[ 'sm-offices' ] = [
     'conditions' => [ 'widgetType' => 'sm-offices' ],
     'integration-class' => 'WPML_Elementor_SM_Widgets_Offices',
  ];

  $widgets[ 'sm-timeline' ] = [
     'conditions' => [ 'widgetType' => 'sm-timeline' ],
     'integration-class' => 'WPML_Elementor_SM_Widgets_Timeline',
  ];
  $widgets[ 'sm-testimonials' ] = [
     'conditions' => [ 'widgetType' => 'sm-testimonials' ],
     'integration-class' => 'WPML_Elementor_SM_Widgets_Testimonials',
  ];
  $widgets[ 'sm-slider' ] = [
     'conditions' => [ 'widgetType' => 'sm-slider' ],
     'integration-class' => 'WPML_Elementor_SM_Widgets_Slider',
  ];
  $widgets[ 'sm-advantages' ] = [
     'conditions' => [ 'widgetType' => 'sm-advantages' ],
     'integration-class' => 'WPML_Elementor_SM_Widgets_Advantages',
  ];
  
  
  return $widgets;
}
add_filter( 'wpml_elementor_widgets_to_translate', 'add_translate_widget' );

