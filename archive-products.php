<?php
/**
 * Products Archive Template
 * @package RefineJewelryReform
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">リフォーム実例</h1>
            <p class="archive-description">お客様の大切なジュエリーを、新しい輝きへと生まれ変わらせた実例をご紹介します。</p>
        </header>

        <?php
        // Get all taxonomies for filter
        $before_terms = get_terms(array(
            'taxonomy' => 'before',
            'hide_empty' => true,
        ));
        
        $after_terms = get_terms(array(
            'taxonomy' => 'after',
            'hide_empty' => true,
        ));
        
        $type_terms = get_terms(array(
            'taxonomy' => 'type',
            'hide_empty' => true,
        ));
        
        if (($before_terms && !is_wp_error($before_terms)) || 
            ($after_terms && !is_wp_error($after_terms)) || 
            ($type_terms && !is_wp_error($type_terms))) : ?>
            <div class="product-filters">
                <div class="filter-section">
                    <h3>リフォーム前</h3>
                    <ul class="filter-list">
                        <li><a href="<?php echo get_post_type_archive_link('products'); ?>" class="<?php echo (!is_tax()) ? 'active' : ''; ?>">すべて</a></li>
                        <?php if ($before_terms) : foreach ($before_terms as $term) : ?>
                            <li>
                                <a href="<?php echo get_term_link($term); ?>" 
                                   class="<?php echo (is_tax('before', $term->term_id)) ? 'active' : ''; ?>">
                                    <?php echo $term->name; ?>
                                </a>
                            </li>
                        <?php endforeach; endif; ?>
                    </ul>
                </div>
                
                <?php if ($after_terms && !is_wp_error($after_terms)) : ?>
                <div class="filter-section">
                    <h3>リフォーム後</h3>
                    <ul class="filter-list">
                        <?php foreach ($after_terms as $term) : ?>
                            <li>
                                <a href="<?php echo get_term_link($term); ?>" 
                                   class="<?php echo (is_tax('after', $term->term_id)) ? 'active' : ''; ?>">
                                    <?php echo $term->name; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                
                <?php if ($type_terms && !is_wp_error($type_terms)) : ?>
                <div class="filter-section">
                    <h3>作業タイプ</h3>
                    <ul class="filter-list">
                        <?php foreach ($type_terms as $term) : ?>
                            <li>
                                <a href="<?php echo get_term_link($term); ?>" 
                                   class="<?php echo (is_tax('type', $term->term_id)) ? 'active' : ''; ?>">
                                    <?php echo $term->name; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php 
        // カスタムクエリで商品を取得
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        
        // タクソノミーフィルタリング対応
        $args = array(
            'post_type' => 'products',
            'posts_per_page' => 12,
            'paged' => $paged,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        );
        
        // タクソノミーページの場合はフィルタリング
        if (is_tax()) {
            $current_term = get_queried_object();
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $current_term->taxonomy,
                    'field' => 'term_id',
                    'terms' => $current_term->term_id,
                )
            );
        }
        
        $products_query = new WP_Query($args);
        
        if ($products_query->have_posts()) : ?>
            <div class="products-grid">
                <?php while ($products_query->have_posts()) : $products_query->the_post(); 
                    // Get custom fields
                    $product_code = get_post_meta(get_the_ID(), 'cf_product_code', true);
                    $material = get_post_meta(get_the_ID(), 'cf_material', true);
                    $price = get_post_meta(get_the_ID(), 'cf_price', true);
                    
                    // Get taxonomies
                    $before_cats = get_the_terms(get_the_ID(), 'before');
                    $after_cats = get_the_terms(get_the_ID(), 'after');
                ?>
                    <article class="product-card">
                        <div class="product-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo refine_jewelry_get_product_image(get_the_ID(), 'product-thumbnail'); ?>
                                <div class="product-overlay">
                                    <span class="view-detail">詳細を見る</span>
                                </div>
                            </a>
                            <?php if ($product_code) : ?>
                                <span class="product-code"><?php echo esc_html($product_code); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="product-content">
                            <h2 class="product-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <?php if ($before_cats || $after_cats) : ?>
                            <div class="product-categories">
                                <?php if ($before_cats && !is_wp_error($before_cats)) : ?>
                                    <span class="cat-before">前: <?php echo $before_cats[0]->name; ?></span>
                                <?php endif; ?>
                                <?php if ($after_cats && !is_wp_error($after_cats)) : ?>
                                    <span class="cat-after">後: <?php echo $after_cats[0]->name; ?></span>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($material) : ?>
                                <div class="product-material">
                                    <span class="material-label">素材:</span> <?php echo esc_html($material); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($price) : ?>
                                <div class="product-price">
                                    参考価格: ￥<?php echo number_format((int)str_replace(',', '', $price)); ?>
                                </div>
                            <?php endif; ?>
                            
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary" style="position: relative; z-index: 10;">詳細を見る</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pagination-wrapper">
                <?php
                // カスタムページネーション
                $big = 999999999;
                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $products_query->max_num_pages,
                    'mid_size' => 2,
                    'prev_text' => '← 前へ',
                    'next_text' => '次へ →',
                ));
                ?>
            </div>

        <?php else : ?>
            <div class="no-products">
                <p>現在、実例を準備中です。</p>
                <a href="<?php echo home_url('/contact/'); ?>" class="btn btn-primary">お問い合わせはこちら</a>
            </div>
        <?php endif; 
        
        // クエリをリセット
        wp_reset_postdata();
        ?>
    </div>
</main>

<style>
/* Archive Page Styles */
.page-header {
    text-align: center;
    margin-bottom: var(--spacing-xxl);
    padding: var(--spacing-xl);
    background: linear-gradient(135deg, var(--color-gold-light), var(--color-champagne));
    border-radius: 12px;
}

.page-title {
    font-family: var(--font-display);
    font-size: 2.5rem;
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-md);
}

.archive-description {
    font-size: 1.1rem;
    color: var(--color-charcoal);
    max-width: 700px;
    margin: 0 auto;
}

/* Filters */
.product-filters {
    background: var(--color-white);
    padding: var(--spacing-lg);
    border-radius: 12px;
    box-shadow: var(--shadow-sm);
    margin-bottom: var(--spacing-xl);
}

.filter-section {
    margin-bottom: var(--spacing-lg);
}

.filter-section:last-child {
    margin-bottom: 0;
}

.filter-section h3 {
    font-size: 1rem;
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-sm);
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

.filter-list {
    list-style: none;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
    gap: var(--spacing-xs);
}

.filter-list li {
    display: inline-block;
}

.filter-list a {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: var(--color-cream);
    color: var(--color-charcoal);
    border-radius: 20px;
    font-size: 0.9rem;
    transition: all var(--transition-normal);
    text-decoration: none;
}

.filter-list a:hover {
    background: var(--color-gold-light);
    color: var(--color-gold-dark);
}

.filter-list a.active {
    background: var(--color-gold);
    color: var(--color-white);
}

/* Products Grid */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: var(--spacing-xl);
    margin-bottom: var(--spacing-xxl);
}

.product-card {
    background: var(--color-white);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all var(--transition-normal);
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.product-image {
    position: relative;
    aspect-ratio: 1;
    overflow: hidden;
    background: var(--color-cream);
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-normal);
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity var(--transition-normal);
    pointer-events: none;
}

.product-card:hover .product-overlay {
    opacity: 1;
    pointer-events: auto;
}

.view-detail {
    color: var(--color-white);
    font-size: 1.1rem;
    font-weight: 500;
    padding: 0.75rem 1.5rem;
    border: 2px solid var(--color-white);
    border-radius: 25px;
    pointer-events: none;
}

.product-code {
    position: absolute;
    top: var(--spacing-sm);
    left: var(--spacing-sm);
    background: var(--color-gold);
    color: var(--color-white);
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.product-content {
    padding: var(--spacing-lg);
    position: relative;
    z-index: 1;
}

.product-title {
    font-size: 1.2rem;
    margin-bottom: var(--spacing-sm);
}

.product-title a {
    color: var(--color-charcoal);
    text-decoration: none;
    transition: color var(--transition-normal);
    display: block;
}

.product-title a:hover {
    color: var(--color-gold);
}

.product-categories {
    margin-bottom: var(--spacing-sm);
    font-size: 0.9rem;
}

.cat-before,
.cat-after {
    display: inline-block;
    margin-right: var(--spacing-sm);
    padding: 0.2rem 0.5rem;
    background: var(--color-cream);
    border-radius: 10px;
    color: var(--color-gray);
}

.cat-after {
    background: var(--color-gold-light);
    color: var(--color-gold-dark);
}

.product-material {
    font-size: 0.9rem;
    color: var(--color-gray);
    margin-bottom: var(--spacing-sm);
}

.material-label {
    font-weight: 600;
    color: var(--color-gold-dark);
}

.product-price {
    font-size: 1.1rem;
    color: var(--color-ruby);
    font-weight: 500;
    margin-bottom: var(--spacing-md);
}

/* Pagination */
.pagination-wrapper {
    text-align: center;
    margin-top: var(--spacing-xxl);
}

.page-numbers {
    display: inline-block;
    padding: 0.75rem 1.25rem;
    margin: 0 0.25rem;
    background: var(--color-white);
    color: var(--color-charcoal);
    border-radius: 8px;
    text-decoration: none;
    transition: all var(--transition-normal);
    box-shadow: var(--shadow-sm);
}

.page-numbers:hover {
    background: var(--color-gold-light);
    color: var(--color-gold-dark);
}

.page-numbers.current {
    background: var(--color-gold);
    color: var(--color-white);
}

/* No Products */
.no-products {
    text-align: center;
    padding: var(--spacing-xxl);
    background: var(--color-white);
    border-radius: 12px;
    box-shadow: var(--shadow-md);
}

.no-products p {
    font-size: 1.2rem;
    color: var(--color-gray);
    margin-bottom: var(--spacing-lg);
}

/* Responsive */
@media (max-width: 768px) {
    .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: var(--spacing-md);
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .filter-list {
        flex-direction: column;
    }
    
    .filter-list a {
        display: block;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .products-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>