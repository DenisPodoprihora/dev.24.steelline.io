<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $templateData
 * @var string $templateFolder
 * @var CatalogSectionComponent $component
 */

global $APPLICATION;

if (isset($templateData['TEMPLATE_THEME']))
{
	$APPLICATION->SetAdditionalCSS($templateFolder.'/themes/'.$templateData['TEMPLATE_THEME'].'/style.css');
	$APPLICATION->SetAdditionalCSS('/bitrix/css/main/themes/'.$templateData['TEMPLATE_THEME'].'/style.css', true);
}

if (!empty($templateData['TEMPLATE_LIBRARY']))
{
	$loadCurrency = false;
	if (!empty($templateData['CURRENCIES']))
	{
		$loadCurrency = \Bitrix\Main\Loader::includeModule('currency');
	}

	CJSCore::Init($templateData['TEMPLATE_LIBRARY']);

	if ($loadCurrency)
	{
		?>
		<script>
			BX.Currency.setCurrencies(<?=$templateData['CURRENCIES']?>);
		</script>
		<?
	}
}

//	lazy load and big data json answers
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
if ($request->isAjaxRequest() && ($request->get('action') === 'showMore' || $request->get('action') === 'deferredLoad'))
{
	$content = ob_get_contents();
	ob_end_clean();

	list(, $itemsContainer) = explode('<!-- items-container -->', $content);
	list(, $paginationContainer) = explode('<!-- pagination-container -->', $content);

	if ($arParams['AJAX_MODE'] === 'Y')
	{
		$component->prepareLinks($paginationContainer);
	}

	$component::sendJsonAnswer(array(
		'items' => $itemsContainer,
		'pagination' => $paginationContainer
	));
}
?>
<script>
	$(document).ready(function() {
        $('.mm-page .workarea-content-paddings').height($('.mm-page .workarea-content-paddings').parent('#workarea-content').height());
        $('.mm-page .workarea-content-paddings > div').height($('.mm-page .workarea-content-paddings').height());
    });

    $('.mm-page .fields.string input').keydown(function(e) { //запрещаем ввод всего кроме цифр, ограничиваем максимальное число
        if (e.keyCode == 46 || e.keyCode == 8 || e.keyCode == 9 || e.keyCode == 27) {
            return;
        } else if ((($(this).val() == "") && (e.keyCode == 48)) || ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105 ))) {
            e.preventDefault();
        } else if ($(this).val().length > 1) {
            e.preventDefault();
            $(this).val('100');
        }
    });
    $('.mm-page .fields.string input').change(function() { //если поле пустое после ввода, то ставим '1'
        if ($(this).val() == "") $(this).val('1');
    })
    $('.mm-page .tab-pane .webform-small-button-text').click(function() {
        var price = parseFloat($(this).parent('span').parent('div').siblings('div[data-entity="props-block"]').find('dd').text()),
            count = parseInt($(this).parent('span').siblings('.fields.string').find('input').val());
        $('#result-panel .panel-body').append(
            "<div class=\"product-item\">" +
                "<div class=\"product-preview\"><a class=\"product-item-image-wrapper\" data-entity=\"image-wrapper\">" +
                    $(this).parent('span').parent('div').siblings('a').html() +
                "</a></div>" +
                "<div class=\"product-descr\">" +
                "<div class=\"product-name\">" +
                    $(this).parent('span').parent('div').siblings('.product-item-title').text() +
                "</div>" +
                "<div class=\"fields string\">" +
                    "<input type=\"text\" name=\"count_product\" value=\"" +
                         count +
                    "\" size=\"20\" class=\"fields string\">" +
                "</div>" +
                "<div class=\"product-single-price\">" +
                    "<div class=\"price-title\">Стоимость за ед.:</div>" +
                    "<span>" + $(this).parent('span').parent('div').siblings('div[data-entity="props-block"]').find('dd').text() + "</span>" +
                "</div>" +
                "<div class=\"product-result-price\">" +
                    "<div class=\"price-title\">Общая стоимость:</div>" +
                    price * count + " руб." +
                "</div></div>" +
            "<span class=\"product-del\"></span></div>"
        );
    });

$(document).ready(function(){
	$("span#pull_product_in_basket").click(pullProduct)
})

	function pullProduct(){


    $.ajax({
        url: "/ajax.handler.php",
        type: "POST",
		data: {PAGE: "MARKETING" },
        success: function(data){

			$('div.deal').html(data);
        }
    });
</script>