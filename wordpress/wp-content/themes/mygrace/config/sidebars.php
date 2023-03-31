<?php
/**
 * Sidebars configuration.
 *
 * @package Mygrace
 */

add_action( 'after_setup_theme', 'mygrace_register_sidebars', 5 );
function mygrace_register_sidebars() {

	mygrace_widget_area()->widgets_settings = apply_filters( 'mygrace-theme/widget_area/default_settings', array(
		'sidebar' => array(
			'name'           => esc_html__( 'Sidebar', 'mygrace' ),
			'description'    => esc_html__( 'List of widgets to display on blog post pages', 'mygrace' ),
			'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'   => '</aside>',
			'before_title'   => '<h6 class="widget-title">',
			'after_title'    => '</h6>',
			'before_wrapper' => '<div id="%1$s" %2$s role="complementary">',
			'after_wrapper'  => '</div>',
			'is_global'      => true,
		),
		'sidebar-shop' => array(
			'name'           => esc_html__( 'Shop Sidebar', 'mygrace' ),
			'description'    => esc_html__( 'List of widgets to display on Shop pages', 'mygrace' ),
			'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'   => '</aside>',
			'before_title'   => '<h6 class="widget-title">',
			'after_title'    => '</h6>',
			'before_wrapper' => '<div id="%1$s" %2$s role="complementary">',
			'after_wrapper'  => '</div>',
			'is_global'      => true,
		)
	) );
}
