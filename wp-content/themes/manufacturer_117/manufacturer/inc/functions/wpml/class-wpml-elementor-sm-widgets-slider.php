<?php

/**
 * Class WPML_Elementor_SM_Widgets_Slider
 */
class WPML_Elementor_SM_Widgets_Slider extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'slides';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'slider_title', 'slider_content', 'slider_btn_title', 'slider_btn_link' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'slider_title':
				return esc_html__( 'Slider Title', 'manufacturer' );

			case 'slider_content':
				return esc_html__( 'Slider Content', 'manufacturer' );

			case 'slider_btn_title':
				return esc_html__( 'Slider Button Text', 'manufacturer' );

			case 'slider_btn_link':
				return esc_html__( 'Slider Button: Link URL', 'manufacturer' );

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
			case 'slider_title':
				return 'LINE';
			case 'slider_content':
				return 'VISUAL';
			case 'slider_btn_title':
				return 'LINE';
			case 'slider_btn_link':
				return 'LINE';

			default:
				return '';
		}
	}

}
