<?php
/**
 * Ocularis_Post_Meta class
 *
 * @package Ocularis
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Ocularis_Post_Meta' ) ) {

	/**
	 * Define Ocularis_Post_Meta class
	 */
	class Ocularis_Post_Meta {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    Ocularis_Post_Meta
		 */
		private static $instance = null;

		/**
		 * Rewritten theme mods.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    array
		 */
		public $rewritten_mods = array();

		/**
		 * Constructor for the class
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function __construct(){

			add_action( 'after_setup_theme', array( $this, 'init_post_meta' ) );

			$rewrite_theme_mods = apply_filters( 'roxxe/rewrite_theme_mods', array(
				'container_type',
				'header_layout_type',
				'header_color_scheme',
			) );

			$disabled_theme_mods = apply_filters( 'roxxe/disabled_theme_mods', array(
				'breadcrumbs_visibillity',
			) );

			foreach ( $rewrite_theme_mods as $mod ) {
				add_filter( "theme_mod_{$mod}", array( $this, 'set_post_meta_value' ), 20 );
			}

			foreach ( $disabled_theme_mods as $mod ) {
				add_filter( "theme_mod_{$mod}", array( $this, 'set_disabled_post_meta_value' ), 20 );
			}
		}

		/**
		 * Init post meta.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function init_post_meta() {

			$default_fields = apply_filters( 'roxxe/page_settings/default_fields', array(
				'roxxe_container_type' => array(
					'title' 		=> esc_html__( 'Page Layout', 'mygrace_core' ),
					'description' 	=> esc_html__( 'Page layout global settings redefining.', 'mygrace_core' ),
					'type' 			=> 'select',
					'value' 		=> 'inherit',
					'options' 		=> array_merge(
						array( 'inherit' => esc_html__( 'Inherit', 'mygrace_core' ) ),
						array( 'boxed' => esc_html__( 'Boxed', 'mygrace_core' ), 'fullwidth' => esc_html__( 'Fullwidth', 'mygrace_core' ) )
					),
				),
				'roxxe_header_layout_type' => array(
					'title' 		=> esc_html__( 'Header Layout', 'mygrace_core' ),
					'description' 	=> esc_html__( 'Header layout global settings redefining.', 'mygrace_core' ),
					'type' 			=> 'select',
					'value' 		=> 'inherit',
					'options' 		=> array_merge(
						array( 'inherit' => esc_html__( 'Inherit', 'mygrace_core' ) ),
						array(
							'layout-1' => esc_html__( 'Style 1 (Logo by Left)', 'mygrace_core' ),
							'layout-2' => esc_html__( 'Style 2 (Logo by Center)', 'mygrace_core' ),
						)
					),
				),
				'roxxe_header_color_scheme' => array(
					'title' 		=> esc_html__( 'Header Color Scheme', 'mygrace_core' ),
					'description' 	=> esc_html__( 'Header Color Scheme global settings redefining.', 'mygrace_core' ),
					'type' 			=> 'select',
					'value' 		=> 'inherit',
					'options' 		=> array_merge(
						array( 'inherit' => esc_html__( 'Inherit', 'mygrace_core' ) ),
						array(
							'color_scheme_1' 	=> esc_html__( 'Color Scheme 1', 'mygrace_core' ),
							'color_scheme_2' 	=> esc_html__( 'Color Scheme 2', 'mygrace_core' ),
							'color_scheme_3' 	=> esc_html__( 'Color Scheme 3', 'mygrace_core' ),
							'overlay' 			=> esc_html__( 'Overlay', 'mygrace_core' ),
						)
					),
				),
			) );

			$disable_fields = apply_filters( 'roxxe/page_settings/disable_fields', array(
				'roxxe_disable_breadcrumbs_visibillity' => array(
					'title' 		=> esc_html__( 'Disable Breadcrumbs', 'mygrace_core' ),
					'type' 			=> 'switcher',
					'value' 		=> false,
					'toggle' 		=> array(
						'true_toggle'  => esc_html__( 'Yes', 'mygrace_core' ),
						'false_toggle' => esc_html__( 'No', 'mygrace_core' ),
					),
				),
			) );

			$fields = array_merge( $default_fields, $disable_fields );

			$post_types = apply_filters( 'roxxe/page_settings/allowed_post_types', array( 'page', 'post' ) );

			foreach ( $post_types as $post_type ) {

				$fields = $this->prepare_fields( $fields, $post_type );

				new Cherry_X_Post_Meta( array(
					'id'            => 'roxxe-' . esc_attr( $post_type ) . '-settings',
					'title'         => esc_html__( 'Ocularis Page Settings', 'mygrace_core' ),
					'page'          => $post_type,
					'context'       => 'normal',
					'priority'      => 'high',
					'callback_args' => false,
					'builder_cb'    => array( $this, 'get_builder' ),
					'fields'        => $fields,
				) );
			};
		}

		/**
		 * Prepare fields.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  array  $fields    Fields list.
		 * @param  string $post_type Post type.
		 * @return array
		 */
		public function prepare_fields( $fields, $post_type ) {

			foreach ( $fields as $meta_key => $field ) {

				if ( isset( $field['page'] ) ) {

					if ( ( is_array( $field['page'] ) && ! in_array( $post_type, $field['page'] ) ) || $field['page'] !== $post_type ) {
						unset( $fields[ $meta_key ] );
					}

					unset( $field['page'] );
				}
			}

			return $fields;
		}

		/**
		 * Get interface builder instance
		 *
		 * @since  1.0.0
		 * @access public
		 * @return CX_Interface_Builder
		 */
		public function get_builder() {

			return new CX_Interface_Builder(
				array(
					'path' => plugin_dir_path( dirname( __FILE__ ) ) . 'modules/interface-builder/',
					'url'  => plugin_dir_path( dirname( __FILE__ ) ) . 'modules/interface-builder/',
				)
			);
		}

		/**
		 * Set specific post meta value.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  mixed $value Filtered value.
		 * @return string|bool
		 */
		public function set_post_meta_value( $value ) {
			$queried_obj = $this->get_queried_obj();

			if ( ! $queried_obj ) {
				return $value;
			}

			$theme_mod  = str_replace( 'theme_mod_', '', current_filter() );
			$meta_key   = 'roxxe_' . $theme_mod;
			$meta_value = get_post_meta( $queried_obj, $meta_key, true );

			if ( ! $meta_value || 'inherit' === $meta_value ) {
				return $value;
			}

			if ( in_array( $meta_value, array( 'yes', 'true', 'no', 'false' ) ) ) {
				$meta_value = filter_var( $meta_value, FILTER_VALIDATE_BOOLEAN );
			}

			if ( ! isset( $this->rewritten_mods[ $theme_mod ] ) ) {
				$this->rewritten_mods[] = $theme_mod;
			}

			return $meta_value;
		}

		/**
		 * Set disabled post meta value.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  mixed $value Filtered value.
		 * @return string|bool
		 */
		public function set_disabled_post_meta_value( $value ) {
			$queried_obj = $this->get_queried_obj();

			if ( ! $queried_obj ) {
				return $value;
			}

			$meta_key   = 'roxxe_disable_' . str_replace( 'theme_mod_', '', current_filter() );
			$meta_value = get_post_meta( $queried_obj, $meta_key, true );

			if ( 'true' !== $meta_value ) {
				return $value;
			}

			return false;
		}

		/**
		 * Get queried object.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return string|boolean
		 */
		public function get_queried_obj() {
			$queried_obj = apply_filters( 'roxxe_queried_object_id', false );

			if ( ! $queried_obj && ! $this->maybe_need_rewrite_mod() ) {
				return false;
			}

			$queried_obj = is_home() ? get_option( 'page_for_posts' ) : $queried_obj;
			$queried_obj = ! $queried_obj ? get_the_id() : $queried_obj;

			return $queried_obj;
		}

		/**
		 * Check if we need to try rewrite theme mod or not
		 *
		 * @since  1.0.0
		 * @access public
		 * @return boolean
		 */
		public function maybe_need_rewrite_mod() {

			if ( is_front_page() && 'page' !== get_option( 'show_on_front' ) ) {
				return false;
			}

			if ( is_home() && 'page' === get_option( 'show_on_front' ) ) {
				return true;
			}

			if ( ! is_singular() ) {
				return false;
			}

			return true;
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return Ocularis_Post_Meta
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
	}

}

new Ocularis_Post_Meta();
