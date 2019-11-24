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



class Timeline extends Widget_Base {

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
		return 'sm-timeline';
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
		return __( 'Timeline', 'smwidgets' );
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
		return 'eicon-countdown';
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
			'sm_timeline_content',
			[
				'label' => __( 'Content', 'smwidgets' ),
			]
		);

		
		$this->add_control(
			'pins',
			[
				'label' => __( 'Timeline Pin', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'title_field' => '{{{ pin_title }}}',
				'fields' => [
					[
						'name' => 'pin_title',
						'label' => __( 'Title', 'smwidgets' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
						'default' => 'Title',
					],
					[
						'name' => 'pin_content',
						'label' => __( 'Content', 'smwidgets' ),
						'type' => \Elementor\Controls_Manager::WYSIWYG,
						'default' => 'Content',
					],
				],

			]
		);


		

		$this->end_controls_section();

		$this->start_controls_section(
			'sm_timeline_style',
			[
				'label' => __( 'Style', 'smwidgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'timeline_color',
			[
				'label' => __( 'Timeline Color', 'smwidgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .owl-nav i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .man_timeline_line' => 'border-color: {{VALUE}};',

				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'smwidgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .man_timeline_pin_title' => 'color: {{VALUE}};',
				],
			]
		);
		


		$this->add_control(
			'pin_border_color',
			[
				'label' => __( 'Pin Border Color', 'smwidgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .man_timeline_point_border' => 'background-color: {{VALUE}};',
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
		
	<div class="man_timeline">
		<div class="man_timeline_line"></div>
		<div class="man_timeline_carousel owl-carousel">
			<?php 
				$i = 0;
				$class = "odd";
				foreach (  $settings['pins'] as $item ) {
				if ($i%2 == 1) { 
					$class = "even";
				}else{
					$class = "odd";
				}

			?>
			<div class="man_timeline_item">
				<div class="man_timeline_pin <?php echo esc_attr($class); ?>">
					<span class="man_timeline_point"></span>
					<span class="man_timeline_point_border"></span>
					<div class="man_timeline_pin_title">
						<?php echo esc_attr($item['pin_title']); ?>
					</div>
					<div class="man_timeline_pin_cont">
						

						<?php if ($class == 'odd'){?>
							<div class="man_timeline_pin_cont_corner">
								<svg
								  xmlns='http://www.w3.org/2000/svg'
								  viewBox='0 0 64 64'
								  width='64' height='64'
								  fill='currentcolor'>
								  <path d='M0 16 L10 16 L0 0 Z' />
								</svg>
							</div>
						<?php }else{ ?>
							<div class="man_timeline_pin_cont_corner man_timeline_pin_cont_corner_even">
								<svg
								  xmlns='http://www.w3.org/2000/svg'
								  viewBox='0 0 64 64'
								  width='64' height='64'
								  fill='currentcolor'>
								  <path d='M0 16 L10 0 L0 0 L0 8 Z' />
								</svg>
							</div>
						<?php } ?>
							
						
						<?php echo wp_kses_post($item['pin_content']); ?>
					</div>
				</div>
			</div>
			<?php
				$i++;
				}
			?>
		</div>
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

		
		<div class="man_timeline">
		<div class="man_timeline_line"></div>
		<div class="man_timeline_carousel owl-carousel">
				
				<#
				var i = 0;
				var sm_class = 'odd';

			 	_.each( settings.pins, function( item ) { 
					if (i%2 == 1) { 
						sm_class = 'even';
				 	}else{ 
						sm_class = 'odd';
					}
				#>

					<div class="man_timeline_item">
						<div class="man_timeline_pin {{ sm_class }}">
							<span class="man_timeline_point"></span>
							<span class="man_timeline_point_border"></span>
							<div class="man_timeline_pin_title">
								{{ item.pin_title }}
							</div>
							<div class="man_timeline_pin_cont">
								{{ item.pin_content }}
							</div>
						</div>
					</div>
	
				<# i++; }); #>

				<script>
					jQuery(document).ready(function($) {
							$(".man_timeline_carousel").owlCarousel({
								items:4,
								autoplay:0,
								dots:1,
								nav:1,
								navText:['<i class="ti ti-angle-left"></i>','<i class="ti ti-angle-right"></i>']
							});
					});
				</script>
		</div>
	</div>




	

	<?php
	}
}



