<?php
/**
 * Template Name: About Us
 *
 * @package GrowmodoAssessment
 */

get_header();

$values = array(
    array(__('Trust', 'growmodo-assessment'), __('Trust is the foundation of every successful real estate journey. We deliver transparent guidance and dependable support.', 'growmodo-assessment')),
    array(__('Excellence', 'growmodo-assessment'), __('We set high standards for every listing, client interaction, and recommendation we make.', 'growmodo-assessment')),
    array(__('Client-Centric', 'growmodo-assessment'), __('Your goals guide our process, from first consultation through negotiation and closing.', 'growmodo-assessment')),
    array(__('Commitment', 'growmodo-assessment'), __('We stay involved, informed, and responsive so every decision feels clearer.', 'growmodo-assessment')),
);

$achievements = array(
    array(__('3+ Years of Excellence', 'growmodo-assessment'), __('Estatein has grown from a focused real estate team into a trusted property partner.', 'growmodo-assessment')),
    array(__('Happy Clients', 'growmodo-assessment'), __('Our greatest achievement is the trust of clients who return and refer us.', 'growmodo-assessment')),
    array(__('Industry Recognition', 'growmodo-assessment'), __('Our work reflects modern property marketing, clear guidance, and strong outcomes.', 'growmodo-assessment')),
);

$steps = array(
    array(__('Step 01', 'growmodo-assessment'), __('Discovery', 'growmodo-assessment'), __('We learn your goals, timeline, budget, and property preferences.', 'growmodo-assessment')),
    array(__('Step 02', 'growmodo-assessment'), __('Strategy', 'growmodo-assessment'), __('We shape a clear plan for buying, selling, investing, or management.', 'growmodo-assessment')),
    array(__('Step 03', 'growmodo-assessment'), __('Selection', 'growmodo-assessment'), __('We compare opportunities using market context and practical details.', 'growmodo-assessment')),
    array(__('Step 04', 'growmodo-assessment'), __('Negotiation', 'growmodo-assessment'), __('We help you move through offers, terms, and paperwork with confidence.', 'growmodo-assessment')),
    array(__('Step 05', 'growmodo-assessment'), __('Closing', 'growmodo-assessment'), __('We coordinate final steps and make the transition feel organized.', 'growmodo-assessment')),
    array(__('Step 06', 'growmodo-assessment'), __('Beyond', 'growmodo-assessment'), __('We remain available for future questions, opportunities, and support.', 'growmodo-assessment')),
);

$team = array(
    array(__('Max Mitchell', 'growmodo-assessment'), __('Founder', 'growmodo-assessment'), 'team-max-mitchell.png'),
    array(__('Sarah Johnson', 'growmodo-assessment'), __('Chief Real Estate Officer', 'growmodo-assessment'), 'team-sarah-johnson.png'),
    array(__('David Brown', 'growmodo-assessment'), __('Head of Property Management', 'growmodo-assessment'), 'team-david-brown.png'),
    array(__('Michael Turner', 'growmodo-assessment'), __('Legal Counsel', 'growmodo-assessment'), 'team-michael-turner.png'),
);

$clients = array(
    array(
        'since'    => __('Since 2019', 'growmodo-assessment'),
        'name'     => __('ABC Corporation', 'growmodo-assessment'),
        'domain'   => __('Commercial Real Estate', 'growmodo-assessment'),
        'category' => __('Luxury Home Development', 'growmodo-assessment'),
        'quote'    => __('Estatein\'s expertise in finding the perfect office space for our expanding operations was invaluable. They truly understand our business needs.', 'growmodo-assessment'),
    ),
    array(
        'since'    => __('Since 2018', 'growmodo-assessment'),
        'name'     => __('GreenTech Enterprises', 'growmodo-assessment'),
        'domain'   => __('Commercial Real Estate', 'growmodo-assessment'),
        'category' => __('Retail Space', 'growmodo-assessment'),
        'quote'    => __('Estatein\'s ability to identify prime retail locations helped us expand our brand presence. They are a trusted partner in our growth.', 'growmodo-assessment'),
    ),
);
?>
<main id="main" class="site-main">
    <section class="about-hero section">
        <div class="container about-hero__grid">
            <div>
                <p class="eyebrow"><?php esc_html_e('Our Journey', 'growmodo-assessment'); ?></p>
                <h1><?php esc_html_e('Our Journey', 'growmodo-assessment'); ?></h1>
                <p><?php esc_html_e('Our story is one of continuous growth and evolution. We started as a small team with a shared vision: to make real estate experiences clearer, calmer, and more rewarding.', 'growmodo-assessment'); ?></p>
            </div>
            <div class="about-hero__visual" aria-hidden="true">
                <img src="<?php echo esc_url(growmodo_assessment_asset('images/figma-estatein-example.png')); ?>" alt="">
            </div>
        </div>
        <div class="container about-stats">
            <div><strong>200+</strong><span><?php esc_html_e('Happy Customers', 'growmodo-assessment'); ?></span></div>
            <div><strong>10k+</strong><span><?php esc_html_e('Properties For Clients', 'growmodo-assessment'); ?></span></div>
            <div><strong>16+</strong><span><?php esc_html_e('Years of Experience', 'growmodo-assessment'); ?></span></div>
        </div>
    </section>

    <section class="section">
        <div class="container split-heading">
            <div>
                <p class="eyebrow"><?php esc_html_e('Our Values', 'growmodo-assessment'); ?></p>
                <h2><?php esc_html_e('Our Values', 'growmodo-assessment'); ?></h2>
                <p><?php esc_html_e('Our values are the foundation of our work. They guide every decision, every recommendation, and every relationship.', 'growmodo-assessment'); ?></p>
            </div>
        </div>
        <div class="container value-grid">
            <?php foreach ($values as $value) : ?>
                <article class="value-card">
                    <span class="feature-card__icon" aria-hidden="true"></span>
                    <h3><?php echo esc_html($value[0]); ?></h3>
                    <p><?php echo esc_html($value[1]); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <div class="container split-heading">
            <div>
                <p class="eyebrow"><?php esc_html_e('Our Achievements', 'growmodo-assessment'); ?></p>
                <h2><?php esc_html_e('Our Achievements', 'growmodo-assessment'); ?></h2>
                <p><?php esc_html_e('Our story is built on meaningful progress, trusted relationships, and a commitment to better property decisions.', 'growmodo-assessment'); ?></p>
            </div>
        </div>
        <div class="container feature-grid">
            <?php foreach ($achievements as $achievement) : ?>
                <article class="feature-card">
                    <h3><?php echo esc_html($achievement[0]); ?></h3>
                    <p><?php echo esc_html($achievement[1]); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <div class="container split-heading">
            <div>
                <p class="eyebrow"><?php esc_html_e('Navigating the Estatein Experience', 'growmodo-assessment'); ?></p>
                <h2><?php esc_html_e('Navigating the Estatein Experience', 'growmodo-assessment'); ?></h2>
                <p><?php esc_html_e('At Estatein, we make the real estate journey clear, strategic, and supportive from first conversation to final decision.', 'growmodo-assessment'); ?></p>
            </div>
        </div>
        <div class="container experience-grid">
            <?php foreach ($steps as $step) : ?>
                <article class="experience-card">
                    <span><?php echo esc_html($step[0]); ?></span>
                    <h3><?php echo esc_html($step[1]); ?></h3>
                    <p><?php echo esc_html($step[2]); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <div class="container split-heading">
            <div>
                <p class="eyebrow"><?php esc_html_e('Meet the Estatein Team', 'growmodo-assessment'); ?></p>
                <h2><?php esc_html_e('Meet the Estatein Team', 'growmodo-assessment'); ?></h2>
                <p><?php esc_html_e('At Estatein, our success is driven by the dedication and expertise of our team.', 'growmodo-assessment'); ?></p>
            </div>
        </div>
        <div class="container team-grid">
            <?php foreach ($team as $member) : ?>
                <article class="team-card">
                    <img src="<?php echo esc_url(growmodo_assessment_asset('images/' . $member[2])); ?>" alt="<?php echo esc_attr($member[0]); ?>" loading="lazy">
                    <h3><?php echo esc_html($member[0]); ?></h3>
                    <p><?php echo esc_html($member[1]); ?></p>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>"><?php esc_html_e('Say Hello', 'growmodo-assessment'); ?></a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section">
        <div class="container split-heading">
            <div>
                <p class="eyebrow"><?php esc_html_e('Our Valued Clients', 'growmodo-assessment'); ?></p>
                <h2><?php esc_html_e('Our Valued Clients', 'growmodo-assessment'); ?></h2>
                <p><?php esc_html_e("At Estatein, we have had the privilege of working with a diverse range of clients across various industries. Here are some of the clients we've had the pleasure of serving.", 'growmodo-assessment'); ?></p>
            </div>
        </div>
        <div class="container client-grid">
            <?php foreach ($clients as $client) : ?>
                <article class="client-card">
                    <div class="client-card__header">
                        <div>
                            <span><?php echo esc_html($client['since']); ?></span>
                            <h3><?php echo esc_html($client['name']); ?></h3>
                        </div>
                        <?php growmodo_assessment_button(__('Visit Website', 'growmodo-assessment'), home_url('/contact/'), 'secondary'); ?>
                    </div>
                    <div class="client-card__meta">
                        <div>
                            <span><?php esc_html_e('Domain', 'growmodo-assessment'); ?></span>
                            <strong><?php echo esc_html($client['domain']); ?></strong>
                        </div>
                        <div>
                            <span><?php esc_html_e('Category', 'growmodo-assessment'); ?></span>
                            <strong><?php echo esc_html($client['category']); ?></strong>
                        </div>
                    </div>
                    <div class="client-card__quote">
                        <span><?php esc_html_e('What They Said', 'growmodo-assessment'); ?></span>
                        <p><?php echo esc_html($client['quote']); ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="container section-pager" aria-label="<?php esc_attr_e('Client carousel controls', 'growmodo-assessment'); ?>">
            <span><?php esc_html_e('01 of 10', 'growmodo-assessment'); ?></span>
            <div>
                <a href="<?php echo esc_url(home_url('/about-us/')); ?>" aria-label="<?php esc_attr_e('Previous clients', 'growmodo-assessment'); ?>">&#8592;</a>
                <a href="<?php echo esc_url(home_url('/about-us/')); ?>" aria-label="<?php esc_attr_e('Next clients', 'growmodo-assessment'); ?>">&#8594;</a>
            </div>
        </div>
    </section>
    <?php get_template_part('template-parts/sections/contact'); ?>
</main>
<?php
get_footer();
