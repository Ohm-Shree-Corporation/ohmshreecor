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



class WooCategories extends Widget_Base {

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
		return 'sm-woo-categories';
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
		return __( 'WooCommerce Categories', 'smwidgets' );
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
			'sm_woo_cat_content',
			[
				'label' => __( 'Settings', 'smwidgets' ),
			]
		);
		$this->add_responsive_control(
			'sm_woo_cat_columns',
			[
				'label' => __( 'Columns', 'smwidgets' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'6' => [
						'title' => __( '2 Columns', 'smwidgets' ),
						'icon' => 'ti ti-layout-column2',
					],
					'4' => [
						'title' => __( '3 Columns', 'smwidgets' ),
						'icon' => 'ti ti-layout-column3',
					],
					'3' => [
						'title' => __( '4 Columns', 'smwidgets' ),
						'icon' => 'ti ti-layout-column4',
					],
				],
				'default' => 3,
				'toggle' => true,
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
		<div class="man_woo_cat row">
		<?php 
			global $theme_options;
			$taxonomy  = 'product_cat';
      $empty = 0;
      $args = array(
          'taxonomy'     => $taxonomy,
          'hide_empty'   => $empty
      );
      $all_categories = get_categories( $args );
      foreach ($all_categories as $cat) {
          $category_id = $cat->term_id;
          $thumbnail_id = get_term_meta( $category_id, 'thumbnail_id', true );
          $cat_image = wp_get_attachment_image_src( $thumbnail_id, 'manufacturer_medium' );  
          if ($cat->slug !== 'uncategorized') {
             
      ?>

      	<div class="man_woo_cat_item<?php if ($theme_options['shopsettings_centered'] == '1') {echo ' man_woo_cat_item_centered';} ?><?php if ($theme_options['shopsettings_square'] == '1') {echo ' man_woo_cat_item_square';} ?> col-md-<?php echo esc_attr($settings['sm_woo_cat_columns']); ?> col col-sm-6 col-12">
      		<a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>" class="man_image_bck" data-image="<?php echo esc_attr($cat_image[0]); ?>">
      			<span class="man_woo_cat_item_over"></span>
						<div class="man_woo_cat_item_cont">
							<h3 class="man_woo_cat_item_cont_name"><?php echo esc_attr($cat->name); ?></h3>
							<div class="man_woo_cat_item_cont_an <?php if ($cat->category_description !== ''){echo 'man_woo_cat_item_cont_anp';} ?>">
								<?php if ($cat->category_description !== ''): ?>
										<p><?php echo mb_strimwidth ($cat->category_description, 0, 60, '...'); ?></p>
								<?php endif ?>	
								<span class="btn btn_transparent"><?php echo __( 'View', 'smwidgets' ); ?><i class="ti ti-arrow-right"></i></span>
							</div>
						</div>
					</a>
      	</div>   
      
     <?php }} ?> 
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

		<div class="man_woo_cat row">
		<?php 
			$taxonomy  = 'product_cat';
      $empty = 0;
      $args = array(
          'taxonomy'     => $taxonomy,
          'hide_empty'   => $empty
      );
      $all_categories = get_categories( $args );
      foreach ($all_categories as $cat) {
          $category_id = $cat->term_id;
          $thumbnail_id = get_term_meta( $category_id, 'thumbnail_id', true );
          $cat_image = wp_get_attachment_image_src( $thumbnail_id, 'manufacturer_medium' );  
          if ($cat->slug !== 'uncategorized') {
             
      ?>
				
      	<div class="man_woo_cat_item col-md-{{ settings.sm_woo_cat_columns }} col-sm-6 col-12">
      		<a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>" class="man_image_bck" data-image="<?php echo esc_attr($cat_image[0]); ?>">
      			<span class="man_woo_cat_item_over"></span>
						<div class="man_woo_cat_item_cont">
							<h3 class="man_woo_cat_item_cont_name"><?php echo esc_attr($cat->name); ?></h3>
							<div class="man_woo_cat_item_cont_an <?php if ($cat->category_description !== ''){echo 'man_woo_cat_item_cont_anp';} ?>">
								<?php if ($cat->category_description !== ''): ?>
										<p><?php echo mb_strimwidth ($cat->category_description, 0, 40, '...'); ?></p>
								<?php endif ?>	
								<span class="btn">Open Category<i class="ti ti-arrow-right"></i></span>
							</div>
						</div>
					</a>
      	</div>   
      
     <?php }} ?> 
		</div> 
		
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
			});
		</script>

		<?php
	}
}



