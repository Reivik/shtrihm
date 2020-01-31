<?
function isBot(){
    $interestingCrawlers = array( 'google', 'yahoo', 'yandex', 'googlebot');
    $pattern = '/(' . implode('|', $interestingCrawlers) .')/';
    $matches = array();
    preg_match($pattern, strtolower($_SERVER['HTTP_USER_AGENT']), $matches);


    if(count($matches) > 0) // Found a match
    {
        return true;
    }else{
        return false;
    }

}


function CityDefinition() {

    session_start();
    
    
	global $USER;
    $isGoogleBot = isBot();
	
// 				echo '<input type="hidden" id="intemediate" name = "intemediate" value="true">';
	if(empty($_SESSION["SHTRIH_COUNTRY"]) && empty($_SESSION["SHTRIH_REGION"]) && empty($_SESSION["SHTRIH_TOWN"]) && !$isGoogleBot)
	{
/*
		if($_SERVER["REMOTE_ADDR"] == "192.168.1.254") {
			$arIP = explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]);
			$ip=trim($arIP[count($arIP)-2]);
		}
		else $ip = trim($_SERVER["REMOTE_ADDR"]);
*/
		//$ip = "195.208.131.1"; //Новосибирск
		//$ip = "93.85.176.0"; //Беларусь
		//$ip = "93.85.200.0"; //Гомель
		//$ip = "46.255.232.0";//Казахстан
		//$ip = "109.167.0.0";//Украина
		//$ip = "95.142.81.0"; //Азер

		$ip = trim($_SERVER["REMOTE_ADDR"]);
/*
		$urlchoise = "http://ipgeobase.ru:7020/geo?ip=".$ip;
		$ctxchoise = stream_context_create(array('http' => array('timeout' => 3)));
		$contentschoise = @file_get_contents($urlchoise, false, $ctxchoise);
		$datachoise = new SimpleXMLElement($contentschoise);

		if($datachoise->ip->country[0]->asXML() == "<country>RU</country>"){
		
			$url = "http://ipgeobase.ru:7020/geo?ip=".$ip;
			$ctx = stream_context_create(array('http' => array('timeout' => 3)));
			$contents = @file_get_contents($url, false, $ctx);

			if(!$contents) {
				$country = RUSF;
				$region = MOSCOW_REGION;
				$town = MOSCOW;
			}
			else {
				$data = new SimpleXMLElement($contents);
				if($data->ip->message|| !$data->ip->country || !$data->ip->region || !$data->ip->city) {
					$country = RUSF;
					$region = MOSCOW_REGION;
					$town = MOSCOW;
				}
				else {
					if($data->ip) {

						$country=$data->ip->country[0]->asXML();
						$region=$data->ip->region[0]->asXML();
						$town=$data->ip->city[0]->asXML();

						if($country) {
							$country=explode("</country>", $country);
							$country=explode("<country>", $country[0]);
							$country=$country[1];
						}
						else $country = RF;

						if($region) {
							$region=explode("</region>", $region);
							$region=explode("<region>", $region[0]);
							$region=$region[1];
						}
						else $region = MOSCOW_REGION;

						if($town) {
							$town=explode("</city>", $town);
							$town=explode("<city>", $town[0]);
							$town=$town[1];
						}
						else $town = MOSCOW;
					}
				}
					// echo "<br><br><br>";
					// pr($country);
					// pr($region);
					// pr($town);
				if($country && $region && $town) {
					$_SESSION["SHTRIH_COUNTRY"] = $country == "RU" ? "Российская Федерация" : $country;
					$_SESSION["SHTRIH_REGION"] = $region;
					$_SESSION["SHTRIH_TOWN"] = $town;
				}
			}
		}
else{
			
*/
		/**
/закоментировано по причине неработоспособности
*/
		//$url = "http://api.sypexgeo.net/xml/".$ip;
		//$ctx = stream_context_create(array('http' => array('timeout' => 3)));
		//$contents = @file_get_contents($url, false, $ctx);

			if(!$contents) {				
				$country = RUSF;
				$region = MOSCOW_REGION;
				$town = MOSCOW;
			}
			else 
			{				
				$data = new SimpleXMLElement($contents);//pr($data);
				if(/*$data->ip->message ||*/ !$data->ip->region->name_ru || !$data->ip->city->name_ru) {					
					$country = RUSF;
					$region = MOSCOW_REGION;
					$town = MOSCOW;
				}else{
					
					if($data->ip) {

						$country=$data->ip->country->name_ru[0]->asXML();
						$region=$data->ip->region->name_ru[0]->asXML();
						$town=$data->ip->city->name_ru[0]->asXML();

						if($country) {
							$country=explode("</name_ru>", $country);
							$country=explode("<name_ru>", $country[0]);
							$country=$country[1];
						}
						else $country = RF;

						if($town) {
							$town=explode("</name_ru>", $town);
							$town=explode("<name_ru>", $town[0]);
							$town=$town[1];
						}
						else $town = MOSCOW;

						CModule::IncludeModule("iblock");
						$havetowns = CIBlockElement::GetList(
							array("NAME" => "ASC"),
							array("IBLOCK_ID" => IB_CITIES, "ACTIVE" => "Y", "NAME" => $town),
							false,
							false,
							array("ID", "NAME", "PROPERTY_REGION")
						);
						while($havetown = $havetowns->GetNext()){
							if($havetown["PROPERTY_REGION_VALUE"]){
								$findtown = $havetown["PROPERTY_REGION_VALUE"];
							}
						}

						$haveregions = CIBlockElement::GetList(
							array("NAME" => "ASC"),
							array("IBLOCK_ID" => IB_REGIONS, "ACTIVE" => "Y", "ID" => $findtown),
							false,
							false,
							array("ID", "NAME")
						);
						while($haveregion = $haveregions->GetNext()){
							$findregion = $haveregion["NAME"];
						}

						if($findregion){
							$region=$findregion;
						}
						else{
							if($region) {
								$region=explode("</name_ru>", $region);
								$region=explode("<name_ru>", $region[0]);
								$region=$region[1];
							}

						else $region = MOSCOW_REGION;
						}
					}
				}
					// echo "<br><br><br>";
					// pr($country);
					// pr($region);
					// pr($town);
					// echo 2;				
					$country = ($country=="Россия") ? "Российская Федерация" : $country;
				if($country && $region && $town) {
					$_SESSION["SHTRIH_COUNTRY"] = $country == "RU" ? "Российская Федерация" : $country;
					$_SESSION["SHTRIH_REGION"] = $region;
					$_SESSION["SHTRIH_TOWN"] = $town;
				}
				return true;
			}
		/* } */
	}else{
		/* print_r($_SESSION); */
		return false;
	}
}

//функция возвращает массив стран, городов и регионов(кешируется)
function GetLocationInformation() {
	$cache = new CPHPCache();
	$cache_time = 3600;
	$cache_id = 'regions';
	$cache_path = '/regions/';
	$result = array();
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["regions"]) && (count($res["regions"]) > 0))
		  $result = array_merge($result, $res["regions"]);
	}
	else 
	{
		CModule::IncludeModule("iblock");
		$countries = CIBlockElement::GetList(
			array("NAME" => "ASC"), 
			array("IBLOCK_ID" => IB_COUNTRIES, "ACTIVE" => "Y"), 
			false, 
			false, 
			array("ID", "NAME", "CODE")
		);
		
		while($country = $countries->GetNext()) {
			unset($regions);
			unset($region);
			$regions = CIBlockElement::GetList(
				array("NAME" => "ASC"), 
				array("IBLOCK_ID" => IB_REGIONS, "ACTIVE" => "Y", "PROPERTY_COUNTRY" => $country["ID"]), 
				false, 
				false, 
				array("ID", "NAME")
			);
			while($region = $regions->GetNext()) {
				unset($towns);
				unset($town);
				$towns = CIBlockElement::GetList(
					array("NAME" => "ASC"), 
					array("IBLOCK_ID" => IB_CITIES, "ACTIVE" => "Y", "PROPERTY_REGION" => $region["ID"]), 
					false, 
					false, 
					array("ID", "NAME")
				);
				while($town = $towns->GetNext()){
					$result["TOWNS"][$region["ID"]][$town["ID"]] = $town["NAME"];
				}
				if(count($result["TOWNS"][$region["ID"]]) > 0)
					$result["REGIONS"][$country["ID"]][$region["ID"]] = $region["NAME"];
			}			
			if(count($result["REGIONS"][$country["ID"]]) > 0)
				$result["COUNTRIES"][$country["ID"]] = $country["NAME"];
		}
				
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_id, $cache_path);
			$cache->EndDataCache(array("regions" => $result));
		}		
	}	
	foreach($result["COUNTRIES"] as $keyCon => $valueCon) {
		if($valueCon == $_SESSION["SHTRIH_COUNTRY"]){
			$result["SELECTED_COUNTRY"] = $keyCon;
		}
	}	
	if(!empty($result["REGIONS"][$result["SELECTED_COUNTRY"]])) {
		foreach($result["REGIONS"][$result["SELECTED_COUNTRY"]] as $key => $value) {
			if($value == $_SESSION["SHTRIH_REGION"]){
				$result["SELECTED_REGION"] = $key;
			}
		}
	}	
	if(!empty($result["TOWNS"][$result["SELECTED_REGION"]])) {
		foreach($result["TOWNS"][$result["SELECTED_REGION"]] as $k => $v)
			if($v == $_SESSION["SHTRIH_TOWN"])
				$result["SELECTED_TOWN"] = $k;
	}
	return $result;
}

//функция возвращает массив городов и регионов(кешируется)
function GetDirections() {
	$cache = new CPHPCache();
	$cache_time = 3600;
	$cache_id = 'directions_product_for_filter';
	$cache_path = '/directions_product_for_filter/';
	$rest = array();
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_id, $cache_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["directions_product_for_filter"]) && (count($res["directions_product_for_filter"]) > 0))
		  $rest = array_merge($rest, $res["directions_product_for_filter"]);
	}
	else 
	{
		CModule::IncludeModule("iblock");
		$sections = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_PRODUCTS, "ACTIVE" => "Y", "<=DEPTH_LEVEL" => 2), false);
		while($section = $sections->GetNext()) {
			$sect[] = array(
				"ID" => $section["ID"],
				"NAME" => $section["NAME"],
				"IBLOCK_SECTION_ID" => $section["IBLOCK_SECTION_ID"],
				"DEPTH_LEVEL" => $section["DEPTH_LEVEL"]
			);
			$rest["DIRECTIONS"][] = array("ID" => $section["ID"], "NAME" => $section["NAME"], "ELEMENT_CNT" => $section["ELEMENT_CNT"]);
		}
		
		foreach($sect as $depth1)
			if($depth1["DEPTH_LEVEL"] == 1)
				$rest["SECTIONS"][] = array("ID" => $depth1["ID"], "NAME" => $depth1["NAME"], "ITEMS" => array());
		foreach($rest["SECTIONS"] as $key => $item_depth_1)
			foreach($sect as $sec)
				if($sec["DEPTH_LEVEL"] == 2 && $sec["IBLOCK_SECTION_ID"] == $item_depth_1["ID"])
					$rest["SECTIONS"][$key]["ITEMS"][] = array("ID" => $sec["ID"], "NAME" => $sec["NAME"]);
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_id, $cache_path);
			$cache->EndDataCache(array("directions_product_for_filter" => $rest));
		}
	}
	return $rest;
}

function DefineRegionsArray() {
	$res = GetLocationInformation();
	//var_dump(file_exists($_SERVER['DOCUMENT_ROOT'].'/design/js/regions_array.js'));
	//var_dump(is_writable($_SERVER['DOCUMENT_ROOT'].'/design/js/regions_array.js'));
	file_put_contents($_SERVER['DOCUMENT_ROOT'].'/design/js/regions_array.js','var regions = new Array();'); 
		foreach($res["REGIONS"] as $key_reg => $reg)
			foreach($reg as $key_t => $region)
				file_put_contents($_SERVER['DOCUMENT_ROOT'].'/design/js/regions_array.js','regions[regions.length] = {"id" : "'.$key_t.'", "name" : "'.$region.'", "country" : "'.$key_reg."\"};\n",FILE_APPEND);		
	global $APPLICATION;
	$APPLICATION->AddHeadScript('/design/js/regions_array.js');
	DefineTownsArray();
}

function DefineTownsArray() {
 
	$res = GetLocationInformation();
	file_put_contents($_SERVER['DOCUMENT_ROOT'].'/design/js/towns_array.js','var towns = new Array();');  
	/*	foreach($res["TOWNS"] as $key_con => $con)
		foreach($con as $key_reg => $reg)*/
		foreach($res["TOWNS"] as $key_reg => $reg)
			foreach($reg as $key_t => $town)
				file_put_contents($_SERVER['DOCUMENT_ROOT'].'/design/js/towns_array.js','towns[towns.length] = {"id" : "'.$key_t.'", "name" : "'.$town.'", "region" : "'.$key_reg."\"};\n",FILE_APPEND);		
	global $APPLICATION;
	$APPLICATION->AddHeadScript('/design/js/towns_array.js');
}

function FindFilialsByRegion($country, $region, $town, $statuses = array()) {
	//поиск по филиалам
	$fltr = array("IBLOCK_ID" => IB_FILIALS, "ACTIVE" => "Y");
	if($country > 0)
		$fltr = array_merge($fltr, array("PROPERTY_country" => $country));
	if($region > 0)
		$fltr = array_merge($fltr, array("PROPERTY_region" => $region));
	if($town > 0)
		$fltr = array_merge($fltr, array("PROPERTY_town" => $town));

    if(count($statuses) > 0){
        $fltr = array_merge($fltr, array("PROPERTY_status" => $statuses));
    }


	$res = CIBlockElement::GetList(
		array(), 
		$fltr, 
		false, 
		false, 
		array("ID", "PROPERTY_company", "PROPERTY_country", "PROPERTY_region", "PROPERTY_town", 'PROPERTY_status')
	);
	while($result = $res->GetNext()) {
		if($result["PROPERTY_COMPANY_VALUE"] > 0)
			$filter[] = $result["PROPERTY_COMPANY_VALUE"];
	}
	if(count($filter) > 0)
		$filter = array_unique($filter);
	else $filter = array("-1");
	return $filter;
}

function getDateWithTimeText($dateFrom, $dateTo) {

	$MONTH = array(
		"01" => " января ",
		"02" => " февраля ",
		"03" => " марта ",
		"04" => " апреля ",
		"05" => " мая ",
		"06" => " июня ",
		"07" => " июля ",
		"08" => " августа ",
		"09" => " сентября ",
		"10" => " октября ",
		"11" => " ноября ",
		"12" => " декабря "
	);
	$arFromDT = explode(" ", $dateFrom);
	$arToDT = explode(" ", $dateTo);
	$arFrom = explode(".", $arFromDT[0]);
	$arTo = explode(".", $arToDT[0]);
	$arFrom[0] = (int)$arFrom[0];
	$arTo[0] = (int)$arTo[0];
	if(!isset($arFromDT[1]) && !isset($arToDT[1]))
	{
		if($arFrom[0] == $arTo[0] && $arFrom[1] == $arTo[1] && $arFrom[2] == $arTo[2])
			$str = $arFrom[0].$MONTH[$arFrom[1]].$arFrom[2]." г.";
		elseif($arFrom[1] == $arTo[1] && $arFrom[2] == $arTo[2])
			$str = $arFrom[0]." - ".$arTo[0].$MONTH[$arFrom[1]].$arFrom[2]." г.";
		elseif($arFrom[2] == $arTo[2] && $arFrom[1] != $arTo[1])
			$str = $arFrom[0].$MONTH[$arFrom[1]]." - ".$arTo[0].$MONTH[$arTo[1]].$arFrom[2]." г.";
		elseif($arFrom[2] != $arTo[2])
			$str = $arFrom[0].$MONTH[$arFrom[1]].$arFrom[2]." г. - ".$arTo[0].$MONTH[$arTo[1]].$arTo[2]." г.";
		return $str;
	}
	else
	{
		$arFromTime=explode(":", $arFromDT[1]);
		$arToTime=explode(":", $arToDT[1]);
		$str = $arFrom[0].$MONTH[$arFrom[1]].$arFrom[2]." г. ".$arFromTime[0].":".$arFromTime[1].' - '.$arTo[0].$MONTH[$arTo[1]].$arTo[2]." г. ".$arToTime[0].":".$arToTime[1];
		return $str;
	}
}
function getDateText($dateFrom, $dateTo) {
	$MONTH = array(
		"01" => " января ",
		"02" => " февраля ",
		"03" => " марта ",
		"04" => " апреля ",
		"05" => " мая ",
		"06" => " июня ",
		"07" => " июля ",
		"08" => " августа ",
		"09" => " сентября ",
		"10" => " октября ",
		"11" => " ноября ",
		"12" => " декабря "
	);
	$arFromDT = explode(" ", $dateFrom);
	$arToDT = explode(" ", $dateTo);
	$arFrom = explode(".", $arFromDT[0]);
	$arTo = explode(".", $arToDT[0]);
	$arFrom[0] = (int)$arFrom[0];
	$arTo[0] = (int)$arTo[0];
	if($arFrom[0] == $arTo[0] && $arFrom[1] == $arTo[1] && $arFrom[2] == $arTo[2])
		$str = $arFrom[0].$MONTH[$arFrom[1]].'<nobr>'.$arFrom[2]." г.".'</nobr>';
	elseif($arFrom[1] == $arTo[1] && $arFrom[2] == $arTo[2])
		$str = $arFrom[0]." - ".$arTo[0].$MONTH[$arFrom[1]].'<nobr>'.$arFrom[2]." г.".'</nobr>';
	elseif($arFrom[2] == $arTo[2] && $arFrom[1] != $arTo[1])
		$str = $arFrom[0].$MONTH[$arFrom[1]]." - ".$arTo[0].$MONTH[$arTo[1]].'<nobr>'.$arFrom[2]." г.".'</nobr>';
	elseif($arFrom[2] != $arTo[2])
		$str = $arFrom[0].$MONTH[$arFrom[1]].'<nobr>'.$arFrom[2]." г.</nobr> - ".$arTo[0].$MONTH[$arTo[1]].'<nobr>'.$arTo[2]." г.".'</nobr>';
	return $str;
}

function getOneDay($date) {
	$MONTH = array(
		"01" => " января ",
		"02" => " февраля ",
		"03" => " марта ",
		"04" => " апреля ",
		"05" => " мая ",
		"06" => " июня ",
		"07" => " июля ",
		"08" => " августа ",
		"09" => " сентября ",
		"10" => " октября ",
		"11" => " ноября ",
		"12" => " декабря "
	);
	$arDate = explode(".", $date);
	return $arDate[0].$MONTH[$arDate[1]].$arDate[2]." г.";
}
function getDatewithTime($date) {
	$parts = explode(" ", $date);
	$str_date = getOneDay($parts[0]);
	$str_time_parts = explode(":", $parts[1]);
	return $str_date." в ".$str_time_parts[0].":".$str_time_parts[1];
}
function getCurrentMonth($m) {
	$month = array(
		1 => " январе",
		2 => " феврале",
		3 => " марте",
		4 => " апреле",
		5 => " мае",
		6 => " июне",
		7 => " июле",
		8 => " августе",
		9 => " сентябре",
		10 => " октябре",
		11 => " ноябре",
		12 => " декабре"
	);
	return $month[$m];
}
//CityDefinition();
function getTreeList($sections, $type) {				
	foreach($sections as $sec) {
		if($sec["DEPTH_LEVEL"] == 1) {
			$levels[] = $sec;
		}
	}
	foreach($levels as $key => $lev) {
		foreach($sections as $section_2) {
			if($section_2["DEPTH_LEVEL"] == 2 && $section_2["IBLOCK_SECTION_ID"] == $lev["ID"]) {
				$levels[$key]["SECTIONS"][] = $section_2;
			}
		} 
	}
	if(count($levels) > 0) {
		foreach($levels as $k => $level) {
			if(count($level["SECTIONS"]) > 0) {
				foreach($level["SECTIONS"] as $v => $l) {							
					unset($res);
					unset($element);
					$res = CIBlockElement::GetList(
						array("SORT" => "ASC"), 
						array("IBLOCK_ID" => IB_PRODUCTS, "ACTIVE" => "Y", "SECTION_ID" => $l["ID"], "INCLUDE_SUBSECTIONS" => "Y", "PROPERTY_TYPE_VALUE" => $type), 
						false, 
						false, 
						array("IBLOCK_ID", "NAME", "ID", "ACTIVE", "IBLOCK_SECTION_ID", "PROPERTY_type")
					);
					while($element = $res->GetNext()) {
						$levels[$k]["SECTIONS"][$v]["ITEMS"][] = $element;
					}							
				}
			}
		}
	}
	return $levels;
}
function getPeriodByTwoDate($date1, $date2) {
	$MONTH = array(
		"01" => " января ",
		"02" => " февраля ",
		"03" => " марта ",
		"04" => " апреля ",
		"05" => " мая ",
		"06" => " июня ",
		"07" => " июля ",
		"08" => " августа ",
		"09" => " сентября ",
		"10" => " октября ",
		"11" => " ноября ",
		"12" => " декабря "
	);
	$date_time_1 = explode(" ", $date1);
	$date_time_2 = explode(" ", $date2);
	if($date_time_1[0] == $date_time_2[0]) {
		$str = getDateText($date_time_1[0], $date_time_2[0]);
		$time1 = explode(":", $date_time_1[1]);
		$time2 = explode(":", $date_time_2[1]);
		if($time1[2] && $time1[2] == "00")
			unset($time1[2]);
		if($time2[2] && $time2[2] == "00")
			unset($time2[2]);
		$str .= " ".implode(":", $time1)." - ".implode(":", $time2);
	}
	else {
		$time1 = explode(":", $date_time_1[1]);
		$time2 = explode(":", $date_time_2[1]);
		if($time1[2] && $time1[2] == "00")
			unset($time1[2]);
		if($time2[2] && $time2[2] == "00")
			unset($time2[2]);
		$str = getOneDay($date_time_1[0])." ".implode(":", $time1)." - ".getOneDay($date_time_2[0])." ".implode(":", $time2);
	}
	return $str;
}
function washString($str){
	$str=str_replace('&laquo;','«',$str);
	$str=str_replace('&raquo;','»',$str);
	return htmlspecialchars_decode(strip_tags($str),ENT_QUOTES);
}
?>