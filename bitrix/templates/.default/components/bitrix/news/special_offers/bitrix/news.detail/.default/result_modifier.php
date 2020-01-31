<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(is_array($arResult["DETAIL_PICTURE"]))
{
	$arResult['PICTURES'][] = array(
		"M" => CFile::ResizeImageGet(
			$arResult['DETAIL_PICTURE'],
			array("width" => 307, "height" => 307),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		),
		"L" => CFile::ResizeImageGet(
			$arResult['DETAIL_PICTURE'],
			array("width" => 900, "height" => 900),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		)
	);
}

if (is_array($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) && count($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) > 0)
{
	foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $arFile)
	{
		$arResult['PICTURES'][] = array(
			"M" => CFile::ResizeImageGet(
				$arFile,
				array("width" => 307, "height" => 307),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				true
			),
			"L" => CFile::ResizeImageGet(
				$arFile,
				array("width" => 900, "height" => 900),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				true
			)
		);
	}
}
/*
if(isset($arResult["PREVIEW_PICTURE"]) && is_array($arResult["PREVIEW_PICTURE"])) {
	$arResult["SMALL_PREVIEW_PICTURE"] = CFile::ResizeImageGet(
		$arResult["PREVIEW_PICTURE"]["ID"],
		array(
			"width" => 345,
			"height" => 458
		),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true
	);
}*/
?>