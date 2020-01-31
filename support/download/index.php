<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("SHOW_BANNERS", "Y");
$APPLICATION->SetPageProperty("NEWS_LIST_LEFT", "Y");
$APPLICATION->SetTitle("Скачать");?>
<?
	global $downloadFilter;
	$downloadFilter=array();
	if(isset($_REQUEST['section_id']))
	{
		if($_REQUEST['section_id']!='all')
			$downloadFilter['PROPERTY_SECTION_ID']=(int)$_REQUEST['section_id'];
	}
	if(isset($_REQUEST['product_id']))
	{
		if($_REQUEST['product_id']!='all')
			$downloadFilter['PROPERTY_PRODUCT']=(int)$_REQUEST['product_id'];
	}
	if(isset($_REQUEST['type_id']))
	{
		if($_REQUEST['type_id']!='all')
			$downloadFilter['SECTION_ID']=(int)$_REQUEST['type_id'];
	}
	if(isset($_REQUEST['searchDownloads']))
	{
		if($_REQUEST['searchDownloads']!='Поиск' && $_REQUEST['searchDownloads']!='')
			$downloadFilter['NAME']="%".$_REQUEST['searchDownloads']."%";
	}

	$downloadFilter["!PROPERTY_FILE"] = false;
?>
<?$APPLICATION->IncludeComponent(
	"areal:filter_download",
	".default",
	array(
		"IBLOCK_ID" => IB_DOWNLOAD_FILES,
		"SECTION_ID" => (int)$_REQUEST['section_id'],
		"ELEMENT_ID" => (int)$_REQUEST['product_id'],
		"TYPE" => (int)$_REQUEST['type_id'],
		"SEARCH_STRING" => $_REQUEST['searchDownloads'],
		"CACHE_TIME" => "36000000",
		"SHOW_ELEMENTS_COUNT" => "Y"
	),
	false
);?>
<?$APPLICATION->IncludeComponent("areal:download.list", ".default", array(
	"IBLOCK_ID" => 21, 
	"NEWS_COUNT" => "10",
	"DOWNLOAD_PATH" => "/docs/download.php",
	"FILTER_NAME" => "downloadFilter",
	"SELECT_PROP" => array(
		"PROPERTY_VERSION", 
		"PROPERTY_LAST_UPDATE", 
		"PROPERTY_FILE", 
		/* "PROPERTY_PRODUCT", */
		"PROPERTY_SECTION_ID"
	),
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Файлы для скачивания",
	"PAGER_SHOW_ALWAYS" => "",
	"PAGER_TEMPLATE" => ".default",
	"PAGER_DESC_NUMBERING" => "",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N"
));?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>