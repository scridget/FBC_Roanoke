<?php
  /* Function to enqueue stylesheet from parent theme */
  function child_enqueue__parent_scripts() {
    wp_enqueue_style( 'parent', get_template_directory_uri().'/style.css' );
  }

  add_action('wp_enqueue_scripts', 'child_enqueue__parent_scripts');

  /* Register required plugins */
  function child_register_required_plugins() {
    return [
      // [
      //   'name' => 'OAuth client Single Sign On',
      //   'slug' => 'mygrace-theme',
      // ],
    ];
  }

  add_action('tgmpa_register', 'child_register_required_plugins');
