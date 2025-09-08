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
            <p class="archive-description">これまでに手がけたジュエリーリフォームの実例をご紹介します。</p>
        </header>

        <?php
        // Get all before categories for filter
        $categories = get_terms(array(
            'taxonomy' => 'before',
            'hide_empty' => true,
        ));
        
        if ($categories && !is_wp_error($categories)) : ?>
            <div class="product-filters">
                <h3>カテゴリーで絞り込む</h3>
                <ul class="filter-list">
                    <li><a href="<?php echo get_post_type_archive_link('products'); ?>" class="<?php echo !is_tax() ? 'active' : ''; ?>">すべて</a></li>
                    <?php foreach ($categories as $category) : ?>
                        <li>
                            <a href="<?php echo get_term_link($category); ?>" 
                               class="<?php echo (is_tax('before', $category->term_id)) ? 'active' : ''; ?>">
                                <?php echo $category->name; ?> (<?php echo $category->count; ?>)
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
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
            <div class="products-grid grid">
                <?php while ($products_query->have_posts()) : $products_query->the_post(); ?>
                    <article class="product-card card">
                        <div class="product-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo refine_jewelry_get_product_image(get_the_ID(), 'product-thumbnail'); ?>
                            </a>
                        </div>
                        
                        <div class="product-content">
                            <h2 class="product-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <div class="product-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <a href="<?php the_permalink(); ?>" class="btn">詳細を見る</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php
            // カスタムページネーション
            $big = 999999999;
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $products_query->max_num_pages,
                'mid_size' => 2,
                'prev_text' => __('前へ', 'refine-jewelry-reform'),
                'next_text' => __('次へ', 'refine-jewelry-reform'),
            ));
            ?>

        <?php else : ?>
            <p>商品が見つかりません。</p>
        <?php endif; 
        
        // クエリをリセット
        wp_reset_postdata();
        ?>
    </div>
</main>

<?php get_footer(); ?>