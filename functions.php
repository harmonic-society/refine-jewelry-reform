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
        'show_in_rest' => true,  // Enable Block Editor
        'rest_base' => 'products',  // REST API endpoint
        'rest_controller_class' => 'WP_REST_Posts_Controller',  // REST controller
        'rewrite' => array(
            'slug' => 'case',
            'with_front' => false,
            'feeds' => true,
            'pages' => true
        ),
    );
    
    register_post_type('products', $args);
}
add_action('init', 'refine_jewelry_register_products_cpt', 0);

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
add_action('init', 'refine_jewelry_register_voice_cpt', 0);

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
        'supports' => array('title', 'editor'),
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
add_action('init', 'refine_jewelry_register_ml_slider_cpt', 0);

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
        'supports' => array('title', 'editor', 'custom-fields'),
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
add_action('init', 'refine_jewelry_register_trust_form_cpt', 0);

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

// Filter to handle missing images
function refine_jewelry_fix_image_urls($content) {
    // Replace broken image URLs with placeholder
    $content = preg_replace_callback(
        '/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i',
        function($matches) {
            $img_tag = $matches[0];
            $img_url = $matches[1];
            
            // Check if it's an old URL from the original site
            if (strpos($img_url, 'refine-jewelry-reform.com/wp-content/uploads') !== false) {
                // Extract filename
                $filename = basename($img_url);
                // Try to find attachment by filename
                global $wpdb;
                $attachment = $wpdb->get_var($wpdb->prepare(
                    "SELECT ID FROM $wpdb->posts WHERE guid LIKE %s AND post_type = 'attachment' LIMIT 1",
                    '%' . $filename
                ));
                
                if ($attachment) {
                    $new_url = wp_get_attachment_url($attachment);
                    if ($new_url) {
                        // Make URL protocol-relative
                        $new_url = str_replace(array('https://', 'http://'), '//', $new_url);
                        return str_replace($img_url, $new_url, $img_tag);
                    }
                }
                
                // If not found, use placeholder with protocol-relative URL
                $placeholder = '//via.placeholder.com/400x400/f0f0f0/999999?text=' . urlencode('画像準備中');
                return str_replace($img_url, $placeholder, $img_tag);
            }
            
            // Make all image URLs protocol-relative
            $img_tag = str_replace(array('https://', 'http://'), '//', $img_tag);
            return $img_tag;
        },
        $content
    );
    
    return $content;
}
add_filter('the_content', 'refine_jewelry_fix_image_urls');

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
            'with_front' => false
        );
    }
    
    if (isset($wp_post_types['voice'])) {
        $wp_post_types['voice']->has_archive = true;
        $wp_post_types['voice']->rewrite = array(
            'slug' => 'voice',
            'with_front' => false
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
            'update_callback' => null,
            'schema' => null,
        ));
    }
}
add_action('rest_api_init', 'refine_jewelry_rest_support');

// Force flush rules once on next load
if (get_option('refine_jewelry_flush_rules') !== '1.1') {
    add_action('init', function() {
        flush_rewrite_rules();
        update_option('refine_jewelry_flush_rules', '1.1');
    }, 999);
}
