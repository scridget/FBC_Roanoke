<?php
/**
 * Jet Plugins Wizard configuration.
 *
 * @package Mygrace
 */
$license = array(
	'enabled' => false,
);

/**
 * Plugins configuration
 *
 * @var array
 */
$plugins = array(
	'jet-data-importer' => array(
		'name'   => esc_html__( 'Jet Data Importer', 'mygrace' ),
		'source' => 'remote', // 'local', 'remote', 'wordpress' (default).
		'path'   => 'https://github.com/ZemezLab/jet-data-importer/archive/master.zip',
		'access' => 'base',
	),
	'jet-theme-core' => array(
		'name'   => esc_html__( 'Jet Theme Core', 'mygrace' ),
		'source' => 'remote',
		'path'   => 'https://monstroid.zemez.io/download/jet-theme-core.zip',
		'access' => 'base',
	),
	'elementor' => array(
		'name'   => esc_html__( 'Elementor', 'mygrace' ),
		'access' => 'base',
	),
	'mygrace-core'    => array(
		'name'   => esc_html__( 'Mygrace Core', 'mygrace' ),
		'source' => 'local',
		'path'   => get_parent_theme_file_path( '/assets/includes/plugins/mygrace-core.zip' ),
		'access' => 'base',
	),
	'contact-form-7' => array(
		'name'   => esc_html__( 'Contact Form 7', 'mygrace' ),
		'access' => 'skins',
	),
	'woocommerce' => array(
		'name'   => esc_html__( 'WooCommerce', 'mygrace' ),
		'access' => 'skins',
	),
	'jet-elements' => array(
		'name'   => esc_html__( 'Jet Elements For Elementor', 'mygrace' ),
		'source' => 'remote',
		'path'   => 'https://monstroid.zemez.io/download/jet-elements.zip',
		'access' => 'skins',
	),	
	'jet-blocks' => array(
		'name'   => esc_html__( 'Jet Blocks For Elementor', 'mygrace' ),
		'source' => 'remote',
		'path'   => 'https://monstroid.zemez.io/download/jet-blocks.zip',
		'access' => 'skins',
	),
	'jet-tabs' => array(
		'name'   => esc_html__( 'Jet Tabs', 'mygrace' ),
		'source' => 'remote',
		'path'   => 'https://monstroid.zemez.io/download/jet-tabs.zip',
		'access' => 'skins',
	),
	'jet-menu' => array(
		'name'   => esc_html__( 'Jet Menu', 'mygrace' ),
		'source' => 'remote',
		'path'   => 'https://monstroid.zemez.io/download/jet-menu.zip',
		'access' => 'skins',
	),
	'jet-smart-filters' => array(
		'name'   => esc_html__( 'Jet Smart Filters', 'mygrace' ),
		'source' => 'remote',
		'path'   => 'https://monstroid.zemez.io/download/jet-smart-filters.zip',
		'access' => 'skins',
	),
	'jet-woo-builder' => array(
		'name'   => esc_html__( 'Jet Woo Builder', 'mygrace' ),
		'source' => 'remote',
		'path'   => 'https://monstroid.zemez.io/download/jet-woo-builder.zip',
		'access' => 'skins',
	),
	'jet-woo-product-gallery' => array(
		'name'   => esc_html__( 'Jet Woo Product Gallery', 'mygrace' ),
		'source' => 'remote',
		'path'   => 'https://monstroid.zemez.io/download/jet-woo-product-gallery.zip',
		'access' => 'skins',
	),
	'jet-popup' => array(
		'name'   => esc_html__( 'Jet Popup', 'mygrace' ),
		'source' => 'remote',
		'path'   => 'https://monstroid.zemez.io/download/jet-popup.zip',
		'access' => 'skins',
		),
	'jet-tricks' => array(
		'name'   => esc_html__( 'Jet Tricks', 'mygrace' ),
		'source' => 'remote',
		'path'   => 'https://monstroid.zemez.io/download/jet-tricks.zip',
		'access' => 'skins',
	),
);

/**
 * Skins configuration
 *
 * @var array
 */
$skins = array(
	'base' => array(
		'jet-data-importer',
		'elementor',
		'mygrace-core',

	),
	'advanced' => array(
		'mygrace' => array(
			'full'  => array(
				'jet-blocks',
				'jet-elements',
				'jet-theme-core',
				'jet-tabs',
				'jet-menu',
				'contact-form-7',
				'woocommerce',
				'jet-compare-wishlist',
				'jet-smart-filters',
				'jet-woo-builder',
				'jet-woo-product-gallery',
				'jet-popup',
				'jet-tricks',
			),
			'lite'  => false,
			'demo'  => 'https://ld-wp73.template-help.com/tf/demo_mygrace/mygrace-v10/',
			'thumb' => 'https://monstroid.zemez.io/download/tf/mygrace/mygrace.png',
			'name'  => esc_html__( 'Mygrace', 'mygrace' ),
		),						
	),
);

$texts = array(
	'theme-name' => esc_html__( 'Mygrace', 'mygrace' ),
);

$config = array(
	'license' => $license,
	'plugins' => $plugins,
	'skins'   => $skins,
	'texts'   => $texts,
);
