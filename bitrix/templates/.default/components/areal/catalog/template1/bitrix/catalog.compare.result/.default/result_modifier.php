<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

$arResult["PROP_ROWS"] = array();
foreach($arParams["PROPERTY_CODE"] as $key => $propCode)
{
	if(empty($arResult["SHOW_PROPERTIES"][$propCode]["ID"]) && empty($arResult["DELETED_PROPERTIES"][$propCode]["ID"]))
	{
		unset($arParams["PROPERTY_CODE"][$key]);
		unset($arResult["SHOW_PROPERTIES"][$propCode]);
	}
}
while(count($arParams["PROPERTY_CODE"])>0)
{
	$arRow = array_splice($arParams["PROPERTY_CODE"], 0, 3);
	while(count($arRow) < 3)
		$arRow[]=false;
	$arResult["PROP_ROWS"][]=$arRow;
}

$arResult["OFFERS_PROP_ROWS"] = array();
foreach($arParams["OFFERS_PROPERTY_CODE"] as $key => $propCode)
{
	if(empty($arResult["SHOW_OFFER_PROPERTIES"][$propCode]["ID"]) && empty($arResult["DELETED_OFFER_PROPERTIES"][$propCode]["ID"]))
	{
		unset($arParams["OFFERS_PROPERTY_CODE"][$key]);
		unset($arResult["SHOW_OFFER_PROPERTIES"][$propCode]);
	}
}
while(count($arParams["OFFERS_PROPERTY_CODE"])>0)
{
	$arRow = array_splice($arParams["OFFERS_PROPERTY_CODE"], 0, 3);
	while(count($arRow) < 3)
		$arRow[]=false;
	$arResult["OFFERS_PROP_ROWS"][]=$arRow;
}

foreach($arResult['ITEMS'] as $key => $arItem) {
	$arItem["PREVIEW_PICTURE"] = CFile::ResizeImageGet(
		$arItem["PREVIEW_PICTURE"]['ID'],
		array("width" => 120, "height" => 120),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true
	);
	$arResult["SECTIONS"][$arItem["IBLOCK_SECTION_ID"]]["ITEMS"][] = $arItem;
}
unset($arResult['ITEMS']);
foreach($arResult["SECTIONS"] as $krey => $sect) {
	$sec = CIBlockSection::GetList(array(), array("IBLOCK_ID" => 4, "ID" => $krey), false, array("ID", "NAME"));
	if($section = $sec->GetNext())
		$arResult["SECTIONS"][$krey]["SECTION_NAME"] = $section["NAME"];
	
}
//pr($arResult);
?>