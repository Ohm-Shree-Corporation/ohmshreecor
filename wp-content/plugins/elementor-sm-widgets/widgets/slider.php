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



class Slider extends Widget_Base {

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
		return 'sm-slider';
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
		return __( 'Slider', 'smwidgets' );
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
		return 'eicon-slideshow';
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
			'slider_content',
			[
				'label' => __( 'Content', 'smwidgets' ),
			]
		);



		$slides = new \Elementor\Repeater();


		$slides->add_control(
			'slider_title', [
				'label' => __( 'Title', 'elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => '',
			]
		);
		$slides->add_group_control(
		\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => __( 'Title Typography', 'elementor' ),
				'name' => 'title_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .man_slider_item_title',
			]
		);

		$slides->add_control(
			'slider_content', [
				'label' => __( 'Content', 'elementor' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
			]
		);
		$slides->add_control(
			'slider_content_mobile',
			[
				'label' => __( 'Hide Content on Mobile', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$slides->add_group_control(
		\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => __( 'Content Typography', 'elementor' ),
				'name' => 'content_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .man_slider_item_text',
			]
		);


		$slides->add_control(
			'slider_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}  .man_slider_item_title, {{WRAPPER}} {{CURRENT_ITEM}}  .man_slider_item_text, {{WRAPPER}} {{CURRENT_ITEM}}  h2, {{WRAPPER}} {{CURRENT_ITEM}}  h3, {{WRAPPER}} {{CURRENT_ITEM}}  h4, {{WRAPPER}} {{CURRENT_ITEM}}  h5, {{WRAPPER}} {{CURRENT_ITEM}}  h6, {{WRAPPER}} {{CURRENT_ITEM}}  h1' => 'color: {{VALUE}};',
				],
			]
		);

		$slides->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Text Alignment', 'elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'render_type' => 'template',
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} ' => 'text-align: {{VALUE}};',
				],
			]
		);

		$slides->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'smwidgets' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
			]
		);

		$slides->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'slider_image_over',
				'label' => __( 'Image Over Color', 'smwidgets' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .man_slider_item_over',
			]
		);



		$slides->add_control(
			'slider_btn_title', [
				'label' => __( 'Button Text', 'elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
			]
		);
		$slides->add_control(
			'slider_btn_link', [
				'label' => __( 'Button Link', 'elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
			]
		);

		$slides->add_control(
			'related_link',
			[
				'label' => __( 'Related Link', 'smwidgets' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$slides->add_control(
			'slider_btn_mobile',
			[
				'label' => __( 'Hide Button on Mobile', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);





		$this->add_control(
			'slides',
			[
				'label' => __( 'Slide', 'elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $slides->get_controls(),
				'title_field' => '{{{ slider_title }}}',
			]
		);

		$this->add_responsive_control(
			'margin',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .man_slider_item_title_cont' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		
		<div class="man_slider owl-carousel">
					<?php 
						$i = 1;
						foreach (  $settings['slides'] as $item ) {
					?>
						<div class="man_slider_item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
							<div class="man_slider_item_over"></div>
							<div class="man_slider_over_text parallax_title"><?php echo wp_kses_post($item['slider_over_title']); ?></div>
							
							<div class="container">
								<div class="man_slider_item_title_cont">

									<div class="man_slider_item_title">
										<?php echo wp_kses_post($item['slider_title']); ?>
									</div>
									<div class="man_slider_item_text <?php if ($item['slider_content_mobile'] == 'yes'): ?>d-none d-sm-block<?php endif ?>">
										<?php echo wp_kses_post($item['slider_content']); ?>
									</div>
									
									<?php if ($item['slider_btn_title'] !== ''): ?>
										<div class="man_slider_item_btn <?php if ($item['slider_btn_mobile'] == 'yes'): ?>d-none d-sm-block<?php endif ?>">
										<a href="<?php if ($item['related_link'] == 'yes'): ?><?php echo esc_url(get_home_url()); ?><?php endif ?><?php echo esc_url($item['slider_btn_link']); ?>" class="btn"><?php echo esc_attr($item['slider_btn_title']); ?><i class="ti ti-arrow-right"><span></span></i></a>
										</div>
									<?php endif ?>
									

								</div>
							</div>

						</div>
					<?php
						$i++;
						}
					?>
				
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


			<div class="man_slider owl-carousel">

						<# _.each( settings.slides, function( item ) { #>
						<div class="man_slider_item elementor-repeater-item-">
							<div class="man_slider_item_over"></div>
							<div class="man_slider_over_text parallax_title">{{ item.slider_over_title }}</div>
							
							<div class="container">
								<div class="man_slider_item_title_cont">

									<div class="man_slider_item_title">
										{{ item.slider_title }}
									</div>
									<div class="man_slider_item_text">
										{{ item.slider_content }}
									</div>
									

										<div class="man_slider_item_btn">
										<a href="{{ item.slider_btn_link }}" class="btn">{{ item.slider_btn_title }}<i class="ti ti-arrow-right"><span></span></i></a>
										</div>

									

								</div>
							</div>

						</div>
					<# }); #>
				
		</div>

		

		<?php
	}
}



