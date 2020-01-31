<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");?>

<?if (count($arResult['IDS']) > 0 && CModule::IncludeModule('sale')):?>
	<?$arItemsInCompare = array();
	foreach ($arResult['IDS'] as $ID)
	{
		if (isset($_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"][$ID]))
			$arItemsInCompare[] = $ID;
	}	
	
	if(array_keys($_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"])) {
		$compare_url = implode("-", array_keys($_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"]));
		if($compare_url)
			$arParams["COMPARE_URL"] = $arParams["COMPARE_URL"]."?compare_id=".$compare_url;
	}
	?>
	<?foreach($arResult["IDS"] as $item):?>
		<?if(in_array($item, $arItemsInCompare)):?>
			<script type="text/javascript">
				$("div.compare_id_"+"<?=$item?>").append('<div class="compare left"><label class="label_check" for="checkbox2-<?=$item?>"><input name="sample-checkbox2_<?=$item?>" id="checkbox2-<?=$item?>" value="<?=$item?>" type="checkbox" checked="checked"><span style="display: none" class="compareLink" id="<?=$item?>" href="<?=$arParams["DETAIL_URL"]?>">Сравнить</span>&nbsp;</label><a class="in_compare" name="<?=$item?>" href="<?=$arParams["COMPARE_URL"]?>" title="В список сравнения" style="display: block">Сравнить</a></div>');
			</script>
		<?else:?>
			<script type="text/javascript">
				$("div.compare_id_"+"<?=$item?>").append('<div class="compare left"><label class="label_check" for="checkbox2-<?=$item?>"><input name="sample-checkbox2_<?=$item?>" id="checkbox2-<?=$item?>" value="<?=$item?>" type="checkbox"><span class="compareLink" id="<?=$item?>" href="<?=$arParams["DETAIL_URL"]?>">Сравнить</span>&nbsp;</label><a class="in_compare" name="<?=$item?>" href="<?=$arParams["COMPARE_URL"]?>" title="В список сравнения" style="display: none">Сравнить</a></div>');
			</script>
		<?endif;?>
	<?endforeach;?>
<?endif;?>