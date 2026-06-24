<?php
/**
 * Main template.
 *
 * @package GrowmodoAssessment
 */

get_header();
?>
<main id="main" class="site-main">
    <section class="section">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="archive-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('template-parts/content', get_post_type()); ?>
                    <?php endwhile; ?>
                </div>
                <?php the_posts_pagination(); ?>
            <?php else : ?>
                <article class="empty-state">
                    <h1><?php esc_html_e('Nothing found', 'growmodo-assessment'); ?></h1>
                    <p><?php esc_html_e('Try another search or come back soon.', 'growmodo-assessment'); ?></p>
                </article>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php
get_footer();
