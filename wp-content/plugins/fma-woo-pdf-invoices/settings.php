<?php  if ( ! defined( 'ABSPATH' ) ) exit;  
				
				global $wpdb, $post;

				$pdf_invoice_order_id = intval($_GET['order_ids']);
				
				//company name
			 	$order = new WC_Order( $pdf_invoice_order_id );

		
			 	$shippingmethod =	$order ->get_shipping_method();
			 	if($shippingmethod != ''){
			 		$shippingmethod =	$order ->get_shipping_method();
			 	}else{
			 		$shippingmethod = 'No Method';
			 	}

			 	$companyname = get_option( 'pdf_company_name_setting');
			 	if($companyname != ''){
			 		$companyname = get_option( 'pdf_company_name_setting');
			 	}else {
			 		$companyname = "Fme Woocommerece Extention";
			 	}

			 	//company logo
			 	$companylogo = get_option( 'pdf_company_logo_setting');
			 	if($companylogo != ''){
			 		$companylogo = get_option( 'pdf_company_logo_setting');
			 	}else {

			 		$custom_logo_id = get_theme_mod( 'custom_logo' );
					$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			 		$companylogo = $image[0];
			 	}

			 	//company address
			 	$companyaddress = get_option( 'pdf_company_address_setting');
			 	if($companyaddress != ''){
			 		$companyaddress = get_option( 'pdf_company_address_setting');
			 	}else {
			 		$companyaddress = "Company Address";
			 	}

			 	//company phone number
			 	$companyph = get_option( 'pdf_company_phone_setting');
			 	if($companyph != ''){
			 		$companyph = get_option( 'pdf_company_phone_setting');
			 	}else {
			 		$companyph = "Company Phone Number";
			 	}

			 	
			 	//company fax number
			 	$companyemail = get_option( 'pdf_company_email_setting');
			 	if($companyemail != ''){
			 		$companyemail = get_option( 'pdf_company_email_setting');
			 	}else {
			 		$companyemail = " Company Email Address";
			 	}	
			 	

			 	//company header heading 
			 	$companyterms = get_option( 'pdf_company_termconditon_setting');
			 	if($companyterms != ''){
			 		$companyterms = get_option( 'pdf_company_termconditon_setting');
			 	}else {
			 		$companyterms = "Company term and condition goes here";
			 	}	

			 	//company header heading text
			 	$companynote = get_option( 'pdf_company_note_setting');
			 	if($companynote != ''){
			 		$companynote = get_option( 'pdf_company_note_setting');
			 	}else {
			 		$companynote = "Company note goes here";
			 	}

			 	$billingfname = get_post_meta($pdf_invoice_order_id, '_billing_first_name', true);
			 	$billinglname = get_post_meta($pdf_invoice_order_id, '_billing_last_name', true);
			 	$billingcompnay = get_post_meta($pdf_invoice_order_id, '_billing_company', true);
			 	$billingaddress = get_post_meta($pdf_invoice_order_id, '_billing_address_1', true);
			 	$billingcountry = get_post_meta($pdf_invoice_order_id, '_billing_state', true);
				$billingemail = get_post_meta($pdf_invoice_order_id, '_billing_email', true);
				$billingphone = get_post_meta($pdf_invoice_order_id, '_billing_phone', true);

				$shippingfname = get_post_meta($pdf_invoice_order_id, '_shipping_first_name', true);
			 	$shippinglname = get_post_meta($pdf_invoice_order_id, '_shipping_last_name', true);
			 	$shippingcompnay = get_post_meta($pdf_invoice_order_id, '_shipping_company', true);
			 	$shippingaddress = get_post_meta($pdf_invoice_order_id, '_shipping_address_1', true);
			 	$shippingcountry = get_post_meta($pdf_invoice_order_id, '_shipping_state', true);
				$shippingemail = get_post_meta($pdf_invoice_order_id, '_shipping_email', true);
				$shippingphone = get_post_meta($pdf_invoice_order_id, '_shipping_phone', true);

				$paymentmethod = get_post_meta($pdf_invoice_order_id, '_payment_method_title', true);
				

			 	//invoice # display hide
			 	$invoicnumber = get_option( 'pdf_invoice_number_setting');
			 	if($invoicnumber != ''){
			 		$invoicnumber = get_option( 'pdf_invoice_number_setting');
			 	}else {
			 		$invoicnumber = "block";
			 	}
			 	
			 	//shipping address hide show
			 	$s_address_show_hide = get_option( 'pdf_address_shipping_setting');
			 	if($s_address_show_hide != ''){
			 		$s_address_show_hide = get_option( 'pdf_address_shipping_setting');
			 	}else {
			 		$s_address_show_hide = "block";
			 	}
			 	
			 	//billing address hide show
			 	$b_address_show_hide = get_option( 'pdf_address_billing_setting');
			 	if($b_address_show_hide != ''){
			 		$b_address_show_hide = get_option( 'pdf_address_billing_setting');
			 	}else {
			 		$b_address_show_hide = "block";
			 	}

			 	//tax hide show
			 	$invoice_tax_show_hide = get_option( 'pdf_invoice_tax_setting');
			 	if($invoice_tax_show_hide != ''){
			 		$invoice_tax_show_hide = get_option( 'pdf_invoice_tax_setting');
			 	}else {
			 		$invoice_tax_show_hide = "block";
			 	}

			 	//subtotal hide show

			 	$invoice_stotal_hide = get_option( 'pdf_invoice_stotal_setting');
			 	if($invoice_stotal_hide != ''){
			 		$invoice_stotal_hide = get_option( 'pdf_invoice_stotal_setting');
			 	}else {
			 		$invoice_stotal_hide = "block";
			 	}

			 	

			 
