<?php 

// WooCommerce
add_theme_support( 'woocommerce', array() );

add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
	return array(
	'width' => 150,
	'height' => 150,
	'crop' => 0,
	);
} );

add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
	return array(
	'width' => 360,
	'height' => 280,
	'crop' => 1,
	);
} );
add_filter( 'woocommerce_get_image_size_single', function( $size ) {
	return array(
	'width' => 660,
	'height' => 660,
	'crop' => 0,
	);
} );




// Remove Additional Information Tab
add_filter( 'woocommerce_product_tabs', 'manufacturer_remove_product_tabs', 98 );
 
function manufacturer_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] ); 
    return $tabs;
}

// Remove Tabs Headers
add_filter('woocommerce_product_description_heading', '__return_null');
add_filter('yikes_woocommerce_custom_repeatable_product_tabs_heading', '__return_null');

// Extra Description

add_action( 'woocommerce_product_options_general_product_data', 'my_woo_custom_fields' );
/**
* Add a select Field at the bottom
*/
function my_woo_custom_fields() {
  $args = array(
	  'label' => '', // Text in Label
	  'placeholder' => '',
	  'class' => '',
	  'style' => '',
	  'wrapper_class' => '',
	  'value' => '', // if empty, retrieved from post meta where id is the meta_key
	  'id' => '', // required
	  'name' => '', //name will set from id if empty
	  'rows' => '',
	  'cols' => '',
	  'desc_tip' => '',
	  'custom_attributes' => '', // array of attributes 
	  'description' => ''
	);
	woocommerce_wp_textarea_input( $args );
}



// Labels
add_filter( 'woocommerce_product_add_to_cart_text' , 'custom_woocommerce_product_add_to_cart_text' );
function custom_woocommerce_product_add_to_cart_text() {
	global $product;

	$product_type = $product->get_type();
	if ($product->get_price() !== '') {
		switch ( $product_type ) {
			case 'external':
				return __( 'Buy product', 'manufacturer' );
			break;
			case 'grouped':
				return __( 'View products', 'manufacturer' );
			break;
			case 'simple':
				return __( 'Add to cart', 'manufacturer' );
			break;
			case 'variable':
				return __( 'Select options', 'manufacturer' );
			break;
			default:
				return __( 'Read more', 'manufacturer' );
		}  // end switch
	}else{
			return __( 'Read more', 'manufacturer' );
	}
	
}


function manufacturer_add_woocommerce_support() {
  add_theme_support( 'woocommerce' );
  add_theme_support( 'wc-product-gallery-zoom' );
  add_theme_support( 'wc-product-gallery-lightbox' );
  add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'manufacturer_add_woocommerce_support' );

// Remove Ratings
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// Add Category to the Title
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'manufacturer_woo_loop_product_title', 10 );
 
function manufacturer_woo_loop_product_title() {
    echo '<h3>' . get_the_title() . '</h3>';
    global $post;
    $terms = get_the_terms( $post->ID, 'product_cat' );
    if ( $terms && ! is_wp_error( $terms ) ) :
    //only displayed if the product has at least one category
        $cat_links = array();
        foreach ( $terms as $term ) {
            $cat_links[] = $term->name;
        }
        $on_cat = join( " ", $cat_links );
        ?>
        <span class="label-group">
            <?php echo esc_attr($on_cat); ?>
        </span>
    <?php endif;
}

// Remove Breadcrumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

// Remove Related Products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

    
// Add Related Tab
add_filter( 'woocommerce_product_tabs' , 'woocommerce_related_products_tab' );
function woocommerce_related_products_tab( $tabs ) {
	global $product;
	$product_id = $product->get_id();
	
	if ( count( wc_get_related_products($product_id)) > 1 ) {
		$tabs['related_products'] = array(
					'title'    => __( 'Related Products', 'manufacturer' ),
					'priority' => 25,
					'callback' => 'woocommerce_product_related_products_tab'
		);
	}
	

	return $tabs;

}



// Related Products callback
function woocommerce_product_related_products_tab() {
	global $theme_options;
 	
	

	if ( !isset($theme_options['shopsettings-related-columns']) ) {
	  $count = '3';
	}else{
		$count = $theme_options['shopsettings-related-columns'];
	}
	echo do_shortcode('[related_products columns="'.$count.'" limit="'.$count.'"]');
}

// Vertical Image
function woocommerce_get_product_vertical_thumbnail( $size = 'manufacturer_vertical_thumb' ) {
  global $post, $woocommerce;
  $output = '';

  if ( has_post_thumbnail() ) {               
      $output .= get_the_post_thumbnail( $post->ID, $size );
  } else {
       $output .= wc_placeholder_img( $size );
  }                       
  $output .= '';
  return $output;
}

// Default Image
function woocommerce_get_product_default_thumbnail( $size = 'manufacturer_medium' ) {
  global $post, $woocommerce;
  $output = '';

  if ( has_post_thumbnail() ) {               
      $output .= get_the_post_thumbnail( $post->ID, $size );
  } else {
       $output .= wc_placeholder_img( $size );
  }                       
  $output .= '';
  return $output;
}

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		global $theme_options;
		
		if ( isset($theme_options['shopsettings-columns']) ) {
			$count = $theme_options['shopsettings-columns'];
			return $count;
		}else{
			return 3; // 3 products per row
		}
	}
}



