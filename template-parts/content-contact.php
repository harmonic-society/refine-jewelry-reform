<?php
// Handle form submission
$form_submitted = false;
$form_error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form_nonce'])) {
    if (wp_verify_nonce($_POST['contact_form_nonce'], 'contact_form_submit')) {
        // Sanitize form data
        $name = sanitize_text_field($_POST['customer_name']);
        $email = sanitize_email($_POST['customer_email']);
        $phone = sanitize_text_field($_POST['customer_phone']);
        $message = sanitize_textarea_field($_POST['customer_message']);
        
        // Create trust-form post
        $post_data = array(
            'post_title' => $name . ' - ' . current_time('Y/m/d H:i:s'),
            'post_type' => 'trust-form',
            'post_status' => 'private',
            'meta_input' => array(
                'customer_name' => $name,
                'customer_email' => $email,
                'customer_phone' => $phone,
                'customer_message' => $message,
                'submission_date' => current_time('mysql'),
                'status' => 'new'
            )
        );
        
        $result = wp_insert_post($post_data);
        
        if ($result) {
            // Send email notifications
            $admin_email = get_option('admin_email');
            $subject = 'ホームページからのお問い合わせ';
            $body = "お名前: {$name}\n";
            $body .= "メールアドレス: {$email}\n";
            $body .= "電話番号: {$phone}\n";
            $body .= "メッセージ:\n{$message}";
            
            wp_mail($admin_email, $subject, $body);
            
            // Send confirmation email to customer
            $customer_subject = 'お問い合わせありがとうございました';
            $customer_body = "{$name} 様\n\n";
            $customer_body .= "この度はお問い合わせいただき、誠にありがとうございます。\n";
            $customer_body .= "内容を確認の上、担当者よりご連絡させていただきます。\n\n";
            $customer_body .= "【お問い合わせ内容】\n";
            $customer_body .= $message . "\n\n";
            $customer_body .= "ジュエリー工房リファイン";
            
            wp_mail($email, $customer_subject, $customer_body);
            
            $form_submitted = true;
        } else {
            $form_error = true;
        }
    }
}
?>

<div class="contact-page">
    <?php if ($form_submitted) : ?>
        <div class="alert alert-success">
            <h2>お問い合わせありがとうございました</h2>
            <p>内容を確認の上、担当者よりご連絡させていただきます。</p>
            <p>お急ぎの場合は、お電話でもお問い合わせください。</p>
        </div>
    <?php elseif ($form_error) : ?>
        <div class="alert alert-error">
            <p>送信中にエラーが発生しました。お手数ですが、もう一度お試しください。</p>
        </div>
    <?php endif; ?>

    <div class="contact-intro">
        <p>ジュエリーのリフォーム・修理・買取に関するご相談、お見積りのご依頼など、お気軽にお問い合わせください。</p>
    </div>

    <div class="contact-content">
        <div class="contact-form-section">
            <h2>お問い合わせフォーム</h2>
            
            <?php if (!$form_submitted) : ?>
            <form method="post" class="contact-form">
                <?php wp_nonce_field('contact_form_submit', 'contact_form_nonce'); ?>
                
                <div class="form-group">
                    <label for="customer_name">お名前 <span class="required">*</span></label>
                    <input type="text" id="customer_name" name="customer_name" required>
                </div>
                
                <div class="form-group">
                    <label for="customer_email">メールアドレス <span class="required">*</span></label>
                    <input type="email" id="customer_email" name="customer_email" required>
                </div>
                
                <div class="form-group">
                    <label for="customer_phone">電話番号</label>
                    <input type="tel" id="customer_phone" name="customer_phone" placeholder="例: 03-1234-5678">
                </div>
                
                <div class="form-group">
                    <label for="customer_message">お問い合わせ内容 <span class="required">*</span></label>
                    <textarea id="customer_message" name="customer_message" rows="8" required></textarea>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">送信する</button>
                </div>
            </form>
            <?php endif; ?>
        </div>

        <div class="contact-info-section">
            <h2>お電話でのお問い合わせ</h2>
            
            <div class="store-contacts">
                <div class="store-contact-item">
                    <h3>池袋・大塚店</h3>
                    <p class="phone-number">03-1234-5678</p>
                    <p class="hours">営業時間: 10:00-19:00</p>
                </div>
                
                <div class="store-contact-item">
                    <h3>浦和店</h3>
                    <p class="phone-number">048-234-5678</p>
                    <p class="hours">営業時間: 10:00-19:00</p>
                </div>
                
                <div class="store-contact-item">
                    <h3>横浜店</h3>
                    <p class="phone-number">045-345-6789</p>
                    <p class="hours">営業時間: 10:00-19:00</p>
                </div>
                
                <div class="store-contact-item">
                    <h3>川崎店</h3>
                    <p class="phone-number">044-456-7890</p>
                    <p class="hours">営業時間: 10:00-19:00</p>
                </div>
            </div>
            
            <div class="contact-notes">
                <h3>ご来店予約</h3>
                <p>ご来店の際は、事前にお電話またはフォームからご予約いただくと、スムーズにご案内できます。</p>
                
                <h3>お持ちいただくもの</h3>
                <ul>
                    <li>リフォーム・修理をご希望のジュエリー</li>
                    <li>ご希望のデザインがある場合は参考画像</li>
                    <li>買取の場合は身分証明書</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
.contact-page {
    padding: var(--spacing-xl) 0;
}

.contact-intro {
    text-align: center;
    margin-bottom: var(--spacing-xl);
    font-size: 1.1rem;
    color: var(--color-gray-dark);
}

.contact-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: var(--spacing-xl);
}

.contact-form-section {
    background: var(--color-white);
    padding: var(--spacing-xl);
    border-radius: 12px;
    box-shadow: var(--shadow-md);
}

.contact-form {
    margin-top: var(--spacing-lg);
}

.form-group {
    margin-bottom: var(--spacing-md);
}

.form-group label {
    display: block;
    margin-bottom: var(--spacing-xs);
    font-weight: 500;
    color: var(--color-charcoal);
}

.required {
    color: var(--color-ruby);
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: var(--spacing-sm);
    border: 1px solid var(--color-silver);
    border-radius: 4px;
    font-size: 1rem;
    transition: border-color var(--transition-normal);
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--color-gold);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
}

.contact-info-section {
    space-y: var(--spacing-lg);
}

.store-contacts {
    background: var(--color-white);
    padding: var(--spacing-lg);
    border-radius: 12px;
    box-shadow: var(--shadow-md);
}

.store-contact-item {
    margin-bottom: var(--spacing-lg);
    padding-bottom: var(--spacing-md);
    border-bottom: 1px solid var(--color-silver);
}

.store-contact-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.store-contact-item h3 {
    font-size: 1.1rem;
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-xs);
}

.phone-number {
    font-size: 1.5rem;
    font-weight: bold;
    color: var(--color-charcoal);
    margin-bottom: var(--spacing-xs);
}

.hours {
    font-size: 0.9rem;
    color: var(--color-gray);
}

.contact-notes {
    background: var(--color-cream);
    padding: var(--spacing-lg);
    border-radius: 12px;
    margin-top: var(--spacing-lg);
}

.contact-notes h3 {
    font-size: 1.1rem;
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-sm);
}

.contact-notes ul {
    margin-left: var(--spacing-md);
    color: var(--color-gray-dark);
}

.alert {
    padding: var(--spacing-lg);
    border-radius: 8px;
    margin-bottom: var(--spacing-xl);
    text-align: center;
}

.alert-success {
    background: linear-gradient(135deg, var(--color-emerald), #40a070);
    color: var(--color-white);
}

.alert-error {
    background: linear-gradient(135deg, var(--color-ruby), #c91126);
    color: var(--color-white);
}

@media (max-width: 768px) {
    .contact-content {
        grid-template-columns: 1fr;
    }
}
</style>