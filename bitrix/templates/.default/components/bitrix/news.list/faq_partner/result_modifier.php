<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	foreach($arResult["ITEMS"] as $key=>$item)
		$arSections[] = $item["IBLOCK_SECTION_ID"];
	
	if($arSections)
	{
		$arSelect = Array("ID", "NAME");
		$arFilter = Array("ID"=>$arSections);
		$res = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, false, $arSelect);
		while($ob = $res->GetNext())
			$arNameSections[$ob["ID"]] = $ob["NAME"];
	}
		
	$arResult["SECTIONS"] = $arNameSections;
?>
