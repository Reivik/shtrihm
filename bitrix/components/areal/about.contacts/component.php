<?
if(CModule::IncludeModule("iblock")) {
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'about.contacts';
	$cache_dir_path = '/about.contacts/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["about.contacts"]) && (count($res["about.contacts"]) > 0))
		  $arResult = array_merge($arResult, $res["about.contacts"]);
	}
	else 
	{
		$sections = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_CONTACTS, "ACTIVE" => "Y", "DEPTH_LEVEL" => 1), true, array("ID", "SORT", "NAME"));
		while($section = $sections->GetNext()) {			
			if($section["ELEMENT_CNT"] > 0) {
				unset($res);
				unset($el);
				unset($elements);
				$res = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_CONTACTS, "ACTIVE" => "Y", "SECTION_ID" => $section["ID"]), false, false, array("NAME", "PROPERTY_DEPARTMENT", "PROPERTY_POSITION", "PROPERTY_PHONE", "PROPERTY_EMAIL", "PROPERTY_MOBILE"));
				while($el = $res->GetNext()) 
					$elements[] = array(
						"NAME" => $el["NAME"],
						"DEPARTMENT" => $el["PROPERTY_DEPARTMENT_VALUE"],
						"POSITION" => $el["PROPERTY_POSITION_VALUE"],
						"PHONE" => $el["PROPERTY_PHONE_VALUE"],
						"EMAIL" => $el["PROPERTY_EMAIL_VALUE"],
						"MOBILE" => $el["PROPERTY_MOBILE_VALUE"]
					);
				$arResult["SECTIONS"][] = array(
					"ID" => $section["ID"],
					"NAME" => $section["NAME"],
					"ITEMS" => $elements
				);
			}
		}
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array("about.contacts" => $arResult));
		}
	}
	//pr($arResult);
	
	$this->IncludeComponentTemplate();
}
?>