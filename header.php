<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                <?php endif; ?>
            </div>

            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id' => 'primary-menu',
                    'container' => false,
                    'fallback_cb' => function() {
                        ?>
                        <ul>
                            <li><a href="<?php echo home_url('/'); ?>">ホーム</a></li>
                            <li><a href="<?php echo home_url('/service/'); ?>">サービス</a></li>
                            <li><a href="<?php echo home_url('/case/'); ?>">リフォーム実例</a></li>
                            <li><a href="<?php echo home_url('/voice/'); ?>">お客様の声</a></li>
                            <li><a href="<?php echo home_url('/shop/'); ?>">店舗</a></li>
                            <li><a href="<?php echo home_url('/qa/'); ?>">Q&A</a></li>
                            <li><a href="<?php echo home_url('/inquiry/'); ?>">お問い合わせ</a></li>
                        </ul>
                        <?php
                    }
                ));
                ?>
            </nav>
        </div>
    </div>
</header>