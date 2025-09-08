<?php
/**
 * 404 Error Page Template
 * @package RefineJewelryReform
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="error-404 not-found text-center">
            <header class="page-header">
                <h1 class="page-title">404</h1>
                <p class="error-message">お探しのページが見つかりません</p>
            </header>

            <div class="page-content">
                <p>申し訳ございません。お探しのページは存在しないか、移動した可能性があります。</p>
                
                <div class="search-form-container">
                    <h3>検索してみる</h3>
                    <?php get_search_form(); ?>
                </div>
                
                <div class="helpful-links mt-4">
                    <h3>よく見られているページ</h3>
                    <ul>
                        <li><a href="<?php echo home_url('/'); ?>">ホーム</a></li>
                        <li><a href="<?php echo home_url('/service/'); ?>">サービス</a></li>
                        <li><a href="<?php echo home_url('/case/'); ?>">リフォーム実例</a></li>
                        <li><a href="<?php echo home_url('/shop/'); ?>">店舗情報</a></li>
                        <li><a href="<?php echo home_url('/inquiry/'); ?>">お問い合わせ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>