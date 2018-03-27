<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
CJSCore::Init(array("jquery"));
CUtil::InitJSCore(array('window', 'ajax'));
$APPLICATION->AddHeadScript('/bitrix/js/main/utils.js');
$APPLICATION->AddHeadScript('/bitrix/js/main/popup_menu.js');

$APPLICATION->SetAdditionalCSS('/bitrix/themes/.default/pubstyles.css');
if($arResult["OPTIONS"]["theme"] <> '')
	$APPLICATION->SetAdditionalCSS($templateFolder.'/themes/'.$arResult["OPTIONS"]["theme"].'/style.css');

print_r($arResult);
?>

<script>
	alert(1);
	$("#crm-1-space").append("<h2>Дарова</h2>");
</script>