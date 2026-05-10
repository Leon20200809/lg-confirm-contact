<?php

/**
 * form-confirm.php
 *
 * 確認画面テンプレート。
 * 入力画面で入力された内容を、送信前に確認するための画面。
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="lgcc-step lgcc-step--confirm" hidden>
    <div class="lgcc-form lgcc-confirm">
        <h3 class="lgcc-confirm__title">入力内容の確認</h3>

        <div class="lgcc-row">
            <p class="lgcc-row__label">お名前</p>
            <div class="lgcc-row__value js-lgcc-confirm-name"></div>
        </div>

        <div class="lgcc-row">
            <p class="lgcc-row__label">メールアドレス</p>
            <div class="lgcc-row__value js-lgcc-confirm-email"></div>
        </div>

        <div class="lgcc-row">
            <p class="lgcc-row__label">ご依頼・ご相談の種別</p>
            <div class="lgcc-row__value js-lgcc-confirm-subject"></div>
        </div>

        <div class="lgcc-row">
            <p class="lgcc-row__label">ご依頼・ご相談の詳細</p>
            <div class="lgcc-row__value js-lgcc-confirm-message"></div>
        </div>

        <div class="lgcc-row lgcc-row--privacy">
            <p class="lgcc-row__label">個人情報の取り扱い</p>
            <div class="lgcc-row__value js-lgcc-confirm-privacy"></div>
        </div>

        <div class="lgcc-actions lgcc-confirm__actions">
            <button type="button" class="lgcc-button js-lgcc-back-btn">
                入力に戻る
            </button>

            <button type="button" class="lgcc-button js-lgcc-submit-btn">
                送信する
            </button>
        </div>
    </div>
</div>