<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach($arResult["ITEMS"] as $key => $arItem)
{
	if(is_array($arItem["PREVIEW_PICTURE"]))
	{
		$file = CFile::ResizeImageGet(
			$arItem["PREVIEW_PICTURE"]["ID"], 
			array("width" => 201, "height" => 160),
			BX_RESIZE_IMAGE_EXACT,
			true
		);

		$arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["SRC"] = $file["src"];
		$arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["WIDTH"] = $file["width"];
		$arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["HEIGHT"] = $file["height"];
	}
	if($arItem["PROPERTIES"]["CITY"]["VALUE"])
	{
		$objCity = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>IB_CITIES,"ID"=>$arItem["PROPERTIES"]["CITY"]["VALUE"]),false,false,array("ID","NAME"));
		$arCity = $objCity->GetNext();
		$arResult["ITEMS"][$key]["PROPERTIES"]["CITY"]["VALUE"] = $arCity["NAME"];
	}
	if($arItem["PROPERTIES"]["PARTNER"]["VALUE"])
	{
		$partners = CIBlockElement::GetList(array(),array("IBLOCK_ID"=> IB_COMPANY, "ID"=>$arItem["PROPERTIES"]["PARTNER"]["VALUE"]), false, false, array("ID","NAME", "DETAIL_PAGE_URL"));
		if($partner = $partners->GetNext())
			$arResult["ITEMS"][$key]["PROPERTIES"]["PARTNER"]["VALUE"] = array("NAME" => $partner["NAME"], "DETAIL_PAGE_URL" => $partner["DETAIL_PAGE_URL"]);
	}
}
?>
