<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["ITEMS"])) {
	foreach($arResult["ITEMS"] as $key => $arItem) {
		if(!empty($arItem["PREVIEW_PICTURE"])) {
			$arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = CFile::ResizeImageGet( 
				$arItem["PREVIEW_PICTURE"], 
				array("width" => 102, "height" => 102), 
				BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
				true 
			);
		}			
	}
}
//pr($arResult["ITEMS"]);
$res = CIBlockSection::GetList(array(), array("IBLOCK_ID" => $arResult["ITEMS"][0]["IBLOCK_ID"], "ID" => $arResult["ITEMS"][0]["IBLOCK_SECTION_ID"]), false);
while($sec = $res->GetNext()) {
	$arResult["SECTION_NAME"] = $sec["NAME"];
}
?>
