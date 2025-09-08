<?php
/**
 * Main Template File
 * @package RefineJewelryReform
 */

get_header(); ?>

<main id="main" class="site-main">
    <?php if (is_home() || is_front_page()) : ?>
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <h1 class="text-center">リフォームリペア専門店<br>ジュエリー工房リファイン</h1>
                <p class="text-center">東京都 池袋・大塚・埼玉県浦和・神奈川県横浜・若葉台・川崎の<br>ジュエリーリフォーム・リメイク・修理専門店</p>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="mt-4">
            <div class="container">
                <h2 class="text-center">サービス</h2>
                <div class="grid">
                    <div class="card">
                        <h3>リフォーム</h3>
                        <p>お持ちのジュエリーを新しいデザインに生まれ変わらせます。代々受け継がれるジュエリーまで、お客様それぞれの思いを形作ります。</p>
                        <a href="<?php echo home_url('/service/reform/'); ?>" class="btn">詳細を見る</a>
                    </div>
                    <div class="card">
                        <h3>修理</h3>
                        <p>壊れたジュエリーを丁寧に修理いたします。チェーン切れ、石取れ、サイズ直しなど、幅広く対応いたします。</p>
                        <a href="<?php echo home_url('/service/repair/'); ?>" class="btn">詳細を見る</a>
                    </div>
                    <div class="card">
                        <h3>買取</h3>
                        <p>不要なジュエリーを適正価格で買取いたします。査定は無料で承っております。</p>
                        <a href="<?php echo home_url('/service/purchase/'); ?>" class="btn">詳細を見る</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Recent Products -->
        <?php
        $recent_products = new WP_Query(array(
            'post_type' => 'products',
            'posts_per_page' => 6,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        ));

        if ($recent_products->have_posts()) : ?>
            <section class="products-section mt-4">
                <div class="container">
                    <h2 class="text-center">リフォーム実例</h2>
                    <div class="grid">
                        <?php while ($recent_products->have_posts()) : $recent_products->the_post(); ?>
                            <article class="card">
                                <div class="product-image">
                                    <?php echo refine_jewelry_get_product_image(get_the_ID(), 'medium'); ?>
                                </div>
                                <h3><?php the_title(); ?></h3>
                                <?php the_excerpt(); ?>
                                <a href="<?php the_permalink(); ?>" class="btn">詳細を見る</a>
                            </article>
                        <?php endwhile; ?>
                    </div>
                    <div class="text-center mt-3">
                        <a href="<?php echo home_url('/case/'); ?>" class="btn btn-secondary">すべての実例を見る</a>
                    </div>
                </div>
            </section>
            <?php wp_reset_postdata();
        endif; ?>

        <!-- Customer Voices -->
        <?php
        $voices = new WP_Query(array(
            'post_type' => 'voice',
            'posts_per_page' => 3,
            'post_status' => 'publish'
        ));

        if ($voices->have_posts()) : ?>
            <section class="voices-section mt-4">
                <div class="container">
                    <h2 class="text-center">お客様の声</h2>
                    <div class="grid">
                        <?php while ($voices->have_posts()) : $voices->the_post(); ?>
                            <div class="card">
                                <div class="voice-content">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="voice-author">
                                    <strong><?php the_title(); ?></strong>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
            <?php wp_reset_postdata();
        endif; ?>

    <?php else : ?>
        <!-- Blog/Archive Layout -->
        <div class="container">
            <div class="content-area">
                <?php if (have_posts()) : ?>
                    <header class="page-header">
                        <?php
                        if (is_archive()) {
                            the_archive_title('<h1 class="page-title">', '</h1>');
                            the_archive_description('<div class="archive-description">', '</div>');
                        } elseif (is_search()) {
                            printf('<h1 class="page-title">検索結果: %s</h1>', get_search_query());
                        }
                        ?>
                    </header>

                    <div class="posts-list grid">
                        <?php while (have_posts()) : the_post(); ?>
                            <article class="card">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <div class="entry-meta">
                                    <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                                </div>
                                <div class="entry-content">
                                    <?php the_excerpt(); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn">続きを読む</a>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <?php the_posts_navigation(); ?>

                <?php else : ?>
                    <p>コンテンツが見つかりません。</p>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>