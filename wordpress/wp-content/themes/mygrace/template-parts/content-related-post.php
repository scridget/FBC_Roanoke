<?php
/**
 * The template for displaying related posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Mygrace
 * @subpackage single-post
 */

$columns 		= mygrace_theme()->customizer->get_value( 'related_posts_grid' );
$thumb_class 	= ( has_post_thumbnail() && $settings['image_visible'] ) ? 'has-thumb' : 'no-thumb';
$post_comments_enabled = mygrace_theme()->customizer->get_value( 'related_posts_comment_count' );
$post_posted_by_enabled = mygrace_theme()->customizer->get_value( 'related_posts_author' );
?>

<div class="<?php echo esc_attr( $grid_class ); ?>">
	<article class="related-post hentry <?php echo esc_attr( $thumb_class ); ?>">
		<?php
			if ( $settings['image_visible'] ) {
				mygrace_blog_thumbnail(
					'mygrace-thumb-related',
					array( 'visible' => $settings['image_visible'] )
				);
			}
		?>
		<div class="related-post__content">
			<header class="entry-header">

				<div class="entry-meta"><?php
					mygrace_posted_on( array(
						'visible' 	=> $settings['date_visible'],
						'prefix' 	=> ''
					) );
									
				?></div><!-- .entry-meta -->

				<?php if ( $settings['title_visible'] ) :
					printf(
						'<h5 class="entry-title"><a href="%s" rel="bookmark">%s</a></h5>',
						esc_url( get_permalink() ),
						get_the_title()
					);
				endif; ?>
				
			</header><!-- .entry-header -->

				<?php mygrace_post_excerpt( array(
					'visible' 		=> $settings['excerpt_visible'],
					'words_count' 	=> $settings['excerpt_length']
				)); ?>


			<?php if( $post_comments_enabled || $post_posted_by_enabled) {
			
			 ?> <footer class="entry-footer">
				<div class="entry-meta"><?php
					mygrace_posted_by( array(
						'visible' 	=> $settings['author_visible'],
						'prefix' 	=> esc_html__( 'by', 'mygrace' ),
					) );

					mygrace_post_comments( array(
						'visible' 	=> $settings['comment_count_visible'],
						'prefix' 	=> mygrace_get_icon_svg( 'comment' ),
						'postfix' 	=> ''
					) );
					
				?></div><!-- .entry-meta -->
			</footer><!-- .entry-footer --><?php }
			?>
		</div>
	</article><!--.related-post-->
</div>
