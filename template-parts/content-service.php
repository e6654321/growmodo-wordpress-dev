<?php
/**
 * Service card content.
 *
 * @package GrowmodoAssessment
 */
?>
<article <?php post_class('feature-card'); ?>>
    <span class="feature-card__icon" aria-hidden="true"></span>
    <h2><?php the_title(); ?></h2>
    <p><?php echo esc_html(get_the_excerpt()); ?></p>
</article>
