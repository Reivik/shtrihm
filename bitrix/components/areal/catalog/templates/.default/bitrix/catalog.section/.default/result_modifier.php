<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// cache hack to use items list in component_epilog.php
$this->__component->arResult["IDS"] = array();
$this->__component->arResult["OFFERS_IDS"] = array();

if(isset($arParams["DETAIL_URL"]) && strlen($arParams["DETAIL_URL"]) > 0)
	$urlTemplate = $arParams["DETAIL_URL"];
else
	$urlTemplate = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "DETAIL_PAGE_URL");

//2 Sections subtree
$arSections = array();
$rsSections = CIBlockSection::GetList(
	array(), 
	array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"LEFT_MARGIN" => $arResult["LEFT_MARGIN"],
		"RIGHT_MARGIN" => $arResult["RIGHT_MARGIN"],
	), 
	false, 
	array("ID", "DEPTH_LEVEL", "SECTION_PAGE_URL")
);

while($arSection = $rsSections->Fetch())
	$arSections[$arSection["ID"]] = $arSection;

foreach ($arResult["ITEMS"] as $key => $arElement) 
{
	$this->__component->arResult["IDS"][] = $arElement["ID"];
	
	if(is_array($arElement["OFFERS"]) && !empty($arElement["OFFERS"])){
		foreach($arElement["OFFERS"] as $arOffer){
			$this->__component->arResult["OFFERS_IDS"][] = $arOffer["ID"];
		}
	}
	
	if(is_array($arElement["PREVIEW_PICTURE"]))
	{
		$arFileTmp = CFile::ResizeImageGet(
			$arElement["PREVIEW_PICTURE"],
			array("width" => 102, "height" => 102),
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
			true
		);

		$arResult["ITEMS"][$key]["PREVIEW_IMG"] = array(
			"SRC" => $arFileTmp["src"],
			'WIDTH' => $arFileTmp["width"],
			'HEIGHT' => $arFileTmp["height"],
		);
		
		/*if($USER->IsAdmin())	
			pr($arResult["ITEMS"][$key]["PREVIEW_IMG"]);*/
	}
	
	$section_id = $arElement["~IBLOCK_SECTION_ID"];

	if(array_key_exists($section_id, $arSections))
	{
		$urlSection = str_replace(
			array("#SECTION_ID#", "#SECTION_CODE#"),
			array($arSections[$section_id]["ID"], $arSections[$section_id]["CODE"]),
			$urlTemplate
		);

		$arResult["ITEMS"][$key]["DETAIL_PAGE_URL"] = CIBlock::ReplaceDetailUrl(
			$urlSection,
			$arElement,
			true,
			"E"
		);
	}	
	
}
$sect = CIBlockSection::GetList(
	array(), 
	array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ID" => $arResult["ID"]
	), 
	false, 
	array("UF_PEREHOD", "UF_LINK")
);
if($sec = $sect->Fetch()) {
	if($sec["UF_PEREHOD"] == 1 && !empty($sec["UF_LINK"]))
		$arResult["UF_LINK"] = $sec["UF_LINK"];
	else 
		$arResult["UF_LINK"] == false;
	if(!empty($arResult["DETAIL_PICTURE"]))
		$arResult["SMALL_PICTURE"] = CFile::ResizeImageGet( 
			$arResult["DETAIL_PICTURE"]["ID"], 
			array("width" => 345, "height" => 458), 
			BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
			true 
		);
}
$this->__component->SetResultCacheKeys(array("SMALL_PICTURE"));
$this->__component->SetResultCacheKeys(array("UF_LINK"));
$this->__component->SetResultCacheKeys(array("IDS"));
$this->__component->SetResultCacheKeys(array("OFFERS_IDS"));

?>