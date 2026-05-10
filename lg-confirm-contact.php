<?php

/**
 * Plugin Name: LG Confirm Contact
 * Description: 画面遷移なしで「入力 → 確認 → 送信 → 完了画面」を実現する、LG流軽量コンタクトフォームプラグイン。
 * Version: 0.1.0
 * Author: Leon.C
 * Text Domain: lg-confirm-contact
 */

if (!defined('ABSPATH')) {
    exit;
}

// プラグインのバージョン
define('LGCC_VERSION', '0.1.0');

// プラグイン本体ファイルの絶対パス
define('LGCC_FILE', __FILE__);

// プラグインフォルダの絶対パス
define('LGCC_PATH', plugin_dir_path(__FILE__));

// プラグインフォルダのURL
define('LGCC_URL', plugin_dir_url(__FILE__));

// ショートコード登録ファイルを読み込む
require_once LGCC_PATH . 'includes/shortcode.php';

// アセット読み込みファイルを読み込む
require_once LGCC_PATH . 'includes/enqueue.php';

// バリデーション処理ファイルを読み込む
require_once LGCC_PATH . 'includes/validate.php';

// Ajax送信処理ファイルを読み込む
require_once LGCC_PATH . 'includes/ajax-handler.php';
