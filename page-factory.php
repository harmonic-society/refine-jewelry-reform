<?php
/**
 * Template Name: Factory
 * @package RefineJewelryReform
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">自社工場</h1>
            <p class="page-subtitle">最高品質のジュエリーリフォームを支える、職人の技術と設備</p>
        </div>

        <?php
        // Include the factory content template
        get_template_part('template-parts/content', 'factory');
        ?>
    </div>
</main>

<?php get_footer(); ?>