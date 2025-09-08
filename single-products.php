<?php
/**
 * Single Product Template
 * @package RefineJewelryReform
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-product'); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <?php 
                // Extract before image from content
                $content = get_the_content();
                $before_image_url = '';
                
                // Extract first image URL from content
                if (preg_match('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $content, $matches)) {
                    $before_image_url = $matches[1];
                }
                
                // Get featured image as after image
                $after_image_url = '';
                if (has_post_thumbnail()) {
                    $after_image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                }
                
                // Show before/after if both images exist
                if ($before_image_url && $after_image_url) : ?>
                    <!-- Main Before/After Display -->
                    <div class="before-after-showcase">
                        <div class="showcase-header">
                            <h2 class="showcase-title">✨ リフォーム実例 ✨</h2>
                            <p class="showcase-subtitle">お客様の大切なジュエリーが、新しい輝きへと生まれ変わりました</p>
                        </div>
                        
                        <div class="before-after-main">
                            <div class="before-section">
                                <div class="section-label">
                                    <span class="label-text">BEFORE</span>
                                    <span class="label-subtitle">リフォーム前</span>
                                </div>
                                <div class="main-image-wrapper">
                                    <img src="<?php echo esc_url($before_image_url); ?>" alt="リフォーム前" class="showcase-image">
                                </div>
                            </div>
                            
                            <div class="arrow-container">
                                <div class="transform-arrow">→</div>
                                <div class="transform-text">Transform</div>
                            </div>
                            
                            <div class="after-section">
                                <div class="section-label">
                                    <span class="label-text">AFTER</span>
                                    <span class="label-subtitle">リフォーム後</span>
                                </div>
                                <div class="main-image-wrapper">
                                    <img src="<?php echo esc_url($after_image_url); ?>" alt="リフォーム後" class="showcase-image">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php // Show additional images from content if available
                    preg_match_all('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $content, $all_matches);
                    if (count($all_matches[1]) > 1) : ?>
                        <div class="additional-images">
                            <h3>その他の詳細写真</h3>
                            <div class="images-grid">
                                <?php for ($i = 1; $i < count($all_matches[1]); $i++) : ?>
                                    <div class="detail-image">
                                        <img src="<?php echo esc_url($all_matches[1][$i]); ?>" alt="詳細写真" class="detail-img">
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                <?php elseif ($after_image_url) : ?>
                    <!-- Show only after image if no before image in content -->
                    <div class="product-main-image">
                        <h3>リフォーム後</h3>
                        <img src="<?php echo esc_url($after_image_url); ?>" alt="リフォーム後" />
                    </div>
                <?php elseif ($before_image_url) : ?>
                    <!-- Show only before image if no featured image -->
                    <div class="product-main-image">
                        <h3>リフォーム前</h3>
                        <img src="<?php echo esc_url($before_image_url); ?>" alt="リフォーム前" />
                    </div>
                <?php else : ?>
                    <!-- Fallback to placeholder -->
                    <div class="product-main-image">
                        <?php echo refine_jewelry_get_product_image(get_the_ID(), 'large'); ?>
                    </div>
                <?php endif; ?>

                <!-- Product Details Section -->
                <div class="product-details">
                    <?php
                    // Get all custom fields
                    $product_code = get_post_meta(get_the_ID(), 'cf_product_code', true);
                    $material = get_post_meta(get_the_ID(), 'cf_material', true);
                    $color = get_post_meta(get_the_ID(), 'cf_color', true);
                    $size = get_post_meta(get_the_ID(), 'cf_size', true);
                    $spec = get_post_meta(get_the_ID(), 'cf_spec', true);
                    $price = get_post_meta(get_the_ID(), 'cf_price', true);
                    $price2 = get_post_meta(get_the_ID(), 'cf_price2', true);
                    ?>
                    
                    <?php if ($spec) : ?>
                        <div class="product-spec">
                            <h2>商品説明</h2>
                            <p><?php echo esc_html($spec); ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <div class="product-info-grid">
                        <?php if ($product_code) : ?>
                            <div class="info-item">
                                <span class="info-label">商品コード</span>
                                <span class="info-value"><?php echo esc_html($product_code); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($material) : ?>
                            <div class="info-item">
                                <span class="info-label">素材</span>
                                <span class="info-value"><?php echo esc_html($material); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($color) : ?>
                            <div class="info-item">
                                <span class="info-label">カラー</span>
                                <span class="info-value"><?php echo esc_html($color); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($size) : ?>
                            <div class="info-item">
                                <span class="info-label">型番・サイズ</span>
                                <span class="info-value"><?php echo esc_html($size); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($price || $price2) : ?>
                    <div class="product-price">
                        <h3>参考価格</h3>
                        <?php if ($price) : ?>
                            <p class="price">￥<?php echo number_format((int)str_replace(',', '', $price)); ?></p>
                        <?php endif; ?>
                        <?php if ($price2 && $price2 != $price) : ?>
                            <p class="price-alt">特別価格: ￥<?php echo number_format((int)str_replace(',', '', $price2)); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Main Content (without images) -->
                <?php 
                $content_without_images = get_the_content();
                // Remove all img tags from content
                $content_without_images = preg_replace('/<img[^>]+>/i', '', $content_without_images);
                // Remove empty paragraphs that may have contained images
                $content_without_images = preg_replace('/<p[^>]*>\s*<\/p>/i', '', $content_without_images);
                // Apply content filters
                $content_without_images = apply_filters('the_content', $content_without_images);
                
                if (trim($content_without_images)) : ?>
                    <div class="entry-content">
                        <?php echo $content_without_images; ?>
                    </div>
                <?php endif; ?>

                <!-- Taxonomies Display -->
                <div class="product-taxonomies">
                    <?php
                    // Display "Before" categories
                    $before_terms = get_the_terms(get_the_ID(), 'before');
                    if ($before_terms && !is_wp_error($before_terms)) : ?>
                        <div class="taxonomy-group">
                            <h3>リフォーム前</h3>
                            <ul class="taxonomy-list">
                                <?php foreach ($before_terms as $term) : ?>
                                    <li><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <?php
                    // Display "After" categories
                    $after_terms = get_the_terms(get_the_ID(), 'after');
                    if ($after_terms && !is_wp_error($after_terms)) : ?>
                        <div class="taxonomy-group">
                            <h3>リフォーム後</h3>
                            <ul class="taxonomy-list">
                                <?php foreach ($after_terms as $term) : ?>
                                    <li><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <?php
                    // Display "Type" categories
                    $type_terms = get_the_terms(get_the_ID(), 'type');
                    if ($type_terms && !is_wp_error($type_terms)) : ?>
                        <div class="taxonomy-group">
                            <h3>作業タイプ</h3>
                            <ul class="taxonomy-list">
                                <?php foreach ($type_terms as $term) : ?>
                                    <li><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <?php
                    // Display "Stone" categories
                    $stone_terms = get_the_terms(get_the_ID(), 'stone');
                    if ($stone_terms && !is_wp_error($stone_terms)) : ?>
                        <div class="taxonomy-group">
                            <h3>石の種類</h3>
                            <ul class="taxonomy-list">
                                <?php foreach ($stone_terms as $term) : ?>
                                    <li><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Related Products -->
                <?php
                $related_args = array(
                    'post_type' => 'products',
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'rand'
                );
                
                // Get products with same stone type
                if ($stone_terms && !is_wp_error($stone_terms)) {
                    $stone_ids = wp_list_pluck($stone_terms, 'term_id');
                    $related_args['tax_query'] = array(
                        array(
                            'taxonomy' => 'stone',
                            'field' => 'term_id',
                            'terms' => $stone_ids
                        )
                    );
                }
                
                $related_products = new WP_Query($related_args);
                
                if ($related_products->have_posts()) : ?>
                    <div class="related-products">
                        <h2>関連する実例</h2>
                        <div class="related-grid">
                            <?php while ($related_products->have_posts()) : $related_products->the_post(); ?>
                                <div class="related-item">
                                    <a href="<?php the_permalink(); ?>">
                                        <div class="related-image">
                                            <?php echo refine_jewelry_get_product_image(get_the_ID(), 'medium'); ?>
                                        </div>
                                        <h4><?php the_title(); ?></h4>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <?php wp_reset_postdata();
                endif; ?>

                <div class="product-navigation">
                    <?php
                    the_post_navigation(array(
                        'prev_text' => '<span class="nav-subtitle">前の実例:</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">次の実例:</span> <span class="nav-title">%title</span>',
                    ));
                    ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<style>
/* Single Product Styles */
.single-product {
    background: var(--color-white);
    border-radius: 12px;
    padding: var(--spacing-xl);
    box-shadow: var(--shadow-lg);
    margin: var(--spacing-xl) 0;
}

.product-main-image {
    text-align: center;
    margin-bottom: var(--spacing-xl);
}

.product-main-image h3 {
    font-size: 1.5rem;
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-md);
}

.product-main-image img {
    max-width: 600px;
    width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: var(--shadow-md);
}

/* Before/After Showcase - Main Feature */
.before-after-showcase {
    background: linear-gradient(135deg, var(--color-gold-light), var(--color-champagne));
    border-radius: 20px;
    padding: var(--spacing-xxl);
    margin: var(--spacing-xl) 0;
    box-shadow: var(--shadow-xl);
}

.showcase-header {
    text-align: center;
    margin-bottom: var(--spacing-xl);
}

.showcase-title {
    font-family: var(--font-display);
    font-size: 2.5rem;
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-sm);
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}

.showcase-subtitle {
    font-size: 1.2rem;
    color: var(--color-charcoal);
    max-width: 600px;
    margin: 0 auto;
}

.before-after-main {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: var(--spacing-lg);
    align-items: center;
    background: var(--color-white);
    border-radius: 15px;
    padding: var(--spacing-xl);
    box-shadow: inset 0 0 20px rgba(0,0,0,0.05);
}

.before-section,
.after-section {
    text-align: center;
}

.section-label {
    margin-bottom: var(--spacing-md);
}

.label-text {
    display: block;
    font-size: 2rem;
    font-weight: bold;
    letter-spacing: 0.1em;
}

.before-section .label-text {
    color: var(--color-gray);
}

.after-section .label-text {
    color: var(--color-gold-dark);
    background: linear-gradient(45deg, var(--color-gold), var(--color-gold-dark));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.label-subtitle {
    display: block;
    font-size: 0.9rem;
    color: var(--color-gray);
    margin-top: var(--spacing-xs);
}

.main-image-wrapper {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    transition: transform var(--transition-normal);
}

.main-image-wrapper:hover {
    transform: scale(1.02);
    box-shadow: var(--shadow-xl);
}

.showcase-image {
    width: 100%;
    max-width: 450px;
    height: auto;
    display: block;
    object-fit: cover;
    aspect-ratio: 1;
}

.arrow-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 0 var(--spacing-md);
}

.transform-arrow {
    font-size: 3rem;
    color: var(--color-gold);
    font-weight: bold;
    animation: pulse 2s infinite;
}

.transform-text {
    font-size: 0.9rem;
    color: var(--color-gold-dark);
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-top: var(--spacing-xs);
    font-weight: 600;
}

@keyframes pulse {
    0%, 100% {
        transform: translateX(0);
    }
    50% {
        transform: translateX(10px);
    }
}

/* Additional Images */
.additional-images {
    margin-top: var(--spacing-xl);
    padding: var(--spacing-lg);
    background: var(--color-cream);
    border-radius: 12px;
}

.additional-images h3 {
    font-size: 1.3rem;
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-md);
    text-align: center;
}

.images-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: var(--spacing-md);
}

.detail-image {
    background: var(--color-white);
    padding: var(--spacing-sm);
    border-radius: 8px;
    box-shadow: var(--shadow-sm);
    transition: transform var(--transition-normal);
}

.detail-image:hover {
    transform: scale(1.05);
    box-shadow: var(--shadow-md);
}

.detail-img {
    width: 100%;
    height: auto;
    border-radius: 4px;
    object-fit: cover;
    aspect-ratio: 1;
}

.product-details {
    margin: var(--spacing-xl) 0;
    padding: var(--spacing-xl);
    background: var(--color-cream);
    border-radius: 12px;
}

.product-spec {
    margin-bottom: var(--spacing-xl);
    padding-bottom: var(--spacing-lg);
    border-bottom: 1px solid var(--color-silver);
}

.product-spec h2 {
    font-size: 1.3rem;
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-md);
}

.product-spec p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--color-gray-dark);
}

.product-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--spacing-md);
}

.info-item {
    display: flex;
    justify-content: space-between;
    padding: var(--spacing-sm);
    background: var(--color-white);
    border-radius: 6px;
}

.info-label {
    font-weight: 600;
    color: var(--color-gold-dark);
    margin-right: var(--spacing-sm);
}

.info-value {
    color: var(--color-charcoal);
}

.product-price {
    background: linear-gradient(135deg, var(--color-gold-light), var(--color-champagne));
    border-radius: 12px;
    padding: var(--spacing-xl);
    margin: var(--spacing-xl) 0;
    text-align: center;
}

.product-price h3 {
    font-size: 1.2rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-md);
}

.price {
    font-family: var(--font-display);
    font-size: 2.5rem;
    color: var(--color-charcoal);
    font-weight: 500;
    margin: 0;
}

.price-alt {
    font-size: 1.5rem;
    color: var(--color-ruby);
    margin-top: var(--spacing-sm);
}

.product-taxonomies {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--spacing-lg);
    margin: var(--spacing-xl) 0;
    padding: var(--spacing-xl);
    background: var(--color-white);
    border: 1px solid var(--color-silver);
    border-radius: 12px;
}

.taxonomy-group h3 {
    font-size: 1rem;
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-sm);
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

.taxonomy-list {
    list-style: none;
    padding: 0;
}

.taxonomy-list li {
    margin-bottom: var(--spacing-xs);
}

.taxonomy-list a {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    background: var(--color-cream);
    color: var(--color-charcoal);
    border-radius: 15px;
    font-size: 0.9rem;
    transition: all var(--transition-normal);
}

.taxonomy-list a:hover {
    background: var(--color-gold);
    color: var(--color-white);
}

.related-products {
    margin: var(--spacing-xxl) 0;
    padding: var(--spacing-xl);
    background: var(--color-cream);
    border-radius: 12px;
}

.related-products h2 {
    text-align: center;
    margin-bottom: var(--spacing-xl);
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--spacing-lg);
}

.related-item {
    background: var(--color-white);
    border-radius: 8px;
    overflow: hidden;
    transition: transform var(--transition-normal);
}

.related-item:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
}

.related-image {
    aspect-ratio: 1;
    overflow: hidden;
}

.related-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.related-item h4 {
    padding: var(--spacing-md);
    font-size: 1rem;
    color: var(--color-charcoal);
    text-align: center;
}

@media (max-width: 768px) {
    .before-after-showcase {
        padding: var(--spacing-lg);
    }
    
    .showcase-title {
        font-size: 1.8rem;
    }
    
    .showcase-subtitle {
        font-size: 1rem;
    }
    
    .before-after-main {
        grid-template-columns: 1fr;
        gap: var(--spacing-lg);
    }
    
    .arrow-container {
        transform: rotate(90deg);
        margin: var(--spacing-md) 0;
    }
    
    .label-text {
        font-size: 1.5rem;
    }
    
    .showcase-image {
        max-width: 100%;
    }
    
    .images-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    }
    
    .product-info-grid {
        grid-template-columns: 1fr;
    }
    
    .product-taxonomies {
        grid-template-columns: 1fr;
    }
    
    .related-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>