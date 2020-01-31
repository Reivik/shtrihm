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
	   if (is_array($res["directions"]) && (count($res["directions"]) > 0) && (count($res['statuses']) > 0))
		  $arResult = array_merge($arResult, $res["directions"], $res['statuses']);
	}
	else 
	{
		$sections = CIBlockSection::GetList(
			array("SORT" => "ASC"), 
			array("IBLOCK_ID" => IB_PRODUCTS, "ACTIVE" => "Y", "CNT_ACTIVE" => "Y"/*, "<=DEPTH_LEVEL" => 3*/), 
			true,
			array("ID", "NAME")
		);
		while($section = $sections->GetNext()) {
			/*$partners = 0;
			$partners = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_COMPANY, "ACTIVE" => "Y", "PROPERTY_DIRECTION" => $section["ID"]), array(), false, array());
			if($partners > 0)	*/
			$arResult["DIRECTIONS"][] = array("ID" => $section["ID"], "NAME" => $section["NAME"]);
		}

		/** Статусы */

        $statusesDb = CIBlockElement::GetList(
            Array(),
            Array(
                'IBLOCK_TYPE'=>'partners',
                'IBLOCK_ID'=>11,
                'ACTIVE'=>'Y'

            ), false
        );


        while($status = $statusesDb->GetNext())
        {
            $arResult['STATUSES'][$status['ID']] = $status['NAME'];
        }

		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array('directions' => $arResult, 'statuses'=>$arResult['STATUSES']));
		}
	}

	$arResult = array_merge($arResult, GetLocationInformation());
	if(isset($_REQUEST["country"]))
		$arResult["SELECTED_COUNTRY"] = $_REQUEST["country"];						
	if(isset($_REQUEST["region"]) && count($_REQUEST)>1)
		$arResult["SELECTED_REGION"] = $_REQUEST["region"];	
		
	if(isset($_REQUEST["town"]) && count($_REQUEST)>1) 
		$arResult["SELECTED_TOWN"] = $_REQUEST["town"];

    if(isset($_REQUEST["statuses"]) && count($_REQUEST)>1){
        $arResult["SELECTED_STATUSES"] = $_REQUEST["statuses"];
    }


	$filter["ID"] = FindFilialsByRegion($arResult["SELECTED_COUNTRY"], $arResult["SELECTED_REGION"], $arResult["SELECTED_TOWN"], $arResult["SELECTED_STATUSES"]);
	
	if(!empty($_REQUEST) && $_SERVER["REQUEST_METHOD"] == "GET") {


		if(strlen($_REQUEST["search"]) > 1)
			$filter["NAME"] = "%".$_REQUEST["search"]."%";
		if($_REQUEST["directions"] > 0)
			$filter["PROPERTY_DIRECTION"] = $_REQUEST["directions"];

	}
	
	$GLOBALS["arrFilter"] = $filter;
	$this->IncludeComponentTemplate();
}
?>