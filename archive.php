<?php
/**
 * Archive template.
 *
 * @package GrowmodoAssessment
 */

get_header();
$is_property_archive = is_post_type_archive('property');
$is_service_archive  = is_post_type_archive('service');
?>
<main id="main" class="site-main">
    <header class="page-hero <?php echo $is_property_archive ? 'page-hero--properties' : ''; ?>">
        <div class="container page-hero__inner">
            <?php if ($is_property_archive) : ?>
                <h1><?php esc_html_e('Find Your Dream Property', 'growmodo-assessment'); ?></h1>
                <p class="page-hero__description"><?php esc_html_e('Welcome to Estatein, where your dream property awaits in every corner of our beautiful world. Explore our curated selection of properties, each offering a unique story and a chance to redefine your life.', 'growmodo-assessment'); ?></p>
            <?php elseif ($is_service_archive) : ?>
                <h1><?php esc_html_e('Elevate Your Real Estate Experience', 'growmodo-assessment'); ?></h1>
                <p class="page-hero__description"><?php esc_html_e('Welcome to Estatein, where your real estate aspirations meet expert guidance. Explore our comprehensive range of services, each designed to cater to your unique needs and dreams.', 'growmodo-assessment'); ?></p>
            <?php else : ?>
                <p class="eyebrow"><?php esc_html_e('Explore', 'growmodo-assessment'); ?></p>
                <h1><?php the_archive_title(); ?></h1>
                <?php the_archive_description('<div class="page-hero__description">', '</div>'); ?>
            <?php endif; ?>
        </div>
        <?php if ($is_property_archive) : ?>
            <div class="container property-search">
                <form class="property-search__bar" role="search" action="<?php echo esc_url(home_url('/properties/')); ?>" method="get">
                    <label class="screen-reader-text" for="property-archive-search"><?php esc_html_e('Search for a property', 'growmodo-assessment'); ?></label>
                    <input id="property-archive-search" name="s" type="search" placeholder="<?php esc_attr_e('Search For A Property', 'growmodo-assessment'); ?>">
                    <button class="button button--primary" type="submit"><?php esc_html_e('Find Property', 'growmodo-assessment'); ?></button>
                </form>
                <div class="property-search__filters" aria-label="<?php esc_attr_e('Property filters', 'growmodo-assessment'); ?>">
                    <button class="filter-location" type="button"><?php esc_html_e('Location', 'growmodo-assessment'); ?></button>
                    <button class="filter-type" type="button"><?php esc_html_e('Property Type', 'growmodo-assessment'); ?></button>
                    <button class="filter-price" type="button"><?php esc_html_e('Pricing Range', 'growmodo-assessment'); ?></button>
                    <button class="filter-size" type="button"><?php esc_html_e('Property Size', 'growmodo-assessment'); ?></button>
                    <button class="filter-year" type="button"><?php esc_html_e('Build Year', 'growmodo-assessment'); ?></button>
                </div>
            </div>
        <?php endif; ?>
    </header>
    <?php if ($is_service_archive) : ?>
        <section class="service-shortcuts">
            <div class="container quick-links">
                <a href="<?php echo esc_url(home_url('/services/')); ?>"><?php esc_html_e('Find Your Dream Home', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/services/')); ?>"><?php esc_html_e('Unlock Property Value', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/services/')); ?>"><?php esc_html_e('Effortless Property Management', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/services/')); ?>"><?php esc_html_e('Smart Investments, Informed Decisions', 'growmodo-assessment'); ?></a>
            </div>
        </section>
    <?php endif; ?>
    <section class="section">
        <div class="container">
            <?php if ($is_property_archive) : ?>
                <div class="section__header">
                    <p class="eyebrow"><?php esc_html_e('Discover a World of Possibilities', 'growmodo-assessment'); ?></p>
                    <h2><?php esc_html_e('Our portfolio of properties is as diverse as your dreams.', 'growmodo-assessment'); ?></h2>
                    <p><?php esc_html_e('Explore the following categories to find the perfect property that resonates with your vision of home.', 'growmodo-assessment'); ?></p>
                </div>
            <?php elseif ($is_service_archive) : ?>
                <div class="section__header">
                    <p class="eyebrow"><?php esc_html_e('Unlock Property Value', 'growmodo-assessment'); ?></p>
                    <h2><?php esc_html_e('Real estate services for every step of the journey.', 'growmodo-assessment'); ?></h2>
                    <p><?php esc_html_e('From discovery and valuation to marketing, management, and investment guidance, Estatein brings structure to complex decisions.', 'growmodo-assessment'); ?></p>
                </div>
            <?php endif; ?>
            <?php if (have_posts()) : ?>
                <div class="archive-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('template-parts/content', get_post_type()); ?>
                    <?php endwhile; ?>
                </div>
                <?php if ($is_property_archive) : ?>
                    <div class="section-pager" aria-label="<?php esc_attr_e('Properties carousel controls', 'growmodo-assessment'); ?>">
                        <span><?php esc_html_e('01 of 10', 'growmodo-assessment'); ?></span>
                        <div>
                            <a href="<?php echo esc_url(home_url('/properties/')); ?>" aria-label="<?php esc_attr_e('Previous properties', 'growmodo-assessment'); ?>">&#8592;</a>
                            <a href="<?php echo esc_url(home_url('/properties/')); ?>" aria-label="<?php esc_attr_e('Next properties', 'growmodo-assessment'); ?>">&#8594;</a>
                        </div>
                    </div>
                <?php else : ?>
                    <?php the_posts_pagination(); ?>
                <?php endif; ?>
            <?php else : ?>
                <article class="empty-state">
                    <h2><?php esc_html_e('Nothing listed yet', 'growmodo-assessment'); ?></h2>
                    <p><?php esc_html_e('Add properties or services in WordPress admin to populate this archive. The page templates include fallback content for first-run demos.', 'growmodo-assessment'); ?></p>
                </article>
            <?php endif; ?>
        </div>
    </section>
    <?php if ($is_property_archive) : ?>
        <section class="section">
            <div class="container split-heading">
                <div>
                    <p class="eyebrow"><?php esc_html_e("Let's Make it Happen", 'growmodo-assessment'); ?></p>
                    <h2><?php esc_html_e("Let's Make it Happen", 'growmodo-assessment'); ?></h2>
                    <p><?php esc_html_e("Ready to take the first step toward your dream property? Fill out the form below, and our real estate wizards will work their magic to find your perfect match. Don't wait; let's embark on this exciting journey together.", 'growmodo-assessment'); ?></p>
                </div>
            </div>
            <div class="container">
                <?php get_template_part('template-parts/sections/contact-form'); ?>
            </div>
        </section>
    <?php endif; ?>
</main>
<?php
get_footer();
