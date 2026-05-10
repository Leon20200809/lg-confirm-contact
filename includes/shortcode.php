<?php

/**
 * shortcode.php
 *
 * [lg_confirm_contact] を登録
 * 
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ショートコードの表示内容を返す。
 *
 * プラグインでは get_template_part() を使わず、
 * LGCC_PATH でテンプレートを明示的に読み込む。
 *
 * ob_start() でテンプレートの出力を一時保存し、
 * ob_get_clean() でHTML文字列として回収して return する。
 *
 * @return string フォームHTML
 */
function lgcc_render_contact_shortcode(): string
{
    ob_start();

    include LGCC_PATH . 'templates/form.php';

    return ob_get_clean();
}

/**
 * ショートコードを登録する
 */
function lgcc_register_contact_shortcode(): void
{
    add_shortcode('lg_confirm_contact', 'lgcc_render_contact_shortcode');
}
add_action('init', 'lgcc_register_contact_shortcode');
