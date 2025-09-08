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

        <?php if (have_posts()) : ?>
            <div class="products-grid grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="product-card card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="product-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('product-thumbnail'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
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
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('前へ', 'refine-jewelry-reform'),
                'next_text' => __('次へ', 'refine-jewelry-reform'),
            ));
            ?>

        <?php else : ?>
            <p>商品が見つかりません。</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>