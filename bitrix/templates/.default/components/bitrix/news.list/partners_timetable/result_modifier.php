<?
if(!empty($arResult["ITEMS"])) {
	foreach($arResult["ITEMS"] as $key => $arItem) {
		$month=date('m-Y',strtotime($arItem['DATE_ACTIVE_FROM']));
		$arResult["DATES"][$month][]=$key;
		if(!empty($arItem["PROPERTIES"]["THEME"]["VALUE"])) {
			unset($res);
			unset($elem);
			$res = CIBlockElement::GetList(
				array(), 
				array("IBLOCK_ID" => IB_PROGRAMMS, "ID" => $arItem["PROPERTIES"]["THEME"]["VALUE"]),
				false,
				false,
				array("IBLOCK_ID", "ID", "NAME", "DETAIL_PAGE_URL", "PROPERTY_TYPE_COMPANY", "PROPERTY_PERSON", "PROPERTY_PRICE", "PROPERTY_DURATION", "PROPERTY_COMPENSATION")
			);
			if($elem = $res->GetNext()) {
				unset($prices);
				if(count($elem["PROPERTY_PRICE_VALUE"]) > 1) {
					foreach($elem["PROPERTY_PRICE_VALUE"] as $key_price => $price)
						$prices[] = $price." (".$elem["PROPERTY_PRICE_DESCRIPTION"][$key_price].")";
				}
				elseif(count($elem["PROPERTY_PRICE_VALUE"]) == 1) {
					$prices = $elem["PROPERTY_PRICE_VALUE"][0];
				}
				$arResult["ITEM"][$key]["PROGRAMM"] = array(
					"ID_THEME" => $elem["ID"],
					"NAME" => $elem["NAME"],
					"DATE_ACTIVE_FROM" => $arItem["DATE_ACTIVE_FROM"],
					"DATE_ACTIVE_TO" => $arItem["DATE_ACTIVE_TO"],
					"TYPE_COMPANY" => $elem["PROPERTY_TYPE_COMPANY_VALUE"],
					"PERSON" => $elem["PROPERTY_PERSON_VALUE"],
					"PRICE" => $prices,
					"DURATION" => $elem["PROPERTY_DURATION_VALUE"],
					"COMPENSATION" => $elem["PROPERTY_COMPENSATION_VALUE"],
					"DETAIL_PAGE_URL" => $elem["DETAIL_PAGE_URL"]
				);
			}
		}
		if(!empty($arItem["PROPERTIES"]["LEARNING_CENTER"]["VALUE"])) {
			unset($learnings);
			unset($element);
			$learnings = CIBlockElement::GetList(
				array(), 
				array("IBLOCK_ID" => IB_LEARNING_CENTER, "ID" => $arItem["PROPERTIES"]["LEARNING_CENTER"]["VALUE"]),
				false,
				false,
				array("PROPERTY_CITY.NAME")
			);
			if($element = $learnings->GetNext())
				$arResult["ITEM"][$key]["PROGRAMM"]["CITY"] = $element["PROPERTY_CITY_NAME"];
		}
		if(!empty($arItem["PROPERTIES"]["PICTURE"]["VALUE"])) {
			$arResult["ITEM"][$key]["PROGRAMM"]["PICTURE"] = CFile::GetPath($arItem["PROPERTIES"]["PICTURE"]["VALUE"]);
		}
	}
	//pr($arResult["ITEM"]);
}
?>