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



class Advantages extends Widget_Base {

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
		return 'sm-advantages';
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
		return __( 'Advantages', 'smwidgets' );
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
		return 'eicon-banner';
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
			'sm_adv_box',
			[
				'label' => __( 'Content', 'smwidgets' ),
			]
		);

		$this->add_control(
			'box_items',
			[
				'label' => __( 'Items', 'smwidgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 5,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				

			]
		);

		

		$this->add_control(
			'boxes',
			[
				'label' => __( 'Boxes', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'title_field' => '{{{ box_title }}}',
				'fields' => [
					[
						'name' => 'box_pre_title',
						'label' => __( 'Before Title', 'smwidgets' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( '01', 'smwidgets' ),
					],
					[
						'name' => 'box_title',
						'label' => __( 'Title', 'smwidgets' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( 'Title', 'smwidgets' ),
					],
					[
						'name' => 'box_content',
						'label' => __( 'Content', 'smwidgets' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'default' => __( 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id', 'smwidgets' ),
					],
					[
						'name' => 'box_btn',
						'label' => __( 'Button Text', 'smwidgets' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( 'More Info', 'smwidgets' ),
					],
					[
						'name' => 'box_btn_link',
						'label' => __( 'Button Link', 'smwidgets' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( '#', 'smwidgets' ),
					],
					[
						'name' => 'box_image',
						'label' => __( 'Image', 'smwidgets' ),
						'type' => Controls_Manager::MEDIA,
						'label_block' => true,
					],
				],
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
			'sm_adv_style',
			[
				'label' => __( 'Style', 'smwidgets' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'block_color',
			[
				'label' => __( 'Block Color', 'smwidgets' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ff2153',
				'selectors' => [
					'{{WRAPPER}} .man_adv_box_block_cont' => 'background-color: {{VALUE}};',
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
	
	<div class="man_advantages">

			<div class="man_adv_carousel owl-carousel" data-items="<?php echo esc_attr($settings['box_items']['size']); ?>">

			<?php 
				foreach (  $settings['boxes'] as $item ) {
			?>
			<div class="man_adv_box" id="<?php echo esc_attr($item['_id']); ?>">
				<div class="man_adv_box_img man_image_bck man_adv_box_img_<?php echo esc_attr($item['_id']); ?>" data-image="<?php echo esc_attr(wp_get_attachment_image_url( $item['box_image']['id'], 'manufacturer_full' )); ?>"></div>
				<div class="man_adv_box_block">
					<div class="man_adv_box_block_cont_wb man_wht_txt">
						<h4><?php echo esc_attr($item['box_pre_title']); ?></h4>
						<h2><?php echo esc_attr($item['box_title']); ?></h2>
					</div>
					<div class="man_adv_box_block_cont man_wht_txt">
						<h4><?php echo esc_attr($item['box_pre_title']); ?></h4>
						<h2><?php echo esc_attr($item['box_title']); ?></h2>
						<p><?php echo esc_attr($item['box_content']); ?></p>
						<a href="<?php if ($settings['related_link'] == 'yes'): ?><?php echo esc_url(get_home_url()); ?><?php endif ?><?php echo esc_url($item['box_btn_link']); ?>" class="btn btn_transparent"><?php echo esc_attr($item['box_btn']); ?><i class="ti ti-arrow-right"></i></a>
					</div>
					
				</div>
				
			</div>

			<?php
			}
			?>
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
		
		<div class="man_advantages">

			<div class="man_adv_carousel owl-carousel" data-items="{{ settings.box_items.size }}">
			<# _.each( settings.boxes, function( item ) { #>	

			<div class="man_adv_box" id="{{ item._id }}">
				<div class="man_adv_box_img man_image_bck sm_adv_box_img_{{ item._id }}" data-image="{{ item.box_image.url }}"></div>
				<div class="man_adv_box_block">
					<div class="man_adv_box_block_cont_wb sm_wht_txt">
						<h4>{{ item.box_pre_title }}</h4>
						<h2>{{ item.box_title }}</h2>
					</div>
					<div class="man_adv_box_block_cont sm_wht_txt">
						<h4>{{ item.box_pre_title }}</h4>
						<h2>{{ item.box_title }}</h2>
						<p>{{ item.box_content }}</p>
						<a href="{{ item.box_btn_link }}" class="btn btn_transparent">{{ item.box_btn }}<i class="ti ti-arrow-right"></i></a>
					</div>
					
				</div>
				
			</div>

			<# }); #>
		</div>

	</div>


		<script>
			jQuery(document).ready(function($) {
					// Advantages
					$('.man_adv_carousel .man_adv_box_img').each(function(i, el){
						if ( i === 0) {
								$(el).addClass('first-item');
						}
						$(this).insertBefore($(this).parents('.elementor-container'));
					});
					$('.man_adv_box').on({
						mouseenter:function(){
							var box_id = $(this).attr('id');
							$('.man_adv_box_img_'+box_id+'').addClass('active');
						},mouseleave:function(){
							var box_id = $(this).attr('id');
							$('.man_adv_box_img_'+box_id+'').removeClass('active');
						}
					});
					$('.man_adv_carousel').each(function(){
						var items = $(this).attr('data-items')
						$(this).owlCarousel({
							items:items,
							autoplay:0,
							dots:1,
							nav:1,
							navText:['<i class="ti ti-angle-left"></i>','<i class="ti ti-angle-right"></i>']
						});
					});
				
			});
		</script>
		

		<?php
	}
}



