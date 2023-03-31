<?php
/**
 * Theme import config file.
 *
 * @var array
 *
 * @package Mygrace
 */
$config = array(
	'xml' => false,
	'advanced_import' => array(
		'mygrace' => array(
			'label'    => esc_html__( 'Mygrace', 'mygrace' ), 
			'full'     => 'https://monstroid.zemez.io/download/tf/mygrace/mygrace.xml',
			'lite'     => false,
			'thumb'    => 'https://monstroid.zemez.io/download/tf/mygrace/mygrace.png',
			'demo_url' => 'https://ld-wp73.template-help.com/tf/demo_mygrace/mygrace-v10/',
		),
		
	),
	'import' => array(
		'chunk_size' => 3,
	),
	'slider' => array(
		'path' => 'https://raw.githubusercontent.com/JetImpex/wizard-slides/master/slides.json',
	),
	'success-links' => array(
		'home' => array(
			'label'  => esc_html__( 'View your site', 'mygrace' ),
			'type'   => 'primary',
			'target' => '_self',
			'icon'   => 'dashicons-welcome-view-site',
			'desc'   => esc_html__( 'Take a look at your site', 'mygrace' ),
			'url'    => home_url( '/' ),
		),
		'customize' => array(
			'label'  => esc_html__( 'Customize your theme', 'mygrace' ),
			'type'   => 'primary',
			'target' => '_self',
			'icon'   => 'dashicons-admin-generic',
			'desc'   => esc_html__( 'Proceed to customizing your theme', 'mygrace' ),
			'url'    => admin_url( 'customize.php' ),
		),
	),
	'export' => array(
		'options' => array(
			'site_icon',
			'elementor_cpt_support',
			'elementor_disable_color_schemes',
			'elementor_disable_typography_schemes',
			'elementor_container_width',
			'elementor_css_print_method',
			'elementor_global_image_lightbox',
			'jet-elements-settings',
			'jet_menu_options',
			'woocommerce_default_country',
				'woocommerce_shop_page_id',
				'woocommerce_techguide_page_id',
				'woocommerce_default_catalog_orderby',
				'techguide_catalog_image_size',
				'techguide_single_image_size',
				'techguide_thumbnail_image_size',
				'woocommerce_cart_page_id',
				'woocommerce_checkout_page_id',
				'woocommerce_terms_page_id',
				'tm_woowishlist_page',
				'tm_woocompare_page',
				'tm_woocompare_enable',
				'tm_woocompare_show_in_catalog',
				'tm_woocompare_show_in_single',
				'tm_woocompare_compare_text',
				'tm_woocompare_remove_text',
				'tm_woocompare_page_btn_text',
				'tm_woocompare_show_in_catalog',
				'site_icon',
				'elementor_cpt_support',
				'elementor_disable_color_schemes',
				'elementor_disable_typography_schemes',
				'elementor_container_width',
				'elementor_css_print_method',
				'elementor_global_image_lightbox',
				'jet-elements-settings',
				'jet_menu_options',
				'highlight-and-share',
				'stockticker_defaults',
				'wsl_settings_social_icon_set',
				'jet_woo_builder',
				'jet-cw-settings',
		),
		'tables' => array(
			'revslider_css',
			'revslider_layer_animations',
			'revslider_navigations',
			'revslider_sliders',
			'revslider_slides',
			'revslider_static_slides',
		),
	),
);
