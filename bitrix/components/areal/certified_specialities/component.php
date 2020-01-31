<?
if(CModule::IncludeModule("iblock"))
{
	/*if($USER->IsAuthorized()) {
		if(in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_YC, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PO, CUser::GetUserGroup($USER->GetID()))) {*/
			$rsUsers = CUser::GetList(($by="id"), ($order="desc"), array("ID" => $USER->GetID()), array("SELECT" => array("UF_*")));
			$arUsers = $rsUsers->GetNext();
			$company = $arUsers["UF_COMPANY"];
			$qualifs = CIBlockElement::GetList(
				array("SORT" => "ASC"), 
				array("IBLOCK_ID" => IB_PROGRAMMS, "ACTIVE" => "Y"), 
				false, 
				false, 
				array("NAME", "ID")
			);
			while($qualif = $qualifs->GetNext())
				$arResult["PROGRAMMS"][$qualif["ID"]] = $qualif["~NAME"];
			$arResult["MONTH"] = array(
				"01" => GetMessage("January"),
				"02" => GetMessage("February"),
				"03" => GetMessage("March"),
				"04" => GetMessage("April"),
				"05" => GetMessage("May"),
				"06" => GetMessage("June"),
				"07" => GetMessage("July"),
				"08" => GetMessage("August"),
				"09" => GetMessage("September"),
				"10" => GetMessage("October"),
				"11" => GetMessage("November"),
				"12" => GetMessage("December")
			);
			
			if(!empty($_REQUEST["submit"])) {
				$filter = array("IBLOCK_ID" => IB_SERTIFIED_SPECIALIES, /*"PROPERTY_COMPANY" => $company*/"ACTIVE" => "Y");
				if($_REQUEST["day_from"] && $_REQUEST["month_from"] && $_REQUEST["year_from"]) {
					$dateFrom = ConvertTimeStamp(mktime(0, 0, 0, $_REQUEST["month_from"], $_REQUEST["day_from"], $_REQUEST["year_from"]), "SHORT", "ru");
					$filter = array_merge($filter, array(">=DATE_ACTIVE_FROM" => $dateFrom));
				}
				if($_REQUEST["day_to"] && $_REQUEST["month_to"] && $_REQUEST["year_to"]) {
					$dateTo = ConvertTimeStamp(mktime(0, 0, 0, $_REQUEST["month_to"], $_REQUEST["day_to"], $_REQUEST["year_to"]), "SHORT", "ru");
					$filter = array_merge($filter, array("<=DATE_ACTIVE_FROM" => $dateTo));
				}
				if($_REQUEST["programm"])
					$filter = array_merge($filter, array("PROPERTY_QUALIFICATION" => $_REQUEST["programm"]));
				if($_REQUEST["search_name"])
					$filter = array_merge($filter, array("NAME" => "%".$_REQUEST["search_name"]."%"));
			}
			else 
				$filter = array("IBLOCK_ID" => IB_SERTIFIED_SPECIALIES, "ACTIVE" => "Y"/*, "PROPERTY_COMPANY" => $company*/);
			
			$res = CIBlockElement::GetList(
				array("DATE_ACTIVE_TO" => "DESC"), 
				$filter,
				false,
				false,
				array(
					"NAME",
					"DATE_ACTIVE_FROM",
					"PROPERTY_QUALIFICATION.NAME",
					"PROPERTY_QUALIFICATION.DETAIL_PAGE_URL",
					"PROPERTY_COMPANY.NAME",
					"PROPERTY_VALIDITY",
					"PROPERTY_POSITION",
				)
			);
			while($element = $res->GetNext()) {
				unset($ob);
				$ob["NAME"] = $element["NAME"];
				$ob["QUALIFICATION"] = array(
					"NAME" => $element["PROPERTY_QUALIFICATION_NAME"],
					"DETAIL_PAGE_URL" => $element["PROPERTY_QUALIFICATION_DETAIL_PAGE_URL"]
				);			
				$ob["COMPANY"] = $element["PROPERTY_COMPANY_NAME"];
				$ob["DATE_START"] = ConvertDateTime($element["DATE_ACTIVE_FROM"], "DD.MM.YYYY", "ru");
				$ob["VALIDITY"] = $element["PROPERTY_VALIDITY_VALUE"];
				$ob["POSITION"] = $element["PROPERTY_POSITION_VALUE"];
				$date_array = explode(".", $element["DATE_ACTIVE_FROM"]);
				$ob["DATE_END"] = date("d.m.Y", mktime(0, 0, 0, $date_array[1], $date_array[0]+$element["PROPERTY_VALIDITY_VALUE"], $date_array[2]));
				$arResult["ITEMS"][] = $ob;
			}
		/*}
	}*/
	$this->IncludeComponentTemplate();
}
?>