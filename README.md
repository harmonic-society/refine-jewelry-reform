# Refine Jewelry Reform - WordPressテーマ

## 概要
リフォームリペア専門店ジュエリー工房リファインのWordPressテーマです。
東京都池袋・大塚・埼玉県浦和・神奈川県横浜・若葉台・川崎のジュエリーリフォーム・リメイク・修理専門店のウェブサイトを構築します。

## 必要な環境
- Docker Desktop
- Docker Compose
- 8GB以上のメモリ
- 10GB以上の空きディスク容量

## セットアップ手順

### 1. 環境の起動
```bash
# セットアップスクリプトを実行
./setup.sh
```

### 2. WordPressの初期設定
ブラウザで http://localhost:8080 にアクセスし、以下の手順を実行：

1. 言語選択: 日本語を選択
2. サイト情報の入力:
   - サイトのタイトル: リフォームリペア専門店ジュエリー工房リファイン
   - ユーザー名: admin（推奨）
   - パスワード: 任意の強力なパスワード
   - メールアドレス: 管理者のメールアドレス

### 3. データのインポート

#### 自動インポート（推奨）
```bash
# 自動インポートスクリプトを実行
./import-data.sh
```

#### 手動インポート
1. WordPress管理画面にログイン（http://localhost:8080/wp-admin）
2. ツール → インポート → WordPress を選択
3. 「インポーターの実行」をクリック
4. ファイル選択で `/var/www/html/import.xml` を指定
5. 「ファイルをアップロードしてインポート」をクリック
6. 投稿者の割り当て: 「新規ユーザーを作成」を選択
7. 「実行」をクリック

## アクセスURL

- **WordPress サイト**: http://localhost:8080
- **WordPress 管理画面**: http://localhost:8080/wp-admin
- **phpMyAdmin**: http://localhost:8081
  - ユーザー名: root
  - パスワード: rootpassword

## ディレクトリ構成
```
refine-jewelry-reform/
├── WordPress.2025-09-07.xml    # WordPressバックアップファイル
├── docker-compose.yml          # Docker Compose設定
├── .env                        # 環境変数設定
├── setup.sh                    # セットアップスクリプト
├── import-data.sh              # データインポートスクリプト
├── wp-content/                 # WordPressコンテンツディレクトリ
└── README.md                   # このファイル
```

## よく使うコマンド

### コンテナの管理
```bash
# コンテナの起動
docker-compose up -d

# コンテナの停止
docker-compose down

# コンテナの再起動
docker-compose restart

# ログの確認
docker-compose logs -f

# コンテナの状態確認
docker-compose ps
```

### WordPressのWP-CLIコマンド
```bash
# プラグインリスト表示
docker exec refine-jewelry-wp wp plugin list

# テーマリスト表示
docker exec refine-jewelry-wp wp theme list

# キャッシュクリア
docker exec refine-jewelry-wp wp cache flush

# データベースの最適化
docker exec refine-jewelry-wp wp db optimize
```

## トラブルシューティング

### ポートが使用中の場合
.envファイルのポート番号を変更してください：
```
WORDPRESS_PORT=8082  # 8080から変更
PHPMYADMIN_PORT=8083  # 8081から変更
```

### メモリ不足エラーの場合
Docker Desktopの設定でメモリ割り当てを増やしてください：
1. Docker Desktop → Settings → Resources
2. Memory: 8GB以上に設定
3. Apply & Restart

### インポートエラーの場合
PHPの設定を調整：
```bash
docker exec refine-jewelry-wp bash -c "echo 'memory_limit = 1024M' >> /usr/local/etc/php/conf.d/custom.ini"
docker exec refine-jewelry-wp bash -c "echo 'max_execution_time = 1200' >> /usr/local/etc/php/conf.d/custom.ini"
docker-compose restart wordpress
```

## データベースのバックアップ
```bash
# バックアップの作成
docker exec refine-jewelry-db mysqldump -u wordpress -pwordpresspass wordpress > backup_$(date +%Y%m%d).sql

# バックアップからの復元
docker exec -i refine-jewelry-db mysql -u wordpress -pwordpresspass wordpress < backup_20250907.sql
```

## セキュリティ注意事項
- 本番環境では必ず強力なパスワードを使用してください
- .envファイルをGitにコミットしないでください
- 定期的にバックアップを取得してください

## サポート
問題が発生した場合は、以下を確認してください：
1. Dockerが正常に動作しているか
2. ポートが他のアプリケーションで使用されていないか
3. 十分なディスク容量があるか