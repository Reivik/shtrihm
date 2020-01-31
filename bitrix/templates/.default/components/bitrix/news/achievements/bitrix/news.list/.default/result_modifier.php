<?
	if(!empty($arResult["ITEMS"])) {
		foreach($arResult["ITEMS"] as $key => $arItem) {
			if(!empty($arItem["PREVIEW_PICTURE"])) {
				$arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = CFile::ResizeImageGet( 
					$arItem["PREVIEW_PICTURE"], 
					array("width" => 102, "height" => 102), 
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true 
				);
			}
			elseif(!empty($arItem["PROPERTIES"]["COMPANY"]["VALUE"])) {
				$comp = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_COMPANY, "ID" => $arItem["PROPERTIES"]["COMPANY"]["VALUE"]), false, false, array("NAME", "PREVIEW_PICTURE"));
				if($company = $comp->GetNext())
					$arResult["ITEMS"][$key]["PREVIEW_PICTURE"] = CFile::ResizeImageGet( 
						$company["PREVIEW_PICTURE"], 
						array("width" => 102, "height" => 102), 
						BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
						true 
					);
			}
		}
	}
?>