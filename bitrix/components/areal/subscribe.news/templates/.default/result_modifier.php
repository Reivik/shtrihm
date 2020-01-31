<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach($arResult["IBLOCKS"] as $key => $arIBlock) {
	if(count($arIBlock["ITEMS"]) > 0) {
		foreach($arIBlock["ITEMS"] as $bal => $arItem) {			
			if(!empty($arResult["IBLOCKS"][$key]["ITEMS"][$bal]["PREVIEW_PICTURE"])) {
				$arResult["IBLOCKS"][$key]["ITEMS"][$bal]["PREVIEW_PICTURE"] = CFile::ResizeImageGet( 
					$arItem["PREVIEW_PICTURE"], 
					array("width" => 171, "height" => 171), 
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true 
				);
			}
		}
	}
}
?>