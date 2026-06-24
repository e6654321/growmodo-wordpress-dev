<?php
/**
 * Single property template.
 *
 * @package GrowmodoAssessment
 */

get_header();
?>
<main id="main" class="site-main">
    <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class('single-content property-detail'); ?>>
            <header class="property-detail__header">
                <div class="container property-detail__titlebar">
                    <div>
                        <h1><?php the_title(); ?></h1>
                        <span class="property-location"><?php esc_html_e('Malibu, California', 'growmodo-assessment'); ?></span>
                    </div>
                    <div>
                        <small><?php esc_html_e('Price', 'growmodo-assessment'); ?></small>
                        <strong><?php echo esc_html(growmodo_assessment_field('price', '$1,250,000')); ?></strong>
                    </div>
                </div>
            </header>

            <section class="section property-gallery-section">
                <div class="container property-gallery">
                    <div class="property-gallery__thumbs">
                        <img src="<?php echo esc_url(growmodo_assessment_asset('images/estatein-card-seaside.png')); ?>" alt="<?php esc_attr_e('Property thumbnail exterior', 'growmodo-assessment'); ?>">
                        <img src="<?php echo esc_url(growmodo_assessment_asset('images/estatein-card-metropolitan.png')); ?>" alt="<?php esc_attr_e('Property thumbnail city building', 'growmodo-assessment'); ?>">
                        <img src="<?php echo esc_url(growmodo_assessment_asset('images/estatein-card-rustic.png')); ?>" alt="<?php esc_attr_e('Property thumbnail city tower', 'growmodo-assessment'); ?>">
                        <img src="<?php echo esc_url(growmodo_assessment_asset('images/figma-estatein-example.png')); ?>" alt="<?php esc_attr_e('Estatein property preview', 'growmodo-assessment'); ?>">
                        <img src="<?php echo esc_url(growmodo_assessment_asset('images/property-seaside.png')); ?>" alt="<?php esc_attr_e('Property thumbnail pool view', 'growmodo-assessment'); ?>">
                        <img src="<?php echo esc_url(growmodo_assessment_asset('images/property-metropolitan.png')); ?>" alt="<?php esc_attr_e('Property thumbnail metropolitan view', 'growmodo-assessment'); ?>">
                        <img src="<?php echo esc_url(growmodo_assessment_asset('images/property-rustic.png')); ?>" alt="<?php esc_attr_e('Property thumbnail exterior angle', 'growmodo-assessment'); ?>">
                        <img src="<?php echo esc_url(growmodo_assessment_asset('images/figma-estatein-screens.png')); ?>" alt="<?php esc_attr_e('Estatein gallery thumbnail set', 'growmodo-assessment'); ?>">
                    </div>
                    <div class="property-gallery__main">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large'); ?>
                        <?php else : ?>
                            <img src="<?php echo esc_url(growmodo_assessment_asset('images/estatein-card-seaside.png')); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                        <img src="<?php echo esc_url(growmodo_assessment_asset('images/figma-estatein-screens.png')); ?>" alt="<?php esc_attr_e('Estatein interior and exterior gallery preview', 'growmodo-assessment'); ?>">
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="container property-detail__grid">
                    <div class="detail-panel">
                        <h2><?php esc_html_e('Description', 'growmodo-assessment'); ?></h2>
                        <?php the_content(); ?>
                        <div class="property-detail-stats">
                            <div>
                                <span><?php esc_html_e('Bedrooms', 'growmodo-assessment'); ?></span>
                                <strong><?php echo esc_html(growmodo_assessment_field('bedrooms', '04')); ?></strong>
                            </div>
                            <div>
                                <span><?php esc_html_e('Bathrooms', 'growmodo-assessment'); ?></span>
                                <strong><?php echo esc_html(growmodo_assessment_field('bathrooms', '03')); ?></strong>
                            </div>
                            <div>
                                <span><?php esc_html_e('Area', 'growmodo-assessment'); ?></span>
                                <strong><?php esc_html_e('2,500 Square Feet', 'growmodo-assessment'); ?></strong>
                            </div>
                        </div>
                    </div>
                    <div class="detail-panel">
                        <h2><?php esc_html_e('Key Features and Amenities', 'growmodo-assessment'); ?></h2>
                        <ul class="feature-list">
                            <li><?php esc_html_e('Expansive oceanfront terrace for outdoor entertaining', 'growmodo-assessment'); ?></li>
                            <li><?php esc_html_e('Gourmet kitchen with top-of-the-line appliances', 'growmodo-assessment'); ?></li>
                            <li><?php esc_html_e('Private beach access for morning strolls and sunset views', 'growmodo-assessment'); ?></li>
                            <li><?php esc_html_e('Master suite with spa-inspired bathroom and ocean-facing balcony', 'growmodo-assessment'); ?></li>
                            <li><?php esc_html_e('Private garage and ample storage space', 'growmodo-assessment'); ?></li>
                        </ul>
                    </div>
                </div>
            </section>

            <section class="section">
                <div class="container property-inquiry">
                    <div>
                        <p class="eyebrow"><?php esc_html_e('Inquire About', 'growmodo-assessment'); ?></p>
                        <h2><?php the_title(); ?></h2>
                        <p><?php esc_html_e('Interested in this property? Fill out the form and our team will contact you with more details, viewing availability, and next steps.', 'growmodo-assessment'); ?></p>
                    </div>
                    <form class="contact-form property-inquiry-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" data-contact-form>
                        <input type="hidden" name="action" value="growmodo_contact">
                        <?php wp_nonce_field('growmodo_contact', 'growmodo_contact_nonce'); ?>
                        <label>
                            <span><?php esc_html_e('First Name', 'growmodo-assessment'); ?></span>
                            <input name="name" type="text" autocomplete="given-name" placeholder="<?php esc_attr_e('Enter First Name', 'growmodo-assessment'); ?>" required>
                        </label>
                        <label>
                            <span><?php esc_html_e('Last Name', 'growmodo-assessment'); ?></span>
                            <input name="last_name" type="text" autocomplete="family-name" placeholder="<?php esc_attr_e('Enter Last Name', 'growmodo-assessment'); ?>">
                        </label>
                        <label>
                            <span><?php esc_html_e('Email', 'growmodo-assessment'); ?></span>
                            <input name="email" type="email" autocomplete="email" placeholder="<?php esc_attr_e('Enter your Email', 'growmodo-assessment'); ?>" required>
                        </label>
                        <label>
                            <span><?php esc_html_e('Phone', 'growmodo-assessment'); ?></span>
                            <input name="phone" type="tel" autocomplete="tel" placeholder="<?php esc_attr_e('Enter Phone Number', 'growmodo-assessment'); ?>">
                        </label>
                        <label class="contact-form__wide selected-property-field">
                            <span><?php esc_html_e('Selected Property', 'growmodo-assessment'); ?></span>
                            <input name="selected_property" type="text" value="<?php echo esc_attr(get_the_title() . ', Malibu, California'); ?>" readonly>
                        </label>
                        <label class="contact-form__wide">
                            <span><?php esc_html_e('Message', 'growmodo-assessment'); ?></span>
                            <textarea name="message" rows="5" placeholder="<?php esc_attr_e('Enter your Message here...', 'growmodo-assessment'); ?>" required></textarea>
                        </label>
                        <label class="contact-form__consent">
                            <input name="terms" type="checkbox" required>
                            <span><?php esc_html_e('I agree with Terms of Use and Privacy Policy', 'growmodo-assessment'); ?></span>
                        </label>
                        <button class="button button--primary" type="submit"><?php esc_html_e('Send Your Message', 'growmodo-assessment'); ?></button>
                        <p class="contact-form__note" data-form-note hidden><?php esc_html_e('Thanks. In a production build this can be connected to a mail or CRM plugin.', 'growmodo-assessment'); ?></p>
                    </form>
                </div>
            </section>

            <section class="section">
                <div class="container split-heading">
                    <div>
                        <p class="eyebrow"><?php esc_html_e('Comprehensive Pricing Details', 'growmodo-assessment'); ?></p>
                        <h2><?php esc_html_e('Comprehensive Pricing Details', 'growmodo-assessment'); ?></h2>
                        <p><?php esc_html_e('We believe in transparency. Below is a simple breakdown of the key pricing information around this property.', 'growmodo-assessment'); ?></p>
                    </div>
                </div>
                <div class="container pricing-overview">
                    <article class="pricing-lead">
                        <span><?php esc_html_e('Listing Price', 'growmodo-assessment'); ?></span>
                        <strong><?php echo esc_html(growmodo_assessment_field('price', '$1,250,000')); ?></strong>
                    </article>
                    <div class="pricing-grid">
                        <article class="detail-panel">
                            <h3><?php esc_html_e('Additional Fees', 'growmodo-assessment'); ?></h3>
                            <dl class="pricing-list">
                                <div><dt><?php esc_html_e('Property Transfer Tax', 'growmodo-assessment'); ?></dt><dd><?php esc_html_e('$25,000', 'growmodo-assessment'); ?></dd></div>
                                <div><dt><?php esc_html_e('Legal Fees', 'growmodo-assessment'); ?></dt><dd><?php esc_html_e('$3,000', 'growmodo-assessment'); ?></dd></div>
                                <div><dt><?php esc_html_e('Home Inspection', 'growmodo-assessment'); ?></dt><dd><?php esc_html_e('$700', 'growmodo-assessment'); ?></dd></div>
                                <div><dt><?php esc_html_e('Property Insurance', 'growmodo-assessment'); ?></dt><dd><?php esc_html_e('$1,000', 'growmodo-assessment'); ?></dd></div>
                            </dl>
                        </article>
                        <article class="detail-panel">
                            <h3><?php esc_html_e('Monthly Costs', 'growmodo-assessment'); ?></h3>
                            <dl class="pricing-list">
                                <div><dt><?php esc_html_e('Property Taxes', 'growmodo-assessment'); ?></dt><dd><?php esc_html_e('$1,250', 'growmodo-assessment'); ?></dd></div>
                                <div><dt><?php esc_html_e('Homeowners Association Fee', 'growmodo-assessment'); ?></dt><dd><?php esc_html_e('$300', 'growmodo-assessment'); ?></dd></div>
                            </dl>
                        </article>
                    </div>
                </div>
            </section>
        </article>
    <?php endwhile; ?>
    <?php get_template_part('template-parts/sections/contact'); ?>
</main>
<?php
get_footer();
