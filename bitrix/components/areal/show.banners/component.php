<?
if(CModule::IncludeModule("iblock")) {
	$prop_show = $APPLICATION->GetProperty("SHOW_BANNERS");
	if($prop_show != "Y" && $prop_show != "E")
		return;
	else {
		
		$full_url = str_replace("/", "_", $_SERVER["SCRIPT_URL"]);
		$url = $_SERVER["SCRIPT_URL"];
		$expl_url = explode("/", $url);
		if($expl_url[count($expl_url)-1] == "index.php") $expl_url[count($expl_url)-1] = "";
		$new_url = implode("/", $expl_url);
		$cache = new CPHPCache();
		$cache_time = 3600;
		$arResult = array();
		$cache_dir_id = 'banner'.$full_url;		
		$cache_dir_path = '/banner'.$full_url."/";
		if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
		{
		   $res = $cache->GetVars();
		   if (is_array($res['banner'.$full_url]) && (count($res['banner'.$full_url]) > 0))
			  $arResult = array_merge($arResult, $res['banner'.$full_url]);
		}
		else
		{
			$date = date("d.m.Y H:i:s");
			if(!empty($new_url))
			{
				$exp = explode("/", $new_url);
				if($exp[1] == "catalog" && !empty($exp[2])) {
					$res = CIBlockSection::GetList(array(), array("IBLOCK_ID" => IB_PRODUCTS, "CODE" => $exp[2]), false);
					if($sec = $res->GetNext())
						$current_section = $sec['ID'];
				}
				if(!empty($current_section))
					$arFilter_sec = array(
						array(
							"LOGIC" => "OR",
							array("PROPERTY_PAGE_SECTION" => $current_section),
							array("PROPERTY_PAGE" => $new_url)
						)
					);
				else 
					$arFilter_sec = array("PROPERTY_PAGE" => $new_url);
				
				$page_id=0;
				$res_pages = CIBlockElement::GetList(array(), array("IBLOCK_ID" => IB_SECTION_PAGES, "PROPERTY_SECTION_PAGE" => $new_url), false,false,array("ID"));
				while($arPages=$res_pages->GetNext()){
					$page_id=$arPages['ID'];
				}
				
				$arFilter = array(
					"IBLOCK_ID" => IB_BANNERS,
					"ACTIVE"=>"Y",
					array(
						"LOGIC" => "OR",
							array("DATE_ACTIVE_FROM"=>false, ">DATE_ACTIVE_TO"=>$date),
							array("<DATE_ACTIVE_FROM"=>$date, ">DATE_ACTIVE_TO"=>$date),
							array("<DATE_ACTIVE_FROM"=>$date, "DATE_ACTIVE_TO"=>false),
							array("DATE_ACTIVE_FROM"=>false, "DATE_ACTIVE_TO"=>false),
					),					
				);
				
				if(!empty($arFilter_sec)){
					if($page_id!=0)
						$arFilter_sec=array_merge(array("LOGIC" => "OR"),array_merge($arFilter_sec,array("PROPERTY_SITE_SECTION"=>$page_id)));
					$arFilter[] = $arFilter_sec;
				}
				$res = CIBlockElement::GetList(array("SORT"=>"ASC"),$arFilter, false, false, array("ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "PROPERTY_LINK", "PROPERTY_PAGE_SECTION", "PROPERTY_PAGE"));
				while($arBan = $res->GetNext())
				{
					$file = CFile::ResizeImageGet( 
						$arBan["PREVIEW_PICTURE"], 
						array("width" => 681, "height" => 320), 
						BX_RESIZE_IMAGE_EXACT,
						true 
					);
					$rsFile = CFile::GetByID($arBan["PREVIEW_PICTURE"]);
					$arFile = $rsFile->Fetch();
					if(!empty($arFile["DESCRIPTION"]))
						$file["DESCRIPTION"] = $arFile["DESCRIPTION"];
					$arBan["PREVIEW_PICTURE"] = $file;
					$arResult["ITEMS"][$arBan['ID']] = $arBan;
					if(count($arResult["ITEMS"])>=5)
						break;
				}
				
			}
			
			// если ничего не нашли по new_url, то в зависимости от свойства страницы либо ищем баннеры без страницы, либо не ищем баннеры
			if(count($arResult["ITEMS"]) == 0 && $prop_show == "Y")
			{
				$arFilter = array(
					"IBLOCK_ID" => IB_BANNERS, 
					"PROPERTY_PAGE" => false, 
					"PROPERTY_PAGE_SECTION" => false, 
					"ACTIVE"=>"Y",
					array(
						"LOGIC" => "OR",
							array("DATE_ACTIVE_FROM"=>false, ">DATE_ACTIVE_TO"=>$date),
							array("<DATE_ACTIVE_FROM"=>$date, ">DATE_ACTIVE_TO"=>$date),
							array("<DATE_ACTIVE_FROM"=>$date, "DATE_ACTIVE_TO"=>false),
							array("DATE_ACTIVE_FROM"=>false, "DATE_ACTIVE_TO"=>false),
					),					
				);
				
				$res = CIBlockElement::GetList(array("SORT"=>"ASC"),$arFilter,false,false,array("ID","NAME","PREVIEW_PICTURE", "PREVIEW_TEXT", "PROPERTY_LINK", "PROPERTY_PAGE", "PROPERTY_PAGE_SECTION"));
				while($arBan = $res->GetNext())
				{
					$file = CFile::ResizeImageGet( 
						$arBan["PREVIEW_PICTURE"], 
						array("width" => 681, "height" => 320), 
						BX_RESIZE_IMAGE_EXACT,
						true 
					);
					$arBan["PREVIEW_PICTURE"] = $file;
					$arResult["ITEMS"][$arBan['ID']] = $arBan;
					if(count($arResult["ITEMS"])>=5)
						break;
				}
			}
			if ($cache_time > 0) {
				$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
				$cache->EndDataCache(array('banner'.$full_url => $arResult));
			}
		}
		
		$this->IncludeComponentTemplate();
	}
}
?>