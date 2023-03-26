<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="mfeedback">
    <? if (!empty($arResult["ERROR_MESSAGE"])) {
        foreach ($arResult["ERROR_MESSAGE"] as $v) {
            ShowError($v);
        }
    }
    if (strlen($arResult["OK_MESSAGE"]) > 0) {
        ?>
        <div class="mf-ok-text"><?= $arResult["OK_MESSAGE"] ?></div>
        <script defer>
            setTimeout(() => {
                $('.mf-ok-text').slideToggle();
            }, 5000);
        </script>
        <?
    }
    ?>

    <form action="<?= POST_FORM_ACTION_URI ?>" id="feedBack" method="POST">
        <?= bitrix_sessid_post() ?>
        <div class="form-group">
            <input class="form-control" type="text" name="user_name" value="<?= $arResult["AUTHOR_NAME"] ?>" placeholder="<?= GetMessage("MFT_NAME") ?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="contact-text" name="contacts" value="<?= $arResult["CONTACTS"] ?>" placeholder="Ваша почта или телефон для связи">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="MESSAGE" id="message" cols="30" rows="10" placeholder="Ваше сообщение"><?= $arResult["MESSAGE"] ?></textarea>
        </div>
        <? if ($arParams["USE_CAPTCHA"] == "Y"): ?>
            <div class="mf-captcha">
                <div class="mf-text"><?= GetMessage("MFT_CAPTCHA") ?></div>
                <input type="hidden" name="captcha_sid" value="<?= $arResult["capCode"] ?>">
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["capCode"] ?>" width="180" height="40" alt="CAPTCHA">
                <div class="mf-text"><?= GetMessage("MFT_CAPTCHA_CODE") ?><span class="mf-req">*</span></div>
                <input type="text" name="captcha_word" size="30" maxlength="50" value="">
            </div>
        <? endif; ?>
        <input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
        <input type="submit" name="submit" class="btn contact-btn" value="<?= GetMessage("MFT_SUBMIT") ?>">
    </form>
</div>
