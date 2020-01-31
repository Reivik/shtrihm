<?
if(CModule::IncludeModule("iblock"))
{	
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'introduction_filter';
	$cache_dir_path = '/introduction_filter/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["introduction_filter"]) && (count($res["introduction_filter"]) > 0))
		  $arResult = array_merge($arResult, $res["introduction_filter"]);
	}
	else 
	{
		// Получение массива типов объектов, продуктов, городов и компаний
		$objType = CIBlockPropertyEnum::GetList(
			array(),
			array("IBLOCK_ID" => IB_INTRO, "PROPERTY_ID" => "TYPE")
		);
		while($arType = $objType->GetNext())
			$arTypes[$arType["ID"]] = $arType["VALUE"];

		$prods = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_PRODUCTS, "ACTIVE" => "Y"), false, false, array("ID", "NAME"));
		while($prod = $prods->GetNext())
			$arProducts[$prod["ID"]] = $prod["NAME"];
		
		$companies = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_COMPANY, "ACTIVE" => "Y"), false, false, array("ID", "NAME"));
		while($company = $companies->GetNext())
			$arCompany[$company["ID"]] = $company["NAME"];
		
		$arResult["TYPE"] = $arTypes;
		$arResult["PRODUCT"] = $arProducts;
		$arResult["COMPANY"] = $arCompany;
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array("introduction_filter" => $arResult));
		}
	}
	
	$result = GetLocationInformation();
	$arResult = array_merge($arResult, $result);
	
	if(isset($_REQUEST["country"]))
		$arResult["SELECTED_COUNTRY"] = $_REQUEST["country"];		
	if(isset($_REQUEST["region"]))
		$arResult["SELECTED_REGION"] = $_REQUEST["region"];	
	if(isset($_REQUEST["town"]))
		$arResult["SELECTED_TOWN"] = $_REQUEST["town"];
	
	$filter = array();
	if($arResult["SELECTED_COUNTRY"] > 0)
		$filter = array_merge($filter, array("PROPERTY_COUNTRY" => $arResult["SELECTED_COUNTRY"]));
	if($arResult["SELECTED_REGION"] > 0)
		$filter = array_merge($filter, array("PROPERTY_REGION" => $arResult["SELECTED_REGION"]));
	if($arResult["SELECTED_TOWN"] > 0 && count($_REQUEST)>1) //count($_REQUEST)>1 это нужно для того чтобы выводилось при открытии страницы все фильтрация не по определенному городу а по всему региону
		$filter = array_merge($filter, array("PROPERTY_CITY" => $arResult["SELECTED_TOWN"]));
	if(isset($_REQUEST["type"]) && $_REQUEST["type"] != 0)
		$filter = array_merge($filter, array("PROPERTY_TYPE" => $_REQUEST["type"]));
	if(isset($_REQUEST["product"]) && $_REQUEST["product"] != 0)
		$filter = array_merge($filter, array(array("LOGIC" => "OR", "PROPERTY_EQUIPMENT" => $_REQUEST["product"], "PROPERTY_SOFTWARE" => $_REQUEST["product"])));
	if(isset($_REQUEST["company"]) && $_REQUEST["company"] != 0)
		$filter = array_merge($filter, array("PROPERTY_PARTNER" => $_REQUEST["company"]));
	if(isset($_REQUEST["search"]))
		$filter["NAME"] = "%".$_REQUEST["search"]."%";
	//pr($filter);
	$GLOBALS["arrFilter"] = $filter;
	$this->IncludeComponentTemplate();
}
?>