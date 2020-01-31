<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("SHOW_BANNERS", "Y");
$APPLICATION->SetPageProperty("NEWS_LIST_LEFT", "Y");
$APPLICATION->SetTitle("Нормативные документы");?>
<?$APPLICATION->IncludeComponent("areal:filter_document", ".default", array());?>
<?$APPLICATION->IncludeComponent("areal:download.list", ".default", array(
	"IBLOCK_ID" => IB_DOCS, 
	"NEWS_COUNT" => "10",
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
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Документы",
	"PAGER_SHOW_ALWAYS" => "",
	"PAGER_TEMPLATE" => ".default",
	"PAGER_DESC_NUMBERING" => "",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N"
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