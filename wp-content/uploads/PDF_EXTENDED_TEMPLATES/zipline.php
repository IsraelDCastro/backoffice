<?php

/*
 * Template Name: Zipline
 * Version: 0.1
 * Description: Form for Zipline for Globex Tours
 * Author: Innovacode
 * Author URI: https://innova-code.com.com
 * Group: Core
 * License: GPLv2
 * Required PDF Version: 4.0-alpha
 * Tags: Header, Footer, Background, Optional HTML Fields, Optional Page Fields, Field Border Color
 */

/* Prevent direct access to the template */
if ( ! class_exists( 'GFForms' ) ) {
    return;
}

/*
 * All Gravity PDF 4.x templates have access to the following variables:
 *
 * $form (The current Gravity Form array)
 * $entry (The raw entry data)
 * $form_data (The processed entry data stored in an array)
 * $settings (the current PDF configuration)
 * $fields (an array of Gravity Form fields which can be accessed with their ID number)
 * $config (The initialised template config class – eg. /config/zadani.php)
 * $gfpdf (the main Gravity PDF object containing all our helper classes)
 * $args (contains an array of all variables - the ones being described right now - passed to the template)
 */

/*
 * Load up our template-specific appearance settings
 */
$value_border_colour = ( ! empty( $settings['zadani_border_colour'] ) ) ? $settings['zadani_border_colour'] : '#CCCCCC';

?>

<!-- Include styles needed for the PDF -->
<style>

    /* Handle Gravity Forms CSS Ready Classes */
    .row-separator {
        clear: both;
        padding: 1.25mm 0;
    }

    .gf_left_half,
    .gf_left_third, .gf_middle_third,
    .gf_first_quarter, .gf_second_quarter, .gf_third_quarter,
    .gf_list_2col li, .gf_list_3col li, .gf_list_4col li, .gf_list_5col li {
        float: left;
    }

    .gf_right_half,
    .gf_right_third,
    .gf_fourth_quarter {
        float: right;
    }

    .gf_left_half, .gf_right_half,
    .gf_list_2col li {
        width: 49%;
    }

    .gf_left_third, .gf_middle_third, .gf_right_third,
    .gf_list_3col li {
        width: 32.3%;
    }

    .gf_first_quarter, .gf_second_quarter, .gf_third_quarter, .gf_fourth_quarter {
        width: 24%;
    }

    .gf_list_4col li {
        width: 24%;
    }

    .gf_list_5col li {
        width: 19%;
    }

    .gf_left_half, .gf_right_half {
        padding-right: 1%;
    }

    .gf_left_third, .gf_middle_third, .gf_right_third {
        padding-right: 1.505%;
    }

    .gf_first_quarter, .gf_second_quarter, .gf_third_quarter, .gf_fourth_quarter {
        padding-right: 1.333%;
    }

    .gf_right_half, .gf_right_third, .gf_fourth_quarter {
        padding-right: 0;
    }

    /* Don't double float the list items if already floated (mPDF does not support this ) */
    .gf_left_half li, .gf_right_half li,
    .gf_left_third li, .gf_middle_third li, .gf_right_third li {
        width: 100% !important;
        float: none !important;
    }

    /*
     * Headings
     */
    h3 {
        margin: 1.5mm 0 0.5mm;
        padding: 0;
    }

    /*
     * Quiz Style Support
     */
    .gquiz-field {
        color: #666;
    }

    .gquiz-correct-choice {
        font-weight: bold;
        color: black;
    }

    .gf-quiz-img {
        padding-left: 5px !important;
        vertical-align: middle;
    }

    /*
     * Survey Style Support
     */
    .gsurvey-likert-choice-label {
        padding: 4px;
    }

    .gsurvey-likert-choice, .gsurvey-likert-choice-label {
        text-align: center;
    }

    /*
     * Terms of Service (Gravity Perks) Support
     */
    .terms-of-service-agreement {
        padding-top: 3px;
        font-weight: bold;
    }

    .terms-of-service-tick {
        font-size: 150%;
    }

    /*
     * List Support
     */
    ul, ol {
        margin: 0;
        padding-left: 1mm;
        padding-right: 1mm;
    }

    li {
        margin: 0;
        padding: 0;
        list-style-position: inside;
    }

    /*
     * Header / Footer
     */
    .alignleft {
        float: left;
    }

    .alignright {
        float: right;
    }

    .aligncenter {
        text-align: center;
    }

    p.alignleft {
        text-align: left;
        float: none;
    }

    p.alignright {
        text-align: right;
        float: none;
    }

    /*
     * Independant Template Styles
     */
    .gfpdf-field .label {
        text-transform: uppercase;
        font-size: 90%;
    }

    .gfpdf-field .value {
        border: 1px solid <?php echo $value_border_colour; ?>;
        padding: 1.5mm 2mm;
    }

    .products-title-container, .products-container {
        padding: 0;
    }

    .products-title-container h3 {
        margin-bottom: -0.5mm;
    }
    body{
      width: 816px;
      height: 1056px;
      border: 1px solid #000;
      padding: 0;
      margin: 0 auto;
      font-family: 'B'
    }
    .title{
      background: #a6a6a6;
    }
    .title h1{
      font-size: 2.5em;
      padding: .4em;
      letter-spacing: 14px;
    }
    .subtitle{
      background: #808080;
    }
    .subtitle h4{
      padding: 5px;
      letter-spacing: 7px;
    }
    .title h1, .subtitle h4, .footer-head{
      margin: 0;
      text-align: center;
      color: #fff;
    }
    .img-logo{
      width: auto;
      display: inline-block;
      margin-bottom: 1em;
      margin-left: .5em;
    }
    .img-content-logo{
      width: 290px;
    }
    .data-date{
      width: 300px;
      display: inline-block;
      float: right;
    }
    .data-date p{
      margin: 6px;
    }
    header{
      border-bottom: .6em solid #808080;
    }
    .content{
      width: 100%;
      overflow: hidden;
    }
    .content h2{
      margin: 0;
      text-align: center;
      padding: .5em;
      font-size: 2.7em;
      font-weight: 700;
    }
    .table-title {
      font-size: 1.5em;
      font-weight: normal;
      text-align: center;
      border-top: 1px solid #808080;
      border-bottom: 1px solid #808080;
      margin: 0 2em;
      color: #808080;
      letter-spacing: 5px;
    }
    .info-contact {
      width: 50%;
      display: inline-block;
      float: left;
    }
    table {
      margin: 0 auto;
      text-align: left;
      width: 77%;
    }
    .second-table th {
      padding: 16px 0px;
    }
    tr:nth-child(even) {background: #f2f2f2;}
    th{
      padding: 2px;
      width: 40%;
      margin: 0 9% 0 0;
      display: inline-block;
      font-weight: normal;
      color: #484848;
      text-transform: uppercase;
    }
    td {
      padding: 2px;
      display: inline-block;
      width: 48%;
      color: grey;
      text-transform: uppercase;
      font-size: 13px;
    }
    .full-w{
      width: 100%
    }
    footer{
      width: 100%
    }
    .footer-text, .footer-img{
      width: 50%;
      display: table-cell;
      padding: 0 1em;
    }
    .footer-img img{
      width: 255px;
    }
    .footer-img {
      text-align: center;
    }
    .footer-img h5{
      margin: 20px 0;
    }
    .cancel-text{
      padding: 0 1em;
    }
    .footer-head{
      background: #808080;
      margin: 2em 0;
    }
    .cancel-text h5, .footer-img h5, .footer-text h5 {
      text-transform: uppercase;
      font-weight: normal;
      font-size: 1em;
      margin: .85em 0;
      color: grey;
    }
    .cancel-text p, .footer-img p, .footer-text p {
      color: grey;
      line-height: 1.5;
    }
    .footer-head p{
      margin: 0;
      padding: 5px 1em;
    }
    .red-text{
      color: red;
      font-size: 20px;
    }
    .data-date{
      font-style: italic;
    }
    .data-date .booking{
      color: #484848;
      font-size: 18px;
    }
</style>

<!-- Output our HTML markup -->
<?php

/*
 * Load our core-specific styles from our PDF settings which will be passed to the PDF template $config array
 */
$show_form_title      = ( ! empty( $settings['show_form_title'] ) && $settings['show_form_title'] == 'Yes' )            ? true : false;
$show_page_names      = ( ! empty( $settings['show_page_names'] ) && $settings['show_page_names'] == 'Yes' )            ? true : false;
$show_html            = ( ! empty( $settings['show_html'] ) && $settings['show_html'] == 'Yes' )                        ? true : false;
$show_section_content = ( ! empty( $settings['show_section_content'] ) && $settings['show_section_content'] == 'Yes' )  ? true : false;
$enable_conditional   = ( ! empty( $settings['enable_conditional'] ) && $settings['enable_conditional'] == 'Yes' )      ? true : false;
$show_empty           = ( ! empty( $settings['show_empty'] ) && $settings['show_empty'] == 'Yes' )                      ? true : false;

/**
 * Set up our configuration array to control what is and is not shown in the generated PDF
 *
 * @var array
 */
$html_config = array(
    'settings' => $settings,
    'meta'     => array(
        'echo'                     => true, /* whether to output the HTML or return it */
        'exclude'                  => true, /* whether we should exclude fields with a CSS value of 'exclude'. Default to true */
        'empty'                    => $show_empty, /* whether to show empty fields or not. Default is false */
        'conditional'              => $enable_conditional, /* whether we should skip fields hidden with conditional logic. Default to true. */
        'show_title'               => $show_form_title, /* whether we should show the form title. Default to true */
        'section_content'          => $show_section_content, /* whether we should include a section breaks content. Default to false */
        'page_names'               => $show_page_names, /* whether we should show the form's page names. Default to false */
        'html_field'               => $show_html, /* whether we should show the form's html fields. Default to false */
        'individual_products'      => false, /* Whether to show individual fields in the entry. Default to false - they are grouped together at the end of the form */
        'enable_css_ready_classes' => true, /* Whether to enable or disable Gravity Forms CSS Ready Class support in your PDF */
    ),
);

/*
 * Generate our HTML markup
 *
 * You can access Gravity PDFs common functions and classes through our API wrapper class "GPDFAPI"
 */
 <header name="myHeader">
   <section>
     <div class="title">
       <h1>CONFIRMATION TICKET</h1>
     </div>
     <div class="subtitle">
       <h4>GLOBEX SERVICIOS TURISTICOS. S.R.L</h4>
     </div>
   </section>
   <section>
     <div class="img-logo">
       <img class="img-content-logo" src="https://res.cloudinary.com/globex-tours/image/upload/c_scale,w_700/v1509395827/LogoGlobex_lwg3pc.png" alt="Globex Tours">
     </div>
     <div class="data-date">
       <p><span class="booking">Booking Date:</span> Monday 4th, January 2018</p>
       <p><span class="booking">Booking Time:</span> 8:00 AM</p>
       <p><span class="booking">Ticket Number:</span> <span class="red-text"> 000001</span></p>
     </div>
   </section>
 </header>
 <section class="content">
   <h2>Adventure Buggy</h2>
   <div class="info-contact">
     <h3 class="table-title">Service Information</h3>
     <table>
       <tbody>
         <tr>
           <th>First Name</th>
           <td>Edward</td>
         </tr>
         <tr>
           <th>Last Name</th>
           <td>Acosta Mejia</td>
         </tr>
         <tr>
           <th>Adults</th>
           <td>3 Pax</td>
         </tr>
         <tr>
           <th>Children</th>
           <td>3 Pax</td>
         </tr>
         <tr>
           <th>Service a</th>
           <td>Zip Line Adventure</td>
         </tr>
         <tr>
           <th>Hotel Name</th>
           <td>Royalton Bavaro</td>
         </tr>
         <tr>
           <th>Room Number</th>
           <td>2332</td>
         </tr>
         <tr>
           <th>Excursion Date</th>
           <td>Monday 4th, January 2018</td>
         </tr>
         <tr>
           <th>Picuo Time</th>
           <td>8:30 AM</td>
         </tr>
         <tr>
           <th>Pick Up Place</th>
           <td>Outside Main Lobby</td>
         </tr>
       </tbody>
     </table>
   </div>
   <div class="info-contact">
     <h3 class="table-title">Invoice Information</h3>
     <table class="second-table">
       <tbody>
         <tr>
           <th>Paid With</th>
           <td>Master Card</td>
         </tr>
         <tr>
           <th>Discount</th>
           <td>US$ 35.00</td>
         </tr>
         <tr>
           <th>Adult Price</th>
           <td>US$ 100.00</td>
         </tr>
         <tr>
           <th>Child Price</th>
           <td>US$ 50.00</td>
         </tr>
         <tr>
           <th>Total Price</th>
           <td><span class="red-text">US$ 315.00</span></td>
         </tr>
       </tbody>
     </table>
   </div>
 </section>
 <footer>
   <div class="footer-text">
     <h5>Recommendations & Important Tips</h5>
     <p>Road may be Partially dusty and/or muddy, so can get yu. Either bring a handkershieft to cover your face or cash to buy one. Comfotable cloths. Avoid yewelry. Minimum age to drive is 18 y/o.
     Please be five (5) minutes before given time at your pick up. This ticket will be requested by the bus driver (on paper or digital). Driver will only board amount of passengers indicated on ticket.</p>
   </div>
   <div class="footer-img">
     <h5>The Bus Will Pick You Up Looks Like</h5>
     <img src="http://res.cloudinary.com/globex-tours/image/upload/c_scale,w_400/v1515765023/adventure-boogies-private_exkqqk.jpg" alt="">
   </div>
   <div class="cancel-text">
     <h5>Cancellation Policies</h5>
     <p>Full refund applies only when cancellation is notified 48 hours (or more) before service date. 65% refund applies when cancellation is notified less than 48 hours, but at least 24 hours before service Date
     50% refund applies when cancellation is notified less than 24 hours, but al least 12 hours service date. No refund applies for cancellations notified less than 12 hours before service data</p>
   </div>
   <div class="footer-head">
     <p>Av Boulevard Turistico Del Este Esq. España, Plaza Bávaro Boulevard Center, local #16-81, Punta Cana, Rep. Dominicana For Assistance, please call" 809-795-8395 | or type WhatsApp Number: 809-356-1010</p>
   </div>
 </footer>
$pdf = GPDFAPI::get_pdf_class();
$pdf->process_html_structure( $entry, GPDFAPI::get_pdf_class( 'model' ), $html_config );
