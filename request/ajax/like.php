<?
if(filter_input(INPUT_POST, "id")) {
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");




	if(!CModule::IncludeModule("iblock")) return;

	$id = intVal(filter_input(INPUT_POST, "id"));
	$db_props = CIBlockElement::GetProperty(5, $id, array("sort" => "asc"), Array("CODE"=>"LIKES"));
	if($ar_props = $db_props->Fetch()){
		$LIKES = IntVal($ar_props["VALUE"]);
		if(filter_input(INPUT_POST, "minus")) {
			$LIKES--;
		} else {
			$LIKES++;
		}

		$PROPERTY_CODE = "LIKES";
		$PROPERTY_VALUE = $LIKES;
		CIBlockElement::SetPropertyValuesEx($id, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
	}
}