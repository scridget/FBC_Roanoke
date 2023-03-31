<?php

/**
 * Include widgets
 */

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/widget-posts.php';

/**
 * Register widgets
 */

function mygrace_core_register_widgets() {
	register_widget( 'Mygrace_Core_Widget_Posts' );
}

add_action( 'widgets_init', 'mygrace_core_register_widgets' );

/**
 * Sanitize text field
 */

function mygrace_core_sanitize_text_field($text) {
	return $text;
}