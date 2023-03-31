<?php
/**
 * Post single meta
 *
 * @package Mygrace
 */

$categories_visible = mygrace_theme()->customizer->get_value( 'single_post_categories' );

if ( 'post' === get_post_type() ) :
	
	echo '<div class="entry-meta">';
		
		mygrace_posted_on();
		mygrace_posted_by( array( 
			'prefix' =>  esc_html__( 'by', 'mygrace' ),
		));
		mygrace_post_comments( array(
			'prefix' 	=> mygrace_get_icon_svg( 'comment' ),
			'postfix' 	=> '',
		));

	echo '</div>';

endif;
