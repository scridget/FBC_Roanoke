<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mygrace
 */

$categories_visible = mygrace_theme()->customizer->get_value( 'single_post_categories' );
?>
<header class="entry-header">
	<?php  mygrace_posted_in( array(
		'visible' 	=> $categories_visible,
		'prefix' 	=> '',
	) ); ?>
	<h1 class="entry-title h2-style"><?php 
		mygrace_sticky_label();
		the_title();
	?></h1>
	<?php get_template_part( 'template-parts/single-post/meta' ); ?>
</header><!-- .entry-header -->

