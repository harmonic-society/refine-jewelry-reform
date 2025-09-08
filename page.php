<?php
/**
 * Page Template
 * @package RefineJewelryReform
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
                <header class="page-header">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php 
                    // Check if content exists
                    $content = get_the_content();
                    
                    if (!empty($content)) {
                        the_content();
                    } else {
                        // Provide default content based on page slug
                        $post_slug = get_post_field('post_name', get_the_ID());
                        
                        switch($post_slug) {
                            case 'service':
                                include(get_template_directory() . '/template-parts/content-service.php');
                                break;
                            case 'inquiry':
                            case 'contact':
                                include(get_template_directory() . '/template-parts/content-contact.php');
                                break;
                            case 'shops':
                            case 'shop':
                                include(get_template_directory() . '/template-parts/content-shops.php');
                                break;
                            case 'qa':
                                include(get_template_directory() . '/template-parts/content-qa.php');
                                break;
                            case 'privacy':
                                include(get_template_directory() . '/template-parts/content-privacy.php');
                                break;
                            case 'company':
                                include(get_template_directory() . '/template-parts/content-company.php');
                                break;
                            default:
                                echo '<p>このページのコンテンツは準備中です。</p>';
                                break;
                        }
                    }
                    ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>