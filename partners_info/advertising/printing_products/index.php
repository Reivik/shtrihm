<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Полиграфическая продукция");?>
<?$APPLICATION->IncludeComponent("areal:filter_printing", ".default");?>
<?$APPLICATION->IncludeComponent("areal:document.list", "printing_products", array(
	"IBLOCK_ID" => 43, 
	"NEWS_COUNT" => "15",
	"DOWNLOAD_PATH" => "/partners_info/advertising/printing_products/download.php",
	"FILTER_NAME" => "arrFilter",
	"SELECT_PROP" => array(
		"PREVIEW_PICTURE",
		"PREVIEW_TEXT"
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>