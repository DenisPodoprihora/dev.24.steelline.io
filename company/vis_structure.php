<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/intranet/public/company/vis_structure.php");
$APPLICATION->SetTitle(GetMessage("COMPANY_TITLE"));
$APPLICATION->AddChainItem(GetMessage("COMPANY_TITLE"), "vis_structure.php");
?>
<?
$APPLICATION->IncludeComponent(
	"bitrix:intranet.structure.visual", 
	"my_edit_vis_structure", 
	array(
		"DETAIL_URL" => "/company/structure.php?set_filter_structure=Y&structure_UF_DEPARTMENT=#ID#",
		"PROFILE_URL" => "/company/personal/user/#ID#/",
		"PM_URL" => "/company/personal/messages/chat/#ID#/",
		"NAME_TEMPLATE" => "",
		"USE_USER_LINK" => "Y",
		"COMPONENT_TEMPLATE" => "my_edit_vis_structure",
		"SHOW_LOGIN" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "2592000",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>