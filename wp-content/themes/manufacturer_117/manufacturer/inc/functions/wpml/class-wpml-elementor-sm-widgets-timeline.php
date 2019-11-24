<?php

/**
 * Class WPML_Elementor_SM_Widgets_Timeline
 */
class WPML_Elementor_SM_Widgets_Timeline extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'pins';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'pin_title', 'pin_content' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'pin_title':
				return esc_html__( 'Timeline Pin Title', 'manufacturer' );

			case 'pin_content':
				return esc_html__( 'Timeline Pin Text', 'manufacturer' );

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
			case 'pin_title':
				return 'LINE';
			case 'pin_content':
				return 'VISUAL';

			default:
				return '';
		}
	}

}
