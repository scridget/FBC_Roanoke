<?php
/**
 * WooCommerce content product hooks.
 *
 * @package Mygrace
 */

add_action( 'woocommerce_before_shop_loop_item', 'mygrace_wc_loop_product_content_open', 1 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 20 );

add_action( 'woocommerce_before_shop_loop_item_title', 'mygrace_wc_loop_product_content_descr_open', 20 );

add_action( 'woocommerce_before_shop_loop_item_title', 'mygrace_wc_loop_product_descr_open', 30 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', 25 );

add_action( 'woocommerce_after_shop_loop_item', 'mygrace_wc_loop_product_content_descr_close', 10 );

add_action( 'woocommerce_after_shop_loop_item', 'mygrace_wc_loop_product_descr_close', 15 );

add_action( 'woocommerce_before_shop_loop_item_title', 'mygrace_wc_loop_product_descr_open', 30 );

add_action( 'woocommerce_after_shop_loop_item', 'mygrace_wc_loop_product_content_button_open', 5 );

add_action( 'woocommerce_after_shop_loop_item', 'mygrace_wc_loop_product_content_button_close', 10 );


add_action( 'woocommerce_after_shop_loop_item', 'mygrace_wc_loop_product_content_close', 20 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'mygrace_wc_template_loop_product_title', 10 );

add_action( 'woocommerce_before_subcategory', 'mygrace_wc_loop_category_content_open', 1 );
add_action( 'woocommerce_after_subcategory', 'mygrace_wc_loop_category_content_close', 40 );

add_action( 'woocommerce_before_cart', 'mygrace_wc_cart_product_content_open', 10 );
add_action( 'woocommerce_after_cart', 'mygrace_wc_cart_product_content_close', 20 );


// Thumbnail
add_filter( 'single_product_archive_thumbnail_size', function( $size ) {
	return 'mygrace-thumb-product-archive';

	if ( is_product_category() ){
		return 'mygrace-thumb-products-cat';
	}
} );


if ( ! function_exists( 'mygrace_wc_cart_product_content_open' ) ) {

	/**
	 * Content product wrapper open
	 */
	function mygrace_wc_cart_product_content_open() {
		echo '<div class="woocommerce-cart-content">';
	}

}

if ( ! function_exists( 'mygrace_wc_cart_product_content_close' ) ) {

	/**
	 * Content product wrapper close
	 */
	function mygrace_wc_cart_product_content_close() {
		echo '</div>';
	}

}

if ( ! function_exists( 'mygrace_wc_loop_product_content_open' ) ) {

	/**
	 * Content product wrapper open
	 */
	function mygrace_wc_loop_product_content_open() {
		echo '<div class="product-content">';
	}

}

if ( ! function_exists( 'mygrace_wc_loop_product_content_close' ) ) {

	/**
	 * Content product wrapper close
	 */
	function mygrace_wc_loop_product_content_close() {
		echo '</div>';
	}

}

if ( ! function_exists( 'mygrace_wc_loop_product_content_button_open' ) ) {

	/**
	 * Content product desc wrapper open
	 */
	function mygrace_wc_loop_product_content_button_open() {
		echo '<div class="content-button">';
	}

}

if ( ! function_exists( 'mygrace_wc_loop_product_content_button_close' ) ) {

	/**
	 * Content product desc wrapper close
	 */
	function mygrace_wc_loop_product_content_button_close() {
		echo '</div>';
	}

}

if ( ! function_exists( 'mygrace_wc_loop_product_content_descr_open' ) ) {

	/**
	 * Content product desc wrapper open
	 */
	function mygrace_wc_loop_product_content_descr_open() {
		echo '<div class="product-content-desc">';
	}

}

if ( ! function_exists( 'mygrace_wc_loop_product_content_descr_close' ) ) {

	/**
	 * Content product desc wrapper close
	 */
	function mygrace_wc_loop_product_content_descr_close() {
		echo '</div>';
	}

}

if ( ! function_exists( 'mygrace_wc_loop_product_descr_open' ) ) {

	/**
	 * Content product wrapper open
	 */
	function mygrace_wc_loop_product_descr_open() {
		echo '<div class="product-description">';
	}

}

if ( ! function_exists( 'mygrace_wc_loop_product_descr_close' ) ) {

	/**
	 * Content product wrapper close
	 */
	function mygrace_wc_loop_product_descr_close() {
		echo '</div>';
	}

}

if ( ! function_exists( 'mygrace_wc_template_loop_product_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function mygrace_wc_template_loop_product_title() {
		echo '<h6 class="woocommerce-loop-product__title"><a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h6>';
	}
}

if ( ! function_exists( 'mygrace_wc_loop_category_content_open' ) ) {

	/**
	 * Content category wrapper open
	 */
	function mygrace_wc_loop_category_content_open() {
		echo '<div class="category-content">';
	}

}

if ( ! function_exists( 'mygrace_wc_loop_category_content_close' ) ) {

	/**
	 * Content category wrapper close
	 */
	function mygrace_wc_loop_category_content_close() {
		echo '</div>';
	}

}
