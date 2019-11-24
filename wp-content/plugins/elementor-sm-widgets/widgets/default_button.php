<?php
namespace SmWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Base_Control;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Default Button
 *
 * Elementor widget for Elementro SM Widgets.
 *
 * @since 1.0.0
 */



class DefaultButton extends Widget_Base {

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
		return 'sm-default-button';
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
		return __( 'Default Button', 'smwidgets' );
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
		return 'eicon-button';
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
			'sm_button_content',
			[
				'label' => __( 'Content', 'smwidgets' ),
			]
		);

		$this->add_control(
			'buttons',
			[
				'label' => __( 'Buttons', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'title_field' => '{{{ text }}}',
				'fields' => [
					[
						'name' => 'text',
						'label' => __( 'Text', 'elementor' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( 'Read More', 'smwidgets' ),
					],
					[
						'name' => 'link',
						'label' => __( 'Link', 'smwidgets' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( '#', 'smwidgets' ),
					],
					[
						'name' => 'transparent',
						'label' => __( 'Transparent Button', 'smwidgets' ),
						'type' => Controls_Manager::SWITCHER,
					],
					[
						'name' => 'inline_style',
						'label' => __( 'Inline Style', 'smwidgets' ),
						'type' => Controls_Manager::SWITCHER,
					],
					[
						'name' => 'javascript',
						'label' => __( 'JavaScript Event', 'smwidgets' ),
						'type' => Controls_Manager::TEXT,
					],
					[
						'name' => 'new_window',
						'label' => __( 'Open in New Window', 'smwidgets' ),
						'type' => Controls_Manager::SWITCHER,
					],
				],
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

		$this->add_control(
			'inline',
			[
				'label' => __( 'Display Inline', 'smwidgets' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'related_link',
			[
				'label' => __( 'Related Link', 'smwidgets' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
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
		$settings = $this->get_settings_for_display();

	?>

		<?php 
			foreach (  $settings['buttons'] as $item ) {
		?>
		<a <?php if ($item['new_window'] == 'yes' ) { echo 'target="_blank"';} ?> <?php if ($item['javascript'] !== '' ) { echo wp_kses_post($item['javascript']);} ?> href="<?php if ($settings['related_link'] == 'yes'): ?><?php echo esc_url(get_home_url()); ?><?php endif ?><?php echo esc_url($item['link']); ?>" class="<?php if ($item['inline_style'] == '' ) { echo 'btn';} ?> <?php if ($item['transparent'] == 'yes' ) { echo ' btn_transparent';} ?> <?php if ($item['inline_style'] == 'yes' ) { echo ' btn_inline_style';} ?>"><?php echo esc_attr($item['text']); ?><i class="ti ti-arrow-right"></i></a>
		<?php
			}
		?>

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
		<# _.each( settings.buttons, function( item ) { #>
		<a href="{{{ item.link }}}" class="btn">{{{ item.text }}}<i class="ti ti-arrow-right"></i></a>
		<# }); #>
		<?php
	}
}






