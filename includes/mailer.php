<?php

/**
 * mailer.php
 *
 * お問い合わせフォームのメール送信を担当する。
 * MVPでは、WordPress管理者メールアドレス宛に通知メールを送る。
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * 管理者宛にお問い合わせ通知メールを送信する
 *
 * @param array $form_data フォーム入力値
 * @return bool メール送信に成功したら true
 */
function lgcc_send_admin_mail(array $form_data): bool
{
    $name    = sanitize_text_field($form_data['name'] ?? '');
    $email   = sanitize_email($form_data['email'] ?? '');
    $subject = sanitize_text_field($form_data['subject'] ?? '');
    $message = sanitize_textarea_field($form_data['message'] ?? '');

    // WordPress管理画面で設定されている管理者メールアドレス
    $to = get_option('admin_email');

    $mail_subject = '【お問い合わせ】' . ($name !== '' ? $name . '様より' : '新規お問い合わせ');

    $body  = "お問い合わせがありました。\n\n";
    $body .= "【お名前】\n";
    $body .= ($name !== '' ? $name : '未入力') . "\n\n";

    $body .= "【メールアドレス】\n";
    $body .= ($email !== '' ? $email : '未入力') . "\n\n";

    $body .= "【ご依頼・ご相談の種別】\n";
    $body .= ($subject !== '' ? $subject : '未選択') . "\n\n";

    $body .= "【ご依頼・ご相談の詳細】\n";
    $body .= ($message !== '' ? $message : '未入力') . "\n";

    $headers = [];

    if ($email !== '') {
        $headers[] = 'Reply-To: ' . $email;
    }

    return wp_mail($to, $mail_subject, $body, $headers);
}
