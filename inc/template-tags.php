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
