<?php
if ( ! class_exists( 'Mygrace_Theme_Setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since 1.0.0
	 */
	class Mygrace_Theme_Setup {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * True if the page is a blog or archive.
		 *
		 * @since 1.0.0
		 * @var   Boolean
		 */
		private $is_blog = false;

		/**
		 * Sidebar position.
		 *
		 * @since 1.0.0
		 * @var   String
		 */
		public $sidebar_position = 'none';

		/**
		 * Loaded modules
		 *
		 * @var array
		 */
		public $modules = array();

		/**
		 * Theme version
		 *
		 * @var string
		 */
		public $version;

		/**
		 * Sets up needed actions/filters for the theme to initialize.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			$template      = get_template();
			$theme_obj     = wp_get_theme( $template );
			$this->version = $theme_obj->get( 'Version' );

			// Load the theme modules.
			add_action( 'after_setup_theme', array( $this, 'mygrace_framework_loader' ), -20 );

			// Initialization of customizer.
			add_action( 'after_setup_theme', array( $this, 'mygrace_customizer' ) );

			// Initialization of breadcrumbs module
			add_action( 'wp_head', array( $this, 'mygrace_breadcrumbs' ) );

			// Language functions and translations setup.
			add_action( 'after_setup_theme', array( $this, 'l10n' ), 2 );

			// Handle theme supported features.
			add_action( 'after_setup_theme', array( $this, 'theme_support' ), 3 );

			// Load the theme includes.
			add_action( 'after_setup_theme', array( $this, 'includes' ), 4 );

			// Load theme modules.
			add_action( 'after_setup_theme', array( $this, 'load_modules' ), 5 );

			// Init properties.
			add_action( 'wp_head', array( $this, 'mygrace_init_properties' ) );

			// Register public assets.
			add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ), 9 );

			// Enqueue scripts.
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 10 );

			// Enqueue styles.
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 10 );

			// Maybe register Elementor Pro locations.
			add_action( 'elementor/theme/register_locations', array( $this, 'elementor_locations' ) );


			// Register import config for Jet Data Importer.
			add_action( 'init', array( $this, 'register_data_importer_config' ), 5 );

			// Register plugins config for Jet Plugins Wizard.
			add_action( 'init', array( $this, 'register_plugins_wizard_config' ), 5 );

			// Enqueue masonry scripts.
			add_action( 'wp_enqueue_scripts', array( $this, 'mygrace_masonry_script' ), 5 );

		}

		/**
		* Run initialization of masonry scripts.
		 *
		 * @return string
		 */
		public function mygrace_masonry_script() {
			wp_enqueue_script('masonry');
		}

		/**
		 * Retuns theme version
		 *
		 * @return string
		 */
		public function version() {
			return apply_filters( 'mygrace-theme/version', $this->version );
		}

		/**
		 * Load the theme modules.
		 *
		 * @since  1.0.0
		 */
		public function mygrace_framework_loader() {

			require get_theme_file_path( 'framework/loader.php' );

			new Mygrace_CX_Loader(
				array(
					get_theme_file_path( 'framework/modules/customizer/cherry-x-customizer.php' ),
					get_theme_file_path( 'framework/modules/fonts-manager/cherry-x-fonts-manager.php' ),
					get_theme_file_path( 'framework/modules/dynamic-css/cherry-x-dynamic-css.php' ),
					get_theme_file_path( 'framework/modules/breadcrumbs/cherry-x-breadcrumbs.php' ),
				)
			);

		}

		/**
		 * Run initialization of customizer.
		 *
		 * @since 1.0.0
		 */
		public function mygrace_customizer() {

			$this->customizer = new CX_Customizer( mygrace_get_customizer_options() );
			$this->dynamic_css = new CX_Dynamic_CSS( mygrace_get_dynamic_css_options() );

		}

		/**
		 * Run initialization of breadcrumbs.
		 *
		 * @since 1.0.0
		 */
		public function mygrace_breadcrumbs() {

			$this->breadcrumbs = new CX_Breadcrumbs( mygrace_get_breadcrumbs_options() );

		}

		/**
		 * Run init init properties.
		 *
		 * @since 1.0.0
		 */
		public function mygrace_init_properties() {

			$this->is_blog = is_home() || ( is_archive() && ! is_tax() && ! is_post_type_archive() ) ? true : false;

			if (class_exists('WooCommerce')){
				if (!is_cart() && !is_checkout() && !is_account_page() && !is_woocommerce() ) {
					$this->sidebar_position = mygrace_theme()->customizer->get_value( 'page_sidebar_position' );
				}
			}
			else{
				if ( is_page() )  {
					$this->sidebar_position = mygrace_theme()->customizer->get_value( 'page_sidebar_position' );
				}
			}
			
			// Blog list properties init
			if ( $this->is_blog ) {
				$this->sidebar_position = mygrace_theme()->customizer->get_value( 'blog_sidebar_position' );
			}

			// Single blog properties init
			if ( is_singular( 'post' ) ) {
				$this->sidebar_position = mygrace_theme()->customizer->get_value( 'single_sidebar_position' );
			}

		}

		/**
		 * Loads the theme translation file.
		 *
		 * @since 1.0.0
		 */
		public function l10n() {

			/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 */
			load_theme_textdomain( 'mygrace', get_theme_file_path( 'languages' ) );

		}

		/**
		 * Adds theme supported features.
		 *
		 * @since 1.0.0
		 */
		public function theme_support() {

			global $content_width;

			if ( ! isset( $content_width ) ) {
				$content_width = 1200;
			}

			// Add support for core custom logo.
			add_theme_support( 'custom-logo', array(
				'height'      => 35,
				'width'       => 135,
				'flex-width'  => true,
				'flex-height' => true
			) );

			// Enable support for Post Thumbnails on posts and pages.
			add_theme_support( 'post-thumbnails' );

			// Enable HTML5 markup structure.
			add_theme_support( 'html5', array(
				'comment-list', 'comment-form', 'search-form', 'gallery', 'caption',
			) );

			// Enable default title tag.
			add_theme_support( 'title-tag' );

			// Enable post formats.
			add_theme_support( 'post-formats', array(
				'gallery', 'image', 'link', 'quote', 'video', 'audio',
			) );

			// Enable custom background.
			add_theme_support( 'custom-background', array( 'default-color' => 'ffffff', ) );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

		}

		/**
		 * Loads the theme files supported by themes and template-related functions/classes.
		 *
		 * @since 1.0.0
		 */
		public function includes() {

			/**
			 * Configurations.
			 */
			require_once get_theme_file_path( 'config/layout.php' );
			require_once get_theme_file_path( 'config/menus.php' );
			require_once get_theme_file_path( 'config/sidebars.php' );
			require_once get_theme_file_path( 'config/modules.php' );

			require_if_theme_supports( 'post-thumbnails', get_theme_file_path( 'config/thumbnails.php' ) );

			require_once get_theme_file_path( 'inc/modules/base.php' );

			/**
			 * Classes.
			*/
			require_once get_theme_file_path( 'inc/classes/class-widget-area.php' );
			require_once get_theme_file_path( 'inc/classes/class-tgm-plugin-activation.php' );
			require_once get_theme_file_path( 'inc/classes/class-svg-icons.php' );

			/**
			 * Functions.
			 */
			require_once get_theme_file_path( 'inc/template-tags.php' );
			require_once get_theme_file_path( 'inc/template-menu.php' );
			require_once get_theme_file_path( 'inc/template-comment.php' );
			require_once get_theme_file_path( 'inc/template-related-posts.php' );
			require_once get_theme_file_path( 'inc/extras.php' );
			require_once get_theme_file_path( 'inc/customizer.php' );
			require_once get_theme_file_path( 'inc/breadcrumbs.php' );
			require_once get_theme_file_path( 'inc/context.php' );
			require_once get_theme_file_path( 'inc/hooks.php' );
			require_once get_theme_file_path( 'inc/register-plugins.php' );

			/**
			 * Hooks.
			 */
			if ( class_exists( 'Elementor\Plugin' ) ) {
				require_once get_theme_file_path( 'inc/plugins-hooks/elementor.php' ) ;
			}

		}

		/**
		 * Modules base path
		 *
		 * @return string
		 */
		public function modules_base() {

			return 'inc/modules/';

		}

		/**
		 * Returns module class by name
		 * @return [type] [description]
		 */
		public function get_module_class( $name ) {

			$module = str_replace( ' ', '_', ucwords( str_replace( '-', ' ', $name ) ) );
			return 'Mygrace_' . $module . '_Module';

		}

		/**
		 * Load theme and child theme modules
		 *
		 * @return void
		 */
		public function load_modules() {

			$disabled_modules = apply_filters( 'mygrace-theme/disabled-modules', array() );

			foreach ( mygrace_get_allowed_modules() as $module => $childs ) {
				if ( ! in_array( $module, $disabled_modules ) ) {
					$this->load_module( $module, $childs );
				}
			}

		}

		public function load_module( $module = '', $childs = array() ) {

			if ( ! file_exists( get_theme_file_path( $this->modules_base() . $module . '/module.php' ) ) ) {
				return;
			}

			require_once get_theme_file_path( $this->modules_base() . $module . '/module.php' );
			$class = $this->get_module_class( $module );

			if ( ! class_exists( $class ) ) {
				return;
			}

			$instance = new $class( $childs );

			$this->modules[ $instance->module_id() ] = $instance;

		}

		/**
		 * Register import config for Jet Data Importer.
		 *
		 * @since 1.0.0
		 */
		public function register_data_importer_config() {
			if ( ! function_exists( 'jet_data_importer_register_config' ) ) {
				return;
			}

			require_once get_theme_file_path( 'config/import.php' );

			/**
			 * @var array $config Defined in config file.
			 */
			jet_data_importer_register_config( $config );
		}

		/**
		 * Register plugins config for Jet Plugins Wizard.
		 *
		 * @since 1.0.0
		 */
		public function register_plugins_wizard_config() {
			if ( ! function_exists( 'jet_plugins_wizard_register_config' ) ) {
				return;
			}

			if ( ! is_admin() ) {
				return;
			}

			require_once get_theme_file_path( 'config/plugins-wizard.php' );

			/**
			 * @var array $config Defined in config file.
			 */
			jet_plugins_wizard_register_config( $config );
		}

		/**
		 * Register assets.
		 *
		 * @since 1.0.0
		 */
		public function register_assets() {

			wp_register_script(
				'magnific-popup',
				get_theme_file_uri( 'assets/lib/magnific-popup/jquery.magnific-popup.min.js' ),
				array( 'jquery' ),
				'1.1.0',
				true
			);

			wp_register_script(
				'jquery-swiper',
				get_theme_file_uri( 'assets/lib/swiper/swiper.jquery.min.js' ),
				array( 'jquery' ),
				'4.3.3',
				true
			);

			wp_register_script(
				'jquery-totop',
				get_theme_file_uri( 'assets/js/jquery.ui.totop.min.js' ),
				array( 'jquery' ),
				'1.2.0',
				true
			);

			wp_register_script(
				'responsive-menu',
				get_theme_file_uri( 'assets/js/responsive-menu.js' ),
				array(),
				'1.0.0',
				true
			);

			wp_register_script(
				'mygrace-custom-stickysidebar',
				get_theme_file_uri( 'assets/js/custom-stickysidebar.js' ),
				array(),
				false,
				true
			);

			// register style
			wp_register_style(
				'font-awesome',
				get_theme_file_uri( 'assets/lib/font-awesome/font-awesome.min.css' ),
				array(),
				'4.7.0'
			);

			wp_register_style(
				'nucleo-outline',
				get_theme_file_uri( 'assets/lib/nucleo-outline/nucleo-outline.css' ),
				array(),
				'1.0.0'
			);

			wp_register_style(
				'magnific-popup',
				get_theme_file_uri( 'assets/lib/magnific-popup/magnific-popup.min.css' ),
				array(),
				'1.1.0'
			);

			wp_register_style(
				'jquery-swiper',
				get_theme_file_uri( 'assets/lib/swiper/swiper.min.css' ),
				array(),
				'4.3.3'
			);
		}

		/**
		 * Enqueue scripts.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_scripts() {

			/**
			 * Filter the depends on main theme script.
			 *
			 * @since 1.0.0
			 * @var   array
			 */
			$scripts_depends = 	apply_filters( 'mygrace-theme/assets-depends/script', array(
				'jquery',
				'responsive-menu',
			) );

			if ( $this->is_blog || is_singular( 'post' ) ) {
				array_push( $scripts_depends, 'magnific-popup', 'jquery-swiper' );
			}

			// Sticky Sidebar
			if ( mygrace_theme()->customizer->get_value( 'sticky_sidebar' ) ) {
				wp_enqueue_script( 'mygrace-custom-stickysidebar' );
			}

			wp_enqueue_script(
				'mygrace-theme-script',
				get_theme_file_uri( 'assets/js/theme-script.js' ),
				$scripts_depends,
				$this->version(),
				true
			);

			// Threaded Comments.
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

		}

		/**
		 * Enqueue styles.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_styles() {

			/**
			 * Filter the depends on main theme styles.
			 *
			 * @since 1.0.0
			 * @var   array
			 */
			$styles_depends = apply_filters( 'mygrace-theme/assets-depends/styles', array(
				'font-awesome',
				'nucleo-outline'
			) );

			if ( $this->is_blog || is_singular( 'post' ) ) {
				array_push($styles_depends, 'magnific-popup', 'jquery-swiper');
			}

			wp_enqueue_style(
				'mygrace-theme-style',
				get_stylesheet_uri(),
				$styles_depends,
				$this->version()
			);

			if ( is_rtl() ) {
				wp_enqueue_style(
					'mygrace-theme-style-rtl',
					get_theme_file_uri( 'rtl.css' ),
					false,
					$this->version()
				);
			}

		}

		/**
		 * Do Elementor or Jet Theme Core location
		 *
		 * @return bool
		 */
		public function do_location( $location = null, $fallback = null ) {

			$handler = false;
			$done    = false;

			// Choose handler
			if ( function_exists( 'jet_theme_core' ) ) {
				$handler = array( jet_theme_core()->locations, 'do_location' );
			} elseif ( function_exists( 'elementor_theme_do_location' ) ) {
				$handler = 'elementor_theme_do_location';
			}

			// If handler is found - try to do passed location
			if ( false !== $handler ) {
				$done = call_user_func( $handler, $location );
			}

			if ( true === $done ) {
				// If location successfully done - return true
				return true;
			} elseif ( null !== $fallback ) {
				// If for some reasons location coludn't be done and passed fallback template name - include this template and return
				if ( is_array( $fallback ) ) {
					// fallback in name slug format
					get_template_part( $fallback[0], $fallback[1] );
				} else {
					// fallback with just a name
					get_template_part( $fallback );
				}
				return true;
			}

			// In other cases - return false
			return false;

		}

		/**
		 * Register Elemntor Pro locations
		 *
		 * @return [type] [description]
		 */
		public function elementor_locations( $elementor_theme_manager ) {

			// Do nothing if Jet Theme Core is active.
			if ( function_exists( 'jet_theme_core' ) ) {
				return;
			}

			$elementor_theme_manager->register_location( 'header' );
			$elementor_theme_manager->register_location( 'footer' );

		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
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

/**
 * Returns instanse of main theme configuration class.
 *
 * @since  1.0.0
 * @return object
 */
function mygrace_theme() {

	return Mygrace_Theme_Setup::get_instance();

}

add_action( 'jet-theme-core/register-config', 'mygrace_core_config' );

function mygrace_core_config( $manager ) {
	$manager->register_config(
		array(
			'dashboard_page_name' => esc_html__( 'Mygrace', 'mygrace' ),
			'library_button'      => false,
			'menu_icon'           => 'dashicons-admin-generic',
			'api'                 => array( 'enabled' => false ),
			'guide' => array(
				'title' => esc_html__( 'Learn More About Mygrace', 'mygrace' ),
				'links' => array(
					'documentation' => array(
						'label'  => esc_html__( 'Check documentation', 'mygrace' ),
						'type'   => 'primary',
						'target' => '_blank',
						'icon'   => 'dashicons-welcome-learn-more',
						'desc'   => esc_html__( 'Get more info from documentation', 'mygrace' ),
						'url'    => 'http://documentation.zemez.io/wordpress/index.php?project=mygrace',
					),
					'knowledge-base' => array(
						'label'  => esc_html__( 'Knowledge Base', 'mygrace' ),
						'type'   => 'primary',
						'target' => '_blank',
						'icon'   => 'dashicons-sos',
						'desc'   => esc_html__( 'Access the vast knowledge base', 'mygrace' ),
						'url'    => 'https://zemez.io/wordpress/support/knowledge-base-category/mygrace/',
					),
					'community' => array(
						'label'  => esc_html__( 'Community', 'mygrace' ),
						'type'   => 'primary',
						'target' => '_blank',
						'icon'   => 'dashicons-facebook',
						'desc'   => esc_html__( 'Join community to stay tuned to the latest news', 'mygrace' ),
						'url'    => 'https://www.facebook.com/groups/ZemezJetCommunity/',
					),
					'video-tutorials' => array(
						'label' => esc_html__( 'View Video', 'mygrace' ),
						'type'   => 'primary',
						'target' => '_blank',
						'icon'   => 'dashicons-format-video',
						'desc'   => esc_html__( 'View video tutorials', 'mygrace' ),
						'url'    => 'https://zemez.io/wordpress/support/video-tutorials/',
					),
				),
			),
		)
	);
}

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backwards compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

mygrace_theme();
