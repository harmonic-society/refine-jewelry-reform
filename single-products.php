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

                <div class="product-images">
                    <?php 
                    // Helper function to fix protocol in image HTML
                    function fix_image_protocol($html) {
                        // Get current protocol
                        $current_protocol = is_ssl() ? 'https:' : 'http:';
                        
                        // Replace https with current protocol if needed
                        if (!is_ssl()) {
                            $html = str_replace('https:', 'http:', $html);
                        }
                        
                        // Alternative: use protocol-relative URLs
                        // $html = str_replace(array('https:', 'http:'), '', $html);
                        
                        return $html;
                    }
                    
                    // Get all attached images
                    $attachments = get_posts(array(
                        'post_type' => 'attachment',
                        'posts_per_page' => -1,
                        'post_parent' => get_the_ID(),
                        'post_mime_type' => 'image',
                        'orderby' => 'menu_order',
                        'order' => 'ASC'
                    ));
                    
                    // If we have multiple images, show before/after
                    if (count($attachments) >= 2) : ?>
                        <div class="before-after-container">
                            <div class="before-image">
                                <h3>Before</h3>
                                <div class="image-wrapper">
                                    <?php 
                                    $before_img = wp_get_attachment_image($attachments[0]->ID, 'large', false, array('class' => 'reform-image'));
                                    echo fix_image_protocol($before_img);
                                    ?>
                                </div>
                            </div>
                            <div class="after-image">
                                <h3>After</h3>
                                <div class="image-wrapper">
                                    <?php 
                                    $after_img = wp_get_attachment_image($attachments[1]->ID, 'large', false, array('class' => 'reform-image'));
                                    echo fix_image_protocol($after_img);
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <?php // Show additional images if available
                        if (count($attachments) > 2) : ?>
                            <div class="additional-images">
                                <h3>詳細写真</h3>
                                <div class="images-grid">
                                    <?php for ($i = 2; $i < count($attachments); $i++) : ?>
                                        <div class="detail-image">
                                            <?php 
                                            $detail_img = wp_get_attachment_image($attachments[$i]->ID, 'medium', false, array('class' => 'detail-img'));
                                            echo fix_image_protocol($detail_img);
                                            ?>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                    <?php else : ?>
                        <!-- Fallback to single image or placeholder -->
                        <div class="product-main-image">
                            <?php echo refine_jewelry_get_product_image(get_the_ID(), 'large'); ?>
                        </div>
                    <?php endif; ?>
                </div>

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

                <!-- Main Content -->
                <?php if (get_the_content()) : ?>
                    <div class="entry-content">
                        <?php the_content(); ?>
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

.product-main-image img {
    max-width: 600px;
    width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: var(--shadow-md);
}

/* Before/After Container */
.before-after-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spacing-xl);
    margin-bottom: var(--spacing-xl);
}

.before-image,
.after-image {
    text-align: center;
}

.before-image h3,
.after-image h3 {
    font-family: var(--font-display);
    font-size: 1.5rem;
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-md);
    position: relative;
    padding-bottom: var(--spacing-sm);
}

.before-image h3::after,
.after-image h3::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 2px;
    background: var(--color-gold);
}

.image-wrapper {
    background: var(--color-white);
    padding: var(--spacing-md);
    border-radius: 12px;
    box-shadow: var(--shadow-md);
    transition: transform var(--transition-normal);
}

.image-wrapper:hover {
    transform: scale(1.02);
    box-shadow: var(--shadow-xl);
}

.reform-image {
    width: 100%;
    max-width: 500px;
    height: auto;
    border-radius: 8px;
    object-fit: cover;
    aspect-ratio: 1;
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
    .before-after-container {
        grid-template-columns: 1fr;
        gap: var(--spacing-lg);
    }
    
    .reform-image {
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