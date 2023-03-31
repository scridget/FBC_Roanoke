<?php
/**
 * Template part for posts navigation.
 *
 * @package Mygrace
 */

do_action( 'mygrace-theme/blog/posts-navigation-before' );

the_posts_pagination(
	apply_filters( 'mygrace-theme/posts/navigation-args',
		array(
			'prev_text' => sprintf(
				'%1$s%2$s',
				mygrace_get_icon_svg( 'pagin-prev' ),
				esc_html__( 'Prev', 'mygrace' ) ),
			'next_text' => sprintf(
				'%1$s%2$s',
				esc_html__( 'Next', 'mygrace' ),
				mygrace_get_icon_svg( 'pagin-next' ) ),
		)
	)
);

do_action( 'mygrace-theme/blog/posts-navigation-after' );
