<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(array_keys($_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"])) {
	$compare_url = implode("-", array_keys($_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"]));
	if($compare_url)
		$arParams["COMPARE_URL"] = $arParams["COMPARE_URL"]."?compare_id=".$compare_url;
}
?>
<?if (isset($_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"][$arResult["ID"]])):?>
	<script type="text/javascript">
		$("div.compare_detail").append('<div class="compare left"><label class="label_check" for="checkbox2-<?=$arResult["ID"]?>"><input name="sample-checkbox2_<?=$arResult["ID"]?>" id="checkbox2-<?=$arResult["ID"]?>" value="<?=$arResult["ID"]?>" type="checkbox" checked="checked"><span style="display: none" class="compareLink" id="<?=$arResult["ID"]?>" href="<?=$arParams["DETAIL_URL"]?>">Сравнить</span>&nbsp;</label><a class="in_compare" name="<?=$arResult["ID"]?>" href="<?=$arParams["COMPARE_URL"]?>" title="В список сравнения" style="display: block">Сравнить</a></div>');
	</script>
<?else:?>
	<script type="text/javascript">
		<?$COMPARE_URL = htmlspecialcharsbx($APPLICATION->GetCurPageParam("action=ADD_TO_COMPARE_LIST&id=".$arResult["ID"], array("action", "id")));?>
		$("div.compare_detail").append('<div class="compare left"><label class="label_check" for="checkbox2-<?=$arResult["ID"]?>"><input name="sample-checkbox2_<?=$arResult["ID"]?>" id="checkbox2-<?=$arResult["ID"]?>" value="<?=$arResult["ID"]?>" type="checkbox"><span class="compareLink" id="<?=$arResult["ID"]?>" href="<?=$arParams["DETAIL_URL"]?>">Сравнить</span>&nbsp;</label><a class="in_compare" name="<?=$arResult["ID"]?>" href="<?=$COMPARE_URL?>" title="В список сравнения" style="display: none">Сравнить</a></div>');
	</script>
<?endif;?>

<?/*
	<div id="reviews">
		<?$GLOBALS["reviewFilter"] = array("PROPERTY_PRODUCT" => $arResult["ID"]);
		$APPLICATION->IncludeComponent("bitrix:news.list", "product_review", array(
			"IBLOCK_TYPE" => "clients",
			"IBLOCK_ID" => REVIEWS,
			"NEWS_COUNT" => 100000,
			"SORT_BY1" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_BY2" => "NAME",
			"SORT_ORDER2" => "ASC",
			"FILTER_NAME" => "reviewFilter",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"PROPERTY_CODE" => array(
				0 => "SOLUTION",
				1 => "",
			),
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
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
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Отзывы",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"AJAX_OPTION_ADDITIONAL" => ""
			),
			false
		);?>
	</div>
*/?>
	<div id="goods">
		<?if(count($arResult["PROPERTIES"]["other_product"]["VALUE"]) > 0)
			$GLOBALS["productFilter"] = array("ID" => $arResult["PROPERTIES"]["other_product"]["VALUE"]);
		else $GLOBALS["productFilter"] = array("ID" => array("-1"));
		$APPLICATION->IncludeComponent("bitrix:catalog.section", "product", array(
	"IBLOCK_TYPE" => "catalog",
	"IBLOCK_ID" => "4",
	"SECTION_ID" => "",
	"SECTION_CODE" => "",
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"ELEMENT_SORT_FIELD" => "",
	"ELEMENT_SORT_ORDER" => "",
	"FILTER_NAME" => "productFilter",
	"INCLUDE_SUBSECTIONS" => "Y",
	"SHOW_ALL_WO_SECTION" => "Y",
	"PAGE_ELEMENT_COUNT" => "5",
	"LINE_ELEMENT_COUNT" => "1",
	"PROPERTY_CODE" => array(
		0 => "EGAIS",
		1 => "PRICE_IN",
		2 => "",
	),
	"OFFERS_LIMIT" => "5",
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
	"SET_TITLE" => "N",
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
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
	</div>
<?if($arResult["PROPERTIES"]["buy"]["VALUE"]=="N") {?>
<?}else{?>
	<div id="introduction">
		<?$GLOBALS["introFilter"] = array(array("LOGIC" => "OR", "PROPERTY_EQUIPMENT" => $arResult["ID"], "PROPERTY_SOFTWARE" => $arResult["ID"]));
		$APPLICATION->IncludeComponent("bitrix:news.list", "product_introduction", array(
			"IBLOCK_TYPE" => "clients",
			"IBLOCK_ID" => IB_INTRO,
			"NEWS_COUNT" => 100000,
			"SORT_BY1" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_BY2" => "NAME",
			"SORT_ORDER2" => "ASC",
			"FILTER_NAME" => "introFilter",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"PROPERTY_CODE" => array(
				0 => "SOLUTION",
				1 => "",
			),
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "36000000",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
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
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Внедрения",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"AJAX_OPTION_ADDITIONAL" => ""
			),
			false
		);?>		
	</div>
<?}?>
	<div id="download">
		<?/*$GLOBALS["fileFilter"] = array("PROPERTY_PRODUCT" => $arResult["ID"]);?>
		<?$APPLICATION->IncludeComponent("areal:document.list", ".default", array(
			"IBLOCK_ID" => array(IB_DOWNLOAD_FILES, IB_PRINTING_PRODUCTS, IB_DOCS),
			"NEWS_COUNT" => 100000,
			"SECTION_CODE" => "normative", 
			"DOWNLOAD_PATH" => "/docs/download.php", 
			"FILTER_NAME" => "fileFilter",
			"SELECT_PROP" => array(
				"PROPERTY_TYPE_CONTROL", 
				"PROPERTY_LAST_UPDATE", 
				"PROPERTY_VERSION", 
				"PROPERTY_PRODUCT",
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
		));*/?>
		<?
			$GLOBALS["fileFilter"] = array("PROPERTY_PRODUCT" => $arResult["ID"]);
			$APPLICATION->IncludeComponent("areal:product.download", ".default", array(
				"IBLOCK_ID" => array(21, 45, 43),
				"DOWNLOAD_PATH" => "/docs/download.php",
				"PRODUCT" => $arResult["ID"],
				"SELECT_PROP" => array(
					"PROPERTY_VERSION", 
					"PROPERTY_LAST_UPDATE", 
					"PROPERTY_FILE", 
					"PROPERTY_PRODUCT", 
					"PROPERTY_SECTION_ID"
				)
			));
		?>
	</div>
    <?if ($arResult["PROPERTIES"]["POSM"]["VALUE"]) {?>
        <div id="posm">
            <strong>Список POS-материалов:</strong>
            <?foreach ($arResult["PROPERTIES"]["POSM"]["VALUE"] as $keyp => $arPosm) {?>
                <p><a href="<?=CFile::GetPath($arPosm)?>" target="_blank"><?=$arResult["PROPERTIES"]["POSM"]["DESCRIPTION"][$keyp]?></a></p>
            <?}?>
        </div>
    <?}?>
    <?if ($arResult["PROPERTIES"]["LISTS"]["VALUE"]) {?>
        <div id="lists">
            <strong>Список листовок:</strong>
            <?foreach ($arResult["PROPERTIES"]["LISTS"]["VALUE"] as $keyl => $arList) {?>
                <p><a href="<?=CFile::GetPath($arList)?>" target="_blank"><?=$arResult["PROPERTIES"]["LISTS"]["DESCRIPTION"][$keyl]?></a></p>
            <?}?>
        </div>
    <?}?>
    <?if ($arResult["PROPERTIES"]["ONLINE_IN"]["VALUE"]) {?>
        <div id="videos">
            <?
            $resVideo = CIBlockElement::GetList(
                Array('SORT'=>'ASC'),
                Array('IBLOCK_ID'=>79, 'PROPERTY_LMNT'=>$arResult['ID'], 'ACTIVE'=>'Y'),
                false,
                false,
                Array('NAME', 'PREVIEW_PICTURE', 'PROPERTY_LINK')
            );
            while($obVideo = $resVideo->GetNext())
            {
                $prevSrc = CFile::GetPath($obVideo['PREVIEW_PICTURE']);
                $video[] = array(
                    'NAME' => $obVideo['NAME'],
                    'PREVIEW_PICTURE' => $prevSrc,
                    'LINK' => $obVideo['PROPERTY_LINK_VALUE']
                );
            }
            $arResult['VIDEOS'] = $video;
            ?>
            <?if ($arResult['VIDEOS']) {?>
                <?foreach ($arResult['VIDEOS'] as $arVideo) {?>
                    <div class="video_block_detail" data-link="<?=$arVideo['LINK']?>?rel=0&amp;showinfo=0">
                        <img width="100%" height="110" src="<?=$arVideo['PREVIEW_PICTURE']?>" alt="<?=$arVideo['NAME']?>">
                        <div class="video_title">
                            <p><?=$arVideo['NAME']?></p>
                        </div>
                    </div>
                <?}?>
            <?}else{?>
                Видео-файлы скоро будут загружены
            <?}?>
        </div>
    <?}?>
	<div class="clear"></div>
</div>
