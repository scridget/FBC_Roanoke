<?php
/**
 * The template for displaying author bio.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Mygrace
 */

$is_enabled 			= mygrace_theme()->customizer->get_value( 'post_authorbio_block' );
$author_description 	= get_the_author_meta( 'description' );

if ( ! $is_enabled || empty( $author_description ) ) {
	return;
}

?>

<div class="post-author-bio">
	<div class="post-author__holder">
		<div class="post-author__avatar"><?php
			mygrace_get_post_author_avatar( array(
				'size' => 120
			) );
		?></div>
		<div class="post-author__content">
			<h5 class="post-author__title"><?php
				mygrace_get_post_author();
			?></h5>
			<div class="post-author__role"><?php
				echo esc_html__( 'About Author', 'mygrace' );
			?></div>
			<div class="post-author__description"><?php
				echo esc_html( $author_description );
			?></div>
			<?php echo apply_filters( 'mygrace-theme/post/entry-meta', '' );?>
		</div>
		<div class="post-author__overlay"></div>
	</div>
</div>