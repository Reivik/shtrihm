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
if(strlen($arResult["TAGS"]) > 0)
{
	$arTags = explode(",",$arResult["TAGS"]);
	foreach($arTags as $tag)
	{
		$arResult["TAGS_LINKS"][] = array(
			"URL" => "/press_center/news/?tags=".trim($tag),
			"NAME" => trim($tag)
		);
	}
}

$res = CIBlockSection::GetList(array(), array("IBLOCK_ID" => $arResult["IBLOCK_ID"], "ID" => $arResult["IBLOCK_SECTION_ID"]), false);
while($sec = $res->GetNext()) {
	$arResult["SECTION_NAME"] = $sec["NAME"];
}
?>