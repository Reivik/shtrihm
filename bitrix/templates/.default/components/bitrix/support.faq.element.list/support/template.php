<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="FAQ_filter default_forms">
	<form method="post" id="FAQ_filter_form">
		<div class="FAQ_sections">
				<?$APPLICATION->IncludeComponent(
					"areal:section.select",
					"",
					Array(
						"IBLOCK_TYPE" => "FAQ",
						"IBLOCK_ID" => IB_FAQ_SUPPORT,
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "36000000",
						"CACHE_NOTES" => "",
						"SHOW_ELEMENTS_COUNT" => "Y",
						"SET_ID" => "faq_section_select",
						"SET_NAME" => "SECTION_ID",
						"SHOW_ELEMENTS_COUNT" => "Y",
						"SECTION_ID" => $arParams['SECTION_ID'],
						"DEFAULT_NAME"=> "Все категории"
					)
				);?>
		</div>
		<div class="FAQ_search">
			<div class="search">
				<input type="text" name="q" value="" class="inputText FAQ_Search_input" placeholder="Поиск"/>
				<button type="submit" name="s" class="btn"><i></i> Найти</button>
			</div>
		</div>
	</form>
</div>
<div class="clear"></div>

<?
if (count($arResult["ITEMS"]) < 1)
{
	echo "Не найдено доступных элементов!<br>";
	return;
}
?>

<div class="faq-list">

	<?foreach ($arResult["ITEMS"] as $val):?>
		<div class="faq-item" id="<?=$val["ID"]?>">
			<h3><?=$val["QUESTION"]?></h3>
			<div class="faq-item-answer">
				<?=$val["ANSWER"]?>
			</div>
		</div>
	<?endforeach;?>
</div>