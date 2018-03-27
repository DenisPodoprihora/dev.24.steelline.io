<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("highloadblock"); 

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!CModule::IncludeModule('crm'))
{
	ShowError(GetMessage('CRM_MODULE_NOT_INSTALLED'));
	return;
}


$rsDeal = CCrmDeal::GetList();

$arItem = $rsDeal->Fetch();

$arItemsID = $arItem['ID'];
$arItemsTitle = $arItem['TITLE'];
$arItemsBeginDate = $arItem['BEGINDATE'];

//print_r($arItems);

?>
<?

if (CModule::IncludeModule('highloadblock')) {
	$arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(1)->fetch();
   $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
$strEntityDataClass = $obEntity->getDataClass();
}

if (CModule::IncludeModule('highloadblock')) {
   $rsData = $strEntityDataClass::getList(array(
      'select' => array('ID','UF_NAME','UF_NUMBER'),
      'order' => array('ID' => 'ASC'),
      'limit' => '50',
   ));
	while ($arItem = $rsData->Fetch()) {
		$arItemsHIID= $arItem['ID'];
		$arItemsHIUF_NAME = $arItem['UF_NAME'];
		$arItemsHIUF_NUMBER = $arItem['UF_NUMBER'];
	}
}


$res = CIBlockElement::GetList();

$element = $res->GetNext();
    // $element['NAME'];
    // и другие свойства элемента
//print_r($element);
	$arInfoID = $element['ID'];
	$arInfoName = $element['NAME'];
	$arInfoIBLOCK_NAME = $element['IBLOCK_NAME'];



$data = "
<h2> CRM элемент</h2>
<table class=table>
	<thead>
		<tr>
			<th>ID записи</th>
			<th>Название</th>
			<th>Дата создания</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td> $arItemsID </td>
			<td> $arItemsTitle</td>
			<td> $arItemsBeginDate</td>
		</tr>
	</tbody>
</table> 
<h2> HILOAD-Инфоблок</h2>
<table class='table' >
	<thead>
		<tr>
			<th>ID инфоблока</th>
			<th>Название</th>
			<th>Числовое значение</th>
		</tr>

	</thead>
	<tbody>
		<tr>
			<td> $arItemsHIID</td>
			<td> $arItemsHIUF_NAME</td>
			<td> $arItemsHIUF_NUMBER</td>
		</tr>
	</tbody>
</table>
<h1> Инфоблок</h1>
<table class='table' >
	<thead>
		<tr>
			<th>ID инфоблока</th>
			<th>Название</th>
			<th>Тип инфоблока</th>
		</tr>

	</thead>
	<tbody>
		<tr>
			<td>$arItemsHIID</td>
			<td>$arItemsHIUF_NAME</td>
			<td>$arInfoIBLOCK_NAME</td>
		</tr>
	</tbody>
</table>";

echo $data;

?>
