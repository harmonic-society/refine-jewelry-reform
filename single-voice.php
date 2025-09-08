<?php
/**
 * Single Voice (Customer Testimonial) Template
 * @package RefineJewelryReform
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-voice'); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    
                    <?php 
                    // カスタムフィールドから追加情報を取得
                    $age = get_post_meta(get_the_ID(), '_customer_age', true);
                    $location = get_post_meta(get_the_ID(), '_customer_location', true);
                    $service_type = get_post_meta(get_the_ID(), '_service_type', true);
                    $date = get_post_meta(get_the_ID(), '_service_date', true);
                    
                    if ($age || $location || $service_type || $date) : ?>
                        <div class="voice-meta">
                            <?php if ($age) : ?>
                                <span class="meta-item">
                                    <strong>年齢:</strong> <?php echo esc_html($age); ?>歳
                                </span>
                            <?php endif; ?>
                            
                            <?php if ($location) : ?>
                                <span class="meta-item">
                                    <strong>地域:</strong> <?php echo esc_html($location); ?>
                                </span>
                            <?php endif; ?>
                            
                            <?php if ($service_type) : ?>
                                <span class="meta-item">
                                    <strong>サービス:</strong> <?php echo esc_html($service_type); ?>
                                </span>
                            <?php endif; ?>
                            
                            <?php if ($date) : ?>
                                <span class="meta-item">
                                    <strong>ご利用時期:</strong> <?php echo esc_html($date); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="voice-featured-image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content voice-content">
                    <?php the_content(); ?>
                </div>

                <?php
                // 関連する商品がある場合は表示
                $related_product = get_post_meta(get_the_ID(), '_related_product', true);
                if ($related_product) : 
                    $product = get_post($related_product);
                    if ($product) : ?>
                        <div class="related-product">
                            <h3>関連するリフォーム実例</h3>
                            <div class="product-card">
                                <div class="product-image">
                                    <a href="<?php echo get_permalink($product->ID); ?>">
                                        <?php echo refine_jewelry_get_product_image($product->ID, 'medium'); ?>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <h4><a href="<?php echo get_permalink($product->ID); ?>"><?php echo get_the_title($product->ID); ?></a></h4>
                                    <p><?php echo wp_trim_words($product->post_content, 30); ?></p>
                                    <a href="<?php echo get_permalink($product->ID); ?>" class="btn btn-outline">詳細を見る</a>
                                </div>
                            </div>
                        </div>
                    <?php endif;
                endif; ?>

                <div class="voice-navigation">
                    <?php
                    the_post_navigation(array(
                        'prev_text' => '<span class="nav-subtitle">前の声:</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">次の声:</span> <span class="nav-title">%title</span>',
                    ));
                    ?>
                </div>

                <div class="back-to-archive">
                    <a href="<?php echo get_post_type_archive_link('voice'); ?>" class="btn btn-secondary">
                        お客様の声一覧へ戻る
                    </a>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<style>
/* Single Voice Specific Styles */
.single-voice {
    background: var(--color-white);
    border-radius: 12px;
    padding: var(--spacing-xl);
    box-shadow: var(--shadow-lg);
    margin: var(--spacing-xl) 0;
}

.single-voice .entry-header {
    text-align: center;
    margin-bottom: var(--spacing-xl);
    position: relative;
    padding-bottom: var(--spacing-lg);
}

.single-voice .entry-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--color-gold), transparent);
}

.voice-meta {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: var(--spacing-md);
    margin-top: var(--spacing-md);
    font-size: 0.95rem;
}

.meta-item {
    padding: var(--spacing-xs) var(--spacing-sm);
    background: var(--color-cream);
    border-radius: 20px;
    color: var(--color-gray-dark);
}

.meta-item strong {
    color: var(--color-gold-dark);
    margin-right: var(--spacing-xs);
}

.voice-featured-image {
    margin: var(--spacing-xl) 0;
    text-align: center;
}

.voice-featured-image img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: var(--shadow-md);
}

.voice-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--color-gray-dark);
    margin: var(--spacing-xl) 0;
    position: relative;
    padding-left: var(--spacing-xl);
}

.voice-content::before {
    content: '"';
    position: absolute;
    top: -20px;
    left: 0;
    font-family: var(--font-display);
    font-size: 5rem;
    color: var(--color-gold);
    opacity: 0.2;
    line-height: 1;
}

.related-product {
    margin-top: var(--spacing-xxl);
    padding: var(--spacing-xl);
    background: var(--color-cream);
    border-radius: 8px;
}

.related-product h3 {
    text-align: center;
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-lg);
}

.related-product .product-card {
    display: flex;
    gap: var(--spacing-lg);
    align-items: center;
}

.related-product .product-image {
    flex: 0 0 200px;
}

.related-product .product-image img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.related-product .product-info {
    flex: 1;
}

.related-product h4 {
    margin-bottom: var(--spacing-sm);
}

.related-product h4 a {
    color: var(--color-charcoal);
    text-decoration: none;
}

.related-product h4 a:hover {
    color: var(--color-gold-dark);
}

.voice-navigation {
    margin-top: var(--spacing-xxl);
    padding-top: var(--spacing-xl);
    border-top: 1px solid var(--color-silver);
}

.back-to-archive {
    text-align: center;
    margin-top: var(--spacing-xl);
}

@media (max-width: 768px) {
    .voice-meta {
        flex-direction: column;
        align-items: center;
    }
    
    .related-product .product-card {
        flex-direction: column;
    }
    
    .related-product .product-image {
        flex: none;
        width: 100%;
    }
    
    .voice-content {
        padding-left: var(--spacing-md);
    }
}
</style>

<?php get_footer(); ?>