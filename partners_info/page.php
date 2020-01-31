<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "Сервисные центры");
$APPLICATION->SetPageProperty("keywords_inner", "Сервисные центры");
$APPLICATION->SetPageProperty("title", "Где купить?");
$APPLICATION->SetPageProperty("keywords", "Сервисные центры");
$APPLICATION->SetPageProperty("description", "Сервисные центры");
$APPLICATION->SetTitle("Где купить?");
?> 
<p>Продажей, внедрением, и последующей поддержкой продукции компании &laquo;ШТРИХ-М&raquo; занимаются партнеры компании &ndash; сервисные центры, имеющие статусы «СЕРВИС-ПАРТНЕР» и «АСЦ».</p>
 
<p>Данные статусы получают те компании, которые прошли специальную аттестацию и имеющие соответствующие сертификаты, а также соответствуют всем требованиям компании «ШТРИХ-М» в части технического и программного оснащения.</p>
 
<p>В случае необходимости какого либо ремонта компания «ШТРИХ-М» рекомендует обращаться напрямую к партнерам, имеющим данные статусы в соответствующем вашему регионе. Это позволит оперативно решить возникшие вопросы, провести необходимую диагностику и ремонт оборудования. А также закупить необходимое оборудование.</p>
 <?$APPLICATION->IncludeComponent("bitrix:catalog.smart.filter", "partner_list_filter1", Array(
	"IBLOCK_TYPE" => "partners",	// Тип инфоблока
	"IBLOCK_ID" => "83",	// Инфоблок
	"SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела инфоблока
	"FILTER_NAME" => "arrFilter",	// Имя выходящего массива для фильтрации
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"SAVE_IN_SESSION" => "N",	// Сохранять установки фильтра в сессии пользователя
	"INSTANT_RELOAD" => "N",	// Мгновенная фильтрация при включенном AJAX
	"PRICE_CODE" => "",	// Тип цены
	),
	false
);?><?$APPLICATION->IncludeComponent("bitrix:catalog.section", "partner_list", array(
	"IBLOCK_TYPE" => "partners",
	"IBLOCK_ID" => "83",
	"SECTION_ID" => $_REQUEST["SECTION_ID"],
	"SECTION_CODE" => "",
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"ELEMENT_SORT_FIELD" => "sort",
	"ELEMENT_SORT_ORDER" => "asc",
	"FILTER_NAME" => "arrFilter",
	"INCLUDE_SUBSECTIONS" => "Y",
	"SHOW_ALL_WO_SECTION" => "N",
	"PAGE_ELEMENT_COUNT" => "10",
	"LINE_ELEMENT_COUNT" => "3",
	"PROPERTY_CODE" => array(
		0 => "EMAIL",
		1 => "PHONES",
		2 => "REG_CITY",
		3 => "WWW",
		4 => "",
	),
	"OFFERS_LIMIT" => "10",
	"SECTION_URL" => "",
	"DETAIL_URL" => "",
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"ADD_SECTIONS_CHAIN" => "N",
	"DISPLAY_COMPARE" => "N",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "N",
	"CACHE_FILTER" => "N",
	"PRICE_CODE" => array(
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_PROPERTIES" => array(
	),
	"USE_PRODUCT_QUANTITY" => "N",
	"CONVERT_CURRENCY" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "Y",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
<style type="text/css">
	.pageCont table tr:nth-child(2n+1) td {
	    background: transparent;
	}
	.pageCont table td {
	
	    border-width: 0px;
	      padding: 4px 3px;
	}
	.pageCont table {
	    border-collapse: collapse;
	    clear: both;
	    width: 100%;
	    border-width: 0;
	    border-style: solid;
	    border-color: #eaeaea;
	    margin-bottom: 16px;
	}
	.pageCont table thead tr td{font-weight: bold;}
	.pageCont table a{color: #005baa}
	.pageCont table td {
    border-width: 0px;
    padding: 4px 3px;
    vertical-align: middle;
}
	.pageCont table tr {
	
	    padding: 4px 0 4px 0;
	    color: #4d4d4d;
	    font-family: AchilleIICyrFYB;
	    font-size: 14px;
	    font-weight: normal;
	    border-bottom: 1px solid #ceebf9;
	    vertical-align: middle;
	}
	#set_filter,#del_filter{height: 30px;
    width: 250px;
    margin: 5px 40px 15px 0;
    display: inline-block;
    text-align: center;
    border: 1px solid #005baa;
    background-color: #F47320;
    color: white;
    font-weight: bold;
    font-family: AchilleIICyrFYMedium;}
    .row .bx-filter-parameters-box .bx-filter-block .bx-filter-parameters-box-container .col-xs-12 .bx-filter-select-container .bx-filter-select-block .bx-filter-select-arrow {
	    position: absolute;
	    top: 0;
	    right: 0;
	    width: 34px;
	    height: 33px;
	    cursor: pointer;
	    background: url(/images/select-dropdown-trigger.png) no-repeat right #fffefd;
	}

	.row .bx-filter-parameters-box .bx-filter-block .bx-filter-parameters-box-container .col-xs-12 .bx-filter-select-container {
    display: block;
    box-sizing: border-box;
    height: 35px;
    border-radius: 0;
    border: 1px solid #005baa;
}
.row .bx-filter-parameters-box .bx-filter-parameters-box-title .bx-filter-parameters-box-hint {
    color: #000;
    border-bottom: 1px solid transparent;
    cursor: pointer;
    font-family: AchilleIICyrFYMedium;
    font-size: 20px;
}
.popup-window .bx-filter-select-popup ul{width: 500px !important; max-height: 300px; overflow-y: scroll;}
.popup-window .bx-filter-select-popup ul li{display: block !important;}
.bx-filter-select-popup .bx-filter-param-label {
    min-height: 20px;
    font-weight: normal;
    cursor: pointer;
    float: none;
    display: block;
    color: #000;
    margin-right: 5px;
}
</style>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>