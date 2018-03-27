<?
foreach($arResult["ITEMS"] as $arItem)
{
    if($arItem["PROPERTIES"]["COUNTRY"]["VALUE"] && !in_array($arItem["PROPERTIES"]["COUNTRY"]["VALUE"], $COUNTRIES)) {
        $COUNTRIES[] = $arItem["PROPERTIES"]["COUNTRY"]["VALUE"];
    }
    if($arItem["PROPERTIES"]["REGION"]["VALUE"] && !in_array($arItem["PROPERTIES"]["REGION"]["VALUE"], $REGIONS)) {
        $REGIONS[] = $arItem["PROPERTIES"]["REGION"]["VALUE"];
    }
    asort($REGIONS);
    $arResult["JSON_ITEMS"][$arItem["ID"]] = array(
        "ID" => $arItem["ID"],
        "CODE" => $arItem["CODE"],
        "PICTURE" => $arItem["PREVIEW_PICTURE"]["SRC"],
        "NAME" => $arItem["NAME"],
        "ADDRESS" => $arItem["PROPERTIES"]["ADDRESS"]["VALUE"],
        "COUNT_IN_STOCK" => $arItem["PROPERTIES"]["COUNT_IN_STOCK"]["VALUE"],
        "PHONES" => $arItem["PROPERTIES"]["PHONES"]["VALUE"],
        "WORK_TIME" => $arItem["PROPERTIES"]["WORK_TIME"]["~VALUE"],
        "DETAIL_PAGE_URL" => $arItem["DETAIL_PAGE_URL"]
    );
}

$arResult["REGIONS"] = $REGIONS;
$arResult["COUNTRIES"] = $COUNTRIES;

?>