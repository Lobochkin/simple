<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @global CMain $APPLICATION
 */

//global $APPLICATION;

if (!empty($arResult)) {

    $strReturn = '<div class="breadcumb-nav"><div class="container"><div class="row"><div class="col-12"><nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a></li>';
    foreach ($arResult as $key => $item) {
        if (count($arResult) === ++$key) {
            $strReturn .= '<li class="breadcrumb-item active" aria-current="page">' . $item['TITLE'] . '</li>';
        } else {
            $strReturn .= '<li class="breadcrumb-item"><a href="' . $item['LINK'] . '">' . $item['TITLE'] . '</a></li>';
        }
    }
    $strReturn .= '</ol></nav></div></div></div></div>';
    return $strReturn;
}