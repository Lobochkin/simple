<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
if (empty($arResult)) {
    return;
}
?>
<div class="collapse navbar-collapse justify-content-center" id="yummyfood-nav">
    <ul class="navbar-nav" id="yummy-nav">
        <?php
        foreach ($arResult as $arItem):?>
            <li class="nav-item <?=$arItem['SELECTED']?'active' : ''?>">
                <a class="nav-link" href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?><?=$arItem['SELECTED']?'<span class="sr-only">(current)</span>' : ''?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>


