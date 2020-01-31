<?
	if(!empty($arResult["ITEMS"])) {
		foreach($arResult["ITEMS"] as $key => $arItem) {
			if(!empty($arItem["PREVIEW_PICTURE"])) {
				$arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = CFile::ResizeImageGet( 
					$arItem["PREVIEW_PICTURE"], 
					array("width" => 171, "height" => 171), 
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true 
				);
			}			
		}
	}
?>