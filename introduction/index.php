<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("SHOW_BANNERS", "Y");
//$APPLICATION->SetPageProperty("SHOW_SPECIAL_OFFERS", "Y");
$APPLICATION->SetPageProperty("NEWS_LIST_LEFT", "Y");
$APPLICATION->SetPageProperty("NO_LEFT_MENU", "N");
$APPLICATION->SetTitle("Внедрения");?>
<?$APPLICATION->IncludeComponent("bitrix:news", "introduction", array(
	"IBLOCK_TYPE" => "clients",
	"IBLOCK_ID" => "8",
	"NEWS_COUNT" => "6",
	"USE_SEARCH" => "N",
	"USE_RSS" => "N",
	"USE_RATING" => "N",
	"USE_CATEGORIES" => "N",
	"USE_REVIEW" => "N",
	"USE_FILTER" => "Y",
	"FILTER_NAME" => "arrFilter",
	"FILTER_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"FILTER_PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"CHECK_DATES" => "Y",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/introduction/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "Y",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"USE_PERMISSIONS" => "N",
	"PREVIEW_TRUNCATE_LEN" => "",
	"LIST_ACTIVE_DATE_FORMAT" => "j F Y",
	"LIST_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"LIST_PROPERTY_CODE" => array(
		0 => "",
		1 => "MORE_PHOTO",
		2 => "",
	),
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"DISPLAY_NAME" => "Y",
	"META_KEYWORDS" => "keywords",
	"META_DESCRIPTION" => "description",
	"BROWSER_TITLE" => "seo_title",
	"DETAIL_ACTIVE_DATE_FORMAT" => "j F Y",
	"DETAIL_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"DETAIL_PROPERTY_CODE" => array(
		0 => "EQUIPMENT",
		1 => "SOFTWARE",
		2 => "MORE_PHOTO",
	),
	"DETAIL_DISPLAY_TOP_PAGER" => "N",
	"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
	"DETAIL_PAGER_TITLE" => "Страница",
	"DETAIL_PAGER_TEMPLATE" => "",
	"DETAIL_PAGER_SHOW_ALL" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Внедрения",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => "",
	"SEF_URL_TEMPLATES" => array(
		"news" => "",
		"section" => "#SECTION_CODE#/",
		"detail" => "#ELEMENT_CODE#/",
	)
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>