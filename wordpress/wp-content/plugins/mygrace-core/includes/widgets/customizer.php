<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


class CustomizeShareBox extends MygraceShareBox {

	/**
	 * Constructor.
	*/

	public function __construct() {
		$this->init();
	}

	public function init (){

		$theme = wp_get_theme();

		if ( 'Mygrace' == $theme->name ) {
			add_filter( 'mygrace-theme/customizer/options', array( $this, 'add_sections_mygrace' ) );
		} else {
			add_action( 'customize_register', array( $this, 'add_sections' ) );
		}
	}

	/**
	 * Add settings to the customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_sections_mygrace( $options){

		$new_options = array(

			'sharebox_checkbox' => array(
				'title' 			=> __( 'Show Share Box', 'mygrace_core'),
				'section' 			=> 'blog_post',
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
				'priority' 			=> 200,
			),

			'prefix_sharebox' => array(
				'title'           => __( 'Prefix Share Box', 'mygrace_core' ),
				'section'         => 'blog_post',
				'default'         => __( 'Share this post:', 'mygrace_core' ),
				'field'           => 'text',
				'type'            => 'control',
				'priority' 		  => 205,
				'conditions' 		=> array(
					'sharebox_checkbox' 	=> true,
				),
			),

			'sharebox_checkbox_list' => array(
				'title' 			=> __( 'Show Share Box', 'mygrace_core'),
				'section' 			=> 'blog',
				'field' 			=> 'checkbox',
				'type' 				=> 'control',
				'priority' 			=> 200,
			),
		);

		$options['options'] = array_merge( $new_options, $options['options'] );

		return $options;
	}

	/**
	 * Add settings to the customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_sections( $wp_customize ) {

		$wp_customize->add_section(
		'sharebox', 
		 array(
	        'title'    => __('Share Box', 'mygrace_core'),
	        'description' => '',
	        'priority' => 120,
	     ));

		$this->sharebox_customize_register( $wp_customize );
  
	}

	/**
	 * Add settings to the customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function sharebox_customize_register($wp_customize){
	     
		$wp_customize->add_setting(
	   	'sharebox_checkbox', 
	   	array(
	        'capability' => 'edit_theme_options',
	        'type'       => 'theme_mod',
	    ));
	  
	    $wp_customize->add_control(
	    'display_sharebox', 
	    	array(
	        'settings' => 'sharebox_checkbox',
	        'label'    => __('Post Show Share Box', 'mygrace_core'),
	        'section'  => 'sharebox',
	        'type'     => 'checkbox',
	    ));

	    $wp_customize->add_setting(
	   	'sharebox_checkbox_list', 
	   	array(
	        'capability' => 'edit_theme_options',
	        'type'       => 'theme_mod',
	    ));
	  
	    $wp_customize->add_control(
	    'display_sharebox_list', 
	    	array(
	        'settings' => 'sharebox_checkbox_list',
	        'label'    => __('Blog Show Share Box', 'mygrace_core'),
	        'section'  => 'sharebox',
	        'type'     => 'checkbox',
	    ));

	   $wp_customize->add_setting(
	   	'prefix_sharebox', 
	   	array(
	        'capability'         => 'edit_theme_options',
	        'type'               => 'theme_mod',
	        'default'            => __( 'Share this post:', 'mygrace_core' ),
	        'sanitize_callback'  => 'sanitize_text_field',
			'transport'          => $transport
	    ));

	    $wp_customize->add_control(
		    'prefix_display',
		    array(
		        'label'          => __( 'Prefix Share Box:', 'mygrace_core' ),
		        'section'         => 'sharebox',
		        'type'            => 'text',
		        'priority' 		  => 205,
		        'settings'        => 'prefix_sharebox',
		    )
		);
	}
}

new CustomizeShareBox();


