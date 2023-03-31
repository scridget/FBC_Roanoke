<?php
/**
 * Post content template (fallback for single location)
 */

$pf = get_post_format();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
	get_template_part( 'template-parts/single-post/header', get_post_format() );
	mygrace_post_thumbnail( 'mygrace-thumb-xl', array( 'link' => false ) );
	get_template_part( 'template-parts/single-post/content', $pf );
	get_template_part( 'template-parts/single-post/footer' );
	get_template_part( 'template-parts/single-post/post_navigation' );

?></article><?php

get_template_part( 'template-parts/single-post/content-author-bio' );
get_template_part( 'template-parts/single-post/comments' );
mygrace_related_posts();