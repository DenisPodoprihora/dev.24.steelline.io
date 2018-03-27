<?require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");

if($_REQUEST["PAGE"] == "MAP"){
	require_once($_SERVER["DOCUMENT_ROOT"] . "/handlers/map.php");
}
if($_REQUEST["PAGE"] == "MARKETING"){
	require_once($_SERVER["DOCUMENT_ROOT"] . "/handlers/marketing_materials.php");
}