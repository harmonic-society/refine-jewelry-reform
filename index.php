<?php
/**
 * Main Template File
 * @package RefineJewelryReform
 */

get_header(); ?>

<main id="main" class="site-main">
    <?php if (is_home() || is_front_page()) : ?>
        <!-- Hero Section -->
        <?php
        $hero_bg = get_theme_mod('hero_background_image', '');
        $hero_title = get_theme_mod('hero_title', 'リフォームリペア専門店<br>ジュエリー工房リファイン');
        $hero_subtitle = get_theme_mod('hero_subtitle', '東京都 池袋・大塚・埼玉県浦和・神奈川県横浜・若葉台・川崎の<br>ジュエリーリフォーム・リメイク・修理専門店');
        $overlay_opacity = get_theme_mod('hero_overlay_opacity', '0.4');
        ?>
        <section class="hero-section" <?php if($hero_bg) : ?>style="background-image: url('<?php echo esc_url($hero_bg); ?>');"<?php endif; ?>>
            <?php if($hero_bg) : ?>
                <div class="hero-overlay" style="opacity: <?php echo esc_attr($overlay_opacity); ?>;"></div>
            <?php endif; ?>
            <div class="hero-content">
                <div class="container">
                    <h1 class="hero-title"><?php echo wp_kses_post($hero_title); ?></h1>
                    <p class="hero-subtitle"><?php echo wp_kses_post($hero_subtitle); ?></p>
                    <div class="hero-cta">
                        <a href="<?php echo home_url('/inquiry/'); ?>" class="hero-btn hero-btn-primary">
                            <span>お問い合わせ</span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M7 4L13 10L7 16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </a>
                        <a href="<?php echo home_url('/case/'); ?>" class="hero-btn hero-btn-secondary">
                            <span>実例を見る</span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M7 4L13 10L7 16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <style>
        .hero-section {
            position: relative;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: hidden;
            background-color: linear-gradient(135deg, #FAF8F5 0%, #F5F0E8 100%);
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg,
                rgba(212, 175, 55, 0.1) 0%,
                rgba(255, 215, 0, 0.05) 50%,
                rgba(212, 175, 55, 0.1) 100%);
            z-index: 1;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg,
                rgba(0, 0, 0, 0.6) 0%,
                rgba(0, 0, 0, 0.4) 50%,
                rgba(0, 0, 0, 0.6) 100%);
            z-index: 2;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            text-align: center;
            padding: 60px 20px;
        }

        .hero-title {
            font-family: 'Noto Sans JP', sans-serif;
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 900;
            margin-bottom: 20px;
            line-height: 1.4;
            -webkit-font-smoothing: subpixel-antialiased;
            text-rendering: geometricPrecision;
            position: relative;
            display: inline-block;
            /* Vibrant gradient as default */
            background: linear-gradient(90deg,
                #B8860B 0%,
                #D4AF37 20%,
                #FFD700 35%,
                #FFA500 50%,
                #FFD700 65%,
                #D4AF37 80%,
                #B8860B 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            background-size: 200% 100%;
            animation: goldShimmer 4s linear infinite, fadeInUp 1s ease-out;
            letter-spacing: 0.08em;
            filter: drop-shadow(0 2px 8px rgba(212, 175, 55, 0.3));
        }

        @keyframes goldShimmer {
            0% { background-position: 100% center; }
            100% { background-position: -100% center; }
        }

        /* Enhanced style for background image */
        .hero-section[style*="background-image"] .hero-title {
            background: linear-gradient(90deg,
                #FFD700 0%,
                #FFED4E 25%,
                #FFF8DC 50%,
                #FFED4E 75%,
                #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            background-size: 200% 100%;
            animation: goldShimmer 4s linear infinite, fadeInUp 1s ease-out;
            filter: drop-shadow(0 0 10px rgba(255, 215, 0, 0.6))
                    drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.8));
        }

        .hero-section[style*="background-image"] .hero-subtitle {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            color: #FFF8DC;
        }

        .hero-subtitle {
            font-size: clamp(0.95rem, 2vw, 1.25rem);
            color: #FFFFFF;
            margin-bottom: 40px;
            line-height: 1.8;
            letter-spacing: 0.05em;
            animation: fadeInUp 1s ease-out 0.2s;
            animation-fill-mode: both;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }

        /* If no background image is set, use default styling */
        .hero-section:not([style*="background-image"]) {
            background: linear-gradient(135deg,
                #FAF8F5 0%,
                #F5F0E8 25%,
                #FFF9F0 50%,
                #F5F0E8 75%,
                #FAF8F5 100%);
            position: relative;
            overflow: visible;
        }

        .hero-section:not([style*="background-image"])::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.08) 0%, transparent 70%);
            pointer-events: none;
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
            50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.8; }
        }

        .hero-section:not([style*="background-image"]) .hero-title {
            background: linear-gradient(90deg,
                #B8860B 0%,
                #D4AF37 20%,
                #FFD700 35%,
                #FFA500 50%,
                #FFD700 65%,
                #D4AF37 80%,
                #B8860B 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: none !important;
            font-weight: 900;
            font-family: 'Noto Sans JP', 'Hiragino Sans', 'Meiryo', sans-serif;
            transform: none !important;
            filter: drop-shadow(0 2px 8px rgba(212, 175, 55, 0.3));
            opacity: 1;
            will-change: auto;
            position: relative;
            display: inline-block;
            background-size: 200% 100%;
            animation: goldShimmer 4s linear infinite;
            letter-spacing: 0.08em;
        }

        .hero-section:not([style*="background-image"]) .hero-subtitle {
            color: #5A5A5A;
            text-shadow: none !important;
            font-weight: 500;
            opacity: 1;
            position: relative;
            margin-top: 10px;
        }

        /* Add decorative elements */
        .hero-section:not([style*="background-image"]) .hero-title::before,
        .hero-section:not([style*="background-image"]) .hero-title::after {
            content: '◆';
            position: absolute;
            color: #D4AF37;
            font-size: 0.4em;
            -webkit-text-fill-color: #D4AF37;
        }

        .hero-section:not([style*="background-image"]) .hero-title::before {
            left: -1.5em;
            top: 50%;
            transform: translateY(-50%);
        }

        .hero-section:not([style*="background-image"]) .hero-title::after {
            right: -1.5em;
            top: 50%;
            transform: translateY(-50%);
        }

        .hero-cta {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 1s ease-out 0.4s;
            animation-fill-mode: both;
        }

        .hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 35px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .hero-btn-primary {
            background: linear-gradient(135deg, #D4AF37 0%, #FFD700 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
        }

        .hero-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
            color: white;
        }

        .hero-btn-secondary {
            background: rgba(255, 255, 255, 0.95);
            color: #D4AF37;
            border: 2px solid #D4AF37;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .hero-btn-secondary:hover {
            background: #D4AF37;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);
        }

        .hero-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .hero-btn:hover::before {
            left: 100%;
        }

        .hero-btn svg {
            transition: transform 0.3s ease;
        }

        .hero-btn:hover svg {
            transform: translateX(5px);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Disable animations for hero text to prevent blur */
        .hero-section:not([style*="background-image"]) .hero-title,
        .hero-section:not([style*="background-image"]) .hero-subtitle {
            animation: none !important;
        }

        /* Parallax effect on scroll */
        @media (min-width: 768px) {
            .hero-section {
                min-height: 700px;
                background-attachment: fixed;
            }
        }

        @media (max-width: 767px) {
            .hero-section {
                min-height: 500px;
            }

            .hero-content {
                padding: 40px 15px;
            }

            .hero-cta {
                flex-direction: column;
                align-items: center;
            }

            .hero-btn {
                width: 100%;
                max-width: 280px;
                justify-content: center;
            }
        }
        </style>

        <!-- Services Section -->
        <section id="services" class="services-luxury-section">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">サービス</h2>
                    <div class="title-decoration"></div>
                </div>
                
                <div class="luxury-services-grid">
                    <!-- リフォーム -->
                    <div class="luxury-service-card">
                        <div class="card-inner">
                            <div class="service-icon">
                                <i class="fas fa-gem fa-3x"></i>
                            </div>
                            <h3 class="service-title">リフォーム</h3>
                            <div class="service-subtitle">REFORM</div>
                            <p class="service-description">
                                お持ちのジュエリーを新しいデザインに生まれ変わらせます。代々受け継がれるジュエリーまで、お客様それぞれの思いを形作ります。
                            </p>
                            <div class="service-features">
                                <span class="feature-tag">デザイン提案</span>
                                <span class="feature-tag">オーダーメイド</span>
                                <span class="feature-tag">リメイク</span>
                            </div>
                            <a href="<?php echo home_url('/service/reform/'); ?>" class="luxury-btn">
                                <span>詳細を見る</span>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M7 4L13 10L7 16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </a>
                        </div>
                        <div class="card-glow"></div>
                    </div>

                    <!-- 修理 -->
                    <div class="luxury-service-card">
                        <div class="card-inner">
                            <div class="service-icon">
                                <i class="fas fa-tools fa-3x"></i>
                            </div>
                            <h3 class="service-title">修理</h3>
                            <div class="service-subtitle">REPAIR</div>
                            <p class="service-description">
                                壊れたジュエリーを丁寧に修理いたします。チェーン切れ、石取れ、サイズ直しなど、幅広く対応いたします。
                            </p>
                            <div class="service-features">
                                <span class="feature-tag">チェーン修理</span>
                                <span class="feature-tag">サイズ直し</span>
                                <span class="feature-tag">石留め</span>
                            </div>
                            <a href="<?php echo home_url('/service/repair/'); ?>" class="luxury-btn">
                                <span>詳細を見る</span>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M7 4L13 10L7 16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </a>
                        </div>
                        <div class="card-glow"></div>
                    </div>

                    <!-- 買取 -->
                    <div class="luxury-service-card">
                        <div class="card-inner">
                            <div class="service-icon">
                                <i class="fas fa-hand-holding-usd fa-3x"></i>
                            </div>
                            <h3 class="service-title">買取</h3>
                            <div class="service-subtitle">PURCHASE</div>
                            <p class="service-description">
                                不要なジュエリーを適正価格で買取いたします。査定は無料で承っております。
                            </p>
                            <div class="service-features">
                                <span class="feature-tag">無料査定</span>
                                <span class="feature-tag">即日現金化</span>
                                <span class="feature-tag">高価買取</span>
                            </div>
                            <a href="<?php echo home_url('/service/purchase/'); ?>" class="luxury-btn">
                                <span>詳細を見る</span>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M7 4L13 10L7 16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </a>
                        </div>
                        <div class="card-glow"></div>
                    </div>
                </div>
            </div>
        </section>

        <style>
        /* Luxury Services Section */
        .services-luxury-section {
            padding: 80px 0;
            background: linear-gradient(180deg, #FAF8F5 0%, #FFFFFF 100%);
            position: relative;
            overflow: hidden;
        }

        .services-luxury-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.03) 0%, transparent 70%);
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(30px, 20px) rotate(180deg); }
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title {
            font-family: 'Noto Serif JP', serif;
            font-size: 2.5rem;
            color: #2C2C2C;
            margin-bottom: 20px;
            letter-spacing: 0.1em;
            position: relative;
            display: inline-block;
        }

        .title-decoration {
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, transparent, #D4AF37, transparent);
            margin: 0 auto;
            position: relative;
        }

        .title-decoration::before,
        .title-decoration::after {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            background: #D4AF37;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }

        .title-decoration::before { left: -15px; }
        .title-decoration::after { right: -15px; }

        .luxury-services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .luxury-service-card {
            position: relative;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-inner {
            position: relative;
            padding: 50px 40px 40px;
            background: linear-gradient(135deg, #FFFFFF 0%, #FAFAFA 100%);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 20px;
            z-index: 1;
            display: flex;
            flex-direction: column;
            height: 560px;
        }

        .card-glow {
            position: absolute;
            inset: -2px;
            background: linear-gradient(135deg, #D4AF37, #FFD700, #D4AF37);
            border-radius: 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 0;
            filter: blur(10px);
        }

        .luxury-service-card:hover .card-glow {
            opacity: 0.3;
        }

        .luxury-service-card:hover {
            transform: translateY(-10px);
            box-shadow: 
                0 20px 40px rgba(212, 175, 55, 0.15),
                0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .service-icon {
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80px;
            animation: iconPulse 3s ease-in-out infinite;
        }

        .service-icon i {
            background: linear-gradient(135deg, #D4AF37 0%, #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 3.5rem;
            filter: drop-shadow(0 2px 4px rgba(212, 175, 55, 0.2));
            transition: all 0.3s ease;
        }

        .luxury-service-card:hover .service-icon i {
            transform: scale(1.1);
            filter: drop-shadow(0 4px 8px rgba(212, 175, 55, 0.4));
        }

        @keyframes iconPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .service-title {
            font-family: 'Noto Serif JP', serif;
            font-size: 1.8rem;
            color: #2C2C2C;
            margin-bottom: 5px;
            text-align: center;
            letter-spacing: 0.05em;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .service-subtitle {
            font-size: 0.9rem;
            color: #D4AF37;
            text-align: center;
            letter-spacing: 0.2em;
            margin-bottom: 20px;
            font-weight: 500;
            height: 25px;
        }

        .service-description {
            color: #666;
            line-height: 1.7;
            margin-bottom: 20px;
            font-size: 0.95rem;
            height: 145px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 5;
            -webkit-box-orient: vertical;
        }

        .service-features {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 25px;
            height: 72px;
            align-items: flex-start;
            align-content: flex-start;
        }

        .feature-tag {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(255, 215, 0, 0.1));
            border: 1px solid rgba(212, 175, 55, 0.3);
            color: #8B7355;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .luxury-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #D4AF37 0%, #FFD700 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
            position: relative;
            overflow: hidden;
            align-self: flex-start;
        }

        .luxury-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .luxury-btn:hover::before {
            left: 100%;
        }

        .luxury-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
            color: white;
        }

        .luxury-btn svg {
            transition: transform 0.3s ease;
        }

        .luxury-btn:hover svg {
            transform: translateX(5px);
        }

        @media (max-width: 768px) {
            .luxury-services-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .card-inner {
                padding: 40px 30px 35px;
                height: 510px;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .service-description {
                height: 125px;
                -webkit-line-clamp: 4;
            }
            
            .service-features {
                height: 62px;
            }
        }
        </style>

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
            <section class="voices-luxury-section">
                <div class="container">
                    <div class="voices-header">
                        <h2 class="voices-title">お客様の声</h2>
                        <div class="voices-subtitle">大切なジュエリーをお任せいただいたお客様からの温かいメッセージ</div>
                    </div>
                    <div class="luxury-voices-grid">
                        <?php while ($voices->have_posts()) : $voices->the_post(); ?>
                            <div class="luxury-voice-card">
                                <div class="voice-card-inner">
                                    <div class="quote-icon">
                                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 20C8 20 8 12 16 12V16C12 16 12 20 12 20V28H4V20H8Z" fill="url(#quote-gradient-<?php echo get_the_ID(); ?>)" opacity="0.3"/>
                                            <path d="M24 20C24 20 24 12 32 12V16C28 16 28 20 28 20V28H20V20H24Z" fill="url(#quote-gradient-<?php echo get_the_ID(); ?>)" opacity="0.3"/>
                                            <defs>
                                                <linearGradient id="quote-gradient-<?php echo get_the_ID(); ?>" x1="0%" y1="0%" x2="100%" y2="100%">
                                                    <stop offset="0%" style="stop-color:#D4AF37"/>
                                                    <stop offset="100%" style="stop-color:#FFD700"/>
                                                </linearGradient>
                                            </defs>
                                        </svg>
                                    </div>
                                    
                                    <div class="voice-rating">
                                        <?php for($i = 0; $i < 5; $i++) : ?>
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 1L11.5 6L17 7L13 11L14 16.5L9 14L4 16.5L5 11L1 7L6.5 6L9 1Z" fill="#FFD700" stroke="#D4AF37" stroke-width="0.5"/>
                                            </svg>
                                        <?php endfor; ?>
                                    </div>
                                    
                                    <div class="voice-message">
                                        <?php 
                                        $excerpt = get_the_excerpt();
                                        echo wp_trim_words($excerpt, 50, '...'); 
                                        ?>
                                    </div>
                                    
                                    <div class="voice-footer">
                                        <div class="voice-avatar">
                                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="25" cy="25" r="24" fill="url(#avatar-gradient-<?php echo get_the_ID(); ?>)" opacity="0.1"/>
                                                <circle cx="25" cy="25" r="23.5" stroke="url(#avatar-gradient-<?php echo get_the_ID(); ?>)" stroke-width="1" opacity="0.3"/>
                                                <circle cx="25" cy="20" r="7" fill="url(#avatar-gradient-<?php echo get_the_ID(); ?>)" opacity="0.5"/>
                                                <path d="M15 38C15 32 19 28 25 28C31 28 35 32 35 38" stroke="url(#avatar-gradient-<?php echo get_the_ID(); ?>)" stroke-width="2" opacity="0.5"/>
                                                <defs>
                                                    <linearGradient id="avatar-gradient-<?php echo get_the_ID(); ?>" x1="0%" y1="0%" x2="100%" y2="100%">
                                                        <stop offset="0%" style="stop-color:#D4AF37"/>
                                                        <stop offset="100%" style="stop-color:#FFD700"/>
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="voice-author-info">
                                            <div class="voice-author-name"><?php the_title(); ?></div>
                                            <div class="voice-date"><?php echo get_the_date('Y年n月'); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="voice-card-glow"></div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="voices-cta">
                        <a href="<?php echo home_url('/voice/'); ?>" class="luxury-voices-btn">
                            <span>すべてのお客様の声を見る</span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M7 4L13 10L7 16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
            
            <style>
            .voices-luxury-section {
                padding: 80px 0;
                background: linear-gradient(180deg, #FAFAFA 0%, #FFFFFF 50%, #FAF8F5 100%);
                position: relative;
                overflow: hidden;
            }
            
            .voices-luxury-section::before {
                content: '';
                position: absolute;
                top: -50%;
                right: -10%;
                width: 500px;
                height: 500px;
                background: radial-gradient(circle, rgba(212, 175, 55, 0.05) 0%, transparent 70%);
                border-radius: 50%;
            }
            
            .voices-header {
                text-align: center;
                margin-bottom: 60px;
            }
            
            .voices-title {
                font-family: 'Noto Serif JP', serif;
                font-size: 2.5rem;
                color: #2C2C2C;
                margin-bottom: 10px;
                position: relative;
                display: inline-block;
            }
            
            .voices-subtitle {
                font-size: 1rem;
                color: #8B7355;
                letter-spacing: 0.05em;
            }
            
            .luxury-voices-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: 30px;
                max-width: 1200px;
                margin: 0 auto 50px;
            }
            
            .luxury-voice-card {
                position: relative;
                background: white;
                border-radius: 16px;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .voice-card-inner {
                position: relative;
                padding: 35px;
                background: linear-gradient(135deg, #FFFFFF 0%, #FFFEF9 100%);
                border: 1px solid rgba(212, 175, 55, 0.15);
                border-radius: 16px;
                z-index: 1;
                min-height: 320px;
                display: flex;
                flex-direction: column;
            }
            
            .voice-card-glow {
                position: absolute;
                inset: -2px;
                background: linear-gradient(135deg, #D4AF37, #FFD700, #D4AF37);
                border-radius: 16px;
                opacity: 0;
                transition: opacity 0.3s ease;
                z-index: 0;
                filter: blur(8px);
            }
            
            .luxury-voice-card:hover {
                transform: translateY(-8px);
                box-shadow: 
                    0 20px 40px rgba(212, 175, 55, 0.12),
                    0 10px 20px rgba(0, 0, 0, 0.08);
            }
            
            .luxury-voice-card:hover .voice-card-glow {
                opacity: 0.2;
            }
            
            .quote-icon {
                margin-bottom: 15px;
            }
            
            .voice-rating {
                display: flex;
                gap: 4px;
                margin-bottom: 20px;
            }
            
            .voice-rating svg {
                filter: drop-shadow(0 2px 4px rgba(212, 175, 55, 0.2));
            }
            
            .voice-message {
                flex-grow: 1;
                font-size: 0.95rem;
                line-height: 1.8;
                color: #5A5A5A;
                margin-bottom: 25px;
                font-style: italic;
                position: relative;
                padding-left: 10px;
            }
            
            .voice-message::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                width: 2px;
                background: linear-gradient(180deg, #D4AF37 0%, transparent 100%);
            }
            
            .voice-footer {
                display: flex;
                align-items: center;
                gap: 15px;
                padding-top: 20px;
                border-top: 1px solid rgba(212, 175, 55, 0.1);
            }
            
            .voice-avatar {
                flex-shrink: 0;
            }
            
            .voice-author-info {
                flex-grow: 1;
            }
            
            .voice-author-name {
                font-weight: 600;
                color: #2C2C2C;
                font-size: 1.05rem;
                margin-bottom: 3px;
            }
            
            .voice-date {
                font-size: 0.85rem;
                color: #9A9A9A;
            }
            
            .voices-cta {
                text-align: center;
                margin-top: 50px;
            }
            
            .luxury-voices-btn {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                background: linear-gradient(135deg, #D4AF37 0%, #FFD700 100%);
                color: white;
                padding: 14px 35px;
                border-radius: 30px;
                text-decoration: none;
                font-weight: 600;
                font-size: 1rem;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
                position: relative;
                overflow: hidden;
            }
            
            .luxury-voices-btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                transition: left 0.5s ease;
            }
            
            .luxury-voices-btn:hover::before {
                left: 100%;
            }
            
            .luxury-voices-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
                color: white;
            }
            
            .luxury-voices-btn svg {
                transition: transform 0.3s ease;
            }
            
            .luxury-voices-btn:hover svg {
                transform: translateX(5px);
            }
            
            @media (max-width: 768px) {
                .luxury-voices-grid {
                    grid-template-columns: 1fr;
                    gap: 25px;
                }
                
                .voices-title {
                    font-size: 2rem;
                }
                
                .voice-card-inner {
                    padding: 30px 25px;
                    min-height: 280px;
                }
                
                .voices-luxury-section {
                    padding: 60px 0;
                }
            }
            </style>
            
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