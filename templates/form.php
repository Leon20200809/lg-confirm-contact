<?php

/**
 * form.php
 *
 * LG Confirm Contact のフォーム全体テンプレート。
 * 入力・確認・完了の3画面をまとめて読み込む。
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<section id="lgcc-contact" class="lgcc-contact">
    <div class="lgcc-contact__inner">
        <h2 class="lgcc-contact__title">Contact</h2>

        <!-- 入力ブロック -->
        <?php include LGCC_PATH . 'templates/form-input.php'; ?>

        <!-- 確認ブロック -->
        <?php include LGCC_PATH . 'templates/form-confirm.php'; ?>

        <!-- サンクスブロック -->
        <?php include LGCC_PATH . 'templates/form-thanks.php'; ?>
    </div>
</section>