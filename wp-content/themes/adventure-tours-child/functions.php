<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'theme-addons','icons-font-eacdffcb47671063ccfb2692ad687558' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css' );

// END ENQUEUE PARENT ACTION

add_filter( 'wpo_wcpdf_raw_document_number', 'wpo_wcpdf_raw_document_number', 10, 4 );
function wpo_wcpdf_raw_document_number( $number, $settings, $document, $order ) {
    if ( $document->get_type() == 'invoice' ) {
        $number = $order->get_order_number();
    }
 
    return $number;

add_filter( 'wp_nav_menu_items','add_search_box', 10, 2 );
function add_search_box( $items, $args ) {
$items .= '<li>' . get_search_form( false ) . '</li>';
return $items;
}
}