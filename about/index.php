<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Компания сегодня");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/intranet/public/about/index.php");


$APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");
$APPLICATION->SetTitle(GetMessage("ABOUT_TITLE"));
?><style>
.equal, .equal {
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    flex:1 0 auto;
}
</style>
<table class="table">
	<tbody class="lead">
		<tr>
			<td class="col-md-6 col-lg-6"><img width="750" height="500" src="<?=GetMessage("PRODUCTION_IMAGE_1", array("#SITE#" => "/"))?>"></td>
			<td class="col-md-6 col-lg-6 equal"><?=GetMessage("FIRST_PARAGRAPH")?></td>
		</tr>
		<tr>
			<td class="col-md-6 col-lg-6 equal"><?=GetMessage("SECOND_PARAGRAPH")?></td>
			<td class="col-md-6 col-lg-6"><img width="750" height="500" src="<?=GetMessage("PRODUCTION_IMAGE_2", array("#SITE#" => "/"))?>"></td>
		</tr>
		<tr>
			<td class="col-md-6 col-lg-6"><img width="750" height="500" src="<?=GetMessage("PRODUCTION_IMAGE_3", array("#SITE#" => "/"))?>"></td>
			<td class="col-md-6 col-lg-6 equal"><?=GetMessage("THIRD_PARAGRAPH")?></td>
		</tr>
	</tbody>
</table>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>