<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>店舗情報</h3>
                <ul>
                    <li>池袋店</li>
                    <li>大塚店</li>
                    <li>浦和店</li>
                    <li>横浜店</li>
                    <li>若葉台店</li>
                    <li>川崎店</li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>サービス</h3>
                <ul>
                    <li><a href="<?php echo home_url('/service/reform/'); ?>">リフォーム</a></li>
                    <li><a href="<?php echo home_url('/service/repair/'); ?>">修理</a></li>
                    <li><a href="<?php echo home_url('/service/purchase/'); ?>">買取</a></li>
                    <li><a href="<?php echo home_url('/service/flow/'); ?>">ご相談の流れ</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>お問い合わせ</h3>
                <ul>
                    <li><a href="<?php echo home_url('/inquiry/'); ?>">お問い合わせフォーム</a></li>
                    <li><a href="<?php echo home_url('/qa/'); ?>">よくある質問</a></li>
                </ul>
            </div>
            
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-section">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>