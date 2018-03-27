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
    ?>
    <?
	//echo("<pre>"); print_r($arResult['ITEMS']); echo("</pre>");
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

    <script src="https://api-maps.yandex.ru/2.1.3/?lang=ru_RU" type="text/javascript"></script>
    <script>
        var data = <?= $data ?>;
        var Items = <?= json_encode($arResult["JSON_ITEMS"]) ?>;
        var countries = <?= json_encode($countries)?>;
    </script>
    <div class="map_app">
        <div class="head clearfix">
            <div class="wrap">
                <h1 class="title"><?=$APPLICATION->GetTitle();?></h1>
                <!-- <div class="select_list js_select regions_select" data-placeholder="Выберите регион">
                    <span class="top js_selected"></span>
                    <ul class="list js_select_list">
                        <li>Все регионы</li>
<?/* foreach ($arResult["REGIONS"] as $region) { ?>
                            <li class="selectable"><?= $region ?></li>
<? } */?>
                    </ul>
                </div> -->
                <!--<div class="select_list js_select countries_select" data-placeholder="Выберите страну">
                    <span class="top js_selected"></span>
                    <ul class="list js_select_list">
                        <li>Все страны</li>
<? /*foreach ($arResult["COUNTRIES"] as $country) { ?>
                            <li><?= $country ?></li>
<? } */?>
                    </ul>
                </div> -->
			<div id="select-date"><span>Отчетный период с</span>
			<?$APPLICATION->IncludeComponent(
					"bitrix:main.calendar",
					"",
					array(
						"SHOW_INPUT"=>"Y",
						"INPUT_NAME"=>"Begin_date",
						"INPUT_VALUE"=>"Выберите дату",
						"INPUT_ADDITIONAL_ATTR"=>'',
						"SHOW_TIME" => 'N'
					),
					array("HIDE_ICONS"=>true)
				);?>
				<span>по</span>
			<?$APPLICATION->IncludeComponent(
					"bitrix:main.calendar",
					"",
					array(
						"SHOW_INPUT"=>"Y",
						"INPUT_NAME"=>"Close_date",
						"INPUT_VALUE"=>"Выберите дату",
						"INPUT_ADDITIONAL_ATTR"=>'',
						"SHOW_TIME" => 'N'
					),
					array("HIDE_ICONS"=>true)
				);?>
				</div>
            </div>
        </div>
        <script src="https://api-maps.yandex.ru/2.1.3/?lang=ru_RU" type="text/javascript"></script>
        <div class="map">
            <div id="map"></div>
            <div class="wrap">
                <div class="wrapper wrap_obj">
                    <ul>
                        <? foreach ($arResult["ITEMS"] as $arItem) { ?>
                            <li class="block ajax_map" id="block_<?=$arItem["ID"]?>" data-id="<?= $arItem["ID"] ?>">
                                <h3 onclick='yaRequest("salon_map");'><span><?= $arItem["NAME"] ?></span> </h3>
                                <p onclick='yaRequest("salon_map");' class="address"><?= $arItem["PROPERTIES"]["ADDRESS"]["VALUE"] ?></p>
                                <p onclick='yaRequest("salon_map");' class="nums">Количество образцов в магазине: <?= $arItem["PROPERTIES"]["COUNT_IN_STOCK"]["VALUE"] ?></p>
                                <div class="block_arrow" onclick='yaRequest("show_on_map");' data-id="<?= $arItem["ID"] ?>"><p class="tooltip">Показать на карте</p></div>
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
?>