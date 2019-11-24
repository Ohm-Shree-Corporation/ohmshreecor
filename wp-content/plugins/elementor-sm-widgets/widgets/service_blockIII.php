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



class ServiceBlockIII extends Widget_Base {

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
		return 'sm-service-block-III';
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
		return __( 'Service Block III', 'smwidgets' );
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
			'sm_content',
			[
				'label' => __( 'Content', 'smwidgets' ),
			]
		);


		$this->add_control(
			'content',
			[
				'label' => __( 'Content', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Content', 'smwidgets' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'smwidgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '#', 'smwidgets' ),
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

		$this->add_control(
			'bottom_text',
			[
				'label' => __( 'Bottom Text', 'smwidgets' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
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

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .man_service_block_III_content, {{WRAPPER}} .man_service_block_III_content h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
				'size',
				[
					'label' => __( 'Block Height', 'smwidgets' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 250,
							'max' => 500,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 250,
					],
					'selectors' => [
						'{{WRAPPER}} .man_service_block_III' => 'height: {{SIZE}}{{UNIT}};',

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
		$this->add_inline_editing_attributes( 'title', 'none' );
		$this->add_inline_editing_attributes( 'content', 'none' );

	?>
	<div class="man_service_block_III <?php if($settings['bottom_text']=='yes'){ echo 'man_service_block_III_bottom';}	?>">
		<a href="<?php if ($settings['related_link'] == 'yes'): ?><?php echo esc_url(get_home_url()); ?><?php endif ?><?php echo esc_url($settings['link']); ?>"></a>
		<img src="<?php echo wp_get_attachment_image_url($settings['image']['id'],'bauwerk_gallery_thumb'); ?>" alt="">
		<div class="man_service_block_III_content">
			<?php echo wp_kses_post($settings['content']); ?>
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
		<div class="title">	
			<i class="{{{ settings.icons }}} man_icon"></i>
			<h3>{{{ settings.title }}}</h3>
			<p>{{{ settings.content }}}</p>
		</div>
		<?php
	}
}



