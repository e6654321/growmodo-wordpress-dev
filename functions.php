<?php
/**
 * Theme bootstrap.
 *
 * @package GrowmodoAssessment
 */

if (!defined('ABSPATH')) {
    exit;
}

define('GROWMODO_ASSESSMENT_VERSION', '1.0.7');
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

    foreach (growmodo_assessment_property_query_args(array('posts_per_page' => get_option('posts_per_page'))) as $key => $value) {
        if ($key === 'post_type') {
            continue;
        }
        $query->set($key, $value);
    }
}
add_action('pre_get_posts', 'growmodo_assessment_property_archive_order');

function growmodo_assessment_create_seed_page(string $title, string $slug, string $template = '', string $content = ''): int
{
    $page = get_page_by_path($slug, OBJECT, 'page');

    if (!$page) {
        $page_id = wp_insert_post(array(
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_title'   => $title,
            'post_name'    => $slug,
            'post_content' => $content,
        ));
    } else {
        $page_id = (int) $page->ID;
    }

    if ($page_id && !is_wp_error($page_id) && $template) {
        update_post_meta($page_id, '_wp_page_template', $template);
    }

    return is_wp_error($page_id) ? 0 : (int) $page_id;
}

function growmodo_assessment_create_seed_post(string $post_type, array $data, array $meta = array()): int
{
    $existing = get_page_by_path($data['slug'], OBJECT, $post_type);

    if ($existing) {
        $post_id = (int) $existing->ID;
    } else {
        $post_id = wp_insert_post(array(
            'post_type'    => $post_type,
            'post_status'  => 'publish',
            'post_title'   => $data['title'],
            'post_name'    => $data['slug'],
            'post_excerpt' => $data['excerpt'] ?? '',
            'post_content' => $data['content'] ?? ($data['excerpt'] ?? ''),
            'menu_order'   => $data['menu_order'] ?? 0,
        ));
    }

    if (!$post_id || is_wp_error($post_id)) {
        return 0;
    }

    foreach ($meta as $key => $value) {
        update_post_meta((int) $post_id, $key, $value);
    }

    return (int) $post_id;
}

function growmodo_assessment_seed_menu(string $menu_name, array $page_ids, string $location): void
{
    $menu = wp_get_nav_menu_object($menu_name);

    if (!$menu) {
        $menu_id = wp_create_nav_menu($menu_name);
    } else {
        $menu_id = (int) $menu->term_id;
    }

    if (!$menu_id || is_wp_error($menu_id)) {
        return;
    }

    $existing_items = wp_get_nav_menu_items($menu_id);
    $existing_pages = array();

    if ($existing_items) {
        foreach ($existing_items as $item) {
            $existing_pages[] = (int) $item->object_id;
        }
    }

    foreach ($page_ids as $page_id) {
        if (!$page_id || in_array((int) $page_id, $existing_pages, true)) {
            continue;
        }

        wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-object-id' => (int) $page_id,
            'menu-item-object'    => 'page',
            'menu-item-type'      => 'post_type',
            'menu-item-status'    => 'publish',
        ));
    }

    $locations              = get_theme_mod('nav_menu_locations', array());
    $locations[$location]   = (int) $menu_id;
    set_theme_mod('nav_menu_locations', $locations);
}

function growmodo_assessment_seed_content(): void
{
    growmodo_assessment_register_post_types();

    $home_id = growmodo_assessment_create_seed_page(
        __('Home', 'growmodo-assessment'),
        'home',
        '',
        __('Estatein homepage powered by the custom Growmodo assessment theme.', 'growmodo-assessment')
    );
    $about_id = growmodo_assessment_create_seed_page(__('About Us', 'growmodo-assessment'), 'about-us', 'page-templates/about-us.php');
    $properties_id = growmodo_assessment_create_seed_page(__('Properties', 'growmodo-assessment'), 'properties', 'page-templates/properties.php');
    $services_id = growmodo_assessment_create_seed_page(__('Services', 'growmodo-assessment'), 'services', 'page-templates/services.php');
    $contact_id = growmodo_assessment_create_seed_page(__('Contact', 'growmodo-assessment'), 'contact', 'page-templates/contact.php');

    if ($home_id) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_id);
    }

    $menu_page_ids = array($home_id, $about_id, $properties_id, $services_id, $contact_id);
    growmodo_assessment_seed_menu(__('Primary Menu', 'growmodo-assessment'), $menu_page_ids, 'primary');
    growmodo_assessment_seed_menu(__('Footer Menu', 'growmodo-assessment'), $menu_page_ids, 'footer');

    $properties = array(
        array(
            'title'      => __('Seaside Serenity Villa', 'growmodo-assessment'),
            'slug'       => 'seaside-serenity-villa',
            'excerpt'    => __('A stunning villa in a peaceful coastal neighborhood with premium amenities.', 'growmodo-assessment'),
            'menu_order' => 1,
            'meta'       => array(
                'price'         => '$1,250,000',
                'bedrooms'      => '4-Bedroom',
                'bathrooms'     => '3-Bathroom',
                'property_type' => __('Villa', 'growmodo-assessment'),
            ),
        ),
        array(
            'title'      => __('Metropolitan Haven', 'growmodo-assessment'),
            'slug'       => 'metropolitan-haven',
            'excerpt'    => __('A chic apartment with panoramic city views and refined finishes.', 'growmodo-assessment'),
            'menu_order' => 2,
            'meta'       => array(
                'price'         => '$650,000',
                'bedrooms'      => '2-Bedroom',
                'bathrooms'     => '2-Bathroom',
                'property_type' => __('Apartment', 'growmodo-assessment'),
            ),
        ),
        array(
            'title'      => __('Rustic Retreat Cottage', 'growmodo-assessment'),
            'slug'       => 'rustic-retreat-cottage',
            'excerpt'    => __('A warm countryside cottage designed for comfort, privacy, and weekend escapes.', 'growmodo-assessment'),
            'menu_order' => 3,
            'meta'       => array(
                'price'         => '$350,000',
                'bedrooms'      => '3-Bedroom',
                'bathrooms'     => '2-Bathroom',
                'property_type' => __('Cottage', 'growmodo-assessment'),
            ),
        ),
    );

    foreach ($properties as $property) {
        $meta = $property['meta'];
        unset($property['meta']);
        growmodo_assessment_create_seed_post('property', $property, $meta);
    }

    $services = array(
        array(
            'title'      => __('Find Your Dream Home', 'growmodo-assessment'),
            'slug'       => 'find-your-dream-home',
            'excerpt'    => __('Personalized search support and curated property shortlists.', 'growmodo-assessment'),
            'menu_order' => 1,
        ),
        array(
            'title'      => __('Unlock Property Value', 'growmodo-assessment'),
            'slug'       => 'unlock-property-value',
            'excerpt'    => __('Strategic selling support for pricing, positioning, and presentation.', 'growmodo-assessment'),
            'menu_order' => 2,
        ),
        array(
            'title'      => __('Smart Investment Guidance', 'growmodo-assessment'),
            'slug'       => 'smart-investment-guidance',
            'excerpt'    => __('Market-aware recommendations for confident property decisions.', 'growmodo-assessment'),
            'menu_order' => 3,
        ),
    );

    foreach ($services as $service) {
        growmodo_assessment_create_seed_post('service', $service);
    }

    update_option('permalink_structure', '/%postname%/');
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'growmodo_assessment_seed_content');

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
    $fallback_redirect = home_url('/contact/');
    $redirect_to       = isset($_POST['redirect_to']) ? esc_url_raw(wp_unslash($_POST['redirect_to'])) : $fallback_redirect;
    $redirect_to       = wp_validate_redirect($redirect_to, $fallback_redirect);

    if (!isset($_POST['growmodo_contact_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['growmodo_contact_nonce'])), 'growmodo_contact')) {
        wp_safe_redirect(add_query_arg('contact', 'invalid', $redirect_to));
        exit;
    }

    $name    = isset($_POST['name']) ? sanitize_text_field(wp_unslash($_POST['name'])) : '';
    $email   = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field(wp_unslash($_POST['message'])) : '';

    if (!$name || !$email || !$message) {
        wp_safe_redirect(add_query_arg('contact', 'missing', $redirect_to));
        exit;
    }

    $body = sprintf(
        "Name: %s\nEmail: %s\n\nMessage:\n%s",
        $name,
        $email,
        $message
    );

    wp_mail(get_option('admin_email'), __('New website inquiry', 'growmodo-assessment'), $body, array('Reply-To: ' . $email));
    wp_safe_redirect(add_query_arg('contact', 'sent', $redirect_to));
    exit;
}
add_action('admin_post_growmodo_contact', 'growmodo_assessment_handle_contact');
add_action('admin_post_nopriv_growmodo_contact', 'growmodo_assessment_handle_contact');
