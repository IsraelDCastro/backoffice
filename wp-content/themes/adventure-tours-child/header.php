<?php
/**
 * Header template part.
 *
 * @author    Themedelight
 * @package   Themedelight/AdventureTours
 * @version   1.0.9
 */

get_template_part( 'header','clean' );

$is_sticky_header = adventure_tours_get_option('sticky-header');

if ( $is_sticky_header ) {
    TdJsClientScript::addScript( 'sticky-header', 'Theme.initStickyHeader();');
    echo '<div class="header-wrap"><div class="header-wrap__backlog"></div>';
}
?>
<header class="header" role="banner">
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KCGMSGP');</script>
<!-- End Google Tag Manager -->
    <div class="container">
        <?php get_template_part( 'templates/header/info' ); ?>
        <div class="header__content-wrap">
            <div class="row">
                
                <!-- <div class="col-md-12 header__content">
                     <?php get_template_part( 'templates/header/logo' ); ?> 
                    <?php if ( has_nav_menu( 'header-menu' ) ) : ?>
                    <nav class="main-nav-header" role="navigation">
                        <?php wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'container' => 'ul',
                            'menu_class' => 'main-nav',
                            'menu_id' => 'navigation',
                            'depth' => 3,
                        )); ?>
                    </nav>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                </div> -->
                <div class="col-md-12">
                    <?php echo do_shortcode("[uap-account-header]"); ?>
                </div>
                
            </div>
        </div><!-- .header__content-wrap -->
    </div><!-- .container -->
</header>
<?php if ( $is_sticky_header ) { echo '</div>'; } ?>
<?php get_template_part( 'templates/header/header-section' ); ?>
<div class="container layout-container margin-top margin-bottom">