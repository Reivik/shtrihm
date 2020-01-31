<?
if(CModule::IncludeModule("iblock"))
{
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'directions';
	$cache_dir_path = '/directions/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["directions"]) && (count($res["directions"]) > 0))
		  $arResult = array_merge($arResult, $res["directions"]);
	}
	else 
	{
		//разделы вебинаров
		$sec = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_WEBINAR, "DEPTH_LEVEL" => 1, "ACTIVE" => "Y"), false);
		while($section = $sec->GetNext())
			$arResult["DIRECTIONS"][$section["ID"]] = $section["NAME"];
		
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
			$cache->EndDataCache(array("directions" => $arResult));
		}
	}
		
	$sec = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_WEBINAR, "ACTIVE" => "Y"), false, false, array("PROPERTY_CATEGORY", "PROPERTY_CATEGORY.NAME"));
	while($ob = $sec->GetNext())
		$arIdCategories[$ob["PROPERTY_CATEGORY_VALUE"]] = $ob["PROPERTY_CATEGORY_VALUE"];
		
	$sec = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_PRODUCTS, "ID" => $arIdCategories), false, array("ID", "NAME"));
	while($section = $sec->GetNext())
		$arResult["CATEGORIES"][$section["ID"]] = $section["NAME"];
		
	$filter = array();
	//$filter = array(">=DATE_ACTIVE_TO" => date("d.m.Y H:i:s"));
	if($arParams["ARCHIVE"] == "Y")
		$filter = array_merge($filter, array("!PROPERTY_ARCHIVE" => false, "!PROPERTY_VIDEO" => false, "<=DATE_ACTIVE_FROM" => ConvertTimeStamp()));
	elseif($arParams["ARCHIVE"] == "N") {
		$filter = array_merge($filter, array("PROPERTY_ARCHIVE" => false, ">=DATE_ACTIVE_FROM" => ConvertTimeStamp()));
		if(in_array(UG_VEBINAR_CREATOR, CUser::GetUserGroup($USER->GetID())))
			$filter = array_merge($filter, array("ACTIVE" => ""));
	}
	if(!empty($_REQUEST) && strlen($_REQUEST["submit"]) > 1) {
		if($_REQUEST["directions"] > 0)
			$filter["SECTION_ID"] = $_REQUEST["directions"];
		if(strlen($_REQUEST["search"]) > 1)
			$filter["NAME"] = "%".$_REQUEST["search"]."%";
		if($_REQUEST["categories"] > 0)
			$filter["PROPERTY_CATEGORY"] = $_REQUEST["categories"];
	
		if(!empty($_REQUEST["day_from"]) && !empty($_REQUEST["month_from"]) && !empty($_REQUEST["year_from"])) {
			$dateFrom = ConvertTimeStamp(mktime(0, 0, 0, $_REQUEST["month_from"], $_REQUEST["day_from"], $_REQUEST["year_from"]), "SHORT", "ru");
			$filter = array_merge($filter, array(">=DATE_ACTIVE_FROM" => $dateFrom));
		}
		if(!empty($_REQUEST["day_to"]) && !empty($_REQUEST["month_to"]) && !empty($_REQUEST["year_to"])) {
			$dateTo = ConvertTimeStamp(mktime(0, 0, 0, $_REQUEST["month_to"], $_REQUEST["day_to"], $_REQUEST["year_to"]), "SHORT", "ru");
			$filter = array_merge($filter, array("<=DATE_ACTIVE_FROM" => $dateTo));
		}
		
	}
	
	$GLOBALS["arrFilter"] = $filter;
	$this->IncludeComponentTemplate();
}
?>