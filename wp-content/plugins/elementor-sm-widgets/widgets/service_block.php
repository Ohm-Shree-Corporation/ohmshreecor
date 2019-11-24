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



class Service_Block extends Widget_Base {

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
		return 'sm-service-block';
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
		return __( 'Service', 'smwidgets' );
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
		return 'eicon-posts-grid';
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
			'sm_service_block_content',
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
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} h4',
				'label' => __( 'Title Typography', 'smwidgets' ),
			]
		);

		$this->add_control(
			'content',
			[
				'label' => __( 'Content', 'smwidgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Content', 'smwidgets' ),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} p',
				'label' => __( 'Content Typography', 'smwidgets' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'smwidgets' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'link_text',
			[
				'label' => __( 'Link Text', 'smwidgets' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'icons',
			[
				'label' => __( 'Icons', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'options' => theme_icons(),
				'exclude' => theme_fa_icons(),
				'label_block' => true,
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

		$this->start_controls_section(
			'sm_service_block_style',
			[
				'label' => __( 'Style', 'smwidgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'size',
				[
					'label' => __( 'Size', 'smwidgets' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 6,
							'max' => 300,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .sm_icon' => 'font-size: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',

					],
				]
			);

			$this->add_control(
				'primary_color',
				[
					'label' => __( 'Primary Color', 'smwidgets' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .sm_icon' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'heading_color',
				[
					'label' => __( 'Heading Color', 'smwidgets' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} h4' => 'color: {{VALUE}};',
					],
				]
			);



		$this->end_controls_section();


		$this->start_controls_section(
			'sm_service_block_style_hover',
				[
					'label' => __( 'Style Hover', 'smwidgets' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

				$this->add_control(
					'primary_color_hover',
					[
						'label' => __( 'Primary Color', 'smwidgets' ),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}}:hover, {{WRAPPER}}:hover .sm_icon, {{WRAPPER}}:hover h4, {{WRAPPER}}:hover .btn_inline_style' => 'color: {{VALUE}};',
							'{{WRAPPER}}:hover .btn_inline_style:before' => 'background-color: {{VALUE}}!important;',
						],
					]
				);

				$this->add_control(
					'hover_margin',
					[
						'label' => __( 'Hover Effect', 'smwidgets' ),
						'type' => Controls_Manager::SWITCHER,
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
		$this->add_inline_editing_attributes( 'title', 'none' );
		$this->add_inline_editing_attributes( 'content', 'none' );

		$block_class = '';
		if ($settings['hover_margin'] == "yes") {
			$block_class = 'man_hover_margin';
		}
	?>
		<div class="man_service_block <?php echo esc_attr($block_class); ?>">	
			<i class="<?php echo esc_attr($settings['icons']); ?> sm_icon"></i>
			<h4 <?php echo wp_kses_post($this->get_render_attribute_string( 'title' )); ?>><?php echo wp_kses_post($settings['title']); ?></h4>
			<p <?php echo wp_kses_post($this->get_render_attribute_string( 'content' )); ?>><?php echo wp_kses_post($settings['content']); ?></p>
			<?php if ($settings['link_text']!==''): ?>
				<a href="<?php if ($settings['related_link'] == 'yes'): ?><?php echo esc_url(get_home_url()); ?><?php endif ?><?php echo esc_url($settings['link']); ?>" class="btn_inline_style"><?php echo esc_attr($settings['link_text']); ?></a>
			<?php endif ?>
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
		<div class="title">	
			<i class="{{{ settings.icons }}} sm_icon"></i>
			<h4>{{{ settings.title }}}</h4>
			<p>{{{ settings.content }}}</p>
		</div>
		<?php
	}


}



