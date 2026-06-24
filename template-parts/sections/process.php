<?php
/**
 * Process section.
 *
 * @package GrowmodoAssessment
 */

$steps = array(
    array(__('Discover', 'growmodo-assessment'), __('Tell us your goals, lifestyle needs, preferred locations, and budget range.', 'growmodo-assessment')),
    array(__('Shortlist', 'growmodo-assessment'), __('Review curated property options with clear details and expert context.', 'growmodo-assessment')),
    array(__('Close', 'growmodo-assessment'), __('Move forward with negotiation, paperwork, and guidance through every step.', 'growmodo-assessment')),
);
?>
<section class="section section--dark">
    <div class="container process">
        <div class="section__header section__header--left">
            <p class="eyebrow"><?php esc_html_e('How It Works', 'growmodo-assessment'); ?></p>
            <h2><?php esc_html_e('A simpler path from search to signed.', 'growmodo-assessment'); ?></h2>
        </div>
        <ol class="process__list">
            <?php foreach ($steps as $index => $step) : ?>
                <li>
                    <span><?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
                    <h3><?php echo esc_html($step[0]); ?></h3>
                    <p><?php echo esc_html($step[1]); ?></p>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>
