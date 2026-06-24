<?php
/**
 * Theme bootstrap.
 *
 * @package GrowmodoAssessment
 */

if (!defined('ABSPATH')) {
    exit;
}

define('GROWMODO_ASSESSMENT_VERSION', '1.0.6');
define('GROWMODO_ASSESSMENT_DIR', get_template_directory());
define('GROWMODO_ASSESSMENT_URI', get_template_directory_uri());

require_once GROWMODO_ASSESSMENT_DIR . '/inc/template-tags.php';

function growmodo_assessment_setup(): void
{
    load_theme_textdomain('growmodo-assessment', GROWMODO_ASSESSMENT_DIR . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('custom-logo', array(
        'height'      => 56,
        'width'       => 180,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'growmodo-assessment'),
        'footer'  => __('Footer Menu', 'growmodo-assessment'),
    ));
}
add_action('after_setup_theme', 'growmodo_assessment_setup');

function growmodo_assessment_primary_menu_items(array $items, stdClass $args): array
{
    if (($args->theme_location ?? '') !== 'primary') {
        return $items;
    }

    $contact = get_page_by_path('contact');
    if (!$contact) {
        return $items;
    }

    return array_values(array_filter($items, static function ($item) use ($contact): bool {
        return (int) $item->object_id !== (int) $contact->ID;
    }));
}
add_filter('wp_nav_menu_objects', 'growmodo_assessment_primary_menu_items', 10, 2);

function growmodo_assessment_assets(): void
{
    wp_enqueue_style(
        'growmodo-assessment-fonts',
        'https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'growmodo-assessment-main',
        GROWMODO_ASSESSMENT_URI . '/assets/css/main.css',
        array('growmodo-assessment-fonts'),
        GROWMODO_ASSESSMENT_VERSION
    );

    wp_enqueue_script(
        'growmodo-assessment-main',
        GROWMODO_ASSESSMENT_URI . '/assets/js/main.js',
        array(),
        GROWMODO_ASSESSMENT_VERSION,
        true
    );
}
add_action('wp_enqueue_scripts', 'growmodo_assessment_assets');

function growmodo_assessment_register_post_types(): void
{
    register_post_type('service', array(
        'labels' => array(
            'name'          => __('Services', 'growmodo-assessment'),
            'singular_name' => __('Service', 'growmodo-assessment'),
        ),
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-admin-tools',
        'supports'     => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
        'has_archive'  => false,
        'rewrite'      => array('slug' => 'services'),
    ));

    register_post_type('property', array(
        'labels' => array(
            'name'          => __('Properties', 'growmodo-assessment'),
            'singular_name' => __('Property', 'growmodo-assessment'),
        ),
        'public'       => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-building',
        'supports'     => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'properties'),
    ));
}
add_action('init', 'growmodo_assessment_register_post_types');

function growmodo_assessment_property_archive_order(WP_Query $query): void
{
    if (is_admin() || !$query->is_main_query() || !$query->is_post_type_archive('property')) {
        return;
    }

    $query->set('orderby', 'date');
    $query->set('order', 'ASC');
}
add_action('pre_get_posts', 'growmodo_assessment_property_archive_order');

function growmodo_assessment_customize_register(WP_Customize_Manager $wp_customize): void
{
    $wp_customize->add_section('growmodo_assessment_home', array(
        'title'    => __('Homepage Content', 'growmodo-assessment'),
        'priority' => 30,
    ));

    $settings = array(
        'hero_eyebrow' => '',
        'hero_title'   => __('Discover Your Dream Property with Estatein', 'growmodo-assessment'),
        'hero_text'    => __('Your journey to finding the perfect property begins here. Explore our listings to find the home that matches your dreams.', 'growmodo-assessment'),
        'hero_cta'     => __('Browse Properties', 'growmodo-assessment'),
    );

    foreach ($settings as $setting => $default) {
        $wp_customize->add_setting($setting, array(
            'default'           => $default,
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control($setting, array(
            'section' => 'growmodo_assessment_home',
            'label'   => ucwords(str_replace('_', ' ', $setting)),
            'type'    => 'text',
        ));
    }
}
add_action('customize_register', 'growmodo_assessment_customize_register');

function growmodo_assessment_excerpt_length(): int
{
    return 24;
}
add_filter('excerpt_length', 'growmodo_assessment_excerpt_length');

function growmodo_assessment_handle_contact(): void
{
    if (!isset($_POST['growmodo_contact_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['growmodo_contact_nonce'])), 'growmodo_contact')) {
        wp_safe_redirect(home_url('/contact/?contact=invalid'));
        exit;
    }

    $name    = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
    $email   = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '';

    if (!$name || !$email || !$message) {
        wp_safe_redirect(home_url('/contact/?contact=missing'));
        exit;
    }

    $body = sprintf(
        "Name: %s\nEmail: %s\n\nMessage:\n%s",
        $name,
        $email,
        $message
    );

    wp_mail(get_option('admin_email'), __('New website inquiry', 'growmodo-assessment'), $body, array('Reply-To: ' . $email));
    wp_safe_redirect(home_url('/contact/?contact=sent'));
    exit;
}
add_action('admin_post_growmodo_contact', 'growmodo_assessment_handle_contact');
add_action('admin_post_nopriv_growmodo_contact', 'growmodo_assessment_handle_contact');
