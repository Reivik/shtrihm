<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$prop_show = $APPLICATION->GetProperty("SHOW_BANNERS");
if($prop_show != "Y" && $prop_show != "E")
	return;

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);

$cache = new CPHPCache;
$cache_id = $arParams["FILTER_NAME"]."|".$arParams["IBLOCK_ID"]."|".$_SERVER["REQUEST_URI"];
$cache_dir = "/".SITE_ID.$this->GetRelativePath();
if($cache->StartDataCache($arParams["CACHE_TIME"],$cache_id,$cache_dir))
{
	global $CACHE_MANAGER;
	$CACHE_MANAGER->StartTagCache($cache_dir);
	$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);

$url = explode('/',$_SERVER["REQUEST_URI"]);
// pr($_SERVER["REQUEST_URI"]);
// pr($url);
if($_SERVER["SCRIPT_NAME"] == "/index.php")
{
	$res = CIBlockElement::GetList(array("SORT"=>"ASC"),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"PROPERTY_PAGE"=>"/"),false,false,array("ID","NAME","PREVIEW_PICTURE"));
	while($arBan = $res->GetNext())
	{
		$cnt++;
		$file = CFile::GetFileArray($arBan["PREVIEW_PICTURE"]);
		$arBan["PREVIEW_PICTURE"] = $file;
		$arResult["ITEMS"][] = $arBan;
		if($cnt == 5)
			break;
	}
}

$i = count($url) - 2;
$cnt;
while($i > 0)
{
	$find = "";
	$cnt = 0;
	for($k = 1; $k <= $i; $k++)
	{
		$find .= $url[$k]."/";
	}
	$res = CIBlockElement::GetList(array("SORT"=>"ASC"),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"PROPERTY_PAGE"=>$find),false,false,array("ID","NAME","PREVIEW_PICTURE"));
	while($arBan = $res->GetNext())
	{
		$cnt++;
		$file = CFile::GetFileArray($arBan["PREVIEW_PICTURE"]);
		$arBan["PREVIEW_PICTURE"] = $file;
		$arResult["ITEMS"][] = $arBan;
		if($cnt == 5)
			break;
	}
	if($cnt) break; // если что то нашли, то прерываем цикл
	elseif($i == 2) // если ничего не найдено и вложенность 2, то надо посмотреть родительскую секциию если она есть
	{
		// выбираем секции
		$objSect = CIBlockSection::GetList(array(),array("CODE"=>$url[$i]),false,array(),false);
		$arSect = $objSect->GetNext();
		// если у секции есть родитель, то получаем его CODE и ищем баннеры
		if($arSect["IBLOCK_SECTION_ID"])
		{
			$objParentSect = CIBlockSection::GetByID($arSect["IBLOCK_SECTION_ID"]);
			$arParentSect = $objParentSect->GetNext();
			
			$find = str_replace($arSect["CODE"],$arParentSect["CODE"],$find);
			
			$res = CIBlockElement::GetList(array("SORT"=>"ASC"),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"PROPERTY_PAGE"=>$find),false,false,array("ID","NAME","PREVIEW_PICTURE"));
			while($arBan = $res->GetNext())
			{
				$cnt++;
				$file = CFile::GetFileArray($arBan["PREVIEW_PICTURE"]);
				$arBan["PREVIEW_PICTURE"] = $file;
				$arResult["ITEMS"][] = $arBan;
				if($cnt == 5)
					break;
			}
			if($cnt) break;	// если что то нашли, то прерываем цикл
		}
	}
	$i--;
}

// если ничего не нашли по url, то в зависимости от свойства страницы либо ищем баннеры без страницы, либо не ищем баннеры
if($cnt == 0 && $prop_show == "Y")
{
	$find = "";
	$res = CIBlockElement::GetList(array("SORT"=>"ASC"),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"PROPERTY_PAGE"=>false),false,false,array("ID","NAME","PREVIEW_PICTURE"));
	while($arBan = $res->GetNext())
	{
		$cnt++;
		$file = CFile::GetFileArray($arBan["PREVIEW_PICTURE"]);
		$arBan["PREVIEW_PICTURE"] = $file;
		$arResult["ITEMS"][] = $arBan;
		if($cnt == 5)
			break;
	}
}
	
	$CACHE_MANAGER->EndTagCache();
	
	$cache->EndDataCache(array("ITEMS"=>$arResult["ITEMS"]));
}
else
{
	$vars = $cache->GetVars();
	$arResult["ITEMS"] = $vars["ITEMS"];
}

$this->IncludeComponentTemplate();

?>