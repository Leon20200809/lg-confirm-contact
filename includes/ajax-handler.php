<?php

/**
 * ajax-handler.php
 *
 * fetch 送信を受け取る入口。
 *
 * JavaScript から送られた通信を受け取り、JSONレスポンスを返すところまでを確認する。
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * お問い合わせフォーム送信のAjax処理
 *
 * @return void
 */
function lgcc_handle_contact_send(): void
{
    // nonce検証（なりすまし防止）
    $nonce = sanitize_text_field(wp_unslash($_POST['nonce'] ?? ''));
    if (!wp_verify_nonce($nonce, 'lgcc_contact_nonce')) {
        wp_send_json_error(
            [
                'message' => '不正なリクエストです。',
            ],
            403,
            JSON_UNESCAPED_UNICODE
        );
    }

    $form_data =  [
        'name'    => sanitize_text_field(wp_unslash($_POST['name'] ?? '')),
        'email'   => sanitize_email(wp_unslash($_POST['email'] ?? '')),
        'subject' => sanitize_text_field(wp_unslash($_POST['subject'] ?? '')),
        'message' => sanitize_textarea_field(wp_unslash($_POST['message'] ?? '')),
        'privacy' => sanitize_text_field(wp_unslash($_POST['privacy'] ?? '')),
    ];

    $errors = lgcc_validate_contact_data($form_data);

    if (!empty($errors)) {
        wp_send_json_error(
            [
                'message' => '入力内容を確認してください。',
                'errors'  => $errors,
            ],
            400,
            JSON_UNESCAPED_UNICODE
        );
    }

    wp_send_json_success(
        [
            'message'  => 'バリデーションを通過しました。',
            'received' => $form_data,
        ],
        200,
        JSON_UNESCAPED_UNICODE
    );
}

// ログイン中ユーザー用
add_action('wp_ajax_lgcc_send_contact', 'lgcc_handle_contact_send');

// 未ログインユーザー用
add_action('wp_ajax_nopriv_lgcc_send_contact', 'lgcc_handle_contact_send');
