# データベースURL変更手順書

## 🚨 重要な注意事項
**このスクリプトを実行する前に、必ずデータベースの完全なバックアップを取得してください！**

## 対象環境
- サイト: refine-jewelry-reform.com
- 変更内容: HTTPS → HTTP への一括変換
- データベース: wp629555_wp8

## 📋 実行手順

### 1. データベースのバックアップ（必須）

#### 方法A: phpMyAdminを使用
1. phpMyAdminにログイン
2. データベース `wp629555_wp8` を選択
3. 「エクスポート」タブをクリック
4. エクスポート方法: 「詳細」を選択
5. フォーマット: SQL
6. 「実行」をクリックしてダウンロード

#### 方法B: コマンドラインを使用
```bash
mysqldump -u [ユーザー名] -p[パスワード] wp629555_wp8 > backup_$(date +%Y%m%d_%H%M%S).sql
```

### 2. 現在の状態を確認

SQLを実行する前に、現在のHTTPSのURLがどれくらいあるか確認します：

```sql
-- HTTPSのURLカウントを確認
SELECT 
    'wp_posts' as table_name, 
    COUNT(*) as https_count 
FROM wp_posts 
WHERE post_content LIKE '%https://refine-jewelry-reform.com%' 
   OR post_content LIKE '%https://www.refine-jewelry-reform.com%'
UNION ALL
SELECT 
    'wp_postmeta' as table_name, 
    COUNT(*) as https_count 
FROM wp_postmeta 
WHERE meta_value LIKE '%https://refine-jewelry-reform.com%' 
   OR meta_value LIKE '%https://www.refine-jewelry-reform.com%'
UNION ALL
SELECT 
    'wp_options' as table_name, 
    COUNT(*) as https_count 
FROM wp_options 
WHERE option_value LIKE '%https://refine-jewelry-reform.com%' 
   OR option_value LIKE '%https://www.refine-jewelry-reform.com%';
```

結果を記録しておいてください。

### 3. SQLスクリプトの実行

#### 方法A: phpMyAdminを使用
1. phpMyAdminで「SQL」タブを開く
2. `database-url-update.sql` の内容をコピー＆ペースト
3. 「実行」をクリック

#### 方法B: コマンドラインを使用
```bash
mysql -u [ユーザー名] -p[パスワード] wp629555_wp8 < database-url-update.sql
```

### 4. シリアライズされたデータの確認

WordPressはいくつかのデータをシリアライズ形式で保存しています。これらは手動で確認が必要です：

```sql
-- シリアライズされたデータを確認
SELECT option_name, option_value 
FROM wp_options 
WHERE option_value LIKE '%s:%' 
  AND (option_value LIKE '%https://refine-jewelry-reform.com%' 
       OR option_value LIKE '%https://www.refine-jewelry-reform.com%')
LIMIT 10;
```

もしシリアライズされたデータがある場合は、専用のツールを使用するか、PHPスクリプトで処理する必要があります。

### 5. 実行後の確認

変更が正しく適用されたか確認：

```sql
-- HTTPSのURLが残っていないか確認
SELECT 
    'wp_posts' as table_name, 
    COUNT(*) as remaining_https 
FROM wp_posts 
WHERE post_content LIKE '%https://refine-jewelry-reform.com%' 
   OR post_content LIKE '%https://www.refine-jewelry-reform.com%'
UNION ALL
SELECT 
    'wp_postmeta' as table_name, 
    COUNT(*) as remaining_https 
FROM wp_postmeta 
WHERE meta_value LIKE '%https://refine-jewelry-reform.com%' 
   OR meta_value LIKE '%https://www.refine-jewelry-reform.com%'
UNION ALL
SELECT 
    'wp_options' as table_name, 
    COUNT(*) as remaining_https 
FROM wp_options 
WHERE option_value LIKE '%https://refine-jewelry-reform.com%' 
   OR option_value LIKE '%https://www.refine-jewelry-reform.com%';
```

すべてのカウントが0になっていることを確認してください。

### 6. WordPressでの作業

#### キャッシュのクリア
1. WordPress管理画面にログイン
2. キャッシュプラグインがある場合は、すべてのキャッシュをクリア
3. ブラウザのキャッシュもクリア（Ctrl+Shift+R / Cmd+Shift+R）

#### パーマリンクの再設定
1. 設定 → パーマリンク設定
2. 何も変更せずに「変更を保存」をクリック

### 7. サイトの動作確認

以下の項目を確認してください：

- [ ] トップページが正常に表示される
- [ ] 画像が正しく表示される
- [ ] リンクが正常に動作する
- [ ] 管理画面にログインできる
- [ ] 投稿の編集・保存ができる
- [ ] メディアライブラリの画像が表示される

## 🔄 ロールバック手順（問題があった場合）

### バックアップからの復元

#### 方法A: phpMyAdminを使用
1. データベースを選択
2. すべてのテーブルを選択
3. 「削除」を実行
4. 「インポート」タブを開く
5. バックアップファイルを選択してインポート

#### 方法B: コマンドラインを使用
```bash
mysql -u [ユーザー名] -p[パスワード] wp629555_wp8 < backup_[タイムスタンプ].sql
```

## 📝 補足情報

### プロトコル相対URLについて
現在のテーマには、プロトコル相対URL（`//domain.com`）を使用する機能が実装されています。これにより、HTTPとHTTPSの両方の環境で動作しますが、データベースを統一することでより安定した動作が期待できます。

### SSL証明書について
将来的にHTTPSに戻す場合は、逆の手順（HTTP → HTTPS）で同様の変更を行ってください。

## トラブルシューティング

### 画像が表示されない場合
- ブラウザのキャッシュをクリア
- CDNを使用している場合は、CDNのキャッシュもクリア
- `.htaccess` ファイルを確認

### Mixed Content警告が出る場合
- ブラウザの開発者ツールでコンソールを確認
- 残っているHTTPSのリソースを特定
- 必要に応じて個別に修正

## サポート
問題が発生した場合は、バックアップから復元してから、再度手順を確認してください。