<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(is_array($arResult["PREVIEW_PICTURE"]))
{
	$arResult['PICTURES'][] = array(
		"S" => CFile::ResizeImageGet(
			$arResult['PREVIEW_PICTURE'],
			array("width" => 88, "height" => 88),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		),
		"M" => CFile::ResizeImageGet(
			$arResult['PREVIEW_PICTURE'],
			array("width" => 345, "height" => 345),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		),
		"L" => CFile::ResizeImageGet(
			$arResult['PREVIEW_PICTURE'],
			array("width" => 900, "height" => 900),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		)
	);
}
if (is_array($arResult['PROPERTIES']['MORE_PHOTO']["VALUE"]) && count($arResult['PROPERTIES']['MORE_PHOTO']["VALUE"]) > 0)
{
	foreach ($arResult['PROPERTIES']['MORE_PHOTO']["VALUE"] as $key => $arFile)
	{
		$arResult['PICTURES'][] = array(
			"S" => CFile::ResizeImageGet(
				$arFile,
				array("width" => 88, "height" => 88),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				true
			),
			"M" => CFile::ResizeImageGet(
				$arFile,
				array("width" => 345, "height" => 345),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				true
			),
			"L" => CFile::ResizeImageGet(
				$arFile,
				array("width" => 900, "height" => 900),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				true
			)
		);
	}
}


if(is_array($arResult['DISPLAY_PROPERTIES']['EQUIPMENT']['VALUE']))
{
	foreach($arResult['DISPLAY_PROPERTIES']['EQUIPMENT']['VALUE'] as $item)
	{
		$obj = CIBlockElement::GetList(
			array(),
			array("ID"=>$item),
			false,
			false,
			array("ID","NAME","PREVIEW_TEXT","PREVIEW_PICTURE","DETAIL_PAGE_URL")
		);
		$ar = $obj->GetNext();

		$file = CFile::GetByID($ar["PREVIEW_PICTURE"]);
		$arFile = $file->Fetch();
		
		$arFilter = '';
		if($arParams["SHARPEN"] != 0)
		{
			$arFilter = array(array("name" => "sharpen", "precision" => $arParams["SHARPEN"]));
		}
		
		$newFile = CFile::ResizeImageGet(
			$arFile,
			array("width"=>100, "height"=>100),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true,
			$arFilter
		);
	
		$arResult["EQUIPMENT"][] = array("NAME"=>$ar["NAME"],"PREVIEW_TEXT"=>$ar["PREVIEW_TEXT"],"PREVIEW_PICTURE"=>$newFile,"DETAIL_PAGE_URL"=>$ar["DETAIL_PAGE_URL"]);
	}
}
if(is_array($arResult['DISPLAY_PROPERTIES']['SOFTWARE']['VALUE']))
{
	foreach($arResult['DISPLAY_PROPERTIES']['SOFTWARE']['VALUE'] as $item)
	{
		$obj = CIBlockElement::GetList(
			array(),
			array("ID"=>$item),
			false,
			false,
			array("ID","NAME","PREVIEW_TEXT","PREVIEW_PICTURE","DETAIL_PAGE_URL")
		);
		$ar = $obj->GetNext();
		
		$file = CFile::GetByID($ar["PREVIEW_PICTURE"]);
		$arFile = $file->Fetch();
		
		$arFilter = '';
		if($arParams["SHARPEN"] != 0)
		{
			$arFilter = array(array("name" => "sharpen", "precision" => $arParams["SHARPEN"]));
		}
		
		$newFile = CFile::ResizeImageGet(
			$arFile,
			array("width"=>100, "height"=>100),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true,
			$arFilter
		);
	
		$arResult["SOFTWARE"][] = array("NAME"=>$ar["NAME"],"PREVIEW_TEXT"=>$ar["PREVIEW_TEXT"],"PREVIEW_PICTURE"=>$newFile,"DETAIL_PAGE_URL"=>$ar["DETAIL_PAGE_URL"]);
	}
}
if($arResult["PROPERTIES"]["CLIENT"]["VALUE"])
{
	$objClient = CIBlockElement::GetList(
		array(),
		array("ID"=>$arResult["PROPERTIES"]["CLIENT"]["VALUE"], "IBLOCK_ID"=>IB_CLIENTS),
		false,
		false,
		array("ID", "NAME", "DETAIL_PAGE_URL","PROPERTY_SITE")
	);
	$arClient = $objClient->GetNext();
	$arResult["PROPERTIES"]["CLIENT"]["VALUE"] = $arClient;
}
if($arResult["PROPERTIES"]["PARTNER"]["VALUE"])
{
	$objClient = CIBlockElement::GetList(
		array(),
		array("ID" => $arResult["PROPERTIES"]["PARTNER"]["VALUE"], "IBLOCK_ID" => IB_COMPANY),
		false,
		false,
		array("ID", "NAME", "DETAIL_PAGE_URL")
	);
	$arClient = $objClient->GetNext();
	$arResult["PROPERTIES"]["PARTNER"]["VALUE"] = $arClient;
}
if($arResult["PROPERTIES"]["CITY"]["VALUE"])
{
	$objCity = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>IB_CITIES,"ID"=>$arResult["PROPERTIES"]["CITY"]["VALUE"]),false,false,array("ID","NAME"));
	$arCity = $objCity->GetNext();
	$arResult["PROPERTIES"]["CITY"]["VALUE"] = $arCity["NAME"];
}
if($arResult["PROPERTIES"]["REGION"]["VALUE"])
{
	$objCity = CIBlockElement::GetList(array(),array("IBLOCK_ID"=>IB_REGIONS,"ID"=>$arResult["PROPERTIES"]["REGION"]["VALUE"]),false,false,array("ID","NAME"));
	$arCity = $objCity->GetNext();
	$arResult["PROPERTIES"]["REGION"]["VALUE"] = $arCity["NAME"];
}
?>