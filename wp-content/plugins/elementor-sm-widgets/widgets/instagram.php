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



class Instagram extends Widget_Base {

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
		return 'sm-instagram';
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
		return __( 'Instagram', 'smwidgets' );
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
			'sm_instagram_content',
			[
				'label' => __( 'Content', 'smwidgets' ),
			]
		);

		$this->add_control(
			'clientid',
			[
				'label' => __( 'User Id', 'smwidgets' ),
				'type' => Controls_Manager::TEXT,
				'description' => 'Required. First 10 numbers from Access Token',
			]
		);

		$this->add_control(
			'accesstoken',
			[
				'label' => __( 'Access Token', 'smwidgets' ),
				'type' => Controls_Manager::TEXT,
				'description' => 'A valid oAuth token. Can be used in place of a client ID',
			]
		);

		$this->add_control(
			'limit',
			[
				'label' => __( 'Limit', 'smwidgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => '9',
			]
		);

		$this->add_control(
			'get',
			[
				'label' => __( 'Get Method', 'smwidgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'popular',
				'options' => [
					'popular' => __( 'Popular', 'smwidgets' ),
					'tagged' => __( 'Tagged', 'smwidgets' ),
				],
				'description' => 'Customize what Instafeed fetches',
			]
		);

		$this->add_control(
			'tagname',
			[
				'label' => __( 'Tag Name', 'smwidgets' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'get' => 'tagged',
				],
				'description' => 'Name of the tag to get',
			]
		);

		$this->add_control(
			'resolution',
			[
				'label' => __( 'Resolution', 'smwidgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'thumbnail',
				'options' => [
					'thumbnail' => __( '150x150', 'smwidgets' ),
					'low_resolution' => __( '306x306', 'smwidgets' ),
					'standard_resolution' => __( '612x612', 'smwidgets' ),
				],
				'description' => 'Customize what Instafeed fetches',
			]
		);

		$this->add_control(
			'sortby',
			[
				'label' => __( 'Sort By', 'smwidgets' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'Default', 'smwidgets' ),
					'most-recent' => __( 'Most recent', 'smwidgets' ),
					'least-recent' => __( 'Least recent', 'smwidgets' ),
					'most-liked' => __( 'Most liked', 'smwidgets' ),
					'least-liked' => __( 'Least liked', 'smwidgets' ),
					'most-commented' => __( 'Most commented', 'smwidgets' ),
					'least-commented' => __( 'Least commented', 'smwidgets' ),
					'random' => __( 'Random', 'smwidgets' ),
				],
			]
		);

		$this->add_control(
			'comments',
			[
				'label' => __( 'Comments Text', 'smwidgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Comments',
			]
		);


		$this->add_control( 'block_height',
			[
				'label' => __( 'Block Height', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 300,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 170,
				],
				'selectors' => [
					'{{WRAPPER}} .man_bordered_block' => 'height: {{SIZE}}{{UNIT}};',
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

		<div class="instagram-carousel owl-carousel" id="instagram-carousel" data-userid="<?php echo esc_attr($settings['clientid']); ?>" data-accesstoken="<?php echo esc_attr($settings['accesstoken']); ?>" data-sortby="<?php echo esc_attr($settings['sortby']); ?>" data-comments="<?php echo esc_attr($settings['comments']); ?>" data-limit="<?php echo esc_attr($settings['limit']); ?>" data-resolution="<?php echo esc_attr($settings['resolution']); ?>" > 
			
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

		<div class="instagram-carousel" id="instagram-carousel" data-userid="{{{ settings.userid }}}" data-accesstoken="{{{ settings.accesstoken }}}" data-sortby="{{{ settings.sortby }}}" data-comments="{{{ settings.comments }}}" data-limit="{{{ settings.limit }}}" data-resolution="{{{ settings.resolution }}}" > 			
		</div>

		<?php
	}
}



