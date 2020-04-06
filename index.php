<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Simple biscuits"); ?>
    <!-- ****** Welcome Post Area Start ****** -->
    <section class="welcome-post-sliders owl-carousel">

        <!--Single Slide-->
        <div class="welcome-single-slide">
            <!--Post Thumb-->
            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/bg-img/slide-1.jpg" alt="">

        </div>

        <!--Single Slide-->
        <div class="welcome-single-slide">
            <!--Post Thumb-->
            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/bg-img/slide-2.jpg" alt="">

        </div>

        <!--Single Slide-->
        <div class="welcome-single-slide">
            <!--Post Thumb-->
            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/bg-img/slide-3.jpg" alt="">

        </div>

        <!--Single Slide-->
        <div class="welcome-single-slide">
            <!--Post Thumb-->
            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/bg-img/slide-4.jpg" alt="">

        </div>

        <!--Single Slide-->
        <div class="welcome-single-slide">
            <!--Post Thumb-->
            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/bg-img/slide-4.jpg" alt="">

        </div>

    </section>
    <!-- ****** Welcome Area End ****** -->
    <!--****** Categories Area Start ******-->
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "list_sections",
    Array(
        "ADD_SECTIONS_CHAIN" => "N",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COUNT_ELEMENTS" => "Y",
        "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
        "FILTER_NAME" => "sectionsFilter",
        "IBLOCK_ID" => "3",
        "IBLOCK_TYPE" => "content",
        "SECTION_CODE" => "",
        "SECTION_FIELDS" => array("NAME", "PICTURE", "DETAIL_PICTURE", ""),
        "SECTION_ID" => $_REQUEST["SECTION_ID"],
        "SECTION_URL" => "#CODE#",
        "SECTION_USER_FIELDS" => array("UF_URL", ""),
        "SHOW_PARENT_NAME" => "Y",
        "TOP_DEPTH" => "2",
        "VIEW_MODE" => "LINE"
    )
);?>

    <!-- ****** Instagram Area Start ****** -->
    <div class="instargram_area owl-carousel section_padding_100_0 clearfix" id="portfolio">

        <!--Instagram Item-->
        <div class="instagram_gallery_item">
            <!--Instagram Thumb-->
            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/instagram-img/1.jpg" alt="">
            <!--Hover -->
            <div class="hover_overlay">
                <div class="yummy-table">
                    <div class="yummy-table-cell">
                        <div class="follow-me text-center">
                            <a href="#"><i class="fa fa-instagram" aria - hidden="true"></i> Follow me </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Instagram Item-->
        <div class="instagram_gallery_item">
            <!--Instagram Thumb-->
            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/instagram-img/2.jpg" alt="">
            <!--Hover -->
            <div class="hover_overlay">
                <div class="yummy-table">
                    <div class="yummy-table-cell">
                        <div class="follow-me text-center">
                            <a href="#"><i class="fa fa-instagram" aria - hidden="true"></i> Follow me </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Instagram Item-->
        <div class="instagram_gallery_item">
            <!--Instagram Thumb-->
            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/instagram-img/3.jpg" alt="">
            <!--Hover -->
            <div class="hover_overlay">
                <div class="yummy-table">
                    <div class="yummy-table-cell">
                        <div class="follow-me text-center">
                            <a href="#"><i class="fa fa-instagram" aria - hidden="true"></i> Follow me </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Instagram Item-->
        <div class="instagram_gallery_item">
            <!--Instagram Thumb-->
            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/instagram-img/4.jpg" alt="">
            <!--Hover -->
            <div class="hover_overlay">
                <div class="yummy-table">
                    <div class="yummy-table-cell">
                        <div class="follow-me text-center">
                            <a href="#"><i class="fa fa-instagram" aria - hidden="true"></i> Follow me </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Instagram Item-->
        <div class="instagram_gallery_item">
            <!--Instagram Thumb-->
            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/instagram-img/5.jpg" alt="">
            <!--Hover -->
            <div class="hover_overlay">
                <div class="yummy-table">
                    <div class="yummy-table-cell">
                        <div class="follow-me text-center">
                            <a href="#"><i class="fa fa-instagram" aria - hidden="true"></i> Follow me </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Instagram Item-->
        <div class="instagram_gallery_item">
            <!--Instagram Thumb-->
            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/instagram-img/6.jpg" alt="">
            <!--Hover -->
            <div class="hover_overlay">
                <div class="yummy-table">
                    <div class="yummy-table-cell">
                        <div class="follow-me text-center">
                            <a href="#"><i class="fa fa-instagram" aria - hidden="true"></i> Follow me </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Instagram Item-->
        <div class="instagram_gallery_item">
            <!--Instagram Thumb-->
            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/instagram-img/1.jpg" alt="">
            <!--Hover -->
            <div class="hover_overlay">
                <div class="yummy-table">
                    <div class="yummy-table-cell">
                        <div class="follow-me text-center">
                            <a href="#"><i class="fa fa-instagram" aria - hidden="true"></i> Follow me </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Instagram Item-->
        <div class="instagram_gallery_item">
            <!--Instagram Thumb-->
            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/instagram-img/2.jpg" alt="">
            <!--Hover -->
            <div class="hover_overlay">
                <div class="yummy-table">
                    <div class="yummy-table-cell">
                        <div class="follow-me text-center">
                            <a href="#"><i class="fa fa-instagram" aria - hidden="true"></i> Follow me </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ****** Our Creative Portfolio Area End ****** -->
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>