<?php
/**
 * Homepage hero.
 *
 * @package GrowmodoAssessment
 */

$title   = get_theme_mod('hero_title', __('Discover Your Dream Property with Estatein', 'growmodo-assessment'));
$eyebrow = get_theme_mod('hero_eyebrow', '');
$text    = get_theme_mod('hero_text', __('Your journey to finding the perfect property begins here. Explore our listings to find the home that matches your dreams.', 'growmodo-assessment'));
$cta     = get_theme_mod('hero_cta', __('Browse Properties', 'growmodo-assessment'));
?>
<section class="hero">
    <div class="container hero__grid">
        <div class="hero__content">
            <?php if ($eyebrow) : ?>
                <p class="eyebrow"><?php echo esc_html($eyebrow); ?></p>
            <?php endif; ?>
            <h1><?php echo esc_html($title); ?></h1>
            <p><?php echo esc_html($text); ?></p>
            <div class="hero__actions">
                <?php growmodo_assessment_button(__('Learn More', 'growmodo-assessment'), home_url('/about-us/'), 'secondary'); ?>
                <?php growmodo_assessment_button($cta, home_url('/properties/'), 'primary'); ?>
            </div>
            <dl class="hero-stats">
                <div><dt>200+</dt><dd><?php esc_html_e('Happy Customers', 'growmodo-assessment'); ?></dd></div>
                <div><dt>10k+</dt><dd><?php esc_html_e('Properties For Clients', 'growmodo-assessment'); ?></dd></div>
                <div><dt>16+</dt><dd><?php esc_html_e('Years of Experience', 'growmodo-assessment'); ?></dd></div>
            </dl>
        </div>
        <div class="hero__visual" aria-label="<?php esc_attr_e('Website interface preview', 'growmodo-assessment'); ?>">
            <a class="hero-badge" href="<?php echo esc_url(home_url('/properties/')); ?>" aria-label="<?php esc_attr_e('Discover your dream property', 'growmodo-assessment'); ?>">
                <span class="hero-badge__text" aria-hidden="true"><?php esc_html_e('Discover Your Dream Property', 'growmodo-assessment'); ?></span>
                <span class="hero-badge__arrow" aria-hidden="true">&#8599;</span>
            </a>
            <div class="hero-building">
                <img src="<?php echo esc_url(growmodo_assessment_asset('images/estatein-hero-building.png')); ?>" alt="<?php esc_attr_e('Blue glass high-rise building from the Estatein homepage design', 'growmodo-assessment'); ?>">
            </div>
        </div>
    </div>
    <div class="container quick-links" aria-label="<?php esc_attr_e('Property actions', 'growmodo-assessment'); ?>">
        <a href="<?php echo esc_url(home_url('/properties/')); ?>"><?php esc_html_e('Find Your Dream Home', 'growmodo-assessment'); ?></a>
        <a href="<?php echo esc_url(home_url('/properties/')); ?>"><?php esc_html_e('Unlock Property Value', 'growmodo-assessment'); ?></a>
        <a href="<?php echo esc_url(home_url('/services/')); ?>"><?php esc_html_e('Effortless Property Management', 'growmodo-assessment'); ?></a>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Smart Investments, Informed Decisions', 'growmodo-assessment'); ?></a>
    </div>
</section>
