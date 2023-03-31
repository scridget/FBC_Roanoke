<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package Mygrace
 */
?>

<?php do_action( 'mygrace-theme/widget-area/render', 'footer-area' ); ?>

<div <?php mygrace_footer_class(); ?>>
	<div class="space-between-content">
		<?php mygrace_footer_logo(); ?>

		<div class="footer-info__holder">
			<?php mygrace_footer_copyright(); ?>
			<?php mygrace_footer_menu(); ?>
		</div>
	</div>
</div><!-- .container -->

<?php mygrace_footer_newsletter_popup(); ?>
