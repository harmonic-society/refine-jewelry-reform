<?php
/**
 * Voice (Customer Testimonials) Archive Template
 * @package RefineJewelryReform
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">お客様の声</h1>
            <p class="archive-description">ジュエリーリフォームをご利用いただいたお客様からの感想をご紹介します。</p>
        </header>

        <?php 
        // カスタムクエリでお客様の声を取得
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        
        $args = array(
            'post_type' => 'voice',
            'posts_per_page' => 9,
            'paged' => $paged,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        );
        
        $voice_query = new WP_Query($args);
        
        if ($voice_query->have_posts()) : ?>
            <div class="voices-grid grid">
                <?php while ($voice_query->have_posts()) : $voice_query->the_post(); ?>
                    <article class="voice-card card">
                        <div class="voice-content">
                            <?php if (has_excerpt()) : ?>
                                <?php the_excerpt(); ?>
                            <?php else : ?>
                                <?php echo wp_trim_words(get_the_content(), 50, '...'); ?>
                            <?php endif; ?>
                        </div>
                        
                        <div class="voice-author">
                            <strong><?php the_title(); ?></strong>
                            <?php 
                            // カスタムフィールドから追加情報を取得（存在する場合）
                            $age = get_post_meta(get_the_ID(), '_customer_age', true);
                            $location = get_post_meta(get_the_ID(), '_customer_location', true);
                            
                            if ($age || $location) : ?>
                                <span class="voice-meta">
                                    <?php if ($age) : ?>
                                        <?php echo esc_html($age); ?>歳
                                    <?php endif; ?>
                                    <?php if ($age && $location) : ?> / <?php endif; ?>
                                    <?php if ($location) : ?>
                                        <?php echo esc_html($location); ?>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="voice-image">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <a href="<?php the_permalink(); ?>" class="btn btn-outline">詳細を読む</a>
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
                'total' => $voice_query->max_num_pages,
                'mid_size' => 2,
                'prev_text' => __('前へ', 'refine-jewelry-reform'),
                'next_text' => __('次へ', 'refine-jewelry-reform'),
            ));
            ?>

        <?php else : ?>
            <div class="no-content">
                <p>お客様の声がまだありません。</p>
            </div>
        <?php endif; 
        
        // クエリをリセット
        wp_reset_postdata();
        ?>
    </div>
</main>

<style>
/* Voice Archive Specific Styles */
.voices-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: var(--spacing-xl);
    margin: var(--spacing-xl) 0;
}

.voice-card {
    display: flex;
    flex-direction: column;
    padding: var(--spacing-xl);
    background: var(--color-white);
    border-radius: 12px;
    box-shadow: var(--shadow-md);
    position: relative;
    transition: all var(--transition-normal);
}

.voice-card::before {
    content: '"';
    position: absolute;
    top: var(--spacing-md);
    left: var(--spacing-md);
    font-family: var(--font-display);
    font-size: 3rem;
    color: var(--color-gold);
    opacity: 0.2;
    line-height: 1;
}

.voice-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.voice-content {
    padding-top: var(--spacing-lg);
    font-style: italic;
    color: var(--color-gray-dark);
    line-height: 1.8;
    margin-bottom: var(--spacing-md);
    flex-grow: 1;
}

.voice-author {
    margin-top: auto;
    padding-top: var(--spacing-md);
    border-top: 1px solid var(--color-silver);
    margin-bottom: var(--spacing-md);
}

.voice-author strong {
    display: block;
    font-family: var(--font-display);
    color: var(--color-gold-dark);
    font-size: 1.1rem;
    margin-bottom: var(--spacing-xs);
}

.voice-meta {
    font-size: 0.9rem;
    color: var(--color-gray);
}

.voice-image {
    margin: var(--spacing-md) 0;
    text-align: center;
}

.voice-image img {
    border-radius: 50%;
    width: 80px;
    height: 80px;
    object-fit: cover;
    border: 3px solid var(--color-gold-light);
}

@media (max-width: 768px) {
    .voices-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>