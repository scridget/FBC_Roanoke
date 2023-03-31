<?php
/**
 * The template for displaying the default header layout.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mygrace
 */

$visible_header_wc_cart 	= mygrace_theme()->customizer->get_value( 'woo_header_cart_icon' ) && class_exists( 'WooCommerce' );
?>

<div <?php mygrace_header_class(); ?>>
	<?php do_action( 'mygrace-theme/header/before' ); ?>
	<div class="space-between-content">

		<?php mygrace_main_menu_toggle(); ?>

		<div <?php mygrace_site_branding_class(); ?>>
			<?php mygrace_header_logo(); ?>
			<?php mygrace_site_description(); ?>
		</div>

		<div class="site-header__right_part">
			<?php mygrace_social_list( 'header' ); ?>

			<?php mygrace_header_search_toggle(); ?>

			<?php if ( $visible_header_wc_cart ) :
				mygrace_wc_header_cart();
			endif; ?>
		</div>
		<?php mygrace_header_btn( 'header' ); ?>

		<?php mygrace_header_search_popup(); ?>
	</div>
	
	<div class="header-vertical-menu-popup">
		<div class="header-vertical-menu-popup__inner">
			<button class="menu-toggle-close btn-initial"><?php echo mygrace_get_icon_svg( 'close' ); ?></button>
			<?php mygrace_main_menu( 'vertical' ); ?>
		</div>
	</div>
	<?php do_action( 'mygrace-theme/header/after' ); ?>
</div>
