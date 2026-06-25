<?php
/**
 * Contact form.
 *
 * @package GrowmodoAssessment
 */
?>
<?php $prefill_email = isset($_GET['email']) ? sanitize_email(wp_unslash($_GET['email'])) : ''; ?>
<form class="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" data-contact-form>
    <input type="hidden" name="action" value="growmodo_contact">
    <input type="hidden" name="redirect_to" value="<?php echo esc_url(get_permalink() ?: home_url('/contact/')); ?>">
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
        <input name="email" type="email" autocomplete="email" value="<?php echo esc_attr($prefill_email); ?>" placeholder="<?php esc_attr_e('Enter your Email', 'growmodo-assessment'); ?>" required>
    </label>
    <label>
        <span><?php esc_html_e('Phone', 'growmodo-assessment'); ?></span>
        <input name="phone" type="tel" autocomplete="tel" placeholder="<?php esc_attr_e('Enter Phone Number', 'growmodo-assessment'); ?>">
    </label>
    <label>
        <span><?php esc_html_e('Preferred Location', 'growmodo-assessment'); ?></span>
        <select name="location">
            <option><?php esc_html_e('Select Location', 'growmodo-assessment'); ?></option>
            <option><?php esc_html_e('Metropolis', 'growmodo-assessment'); ?></option>
            <option><?php esc_html_e('Coastal Area', 'growmodo-assessment'); ?></option>
            <option><?php esc_html_e('Countryside', 'growmodo-assessment'); ?></option>
        </select>
    </label>
    <label>
        <span><?php esc_html_e('Property Type', 'growmodo-assessment'); ?></span>
        <select name="property_type">
            <option><?php esc_html_e('Select Property Type', 'growmodo-assessment'); ?></option>
            <option><?php esc_html_e('Villa', 'growmodo-assessment'); ?></option>
            <option><?php esc_html_e('Apartment', 'growmodo-assessment'); ?></option>
            <option><?php esc_html_e('Cottage', 'growmodo-assessment'); ?></option>
        </select>
    </label>
    <label>
        <span><?php esc_html_e('No. of Bathrooms', 'growmodo-assessment'); ?></span>
        <select name="bathrooms">
            <option><?php esc_html_e('Select no. of Bathrooms', 'growmodo-assessment'); ?></option>
            <option>1</option>
            <option>2</option>
            <option>3+</option>
        </select>
    </label>
    <label>
        <span><?php esc_html_e('No. of Bedrooms', 'growmodo-assessment'); ?></span>
        <select name="bedrooms">
            <option><?php esc_html_e('Select no. of Bedrooms', 'growmodo-assessment'); ?></option>
            <option>1</option>
            <option>2</option>
            <option>3+</option>
        </select>
    </label>
    <label>
        <span><?php esc_html_e('Budget', 'growmodo-assessment'); ?></span>
        <select name="budget">
            <option><?php esc_html_e('Select Budget', 'growmodo-assessment'); ?></option>
            <option><?php esc_html_e('$250,000 - $500,000', 'growmodo-assessment'); ?></option>
            <option><?php esc_html_e('$500,000 - $1,000,000', 'growmodo-assessment'); ?></option>
            <option><?php esc_html_e('$1,000,000+', 'growmodo-assessment'); ?></option>
        </select>
    </label>
    <label>
        <span><?php esc_html_e('Preferred Contact Method', 'growmodo-assessment'); ?></span>
        <select name="preferred_contact">
            <option><?php esc_html_e('Select Contact Method', 'growmodo-assessment'); ?></option>
            <option><?php esc_html_e('Email', 'growmodo-assessment'); ?></option>
            <option><?php esc_html_e('Phone', 'growmodo-assessment'); ?></option>
            <option><?php esc_html_e('Either is fine', 'growmodo-assessment'); ?></option>
        </select>
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
