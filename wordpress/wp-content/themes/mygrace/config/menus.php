<?php
/**
 * Menus configuration.
 *
 * @package Mygrace
 */

add_action( 'after_setup_theme', 'mygrace_register_menus', 5 );
function mygrace_register_menus() {

	register_nav_menus( array(
		'main'   => esc_html__( 'Main', 'mygrace' ),
		'footer' => esc_html__( 'Footer', 'mygrace' ),
		'social' => esc_html__( 'Social', 'mygrace' ),
	) );
}
