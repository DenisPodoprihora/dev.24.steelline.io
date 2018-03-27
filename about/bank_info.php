<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/intranet/public/about/bank_info.php");

$APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");
$APPLICATION->SetTitle(GetMessage("ABOUT_TITLE"));
?>


	<?=GetMessage("ABOUT_INFO")?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>