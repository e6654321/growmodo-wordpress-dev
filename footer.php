<?php
/**
 * Site footer.
 *
 * @package GrowmodoAssessment
 */
?>
<footer class="site-footer">
    <div class="container site-footer__grid">
        <div class="site-footer__brand">
            <a class="brand brand--footer" href="<?php echo esc_url(home_url('/')); ?>">
                <span class="brand__mark" aria-hidden="true"></span>
                <span class="brand__text">Estatein</span>
            </a>
            <form class="footer-subscribe" action="<?php echo esc_url(home_url('/contact/')); ?>" method="get">
                <label class="screen-reader-text" for="footer-email"><?php esc_html_e('Email address', 'growmodo-assessment'); ?></label>
                <input id="footer-email" type="email" placeholder="<?php esc_attr_e('Enter Your Email', 'growmodo-assessment'); ?>">
                <button type="submit" aria-label="<?php esc_attr_e('Submit email', 'growmodo-assessment'); ?>">&#8594;</button>
            </form>
        </div>

        <nav class="site-footer__sitemap" aria-label="<?php esc_attr_e('Footer navigation', 'growmodo-assessment'); ?>">
            <div class="site-footer__column">
                <span><?php esc_html_e('Home', 'growmodo-assessment'); ?></span>
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Hero Section', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Features', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/properties/')); ?>"><?php esc_html_e('Properties', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Testimonials', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('FAQ\'s', 'growmodo-assessment'); ?></a>
            </div>
            <div class="site-footer__column">
                <span><?php esc_html_e('About Us', 'growmodo-assessment'); ?></span>
                <a href="<?php echo esc_url(home_url('/about-us/')); ?>"><?php esc_html_e('Our Story', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/about-us/')); ?>"><?php esc_html_e('Our Works', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/about-us/')); ?>"><?php esc_html_e('How It Works', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/about-us/')); ?>"><?php esc_html_e('Our Team', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/about-us/')); ?>"><?php esc_html_e('Our Clients', 'growmodo-assessment'); ?></a>
            </div>
            <div class="site-footer__column">
                <span><?php esc_html_e('Properties', 'growmodo-assessment'); ?></span>
                <a href="<?php echo esc_url(home_url('/properties/')); ?>"><?php esc_html_e('Portfolio', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/properties/')); ?>"><?php esc_html_e('Categories', 'growmodo-assessment'); ?></a>
            </div>
            <div class="site-footer__column">
                <span><?php esc_html_e('Services', 'growmodo-assessment'); ?></span>
                <a href="<?php echo esc_url(home_url('/services/')); ?>"><?php esc_html_e('Valuation Mastery', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/services/')); ?>"><?php esc_html_e('Strategic Marketing', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/services/')); ?>"><?php esc_html_e('Negotiation Wizardry', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/services/')); ?>"><?php esc_html_e('Closing Success', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/services/')); ?>"><?php esc_html_e('Property Management', 'growmodo-assessment'); ?></a>
            </div>
            <div class="site-footer__column">
                <span><?php esc_html_e('Contact Us', 'growmodo-assessment'); ?></span>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Contact Form', 'growmodo-assessment'); ?></a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Our Offices', 'growmodo-assessment'); ?></a>
            </div>
        </nav>
    </div>
    <div class="container site-footer__bottom">
        <div class="site-footer__legal">
            <small><?php esc_html_e('@2023 Estatein. All Rights Reserved.', 'growmodo-assessment'); ?></small>
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Terms & Conditions', 'growmodo-assessment'); ?></a>
        </div>
        <nav class="site-footer__social" aria-label="<?php esc_attr_e('Social links', 'growmodo-assessment'); ?>">
            <a class="social-link social-link--facebook" href="<?php echo esc_url(home_url('/contact/')); ?>" aria-label="<?php esc_attr_e('Facebook', 'growmodo-assessment'); ?>">f</a>
            <a class="social-link social-link--linkedin" href="<?php echo esc_url(home_url('/contact/')); ?>" aria-label="<?php esc_attr_e('LinkedIn', 'growmodo-assessment'); ?>">in</a>
            <a class="social-link social-link--twitter" href="<?php echo esc_url(home_url('/contact/')); ?>" aria-label="<?php esc_attr_e('Twitter', 'growmodo-assessment'); ?>">x</a>
            <a class="social-link social-link--youtube" href="<?php echo esc_url(home_url('/contact/')); ?>" aria-label="<?php esc_attr_e('YouTube', 'growmodo-assessment'); ?>">▶</a>
        </nav>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
