<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Manufacturer
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h3 class="comments-title">
			<?php
			$manufacturer_comment_count = get_comments_number();
			if ( '1' === $manufacturer_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought', 'manufacturer' ),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought', '%1$s thoughts', $manufacturer_comment_count, 'comments title', 'manufacturer' ) ),
					number_format_i18n( $manufacturer_comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h3><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size'       => 126,
			) );
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'manufacturer' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	$defaults = array(
		'fields' => array(
			'author' => '<div class="row"><p class="comment-form-author comment-form-input col-md-4"><input id="author" name="author" type="text" value="" size="30" placeholder="'.esc_attr__( 'Name*', 'manufacturer' ).'" /></p>',
			'email' => '<p class="comment-form-email comment-form-input col-md-4"><input id="email" name="email" type="text" value="" size="30" placeholder="'.esc_attr__( 'E-mail*', 'manufacturer' ).'" /></p>',
			'url' => '<p class="comment-form-url comment-form-input col-md-4"><input id="url" name="url" type="text" value="" size="30" placeholder="'.esc_attr__( 'Website', 'manufacturer' ).'" /></p></div>',
		),
		'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8"  aria-required="true" required="required" placeholder="'.esc_attr__( 'Comment', 'manufacturer' ).'"></textarea></p>',
	);
	comment_form($defaults);
	?>

</div><!-- #comments -->
