<?php

/**
 * Class WPML_Elementor_SM_Widgets_Timeline
 */
class WPML_Elementor_SM_Widgets_Testimonials extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'testimonials';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 't_name', 't_position', 't_content' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 't_name':
				return esc_html__( 'Testimonial Name', 'manufacturer' );

			case 't_position':
				return esc_html__( 'Testimonial Position', 'manufacturer' );

			case 't_content':
				return esc_html__( 'Testimonial Content', 'manufacturer' );

			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch( $field ) {
			case 't_name':
				return 'LINE';
			case 't_position':
				return 'LINE';
			case 't_content':
				return 'AREA';

			default:
				return '';
		}
	}

}
