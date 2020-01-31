<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["USE_FILTER"]=="Y"):?>
	<?$APPLICATION->IncludeComponent(
		"areal:filter_news",
		"",
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
			"PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"]
		),
		$component
	);
	?>
<?endif?>
<?$actual = $GLOBALS["arrFilter"]["ACTUAL"];
unset($GLOBALS["arrFilter"]["ACTUAL"]);?>
<?/*<div class="tags_cloud">
	<?$APPLICATION->IncludeComponent("bitrix:search.tags.cloud","",Array(
		"FONT_MAX" => "20", 
		"FONT_MIN" => "15", 
		"COLOR_NEW" => "f0781e", 
		"COLOR_OLD" => "353535", 
		"PERIOD_NEW_TAGS" => "", 
		"SHOW_CHAIN" => "N", 
		"COLOR_TYPE" => "Y", 
		"WIDTH" => "100%", 
		"SORT" => "NAME", 
		"PAGE_ELEMENTS" => "150", 
		"PERIOD" => "", 
		//"URL_SEARCH" => "/search.php", 
		"URL_SEARCH" => "/press_center/news/", 
		"TAGS_INHERIT" => "Y", 
		"CHECK_DATES" => "N",
		"FILTER_NAME"=> "arFil",
		//"arrFILTER" => Array("IBLOCK_ID" => IB_NEWS),
		"CACHE_TYPE" => "A", 
		"CACHE_TIME" => "3600" 
	));?>
	<?if(isset($_GET["tags"])):?>
		<p class="all_tags"><a href="<?=$_SERVER["HTTP_X_FORWARDED_PROTO"].'://'.$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_URL"];?>">Все теги</a></p>
	<?endif;?>
</div>*/?>
<?if(isset($_REQUEST["tags"])) {
	$GLOBALS["arrFilter"] = array_merge($GLOBALS["arrFilter"], array("TAGS" => "%".$_REQUEST["tags"]."%"));
}
?>
<?
$arGrp = CUser::GetUserGroup($USER->GetID());
if(!in_array(UG_PO,$arGrp) && !in_array(UG_ADMIN,$arGrp))
	$GLOBALS["arrFilter"]["!PROPERTY_OPEN_ACCESS_VALUE"] = false;
?>
<?if((isset($actual) && $actual == 1) || !$actual):?>
<h2>Актуальные новости</h2>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"",
	Array(
		"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
		"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
		"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
		"SORT_BY1"	=>	$arParams["SORT_BY1"],
		"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
		"SORT_BY2"	=>	$arParams["SORT_BY2"],
		"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
		"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
		"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
		"SET_TITLE"	=>	$arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN"	=>	"N",
		"ADD_SECTIONS_CHAIN"	=>	"N",
		"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
		"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
		"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
		"DISPLAY_NAME"	=>	"Y",
		"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME"	=>	"arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
		"PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
		"PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
		"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
	),
	$component
);?>
<?if($arResult["VARIABLES"]["SECTION_CODE"])
	$res = CIBlockSection::GetList(array(), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "CODE" => $arResult["VARIABLES"]["SECTION_CODE"]), false);
	if($sec = $res->GetNext())
		$APPLICATION->SetTitle($sec["NAME"]);
?>
<?endif;?>


<?if((isset($actual) && $actual == 2) || !$actual):?>
	<?$GLOBALS["archiveFilter"]["<DATE_ACTIVE_TO"] = date("d.m.Y H:i:s");?>
	<h2>Архив новостей</h2>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"",
		Array(
			"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
			"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
			"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
			"SORT_BY1"	=>	$arParams["SORT_BY1"],
			"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
			"SORT_BY2"	=>	$arParams["SORT_BY2"],
			"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
			"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
			"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
			"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
			"SET_TITLE"	=>	"N",
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
			"ADD_SECTIONS_CHAIN"	=>	$arParams["ADD_SECTIONS_CHAIN"],
			"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
			"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
			"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
			"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
			"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
			"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
			"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
			"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
			"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
			"DISPLAY_NAME"	=>	"Y",
			"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
			"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
			"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
			"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
			"FILTER_NAME"	=>	"archiveFilter",
			"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
			"CHECK_DATES"	=>	$arParams["CHECK_DATES"],

			"PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
			"PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
			"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		),
		$component
	);?>
<?endif;?>
