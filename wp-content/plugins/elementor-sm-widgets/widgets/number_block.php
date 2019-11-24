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



class NumberBlock extends Widget_Base {

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
		return 'sm-number-block';
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
		return __( 'Number Block', 'smwidgets' );
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
		return 'eicon-number-field';
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
			'title',
			[
				'label' => __( 'Title', 'smwidgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Title', 'smwidgets' ),
			]
		);
		$this->add_control(
			'number',
			[
				'label' => __( 'Number', 'smwidgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '01', 'smwidgets' ),
			]
		);
		$this->add_control(
			'text',
			[
				'label' => __( 'Text', 'smwidgets' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);

		$this->add_responsive_control(
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
		
		<div class="man_number_block">
			<div class="man_number_block_number"><?php echo esc_attr($settings['number']); ?></div>
			<h3 class="man_number_block_title">
				<span><?php echo esc_attr($settings['number']); ?></span><?php echo wp_kses_post($settings['title']); ?>
			</h3>
			<?php echo esc_attr($settings['text']); ?>
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


			<div class="man_number_block">
				<div class="man_number_block_number">{{{ settings.number }}}</div>
				<h3 class="man_number_block_title">
					<span>{{{ settings.number }}}</span>{{{ settings.title }}}
				</h3>
				{{{ settings.text }}}
			</div>
		

		<?php
	}
}



