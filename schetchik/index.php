<?

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?php

/*Bitrix\Main\Page\Asset::getInstance()->addString("<link href=\"/schetchik/css/style.css\" type=\"text/css\" rel=\"stylesheet\">");*/
Bitrix\Main\Page\Asset::getInstance()->addString("<link href=\"/schetchik/build/css/app.css\" rel=\"preload\" as=\"style\">");
Bitrix\Main\Page\Asset::getInstance()->addString("<link href=\"/schetchik/build/js/app.js\" rel=\"preload\" as=\"script\">");
Bitrix\Main\Page\Asset::getInstance()->addString("<link href=\"/schetchik/build/js/chunk-vendors.js\" rel=\"preload\" as=\"script\">");
Bitrix\Main\Page\Asset::getInstance()->addString("<link href=\"/schetchik/build/css/app.css\" rel=\"stylesheet\">");
?>
<div class="container" id="app"></div>
<script src=/schetchik/build/js/chunk-vendors.js></script>
<script src=/schetchik/build/js/app.js></script>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>

