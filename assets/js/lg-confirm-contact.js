/**
 * lg-confirm-contact.js
 *
 * LG Confirm Contact のUI制御。
 *
 * MVPの目的：
 *   - 入力画面から確認画面へ切り替える
 *   - 入力内容を確認画面に表示する
 *   - 確認画面から入力画面へ戻れるようにする
 *
 * 今後実装すること：
 *   - FormData の作成
 *   - fetch による admin-ajax.php への送信
 *   - nonce の送信
 *   - PHP側バリデーション結果の表示
 *   - 送信成功後のサンクス画面表示
 *   - 送信中ボタンの disabled / loading 表示
 */

document.addEventListener("DOMContentLoaded", () => {
  // ===== 要素取得 =====

  const contactSection = document.getElementById("lgcc-contact");
  if (!contactSection) return;

  const form = contactSection.querySelector(".lgcc-form");

  const inputStep = contactSection.querySelector(".lgcc-step--input");
  const confirmStep = contactSection.querySelector(".lgcc-step--confirm");
  const thanksStep = contactSection.querySelector(".lgcc-step--thanks");

  const confirmBtn = contactSection.querySelector(".js-lgcc-confirm-btn");
  const backBtn = contactSection.querySelector(".js-lgcc-back-btn");
  const submitBtn = contactSection.querySelector(".js-lgcc-submit-btn");

  // 確認画面の表示先
  const outName = contactSection.querySelector(".js-lgcc-confirm-name");
  const outEmail = contactSection.querySelector(".js-lgcc-confirm-email");
  const outSubject = contactSection.querySelector(".js-lgcc-confirm-subject");
  const outMessage = contactSection.querySelector(".js-lgcc-confirm-message");
  const outPrivacy = contactSection.querySelector(".js-lgcc-confirm-privacy");

  // 必須要素がなければ処理しない
  if (!form || !inputStep || !confirmStep || !confirmBtn || !backBtn) {
    return;
  }

  // ===== ユーティリティ =====

  /**
   * ラジオボタンなど、チェックされている値を取得する。
   *
   * @param {string} name
   * @returns {string}
   */
  const getCheckedValue = (name) => {
    const checked = form.querySelector(`input[name="${name}"]:checked`);
    return checked ? checked.value : "";
  };

  /**
   * フォーム入力値をまとめて取得する。
   *
   * @returns {{
   *   name: string,
   *   email: string,
   *   subject: string,
   *   message: string,
   *   privacy: string
   * }}
   */
  const getFormValues = () => {
    return {
      name: form.querySelector('input[name="name"]')?.value ?? "",
      email: form.querySelector('input[name="email"]')?.value ?? "",
      subject: getCheckedValue("subject"),
      message: form.querySelector('textarea[name="message"]')?.value ?? "",
      privacy: form.querySelector('input[name="privacy"]')?.checked ? "1" : ""
    };
  };

  /**
   * HTMLとして表示しても危険な文字を無害化する。
   * XSS対策として、確認画面へ出す前に必ず通す。
   *
   * @param {string} value
   * @returns {string}
   */
  const escapeHtml = (value) => {
    return String(value)
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")
      .replaceAll('"', "&quot;")
      .replaceAll("'", "&#039;");
  };

  /**
   * 改行を <br> に変換して確認画面に表示する。
   *
   * @param {string} value
   * @returns {string}
   */
  const nl2br = (value) => {
    return escapeHtml(value).replaceAll("\n", "<br>");
  };

  /**
   * 指定した要素までスクロールする。
   *
   * 今後の改善候補：
   *   - 固定ヘッダーがある場合は offset 調整する
   *
   * @param {HTMLElement} element
   */
  const scrollToSection = (element) => {
    window.scrollTo({
      top: element.offsetTop,
      behavior: "smooth"
    });
  };

  const showServerErrors = (data) => {
    const errorSummary = contactSection.querySelector(".js-lgcc-error-summary");

    const errorFields = {
      name: contactSection.querySelector(".js-lgcc-error-name"),
      email: contactSection.querySelector(".js-lgcc-error-email"),
      subject: contactSection.querySelector(".js-lgcc-error-subject"),
      message: contactSection.querySelector(".js-lgcc-error-message"),
      privacy: contactSection.querySelector(".js-lgcc-error-privacy")
    };

    if (errorSummary) {
      errorSummary.textContent =
        data?.message || "入力内容を確認してください。";
      errorSummary.hidden = false;
    }

    const errors = data?.errors || {};

    Object.entries(errorFields).forEach(([fieldName, element]) => {
      if (!element) return;

      const errorMessage = errors[fieldName];

      if (errorMessage) {
        element.textContent = errorMessage;
        element.hidden = false;
        return;
      }

      element.textContent = "";
      element.hidden = true;
    });
  };

  const clearServerErrors = () => {
    const errorSummary = contactSection.querySelector(".js-lgcc-error-summary");

    const errorMessages = contactSection.querySelectorAll(
      ".lgcc-error-message"
    );

    if (errorSummary) {
      errorSummary.textContent = "";
      errorSummary.hidden = true;
    }

    errorMessages.forEach((element) => {
      element.textContent = "";
      element.hidden = true;
    });
  };

  // ===== 確認画面へ進む =====

  confirmBtn.addEventListener("click", () => {
    clearServerErrors();
    // HTMLの required / type="email" などの標準バリデーションを使う
    if (!form.checkValidity()) {
      form.reportValidity();
      return;
    }

    const formValues = getFormValues();

    // 確認画面へ入力内容を反映する
    if (outName) outName.innerHTML = escapeHtml(formValues.name);
    if (outEmail) outEmail.innerHTML = escapeHtml(formValues.email);
    if (outSubject) outSubject.innerHTML = escapeHtml(formValues.subject);
    if (outMessage) outMessage.innerHTML = nl2br(formValues.message);
    if (outPrivacy) {
      outPrivacy.innerHTML = formValues.privacy === "1" ? "同意済み" : "未同意";
    }

    // 入力画面を隠して、確認画面を表示する
    inputStep.hidden = true;
    confirmStep.hidden = false;

    scrollToSection(contactSection);
  });

  // ===== 入力画面へ戻る =====

  backBtn.addEventListener("click", () => {
    confirmStep.hidden = true;
    inputStep.hidden = false;

    scrollToSection(contactSection);
  });

  // ===== 送信ボタン：送信処理 =====
  submitBtn.addEventListener("click", async () => {
    // 1. 連打防止
    if (submitBtn.disabled) return;

    // 2. getFormValues() で入力値取得
    const formValues = getFormValues();

    // 3. FormData を作成
    const formData = new FormData();

    // 4. action / nonce / name / email / subject / message / privacy を詰める
    formData.append("action", "lgcc_send_contact");
    formData.append("nonce", window.lgccContact.nonce);

    // ユーザー入力詰め込み
    formData.append("name", formValues.name);
    formData.append("email", formValues.email);
    formData.append("subject", formValues.subject);
    formData.append("message", formValues.message);
    formData.append("privacy", formValues.privacy);

    // 5. fetch(window.lgccContact.ajaxurl, { method: "POST", body: formData })
    try {
      const response = await fetch(window.lgccContact.ajaxurl, {
        method: "POST",
        body: formData
      });

      const result = await response.json();

      if (!result.success) {
        confirmStep.hidden = true;
        inputStep.hidden = false;

        showServerErrors(result.data);

        scrollToSection(contactSection);

        return;
      }

      console.log("成功", result);
    } catch (error) {
      console.error(error);
    }

    //     6. response.json() を取得
    //     7. success なら confirmStep を hidden、thanksStep を表示
    //     8. error ならメッセージ表示
  });
  //
  // 現時点では submitBtn / thanksStep は未使用。
  // fetch送信は PHP側 ajax-handler.php 実装後に接続する。
});
