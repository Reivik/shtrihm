<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->SetPageProperty("CONGRATULATION", "Y");?>

<div class="clear"></div>
<?$APPLICATION->IncludeComponent("areal:best_in_month", ".default");?>
<div class="clear"></div>
<div id="introduction" class="list_item_tabs">
	<ul>
		<li class="list_item_tab"><a href="#company_list"><span>Список компаний</span></a></li>
		<li class="list_item_tab"><a href="#competences"><span>Компетенции</span></a></li>
		<li class="list_item_tab"><a href="#congratulations"><span>Как выбрать партнера?</span></a></li>
		<li class="list_item_tab"><a href="#sales_leaders"><span>Лидеры продаж</span></a></li>
	</ul>
	<div id="company_list">
		<?if($arParams["USE_FILTER"]=="Y"):?>
			<?$APPLICATION->IncludeComponent("areal:filter_partner", "");?>
		<?endif?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"",
			Array(
				"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
				"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
				"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
				"SORT_BY1"	=>	$arParams["SORT_BY1"],
				"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
				"SORT_BY2"	=>	$arParams["SORT_BY2"],
				"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
				"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
				"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
				"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
				"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
				"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
				"SET_TITLE"	=>	"N",
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
				"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
				"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
				"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
				"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
				"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
				"DISPLAY_NAME"	=>	"Y",
				"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
				"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
				"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
				"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
				"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
				"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
				"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
				"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
				"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
			),
			$component
		);?>
	</div>
	<div id="competences">
		<?$APPLICATION->IncludeComponent("bitrix:news.list", "statuses", array(
			"IBLOCK_TYPE" => "partners",
			"IBLOCK_ID" => IB_STATUS_COMPANY,
			"NEWS_COUNT" => "20",
			"SORT_BY1" => "PROPERTY_RATING",
			"SORT_ORDER1" => "DESC",
			"SORT_BY2" => "",
			"SORT_ORDER2" => "",
			"FILTER_NAME" => "",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
				2 => "",
			),
			"PROPERTY_CODE" => array(
				0 => "",
				1 => "",
				2 => "",
			),
			"CHECK_DATES" => "N",
			"DETAIL_URL" => "",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "N",
			"PREVIEW_TRUNCATE_LEN" => "",
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"SET_TITLE" => "N",
			"SET_STATUS_404" => "N",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_TITLE" => "",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "",
			"PAGER_SHOW_ALL" => "N",
			"DISPLAY_DATE" => "N",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"AJAX_OPTION_ADDITIONAL" => ""
			),
			$component
		);?>
	</div>
	<div id="congratulations">
		<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/how_to_become_a_partner.php"), false);?>
	</div>
	<div id="sales_leaders">
		<?$APPLICATION->IncludeComponent("areal:top_salers", ".default");?>
	</div>
</div>
<?$APPLICATION->IncludeComponent(
	"areal:special.offers", 
	".default", 
	array( 
		"COUNT_IN_LINE" => 2,
		"SHOW_ALL" => "N"
	)
);?>