<?
if(CModule::IncludeModule("iblock")) {
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'admin_partner';
	$cache_dir_path = '/admin_partner/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["admin_partner"]) && (count($res["admin_partner"]) > 0))
		  $arResult = array_merge($arResult, $res["admin_partner"]);
	}
	else 
	{
		$sections = CIBlockSection::GetList(
				array("SORT" => "ASC"), 
				array("IBLOCK_ID" => IB_PRODUCTS, "ACTIVE" => "Y", "CNT_ACTIVE" => "Y", "<=DEPTH_LEVEL" => 3), 
				true,
				array("IBLOCK_ID", "ACTIVE", "ELEMENT_SUBSECTIONS", "CNT_ACTIVE", "ID", "NAME")
			);
		while($section = $sections->GetNext()) {
			$arResult["DIRECTIONS"][] = array("ID" => $section["ID"], "NAME" => $section["NAME"], "ELEMENT_CNT" => $section["ELEMENT_CNT"]);
		}
		unset($levels);
		$levels = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_PARTNER_LEVEL, "ACTIVE" => "Y"), false, false, array("IBLOCK_ID", "ID", "PROPERTY_SHORT_NAME", "NAME"));
		while($lev = $levels->GetNext()) {
			$arResult["LEVELS"][] = array("ID" => $lev["ID"], "NAME" => $lev["PROPERTY_SHORT_NAME_VALUE"] ? $lev["PROPERTY_SHORT_NAME_VALUE"] : $lev["NAME"]);
		}
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array("admin_partner" => $arResult));
		}
	}
	$arResult = array_merge($arResult, GetLocationInformation());
	if(!empty($_SESSION["FORM_ADMIN_PARTNER"]) && !isset($_REQUEST["send_now"]) && !isset($_REQUEST["new_send"])) {
		foreach($_SESSION["FORM_ADMIN_PARTNER"] as $key => $session)
			$_REQUEST[$key] = $session;
	}
	if(isset($_SESSION["FORM_ADMIN_PARTNER"]["company"]) && $_SESSION["FORM_ADMIN_PARTNER"]["company"] > 0)
		$GLOBALS["ADMIN_CHOOSE_COMPANY"] = $_SESSION["FORM_ADMIN_PARTNER"]["company"];
	if((!empty($_REQUEST["send_ok"]) && $_REQUEST["send_ok"] == "send") || (isset($_REQUEST["company_partner_id"]) && $_REQUEST["company_partner_id"] > 0) || (isset($GLOBALS["ADMIN_CHOOSE_COMPANY"]) && $GLOBALS["ADMIN_CHOOSE_COMPANY"] > 0)) {
		$arFilter = array("IBLOCK_ID" => IB_COMPANY);
		if(isset($_REQUEST["company_partner_id"]) && ($_REQUEST["company_partner_id"] > 0 || $GLOBALS["ADMIN_CHOOSE_COMPANY"] > 0)) {
			$arFilter = array_merge($arFilter, array("ID" => $_REQUEST["company_partner_id"] ? $_REQUEST["company_partner_id"] : $GLOBALS["ADMIN_CHOOSE_COMPANY"]));
		}
		else {
			if($_REQUEST["admin_now_search"])
				$arFilter = array_merge($arFilter, array("NAME" => "%".$_REQUEST["admin_now_search"]."%"));
			if($_REQUEST["admin_now_direction"])
				$arFilter = array_merge($arFilter, array("PROPERTY_DIRECTION" => $_REQUEST["admin_now_direction"]));
			if($_REQUEST["admin_now_level"])
				$arFilter = array_merge($arFilter, array("PROPERTY_PARTNERS_LEVELS" => $_REQUEST["admin_now_level"]));
			if($_REQUEST["admin_now_confirmed"])
				$arFilter = array_merge($arFilter, array("ACTIVE" => $_REQUEST["admin_now_confirmed"]));
		}
		$companies = CIBlockElement::GetList(array(), $arFilter, false, false, array("ID", "NAME", "PROPERTY_DIRECTION", "PROPERTY_PARTNERS_LEVELS", "PREVIEW_PICTURE"));
		while($company = $companies->GetNext()) {
			unset($filial_filter);
			$filials = 0;
			$filial_filter = array("IBLOCK_ID" => IB_FILIALS, "PROPERTY_company" => $company["ID"]);
			 if($_REQUEST["admin_now_region"])
				$filial_filter["PROPERTY_region"] = $_REQUEST["admin_now_region"];
			if($_REQUEST["admin_now_town"])
				$filial_filter["PROPERTY_town"] = $_REQUEST["admin_now_town"];
			$filials = CIBlockElement::GetList(array(), $filial_filter, array());
			if($filials > 0 || (!isset($_REQUEST["admin_now_town"]) && !isset($_REQUEST["admin_now_region"])))
				$arResult["COMPANY"][] = array(
					"ID" => $company["ID"],
					"NAME" => $company["NAME"],
					"PREVIEW_PICTURE" => CFile::ResizeImageGet( 
						$company["PREVIEW_PICTURE"], 
						array("width" => 58, "height" => 58), 
						BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
						true 
					)
				);
		}
		if(isset($_REQUEST["company_partner_id"]) && $_REQUEST["company_partner_id"] > 0 && !empty($arResult["COMPANY"])) {
			$_SESSION["FORM_ADMIN_PARTNER"]["company"] = $_REQUEST["company_partner_id"];
		}
	}
	if(isset($_REQUEST["admin_now_company"]) && $_REQUEST["admin_now_company"] > 0 && $_REQUEST["admin_now_company"] != $_SESSION["FORM_ADMIN_PARTNER"]["company"] && isset($_REQUEST["new_send"])) {
		$_SESSION["FORM_ADMIN_PARTNER"]["region"] = $_REQUEST["admin_now_region"];
		$_SESSION["FORM_ADMIN_PARTNER"]["town"] = $_REQUEST["admin_now_town"];
		$_SESSION["FORM_ADMIN_PARTNER"]["confirmed"] = $_REQUEST["admin_now_confirmed"];
		$_SESSION["FORM_ADMIN_PARTNER"]["direction"] = $_REQUEST["admin_now_direction"];
		$_SESSION["FORM_ADMIN_PARTNER"]["level"] = $_REQUEST["admin_now_level"];
		$_SESSION["FORM_ADMIN_PARTNER"]["search"] = $_REQUEST["admin_now_search"];
		$_SESSION["FORM_ADMIN_PARTNER"]["send_ok"] = $_REQUEST["send_ok"];
		$_SESSION["FORM_ADMIN_PARTNER"]["company"] = $_REQUEST["admin_now_company"];
		$GLOBALS["ADMIN_CHOOSE_COMPANY"] = $_REQUEST["admin_now_company"];
	}
	
	$this->IncludeComponentTemplate();
}
?>