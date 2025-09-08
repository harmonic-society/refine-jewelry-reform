<?php
/**
 * Trust Form (Contact Submissions) Archive Template
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
        <header class="page-header">
            <h1 class="page-title">お問い合わせ履歴</h1>
            <p class="archive-description">お客様からのお問い合わせ一覧です。</p>
        </header>

        <?php 
        // Get contact form submissions
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        
        $args = array(
            'post_type' => 'trust-form',
            'posts_per_page' => 20,
            'paged' => $paged,
            'post_status' => array('private', 'publish'),
            'orderby' => 'date',
            'order' => 'DESC'
        );
        
        $submissions = new WP_Query($args);
        
        if ($submissions->have_posts()) : ?>
            <div class="submissions-table-wrapper">
                <table class="submissions-table">
                    <thead>
                        <tr>
                            <th>日時</th>
                            <th>お名前</th>
                            <th>メールアドレス</th>
                            <th>電話番号</th>
                            <th>ステータス</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($submissions->have_posts()) : $submissions->the_post(); 
                            $name = get_post_meta(get_the_ID(), 'customer_name', true);
                            $email = get_post_meta(get_the_ID(), 'customer_email', true);
                            $phone = get_post_meta(get_the_ID(), 'customer_phone', true);
                            $status = get_post_meta(get_the_ID(), 'status', true);
                            $date = get_the_date('Y/m/d H:i');
                        ?>
                            <tr>
                                <td><?php echo esc_html($date); ?></td>
                                <td><?php echo esc_html($name ?: '不明'); ?></td>
                                <td><?php echo esc_html($email ?: '不明'); ?></td>
                                <td><?php echo esc_html($phone ?: '未記入'); ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo esc_attr($status); ?>">
                                        <?php 
                                        switch($status) {
                                            case 'new':
                                                echo '新規';
                                                break;
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
                                <td>
                                    <a href="<?php the_permalink(); ?>" class="btn-view">詳細</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <?php
            // Pagination
            $big = 999999999;
            echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $submissions->max_num_pages,
                'mid_size' => 2,
                'prev_text' => __('前へ', 'refine-jewelry-reform'),
                'next_text' => __('次へ', 'refine-jewelry-reform'),
            ));
            ?>

        <?php else : ?>
            <div class="no-submissions">
                <p>お問い合わせ履歴がありません。</p>
            </div>
        <?php endif; 
        
        wp_reset_postdata();
        ?>
        
        <div class="admin-actions">
            <h2>管理者メニュー</h2>
            <div class="action-buttons">
                <a href="<?php echo admin_url('edit.php?post_type=trust-form'); ?>" class="btn btn-secondary">
                    管理画面で編集
                </a>
                <a href="<?php echo home_url('/inquiry/'); ?>" class="btn btn-primary">
                    お問い合わせフォームへ
                </a>
            </div>
        </div>
    </div>
</main>

<style>
.submissions-table-wrapper {
    background: var(--color-white);
    border-radius: 8px;
    box-shadow: var(--shadow-md);
    overflow-x: auto;
    margin: var(--spacing-xl) 0;
}

.submissions-table {
    width: 100%;
    border-collapse: collapse;
}

.submissions-table thead {
    background: linear-gradient(135deg, var(--color-gold-light), var(--color-champagne));
}

.submissions-table th {
    padding: var(--spacing-md);
    text-align: left;
    font-weight: 600;
    color: var(--color-charcoal);
    border-bottom: 2px solid var(--color-gold);
}

.submissions-table td {
    padding: var(--spacing-md);
    border-bottom: 1px solid var(--color-silver);
}

.submissions-table tbody tr:hover {
    background: var(--color-cream);
}

.status-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.85rem;
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

.btn-view {
    display: inline-block;
    padding: 0.25rem 1rem;
    background: var(--color-gold);
    color: var(--color-white);
    border-radius: 4px;
    text-decoration: none;
    font-size: 0.9rem;
    transition: background var(--transition-normal);
}

.btn-view:hover {
    background: var(--color-gold-dark);
}

.no-submissions {
    background: var(--color-white);
    padding: var(--spacing-xxl);
    text-align: center;
    border-radius: 8px;
    box-shadow: var(--shadow-md);
}

.admin-actions {
    background: var(--color-cream);
    padding: var(--spacing-xl);
    border-radius: 8px;
    margin-top: var(--spacing-xl);
}

.admin-actions h2 {
    margin-bottom: var(--spacing-md);
}

.action-buttons {
    display: flex;
    gap: var(--spacing-md);
}

@media (max-width: 768px) {
    .submissions-table {
        font-size: 0.85rem;
    }
    
    .submissions-table th,
    .submissions-table td {
        padding: var(--spacing-sm);
    }
    
    .action-buttons {
        flex-direction: column;
    }
}
</style>

<?php get_footer(); ?>