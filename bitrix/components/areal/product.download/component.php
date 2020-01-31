<?
if(CModule::IncludeModule("iblock"))
{
	global $USER;
	$arParams["CACHE_FILTER"] = $arParams["CACHE_FILTER"]=="Y";
	
	$arSelect = array("IBLOCK_ID", "IBLOCK_SECTION_ID", "PROPERTY_FILE", "ID", "NAME");
	if(!empty($arParams["SELECT_PROP"]))
		$arSelect = array_merge($arSelect, $arParams["SELECT_PROP"]);
	$arGroups = CUser::GetUserGroup($USER->GetID());
	
	if($this->StartResultCache(false)) {
		foreach($arParams["IBLOCK_ID"] as $iblock_id) {
			$filter = array("IBLOCK_ID" => $iblock_id, "!PROPERTY_FILE" => false, "ACTIVE" => "Y", "PROPERTY_PRODUCT" => $arParams["PRODUCT"]);
			$arElem = CIBlockElement::GetList(array("DATE_ACTIVE_FROM" => "ASC"), $filter, false, false, $arSelect);
			while($elem = $arElem->GetNext()) {
				unset($ob);
				unset($arRights);
				unset($rights);
				unset($file);
				$ob = new CIBlockElementRights($iblock_id, $elem['ID']);
				$arRights = $ob->GetRights();
				$flag = 0;
				foreach($arRights as $right) {
					if($right["TASK_ID"] != 38 && strstr($right["GROUP_CODE"], "G") != false) {
						if(in_array(str_replace("G", "", $right["GROUP_CODE"]), $arGroups))
							$flag = 1;
					}
					if($right["TASK_ID"] != 38 && strstr($right["GROUP_CODE"], "U") != false && str_replace("U", "", $right["GROUP_CODE"]) == $USER->GetID())
						$flag = 1;
				}
				
				$file=CFile::GetFileArray($elem["PROPERTY_FILE_VALUE"]);
				if($file['FILE_SIZE']<1024)
					$file['FILE_SIZE'].=" Б";
				elseif($file['FILE_SIZE']/1024<1024)
					$file['FILE_SIZE']=round($file['FILE_SIZE']/1024)." Кб";
				else
					$file['FILE_SIZE']=round($file['FILE_SIZE']/(1024*1024))." Mб";
				if(in_array("PREVIEW_PICTURE", $arSelect))
					$picture = CFile::ResizeImageGet(
						$elem["PREVIEW_PICTURE"], 
						array("width" => 201, "height" => 160),
						BX_RESIZE_IMAGE_PROPORTIONAL,
						true
					);
				if(!in_array($elem["IBLOCK_SECTION_ID"], $arResult["SECTION"][$iblock_id]))
					$arResult["SECTION"][$iblock_id][] = $elem["IBLOCK_SECTION_ID"];
				$arResult["DOCUMENTS"][$iblock_id][$elem["IBLOCK_SECTION_ID"]][] = array(
					"ID" => $elem["ID"],
					"IBLOCK_ID" => $elem["IBLOCK_ID"],
					"NAME" => $elem["NAME"],
					"TYPE_CONTROL" => $elem["PROPERTY_TYPE_CONTROL_VALUE"],
					"VERSION" => $elem["PROPERTY_VERSION_VALUE"],
					"LAST_UPDATE" => $elem["PROPERTY_LAST_UPDATE_VALUE"],
					"PRODUCT" => $elem["PROPERTY_PRODUCT_VALUE"],
					"SECTION" => $elem["PROPERTY_SECTION_VALUE"],
					"RIGHT" => $flag,
					"FILE" => $file,
					"PREVIEW_PICTURE" => $picture,
					"PREVIEW_TEXT" => $elem["PREVIEW_TEXT"]
				);				
			}
			if(!empty($arResult["DOCUMENTS"][$iblock_id])) {
				unset($secs);
				unset($sec);
				$secs = CIBlockSection::GetList(array("SORT" => "ASC", "NAME" => "ASC"), array("IBLOCK_ID" => $iblock_id, "ACTIVE" => "Y", "CHECK_PERMISSIONS" => "N" , "ID" => array_keys($arResult["DOCUMENTS"][$iblock_id])), false, array("ID", "IBLOCK_ID", "NAME"));
				while($sec = $secs->GetNext()) {
					$arResult["SECTIONS"][$sec["IBLOCK_ID"]][$sec["ID"]] = $sec["NAME"];
				}
			}
		}
		$this->SetResultCacheKeys(array_keys($arResult));
		$this->IncludeComponentTemplate();
	}	
}
?>