<?php
/**
 * Template Name: Properties
 *
 * @package GrowmodoAssessment
 */

get_header();
$properties = new WP_Query(array(
    'post_type'      => 'property',
    'posts_per_page' => 9,
    'orderby'        => 'date',
    'order'          => 'ASC',
));
?>
<main id="main" class="site-main">
    <section class="page-hero page-hero--properties">
        <div class="container page-hero__inner">
            <h1><?php esc_html_e('Find Your Dream Property', 'growmodo-assessment'); ?></h1>
            <p class="page-hero__description"><?php esc_html_e('Welcome to Estatein, where your dream property awaits in every corner of our beautiful world. Explore our curated selection of properties, each offering a unique story and a chance to redefine your life.', 'growmodo-assessment'); ?></p>
        </div>
        <div class="container property-search">
            <form class="property-search__bar" role="search" action="<?php echo esc_url(home_url('/properties/')); ?>" method="get">
                <label class="screen-reader-text" for="property-search"><?php esc_html_e('Search for a property', 'growmodo-assessment'); ?></label>
                <input id="property-search" name="s" type="search" placeholder="<?php esc_attr_e('Search For A Property', 'growmodo-assessment'); ?>">
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
    </section>
    <section class="section">
        <div class="container section__header">
            <p class="eyebrow"><?php esc_html_e('Discover a World of Possibilities', 'growmodo-assessment'); ?></p>
            <h2><?php esc_html_e('Our portfolio of properties is as diverse as your dreams.', 'growmodo-assessment'); ?></h2>
            <p><?php esc_html_e('Explore the following categories to find the perfect property that resonates with your vision of home.', 'growmodo-assessment'); ?></p>
        </div>
        <div class="container work-grid">
            <?php if ($properties->have_posts()) : ?>
                <?php while ($properties->have_posts()) : $properties->the_post(); ?>
                    <?php get_template_part('template-parts/content', 'property'); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
                <?php
                $fallback_properties = array(
                    array(
                        'title'     => 'Seaside Serenity Villa',
                        'price'     => '$1,250,000',
                        'image'     => 'estatein-card-seaside.png',
                        'kicker'    => 'Coastal Escapes - Where Waves Beckon',
                        'excerpt'   => 'Wake up to the soothing melody of waves. This beachfront villa offers panoramic ocean views.',
                        'type'      => 'Villa',
                    ),
                    array(
                        'title'     => 'Metropolitan Haven',
                        'price'     => '$650,000',
                        'image'     => 'estatein-card-metropolitan.png',
                        'kicker'    => 'Urban Oasis - Life in the Heart of the City',
                        'excerpt'   => 'Immerse yourself in the energy of the city. This modern apartment places you close to everything.',
                        'type'      => 'Apartment',
                    ),
                    array(
                        'title'     => 'Rustic Retreat Cottage',
                        'price'     => '$350,000',
                        'image'     => 'estatein-card-rustic.png',
                        'kicker'    => 'Countryside Charm - Escape to Nature\'s Embrace',
                        'excerpt'   => 'Find tranquility in the countryside. This charming cottage is nestled among rolling hills and trees.',
                        'type'      => 'Cottage',
                    ),
                );
                foreach ($fallback_properties as $property) :
                    ?>
                    <article class="card property-card">
                        <a class="card__link" href="<?php echo esc_url(home_url('/properties/')); ?>">
                            <div class="card__media">
                                <img src="<?php echo esc_url(growmodo_assessment_asset('images/' . $property['image'])); ?>" alt="<?php echo esc_attr($property['title']); ?>" loading="lazy">
                            </div>
                            <div class="card__body">
                                <p class="card__kicker"><?php echo esc_html($property['kicker']); ?></p>
                                <h2><?php echo esc_html($property['title']); ?></h2>
                                <p><?php echo esc_html($property['excerpt']); ?> <span><?php esc_html_e('Read More', 'growmodo-assessment'); ?></span></p>
                                <ul class="property-specs">
                                    <li class="property-specs__bed"><?php esc_html_e('4-Bedroom', 'growmodo-assessment'); ?></li>
                                    <li class="property-specs__bath"><?php esc_html_e('3-Bathroom', 'growmodo-assessment'); ?></li>
                                    <li class="property-specs__type"><?php echo esc_html($property['type']); ?></li>
                                </ul>
                                <div class="property-card__bottom">
                                    <div><small><?php esc_html_e('Price', 'growmodo-assessment'); ?></small><strong><?php echo esc_html($property['price']); ?></strong></div>
                                    <span class="button button--primary"><?php esc_html_e('View Property Details', 'growmodo-assessment'); ?></span>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="container section-pager" aria-label="<?php esc_attr_e('Properties carousel controls', 'growmodo-assessment'); ?>">
            <span><?php esc_html_e('01 of 10', 'growmodo-assessment'); ?></span>
            <div>
                <a href="<?php echo esc_url(home_url('/properties/')); ?>" aria-label="<?php esc_attr_e('Previous properties', 'growmodo-assessment'); ?>">&#8592;</a>
                <a href="<?php echo esc_url(home_url('/properties/')); ?>" aria-label="<?php esc_attr_e('Next properties', 'growmodo-assessment'); ?>">&#8594;</a>
            </div>
        </div>
    </section>

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
</main>
<?php
get_footer();
