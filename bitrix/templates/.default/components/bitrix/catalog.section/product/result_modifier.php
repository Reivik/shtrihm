<?
if(!empty($arResult["ITEMS"]))
	foreach($arResult["ITEMS"] as $key => $it)
		if(!empty($it["PREVIEW_PICTURE"]))
			$arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = CFile::ResizeImageGet(
				$it["PREVIEW_PICTURE"],
				array("width" => 117, "height" => 117),
				BX_RESIZE_IMAGE_PROPORTIONAL_ALT, 
				true
			)
?>