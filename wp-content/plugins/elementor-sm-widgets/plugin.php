<?php
namespace SmWidgets;

use SmWidgets\Widgets\Service_Block;
use SmWidgets\Widgets\ServiceBlockII;
use SmWidgets\Widgets\ServiceBlockIII;
use SmWidgets\Widgets\Instagram;
use SmWidgets\Widgets\Offices;
use SmWidgets\Widgets\Timeline;
use SmWidgets\Widgets\Advantages;
use SmWidgets\Widgets\Testimonials;
use SmWidgets\Widgets\News;
use SmWidgets\Widgets\DefaultButton;
use SmWidgets\Widgets\WooCategories;
use SmWidgets\Widgets\WooProducts;
use SmWidgets\Widgets\Menu;
use SmWidgets\Widgets\Logo;
use SmWidgets\Widgets\Search;
use SmWidgets\Widgets\Basket;
use SmWidgets\Widgets\AbsoluteImage;
use SmWidgets\Widgets\NumberBlock;
use SmWidgets\Widgets\Demos;
use SmWidgets\Widgets\Slider;
use SmWidgets\Widgets\MenuLinks;
use SmWidgets\Widgets\VideoLink;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */



class Plugin {


	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
	}




	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */



	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		require __DIR__ . '/widgets/service_block.php';
		require __DIR__ . '/widgets/service_blockII.php';
		require __DIR__ . '/widgets/service_blockIII.php';
		require __DIR__ . '/widgets/instagram.php';
		require __DIR__ . '/widgets/offices.php';
		require __DIR__ . '/widgets/timeline.php';
		require __DIR__ . '/widgets/advantages.php';
		require __DIR__ . '/widgets/testimonials.php';
		require __DIR__ . '/widgets/news.php';
		require __DIR__ . '/widgets/default_button.php';
		require __DIR__ . '/widgets/woo_categories.php';
		require __DIR__ . '/widgets/woo_products.php';
		require __DIR__ . '/widgets/menu.php';
		require __DIR__ . '/widgets/logo.php';
		require __DIR__ . '/widgets/search.php';
		require __DIR__ . '/widgets/absolute_image.php';
		require __DIR__ . '/widgets/number_block.php';
		require __DIR__ . '/widgets/demos.php';
		require __DIR__ . '/widgets/basket.php';
		require __DIR__ . '/widgets/slider.php';
		require __DIR__ . '/widgets/menu_links.php';
		require __DIR__ . '/widgets/video_link.php';
		require_once( __DIR__ . '/fields/icons.php' );
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Service_Block() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ServiceBlockII() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ServiceBlockIII() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Instagram() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Offices() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Timeline() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Advantages() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Testimonials() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new News() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new DefaultButton() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new WooCategories() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new WooProducts() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Logo() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Search() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new AbsoluteImage() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new NumberBlock() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Demos() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Basket() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new MenuLinks() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new VideoLink() );
	}





}

new Plugin();





