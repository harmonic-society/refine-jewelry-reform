<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    
    <!-- Preload Fonts for Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&family=Noto+Serif+JP:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Crimson+Text:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home">
                        REFINE JEWELRY
                    </a>
                <?php endif; ?>
            </div>

            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'primary-menu',
                    'container' => false,
                    'fallback_cb' => function() {
                        ?>
                        <ul class="primary-menu">
                            <li class="<?php echo is_home() || is_front_page() ? 'current-menu-item' : ''; ?>">
                                <a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a>
                            </li>
                            <li class="<?php echo is_page('service') ? 'current-menu-item' : ''; ?>">
                                <a href="<?php echo esc_url(home_url('/service/')); ?>">サービス</a>
                            </li>
                            <li class="<?php echo is_post_type_archive('products') || is_singular('products') ? 'current-menu-item' : ''; ?>">
                                <a href="<?php echo esc_url(home_url('/case/')); ?>">リフォーム実例</a>
                            </li>
                            <li class="<?php echo is_post_type_archive('voice') ? 'current-menu-item' : ''; ?>">
                                <a href="<?php echo esc_url(home_url('/voice/')); ?>">お客様の声</a>
                            </li>
                            <li class="<?php echo is_page('shop') ? 'current-menu-item' : ''; ?>">
                                <a href="<?php echo esc_url(home_url('/shop/')); ?>">店舗</a>
                            </li>
                            <li class="<?php echo is_page('factory') ? 'current-menu-item' : ''; ?>">
                                <a href="<?php echo esc_url(home_url('/factory/')); ?>">自社工場</a>
                            </li>
                            <li class="<?php echo is_page('qa') ? 'current-menu-item' : ''; ?>">
                                <a href="<?php echo esc_url(home_url('/qa/')); ?>">Q&A</a>
                            </li>
                            <li class="<?php echo is_page('inquiry') || is_page('contact') ? 'current-menu-item' : ''; ?>">
                                <a href="<?php echo esc_url(home_url('/inquiry/')); ?>">お問い合わせ</a>
                            </li>
                        </ul>
                        <?php
                    }
                ));
                ?>
            </nav>
            
            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" aria-label="メニューを開く" onclick="this.classList.toggle('active'); document.querySelector('.main-navigation').classList.toggle('active');">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</header>

<style>
/* Mobile Menu Toggle Styles */
.mobile-menu-toggle {
    display: none;
    flex-direction: column;
    justify-content: space-between;
    width: 30px;
    height: 24px;
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 0;
    z-index: 1001;
}

.mobile-menu-toggle span {
    width: 100%;
    height: 2px;
    background: var(--color-charcoal);
    transition: all 0.3s ease;
    transform-origin: center;
}

.mobile-menu-toggle.active span:nth-child(1) {
    transform: translateY(11px) rotate(45deg);
}

.mobile-menu-toggle.active span:nth-child(2) {
    opacity: 0;
}

.mobile-menu-toggle.active span:nth-child(3) {
    transform: translateY(-11px) rotate(-45deg);
}

@media (max-width: 768px) {
    .mobile-menu-toggle {
        display: flex;
    }
    
    .main-navigation {
        position: fixed;
        top: 0;
        right: -100%;
        width: 80%;
        max-width: 350px;
        height: 100vh;
        background: var(--color-white);
        box-shadow: -5px 0 15px rgba(0,0,0,0.1);
        transition: right 0.3s ease;
        z-index: 1000;
        overflow-y: auto;
        padding-top: 80px;
    }
    
    .main-navigation.active {
        right: 0;
    }
    
    .main-navigation .primary-menu {
        flex-direction: column;
        padding: var(--spacing-lg);
    }
    
    .main-navigation .primary-menu li {
        margin-bottom: var(--spacing-md);
    }
    
    .main-navigation .primary-menu a {
        display: block;
        padding: var(--spacing-sm);
        font-size: 1.1rem;
    }
}
</style>