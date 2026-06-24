<?php
/**
 * Template Name: Contact
 *
 * @package GrowmodoAssessment
 */

get_header();

$contact_cards = array(
    array(__('Email', 'growmodo-assessment'), __('info@estatein.com', 'growmodo-assessment')),
    array(__('Phone', 'growmodo-assessment'), __('+1 (123) 456-7890', 'growmodo-assessment')),
    array(__('Office', 'growmodo-assessment'), __('Main Headquarters', 'growmodo-assessment')),
    array(__('Social', 'growmodo-assessment'), __('Instagram LinkedIn Facebook', 'growmodo-assessment')),
);

$offices = array(
    array(
        'type'    => __('Main Headquarters', 'growmodo-assessment'),
        'title'   => __('123 Estatein Plaza, City Center, Metropolis', 'growmodo-assessment'),
        'summary' => __('Our headquarters is the hub of our real estate expertise. Visit us to meet our team and discuss your property goals.', 'growmodo-assessment'),
        'email'   => __('info@estatein.com', 'growmodo-assessment'),
        'phone'   => __('+1 (123) 456-7890', 'growmodo-assessment'),
        'place'   => __('Metropolis', 'growmodo-assessment'),
    ),
    array(
        'type'    => __('Regional Office', 'growmodo-assessment'),
        'title'   => __('456 Urban Avenue, Downtown District', 'growmodo-assessment'),
        'summary' => __('Our regional office brings local market insight to buyers, sellers, and investors across growing communities.', 'growmodo-assessment'),
        'email'   => __('support@estatein.com', 'growmodo-assessment'),
        'phone'   => __('+1 (987) 654-3210', 'growmodo-assessment'),
        'place'   => __('Downtown District', 'growmodo-assessment'),
    ),
);
?>
<main id="main" class="site-main">
    <section class="page-hero">
        <div class="container page-hero__inner">
            <h1><?php esc_html_e('Get in Touch with Estatein', 'growmodo-assessment'); ?></h1>
            <p class="page-hero__description"><?php esc_html_e('Welcome to Estatein contact page. We are here to assist you with any inquiries, requests, or feedback you may have.', 'growmodo-assessment'); ?></p>
        </div>
    </section>

    <section class="service-shortcuts">
        <div class="container contact-methods">
            <?php foreach ($contact_cards as $card) : ?>
                <article>
                    <span class="feature-card__icon" aria-hidden="true"></span>
                    <h2><?php echo esc_html($card[1]); ?></h2>
                    <p><?php echo esc_html($card[0]); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <div class="container split-heading">
            <div>
                <p class="eyebrow"><?php esc_html_e("Let's Connect", 'growmodo-assessment'); ?></p>
                <h2><?php esc_html_e("Let's Connect", 'growmodo-assessment'); ?></h2>
                <p><?php esc_html_e('We are excited to connect with you and learn more about your real estate goals. Use the form below to get started.', 'growmodo-assessment'); ?></p>
            </div>
        </div>
        <div class="container">
            <?php get_template_part('template-parts/sections/contact-form'); ?>
        </div>
    </section>

    <section class="section">
        <div class="container split-heading">
            <div>
                <p class="eyebrow"><?php esc_html_e('Discover Our Office Locations', 'growmodo-assessment'); ?></p>
                <h2><?php esc_html_e('Discover Our Office Locations', 'growmodo-assessment'); ?></h2>
                <p><?php esc_html_e('Estatein is here to serve clients across neighborhoods, cities, and investment markets.', 'growmodo-assessment'); ?></p>
            </div>
        </div>
        <div class="container office-grid">
            <?php foreach ($offices as $office) : ?>
                <article class="office-card">
                    <span><?php echo esc_html($office['type']); ?></span>
                    <h3><?php echo esc_html($office['title']); ?></h3>
                    <p><?php echo esc_html($office['summary']); ?></p>
                    <ul class="office-card__meta">
                        <li class="office-card__email"><?php echo esc_html($office['email']); ?></li>
                        <li class="office-card__phone"><?php echo esc_html($office['phone']); ?></li>
                        <li class="office-card__place"><?php echo esc_html($office['place']); ?></li>
                    </ul>
                    <?php growmodo_assessment_button(__('Get Direction', 'growmodo-assessment'), home_url('/contact/'), 'secondary'); ?>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <?php get_template_part('template-parts/sections/faq'); ?>
</main>
<?php
get_footer();
