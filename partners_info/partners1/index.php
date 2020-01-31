<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("SHOW_BANNERS", "Y");
$APPLICATION->SetPageProperty("NEWS_LIST", "Y");
$APPLICATION->SetPageProperty("CONGRATULATION", "Y");
$APPLICATION->SetTitle("Сервисные партнеры");?>

<?$APPLICATION->IncludeComponent("bitrix:news", "partners_1", array(
	"IBLOCK_TYPE" => "partners",
	"IBLOCK_ID" => "9",
	"NEWS_COUNT" => "20",
	"USE_SEARCH" => "N",
	"USE_RSS" => "N",
	"USE_RATING" => "N",
	"USE_CATEGORIES" => "N",
	"USE_REVIEW" => "N",
	"USE_FILTER" => "Y",
	"FILTER_NAME" => "",
	"FILTER_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"FILTER_PROPERTY_CODE" => array(
		0 => "STATUS",
		1 => "",
	),
	"SORT_BY1" => "PROPERTY_RATING",
	"SORT_ORDER1" => "ASC,NULLS",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC,NULLS",
	"CHECK_DATES" => "Y",
	"SEF_MODE" => "Y",
	"SEF_FOLDER" => "/partners_info/partners1/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"USE_PERMISSIONS" => "N",
	"PREVIEW_TRUNCATE_LEN" => "",
	"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
	"LIST_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"LIST_PROPERTY_CODE" => array(
		0 => "LEGAL_ADDRESS",
		1 => "",
	),
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"DISPLAY_NAME" => "Y",
	"META_KEYWORDS" => "keywords",
	"META_DESCRIPTION" => "description",
	"BROWSER_TITLE" => "seo_title",
	"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
	"DETAIL_FIELD_CODE" => array(
		0 => "PREVIEW_PICTURE",
		1 => "",
	),
	"DETAIL_PROPERTY_CODE" => array(
		0 => "LEGAL_ADDRESS",
		1 => "",
	),
	"DETAIL_DISPLAY_TOP_PAGER" => "N",
	"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
	"DETAIL_PAGER_TITLE" => "Страница",
	"DETAIL_PAGER_TEMPLATE" => "",
	"DETAIL_PAGER_SHOW_ALL" => "Y",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"AJAX_OPTION_ADDITIONAL" => "",
	"SEF_URL_TEMPLATES" => array(
		"news" => "/partners_info/partners1/",
		"section" => "",
		"detail" => "#ELEMENT_CODE#/",
	)
	),
	false
);?>	
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>