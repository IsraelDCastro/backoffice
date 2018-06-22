<?php 

/*
Plugin Name: Fme Pdf Invoices & Picklist Free
Plugin URI: http://xyz.com
Description: For the purpose of order invoices and picking slip (free version).
Author: FMEs Addons
Version: 1.0.1
textdomain: fme_pdfinvoices_domain
Author URI: http://TehseeRajpoot/
Developer: Tehseen Rajpoot
*/


//If not user for security purpose
if ( ! defined( 'ABSPATH' ) ) exit; 

	//Exit if woocommerce not installed
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

		function fme_pdf_woocommerceactivation() {

			// Deactivate the plugin
			deactivate_plugins(__FILE__);
			$error_message = __('<div class="error notice"><p>This plugin requires <a href="http://wordpress.org/extend/plugins/woocommerce/">WooCommerce</a> plugin to be installed and active!</p></div>', 'woocommerce');
			die($error_message);
		}
		
		add_action( 'admin_notices', 'fme_pdf_woocommerceactivation' );
	}



//pdf invoices Main class
class fme_pdfinvoices_mainclass {
	
	//constructor main class
	public function __construct() {
		
		//Module Constant	
		$this->module_constant();
		//checking pages
		if(is_admin()){
			require_once( fme_pdf_invoices_plguin_dir.'Fme-pdf-inv-admin.php');
		}else {
			require_once( fme_pdf_invoices_plguin_dir.'Fme-pdf-inv-front.php');
		}
		
	}
	
	
	//module constant 
	function module_constant() {

		if ( !defined( 'fme_pdf_invoices_url' ) )
	    define( 'fme_pdf_invoices_url', plugin_dir_url( __FILE__ ) );

	    if ( !defined( 'fme_pdf_invoices_basename' ) )
	    define( 'fme_pdf_invoices_basename', plugin_basename( __FILE__ ) );

	    if ( ! defined( 'fme_pdf_invoices_plguin_dir' ) )
	    define( 'fme_pdf_invoices_plguin_dir', plugin_dir_path( __FILE__ ) ); 
}
	


	//enqueue the scripts and style
	function init() { 

		wp_enqueue_script('jquery');	
		
		if ( function_exists( 'load_plugin_textdomain' ) )
		load_plugin_textdomain( 'fme_pdfinvoices_domain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		
	} 	

}
new fme_pdfinvoices_mainclass();