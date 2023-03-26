<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<section class="welcome-post-sliders owl-carousel">
    <? foreach ($arResult['PICTURES'] as $idPictures => $item): ?>
        <?
        $file = CFile::ResizeImageGet(
            $idPictures,
            array("width" => 400, "height" => 400),
            BX_RESIZE_IMAGE_EXACT,
            true
        );
        ?>
        <div class="welcome-single-slide">
            <!-- Post Thumb -->
            <img src="<?= $file['src'] ?>" alt="">
            <!-- Overlay Text -->
            <a href="<?= $item['DETAIL_PAGE_URL'] ?>/">
                <div class="project_title">
                    <!--            <div class="post-date-commnents d-flex">-->
                    <!--                <a href="#">May 19, 2017</a>-->
                    <!--                <a href="#">5 Comment</a>-->
                    <!--            </div>-->
                    <h2><?= $item['NAME'] ?></h2>

                </div>
            </a>
        </div>
    <? endforeach; ?>
</section>

<script>
    $(document).ready(function() {
        'use strict';

        if ($.fn.owlCarousel) {
            // :: 1.0 Welcome Post Slider Active Code
            $(".welcome-post-sliders").owlCarousel({
                items: <?=$arParams['COUNT_ITEMS_1200']?>,
                loop: true,
                autoplay: true,
                smartSpeed: <?=$arParams['SMART_SPEED']?>,
                autoplayTimeout: <?=$arParams['AUTOPLAY_TIMEOUT']?>,
                margin: 10,
                nav: false,
                navText: ['', ''],
                responsive: {
                    320: {
                        items: <?=$arParams['COUNT_ITEMS_320']?>
                    },
                    576: {
                        items: <?=$arParams['COUNT_ITEMS_576']?>
                    },
                    992: {
                        items: <?=$arParams['COUNT_ITEMS_992']?>
                    },
                    1200: {
                        items: <?=$arParams['COUNT_ITEMS_1200']?>
                    }
                }
            })
        }
    });
</script>