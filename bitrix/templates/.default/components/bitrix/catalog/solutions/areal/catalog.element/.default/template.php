<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>			
<?if(is_array($arResult["SMALL_PICTURE"]) && !isset($_REQUEST["PAGEN_1"])):?>
	<div class="solutionLogo">
		<a href="<?=$arResult["BIG_PICTURE"]["src"]?>">	
			<img src="<?=$arResult["SMALL_PICTURE"]["src"]?>" width="<?=$arResult["SMALL_PICTURE"]["width"]?>" height="<?=$arResult["SMALL_PICTURE"]["height"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>"  />
			<span class="zoom" title="<?=GetMessage("OPEN_BIG_PICTURE")?>"></span>
		</a>
	</div>
<?endif?>
<?if(count($arResult["MORE_PHOTO"])>0):?>
	<a href="#more_photo"><?=GetMessage("CATALOG_MORE_PHOTO")?></a>
<?endif;?>
<div class="page_nav_solution">
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"] == "Y"):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
</div>
<div class="print_article"><a href="/print/?id=<?=$arResult["ID"]?>" title="Распечатать статью" target="_blank" class="add">Распечатать статью</a></div>
<div class="clear"></div>
<?
$GLOBALS["introFilter"] = array("PROPERTY_SOLUTION" => $arResult["ID"]);
$APPLICATION->IncludeComponent("bitrix:news.list", "solution", array(
	"IBLOCK_TYPE" => "clients",
	"IBLOCK_ID" => "8",
	"NEWS_COUNT" => "20",
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