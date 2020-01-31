<?
if(CModule::IncludeModule("iblock")) {	
	$cache = new CPHPCache();
	$cache_time = 36000;
	$arResult = array();
	$cache_dir_id = 'news_list_left_small';
	$cache_dir_path = '/news_list_left_small/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
		$res = $cache->GetVars();
		if (is_array($res['news_list_left_small']) && (count($res['news_list_left_small']) > 0))
			$arResult = array_merge($arResult, $res['news_list_left_small']);
	}
	else
	{
		$elements = CIBlockElement::GetList(
			array("sort" => "ASC", "date_active_from" => "DESC"),
			array("IBLOCK_ID" => IB_NEWS, "ACTIVE" => "Y", "<=DATE_ACTIVE_FROM" => ConvertTimeStamp(time(), "FULL"), ">=DATE_ACTIVE_TO" => ConvertTimeStamp(time(), "FULL")), 
			false, 
			false, 
			array("ID", "NAME", "DATE_ACTIVE_FROM", "DATE_ACTIVE_TO", "DETAIL_PAGE_URL", "PROPERTY_OPEN")
		);
		while($element = $elements->GetNext()) {
			$date = explode(" ", $element["DATE_ACTIVE_FROM"]);
			$arResult["ITEMS"][] = array(
				"NAME" => $element["NAME"],
				"DATE" => $date[0],
				"DETAIL_PAGE_URL" => $element["DETAIL_PAGE_URL"],
				"OPEN" => $element["PROPERTY_OPEN_VALUE"] ? true : false
			);
		}
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array('news_list_left_small' => $arResult));
		}
	}
	if(!empty($arResult["ITEMS"])) {
		if($USER->IsAuthorized()) {
			if(in_array(UG_PO, CUser::GetUserGroup($USER->GetID())) || in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())))
				$arResult["ITEMS_LIST"] = $arResult["ITEMS"];
		}
		else {
			foreach($arResult["ITEMS"] as $arItem) 
				if($arItem["OPEN"] != false) 
					$arResult["ITEMS_LIST"][] = $arItem;
		}	
	}
	$this->IncludeComponentTemplate();
}
?>