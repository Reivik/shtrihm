<?
if(CModule::IncludeModule("iblock"))
{

	// $curr_month = (int)date("m");
	// $date_active_from = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")), mktime(0, 0, 0, $curr_month, 1, date("Y")));
	// $date_active_to = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")), mktime(0, 0, 0, $curr_month+1, 1, date("Y")));
	
	$arFilter = array(
		"IBLOCK_ID" => IB_ACHIEVEMENTS, 
		"ACTIVE_DATE" => "Y",
		/* "<=DATE_ACTIVE_FROM" => $date_active_to, 
		">=DATE_ACTIVE_TO" => $date_active_from,  */
		"ACTIVE" => "Y"
	);
	$arSelect = array(
		"NAME", 
		"CODE",
		"PROPERTY_COMPANY", 
		"PROPERTY_COMPANY.NAME", 
		"PROPERTY_COMPANY.DETAIL_PAGE_URL", 
		"PROPERTY_COMPANY.PREVIEW_PICTURE",
		"PROPERTY_NOMINATION"
	);
	$res = CIBlockElement::GetList(array("SORT" => "ASC"), $arFilter, false, false, $arSelect);
	while($elem = $res->GetNext())
	{
		if($elem["PROPERTY_NOMINATION_VALUE"])
			$nomination = CFile::ResizeImageGet($elem["PROPERTY_NOMINATION_VALUE"], array("width" => 118, "height" => 118), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		
		if($elem["PROPERTY_COMPANY_PREVIEW_PICTURE"])
			$previewPicture = CFile::ResizeImageGet($elem["PROPERTY_COMPANY_PREVIEW_PICTURE"], array("width" => 118, "height" => 118), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			
		$arResult["COMPANIES"][] = array(
			"NAME" => $elem["PROPERTY_COMPANY_NAME"],
			"NOMINATION" => $nomination,
			"DETAIL_PAGE_URL" => "/partners_info/achievements/".$elem["CODE"]."/",
			"PICTURE" => $previewPicture
		);
		$nomination = "";
		$previewPicture = "";
	}
	



	/* $curr_month = (int)date("m"); $flag = 0;
	while($curr_month > 0 && $flag == 0) {
		$date_active_from = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")), mktime(0, 0, 0, $curr_month, 1, date("Y")));
		$date_active_to = date($DB->DateFormatToPHP(CLang::GetDateFormat("FULL")), mktime(0, 0, 0, $curr_month+1, 1, date("Y")));
		$res = CIBlockElement::GetList(array("cnt" => "desc", "SORT" => "ASC"), array("IBLOCK_ID" => IB_ACHIEVEMENTS, "<=DATE_ACTIVE_FROM" => $date_active_to, ">=DATE_ACTIVE_TO" => $date_active_from, "ACTIVE" => "Y"), array("PROPERTY_COMPANY"), false, array("NAME", "PROPERTY_COMPANY", "DATE_ACTIVE_FROM", "DATE_ACTIVE_TO", "PROPERTY_COMPANY.NAME", "PROPERTY_COMPANY.DETAIL_PAGE_URL", "PROPERTY_COMPANY.PREVIEW_PICTURE"));
		while($elem = $res->GetNext())
			$arComp[] = array("CNT" => $elem["CNT"], "ID" => $elem["PROPERTY_COMPANY_VALUE"]);
		
		if(!empty($arComp)) {
			foreach($arComp as $comp) {
				unset($companies);
				unset($company);
				$companies = CIBlockElement::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => IB_COMPANY, "ID" => $comp["ID"]), false, false, array("NAME", "DETAIL_PAGE_URL", "PREVIEW_PICTURE"));
				if($company = $companies->GetNext()) {
					$arFilter = Array("IBLOCK_ID"=>41,"PROPERTY_COMPANY"=>$company["ID"], "ACTIVE"=>"Y");
					$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), Array());
					while($ob = $res->GetNextElement()){
						$arFields = $ob->GetFields();
						$code=$arFields["CODE"];
						$text=$arFields["PREVIEW_TEXT"];
						$arProp = $ob->GetProperties();
						$nomination = CFile::ResizeImageGet($arProp["NOMINATION"]["VALUE"], array("width" => 150, "height" => 150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					}
					$arResult["COMPANIES"][] = array(
						"NAME" => $company["NAME"],
						"NOMINATION"=>$nomination,
						"PREVIEW_TEXT"=>$text,
						"DETAIL_PAGE_URL" => "/partners_info/achievements/".$code."/",
						"PICTURE" => CFile::ResizeImageGet($company["PREVIEW_PICTURE"], array("width" => 150, "height" => 150), BX_RESIZE_IMAGE_PROPORTIONAL, true)
					);
				}
			}
			$arResult["MONTH"] = getCurrentMonth($curr_month);
			if(count($arResult["COMPANIES"]) > 0) 
				$flag = 1;
		}
		else {
			$curr_month--;
		}
	} */
	
	
	
	$this->IncludeComponentTemplate();
}
?>