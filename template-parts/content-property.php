<?php
/**
 * Property card content.
 *
 * @package GrowmodoAssessment
 */
?>
<article <?php post_class('card property-card'); ?>>
    <a class="card__link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
        <?php growmodo_assessment_card_image(get_the_ID()); ?>
        <div class="card__body">
            <p class="card__kicker"><?php echo esc_html(growmodo_assessment_property_kicker(get_the_ID())); ?></p>
            <h2><?php the_title(); ?></h2>
            <p><?php echo esc_html(growmodo_assessment_property_excerpt(get_the_ID())); ?> <span><?php esc_html_e('Read More', 'growmodo-assessment'); ?></span></p>
            <ul class="property-specs">
                <li class="property-specs__bed"><?php echo esc_html(growmodo_assessment_field('bedrooms', '4-Bedroom')); ?></li>
                <li class="property-specs__bath"><?php echo esc_html(growmodo_assessment_field('bathrooms', '3-Bathroom')); ?></li>
                <li class="property-specs__type"><?php echo esc_html(growmodo_assessment_field('property_type', 'Villa')); ?></li>
            </ul>
            <div class="property-card__bottom">
                <div>
                    <small><?php esc_html_e('Price', 'growmodo-assessment'); ?></small>
                    <strong><?php echo esc_html(growmodo_assessment_field('price', '$550,000')); ?></strong>
                </div>
                <span class="button button--primary"><?php esc_html_e('View Property Details', 'growmodo-assessment'); ?></span>
            </div>
        </div>
    </a>
</article>
