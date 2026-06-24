<?php
/**
 * Work section.
 *
 * @package GrowmodoAssessment
 */

$work = new WP_Query(array(
    'post_type'      => 'property',
    'posts_per_page' => 3,
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
));
?>
<section class="section">
    <div class="container split-heading">
        <div>
            <p class="eyebrow"><?php esc_html_e('Featured Properties', 'growmodo-assessment'); ?></p>
            <h2><?php esc_html_e('Explore our handpicked selection of featured properties.', 'growmodo-assessment'); ?></h2>
            <p><?php esc_html_e('Each listing is chosen for its comfort, value, and lifestyle potential, giving you a clear starting point for your property journey.', 'growmodo-assessment'); ?></p>
        </div>
        <a class="text-link" href="<?php echo esc_url(home_url('/properties/')); ?>"><?php esc_html_e('View All Properties', 'growmodo-assessment'); ?></a>
    </div>
    <div class="container work-grid">
        <?php if ($work->have_posts()) : ?>
            <?php while ($work->have_posts()) : $work->the_post(); ?>
                <?php get_template_part('template-parts/content', 'property'); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php else : ?>
            <?php
            $properties = array(
                array('Seaside Serenity Villa', 'A stunning 4-bedroom, 3-bathroom villa in a peaceful coastal neighborhood.', '$1,250,000', '4-Bedroom', '3-Bathroom', 'Villa', 'estatein-card-seaside.png'),
                array('Metropolitan Haven', 'A chic 2-bedroom apartment with panoramic city views and premium finishes.', '$650,000', '2-Bedroom', '2-Bathroom', 'Apartment', 'estatein-card-metropolitan.png'),
                array('Rustic Retreat Cottage', 'A warm countryside cottage designed for comfort, privacy, and weekend escapes.', '$350,000', '3-Bedroom', '2-Bathroom', 'Cottage', 'estatein-card-rustic.png'),
            );
            foreach ($properties as $property) :
                ?>
                <article class="card property-card">
                    <a class="card__link" href="<?php echo esc_url(home_url('/properties/')); ?>">
                        <div class="card__media">
                            <img src="<?php echo esc_url(growmodo_assessment_asset('images/' . $property[6])); ?>" alt="<?php echo esc_attr($property[0]); ?>" loading="lazy">
                        </div>
                        <div class="card__body">
                            <h3><?php echo esc_html($property[0]); ?></h3>
                            <p><?php echo esc_html($property[1]); ?> <span><?php esc_html_e('Read More', 'growmodo-assessment'); ?></span></p>
                            <ul class="property-specs">
                                <li><?php echo esc_html($property[3]); ?></li>
                                <li><?php echo esc_html($property[4]); ?></li>
                                <li><?php echo esc_html($property[5]); ?></li>
                            </ul>
                            <div class="property-card__bottom">
                                <div><small><?php esc_html_e('Price', 'growmodo-assessment'); ?></small><strong><?php echo esc_html($property[2]); ?></strong></div>
                                <span class="button button--primary"><?php esc_html_e('View Property Details', 'growmodo-assessment'); ?></span>
                            </div>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="container section-pager" aria-label="<?php esc_attr_e('Featured properties carousel controls', 'growmodo-assessment'); ?>">
        <span><?php esc_html_e('01 of 60', 'growmodo-assessment'); ?></span>
        <div>
            <a href="<?php echo esc_url(home_url('/properties/')); ?>" aria-label="<?php esc_attr_e('Previous featured properties', 'growmodo-assessment'); ?>">&larr;</a>
            <a href="<?php echo esc_url(home_url('/properties/')); ?>" aria-label="<?php esc_attr_e('Next featured properties', 'growmodo-assessment'); ?>">&rarr;</a>
        </div>
    </div>
</section>
