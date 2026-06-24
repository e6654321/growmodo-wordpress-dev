<?php
/**
 * Page template.
 *
 * @package GrowmodoAssessment
 */

get_header();
?>
<main id="main" class="site-main">
    <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class('page-content'); ?>>
            <header class="page-hero">
                <div class="container page-hero__inner">
                    <p class="eyebrow"><?php esc_html_e('Page', 'growmodo-assessment'); ?></p>
                    <h1><?php the_title(); ?></h1>
                </div>
            </header>
            <div class="container prose">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; ?>
</main>
<?php
get_footer();
