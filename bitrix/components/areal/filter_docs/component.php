<?
if(CModule::IncludeModule("iblock"))
{
	/*$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'docs_filter';
	$cache_dir_path = '/docs_filter/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
		$res = $cache->GetVars();
		if (is_array($res["docs_filter"]) && (count($res["docs_filter"]) > 0))
			$arResult = array_merge($arResult, $res["docs_filter"]);
	}
	else */
	{
		$property_enums = CIBlockPropertyEnum::GetList(
			array("DEF"=>"DESC", "SORT"=>"ASC"), 
			array("IBLOCK_ID" => IB_CLIENTS, "CODE" => "TYPE")
		);
		while($enum_fields = $property_enums->GetNext())
			$arResult["TYPE"][] = array("ID" => $enum_fields["ID"], "NAME" => $enum_fields["VALUE"]);
		
		$sections = CIBlockSection::GetList(
			array("SORT" => "ASC"), 
			array("IBLOCK_ID" => IB_PRODUCTS, "ACTIVE" => "Y", "CNT_ACTIVE" => "Y"), 
			true,
			array("IBLOCK_ID", "ACTIVE", "ELEMENT_SUBSECTIONS", "CNT_ACTIVE", "ID", "NAME")
		);
		while($section = $sections->GetNext()) {
			$arResult["DIRECTIONS"][] = array("ID" => $section["ID"], "NAME" => $section["NAME"], "ELEMENT_CNT" => $section["ELEMENT_CNT"]);
		}
		/*if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array("docs_filter" => $arResult));
		}*/
	}
	$this->IncludeComponentTemplate();
}
?>