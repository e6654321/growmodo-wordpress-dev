<?php
/**
 * Homepage FAQ section.
 *
 * @package GrowmodoAssessment
 */

$faqs = array(
    array(
        __('How do I search for properties on Estatein?', 'growmodo-assessment'),
        __('Use the Properties page to browse listings, review details, and narrow your search by location, type, range, size, and build year.', 'growmodo-assessment'),
    ),
    array(
        __('What documents do I need to sell my property?', 'growmodo-assessment'),
        __('Our advisors help you prepare ownership documents, disclosure details, pricing information, and the materials needed to market your property.', 'growmodo-assessment'),
    ),
    array(
        __('How can Estatein help me buy a property?', 'growmodo-assessment'),
        __('We help you clarify goals, compare options, review property details, and move through negotiation and closing with confidence.', 'growmodo-assessment'),
    ),
);
?>
<section class="section section--home-faq">
    <div class="container split-heading">
        <div>
            <p class="eyebrow"><?php esc_html_e('FAQ', 'growmodo-assessment'); ?></p>
            <h2><?php esc_html_e('Frequently Asked Questions', 'growmodo-assessment'); ?></h2>
            <p><?php esc_html_e('Find answers to common questions about Estatein services, property listings, and the real estate process.', 'growmodo-assessment'); ?></p>
        </div>
        <a class="text-link" href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('View All FAQs', 'growmodo-assessment'); ?></a>
    </div>
    <div class="container faq-grid">
        <?php foreach ($faqs as $faq) : ?>
            <article class="faq-card">
                <h3><?php echo esc_html($faq[0]); ?></h3>
                <p><?php echo esc_html($faq[1]); ?></p>
                <a class="button button--secondary" href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Read More', 'growmodo-assessment'); ?></a>
            </article>
        <?php endforeach; ?>
    </div>
    <div class="container section-pager" aria-label="<?php esc_attr_e('FAQ carousel controls', 'growmodo-assessment'); ?>">
        <span><?php esc_html_e('01 of 10', 'growmodo-assessment'); ?></span>
        <div>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" aria-label="<?php esc_attr_e('Previous frequently asked questions', 'growmodo-assessment'); ?>">&larr;</a>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" aria-label="<?php esc_attr_e('Next frequently asked questions', 'growmodo-assessment'); ?>">&rarr;</a>
        </div>
    </div>
</section>
