<?
if(CModule::IncludeModule("iblock"))
{	
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'printing_products';
	$cache_dir_path = '/printing_products/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["printing_products"]) && (count($res["printing_products"]) > 0))
		  $arResult = array_merge($arResult, $res["printing_products"]);
	}
	else 
	{
		$sections = CIBlockSection::GetList(
			array("SORT" => "ASC"), 
			array("IBLOCK_ID" => IB_PRINTING_PRODUCTS, "ACTIVE" => "Y", "CNT_ACTIVE" => "Y"), 
			true,
			array("IBLOCK_ID", "ACTIVE", "ID", "NAME")
		);
		while($section = $sections->GetNext()) {
			$arResult["DIRECTIONS"][] = array("ID" => $section["ID"], "NAME" => $section["NAME"]);
		}
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array("printing_products" => $arResult));
		}
	}
	$filter = array();
	if(!empty($_REQUEST) && strlen($_REQUEST["search"]) > 1) {
		if(strlen($_REQUEST["search"]) > 1) {
			$filter = array_merge(
				array(
					array(
						"NAME" => "%".$_REQUEST["search"]."%",
						"PREVIEW_TEXT" => "%".$_REQUEST["search"]."%",
						"LOGIC" => "OR"
					)
				), 
				$filter
			);
		}
	}
	if($_REQUEST["directions"] > 0)
		$filter["SECTION_ID"] = $_REQUEST["directions"];
	
	$GLOBALS["arrFilter"] = $filter;
	$this->IncludeComponentTemplate();
}