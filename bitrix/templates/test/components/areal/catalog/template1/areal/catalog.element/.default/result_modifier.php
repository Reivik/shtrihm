<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//pr($arResult["IBLOCK_SECTION_ID"]);
if(is_array($arResult["PREVIEW_PICTURE"]))
{
	$arResult['PICTURES'][] = array(
		"S" => CFile::ResizeImageGet(
			$arResult['PREVIEW_PICTURE'],
			array("width" => 88, "height" => 88),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		),
		"M" => CFile::ResizeImageGet(
			$arResult['PREVIEW_PICTURE'],
			array("width" => 326, "height" => 326),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		),
		"L" => CFile::ResizeImageGet(
			$arResult['PREVIEW_PICTURE'],
			array("width" => 900, "height" => 900),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		)
	);
}

if (is_array($arResult['MORE_PHOTO']) && count($arResult['MORE_PHOTO']) > 0)
{
	unset($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']);
	foreach ($arResult['MORE_PHOTO'] as $key => $arFile)
	{
		$arResult['PICTURES'][] = array(
			"S" => CFile::ResizeImageGet(
				$arFile,
				array("width" => 88, "height" => 88),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				true
			),
			"M" => CFile::ResizeImageGet(
				$arFile,
				array("width" => 326, "height" => 326),
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
$prop = false;
foreach($arResult["PROPERTIES"] as $key=>$pr)
{
	if($pr["VALUE"] && $pr["PROPERTY_TYPE"] != "F" && $key != 'MORE_PHOTO' && $key != 'other_product' && $key != 'dop_chars' && $key != 'type' && $key != 'keywords' && $key != 'description' && $key != 'seo_title' && $key != 'accreditation' && $key != 'buy') 
	{
		$prop = true;
		break;
	}
}

$arResult["ISSET_PROPERTY"] = $prop;
?>