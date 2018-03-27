<?
if (!CSite::InGroup(array(12))){
	$result = $DB->query(sprintf(
				"SELECT ID, IBLOCK_SECTION_ID FROM b_iblock_section
					WHERE IBLOCK_ID = %u  AND GLOBAL_ACTIVE = 'Y' %s ORDER BY LEFT_MARGIN ASC",
				$arParams['IBLOCK_ID'],
				$mode == 'subtree' && $arCurrentSection['LEFT_MARGIN'] > 0 && $arCurrentSection['RIGHT_MARGIN'] > 0
					? sprintf('AND LEFT_MARGIN > %u AND RIGHT_MARGIN < %u', $arCurrentSection['LEFT_MARGIN'], $arCurrentSection['RIGHT_MARGIN']) : ''
			));
	
	$rsUser = CUser::GetByID($USER->GetID());
	$arUser = $rsUser->Fetch();
	$CurrentID = $arUser['UF_DEPARTMENT'][0];
	$subordinate = array($CurrentID);
	$visible_itemsID = array(53);

	while ($item = $result->fetch())
	{
		$available_items[] = $item;
	}

	$flag = true;
	while($flag){  									// цепочка от пользователя к самому корню дерева структуры
		foreach ($available_items as $key => $value){
			if ($value['ID'] == $CurrentID){
				$visible_itemsID[] = $value['ID'];
				$CurrentID = $value['IBLOCK_SECTION_ID'];
			}
		}
		if ($CurrentID == 53) {  $flag = false;}
	}
	$flag = true;

	while($flag){
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
$result = array_merge($visible_itemsID, $subordinate);
	//echo("<pre>"); print_r($subordinate); echo("</pre>");




		foreach($arResult['ENTRIES'] as $key => $value){
			if (!in_array($value["ID"], $result)){
				unset($arResult['ENTRIES'][$key]);
			}
		}


}
?>
