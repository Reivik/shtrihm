<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
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
}
?>