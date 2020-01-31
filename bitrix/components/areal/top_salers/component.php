<?
if(CModule::IncludeModule("iblock")) {
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'top_salers';
	$cache_dir_path = '/top_salers/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["top_salers"]) && (count($res["top_salers"]) > 0))
		  $arResult = array_merge($arResult, $res["top_salers"]);
	}
	else 
	{
		$k = date("Y"); $flag = 0;
		while($k > 0) {
			$tops = CIBlockSection::GetList(
				array("SORT" => "ASC"), 
				array("IBLOCK_ID" => IB_TOP_SALERS, "ACTIVE" => "Y", "ELEMENT_SUBSECTIONS" => "Y", "CNT_ACTIVE" => "Y", "NAME" => $k), 
				true,
				array("ID", "DESCRIPTION", "NAME", "PICTURE", "SORT", "DEPTH_LEVEL", "IBLOCK_SECTION_ID")
			);
			while($top = $tops->GetNext()) {
				if($top["ELEMENT_CNT"] > 0) {
					$arResult = array("ID" => $top["ID"], "NAME" => $top["NAME"], "PICTURE" => CFile::ResizeImageGet($top["PICTURE"], array("width" => 150, "height" => 300), BX_RESIZE_IMAGE_PROPORTIONAL, true), "DESCRIPTION" => $top["DESCRIPTION"], "SECTIONS" => array());
					$flag = 1;
				}
			}
			if($flag == 0)
				$k--;
			else break;
		}

		$res = CIBlockSection::GetList(
			array("SORT" => "ASC"), 
			array("IBLOCK_ID" => IB_TOP_SALERS, "ACTIVE" => "Y", "ELEMENT_SUBSECTIONS" => "Y", "CNT_ACTIVE" => "Y", "SECTION_ID" => $arResult["ID"]), 
			true,
			array("ID", "DESCRIPTION", "NAME", "PICTURE", "SORT", "DEPTH_LEVEL", "IBLOCK_SECTION_ID")
		);
		while($sec = $res->GetNext())
			$arResult["SECTIONS"][$sec["ID"]] = array("NAME" => $sec["NAME"], "ITEMS" => array());
		
		foreach($arResult["SECTIONS"] as $key => $second_sect) {
			unset($el);
			unset($element);
			$el = CIBlockElement::GetList(
				array("SORT" => "ASC"), 
				array("IBLOCK_ID" => IB_TOP_SALERS, "ACTIVE" => "Y", "SECTION_ID" => $key), 
				false, 
				false, 
				array("ID", "PROPERTY_COMPANY", "PROPERTY_COMPANY.NAME", "PROPERTY_COMPANY.DETAIL_PAGE_URL")
			);
			while($element = $el->GetNext()) 
				$arResult["SECTIONS"][$key]["ITEMS"][] = array(
					"NAME" => $element["PROPERTY_COMPANY_NAME"], 
					"SORT" => $element["SORT"], 
					"DETAIL_PAGE_URL" => substr($element["PROPERTY_COMPANY_DETAIL_PAGE_URL"], 1, strlen($element["PROPERTY_COMPANY_DETAIL_PAGE_URL"])-1)
				);
		}
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array("top_salers" => $arResult));
		}
	}
	$this->IncludeComponentTemplate();
}
?>