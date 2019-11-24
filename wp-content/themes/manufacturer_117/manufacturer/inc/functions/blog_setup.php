<?php
/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function manufacturer_custom_excerpt_length( $length ) {
    return 18;
}
add_filter( 'excerpt_length', 'manufacturer_custom_excerpt_length', 999 );

function manufacturer_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'manufacturer_excerpt_more' );


// Pagination
function man_navigation() {
  global $wp_query;
  $pages = '';
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $a['total'] = $max;
  $a['current'] = $current;

  $total = 1; 
  $a['mid_size'] = 3;
  $a['end_size'] = 1; 
  $a['prev_text'] = __( '<i class="ti ti-arrow-left"></i>Prev', 'manufacturer' );
  $a['next_text'] = __( 'Next<i class="ti ti-arrow-right"></i>', 'manufacturer' );

  if ($max > 1) echo '<div class="man_navigation">';
  echo esc_attr($pages) . paginate_links($a);
  if ($max > 1) echo '</div>';
}