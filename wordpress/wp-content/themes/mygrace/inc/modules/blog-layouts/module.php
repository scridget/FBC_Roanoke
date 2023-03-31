<?php
/**
 * Blog layouts module
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Mygrace_Blog_Layouts_Module' ) ) {

	/**
	 * Define Mygrace_Blog_Layouts_Module class
	 */
	class Mygrace_Blog_Layouts_Module extends Mygrace_Module_Base {
		/**
		 * properties.
		 */
		private $layout_type;
		private $sidebar_enabled = true;
		private $columns_enabled = true;
		private $fullwidth_enabled = true;

		/**
		 * Sidebar list.
		 */
		private $sidebar_list = array (
			'default' 			=> array( '2-cols', '3-cols' ),
			'grid' 				=> array( '2-cols' )
		);

		/**
		 * Columns list.
		 */
		private $columns_list = array (
			'default' 			=> array(),
			'grid' 				=> array( 'default' )
		);

		/**
		 * Module ID
		 *
		 * @return string
		 */
		public function module_id() {

			return 'blog-layouts';

		}

		/**
		 * Module filters
		 *
		 * @return void
		 */
		public function filters() {

			add_action( 'wp_head', array( $this, 'module_init_properties' ) );
			add_filter( 'mygrace-theme/customizer/options', array( $this, 'customizer_options' ) );
			add_filter( 'mygrace-theme/customizer/blog-sidebar-enabled', array( $this, 'customizer_blog_sidebar_enabled' ) );
			add_filter( 'mygrace-theme/customizer/blog-columns-enabled', array( $this, 'customizer_blog_columns_enabled' ) );
			add_filter( 'mygrace-theme/posts/template-part-slug', array( $this, 'apply_layout_template' ) );
			add_filter( 'mygrace-theme/posts/post-style', array( $this, 'apply_style_template' ) );
			add_filter( 'mygrace-theme/posts/list-class', array( $this, 'add_list_class' ) );
			add_filter( 'mygrace-theme/site-content/container-enabled', array( $this, 'disable_site_content_container' ) );

		}

		/**
		 * Init module properties
		 *
		 * @return void
		 */
		public function module_init_properties() {

			$this->layout_type 		= mygrace_theme()->customizer->get_value( 'blog_layout_type' );
			$this->layout_columns 	= mygrace_theme()->customizer->get_value( 'blog_layout_columns' );
			$this->layout_style 	= 'default';

			if ( isset( $this->sidebar_list[$this->layout_type] ) && $this->is_blog_archive() ) {
				$this->sidebar_enabled = in_array( $this->layout_columns, $this->sidebar_list[$this->layout_type] );
			}

			if ( isset( $this->columns_list[$this->layout_type] ) && $this->is_blog_archive() ) {
				$this->columns_enabled = in_array( $this->layout_style, $this->columns_list[$this->layout_type] );
			}

			if ( ! $this->sidebar_enabled ) {
				mygrace_theme()->sidebar_position = 'none';
			}

		}

		/**
		 * Apply new blog layout
		 *
		 * @return array
		 */
		public function apply_layout_template( $layout ) {

			$blog_post_template = 'template-parts/' . esc_attr( $this->layout_type ) . '/content';

			return 'inc/modules/blog-layouts/' . $blog_post_template;

		}

		/**
		 * Apply style template
		 *
		 * @param  string $style Current style template suuffix
		 *
		 * @return [type]        [description]
		 */
		public function apply_style_template( $style ) {

			$blog_layout_style = false;

			return $blog_layout_style;

		}

		/**
		 * Add list class
		 *
		 * @param  string   list class
		 *
		 * @return [type]   modified list class
		 */
		public function add_list_class( $list_class ) {

			$list_class .= ' posts-list--' . sanitize_html_class( ! is_search() ? $this->layout_type : 'default' );
			// $list_class .= ' list-style-default';
			if ( 'grid' === $this->layout_type ) {
				$list_class .= ' posts-list-' . sanitize_html_class( $this->layout_columns );
			}

			return $list_class;

		}

		/**
		 * Add blog related customizer options
		 *
		 * @param  array $options Options list
		 * @return array
		 */
		public function customizer_options( $options ) {

			$new_options = array(
				'blog_layout_type' => array(
					'title'    => esc_html__( 'Layout', 'mygrace' ),
					'priority' => 1,
					'section'  => 'blog',
					'default'  => 'grid',
					'field'    => 'select',
					'choices'  => array(
						'default' 		=> esc_html__( 'Listing', 'mygrace' ),
						'grid' 			=> esc_html__( 'Grid', 'mygrace' ),
					),
					'type' => 'control',
				)
			);

			$options['options'] = array_merge( $new_options, $options['options'] );

			return $options;

		}

		/**
		 * Check blog archive pages
		 *
		 * @return bool
		 */
		public function is_blog_archive() {

			if ( is_home() || ( is_archive() && ! is_tax() && ! is_post_type_archive() ) ) {
				return true;
			}

			return false;

		}

		/**
		 * Disable site content container
		 *
		 * @return boolean
		 */
		public function disable_site_content_container() {

			return $this->fullwidth_enabled;

		}

		/**
		 * Customizer blog sidebar enabled
		 *
		 * @return boolean
		 */
		public function customizer_blog_sidebar_enabled() {

			return $this->sidebar_enabled;

		}

		/**
		 * Customizer blog columns enabled
		 *
		 * @return boolean
		 */
		public function customizer_blog_columns_enabled() {

			return $this->columns_enabled;

		}

		/**
		 * Blog layouts styles
		 *
		 * @return void
		 */
		public function enqueue_styles() {

			wp_enqueue_style(
				'mygrace-blog-layouts-module',
				get_theme_file_uri( 'inc/modules/blog-layouts/assets/css/blog-layouts-module.css' ),
				false,
				mygrace_theme()->version()
			);

			if ( is_rtl() ) {
				wp_enqueue_style(
					'mygrace-blog-layouts-module-rtl',
					get_theme_file_uri( 'inc/modules/blog-layouts/assets/css/rtl.css' ),
					false,
					mygrace_theme()->version()
				);
			}

		}

	}

}
