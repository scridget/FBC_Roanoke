<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Mygrace
 */
$breadcrumbs_visibillity = mygrace_theme()->customizer->get_value( 'breadcrumbs_visibillity' );
get_header();

	do_action( 'mygrace-theme/site/site-content-before', 'search' ); ?>

	<div <?php mygrace_content_class() ?>>
		<div class="row">

			<?php do_action( 'mygrace-theme/site/primary-before', 'search' ); ?>

			<div id="primary" class="col-xs-12">

				<?php do_action( 'mygrace-theme/site/main-before', 'search' ); ?>

				<main id="main" class="site-main"><?php
					if ( have_posts() ) : ?>

						<?php

						mygrace_theme()->do_location( 'archive', 'template-parts/search-loop' );

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
				?></main><!-- #main -->

				<?php do_action( 'mygrace-theme/site/main-after', 'search' ); ?>

			</div><!-- #primary -->

			<?php do_action( 'mygrace-theme/site/primary-after', 'search' ); ?>

		</div>
	</div><?php
get_footer();
