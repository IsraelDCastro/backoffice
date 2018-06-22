<?php  if ( ! defined( 'ABSPATH' ) ) exit;  

//pdf invoices front class
class fme_pdfinvoices_frontclass extends fme_pdfinvoices_mainclass {
	
	

    //front class constructor
    public function __construct(){
    	
    	add_filter( 'woocommerce_my_account_my_orders_actions', array($this,'fme_invoice_my_account_order_actions'), 10, 2 );
		
	}

	function fme_invoice_my_account_order_actions( $actions, $order ) {


		$actions['name'] = array(
	       'url' => wp_nonce_url(admin_url( 'admin-ajax.php?template=1&action=fmea_pdfa_invoice&mode=myaccount&order_ids=' . $order->id )),
					'alt'		=> __( 'PDF Invoice', 'wpo_wcpdf' ),
	        'name' => 'PDF Invoice',
    	);
		return $actions;
	}

}
new fme_pdfinvoices_frontclass();




