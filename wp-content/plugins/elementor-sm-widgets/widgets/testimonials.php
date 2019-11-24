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



class Testimonials extends Widget_Base {

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
		return 'sm-testimonials';
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
		return __( 'Testimonials', 'smwidgets' );
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
		return 'eicon-blockquote';
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
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 5,
						'step' => 1,
					],
				],

			]
		);

		$this->add_control(
			'testimonials',
			[
				'label' => __( 'Testimonials', 'smwidgets' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'title_field' => '{{{ t_name }}}',
				'fields' => [
					[
						'name' => 't_name',
						'label' => __( 'Name', 'smwidgets' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( 'John S.Gates', 'smwidgets' ),
					],
					[
						'name' => 't_position',
						'label' => __( 'position', 'smwidgets' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
						'default' => __( 'Founder', 'smwidgets' ),
					],
					[
						'name' => 't_content',
						'label' => __( 'Content', 'smwidgets' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'default' => __( 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id', 'smwidgets' ),
					],
					[
						'name' => 't_image',
						'label' => __( 'Image', 'smwidgets' ),
						'type' => Controls_Manager::MEDIA,
						'label_block' => true,
					],
				],
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
	
	<div class="man_testimonials owl-carousel" data-items="<?php echo esc_attr($settings['box_items']['size']); ?>">
			
			<?php 
				foreach (  $settings['testimonials'] as $item ) {
			?>
				<div class="man_testimonials_item">
					<div class="man_testimonials_item_cont">
						<?php echo esc_attr($item['t_content']); ?>
					</div>
					<div class="man_testimonials_item_desc">
						<div class="man_testimonials_item_title_cont">
							<div class="man_testimonials_item_img man_image_bck">
								<?php echo wp_get_attachment_image($item['t_image']['id'],'thumbnail'); ?>
							</div>
							<div class="man_testimonials_item_title">
									<div class="man_testimonials_item_title_name"><?php echo esc_attr($item['t_name']); ?></div>
									<?php echo esc_attr($item['t_position']); ?>
							</div>
						</div>
					</div>
				</div>

			<?php
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


		<div class="man_testimonials owl-carousel" data-items="{{ settings.box_items.size }}">
			
			<# _.each( settings.testimonials, function( item ) { #>
				<div class="man_testimonials_item">
					<div class="man_testimonials_item_cont">
						{{ item.t_content }}
					</div>
					<div class="man_testimonials_item_desc">
						<div class="man_testimonials_item_title_cont">
							<div class="man_testimonials_item_img man_image_bck" data-image=""></div>
							<div class="man_testimonials_item_title">
									<div class="man_testimonials_item_title_name">{{ item.t_name }}</div>
									{{ item.t_position }}
							</div>
						</div>
					</div>
				</div>

			<# }); #>


	</div>
		
		

		<script>
			jQuery(document).ready(function($) {
				// Testimonials
				$('.man_testimonials').each(function(){
					var items = $(this).attr('data-items');
					$(this).owlCarousel({
						items:items,
						autoplay:0,
						dots:1,
						nav:1,
						navText:['<i class="ti ti-angle-left"></i>','<i class="ti ti-angle-right"></i>']
					});
				});
				$('.man_image_bck').each(function(){
					var image = $(this).attr('data-image');
					if (image){
						$(this).css('background-image', 'url('+image+')');	
					}
				});	
			});
		</script>

		<?php
	}
}



