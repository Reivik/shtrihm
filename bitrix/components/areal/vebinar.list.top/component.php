<?
if(CModule::IncludeModule("iblock")) {	
	$cache = new CPHPCache();
	$cache_time = 36000;
	$arResult = array();
	$cache_dir_id = 'vebinars_list_top';
	$cache_dir_path = '/vebinars_list_top/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
		$res = $cache->GetVars();
		if (is_array($res['vebinars_list_top']) && (count($res['vebinars_list_top']) > 0))
			$arResult = array_merge($arResult, $res['vebinars_list_top']);
	}
	else
	{
		$elements = CIBlockElement::GetList(
			array("date_active_from" => "DESC", "sort" => "ASC"),
			array("IBLOCK_ID" => IB_WEBINAR, "ACTIVE" => "Y", "!PROPERTY_TOP" => false, "!PROPERTY_ARCHIVE" => false, "<=DATE_ACTIVE_FROM" => ConvertTimeStamp()), 
			false, 
			array("nTopCount" => 3), 
			array("ID", "NAME", "PROPERTY_TOP", "PREVIEW_PICTURE", "PROPERTY_LEADING", "PROPERTY_VIDEO")
		);
		while($element = $elements->GetNext()) {
			$arResult["ITEMS"][] = array(
				"ID" => $element["ID"],
				"NAME" => $element["NAME"],
				"PREVIEW_PICTURE" => CFile::ResizeImageGet( 
					$element["PREVIEW_PICTURE"], 
					array("width" => 85, "height" => 64), 
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true 
				),
				"LEADING" => $element["PROPERTY_LEADING_VALUE"],
				"VIDEO" => $element["PROPERTY_VIDEO_VALUE"]
			);
		}
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array('vebinars_list_top' => $arResult));
		}
	}
	//pr($arResult["ITEMS"]);
	$this->IncludeComponentTemplate();
}
?>