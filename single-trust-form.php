<?php
/**
 * Single Trust Form (Contact Submission) Template
 * @package RefineJewelryReform
 */

// Check if user has admin capabilities
if (!current_user_can('manage_options')) {
    wp_redirect(home_url());
    exit;
}

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <?php while (have_posts()) : the_post(); 
            $name = get_post_meta(get_the_ID(), 'customer_name', true);
            $email = get_post_meta(get_the_ID(), 'customer_email', true);
            $phone = get_post_meta(get_the_ID(), 'customer_phone', true);
            $message = get_post_meta(get_the_ID(), 'customer_message', true);
            $status = get_post_meta(get_the_ID(), 'status', true);
            $date = get_post_meta(get_the_ID(), 'submission_date', true);
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-trust-form'); ?>>
                <header class="page-header">
                    <h1 class="page-title">お問い合わせ詳細</h1>
                    <div class="submission-meta">
                        <span class="submission-date">受信日時: <?php echo $date ?: get_the_date('Y/m/d H:i:s'); ?></span>
                    </div>
                </header>

                <div class="submission-details">
                    <div class="detail-section">
                        <h2>お客様情報</h2>
                        <table class="detail-table">
                            <tr>
                                <th>お名前</th>
                                <td><?php echo esc_html($name ?: '不明'); ?></td>
                            </tr>
                            <tr>
                                <th>メールアドレス</th>
                                <td>
                                    <?php if ($email) : ?>
                                        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                                    <?php else : ?>
                                        —
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>電話番号</th>
                                <td>
                                    <?php if ($phone) : ?>
                                        <a href="tel:<?php echo esc_attr(str_replace('-', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                                    <?php else : ?>
                                        —
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>ステータス</th>
                                <td>
                                    <span class="status-badge status-<?php echo esc_attr($status ?: 'new'); ?>">
                                        <?php 
                                        switch($status) {
                                            case 'in_progress':
                                                echo '対応中';
                                                break;
                                            case 'completed':
                                                echo '完了';
                                                break;
                                            default:
                                                echo '新規';
                                        }
                                        ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="detail-section">
                        <h2>お問い合わせ内容</h2>
                        <div class="message-content">
                            <?php if ($message) : ?>
                                <?php echo nl2br(esc_html($message)); ?>
                            <?php else : ?>
                                <?php the_content(); ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="admin-actions">
                        <h2>管理者アクション</h2>
                        <div class="action-buttons">
                            <a href="<?php echo admin_url('post.php?post=' . get_the_ID() . '&action=edit'); ?>" class="btn btn-primary">
                                編集する
                            </a>
                            <a href="<?php echo admin_url('edit.php?post_type=trust-form'); ?>" class="btn btn-secondary">
                                一覧に戻る
                            </a>
                            <?php if ($email) : ?>
                                <a href="mailto:<?php echo esc_attr($email); ?>?subject=Re: お問い合わせありがとうございます" class="btn btn-outline">
                                    返信メールを送る
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if (get_the_content()) : ?>
                    <div class="detail-section">
                        <h2>その他の情報</h2>
                        <div class="additional-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<style>
.single-trust-form {
    background: var(--color-white);
    border-radius: 12px;
    padding: var(--spacing-xl);
    box-shadow: var(--shadow-lg);
    margin: var(--spacing-xl) 0;
}

.submission-meta {
    text-align: center;
    color: var(--color-gray);
    font-size: 0.95rem;
    margin-top: var(--spacing-sm);
}

.submission-details {
    margin-top: var(--spacing-xl);
}

.detail-section {
    margin-bottom: var(--spacing-xl);
    padding-bottom: var(--spacing-xl);
    border-bottom: 1px solid var(--color-silver);
}

.detail-section:last-child {
    border-bottom: none;
}

.detail-section h2 {
    font-size: 1.3rem;
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-md);
}

.detail-table {
    width: 100%;
    border-collapse: collapse;
}

.detail-table th {
    text-align: left;
    padding: var(--spacing-sm);
    background: var(--color-cream);
    font-weight: 600;
    width: 200px;
    color: var(--color-charcoal);
}

.detail-table td {
    padding: var(--spacing-sm);
    background: var(--color-white);
}

.detail-table tr {
    border-bottom: 1px solid var(--color-silver);
}

.status-badge {
    display: inline-block;
    padding: 0.25rem 1rem;
    border-radius: 15px;
    font-size: 0.9rem;
    font-weight: 500;
}

.status-new {
    background: var(--color-ruby);
    color: var(--color-white);
}

.status-in_progress {
    background: var(--color-sapphire);
    color: var(--color-white);
}

.status-completed {
    background: var(--color-emerald);
    color: var(--color-white);
}

.message-content {
    background: var(--color-cream);
    padding: var(--spacing-lg);
    border-radius: 8px;
    line-height: 1.8;
    color: var(--color-gray-dark);
}

.admin-actions {
    background: linear-gradient(135deg, var(--color-gold-light), var(--color-champagne));
    padding: var(--spacing-lg);
    border-radius: 8px;
    margin-top: var(--spacing-xl);
}

.admin-actions h2 {
    font-size: 1.2rem;
    margin-bottom: var(--spacing-md);
    color: var(--color-charcoal);
}

.action-buttons {
    display: flex;
    gap: var(--spacing-md);
    flex-wrap: wrap;
}

@media (max-width: 768px) {
    .detail-table th {
        width: 120px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
}
</style>

<?php get_footer(); ?>