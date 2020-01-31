<?
if(CModule::IncludeModule("iblock"))
{	
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'event_filter';
	$cache_dir_path = '/event_filter/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["event_filter"]) && (count($res["event_filter"]) > 0))
		  $arResult = array_merge($arResult, $res["event_filter"]);
	}
	else 
	{
		// Получение массива типов объектов, продуктов, городов и компаний
		$objType = CIBlockPropertyEnum::GetList(
			array(),
			array("IBLOCK_ID" => IB_EVENTS, "PROPERTY_ID" => "TYPE")
		);
		while($arType = $objType->GetNext())
			$arResult["TYPE"][] = $arType["VALUE"];
		
		$sec = CIBlockSection::GetList(
			array("SORT" => "ASC"),
			array("IBLOCK_ID" => IB_EVENTS, "ACTIVE" => "Y", "ELEMENT_SUBSECTIONS" => "Y", "CNT_ACTIVE" => "Y"),
			true
		);
		while($section = $sec->GetNext())
			$arResult["SECTION"][$section["ID"]] = $section["NAME"];
		
		$arResult["MONTH"] = array(
			"01" => "январь",
			"02" => "февраль",
			"03" => "март",
			"04" => "апрель",
			"05" => "май",
			"06" => "июнь",
			"07" => "июль",
			"08" => "август",
			"09" => "сентябрь",
			"10" => "октябрь",
			"11" => "ноябрь",
			"12" => "декабрь"
		);
		
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array("event_filter" => $arResult));
		}
	}
	
	$result = GetLocationInformation();
	$arResult = array_merge($arResult, $result);
	
	if(isset($_REQUEST["region"]))
		$arResult["SELECTED_REGION"] = $_REQUEST["region"];	
	if(isset($_REQUEST["town"]))
		$arResult["SELECTED_TOWN"] = $_REQUEST["town"];
	
	$filter = array();
	$arGroups = CUser::GetUserGroup($USER->GetID());
		if(!in_array(UG_PO, $arGroups))
			$filter = array_merge($filter, array("!PROPERTY_OPEN" => false));
	
	if($arResult["SELECTED_REGION"] > 0)
		$filter = array_merge($filter, array("PROPERTY_REGION" => $arResult["SELECTED_REGION"]));
	if($arResult["SELECTED_TOWN"] > 0 && count($_REQUEST)>1) //count($_REQUEST)>1 это нужно для того чтобы выводилось при открытии страницы все фильтрация не по определенному городу а по всему региону
		$filter = array_merge($filter, array("PROPERTY_TOWN" => $arResult["SELECTED_TOWN"]));
	if($_REQUEST["type"])
		$filter = array_merge($filter, array("PROPERTY_TYPE_VALUE" => $_REQUEST["type"]));
	if(!empty($_REQUEST["section"]))
		$filter = array_merge($filter, array("SECTION_ID" => $_REQUEST["section"]));
	
	if(!empty($_REQUEST["day_from"]) && !empty($_REQUEST["month_from"]) && !empty($_REQUEST["year_from"]) && !empty($_REQUEST["day_to"]) && !empty($_REQUEST["month_to"]) && !empty($_REQUEST["year_to"])) {
		$dateFrom = ConvertTimeStamp(mktime(0, 0, 0, $_REQUEST["month_from"], $_REQUEST["day_from"], $_REQUEST["year_from"]), "SHORT", "ru");
		$dateTo = ConvertTimeStamp(mktime(23, 59, 59, $_REQUEST["month_to"], $_REQUEST["day_to"], $_REQUEST["year_to"]), "FULL", "ru");
		$filter = array_merge($filter, array("<=DATE_ACTIVE_FROM" => $dateTo, ">=DATE_ACTIVE_TO" => $dateFrom));
	}
	else {
		$dateFrom = ConvertTimeStamp(mktime(0,0,0,date("m"),date("d"),date("Y")), "SHORT", "ru");
		//$dateTo = ConvertTimeStamp(mktime(0,0,0,date("m")+1,date("d"),date("Y")), "SHORT", "ru");
		$filter = array_merge($filter, array(">=DATE_ACTIVE_TO" => $dateFrom));
	}
	$GLOBALS["arrFilter"] = $filter;
	$this->IncludeComponentTemplate();
}
?>