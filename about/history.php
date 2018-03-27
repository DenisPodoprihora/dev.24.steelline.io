<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/intranet/public/about/history.php");
$APPLICATION->SetAdditionalCSS("/bitrix/css/main/bootstrap.css");
$APPLICATION->SetTitle(GetMessage("ABOUT_TITLE"));
?>
<p>
	<table class="table">
		<tbody>
			<tr><td valign="top"><img height="300" width="500" src="<?=GetMessage("ABOUT_IMAGE", array("#SITE#" => "/")) ?>"/> </td><td valign="top">
				<div class="lead"><?=GetMessage("FIRST_PARAGRAPH")?></div>
			</td></tr>
		</tbody>
	</table>
</p>

<div class="lead"><?=GetMessage("ABOUT_INFO", array("#SITE#" => "/"))
	?></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>