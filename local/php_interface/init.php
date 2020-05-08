<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//Константы
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/const.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/const.php");
}
//Функции
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/functions.php")) {
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/include/functions.php");
}

require '/var/www/bitrix/data/www/lobochkin.ru/vendor/autoload.php';
ini_set("memory_limit", "512M");



