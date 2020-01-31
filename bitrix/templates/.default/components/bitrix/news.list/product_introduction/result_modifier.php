<?
if(!empty($arResult["ITEMS"])) {
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
				array("ID", "NAME", "DETAIL_PAGE_URL")
			);
			if($el = $res->GetNext()) {
				$arResult["ITEMS"][$key]["PROPERTIES"]["PARTNER"]["VALUE"] = $el["NAME"];
				$arResult["ITEMS"][$key]["PROPERTIES"]["PARTNER"]["DETAIL_PAGE_URL"] = $el["DETAIL_PAGE_URL"];
			}
		}
		if($arItem["PROPERTIES"]["REGION"]["VALUE"]) {
			$regions = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_REGIONS, "ID" => $arItem["PROPERTIES"]["REGION"]["VALUE"]), false, false, array("ID", "NAME"));
			if($region = $regions->GetNext()) 
				$arResult["ITEMS"][$key]["PROPERTIES"]["REGION"]["VALUE"] = $region["NAME"];
		}
		if($arItem["PROPERTIES"]["CITY"]["VALUE"]) {
			$towns = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_CITIES, "ID" => $arItem["PROPERTIES"]["CITY"]["VALUE"]), false, false, array("ID", "NAME"));
			if($town = $towns->GetNext()) 
				$arResult["ITEMS"][$key]["PROPERTIES"]["CITY"]["VALUE"] = $town["NAME"];
		}
	}
}
?>