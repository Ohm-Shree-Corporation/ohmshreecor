<?php
function manufacturer_header_footer_elementor_support() {
	add_theme_support( 'header-footer-elementor' );
}

add_action( 'after_setup_theme', 'manufacturer_header_footer_elementor_support' );