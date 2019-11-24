<?php
/**
 * Template for displaying search forms in Manufacturer
 *
 * @package WordPress
 * @subpackage Manufacturer
 * @since 1.0
 * @version 1.0
 */

?>
<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
	<div>
		<label class="screen-reader-text" for="<?php echo esc_attr($unique_id); ?>"><?php echo esc_attr__( 'Search for:', 'manufacturer' ); ?></label>
		<input type="text" value="<?php get_search_query(); ?>" id="<?php echo esc_attr($unique_id); ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search', 'manufacturer' ); ?>"  name="s" />
		<button type="submit" class="man_search_btn">
			<i class="ti ti-search"></i>
		</button>
	</div>
</form>
