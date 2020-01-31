<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult["ITEMS"] as $key => $arElement) 
{
	if(is_array($arElement["PREVIEW_PICTURE"]))
	{
		$arFilter = '';
		if($arParams["SHARPEN"] != 0)
		{
			$arFilter = array(array("name" => "sharpen", "precision" => $arParams["SHARPEN"]));
		}
		$arFileTmp = CFile::ResizeImageGet(
			$arElement["PREVIEW_PICTURE"],
			array("width" => 105, "height" => 105),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true, $arFilter
		);

		$arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = array(
			"SRC" => $arFileTmp["src"],
			'WIDTH' => $arFileTmp["width"],
			'HEIGHT' => $arFileTmp["height"],
		);
	}
}
?>