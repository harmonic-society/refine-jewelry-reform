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
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'author', 'revisions'),
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
        'show_in_rest' => true,  // Enable REST API (but we'll use Classic Editor)
        'rest_base' => 'products',  // REST API endpoint
        'rest_controller_class' => 'WP_REST_Posts_Controller',  // REST controller
        'taxonomies' => array('before', 'after', 'type', 'stone', 'show'),  // Explicitly declare taxonomies
        'rewrite' => array(
            'slug' => 'case',
            'with_front' => false,
            'feeds' => true,
            'pages' => true
        ),
    );
    
    register_post_type('products', $args);
}
add_action('init', 'refine_jewelry_register_products_cpt', 20);  // Register after taxonomies

// Flush rewrite rules on theme activation
function refine_jewelry_rewrite_flush() {
    refine_jewelry_register_products_cpt();
    refine_jewelry_register_taxonomies();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'refine_jewelry_rewrite_flush');

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
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'author', 'revisions'),
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
        'show_in_rest' => true,  // Enable Block Editor
        'rest_base' => 'voice',  // REST API endpoint
        'rest_controller_class' => 'WP_REST_Posts_Controller',  // REST controller
        'rewrite' => array(
            'slug' => 'voice',
            'with_front' => false,
            'feeds' => true,
            'pages' => true
        ),
    );
    
    register_post_type('voice', $args);
}
add_action('init', 'refine_jewelry_register_voice_cpt', 20);

// Register Custom Post Type: ML Slider
function refine_jewelry_register_ml_slider_cpt() {
    $labels = array(
        'name' => _x('スライダー', 'Post Type General Name', 'refine-jewelry-reform'),
        'singular_name' => _x('スライダー', 'Post Type Singular Name', 'refine-jewelry-reform'),
        'menu_name' => __('スライダー', 'refine-jewelry-reform'),
    );
    
    $args = array(
        'label' => __('スライダー', 'refine-jewelry-reform'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'author', 'revisions'),
        'hierarchical' => false,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-images-alt2',
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => false,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'capability_type' => 'post',
        'show_in_rest' => true,  // Enable Block Editor
        'rest_base' => 'ml_slider',  // REST API endpoint (use underscore instead of hyphen)
        'rest_controller_class' => 'WP_REST_Posts_Controller',  // REST controller
    );
    
    register_post_type('ml-slider', $args);
}
add_action('init', 'refine_jewelry_register_ml_slider_cpt', 20);

// Register Custom Post Type: Trust Form (Contact Form Submissions)
function refine_jewelry_register_trust_form_cpt() {
    $labels = array(
        'name' => _x('お問い合わせ履歴', 'Post Type General Name', 'refine-jewelry-reform'),
        'singular_name' => _x('お問い合わせ', 'Post Type Singular Name', 'refine-jewelry-reform'),
        'menu_name' => __('お問い合わせ履歴', 'refine-jewelry-reform'),
        'all_items' => __('すべてのお問い合わせ', 'refine-jewelry-reform'),
        'add_new_item' => __('新規お問い合わせを追加', 'refine-jewelry-reform'),
        'add_new' => __('新規追加', 'refine-jewelry-reform'),
        'edit_item' => __('お問い合わせを編集', 'refine-jewelry-reform'),
        'view_item' => __('お問い合わせを表示', 'refine-jewelry-reform'),
        'search_items' => __('お問い合わせを検索', 'refine-jewelry-reform'),
        'not_found' => __('お問い合わせが見つかりません', 'refine-jewelry-reform'),
    );
    
    $args = array(
        'label' => __('お問い合わせ履歴', 'refine-jewelry-reform'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'custom-fields', 'author', 'revisions'),
        'hierarchical' => false,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 7,
        'menu_icon' => 'dashicons-email-alt',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => false,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'capability_type' => 'post',
        'show_in_rest' => true,  // Enable Block Editor
        'rest_base' => 'trust_form',  // REST API endpoint (use underscore instead of hyphen)
        'rest_controller_class' => 'WP_REST_Posts_Controller',  // REST controller
        'rewrite' => array(
            'slug' => 'trust-form',
            'with_front' => false,
            'feeds' => false,
            'pages' => false
        ),
    );
    
    register_post_type('trust-form', $args);
}
add_action('init', 'refine_jewelry_register_trust_form_cpt', 20);

// Register Custom Taxonomies
function refine_jewelry_register_taxonomies() {
    // Before Categories (リフォーム前)
    register_taxonomy('before', 'products', array(
        'labels' => array(
            'name' => 'リフォーム前',
            'singular_name' => 'リフォーム前',
            'menu_name' => 'リフォーム前',
            'all_items' => 'すべてのリフォーム前',
            'edit_item' => '編集',
            'add_new_item' => '新規追加',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,  // Enable REST API for Block Editor
        'rewrite' => array(
            'slug' => 'before',
            'with_front' => false,
            'feeds' => true
        ),
    ));
    
    // After Categories (リフォーム後)
    register_taxonomy('after', 'products', array(
        'labels' => array(
            'name' => 'リフォーム後',
            'singular_name' => 'リフォーム後',
            'menu_name' => 'リフォーム後',
            'all_items' => 'すべてのリフォーム後',
            'edit_item' => '編集',
            'add_new_item' => '新規追加',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,  // Enable REST API for Block Editor
        'rewrite' => array(
            'slug' => 'after',
            'with_front' => false,
            'feeds' => true
        ),
    ));
    
    // Type Categories (作業タイプ)
    register_taxonomy('type', 'products', array(
        'labels' => array(
            'name' => '作業タイプ',
            'singular_name' => '作業タイプ',
            'menu_name' => '作業タイプ',
            'all_items' => 'すべての作業タイプ',
            'edit_item' => '編集',
            'add_new_item' => '新規追加',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,  // Enable REST API for Block Editor
        'rewrite' => array(
            'slug' => 'type',
            'with_front' => false,
            'feeds' => true
        ),
    ));
    
    // Stone Categories (石の種類)
    register_taxonomy('stone', 'products', array(
        'labels' => array(
            'name' => '石の種類',
            'singular_name' => '石の種類',
            'menu_name' => '石の種類',
            'all_items' => 'すべての石',
            'edit_item' => '編集',
            'add_new_item' => '新規追加',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,  // Enable REST API for Block Editor
        'rewrite' => array(
            'slug' => 'stone',
            'with_front' => false,
            'feeds' => true
        ),
    ));
    
    // Show Categories (表示設定)
    register_taxonomy('show', 'products', array(
        'labels' => array(
            'name' => '表示設定',
            'singular_name' => '表示設定',
            'menu_name' => '表示設定',
            'all_items' => 'すべての表示設定',
            'edit_item' => '編集',
            'add_new_item' => '新規追加',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,  // Enable REST API for Block Editor
        'rewrite' => array(
            'slug' => 'show',
            'with_front' => false,
            'feeds' => true
        ),
    ));
    
    // ML Slider taxonomy
    register_taxonomy('ml-slider', 'attachment', array(
        'labels' => array(
            'name' => 'スライダー',
            'singular_name' => 'スライダー',
            'menu_name' => 'スライダー',
        ),
        'hierarchical' => true,
        'public' => false,
        'show_ui' => false,
        'show_admin_column' => false,
        'show_in_nav_menus' => false,
        'rewrite' => false,
    ));
}
add_action('init', 'refine_jewelry_register_taxonomies', 10);  // Register taxonomies before post types

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

// Custom function to get product image with fallback
function refine_jewelry_get_product_image($post_id = null, $size = 'medium') {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    // Helper function to use protocol-relative URLs
    $make_protocol_relative = function($html) {
        // Remove both http: and https: to make URLs protocol-relative
        $html = str_replace(array('https://', 'http://'), '//', $html);
        return $html;
    };
    
    // Try to get featured image
    if (has_post_thumbnail($post_id)) {
        $img = get_the_post_thumbnail($post_id, $size, array('class' => 'product-image'));
        return $make_protocol_relative($img);
    }
    
    // Try to get before/after images from meta
    $before_image_id = get_post_meta($post_id, '_before_image', true);
    $after_image_id = get_post_meta($post_id, '_after_image', true);
    
    if ($after_image_id && wp_attachment_is_image($after_image_id)) {
        $img = wp_get_attachment_image($after_image_id, $size, false, array('class' => 'product-image'));
        return $make_protocol_relative($img);
    }
    
    if ($before_image_id && wp_attachment_is_image($before_image_id)) {
        $img = wp_get_attachment_image($before_image_id, $size, false, array('class' => 'product-image'));
        return $make_protocol_relative($img);
    }
    
    // Return placeholder image with protocol-relative URL
    $placeholder_url = '//via.placeholder.com/400x400/f0f0f0/999999?text=' . urlencode('ジュエリー画像');
    return '<img src="' . $placeholder_url . '" alt="' . get_the_title($post_id) . '" class="product-image placeholder" />';
}

// Filter to handle missing images and fix old URLs
function refine_jewelry_fix_image_urls($content) {
    // Handle both image tags and anchor tags
    $content = preg_replace_callback(
        '/<(img|a)([^>]+)(src|href)=["\']([^"\']+)["\']([^>]*)>/i',
        function($matches) {
            $tag = $matches[0];
            $tag_name = $matches[1];
            $attr_before = $matches[2];
            $attr_name = $matches[3];
            $url = $matches[4];
            $attr_after = $matches[5];
            
            // Check if URL is from refine-jewelry-reform.com
            if (strpos($url, 'refine-jewelry-reform.com') !== false) {
                // Check if it's an upload URL
                if (strpos($url, '/wp-content/uploads/') !== false) {
                    // Extract path after uploads/
                    preg_match('/\/wp-content\/uploads\/(.+)$/i', $url, $path_matches);
                    if (!empty($path_matches[1])) {
                        // Check if file exists
                        $upload_dir = wp_upload_dir();
                        $file_path = $upload_dir['basedir'] . '/' . $path_matches[1];
                        
                        if (file_exists($file_path)) {
                            // File exists, use current site URL
                            $new_url = $upload_dir['baseurl'] . '/' . $path_matches[1];
                            return "<{$tag_name}{$attr_before}{$attr_name}=\"{$new_url}\"{$attr_after}>";
                        } else {
                            // Try to find by filename in database
                            $filename = basename($url);
                            global $wpdb;
                            $attachment = $wpdb->get_var($wpdb->prepare(
                                "SELECT ID FROM $wpdb->posts WHERE guid LIKE %s AND post_type = 'attachment' LIMIT 1",
                                '%' . $filename
                            ));
                            
                            if ($attachment) {
                                $new_url = wp_get_attachment_url($attachment);
                                if ($new_url) {
                                    return "<{$tag_name}{$attr_before}{$attr_name}=\"{$new_url}\"{$attr_after}>";
                                }
                            }
                            
                            // For images, use placeholder
                            if ($tag_name === 'img') {
                                $placeholder = '//via.placeholder.com/400x400/f0f0f0/999999?text=' . urlencode('画像準備中');
                                return "<img{$attr_before}src=\"{$placeholder}\"{$attr_after}>";
                            }
                        }
                    }
                }
            }
            
            return $tag;
        },
        $content
    );
    
    return $content;
}
add_filter('the_content', 'refine_jewelry_fix_image_urls', 5);  // Run early with priority 5

// Fix image placeholders in content
function refine_jewelry_fix_image_placeholders($content) {
    // Pattern to match [Image #X] placeholders
    $pattern = '/\[Image #(\d+)\]/i';
    
    // Replace with actual images from media library
    $content = preg_replace_callback($pattern, function($matches) {
        global $post;
        
        // Try to get the first attached image
        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'posts_per_page' => -1,
            'post_parent' => $post->ID,
            'post_mime_type' => 'image',
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ));
        
        $image_index = intval($matches[1]) - 1;
        
        if (isset($attachments[$image_index])) {
            // Get the image HTML
            $image_html = wp_get_attachment_image($attachments[$image_index]->ID, 'large', false, array(
                'class' => 'content-image',
                'alt' => get_the_title($attachments[$image_index]->ID)
            ));
            return $image_html;
        }
        
        // If no attachment found, try to get featured image
        if ($image_index === 0 && has_post_thumbnail($post->ID)) {
            return get_the_post_thumbnail($post->ID, 'large', array('class' => 'content-image'));
        }
        
        // Return placeholder if no image found
        return '<img src="//via.placeholder.com/600x400/f0f0f0/999999?text=' . urlencode('画像 #' . $matches[1]) . '" alt="Image ' . $matches[1] . '" class="content-image placeholder" />';
    }, $content);
    
    // Also handle [img] shortcode if present
    $content = preg_replace_callback('/\[img\s*(?:id=["\']?(\d+)["\']?)?\s*\]/i', function($matches) {
        if (isset($matches[1])) {
            $attachment_id = intval($matches[1]);
            if (wp_attachment_is_image($attachment_id)) {
                return wp_get_attachment_image($attachment_id, 'large', false, array('class' => 'content-image'));
            }
        }
        return '';
    }, $content);
    
    return $content;
}
add_filter('the_content', 'refine_jewelry_fix_image_placeholders', 9);
add_filter('the_excerpt', 'refine_jewelry_fix_image_placeholders', 9);

// Add support for external images as featured images
function refine_jewelry_external_featured_image($html, $post_id, $post_thumbnail_id, $size, $attr) {
    if (empty($html)) {
        // Try to get the first image from content
        $post = get_post($post_id);
        if ($post && $post->post_content) {
            preg_match('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $post->post_content, $matches);
            if (!empty($matches[1])) {
                $classes = 'attachment-' . $size . ' size-' . $size . ' wp-post-image';
                if (!empty($attr['class'])) {
                    $classes .= ' ' . $attr['class'];
                }
                $html = '<img src="' . esc_url($matches[1]) . '" class="' . esc_attr($classes) . '" alt="' . esc_attr(get_the_title($post_id)) . '" />';
            }
        }
    }
    return $html;
}
add_filter('post_thumbnail_html', 'refine_jewelry_external_featured_image', 10, 5);

// Adjust queries for custom post types
function refine_jewelry_adjust_queries($query) {
    if (!is_admin() && $query->is_main_query()) {
        // Products archive
        if (is_post_type_archive('products')) {
            $query->set('posts_per_page', 12);
            $query->set('orderby', 'date');
            $query->set('order', 'DESC');
        }
        
        // Voice archive
        if (is_post_type_archive('voice')) {
            $query->set('posts_per_page', 9);
            $query->set('orderby', 'date');
            $query->set('order', 'DESC');
        }
        
        // Taxonomy archives for products
        if (is_tax(array('before', 'after', 'type', 'stone', 'show'))) {
            $query->set('posts_per_page', 12);
            $query->set('orderby', 'date');
            $query->set('order', 'DESC');
        }
    }
}
add_action('pre_get_posts', 'refine_jewelry_adjust_queries');

// Add rewrite rules for better URLs
function refine_jewelry_rewrite_rules() {
    // Flush rewrite rules to ensure custom post types work
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'refine_jewelry_rewrite_rules');

// Ensure custom post types are properly registered with archives
function refine_jewelry_fix_post_type_archives() {
    // Re-register products post type with proper archive settings
    global $wp_post_types;
    
    if (isset($wp_post_types['products'])) {
        $wp_post_types['products']->has_archive = 'case';
        $wp_post_types['products']->rewrite = array(
            'slug' => 'products',
            'with_front' => false,
            'feeds' => true,
            'pages' => true
        );
    }
    
    if (isset($wp_post_types['voice'])) {
        $wp_post_types['voice']->has_archive = true;
        $wp_post_types['voice']->rewrite = array(
            'slug' => 'voice',
            'with_front' => false,
            'feeds' => true,
            'pages' => true
        );
    }
}
add_action('init', 'refine_jewelry_fix_post_type_archives', 20);

// Add custom columns to trust-form admin list
function refine_jewelry_trust_form_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = 'お名前・日時';
    $new_columns['customer_email'] = 'メールアドレス';
    $new_columns['customer_phone'] = '電話番号';
    $new_columns['status'] = 'ステータス';
    $new_columns['date'] = '受信日';
    return $new_columns;
}
add_filter('manage_trust-form_posts_columns', 'refine_jewelry_trust_form_columns');

// Populate custom columns for trust-form
function refine_jewelry_trust_form_column_content($column_name, $post_id) {
    switch($column_name) {
        case 'customer_email':
            $email = get_post_meta($post_id, 'customer_email', true);
            echo $email ? esc_html($email) : '—';
            break;
        case 'customer_phone':
            $phone = get_post_meta($post_id, 'customer_phone', true);
            echo $phone ? esc_html($phone) : '—';
            break;
        case 'status':
            $status = get_post_meta($post_id, 'status', true);
            $status_text = '新規';
            $status_class = 'new';
            
            if ($status === 'in_progress') {
                $status_text = '対応中';
                $status_class = 'in-progress';
            } elseif ($status === 'completed') {
                $status_text = '完了';
                $status_class = 'completed';
            }
            
            echo '<span class="status-' . $status_class . '" style="padding: 3px 8px; border-radius: 3px; background: ';
            echo $status_class === 'new' ? '#dc3545' : ($status_class === 'in-progress' ? '#007bff' : '#28a745');
            echo '; color: white; font-size: 11px;">' . $status_text . '</span>';
            break;
    }
}
add_action('manage_trust-form_posts_custom_column', 'refine_jewelry_trust_form_column_content', 10, 2);

// Make columns sortable
function refine_jewelry_trust_form_sortable_columns($columns) {
    $columns['customer_email'] = 'customer_email';
    $columns['status'] = 'status';
    return $columns;
}
add_filter('manage_edit-trust-form_sortable_columns', 'refine_jewelry_trust_form_sortable_columns');

// Add meta box for trust-form details
function refine_jewelry_add_trust_form_meta_boxes() {
    add_meta_box(
        'trust_form_details',
        'お問い合わせ詳細',
        'refine_jewelry_trust_form_meta_box_callback',
        'trust-form',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'refine_jewelry_add_trust_form_meta_boxes');

// Meta box callback
function refine_jewelry_trust_form_meta_box_callback($post) {
    wp_nonce_field('trust_form_meta_box', 'trust_form_meta_box_nonce');
    
    $name = get_post_meta($post->ID, 'customer_name', true);
    $email = get_post_meta($post->ID, 'customer_email', true);
    $phone = get_post_meta($post->ID, 'customer_phone', true);
    $message = get_post_meta($post->ID, 'customer_message', true);
    $status = get_post_meta($post->ID, 'status', true);
    $date = get_post_meta($post->ID, 'submission_date', true);
    ?>
    <style>
        .trust-form-field {
            margin-bottom: 15px;
        }
        .trust-form-field label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }
        .trust-form-field input[type="text"],
        .trust-form-field input[type="email"],
        .trust-form-field select,
        .trust-form-field textarea {
            width: calc(100% - 160px);
        }
        .trust-form-field textarea {
            vertical-align: top;
        }
    </style>
    
    <div class="trust-form-field">
        <label for="customer_name">お名前:</label>
        <input type="text" id="customer_name" name="customer_name" value="<?php echo esc_attr($name); ?>" />
    </div>
    
    <div class="trust-form-field">
        <label for="customer_email">メールアドレス:</label>
        <input type="email" id="customer_email" name="customer_email" value="<?php echo esc_attr($email); ?>" />
    </div>
    
    <div class="trust-form-field">
        <label for="customer_phone">電話番号:</label>
        <input type="text" id="customer_phone" name="customer_phone" value="<?php echo esc_attr($phone); ?>" />
    </div>
    
    <div class="trust-form-field">
        <label for="status">ステータス:</label>
        <select id="status" name="status">
            <option value="new" <?php selected($status, 'new'); ?>>新規</option>
            <option value="in_progress" <?php selected($status, 'in_progress'); ?>>対応中</option>
            <option value="completed" <?php selected($status, 'completed'); ?>>完了</option>
        </select>
    </div>
    
    <div class="trust-form-field">
        <label for="customer_message">メッセージ:</label>
        <textarea id="customer_message" name="customer_message" rows="8"><?php echo esc_textarea($message); ?></textarea>
    </div>
    
    <?php if ($date) : ?>
    <div class="trust-form-field">
        <label>受信日時:</label>
        <span><?php echo esc_html($date); ?></span>
    </div>
    <?php endif;
}

// Save meta box data
function refine_jewelry_save_trust_form_meta($post_id) {
    if (!isset($_POST['trust_form_meta_box_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['trust_form_meta_box_nonce'], 'trust_form_meta_box')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array('customer_name', 'customer_email', 'customer_phone', 'customer_message', 'status');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_trust-form', 'refine_jewelry_save_trust_form_meta');

// Flush rewrite rules on activation and when needed
function refine_jewelry_flush_rewrite_rules() {
    // Register post types and taxonomies first
    refine_jewelry_register_products_cpt();
    refine_jewelry_register_voice_cpt();
    refine_jewelry_register_ml_slider_cpt();
    refine_jewelry_register_trust_form_cpt();
    refine_jewelry_register_taxonomies();
    
    // Then flush rules
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'refine_jewelry_flush_rewrite_rules');

// Ensure REST API support for custom fields
function refine_jewelry_rest_support() {
    // Register custom fields for REST API
    $post_types = array('products', 'voice', 'ml-slider', 'trust-form');
    
    foreach ($post_types as $post_type) {
        register_rest_field($post_type, 'meta', array(
            'get_callback' => function($post) {
                return get_post_meta($post['id']);
            },
            'update_callback' => function($value, $post, $field_name) {
                foreach ($value as $key => $val) {
                    update_post_meta($post->ID, $key, $val);
                }
                return true;
            },
            'schema' => array(
                'type' => 'object',
                'context' => array('view', 'edit'),
            ),
        ));
        
        // Register taxonomies for REST API specifically for products
        if ($post_type === 'products') {
            $taxonomies = array('before', 'after', 'type', 'stone', 'show');
            foreach ($taxonomies as $tax) {
                register_rest_field($post_type, $tax, array(
                    'get_callback' => function($post) use ($tax) {
                        return wp_get_post_terms($post['id'], $tax, array('fields' => 'ids'));
                    },
                    'update_callback' => function($value, $post, $field_name) use ($tax) {
                        wp_set_post_terms($post->ID, $value, $tax);
                        return true;
                    },
                    'schema' => array(
                        'type' => 'array',
                        'items' => array('type' => 'integer'),
                        'context' => array('view', 'edit'),
                    ),
                ));
            }
        }
    }
}
add_action('rest_api_init', 'refine_jewelry_rest_support');

// Force flush rules once on next load
if (get_option('refine_jewelry_flush_rules') !== '1.4') {
    add_action('init', function() {
        flush_rewrite_rules();
        update_option('refine_jewelry_flush_rules', '1.4');
    }, 999);
}

// Force Classic Editor for products post type due to complex taxonomies
function refine_jewelry_use_classic_editor($use_block_editor, $post_type) {
    // Disable Block Editor for products post type
    if ($post_type === 'products') {
        return false;
    }
    return $use_block_editor;
}
add_filter('use_block_editor_for_post_type', 'refine_jewelry_use_classic_editor', 10, 2);

// Enable Classic Editor meta box for products
function refine_jewelry_classic_editor_settings() {
    // Remove Gutenberg from products
    if (isset($_GET['post'])) {
        $post_id = $_GET['post'];
        if (get_post_type($post_id) === 'products') {
            add_filter('gutenberg_can_edit_post_type', '__return_false', 10);
        }
    }
    
    // Ensure media buttons are available in Classic Editor
    add_filter('user_can_richedit', '__return_true');
    
    // Add media button support for custom post types
    add_post_type_support('products', 'editor');
    add_post_type_support('voice', 'editor');
    add_post_type_support('ml-slider', 'editor');
    add_post_type_support('trust-form', 'editor');
}
add_action('admin_init', 'refine_jewelry_classic_editor_settings');

// Enable WordPress media uploader for all editors
function refine_jewelry_enable_media_uploader() {
    if (is_admin()) {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'refine_jewelry_enable_media_uploader');

// Ensure products post type works with REST API (for future use)
function refine_jewelry_fix_products_rest() {
    global $wp_post_types;
    
    if (isset($wp_post_types['products'])) {
        // Keep REST API enabled for potential future use
        $wp_post_types['products']->show_in_rest = true;
        $wp_post_types['products']->rest_base = 'products';
        $wp_post_types['products']->rest_controller_class = 'WP_REST_Posts_Controller';
        
        // Make sure taxonomies are available
        $taxonomies = array('before', 'after', 'type', 'stone', 'show');
        foreach ($taxonomies as $tax) {
            register_taxonomy_for_object_type($tax, 'products');
        }
    }
}
add_action('init', 'refine_jewelry_fix_products_rest', 30);

// Register custom meta fields for products post type
function refine_jewelry_register_products_meta() {
    $meta_fields = array(
        '_before_image' => 'integer',
        '_after_image' => 'integer',
        '_product_price' => 'string',
        '_product_material' => 'string',
        '_product_description' => 'string',
    );
    
    foreach ($meta_fields as $meta_key => $type) {
        register_post_meta('products', $meta_key, array(
            'show_in_rest' => true,
            'single' => true,
            'type' => $type,
            'auth_callback' => function() {
                return current_user_can('edit_posts');
            }
        ));
    }
}
add_action('init', 'refine_jewelry_register_products_meta', 25);

// Contact Form 7 Support
function refine_jewelry_cf7_support() {
    // Check if Contact Form 7 is active
    if (!function_exists('wpcf7')) {
        return;
    }
    
    // Add custom validation for Japanese phone numbers
    add_filter('wpcf7_validate_tel', 'refine_jewelry_cf7_validate_phone', 10, 2);
    add_filter('wpcf7_validate_tel*', 'refine_jewelry_cf7_validate_phone', 10, 2);
}
add_action('init', 'refine_jewelry_cf7_support');

// Validate Japanese phone numbers
function refine_jewelry_cf7_validate_phone($result, $tag) {
    $name = $tag->name;
    $value = isset($_POST[$name]) ? trim($_POST[$name]) : '';
    
    if ($value) {
        // Remove spaces, hyphens, and parentheses
        $cleaned = preg_replace('/[\s\-\(\)]/', '', $value);
        
        // Check if it's a valid Japanese phone number
        if (!preg_match('/^(0[0-9]{9,10}|[\+]?81[0-9]{9,10})$/', $cleaned)) {
            $result->invalidate($tag, '有効な電話番号を入力してください。');
        }
    }
    
    return $result;
}

// Flamingo Support - Custom columns for Flamingo admin
function refine_jewelry_flamingo_columns($columns) {
    // Reorder columns for better display
    $new_columns = array();
    if (isset($columns['cb'])) $new_columns['cb'] = $columns['cb'];
    if (isset($columns['title'])) $new_columns['title'] = 'お名前';
    $new_columns['email'] = 'メールアドレス';
    $new_columns['subject'] = '件名';
    $new_columns['status'] = 'ステータス';
    if (isset($columns['date'])) $new_columns['date'] = $columns['date'];
    
    return $new_columns;
}
add_filter('manage_flamingo_inbound_posts_columns', 'refine_jewelry_flamingo_columns');

// Display custom column content for Flamingo
function refine_jewelry_flamingo_column_content($column, $post_id) {
    $post = get_post($post_id);
    $submission = get_post_meta($post_id, '_submission', true);
    
    switch ($column) {
        case 'email':
            if (isset($submission['your-email'])) {
                echo esc_html($submission['your-email']);
            }
            break;
        case 'subject':
            if (isset($submission['your-subject'])) {
                echo esc_html($submission['your-subject']);
            }
            break;
        case 'status':
            $status = get_post_meta($post_id, '_status', true);
            if (!$status) $status = 'new';
            
            $status_labels = array(
                'new' => '新規',
                'read' => '既読',
                'replied' => '返信済',
                'spam' => 'スパム'
            );
            
            $label = isset($status_labels[$status]) ? $status_labels[$status] : $status;
            echo '<span class="status-' . esc_attr($status) . '">' . esc_html($label) . '</span>';
            break;
    }
}
add_action('manage_flamingo_inbound_posts_custom_column', 'refine_jewelry_flamingo_column_content', 10, 2);

// Add admin styles for Flamingo
function refine_jewelry_flamingo_admin_styles() {
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'flamingo_inbound') {
        ?>
        <style>
            .status-new { 
                background: #dc3545; 
                color: white; 
                padding: 3px 8px; 
                border-radius: 3px; 
                font-size: 11px; 
            }
            .status-read { 
                background: #007bff; 
                color: white; 
                padding: 3px 8px; 
                border-radius: 3px; 
                font-size: 11px; 
            }
            .status-replied { 
                background: #28a745; 
                color: white; 
                padding: 3px 8px; 
                border-radius: 3px; 
                font-size: 11px; 
            }
            .status-spam { 
                background: #6c757d; 
                color: white; 
                padding: 3px 8px; 
                border-radius: 3px; 
                font-size: 11px; 
            }
        </style>
        <?php
    }
}
add_action('admin_head', 'refine_jewelry_flamingo_admin_styles');
