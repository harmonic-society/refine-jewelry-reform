# デプロイメントガイド

## 概要
このWordPressテーマはGitHub Actionsを使用して自動的に本番環境にデプロイされます。

## 自動デプロイ
mainブランチにプッシュすると、GitHub Actionsが自動的に本番サーバーにデプロイします。

### デプロイ先
- サーバー: `refine-jewelry-reform.com`
- パス: `/home/wp629555/refine-jewelry-reform.com/public_html/wp-content/themes/refine-jewelry-reform`

## 必要なGitHub Secrets
以下のSecretsをGitHubリポジトリに設定する必要があります：

- `SSH_PRIVATE_KEY`: デプロイ用のSSH秘密鍵
- `HOST`: サーバーのホスト名
- `USERNAME`: SSHユーザー名
- `SSH_PORT`: SSHポート番号（デフォルト: 10022）

## 手動デプロイ
必要に応じて、以下の手順で手動デプロイも可能です：

```bash
# 1. サーバーにSSH接続
ssh -p 10022 username@host

# 2. テーマディレクトリに移動
cd /home/wp629555/refine-jewelry-reform.com/public_html/wp-content/themes/refine-jewelry-reform

# 3. 最新の変更を取得
git pull origin main
```

## XMLデータのインポート

### 初回セットアップ
1. WordPressにログイン
2. ツール → インポート → WordPress インポーターをインストール
3. `WordPress.2025-09-07.xml`ファイルをアップロード
4. インポートを実行

### PHPスクリプトを使用したインポート
```bash
# WordPressのwp-loadを読み込んでインポート
php import-xml-data.php
```

## テーマの有効化
1. WordPress管理画面にログイン
2. 外観 → テーマ
3. 「Refine Jewelry Reform」テーマを有効化

## カスタム投稿タイプ
このテーマは以下のカスタム投稿タイプを使用します：

- **products**: リフォーム実例
- **voice**: お客様の声

## 必要なプラグイン
特に必須のプラグインはありませんが、以下を推奨：

- Contact Form 7（お問い合わせフォーム用）
- All in One SEO（SEO対策用）

## トラブルシューティング

### デプロイが失敗する場合
1. GitHub Secretsが正しく設定されているか確認
2. SSH鍵が正しいか確認
3. サーバーの接続情報を確認

### テーマが表示されない場合
1. テーマディレクトリのパーミッションを確認（755推奨）
2. functions.phpにエラーがないか確認
3. WordPressのデバッグモードを有効にしてエラーを確認

## 開発環境
ローカル開発には以下を使用：

```bash
# Dockerを使用したローカル環境の起動
docker-compose up -d

# テーマファイルの監視（必要に応じて）
npm run watch
```

## サポート
問題が発生した場合は、GitHubのIssuesで報告してください。