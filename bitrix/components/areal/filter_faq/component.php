<?if(CModule::IncludeModule("iblock"))
{
	if(!empty($arParams["GROUP_ACCESS"])) {
		if(!array_intersect($arParams["GROUP_ACCESS"], CUser::GetUserGroup($USER->GetID())))
			return false;
	}
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'faq_'.$arParams["IBLOCK_ID"];
	$cache_dir_path = '/faq_'.$arParams["IBLOCK_ID"].'/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["faq_".$arParams["IBLOCK_ID"]]) && (count($res["faq_".$arParams["IBLOCK_ID"]]) > 0))
		  $arResult = array_merge($arResult, $res["faq_".$arParams["IBLOCK_ID"]]);
	}
	else
	{
		$sections = CIBlockSection::GetList(
			array("SORT" => "ASC"), 
			array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "CNT_ACTIVE" => "Y"), 
			true,
			array("IBLOCK_ID", "ACTIVE", "ELEMENT_SUBSECTIONS", "CNT_ACTIVE", "ID", "NAME")
		);
		while($section = $sections->GetNext()) {
			$arResult["DIRECTIONS"][] = array("ID" => $section["ID"], "NAME" => $section["NAME"], "ELEMENT_CNT" => $section["ELEMENT_CNT"]);
		}
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array("faq_".$arParams["IBLOCK_ID"] => $arResult));
		}
	}
	$filter = array();
	if(!empty($_REQUEST) && strlen($_REQUEST["search"]) > 1) {		
		if(strlen($_REQUEST["search"]) > 1)
			$filter[]=array(
				"LOGIC" => "OR",
				array("PROPERTY_QUESTION" => "%".$_REQUEST["search"]."%"),
				array("PROPERTY_ANSWER" => "%".$_REQUEST["search"]."%")
			);
	}
	if($_REQUEST["directions"] > 0)
		$filter[] = array("SECTION_ID" => $_REQUEST["directions"]);
	$GLOBALS["arrFilter"] = $filter;
	$this->IncludeComponentTemplate();
}
?>