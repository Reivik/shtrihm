<?
//pr($GLOBALS['arrFilter']);
if(!empty($arResult["ITEMS"])) {
	foreach($arResult["ITEMS"] as $key => $arItem) {
		if(!empty($arItem["PREVIEW_PICTURE"])) {
			$arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = CFile::ResizeImageGet( 
				$arItem["PREVIEW_PICTURE"], 
				array("width" => 103, "height" => 103), 
				BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
				true 
			);
		}
		if(!empty($arItem["PROPERTIES"]["TOWN"]["VALUE"])) {
			unset($res);
			unset($city);
			unset($town);
			$res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_CITIES, "ID" => $arItem["PROPERTIES"]["TOWN"]["VALUE"]), false, false, array("NAME"));
			while($city = $res->GetNext())
				$town = $city["NAME"];
			$arResult["ITEMS"][$key]["TOWN"] = $town;
		}
	}
	//pr($arResult["ITEMS"]);
}
?>