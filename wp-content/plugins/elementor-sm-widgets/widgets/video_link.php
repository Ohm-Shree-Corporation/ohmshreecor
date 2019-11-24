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



class VideoLink extends Widget_Base {

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
		return 'sm-video-link';
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
		return __( 'YouTube Link', 'smwidgets' );
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
		return 'eicon-play-o';
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
			'text',
			[
				'label' => __( 'Text', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'url',
			[
				'label' => __( 'Youtube Code', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_responsive_control( 'icon_size',
			[
				'label' => __( 'Icon Size', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 1.8,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'transform:scale({{SIZE}});',
				],
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => __( 'Text Color', 'smwidgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a' => 'color: {{VALUE}};',
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
		$settings = $this->get_settings_for_display();

	?>
		
		<?php if ($settings['text']): ?>
			<a href="https://www.youtube.com/embed/<?php echo esc_attr($settings['url']); ?>?feature=oembed&rel=0&controls=0&showinfo=0&mute=0&wmode=opaque" class="sm_video_link sm_video_link_text"><span><b></b><i class="fa fa-play"></i></span><b><?php echo esc_attr($settings['text']); ?></b></a>
		<?php else: ?>
			<a href="https://www.youtube.com/embed/<?php echo esc_attr($settings['url']); ?>?feature=oembed&rel=0&controls=0&showinfo=0&mute=0&wmode=opaque" class="sm_video_link"><span><b></b><i class="fa fa-play"></i></span></a>
		<?php endif ?>
		


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
	}
}






