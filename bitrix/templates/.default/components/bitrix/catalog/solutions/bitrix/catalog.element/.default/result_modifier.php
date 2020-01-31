<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(is_array($arResult["PREVIEW_PICTURE"]))
{
	$arResult["BIG_PREVIEW_PICTURE"] = CFile::ResizeImageGet(
		$arResult["PREVIEW_PICTURE"]["ID"],
		array(
			"width" => $arResult["PREVIEW_PICTURE"]["WIDTH"],
			"height" => $arResult["PREVIEW_PICTURE"]["HEIGHT"]
		),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true
	);	
	$arResult["SMALL_PREVIEW_PICTURE"] = CFile::ResizeImageGet(
		$arResult["PREVIEW_PICTURE"]["ID"],
		array(
			"width" => 345,
			"height" => 458
		),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true
	);
}?>