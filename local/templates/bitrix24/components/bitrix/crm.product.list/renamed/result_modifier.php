<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

/*$file = trim(preg_replace("'[\\\\/]+'", '/', (dirname(__FILE__).'/lang/'.LANGUAGE_ID.'/result_modifier.php')));
__IncludeLang($file);*/
IncludeModuleLangFile(__FILE__);

$arArrays = array();
$arElements = array();
$arSections = array();

foreach ($arResult['PROPERTY_VALUES'] as $productID => $arProperties)
{
	foreach ($arProperties as $propID => $propValue)
	{
		$arProp = $arResult['PROPS'][$propID];

		if ($arProp['PROPERTY_TYPE'] == 'F')
		{
			if (is_array($propValue))
			{
				foreach ($propValue as $valueKey => $file)
				{
					$obFile = new CCrmProductFile(
						$productID,
						$propID,
						$file
					);

					$obFileControl = new CCrmProductFileControl($obFile, $propID);

					$propValue[$valueKey] = '<nobr>'.$obFileControl->GetHTML(array(
							'show_input' => false,
							'max_size' => 102400,
							'max_width' => 50,
							'max_height' => 50,
							'url_template' => $arParams['~PATH_TO_PRODUCT_FILE'],
							'a_title' => GetMessage('CRM_PRODUCT_PROP_ENLARGE'),
							'download_text' => GetMessage('CRM_PRODUCT_PROP_DOWNLOAD'),
						)).'</nobr>';
				}
			}
			else
			{
				$obFile = new CCrmProductFile(
					$productID,
					$propID,
					$propValue
				);

				$obFileControl = new CCrmProductFileControl($obFile, $propID);

				$propValue = '<nobr>'.$obFileControl->GetHTML(array(
						'show_input' => false,
						'max_size' => 102400,
						'max_width' => 50,
						'max_height' => 50,
						'url_template' => $arParams['~PATH_TO_PRODUCT_FILE'],
						'a_title' => GetMessage('CRM_PRODUCT_PROP_ENLARGE'),
						'download_text' => GetMessage('CRM_PRODUCT_PROP_DOWNLOAD'),
					)).'</nobr>';
			}
		}
		else if ($arProp['PROPERTY_TYPE'] == 'E')
		{
			if (is_array($propValue))
			{
				foreach ($propValue as $valueKey => $id)
				{
					if ($id > 0)
						$arElements[] = &$arResult['PROPERTY_VALUES'][$productID][$propID][$valueKey];
				}
				$arArrays[$productID.'_'.$propID] = &$arResult['PROPERTY_VALUES'][$productID][$propID];
			}
			else if ($propValue > 0)
			{
				$arElements[] = &$arResult['PROPERTY_VALUES'][$productID][$propID];
			}
			continue;
		}
		else if ($arProp['PROPERTY_TYPE'] == 'G')
		{
			if (is_array($propValue))
			{
				foreach ($propValue as $valueKey => $id)
				{
					if ($id > 0)
						$arSections[] = &$arResult['PROPERTY_VALUES'][$productID][$propID][$valueKey];
				}
				$arArrays[$productID.'_'.$propID] = &$arResult['PROPERTY_VALUES'][$productID][$propID];
			}
			else if ($propValue > 0)
			{
				$arSections[] = &$arResult['PROPERTY_VALUES'][$productID][$propID];
			}
			continue;
		}

		$arResult['PROPERTY_VALUES'][$productID][$propID] = $propValue;

		if (is_array($propValue))
		{
			if (count($propValue) > 1)
				$arArrays[$productID.'_'.$propID] = &$arResult['PROPERTY_VALUES'][$productID][$propID];
			else
				$arResult['PROPERTY_VALUES'][$productID][$propID] = $propValue[0];
		}
	}
}

if (count($arElements))
{
	$rsElements = CIBlockElement::GetList(array(), array('=ID' => $arElements), false, false, array('ID', 'NAME', 'DETAIL_PAGE_URL'));
	$arr = array();
	while($ar = $rsElements->GetNext())
		$arr[$ar['ID']] = $ar['NAME'];

	foreach ($arElements as $i => $el)
		if (isset($arr[$el]))
			$arElements[$i] = $arr[$el];
}

if (count($arSections))
{
	$rsSections = CIBlockSection::GetList(array(), array('=ID' => $arSections));
	$arr = array();
	while($ar = $rsSections->GetNext())
		$arr[$ar['ID']] = $ar['NAME'];

	foreach ($arSections as $i => $el)
		if (isset($arr[$el]))
			$arSections[$i] = $arr[$el];
}

foreach ($arArrays as $i => $ar)
	$arArrays[$i] = implode('&nbsp;/<br>', $ar);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (CSite::InGroup(array(1, 25))){				// Что бы можно было просматривать админам и топ менеджерам, не сосоящим в отделе сбыта
    return;
}
$ProductsIds = [];
foreach ($arResult['PRODUCTS'] as $key => $value){
    $ProductsIds[] = $value['ID'];
}


$result = $DB->query("SELECT ID, IBLOCK_SECTION_ID, NAME FROM b_iblock_section WHERE IBLOCK_ID = 5 ORDER BY LEFT_MARGIN ASC"); // получаем список всех отделов



while ($item = $result->fetch())
{
    $available_items[] = $item;
}


$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
//echo("<pre>"); print_r($arUser); echo("</pre>");
$CurrentID = $arUser['UF_DEPARTMENT'][0];   //Находим отдел текущего пользователя




$subordinate = array($CurrentID);
$flag = true;

while($flag){                               // создаём список подчиняющихся отделов от пользователя вниз по иерархии
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


$filter = array(
    '=UF_DEPARTMENT' => $subordinate
);

$elementsResult = CUser::GetList(($by="UF_DEPARTMENT"), ($order="DESC"), $filter);

$subordinateEmployers[] = CUser::GetID(); // Массив с id всех пользоватлей, которые находятся ниже по иерархии в конкретной ветке
while ($item = $elementsResult->fetch())
{

    $rsUser = CUser::GetByID($item["ID"]);
    $arUser = $rsUser->Fetch();

    if (in_array($arUser['UF_DEPARTMENT'][0], $subordinate)){
        $subordinateEmployers[] = $arUser['ID'];
    }

}

foreach ($arResult['PRODUCTS'] as $value) {
    $ListOfProducts[] = $value['ID'];        // список всех наборов товаров
}

if (isset($ListOfProducts)) {

    $arFilter = Array("ID" => $ListOfProducts);
    $res = CIBlockElement::GetList(Array(), $arFilter);
    while($ar_res = $res->GetNext()) {

        if (!in_array($ar_res['CREATED_BY'], $subordinateEmployers)){


            unset($arResult['PRODUCTS'][$ar_res['ID']]);
        }
    }
}
