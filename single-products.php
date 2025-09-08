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
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="product-main-image">
                            <?php the_post_thumbnail('product-large'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php
                    // Get before/after images if they exist
                    $before_image_id = get_post_meta(get_the_ID(), '_before_image', true);
                    $after_image_id = get_post_meta(get_the_ID(), '_after_image', true);
                    ?>
                    
                    <?php if ($before_image_id || $after_image_id) : ?>
                        <div class="before-after-images grid">
                            <?php if ($before_image_id) : ?>
                                <div class="before-image card">
                                    <h3>リフォーム前</h3>
                                    <?php echo wp_get_attachment_image($before_image_id, 'product-thumbnail'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($after_image_id) : ?>
                                <div class="after-image card">
                                    <h3>リフォーム後</h3>
                                    <?php echo wp_get_attachment_image($after_image_id, 'product-thumbnail'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <?php
                // Get product price
                $price = get_post_meta(get_the_ID(), '_product_price', true);
                if ($price) : ?>
                    <div class="product-price">
                        <h3>参考価格</h3>
                        <p class="price"><?php echo esc_html($price); ?></p>
                    </div>
                <?php endif; ?>

                <?php
                // Display categories
                $terms = get_the_terms(get_the_ID(), 'before');
                if ($terms && !is_wp_error($terms)) : ?>
                    <div class="product-categories">
                        <h3>カテゴリー</h3>
                        <ul>
                            <?php foreach ($terms as $term) : ?>
                                <li><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

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

<?php get_footer(); ?>