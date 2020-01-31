<?
if(CModule::IncludeModule("iblock"))
{
	$cache = new CPHPCache();
	$cache_time = 3600;
	$cache_id = 'learning_main';
	$cache_path = '/learning_main/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["learning_main"]) && (count($res["learning_main"]) > 0))
		  $arResult = array_merge($arResult, $res["learning_main"]);
	}
	else 
	{	
		/*$property_enums_type_of_company = CIBlockPropertyEnum::GetList(
			Array("SORT"=>"ASC"), 
			Array("IBLOCK_ID" => IB_PROGRAMMS, "CODE" => "TYPE_COMPANY")
		);
		while($enum_fields_type_of_company = $property_enums_type_of_company->GetNext())
			$type_of_company[] = $enum_fields_type_of_company["VALUE"];*/
		
		$property_enums_person = CIBlockPropertyEnum::GetList(
			Array("DEF"=>"DESC", "SORT"=>"ASC"), 
			Array("IBLOCK_ID" => IB_PROGRAMMS, "CODE" => "PERSON")
		);
		while($enum_fields_person = $property_enums_person->GetNext())
			$person[] = $enum_fields_person["VALUE"];
		
		//foreach($type_of_company as $type) {
			foreach($person as $per) {
				$res = CIBlockElement::GetList(
					array("SORT" => "ASC"),
					array("IBLOCK_ID" => IB_PROGRAMMS, /*"PROPERTY_TYPE_COMPANY_VALUE" => $type, */"PROPERTY_PERSON_VALUE" => $per),
					false,
					false,
					array("ID", "NAME", "DETAIL_PAGE_URL"/*, "PROPERTY_TYPE_COMPANY"*/, "PROPERTY_PERSON", "SHOTR_IMG", "PREVIEW_PICTURE")
				);
				while($elem = $res->GetNext())
					$arResult[$per][] = array("ID" => $elem["ID"], "NAME" => $elem["~NAME"], "DETAIL_PAGE_URL" => $elem["DETAIL_PAGE_URL"], "SHOTR_IMG" => $elem["SHOTR_IMG"], "PREVIEW_PICTURE" => $elem["PREVIEW_PICTURE"]);				
					//$arResult[$type][$per][] = array("ID" => $elem["ID"], "NAME" => $elem["~NAME"], "DETAIL_PAGE_URL" => $elem["DETAIL_PAGE_URL"]);				
			}
		//}
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_id, $cache_path);
			$cache->EndDataCache(array("learning_main" => $arResult));
		}
	}
	
	$this->IncludeComponentTemplate();
}
?>