<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Онлайн-кассы");

$APPLICATION->SetPageProperty("NO_LEFT_MENU", "N");
$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/slick.css" type="text/css" />');
$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/new_styles.css?65" type="text/css" />');
$APPLICATION->AddHeadScript('/design/js/slick.min.js');
$APPLICATION->AddHeadString('<link rel="stylesheet" href="/design/css/jquery.kladr.min.css" type="text/css" />');
?>
<?if (isset($_GET['test'])) {?>
	<?global $arnewFilter;
	$arnewFilter=array("PROPERTY"=>array("ONLINE_IN"=>"738"));
	$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"online-till-test",
		Array(
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"AJAX_MODE" => "N",
			"IBLOCK_TYPE" => "catalog",
			"IBLOCK_ID" => "4",
			"NEWS_COUNT" => "50",
			"SORT_BY1" => "SORT",
			"SORT_ORDER1" => "ASC",
			"SORT_BY2" => "ACTIVE_FROM",
			"SORT_ORDER2" => "DESC",
			"FILTER_NAME" => "arnewFilter",
			"FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE"),
			"PROPERTY_CODE" => array("EGAIS","ONLINE_IN","FZ54_IN","PRICE_IN","SPEC_LINK", "NEW_POPUP"),
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
			"INCLUDE_SUBSECTIONS" => "Y",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "360",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_TITLE" => "Новости",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N"
		)
	);?>
<?}else{?>
<?global $arnewFilter;
$arnewFilter=array("PROPERTY"=>array("ONLINE_IN"=>"738"));
$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"online-till-new",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"NEWS_COUNT" => "50",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ACTIVE_FROM",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "arnewFilter",
		"FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE","DETAIL_PICTURE"),
		"PROPERTY_CODE" => array("EGAIS","ONLINE_IN","FZ54_IN","PRICE_IN","SPEC_LINK","MORE_PHOTO", "FILTER_ON", "FOR_WHO", "SUPPLY_FOR", "NEW_POPUP"),
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
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	)
);?>
<?}?>
<?
if(CModule::IncludeModule("iblock"))
{
	CityDefinition();
	$arResult = GetLocationInformation();
	if(!empty($arResult["REGIONS"])):?>
<?
$utm_source = htmlspecialchars($_GET["utm_source"]);
$utm_medium = htmlspecialchars($_GET["utm_medium"]);
$utm_campaign = htmlspecialchars($_GET["utm_campaign"]);
$utm_content = htmlspecialchars($_GET["utm_content"]);
$utm_term = htmlspecialchars($_GET["utm_term"]);
?>
<script>
    
    
        $('a#30481').attr('href', 'https://www.shtrih-m.ru/partners_info/rt-online/');
    $('a#30481').removeAttr('onclick');
    

</script>
<script language="JavaScript">
document.body.innerHTML = document.body.innerHTML.replace('<span>2360 Р</span>', '<span style="font-size: 31px;">2360 Р/Мес</span>');
document.body.innerHTML = document.body.innerHTML.replace('<div class="price_block">2360 Р</div>', '<div class="price_block">2360 Р/Мес</div>');
</script>
<?//echo"<pre>";print_r($arResult["REGIONS"]);?>
<script>
$(document).ready(function(){
	$('input[name=form_text_172]').search_place_input('change',{name: '<?=($arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]][$arResult["SELECTED_REGION"]])?$arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]][$arResult["SELECTED_REGION"]]:''?>',});
 	$('input[name=form_text_171]').search_place_input('change',{name: '<?=($arResult["TOWNS"][$arResult["SELECTED_REGION"]][$arResult["SELECTED_TOWN"]])?$arResult["TOWNS"][$arResult["SELECTED_REGION"]][$arResult["SELECTED_TOWN"]]:''?>',});
	$('input[name=form_text_175]').addClass('hidden');
	$('input[name=form_text_176]').addClass('hidden');
	$('input[name=form_text_177]').addClass('hidden');
	$('input[name=form_text_178]').addClass('hidden');
	$('input[name=form_text_179]').addClass('hidden');
	$('input[name=form_text_173]').removeAttr('required');
	$('input[name=form_text_175]').removeAttr('required');
	$('input[name=form_text_176]').removeAttr('required');
	$('input[name=form_text_177]').removeAttr('required');
	$('input[name=form_text_178]').removeAttr('required');
	$('input[name=form_text_179]').removeAttr('required');
	$('input[name=form_text_175]').val('<?=$utm_source?>');
	$('input[name=form_text_176]').val('<?=$utm_medium?>');
	$('input[name=form_text_177]').val('<?=$utm_campaign?>');
	$('input[name=form_text_178]').val('<?=$utm_content?>');
	$('input[name=form_text_179]').val('<?=$utm_term?>');

	/**********для новой формы*************/
	$('input[name=form_text_218]').search_place_input('change',{name: '<?=($arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]][$arResult["SELECTED_REGION"]])?$arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]][$arResult["SELECTED_REGION"]]:''?>',});
 	$('input[name=form_text_217]').search_place_input('change',{name: '<?=($arResult["TOWNS"][$arResult["SELECTED_REGION"]][$arResult["SELECTED_TOWN"]])?$arResult["TOWNS"][$arResult["SELECTED_REGION"]][$arResult["SELECTED_TOWN"]]:''?>',});
	/*$('input[name=form_text_175]').addClass('hidden');
	$('input[name=form_text_176]').addClass('hidden');
	$('input[name=form_text_177]').addClass('hidden');
	$('input[name=form_text_178]').addClass('hidden');
	$('input[name=form_text_179]').addClass('hidden');
	$('input[name=form_text_219]').removeAttr('required');
	$('input[name=form_text_175]').removeAttr('required');
	$('input[name=form_text_176]').removeAttr('required');
	$('input[name=form_text_177]').removeAttr('required');
	$('input[name=form_text_178]').removeAttr('required');
	$('input[name=form_text_179]').removeAttr('required');
	$('input[name=form_text_175]').val('<?=$utm_source?>');
	$('input[name=form_text_176]').val('<?=$utm_medium?>');
	$('input[name=form_text_177]').val('<?=$utm_campaign?>');
	$('input[name=form_text_178]').val('<?=$utm_content?>');
	$('input[name=form_text_179]').val('<?=$utm_term?>');*/

});
</script>
	<?endif;?>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>