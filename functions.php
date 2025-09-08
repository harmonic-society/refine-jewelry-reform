<?php
/**
 * Refine Jewelry Reform Theme Functions
 * @package RefineJewelryReform
 */

// Theme Setup
function refine_jewelry_setup() {
    // Theme Support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 400,
        'flex-height' => true,
        'flex-width' => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Register Menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'refine-jewelry-reform'),
        'footer' => __('Footer Menu', 'refine-jewelry-reform'),
    ));

    // Image Sizes
    add_image_size('product-thumbnail', 400, 400, true);
    add_image_size('product-large', 800, 800, true);
}
add_action('after_setup_theme', 'refine_jewelry_setup');

// Enqueue Scripts and Styles
function refine_jewelry_scripts() {
    wp_enqueue_style('refine-jewelry-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap', array(), null);
}
add_action('wp_enqueue_scripts', 'refine_jewelry_scripts');

// Register Custom Post Type: Products
function refine_jewelry_register_products_cpt() {
    $labels = array(
        'name' => _x('商品', 'Post Type General Name', 'refine-jewelry-reform'),
        'singular_name' => _x('商品', 'Post Type Singular Name', 'refine-jewelry-reform'),
        'menu_name' => __('商品管理', 'refine-jewelry-reform'),
        'all_items' => __('すべての商品', 'refine-jewelry-reform'),
        'add_new_item' => __('新規商品を追加', 'refine-jewelry-reform'),
        'add_new' => __('新規追加', 'refine-jewelry-reform'),
        'edit_item' => __('商品を編集', 'refine-jewelry-reform'),
    );
    
    $args = array(
        'label' => __('商品', 'refine-jewelry-reform'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-cart',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'products'),
    );
    
    register_post_type('products', $args);
}
add_action('init', 'refine_jewelry_register_products_cpt', 0);

// Register Custom Post Type: Voice (Customer Testimonials)
function refine_jewelry_register_voice_cpt() {
    $labels = array(
        'name' => _x('お客様の声', 'Post Type General Name', 'refine-jewelry-reform'),
        'singular_name' => _x('お客様の声', 'Post Type Singular Name', 'refine-jewelry-reform'),
        'menu_name' => __('お客様の声', 'refine-jewelry-reform'),
        'all_items' => __('すべての声', 'refine-jewelry-reform'),
        'add_new_item' => __('新規追加', 'refine-jewelry-reform'),
    );
    
    $args = array(
        'label' => __('お客様の声', 'refine-jewelry-reform'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-testimonial',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'voice'),
    );
    
    register_post_type('voice', $args);
}
add_action('init', 'refine_jewelry_register_voice_cpt', 0);

// Register Custom Taxonomies
function refine_jewelry_register_taxonomies() {
    // Before Categories (for reform examples)
    register_taxonomy('before', 'products', array(
        'labels' => array(
            'name' => 'リフォーム前カテゴリー',
            'singular_name' => 'リフォーム前カテゴリー',
            'menu_name' => 'リフォーム前',
            'all_items' => 'すべてのカテゴリー',
            'edit_item' => 'カテゴリーを編集',
            'add_new_item' => '新規カテゴリーを追加',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'rewrite' => array('slug' => 'before'),
    ));
}
add_action('init', 'refine_jewelry_register_taxonomies');

// Widget Areas
function refine_jewelry_widgets_init() {
    register_sidebar(array(
        'name' => __('サイドバー', 'refine-jewelry-reform'),
        'id' => 'sidebar-1',
        'description' => __('サイドバーウィジェットエリア', 'refine-jewelry-reform'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    
    register_sidebar(array(
        'name' => __('フッター1', 'refine-jewelry-reform'),
        'id' => 'footer-1',
        'description' => __('フッターウィジェットエリア', 'refine-jewelry-reform'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'refine_jewelry_widgets_init');

// Import XML Data Function
function refine_jewelry_import_xml_data() {
    // This function will be called to import the XML data
    $xml_file = get_template_directory() . '/WordPress.2025-09-07.xml';
    
    if (file_exists($xml_file)) {
        // XML import logic will be implemented here
        return true;
    }
    return false;
}