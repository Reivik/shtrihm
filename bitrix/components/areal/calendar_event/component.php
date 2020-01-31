<?
if(CModule::IncludeModule("iblock"))
{
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'calendar_event'.$arParams["DATE"];
	$cache_dir_path = '/calendar_event'.$arParams["DATE"].'/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["calendar_event".$arParams["DATE"]]) && (count($res["calendar_event".$arParams["DATE"]]) > 0))
		  $arResult = array_merge($arResult, $res["calendar_event".$arParams["DATE"]]);
	}
	else 
	{
		
		$filter = array(
			"<=DATE_ACTIVE_FROM" => $arParams["DATE"].' 23:59:59',
			">=DATE_ACTIVE_TO" => $arParams["DATE"].' 00:00:00',
			"IBLOCK_ID" => array(IB_EVENTS, IB_CALENDAR_EVENT, IB_TIMETABLE)
		);
		
		$res = CIBlockElement::GetList(
			array("DATE_ACTIVE_FROM" => "ASC"),
			$filter,
			false,
			false,
			array("IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "DATE_ACTIVE_FROM", "DATE_ACTIVE_TO", "PROPERTY_THEME.DETAIL_PAGE_URL", "PROPERTY_OPEN","PROPERTY_EVENT")
		);
		while($event=$res->GetNext()) {
			if($event['PROPERTY_EVENT_VALUE']!='')
				continue;
			$arResult["EVENT"][] = array(
				"NAME" => $event["NAME"],
				"DATE_ACTIVE_FROM" => $event["DATE_ACTIVE_FROM"],
				"DATE_ACTIVE_TO" => $event["DATE_ACTIVE_TO"],
				"DETAIL_PAGE_URL" => $event["PROPERTY_THEME_DETAIL_PAGE_URL"] ? substr($event["PROPERTY_THEME_DETAIL_PAGE_URL"], 1, strlen($event["PROPERTY_THEME_DETAIL_PAGE_URL"])-1) : $event["DETAIL_PAGE_URL"],
				"OPEN" => ($event["IBLOCK_ID"] != IB_TIMETABLE && $event["PROPERTY_OPEN_VALUE"] == false) ? false : true
			);
		}
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array("calendar_event".$arParams["DATE"] => $arResult));
		}
	}
	if(!empty($arResult["EVENT"]))
		foreach($arResult["EVENT"] as $event)
			if((!$USER->IsAuthorized() && $event["OPEN"] == true) || ($USER->IsAuthorized() && in_array(UG_PO, CUser::GetUserGroup($USER->GetID()))) || $event["OPEN"] == true) 
				$arResult["ITEMS"][] = $event;
	$this->IncludeComponentTemplate();
}
?>