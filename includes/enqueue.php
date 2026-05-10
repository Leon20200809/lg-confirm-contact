<?php

/**
 * enqueue.php
 *
 * LG Confirm Contact で使用するCSS・JSを読み込む。
 * 
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * フロント側のCSS・JSを読み込む
 *
 * @return void
 */
function lgcc_enqueue_assets(): void
{
    wp_enqueue_style(
        'lgcc-contact-style',
        LGCC_URL . 'assets/css/lg-confirm-contact.css',
        [],
        LGCC_VERSION
    );

    wp_enqueue_script(
        'lgcc-contact-script',
        LGCC_URL . 'assets/js/lg-confirm-contact.js',
        [],
        LGCC_VERSION,
        true
    );

    // 1.対象のJSスクリプト 2.JS 側で使うオブジェクト名
    wp_localize_script(
        'lgcc-contact-script',
        'lgccContact',
        [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('lgcc_contact_nonce'),
        ]
    );
}

add_action('wp_enqueue_scripts', 'lgcc_enqueue_assets');
