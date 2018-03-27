<?

$arr = json_decode($_POST['jsonData'], true);

$name = "Комплект маркетинговых материалов";

$arFields = Array(
    "IBLOCK_ID"          => 27,
    "NAME"               => $name,
    "IBLOCK_SECTION_ID" => 340
);

$obElement = new CIBlockElement();

$ID = $obElement->Add($arFields);
    if( $ID < 1 ) { echo $obElement->LAST_ERROR; }

    $obElement->Update($ID, array("NAME" => $USER->GetFirstName() . " " . $USER->GetLastName(). ": " . $name . " № ".   $ID));

    CCatalogProduct::add(array("ID" => $ID));


    $ITEMS = [];
    $i = 0;
    foreach($arr as $key => $arr_element) {
        $ITEMS[$i]["ACTIVE"] = "Y";
        $ITEMS[$i]["ITEM_ID"] = $key;
        $ITEMS[$i]["QUANTITY"] = $arr_element;
        $i++;
    }
    //print_r($ITEMS);
    $arFields = array(
        "TYPE" => CCatalogProductSet::TYPE_GROUP, // тип 1 = комплект, 2 = набор
        "ITEM_ID" => $ID,
        "SET_ID" => 0,
        "ITEMS" => $ITEMS
    );

    if(CCatalogProductSet::add($arFields)) {
        print_r($ID);
        return $ID;
    }
