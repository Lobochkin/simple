<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Page\Asset;
?>
<!-- ****** Footer Social Icon Area Start ****** -->
<div class="social_icon_area clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer-social-area d-flex">
                    <div class="single-icon">
                        <a href="https://www.instagram.com/simple_biscuits/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ****** Footer Social Icon Area End ****** -->

<!-- ****** Footer Menu Area Start ****** -->
<footer class="footer_area">
    <div class="container">
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

    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Copywrite Text -->
                <div class="copy_right_text text-center">
                    <p>Copyright @2020 All rights reserved <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="/" target="_blank">Lobochkin</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Jquery-2.2.4 js -->
<?php Asset::getInstance()->addJs(SIMPLE_TEMPLATE_PATH . '/js/jquery/jquery-2.2.4.min.js'); ?>
<!-- Popper js -->
<?php Asset::getInstance()->addJs(SIMPLE_TEMPLATE_PATH . '/js/bootstrap/popper.min.js'); ?>
<!-- Bootstrap-4 js -->
<?php Asset::getInstance()->addJs(SIMPLE_TEMPLATE_PATH . '/js/bootstrap/bootstrap.min.js'); ?>
<!-- All Plugins JS -->
<?php Asset::getInstance()->addJs(SIMPLE_TEMPLATE_PATH . '/js/others/plugins.js'); ?>
<!-- Active JS -->
<script src="<?=SIMPLE_TEMPLATE_PATH?>/js/active.js"></script>

<?php Asset::getInstance()->addJs(SIMPLE_TEMPLATE_PATH . '/js/vue.js'); ?>
</body>

</html>
