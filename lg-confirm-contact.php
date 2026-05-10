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

/**
 * ------------------------------------------------------------
 * LG Confirm Contact : Main Plugin File
 * ------------------------------------------------------------
 * 目的：
 *   - WordPressにプラグインとして認識させる
 *   - プラグイン内で使う基本定数を定義する
 *   - MVPでは、まず「有効化できる状態」までを勝利条件にする
 * ------------------------------------------------------------
 */

// プラグインのバージョン
define('LGCC_VERSION', '0.1.0');

// プラグイン本体ファイルの絶対パス
define('LGCC_FILE', __FILE__);

// プラグインフォルダの絶対パス
define('LGCC_PATH', plugin_dir_path(__FILE__));

// プラグインフォルダのURL
define('LGCC_URL', plugin_dir_url(__FILE__));
