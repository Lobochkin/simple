<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>

<section class="categories_area clearfix" id="about">
    <div class="container">
        <div class="row">
            <?php foreach ($arResult['SECTIONS'] as $item): ?>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="single_catagory wow fadeInUp blackout" data-wow-delay=".3s">
                        <img src="<?= $item['PICTURE']['SRC'] ?>" alt="<?=$item['NAME']?>">
                        <div class="catagory-title">
                            <a href="<?=$item['SECTION_PAGE_URL']?>">
                                <h5 class="button"><?=$item['NAME']?></h5>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
