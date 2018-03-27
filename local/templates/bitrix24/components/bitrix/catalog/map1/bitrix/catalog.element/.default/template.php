<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<style>
    #map {
        height:660px;
    }
</style>
<div class="salon_cart">
    <div class="info">
        <?
        $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb", "breadcrumbs", Array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => "",
            "SITE_ID" => "-",
            "START_FROM" => "0",
                ), false
        );
        ?>
        <div class="wrap content">
			<? if($arResult["PROPERTIES"]["NAME_FIRMA"]["VALUE"]) { ?>
            <p class="blue"><?=$arResult["PROPERTIES"]["NAME_FIRMA"]["VALUE"]?></p>
			<? } ?>
            <h1 class="title"><?= $arResult["PROPERTIES"]["NAME"]["VALUE"] ?></h1>
            <p class="text"><?= $arResult["PREVIEW_TEXT"] ?></p>
			<? if($arResult["PROPERTIES"]["URL"]["VALUE"]) { ?>
      	      <a class="but" target="_blank" href="<?= $arResult["PROPERTIES"]["URL"]["VALUE"] ?>">Перейти на сайт салона</a>
			<? } ?>
            <div class="sticker">
                <h3>Контакты</h3>
                <span class="address" data-scroll=".map"><?= $arResult["PROPERTIES"]["ADDRESS"]["VALUE"] ?></span>
                <? foreach ($arResult["PROPERTIES"]["PHONES"]["VALUE"] as $val) { ?>
                    <span class="phone"><?= $val ?></span>
                <? } ?>
                <? foreach ($arResult["PROPERTIES"]["WORK_TIME"]["VALUE"] as $val) { ?>
                    <span class="time"><?= $val ?></span>
                <? } ?>
            </div>
        </div>
    </div>
    <div class="doors">
        <div class="wrap clearfix">
            <div class="left">
                <h3>Количество<br>дверей в салоне:</h3>
                <b><?= $arResult["PROPERTIES"]["COUNT_IN_STOCK"]["VALUE"] ?></b>
                <p><?= $arResult["DETAIL_TEXT"] ?></p>
            </div>
            <div class="right clearfix">
                <div class="col">
                    <img src="<?= CFile::GetPath($arResult["PROPERTIES"]["DOORS"]["VALUE"][0]) ?>" alt="<?= $arResult["NAME"] ?>">
                </div>
                <div class="col mini">
                    <img src="<?= CFile::GetPath($arResult["PROPERTIES"]["DOORS"]["VALUE"][1]) ?>" alt="<?= $arResult["NAME"] ?>">
                    <img src="<?= CFile::GetPath($arResult["PROPERTIES"]["DOORS"]["VALUE"][2]) ?>" alt="<?= $arResult["NAME"] ?>">
                </div>
                <div class="col">
                    <img src="<?= CFile::GetPath($arResult["PROPERTIES"]["DOORS"]["VALUE"][3]) ?>" alt="<?= $arResult["NAME"] ?>">
                </div>
                <p class="more">и многие другие модели ...</p>
            </div>
        </div>
    </div>
    <div class="galery">
        <div class="wrap clearfix">
            <h2>Фотогалерея салона</h2>
            <div data-num="0" class="img js_img"><img src="<?= CFile::GetPath($arResult["PROPERTIES"]["SALON_PHOTOS"]["VALUE"][0]) ?>" alt="<?= $arResult["NAME"] ?>"></div>
            <div data-num="1" class="img js_img mini"><img src="<?= CFile::GetPath($arResult["PROPERTIES"]["SALON_PHOTOS"]["VALUE"][1]) ?>" alt="<?= $arResult["NAME"] ?>"></div>
            <div data-num="2" class="img js_img mini"><img src="<?= CFile::GetPath($arResult["PROPERTIES"]["SALON_PHOTOS"]["VALUE"][2]) ?>" alt="<?= $arResult["NAME"] ?>"></div>
        </div>
    </div>
    <div class="js_slider js_popup popup_box">
        <i class="close_popup"></i>
        <div class="control js_control next"></div>
        <div class="control js_control prev"></div>
        <ul class="navigation js_navigation"></ul>
        <div class="js_slide slide">
            <img class="img" src="" alt="">	
        </div>
    </div>
    <script>
        $(function () {

            var popup = new Popup();

            var box = $('.js_slider'),
                    slide = box.find('.js_slide'),
                    galery = $('.js_img img'),
                    num = $('.js_img').length,
                    trigger = $('.js_img'),
                    opened = false;

            for (var i = 1; i < num; i++) {
                box.append(slide.clone());
            }
            ;

            var damm = new DammSlider({
                query: box,
                start_slide: 0,
                speed: 500,
                offsetTop: 0,
                min_height: 0
            });

            trigger.on('click', function () {
                if (!opened) {
                    opened = true;
                    galery.each(function (i) {
                        box.find('img').eq(i).attr('src', $(this).attr('src'));
                    });
                }
                ;
                damm.setStart($(this).attr('data-num'));
                box.fadeIn(150);
            });

            $(document).keydown(function (e) {
                if (e.keyCode == 27) {
                    box.fadeOut(150);
                }
            });
        })
    </script>
    <div class="map">
        <div id="map">
            <script src="https://api-maps.yandex.ru/2.1.3/?lang=ru_RU" type="text/javascript"></script>
        </div>
        <div class="wrap">
            <p class="address"><?= $arResult["PROPERTIES"]["ADDRESS"]["VALUE"] ?></p>
        </div>
    </div>
</div>
<script src="<?= SITE_TEMPLATE_PATH . "/script/scriptMap.js" ?>"></script>
<script type="text/javascript">

        ymaps.ready(initMap);


        function initMap() {
            initIcons(ymaps);
            myMap = new ymaps.Map('map', {
                center: [<?= $arResult["PROPERTIES"]["COORDINATES"]["VALUE"] ?>],
                zoom: 11,
                controls: []
            }, {
                searchControlProvider: 'yandex#search'
            });
            myMap.geoObjects
                    .add(new ymaps.Placemark([<?= $arResult["PROPERTIES"]["COORDINATES"]["VALUE"] ?>], {
                        balloonContent: '<strong><?= $arResult["NAME"] ?></strong>'
                    }, {
                        preset: iconSalon,
                        iconColor: '#735184'
                    }))
            
        }


</script>