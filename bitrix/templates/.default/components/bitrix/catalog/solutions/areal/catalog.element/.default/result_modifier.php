<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(is_array($arResult["DETAIL_PICTURE"])) {
	$arResult["BIG_PICTURE"] = CFile::ResizeImageGet(
		$arResult["DETAIL_PICTURE"]["ID"],
		array(
			"width" => $arResult["DETAIL_PICTURE"]["WIDTH"],
			"height" => $arResult["DETAIL_PICTURE"]["HEIGHT"]
		),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true
	);	
	$arResult["SMALL_PICTURE"] = CFile::ResizeImageGet(
		$arResult["DETAIL_PICTURE"]["ID"],
		array(
			"width" => 345,
			"height" => 458
		),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true
	);
}
?>