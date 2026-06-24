<?php
/**
 * Single post template.
 *
 * @package GrowmodoAssessment
 */

get_header();
?>
<main id="main" class="site-main">
    <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class('single-content'); ?>>
            <header class="page-hero">
                <div class="container page-hero__inner">
                    <p class="eyebrow"><?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?></p>
                    <h1><?php the_title(); ?></h1>
                    <p class="single-content__meta"><?php echo esc_html(get_the_date()); ?></p>
                </div>
            </header>
            <div class="container single-content__media">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large'); ?>
                <?php endif; ?>
            </div>
            <div class="container prose">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; ?>
</main>
<?php
get_footer();
