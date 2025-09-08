# 🔐 安全なデータベースURL更新手順

## ⚠️ 問題の詳細

商品詳細ページの投稿内容に以下のようなHTMLが直接記載されています：

```html
<a href="https://www.refine-jewelry-reform.com/wp-content/uploads/2015/07/61-10b2.png">
  <img class="alignnone wp-image-1520" src="http://www.refine-jewelry-reform.com/wp-content/uploads/2015/07/61-10b2-150x150.png" alt="" width="225" height="225" />
</a>
```

**問題点:**
- `<a href>` タグ：**HTTPS**を使用
- `<img src>` タグ：**HTTP**を使用
- プロトコルが混在している

## 📋 推奨実行手順

### ステップ1: バックアップ（必須）

```bash
# データベース全体のバックアップ
mysqldump -u [ユーザー名] -p[パスワード] wp629555_wp8 > backup_full_$(date +%Y%m%d_%H%M%S).sql

# wp_postsテーブルのみのバックアップ（追加の安全策）
mysqldump -u [ユーザー名] -p[パスワード] wp629555_wp8 wp_posts > backup_posts_$(date +%Y%m%d_%H%M%S).sql
```

### ステップ2: 現状確認

1. **test-before-update.sql** を実行して現状を把握：

```sql
-- phpMyAdminまたはMySQLクライアントで実行
source test-before-update.sql;
```

これにより以下が確認できます：
- HTTPSとHTTPが混在している投稿数
- 具体的な問題箇所
- URLパターンの統計

### ステップ3: 段階的な更新

#### 方法A: 安全な段階的実行（推奨）

1. **まず1件だけテスト更新**

```sql
-- 特定の1投稿だけ更新してテスト
UPDATE wp_posts 
SET post_content = REPLACE(
    REPLACE(
        post_content,
        'href="https://www.refine-jewelry-reform.com',
        'href="http://www.refine-jewelry-reform.com'
    ),
    'href="https://refine-jewelry-reform.com',
    'href="http://refine-jewelry-reform.com'
)
WHERE ID = 52  -- テストする投稿IDを指定
  AND post_type = 'products';

-- 結果を確認
SELECT ID, post_title, post_content FROM wp_posts WHERE ID = 52;
```

2. **問題なければ、商品投稿のみ更新**

```sql
-- productsタイプのみ更新
UPDATE wp_posts 
SET post_content = REPLACE(
    REPLACE(
        post_content,
        'href="https://www.refine-jewelry-reform.com',
        'href="http://www.refine-jewelry-reform.com'
    ),
    'href="https://refine-jewelry-reform.com',
    'href="http://refine-jewelry-reform.com'
)
WHERE post_type = 'products'
  AND post_content LIKE '%href="https://%';

-- 更新件数を確認
SELECT ROW_COUNT() as updated_count;
```

3. **最後に全体を更新**

```sql
-- database-url-update-enhanced.sql を実行
source database-url-update-enhanced.sql;
```

#### 方法B: 一括実行（テスト環境で確認済みの場合）

```bash
mysql -u [ユーザー名] -p[パスワード] wp629555_wp8 < database-url-update-enhanced.sql
```

### ステップ4: 実行後の確認

```sql
-- HTTPSが残っていないか確認
SELECT 
    'href属性のHTTPS' as check_type,
    COUNT(*) as remaining
FROM wp_posts 
WHERE post_content LIKE '%href="https://www.refine-jewelry-reform.com%'
   OR post_content LIKE '%href="https://refine-jewelry-reform.com%'
UNION ALL
SELECT 
    'src属性のHTTPS' as check_type,
    COUNT(*) as remaining
FROM wp_posts 
WHERE post_content LIKE '%src="https://www.refine-jewelry-reform.com%'
   OR post_content LIKE '%src="https://refine-jewelry-reform.com%';
```

すべて0になっていることを確認。

### ステップ5: WordPress側の処理

1. **管理画面にログイン**
2. **キャッシュをクリア**
   - キャッシュプラグインがある場合：すべてクリア
   - CDNを使用している場合：CDNキャッシュもクリア
3. **パーマリンクを再設定**
   - 設定 → パーマリンク設定 → 変更を保存
4. **ブラウザキャッシュをクリア**
   - Ctrl+Shift+R (Windows) / Cmd+Shift+R (Mac)

### ステップ6: 動作確認

以下のページを確認：

- [ ] 商品一覧ページ（/case/）
- [ ] 商品詳細ページ（複数確認）
- [ ] 画像のリンクをクリックして拡大表示を確認
- [ ] ブラウザのコンソールでMixed Contentエラーがないか確認

## 🔄 問題が発生した場合のロールバック

```bash
# バックアップから復元
mysql -u [ユーザー名] -p[パスワード] wp629555_wp8 < backup_full_[タイムスタンプ].sql

# または、wp_postsテーブルのみ復元
mysql -u [ユーザー名] -p[パスワード] wp629555_wp8 < backup_posts_[タイムスタンプ].sql
```

## 💡 追加の対策

### functions.phpでの対策（既に実装済み）

現在のテーマには以下のフィルターが実装されています：

```php
// Force all content to use protocol-relative URLs
function refine_jewelry_force_protocol_relative($content) {
    $content = str_replace(array('https://', 'http://'), '//', $content);
    return $content;
}
```

この関数により、出力時にプロトコル相対URLに変換されますが、データベースを統一することで、より確実な動作が期待できます。

## 📊 期待される結果

更新後：
- すべてのURLが`http://`で統一される
- リンクと画像のプロトコルが一致する
- Mixed Contentエラーが解消される
- サイトの表示が正常になる

## ⚠️ 注意事項

1. **本番環境で実行する前に、必ずステージング環境でテストしてください**
2. **営業時間外や訪問者が少ない時間帯に実行することを推奨**
3. **実行中はサイトをメンテナンスモードにすることを検討**
4. **シリアライズされたデータがある場合は、別途対応が必要**

## サポート

問題が発生した場合：
1. まずバックアップから復元
2. エラーメッセージを記録
3. 段階的な実行方法で再試行