<?php
/**
 * Theme Customizer.
 *
 * @package Mygrace
 */

/**
 * Retrieve a holder for Customizer options.
 *
 * @since  1.0.0
 * @return array
 */

function mygrace_get_customizer_options() {
	/**
	 * Filter a holder for Customizer options (for theme/plugin developer customization).
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'mygrace-theme/customizer/options' , array(
		'prefix'        => 'mygrace',
		'path'          => get_theme_file_path( 'framework/modules/customizer/' ),
		'capability'    => 'edit_theme_options',
		'type'          => 'theme_mod',
		'fonts_manager' => new CX_Fonts_Manager(),
		'options'       => array(
			
			/** `Site Identity` section */
			'logo_retina' => array(
				'title' 			=> esc_html__( 'Retina Logo', 'mygrace' ),
				'section' 			=> 'title_tagline',
				'priority' 			=> 8,
				'field' 			=> 'image',
				'type' 				=> 'control',
				'dynamic_css' 		=> true,
			),
			'logo_retina_height' => array(
				'title' 			=> esc_html__( 'Logo Height, px', 'mygrace' ),
				'section' 			=> 'title_tagline',
				'priority' 			=> 9,
				'default' 			=> 40,
				'field' 			=> 'number',
				'input_attrs' 		=> array(
					'min'  => 20,
					'max'  => 100,
					'step' => 1,
				),
				'type' 				=> 'control',
				'dynamic_css' 		=> true,
			),
			'site_tagline' => array(
				'title' 			=> esc_html__( 'Show Site Tagline', 'mygrace' ),
				'section' 			=> 'title_tagline',
				'priority' 			=> 10,
				'default' 			=> false,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
			),

			/** `General` panel */
			'general_settings' => array(
				'title'       => esc_html__( 'General Site settings', 'mygrace' ),
				'priority'    => 40,
				'type'        => 'panel',
			),

			/** `Favicon` section */
			'favicon' => array(
				'title'       => esc_html__( 'Favicon', 'mygrace' ),
				'priority'    => 25,
				'panel'       => 'general_settings',
				'type'        => 'section',
			),

			/** `Preloader` section */
			'preloader_section' => array(
				'title'    => esc_html__( 'Page Preloader', 'mygrace' ),
				'priority' => 30,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),
			'page_preloader' => array(
				'title'    => esc_html__( 'Show page preloader', 'mygrace' ),
				'section'  => 'preloader_section',
				'priority' => 30,
				'default'  => true,
				'field'    => 'checkbox',
				'type'     => 'control',
			),
			
			/** `Breadcrumbs` section */
			'breadcrumbs' => array(
				'title'    => esc_html__( 'Breadcrumbs', 'mygrace' ),
				'priority' => 30,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),
			'breadcrumbs_visibillity' => array(
				'title'   => esc_html__( 'Enable Breadcrumbs', 'mygrace' ),
				'section' => 'breadcrumbs',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_front_visibillity' => array(
				'title'   => esc_html__( 'Enable Breadcrumbs on front page', 'mygrace' ),
				'section' => 'breadcrumbs',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_path_type' => array(
				'title'   => esc_html__( 'Show full/minified path', 'mygrace' ),
				'section' => 'breadcrumbs',
				'default' => 'minified',
				'field'   => 'select',
				'choices' => array(
					'full'     => esc_html__( 'Full', 'mygrace' ),
					'minified' => esc_html__( 'Minified', 'mygrace' ),
				),
				'type'    => 'control',
			),
			'breadcrumbs_text_color' => array(
				'title'       => esc_html__( 'Text Color', 'mygrace' ),
				'description' => esc_html__( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'mygrace' ),
				'section'     => 'breadcrumbs',
				'default'     => 'dark',
				'field'       => 'select',
				'choices'     => mygrace_get_text_color(),
				'type'        => 'control',
			),
			/** `Page Layout` section */
			'page_layout' => array(
				'title' 			=> esc_html__( 'Page Layout', 'mygrace' ),
				'priority' 			=> 55,
				'type' 				=> 'section',
				'panel' 			=> 'general_settings',
			),
			'container_type' => array(
				'title' 			=> esc_html__( 'Container Type', 'mygrace' ),
				'section' 			=> 'page_layout',
				'default' 			=> 'fullwidth',
				'field' 			=> 'select',
				'choices' 			=> array(
					'boxed'     => esc_html__( 'Boxed', 'mygrace' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'mygrace' ),
				),
				'type' 				=> 'control',
			),
			'container_width' => array(
				'title' 			=> esc_html__( 'Container Width, px', 'mygrace' ),
				'section' 			=> 'page_layout',
				'default' 			=> 1200,
				'field' 			=> 'number',
				'input_attrs' 		=> array(
					'min'  => 700,
					'max'  => 2000,
					'step' => 1,
				),
				'type' 				=> 'control',
				'dynamic_css' 		=> true,
			),
			'sidebar_width' => array(
				'title' 			=> esc_html__( 'Sidebar width', 'mygrace' ),
				'section' 			=> 'page_layout',
				'default' 			=> '1/3',
				'field' 			=> 'select',
				'choices' 			=> array(
					'1/3' => '1/3',
					'1/4' => '1/4',
				),
				'sanitize_callback' => 'sanitize_text_field',
				'type' 				=> 'control',
			),

			'page_sidebar_position' => array(
				'title' 			=> esc_html__( 'Sidebar', 'mygrace' ),
				'section' 			=> 'page_layout',
				'default' 			=> 'one-right-sidebar',
				'field' 			=> 'select',
				'choices' 			=> array(
					'one-left-sidebar' 	=> esc_html__( 'Sidebar on left side', 'mygrace' ),
					'one-right-sidebar' => esc_html__( 'Sidebar on right side', 'mygrace' ),
					'none' 				=> esc_html__( 'No sidebar', 'mygrace' ),
				),
				'sanitize_callback' => 'sanitize_text_field',
				'type' 				=> 'control',
			),

			/* Page Title */
			'page_title' => array(
				'title' 			=> esc_html__( 'Page Title', 'mygrace' ),
				'section' 			=> 'page_layout',
				'default' 			=> true,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
			),

			/* Sticky Sidebar */
			'sticky_sidebar' => array(
				'title' 			=> esc_html__( 'Sticky Sidebar', 'mygrace' ),
				'section' 			=> 'page_layout',
				'default' 			=> false,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
			),

			/** `Preloader` section */
			'totop_section' => array(
				'title'    => esc_html__( 'ToTop Button', 'mygrace' ),
				'priority' => 60,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),
			'totop_visibility' => array(
				'title'   => esc_html__( 'Show ToTop Button', 'mygrace' ),
				'section' => 'totop_section',
				'priority' => 60,
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Color Scheme` panel */
			'color_scheme' => array(
				'title'       => esc_html__( 'Color Scheme', 'mygrace' ),
				'description' => esc_html__( 'Configure Color Scheme', 'mygrace' ),
				'priority'    => 40,
				'type'        => 'section',
			),

			'accent_color' => array(
				'title' 			=> esc_html__( 'Accent color', 'mygrace' ),
				'section' 			=> 'color_scheme',
				'default' 			=> '#fb571c',
				'field' 			=> 'hex_color',
				'type' 				=> 'control',
			),
			'accent_color_2' => array(
				'title' 			=> esc_html__( 'Accent color 2', 'mygrace' ),
				'section' 			=> 'color_scheme',
				'default' 			=> '#FFC11F',
				'field' 			=> 'hex_color',
				'type' 				=> 'control',
			),
			'primary_text_color' => array(
				'title' 			=> esc_html__( 'Primary Text color', 'mygrace' ),
				'section' 			=> 'color_scheme',
				'default' 			=> '#202020',
				'field' 			=> 'hex_color',
				'type' 				=> 'control',
			),
			'secondary_text_color' => array(
				'title' 			=> esc_html__( 'Secondary Text color', 'mygrace' ),
				'section' 			=> 'color_scheme',
				'default' 			=> '#999999',
				'field' 			=> 'hex_color',
				'type' 				=> 'control',
			),
			'link_color' => array(
				'title' 			=> esc_html__( 'Link color', 'mygrace' ),
				'section' 			=> 'color_scheme',
				'default' 			=> '#202020',
				'field' 			=> 'hex_color',
				'type' 				=> 'control',
			),
			'link_hover_color' => array(
				'title' 			=> esc_html__( 'Link hover color', 'mygrace' ),
				'section' 			=> 'color_scheme',
				'default' 			=> '#fb571c',
				'field' 			=> 'hex_color',
				'type' 				=> 'control',
			),
			'h1_color' => array(
				'title'   => esc_html__( 'H1 color', 'mygrace' ),
				'section' => 'color_scheme',
				'default' => '#202020',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'h2_color' => array(
				'title'   => esc_html__( 'H2 color', 'mygrace' ),
				'section' => 'color_scheme',
				'default' => '#202020',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'h3_color' => array(
				'title'   => esc_html__( 'H3 color', 'mygrace' ),
				'section' => 'color_scheme',
				'default' => '#202020',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'h4_color' => array(
				'title'   => esc_html__( 'H4 color', 'mygrace' ),
				'section' => 'color_scheme',
				'default' => '#202020',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'h5_color' => array(
				'title'   => esc_html__( 'H5 color', 'mygrace' ),
				'section' => 'color_scheme',
				'default' => '#202020',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'h6_color' => array(
				'title'   => esc_html__( 'H6 color', 'mygrace' ),
				'section' => 'color_scheme',
				'default' => '#202020',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'grey_color_1' => array(
				'title'   => esc_html__( 'Grey color (1)', 'mygrace' ),
				'section' => 'color_scheme',
				'default' => '#F7F7F7', // new !
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'grey_color_2' => array(
				'title'   => esc_html__( 'Grey color (2)', 'mygrace' ),
				'section' => 'color_scheme',
				'default' => '#F5F5F5', // new !
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'grey_color_3' => array(
				'title'   => esc_html__( 'Grey color (3)', 'mygrace' ),
				'section' => 'color_scheme',
				'default' => '#F0F0F0', // new !
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'grey_color_4' => array(
				'title'   => esc_html__( 'Grey color (4)', 'mygrace' ),
				'section' => 'color_scheme',
				'default' => '#828282', // new !
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'shadow_color' => array(
				'title' 			=> esc_html__( 'Shadow color', 'mygrace' ),
				'section' 			=> 'color_scheme',
				'default' 			=> '#5A5A5A',
				'field' 			=> 'hex_color',
				'type' 				=> 'control',
			),
			'invert_text_color' => array(
				'title'   => esc_html__( 'Invert Text color', 'mygrace' ),
				'section' => 'color_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			'btn_text_color' => array(
				'title'   => esc_html__( 'Button Text Color', 'mygrace' ),
				'section' => 'color_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'btn_bg_color' => array(
				'title'   => esc_html__( 'Button Background Color', 'mygrace' ),
				'section' => 'color_scheme',
				'default' => '#FB571C',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Typography Settings` panel */
			'typography' => array(
				'title'       => esc_html__( 'Typography', 'mygrace' ),
				'description' => esc_html__( 'Configure typography settings', 'mygrace' ),
				'priority'    => 45,
				'type'        => 'panel',
			),

			/** `Body text` section */
			'body_typography' => array(
				'title'       => esc_html__( 'Body Text', 'mygrace' ),
				'priority'    => 5,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'body_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'mygrace' ),
				'section' => 'body_typography',
				'default' => 'DM Sans, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'body_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'mygrace' ),
				'section' => 'body_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => mygrace_get_font_styles(),
				'type'    => 'control',
			),
			'body_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'mygrace' ),
				'description' => esc_html__( 'Important: Not all fonts support every font-weight.', 'mygrace' ),
				'section' => 'body_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => mygrace_get_font_weight(),
				'type'    => 'control',
			),
			'body_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'mygrace' ),
				'section'     => 'body_typography',
				'default'     => '16',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type' => 'control',
			),
			'body_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'mygrace' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'mygrace' ),
				'section'     => 'body_typography',
				'default'     => '1.5',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'body_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'mygrace' ),
				'section'     => 'body_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'body_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'mygrace' ),
				'section' => 'body_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => mygrace_get_character_sets(),
				'type'    => 'control',
			),
			'body_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'mygrace' ),
				'section' => 'body_typography',
				'default' => 'left',
				'field'   => 'select',
				'choices' => mygrace_get_text_aligns(),
				'type'    => 'control',
			),			
			'body_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'mygrace' ),
				'section' => 'body_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => mygrace_get_text_transform(),
				'type'    => 'control',
			),

			/** `H1 Heading` section */
			'h1_typography' => array(
				'title'       => esc_html__( 'H1 Heading', 'mygrace' ),
				'priority'    => 10,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h1_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'mygrace' ),
				'section' => 'h1_typography',
				'default' => 'DM Sans, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h1_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'mygrace' ),
				'section' => 'h1_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => mygrace_get_font_styles(),
				'type'    => 'control',
			),
			'h1_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'mygrace' ),
				'description' => esc_html__( 'Important: Not all fonts support every font-weight.', 'mygrace' ),
				'section' => 'h1_typography',
				'default' => '700',
				'field'   => 'select',
				'choices' => mygrace_get_font_weight(),
				'type'    => 'control',
			),
			'h1_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'mygrace' ),
				'section'     => 'h1_typography',
				'default'     => '72',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h1_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'mygrace' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'mygrace' ),
				'section'     => 'h1_typography',
				'default'     => '1.38',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h1_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'mygrace' ),
				'section'     => 'h1_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h1_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'mygrace' ),
				'section' => 'h1_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => mygrace_get_character_sets(),
				'type'    => 'control',
			),
			'h1_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'mygrace' ),
				'section' => 'h1_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => mygrace_get_text_aligns(),
				'type'    => 'control',
			),
			'h1_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'mygrace' ),
				'section' => 'h1_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => mygrace_get_text_transform(),
				'type'    => 'control',
			),

			/** `H2 Heading` section */
			'h2_typography' => array(
				'title'       => esc_html__( 'H2 Heading', 'mygrace' ),
				'priority'    => 15,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h2_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'mygrace' ),
				'section' => 'h2_typography',
				'default' => 'DM Sans, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h2_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'mygrace' ),
				'section' => 'h2_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => mygrace_get_font_styles(),
				'type'    => 'control',
			),
			'h2_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'mygrace' ),
				'description' => esc_html__( 'Important: Not all fonts support every font-weight.', 'mygrace' ),
				'section' => 'h2_typography',
				'default' => '700',
				'field'   => 'select',
				'choices' => mygrace_get_font_weight(),
				'type'    => 'control',
			),
			'h2_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'mygrace' ),
				'section'     => 'h2_typography',
				'default'     => '38',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h2_line_height' => array(
				'title' 			=> esc_html__( 'Line Height', 'mygrace' ),
				'description' 		=> esc_html__( 'Relative to the font-size of the element', 'mygrace' ),
				'section' 			=> 'h2_typography',
				'default' 			=> '1.39',
				'field' 			=> 'number',
				'input_attrs' 		=> array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' 				=> 'control',
			),
			'h2_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'mygrace' ),
				'section'     => 'h2_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h2_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'mygrace' ),
				'section' => 'h2_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => mygrace_get_character_sets(),
				'type'    => 'control',
			),
			'h2_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'mygrace' ),
				'section' => 'h2_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => mygrace_get_text_aligns(),
				'type'    => 'control',
			),
			'h2_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'mygrace' ),
				'section' => 'h2_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => mygrace_get_text_transform(),
				'type'    => 'control',
			),

			/** `H3 Heading` section */
			'h3_typography' => array(
				'title'       => esc_html__( 'H3 Heading', 'mygrace' ),
				'priority'    => 20,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h3_font_family' => array(
				'title' 			=> esc_html__( 'Font Family', 'mygrace' ),
				'section' 			=> 'h3_typography',
				'default' 			=> 'DM Sans, sans-serif',
				'field' 			=> 'fonts',
				'type' 				=> 'control',
			),
			'h3_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'mygrace' ),
				'section' => 'h3_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => mygrace_get_font_styles(),
				'type'    => 'control',
			),
			'h3_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'mygrace' ),
				'description' => esc_html__( 'Important: Not all fonts support every font-weight.', 'mygrace' ),
				'section' => 'h3_typography',
				'default' => '700',
				'field'   => 'select',
				'choices' => mygrace_get_font_weight(),
				'type'    => 'control',
			),
			'h3_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'mygrace' ),
				'section'     => 'h3_typography',
				'default'     => '32',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h3_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'mygrace' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'mygrace' ),
				'section'     => 'h3_typography',
				'default'     => '1.375',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h3_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'mygrace' ),
				'section'     => 'h3_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h3_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'mygrace' ),
				'section' => 'h3_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => mygrace_get_character_sets(),
				'type'    => 'control',
			),
			'h3_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'mygrace' ),
				'section' => 'h3_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => mygrace_get_text_aligns(),
				'type'    => 'control',
			),
			'h3_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'mygrace' ),
				'section' => 'h3_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => mygrace_get_text_transform(),
				'type'    => 'control',
			),

			/** `H4 Heading` section */
			'h4_typography' => array(
				'title'       => esc_html__( 'H4 Heading', 'mygrace' ),
				'priority'    => 25,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h4_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'mygrace' ),
				'section' => 'h4_typography',
				'default' => 'DM Sans, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h4_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'mygrace' ),
				'section' => 'h4_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => mygrace_get_font_styles(),
				'type'    => 'control',
			),
			'h4_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'mygrace' ),
				'description' => esc_html__( 'Important: Not all fonts support every font-weight.', 'mygrace' ),
				'section' => 'h4_typography',
				'default' => '700',
				'field'   => 'select',
				'choices' => mygrace_get_font_weight(),
				'type'    => 'control',
			),
			'h4_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'mygrace' ),
				'section'     => 'h4_typography',
				'default'     => '24',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h4_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'mygrace' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'mygrace' ),
				'section'     => 'h4_typography',
				'default'     => '1.38',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h4_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'mygrace' ),
				'section'     => 'h4_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h4_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'mygrace' ),
				'section' => 'h4_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => mygrace_get_character_sets(),
				'type'    => 'control',
			),
			'h4_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'mygrace' ),
				'section' => 'h4_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => mygrace_get_text_aligns(),
				'type'    => 'control',
			),
			'h4_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'mygrace' ),
				'section' => 'h4_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => mygrace_get_text_transform(),
				'type'    => 'control',
			),

			/** `H5 Heading` section */
			'h5_typography' => array(
				'title'       => esc_html__( 'H5 Heading', 'mygrace' ),
				'priority'    => 30,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h5_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'mygrace' ),
				'section' => 'h5_typography',
				'default' => 'DM Sans, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h5_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'mygrace' ),
				'section' => 'h5_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => mygrace_get_font_styles(),
				'type'    => 'control',
			),
			'h5_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'mygrace' ),
				'description' => esc_html__( 'Important: Not all fonts support every font-weight.', 'mygrace' ),
				'section' => 'h5_typography',
				'default' => '500',
				'field'   => 'select',
				'choices' => mygrace_get_font_weight(),
				'type'    => 'control',
			),
			'h5_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'mygrace' ),
				'section'     => 'h5_typography',
				'default'     => '21',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h5_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'mygrace' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'mygrace' ),
				'section'     => 'h5_typography',
				'default'     => '1.43',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h5_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'mygrace' ),
				'section'     => 'h5_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h5_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'mygrace' ),
				'section' => 'h5_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => mygrace_get_character_sets(),
				'type'    => 'control',
			),
			'h5_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'mygrace' ),
				'section' => 'h5_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => mygrace_get_text_aligns(),
				'type'    => 'control',
			),
			'h5_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'mygrace' ),
				'section' => 'h5_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => mygrace_get_text_transform(),
				'type'    => 'control',
			),

			/** `H6 Heading` section */
			'h6_typography' => array(
				'title'       => esc_html__( 'H6 Heading', 'mygrace' ),
				'priority'    => 35,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h6_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'mygrace' ),
				'section' => 'h6_typography',
				'default' => 'DM Sans, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h6_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'mygrace' ),
				'section' => 'h6_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => mygrace_get_font_styles(),
				'type'    => 'control',
			),
			'h6_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'mygrace' ),
				'description' => esc_html__( 'Important: Not all fonts support every font-weight.', 'mygrace' ),
				'section' => 'h6_typography',
				'default' => '500',
				'field'   => 'select',
				'choices' => mygrace_get_font_weight(),
				'type'    => 'control',
			),
			'h6_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'mygrace' ),
				'section'     => 'h6_typography',
				'default'     => '18',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h6_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'mygrace' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'mygrace' ),
				'section'     => 'h6_typography',
				'default'     => '1.44',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h6_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'mygrace' ),
				'section'     => 'h6_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h6_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'mygrace' ),
				'section' => 'h6_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => mygrace_get_character_sets(),
				'type'    => 'control',
			),
			'h6_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'mygrace' ),
				'section' => 'h6_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => mygrace_get_text_aligns(),
				'type'    => 'control',
			),
			'h6_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'mygrace' ),
				'section' => 'h6_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => mygrace_get_text_transform(),
				'type'    => 'control',
			),

			/** `Logo text` section */
			'logo_typography' => array(
				'title'       => esc_html__( 'Logo Text', 'mygrace' ),
				'priority'    => 40,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'header_logo_font_family' => array(
				'title'           => esc_html__( 'Font Family', 'mygrace' ),
				'section'         => 'logo_typography',
				'default'         => 'DM Sans, serif-serif',
				'field'           => 'fonts',
				'type'            => 'control',
			),
			'header_logo_font_style' => array(
				'title'           => esc_html__( 'Font Style', 'mygrace' ),
				'section'         => 'logo_typography',
				'default'         => 'normal',
				'field'           => 'select',
				'choices'         => mygrace_get_font_styles(),
				'type'            => 'control',
			),
			'header_logo_font_weight' => array(
				'title'           => esc_html__( 'Font Weight', 'mygrace' ),
				'description'     => esc_html__( 'Important: Not all fonts support every font-weight.', 'mygrace' ),
				'section'         => 'logo_typography',
				'default'         => '700',
				'field'           => 'select',
				'choices'         => mygrace_get_font_weight(),
				'type'            => 'control',
			),
			'header_logo_font_size' => array(
				'title'           => esc_html__( 'Font Size, px', 'mygrace' ),
				'section'         => 'logo_typography',
				'default'         => '33',
				'field'           => 'number',
				'input_attrs'     => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type'            => 'control',
			),
			'header_logo_character_set' => array(
				'title'           => esc_html__( 'Character Set', 'mygrace' ),
				'section'         => 'logo_typography',
				'default'         => 'latin',
				'field'           => 'select',
				'choices'         => mygrace_get_character_sets(),
				'type'            => 'control',
			),

			/** `Menu` section */
			'menu_typography' => array(
				'title'       => esc_html__( 'Menu', 'mygrace' ),
				'priority'    => 45,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'menu_font_family' => array(
				'title'           => esc_html__( 'Font Family', 'mygrace' ),
				'section'         => 'menu_typography',
				'default'         => 'DM Sans, sans-serif',
				'field'           => 'fonts',
				'type'            => 'control',
			),
			'menu_font_style' => array(
				'title'           => esc_html__( 'Font Style', 'mygrace' ),
				'section'         => 'menu_typography',
				'default'         => 'normal',
				'field'           => 'select',
				'choices'         => mygrace_get_font_styles(),
				'type'            => 'control',
			),
			'menu_font_weight' => array(
				'title'           => esc_html__( 'Font Weight', 'mygrace' ),
				'description' => esc_html__( 'Important: Not all fonts support every font-weight.', 'mygrace' ),
				'section'         => 'menu_typography',
				'default'         => '500',
				'field'           => 'select',
				'choices'         => mygrace_get_font_weight(),
				'type'            => 'control',
			),
			'menu_font_size' => array(
				'title'           => esc_html__( 'Font Size, px', 'mygrace' ),
				'section'         => 'menu_typography',
				'default'         => '18',
				'field'           => 'number',
				'input_attrs'     => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type'            => 'control',
			),
			'menu_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'mygrace' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'mygrace' ),
				'section'     => 'menu_typography',
				'default'     => '1.44',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'menu_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'mygrace' ),
				'section'     => 'menu_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'menu_character_set' => array(
				'title' 			=> esc_html__( 'Character Set', 'mygrace' ),
				'section' 			=> 'menu_typography',
				'default' 			=> 'latin',
				'field' 			=> 'select',
				'choices' 			=> mygrace_get_character_sets(),
				'type' 				=> 'control',
			),
			'menu_text_transform' => array(
				'title' 			=> esc_html__( 'Text Transform', 'mygrace' ),
				'section' 			=> 'menu_typography',
				'default' 			=> 'none',
				'field' 			=> 'select',
				'choices' 			=> mygrace_get_text_transform(),
				'type' 				=> 'control',
			),

			/** `Meta` section */
			'meta_typography' => array(
				'title'       => esc_html__( 'Meta', 'mygrace' ),
				'priority'    => 50,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'meta_font_family' => array(
				'title' 			=> esc_html__( 'Font Family', 'mygrace' ),
				'section' 			=> 'meta_typography',
				'default' 			=> 'DM Sans, sans-serif',
				'field' 			=> 'fonts',
				'type' 				=> 'control',
			),
			'meta_font_style' => array(
				'title' 			=> esc_html__( 'Font Style', 'mygrace' ),
				'section' 			=> 'meta_typography',
				'default' 			=> 'normal',
				'field' 			=> 'select',
				'choices' 			=> mygrace_get_font_styles(),
				'type' 				=> 'control',
			),
			'meta_font_weight' => array(
				'title' 			=> esc_html__( 'Font Weight', 'mygrace' ),
				'description' => esc_html__( 'Important: Not all fonts support every font-weight.', 'mygrace' ),
				'section' 			=> 'meta_typography',
				'default' 			=> '500',
				'field' 			=> 'select',
				'choices' 			=> mygrace_get_font_weight(),
				'type' 				=> 'control',
			),
			'meta_font_size' => array(
				'title' 			=> esc_html__( 'Font Size, px', 'mygrace' ),
				'section' 			=> 'meta_typography',
				'default' 			=> '14',
				'field' 			=> 'number',
				'input_attrs' 		=> array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' 				=> 'control',
			),
			'meta_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'mygrace' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'mygrace' ),
				'section'     => 'meta_typography',
				'default'     => '1.6',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'meta_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'mygrace' ),
				'section'     => 'meta_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type' => 'control',
			),
			'meta_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'mygrace' ),
				'section' => 'meta_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => mygrace_get_character_sets(),
				'type'    => 'control',
			),
			'meta_text_transform' => array(
				'title'   => esc_html__( 'Text Transform', 'mygrace' ),
				'section' => 'meta_typography',
				'default' => 'none',
				'field'   => 'select',
				'choices' => mygrace_get_text_transform(),
				'type'    => 'control',
			),
			
			/** `Button` section */
			'button_typography' => array(
				'title' 			=> esc_html__( 'Button', 'mygrace' ),
				'priority' 			=> 55,
				'panel' 			=> 'typography',
				'type' 				=> 'section',
			),
			'button_font_family' => array(
				'title' 			=> esc_html__( 'Font Family', 'mygrace' ),
				'section' 			=> 'button_typography',
				'default' 			=> 'DM Sans, sans-serif',
				'field' 			=> 'fonts',
				'type' 				=> 'control',
			),
			'button_font_style' => array(
				'title' 			=> esc_html__( 'Font Style', 'mygrace' ),
				'section' 			=> 'button_typography',
				'default' 			=> 'normal',
				'field' 			=> 'select',
				'choices' 			=> mygrace_get_font_styles(),
				'type' 				=> 'control',
			),
			'button_font_weight' => array(
				'title' 			=> esc_html__( 'Font Weight', 'mygrace' ),
				'description' => esc_html__( 'Important: Not all fonts support every font-weight.', 'mygrace' ),
				'section' 			=> 'button_typography',
				'default' 			=> '700',
				'field' 			=> 'select',
				'choices' 			=> mygrace_get_font_weight(),
				'type' 				=> 'control',
			),
			'button_text_transform' => array(
				'title' 			=> esc_html__( 'Text Transform', 'mygrace' ),
				'section' 			=> 'button_typography',
				'default' 			=> 'uppercase',
				'field' 			=> 'select',
				'choices' 			=> mygrace_get_text_transform(),
				'type' 				=> 'control',
			),
			'button_font_size' => array(
				'title' 			=> esc_html__( 'Font Size, px', 'mygrace' ),
				'section' 			=> 'button_typography',
				'default' 			=> '12',
				'field' 			=> 'number',
				'input_attrs' 		=> array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type' 				=> 'control',
			),
			'button_line_height' => array(
				'title' 			=> esc_html__( 'Line Height', 'mygrace' ),
				'description' 		=> esc_html__( 'Relative to the font-size of the element', 'mygrace' ),
				'section' 			=> 'button_typography',
				'default' 			=> '1.5',
				'field' 			=> 'number',
				'input_attrs' 		=> array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' 				=> 'control',
			),
			'button_letter_spacing' => array(
				'title' 			=> esc_html__( 'Letter Spacing, px', 'mygrace' ),
				'section' 			=> 'button_typography',
				'default' 			=> '0',
				'field' 			=> 'number',
				'input_attrs' 		=> array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' 				=> 'control',
			),
			'button_character_set' => array(
				'title' 			=> esc_html__( 'Character Set', 'mygrace' ),
				'section' 			=> 'button_typography',
				'default' 			=> 'latin',
				'field' 			=> 'select',
				'choices' 			=> mygrace_get_character_sets(),
				'type' 				=> 'control',
			),

			/** `Header` panel */
			'header_panel' => array(
				'title' 			=> esc_html__( 'Header', 'mygrace' ),
				'priority' 			=> 105,
				'type' 				=> 'panel',
			),

			'header_styles' => array(
				'title' 			=> esc_html__( 'Style', 'mygrace' ),
				'panel' 			=> 'header_panel',
				'type' 				=> 'section',
			),
			'header_layout_type' => array(
				'title' 			=> esc_html__( 'Layout', 'mygrace' ),
				'section' 			=> 'header_styles',
				'default' 			=> 'style-3',
				'choices' 			=> array(
					'style-1' => esc_html__( 'Style 1 (Logo by Center)', 'mygrace' ),
					// 'style-2' => esc_html__( 'Style 2 (Hamburger Menu)', 'mygrace' ),
					'style-3' => esc_html__( 'Style 2 (Logo by Left)', 'mygrace' ),
				),
				'field' 			=> 'select',
				'type' 				=> 'control',
			),
			'header_container_type' => array(
				'title' 			=> esc_html__( 'Container Type', 'mygrace' ),
				'section' 			=> 'header_styles',
				'default' 			=> 'fullwidth',
				'field' 			=> 'select',
				'choices' 			=> array(
					'boxed'     => esc_html__( 'Boxed', 'mygrace' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'mygrace' ),
				),
				'type' 				=> 'control',
			),

			'header_bg_image' => array(
				'title'   => esc_html__( 'Background Image', 'mygrace' ),
				'section' => 'header_styles',
				'field'   => 'image',
				'type'    => 'control',
			),
			'header_bg_repeat' => array(
				'title'   => esc_html__( 'Background Repeat', 'mygrace' ),
				'section' => 'header_styles',
				'default' => 'repeat',
				'field'   => 'select',
				'choices' => array(
					'no-repeat'  => esc_html__( 'No Repeat', 'mygrace' ),
					'repeat'     => esc_html__( 'Tile', 'mygrace' ),
					'repeat-x'   => esc_html__( 'Tile Horizontally', 'mygrace' ),
					'repeat-y'   => esc_html__( 'Tile Vertically', 'mygrace' ),
				),
				'type' => 'control',
			),
			'header_bg_position_x' => array(
				'title'   => esc_html__( 'Background Position', 'mygrace' ),
				'section' => 'header_styles',
				'default' => 'center',
				'field'   => 'select',
				'choices' => array(
					'left'   => esc_html__( 'Left', 'mygrace' ),
					'center' => esc_html__( 'Center', 'mygrace' ),
					'right'  => esc_html__( 'Right', 'mygrace' ),
				),
				'type' => 'control',
			),
			'header_bg_attachment' => array(
				'title'   => esc_html__( 'Background Attachment', 'mygrace' ),
				'section' => 'header_styles',
				'default' => 'scroll',
				'field'   => 'select',
				'choices' => array(
					'scroll' => esc_html__( 'Scroll', 'mygrace' ),
					'fixed'  => esc_html__( 'Fixed', 'mygrace' ),
				),
				'type' => 'control',
			),

			'header_invert' => array(
				'title' 			=> esc_html__( 'Enable Invert', 'mygrace' ),
				'section' 			=> 'header_styles',
				'default' 			=> false,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
			),
			'header_social_links' => array(
				'title' 			=> esc_html__( 'Show Social Links', 'mygrace' ),
				'section' 			=> 'header_styles',
				'default' 			=> false,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
			),

			'header_search_section' => array(
				'title' 			=> esc_html__( 'Search Popup', 'mygrace' ),
				'panel' 			=> 'header_panel',
				'type' 				=> 'section',
			),
			'header_search_visible' => array(
				'title' 			=> esc_html__( 'Show Search', 'mygrace' ),
				'section' 			=> 'header_search_section',
				'default' 			=> true,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
			),
			'header_search_text' => array(
				'title' 			=> esc_html__( 'Search Text', 'mygrace' ),
				'section' 			=> 'header_search_section',
				'default' 			=> '',
				'field' 			=> 'text',
				'type' 				=> 'control',
				'conditions' 		=> array(
					'header_search_visible' 	=> true,
				),
			),
			'header_search_label' => array(
				'title' 			=> esc_html__( 'Label Text', 'mygrace' ),
				'section' 			=> 'header_search_section',
				'default' 			=> esc_html__( 'What are you looking for?', 'mygrace' ),
				'field' 			=> 'text',
				'type' 				=> 'control',
				'conditions' 		=> array(
					'header_search_visible' 	=> true,
				),
			),
			'header_search_placeholder' => array(
				'title' 			=> esc_html__( 'Placeholder Text', 'mygrace' ),
				'section' 			=> 'header_search_section',
				'default' 			=> esc_html__( 'Search this store', 'mygrace' ),
				'field' 			=> 'text',
				'type' 				=> 'control',
				'conditions' 		=> array(
					'header_search_visible' 	=> true,
				),
			),

			'header_btn_visibility' => array(
				'title'   => esc_html__( 'Show call to action button', 'mygrace' ),
				'section' => 'header_styles',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_btn_text' => array(
				'title'           => esc_html__( 'Header call to action button', 'mygrace' ),
				'description'     => esc_html__( 'Button text', 'mygrace' ),
				'section'         => 'header_styles',
				'default'         => '',
				'field'           => 'text',
				'type'            => 'control',
				'conditions' 		=> array(
					'header_btn_visibility' 	=> true,
				),
			),

			'header_btn_url' => array(
				'title'           => '',
				'description'     => esc_html__( 'Button url', 'mygrace' ),
				'section'         => 'header_styles',
				'default'         => '',
				'field'           => 'text',
				'type'            => 'control',
				'conditions' 		=> array(
					'header_btn_visibility' 	=> true,
				),
			),
			'header_btn_target' => array(
				'title'           => esc_html__( 'Open Link in New Tab', 'mygrace' ),
				'section'         => 'header_styles',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'conditions' 		=> array(
					'header_btn_visibility' 	=> true,
				),
			),

			'header_btn_style' => array(
				'title'   => esc_html__( 'Button style', 'mygrace' ),
				'section' => 'header_styles',
				'default' => 'accent-2',
				'field'   => 'radio',
				'choices' => array(
					'accent-1'  => esc_html__( 'Accent 1', 'mygrace' ),
					'accent-2'  => esc_html__( 'Accent 2', 'mygrace' ),
				),
				'type'    => 'control',
				'conditions' 		=> array(
					'header_btn_visibility' 	=> true,
				),
			),

			'header_bg' => array(
				'title' 			=> esc_html__( 'Header Background Color', 'mygrace' ),
				'section' 			=> 'color_scheme',
				'default' 			=> '#fff',
				'field' 			=> 'hex_color',
				'type' 				=> 'control',
			),

			/** `Footer` panel */
			'footer_options' => array(
				'title' 			=> esc_html__( 'Footer', 'mygrace' ),
				'priority' 			=> 110,
				'type' 				=> 'section',
			),
			'footer_bg' => array(
				'title' 			=> esc_html__( 'Background Color', 'mygrace' ),
				'section' 			=> 'footer_options',
				'default' 			=> '#f26837',
				'field' 			=> 'hex_color',
				'type' 				=> 'control',
				'dynamic_css' 		=> true,
			),
			'footer_text_color' => array(
				'title' 			=> esc_html__( 'Text Color', 'mygrace' ),
				'section' 			=> 'footer_options',
				'default' 			=> '#ffffff',
				'field' 			=> 'hex_color',
				'type' 				=> 'control',
				'dynamic_css' 		=> true,
			),
			'footer_copyright' => array(
				'title' 			=> esc_html__( 'Copyright text', 'mygrace' ),
				'section' 			=> 'footer_options',
				'default' 			=> mygrace_get_default_footer_copyright(),
				'field' 			=> 'textarea',
				'type' 				=> 'control',
			),
			'footer_logo_visible' => array(
				'title' 			=> esc_html__( 'Show Footer Logo', 'mygrace' ),
				'section' 			=> 'footer_options',
				'default' 			=> false,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
			),
			'footer_logo' => array(
				'title' 			=> esc_html__( 'Footer Logo', 'mygrace' ),
				'section' 			=> 'footer_options',
				'field' 			=> 'image',
				'type' 				=> 'control',
				'dynamic_css' 		=> true,
				'conditions'   => array(
					'footer_logo_visible' => true,
				),
			),

			/** `Blog Settings` panel */
			'blog_settings' => array(
				'title' 			=> esc_html__( 'Blog Settings', 'mygrace' ),
				'priority' 			=> 115,
				'type' 				=> 'panel',
			),

			/** `Blog` section */
			'blog' => array(
				'title' 			=> esc_html__( 'Blog', 'mygrace' ),
				'panel' 			=> 'blog_settings',
				'priority' 			=> 10,
				'type' 				=> 'section',
			),

			/* Blog Page Title */

			'blog_layout_columns' => array(
				'title' 			=> esc_html__( 'Columns', 'mygrace' ),
				'section' 			=> 'blog',
				'default'			=> '2-cols',
				'field' 			=> 'select',
				'choices' 			=> array(
					'2-cols' => esc_html__( '2 columns', 'mygrace' ),
					'3-cols' => esc_html__( '3 columns', 'mygrace' ),
				),
				'type' 				=> 'control',
				'active_callback' 	=> 'mygrace_is_blog_columns_enabled',
			),
			'blog_sidebar_position' => array(
				'title' 			=> esc_html__( 'Sidebar', 'mygrace' ),
				'section' 			=> 'blog',
				'default' 			=> 'one-right-sidebar',
				'field' 			=> 'select',
				'choices' 			=> array(
					'one-left-sidebar' 	=> esc_html__( 'Sidebar on left side', 'mygrace' ),
					'one-right-sidebar' => esc_html__( 'Sidebar on right side', 'mygrace' ),
					'none' 				=> esc_html__( 'No sidebar', 'mygrace' ),
				),
				'type' 				=> 'control',
				'active_callback' 	=> 'mygrace_is_blog_sidebar_enabled',
			),
			'blog_sticky_type' => array(
				'title' 			=> esc_html__( 'Sticky label type', 'mygrace' ),
				'section' 			=> 'blog',
				'default' 			=> 'icon',
				'field' 			=> 'select',
				'choices' 			=> array(
					'label' => esc_html__( 'Text Label', 'mygrace' ),
					'icon'  => esc_html__( 'Font Icon', 'mygrace' ),
					'both'  => esc_html__( 'Text with Icon', 'mygrace' ),
				),
				'type' 				=> 'control',
			),
			'blog_sticky_label' => array(
				'description' 		=> esc_html__( 'Label for sticky post', 'mygrace' ),
				'section' 			=> 'blog',
				'default' 			=> esc_html__( 'Featured', 'mygrace' ),
				'field' 			=> 'text',
				'type' 				=> 'control',
				'conditions' 		=> array(
					'blog_sticky_type' => array( 'label', 'both' ),
				),
			),
			'blog_post_author' => array(
				'title' 			=> esc_html__( 'Show post author', 'mygrace' ),
				'section' 			=> 'blog',
				'default' 			=> false,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
			),
			'blog_post_publish_date' => array(
				'title' 			=> esc_html__( 'Show publish date', 'mygrace' ),
				'section' 			=> 'blog',
				'default' 			=> true,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
			),
			'blog_post_categories' => array(
				'title' 			=> esc_html__( 'Show categories', 'mygrace' ),
				'section' 			=> 'blog',
				'default' 			=> false,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
			),
			'blog_post_tags' => array(
				'title' 			=> esc_html__( 'Show tags', 'mygrace' ),
				'section' 			=> 'blog',
				'default' 			=> false,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
			),
			'blog_post_comments' => array(
				'title' 			=> esc_html__( 'Show comments', 'mygrace' ),
				'section' 			=> 'blog',
				'default' 			=> false,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
			),
			'blog_post_excerpt' => array(
				'title' 			=> esc_html__( 'Show Excerpt', 'mygrace' ),
				'section' 			=> 'blog',
				'default' 			=> false,
				'field' 			=> 'checkbox',
				'type' 				=> 'control'
			),
			'blog_post_excerpt_words_count' => array(
				'title' 			=> esc_html__( 'Excerpt Words Count', 'mygrace' ),
				'section' 			=> 'blog',
				'default' 			=> '26',
				'field' 			=> 'number',
				'input_attrs' 		=> array(
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				),
				'type' 				=> 'control',
			),
			'blog_read_more_type' => array(
				'title' 			=> esc_html__( 'Read more button type', 'mygrace' ),
				'section' 			=> 'blog',
				'default' 			=> false,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
			),
			'blog_read_more_text' => array(
				'title' 			=> esc_html__( 'Read more button text', 'mygrace' ),
				'section' 			=> 'blog',
				'default' 			=> esc_html__( 'Learn more', 'mygrace' ),
				'field' 			=> 'text',
				'type' 				=> 'control',
				'conditions' 		=> array(
					'blog_read_more_type' => true,
				)
			),

			/** `Post` section */
			'blog_post' => array(
				'title'           => esc_html__( 'Post', 'mygrace' ),
				'panel'           => 'blog_settings',
				'priority'        => 20,
				'type'            => 'section',
				'active_callback' => 'callback_single',
			),
			'single_sidebar_position' => array(
				'title'   => esc_html__( 'Sidebar', 'mygrace' ),
				'section' => 'blog_post',
				'default' => 'none',
				'field'   => 'select',
				'choices' => array(
					'one-left-sidebar'  => esc_html__( 'Sidebar on left side', 'mygrace' ),
					'one-right-sidebar' => esc_html__( 'Sidebar on right side', 'mygrace' ),
					'none'              => esc_html__( 'No sidebar', 'mygrace' ),
				),
				'type' => 'control',
			),
			'single_post_author' => array(
				'title'   => esc_html__( 'Show post author', 'mygrace' ),
				'section' => 'blog_post',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_publish_date' => array(
				'title'   => esc_html__( 'Show publish date', 'mygrace' ),
				'section' => 'blog_post',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_comments' => array(
				'title'   => esc_html__( 'Show comments', 'mygrace' ),
				'section' => 'blog_post',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_categories' => array(
				'title'   => esc_html__( 'Show categories', 'mygrace' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_tags' => array(
				'title'   => esc_html__( 'Show tags', 'mygrace' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_navigation' => array(
				'title'   => esc_html__( 'Enable post navigation', 'mygrace' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Author Bio` section */
			'post_authorbio' => array(
				'title' 			=> esc_html__( 'Author Bio Block', 'mygrace' ),
				'panel' 			=> 'blog_settings',
				'priority' 			=> 25,
				'type' 				=> 'section',
				'active_callback' 	=> 'callback_single',
			),
			'post_authorbio_block' => array(
				'title' 			=> esc_html__( 'Show Author Bio Block', 'mygrace' ),
				'section' 			=> 'post_authorbio',
				'default' 			=> true,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
			),

			/** `Related Posts` section */
			'related_posts' => array(
				'title' 			=> esc_html__( 'Related Posts Block', 'mygrace' ),
				'panel' 			=> 'blog_settings',
				'priority' 			=> 30,
				'type' 				=> 'section',
				'active_callback' 	=> 'callback_single',
			),
			'related_posts_visible' => array(
				'title' 			=> esc_html__( 'Show related posts block', 'mygrace' ),
				'section' 			=> 'related_posts',
				'default' 			=> true,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
			),
			'related_posts_block_title' => array(
				'title' 			=> esc_html__( 'Related posts block title', 'mygrace' ),
				'section' 			=> 'related_posts',
				'default' 			=> esc_html__( 'Related Posts', 'mygrace' ),
				'field' 			=> 'text',
				'type' 				=> 'control',
				'conditions' 		=> array(
					'related_posts_visible' => true,
				),
			),
			'related_posts_count' => array(
				'title' 			=> esc_html__( 'Number of post', 'mygrace' ),
				'section' 			=> 'related_posts',
				'default' 			=> '3',
				'field' 			=> 'text',
				'type' 				=> 'control',
				'conditions' 		=> array(
					'related_posts_visible' => true,
				),
			),

			'related_posts_image' => array(
				'title' 			=> esc_html__( 'Show post image', 'mygrace' ),
				'section' 			=> 'related_posts',
				'default' 			=> true,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
				'conditions' 		=> array(
					'related_posts_visible' => true,
				),
			),
			'related_posts_title' => array(
				'title' 			=> esc_html__( 'Show post title', 'mygrace' ),
				'section' 			=> 'related_posts',
				'default' 			=> true,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
				'conditions' 		=> array(
					'related_posts_visible' => true,
				),
			),
			'related_posts_excerpt' => array(
				'title' 			=> esc_html__( 'Display excerpt', 'mygrace' ),
				'section' 			=> 'related_posts',
				'default' 			=> false,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
				'conditions' 		=> array(
					'related_posts_visible' => true,
				),
			),
			'related_posts_excerpt_words_count' => array(
				'title' 			=> esc_html__( 'Excerpt Words Count', 'mygrace' ),
				'section' 			=> 'related_posts',
				'default' 			=> '9',
				'field' 			=> 'number',
				'input_attrs' 		=> array(
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				),
				'type' 				=> 'control',
				'conditions' 		=> array(
					'related_posts_visible' => true,
					'related_posts_excerpt' => true,
				),
			),
			'related_posts_author' => array(
				'title' 			=> esc_html__( 'Show post author', 'mygrace' ),
				'section' 			=> 'related_posts',
				'default' 			=> false,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
				'conditions' 		=> array(
					'related_posts_visible' => true,
				),
			),
			'related_posts_publish_date' => array(
				'title' 			=> esc_html__( 'Show post publish date', 'mygrace' ),
				'section' 			=> 'related_posts',
				'default' 			=> true,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
				'conditions' 		=> array(
					'related_posts_visible' => true,
				),
			),
			'related_posts_comment_count' => array(
				'title' 			=> esc_html__( 'Show post comment count', 'mygrace' ),
				'section' 			=> 'related_posts',
				'default' 			=> false,
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
				'conditions' 		=> array(
					'related_posts_visible' => true,
				),
			),
	) ) );
}

/**
 * Return true if value of passed setting is not equal with passed value.
 *
 * @param  object $control Parent control.
 * @param  string $setting Setting name to check.
 * @param  string $value   Setting value to compare.
 * @return bool
 */
function mygrace_is_not_setting( $control, $setting, $value ) {

	if ( $value !== $control->manager->get_setting( $setting )->value() ) {
		return true;
	}

	return false;

}

/**
 * Move native `site_icon` control (based on WordPress core) into custom section.
 *
 * @since 1.0.0
 * @param  object $wp_customize
 * @return void
 */
function mygrace_customizer_change_core_controls( $wp_customize ) {
	$wp_customize->get_control( 'site_icon' )->section      = 'mygrace_favicon';
	$wp_customize->get_control( 'background_color' )->label = esc_html__( 'Body Background Color', 'mygrace' );
}

// Move native `site_icon` control (based on WordPress core) in custom section.
add_action( 'customize_register', 'mygrace_customizer_change_core_controls', 20 );

/**
 * Get font styles
 *
 * @since 1.0.0
 * @return array
 */
function mygrace_get_font_styles() {
	return apply_filters( 'mygrace-theme/font/styles', array(
		'normal'  => esc_html__( 'Normal', 'mygrace' ),
		'italic'  => esc_html__( 'Italic', 'mygrace' ),
		'oblique' => esc_html__( 'Oblique', 'mygrace' ),
		'inherit' => esc_html__( 'Inherit', 'mygrace' ),
	) );
}

/**
 * Get character sets
 *
 * @since 1.0.0
 * @return array
 */
function mygrace_get_character_sets() {
	return apply_filters( 'mygrace-theme/font/character_sets', array(
		'latin'        => esc_html__( 'Latin', 'mygrace' ),
		'greek'        => esc_html__( 'Greek', 'mygrace' ),
		'greek-ext'    => esc_html__( 'Greek Extended', 'mygrace' ),
		'vietnamese'   => esc_html__( 'Vietnamese', 'mygrace' ),
		'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'mygrace' ),
		'latin-ext'    => esc_html__( 'Latin Extended', 'mygrace' ),
		'cyrillic'     => esc_html__( 'Cyrillic', 'mygrace' ),
	) );
}

/**
 * Get text aligns
 *
 * @since 1.0.0
 * @return array
 */
function mygrace_get_text_aligns() {
	return apply_filters( 'mygrace-theme/font/text-aligns', array(
		'inherit' => esc_html__( 'Inherit', 'mygrace' ),
		'center'  => esc_html__( 'Center', 'mygrace' ),
		'justify' => esc_html__( 'Justify', 'mygrace' ),
		'left'    => esc_html__( 'Left', 'mygrace' ),
		'right'   => esc_html__( 'Right', 'mygrace' ),
	) );
}

/**
 * Get font weights
 *
 * @since 1.0.0
 * @return array
 */
function mygrace_get_font_weight() {
	return apply_filters( 'mygrace-theme/font/weight', array(
		'100' => '100',
		'200' => '200',
		'300' => '300',
		'400' => '400',
		'500' => '500',
		'600' => '600',
		'700' => '700',
		'800' => '800',
		'900' => '900',
	) );
}

/**
 * Get text transform.
 *
 * @since 1.0.0
 * @return array
 */
function mygrace_get_text_transform() {
	return apply_filters( 'mygrace_get_text_transform', array(
		'none'       => esc_html__( 'None ', 'mygrace' ),
		'uppercase'  => esc_html__( 'Uppercase ', 'mygrace' ),
		'lowercase'  => esc_html__( 'Lowercase', 'mygrace' ),
		'capitalize' => esc_html__( 'Capitalize', 'mygrace' ),
	) );
}

// Background utility function
/**
 * Get background position
 *
 * @since 1.0.0
 * @return array
 */
function mygrace_get_bg_position() {
	return apply_filters( 'mygrace_get_bg_position', array(
		'top-left'      => esc_html__( 'Top Left', 'mygrace' ),
		'top-center'    => esc_html__( 'Top Center', 'mygrace' ),
		'top-right'     => esc_html__( 'Top Right', 'mygrace' ),
		'center-left'   => esc_html__( 'Middle Left', 'mygrace' ),
		'center'        => esc_html__( 'Middle Center', 'mygrace' ),
		'center-right'  => esc_html__( 'Middle Right', 'mygrace' ),
		'bottom-left'   => esc_html__( 'Bottom Left', 'mygrace' ),
		'bottom-center' => esc_html__( 'Bottom Center', 'mygrace' ),
		'bottom-right'  => esc_html__( 'Bottom Right', 'mygrace' ),
	) );
}

/**
 * Get background size
 *
 * @since 1.0.0
 * @return array
 */
function mygrace_get_bg_size() {
	return apply_filters( 'mygrace_get_bg_size', array(
		'auto'    => esc_html__( 'Auto', 'mygrace' ),
		'cover'   => esc_html__( 'Cover', 'mygrace' ),
		'contain' => esc_html__( 'Contain', 'mygrace' ),
	) );
}

/**
 * Get background repeat
 *
 * @since 1.0.0
 * @return array
 */
function mygrace_get_bg_repeat() {
	return apply_filters( 'mygrace_get_bg_repeat', array(
		'no-repeat' => esc_html__( 'No Repeat', 'mygrace' ),
		'repeat'    => esc_html__( 'Tile', 'mygrace' ),
		'repeat-x'  => esc_html__( 'Tile Horizontally', 'mygrace' ),
		'repeat-y'  => esc_html__( 'Tile Vertically', 'mygrace' ),
	) );
}

/**
 * Get background attachment
 *
 * @since 1.0.0
 * @return array
 */
function mygrace_get_bg_attachment() {
	return apply_filters( 'mygrace_get_bg_attachment', array(
		'scroll' => esc_html__( 'Scroll', 'mygrace' ),
		'fixed'  => esc_html__( 'Fixed', 'mygrace' ),
	) );
}

/**
 * Get text color
 *
 * @since 1.0.0
 * @return array
 */
function mygrace_get_text_color() {
	return apply_filters( 'mygrace_get_text_color', array(
		'light' => esc_html__( 'Light', 'mygrace' ),
		'dark'  => esc_html__( 'Dark', 'mygrace' ),
	) );
}


/**
 * Return array of arguments for dynamic CSS module
 *
 * @return array
 */

function mygrace_get_dynamic_css_options() {
	return apply_filters( 'mygrace-theme/dynamic_css/options', array(
		'prefix'        => 'mygrace',
		'type'          => 'theme_mod',
		'parent_handles' => array(
			'css' => 'mygrace-theme-style',
			'js'  => 'mygrace-theme-js',
		),
		'css_files'      => array(
			get_theme_file_path( 'assets/css/dynamic.css' ),
			get_theme_file_path( 'assets/css/dynamic/header.css' ),
			get_theme_file_path( 'assets/css/dynamic/footer.css' ),
			get_theme_file_path( 'assets/css/dynamic/menus.css' ),
			get_theme_file_path( 'assets/css/dynamic/social.css' ),
			get_theme_file_path( 'assets/css/dynamic/navigation.css' ),
			get_theme_file_path( 'assets/css/dynamic/buttons.css' ),
			get_theme_file_path( 'assets/css/dynamic/forms.css' ),
			get_theme_file_path( 'assets/css/dynamic/post.css' ),
			get_theme_file_path( 'assets/css/dynamic/page.css' ),
			get_theme_file_path( 'assets/css/dynamic/post-grid.css' ),
			get_theme_file_path( 'assets/css/dynamic/widgets.css' ),
			get_theme_file_path( 'assets/css/dynamic/plugins.css' ),
		),
		'options_cb'     => 'get_theme_mods',
	) );
}

/**
 * Return true if setting is value. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @param  string $setting Setting name to check.
 * @param  string $value   Setting value to compare.
 * @return bool
 */
function mygrace_is_setting( $control, $setting, $value ) {

	if ( $value == $control->manager->get_setting( $setting )->value() ) {
		return true;
	}

	return false;
}

/**
 * Get default footer copyright.
 *
 * @since  1.0.0
 * @return string
 */
function mygrace_get_default_footer_copyright() {
	return esc_html__( '%%site-name%% © %%year%%. All rights reserved.', 'mygrace' );
}

/**
 * Return true if blog sidebar enabled.
 *
 * @return bool
 */
function mygrace_is_blog_sidebar_enabled() {
	return apply_filters( 'mygrace-theme/customizer/blog-sidebar-enabled', true );
}

/**
 * Return true if blog columns enabled.
 *
 * @return bool
 */
function mygrace_is_blog_columns_enabled() {
	return apply_filters( 'mygrace-theme/customizer/blog-columns-enabled', true );
}

/**
 * Load dynamic logic for the customizer controls area.
 *
 * @since 1.0.0
 */
function mygrace_customize_controls_assets() {
	wp_enqueue_script( 'mygrace-theme-customizer-controls', get_theme_file_uri('assets/js/customizer-controls.js' ), array( 'customize-controls' ), mygrace_theme()->version, true );

	wp_localize_script( 'mygrace-theme-customizer-controls', 'mygraceControlsConditions', mygrace_get_customize_controls_conditions() );
}

add_action( 'customize_controls_enqueue_scripts', 'mygrace_customize_controls_assets' );

/**
 * Get customize controls conditions.
 *
 * @since  1.0.0
 * @return array
 */
function mygrace_get_customize_controls_conditions() {

	$customize_options = mygrace_get_customizer_options();
	$controls_args     = $customize_options['options'];

	$results = array();

	foreach ( $controls_args as $control => $args ) {
		if ( isset( $args['conditions'] ) ) {
			$results[ $control ] = $args['conditions'];
		}
	}

	return $results;
}