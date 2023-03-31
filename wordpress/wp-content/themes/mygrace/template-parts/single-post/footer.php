<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mygrace
 */

if ( ! has_tag() ) {
	return;
}

?>
<footer class="entry-footer">
	<div class="entry-footer-container">
		<div class="entry-meta">
			<div class="entry">
				<?php
					mygrace_posted_by( array( 
							'prefix' => esc_html__( 'by', 'mygrace' ),
						 )
					);
					mygrace_post_tags();
				?>
			</div>
			<?php echo apply_filters( 'mygrace-theme/post/entry-meta', '' ); ?> 
		</div>
	</div>
</footer><!-- .entry-footer -->
