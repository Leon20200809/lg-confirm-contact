<?php

/**
 * validate.php
 *
 * お問い合わせフォームの入力値を検証する。
 * MVPでは、必須項目とメール形式だけを確認する。
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * お問い合わせフォームの入力値を検証する
 *
 * @param array $form_data フォーム入力値
 * @return array<string, string> エラー配列
 */
function lgcc_validate_contact_data(array $form_data): array
{
    $errors = [];

    $name    = trim((string) ($form_data['name'] ?? ''));
    $email   = trim((string) ($form_data['email'] ?? ''));
    $subject = trim((string) ($form_data['subject'] ?? ''));
    $message = trim((string) ($form_data['message'] ?? ''));
    $privacy = (string) ($form_data['privacy'] ?? '');

    if ($name === '') {
        $errors['name'] = 'お名前を入力してください。';
    }

    if ($email === '') {
        $errors['email'] = 'メールアドレスを入力してください。';
    } elseif (!is_email($email)) {
        $errors['email'] = '正しいメールアドレスを入力してください。';
    }

    if ($subject === '') {
        $errors['subject'] = 'ご相談の種別を選択してください。';
    }

    if ($message === '') {
        $errors['message'] = 'ご相談内容を入力してください。';
    } elseif (mb_strlen($message) > 400) {
        $errors['message'] = 'ご相談内容は400文字以内で入力してください。';
    }

    if ($privacy !== '1') {
        $errors['privacy'] = 'プライバシーポリシーへの同意が必要です。';
    }

    return $errors;
}
