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

if (!empty($arResult['ITEMS'])) {

    $array["type"] = "FeatureCollection";
    $features = array();
    $countries = array();
    foreach ($arResult['ITEMS'] as $arItem) {
        $id = $arItem["ID"];
        $isSalon = $arItem["PROPERTIES"]["IS_SALON"]["VALUE"] == "Y";
        $name = $arItem["NAME"];
        $baloon = htmlspecialchars_decode($arItem["PROPERTIES"]["BALOON_CONTENT"]["VALUE"]["TEXT"]);
        $cluster = $arItem["NAME"];
        $hint = $arItem["NAME"];
        $arItem["PROPERTIES"]["COORDINATES"]["VALUE"] = str_replace(" ", "", $arItem["PROPERTIES"]["COORDINATES"]["VALUE"]);
        $coordinates = explode(",", $arItem["PROPERTIES"]["COORDINATES"]["VALUE"]);
        $features[] = array(
            "type" => "Feature",
            "id" => $id,
            "isSalon" => $isSalon,
            "region" => $arItem["PROPERTIES"]["REGION"]["VALUE"],
            "country" => $arItem["PROPERTIES"]["COUNTRY"]["VALUE"],
            "geometry" => array("type" => "Point", "coordinates" => $coordinates),
            "properties" => array("balloonContent" => $baloon, "clusterCaption" => $cluster, "hintContent" => $hint),
        );
        if($countries[$arItem["PROPERTIES"]["COUNTRY"]["VALUE"]][$arItem["PROPERTIES"]["REGION"]["VALUE"]]) {
            $countries[$arItem["PROPERTIES"]["COUNTRY"]["VALUE"]][$arItem["PROPERTIES"]["REGION"]["VALUE"]]++;
        } else {
            $countries[$arItem["PROPERTIES"]["COUNTRY"]["VALUE"]][$arItem["PROPERTIES"]["REGION"]["VALUE"]] = 1;
        }
    }
    $array["features"] = $features;
    $data = json_encode($array, true);
    ?>

   <script src="https://api-maps.yandex.ru/2.1.3/?lang=en_US" type="text/javascript"></script>
    <script>
        var data = <?= $data ?>;
        var Items = <?= json_encode($arResult["JSON_ITEMS"]) ?>;
        var countries = <?= json_encode($countries)?>;
    </script>
    <div class="map_app">
        <div class="head clearfix">
            <div class="wrap">

                <div class="select_list js_select regions_select" data-placeholder="Choose region">
                    <span class="top js_selected"></span>
                    <ul class="list js_select_list">
                        <li>All regions</li>
                        <? foreach ($arResult["REGIONS"] as $region) { ?>
                            <li class="selectable"><?= $region ?></li>
                        <? } ?>
                    </ul>
                </div>
                <div class="select_list js_select countries_select" data-placeholder="Choose country">
                    <span class="top js_selected"></span>
                    <ul class="list js_select_list">
                        <li>All countries</li>
                        <? foreach ($arResult["COUNTRIES"] as $country) { ?>
                            <li><?= $country ?></li>
                        <? } ?>
                    </ul>
                </div>
            </div><input type="hidden">
        </div>
        <div class="map">
            <div id="map"></div>
            <div class="wrap">
                <div class="wrapper wrap_obj">
                    <ul>
                        <? foreach ($arResult["ITEMS"] as $arItem) { ?>
                            <li class="block ajax_map" id="block_<?=$arItem["ID"]?>" data-id="<?= $arItem["ID"] ?>">
                                <h3 onclick='yaRequest("salon_map");'><span><?= $arItem["NAME"] ?></span> </h3>
                                <p onclick='yaRequest("salon_map");' class="address"><?= $arItem["PROPERTIES"]["ADDRESS"]["VALUE"] ?></p>
                                <p onclick='yaRequest("salon_map");' class="nums"><?= $arItem["PROPERTIES"]["COUNT_IN_STOCK"]["NAME"] ?>: <?= $arItem["PROPERTIES"]["COUNT_IN_STOCK"]["VALUE"] ?></p>
                                <div class="block_arrow" onclick='yaRequest("show_on_map");' data-id="<?= $arItem["ID"] ?>"><p class="tooltip">Show on the map</p></div>
                            </li>
                        <? } ?>
                    </ul>
                    <div class="detail_salon"></div>
                </div>
            </div>
        </div>
    </div>
    <?
}