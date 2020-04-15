<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
} ?>
<?php

use Bitrix\Main\Page\Asset;

$APPLICATION->SetPageProperty("title", "Simple_biscuits");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $APPLICATION->ShowHead(); ?>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <?php Asset::getInstance()->addString('<meta http-equiv="X-UA-Compatible" content="IE=edge">'); ?>
    <?php Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1">'); ?>
    <?php Asset::getInstance()->addCss(SIMPLE_TEMPLATE_PATH . '/style.css'); ?>
    <?php Asset::getInstance()->addCss(SIMPLE_TEMPLATE_PATH . '/css/responsive/responsive.css'); ?>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />

    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="<?=SIMPLE_TEMPLATE_PATH?>/fancybox/lib/jquery.mousewheel.pack.js"></script>
    <!-- Add fancyBox -->
    <?php Asset::getInstance()->addCss(SIMPLE_TEMPLATE_PATH . '/fancybox/source/jquery.fancybox.css?v=2.1.7'); ?>
    <script type="text/javascript" src="<?=SIMPLE_TEMPLATE_PATH?>/fancybox/source/jquery.fancybox.pack.js?v=2.1.7"></script>
    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <?php Asset::getInstance()->addCss(SIMPLE_TEMPLATE_PATH . '/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5'); ?>
    <script type="text/javascript" src="<?=SIMPLE_TEMPLATE_PATH?>/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="<?=SIMPLE_TEMPLATE_PATH?>/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
    <?php Asset::getInstance()->addCss(SIMPLE_TEMPLATE_PATH . '/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7'); ?>
    <script type="text/javascript" src="<?=SIMPLE_TEMPLATE_PATH?>/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
</head>


<body>
<?php $APPLICATION->ShowPanel(); ?>
<!-- Preloader Start -->
<div id="preloader">
    <div class="yummy-load"></div>
</div>

<!-- ****** Top Header Area Start ****** -->
<div class="top_header_area">
    <div class="container">
        <div class="row">
            <div class="col-5 col-sm-6">
                <!--  Top Social bar start -->
                <div class="top_social_bar">
                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a>
                    <a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                </div>
            </div>
            <!--  Login Register Area -->
            <div class="col-7 col-sm-6">
                <div class="signup-search-area d-flex align-items-center justify-content-end">
                    <div class="login_register_area d-flex">
                        <div class="login">
                            <a href="register.html">Sing in</a>
                        </div>
                        <div class="register">
                            <a href="register.html">Sing up</a>
                        </div>
                    </div>
                    <!-- Search Button Area -->
                    <div class="search_button">
                        <a class="searchBtn" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                    </div>
                    <!-- Search Form -->
                    <div class="search-hidden-form">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search-anything" placeholder="Search Anything...">
                            <input type="submit" value="" class="d-none">
                            <span class="searchBtn"><i class="fa fa-times" aria-hidden="true"></i></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ****** Top Header Area End ****** -->

<!-- ****** Header Area Start ****** -->
<header class="header_area">
    <div class="container">
        <div class="row">
            <!-- Logo Area Start -->
            <div class="col-12">
                <div class="logo_area text-center">
                    <a href="/" class="yummy-logo">Simple biscuits</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#yummyfood-nav"
                            aria-controls="yummyfood-nav" aria-expanded="false" aria-label="Toggle navigation"><i
                                class="fa fa-bars" aria-hidden="true"></i> Menu
                    </button>
                    <!-- Menu Area Start -->
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "horizontal_menu_first_level",
                        Array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "left",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(""),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "main",
                            "USE_EXT" => "Y"
                        )
                    );?>

                </nav>
            </div>
        </div>
    </div>
</header>
<?php if ($APPLICATION->GetCurPage() !== '/'): ?>
<?$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
        "START_FROM" => "0",
        "PATH" => "",
        "SITE_ID" => "s1"
    )
);?>
<? endif;?>
<script>
    $(document).ready(function() {
        $(".fancybox-thumb").fancybox({
            prevEffect	: 'none',
            nextEffect	: 'none',
            helpers	: {
                title	: {
                    type: 'outside'
                },
                thumbs	: {
                    width	: 50,
                    height	: 50
                }
            }
        });
    });
</script>

