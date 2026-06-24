<?php
/**
 * Homepage template.
 *
 * @package GrowmodoAssessment
 */

get_header();
?>
<main id="main" class="site-main">
    <?php get_template_part('template-parts/sections/hero'); ?>
    <?php get_template_part('template-parts/sections/work'); ?>
    <?php get_template_part('template-parts/sections/testimonials'); ?>
    <?php get_template_part('template-parts/sections/faq'); ?>
    <?php get_template_part('template-parts/sections/contact'); ?>
</main>
<?php
get_footer();
