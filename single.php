<?php
/**
 * Single Post Template
 * @package RefineJewelryReform
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    
                    <div class="entry-meta">
                        <time datetime="<?php echo get_the_date('c'); ?>">
                            <?php echo get_the_date(); ?>
                        </time>
                        <?php
                        $categories = get_the_category();
                        if ($categories) {
                            echo ' | ';
                            foreach ($categories as $category) {
                                echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a> ';
                            }
                        }
                        ?>
                    </div>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php 
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">ページ: ',
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <footer class="entry-footer">
                    <?php
                    $tags = get_the_tags();
                    if ($tags) {
                        echo '<div class="post-tags">';
                        echo '<span>タグ: </span>';
                        foreach ($tags as $tag) {
                            echo '<a href="' . get_tag_link($tag->term_id) . '">#' . $tag->name . '</a> ';
                        }
                        echo '</div>';
                    }
                    ?>
                </footer>

                <nav class="post-navigation">
                    <?php
                    the_post_navigation(array(
                        'prev_text' => '<span class="nav-subtitle">前の記事:</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">次の記事:</span> <span class="nav-title">%title</span>',
                    ));
                    ?>
                </nav>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>