<div class="services-page">
    <div class="services-intro">
        <p class="lead">ジュエリー工房リファインでは、お客様の大切なジュエリーに新しい命を吹き込む、3つのサービスをご提供しています。</p>
    </div>

    <div class="services-list">
        <section class="service-item">
            <div class="service-icon">
                <span class="icon-reform">💎</span>
            </div>
            <h2>ジュエリーリフォーム</h2>
            <p>お持ちのジュエリーを新しいデザインに生まれ変わらせます。世代を超えて受け継がれる宝石に、現代的な息吹を与えます。</p>
            <ul class="service-features">
                <li>オーダーメイドデザイン</li>
                <li>宝石の再利用・組み替え</li>
                <li>サイズ調整・デザイン変更</li>
                <li>アンティークジュエリーのリメイク</li>
            </ul>
            <a href="<?php echo home_url('/service/reform/'); ?>" class="btn btn-primary">リフォームの詳細へ</a>
        </section>

        <section class="service-item">
            <div class="service-icon">
                <span class="icon-repair">🔧</span>
            </div>
            <h2>ジュエリー修理</h2>
            <p>壊れてしまったジュエリーを、熟練の職人が丁寧に修理いたします。諦めていたジュエリーも、もう一度輝きを取り戻します。</p>
            <ul class="service-features">
                <li>チェーン切れ修理</li>
                <li>石留め・石の交換</li>
                <li>変色・変形の修正</li>
                <li>パーツ交換・補修</li>
            </ul>
            <a href="<?php echo home_url('/service/repair/'); ?>" class="btn btn-primary">修理の詳細へ</a>
        </section>

        <section class="service-item">
            <div class="service-icon">
                <span class="icon-purchase">💰</span>
            </div>
            <h2>ジュエリー買取</h2>
            <p>ご不要になったジュエリーを適正価格で買取いたします。査定は無料、その場で現金化も可能です。</p>
            <ul class="service-features">
                <li>無料査定サービス</li>
                <li>即日現金買取</li>
                <li>ダイヤモンド・貴金属高価買取</li>
                <li>壊れたジュエリーも査定可能</li>
            </ul>
            <a href="<?php echo home_url('/service/purchase/'); ?>" class="btn btn-primary">買取の詳細へ</a>
        </section>
    </div>

    <div class="service-flow">
        <h2>ご相談の流れ</h2>
        <div class="flow-steps">
            <div class="flow-step">
                <span class="step-number">1</span>
                <h3>お問い合わせ</h3>
                <p>お電話またはWebフォームからご相談ください</p>
            </div>
            <div class="flow-step">
                <span class="step-number">2</span>
                <h3>無料相談・査定</h3>
                <p>店舗にて専門スタッフがご相談を承ります</p>
            </div>
            <div class="flow-step">
                <span class="step-number">3</span>
                <h3>お見積り</h3>
                <p>詳細なお見積りをご提示いたします</p>
            </div>
            <div class="flow-step">
                <span class="step-number">4</span>
                <h3>作業開始</h3>
                <p>ご了承いただいてから作業を開始します</p>
            </div>
            <div class="flow-step">
                <span class="step-number">5</span>
                <h3>お渡し</h3>
                <p>完成品をご確認いただき、お渡しします</p>
            </div>
        </div>
    </div>
</div>

<style>
.services-page {
    padding: var(--spacing-xl) 0;
}

.services-intro {
    text-align: center;
    margin-bottom: var(--spacing-xxl);
}

.lead {
    font-size: 1.25rem;
    color: var(--color-gray-dark);
    max-width: 800px;
    margin: 0 auto;
}

.services-list {
    display: grid;
    gap: var(--spacing-xl);
    margin-bottom: var(--spacing-xxl);
}

.service-item {
    background: var(--color-white);
    padding: var(--spacing-xl);
    border-radius: 12px;
    box-shadow: var(--shadow-md);
    text-align: center;
    transition: transform var(--transition-normal);
}

.service-item:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.service-icon {
    font-size: 3rem;
    margin-bottom: var(--spacing-md);
}

.service-item h2 {
    color: var(--color-gold-dark);
    margin-bottom: var(--spacing-md);
}

.service-features {
    list-style: none;
    padding: 0;
    margin: var(--spacing-md) 0;
    text-align: left;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.service-features li {
    padding: var(--spacing-xs) 0;
    padding-left: 1.5rem;
    position: relative;
}

.service-features li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: var(--color-gold);
    font-weight: bold;
}

.service-flow {
    background: var(--color-cream);
    padding: var(--spacing-xxl);
    border-radius: 12px;
    margin-top: var(--spacing-xxl);
}

.service-flow h2 {
    text-align: center;
    margin-bottom: var(--spacing-xl);
}

.flow-steps {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: var(--spacing-md);
    max-width: 1000px;
    margin: 0 auto;
}

.flow-step {
    flex: 1;
    min-width: 150px;
    text-align: center;
    position: relative;
}

.flow-step:not(:last-child)::after {
    content: "→";
    position: absolute;
    right: -20px;
    top: 25px;
    color: var(--color-gold);
    font-size: 1.5rem;
}

.step-number {
    display: inline-block;
    width: 50px;
    height: 50px;
    line-height: 50px;
    background: linear-gradient(135deg, var(--color-gold), var(--color-gold-dark));
    color: var(--color-white);
    border-radius: 50%;
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: var(--spacing-sm);
}

.flow-step h3 {
    font-size: 1.1rem;
    margin-bottom: var(--spacing-xs);
    color: var(--color-charcoal);
}

.flow-step p {
    font-size: 0.9rem;
    color: var(--color-gray);
}

@media (max-width: 768px) {
    .flow-steps {
        flex-direction: column;
    }
    
    .flow-step:not(:last-child)::after {
        content: "↓";
        right: auto;
        top: auto;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
    }
}
</style>