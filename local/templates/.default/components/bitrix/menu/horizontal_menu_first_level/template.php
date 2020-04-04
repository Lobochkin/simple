<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
if (empty($arResult)) {
    return;
}
?>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <?php
        foreach ($arResult as $arItem):?>
            <li>
                <a class="<?=$arItem['SELECTED']?'active' : ''?>" href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
