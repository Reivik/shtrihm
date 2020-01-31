<?
if(CModule::IncludeModule("iblock"))
{	
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'directions';
	$cache_dir_path = '/directions/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["directions"]) && (count($res["directions"]) > 0))
		  $arResult = array_merge($arResult, $res["directions"]);
	}
	else 
	{
		$sections = CIBlockElement::GetList(
			array("SORT" => "ASC"), 
			array("IBLOCK_ID" => IB_STATUS_COMPANY, "ACTIVE" => "Y", "CNT_ACTIVE" => "Y"/*, "<=DEPTH_LEVEL" => 3*/), 
			true,
			array("ID", "NAME")
		);
		while($section = $sections->GetNext()) {
			/*$partners = 0;
			$partners = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_COMPANY, "ACTIVE" => "Y", "PROPERTY_DIRECTION" => $section["ID"]), array(), false, array());
			if($partners > 0)	*/
			$arResult["DIRECTIONS"][] = array("ID" => $section["ID"], "NAME" => $section["NAME"]);
		}
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array("directions" => $arResult));
		}
	}
	$arResult = array_merge($arResult, GetLocationInformation());
	if(isset($_REQUEST["country"]))
		$arResult["SELECTED_COUNTRY"] = $_REQUEST["country"];						
	if(isset($_REQUEST["region"]) && count($_REQUEST)>1)
		$arResult["SELECTED_REGION"] = $_REQUEST["region"];	
		
	if(isset($_REQUEST["town"]) && count($_REQUEST)>1) 
		$arResult["SELECTED_TOWN"] = $_REQUEST["town"];
		
	$filter["ID"] = FindFilialsByRegion($arResult["SELECTED_COUNTRY"], $arResult["SELECTED_REGION"], $arResult["SELECTED_TOWN"]);
	
	if(!empty($_REQUEST) && $_SERVER["REQUEST_METHOD"] == "GET") {
		if($_REQUEST["countries"] > 0 || $_REQUEST["regions"] > 0 || $_REQUEST["towns"] > 0) {
			$filter["ID"] = FindFilialsByRegion($_REQUEST["countries"], 
			$_REQUEST["regions"], 
			$_REQUEST["towns"]);
		}
		if(strlen($_REQUEST["search"]) > 1)
			$filter["NAME"] = "%".$_REQUEST["search"]."%";
		if($_REQUEST["directions"] > 0)
			$filter["PROPERTY_DIRECTION"] = $_REQUEST["directions"];
	}
	
	$GLOBALS["arrFilter"] = $filter;
	$this->IncludeComponentTemplate();
}
?>