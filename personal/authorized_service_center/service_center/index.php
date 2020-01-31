<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("SHOW_BANNERS", "Y");
$APPLICATION->SetPageProperty("NEWS_LIST_LEFT", "Y");
$APPLICATION->SetTitle("Правовые документы");?>
<?$APPLICATION->IncludeComponent("areal:filter_document", ".default", array("direction" => 208));?>
<?$APPLICATION->IncludeComponent("areal:document.list", ".default", array(
	"IBLOCK_ID" => IB_DOCS, 
	"NEWS_COUNT" => "5",
	"SECTION_CODE" => "normative", 
	"DOWNLOAD_PATH" => "/docs/download.php", 
	"FILTER_NAME" => "arrFilter",
	"SELECT_PROP" => array(
		"PROPERTY_TYPE_CONTROL", 
		"PROPERTY_VERSION", 
		"PROPERTY_LAST_UPDATE", 
		"PROPERTY_PRODUCT", 
		"PROPERTY_SECTION"
	),
	"DETAIL_DISPLAY_TOP_PAGER" => "N",
	"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
	"DETAIL_PAGER_TITLE" => "Страница",
	"DETAIL_PAGER_TEMPLATE" => "",
	"DETAIL_PAGER_SHOW_ALL" => "Y",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Документы",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y"
));?>
<?$APPLICATION->IncludeComponent(
	"areal:special.offers", 
	".default", 
	array( 
		"COUNT_IN_LINE" => 2,
		"SHOW_ALL" => "N"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>