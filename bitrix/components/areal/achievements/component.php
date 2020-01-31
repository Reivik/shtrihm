<?
if(CModule::IncludeModule("iblock")) {
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'achievements';
	$cache_dir_path = '/achievements/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["achievements"]) && (count($res["achievements"]) > 0))
		  $arResult = array_merge($arResult, $res["achievements"]);
	}
	else 
	{
		$elements = CIBlockElement::GetList(
			array("ACTIVE_FROM" => "DESC"), 
			array("IBLOCK_ID" => IB_ACHIEVEMENTS), 
			false, 
			array("nTopCount" => 3), 
			array("ID", "NAME", "DATE_ACTIVE_FROM", "DATE_ACTIVE_TO", "DETAIL_PAGE_URL", "PROPERTY_OPEN_ACCESS")
		);
		while($element = $elements->GetNext()) 
			$arResult["ITEMS"][] = array(
				"NAME" => $element["NAME"],
				"DATE" => getDateText($element["DATE_ACTIVE_FROM"], $element["DATE_ACTIVE_TO"]),
				"DETAIL_PAGE_URL" => $element["DETAIL_PAGE_URL"]				
			);
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array("achievements" => $arResult));
		}
	}
	$this->IncludeComponentTemplate();
}
?>