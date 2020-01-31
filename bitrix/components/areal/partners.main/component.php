<?
if(CModule::IncludeModule("iblock"))
{
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'partners_main';
	$cache_dir_path = '/partners_main/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
		$res = $cache->GetVars();
		if (is_array($res["partners_main"]) && (count($res["partners_main"]) > 0))
			$arResult = array_merge($arResult, $res["partners_main"]);
	}
	else 
	{
		$elements = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "!PROPERTY_TO_INDEX" => false), false, array("nTopCount" => 8), array("ID", "CODE", "NAME", "PREVIEW_PICTURE"));
		while($element = $elements->GetNext()) {
			if(!empty($element["PREVIEW_PICTURE"]))
				$prev_picture = CFile::ResizeImageGet( 
					$element["PREVIEW_PICTURE"], 
					array("width" => 95, "height" => 50), 
					BX_RESIZE_IMAGE_PROPORTIONAL,
					true 
				);
			else $prev_picture = "";
			$arResult["ITEMS"][] = array(
				"NAME" => $element["NAME"],
				"CODE" => $element["CODE"],
				"PREVIEW_PICTURE" => $prev_picture
			);
		}
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array("partners_main" => $arResult));
		}
	}
	$this->IncludeComponentTemplate();
}
?>