<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php
use Bitrix\Main\Page\Asset;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $APPLICATION->ShowHead(); ?>
    <title><?$APPLICATION->ShowTitle()?></title>
    <!-- Bootstrap Core CSS -->
    <?php Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/bootstrap.min.css'); ?>
    <!-- Custom CSS -->
    <?php Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/business-casual.css'); ?>
    <?php Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/jquery.js'); ?>
    <?php Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/bootstrap.min.js'); ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]-->
    <?php Asset::getInstance()->addJs('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'); ?>
    <?php Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'); ?>
    <?php Asset::getInstance()->addString('<meta http-equiv="X-UA-Compatible" content="IE=edge">'); ?>
    <?php Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1">'); ?>
    <!-- Fonts -->
    <?php Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">'); ?>
    <?php Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">'); ?>
</head>
<body>
<?php $APPLICATION->ShowPanel(); ?>
<div class="brand">Business Casual</div>
<div class="address-bar">3481 Melrose Place | Beverly Hills, CA 90210 | 123.456.7890</div>

<!-- Navigation -->
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
            <a class="navbar-brand" href="index.html">Business Casual</a>
        </div>
        <?$APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel", Array(
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"MAX_LEVEL" => "2",	// Уровень вложенности меню
		"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
			0 => "",
		),
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_TYPE" => "A",	// Тип кеширования
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"ROOT_MENU_TYPE" => "main",	// Тип меню для первого уровня
		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	),
	false
);?>
        <!-- Collect the nav links, forms, and other content for toggling -->
      <!--  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="about.html">About</a>
                </li>
                <li>
                    <a href="blog.html">Blog</a>
                </li>
                <li>
                    <a href="contact.html">Contact</a>
                </li>
            </ul>
        </div>-->
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<div class="container">
</body>
</html>