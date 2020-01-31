<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск");
$APPLICATION->SetPageProperty("NO_LEFT_MENU", "N");
?>
<?$APPLICATION->IncludeComponent("bitrix:search.page", ".default", array(
	"RESTART" => "Y",
	"NO_WORD_LOGIC" => "N",
	"CHECK_DATES" => "N",
	"USE_TITLE_RANK" => "Y",
	"DEFAULT_SORT" => "rank",
	"FILTER_NAME" => "",
	"arrFILTER" => array(
		0 => "main",
		1 => "iblock_catalog",
		2 => "iblock_partners",
		3 => "iblock_to_partner",
		4 => "iblock_press_center",
		5 => "iblock_learning",
		6 => "iblock_clients",
		7 => "iblock_FAQ",
		8 => "iblock_download",
		9 => "iblock_about",
	),
	"arrFILTER_main" => array(
	),
	"arrFILTER_iblock_catalog" => array(
		0 => "all",
	),
	"arrFILTER_iblock_partners" => array(
		0 => "all",
	),
	"arrFILTER_iblock_to_partner" => array(
		0 => "all",
		1 => "41",
	),
	"arrFILTER_iblock_press_center" => array(
		0 => "all",
	),
	"arrFILTER_iblock_learning" => array(
		0 => "all",
	),
	"arrFILTER_iblock_clients" => array(
		0 => "all",
	),
	"arrFILTER_iblock_FAQ" => array(
		0 => "all",
	),
	"arrFILTER_iblock_download" => array(
		0 => "all",
	),
	"arrFILTER_iblock_about" => array(
		0 => "all",
	),
	"SHOW_WHERE" => "N",
	"SHOW_WHEN" => "N",
	"PAGE_RESULT_COUNT" => "50",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Результаты поиска",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"USE_LANGUAGE_GUESS" => "N",
	"USE_SUGGEST" => "N",
	"SHOW_RATING" => "Y",
	"RATING_TYPE" => "",
	"PATH_TO_USER_PROFILE" => "",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>