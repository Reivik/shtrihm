<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сервисные центры");?> 
<p>
	Авторизированный сервисный центр ГК «ШТРИХ-М» находится в главном офисе компании по адресу : г. Москва. ул. Ленинская Слобода д 19 стр 4 офис 312, <b>тел. (499) 938-52-54</b>, e-mail: <a href="mailto:shtrih-service@shtrih-m.ru">shtrih-service@shtrih-m.ru</a>.
</p>
 <p>Продажей, внедрением, и  последующей поддержкой продукции компании «ШТРИХ-М» занимаются партнеры компании – сервисные центры, имеющие статусы «СЕРВИС-ПАРТНЕР» и «АСЦ».</p>
<p>Данные статусы получают те компании, которые прошли специальную аттестацию и имеющие соответствующие сертификаты, а также соответствуют всем требованиям компании «ШТРИХ-М» в части технического и программного оснащения.</p>
<p>В случае необходимости какого либо ремонта компания «ШТРИХ-М» рекомендует обращаться напрямую к партнерам, имеющим данные статусы в соответствующем вашему регионе. Это позволит оперативно решить возникшие вопросы, провести необходимую диагностику и ремонт оборудования. А также закупить необходимое оборудование.</p>

 <?$APPLICATION->IncludeComponent("ithive:offices", ".default", array(
	"KEY" => "AITB81sBAAAAPKOFQAIAUi-_fRBtwcmrweQsr1zuihD-g54AAAAAAAAAAADhdav6GI6cq1p3c35KIJ8RohaaUA==",
	"ICON_FILE" => "/bitrix/components/ithive/offices.list/templates/.default/images/map-icon.png",
	"ICON_SIZE" => "46,31",
	"ICON_OFFSET" => "-15,-30",
	"INCLUDE_JQUERY" => "Y",
	"IBLOCK_TYPE" => "partners",
	"IBLOCK_ID" => "82",
	"NEWS_COUNT" => "2000",
	"USE_SEARCH" => "N",
	"USE_RSS" => "N",
	"USE_RATING" => "N",
	"USE_CATEGORIES" => "N",
	"USE_REVIEW" => "N",
	"USE_FILTER" => "Y",
	"FILTER_NAME" => "arrFilter",
	"FILTER_FIELD_CODE" => array(
		0 => "NAME",
		1 => "",
	),
	"FILTER_PROPERTY_CODE" => array(
		0 => "REG",
		1 => "CITY",
		2 => "REGION_CITY",
		3 => "REGION",
		4 => "",
	),
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"CHECK_DATES" => "Y",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/offices/",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "N",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "3600",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "N",
	"DISPLAY_PANEL" => "N",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"USE_PERMISSIONS" => "N",
	"PREVIEW_TRUNCATE_LEN" => "250",
	"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
	"LIST_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"LIST_PROPERTY_CODE" => array(
		0 => "NAME_SHORT",
		1 => "EMAIL",
		2 => "PHONES",
		3 => "ADDRESS",
		4 => "",
	),
	"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
	"DISPLAY_NAME" => "Y",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
	"DETAIL_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"DETAIL_PROPERTY_CODE" => array(
		0 => "NAME_SHORT",
		1 => "EMAIL",
		2 => "PHONES",
		3 => "ADDRESS",
		4 => "",
	),
	"DETAIL_DISPLAY_TOP_PAGER" => "N",
	"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
	"DETAIL_PAGER_TITLE" => "Страница",
	"DETAIL_PAGER_TEMPLATE" => "",
	"DETAIL_PAGER_SHOW_ALL" => "N",
	"DISPLAY_TOP_PAGER" => "Y",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Партнеры",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => "",
	"VARIABLE_ALIASES" => array(
		"SECTION_ID" => "SECTION_ID",
		"ELEMENT_ID" => "ELEMENT_ID",
	)
	),
	false
);?> 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>