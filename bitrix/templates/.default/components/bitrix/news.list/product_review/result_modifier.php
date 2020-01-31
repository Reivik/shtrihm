<?
if(!empty($arResult["ITEMS"])) {
	foreach($arResult["ITEMS"] as $key => $arItem) {
		if(!empty($arItem["PROPERTIES"]["CLIENT"]["VALUE"])) {
			unset($res);
			unset($el);
			$res = CIBlockElement::GetList(
				array(), 
				array("IBLOCK_ID" => IB_CLIENTS, "ID" => $arItem["PROPERTIES"]["CLIENT"]["VALUE"]),
				false,
				false,
				array("ID", "NAME", "DETAIL_PAGE_URL", "PREVIEW_PICTURE")
			);
			if($el = $res->GetNext()) {
				$arResult["REVIEWS"][] = array(
					"ID" => $arItem["ID"],	
					"NAME" => $arItem["~NAME"],	
					"PREVIEW_TEXT" => $arItem["~PREVIEW_TEXT"],	
					"CLIENT" => array(
						"NAME" => $el["NAME"], 
						"DETAIL_PAGE_URL" => $el["DETAIL_PAGE_URL"], 
						"PREVIEW_PICTURE" => CFile::ResizeImageGet(
							$el["PREVIEW_PICTURE"],
							array("width" => 102, "height" => 102),
							BX_RESIZE_IMAGE_PROPORTIONAL_ALT, 
							true
						)
					)
				);
			}
		}
	}
}
?>