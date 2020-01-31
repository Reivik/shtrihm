<?
	foreach($arResult["ITEMS"] as $key => $item) {
		if(!empty($item["PROPERTIES"]["CITY"]["VALUE"])) {
			$res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_CITIES, "ID" => $item["PROPERTIES"]["CITY"]["VALUE"]), false, false, array("NAME"));
			if($el = $res->GetNext())
				if(strlen($el["~NAME"]) > 0)
					$arResult["ITEMS"][$key]["PROPERTIES"]["CITY"]["VALUE"] = $el["~NAME"];
		}
	}
?>