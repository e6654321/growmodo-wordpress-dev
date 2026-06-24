<?php
/**
 * Site header.
 *
 * @package GrowmodoAssessment
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e('Skip to content', 'growmodo-assessment'); ?></a>

<header class="site-header" data-site-header>
    <div class="promo-banner" data-promo-banner>
        <a class="promo-banner__link" href="<?php echo esc_url(home_url('/properties/')); ?>">
            <span class="promo-banner__spark" aria-hidden="true"></span>
            <?php esc_html_e('Discover Your Dream Property with Estatein', 'growmodo-assessment'); ?>
            <span class="promo-banner__more"><?php esc_html_e('Learn More', 'growmodo-assessment'); ?></span>
        </a>
        <button class="promo-banner__close" type="button" aria-label="<?php esc_attr_e('Close announcement', 'growmodo-assessment'); ?>" data-promo-close>
            <span aria-hidden="true"></span>
        </button>
    </div>
    <div class="container site-header__inner">
        <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?>">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <span class="brand__mark" aria-hidden="true"></span>
                <span class="brand__text">Estatein</span>
            <?php endif; ?>
        </a>

        <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-menu" data-nav-toggle>
            <span class="nav-toggle__bar"></span>
            <span class="screen-reader-text"><?php esc_html_e('Menu', 'growmodo-assessment'); ?></span>
        </button>

        <nav class="primary-nav" id="primary-menu" aria-label="<?php esc_attr_e('Primary navigation', 'growmodo-assessment'); ?>" data-primary-nav>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => 'primary-nav__list',
                'container'      => false,
                'fallback_cb'    => 'growmodo_assessment_fallback_menu',
            ));
            ?>
        </nav>
        <a class="header-contact" href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Contact Us', 'growmodo-assessment'); ?></a>
    </div>
</header>
