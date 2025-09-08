<?php
/**
 * WordPress XML Data Importer
 * This script imports data from the WordPress export XML file
 * 
 * Usage: Run this file after WordPress installation to import all data
 * @package RefineJewelryReform
 */

// Load WordPress
require_once('../../../wp-load.php');

// Check if user has admin privileges
if (!current_user_can('manage_options')) {
    die('Access denied. Admin privileges required.');
}

// Set max execution time
set_time_limit(600);

// XML file path
$xml_file = __DIR__ . '/WordPress.2025-09-07.xml';

if (!file_exists($xml_file)) {
    die('XML file not found: ' . $xml_file);
}

echo "<h1>WordPress XML Data Import</h1>";
echo "<p>Importing data from: " . basename($xml_file) . "</p>";

// Parse XML
$xml = simplexml_load_file($xml_file);

// Register namespaces
$namespaces = $xml->getNamespaces(true);

// Statistics
$stats = array(
    'pages' => 0,
    'products' => 0,
    'voices' => 0,
    'attachments' => 0,
    'categories' => 0,
    'errors' => array()
);

// Import categories first
echo "<h2>Importing Categories...</h2>";
foreach ($xml->channel->children($namespaces['wp'])->category as $cat) {
    $term_name = (string)$cat->cat_name;
    $term_slug = (string)$cat->category_nicename;
    
    if (!term_exists($term_name, 'category')) {
        $result = wp_insert_term($term_name, 'category', array(
            'slug' => $term_slug
        ));
        if (!is_wp_error($result)) {
            $stats['categories']++;
            echo "✓ Category imported: $term_name<br>";
        }
    }
}

// Import taxonomies
echo "<h2>Importing Taxonomies...</h2>";
foreach ($xml->channel->children($namespaces['wp'])->term as $term) {
    $taxonomy = (string)$term->term_taxonomy;
    if ($taxonomy == 'before') {
        $term_name = (string)$term->term_name;
        $term_slug = (string)$term->term_slug;
        
        if (!term_exists($term_name, 'before')) {
            $result = wp_insert_term($term_name, 'before', array(
                'slug' => $term_slug
            ));
            if (!is_wp_error($result)) {
                echo "✓ Term imported: $term_name<br>";
            }
        }
    }
}

// Import posts/pages/custom post types
echo "<h2>Importing Content...</h2>";
foreach ($xml->channel->item as $item) {
    $wp = $item->children($namespaces['wp']);
    $content = $item->children($namespaces['content']);
    $excerpt = $item->children($namespaces['excerpt']);
    
    $post_type = (string)$wp->post_type;
    $post_status = (string)$wp->status;
    
    // Skip drafts and private posts
    if ($post_status != 'publish' && $post_type != 'attachment') {
        continue;
    }
    
    $post_data = array(
        'post_title' => (string)$item->title,
        'post_name' => (string)$wp->post_name,
        'post_content' => (string)$content->encoded,
        'post_excerpt' => (string)$excerpt->encoded,
        'post_status' => $post_status,
        'post_type' => $post_type,
        'post_date' => (string)$wp->post_date,
        'comment_status' => (string)$wp->comment_status,
        'ping_status' => (string)$wp->ping_status,
        'menu_order' => (int)$wp->menu_order
    );
    
    // Handle different post types
    switch ($post_type) {
        case 'page':
            // Check if page already exists
            $existing = get_page_by_path($post_data['post_name']);
            if (!$existing) {
                $post_id = wp_insert_post($post_data);
                if (!is_wp_error($post_id)) {
                    $stats['pages']++;
                    echo "✓ Page imported: {$post_data['post_title']}<br>";
                }
            }
            break;
            
        case 'products':
            // Import product
            $existing = get_page_by_path($post_data['post_name'], OBJECT, 'products');
            if (!$existing) {
                $post_id = wp_insert_post($post_data);
                if (!is_wp_error($post_id)) {
                    // Add meta data
                    foreach ($wp->postmeta as $meta) {
                        $meta_key = (string)$meta->meta_key;
                        $meta_value = (string)$meta->meta_value;
                        if (!empty($meta_key) && $meta_key[0] != '_') {
                            update_post_meta($post_id, $meta_key, $meta_value);
                        }
                    }
                    
                    // Assign categories
                    $terms = array();
                    foreach ($item->category as $cat) {
                        if ((string)$cat['domain'] == 'before') {
                            $term = get_term_by('slug', (string)$cat['nicename'], 'before');
                            if ($term) {
                                $terms[] = $term->term_id;
                            }
                        }
                    }
                    if (!empty($terms)) {
                        wp_set_post_terms($post_id, $terms, 'before');
                    }
                    
                    $stats['products']++;
                    echo "✓ Product imported: {$post_data['post_title']}<br>";
                }
            }
            break;
            
        case 'voice':
            // Import customer voice
            $existing = get_page_by_path($post_data['post_name'], OBJECT, 'voice');
            if (!$existing) {
                $post_id = wp_insert_post($post_data);
                if (!is_wp_error($post_id)) {
                    $stats['voices']++;
                    echo "✓ Voice imported: {$post_data['post_title']}<br>";
                }
            }
            break;
            
        case 'attachment':
            // Import media files
            $attachment_url = (string)$wp->attachment_url;
            if (!empty($attachment_url)) {
                // Check if attachment already exists
                $existing = attachment_url_to_postid($attachment_url);
                if (!$existing) {
                    // Note: Actual file download would be needed here
                    $stats['attachments']++;
                    echo "✓ Attachment recorded: {$post_data['post_title']} - $attachment_url<br>";
                }
            }
            break;
    }
}

// Display summary
echo "<h2>Import Summary</h2>";
echo "<ul>";
echo "<li>Pages imported: {$stats['pages']}</li>";
echo "<li>Products imported: {$stats['products']}</li>";
echo "<li>Customer voices imported: {$stats['voices']}</li>";
echo "<li>Attachments found: {$stats['attachments']}</li>";
echo "<li>Categories imported: {$stats['categories']}</li>";
echo "</ul>";

if (!empty($stats['errors'])) {
    echo "<h3>Errors:</h3>";
    echo "<ul>";
    foreach ($stats['errors'] as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
}

echo "<p><strong>Import completed!</strong></p>";
echo "<p><a href='" . admin_url() . "'>Go to WordPress Admin</a></p>";
?>