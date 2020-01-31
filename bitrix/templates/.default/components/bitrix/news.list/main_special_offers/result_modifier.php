<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["ITEMS"] as &$item)
{
	if(is_array($item["PREVIEW_PICTURE"]))
	{
		$arFilter = '';
		if($arParams["SHARPEN"] != 0)
		{
			$arFilter = array(array("name" => "sharpen", "precision" => $arParams["SHARPEN"]));
		}
			
		$arTmpFile = CFile::ResizeImageGet(
			$item["PREVIEW_PICTURE"],
			array("width"=>$arParams["DISPLAY_IMG_WIDTH"],"height"=>$arParams["DISPLAY_IMG_HEIGHT"]),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true,
			$arFilter
		);
		
		$item["PREVIEW_PICTURE"] = array(
			"SRC" => $arTmpFile["src"],
			"WIDTH" => $arTmpFile["width"],
			"HEIGHT" => $arTmpFile["height"],
		);
	}
}

?>
