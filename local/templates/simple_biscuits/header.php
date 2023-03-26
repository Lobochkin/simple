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

    <?php Asset::getInstance()->addJs(SIMPLE_TEMPLATE_PATH . '/js/axios.min.js'); ?>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
    <!-- Jquery-2.2.4 js -->
    <?php Asset::getInstance()->addJs(SIMPLE_TEMPLATE_PATH . '/js/jquery/jquery-2.2.4.min.js'); ?>

    <!-- Add mousewheel plugin (this is optional) -->

    <?php Asset::getInstance()->addJs(SIMPLE_TEMPLATE_PATH . '/fancybox/lib/jquery.mousewheel.pack.js'); ?>
    <!-- Add fancyBox -->
    <?php Asset::getInstance()->addCss(SIMPLE_TEMPLATE_PATH . '/fancybox/source/jquery.fancybox.css?v=2.1.7'); ?>
    <?php Asset::getInstance()->addJs(SIMPLE_TEMPLATE_PATH . '/fancybox/source/jquery.fancybox.pack.js?v=2.1.7'); ?>
    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <?php Asset::getInstance()->addCss(SIMPLE_TEMPLATE_PATH . '/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5'); ?>

    <?php Asset::getInstance()->addJs(SIMPLE_TEMPLATE_PATH . '/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5'); ?>
    <?php Asset::getInstance()->addJs(SIMPLE_TEMPLATE_PATH . '/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6'); ?>
    <?php Asset::getInstance()->addCss(SIMPLE_TEMPLATE_PATH . '/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7'); ?>
    <?php Asset::getInstance()->addJs(SIMPLE_TEMPLATE_PATH . '/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7'); ?>
    <!-- Popper js -->
    <?php Asset::getInstance()->addJs(SIMPLE_TEMPLATE_PATH . '/js/bootstrap/popper.min.js'); ?>
    <!-- Bootstrap-4 js -->
    <?php Asset::getInstance()->addJs(SIMPLE_TEMPLATE_PATH . '/js/bootstrap/bootstrap.min.js'); ?>
    <!-- All Plugins JS -->
    <?php Asset::getInstance()->addJs(SIMPLE_TEMPLATE_PATH . '/js/others/plugins.js'); ?>
    <!-- Active JS -->

<!--    <script src="--><?//=SIMPLE_TEMPLATE_PATH?><!--/js/active.js"></script>-->

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
                    <a href="https://www.instagram.com/simple_biscuits/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    <a href="https://api.whatsapp.com/send?phone=79151365506" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
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
    (function ($) {
        'use strict';
        // :: 4.0 ScrollUp Active JS
        if ($.fn.scrollUp) {
            $.scrollUp({
                scrollSpeed: 1500,
                scrollText: '<i class="fa fa-arrow-up" aria-hidden="true"></i>'
            });
        }

        // // :: 5.0 CounterUp Active JS
        // if ($.fn.counterUp) {
        //     $('.counter').counterUp({
        //         delay: 10,
        //         time: 2000
        //     });
        // }

        // :: 6.0 PreventDefault a Click
        $("a[href='#']").on('click', function ($) {
            $.preventDefault();
        });

        // // :: 7.0 Search Form Active Code
        // $(".searchBtn").on('click', function () {
        //     $(".search-hidden-form").toggleClass("search-form-open");
        // });

        // :: 8.0 Search Form Active Code
        // $("#pattern-switcher").on('click', function () {
        //     $("body").toggleClass("bg-pattern");
        // });
        // $("#patter-close").on('click', function () {
        //     $(this).hide("slow");
        //     $("#pattern-switcher").addClass("pattern-remove");
        // });

        // :: 9.0 wow Active Code анимация появления елементов при прокрутке
        if ($.fn.init) {
            new WOW().init();
        }

        // :: 10.0 matchHeight Active JS вырвнивает блоки item по высоте
        // if ($.fn.matchHeight) {
        //     $('.item').matchHeight();
        // }

        var $window = $(window);

        // :: 11.0 Preloader active code
        $window.on('load', function () {
            $('#preloader').fadeOut('slow', function () {
                $(this).remove();
            });
        });

    })(jQuery);
</script>

