<?php
/**
 * Homepage testimonials section.
 *
 * @package GrowmodoAssessment
 */

$testimonials = array(
    array(
        __('Exceptional Service!', 'growmodo-assessment'),
        __('Our experience with Estatein was outstanding. Their team guided us through every step with care, clarity, and confidence.', 'growmodo-assessment'),
        __('Wade Warren', 'growmodo-assessment'),
        __('USA, California', 'growmodo-assessment'),
    ),
    array(
        __('Efficient and Reliable', 'growmodo-assessment'),
        __('Estatein made selling our property smooth and successful. Their market insight and communication were exactly what we needed.', 'growmodo-assessment'),
        __('Emelie Smith', 'growmodo-assessment'),
        __('USA, Florida', 'growmodo-assessment'),
    ),
    array(
        __('Trusted Advisors', 'growmodo-assessment'),
        __('Their understanding of investment properties helped us find a strong opportunity without feeling rushed or overwhelmed.', 'growmodo-assessment'),
        __('John Pathan', 'growmodo-assessment'),
        __('USA, Nevada', 'growmodo-assessment'),
    ),
);
?>
<section class="section section--home-testimonials">
    <div class="container split-heading">
        <div>
            <p class="eyebrow"><?php esc_html_e('Our Clients', 'growmodo-assessment'); ?></p>
            <h2><?php esc_html_e('What Our Clients Say', 'growmodo-assessment'); ?></h2>
            <p><?php esc_html_e('Read the success stories and heartfelt testimonials from our valued clients. Discover why they chose Estatein for their real estate needs.', 'growmodo-assessment'); ?></p>
        </div>
        <a class="text-link" href="<?php echo esc_url(home_url('/about-us/')); ?>"><?php esc_html_e('View All Testimonials', 'growmodo-assessment'); ?></a>
    </div>
    <div class="container testimonial-grid">
        <?php foreach ($testimonials as $testimonial) : ?>
            <article class="testimonial-card">
                <div class="rating" aria-label="<?php esc_attr_e('Five star rating', 'growmodo-assessment'); ?>">
                    <span>5.0</span>
                    <span><?php esc_html_e('5 / 5', 'growmodo-assessment'); ?></span>
                </div>
                <h3><?php echo esc_html($testimonial[0]); ?></h3>
                <p><?php echo esc_html($testimonial[1]); ?></p>
                <div class="testimonial-card__author">
                    <span aria-hidden="true"></span>
                    <div>
                        <strong><?php echo esc_html($testimonial[2]); ?></strong>
                        <small><?php echo esc_html($testimonial[3]); ?></small>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
    <div class="container section-pager" aria-label="<?php esc_attr_e('Testimonials carousel controls', 'growmodo-assessment'); ?>">
        <span><?php esc_html_e('01 of 10', 'growmodo-assessment'); ?></span>
        <div>
            <a href="<?php echo esc_url(home_url('/about-us/')); ?>" aria-label="<?php esc_attr_e('Previous testimonials', 'growmodo-assessment'); ?>">&larr;</a>
            <a href="<?php echo esc_url(home_url('/about-us/')); ?>" aria-label="<?php esc_attr_e('Next testimonials', 'growmodo-assessment'); ?>">&rarr;</a>
        </div>
    </div>
</section>
