<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 3600000;

$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arParams["SECTION_ID"] = trim($arParams["SECTION_ID"]);
$arParams["ELEMENT_ID"] = trim($arParams["ELEMENT_ID"]);
$arParams["TYPE"] = trim($arParams["TYPE"]);

$arResult = array();

/* if($this->StartResultCache())
{ */
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
	}
	else
	{
		$arElProducts = array();
		$arSelect = Array("ID", "NAME", "PROPERTY_SECTION_ID", "PROPERTY_PRODUCT", "PROPERTY_PRODUCT.NAME");
		$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array("NAME"=>"ASC"), $arFilter, false, false, $arSelect);
		while($ob = $res->GetNext())
		{
			if($ob["PROPERTY_SECTION_ID_VALUE"])
				$arResult["SECTIONS_DOWNLOADS"][$ob["PROPERTY_SECTION_ID_VALUE"]] = $ob["PROPERTY_SECTION_ID_VALUE"];
				
			if($ob["PROPERTY_PRODUCT_VALUE"])
				$arSelectElements[$ob["PROPERTY_PRODUCT_VALUE"]] = $ob["PROPERTY_PRODUCT_VALUE"];
				
			$arResult["ELEMENTS_SECTIONS"][$ob["PROPERTY_SECTION_ID_VALUE"]][$ob["PROPERTY_PRODUCT_VALUE"]] = $ob["PROPERTY_PRODUCT_NAME"];
			$arResult["ALL_PRODUCTS"][$ob["PROPERTY_PRODUCT_VALUE"]] = $ob["PROPERTY_PRODUCT_NAME"];
		}
		
		/* if($arSelectElements)
		{
			$arSelect = Array("ID", "NAME", "IBLOCK_SECTION_ID");
			$arFilter = Array("IBLOCK_ID"=>IB_PRODUCTS, "ID"=>$arSelectElements);
			$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNext())
			{
				if(in_array($ob["IBLOCK_SECTION_ID"], $arResult["SECTIONS_DOWNLOADS"]))
					$arResult["ELEMENTS_SECTIONS"][$ob["IBLOCK_SECTION_ID"]][$ob["ID"]] = $ob["NAME"];
					
				$arResult["ALL_PRODUCTS"][$ob["ID"]] = $ob["NAME"];
			}
		} */

		$arFilter = array(
			"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
			"GLOBAL_ACTIVE"=>"Y",
			"IBLOCK_ACTIVE"=>"Y",
		);
		
		$arOrder = array(
			"NAME"=>"asc",
		);

		$rsElement = CIBlockElement::GetList($arOrder, $arFilter, false, false, array(
			"ID",
			"NAME",
			"IBLOCK_SECTION_ID",
			"PROPERTY_SECTION_ID",
			"PROPERTY_PRODUCT",
		));
		
		$arType=array();
		$arProducts=array();
		$arCategory=array();
		
		while($arElement = $rsElement->GetNext())
		{
			if(!in_array($arElement['IBLOCK_SECTION_ID'],$arType))
				$arType[]=$arElement['IBLOCK_SECTION_ID'];
			if(!in_array($arElement['PROPERTY_SECTION_ID_VALUE'],$arCategory))
				$arCategory[]=$arElement['PROPERTY_SECTION_ID_VALUE'];
			if(!in_array($arElement['PROPERTY_PRODUCT_VALUE'],$arProducts))
				$arProducts[]=$arElement['PROPERTY_PRODUCT_VALUE'];
		}
		
		$arFilter = array(
			"IBLOCK_ID"=>IB_PRODUCTS,
			"INCLUDE_SUBSECTIONS"=>"Y",
			"ID"=>$arProducts,
		);
		if($arParams['SECTION_ID']!=0)
			$arFilter['SECTION_ID'] = $arParams['SECTION_ID'] ;
		$rsElement = CIBlockElement::GetList($arOrder, $arFilter, false, false, array(
			"ID",
			"NAME"
		));
		while($arElement = $rsElement->GetNext())
		{
			$arResult["PRODUCTS"][$arElement["ID"]] = array(
				"NAME" => $arElement["NAME"],
			);
		}
		
		$arFilter = array(
			"IBLOCK_ID"=>IB_PRODUCTS,
			"ID"=>$arCategory,
			"GLOBAL_ACTIVE"=>"Y",
			"IBLOCK_ACTIVE"=>"Y",
		);
		$rsCategory = CIBlockSection::GetList($arOrder, $arFilter, false, array(
			"ID",
			"NAME",
		));
		while($arSection = $rsCategory->GetNext())
		{
			$arResult["SECTIONS"][$arSection["ID"]] = array(
				"NAME" => $arSection["NAME"],
			);
			if($arParams['SHOW_ELEMENTS_COUNT']==="Y")
			{
				$elCount=CIBlockElement::GetList(array(),array("IBLOCK_ID"=>IB_PRODUCTS,"SECTION_ID"=>$arSection['ID'], "INCLUDE_SUBSECTIONS" => "Y"),true);
				$arResult["SECTIONS"][$arSection["ID"]]['COUNT']=$elCount;
			}
		}
		$arFilter = array(
			"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
			"ID"=>$arType,
			"GLOBAL_ACTIVE"=>"Y",
			"IBLOCK_ACTIVE"=>"Y",
			"CHECK_PERMISSIONS" => "N"
		);
		$rsTypes = CIBlockSection::GetList($arOrder, $arFilter, false, array(
			"ID",
			"NAME",
		));
		while($arType = $rsTypes->GetNext())
		{
			$arResult["TYPES"][$arType["ID"]] = array(
				"NAME" => $arType["NAME"],
			);
			if($arParams['SHOW_ELEMENTS_COUNT']==="Y")
			{
				$elCount=CIBlockElement::GetList(array(),array("IBLOCK_ID"=>$arParams["IBLOCK_ID"],"SECTION_ID"=>$arType['ID'],"INCLUDE_SUBSECTIONS" => "Y"),true);
				$arResult["TYPES"][$arType["ID"]]['COUNT']=$elCount;
			}
		}
		
		$this->IncludeComponentTemplate();
		$this->EndResultCache();
	}
/* } */

?>