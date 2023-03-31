<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mygrace
 */

if ( ! get_theme_mod( 'single_post_navigation', mygrace_theme()->customizer->get_default( 'single_post_navigation' ) ) ) {
	return;
}

$in_same_cat = true;

$previous_post = get_previous_post( $in_same_cat );
$next_post     = get_next_post( $in_same_cat );

// Return if there're no previous or next posts.
if ( ! ( $previous_post || $next_post ) ) {
	return;
}

$post_ids = array();

if ( $previous_post ) {
	$post_ids[] = $previous_post->ID;
}

if ( $next_post ) {
	$post_ids[] = $next_post->ID;
}

$args = array(
	'post__in'            => $post_ids,
	'order'               => 'ASC',
	'ignore_sticky_posts' => true,
);

// Add filter for the query.
$the_query = new WP_Query( $args );

// Check if there're enough posts in the query.
if ( $the_query->have_posts() ) { ?>

	<nav class="navigation post-navigation">
		<h2 class="screen-reader-text"><?php echo esc_html__( 'Post navigation', 'mygrace' ); ?></h2>
		
		<div class="nav-links">
			
			<?php
			
			while ( $the_query->have_posts() ) :
				
				$the_query->the_post();
				$nav_class 		= '';
				$permalink 		= get_permalink();

				if ( $previous_post && get_the_ID() === $previous_post->ID ) {
					$nav_class 		.= 'prev';
				} elseif ( $next_post && get_the_ID() === $next_post->ID ) {
					$nav_class 		.= 'next';
				}

				$nav_classes 	= 'nav-' . esc_attr( $nav_class );
				?>

				<div class="<?php echo esc_attr( $nav_classes ); ?>">
					<a class="nav-links__item" href="<?php echo esc_url( $permalink ); ?>">
						<span>
							<?php echo mygrace_get_icon_svg( 'post-' . esc_attr( $nav_class ) ) ?>
						</span>
					</a>
				</div>
			<?php endwhile; ?>

			<?php if ( get_option( 'page_for_posts' ) ) {
			   echo '<a class="archive-page-links" href="' . esc_url(get_permalink( get_option( 'page_for_posts' ) )) . '">' .  mygrace_get_icon_svg( 'blog') . '</a>';
			} else {
			   echo '<a class="archive-page-links" href="' . esc_url( home_url( '/' ) ) . '">' .  mygrace_get_icon_svg( 'blog') . '</a>';
			} ?>

		</div>
	</nav>

	<?php wp_reset_postdata(); ?>

<?php
}