<?
	if(!empty($arResult["ITEMS"])) {
		foreach($arResult["ITEMS"] as $key => $arItem) {
			if(!empty($arItem["PREVIEW_PICTURE"])) {
				$arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = CFile::ResizeImageGet( 
					$arItem["PREVIEW_PICTURE"], 
					array("width" => 151, "height" => 164), 
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true 
				);
			}
			$filials = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_FILIALS, "PROPERTY_company" => $arItem["ID"], "!PROPERTY_main" => false), false, false, array("PROPERTY_town.NAME", "PROPERTY_address"));
			if($filial = $filials->GetNext())
				$arResult["ITEMS"][$key]["MAIN_OFFICE"] = $filial["PROPERTY_TOWN_NAME"].", ".$filial["PROPERTY_ADDRESS_VALUE"];
			
			if(!empty($arItem["PROPERTIES"]["STATUS"]["VALUE"])) {
				foreach($arItem["PROPERTIES"]["STATUS"]["VALUE"] as $stat) {
					unset($statuses);
					unset($status);
					$statuses = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_STATUS_COMPANY, "ID" => $stat), false, false, array("NAME", "PREVIEW_PICTURE"));
					while($status = $statuses->GetNext()) {
						$arResult["ITEMS"][$key]["STATUS"][] = array(
							"NAME" => $status["NAME"],
							"PREVIEW_PICTURE" => CFile::ResizeImageGet( 
								$status["PREVIEW_PICTURE"], 
								array("width" => 20, "height" => 20), 
								BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
								true 
							)
						);						
					}
				}
			}			
		}
	}
?>