<?php
/**
 * Template Name: Services
 *
 * @package GrowmodoAssessment
 */

get_header();

$valuation = array(
    array(__('Valuation Mastery', 'growmodo-assessment'), __('Discover the true worth of your property with our expert valuation services.', 'growmodo-assessment')),
    array(__('Strategic Marketing', 'growmodo-assessment'), __('Selling a property requires more than a listing; it demands a strategic marketing approach.', 'growmodo-assessment')),
    array(__('Negotiation Wizardry', 'growmodo-assessment'), __('Negotiating the best deal is an art, and our negotiation experts are masters of it.', 'growmodo-assessment')),
    array(__('Closing Success', 'growmodo-assessment'), __('A successful sale is not complete until the closing. We guide you through the intricate closing process.', 'growmodo-assessment')),
);

$management = array(
    array(__('Tenant Harmony', 'growmodo-assessment'), __('Our tenant management services ensure your tenants have a smooth experience while reducing vacancies.', 'growmodo-assessment')),
    array(__('Maintenance Ease', 'growmodo-assessment'), __('Say goodbye to property maintenance headaches. We handle all aspects of property upkeep.', 'growmodo-assessment')),
    array(__('Financial Peace of Mind', 'growmodo-assessment'), __('Managing property finances can be complex. Our financial experts take care of rent collection and reports.', 'growmodo-assessment')),
    array(__('Legal Guardian', 'growmodo-assessment'), __('Stay compliant with property laws and regulations effortlessly with our legal support.', 'growmodo-assessment')),
);
?>
<main id="main" class="site-main">
    <section class="page-hero">
        <div class="container page-hero__inner">
            <h1><?php esc_html_e('Elevate Your Real Estate Experience', 'growmodo-assessment'); ?></h1>
            <p class="page-hero__description"><?php esc_html_e('Welcome to Estatein, where your real estate aspirations meet expert guidance. Explore our comprehensive range of services, each designed to cater to your unique needs and dreams.', 'growmodo-assessment'); ?></p>
        </div>
    </section>

    <section class="service-shortcuts">
        <div class="container quick-links">
            <a href="#dream-home"><?php esc_html_e('Find Your Dream Home', 'growmodo-assessment'); ?></a>
            <a href="#valuation"><?php esc_html_e('Unlock Property Value', 'growmodo-assessment'); ?></a>
            <a href="#management"><?php esc_html_e('Effortless Property Management', 'growmodo-assessment'); ?></a>
            <a href="#investment"><?php esc_html_e('Smart Investments, Informed Decisions', 'growmodo-assessment'); ?></a>
        </div>
    </section>

    <section id="dream-home" class="section">
        <div class="container split-heading">
            <div>
                <p class="eyebrow"><?php esc_html_e('Unlock Property Value', 'growmodo-assessment'); ?></p>
                <h2><?php esc_html_e('Unlock the Value of Your Property', 'growmodo-assessment'); ?></h2>
                <p><?php esc_html_e('Selling your property should be a rewarding experience, and at Estatein, we make sure it is.', 'growmodo-assessment'); ?></p>
            </div>
        </div>
        <div class="container service-panel-grid">
            <article class="service-highlight">
                <h3><?php esc_html_e('Unlock the Value of Your Property Today', 'growmodo-assessment'); ?></h3>
                <p><?php esc_html_e('Ready to unlock the true value of your property? Explore expert valuation, strategic marketing, and careful negotiation support.', 'growmodo-assessment'); ?></p>
                <?php growmodo_assessment_button(__('Learn More', 'growmodo-assessment'), home_url('/contact/'), 'secondary'); ?>
            </article>
            <?php foreach ($valuation as $service) : ?>
                <article class="feature-card">
                    <span class="feature-card__icon" aria-hidden="true"></span>
                    <h3><?php echo esc_html($service[0]); ?></h3>
                    <p><?php echo esc_html($service[1]); ?></p>
                    <a class="card-action" href="<?php echo esc_url(home_url('/contact/')); ?>" aria-label="<?php echo esc_attr(sprintf(__('Learn more about %s', 'growmodo-assessment'), $service[0])); ?>"><?php esc_html_e('Learn More', 'growmodo-assessment'); ?></a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="management" class="section">
        <div class="container split-heading">
            <div>
                <p class="eyebrow"><?php esc_html_e('Effortless Property Management', 'growmodo-assessment'); ?></p>
                <h2><?php esc_html_e('Effortless Property Management', 'growmodo-assessment'); ?></h2>
                <p><?php esc_html_e('Owning a property should be a joy, not a burden. Estatein keeps your investment running smoothly.', 'growmodo-assessment'); ?></p>
            </div>
        </div>
        <div class="container service-panel-grid">
            <?php foreach ($management as $service) : ?>
                <article class="feature-card">
                    <span class="feature-card__icon" aria-hidden="true"></span>
                    <h3><?php echo esc_html($service[0]); ?></h3>
                    <p><?php echo esc_html($service[1]); ?></p>
                    <a class="card-action" href="<?php echo esc_url(home_url('/contact/')); ?>" aria-label="<?php echo esc_attr(sprintf(__('Learn more about %s', 'growmodo-assessment'), $service[0])); ?>"><?php esc_html_e('Learn More', 'growmodo-assessment'); ?></a>
                </article>
            <?php endforeach; ?>
            <article id="investment" class="service-highlight">
                <h3><?php esc_html_e('Smart Investments, Informed Decisions', 'growmodo-assessment'); ?></h3>
                <p><?php esc_html_e('Build an investment plan with market context, portfolio goals, and practical risk awareness.', 'growmodo-assessment'); ?></p>
                <?php growmodo_assessment_button(__('Start Today', 'growmodo-assessment'), home_url('/contact/'), 'primary'); ?>
            </article>
        </div>
    </section>

    <?php get_template_part('template-parts/sections/contact'); ?>
</main>
<?php
get_footer();
