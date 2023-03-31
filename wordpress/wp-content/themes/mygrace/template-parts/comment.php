<?php do_action( 'mygrace-theme/comments/comment-before' ); ?>

<div class="comment-body__holder">
	<?php if ( ! empty( mygrace_comment_author_avatar() ) ) : ?>
		<div class="comment-author vcard">
			<?php echo mygrace_comment_author_avatar( array(
				'size' => 60
			) ); ?>
		</div>
	<?php endif; ?>
	<div class="comment-content-wrap">
		<div class="comment-meta">
			<div class="comment-metadata">
				<?php echo mygrace_get_comment_author_link(); ?>
				<?php echo mygrace_get_comment_reply_link(); ?>
			</div>

				<?php echo mygrace_get_comment_date(); ?>
		</div>
		<div class="comment-content">
			<?php echo mygrace_get_comment_text(); ?>
		</div>
	</div>
</div>

<?php do_action( 'mygrace-theme/comments/comment-after' ); ?>