<?
foreach($arResult["ITEMS"] as $key => $arItem) {
	if(!empty($arItem["PROPERTIES"]["QUALIFICATION"]["VALUE"]))
	foreach($arItem["PROPERTIES"]["QUALIFICATION"]["VALUE"] as $v => $qualification) {
		$qualifications = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_PROGRAMMS, "ID" => $qualification), false, false, array("NAME", "DETAIL_PAGE_URL"));
		while($qualif = $qualifications->GetNext())
			$arResult["ITEMS"][$key]["PROPERTIES"]["QUALIFICATION"]["VALUE"][$v] = array(
				"NAME" => $qualif["NAME"],
				"DETAIL_PAGE_URL" => $qualif["DETAIL_PAGE_URL"]
			);
	}	
	if(!empty($arItem["PROPERTIES"]["COMPANY"]["VALUE"]))
		$compamies = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_COMPANY, "ID" => $arItem["PROPERTIES"]["COMPANY"]["VALUE"]), false, false, array("NAME"));
		while($company = $compamies->GetNext())
			$arResult["ITEMS"][$key]["PROPERTIES"]["COMPANY"]["VALUE"] = $company["NAME"];
}
?>