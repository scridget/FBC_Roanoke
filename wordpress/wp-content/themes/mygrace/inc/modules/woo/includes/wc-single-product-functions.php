<?php
/**
 * WooCommerce single product hooks.
 *
 * @package Mygrace
 */

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );

add_action( 'woocommerce_before_single_product_summary', 'mygrace_single_product_row_open', 1 );
add_action( 'woocommerce_after_single_product_summary', 'mygrace_single_product_row_close', 5 );

add_action( 'woocommerce_before_single_product_summary', 'mygrace_single_product_images_column_open', 1 );
add_action( 'woocommerce_before_single_product_summary', 'mygrace_single_product_images_column_close', 30 );

add_action( 'woocommerce_before_single_product_summary', 'mygrace_single_product_images_wrap_open', 5 );
add_action( 'woocommerce_before_single_product_summary', 'mygrace_single_product_images_wrap_close', 25 );

add_action( 'woocommerce_before_single_product_summary', 'mygrace_single_product_content_column_open', 40 );
add_action( 'woocommerce_after_single_product_summary', 'mygrace_single_product_content_column_close', 1 );

add_filter( 'woocommerce_product_thumbnails_columns', 'mygrace_wc_product_thumbnails_columns' );

// Product Meta
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'mygrace_woo_template_single_meta', 40 );


// Hide Tab Heading
add_filter( 'woocommerce_product_description_heading', '__return_null' );

// Thumbnail
add_filter( 'woocommerce_gallery_image_size', function( $size ) {
	return 'mygrace-thumb-product-single';
} );


if ( ! function_exists( 'mygrace_single_product_row_open' ) ) {

	/**
	 * Content single product row open
	 */
	function mygrace_single_product_row_open() {
		echo '<div class="row">';
	}

}

if ( ! function_exists( 'mygrace_single_product_row_close' ) ) {

	/**
	 * Content single product row open
	 */
	function mygrace_single_product_row_close() {
		echo '</div>';
	}

}

if ( ! function_exists( 'mygrace_single_product_images_column_open' ) ) {

	/**
	 * Content single product images column open
	 */
	function mygrace_single_product_images_column_open() {
		echo '<div class="col-xs-12 col-sm-7">';
	}

}

if ( ! function_exists( 'mygrace_single_product_images_column_close' ) ) {

	/**
	 * Content single product images column close
	 */
	function mygrace_single_product_images_column_close() {
		echo '</div>';
	}

}

if ( ! function_exists( 'mygrace_single_product_images_wrap_open' ) ) {

	/**
	 * Content single product images column open
	 */
	function mygrace_single_product_images_wrap_open() {
		echo '<div class="product_images_wrap">';
	}

}

if ( ! function_exists( 'mygrace_single_product_images_wrap_close' ) ) {

	/**
	 * Content single product images column close
	 */
	function mygrace_single_product_images_wrap_close() {
		echo '</div>';
	}

}

if ( ! function_exists( 'mygrace_single_product_content_column_open' ) ) {

	/**
	 * Content single product content column open
	 */
	function mygrace_single_product_content_column_open() {
		echo '<div class="col-xs-12 col-sm-5">';
	}

}

if ( ! function_exists( 'mygrace_single_product_content_column_close' ) ) {

	/**
	 * Content single product content column close
	 */
	function mygrace_single_product_content_column_close() {
		echo '</div>';
	}

}

if ( ! function_exists( 'mygrace_wc_product_thumbnails_columns' ) ) {

	/**
	 * Return product thumbnails count
	 *
	 * @return int
	 */
	function mygrace_wc_product_thumbnails_columns(){
		return 3;
	}

}

if ( ! function_exists( 'mygrace_woo_template_single_meta' ) ) {

	/**
	 * Output the product meta.
	 *
	 * @return int
	 */
	function mygrace_woo_template_single_meta(){
		global $product;
		?>
		
		<div class="product_meta">

			<?php do_action( 'woocommerce_product_meta_start' ); ?>

			<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

				<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'mygrace' ); ?> <span class="sku"><?php echo esc_html( ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'mygrace' ) ); ?></span></span>

			<?php endif; ?>

			<?php echo wc_get_product_category_list( $product->get_id(), ' ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'mygrace' ) . ' ', '</span>' ); ?>

			<?php echo wc_get_product_tag_list( $product->get_id(), ' ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'mygrace' ) . ' ', '</span>' ); ?>

			<?php do_action( 'woocommerce_product_meta_end' ); ?>

		</div><?php
	}

}