<?
if(CModule::IncludeModule("iblock"))
{
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'offers_'.$arParams["SECTION_ID"];
	$cache_dir_path = '/offers_'.$arParams["SECTION_ID"].'/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
		$res = $cache->GetVars();
		if (is_array($res['offers_'.$arParams["SECTION_ID"]]) && (count($res['offers_'.$arParams["SECTION_ID"]]) > 0))
			$arResult = array_merge($arResult, $res['offers_'.$arParams["SECTION_ID"]]);
	}
	else
	{
		if(isset($arParams["SECTION_ID"]))
			$arFilter = array("IBLOCK_ID" => IB_SPECIALS, "ACTIVE" => "Y", "PROPERTY_SECTION" => $arParams["SECTION_ID"], "<=DATE_ACTIVE_FROM" => ConvertTimeStamp(time(), "FULL"), ">=DATE_ACTIVE_TO" => ConvertTimeStamp(time(), "FULL"));
		else 
			$arFilter = array("IBLOCK_ID" => IB_SPECIALS, "ACTIVE" => "Y", "<=DATE_ACTIVE_FROM" => ConvertTimeStamp(time(), "FULL"), ">=DATE_ACTIVE_TO" => ConvertTimeStamp(time(), "FULL"));
		$objSpec = CIBlockElement::GetList(
			array("sort" => "ASC","date_active_from" => "desc"),
			$arFilter,
			false,
			false,
			array("ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "DETAIL_PAGE_URL", "PROPERTY_OPEN_ACCESS", "PROPERTY_SECTION", "DATE_ACTIVE_FROM", "DATE_ACTIVE_TO")
		);
		while($arSpec = $objSpec->GetNext()) {
			$dateTo = explode(" ", $arSpec["DATE_ACTIVE_TO"]);
			
			$arResult["SPECIALS"][] = array(
				"NAME" => $arSpec["NAME"],
				"PREVIEW_PICTURE" => CFile::ResizeImageGet(
					$arSpec["PREVIEW_PICTURE"],
					array("width" => 62,"height" => 62),
					BX_RESIZE_IMAGE_PROPORTIONAL,
					true					
				),
				"PREVIEW_TEXT" => $arSpec["PREVIEW_TEXT"],
				"DETAIL_PAGE_URL" => $arSpec["DETAIL_PAGE_URL"],
				"OPEN" => $arSpec["PROPERTY_OPEN_ACCESS_VALUE"],
				"DATE_ACTIVE_FROM" => $arSpec["DATE_ACTIVE_FROM"],
				"DATE_ACTIVE_TO" => $dateTo[0]
			);
		}	
		
		if(count($arResult["SPECIALS"]) == 0) {
			$secs = CIBlockSection::GetList(array(), array("IBLOCK_ID" => IB_PRODUCTS, "ID" => $arParams["SECTION_ID"]), false);
			if($sec = $secs->GetNext())
				$IBLOCK_SECTION_ID = $sec["IBLOCK_SECTION_ID"];
			$objSpec = CIBlockElement::GetList(
				array("DATE_ACTIVE_TO" => "DESC", "created" => "DESC"),
				array("IBLOCK_ID" => IB_SPECIALS, "PROPERTY_SECTION" => $IBLOCK_SECTION_ID, "ACTIVE" => "Y", "<=DATE_ACTIVE_FROM" => ConvertTimeStamp(time(), "FULL"), ">=DATE_ACTIVE_TO" => ConvertTimeStamp(time(), "FULL")),
				false,
				false,
				array("ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "DETAIL_PAGE_URL", "PROPERTY_OPEN_ACCESS", "PROPERTY_SECTION", "DATE_ACTIVE_FROM")
			);
			while($arSpec = $objSpec->GetNext()) 
				$arResult["SPECIALS"][] = array(
					"NAME" => $arSpec["NAME"],
					"PREVIEW_PICTURE" => CFile::ResizeImageGet(
						$arSpec["PREVIEW_PICTURE"],
						array("width" => 62,"height" => 62),
						BX_RESIZE_IMAGE_PROPORTIONAL,
						true					
					),
					"PREVIEW_TEXT" => $arSpec["PREVIEW_TEXT"],
					"DETAIL_PAGE_URL" => $arSpec["DETAIL_PAGE_URL"],
					"OPEN" => $arSpec["PROPERTY_OPEN_ACCESS_VALUE"],
					"DATE_ACTIVE_FROM" => $arSpec["DATE_ACTIVE_FROM"]
				);
		}
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array('offers_'.$arParams["SECTION_ID"] => $arResult));
		}
	}
	if($USER->IsAuthorized()) {
		if(in_array(UG_PO, CUser::GetUserGroup($USER->GetID())) || in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())))
			$specials = $arResult["SPECIALS"];
	}
	else {
		if(!empty($arResult["SPECIALS"]))
			foreach($arResult["SPECIALS"] as $item)
				if($item["OPEN"] == true)
					$specials[] = $item;
	}
	unset($arResult["SPECIALS"]);
	$arResult["SPECIALS"] = $specials;
	
	$this->IncludeComponentTemplate();
}
?>