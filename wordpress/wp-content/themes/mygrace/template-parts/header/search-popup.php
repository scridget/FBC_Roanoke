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

<div class="header-search-popup">
	<button class="header-search-popup-close"><?php echo mygrace_get_icon_svg( 'close' ); ?></button>
	<div class="header-search-popup__inner container">
		<form role="search" method="get" class="header-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="header-search-form__label"><?php echo esc_html( $label ); ?></label>
			<input type="search" class="header-search-form__field" placeholder="<?php echo esc_attr( $placeholder ); ?>" value="<?php echo get_search_query() ?>" name="s">
			<button type="submit" class="header-search-form__submit btn btn-initial"><?php echo esc_html__( 'Search', 'mygrace' ); ?></button>
		</form>
	</div>
</div>
