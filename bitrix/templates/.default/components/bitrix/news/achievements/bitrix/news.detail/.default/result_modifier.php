<?
	if(!empty($arResult["PREVIEW_PICTURE"])) {
		$arResult["PREVIEW_PICTURE"] = CFile::ResizeImageGet(
			$arResult["PREVIEW_PICTURE"],
			array("width" => 155, "height" => 155),
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT, 
			true
		);
	}
?>