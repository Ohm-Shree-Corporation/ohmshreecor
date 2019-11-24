<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Manufacturer
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<?php
	if ( is_singular() ) {
?>
	
		<div class="man_single_page">

			<?php the_post_thumbnail('manufacturer_full'); ?>


			<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'manufacturer' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'manufacturer' ),
				'after'  => '</div>',
			) );

			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer man_single_page_footer">
			<?php manufacturer_entry_footer(); ?>
		</footer><!-- .entry-footer -->


<?php 
	}else{
?>
	
	
	<div class="man_news_item_list row">
		<?php if (has_post_thumbnail()) {
		?>
		<div class="col-md-5 col-lg-5 man_news_item_photo_col">
			<div class="man_news_item_photo">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="man_image_bck" data-image="<?php the_post_thumbnail_url('manufacturer_medium'); ?>"></a>
			</div>
		</div>
		<?php 
		} 
		?>
		
		<div class="col-md-7 col-lg-7 man_news_item_cont_col <?php if (!has_post_thumbnail()) { echo ' man_news_item_cont_list_full';}?>">
			<div class="man_news_item_cont_list">
				<div class="man_news_item_title">
					<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
				</div>
				<div class="man_news_item_txt">
					<?php
					the_excerpt();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'manufacturer' ),
						'after'  => '</div>',
					) );
					?>
				</div>
				<div class="man_news_item_tech">
					<div class="man_news_item_date">
						<a href="<?php echo esc_url( get_permalink() ); ?>"><i class="ti ti-arrow-circle-right"></i><?php echo esc_attr__( 'Read More', 'manufacturer' ); ?></a>
						<span><?php manufacturer_posted_on();?></span>
						<?php manufacturer_entry_footer(); ?>

					</div>
					
				</div>
			</div>
		</div>
		
	</div>

<?php 
	}
?>

	

	
</article><!-- #post-<?php the_ID(); ?> -->
