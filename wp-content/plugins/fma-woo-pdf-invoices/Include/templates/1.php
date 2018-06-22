<?php  if ( ! defined( 'ABSPATH' ) ) exit;  

global $wpdb, $post;

require fme_pdf_invoices_plguin_dir.'settings.php';

$piclistid = $_GET['order_ids'];
$my_piclist_ids = explode(",",$piclistid);



$html ='
						<style>
						.packingsli_order_tr {
				font-size: 14px;
				color: black;
				background-color: #f7f7f7;
				font-weight:bold;
			}
						.border-bottom:1px solid black;
			}
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

			    $html .= '<tr style="background-color: #e6e6e6;" class="heading_cells">';
			    
			    $html .= '<td width="320">';
			    		
			    $html .= '<table width="100%" cellpadding="8" cellspacing="0" border="0">';

			    $html .= '<tr><td style="text-align:left;"><img width="auto" height="auto" src="'.$companylogo.'"></td></tr>';

			    $html .= '</table>';
			    	
			    $html .= '</td>';

			    $html .= '<td width="320">';
			    		
			    $html .= '<table  width="100%" cellpadding="10" cellspacing="12" border="0">';
				
				$html .= '<tr><td style="font-size:18px; color: black; background-color: #e6e6e6;" class="heading_cells heading_alingmentleft" >'.$companyname.'</td></tr>';

			    $html .= '</table>';
			    					    	
			    $html .= '</td>';

			    $html .='</tr>';
						
		$html .= '</table>';

		$html .='<table width="640" cellpadding="" cellspacing="0" border="0">
			<tr><td>&nbsp;</td></tr>
	
			<tr><td>&nbsp;</td></tr>
		
		</table>';


		$html .='<table cellpadding="4" cellspacing="2" border="0">
				<tr style="font-size:18px; color: black; background-color: #e6e6e6;" class="heading_cells">
		        <td class="heading_alingmentcenter">Item #</td>    
		        <td class="heading_alingmentcenter">Description</td>	            
		        <td class="heading_alingmentcenter">Quantity</td>
		    	</tr>';
	

		foreach ($my_piclist_ids as $single_id) {	
		$order = new WC_Order( $single_id );
		$html.='<tr>
			<td class="packingsli_order_tr" colspan="3">Order Number: #'.$order->id.'</td>
		</tr>';
		$items = $order->get_items();				
		$i=1;
		foreach ($items as $item ) {
		$product = new WC_Product($item['product_id']);
				
		$html .='<tr  class=" heading_cellsdata">
					<td class="heading_cellsdata heading_alingmentcenter">
							<span>'.$i.'</span>
					</td>
					<td class="heading_cellsdata heading_alingmentcenter">
							<span>'.$item['name'].'</span>
					</td>
					<td class="heading_cellsdata heading_alingmentcenter">
							<span>'.$item['qty'].'</span>
					</td>
				</tr>';
				
				$i++;}}

		$html.='<tr><td colspan="1">&nbsp;</td></tr>
				</table>';

$html .='<table width="640" cellpadding="" cellspacing="0" border="0">
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
		</table>';
		$html .='<table width="640" cellpadding="" cellspacing="0" border="0">
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
		</table>';


$html .='<table align="center" class="aftermain-tss-head" width="640" cellpadding="" cellspacing="0" border="0">
			<tr>
				<td ><img height="80" width="80" src="'.fme_pdf_invoices_url.'img/gift.png"></td>
			</tr>
			
			<tr>
				<td style="font-size: 12px;">'.$companyterms.'</td>
			</tr>
		</table>';
$html .='<table align="center" class="aftermain-tss-head" width="640" cellpadding="" cellspacing="0" border="0">
			<tr>
				<td style="font-size: 12px; ">'.$companyname.'</td>
			</tr>
			<tr>
				<td style="font-size: 12px; ">'.$companyaddress.'</td>
			</tr>
			<tr>
				<td style="font-size: 12px; ">'.$companyph.'</td>
			</tr>
			<tr>
				<td style="font-size: 12px; ">'.$companyemail.'</td>
			</tr>
			<tr>
				<td style="font-size: 12px; " >'.$companyfax.'</td>
			</tr>
		</table>';

return $html;