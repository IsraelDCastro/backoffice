<?php  if ( ! defined( 'ABSPATH' ) ) exit;  
		global $wpdb, $post;

				require fme_pdf_invoices_plguin_dir.'settings.php';
				
				
				$order_details	= $wpdb->get_results("select * from ".$wpdb->prefix."posts where ID =".$pdf_invoice_order_id);
				foreach($order_details as $order) {
					//echo $order->post_status;
				} 

				if($order->post_status == 'wc-pending'){
					$orderstatus = 'Pending payment';
				}elseif($order->post_status == 'wc-processing'){
					$orderstatus = 'Processing';
				}elseif($order->post_status == 'wc-on-hold'){
					$orderstatus = 'On hold';
				}elseif($order->post_status == 'wc-completed'){
					$orderstatus = 'Completed';
				}elseif($order->post_status == 'wc-cancelled'){
					$orderstatus = 'Cancelled';
				}elseif($order->post_status == 'wc-refunded'){
					$orderstatus = 'Refunded';
				}elseif($order->post_status == 'wc-failed'){
					$orderstatus = 'Failed';
				}

		
				$html ='
						<style>
								.heading_cellsdata{
									font-size: 13px;
									background-color:#f7f7f7;
									text-align:center;
								}
								.heading_cellsinvdata{
									font-size: 15px;
									background-color:#e6e6e6;;
									text-align:center;
								}						
								.heading_alingmentleft{
									text-align:left;
								}
								.heading_alingmentcenter{
									text-align:center;
								}
								.heading_alingmentright{
									text-align:right;
								}
								.inner_text{
									font-size:12px;
								}
								strong.bold_heading{
									font-size:12px;
								}
						</style>
						';

				$html .= '<table  align="center" width="640" cellpadding="0" cellspacing="0" border="0">';

			    $html .= '<tr style="background-color: #e6e6e6;;" class="heading_cells">';
			    
			    $html .= '<td width="320">';
			    		
			    $html .= '<table width="100%" cellpadding="8" cellspacing="0" border="0">';

			    $html .= '<tr><td style="text-align:left;"><img width="auto" height="auto" src="'. $companylogo.'"></td></tr>';

			    $html .= '</table>';
			    	
			    $html .= '</td>';

			    $html .= '<td width="320">';
			    		
			    $html .= '<table  width="100%" cellpadding="8" cellspacing="0" border="0">';

				

			    $html .= '</table>';
			    					    	
			    $html .= '</td>';

			    $html .='</tr>';
					
				$html .= '<tr><td colspan="1">&nbsp;</td></tr>
				<tr><td colspan="1">&nbsp;</td></tr>
					<tr><td colspan="1">&nbsp;</td></tr>';
					
					$html .= '<tr>';
						$html .= '<td>';
							$html .= '<table cellpadding="3" cellspacing="2" border="0">';
								$html .= '<tr>';
									$html .= '<td style="font-size:18px;color: #000000; background-color: #e6e6e6;" class="heading_cells heading_alingmentleft">';
									$html .= '<span>Invoice Information</span>';
									$html .= '</td>';
								$html .= '</tr>';

								$html .= '<tr>';
									$html .= '<td  class="heading_alingmentleft">';
									$html .= '<strong class="bold_heading">Date:</strong><span style="font-size: 12px"> '.date("d-M-Y", strtotime($order->post_date)).'</span>';
									$html .= '</td>';
								$html .= '</tr>';

								

								$html .= '<tr>';
									$html .= '<td class="heading_alingmentleft">';
									$html .= '<strong class="bold_heading">Invoice Number:</strong><span style="display: '.$invoicnumber.'; font-size: 12px"> '.$order->ID.'</span>';
									$html .= '</td>';
								$html .= '</tr>';

								

								$html .= '<tr>';
									$html .= '<td class="heading_alingmentleft">';
									$html .= '<strong class="bold_heading">Order Status:</strong><span style="font-size: 12px"> '.$orderstatus.'</span>';
									$html .= '</td>';
								$html .= '</tr>';

							$html .= '</table>';
						$html .= '</td>';

						$html .= '<td>';
							$html .= '<table cellpadding="3" cellspacing="2" border="0">';
								$html .= '<tr>';
									$html .= '<td style="font-size:18px; color: #000000; background-color: #e6e6e6;" class="heading_cells heading_alingmentleft" >';
									$html .= '<span >'.$companyname.'</span>';
									$html .= '</td>';
								$html .= '</tr>';

								$html .= '<tr>';
									$html .= '<td class="heading_alingmentleft">';
									$html .= '<strong class="bold_heading">Company Address:</strong><span style="font-size: 12px"> '.$companyaddress.'</span>';
									$html .= '</td>';
								$html .= '</tr>';

								$html .= '<tr>';
									$html .= '<td class="heading_alingmentleft">';
									$html .= '<strong class="bold_heading">Phone Number:</strong><span style="font-size: 12px"> '.$companyph.'</span>';
									$html .= '</td>';
								$html .= '</tr>';

								

								$html .= '<tr>';
									$html .= '<td class="heading_alingmentleft">';
									$html .= '<strong class="bold_heading">Email ID:</strong><span style="font-size: 12px"> '.$companyemail.'</span>';
									$html .= '</td>';
								$html .= '</tr>';

							$html .= '</table>';
						$html .= '</td>';
					
					$html .= '</tr>
					<tr><td colspan="1">&nbsp;</td></tr>
					<tr><td colspan="1">&nbsp;</td></tr>
					<tr><td colspan="1">&nbsp;</td></tr>
					';
						
				$html .= '</table>';

				

				$html .='<table  align="center" width="640" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>
							<table cellpadding="3" cellspacing="2" border="0">
								<tr>
									<td style="font-size:18px; color: #000000; background-color: #e6e6e6;" class="heading_cells heading_alingmentleft">
										<span>Billing Address</span>
									</td>
								</tr>
								<tr>
									<td style="display: '.$b_address_show_hide.'" class="heading_alingmentleft">
										<span class="inner_text">'.$billingfname.' '.$billinglname.'</span><br>
										<span style="font-size: 12px">'.$billingcompnay.'</span><br>
										<span style="font-size: 12px">'.$billingaddress.'</span><br>
										<span style="font-size: 12px">'.$billingcountry.'</span><br>
										<span style="font-size: 12px">'.$billingemail.'</span><br>
										<span style="font-size: 12px">'.$billingphone.'</span><br>
									</td>
								</tr>
							</table>
						</td>
						<td>
							<table cellpadding="3" cellspacing="2" border="0">
								<tr>
									<td style="font-size:18px; color: #000000; background-color: #e6e6e6;" class="heading_cells heading_alingmentleft">
										<span>Shipping Address</span>
									</td>
								</tr>
								<tr>
									<td style="display: '.$s_address_show_hide.'" class="heading_alingmentleft">
										<span class="inner_text">'.$shippingfname.' '.$billinglname.'</span><br>
										<span style="font-size: 12px">'.$shippingcompnay.'</span><br>
										<span style="font-size: 12px">'.$shippingaddress.'</span><br>
										<span style="font-size: 12px">'.$shippingcountry.'</span><br>
										<span style="font-size: 12px">'.$shippingemail.'</span><br>
										<span style="font-size: 12px">'.$shippingphone.'</span><br>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td colspan="1">&nbsp;</td></tr>
					<tr><td colspan="1">&nbsp;</td></tr>
				</table>
				';


				$html .='<table  align="center" width="640" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>
							<table cellpadding="3" cellspacing="2" border="0">
								<tr>
									<td style="font-size:18px; color: #000000; background-color: #e6e6e6;" class="heading_cells heading_alingmentleft">
										<span>Payment Method</span>
									</td>
								</tr>
								<tr>
									<td class="heading_alingmentleft">
										<span style="font-size: 12px">'.$paymentmethod.'</span>
									</td>
								</tr>							
							</table>
						</td>
						<td>
							<table cellpadding="3" cellspacing="2" border="0">
								<tr>
									<td style="font-size:18px; color: #000000; background-color: #e6e6e6;" class="heading_cells heading_alingmentleft">
										<span>Shipping Method</span>
									</td>
								</tr>
								<tr>
									<td class="heading_alingmentleft">
										<span style="font-size: 12px">'.$shippingmethod.'</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr><td colspan="1">&nbsp;</td></tr>
					<tr><td colspan="1">&nbsp;</td></tr>
				</table>
				';

				$html .='<table cellpadding="4" cellspacing="2" border="0">
					<tr style="font-size:18px; color: #000000; background-color: #e6e6e6;" class="heading_cells">
						<td class="heading_alingmentcenter">
							<span>Product</span>
						</td>
						<td class="heading_alingmentcenter">
							<span>Sku</span>
						</td>
						<td class="heading_alingmentcenter ">
							<span>Price</span>
						</td>
						<td class="heading_alingmentcenter ">
							<span>Quantity</span>
						</td>
						<td class="heading_alingmentcenter">
							<span>Total</span>
						</td>
					</tr>';
	$get_orderitemd = $wpdb->get_results("select o.order_item_name, o.order_item_id, o.order_item_type, om.meta_key, om.meta_value FROM ".$wpdb->prefix."woocommerce_order_items as o INNER JOIN ".$wpdb->prefix."woocommerce_order_itemmeta as om ON o.order_item_id = om.order_item_id WHERE o.order_id=".$pdf_invoice_order_id);


		$order = new WC_Order( $pdf_invoice_order_id );
		$items = $order->get_items();				
							foreach ($items as $item ) {
		$product = new WC_Product($item['product_id']);
				$html .='<tr  class=" heading_cellsdata">
						<td class="heading_cellsdata heading_alingmentcenter">
							<span>'.$item['name'].'</span>
						</td>
						<td class="heading_cellsdata heading_alingmentcenter">
							<span>'.$product->get_sku().'</span>
						</td>
						<td class="heading_cellsdata heading_alingmentcenter">
							
							<span>'.wc_price($order->get_item_total($item ), array(
										    'ex_tax_label'       => false,
										    'currency'           => '',
										    'decimal_separator'  => wc_get_price_decimal_separator(),
										    'thousand_separator' => wc_get_price_thousand_separator(),
										    'decimals'           => wc_get_price_decimals(),
										    'price_format'       => get_woocommerce_price_format()
							) ).'</span>

						</td>
						<td class="heading_cellsdata heading_alingmentcenter">
							<span>x '.$item['qty'].'</span>
						
						</td>
						<td class="heading_cellsdata heading_alingmentcenter">
							
							<span>'.wc_price($item['line_total'], array(
										    'ex_tax_label'       => false,
										    'currency'           => '',
										    'decimal_separator'  => wc_get_price_decimal_separator(),
										    'thousand_separator' => wc_get_price_thousand_separator(),
										    'decimals'           => wc_get_price_decimals(),
										    'price_format'       => get_woocommerce_price_format()
							) ).'</span>

						</td>
					</tr>';
				}

				$html.='<tr><td colspan="1">&nbsp;</td></tr>
				</table>';



				$html .='<table  align="center" width="640" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td>
							<table cellpadding="3" cellspacing="2" border="0">
								
								<tr>
									<td class="heading_alingmentleft">
										<strong class="bold_heading">Note:</strong><span style="font-size: 12px"> '.$companynote.'</span>
									</td>
								</tr>
								<tr>
									<td class="heading_alingmentleft">
										<strong class="bold_heading">Terms:</strong><span style="font-size: 12px"> '.$companyterms.'</span>
									</td>
								</tr>							
							</table>
						</td>
						<td>
							<table width="315" cellpadding="3" cellspacing="0" border="0">
								<tr>
									<td class="heading_alingmentleft">
										<strong class="bold_heading">Subtotal</strong>
									</td>
									<td class="heading_alingmentcenter">
										<span style="display: '.$invoice_stotal_hide.'; font-size: 12px">'.wc_price($order->get_total(), array(
										    'ex_tax_label'       => false,
										    'currency'           => '',
										    'decimal_separator'  => wc_get_price_decimal_separator(),
										    'thousand_separator' => wc_get_price_thousand_separator(),
										    'decimals'           => wc_get_price_decimals(),
										    'price_format'       => get_woocommerce_price_format()
							) ).'</span>
									</td>
								</tr>
								<tr>
									<td class="heading_alingmentleft">
										<strong class="bold_heading">Tax</strong>
									</td>
									<td class="heading_alingmentcenter">
										<span style="display: '.$invoice_tax_show_hide.'; font-size: 12px">'.wc_price($order->get_total_tax(), array(
										    'ex_tax_label'       => false,
										    'currency'           => '',
										    'decimal_separator'  => wc_get_price_decimal_separator(),
										    'thousand_separator' => wc_get_price_thousand_separator(),
										    'decimals'           => wc_get_price_decimals(),
										    'price_format'       => get_woocommerce_price_format()
							) ).'</span>
									</td>
								</tr>	
								<tr>	
									<td class="heading_alingmentleft">
										<strong class="bold_heading">Shipping & Handling</strong>
									</td>
									<td class="heading_alingmentcenter">
										<span style="font-size: 12px">'.wc_price($order->get_shipping_tax(), array(
										    'ex_tax_label'       => false,
										    'currency'           => '',
										    'decimal_separator'  => wc_get_price_decimal_separator(),
										    'thousand_separator' => wc_get_price_thousand_separator(),
										    'decimals'           => wc_get_price_decimals(),
										    'price_format'       => get_woocommerce_price_format()
							) ).'</span>
									</td>
								</tr>
								<tr><td colspan="1">&nbsp;</td></tr>
								<tr><td colspan="1">&nbsp;</td></tr>
								<tr >
									<td style="font-size:18px; color: #000000; background-color: #e6e6e6;"  class="heading_cellsinvdata ">
										<span>Grand Total</span>
									</td>
									<td style="font-size:18px; color: #000000; background-color: #e6e6e6;" class="heading_cellsinvdata ">
										<span>'.wc_price($order->get_total(), array(
										    'ex_tax_label'       => false,
										    'currency'           => '',
										    'decimal_separator'  => wc_get_price_decimal_separator(),
										    'thousand_separator' => wc_get_price_thousand_separator(),
										    'decimals'           => wc_get_price_decimals(),
										    'price_format'       => get_woocommerce_price_format()
							) ).'</span>
									</td>
								</tr>
								<tr><td colspan="1">&nbsp;</td></tr>
								<tr><td colspan="1">&nbsp;</td></tr>
							</table>
						</td>
					</tr>
					<tr><td colspan="1">&nbsp;</td></tr>
					<tr><td colspan="1">&nbsp;</td></tr>
				</table>
				';



				return $html;


