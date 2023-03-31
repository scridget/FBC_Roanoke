<?php
/**
 * The template for displaying search form.
 *
 * @package Mygrace
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-form__input-wrap">
		<label for="widget-title"></label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'mygrace' ) ?></span>
		<div class="search-form__wrap">
			<input type="search" class="search-form__field" placeholder="<?php echo esc_attr_x( 'Search products...', 'placeholder', 'mygrace' ) ?>" value="<?php echo get_search_query() ?>" name="s">
			<button type="submit" class="search-form__submit btn btn-initial"><?php echo mygrace_get_icon_svg( 'search' ); ?></button>
		</div>
	</div>
</form>
