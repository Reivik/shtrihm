<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Календарь событий");
$APPLICATION->SetPageProperty("SHOW_CALENDAR_EVENT_RIGHT", "Y");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"calendar_event",
	Array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"USE_SHARE" => "N",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "to_partner",
		"IBLOCK_ID" => "39",
		"ELEMENT_ID" => "",
		"ELEMENT_CODE" => $_REQUEST["code"],
		"CHECK_DATES" => "N",
		"FIELD_CODE" => array("PREVIEW_TEXT", "DATE_ACTIVE_FROM", "DATE_ACTIVE_TO"),
		"PROPERTY_CODE" => array("OPEN"),
		"IBLOCK_URL" => "",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"USE_PERMISSIONS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Страница",
		"PAGER_TEMPLATE" => "",
		"PAGER_SHOW_ALL" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	),
false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>