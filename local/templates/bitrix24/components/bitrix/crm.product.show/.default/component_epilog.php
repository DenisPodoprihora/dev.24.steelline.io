
<table class="main-grid-table" id="CRM_ORDER_LIST_table">
    <thead class="main-grid-header" data-relative="CRM_ORDER_LIST_table">
    <tr class="main-grid-row-head">
        <th class="main-grid-cell-head main-grid-cell-left main-grid-col-sortable  main-grid-draggable">
				<span class="main-grid-cell-head-container">
					<span class="main-grid-head-title">Наименование товара</span>
				</span>
        </th>
        <th class="main-grid-cell-head main-grid-cell-center main-grid-col-sortable  main-grid-draggable">
				<span class="main-grid-cell-head-container">
					<span class="main-grid-head-title">Количество</span>
				</span>
        </th>
        <th class="main-grid-cell-head main-grid-cell-center main-grid-col-sortable  main-grid-draggable">
				<span class="main-grid-cell-head-container">
					<span class="main-grid-head-title">Цена за ед.</span>
				</span>
        </th>
        <th class="main-grid-cell-head main-grid-cell-center main-grid-col-sortable  main-grid-draggable">
				<span class="main-grid-cell-head-container">
					<span class="main-grid-head-title">Скидка</span>
				</span>
        </th>
        <th class="main-grid-cell-head main-grid-cell-right main-grid-col-sortable  main-grid-draggable">
				<span class="main-grid-cell-head-container">
					<span class="main-grid-head-title">Сумма</span>
				</span>
        </th>
    </tr>
    </thead>
    <tbody>
        <?

        $discount = [];
        $arFilter = Array("IBLOCK_ID"=>43, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
        $res = CIBlockElement::GetList(Array(), $arFilter);
        $i = 0;
        while($ob = $res->GetNextElement())
        {
         $arFields = $ob->GetFields();

         $rest = CIBlockElement::GetProperty(43, $arFields['ID'] , array("sort" => "asc"));
         while($ar_res = $rest->Fetch()) {
             $discount[$i]['DISCOUNT'] = $ar_res;
             $ar_res = $rest->Fetch();
             $discount[$i]['GROUP'] = $ar_res;
             $i++;
         }
        }
        $DISCOUNT_PRICE = 0;
        $arGroups = CUser::GetUserGroup($USER->GetID());

       foreach ($discount as $key => $value){
            if (in_array($discount[$key]['GROUP']['VALUE'], $arGroups)){
                $DISCOUNT_PRICE = $discount[$key]['DISCOUNT']['VALUE'];
            }
       }


        $arSets = CCatalogProductSet::getAllSetsByProduct($arResult['PRODUCT_ID'], CCatalogProductSet::TYPE_GROUP);

        $TOTAL_PRICE = 0;
        foreach ($arSets as $key => $value) {
            foreach ($arSets[$key]['ITEMS'] as $newKey => $newValue) {

                $result = CIBlockElement::GetByID($newValue['ITEM_ID']);
                $ar_res = $result->GetNext();

                $PRODUCT_IBLOCK_ID = $ar_res['IBLOCK_ID'];

                $db_props = CIBlockElement::GetProperty($PRODUCT_IBLOCK_ID, $newValue['ITEM_ID'], array("sort" => "asc"), Array("CODE"=>"PRICE"));
                if($ar_props = $db_props->Fetch()) {
                    
                    $PRICE = floatval($ar_props["VALUE"]) - (($DISCOUNT_PRICE / 100) * floatval($ar_props["VALUE"]));
                }
                $TOTAL_PRICE += $PRICE * IntVal($newValue['QUANTITY']);
                ?>
                <tr class="main-grid-row main-grid-row-body">
                    <td class="main-grid-cell main-grid-cell-left">
				        <span class="main-grid-cell-content">
                            <span class="crm-product-title-wrapper">
                                <?=$ar_res['NAME'];?>
                            </span>
				        </span>
                    </td>
                    <td class="main-grid-cell main-grid-cell-center">
                        <span class="main-grid-cell-content">
                            <span class="crm-product-count-wrapper">
                                <?=$newValue['QUANTITY'];?>
                            </span>
                        </span>
                    </td>
                    <td class="main-grid-cell main-grid-cell-center">
                        <span class="main-grid-cell-content">
                            <span class="crm-product-price-wrapper">
                                <?=floatval($ar_props["VALUE"]);?>
                            </span>
                        </span>
                    </td>
                    <td class="main-grid-cell main-grid-cell-center">
                        <span class="main-grid-cell-content">
                            <span class="crm-product-discount-wrapper">
                                <?=$DISCOUNT_PRICE;?> %
                            </span>
                        </span>
                    </td>
                    <td class="main-grid-cell main-grid-cell-right">
                        <span class="main-grid-cell-content">
                            <span class="crm-product-sum-wrapper" style="padding-right: 21px">
                                <?=$PRICE*IntVal($newValue['QUANTITY']);?> руб.
                            </span>
                        </span>
                    </td>
                </tr>
                <?
            }
        }
        ?>
        <tr class="main-grid-row main-grid-row-body">
            <td colspan="5" class="main-grid-panel-cell main-grid-panel-limit main-grid-cell-right" style="padding: 16px;">
                <span class="main-grid-panel-content">
                    <span class="main-grid-panel-content" style="padding-right: 21px; font-size: 1.2em">Итого: <?=$TOTAL_PRICE?> руб.</span>
                </span>
            </td>
        </tr>
    </tbody>
</table>

