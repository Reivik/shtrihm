<?
	if(is_array($arResult["PREVIEW_PICTURE"])) {
		$arResult["BIG_PICTURE"] = CFile::ResizeImageGet(
			$arResult["PREVIEW_PICTURE"]["ID"],
			array(
				"width" => $arResult["PREVIEW_PICTURE"]["WIDTH"],
				"height" => $arResult["PREVIEW_PICTURE"]["HEIGHT"]
			),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);	
		$arResult["SMALL_PICTURE"] = CFile::ResizeImageGet(
			$arResult["PREVIEW_PICTURE"]["ID"],
			array(
				"width" => 345,
				"height" => 458
			),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);
	}
	
	$property_enums = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>IB_FILIALS, "CODE"=>"office", "XML_ID"=>1));
	while($enum_fields = $property_enums->GetNext())
		$arFilialsMainID = $enum_fields["ID"];
		
	$res = CIBlockElement::GetList(
		array("SORT" => "ASC"),
		array("IBLOCK_ID" => IB_FILIALS, "ACTIVE" => "Y", "PROPERTY_company" => $arResult["ID"]), 
		false,
		false, 
		array(
			"IBLOCK_ID",
			"ID", 
			"PROPERTY_company",
			"PROPERTY_town.NAME",
			"PROPERTY_status",
			//"PROPERTY_status.NAME",
			//"PROPERTY_status.PREVIEW_PICTURE",
			"PROPERTY_address",
			"PROPERTY_phone",
			"PROPERTY_email",
			"PROPERTY_office"
		)
	);
	while($result = $res->GetNext()) {
		/*unset($status_filial);
		unset($statuses);
		unset($status);*/
		$query = json_decode(file_get_contents("http://maps.google.com/maps/api/geocode/json?address=".urlencode($result["PROPERTY_TOWN_NAME"]." ".$result["PROPERTY_ADDRESS_VALUE"])."&sensor=false"), true);
		/*if(!empty($result["PROPERTY_STATUS_VALUE"])) {
			$statuses = CIBlockElement::GetList(array("PROPERTY_RATING" => "ASC"), array("IBLOCK_ID" => IB_STATUS_COMPANY, "ACTIVE" => "Y", "ID" => $result["PROPERTY_STATUS_VALUE"]), false, false, array("ID", "NAME"));
			while($status = $statuses->GetNext())
				$status_filial[] = $status["NAME"];
		}*/
		$arResult["FILLIALS"][] = array(
			"TOWN" => $result["PROPERTY_TOWN_NAME"],
			//"STATUS" => implode(", ", $status_filial),
			"PHONE" => $result["PROPERTY_PHONE_VALUE"],
			"EMAIL" => explode("@", $result["PROPERTY_EMAIL_VALUE"]),
			"OFFICE" => $result["PROPERTY_OFFICE_VALUE"],
			"ADDRESS" => $result["PROPERTY_ADDRESS_VALUE"],
			"COORDINATES" => ($query["status"] == "OK") ? $query["results"][0]["geometry"]["location"] : ""
		);
		
		if($result["PROPERTY_OFFICE_ENUM_ID"] == $arFilialsMainID)
			$arResult["LOCATION_CENTER"] = ($query["status"] == "OK") ? $query["results"][0]["geometry"]["location"] : "";
	}
	//pr($arResult["FILLIALS"]);
	if(!$arResult["LOCATION_CENTER"])
	{
		if(!empty($arResult["PROPERTIES"]["LEGAL_ADDRESS"]["VALUE"]))
			$query = json_decode(file_get_contents("http://maps.google.com/maps/api/geocode/json?address=".urlencode($arResult["PROPERTIES"]["LEGAL_ADDRESS"]["VALUE"])."&sensor=false"), true);
		if($query["status"] == "OK")
			$arResult["LOCATION_CENTER"] = $query["results"][0]["geometry"]["location"];
	}
	
	$this->__component->SetResultCacheKeys(array("FILLIALS", "LOCATION_CENTER"));
?>