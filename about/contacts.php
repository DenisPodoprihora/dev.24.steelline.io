<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/intranet/public/about/contacts.php");
$APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");
$APPLICATION->SetTitle(GetMessage("ABOUT_TITLE"));
?>
<?=GetMessage("CONTACTS")?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>