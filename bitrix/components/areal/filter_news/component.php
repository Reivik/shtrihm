<?
if(CModule::IncludeModule("iblock"))
{	
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'news_filter';
	$cache_dir_path = '/news_filter/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["news_filter"]) && (count($res["news_filter"]) > 0))
		  $arResult = array_merge($arResult, $res["news_filter"]);
	}
	else 
	{
		//Получение списка разделов из блока новостей
		$objSections = CIBlockSection::GetList(
			array("SORT"=>"ASC"),
			array("IBLOCK_ID" => IB_NEWS, "ACTIVE" => "Y"),
			true,
			array("ID", "NAME", "CODE")
		);
		while($arSection = $objSections->GetNext())
			$arResult["SECTIONS"][] = $arSection;
		$arResult["MONTH"] = array(
			"01" => GetMessage("January"),
			"02" => GetMessage("February"),
			"03" => GetMessage("March"),
			"04" => GetMessage("April"),
			"05" => GetMessage("May"),
			"06" => GetMessage("June"),
			"07" => GetMessage("July"),
			"08" => GetMessage("August"),
			"09" => GetMessage("September"),
			"10" => GetMessage("October"),
			"11" => GetMessage("November"),
			"12" => GetMessage("December")
		);
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array("news_filter" => $arResult));
		}
	}
	
	$filter = array();
	if(!empty($_REQUEST["sections"]))
		$filter = array_merge($filter, array("SECTION_ID" => $_REQUEST["sections"]));
	$arGroups = CUser::GetUserGroup($USER->GetID());
		if(!in_array(UG_PO, $arGroups) || !in_array(UG_AKP, $arGroups))
			$filter = array_merge($filter, array("!PROPERTY_OPEN" => false));
	if($_REQUEST["day_from"] > 0 && $_REQUEST["month_from"] > 0 && $_REQUEST["year_from"] > 0 && $_REQUEST["day_to"] > 0 && $_REQUEST["month_to"] > 0 && $_REQUEST["year_to"] > 0) {
		$dateFrom = ConvertTimeStamp(mktime(0, 0, 0, $_REQUEST["month_from"], $_REQUEST["day_from"], $_REQUEST["year_from"]), "SHORT", "ru");
		$dateTo = ConvertTimeStamp(mktime(0, 0, 0, $_REQUEST["month_to"], $_REQUEST["day_to"], $_REQUEST["year_to"]), "SHORT", "ru");
		$filter = array_merge($filter, array(">=DATE_ACTIVE_FROM" => $dateFrom, "<=DATE_ACTIVE_FROM" => $dateTo));
	}
	/*else {
		$dateFrom = ConvertTimeStamp(mktime(0,0,0,date("m"),date("d"),date("Y")), "SHORT", "ru");
		$dateTo = ConvertTimeStamp(mktime(0,0,0,date("m")+1,date("d"),date("Y")), "SHORT", "ru");
		$filter = array_merge($filter, array("<=DATE_ACTIVE_FROM" => $dateTo, ">=DATE_ACTIVE_TO" => $dateFrom));
	}*/
	if(!empty($_REQUEST["search_text"])) {
		$filter_name = array(array(
			"LOGIC" => "OR", 
			"NAME" => "%".$_REQUEST["search_text"]."%",
			"PREVIEW_TEXT" => "%".$_REQUEST["search_text"]."%",
			"DETAIL_TEXT" => "%".$_REQUEST["search_text"]."%",
		));
		$filter = array_merge($filter, $filter_name);
	}
	if(!empty($_REQUEST["relevance"])) {
		if($_REQUEST["relevance"] == 1)
			$filter = array_merge($filter, array("ACTUAL" => 1));
		elseif($_REQUEST["relevance"] == 2)
			$filter = array_merge($filter, array("ACTUAL" => 2));
	}
	$GLOBALS["arrFilter"] = $filter;
	$GLOBALS["archiveFilter"] = $filter;
	
	$this->IncludeComponentTemplate();
}
?>
