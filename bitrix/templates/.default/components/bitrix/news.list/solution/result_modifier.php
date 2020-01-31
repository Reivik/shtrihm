<?
foreach($arResult["ITEMS"] as $key => $arItem) {
	if(!empty($arItem["PREVIEW_PICTURE"]))
		$arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = CFile::ResizeImageGet( 
			$arItem["PREVIEW_PICTURE"], 
			array("width" => 117, "height" => 117), 
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
			true 
		);
	if(!empty($arItem["PROPERTIES"]["PARTNER"]["VALUE"])) {
		unset($res);
		unset($el);
		$res = CIBlockElement::GetList(
			array(), 
			array("IBLOCK_ID" => IB_COMPANY, "ID" => $arItem["PROPERTIES"]["PARTNER"]["VALUE"]),
			false,
			false,
			array("ID", "NAME")
		);
		if($el = $res->GetNext())
			$arResult["ITEMS"][$key]["PROPERTIES"]["PARTNER"]["VALUE"] = $el["NAME"];
	}
}
?>