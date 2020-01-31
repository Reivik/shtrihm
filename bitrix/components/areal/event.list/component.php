<?
if(CModule::IncludeModule("iblock"))
{
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'event_list';
	$cache_dir_path = '/event_list/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["event_list"]) && (count($res["event_list"]) > 0))
		  $arResult = array_merge($arResult, $res["event_list"]);
	}
	else 
	{
		$res = CIBlockElement::GetList(
			array("DATE_ACTIVE_FROM" => "ASC"),
			array("IBLOCK_ID" => IB_EVENTS, "<=DATE_ACTIVE_FROM" => ConvertTimeStamp(), ">=DATE_ACTIVE_TO" => ConvertTimeStamp()),
			false,
			false,
			array("IBLOCK_ID", "NAME", "DETAIL_PAGE_URL", "DATE_ACTIVE_FROM", "DATE_ACTIVE_TO", "PROPERTY_OPEN")
		);
		while($event=$res->GetNext()) {
			$arResult["EVENT"][] = array(
				"NAME" => $event["NAME"],
				"DATE_ACTIVE_FROM" => $event["DATE_ACTIVE_FROM"],
				"DATE_ACTIVE_TO" => $event["DATE_ACTIVE_TO"],
				"DETAIL_PAGE_URL" => $event["DETAIL_PAGE_URL"],
				"OPEN" => ($event["PROPERTY_OPEN_VALUE"] == false) ? false : true
			);
		}
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array("event_list" => $arResult));
		}
	}
	if(!empty($arResult["EVENT"])) {
		foreach($arResult["EVENT"] as $event)
			if((!$USER->IsAuthorized() && $event["OPEN"] == true) || ($USER->IsAuthorized() && in_array(UG_PO, CUser::GetUserGroup($USER->GetID()))) || $event["OPEN"] == true) 
				$arResult["ITEMS"][] = $event;
	}
	$this->IncludeComponentTemplate();
}
?>