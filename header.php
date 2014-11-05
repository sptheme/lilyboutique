<?php
/**
 * The Header
 */
?>
<!DOCTYPE html>
<!--[if IE 8 ]>    <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js lt-ie9> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper" class="wrapper">
    <div id="side-logo">
    <div class="branding">
        <?php if( !is_singular() ) echo '<h1>'; else echo '<h2>'; ?>
                
        <a  href="<?php echo home_url() ?>/"  title="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>">
            <?php if(ot_get_option('custom-logo')) : ?>
            <img src="<?php echo ot_get_option('custom-logo'); ?>" alt="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>" />
            <?php else: ?>
            <span><?php bloginfo( 'name' ); ?></span>
            <?php endif; ?>
        </a>
        
        <?php if( !is_singular() ) echo '</h1>'; else echo '</h2>'; ?>
    </div>
    </div> <!-- .side-logo -->

    <div id="menu-trigger" class="mobile-menu-trigger right"></div>

    <aside id="sidemenu-container">
        <div class="branding">
            <?php if( !is_singular() ) echo '<h1>'; else echo '<h2>'; ?>
                
            <a  href="<?php echo home_url() ?>/"  title="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>">
                <?php if(ot_get_option('custom-logo')) : ?>
                <img src="<?php echo ot_get_option('custom-logo'); ?>" alt="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>" />
                <?php else: ?>
                <span><?php bloginfo( 'name' ); ?></span>
                <?php endif; ?>
            </a>
            
            <?php if( !is_singular() ) echo '</h1>'; else echo '</h2>'; ?>
        </div>

        <nav class="primary-menu-container">
            <?php echo sp_main_navigation(); ?>
        </nav>

        <div class="icons-social">
            <!-- Agoda -->
            <?php if(ot_get_option('agoda')) : ?>
            <a href="<?php echo ot_get_option('agoda'); ?>" target="_blank" title="Shaly page on Agoda"><img src="<?php echo SP_ASSETS_THEME; ?>images/icon-agoda.png"></a>
            <?php endif; ?>
            <!-- Trip Advisor -->
            <?php if(ot_get_option('tripadvisor')) : ?>
            <a href="<?php echo ot_get_option('tripadvisor'); ?>" target="_blank" title="Shaly page on Trip Advisor"><img src="<?php echo SP_ASSETS_THEME; ?>images/icon-tripadvisor.png"></a>
            <?php endif; ?>
            <!-- Facebook -->
            <?php if(ot_get_option('facebook')) : ?>
            <a href="<?php echo ot_get_option('facebook'); ?>" target="_blank" title="Join us on Facebook"><img src="<?php echo SP_ASSETS_THEME; ?>images/icon-facebook.png"></a>
            <?php endif; ?>
        </div>

        <div class="quick-contact">
            <ul>
            <li class="address"><?php echo ot_get_option('address'); ?></li>
            <li class="email"><a href="mailto:<?php echo ot_get_option('email'); ?>"><?php echo ot_get_option('email'); ?></a></li>
            <?php if(ot_get_option('tel')) : ?>
            <li class="tel">Tel: <?php echo ot_get_option('tel'); ?></li>
            <?php endif; ?>
            <?php if(ot_get_option('tel')) : ?>
            <li class="tel">HP: <?php echo ot_get_option('phone'); ?></li>
            <?php endif; ?>
            <?php if(ot_get_option('tel')) : ?>
            <li class="tel">Fax: <?php echo ot_get_option('fax'); ?></li>
            <?php endif; ?>
            </ul>
        </div>

        <div class="copyright">
            <?php if ( ot_get_option( 'copyright' ) ): ?>
                <?php echo ot_get_option( 'copyright' ); ?>
            <?php else: ?>
                <?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e( 'All Rights Reserved.', SP_TEXT_DOMAIN ); ?>
            <?php endif; ?>
        </div><!--/#copyright-->

    </aside> <!-- sidemenu-container -->
