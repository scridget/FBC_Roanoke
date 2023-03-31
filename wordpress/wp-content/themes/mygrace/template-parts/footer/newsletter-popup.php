<?php
/**
 * The template for displaying the header search form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mygrace
 */

$label 			= mygrace_theme()->customizer->get_value( 'header_search_label' );
$placeholder 	= mygrace_theme()->customizer->get_value( 'header_search_placeholder' );
?>

<div class="footer-newsletter-popup">
	<button class="footer-newsletter-popup-close"><?php echo mygrace_get_icon_svg( 'close' ); ?></button>
	<div class="footer-newsletter-popup__inner">
		<?php echo do_shortcode('[mc4wp_form id="1853"]'); ?>
	</div>
</div>
