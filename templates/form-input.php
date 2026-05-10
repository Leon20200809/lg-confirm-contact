<?php

/**
 * form-input.php
 *
 * 入力画面テンプレート。
 * ユーザーが問い合わせ内容を入力する最初の画面。
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="lgcc-step lgcc-step--input">
    <form class="lgcc-form" action="" method="post">
        <div class="lgcc-row">
            <label class="lgcc-row__label" for="lgcc-name">お名前</label>
            <input
                class="lgcc-row__control"
                type="text"
                id="lgcc-name"
                name="name"
                placeholder="お名前"
                required>
        </div>

        <div class="lgcc-row">
            <label class="lgcc-row__label" for="lgcc-email">メールアドレス</label>
            <input
                class="lgcc-row__control"
                type="email"
                id="lgcc-email"
                name="email"
                placeholder="メールアドレス"
                required>
        </div>

        <div class="lgcc-row">
            <p class="lgcc-row__label">ご依頼・ご相談の種別</p>

            <div class="lgcc-row__control lgcc-radio-group">
                <label class="lgcc-radio-option">
                    <input type="radio" name="subject" value="WEBページの相談・依頼" required>
                    <span>Webサイト制作・改修のご相談</span>
                </label>

                <label class="lgcc-radio-option">
                    <input type="radio" name="subject" value="開発の相談">
                    <span>業務システム開発のご相談</span>
                </label>
            </div>
        </div>

        <div class="lgcc-row">
            <label class="lgcc-row__label" for="lgcc-message">ご依頼・ご相談の詳細</label>
            <textarea
                class="lgcc-row__control"
                id="lgcc-message"
                name="message"
                placeholder="ご希望内容・お困りごと・ご予算などをご記入ください。"
                required></textarea>
        </div>

        <div class="lgcc-row lgcc-row--privacy">
            <p class="lgcc-row__label">個人情報の取り扱い</p>

            <div class="lgcc-row__control">
                <label class="lgcc-privacy">
                    <input type="checkbox" name="privacy" value="1" required>
                    <span>
                        <a href="#" class="lgcc-privacy__link">プライバシーポリシー</a>
                        に同意する
                    </span>
                </label>
            </div>
        </div>

        <div class="lgcc-actions">
            <button type="button" class="lgcc-button js-lgcc-confirm-btn">
                確認する
            </button>
        </div>
    </form>
</div>