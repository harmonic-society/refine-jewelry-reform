<?php
/**
 * Template Name: Inquiry (Contact Form 7)
 * @package RefineJewelryReform
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">お問い合わせ</h1>
            <p class="page-subtitle">ジュエリーリフォームに関するご相談・お見積りは無料です</p>
        </div>

        <div class="inquiry-content">
            <div class="inquiry-intro">
                <p>お客様の大切なジュエリーのリフォーム・修理に関するご相談を承っております。<br>
                下記フォームに必要事項をご記入の上、送信してください。<br>
                お急ぎの方は、お電話でもお問い合わせいただけます。</p>
                
                <div class="contact-info-box">
                    <div class="phone-info">
                        <h3>お電話でのお問い合わせ</h3>
                        <p class="phone-number">
                            <span class="label">フリーダイアル</span>
                            <a href="tel:0120-262-704">0120-262-704</a>
                            <small>（プロになおし）</small>
                        </p>
                        <p class="phone-hours">
                            営業時間: 11:30～19:00<br>
                            定休日: 火・日・祝
                        </p>
                    </div>
                </div>
            </div>

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="contact-form-wrapper">
                    <?php
                    // Display the page content (which should contain the Contact Form 7 shortcode)
                    the_content();
                    
                    // If no content, display a default Contact Form 7 shortcode
                    if (empty(get_the_content())) {
                        echo '<div class="cf7-notice">';
                        echo '<p>Contact Form 7のショートコードを挿入してください。</p>';
                        echo '<p>例: [contact-form-7 id="123" title="お問い合わせフォーム"]</p>';
                        echo '</div>';
                    }
                    ?>
                </div>
            <?php endwhile; endif; ?>

            <div class="inquiry-notes">
                <h3>お問い合わせに関するご注意</h3>
                <ul>
                    <li>※ お問い合わせいただいた内容は、2営業日以内にご返信いたします。</li>
                    <li>※ お急ぎの場合は、お電話でのお問い合わせをお願いいたします。</li>
                    <li>※ 携帯電話のメールアドレスをご利用の場合、受信設定をご確認ください。</li>
                    <li>※ 個人情報は適切に管理し、お問い合わせ対応以外には使用いたしません。</li>
                </ul>
            </div>

            <div class="store-info-section">
                <h3>店舗でのご相談も承っております</h3>
                <div class="store-cards">
                    <div class="store-card">
                        <h4>池袋大塚店</h4>
                        <p>〒170-0005<br>東京都豊島区南大塚2-15-9</p>
                        <p>TEL: 0120-262-704</p>
                    </div>
                    <div class="store-card">
                        <h4>中野マルイ店</h4>
                        <p>〒164-0001<br>東京都中野区中野3-34-28 2F</p>
                        <p>TEL: 03-5340-7707</p>
                    </div>
                    <div class="store-card">
                        <h4>横浜若葉台店</h4>
                        <p>〒241-0801<br>神奈川県横浜市旭区若葉台3-7-1</p>
                        <p>TEL: 045-921-6201</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
/* Inquiry Page Styles */
.inquiry-content {
    max-width: 800px;
    margin: 0 auto;
    padding: var(--spacing-xl) 0;
}

.inquiry-intro {
    text-align: center;
    margin-bottom: var(--spacing-xl);
}

.inquiry-intro p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: var(--color-gray-dark);
    margin-bottom: var(--spacing-lg);
}

.contact-info-box {
    background: linear-gradient(135deg, var(--color-gold-light), var(--color-champagne));
    border-radius: 12px;
    padding: var(--spacing-xl);
    margin: var(--spacing-xl) 0;
}

.phone-info {
    text-align: center;
}

.phone-info h3 {
    font-size: 1.3rem;
    color: var(--color-charcoal);
    margin-bottom: var(--spacing-md);
}

.phone-number {
    margin-bottom: var(--spacing-md);
}

.phone-number .label {
    display: block;
    font-size: 0.9rem;
    color: var(--color-charcoal);
    margin-bottom: var(--spacing-xs);
}

.phone-number a {
    font-size: 2rem;
    font-weight: bold;
    color: var(--color-charcoal);
    text-decoration: none;
    transition: color var(--transition-normal);
}

.phone-number a:hover {
    color: var(--color-gold-dark);
}

.phone-number small {
    display: block;
    font-size: 0.9rem;
    color: var(--color-gray-dark);
    margin-top: var(--spacing-xs);
}

.phone-hours {
    color: var(--color-charcoal);
    font-size: 0.95rem;
}

/* Contact Form 7 Wrapper */
.contact-form-wrapper {
    background: var(--color-white);
    border-radius: 12px;
    padding: var(--spacing-xl);
    box-shadow: var(--shadow-lg);
    margin-bottom: var(--spacing-xl);
}

.cf7-notice {
    background: var(--color-cream);
    border: 2px dashed var(--color-gold);
    border-radius: 8px;
    padding: var(--spacing-lg);
    text-align: center;
}

.cf7-notice p {
    color: var(--color-gray-dark);
    margin: var(--spacing-sm) 0;
}

/* Contact Form 7 Styles */
.wpcf7 {
    margin: 0;
}

.wpcf7-form {
    display: block;
}

.wpcf7-form p {
    margin-bottom: var(--spacing-md);
}

.wpcf7-form label {
    display: block;
    font-weight: 600;
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-xs);
    font-size: 0.95rem;
}

.wpcf7-form label .wpcf7-form-control-wrap {
    display: block;
    margin-top: var(--spacing-xs);
}

.wpcf7-text,
.wpcf7-email,
.wpcf7-tel,
.wpcf7-select,
.wpcf7-textarea {
    width: 100%;
    padding: var(--spacing-sm) var(--spacing-md);
    border: 1px solid var(--color-silver);
    border-radius: 6px;
    font-size: 1rem;
    font-family: inherit;
    transition: all var(--transition-normal);
    background: var(--color-white);
}

.wpcf7-text:focus,
.wpcf7-email:focus,
.wpcf7-tel:focus,
.wpcf7-select:focus,
.wpcf7-textarea:focus {
    outline: none;
    border-color: var(--color-gold);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
}

.wpcf7-textarea {
    min-height: 150px;
    resize: vertical;
}

.wpcf7-checkbox,
.wpcf7-radio {
    margin-right: var(--spacing-xs);
}

.wpcf7-list-item {
    margin-bottom: var(--spacing-xs);
}

.wpcf7-submit {
    background: linear-gradient(135deg, var(--color-gold), var(--color-gold-dark));
    color: var(--color-white);
    border: none;
    padding: var(--spacing-md) var(--spacing-xl);
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 50px;
    cursor: pointer;
    transition: all var(--transition-normal);
    display: inline-block;
    min-width: 200px;
    text-align: center;
    margin-top: var(--spacing-md);
}

.wpcf7-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
}

.wpcf7-submit:active {
    transform: translateY(0);
}

/* Contact Form 7 Response Messages */
.wpcf7-response-output {
    margin: var(--spacing-md) 0;
    padding: var(--spacing-md);
    border-radius: 6px;
    text-align: center;
    font-weight: 500;
}

.wpcf7-mail-sent-ok {
    background: rgba(40, 167, 69, 0.1);
    border: 1px solid #28a745;
    color: #28a745;
}

.wpcf7-mail-sent-ng,
.wpcf7-aborted {
    background: rgba(220, 53, 69, 0.1);
    border: 1px solid #dc3545;
    color: #dc3545;
}

.wpcf7-spam-blocked {
    background: rgba(255, 193, 7, 0.1);
    border: 1px solid #ffc107;
    color: #856404;
}

.wpcf7-validation-errors,
.wpcf7-acceptance-missing {
    background: rgba(255, 193, 7, 0.1);
    border: 1px solid #ffc107;
    color: #856404;
}

/* Validation Tips */
.wpcf7-not-valid-tip {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: var(--spacing-xs);
    display: block;
}

.wpcf7-not-valid {
    border-color: #dc3545 !important;
}

/* Required Field Asterisk */
.wpcf7-form-control-wrap[data-name] abbr {
    color: #dc3545;
    text-decoration: none;
    border: none;
}

/* Spinner */
.wpcf7-spinner {
    visibility: hidden;
    display: inline-block;
    background: var(--color-gold);
    opacity: 0.75;
    width: 24px;
    height: 24px;
    border: none;
    border-radius: 50%;
    margin-left: var(--spacing-sm);
    vertical-align: middle;
}

.wpcf7-spinner.is-active {
    visibility: visible;
}

/* Notes Section */
.inquiry-notes {
    background: var(--color-cream);
    border-radius: 12px;
    padding: var(--spacing-xl);
    margin-bottom: var(--spacing-xl);
}

.inquiry-notes h3 {
    font-size: 1.2rem;
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-md);
}

.inquiry-notes ul {
    list-style: none;
    padding: 0;
}

.inquiry-notes li {
    padding: var(--spacing-xs) 0;
    padding-left: 1.5rem;
    position: relative;
    color: var(--color-gray-dark);
    line-height: 1.6;
}

.inquiry-notes li::before {
    content: "•";
    position: absolute;
    left: 0;
    color: var(--color-gold);
    font-weight: bold;
}

/* Store Info Section */
.store-info-section {
    margin-top: var(--spacing-xl);
}

.store-info-section h3 {
    font-size: 1.3rem;
    color: var(--color-gold-dark);
    text-align: center;
    margin-bottom: var(--spacing-lg);
}

.store-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--spacing-md);
}

.store-card {
    background: var(--color-white);
    border: 1px solid var(--color-silver);
    border-radius: 8px;
    padding: var(--spacing-lg);
    text-align: center;
    transition: all var(--transition-normal);
}

.store-card:hover {
    border-color: var(--color-gold);
    box-shadow: var(--shadow-md);
}

.store-card h4 {
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-sm);
}

.store-card p {
    color: var(--color-gray-dark);
    font-size: 0.9rem;
    margin: var(--spacing-xs) 0;
}

/* Responsive */
@media (max-width: 768px) {
    .phone-number a {
        font-size: 1.5rem;
    }
    
    .store-cards {
        grid-template-columns: 1fr;
    }
    
    .wpcf7-submit {
        width: 100%;
    }
}
</style>

<?php get_footer(); ?>