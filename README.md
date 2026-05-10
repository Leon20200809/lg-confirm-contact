# LG Confirm Contact

画面遷移なしで「入力 → 確認 → 送信 → 完了画面」を実現する、LG流軽量WordPressお問い合わせフォームプラグインです。

MVPの役割分担
ファイル 役割
lg-confirm-contact.php プラグイン本体。定数定義と各ファイル読み込み
includes/enqueue.php CSS/JS読み込み、ajaxurl と nonce をJSへ渡す
includes/shortcode.php [lg_confirm_contact] でフォームを表示
includes/ajax-handler.php fetch送信を受け取る入口
includes/validate.php 入力値チェック
includes/mailer.php wp_mail() で管理者宛に送信
templates/form.php フォーム全体の親テンプレート
templates/form-input.php 入力画面
templates/form-confirm.php 確認画面
templates/form-thanks.php 完了画面
assets/js/lg-confirm-contact.js 入力→確認→送信→完了の画面制御
assets/css/lg-confirm-contact.css 最低限の見た目
初回MVPでやること
[lg_confirm_contact]
↓
入力画面表示
↓
確認する
↓
確認画面表示
↓
送信する
↓
fetchでadmin-ajax.phpへPOST
↓
PHP側でvalidate
↓
wp_mailで管理者メールへ送信
↓
完了画面表示
初回MVPでやらないこと

ここは闇を広げすぎない。

管理画面
自動返信メール
ログ保存
REST API化
複数フォーム対応
reCAPTCHA
ファイル添付
確認画面の細かいカスタマイズ
ブロックエディタ対応

まずは1フォーム・1ショートコード・1送信処理で勝つ。

命名ルール
プラグイン名：LG Confirm Contact
フォルダ名：lg-confirm-contact
ショートコード：[lg_confirm_contact]
関数prefix：lgcc\_
JSグローバル変数：window.lgccContact
Ajax action：lgcc_send_contact
nonce action：lgcc_contact_nonce
最初のコミット単位

まずはこの順で刻むのがいい。

1. プラグイン基本構成を作成
2. ショートコードで仮表示
3. フォームテンプレートを追加
4. JSで入力→確認→戻るを実装
5. fetch送信の土台を追加
6. PHP側でAjax受信とバリデーション
7. wp_mail送信と完了画面表示
   最初のREADME見出し案
