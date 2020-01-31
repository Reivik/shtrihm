<?
if(CModule::IncludeModule("iblock"))
{
	$cache = new CPHPCache();
	$cache_time = 3600;
	$cache_id = 'learning_themes';
	$cache_path = '/learning_themes/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["learning_themes"]) && (count($res["learning_themes"]) > 0))
		  $arResult = array_merge($arResult, $res["learning_themes"]);
	}
	else 
	{	
		$property_enums_production = CIBlockPropertyEnum::GetList(
			Array("DEF"=>"DESC", "SORT"=>"ASC"), 
			Array("IBLOCK_ID" => IB_PROGRAMMS, "CODE" => "PRODUCTION")
		);
		while($enum_fields_production = $property_enums_production->GetNext())
			$production[] = $enum_fields_production["VALUE"];
		
			foreach($production as $prod) {
				$res = CIBlockElement::GetList(
					array("SORT" => "ASC"),
					array("IBLOCK_ID" => IB_PROGRAMMS, /*"PROPERTY_TYPE_COMPANY_VALUE" => $type, */"PROPERTY_PRODUCTION_VALUE" => $prod),
					false,
					false,
					array("ID", "NAME", "DETAIL_PAGE_URL"/*, "PROPERTY_TYPE_COMPANY"*/, "PROPERTY_PRODUCTION")
				);
				while($elem = $res->GetNext())
					$arResult[$prod][] = array("ID" => $elem["ID"], "NAME" => $elem["~NAME"], "DETAIL_PAGE_URL" => $elem["DETAIL_PAGE_URL"]);				
			}

		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_id, $cache_path);
			$cache->EndDataCache(array("learning_themes" => $arResult));
		}
	}
	
	$this->IncludeComponentTemplate();
}
?>