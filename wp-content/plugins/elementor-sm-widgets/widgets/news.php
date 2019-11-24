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



class News extends Widget_Base {

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
		return 'sm-news';
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
		return __( 'News', 'smwidgets' );
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
		return 'eicon-posts-ticker';
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
		$category_args = apply_filters( 'elementor_extra_widgets_category_args', array() );
		$slug          = isset( $category_args['slug'] ) ? $category_args['slug'] : 'smwidgets';

		return [ $slug ];
	}



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

		if ( $post_type == 'post' ) {
			$taxonomy = 'category';
		} elseif ( $post_type == 'product' ) {
			$taxonomy = 'product_cat';
		}

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
				'options'   => $this->man_post_type_categories( 'post' ),
			]
		);

		// Product categories.
		$this->add_control(
			'grid_product_categories',
			[
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label'     => '<i class="fa fa-tag"></i> ' . __( 'Category', 'smwidgets' ),
				'options'   => $this->man_post_type_categories( 'product' ),
				'condition' => [
					'grid_post_type' => 'product',
				],
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
		// Ignore sticky posts.
		$args['ignore_sticky_posts'] = 1;
		$args['post_type'] = 'post';
		// Display posts in category.
		$args['category_name'] = $settings['grid_post_categories'];
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
			<div class="man_news owl-carousel" data-items="<?php echo esc_attr($settings['items']); ?>">
		<?php }else{ ?>
			<div class="man_news_list row">
		<?php } ?>
		
		<?php 


		// Query results.
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
		?>
			
			<?php if ($settings['slider'] == 'yes'){ ?>
				<div class="man_news_grid_item">
						<a href="<?php the_permalink(); ?>" class="man_news_item_link"></a>

						<div class="man_news_item_img">
							<img 
								src="<?php echo get_the_post_thumbnail_url( get_post(), 'woocommerce_thumbnail'); ?>"
								srcset="<?php echo wp_get_attachment_image_srcset( get_post_thumbnail_id(), 'large' ) ?>"
							>	
							<div class="man_news_item_over"></div>	
							<div class="man_news_item_cont">
								<div class="man_news_item_title"><?php the_title(); ?></div>
								<div class="man_news_item_date"><i class="ti ti-time"></i> <?php echo get_the_date(); ?></div>	
							</div>
						</div>

				</div>
			<?php }else{ ?>

				<a href="<?php the_permalink(); ?>"></a>
	
				<div class="man_news_grid_item col-sm-6 col-md-<?php echo esc_attr($items); ?>">
						<a href="<?php the_permalink(); ?>" class="man_news_item_link"></a>

						<div class="man_news_item_img">
							<img 
								src="<?php echo get_the_post_thumbnail_url( get_post(), 'woocommerce_thumbnail'); ?>"
								srcset="<?php echo wp_get_attachment_image_srcset( get_post_thumbnail_id(), 'large' ) ?>"
								sizes="<?php echo wp_get_attachment_image_sizes( $attachment_id, 'large' ) ?>"
							>	
							<div class="man_news_item_over"></div>	
							<div class="man_news_item_cont">
								<div class="man_news_item_title"><?php the_title(); ?></div>
								<div class="man_news_item_date"><i class="ti ti-time"></i> <?php echo get_the_date(); ?></div>	
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
		if ($settings['slider'] !== 'yes'){
			$max    = $query->max_num_pages;
			$current       = max( 1, $paged );
			$paginate_args = array(
				'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
				'format'    => '?paged=%#%',
				'current'   => $current,
				'total'     => $max,
				'show_all'  => false,
				'end_size'  => 1,
				'mid_size'  => 3,
				'prev_next' => true,
				'prev_text' => __( '<i class="ti ti-arrow-left"></i>Previous', 'smwidgets' ),
				'next_text' => __( 'Next<i class="ti ti-arrow-right"></i>', 'smwidgets' ),
				'type'      => 'plain',
				'add_args'  => false,
			);

			$pagination = paginate_links( $paginate_args );
		}
		?>
		<?php
		if ($settings['slider'] !== 'yes'){ ?>
		<div class="man_navigation">
			<?php echo wp_kses_post($pagination); ?>
		</div>
		<?php }?>

		<?php 

		// Restore original data.
		wp_reset_postdata();

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

		// Arguments for query.
		$args = array();
		// Display only published posts.
		$args['post_status'] = 'publish';
		// Ignore sticky posts.
		$args['ignore_sticky_posts'] = 1;
		$args['post_type'] = 'post';
		// Display posts in category.

		$args['category_name'] = strstr('{{settings.grid_post_categories}}',' ');
		// Query.
		$query = new \WP_Query( $args );
	
		?>

		<# 
		var items = 4;
		if (settings.items == 2) {
		 var items = 6;
		}
		if (settings.items == 3) {
		 var items = 4;
		}
		if (settings.items == 4) {
		 var items = 3;
		}
		#>
		<# if ( settings.slider == 'yes' ) { #>
			<div class="man_news owl-carousel" data-items="{{ settings.items }}">
		<# }else{ #>
			<div class="man_news_list row">
		<# } #>
		

		<?php 


		// Query results.
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
		?>

			
			<# if ( settings.slider == 'yes' ) { #>
				<div class="man_news_item">
						
						<div class="man_news_item_img man_image_bck" data-image="<?php echo get_the_post_thumbnail_url( get_post()); ?>">	
							<div class="man_news_item_over"></div>	
							<div class="man_news_item_cont">
								<div class="man_news_item_title"><?php the_title(); ?></div>
								<div class="man_news_item_date"><i class="ti ti-time"></i> <?php echo get_the_date(); ?></div>	
							</div>
						</div>

				</div>
			<# }else{ #>
				<div class="man_news_item col-md-{{items}}">
						<a href="<?php the_permalink(); ?>"></a>

						<div class="man_news_item_img man_image_bck" data-image="<?php echo get_the_post_thumbnail_url( get_post()); ?>">	
							<div class="man_news_item_over"></div>	
							<div class="man_news_item_cont">
								<div class="man_news_item_title"><?php the_title(); ?></div>
								<div class="man_news_item_date"><i class="ti ti-time"></i> <?php echo get_the_date(); ?></div>	
							</div>
						</div>

				</div>
			<# } #>

			
				

		<?php 
			} // End while().

		}?>
		</div>
		<!-- Carousel End -->

		<script>
			jQuery(document).ready(function($) {
					/* Section Background */
					$('.man_image_bck').each(function(){
						var image = $(this).attr('data-image');
						var gradient = $(this).attr('data-gradient');
						var color = $(this).attr('data-color');
						if (image){
							$(this).css('background-image', 'url('+image+')');	
						}
						if (gradient){
							$(this).css('background-image', gradient);	
						}
						if (color){
							$(this).css('background-color', color);	
						}
					});	
					// News
					$('.man_news').each(function(){
						var items = $(this).attr('data-items');
						$(this).owlCarousel({
							items:items,
							autoplay:0,
							dots:1,
							nav:0,
							navText:['<i class="ti ti-angle-left"></i>','<i class="ti ti-angle-right"></i>'],
							responsiveRefreshRate:200,
							responsive:{
					        0:{
					            items:1,
					        },
					        767:{
					            items:items,
					        },
					    }
						});
					});		
			});
		</script>

		<?php 

		// Restore original data.
		wp_reset_postdata();

	}
}



