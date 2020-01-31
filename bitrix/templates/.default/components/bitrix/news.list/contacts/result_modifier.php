<?
   	$arElements=array();
	foreach($arResult['ITEMS'] as $item)
	{
		$arElements[$item['IBLOCK_SECTION_ID']]['ITEMS'][]=$item;
	}
	foreach($arElements as $sectId=>$val)
	{
		$sect=CIBlockSection::GetList(array(),array("ID"=>$sectId),false)->Fetch();
		$arElements[$sectId]['SECTION_NAME']=$sect['NAME'];
	}
	$arResult=$arElements;
?>