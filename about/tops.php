<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/intranet/public/about/tops.php");
$APPLICATION->SetTitle(GetMessage("ABOUT_TITLE"));
$APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");
?>

<p>
	<table class=table>
		<tbody class=lead>
			<tr>
				<td class="col-md-6 col-lg-6 text-center" ><img height="750" width="500" src="<?=GetMessage("ABOUT_TOP1_IMG", array("#SITE#" => "/"))?>"/> </td>
				<td valign="col-md-6 col-lg-6 text-center equal"><?=GetMessage("ABOUT_TOP1_INFO")?></td>
			</tr>
		</tbody>
	</table>
</p>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>