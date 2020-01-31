<?
if(CModule::IncludeModule("iblock"))
{
	global $USER;
	$arParams["NEWS_COUNT"] = intval($arParams["NEWS_COUNT"]);
	if($arParams["NEWS_COUNT"]<=0)
		$arParams["NEWS_COUNT"] = 20;
	$arParams["CACHE_FILTER"] = $arParams["CACHE_FILTER"]=="Y";
	if(!$arParams["CACHE_FILTER"] && count($arrFilter)>0)
		$arParams["CACHE_TIME"] = 0;
	$arrFilter = $GLOBALS[$arParams["FILTER_NAME"]];
	if(!is_array($arrFilter))
		$arrFilter = array();
	
	$arSelect = array("IBLOCK_ID", "PROPERTY_FILE", "ID", "NAME");
	if(!empty($arParams["SELECT_PROP"]))
		$arSelect = array_merge($arSelect, $arParams["SELECT_PROP"]);
	$arGroups = CUser::GetUserGroup($USER->GetID());
	
	if($this->StartResultCache(false, array($arrFilter, $arGroups)))
	{	
		$filter = array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "!PROPERTY_FILE" => false, "ACTIVE" => "Y");
		$filter = array_merge($filter, $arrFilter);
		
		if($arParams["DISPLAY_TOP_PAGER"] || $arParams["DISPLAY_BOTTOM_PAGER"])
		{
			$arNavParams = array(
				"nPageSize" => $arParams["NEWS_COUNT"],
				"bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],
				"bShowAll" => $arParams["PAGER_SHOW_ALL"],
			);
			$arNavigation = CDBResult::GetNavParams($arNavParams);
			if($arNavigation["PAGEN"]==0 && $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"]>0)
				$arParams["CACHE_TIME"] = $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"];
		}
		else
		{
			$arNavParams = array(
				"nTopCount" => $arParams["NEWS_COUNT"],
				"bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],
			);
			$arNavigation = false;
		}
		
		$arElem=CIBlockElement::GetList(
			array("DATE_ACTIVE_FROM" => "ASC"), 
			$filter, 
			false, 
			$arNavParams, 
			$arSelect
		);
		while($elem = $arElem->GetNext()) {
			unset($ob);
			unset($arRights);
			unset($rights);
			unset($file);
			$ob = new CIBlockElementRights($arParams["IBLOCK_ID"], $elem['ID']);
			$arRights = $ob->GetRights();
			
			$flag = 0;
			foreach($arRights as $right) {
				if($right["TASK_ID"] > 38 && strstr($right["GROUP_CODE"], "G") != false) {
					if(in_array(str_replace("G", "", $right["GROUP_CODE"]), $arGroups))
						$flag = 1;
				}
				if($right["TASK_ID"] > 38 && strstr($right["GROUP_CODE"], "U") != false && str_replace("U", "", $right["GROUP_CODE"]) == $USER->GetID())
					$flag = 1;
				if($right["TASK_ID"] > 38 && $right["GROUP_CODE"] == "AU")
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
			$arResult["DOCUMENTS"][] = array(
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
		
		$arResult["NAV_STRING"] = $arElem->GetPageNavStringEx($navComponentObject, $arParams["PAGER_TITLE"], $arParams["PAGER_TEMPLATE"], $arParams["PAGER_SHOW_ALWAYS"]);
		$arResult["NAV_CACHED_DATA"] = $navComponentObject->GetTemplateCachedData();
		$arResult["NAV_RESULT"] = $arElem;
		$this->SetResultCacheKeys(array_keys($arResult));
	}
	
	$this->IncludeComponentTemplate();
}
?>