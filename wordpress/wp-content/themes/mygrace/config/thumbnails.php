<?php
/**
 * Thumbnails configuration.
 *
 * @package mygrace
 */

add_action( 'after_setup_theme', 'mygrace_register_image_sizes', 5 );
/**
 * Register image sizes.
 */
function mygrace_register_image_sizes() {
	set_post_thumbnail_size( 370, 260, true );

	// Registers a new image sizes.
	add_image_size( 'mygrace-thumb-m', 370, 280, true );

	add_image_size( 'mygrace-thumb-xl', 1150, 670, true );
	
	// Posts default listing
	add_image_size( 'mygrace-thumb-listing', 750, 500, true );
	
	add_image_size( 'mygrace-thumb-grid-3col', 350, 298, true );   // Posts Grid 3 Columns
	add_image_size( 'mygrace-thumb-grid-2col-sidebar', 350, 298, true );   // default Posts Grid 2 Columns with Sidebar

	add_image_size( 'mygrace-thumb-nav', 115, 85, true ); // Post Navigation

	add_image_size( 'mygrace-thumb-related', 600, 511, true ); // Related Posts
	
	add_image_size( 'mygrace-thumb-post-widget', 58, 58, true ); // Recent Posts Widget
	
	add_image_size( 'mygrace-thumb-search-result', 180, 240, true ); // Search Result Page

	add_image_size( 'mygrace-thumb-grid', 370 , 420, true );

	//	WooCommerce
	add_image_size( 'mygrace-thumb-wishlist', 60, 91, true ); // Wishlist
	add_image_size( 'mygrace-thumb-products-cat', 360, 420, true );
	add_image_size( 'mygrace-thumb-product-archive', 260, 312, true );
	add_image_size( 'mygrace-thumb-product-single', 570, 600, true );
}
