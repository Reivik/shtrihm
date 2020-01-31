<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("SHOW_BANNERS", "Y");
$APPLICATION->SetPageProperty("SHOW_CLIENTS", "N");
$APPLICATION->SetPageProperty("SHOW_SPECIAL_OFFERS", "N");
//$APPLICATION->SetPageProperty("NO_LEFT_MENU", "N");
$APPLICATION->SetPageProperty("SUBSCRIBE_FORM", "Y");
if (isset($_GET['test'])) {
    $APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/new_news_styles.css" type="text/css" />');
    $APPLICATION->SetPageProperty("SUBSCRIBE_FORM", "N");
    $APPLICATION->SetPageProperty("NO_LEFT_MENU", "N");
}
$APPLICATION->SetTitle("Новости");?>
<?$APPLICATION->IncludeComponent("bitrix:news", "news_page", array(
    "IBLOCK_TYPE" => "press_center",
    "IBLOCK_ID" => "7",
    "NEWS_COUNT" => "20",
    "USE_SEARCH" => "N",
    "USE_RSS" => "Y",
    "NUM_NEWS" => "20",
    "NUM_DAYS" => "30",
    "YANDEX" => "Y",
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
        0 => "",
        1 => "",
    ),
    "SORT_BY1" => "ACTIVE_FROM",
    "SORT_ORDER1" => "DESC",
    "SORT_BY2" => "SORT",
    "SORT_ORDER2" => "ASC",
    "CHECK_DATES" => "Y",
    "SEF_MODE" => "Y",
    "SEF_FOLDER" => "/press_center/news/",
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
    "ADD_SECTIONS_CHAIN" => "Y",
    "USE_PERMISSIONS" => "N",
    "PREVIEW_TRUNCATE_LEN" => "",
    "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
    "LIST_FIELD_CODE" => array(
        0 => "",
        1 => "",
    ),
    "LIST_PROPERTY_CODE" => array(
        0 => "",
        1 => "CITY",
        2 => "",
    ),
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
    "DISPLAY_NAME" => "Y",
    "META_KEYWORDS" => "SEO_KEYWORDS",
    "META_DESCRIPTION" => "SEO_DESCRIPTION",
    "BROWSER_TITLE" => "SEO_TITLE",
    "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
    "DETAIL_FIELD_CODE" => array(
        0 => "",
        1 => "",
    ),
    "DETAIL_PROPERTY_CODE" => array(
        0 => "",
        1 => "",
    ),
    "DETAIL_DISPLAY_TOP_PAGER" => "N",
    "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
    "DETAIL_PAGER_TITLE" => "Страница",
    "DETAIL_PAGER_TEMPLATE" => "",
    "DETAIL_PAGER_SHOW_ALL" => "N",
    "DISPLAY_TOP_PAGER" => "N",
    "DISPLAY_BOTTOM_PAGER" => "Y",
    "PAGER_TITLE" => "Новости",
    "PAGER_SHOW_ALWAYS" => "N",
    "PAGER_TEMPLATE" => "",
    "PAGER_DESC_NUMBERING" => "N",
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
    "PAGER_SHOW_ALL" => "N",
    "DISPLAY_DATE" => "Y",
    "DISPLAY_PICTURE" => "Y",
    "DISPLAY_PREVIEW_TEXT" => "Y",
    "DISPLAY_IMG_WIDTH" => "59",
    "DISPLAY_IMG_HEIGHT" => "59",
    "DISPLAY_DETAIL_IMG_WIDTH" => "350",
    "DISPLAY_DETAIL_IMG_HEIGHT" => "1000",
    "SHARPEN" => "30",
    "AJAX_OPTION_ADDITIONAL" => "",
    "SEF_URL_TEMPLATES" => array(
        "news" => "",
        "section" => "#SECTION_CODE#/",
        "detail" => "#SECTION_CODE#/#ELEMENT_CODE#/",
        "rss" => "rss/",
        "rss_section" => "#SECTION_ID#/rss/",
    )
),
    false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>