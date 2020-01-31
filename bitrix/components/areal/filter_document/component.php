<?
if(CModule::IncludeModule("iblock"))
{
	{	
		$sections = CIBlockSection::GetList(
			array("SORT" => "ASC"), 
			array("IBLOCK_ID" => IB_DOCS, "ACTIVE" => "Y", "CNT_ACTIVE" => "Y"), 
			true,
			array("IBLOCK_ID", "ACTIVE", "ELEMENT_SUBSECTIONS", "CNT_ACTIVE", "ID", "NAME")
		);
		while($section = $sections->GetNext()) {
			$arResult["DIRECTIONS"][] = array("ID" => $section["ID"], "NAME" => $section["NAME"], "ELEMENT_CNT" => $section["ELEMENT_CNT"]);
		}
		$objType = CIBlockPropertyEnum::GetList(
			array(),
			array("IBLOCK_ID" => IB_DOCS, "PROPERTY_ID" => "TYPE_CONTROL")
		);
		while($arType = $objType->GetNext())
			$arResult["TYPE_CONTROL"][] = $arType["VALUE"];
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
	}
	if(isset($arParams["direction"]) && $arParams["direction"] > 0 && !isset($_REQUEST["direction"]))
		$_REQUEST["direction"] = $arParams["direction"];
	$filter = array();
	if($_REQUEST["direction"])
		$filter = array_merge($filter, array("SECTION_ID" => $_REQUEST["direction"]));
	if(isset($_REQUEST["actual"]) && $_REQUEST["actual"] == 0) 
		$filter = array_merge($filter, array("ACTIVE" => "N"));
	else $filter = array_merge($filter, array("ACTIVE" => "Y"));
	if($_REQUEST["type"])
		$filter = array_merge($filter, array("PROPERTY_TYPE_CONTROL_VALUE" => $_REQUEST["type"]));
	if($_REQUEST["search_name"])
		$filter = array_merge($filter, array("NAME" => "%".$_REQUEST["search_name"]."%"));
	if(!empty($_REQUEST["day_from"]) && !empty($_REQUEST["month_from"]) && !empty($_REQUEST["year_from"]) && !empty($_REQUEST["day_to"]) && !empty($_REQUEST["month_to"]) && !empty($_REQUEST["year_to"])) {
		$dateFrom = ConvertTimeStamp(mktime(0, 0, 0, $_REQUEST["month_from"], $_REQUEST["day_from"], $_REQUEST["year_from"]), "SHORT", "ru");
		$dateTo = ConvertTimeStamp(mktime(0, 0, 0, $_REQUEST["month_to"], $_REQUEST["day_to"], $_REQUEST["year_to"]), "SHORT", "ru");
		$filter = array_merge($filter, array("<=DATE_ACTIVE_FROM" => $dateTo, ">=DATE_ACTIVE_TO" => $dateFrom));
	}
	/*else {
		$dateFrom = ConvertTimeStamp(mktime(0,0,0,date("m"),date("d"),date("Y")), "SHORT", "ru");
		$dateTo = ConvertTimeStamp(mktime(0,0,0,date("m")+1,date("d"),date("Y")), "SHORT", "ru");
		$filter = array_merge($filter, array("<=DATE_ACTIVE_FROM" => $dateTo, ">=DATE_ACTIVE_TO" => $dateFrom));
	}*/
	
	$GLOBALS["arrFilter"] = $filter;
	$this->IncludeComponentTemplate();
}
?>