<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}


function register_my_menus() {
  register_nav_menus(
    array(
      'lateral-menu' => __( 'Lateral Menu' ),
	  'footer2-menu' => __( 'Footer2 Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );