<?php
/**
 * Services section.
 *
 * @package GrowmodoAssessment
 */

$services = new WP_Query(array(
    'post_type'      => 'service',
    'posts_per_page' => 3,
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
));

$fallback_services = array(
    array(__('Find Your Dream Home', 'growmodo-assessment'), __('Browse curated listings with clear details, pricing, and property highlights.', 'growmodo-assessment')),
    array(__('Unlock Property Value', 'growmodo-assessment'), __('Get strategic guidance for selling, positioning, and maximizing real estate outcomes.', 'growmodo-assessment')),
    array(__('Investment Guidance', 'growmodo-assessment'), __('Make informed property decisions with market insight and transparent support.', 'growmodo-assessment')),
);
?>
<section class="section section--muted">
    <div class="container section__header">
        <p class="eyebrow"><?php esc_html_e('Our Services', 'growmodo-assessment'); ?></p>
        <h2><?php esc_html_e('Elevate your real estate experience.', 'growmodo-assessment'); ?></h2>
    </div>
    <div class="container feature-grid">
        <?php if ($services->have_posts()) : ?>
            <?php while ($services->have_posts()) : $services->the_post(); ?>
                <article class="feature-card">
                    <span class="feature-card__icon" aria-hidden="true"></span>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo esc_html(get_the_excerpt()); ?></p>
                </article>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php else : ?>
            <?php foreach ($fallback_services as $service) : ?>
                <article class="feature-card">
                    <span class="feature-card__icon" aria-hidden="true"></span>
                    <h3><?php echo esc_html($service[0]); ?></h3>
                    <p><?php echo esc_html($service[1]); ?></p>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
