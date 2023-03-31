<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'MygraceShareBox' ) ) {

	class MygraceShareBox  {

		public function __construct() {
			$this->sharebox_customizer();

			add_action( 'pre_get_posts', array( $this, 'sharebox_get_posts' ) );
		}

		/**
		* Include required files
		*
		* @return void
		*/

		public function sharebox_customizer() {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/customizer.php';
		}

		public function sharebox_get_posts() {

			$visible_sharebox         =  get_theme_mod('sharebox_checkbox', false);
			$sharebox_checkbox_list   =  get_theme_mod('sharebox_checkbox_list', false);
			$theme 				      =  wp_get_theme();

			if( $visible_sharebox && is_single() ) {
				if ( 'Mygrace' == $theme->name ) {
					add_filter( 'mygrace-theme/post/entry-meta', array( $this, 'sharebox_add_to_content'), 10, 1);
				} else {
					add_filter( 'the_content', array( $this, 'sharebox_add_to_content'), 10, 1);
				}
			}

			if( $sharebox_checkbox_list && ( ! is_single() ) ) {
				if ( 'Mygrace' == $theme->name) {
					add_filter( 'mygrace-theme/list/entry-meta', array( $this, 'sharebox_add_to_content'), 10, 1);
				} else {
					add_filter( 'the_excerpt', array( $this, 'sharebox_add_to_content'), 10);
				}
			}
			
		}

		public function sharebox_add_to_content( $content ) {

			$visible_sharebox_prefix  =  '<span>' . get_theme_mod('prefix_sharebox', 'Share Box') . '</span>';
			$twitter_user             =  get_bloginfo( 'name' );
			$sharebox_wrap            = 'sharebox_container sharebox_content';
			$share = '';

			$share .= '<a class="share_icon icon-facebook" href="http://www.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;">' . mygrace_core_get_icon_svg( 'facebook' ) . '</a>';

			$share .= '<a class="share_icon icon-twitter" href="https://twitter.com/intent/tweet?text=' . htmlspecialchars( urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ) . '&amp;url=' . urlencode( get_permalink() ) . '&amp;via=' . urlencode( $twitter_user ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;">' . mygrace_core_get_icon_svg( 'twitter' )  . '</a>';

			$share .= '<a class="share_icon icon-linkedin" href="https://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode( get_permalink() ) . '&amp;title=' . htmlspecialchars( urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;">' . mygrace_core_get_icon_svg( 'linkedin' ) . '</a>';

			$share .= ' <a class="share_icon icon-telegram" href="https://telegram.me/share/url/link?url=' . urlencode( get_permalink() ) . '&amp;name=' . htmlspecialchars( urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ) . '&amp;description=' . htmlspecialchars( urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;">' . mygrace_core_get_icon_svg( 'telegram' ) . '</a>';

		    $share_buttons = sprintf(
			    '<div class="%1$s"> %3$s %2$s </div>', 
			    $sharebox_wrap, 
			    $share,
			    wp_kses( wp_unslash( $visible_sharebox_prefix ), wp_kses_allowed_html( 'post' ) )
			);

			return  $content .= $share_buttons;
		}
	}

}

new MygraceShareBox();
