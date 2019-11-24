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



class WooProducts extends Widget_Base {

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
		return 'sm-woo-products';
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
		return __( 'WooCommerce Products', 'smwidgets' );
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
	 * Whether the reload preview is required or not.
	 *
	 * Used to determine whether the reload preview is required.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return bool Whether the reload preview is required.
	 */
	public function is_reload_preview_required() {
		return true;
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



	/**
	 * Get post types.
	 */
	private function man_posts_type() {
		$options = array();
		$exclude = array( 'attachment', 'elementor_library' ); // excluded post types

		$args = array(
			'public' => true,
		);

		foreach ( get_post_types( $args, 'objects' ) as $post_type ) {
			// Check if post type name exists.
			if ( ! isset( $post_type->name ) ) {
				continue;
			}

			// Check if post type label exists.
			if ( ! isset( $post_type->label ) ) {
				continue;
			}

			// Check if post type is excluded.
			if ( in_array( $post_type->name, $exclude ) === true ) {
				continue;
			}

			$options[ $post_type->name ] = $post_type->label;
		}

		return $options;
	}


	/**
	 * Get post type categories.
	 */
	private function man_post_type_categories( $post_type ) {
		$options = array();

		$taxonomy = 'product_cat';

		if ( ! empty( $taxonomy ) ) {
			// Get categories for post type.
			$terms = get_terms(
				array(
					'taxonomy'   => $taxonomy,
					'hide_empty' => false,
				)
			);
			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( isset( $term ) ) {
						if ( isset( $term->slug ) && isset( $term->name ) ) {
							$options[ $term->slug ] = $term->name;
						}
					}
				}
			}
		}

		return $options;
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
			'man_offices_content',
			[
				'label' => __( 'Content', 'smwidgets' ),
			]
		);


		// Post categories.
		$this->add_control(
			'grid_post_categories',
			[
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label'     => __( 'Category', 'smwidgets' ),
				'options'   => $this->man_post_type_categories( 'product' ),
			]
		);

		


		$this->add_control(
			'items',
			[
				'label' => __( 'Columns', 'smwidgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => '2',
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'items_number',
			[
				'label' => __( 'Items', 'smwidgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => '6',
				'render_type' => 'template',
				
			]
		);

		$this->add_control(
			'slider',
			[
				'label' => __( 'Slider', 'smwidgets' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'hover_effect',
			[
				'label' => __( 'Hover Effect', 'smwidgets' ),
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
		$settings = $this->get_settings();

		// Arguments for query.
		$args = array();
		// Display only published posts.
		$args['post_status'] = 'publish';
		if ($settings['items_number'] == 0){
			$args['posts_per_page'] = 999999;
		}else{
			$args['posts_per_page'] = $settings['items_number'];
		}
		$args['tax_query'] = array(                     
	    'relation' => 'AND',                      
      array(
        'taxonomy' => 'product_cat',               
        'field' => 'slug',                    
        'terms' => array( $settings['grid_post_categories'] ),    
        'include_children' => true,           
        'operator' => 'IN'                  
      ),
    );


		// Ignore sticky posts.
		$args['ignore_sticky_posts'] = 1;
		$args['post_type'] = 'product';
		// Display posts in category.

		$paged = get_query_var( 'paged' );
		$args['paged'] = $paged;
		// Query.
		$query = new \WP_Query( $args );
		$items = 4; 
		if ($settings['items'] == 2) {
			$items = 6;
		}elseif($settings['items'] == 3){
			$items = 4;
		}elseif($settings['items'] == 4){
			$items = 3;
		}else{
			$items = 4;
		}

		?>


		<?php if ($settings['slider'] == 'yes'){ ?>
			<div class="products products_grid_type products_widget woo_products_slider owl-carousel man_products_slider" data-items="<?php echo esc_attr($settings['items']); ?>">
		<?php }else{ ?>
			<div class="products_grid_type products_widget products row">
		<?php } ?>

		<?php 


		// Query results.
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				global $product; 
		?>
			
			<?php if ($settings['slider'] == 'yes'){ ?>

			<div class="product type-product post-915 status-publish first instock product_cat-dress product_tag-cotton product_tag-pure product_tag-reversible-to-denim has-post-thumbnail shipping-taxable purchasable product-type-simple">

				<div class="man_product_photo">
					<img src="<?php echo wp_get_attachment_image_src( $product->get_image_id(), 'manufacturer_medium' )[0]; ?>">

					<?php if ($settings['hover_effect'] == 'yes'){ ?>
					<div class="man_product_photo_hover man_image_bck" data-image="<?php echo wp_get_attachment_image_src($product->get_gallery_image_ids()[0],'manufacturer_medium')[0]; ?>"></div>
					<a href="<?php echo get_permalink(); ?>" class="man_product_photo_link"></a>
					<?php } ?>
					
				</div>

				<div class="man_product_cont">
					<a href="<?php echo get_permalink(); ?>" >
						<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
						<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
					</a>
						<span class="man_product_cont_btn">
							<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
						</span>
					
				</div>
			</div>

			<?php }else{ ?>
				<div class="col-md-<?php echo esc_attr($items); ?>">
					<div class="product type-product post-915 status-publish first instock product_cat-dress product_tag-cotton product_tag-pure product_tag-reversible-to-denim has-post-thumbnail shipping-taxable purchasable product-type-simple">


						<div class="man_product_photo">
							<img src="<?php echo wp_get_attachment_image_src( $product->get_image_id(), 'manufacturer_medium' )[0]; ?>">
							
							<?php if ($settings['hover_effect'] == 'yes'){ ?>
							<div class="man_product_photo_hover man_image_bck" data-image="<?php echo wp_get_attachment_image_src($product->get_gallery_image_ids()[0],'manufacturer_medium')[0]; ?>"></div>
							<?php } ?>
							<a href="<?php echo get_permalink(); ?>" class="man_product_photo_link"></a>
							
						</div>

						<div class="man_product_cont">
							<a href="<?php echo get_permalink(); ?>" >
								<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
								<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
							</a>
								<span class="man_product_cont_btn">
									<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
								</span>
							
						</div>


					</div>
				</div>
				
			<?php } ?>
			
				

		<?php 
			} // End while().
			

		}?>
		</div>
		<!-- Carousel End -->
		
		

		<?php 

		// Restore original data.
		wp_reset_postdata();

	}


}



