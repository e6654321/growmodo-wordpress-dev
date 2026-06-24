<?php
/**
 * Contact CTA section.
 *
 * @package GrowmodoAssessment
 */
?>
<section class="section">
    <div class="container cta-band">
        <div>
            <h2><?php esc_html_e('Start Your Real Estate Journey Today', 'growmodo-assessment'); ?></h2>
            <p><?php esc_html_e('Your dream property is just a click away. Whether you are looking for a new home, a strategic investment, or expert real estate advice, Estatein is here to assist you every step of the way.', 'growmodo-assessment'); ?></p>
        </div>
        <?php growmodo_assessment_button(__('Explore Properties', 'growmodo-assessment'), home_url('/properties/'), 'primary'); ?>
    </div>
</section>
