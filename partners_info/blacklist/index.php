<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Черный список");
?> 
<p>Уважаемые потребители, мы официально не поставляем свою продукцию компаниям из &laquo;черного списка&raquo;. Это значит, что товар в этих магазинах может оказаться БУ, снятый с производства, бракованный или несертифицированный. </p>
 
<p>Приобретая товар в этих магазинах, вы можете столкнуться с трудностями при постановке кассы на учет и при получении гарантийной и сервисной поддержки на территории РФ. </p>
 
<p>Приобретайте продукцию ШТРИХ-М только у официальных дилеров и представителей компании! </p>
 
<p>Список официальных дилеров и представителей расположен по адресу: <a href="/partners_info/partners/" >www.shtrih-m.ru/partners_info/partners/</a>.
  <br />
 	Наш официальный интернет-магазин: <a href="http://retail.shtrih-m.ru/" target="_blank" >retail.shtrih-m.ru</a>. 
  <br />
Мы дорожим нашей репутацией надежного производителя и заботимся, чтобы вся продукция в линейке контрольно-кассовой техники прошла тщательную проверку на контроль качества и соответствовала высшим стандартам в этой области. </p>
 
<p><b>Черный список:</b></p>
 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"blacklist",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "to_partner",
		"IBLOCK_ID" => "75",
		"NEWS_COUNT" => "30",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => "NAME",
		"PROPERTY_CODE" => array("ADRES","PHONE","SITE"),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	)
);?> 
<br />
 
<p> 	<b>Контроль за соблюдением партнерской политики:</b></p>
 
<p> Ковшарь Кристина, Тел (495) 787-60-90 доб.427 
  <br />
 	e-mail: <a href="mailto:kkovshar@shtrih-m.ru" >kkovshar@shtrih-m.ru</a> </p>
 
<p> 	Актуальная информация по розничному <a href="/download_files/1. Прайс-лист_Розница_№06_от_01_августа_2018_г.xlsx" target="_blank" >прайс-листу</a> </p>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>