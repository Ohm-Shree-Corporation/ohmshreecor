<?php

/**
 * Class WPML_Elementor_SM_Widgets_Advantages
 */
class WPML_Elementor_SM_Widgets_Advantages extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'boxes';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'box_pre_title', 'box_title', 'box_content', 'box_btn', 'box_btn_link' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'box_pre_title':
				return esc_html__( 'Advantages Box Pre Title', 'manufacturer' );

			case 'box_title':
				return esc_html__( 'Advantages Box Title', 'manufacturer' );

			case 'box_content':
				return esc_html__( 'Advantages Box Content', 'manufacturer' );

			case 'box_btn':
				return esc_html__( 'Advantages Box Button Text', 'manufacturer' );

			case 'box_btn_link':
				return esc_html__( 'Advantages Box Button: Link URL', 'manufacturer' );


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
			case 'box_pre_title':
				return 'LINE';
			case 'box_title':
				return 'LINE';
			case 'box_content':
				return 'AREA';
			case 'box_btn':
				return 'LINE';
			case 'box_btn_link':
				return 'LINE';

			default:
				return '';
		}
	}

}
