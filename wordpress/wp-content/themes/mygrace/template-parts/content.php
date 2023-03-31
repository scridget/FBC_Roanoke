<?php
/**
 * Template part for displaying default posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mygrace
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-default'); ?>>

	<header class="entry-header">
		<h3 class="entry-title"><?php 
			mygrace_sticky_label();
			the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
		?></h3>
		<div class="entry-meta">
			<?php
				mygrace_posted_by();
				mygrace_posted_in( array(
					'prefix' => __( 'In', 'mygrace' ),
				) );
				mygrace_posted_on( array(
					'prefix' => __( 'Posted', 'mygrace' )
				) );
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php mygrace_post_thumbnail( 'mygrace-thumb-l' ); ?>

	<?php mygrace_post_excerpt(); ?>

	<footer class="entry-footer">
		<div class="entry-meta">
			<?php
				mygrace_post_tags( array(
					'prefix' => ''
				) );
			?>
			<div><?php
				mygrace_post_comments( array(
					'prefix' => '<i class="fa fa-comment" aria-hidden="true"></i>',
					'class'  => 'comments-button'
				) );
				mygrace_post_link();
			?></div>
		</div>
		<?php mygrace_edit_link(); 
		?>
	</footer><!-- .entry-footer -->
	
</article><!-- #post-<?php the_ID(); ?> -->
