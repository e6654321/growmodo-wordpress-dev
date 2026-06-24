<?php
/**
 * Card content.
 *
 * @package GrowmodoAssessment
 */
?>
<article <?php post_class('card'); ?>>
    <a class="card__link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
        <?php growmodo_assessment_card_image(get_the_ID()); ?>
        <div class="card__body">
            <p class="card__kicker"><?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?></p>
            <h2><?php the_title(); ?></h2>
            <p><?php echo esc_html(get_the_excerpt()); ?></p>
        </div>
    </a>
</article>
