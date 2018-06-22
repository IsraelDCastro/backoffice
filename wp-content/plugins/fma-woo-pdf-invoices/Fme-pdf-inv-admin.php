<?php  if ( ! defined( 'ABSPATH' ) ) exit;  


//pdf invoices admin class
class fme_pdfinvoices_adminclass extends fme_pdfinvoices_mainclass {
	
	public function __construct() {

		//init hook for scripts and style loading
		add_action('wp_loaded', array( $this, 'fme_admin_init'));
		//register menu item 
		add_action('admin_menu' , array($this,'fme_pdf_setting_function'));
		//adding action in order listing for view and download
		add_action('woocommerce_admin_order_actions_end', array( $this, 'fme_single_order_button'));
		//setting fields register
		add_action('admin_init', array($this,'fme_pdf_allsetting_fields'));
		//invoice generater
		add_action('wp_loaded', array($this, 'fme_invoice_data_collection'));
		//custom bulk for register menu of list
		add_action('admin_footer-edit.php', array($this,'fme_custom_bulk_admin_footer'));
		//getting value from bulk and print pick list
		add_action('load-edit.php', array($this,'fme_custom_bulk_action'));
		//for pick list
		add_action('wp_loaded', array($this, 'fme_getting_pick_list'));

	}


	//function for creating submenu in ctp
	function fme_pdf_setting_function() {

			add_submenu_page( 'woocommerce',
							  'FME PDF INVOICES',
							  'Fme PDF Invoices & List',
							  'manage_options',
							  'fme-pdf-invoices-page',
							  array($this,'fme_pdf_invoices_page_callback'));
	}
	
	
	//fucntion for pdf settings add option in submenu page
	function fme_pdf_invoices_page_callback() { ?>
	
		<div class="wrap">
			    <div id="icon-themes" class="icon32"></div>
			    <?php _e( '<h1>FME PDF INVOICE/LIST SETTINGS</h1>', 'fme_pdfinvoices_domain'); ?>
				<?php _e('<p>Please do not forget to save option.</p>','fme_pdfinvoices_domain'); ?> 
		    <?php settings_errors(); ?>
			
			<?php
			$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general_options';
			?>

			<h2 class="nav-tab-wrapper">
			
				<a href="?page=fme-pdf-invoices-page&tab=general_options" class="nav-tab <?php echo $active_tab == 'general_options' ? 'nav-tab-active' : ''; ?>">General</a>

			    <a href="?page=fme-pdf-invoices-page&tab=template_option" class="nav-tab <?php echo $active_tab == 'template_option' ? 'nav-tab-active' : ''; ?>">Template</a>
			</h2>

			<div id="setting-pdf">
					
				<img class="settingimage" src="<?php echo fme_pdf_invoices_url .'img/settingimage.jpg'?>">
					
				<?php _e( '<h3>FME WooCommerce PDF Invoices & Pick List</h3>', 'fme_pdfinvoices_domain' ); ?>
				<?php _e( '<p>This WooCommerce extension automatically Generate a PDF invoice and picking slip for orders. This PDF invoice also attached with order email to both customer and store admin. Includes a basic template as well as the possibility to modify/customize templates. In addition, you can set invoice as view in browser or download. There are alot of option you can set and make your invoice more beautify.</p>', 'fme_pdfinvoices_domain'); ?>
				<?php _e( '<h3>FME PDf Pro Features Click here for<a href="#" > Premium</a><h3>', 'fme_pdfinvoices_domain' ); ?>
				<?php _e( '<ul class="pdf_seting_ul">
					<li>Awesome background watermark</li>
					<li>Multiple templates (Six invoice templates).</li>
					<li>Font sizes and color option for invoice.</li>
					<li>Template color and customization options.</li>
					<li>Barcode option.</li>
				</ul>', 'fme_pdfinvoices_domain'); ?>
				
				
			</div>

		    <form method="post" action="options.php">
			        <?php
			           if( $active_tab == 'general_options' ) { 
			            settings_fields("gsection");
			            do_settings_sections("pdf_invoice_general_setting_section");  
			           }elseif ( $active_tab == 'template_option') {
			           	settings_fields("tsection");
			            do_settings_sections("pdf_invoice_template_setting_section");
						}
			            submit_button(); ?>          
			</form>
		</div>
	<?php }


	
	//Company Name
	function fme_pdf_companyname() {
		?>
		    <input type="text" name="pdf_company_name_setting" id="pdf_company_name_setting" value="<?php echo get_option('pdf_company_name_setting'); ?>" />
		    <p class="description">Enter Company Name for Invoice.</p>
		   
		<?php
	}

	//Company Email
	function fme_pdf_companyemail() {
		?>
		    <input type="text" name="pdf_company_email_setting" id="pdf_company_email_setting" value="<?php echo get_option('pdf_company_email_setting'); ?>" />
		    <p class="description">Enter Company Email for Invoice.</p>
		<?php
	}


	//Company logo
	function fme_pdf_companylogo() { ?>	
		
		<script type="text/javascript">
				
				jQuery(document).ready(function($){
				    jQuery('#logo-upload-btn').click(function(e) {
				        e.preventDefault();
				        var image = wp.media({ 
				            title: 'Upload Image',
				            multiple: false
				        }).open()
				        .on('select', function(e){
				            var uploaded_image = image.state().get('selection').first();
				            console.log(uploaded_image);
				            var image_url = uploaded_image.toJSON().url;
				            jQuery('#logodisplaydiv').attr('src', image_url);
				            jQuery('#pdf_company_logo_setting').val(image_url);
				            jQuery('#logo_remove_btn').show();

				        });
				    });
				});
				            
				jQuery(document).ready(function($){
				 	var imghid = jQuery('#pdf_company_logo_setting').val();
				 		if(imghid != ''){
				 			jQuery('#logo_remove_btn').show();
				 		}else{
				 			jQuery('#logo_remove_btn').hide();
				 		}
					jQuery('#logo_remove_btn').click(function(e){
						 e.preventDefault();
							jQuery("#logodisplaydiv").attr('src', '');
							jQuery('#pdf_company_logo_setting').val("");
							jQuery('#logo_remove_btn').hide();
					});
				 });
		</script>
			

			<div id="logodisplay"><img id="logodisplaydiv" src="<?php echo get_option('pdf_company_logo_setting'); ?>"></div>
		    <input type="hidden" name="pdf_company_logo_setting" id="pdf_company_logo_setting" value="<?php echo get_option('pdf_company_logo_setting'); ?>" />
		    <button id="logo_remove_btn" type="button" class="alignment_button pdf_button">Remove Logo</button>
		    <button id="logo-upload-btn" type="button" class="pdf_button">Upload Logo</button>
		    <p class="description">Company Logo for invoice.</p>
		<?php
	}

	//Company phone
	function fme_pdf_companyphone() {
		?>
		    <input type="number" name="pdf_company_phone_setting" id="pdf_company_phone_setting" value="<?php echo get_option('pdf_company_phone_setting'); ?>" />
		    <p class="description">Enter Company Phone Number</p>
		<?php
	}

	//company address
	function fme_company_address() { ?>

			<textarea rows="5" cols="45" name="pdf_company_address_setting" id="pdf_company_address_setting" placeholder="Comapany Address here..."><?php echo get_option('pdf_company_address_setting'); ?></textarea>
			<p class="description">Company address to display on invoice.</p>
			
		<?php
	}

	//company terms & condition
	function fme_company_termcondition() { ?>

			<textarea rows="5" cols="45" name="pdf_company_termconditon_setting" id="pdf_company_termconditon_setting" placeholder="Comapany terms and condition.."><?php echo get_option('pdf_company_termconditon_setting'); ?></textarea>
			<p class="description">Company term and condition to display on invoice.</p>
			
		<?php
	}

	//Company note
	function fme_company_note() { ?>

			<textarea rows="5" cols="45" name="pdf_company_note_setting" id="pdf_company_note_setting" placeholder="Comapany Note.."><?php echo get_option('pdf_company_note_setting'); ?></textarea>
			<p class="description">Company Note to display on invoice.</p>
			
		<?php
	}


	//View or download pdf order listing page
	function fme_companyinvoce_view_download() { ?>

			<select class="fme_select" name="pdf_invoice_viewdownload_setting">
				  
				  <option value="I"<?php echo selected( get_option('pdf_invoice_viewdownload_setting'), 'I') ?>>View</option>
				  <option value="D"<?php echo selected( get_option('pdf_invoice_viewdownload_setting'), 'D') ?>>Download</option>
			</select> 
			<p class="description">You can set invoice as view or download in order listing (admin) page from here.<br> Default is <strong>View</strong></p>
			
		<?php
	}

	//View or download pdf in my account page
	function fme_companyinvocemy_view_download() { ?>

			<select class="fme_select" name="pdf_invoice_viewdownloadmy_setting">
				  
				  <option value="I"<?php echo selected( get_option('pdf_invoice_viewdownloadmy_setting'), 'I') ?>>View</option>
				  <option value="D"<?php echo selected( get_option('pdf_invoice_viewdownloadmy_setting'), 'D') ?>>Download</option>
			</select> 
			<p class="description">You can set invoice as view or download in My Account (front-end) page from here.<br> Default is <strong>View</strong></p>
			
		<?php
	}

	//invoice attached with email
	function fme_companyinvoce_email() { ?>

			<select class="fme_select" name="pdf_invoice_email_setting">
				  
				  <option value="yes"<?php echo selected( get_option('pdf_invoice_email_setting'), 'yes') ?>>Yes</option>
				  <option value="no"<?php echo selected( get_option('pdf_invoice_email_setting'), 'no') ?>>No</option>
			</select> 
			<p class="description">Invoice attached with order for email<br> Default is <strong>Yes</strong></p>
			
		<?php
	}

	//enable disable shipping address
	function fme_company_shipping_address() { ?>

			<select class="fme_select" name="pdf_address_shipping_setting">
				  
				  <option value="block"<?php echo selected( get_option('pdf_address_shipping_setting'), 'block') ?>>Enable</option>
				  <option value="none"<?php echo selected( get_option('pdf_address_shipping_setting'), 'none') ?>>Disable</option>
			</select> 
			<p class="description">Display Company Shipping Address on invoice or not</p>
			
		<?php
	}


	//enable disable billing address
	function fme_company_billing_address() { ?>

			<select class="fme_select" name="pdf_address_billing_setting">
				  
				  <option value="block"<?php echo selected( get_option('pdf_address_billing_setting'), 'block') ?>>Enable</option>
				  <option value="none"<?php echo selected( get_option('pdf_address_billing_setting'), 'none') ?>>Disable</option>
			</select> 
			<p class="description">Display Company Billing Address on invoice or not</p>
			
		<?php
	}


	//display invoice number
	function fme_company_invoice_number() { ?>

			<select class="fme_select" name="pdf_invoice_number_setting">
				  
				  <option value="block"<?php echo selected( get_option('pdf_invoice_number_setting'), 'block') ?>>Enable</option>
				  <option value="none"<?php echo selected( get_option('pdf_invoice_number_setting'), 'none') ?>>Disable</option>
			</select> 
			<p class="description">Display invoice number</p>
			
		<?php
	}


		//display tax amount
	function fme_company_tax_number() { ?>

			<select class="fme_select" name="pdf_invoice_tax_setting">
				  
				  <option value="block"<?php echo selected( get_option('pdf_invoice_tax_setting'), 'block') ?>>Enable</option>
				  <option value="none"<?php echo selected( get_option('pdf_invoice_tax_setting'), 'none') ?>>Disable</option>
			</select> 
			<p class="description">Display Tax Amount on invoice</p>
			
		<?php
	}

	//display subtotal
	function fme_company_stotal_number() { ?>

			<select class="fme_select" name="pdf_invoice_stotal_setting">
				  
				  <option value="block"<?php echo selected( get_option('pdf_invoice_stotal_setting'), 'block') ?>>Enable</option>
				  <option value="none"<?php echo selected( get_option('pdf_invoice_stotal_setting'), 'none') ?>>Disable</option>
			</select> 
			<p class="description">Display Subtotal on invoice</p>
			
		<?php
	}



	//function for all setting fields
	function fme_pdf_allsetting_fields() {
		
		//setting section general
		add_settings_section('gsection', 'FME Woocommerece PDF Invoices General Setting Section', null, 'pdf_invoice_general_setting_section');
		//setting section template
		add_settings_section('tsection', 'FME Woocommerece PDF Invoices Template Setting Section', null, 'pdf_invoice_template_setting_section');
		
		
		//setting fields option
		add_settings_field('pdf_company_name_setting', 'Company Name', array($this,'fme_pdf_companyname'), 'pdf_invoice_general_setting_section', 'gsection');

		add_settings_field('pdf_company_email_setting', 'Company Email', array($this,'fme_pdf_companyemail'), 'pdf_invoice_general_setting_section', 'gsection');

		add_settings_field('pdf_company_logo_setting', 'Company Logo', array($this,'fme_pdf_companylogo'), 'pdf_invoice_general_setting_section', 'gsection');

		add_settings_field('pdf_company_phone_setting', 'Company Phone', array($this,'fme_pdf_companyphone'), 'pdf_invoice_general_setting_section', 'gsection');

		add_settings_field('pdf_invoice_viewdownload_setting', 'View/Download (Order listing)', array($this,'fme_companyinvoce_view_download'), 'pdf_invoice_general_setting_section', 'gsection');

		add_settings_field('pdf_invoice_viewdownloadmy_setting', 'View/Download (My Accont)', array($this,'fme_companyinvocemy_view_download'), 'pdf_invoice_general_setting_section', 'gsection');
		
		add_settings_field('pdf_invoice_email_setting', 'PDf Invoice sent in Email to customer and admin', array($this,'fme_companyinvoce_email'), 'pdf_invoice_general_setting_section', 'gsection');

		add_settings_field('pdf_company_address_setting', 'Company Address', array($this,'fme_company_address'), 'pdf_invoice_general_setting_section', 'gsection');

		add_settings_field('pdf_company_termconditon_setting', 'Company Terms & Condition', array($this,'fme_company_termcondition'), 'pdf_invoice_general_setting_section', 'gsection');

		add_settings_field('pdf_company_note_setting', 'Company Note', array($this,'fme_company_note'), 'pdf_invoice_general_setting_section', 'gsection');

		

		add_settings_field('pdf_invoice_number_setting', 'Display Invoice Number on invoice', array($this,'fme_company_invoice_number'), 'pdf_invoice_template_setting_section', 'tsection');

		add_settings_field('pdf_invoice_tax_setting', 'Display Tax Amount', array($this,'fme_company_tax_number'), 'pdf_invoice_template_setting_section', 'tsection');

		add_settings_field('pdf_invoice_stotal_setting', 'Display Subtotal', array($this,'fme_company_stotal_number'), 'pdf_invoice_template_setting_section', 'tsection');

		add_settings_field('pdf_address_shipping_setting', 'Display Customer Shipping Information', array($this,'fme_company_shipping_address'), 'pdf_invoice_template_setting_section', 'tsection');

		add_settings_field('pdf_address_billing_setting', 'Display Customer Billing Information', array($this,'fme_company_billing_address'), 'pdf_invoice_template_setting_section', 'tsection');


		//register setting option
	    register_setting('gsection', 'pdf_company_name_setting');
	    register_setting('gsection', 'pdf_company_email_setting');
	    register_setting('gsection', 'pdf_company_logo_setting');
	    register_setting('gsection', 'pdf_company_phone_setting');
	    register_setting('gsection', 'pdf_invoice_viewdownload_setting');
	    register_setting('gsection', 'pdf_invoice_viewdownloadmy_setting');
	   	register_setting('gsection', 'pdf_company_address_setting');
	   	register_setting('gsection', 'pdf_company_note_setting');
	    register_setting('gsection', 'pdf_company_termconditon_setting');
		register_setting('gsection', 'pdf_invoice_email_setting');
	     
	    register_setting('tsection', 'pdf_invoice_number_setting');
	    register_setting('tsection', 'pdf_invoice_tax_setting');
	    register_setting('tsection', 'pdf_invoice_stotal_setting');
	    register_setting('tsection', 'pdf_address_shipping_setting');
	    register_setting('tsection', 'pdf_address_billing_setting');
	    
	}




	//for adding pdf button in order
	function fme_single_order_button($order) {
			// do not show buttons for trashed orders
			if ( $order->status == 'trash' ) {
				return;
			} 

			$invtemplate = get_option( 'pdf_invoice_templates_setting');
			if($invtemplate != ''){
			 $invtemplate = get_option( 'pdf_invoice_templates_setting');
			}else {
			 	$invtemplate = "1";
			}
			
		$listing_actions = array(
			'invoice'		=> array (
				'url'		=> wp_nonce_url (admin_url( 'admin-ajax.php?template='.$invtemplate.'&action=fmea_pdfa_invoice&mode=admin&order_ids=' . $order->id )),
					'alt'		=> __( 'PDF Invoice', 'fme_pdfinvoices_domain' ),
				),
			); 

				foreach ($listing_actions as $action => $data) { 
				?>
				<a href="<?php echo $data['url']; ?>" class="button tips wpo_wcpdf <?php echo $action; ?>" target="_blank" alt="<?php echo $data['alt']; ?>" data-tip="<?php echo $data['alt']; ?>">
					<img src="<?php echo fme_pdf_invoices_url .'img/pdf.png'?>" >
				</a>
		<?php
		}
	}
	

	//invoice data getting
	function fme_invoice_data_collection() { 
			
		global $wpdb, $post;
			
			if(isset($_GET['action']) && $_GET['action']== "fmea_pdfa_invoice") {

				require_once(fme_pdf_invoices_plguin_dir.'Include/tcpdf/tcpdf.php');
						
				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetAuthor('FME Addons');
				$pdf->SetTitle('Invoice');
				$pdf->SetSubject('Invoice');
				$pdf->SetKeywords('Invoice');
				$pdf->setPrintHeader(false);
				$pdf->setFooterData(array(0,64,0), array(0,64,128));
				$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				$pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
				$pdf->setFontSubsetting(true);
				$pdf->SetFont('dejavusans', '', 5, '', true);
				$pdf->AddPage();
				$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>0, 'blend_mode'=>'Normal'));
				
				if(isset($_GET['template']) && $_GET['template'] == "1") {
				
				require fme_pdf_invoices_plguin_dir.'Include/templates/template-one.php';
				
				}
				
				$pdf->writeHTML($html, true, false, true, false, '');

				if(isset($_GET['mode']) && $_GET['mode'] == "admin") {
					//view or download 
					$viewdownload = get_option( 'pdf_invoice_viewdownload_setting');
					if($viewdownload == ''){
					 $viewdownload = "I";
					}else {
					 	$viewdownload = get_option( 'pdf_invoice_viewdownload_setting');
					}

				$pdf->Output('invoice.pdf', $viewdownload);
				
				}

				if(isset($_GET['mode']) && $_GET['mode'] == "myaccount") {
					//view or download 
					$viewdownloadmy = get_option( 'pdf_invoice_viewdownloadmy_setting');
					if($viewdownloadmy == ''){
					 $viewdownloadmy = "I";
					}else {
					 	$viewdownloadmy = get_option( 'pdf_invoice_viewdownloadmy_setting');
					}

				$pdf->Output('invoice.pdf', $viewdownloadmy);
				
				}

				die();
			}
	}

	//bulk action for picking slips
	function fme_custom_bulk_admin_footer() {
	  
	  global $post_type;
	  
	  if($post_type == 'shop_order') {
	    ?>
	    <script type="text/javascript">
	      jQuery(document).ready(function() {
	        jQuery('<option>').val('pickingslip').text('<?php _e('Fma Picking Slip')?>').appendTo("select[name='action']");
	        jQuery('<option>').val('pickingslip').text('<?php _e('Fma Picking Slip')?>').appendTo("select[name='action2']");
	      });
	    </script>
	    <?php
	  }
	}


	//function for action performing
	function fme_custom_bulk_action() {

	        $wp_list_table = _get_list_table('WP_Posts_List_Table');
	        $action = $wp_list_table->current_action();
	        
	         $allowed_actions = array("pickingslip");
	        
	        if(!in_array($action, $allowed_actions)) return;
	         
	        if(isset($_REQUEST['post'])) {
	      
	            $arr = $_REQUEST['post'];
	            //$orderids = implode(',', $_REQUEST['post']);
	            $orderids = implode(',', array_map('intval', $arr));

	        }
	    	
	    	$sendback = admin_url( "admin-ajax.php?action=fma_picklist&order_ids=".$orderids);    
	        
	        wp_redirect($sendback);
	        exit();
	}

	function fme_getting_pick_list() {

		if(isset($_GET['action']) && $_GET['action'] == 'fma_picklist') {
				
				require_once(fme_pdf_invoices_plguin_dir.'Include/tcpdf/tcpdf.php');

				$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
				$pdf->SetCreator(PDF_CREATOR);
				$pdf->SetAuthor('FME Addons');
				$pdf->SetTitle('Slip');
				$pdf->SetSubject('Slip');
				$pdf->SetKeywords('Slip');
				$pdf->setPrintHeader(false);
				$pdf->setFooterData(array(0,64,0), array(0,64,128));
				$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
				$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				$pdf->SetMargins(PDF_MARGIN_LEFT, '15', PDF_MARGIN_RIGHT);
				$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
				$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
				$pdf->setFontSubsetting(true);
				$pdf->SetFont('dejavusans', '', 5, '', true);
				$pdf->AddPage();
				$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>0, 'blend_mode'=>'Normal'));

				require fme_pdf_invoices_plguin_dir.'Include/templates/1.php';

				$pdf->writeHTML($html, true, false, true, false, '');	
				
					//view or download 
					$viewdownload = get_option( 'pdf_invoice_viewdownload_setting');
					if($viewdownload == ''){
					 $viewdownload = "I";
					}else {
					 	$viewdownload = get_option( 'pdf_invoice_viewdownload_setting');
					}

				$pdf->Output('pickingslip.pdf', $viewdownload);

			die();
		}

	}

	//admin init function
	function fme_admin_init() { 
		
		wp_enqueue_media();

		wp_enqueue_style( 'pdf-backend-css', plugins_url( '/Styles/backend-style.css', __FILE__ ), false );
	} 


}
new fme_pdfinvoices_adminclass();





