<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/intranet/public/crm/deal/index.php");
$APPLICATION->SetTitle(GetMessage("CRM_TITLE"));
$APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");
CJSCore::Init(array("jquery"));
?><?$APPLICATION->IncludeComponent(
	"bitrix:crm.deal",
	"",
	Array(
		"SEF_MODE" => "Y",
		"PATH_TO_CONTACT_SHOW" => "/crm/contact/show/#contact_id#/",
		"PATH_TO_CONTACT_EDIT" => "/crm/contact/edit/#contact_id#/",
		"PATH_TO_COMPANY_SHOW" => "/crm/company/show/#company_id#/",
		"PATH_TO_COMPANY_EDIT" => "/crm/company/edit/#company_id#/",
		"PATH_TO_INVOICE_SHOW" => "/crm/invoice/show/#invoice_id#/",
		"PATH_TO_INVOICE_EDIT" => "/crm/invoice/edit/#invoice_id#/",
		"PATH_TO_LEAD_SHOW" => "/crm/lead/show/#lead_id#/",
		"PATH_TO_LEAD_EDIT" => "/crm/lead/edit/#lead_id#/",
		"PATH_TO_LEAD_CONVERT" => "/crm/lead/convert/#lead_id#/",
		"PATH_TO_USER_PROFILE" => "/company/personal/user/#user_id#/",
		"PATH_TO_PRODUCT_EDIT" => "/crm/product/edit/#product_id#/",
		"PATH_TO_PRODUCT_SHOW" => "/crm/product/show/#product_id#/",
		"ELEMENT_ID" => $_REQUEST["deal_id"],
		"SEF_FOLDER" => "/crm/deal/",
		"SEF_URL_TEMPLATES" => Array(
			"index" => "index.php",
			"list" => "list/",
			"edit" => "edit/#deal_id#/",
			"show" => "show/#deal_id#/"
		),
		"VARIABLE_ALIASES" => Array(
			"index" => Array(),
			"list" => Array(),
			"edit" => Array(),
			"show" => Array(),
		)
	)
);
if(CModule::IncludeModule("iblock")): 

/*$arFilter = array(
    'IBLOCK_ID' => 1, // выборка элементов из инфоблока с ИД равным «5»
    'ACTIVE' => 'Y',  // выборка только активных элементов
);

	$res = CIBlockElement::GetList(array(), $arFilter);
print_r($res);*/



endif; 

?>

<script type="text/javascript">
	//var arTabLoading = []; 
	//BX.ready(function(){//alert(window.location.href);
    //обработка открытия вкладки 
/*
	BX.addCustomEvent("OnTabHide", BX.delegate(function(tab_id){alert(12);
    tab_id = 'tab_live_feed';
}, this));
	BX.addCustomEvent("OnTabShow", BX.delegate(function(tab_id){
      tab_id = 'tab_793563';
}, this));
*/

/*
BX.onCustomEvent(self,'OnTabHide',['tab_live_feed']);
BX.onCustomEvent(self,'OnTabShow',['tab_793563']);
BX.onCustomEvent(self,'BX_CRM_INTERFACE_FORM_TAB_SELECTED',[BxCrmInterfaceForm, 'CRM_DEAL_SHOW_V12', 'tab_793563',
BX('inner_tab_tab_793563')]);
*/
	/*BX.addCustomEvent('BX_CRM_INTERFACE_FORM_TAB_SELECTED', BX.delegate(function(self, name, tab_id){
		//console.log(self, name, tab_id);
        if (!arTabLoading[tab_id] && self.oTabsMeta[tab_id].title == 'Custom') {
       // if (self.oTabsMeta[tab_id].title == 'ProductTable') {
            var innerTab = BX('inner_tab_'+tab_id), 
                dealId = 0, matches = null, 
                waiter = BX.showWait(innerTab); 
            if (matches = window.location.href.match(/\/crm\/deal\/show\/([\d]+)\//i)) { 
                var dealId = parseInt(matches[1]); 
            } 
            if (dealId > 0) {
				category_deal = 0;
                //чтобы не грузить повторно 
                arTabLoading[tab_id] = true; 
				//проверка Заявка или запрос
				BX.ajax({ 
                        url: '/crm/deal/ajax/check_deal.php', 
                        method: 'POST', 
                        dataType: 'html', 
                        data: { 
                            id: dealId 
                        }, 
                        onsuccess: function(data) 
                        { 
							innerTab.innerHTML = data; 
							BX.closeWait(this, waiter); 
							//$("td#test").appned("$PROPS["']");
                        }, 
                        onfailure: function(data) 
                        { 
                            BX.closeWait(innerTab, waiter); 
                        } 
                    } 
                ); 
            } 
        } 

    })); 



});
*/

</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>