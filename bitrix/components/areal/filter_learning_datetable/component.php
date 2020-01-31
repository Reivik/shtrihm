<?
if(CModule::IncludeModule("iblock"))
{
	$cache = new CPHPCache();
	$cache_time = 3600;
	$cache_id = 'filter_timetable';
	$cache_path = '/filter_timetable/';
	$arResult = array();
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["filter_timetable"]) && (count($res["filter_timetable"]) > 0))
		  $arResult = array_merge($arResult, $res["filter_timetable"]);
	}
	else 
	{
		$arResult = GetLocationInformation();
		/*$types = CIBlockPropertyEnum::GetList(	
			array("DEF"=>"DESC", "SORT"=>"ASC"), 
			array("IBLOCK_ID" => IB_PROGRAMMS, "CODE" => "TYPE_COMPANY")
		);
		while($type = $types->GetNext())
			$arResult["FILTER"]["TYPE_OF_COMPANY"][] = $type["VALUE"];
		
		$persons = CIBlockPropertyEnum::GetList(	
			array("DEF"=>"DESC", "SORT"=>"ASC"), 
			array("IBLOCK_ID" => IB_PROGRAMMS, "CODE" => "PERSON")
		);
		while($person = $persons->GetNext())
			$arResult["FILTER"]["PERSONA"][] = $person["VALUE"];

		foreach($arResult["FILTER"]["TYPE_OF_COMPANY"] as $type_comp) {
			foreach($arResult["FILTER"]["PERSONA"] as $pers) {
				unset($programs);
				unset($program);*/
				$programs = CIBlockElement::GetList(
					array(),
					array("IBLOCK_ID" => IB_PROGRAMMS, "ACTIVE" => "Y", "PROPERTY_PERSON_VALUE" => $pers, "PROPERTY_TYPE_COMPANY_VALUE" => $type_comp),
					false,
					false,
					array("NAME", "ID", "PROPERTY_PERSON", "PROPERTY_TYPE_COMPANY", "PROPERTY_DURATION")
				);
				while($program = $programs->GetNext()) {
					$arResult["FILTER"]["THEME"][$program["ID"]] = array("ID" => $program["ID"], "NAME" => $program["~NAME"], "TYPE_COMPANY" => $type_comp, "PERSON" => $pers);
					$arResult["FILTER"]["DURATION"][] = $program["PROPERTY_DURATION_VALUE"];
				}
			/*}
		}*/
		$arResult["FILTER"]["DURATION"] = array_unique($arResult["FILTER"]["DURATION"]);
		
		$forms = CIBlockElement::GetList(
			array(),
			array("IBLOCK_ID" => IB_TIMETABLE, "ACTIVE" => "Y"),
			false,
			false,
			array("PROPERTY_FORM")
		);
		while($form = $forms->GetNext())
			$arResult["FILTER"]["FORM"][] = $form["PROPERTY_FORM_VALUE"];
		$arResult["FILTER"]["FORM"] = array_unique($arResult["FILTER"]["FORM"]);
		
		$arResult["FILTER"]["MONTH"] = array(
			1 => "Январь",
			2 => "Февраль",
			3 => "Март",
			4 => "Апрель",
			5 => "Май",
			6 => "Июнь",
			7 => "Июль",
			8 => "Август",
			9 => "Сентябрь",
			10 => "Октябрь",
			11 => "Ноябрь",
			12 => "Декабрь"
		);
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_id, $cache_path);
			$cache->EndDataCache(array("filter_timetable" => $arResult));
		}
	}
	
	/*if(isset($_REQUEST["region"]))
		$arResult["SELECTED_REGION"] = $_REQUEST["region"];	
	if(isset($_REQUEST["town"]))
		$arResult["SELECTED_TOWN"] = $_REQUEST["town"];*/
	$filter_theme = array("IBLOCK_ID" => IB_PROGRAMMS, "ACTIVE" => "Y");
	/*if($_REQUEST["type_of_company"])
		$filter_theme = array_merge($filter_theme, array("PROPERTY_TYPE_COMPANY_VALUE" => $_REQUEST["type_of_company"]));
	if($_REQUEST["person"])
		$filter_theme = array_merge($filter_theme, array("PROPERTY_PERSON_VALUE" => $_REQUEST["person"]));*/
	if($_REQUEST["theme"])
		$filter_theme = array_merge($filter_theme, array("NAME" => $arResult["FILTER"]["THEME"][$_REQUEST["theme"]]));
	if($_REQUEST["duration"])
		$filter_theme = array_merge($filter_theme, array("PROPERTY_DURATION" => $_REQUEST["duration"]));
	if($_REQUEST["search_name"])
		$filter_theme = array_merge($filter_theme, array(
			 array(
				"LOGIC" => "OR",
				array("PROPERTY_PURPOSE" => "%".$_REQUEST["search_name"]."%"),
				array("PROPERTY_REQUIREMENT" => "%".$_REQUEST["search_name"]."%"),
				array("PROPERTY_CONTENTS" => "%".$_REQUEST["search_name"]."%"),
				
			)
		));
	
	$select = array("ID", "NAME", "PROPERTY_PURPOSE", "PROPERTY_REQUIREMENT", "PROPERTY_CONTENTS", "PROPERTY_DURATION"/* "PROPERTY_PERSON", "PROPERTY_TYPE_COMPANY"*/);
	$progs = CIBlockElement::GetList(array(), $filter_theme, false, false, $select);
	while($prog = $progs->GetNext())
		$arFilter_themes[] = $prog["ID"];
	
	
	$filter_center = array("IBLOCK_ID" => IB_LEARNING_CENTER, "ACTIVE" => "Y");
	
	if((isset($_REQUEST["region"]) && $_REQUEST["region"] > 0))
		$filter_center = array_merge($filter_center, array("PROPERTY_REGION" => $_REQUEST["region"]));
	if((isset($_REQUEST["town"]) && $_REQUEST["town"] > 0))
		$filter_center = array_merge($filter_center, array("PROPERTY_CITY" => $_REQUEST["town"]));
		
	/*if($arResult["SELECTED_REGION"] > 0)
		$filter_center = array_merge($filter_center, array("PROPERTY_REGION" => $arResult["SELECTED_REGION"]));
	if($arResult["SELECTED_TOWN"] > 0)
		$filter_center = array_merge($filter_center, array("PROPERTY_CITY" => $arResult["SELECTED_TOWN"]));*/
		

	$centers = CIBlockElement::GetList(array(), $filter_center, false, false, array("ID", "PROPERTY_REGION", "PROPERTY_CITY"));
	while($center = $centers->GetNext())
		$arFilter_center[] = $center["ID"];
	if(count($arFilter_themes) == 0)
		$arFilter_themes = array("-1");
	if(count($arFilter_center) == 0)
		$arFilter_center = array("-1");
		
	
	$main_filter = array("IBLOCK_ID" => IB_TIMETABLE, /* ">=DATE_ACTIVE_TO" => ConvertTimeStamp(), */ "ACTIVE" => "Y");
	$main_filter = array_merge($main_filter, array("PROPERTY_THEME" => $arFilter_themes), array("PROPERTY_LEARNING_CENTER" => $arFilter_center));
	if($_REQUEST["form"])
		$main_filter = array_merge($main_filter, array("PROPERTY_FORM" => $_REQUEST["form"]));
	
	$curr_date = date($DB->DateFormatToPHP(CLang::GetDateFormat("SHORT")), mktime(date("h"), date("i"), date("s"), date("m"), date("d"), date("Y")));
	
	//сортировка по актуальности программы
	
	if($_REQUEST["archive"] == 2)
		$main_filter = array_merge($main_filter, array("<=DATE_ACTIVE_TO" => ConvertTimeStamp()));
	if($_REQUEST["archive"] == 1 || !isset($_REQUEST["archive"]))
		$main_filter = array_merge($main_filter, array(">=DATE_ACTIVE_TO" => $curr_date));	

	//сортировка по месяцу (реализовать)
	$currentYear = date('Y');
	
	$grafics = CIBlockElement::GetList(array("DATE_ACTIVE_FROM" => "DESC"), $main_filter, false, false, array("ID", "PROPERTY_LEARNING_CENTER", "PROPERTY_THEME", "PROPERTY_FORM", "DATE_ACTIVE_TO", "DATE_ACTIVE_FROM"));
	while($grafic = $grafics->GetNext()) $arrFilter["ID"][] = $grafic["ID"];
	if(count($arrFilter["ID"]) == 0)
		$arrFilter["ID"] = array("-1");
	//pr($arrFilter);

	$GLOBALS["arrFilter"] = $arrFilter;	
	$this->IncludeComponentTemplate();	
}
?>