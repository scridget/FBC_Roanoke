<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mygrace
 */

$header_invert         = mygrace_theme()->customizer->get_value( 'header_invert' );
$header_enable_invert = $header_invert ? 'invert ': '';

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	
<?php do_action( 'mygrace-theme/site/page-start' ); ?>
<?php mygrace_get_page_preloader(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mygrace' ); ?></a>

	<header id="masthead" class="site-header <?php echo esc_attr( $header_enable_invert ); ?>">
		<?php mygrace_theme()->do_location( 'header', 'template-parts/header' ); ?>
		<?php do_action( 'mygrace-theme/site/title' ); ?>
	</header><!-- #masthead -->
	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
	<div id="content" <?php echo mygrace_get_container_classes( 'site-content' ); ?>>

