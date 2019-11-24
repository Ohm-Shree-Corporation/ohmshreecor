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



class Menu extends Widget_Base {

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
		return 'sm-menu';
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
		return __( 'Nav Menu', 'smwidgets' );
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
		return 'eicon-ellipsis-h';
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
			'section_content',
			[
				'label' => __( 'Navigation', 'smwidgets' ),
			]
		);
		$this->add_control(
			'sm_nav_menu',
			[
				'label'   => __( 'Select Menu', 'smwidgets' ),
				'type'    => Controls_Manager::SELECT, 'options' => menu_choices(),
				'default' => '',
			]
		);

		$this->add_control(
			'sm_menu_location',
			[
				'label'       => __( 'Menu Location', 'smwidgets' ),
				'type'        => Controls_Manager::SELECT, 'options' => [
					'primary'   => __( 'Primary', 'smwidgets' ),
					'secondary' => __( 'Secondary', 'smwidgets' ),
				],
				'default'     => 'primary',
			]
		);

		$this->add_control(
			'sm_link_padding',
			[
				'label'      => __( 'Link Padding', 'smwidgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .sm_nav_menu > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_menu_style',
			[
				'label' => __( 'Navbar', 'smwidgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'menu_link_color',
			[
				'label'     => __( 'Link Color', 'smwidgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .sm_menu .menu-item a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .sm_nav_menu a',
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
		if ($settings['inline'] == 'yes') {
			$this->add_render_attribute( '_wrapper', 'class', 'sm_display_inline' );
		}
		$menu_location = $settings['sm_menu_location'];
		// Get menu
		$sm_nav_menu = ! empty( $settings['sm_nav_menu'] ) ? wp_get_nav_menu_object( $settings['sm_nav_menu'] ) : false;

		if ( ! $sm_nav_menu ) {
			return;
		}

		$nav_menu_args = array(
			'fallback_cb'    => false,
			'container'      => false,
			'menu_id'        => 'sm_nav_menu',
			'menu_class'     => 'sm_nav_menu',
			'theme_location' => 'default_navmenu',
			'menu'           => $sm_nav_menu,
			'echo'           => true,
			'depth'          => 0,
			'walker'         => '',
		);

		echo '<div id="elementor-header-' . $menu_location . '" class="elementor-header">';
		?>
			<button class="sm_menu_toggle"><i class="ti ti-menu"></i></button>
			<a class="sm_menu_toggle_close" href="#"><i class="ti ti-close"></i></a>
			<div id="sm_menu" class="sm_menu">
			
				<nav itemtype="http://schema.org/SiteNavigationElement" itemscope="itemscope" id="elementor-navigation" class="elementor-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Elementor Menu', 'smwidgets' ); ?>">				
				<?php
					wp_nav_menu(
						apply_filters(
							'widget_nav_menu_args',
							$nav_menu_args,
							$sm_nav_menu,
							$settings
						)
					);
				?>
				</nav>

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

		

		<?php
	}
}



