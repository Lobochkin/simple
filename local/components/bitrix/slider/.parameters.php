<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
    return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(array("-"=>" "));

$arIBlocks=array();
$db_iblock = CIBlock::GetList(array("SORT"=>"ASC"), array("TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
    $arIBlocks[$arRes["ID"]] = "[".$arRes["ID"]."] ".$arRes["NAME"];

$arProperty_LNS = array();
$rsProp = CIBlockProperty::GetList(array("sort"=>"asc", "name"=>"asc"), array("ACTIVE"=>"Y", "IBLOCK_ID"=>($arCurrentValues["IBLOCK_ID"])));
while ($arr=$rsProp->Fetch())
{
    $arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
    if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S")))
    {
        $arProperty_LNS[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
    }
}

$arComponentParameters = array(
    "PARAMETERS" => array(
        "IBLOCK_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => "Тип инфоблока",
            "TYPE" => "LIST",
            "VALUES" => $arTypesEx,
            "DEFAULT" => "news",
            "REFRESH" => "Y",
        ),
        "IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => "Инфобок",
            "TYPE" => "LIST",
            "VALUES" => $arIBlocks,
            "DEFAULT" => '={$_REQUEST["ID"]}',
            "ADDITIONAL_VALUES" => "Y",
            "REFRESH" => "Y",
        ),
        "PROPERTY_CODE" => array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Укажите свойство по которому будет фильтроваться товары для слайдера",
            "TYPE" => "LIST",
            "MULTIPLE" => "N",
            "VALUES" => $arProperty_LNS,
            "ADDITIONAL_VALUES" => "Y",
        ),
        "COUNT_ITEMS_1200" => array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Укажите количество фото на странице шириной от 1200px",
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "ADDITIONAL_VALUES" => "Y",
            "DEFAULT" => "6",
            "COLS" => 10
        ),
        "COUNT_ITEMS_992" => array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Укажите количество фото на странице шириной от 992px",
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "ADDITIONAL_VALUES" => "Y",
            "DEFAULT" => "4",
            "COLS" => 10
        ),
        "COUNT_ITEMS_576" => array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Укажите количество фото на странице шириной от 576px",
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "ADDITIONAL_VALUES" => "Y",
            "DEFAULT" => "2",
            "COLS" => 10
        ),
        "COUNT_ITEMS_320" => array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Укажите количество фото на странице шириной от 320px",
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "ADDITIONAL_VALUES" => "Y",
            "DEFAULT" => "1",
            "COLS" => 10
        ),
        "SMART_SPEED" => array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Укажите скорость прокрутки в миллисекундах (1сек = 1000мс)",
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "ADDITIONAL_VALUES" => "Y",
            "DEFAULT" => "1500",
        ),
        "AUTOPLAY_TIMEOUT" => array(
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Время смены слайда в миллисекундах (1сек = 1000мс)",
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "ADDITIONAL_VALUES" => "Y",
            "DEFAULT" => "2000",
        ),
    ),
);