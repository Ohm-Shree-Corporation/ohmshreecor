<?php

/**
 * Class WPML_Elementor_SM_Widgets_Default_Buttons
 */
class WPML_Elementor_SM_Widgets_Default_Buttons extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'buttons';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'text', 'link' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'text':
				return esc_html__( 'Button Text', 'manufacturer' );

			case 'link':
				return esc_html__( 'Button: Link URL', 'manufacturer' );

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
			case 'text':
				return 'LINE';
			case 'link':
				return 'LINE';

			default:
				return '';
		}
	}

}
