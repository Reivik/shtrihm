<?
if(CModule::IncludeModule("iblock"))
{
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'clients_main';
	$cache_dir_path = '/clients_main/';
	if($arParams["PAGE"]=='')
		$arParams["PAGE"]='/press_center/clients/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
		$res = $cache->GetVars();
		if (is_array($res["clients_main"]) && (count($res["clients_main"]) > 0))
			$arResult = array_merge($arResult, $res["clients_main"]);
	}
	else 
	{
		$elements = CIBlockElement::GetList(array("SORT" => "ASC", "ID" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "!PROPERTY_TO_INDEX" => false), false, array("nTopCount" => 8), array("ID", "CODE", "NAME", "PREVIEW_PICTURE"));
		while($element = $elements->GetNext()) {
			if(!empty($element["PREVIEW_PICTURE"]))
				$prev_picture = CFile::ResizeImageGet( 
					$element["PREVIEW_PICTURE"], 
					array("width" => 95, "height" => 51), 
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
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
			$cache->EndDataCache(array("clients_main" => $arResult));
		}
	}
	$this->IncludeComponentTemplate();
}
?>