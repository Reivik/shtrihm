<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;	
	CModule::IncludeModule("iblock");
	$aMenuLinksExt = $APPLICATION->IncludeComponent("areal:top.menu.sections", "", array(
		"IS_SEF" => "Y",
		"SEF_BASE_URL" => "",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => IB_PRODUCTS,
		"DEPTH_LEVEL" => "5",
		"CACHE_TYPE" =>"A",
		"CACHE_TIME" => 3600
	), false, Array('HIDE_ICONS' => 'Y'));
	$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>