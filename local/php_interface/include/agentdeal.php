<?php

AddEventHandler("crm", "OnAfterCrmDealAdd", "___OnAfterCrmDealAdd");
function ___OnAfterCrmDealAdd($arFields){




    if (\Bitrix\Main\Loader::includeModule('crm'))
    {

        $connection = Bitrix\Main\Application::getConnection();
        $sql1 = "SELECT ID, IBLOCK_SECTION_ID, NAME FROM b_iblock_section WHERE IBLOCK_ID = 5 ORDER BY LEFT_MARGIN ASC";
        $result = $connection->query($sql1);


        while ($item = $result->fetch())
        {
            $available_items[] = $item;
        }
        if (CSite::InGroup(array(1, 25))){				// Что бы можно было просматривать админам и топ менеджерам, не сосоящим в отделе сбыта
            $CurrentID = 212;
        }else {
            $rsUser = CUser::GetByID(CUser::GetID());
            $arUser = $rsUser->Fetch();

            $CurrentID = $arUser['UF_DEPARTMENT'][0];
        }
        $flag = true;

        while($flag){  									// цепочка от пользователя к самому корню дерева структуры
            if ($CurrentID == 212) {  $flag = false;}
            foreach ($available_items as $key => $value){
                if ($value['ID'] == $CurrentID){

                    $visible_itemsID[] = $value['NAME'];
                    $CurrentID = $value['IBLOCK_SECTION_ID'];
                }
            }

        }

       /* $arFilter = Array("IBLOCK_ID"=>44, "ACTIVE"=>"Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array());

        echo("<pre>"); print_r($res->Fetch()); echo("</pre>");
        die();*/
       /* {        while ($item = $res->fetch())

            if (in_array($available_items, $item)){
                echo("<pre>"); print_r($item); echo("</pre>");
            }
        }*/

        $CATEGORY_ID = 0;
        if (count($visible_itemsID) == 3){
            $CATEGORY_ID = 1;
        } else if (count($visible_itemsID) == 4){
            $CATEGORY_ID = 2;
        }
        //echo("<pre>"); print_r($CATEGORY_ID); echo("</pre>");

        //die();
        $sql2 = "UPDATE b_crm_deal SET CATEGORY_ID ='". $CATEGORY_ID ."' WHERE ID = '" . $arFields['ID']. "'";
        $connection->query($sql2);

    }

}