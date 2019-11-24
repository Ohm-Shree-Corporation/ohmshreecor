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



class Demos extends Widget_Base {

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
		return 'sm-demos';
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
		return __( 'Demos', 'smwidgets' );
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
			'title',
			[
				'label' => __( 'Title', 'smwidgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Title', 'smwidgets' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'smwidgets' ),
				'type' => Controls_Manager::TEXT,
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
			'coming',
			[
				'label' => __( 'Coming Soon', 'smwidgets' ),
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

	?>

		<div class="man_demos">
			<?php if ($settings['link'] !== ''): ?>
			<a href="<?php echo esc_url($settings['link']); ?>" target="_blank"></a>
			<?php endif ?>
			<?php if ($settings['coming']=='yes'): ?>
				<div class="man_coming"></div>
			<?php endif ?>
			<div class="man_demos_photo man_image_bck" data-image="<?php echo esc_url($settings['image']['url']); ?>"></div>
			<div class="man_demos_title"><?php echo wp_kses_post($settings['title']); ?></div>
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
			<h3>{{{ settings.title }}}</h3>
			<p>{{{ settings.content }}}</p>
		</div>
		<?php
	}
}



