<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Mygrace
 */

if ( ! function_exists( 'mygrace_post_excerpt' ) ) :
	/**
	 * Prints HTML with excerpt.
	 */
	function mygrace_post_excerpt( $args = array() ) {
		$default_args = array(
			'before' 		=> '<div class="entry-content">',
			'after' 		=> '</div>',
			'words_count' 	=> '18',
			'echo' 			=> true,
			'visible' 		=> true
		);
		$args = wp_parse_args( $args, $default_args );
		$args = apply_filters( 'mygrace_posted_on_args', $args );

		$visible = filter_var( $args['visible'], FILTER_VALIDATE_BOOLEAN );

		if( ! is_singular( 'post' ) ) {
			$visible = mygrace_theme()->customizer->get_value( 'blog_post_excerpt' );
			$args['words_count'] = mygrace_theme()->customizer->get_value( 'blog_post_excerpt_words_count' );
		}

		if ( ! $visible ) {
			return false;
		}

		$excerpt = str_replace("&nbsp;",'', wp_trim_words( get_the_excerpt(), $args['words_count'], '...' ) );

		if ( ! $excerpt ) {
			return;
		}

		$excerpt_output = apply_filters(
			'mygrace-theme/post/excerpt-output',
			$args['before'] . $excerpt . $args['after']
		);

		if ( $args['echo'] ) {
			echo wp_kses_post( $excerpt_output );
		} else {
			return $excerpt_output;
		}
	}
endif;

if ( ! function_exists( 'mygrace_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function mygrace_posted_on( $args = array() ) {
		if ( 'post' === get_post_type() ) {

			$default_args = array(
				'prefix' 	=> '',
				'format' 	=> get_option( 'date_format' ),
				'before' 	=> '<span class="posted-on">',
				'after' 	=> '</span>',
				'echo' 		=> true,
				'visible' 	=> ! is_singular( 'post' ) ? mygrace_theme()->customizer->get_value( 'blog_post_publish_date' ) : mygrace_theme()->customizer->get_value( 'single_post_publish_date' ),
			);
			
			$args = wp_parse_args( $args, $default_args );
			$args = apply_filters( 'mygrace_posted_on_args', $args );

			$visible = filter_var( $args['visible'], FILTER_VALIDATE_BOOLEAN );

			if ( ! $visible ) {
				return false;
			}

			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date( $args['format'] ) )
			);

			$posted_on = sprintf(
				/* translators: %s: post date. */
				esc_html_x( '%s', 'post date', 'mygrace' ),
				$time_string
			);

			$date_output = apply_filters(
				'mygrace-theme/post/date-output',
				$args['before'] . $args['prefix'] . ' ' . $posted_on . $args['after']
			);

			$allowed_html = array(
				'time' => array(
					'datetime' => true,
				),
				'svg'   => array(
					'class' => true,
					'aria-hidden' => true,
					'aria-labelledby' => true,
					'role' => true,
					'xmlns' => true,
					'width' => true,
					'height' => true,
					'viewbox' => true, // <= Must be lower case!
				),
				'g'     => array( 'fill' => true ),
				'title' => array( 'title' => true ),
				'path'  => array( 'd' => true, 'fill' => true,  ),
			);

			if ( $args['echo'] ) {
				echo wp_kses( $date_output, mygrace_kses_post_allowed_html( $allowed_html ) );
			} else {
				return $date_output;
			}
		}
	}
endif;

if ( ! function_exists( 'mygrace_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function mygrace_posted_by( $args = array() ) {
		if ( 'post' === get_post_type() ) {

			$default_args = array(
				'prefix' 	=> esc_html__( 'by', 'mygrace' ),
				'before' 	=> '<span class="byline">',
				'after' 	=> '</span>',
				'echo' 		=> true,
				'visible' 	=> ! is_singular( 'post' ) ? mygrace_theme()->customizer->get_value( 'blog_post_author' ) : mygrace_theme()->customizer->get_value( 'single_post_author' ),
			);

			$args = wp_parse_args( $args, $default_args );
			$args = apply_filters( 'mygrace_posted_by_args', $args );

			$visible = filter_var( $args['visible'], FILTER_VALIDATE_BOOLEAN );

			if ( ! $visible ) {
				return false;
			}

			mygrace_get_post_author( $args );
		}
	}
endif;

if ( ! function_exists( 'mygrace_posted_in' ) ) :
	/**
	 * Prints HTML with meta information for the current categories.
	 */
	function mygrace_posted_in( $args = array() ) {
		if ( 'post' === get_post_type() ) {

			$default_args = array(
				'prefix' 	=> '',
				'delimiter' => ' ',
				'before' 	=> '<span class="cat-links">',
				'after' 	=> '</span>',
				'visible' 	=> true
			);
			$args = wp_parse_args( $args, $default_args );
			$args = apply_filters( 'mygrace_post_thumbnail_args', $args );

			$visible = filter_var( $args['visible'], FILTER_VALIDATE_BOOLEAN );

			if ( ! $visible ) {
				return false;
			}

			$categories_list = get_the_category_list( esc_html( $args['delimiter'] ) );
			if ( $categories_list ) {
				$categories = sprintf(
					/* translators: 1: list of categories. */
					esc_html__( '%s', 'mygrace' ),
					$categories_list
				);

				echo apply_filters(
					'mygrace-theme/post/categories-output',
					$args['before'] . $args['prefix'] . ' ' . $categories . $args['after']
				);
			}
		}
	}
endif;

if ( ! function_exists( 'mygrace_post_tags' ) ) :
	/**
	 * Prints HTML with meta information for the current tags.
	 */
	function mygrace_post_tags( $args = array() ) {
		if ( 'post' !== get_post_type() ) {
			return false;
		}

		$default_args = array(
			'prefix'    => '',
			'delimiter' => '',
			'before'    => '<span class="tags-links">',
			'after'     => '</span>',
			'visible'   => ! is_singular( 'post' ) ? mygrace_theme()->customizer->get_value( 'blog_post_tags' ) : mygrace_theme()->customizer->get_value( 'single_post_tags' ),
		);

		$args = wp_parse_args( $args, $default_args );
		$args = apply_filters( 'mygrace_post_tags_args', $args );

		$visible = filter_var( $args['visible'], FILTER_VALIDATE_BOOLEAN );

		if ( ! $visible ) {
			return false;
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( $args['delimiter'], 'list item separator', 'mygrace' ) );
		if ( $tags_list ) {
			$tags = sprintf(
				/* translators: 1: list of tags. */
				esc_html__( '%s', 'mygrace' ),
				$tags_list
			);

			echo apply_filters(
				'mygrace-theme/post/tags-output',
				$args['before'] . $args['prefix'] . ' ' . $tags . $args['after']
			);
		}
	}
endif;

if ( ! function_exists( 'mygrace_post_comments' ) ) :
	/**
	 * Prints HTML with meta information for the current comments.
	 */
	function mygrace_post_comments( $args = array() ) {
		if ( 'post' !== get_post_type() ) {
			return false;
		}

		$comment_count = get_comments_number('0', '1', '%');
		if ( $comment_count == 1 ) {
			$postfix = esc_html__( 'Comment', 'mygrace' );
		} else {
			$postfix = esc_html__( 'Comments', 'mygrace' );
		}

		$default_args = array(
			'class' 	=> '',
			'prefix' 	=> '',
			'before' 	=> '<span class="comments-link">',
			'after' 	=> '</span>',
			'postfix' 	=> $postfix,
			'visible' => ! is_singular( 'post' ) ? mygrace_theme()->customizer->get_value( 'blog_post_comments' ) : mygrace_theme()->customizer->get_value( 'single_post_comments' ),
		);

		$args = wp_parse_args( $args, $default_args );
		$args = apply_filters( 'mygrace_post_comments_args', $args );

		$visible = filter_var( $args['visible'], FILTER_VALIDATE_BOOLEAN );

		$post_comments_visible = $visible && ! post_password_required() && ( comments_open() || get_comments_number() );
		$post_comments_visible = apply_filters( 'mygrace_post_comments_visible', $post_comments_visible, $args );

		if ( ! $post_comments_visible ) {
			return false;
		}

		global $post;

		$count = $post->comment_count;
		$link = get_comments_link();

		if ( $args['prefix'] ) {
			$args['prefix'] .= ' ';
		}

		if ( $args['postfix'] ) {
			$args['postfix'] = ' ' . $args['postfix'];
		}

		echo apply_filters(
			'mygrace-theme/post/comments-output',
			$args['before'] . '<a href="' . esc_attr( $link ) . '" class="' . esc_attr( $args['class'] ) . '">' . $args['prefix'] . $count . $args['postfix'] . '</a>' . $args['after']
		);
	}
endif;

if ( ! function_exists( 'mygrace_get_post_author' ) ) :
	/*
	* Display a post author.
	*/
	function mygrace_get_post_author( $args = array() ) {
		$default_args = array(
			'prefix' 	=> '',
			'before' 	=> '<span class="author">',
			'after' 	=> '</span>',
			'link' 		=> true,
			'echo' 		=> true
		);
		$args = wp_parse_args( $args, $default_args );

		global $post;
		$author_id = $post->post_author;

		$author_output = $args['before'];
		if ( $args['prefix'] ) {
			$author_output .= $args['prefix'] . ' ';
		}
		if ( $args['link'] ) {
			$author_output .= '<a href="' . esc_url( get_author_posts_url( $author_id ) ) . '">';
		}
		$author_output .= esc_html( get_the_author_meta( 'display_name' , $author_id ) );
		if ( $args['link'] ) {
			$author_output .= '</a>';
		}
		$author_output .= $args['after'];

		$author_output = apply_filters(
			'mygrace-theme/post/author-output',
			$author_output
		);

		$allowed_html = array(
			'svg'   => array(
				'class' => true,
				'aria-hidden' => true,
				'aria-labelledby' => true,
				'role' => true,
				'xmlns' => true,
				'width' => true,
				'height' => true,
				'viewbox' => true, // <= Must be lower case!
			),
			'g'     => array( 'fill' => true ),
			'title' => array( 'title' => true ),
			'path'  => array( 'd' => true, 'fill' => true,  ),
		);

		if ( $args['echo'] ) {
			echo wp_kses( $author_output, mygrace_kses_post_allowed_html( $allowed_html ) );
		} else {
			return $author_output;
		}
	}
endif;

if ( ! function_exists( 'mygrace_get_post_author_avatar' ) ) :
	/*
	* Display a post author avatar.
	*/
	function mygrace_get_post_author_avatar( $args = array() ) {
		$default_args = array(
			'before' 	=> '',
			'after' 	=> '',
			'size' 		=> 128,
			'echo' 		=> true
		);
		$args = wp_parse_args( $args, $default_args );

		global $post;
		$author_id = $post->post_author;

		$avatar_output = $args['before'];
		
		$avatar_output .= apply_filters(
			'mygrace-theme/post/avatar-output',
			get_avatar( get_the_author_meta( 'user_email', $author_id ), $args['size'], '', esc_attr( get_the_author_meta( 'nickname', $author_id ) ) )
		);
		
		$avatar_output .= $args['after'];

		$allowed_html = array(
			'img' => array(
				'srcset' => true,
			),
			'noscript' => array(),
		);

		if ( $args['echo'] ) {
			echo wp_kses( $avatar_output, mygrace_kses_post_allowed_html( $allowed_html ) );
		} else {
			return $avatar_output;
		}
	}
endif;

if ( ! function_exists( 'mygrace_get_author_role_name' ) ) :
	/*
	* Display a post author role.
	*/
	function mygrace_get_author_role_name() {
		
		global $authordata;

		$author_roles = $authordata->roles;
		$role = array_shift($author_roles);
		$wp_roles = wp_roles();
		$role_name = $wp_roles->role_names[$role];

		echo esc_html( $role_name );
	}
endif;

if ( ! function_exists( 'mygrace_post_link' ) ) :
	function mygrace_post_link( $args = array() ) {

		$default_args = array(
			'postfix' 	=> '',
			'class' => '',
		);

		$args = wp_parse_args( $args, $default_args );

		$post_link_type 	= mygrace_theme()->customizer->get_value( 'blog_read_more_type' );

		if ( ! $post_link_type ) {
			return;
		}

		if ( $args['class'] ) {
			$args['class'] = 'class="' . esc_attr( $args['class'] ) .'"';
		}

		if ( $args['postfix'] ) {
			$args['postfix'] = ' ' . $args['postfix'];
		}

		$link 				= get_permalink();
		$title 				= mygrace_theme()->customizer->get_value( 'blog_read_more_text' );
		$post_link_output 	= '<a href="' . esc_url( $link ) . '" ' . $args['class'] . '>' . $args['postfix'] . esc_html( $title ) . '</a>';

		echo apply_filters(
			'mygrace-theme/post/link-output',
			$post_link_output
		);
	}
endif;

if ( ! function_exists( 'mygrace_edit_link' ) ) :
	function mygrace_edit_link() {
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'mygrace' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'mygrace_post_overlay_thumbnail' ) ) :
/**
 * Displays post thumbnail as tag style
 *
 * @return string
 */
function mygrace_post_overlay_thumbnail( $img_size = 'mygrace-thumb-xl', $postID = null ) {
	$thumbnail = apply_filters(
		'mygrace-theme/post/overlay-thumb',
		get_the_post_thumbnail_url( $postID, $img_size )
	);

	if( $thumbnail ) {
		echo 'style="background-image: url(' . $thumbnail . ')"';
	}
}
endif;

if ( ! function_exists( 'mygrace_blog_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */

function mygrace_blog_thumbnail( $image_size = 'post-thumbnail', $args = array() ) {
	$default_args = array(
		'link'       => true,
		'class'      => 'post-thumbnail',
		'link-class' => 'post-thumbnail__link',
		'echo'       => true,
		'visible'    => true,
	);
	$args = wp_parse_args( $args, $default_args );
	$args = apply_filters( 'mygrace_post_thumbnail_args', $args );

	$visible = filter_var( $args['visible'], FILTER_VALIDATE_BOOLEAN );

	if ( ! $visible ) {
		return false;
	}

	$image_size = apply_filters(
		'mygrace-theme/post/thumb-image-size',
		$image_size
	);

	$thumb = '<figure class="' . esc_attr( $args['class'] ) . '">';

	if ( $args['link'] ) {
		$thumb .= '<a class="' . esc_attr( $args['link-class'] ) . '" href="' . esc_url( get_permalink() ) .'" aria-hidden="true">';
	}

	$thumb .= get_the_post_thumbnail( null, $image_size );

	if ( $args['link'] ) {
		$thumb .= '</a>';
	}
	$thumb .= '</figure>';

	$thumb = apply_filters(
		'mygrace-theme/post/thumb',
		$thumb
	);

	$allowed_html = array(
		'a' => array(
			'aria-hidden' => true,
		),
		'img' => array(
			'srcset' => true,
			'sizes'  => true,
		),
		'noscript' => array(),
	);

	if ( $args['echo'] ) {
		echo wp_kses( $thumb, mygrace_kses_post_allowed_html( $allowed_html ) );
	} else {
		return $thumb;
	}
}
endif;


if ( ! function_exists( 'mygrace_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */

function mygrace_post_thumbnail( $image_size = 'post-thumbnail', $args = array() ) {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	$default_args = array(
		'link'       => true,
		'class'      => 'post-thumbnail',
		'link-class' => 'post-thumbnail__link',
		'echo'       => true,
		'visible'    => true,
	);
	$args = wp_parse_args( $args, $default_args );
	$args = apply_filters( 'mygrace_post_thumbnail_args', $args );

	$visible = filter_var( $args['visible'], FILTER_VALIDATE_BOOLEAN );

	if ( ! $visible ) {
		return false;
	}

	$image_size = apply_filters(
		'mygrace-theme/post/thumb-image-size',
		$image_size
	);

	$thumb = '<figure class="' . esc_attr( $args['class'] ) . '">';
	if ( $args['link'] ) {
		$thumb .= '<a class="' . esc_attr( $args['link-class'] ) . '" href="' . esc_url( get_permalink() ) .'" aria-hidden="true">';
	}

	$thumb .= get_the_post_thumbnail( null, $image_size );

	if ( $args['link'] ) {
		$thumb .= '</a>';
	}
	$thumb .= '</figure>';

	$thumb = apply_filters(
		'mygrace-theme/post/thumb',
		$thumb
	);

	$allowed_html = array(
		'a' => array(
			'aria-hidden' => true,
		),
		'img' => array(
			'srcset' => true,
			'sizes'  => true,
		),
		'noscript' => array(),
	);

	if ( $args['echo'] ) {
		echo wp_kses( $thumb, mygrace_kses_post_allowed_html( $allowed_html ) );
	} else {
		return $thumb;
	}
}
endif;

/**
 * Displays post thumbnail placeholder
 *
 * @return string
 */
if ( ! function_exists( 'get_placeholder_url' ) ) :
	
	function get_placeholder_url( $args = array() ) {

		$args = wp_parse_args( $args, array(
			'width'      => 370,
			'height'     => 260,
			'background' => '558dd9',
			'foreground' => 'fff',
			'title'      => 'mygrace',
		) );

		$args      = array_map( 'urlencode', $args );
		$base_url  = 'http://fakeimg.pl';
		$format    = '%1$s/%2$sx%3$s/%4$s/%5$s/?text=%6$s';
		$image_url = sprintf(
			$format,
			$base_url, $args['width'], $args['height'], $args['background'], $args['foreground'], $args['title']
		);

		/**
		 * Filter image placeholder URL
		 *
		 * @param string $image_url Default URL.
		 * @param string $args      Image arguments.
		 */
		return esc_url( $image_url );
	}

endif;


if ( ! function_exists( 'mygrace_post_overlay_thumbnail' ) ) :
/**
 * Displays post thumbnail as tag style
 *
 * @return string
 */
function mygrace_post_overlay_thumbnail( $img_size = 'mygrace-thumb-xl', $postID = null ) {
	$thumbnail = apply_filters(
		'mygrace-theme/post/overlay-thumb',
		get_the_post_thumbnail_url( $postID, $img_size )
	);

	if( $thumbnail ) {
		echo 'style="background-image: url(' . esc_url( $thumbnail ) . ')"';
	}
}
endif;

if ( ! function_exists( 'mygrace_get_page_preloader' ) ) :
/**
 * Display the page preloader.
 *
 * @since  1.0.0
 * @return void
 */
function mygrace_get_page_preloader() {
	
	$page_preloader = mygrace_theme()->customizer->get_value( 'page_preloader' );

	if ( $page_preloader ) {

		echo '<div class="page-preloader-cover">';
		echo '<img class="preloader" src="'. get_template_directory_uri() . '/assets/images/preloader.svg' . '" alt="' . esc_attr( 'preloader', 'mygrace' ) . '"/>';
		echo '<div class="bar"></div>';
		echo '</div>';
	}
}
endif;

if ( ! function_exists( 'mygrace_header_bar_markup' ) ) :
	/**
	 * Header bar markup.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function mygrace_header_bar_markup(){
		$layout = mygrace_theme()->customizer->get_value( 'header_layout_type' );

		get_template_part( 'template-parts/header/layout', $layout );
	}
endif;
add_action( 'mygrace_header_bar', 'mygrace_header_bar_markup' );

if ( ! function_exists( 'mygrace_header_logo' ) ) :
/**
 * Display the header logo.
 *
 * @since  1.0.0
 * @return void
 */
function mygrace_header_logo() {
		
	$custom_logo_id = get_theme_mod( 'custom_logo' );

	$class = 'site-logo';

	$logo_retina_height = mygrace_theme()->customizer->get_value( 'logo_retina_height' );

	$custom_logo_attr = array();
	$image_retina_url = false;
	$retina_id = false;
	$retina_url = mygrace_theme()->customizer->get_value( 'logo_retina' );
	if ( $retina_url ) {
		$retina_id = attachment_url_to_postid( $retina_url );
		if ( $retina_id ) {
			$image_retina_url = wp_get_attachment_image_src( $retina_id, 'full' );
			if ( $image_retina_url ) {
				$custom_logo_attr['srcset'] = $image_retina_url[0] . ' 2x';
			}
		}
	}

	if ( ! $custom_logo_id ) {
		$custom_logo_id = $retina_id;
	}

	if ( $custom_logo_id ) {
		$image_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
		if ( empty( $image_alt ) ) {
			$custom_logo_attr['alt'] = get_bloginfo( 'name', 'display' );
		}

		if ( $retina_id ) {
			$class .= ' retina-logo';
		}

		$logo = wp_get_attachment_image( $custom_logo_id, 'full', false, $custom_logo_attr );

		$format = apply_filters(
			'mygrace-theme/header/logo-format',
			'<div class="%3$s"><a class="site-logo__link" href="%1$s" rel="home">%2$s</a></div>'
		);

	} else {

		$logo = get_bloginfo( 'name' );

		$format = apply_filters(
			'mygrace-theme/header/logo-format',
			'<h1 class="%3$s"><a class="site-logo__link" href="%1$s" rel="home">%2$s</a></h1>'
		);
	}


	printf( $format, esc_url( home_url( '/' ) ), $logo, $class );
}
endif;

if ( ! function_exists( 'mygrace_site_description' ) ) :
	/**
	 * Display the site description.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function mygrace_site_description() {
		$site_tagline 	= mygrace_theme()->customizer->get_value( 'site_tagline' );
		$description 	= get_bloginfo( 'description', 'display' );

		$visible = $site_tagline && $description;

		if ( ! $visible && ! is_customize_preview() ) {
			return;
		}

		$hidden = ! $visible ? ' hidden="hidden"' : '';

		printf( '<div class="site-description"%2$s><span class="site-description__text">%1$s</span></div>', esc_html( $description ), esc_attr( $hidden ) );
	}
endif;

if ( ! function_exists( 'mygrace_header_search_toggle' ) ) :
	/**
	 * Show header search toggle.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function mygrace_header_search_toggle() {
		$visible = mygrace_theme()->customizer->get_value( 'header_search_visible' );
		$visible_text = mygrace_theme()->customizer->get_value( 'header_search_text' );

		if ( ! $visible ) {
			return;
		}

		$search_output = apply_filters(
			'mygrace_header_search_toggle_format',
			'<button class="header-search-toggle">' . mygrace_get_icon_svg( 'search-header' ) . '<span class="header-search__text">' . esc_html( $visible_text ) . '</span></button>'
		);

		$allowed_html = array(
			'svg'   => array(
				'class' => true,
				'aria-hidden' => true,
				'aria-labelledby' => true,
				'role' => true,
				'xmlns' => true,
				'width' => true,
				'height' => true,
				'viewbox' => true, // <= Must be lower case!
			),
			'g'     => array( 'fill' => true ),
			'title' => array( 'title' => true ),
			'path'  => array( 'd' => true, 'fill' => true,  ),
		);

		echo wp_kses( $search_output, mygrace_kses_post_allowed_html( $allowed_html ) );
	}
endif;

if ( ! function_exists( 'mygrace_header_search_popup' ) ) :
	/**
	 * Show header search popup.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function mygrace_header_search_popup() {
		$visible = mygrace_theme()->customizer->get_value( 'header_search_visible' );

		if ( ! $visible ) {
			return;
		}

		get_template_part( 'template-parts/header/search-popup' );
	}
endif;

if ( ! function_exists( 'mygrace_site_description' ) ) :
/**
 * Display the site description.
 *
 * @since  1.0.0
 * @return void
 */
function mygrace_site_description() {
	$show_desc = mygrace_theme()->customizer->get_value( 'show_tagline' );

	if ( ! $show_desc ) {
		return;
	}

	$description = get_bloginfo( 'description', 'display' );

	if ( ! ( $description || is_customize_preview() ) ) {
		return;
	}

	$format = apply_filters( 'mygrace-theme/header/description-format', '<div class="site-description">%s</div>' );

	printf( $format, $description );
}
endif;

if ( ! function_exists( 'mygrace_header_btn' ) ) :
/**
 * Show Header btn.
 *
 * @since  1.0.0
 * @since  1.0.1 Added new param - $type.
 * @return void
 */

function mygrace_header_btn() {
	$btn_visibility = mygrace_theme()->customizer->get_value( 'header_btn_visibility' );
	$btn_text = mygrace_theme()->customizer->get_value( 'header_btn_text' );
	$btn_url = mygrace_theme()->customizer->get_value( 'header_btn_url' );
	$btn_target = mygrace_theme()->customizer->get_value( 'header_btn_target' );
	$btn_style = mygrace_theme()->customizer->get_value( 'header_btn_style' );

	if ( ! $btn_visibility ) {
		return;
	}

	if ( ! $btn_text || ! $btn_url ) {
		return;
	}

	$target = $btn_target ? ' target="_blank"' : '';

	$btn_style     = 'btn-' . $btn_style;

	$format = apply_filters( 'mygrace_header_btn_html_format', '<div class="header-btn-wrap"><a class="header-btn btn %4$s" href="%2$s"%3$s>%1$s</a></div>' );

	printf( $format, wp_kses( wp_unslash( $btn_text ), wp_kses_allowed_html( 'post' ) ), esc_url( mygrace_render_macros( $btn_url ) ), $target, $btn_style  );
}

endif;

if ( ! function_exists( 'mygrace_social_list' ) ) :
/**
 * Show Social list.
 *
 * @since  1.0.0
 * @since  1.0.1 Added new param - $type.
 * @return void
 */
function mygrace_social_list( $context = '', $type = 'icon' ) {
	$visibility_in_header = mygrace_theme()->customizer->get_value( 'header_social_links' );
	$visibility_in_footer = mygrace_theme()->customizer->get_value( 'footer_social_links' );

	if ( ! $visibility_in_header && ( 'header' === $context ) ) {
		return;
	}

	if ( ! $visibility_in_footer && ( 'footer' === $context ) ) {
		return;
	}

	echo mygrace_get_social_list( $context, $type );
}
endif;

if ( ! function_exists( 'mygrace_footer_logo' ) ) :
	/**
	 * Show footer logo, uploaded from customizer.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function mygrace_footer_logo(){
		$visible = mygrace_theme()->customizer->get_value( 'footer_logo_visible' );

		if ( ! $visible ) {
			return;
		}

		$logo_id = mygrace_theme()->customizer->get_value( 'footer_logo' );
		$logo_attr = array();

		if ( $logo_id ) {
			
			$url      = esc_url( home_url( '/' ) );
			$alt      = esc_attr( get_bloginfo( 'name' ) );
			$logo_src = wp_get_attachment_image_src( $logo_id, 'full' );

			$image_alt = get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true );
			if ( empty( $image_alt ) ) {
				$logo_attr['alt'] = get_bloginfo( 'name', 'display' );
			}

			$logo = wp_get_attachment_image( $logo_id, 'full', false, $logo_attr );

		} else {

			$logo = get_bloginfo( 'name' );

		}
		

		$format = apply_filters(
			'mygrace-theme/footer/logo-format',
			'<div class="footer-logo"><a class="footer-logo__link" href="%1$s" rel="home">%2$s</a></div>'
		);

		printf( $format, esc_url( home_url( '/' ) ), $logo );

	}
endif;

if ( ! function_exists( 'mygrace_footer_copyright' ) ) :
	/**
	 * Show footer copyright text.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function mygrace_footer_copyright() {
		$copyright 		= mygrace_theme()->customizer->get_value( 'footer_copyright' );

		$format = apply_filters(
			'mygrace-theme/footer/copyright-format',
			'<div class="footer-copyright">%1$s</div>'
		);

		if ( empty( $copyright ) ) {
			return;
		}

		printf( $format, wp_kses( mygrace_render_macros( $copyright ), wp_kses_allowed_html( 'post' ) ) );
	}
endif;

if ( ! function_exists( 'mygrace_blog_page_title' ) ) :
	/**
	 * Show blog page title text.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function mygrace_blog_page_title() {

		$visible = mygrace_theme()->customizer->get_value( 'page_title' );

		if ( ! $visible ){
			return;
		}

		$format = apply_filters(
			'mygrace-theme/page-title/page-title-format',
			'<div class="page-header"><h1 class="page-title h2-style">%1$s</h1></div>'
		);
							
		if ( is_front_page() || is_single() || class_exists('WooCommerce') && ( is_shop() || is_product_category() || is_product_tag() ) ) {
			
			$title = '';

		} else if  (is_search() ) {
			/* translators: %s: search query. */
			$title = esc_html__( 'Search Results for: ', 'mygrace' ) . '<span>' . esc_html( get_search_query() ) . '</span>';
		
		} else if  ( is_archive() ) {

			$title = get_the_archive_title();
		
		} else if  ( is_home() && ! is_front_page() ) {

			$title = get_the_title( get_option('page_for_posts', true) );
		}
		else {

			$title = get_the_title();
		}


		if( !empty($title)){
			printf( $format, $title );
		}
	}
endif;

add_action( 'mygrace-theme/site/title', 'mygrace_blog_page_title' );

if ( ! function_exists( 'mygrace_footer_newsletter_popup' ) ) :
	/**
	 * Show footer newsletter popup.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function mygrace_footer_newsletter_popup() {
		

		get_template_part( 'template-parts/footer/newsletter-popup' );
	}
endif;

if ( ! function_exists( 'mygrace_sticky_label' ) ) :
/**
 * Show sticky menu label grabbed from options.
 *
 * @since  1.0.0
 * @return void
 */
function mygrace_sticky_label() {
	if ( ! is_sticky() || is_paged() ) {
		return;
	}

	$sticky_type = mygrace_theme()->customizer->get_value( 'blog_sticky_type' );

	$content = '';

	$icon = apply_filters(
		'mygrace-theme/posts/sticky-icon',
		mygrace_get_icon_svg( 'sticky' )
	);

	switch ( $sticky_type ) {

		case 'icon':
		$content = $icon;
		break;

		case 'label':
		$label = mygrace_theme()->customizer->get_value( 'blog_sticky_label' );
		$content = $label;
		break;

		case 'both':
		$label = mygrace_theme()->customizer->get_value( 'blog_sticky_label' );
		$content = $icon . $label;
		break;
	}

	if ( empty( $content ) ) {
		return;
	}

	printf( '<span class="sticky-label type-%2$s">%1$s</span>', $content, $sticky_type );
}
endif;
