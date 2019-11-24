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



class AbsoluteImage extends Widget_Base {

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
		return 'sm-absolute-image';
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
		return __( 'Absolute Image', 'smwidgets' );
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
		return 'eicon-image-rollover';
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
			'sm_content',
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

		$this->add_responsive_control(
			'width',
			[
				'label' => __( 'Width', 'smwidgets' ),
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

		$this->add_responsive_control(
			'top',
			[
				'label' => __( 'Top', 'smwidgets' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}}' => 'top: {{VALUE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'left',
			[
				'label' => __( 'Left', 'smwidgets' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}}' => 'left: {{VALUE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'right',
			[
				'label' => __( 'Right', 'smwidgets' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}}' => 'right: {{VALUE}}px; left:auto;',
				],
			]
		);

		$this->add_responsive_control(
			'bottom',
			[
				'label' => __( 'Bottom', 'smwidgets' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}}' => 'bottom: {{VALUE}}px;',
				],
			]
		);

		$this->add_control(
			'z_index',
			[
				'label' => __( 'Z-Index', 'smwidgets' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'selectors' => [
					'{{WRAPPER}}' => 'z-index: {{VALUE}};',
				],
				'label_block' => false,
			]
		);




		$this->end_controls_section();


		$this->start_controls_section(
			'sm_animation',
			[
				'label' => __( 'Animation', 'smwidgets' ),
			]
		);

		$this->add_responsive_control(
			'top_start',
			[
				'label' => __( 'Top Start', 'smwidgets' ),
				'type' => Controls_Manager::NUMBER,
			]
		);

		$this->add_responsive_control(
			'top_end',
			[
				'label' => __( 'Top End', 'smwidgets' ),
				'type' => Controls_Manager::NUMBER,
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
		
		<div class="man_absolute_image" <?php if ($settings['top_start'] !== '' && $settings['top_end'] !== '') {
		?>
		data-bottom-top="transform:translateY(<?php echo esc_attr($settings['top_start']); ?>px)" 
		data-center-bottom="transform:translateY(<?php echo esc_attr($settings['top_end']); ?>px)"
		<?php } ?>>
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



		<div class="man_absolute_image">
				
				<img src="{{ settings.image.url }}" alt="">

		</div>

		

		<?php
	}
}



