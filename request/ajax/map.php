<?
if($_REQUEST["ID"]) {

	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	if(!CModule::IncludeModule("iblock")) return;

	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE");
	$arFilter = Array("ID" => $_REQUEST["ID"]);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement()) {
	
	  $arFields = $ob->GetFields();
	  $Properties = $ob->GetProperties();
		if($Properties["MODELS"]["VALUE"]) {
			$filter["ID"] = $Properties["MODELS"]["VALUE"];
		}

	}
}

if($filter["ID"]) {

	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "PREVIEW_PICTURE", "PROPERTY_NAME_FOR_CATALOG");
	$arFilter = Array("ID" => $filter["ID"]);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement()) {
	  $doors[] = $ob->GetFields();
	}
}

?>
<div>
	<div id="popup_place" class="popup">
		<h3><?=$arFields["NAME"]?></h3>
		<div class="galer clearfix">
			<img src="<?=CFile::GetPath($arFields["PREVIEW_PICTURE"])?>" alt="">
			<div class="rama">
				<?foreach($Properties["ADRESS"]["~VALUE"] as $val) { ?>
					<p class="adr"><?=$val?></p>
				<? } ?>
				<p class="phone">
					<?foreach($Properties["PHONES"]["VALUE"] as $val) { ?>
					<span><?=$val?></span>
					<? } ?>
				</p>
				<p class="time">
					<?foreach($Properties["WORK_TIME"]["VALUE"] as $val) { ?>
					<?=$val?><br/>
					<? } ?>
	
				</p>
				<?if($Properties["HREF_ABOUT"]["VALUE"]) { ?>
					<a href="<?=$Properties["HREF_ABOUT"]["VALUE"]?>" class="href_about"><?=$Properties["HREF_ABOUT"]["NAME"]?></a>
				<? } ?>
			</div>
			<?foreach($Properties["MORE_PHOTOS"]["VALUE"] as $val) { ?>
			<img src="<?=CFile::GetPath($val);?>">
			<? } ?>
		</div>
		<? if($doors) { ?>
		<h3>Двери из каталога, представленные в салоне</h3>
		<div class="door_list">
			<div class="wrapper">
				<ul>
					<? foreach($doors as $item) { ?>
					<li>
						<a href="<?=$item["DETAIL_PAGE_URL"]?>">
						<img src="<?=CFile::GetPath($item["PREVIEW_PICTURE"])?>" alt="">
						<p><?=$item["PROPERTY_NAME_FOR_CATALOG_VALUE"]?></p>
						</a>
					</li>
					<? } ?>
				</ul>
			</div>
			<div class="next control"></div>
			<div class="prev control"></div>
		</div>
		<? } ?>
	</div>
</div>