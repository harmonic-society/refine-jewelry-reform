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
                                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="35" stroke="url(#reform-gradient)" stroke-width="2" opacity="0.3"/>
                                    <circle cx="40" cy="40" r="28" stroke="url(#reform-gradient)" stroke-width="1.5"/>
                                    <path d="M40 20L44 28H52L46 33L48 41L40 36L32 41L34 33L28 28H36L40 20Z" fill="url(#reform-gradient)"/>
                                    <path d="M30 50C30 50 35 45 40 45C45 45 50 50 50 50" stroke="url(#reform-gradient)" stroke-width="2" stroke-linecap="round"/>
                                    <defs>
                                        <linearGradient id="reform-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#D4AF37"/>
                                            <stop offset="100%" style="stop-color:#FFD700"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
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
                                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="35" stroke="url(#repair-gradient)" stroke-width="2" opacity="0.3"/>
                                    <circle cx="40" cy="40" r="28" stroke="url(#repair-gradient)" stroke-width="1.5"/>
                                    <path d="M35 25L30 30L35 35M45 25L50 30L45 35" stroke="url(#repair-gradient)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M40 35V50" stroke="url(#repair-gradient)" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="40" cy="50" r="5" fill="url(#repair-gradient)"/>
                                    <defs>
                                        <linearGradient id="repair-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#B8860B"/>
                                            <stop offset="100%" style="stop-color:#DAA520"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
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
                                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="40" cy="40" r="35" stroke="url(#purchase-gradient)" stroke-width="2" opacity="0.3"/>
                                    <circle cx="40" cy="40" r="28" stroke="url(#purchase-gradient)" stroke-width="1.5"/>
                                    <path d="M30 30H50V45C50 47 48 49 46 49H34C32 49 30 47 30 45V30Z" stroke="url(#purchase-gradient)" stroke-width="2"/>
                                    <path d="M35 30V25C35 23 37 21 40 21C43 21 45 23 45 25V30" stroke="url(#purchase-gradient)" stroke-width="2"/>
                                    <circle cx="40" cy="39" r="5" fill="url(#purchase-gradient)"/>
                                    <defs>
                                        <linearGradient id="purchase-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#CD853F"/>
                                            <stop offset="100%" style="stop-color:#DEB887"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
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
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
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