<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 3600000;

$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arParams["SET_ID"] = trim($arParams["SET_ID"]);
$arParams["SET_NAME"] = trim($arParams["SET_NAME"]);

$arResult["SECTIONS"] = array();

if($this->StartResultCache())
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
	}
	else
	{
		$arFilter = array(
			"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
			"GLOBAL_ACTIVE"=>"Y",
			"IBLOCK_ACTIVE"=>"Y",
		);
		$arOrder = array(
			"NAME"=>"asc",
		);

		$rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, array(
			"ID",
			"NAME",
		));
		while($arSection = $rsSections->GetNext())
		{
			$arResult["SECTIONS"][$arSection["ID"]] = array(
				"NAME" => $arSection["NAME"],
			);
			$elCount=CIBlockElement::GetList(array(),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"SECTION_ID"=>$arSection['ID'],"INCLUDE_SUBSECTIONS" => "Y","ACTIVE"=>"Y"),true);
			$arResult["SECTIONS"][$arSection["ID"]]['COUNT']=$elCount;
		}		
		$this->EndResultCache();
	}
}
$this->IncludeComponentTemplate();

?>
