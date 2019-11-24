<?php
namespace SmWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Base_Control;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */



class Offices extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'sm-offices';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Offices', 'smwidgets' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-google-maps';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'theme-elements' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'smwidgets' ];
	}




	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'sm_offices_content',
			[
				'label' => __( 'Content', 'smwidgets' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'smwidgets' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],

			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'pin_title', [
				'label' => __( 'Title', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Title',
			]
		);

		$repeater->add_control(
			'pin_content', [
				'label' => __( 'Content', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
			]
		);

		$repeater->add_responsive_control(
			'pin_top', [
				'label' => __( 'Top position in %', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '10',
				'render_type' => 'template',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{VALUE}}%;'
				],
			]
		);

		$repeater->add_responsive_control(
			'pin_left', [
				'label' => __( 'Left position in %', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '10',
				'render_type' => 'template',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{VALUE}}%;'
				],
			]
		);


		$this->add_control(
			'pins',
			[
				'label' => __( 'Map Pin', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ pin_title }}}',
			]
		);


		$this->add_responsive_control(
			'map_width',
			[
				'label' => __( 'Map Width', 'smwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'pin_color',
			[
				'label' => __( 'Pin Color', 'smwidgets' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .man_map_point' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .man_map_point_border' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .man_map_point_second_border' => 'background-color: {{VALUE}};',

				],
			]
		);
		

		



		

		$this->end_controls_section();




	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings();


	?>	
		
		<div class="man_map man_image_bck">
				<div class="man_map_pins">
					<?php 
						foreach (  $settings['pins'] as $item ) {
					?>
					<div class="man_map_pin_wrapper">
							<div class="man_map_pin_cont_mobile man_map_pin_cont_mobile-<?php echo esc_attr($item['_id']); ?>"><i class="man_map_pin_cont_mobile_close ti ti-close"></i><b><?php echo esc_attr($item['pin_title']); ?></b><?php echo wp_kses_post($item['pin_content']); ?></div>	
							<div class="man_map_pin elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>" data-id="<?php echo esc_attr($item['_id']); ?>" data-top="<?php echo esc_attr($item['pin_top']); ?>" data-left="<?php echo esc_attr($item['pin_left']); ?>" data-top-mobile="<?php echo esc_attr($item['pin_top_mobile']); ?>" data-left-mobile="<?php echo esc_attr($item['pin_left_mobile']); ?>" data-top-tablet="<?php echo esc_attr($item['pin_top_tablet']); ?>" data-left-tablet="<?php echo esc_attr($item['pin_left_tablet']); ?>">
								
								<svg aria-hidden="true" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 414 542" class="svg-inline--fa fa-map-marker-alt fa-w-12 fa-2x"><path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z" class=""></path></svg>


								<div class="man_map_pin_cont">
									<b><?php echo esc_attr($item['pin_title']); ?></b>
									<?php echo wp_kses_post($item['pin_content']); ?>
								</div>
							</div>
					</div>
					<?php
						}
					?>
				</div>
				<img src="<?php echo esc_attr($settings['image']['url']); ?>" alt="">
				
		</div>

	<?php
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {
		?>



		<div class="man_map man_image_bck">
				
				<div class="man_map_pins">
					<# _.each( settings.pins, function( item ) { #>
						<div class="man_map_pin_cont_mobile man_map_pin_cont_mobile-{{ item._id }}"><i class="man_map_pin_cont_mobile_close ti ti-close"></i>{{ item.pin_content }}</div>		
						<div class="man_map_pin elementor-repeater-item-{{ item._id }}" data-top="{{ item.pin_top }}" data-id="{{ item._id }}" data-left="{{ item.pin_left }}" data-top-mobile="{{ item.pin_top_mobile }}" data-left-mobile="{{ item.pin_left_mobile }}" data-top-tablet="{{ item.pin_top_tablet }}" data-left-tablet="{{ item.pin_left_tablet }}">
							
							<svg aria-hidden="true" data-prefix="fas" data-icon="map-marker-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 414 542" class="svg-inline--fa fa-map-marker-alt fa-w-12 fa-2x"><path fill="currentColor" d="M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z" class=""></path></svg>

							<div class="man_map_pin_cont">
								<b>{{ item.pin_ttitle }}</b>
								{{ item.pin_content }}
							</div>
						</div>
					<# }); #>
				</div>
				
				<img src="{{ settings.image.url }}" alt="">

		</div>

		

		<?php
	}
}



