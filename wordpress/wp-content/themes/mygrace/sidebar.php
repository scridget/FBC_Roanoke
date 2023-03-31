<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mygrace
 */

?>

<?php 

do_action( 'mygrace-theme/sidebar/before' );

if ( is_active_sidebar( 'sidebar' ) && 'none' !== mygrace_theme()->sidebar_position ) : ?>
	<aside id="secondary" <?php mygrace_secondary_content_class( array( 'widget-area' ) ); ?>>
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</aside><!-- #secondary -->
<?php endif; 

do_action( 'mygrace-theme/sidebar/after' );
