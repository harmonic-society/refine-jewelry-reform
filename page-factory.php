<?php
/**
 * Template Name: Factory
 * @package RefineJewelryReform
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <div class="page-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </div>

            <div class="page-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>