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
//dump($arResult);
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
                                <div class="wrapper"?>
                                <?php
                                $arImage = [];
                                foreach ($arResult["DISPLAY_PROPERTIES"]["PHOTOS"]["FILE_VALUE"] as $idImg):?>

                                    <a class="fancybox-thumb" rel="fancybox-thumb" href="http://lobochkin.ru<?=$idImg['SRC']?>" title="">
                                        <img class="photo-prev" src="http://lobochkin.ru<?=$idImg['SRC']?>" alt=""  width="100"/>
                                    </a>
<!--                                    <img src="--><?//= CFile::GetFileArray($idImg)['SRC']?><!--" width="100" alt="Фотография торта"/>-->
                                <? endforeach; ?>
                                </div>
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <h2 class="post-headline"><?= $arResult['NAME'] ?></h2>
                                <p><?= $arResult['DETAIL_TEXT'] ?></p>
                                <span class="price">Цена: <?=$arResult['PROPERTIES']['PRICE']['VALUE']?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
