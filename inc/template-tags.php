<?php
/**
 * Template helpers.
 *
 * @package GrowmodoAssessment
 */

if (!defined('ABSPATH')) {
    exit;
}

function growmodo_assessment_field(string $key, $fallback = '')
{
    if (function_exists('get_field')) {
        $value = get_field($key);
        if ($value !== null && $value !== '') {
            return $value;
        }
    }

    $meta = get_post_meta(get_the_ID(), $key, true);
    if ($meta !== '') {
        return $meta;
    }

    return $fallback;
}

function growmodo_assessment_button(string $label, string $url, string $variant = 'primary'): void
{
    if (!$label || !$url) {
        return;
    }

    printf(
        '<a class="button button--%1$s" href="%2$s">%3$s</a>',
        esc_attr($variant),
        esc_url($url),
        esc_html($label)
    );
}

function growmodo_assessment_selected(string $current, string $value): string
{
    return selected($current, $value, false);
}

function growmodo_assessment_property_filter_value(string $key): string
{
    return isset($_GET[$key]) ? sanitize_text_field(wp_unslash($_GET[$key])) : '';
}

function growmodo_assessment_property_query_args(array $overrides = array()): array
{
    $args = array_merge(array(
        'post_type'      => 'property',
        'posts_per_page' => 9,
        'orderby'        => 'date',
        'order'          => 'ASC',
    ), $overrides);

    $search = growmodo_assessment_property_filter_value('property_search');
    if (!$search) {
        $search = growmodo_assessment_property_filter_value('s');
    }

    $location = growmodo_assessment_property_filter_value('location');
    if ($location) {
        $location_terms = array(
            'coastal'     => 'coastal',
            'metropolis'  => 'metropolitan',
            'countryside' => 'countryside',
        );
        $search = trim($search . ' ' . ($location_terms[$location] ?? $location));
    }

    if ($search) {
        $args['s'] = $search;
    }

    $meta_query = array();

    $property_type = growmodo_assessment_property_filter_value('property_type');
    if ($property_type) {
        $meta_query[] = array(
            'key'     => 'property_type',
            'value'   => $property_type,
            'compare' => 'LIKE',
        );
    }

    $bedrooms = growmodo_assessment_property_filter_value('bedrooms');
    if ($bedrooms) {
        $meta_query[] = array(
            'key'     => 'bedrooms',
            'value'   => $bedrooms,
            'compare' => 'LIKE',
        );
    }

    $price_range = growmodo_assessment_property_filter_value('price_range');
    if ($price_range) {
        $price_tokens = array(
            'under-500k' => '$350',
            '500k-1m'    => '$650',
            'over-1m'    => '$1,250',
        );

        if (isset($price_tokens[$price_range])) {
            $meta_query[] = array(
                'key'     => 'price',
                'value'   => $price_tokens[$price_range],
                'compare' => 'LIKE',
            );
        }
    }

    if ($meta_query) {
        $args['meta_query'] = $meta_query;
    }

    return $args;
}

function growmodo_assessment_property_filters_markup(): void
{
    $location      = growmodo_assessment_property_filter_value('location');
    $property_type = growmodo_assessment_property_filter_value('property_type');
    $price_range   = growmodo_assessment_property_filter_value('price_range');
    $bedrooms      = growmodo_assessment_property_filter_value('bedrooms');
    ?>
    <div class="property-search__filters" aria-label="<?php esc_attr_e('Property filters', 'growmodo-assessment'); ?>">
        <label class="filter-location">
            <span class="screen-reader-text"><?php esc_html_e('Location', 'growmodo-assessment'); ?></span>
            <select name="location" aria-label="<?php esc_attr_e('Location', 'growmodo-assessment'); ?>">
                <option value=""><?php esc_html_e('Location', 'growmodo-assessment'); ?></option>
                <option value="coastal" <?php echo growmodo_assessment_selected($location, 'coastal'); ?>><?php esc_html_e('Coastal Area', 'growmodo-assessment'); ?></option>
                <option value="metropolis" <?php echo growmodo_assessment_selected($location, 'metropolis'); ?>><?php esc_html_e('Metropolis', 'growmodo-assessment'); ?></option>
                <option value="countryside" <?php echo growmodo_assessment_selected($location, 'countryside'); ?>><?php esc_html_e('Countryside', 'growmodo-assessment'); ?></option>
            </select>
        </label>
        <label class="filter-type">
            <span class="screen-reader-text"><?php esc_html_e('Property Type', 'growmodo-assessment'); ?></span>
            <select name="property_type" aria-label="<?php esc_attr_e('Property Type', 'growmodo-assessment'); ?>">
                <option value=""><?php esc_html_e('Property Type', 'growmodo-assessment'); ?></option>
                <option value="Villa" <?php echo growmodo_assessment_selected($property_type, 'Villa'); ?>><?php esc_html_e('Villa', 'growmodo-assessment'); ?></option>
                <option value="Apartment" <?php echo growmodo_assessment_selected($property_type, 'Apartment'); ?>><?php esc_html_e('Apartment', 'growmodo-assessment'); ?></option>
                <option value="Cottage" <?php echo growmodo_assessment_selected($property_type, 'Cottage'); ?>><?php esc_html_e('Cottage', 'growmodo-assessment'); ?></option>
            </select>
        </label>
        <label class="filter-price">
            <span class="screen-reader-text"><?php esc_html_e('Pricing Range', 'growmodo-assessment'); ?></span>
            <select name="price_range" aria-label="<?php esc_attr_e('Pricing Range', 'growmodo-assessment'); ?>">
                <option value=""><?php esc_html_e('Pricing Range', 'growmodo-assessment'); ?></option>
                <option value="under-500k" <?php echo growmodo_assessment_selected($price_range, 'under-500k'); ?>><?php esc_html_e('Under $500k', 'growmodo-assessment'); ?></option>
                <option value="500k-1m" <?php echo growmodo_assessment_selected($price_range, '500k-1m'); ?>><?php esc_html_e('$500k - $1m', 'growmodo-assessment'); ?></option>
                <option value="over-1m" <?php echo growmodo_assessment_selected($price_range, 'over-1m'); ?>><?php esc_html_e('$1m+', 'growmodo-assessment'); ?></option>
            </select>
        </label>
        <label class="filter-size">
            <span class="screen-reader-text"><?php esc_html_e('Bedrooms', 'growmodo-assessment'); ?></span>
            <select name="bedrooms" aria-label="<?php esc_attr_e('Bedrooms', 'growmodo-assessment'); ?>">
                <option value=""><?php esc_html_e('Property Size', 'growmodo-assessment'); ?></option>
                <option value="2" <?php echo growmodo_assessment_selected($bedrooms, '2'); ?>><?php esc_html_e('2 Bedrooms', 'growmodo-assessment'); ?></option>
                <option value="3" <?php echo growmodo_assessment_selected($bedrooms, '3'); ?>><?php esc_html_e('3 Bedrooms', 'growmodo-assessment'); ?></option>
                <option value="4" <?php echo growmodo_assessment_selected($bedrooms, '4'); ?>><?php esc_html_e('4 Bedrooms', 'growmodo-assessment'); ?></option>
            </select>
        </label>
        <label class="filter-year">
            <span class="screen-reader-text"><?php esc_html_e('Apply property filters', 'growmodo-assessment'); ?></span>
            <button class="button button--secondary" type="submit"><?php esc_html_e('Apply Filters', 'growmodo-assessment'); ?></button>
        </label>
    </div>
    <?php
}

function growmodo_assessment_property_preview_data(int $post_id): array
{
    $slug = get_post_field('post_name', $post_id);
    $data = array(
        'seaside-serenity-villa' => array(
            'kicker'  => __('Coastal Escapes - Where Waves Beckon', 'growmodo-assessment'),
            'excerpt' => __('Wake up to the soothing melody of waves. This beachfront villa offers panoramic ocean views.', 'growmodo-assessment'),
        ),
        'metropolitan-haven' => array(
            'kicker'  => __('Urban Oasis - Life in the Heart of the City', 'growmodo-assessment'),
            'excerpt' => __('Immerse yourself in the energy of the city. This modern apartment places you close to everything.', 'growmodo-assessment'),
        ),
        'rustic-retreat-cottage' => array(
            'kicker'  => __('Countryside Charm - Escape to Nature\'s Embrace', 'growmodo-assessment'),
            'excerpt' => __('Find tranquility in the countryside. This charming cottage is nestled among rolling hills and trees.', 'growmodo-assessment'),
        ),
    );

    return $data[$slug] ?? array(
        'kicker'  => __('Estatein Featured Property', 'growmodo-assessment'),
        'excerpt' => get_the_excerpt($post_id),
    );
}

function growmodo_assessment_property_kicker(int $post_id): string
{
    $data = growmodo_assessment_property_preview_data($post_id);
    return $data['kicker'];
}

function growmodo_assessment_property_excerpt(int $post_id): string
{
    $data = growmodo_assessment_property_preview_data($post_id);
    return $data['excerpt'];
}

function growmodo_assessment_card_image(int $post_id, string $class = 'card__media'): void
{
    if (has_post_thumbnail($post_id)) {
        echo '<div class="' . esc_attr($class) . '">';
        echo get_the_post_thumbnail($post_id, 'large', array('loading' => 'lazy'));
        echo '</div>';
        return;
    }

    $fallbacks = array(
        'seaside-serenity-villa' => array('estatein-card-seaside.png', __('Seaside Serenity Villa exterior', 'growmodo-assessment')),
        'metropolitan-haven'     => array('estatein-card-metropolitan.png', __('Metropolitan Haven exterior', 'growmodo-assessment')),
        'rustic-retreat-cottage' => array('estatein-card-rustic.png', __('Rustic Retreat Cottage city exterior', 'growmodo-assessment')),
    );
    $slug      = get_post_field('post_name', $post_id);

    if (isset($fallbacks[$slug])) {
        echo '<div class="' . esc_attr($class) . '">';
        printf(
            '<img src="%1$s" alt="%2$s" loading="lazy">',
            esc_url(growmodo_assessment_asset('images/' . $fallbacks[$slug][0])),
            esc_attr($fallbacks[$slug][1])
        );
        echo '</div>';
        return;
    }

    echo '<div class="' . esc_attr($class) . ' card__media--placeholder" aria-hidden="true"></div>';
}

function growmodo_assessment_fallback_menu(): void
{
    $items = array(
        home_url('/')           => __('Home', 'growmodo-assessment'),
        home_url('/about-us/')  => __('About Us', 'growmodo-assessment'),
        home_url('/properties/') => __('Properties', 'growmodo-assessment'),
        home_url('/services/')  => __('Services', 'growmodo-assessment'),
    );

    echo '<ul class="primary-nav__list">';
    foreach ($items as $url => $label) {
        printf('<li><a href="%1$s">%2$s</a></li>', esc_url($url), esc_html($label));
    }
    echo '</ul>';
}

function growmodo_assessment_asset(string $path): string
{
    return GROWMODO_ASSESSMENT_URI . '/assets/' . ltrim($path, '/');
}
