# LG Confirm Contact

LG Confirm Contact は、画面遷移なしで  
「入力 → 確認 → 送信 → 完了画面」  
を実現する、LG流軽量WordPressお問い合わせフォームプラグインです。

## 特徴

- ショートコードでフォームを設置
- 入力画面、確認画面、完了画面を表示
- JavaScript の `fetch()` で非同期送信
- WordPress の `admin-ajax.php` で送信データを受信
- nonce によるなりすまし防止
- サーバー側バリデーション
- バリデーションエラーを画面に表示
- `wp_mail()` による管理者宛メール送信
- 親テーマのデザインを邪魔しない最小CSS

## 使い方

固定ページや投稿に以下のショートコードを記述します。

```txt
[lg_confirm_contact]
```

## 現在のMVP機能

現在のMVPでは、以下の流れが動作します。

```txt
入力
↓
確認
↓
fetch送信
↓
nonce検証
↓
サーバー側バリデーション
↓
wp_mail送信
↓
完了画面表示
```

## ディレクトリ構成

```txt
lg-confirm-contact/
├─ lg-confirm-contact.php
├─ README.md
├─ assets/
│  ├─ css/
│  │  └─ lg-confirm-contact.css
│  └─ js/
│     └─ lg-confirm-contact.js
├─ includes/
│  ├─ ajax-handler.php
│  ├─ enqueue.php
│  ├─ mailer.php
│  ├─ shortcode.php
│  └─ validate.php
└─ templates/
   ├─ form.php
   ├─ form-input.php
   ├─ form-confirm.php
   └─ form-thanks.php
```

## 開発方針

このプラグインは、Contact Form 7 のような多機能フォームビルダーではなく、  
小規模サイトやLPで使いやすい「確認画面つき軽量フォーム」を目指しています。

また、WordPress / PHP / JavaScript / fetch / DevTools の学習を兼ねたプロジェクトです。

## CSS方針

親テーマのフォント・色・世界観はできるだけ尊重します。

プラグイン側では、フォームとして破綻しない最低限の骨格だけを整えます。

## 今後の実装候補

- 自動返信メール
- 送信先メールアドレス設定
- 管理画面設定
- REST API版への拡張
- エラー表示UIの改善
- JavaScriptの責務分離
- CSSの調整
- スパム対策強化

## 開発ステータス

MVP完成。

ローカル環境では、Local の Mailpit を使って `wp_mail()` の送信確認まで完了しています。
