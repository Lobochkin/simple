<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

?>
<section class="single_blog_area section_padding_30">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="row no-gutters">
                    <!-- Single Post -->
                    <div class="col-12 ">
                        <div class="single-post">
                            <!-- Post Thumb -->
                            <div class="post-thumb">
                                <img src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?= $arResult['DETAIL_PICTURE']['ALT'] ?>">
                                <div class="wrapper">
                                    <?php
                                    $arImage = [];
                                    foreach ($arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"] as $idImg):?>

                                        <a class="fancybox-thumb" rel="fancybox-thumb" href="http://lobochkin.ru<?= $idImg['SRC'] ?>" title="">
                                            <img class="photo-prev" src="http://lobochkin.ru<?= $idImg['SRC'] ?>" alt="" width="100"/>
                                        </a>

                                    <? endforeach; ?>
                                </div>
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <h2 class="post-headline"><?= $arResult['NAME'] ?></h2>
                                <?= $arResult['DETAIL_TEXT'] ?>
                                <div class="post-content--buttons">
                                    <span class="price">Цена: <?= $arResult['PROPERTIES']['PRICE']['VALUE'] ?></span>
                                    <div>
                                        <a href="#win1" class="btn contact-btn">Заказать</a>
                                        <a href="https://wa.me/79151365506?text=<?= urldecode("Добрый день, Татьяна!
                                Меня интересует {$arResult['NAME']}") ?>" class="btn contact-btn">Задать вопрос</a>
                                        <a href="#x" class="overlay" id="win1"></a>
                                        <div class="popup">
                                            <? $APPLICATION->IncludeComponent(
                                                "bitrix:main.feedback",
                                                ".default",
                                                array(
                                                    "EMAIL_TO" => "vova_lobochkin@mail.ru",
                                                    "EVENT_MESSAGE_ID" => array(
                                                        0 => "84",
                                                    ),
                                                    "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                                                    "REQUIRED_FIELDS" => array(
                                                        0 => "NAME",
                                                        1 => "MESSAGE",
                                                        2 => "CONTACTS",
                                                    ),
                                                    "USE_CAPTCHA" => "Y",
                                                    "COMPONENT_TEMPLATE" => ".default"
                                                ),
                                                false
                                            ); ?>
                                            <a class="close" title="Закрыть" href="#close"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

