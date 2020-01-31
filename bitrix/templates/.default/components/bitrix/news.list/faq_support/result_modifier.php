<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach($arResult['ITEMS'] as &$item)
{
	$res=CIBlockElement::GetList(array(),array("IBLOCK_ID"=>IB_FAQ_SUPPORT,"ID"=>$item['ID']),false,false,array("PROPERTY_ANSWER","PROPERTY_QUESTION"))->Fetch();
	$item['ANSWER']=$res['PROPERTY_ANSWER_VALUE']['TEXT'];
	$item['QUESTION']=$res['PROPERTY_QUESTION_VALUE']['TEXT'];
}
?>