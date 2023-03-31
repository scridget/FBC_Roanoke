<?php
/**
 * Extends basic functionality for better WooCommerce compatibility
 *
 * @package Mygrace
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function mygrace_wc_setup() {
	add_theme_support( 'woocommerce', array(
		'gallery_thumbnail_image_width' => 500,
	));
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'mygrace_wc_setup' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 *
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function mygrace_wc_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}

add_filter( 'body_class', 'mygrace_wc_active_body_class' );

/**
*   Change Proceed To Checkout Text in WooCommerce
*   Add this code in your active theme functions.php file
**/

function woocommerce_button_proceed_to_checkout() {
	
       ?>
       <a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="checkout-button button alt wc-forward">
	   <?php _e( 'Place Order', 'mygrace' ); ?></a>
	   
<?php
}

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 *
 * @return array $args related products args.
 */
function mygrace_wc_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'mygrace_wc_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'mygrace_shop_page_title' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function mygrace_shop_page_title() {
		
		$visible = mygrace_theme()->customizer->get_value( 'page_title' );

		if ( ! $visible ){
			return;
		}

		?>
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) && !is_singular( 'product' ) && 
			( class_exists('WooCommerce') && ( is_shop() || is_product_category() || is_product_tag() ) ) ) : ?>
				<header class="page-header row">
					<h1 class="page-title h2-style col-md-12"><?php woocommerce_page_title(); ?></h1>
					<div class="archive-description col-xs-12 col-md-8 col-md-push-2"><?php esc_html( do_action('woocommerce_archive_description') ); ?></div>
				</header>
			<?php endif; ?>
		<?php
	}
}
add_filter( 'mygrace-theme/site/title', 'mygrace_shop_page_title' );

if ( ! function_exists( 'mygrace_wc_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function mygrace_wc_wrapper_before() {
		?>
			<div <?php mygrace_get_single_product_container_classes() ?>>
			<div class="row">
			<div id="primary" <?php mygrace_primary_content_class(); ?>>
			<main id="main" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'mygrace_wc_wrapper_before' );

/**
 * Single product layout classes.
 */
if ( ! function_exists( 'mygrace_get_single_product_container_classes' ) ) {
	function mygrace_get_single_product_container_classes( $classes = null, $fullwidth = false ) {

		if ( $classes ) {
			$classes .= ' ';
		}

		$classes .= 'site-content__wrap';

		$site_content_container = apply_filters( 'mygrace-theme/site-content/container-enabled', true );

		if ( $site_content_container ) {
			$classes .= ' container';
		}
			
		echo 'class="' . apply_filters( 'mygrace-theme/site-content/content-classes', $classes ) . '"';
		
	}
}

if ( ! function_exists( 'mygrace_wc_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
function mygrace_wc_wrapper_after() {
	?>
	</main><!-- #main -->
	</div><!-- #primary -->
	<?php
}
}
add_action( 'woocommerce_after_main_content', 'mygrace_wc_wrapper_after' );


if ( ! function_exists( 'mygrace_wc_sidebar_after' ) ) {
	/**
	 * Close tags after sidebar
	 */
	function mygrace_wc_sidebar_after() {
		?>
			</div>
			</div>
		<?php
	}
}
add_action( 'woocommerce_sidebar', 'mygrace_wc_sidebar_after', 99 );

if ( ! function_exists( 'mygrace_wc_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 *
	 * @return array Fragments to refresh via AJAX.
	 */
	function mygrace_wc_cart_link_fragment( $fragments ) {
		ob_start();
		mygrace_wc_cart_link();
		$fragments['a.header-cart__link'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'add_to_cart_fragments', 'mygrace_wc_cart_link_fragment' );

if ( ! function_exists( 'mygrace_wc_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function mygrace_wc_cart_link() {
		?>
			<a class="header-cart__link" href="#" title="<?php esc_attr_e( 'View your shopping cart', 'mygrace' ); ?>">
		  <?php
		  $item_count_text = sprintf(
		  /* translators: number of items in the mini cart. */
			  esc_html__( '%d', 'mygrace' ),
			  WC()->cart->get_cart_contents_count()
		  );

		  ?>
				<?php echo mygrace_get_icon_svg( 'cart' ); ?>
				<span class="header-cart__link-count"><?php echo esc_html( $item_count_text ); ?></span>
			</a>
		<?php
	}
}

if ( ! function_exists( 'mygrace_wc_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function mygrace_wc_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
			<div class="header-cart">
				<div class="header-cart__link-wrap <?php echo esc_attr( $class ); ?>">
			<?php mygrace_wc_cart_link(); ?>
				</div>
				<div class="header-cart__content">
			<?php
			$instance = array( 'title' => esc_html__( 'My cart', 'mygrace' ) );
			the_widget( 'WC_Widget_Cart', $instance );
			?>
				</div>
			</div>
		<?php
	}
}

if ( ! function_exists( 'mygrace_wc_pagination' ) ) {

	/**
	 * WooCommerce pagination
	 *
	 * @param $args
	 *
	 * @return mixed
	 */
	function mygrace_wc_pagination( $args ) {
		$args['prev_text'] = sprintf( '
		<span class="nav-icon icon-prev"></span><span>%1$s</span>',
			esc_html__( 'Prev', 'mygrace' ) );

		$args['next_text'] = sprintf( '
		<span>%1$s</span><span class="nav-icon icon-next"></span>',
			esc_html__( 'Next', 'mygrace' ) );

		return $args;
	}

}
add_filter( 'woocommerce_pagination_args', 'mygrace_wc_pagination' );

if ( ! function_exists( 'mygrace_init_wc_properties' ) ) {

	/**
	 * Init shop properties
	 */
	function mygrace_init_wc_properties() {

		// Sidebar properties for archive product
		if ( ( is_shop() || is_product_taxonomy() ) && ! is_singular( 'product' ) ) {
			if ( is_active_sidebar( 'sidebar-shop' ) ) {
				mygrace_theme()->sidebar_position = 'one-left-sidebar';
			} else {
				mygrace_theme()->sidebar_position = 'none';
			}
		}

	}

}
add_action( 'wp_head', 'mygrace_init_wc_properties', 2 );

/*
 *
 * Removes products count after categories name
 * 
 */
add_filter( 'woocommerce_subcategory_count_html', 'mygrace_woo_remove_category_products_count' );

function mygrace_woo_remove_category_products_count() {
	return;
}

if ( ! function_exists( 'mygrace_woo_add_category_description' ) ) {

	/**
	 * WooCommerce Description for Categories List Page
	 */
	function mygrace_woo_add_category_description ($category) {
		
		$cat_id 		= $category->term_id;
		$prod_term 		= get_term( $cat_id,'product_cat' );
		$description 	= $prod_term->description;

		if ( $category->count > 0 ) {
			$category_count = sprintf(
				'%1$s %2$s',
				esc_html( $category->count ),
				esc_html__( 'Products', 'mygrace' )
			);

		}


		$output = sprintf(
			'<div class="woocommerce-loop-category__description">%1$s</div><div class="entry-meta">%2$s</div>',
				esc_html( $description ),
				esc_html( $category_count )
		);

		echo wp_kses_post( $output );

	}

}
add_action( 'woocommerce_after_subcategory_title', 'mygrace_woo_add_category_description', 12);

if ( ! function_exists( 'mygrace_woo_custom_sale_text' ) ) {
	/**
	 * Remove the parentheses from the category widget.
	 */
	
	function mygrace_woo_custom_sale_text($text, $post, $_product) {
    	return '<span class="onsale">' . esc_html( 'Sale', 'mygrace' ) . '</span>';
	}
}
add_filter('woocommerce_sale_flash', 'mygrace_woo_custom_sale_text', 10, 3);
