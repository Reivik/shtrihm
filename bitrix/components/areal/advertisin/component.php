<?
if(CModule::IncludeModule("iblock"))
{
	$cache = new CPHPCache();
	$cache_time = 3600;
	$arResult = array();
	$cache_dir_id = 'advertisin';
	$cache_dir_path = '/advertisin/';
	if ($cache_time > 0 && $cache->InitCache($cache_time, $cache_dir_id, $cache_dir_path))
	{
	   $res = $cache->GetVars();
	   if (is_array($res["advertisin"]) && (count($res["advertisin"]) > 0))
		  $arResult = array_merge($arResult, $res["advertisin"]);
	}
	else 
	{
		$res = CIBlockElement::GetList(array("NAME" => "ASC"), array("IBLOCK_ID" => IB_ADVERTISIN, "ACTIVE" => "Y"), false, false, array("NAME", "PREVIEW_PICTURE", "PROPERTY_IMG"));
		while($element = $res->GetNext()) {
			$rsFile = CFile::GetByID($element["PROPERTY_IMG_VALUE"]);
			$arFile = $rsFile->Fetch();		
			$extension = substr(strrchr($arFile["FILE_NAME"], '.'), 1);
			$arResult["FILES"][] = array(
				"NAME" => $element["~NAME"],
				"LINK" => "/upload/".$arFile["SUBDIR"]."/".$arFile["FILE_NAME"],
				"EXT" => $extension,
				"PREVIEW_PICTURE" => CFile::ResizeImageGet( 
					$element["PREVIEW_PICTURE"], 
					array("width" => 164, "height" => 158), 
					BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
					true 
				)
			);
		}
		if ($cache_time > 0) {
			$cache->StartDataCache($cache_time, $cache_dir_id, $cache_dir_path);
			$cache->EndDataCache(array("advertisin" => $arResult));
		}
	}
	$this->IncludeComponentTemplate();
}
?>