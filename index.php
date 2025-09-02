<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refine Jewelry Reform</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="#home">ホーム</a></li>
                    <li><a href="#about">私たちについて</a></li>
                    <li><a href="#services">サービス</a></li>
                    <li><a href="#contact">お問い合わせ</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <section id="home" class="mt-4">
                <h1 class="text-center">Refine Jewelry Reform</h1>
                <p class="text-center">ジュエリーリフォームの新しいスタンダード</p>
                
                <div class="grid mt-4">
                    <div class="card">
                        <h3>高品質</h3>
                        <p>熟練の職人による確かな技術で、お客様の大切なジュエリーを生まれ変わらせます。</p>
                    </div>
                    <div class="card">
                        <h3>デザイン</h3>
                        <p>最新のトレンドと伝統的な技法を融合させた、オリジナルデザインをご提案します。</p>
                    </div>
                    <div class="card">
                        <h3>安心保証</h3>
                        <p>すべてのリフォーム作品に品質保証をお付けしています。</p>
                    </div>
                </div>
            </section>

            <section id="about" class="mt-4">
                <h2>私たちについて</h2>
                <div class="card">
                    <p>Refine Jewelry Reformは、お客様の想いを形にするジュエリーリフォーム専門店です。</p>
                    <p>創業以来、多くのお客様の大切なジュエリーに新しい命を吹き込んできました。</p>
                </div>
            </section>

            <section id="services" class="mt-4">
                <h2>サービス</h2>
                <div class="grid">
                    <div class="card">
                        <h3>リング リフォーム</h3>
                        <p>婚約指輪や結婚指輪のサイズ直しやデザイン変更を承ります。</p>
                        <a href="#" class="btn">詳細を見る</a>
                    </div>
                    <div class="card">
                        <h3>ネックレス リメイク</h3>
                        <p>古いネックレスを現代的なデザインに生まれ変わらせます。</p>
                        <a href="#" class="btn">詳細を見る</a>
                    </div>
                    <div class="card">
                        <h3>オーダーメイド</h3>
                        <p>お客様のご要望に合わせた完全オリジナルジュエリーを制作します。</p>
                        <a href="#" class="btn">詳細を見る</a>
                    </div>
                </div>
            </section>

            <section id="contact" class="mt-4">
                <h2>お問い合わせ</h2>
                <div class="card">
                    <form action="" method="post">
                        <label for="name">お名前</label>
                        <input type="text" id="name" name="name" required>
                        
                        <label for="email">メールアドレス</label>
                        <input type="email" id="email" name="email" required>
                        
                        <label for="message">メッセージ</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                        
                        <button type="submit" class="btn">送信する</button>
                    </form>
                </div>
            </section>

            <?php
            // PHPで現在時刻を表示
            date_default_timezone_set('Asia/Tokyo');
            $current_time = date('Y年m月d日 H:i:s');
            ?>
            <div class="mt-4 text-center">
                <p>現在時刻: <?php echo $current_time; ?></p>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Refine Jewelry Reform. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>