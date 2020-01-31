<?
foreach($arResult["ITEMS"] as $key => $arItem) {
	if(!empty($arItem["PREVIEW_PICTURE"]))
		$arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = CFile::ResizeImageGet( 
			$arItem["PREVIEW_PICTURE"], 
			array("width" => 78, "height" => 78), 
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
			true 
		);
}
?>