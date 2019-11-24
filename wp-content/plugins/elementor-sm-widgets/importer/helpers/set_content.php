<?php
function stm_set_content_options( $layout ) {


	//Set pages
	update_option( 'show_on_front', 'page' );

	$front_page = get_page_by_title( 'Home' );
	if ( isset( $front_page->ID ) ) {
		update_option( 'page_on_front', $front_page->ID );
	}

	$possible_blog_pages = array(
		'Events',
		'Success Stories',
		'Blog',
		'News',
	);

	foreach ( $possible_blog_pages as $blog_page ) {
		$blog_page = get_page_by_title( $blog_page );
		if ( isset( $blog_page->ID ) ) {
			update_option( 'page_for_posts', $blog_page->ID );
		}
	}

	// Disable Elementor DEFAULT COLOR AND TYPOGRAPHY
	update_option( 'elementor_disable_color_schemes', 'yes' );
	update_option( 'elementor_disable_typography_schemes', 'yes' );
	update_option( 'elementor_load_fa4_shim', 'yes' );
	update_option( 'elementor_allow_svg', 'yes' );


}


