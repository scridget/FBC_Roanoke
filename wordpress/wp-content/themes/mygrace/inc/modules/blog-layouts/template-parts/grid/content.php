<?php
/**
 * Template part for displaying grid style of posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mygrace
 */
global $post;

$author_id = $post->post_author;

$sidebar 			= mygrace_theme()->customizer->get_value( 'blog_sidebar_position' );
$categories_visible = mygrace_theme()->customizer->get_value( 'blog_post_categories' );
$columns 			= mygrace_theme()->customizer->get_value( 'blog_layout_columns' );
$post_comments_enabled = mygrace_theme()->customizer->get_value( 'blog_post_comments' );
$post_tags_enabled = mygrace_theme()->customizer->get_value( 'blog_post_tags' );
$post_posted_by_enabled = mygrace_theme()->customizer->get_value( 'blog_post_author' );

$thumbnail 		= 'mygrace-thumb-listing';
if( ( 'none' == $sidebar ) && ( '2-cols' == $columns ) ) {
	$thumbnail 		= 'mygrace-thumb-listing';
} elseif( ( 'none' != $sidebar ) && ( '3-cols' == $columns ) ) {
	$thumbnail 		= 'mygrace-thumb-grid-3col';
} elseif( 'none' != $sidebar ) {
	$thumbnail 		= 'mygrace-thumb-grid-2col-sidebar';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item grid-item' ); ?>>

	<?php mygrace_blog_thumbnail( $thumbnail ); ?>
	
	<div class="posts-list__item-content">

		<header class="entry-header">
			<div class="entry-meta">
			<?php 

			mygrace_posted_in( array(
				'visible' 	=> $categories_visible,
			) );

			mygrace_posted_on();
			?></div>

		<h5 class="entry-title"><?php 
			mygrace_sticky_label();
			the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
		?></h5>
		</header><!-- .entry-header -->

		<?php mygrace_post_excerpt(); ?>

		<footer class="entry-footer">
			<?php
				mygrace_post_link( array(
					'class' 	=> 'btn-primary',
					'postfix' 	=> mygrace_get_icon_svg( 'arrow-btn' )
				) );
			?>
			<?php if( $post_comments_enabled || $post_tags_enabled || $post_posted_by_enabled) {
				?> <div class="entry-meta">
					<?php
						mygrace_posted_by( array( 
								'prefix' => esc_html__( 'in', 'mygrace' ),
							 )
						); 
						mygrace_post_comments( array(
							'prefix' 	=> mygrace_get_icon_svg( 'comment' ),
							'postfix' 	=> '',
						) );
						mygrace_post_tags();
					?>
				</div><?php }
			?>
		</footer><!-- .entry-footer -->
		<?php echo apply_filters( 'mygrace-theme/list/entry-meta', '' ); ?><!-- .entry-meta -->
	</div><!-- .posts-list__item-content -->
</article><!-- #post-<?php the_ID(); ?> -->
