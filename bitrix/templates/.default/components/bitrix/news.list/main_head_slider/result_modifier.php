<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach($arResult["ITEMS"] as $num=>$item)
	if($item["PREVIEW_PICTURE"]["ID"])
		$arResult["ITEMS"][$num]["PREVIEW_PICTURE"]["RESIZE_IMG"] = CFile::ResizeImageGet($item["PREVIEW_PICTURE"]["ID"], array('width'=>130, 'height'=>20), BX_RESIZE_IMAGE_PROPORTIONAL, true);
?>


