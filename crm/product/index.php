<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/intranet/public/crm/product/index.php");
global $APPLICATION;
$APPLICATION->SetTitle(GetMessage("CRM_TITLE"));
?>
<!--<div class= "btrx-button_adn_text_inforamtion">
	<a href="/calculator/index.php" class="ui-btn ui-btn-primary ui-btn-icon-add crm-btn-toolbar-add btrx-button-ebash" title="Перейти в формированию товара в калькуляторе">Перейти в формированию товара в калькуляторе</a>
	<div class="btrx-text-products-information">
		В данном списке появляются сформированные в калькуляторе конфигурации дверей.<br>
		Товары в данном списке доступны только для просмотра, без возможности редактирования.
	</div>
</div>-->
<?
$APPLICATION->IncludeComponent(
    "bitrix:crm.product",
    "myEdit",
    array(
        "SEF_MODE" => "Y",
        "SEF_FOLDER" => "/crm/product/"
    ),
    false
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
