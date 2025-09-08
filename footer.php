<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <!-- Brand Section -->
            <div class="footer-brand">
                <h3>REFINE JEWELRY REFORM</h3>
                <p>東京都 池袋・大塚・埼玉県浦和・神奈川県横浜・若葉台・川崎の<br>ジュエリーリフォーム・リメイク・修理専門店</p>
                <div class="footer-contact">
                    <p class="footer-tel">
                        <strong>フリーダイアル</strong><br>
                        <a href="tel:0120-262-704">0120-262-704</a><br>
                        <small>（プロになおし）</small>
                    </p>
                    <p class="footer-hours">
                        <strong>営業時間:</strong> 11:30～19:00<br>
                        <strong>定休日:</strong> 火・日・祝
                    </p>
                </div>
                <div class="social-links">
                    <!-- Social Media Icons can be added here -->
                </div>
            </div>
            
            <!-- Store Locations -->
            <div class="footer-widget">
                <h4>店舗情報</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/shop/ikebukuro/')); ?>">池袋大塚店</a></li>
                    <li><a href="<?php echo esc_url(home_url('/shop/nakano/')); ?>">中野マルイ店</a></li>
                    <li><a href="<?php echo esc_url(home_url('/shop/urawa/')); ?>">浦和店</a></li>
                    <li><a href="<?php echo esc_url(home_url('/shop/yokohama/')); ?>">横浜店</a></li>
                    <li><a href="<?php echo esc_url(home_url('/shop/wakabadai/')); ?>">若葉台店</a></li>
                    <li><a href="<?php echo esc_url(home_url('/shop/kawasaki/')); ?>">川崎店</a></li>
                    <li><a href="<?php echo esc_url(home_url('/shop/sakurashinmachi/')); ?>">世田谷桜新町店</a></li>
                </ul>
            </div>
            
            <!-- Services -->
            <div class="footer-widget">
                <h4>サービス</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/service/reform/')); ?>">リフォーム</a></li>
                    <li><a href="<?php echo esc_url(home_url('/service/repair/')); ?>">修理</a></li>
                    <li><a href="<?php echo esc_url(home_url('/service/purchase/')); ?>">買取</a></li>
                    <li><a href="<?php echo esc_url(home_url('/service/flow/')); ?>">ご相談の流れ</a></li>
                    <li><a href="<?php echo esc_url(home_url('/case/')); ?>">リフォーム実例</a></li>
                </ul>
            </div>
            
            <!-- Support -->
            <div class="footer-widget">
                <h4>サポート</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/inquiry/')); ?>">お問い合わせ</a></li>
                    <li><a href="<?php echo esc_url(home_url('/qa/')); ?>">よくある質問</a></li>
                    <li><a href="<?php echo esc_url(home_url('/voice/')); ?>">お客様の声</a></li>
                    <li><a href="<?php echo esc_url(home_url('/privacy/')); ?>">プライバシーポリシー</a></li>
                    <li><a href="<?php echo esc_url(home_url('/company/')); ?>">会社概要</a></li>
                </ul>
            </div>
            
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-widget">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved. | 
               <a href="<?php echo esc_url(home_url('/privacy/')); ?>">プライバシーポリシー</a> | 
               <a href="<?php echo esc_url(home_url('/terms/')); ?>">利用規約</a>
            </p>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button -->
<button id="scroll-to-top" aria-label="ページトップへ戻る">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 19V5M12 5L5 12M12 5L19 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</button>

<style>
/* Scroll to Top Button */
#scroll-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, var(--color-gold), var(--color-gold-dark));
    color: var(--color-white);
    border: none;
    border-radius: 50%;
    cursor: pointer;
    display: none;
    align-items: center;
    justify-content: center;
    box-shadow: var(--shadow-lg);
    transition: all var(--transition-normal);
    z-index: 999;
}

#scroll-to-top:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(212,175,55,0.4);
}

#scroll-to-top.show {
    display: flex;
}

#scroll-to-top svg {
    width: 24px;
    height: 24px;
}
</style>

<script>
// Scroll to Top Functionality
document.addEventListener('DOMContentLoaded', function() {
    const scrollToTopBtn = document.getElementById('scroll-to-top');
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.classList.add('show');
        } else {
            scrollToTopBtn.classList.remove('show');
        }
    });
    
    // Scroll to top when clicked
    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});

// Add smooth scrolling to all anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});
</script>

<?php wp_footer(); ?>
</body>
</html>