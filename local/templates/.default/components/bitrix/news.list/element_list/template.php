<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

?>
<section class="archive-area section_padding_80">
    <div class="container">
        <div class="row">
            <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
                <?= $arResult["NAV_STRING"] ?><br/>
            <? endif; ?>
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <p class="news-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <!-- Single Post -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="single-post wow fadeInUp" data-wow-delay="0.1s">
                            <!-- Post Thumb -->
                            <div class="post-thumb">
                                <img src="<?= $arItem['DETAIL_PICTURE']['SRC'] ?>" alt="<?= $arItem['NAME'] ?>">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>">
                                    <h4 class="post-headline"><?= $arItem['NAME'] ?></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </p>
            <? endforeach; ?>
            <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
                <br/><?= $arResult["NAV_STRING"] ?>
            <? endif; ?>
        </div>
    </div>
</section>
