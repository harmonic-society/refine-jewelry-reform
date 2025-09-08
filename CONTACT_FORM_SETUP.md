# Contact Form 7 & Flamingo セットアップガイド

## 必要なプラグイン

1. **Contact Form 7** - お問い合わせフォーム作成
2. **Flamingo** - お問い合わせ履歴の保存

## インストール手順

### 1. プラグインのインストール

WordPress管理画面から:
1. プラグイン → 新規追加
2. 「Contact Form 7」を検索してインストール・有効化
3. 「Flamingo」を検索してインストール・有効化

### 2. Contact Form 7 フォーム設定

#### 基本フォーム設定

管理画面の「お問い合わせ」→「新規追加」で以下のコードを使用:

```html
<label> お名前 (必須)
    [text* your-name] </label>

<label> メールアドレス (必須)
    [email* your-email] </label>

<label> 電話番号
    [tel your-phone] </label>

<label> ご希望のサービス
    [select your-service "リフォーム" "修理" "買取" "その他"] </label>

<label> ご相談内容
    [textarea your-message] </label>

<label> 画像をアップロード（任意）
    [file your-file limit:5mb filetypes:jpg|jpeg|png|gif] </label>

[acceptance acceptance-privacy] 個人情報の取り扱いに同意する

[submit "送信する"]
```

#### メール設定

**送信先:**
```
[your-email]
```

**送信元:**
```
リファインジュエリー <wordpress@your-domain.com>
```

**題名:**
```
お問い合わせありがとうございます
```

**追加ヘッダー:**
```
Reply-To: [your-email]
```

**メッセージ本文:**
```
[your-name] 様

この度はリファインジュエリーリフォームへ
お問い合わせいただき、誠にありがとうございます。

以下の内容でお問い合わせを受け付けました。
2営業日以内にご返信いたしますので、
今しばらくお待ちください。

-----------------------------------------
【お名前】
[your-name]

【メールアドレス】
[your-email]

【電話番号】
[your-phone]

【ご希望のサービス】
[your-service]

【ご相談内容】
[your-message]
-----------------------------------------

なお、お急ぎの場合は下記までお電話ください。

フリーダイアル: 0120-262-704
営業時間: 11:30～19:00
定休日: 火・日・祝

━━━━━━━━━━━━━━━━━━━━
リファインジュエリーリフォーム
東京都豊島区南大塚2-15-9
https://refine-jewelry-reform.com
━━━━━━━━━━━━━━━━━━━━
```

#### メール (2) - 管理者通知

**送信先:**
```
admin@your-domain.com
```

**送信元:**
```
[your-name] <[your-email]>
```

**題名:**
```
[お問い合わせ] [your-name]様より
```

**メッセージ本文:**
```
新しいお問い合わせがありました。

【お名前】
[your-name]

【メールアドレス】
[your-email]

【電話番号】
[your-phone]

【ご希望のサービス】
[your-service]

【ご相談内容】
[your-message]

--
このメールは [_site_title] ([_site_url]) のお問い合わせフォームから送信されました
```

### 3. メッセージ設定

カスタマイズ推奨メッセージ:

- **送信成功:** ありがとうございます。メッセージは正常に送信されました。
- **送信失敗:** メッセージの送信に失敗しました。後ほどもう一度お試しください。
- **入力エラー:** 入力内容に問題があります。確認して再度お試しください。
- **スパム判定:** メッセージの送信に失敗しました。
- **承認必要:** 個人情報の取り扱いへの同意が必要です。
- **必須項目:** 必須項目に入力してください。
- **文字数制限:** 入力された文字数が多すぎます。

### 4. Flamingoの設定

Flamingoは自動的にContact Form 7の送信内容を保存します。

#### 管理画面での確認

1. 管理画面の「Flamingo」メニューから履歴を確認
2. 「受信メッセージ」で問い合わせ内容を管理
3. 「アドレス帳」で顧客情報を管理

#### ステータス管理

functions.phpに以下の機能を追加済み:
- 新規 (赤)
- 既読 (青)
- 返信済 (緑)
- スパム (グレー)

### 5. 固定ページの作成

1. 固定ページ → 新規追加
2. タイトル: 「お問い合わせ」
3. パーマリンク: `inquiry`
4. ページテンプレート: 「Inquiry (Contact Form 7)」を選択
5. 本文にContact Form 7のショートコードを貼り付け:
   ```
   [contact-form-7 id="XX" title="お問い合わせフォーム"]
   ```

### 6. スパム対策

#### reCAPTCHA v3の設定（推奨）

1. Contact Form 7 → インテグレーション
2. reCAPTCHAの設定
3. Google reCAPTCHAでサイトキーとシークレットキーを取得
4. キーを入力して保存

#### Akismetの設定（オプション）

1. Akismetプラグインをインストール
2. APIキーを取得・設定
3. Contact Form 7フォームにAkismetタグを追加:
   ```
   [text* your-name akismet:author]
   [email* your-email akismet:author_email]
   ```

## トラブルシューティング

### メールが送信されない場合

1. **WP Mail SMTP**プラグインの使用を検討
2. サーバーのメール送信設定を確認
3. SPF/DKIM設定を確認

### 文字化けする場合

1. WordPressの文字コード設定を確認（UTF-8）
2. メールヘッダーに文字コード指定を追加

### Flamingoに保存されない場合

1. プラグインの再インストール
2. データベースの権限確認
3. wp-content/uploadsの書き込み権限確認

## セキュリティ推奨事項

1. 定期的なプラグインアップデート
2. reCAPTCHAまたはAkismetの使用
3. ファイルアップロードサイズの制限
4. 許可するファイル形式の制限
5. フォーム送信回数の制限（必要に応じて）

## バックアップ

Flamingoのデータは以下のテーブルに保存されます:
- `wp_posts` (post_type: flamingo_inbound, flamingo_contact)
- `wp_postmeta`

定期的なデータベースバックアップを推奨します。