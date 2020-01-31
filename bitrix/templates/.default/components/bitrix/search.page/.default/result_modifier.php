<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
foreach($arResult["SEARCH"] as &$arItem){
	$arElem=CIBlockElement::GetList(array(),array("ID"=>$arItem['ITEM_ID'],"IBLOCK"=>$arItem['PARAM2']),false,false,array("IBLOCK_SECTION_ID"))->Fetch();
	$arItem['SECTION_ID']=$arElem['IBLOCK_SECTION_ID'];
	if($arItem['PARAM2']==21){//файлы для скачивания
		$arItem['URL']='/support/download/?searchDownloads='.$arItem['TITLE'];
	}
	if($arItem['PARAM2']==45){//документы для скачивания
		$arItem['URL']='/partners_info/normative/?search_name='.$arItem['TITLE'];
	}
}
?>