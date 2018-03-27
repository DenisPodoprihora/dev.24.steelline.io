<?
function UserStructure($idUser, $available_items) {

    $rsUser = CUser::GetByID($idUser);
    $arUser = $rsUser->Fetch();

    $CurrentID = $arUser['UF_DEPARTMENT'][0];

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
    $reversed = array_reverse($visible_itemsID);
    return $reversed;
}




$result = $DB->query("SELECT ID, IBLOCK_SECTION_ID, NAME FROM b_iblock_section WHERE IBLOCK_ID = 5 ORDER BY LEFT_MARGIN ASC"); // получаем список всех отделов



while ($item = $result->fetch())
	{
		$available_items[] = $item;
	}

//echo("<pre>"); print_r($available_items); echo("</pre>");

$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
//echo("<pre>"); print_r($arUser); echo("</pre>");
$CurrentID = $arUser['UF_DEPARTMENT'][0];   //Находим отдел текущего пользователя


//echo("<pre>"); print_r($CurrentID); echo("</pre>");


if (CSite::InGroup(array(1, 25))){				// Что бы можно было просматривать админам и топ менеджерам, не сосоящим в отделе сбыта
	$CurrentID = 212;
}
	$subordinate = array($CurrentID);
	$flag = true;

    while($flag){                               // создаём список отделов от пользователя вниз по иерархии
        $flag = false;
        foreach($available_items as $key1 => $value1){
            foreach($subordinate as $value2){
                if ($value2 == $value1['IBLOCK_SECTION_ID']){
                    $subordinate[] = $value1['ID'];
                    //$flag = true;
                }
            }
        }
    }
	
	unset($subordinate[array_search($CurrentID,$subordinate)]);
//echo("<pre>"); print_r($subordinate); echo("</pre>");

$filter = array(
	'=UF_DEPARTMENT' => $subordinate
	);
	$arParam["SELECT"][]= "UF_DEPARTMENT";
	$elementsResult = CUser::GetList(($by="UF_DEPARTMENT"), ($order="DESC"), $filter);




//$test = UserStructure($CurrentID, )
//echo("<pre>"); print_r($available_items); echo("</pre>");



	while ($item = $elementsResult->fetch())
	{

		$rsUser = CUser::GetByID($item["ID"]);
		$arUser = $rsUser->Fetch();
		//echo("<pre>"); print_r($arUser); echo("</pre>");



		$arUsers[$arUser['UF_DEPARTMENT'][0]]["USERS"][$item["ID"]]["USER_NAME"] = isset($arUser["NAME"]) ? $arUser["NAME"] : "";
		$arUsers[$arUser['UF_DEPARTMENT'][0]]["USERS"][$item["ID"]]["USER_LAST_NAME"] = isset($arUser["LAST_NAME"]) ? $arUser["LAST_NAME"] : "";
		$arUsers[$arUser['UF_DEPARTMENT'][0]]["USERS"][$item["ID"]]["WORK_POSITION"] = isset($arUser["WORK_POSITION"]) ? $arUser["WORK_POSITION"] : "";

		if (isset($arUser["PERSONAL_PHOTO"])){
			$file = CFile::ResizeImageGet($arUser["PERSONAL_PHOTO"], array('width'=>40, 'height'=>40), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		}else {
			$file['class'] = "no_photo";
			$file['src'] = SITE_TEMPLATE_PATH . "/images/user-default-avatar.svg";
		}

		$arUsers[$arUser['UF_DEPARTMENT'][0]]["USERS"][$item["ID"]]["USER_PHOTO"] = $file;
		$arUsers[$arUser['UF_DEPARTMENT'][0]]["STRUCTURE"] = UserStructure($item["ID"], $available_items);
	}

//echo("<pre>"); print_r($arUsers[$arUser['UF_DEPARTMENT'][0]]["STRUCTURE"]); echo("</pre>");

foreach($arResult["ITEMS"] as $key => $arItem)
{	
	$var = $arItem["PROPERTIES"]["ID_BLOCK_STRUCTURE"]["VALUE"];
	if (!is_numeric($arItem["PROPERTIES"]["ID_BLOCK_STRUCTURE"]["VALUE"]) || !in_array($var, $subordinate)){
			unset($arResult["ITEMS"][$key]);
	}else {


			if($arItem["PROPERTIES"]["COUNTRY"]["VALUE"] && !in_array($arItem["PROPERTIES"]["COUNTRY"]["VALUE"], $COUNTRIES)) {
				$COUNTRIES[] = $arItem["PROPERTIES"]["COUNTRY"]["VALUE"];
			}
			if($arItem["PROPERTIES"]["REGION"]["VALUE"] && !in_array($arItem["PROPERTIES"]["REGION"]["VALUE"], $REGIONS)) {
				$REGIONS[] = $arItem["PROPERTIES"]["REGION"]["VALUE"];
			}
			asort($REGIONS);





		//echo("<pre>"); print_r($arUsers); echo("</pre>");

			$arResult["JSON_ITEMS"][$arItem["ID"]] = array(
				"ID" => $arItem["ID"],
				"CODE" => $arItem["CODE"],
				"PICTURE" => $arItem["PREVIEW_PICTURE"]["SRC"],
				"NAME" => $arItem["NAME"],
				"ADDRESS" => $arItem["PROPERTIES"]["ADDRESS"]["VALUE"],
				"COUNT_IN_STOCK" => $arItem["PROPERTIES"]["COUNT_IN_STOCK"]["VALUE"],
				"PHONES" => $arItem["PROPERTIES"]["PHONES"]["VALUE"],
				"WORK_TIME" => $arItem["PROPERTIES"]["WORK_TIME"]["~VALUE"],
				"DETAIL_PAGE_URL" => $arItem["DETAIL_PAGE_URL"],
				"USERS" => $arUsers[$var]["USERS"],
				"STRUCTURE" => $arUsers[$var]["STRUCTURE"]
			);
		}
}
//echo("<pre>"); print_r($arResult["JSON_ITEMS"]); echo("</pre>");




//echo("<pre>"); print_r($arResult["ITEMS"]); echo("</pre>");


$arResult["REGIONS"] = $REGIONS;
$arResult["COUNTRIES"] = $COUNTRIES;

?>