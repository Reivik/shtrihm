<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="ok_info_text">
	<p>Комплексное предложение включает в себя современный кассовый аппарат и фискальный накопитель на 13 месяцев
</p>
</div>
<div class="prod_list">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<?$name = str_replace('"', '', $arItem["NAME"]);?>
	<div class="ok_cat_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="ok_top_line">
			<?if ($arItem["DISPLAY_PROPERTIES"]["FZ54_IN"]["VALUE"]) {?><div class="nov_block"><?=$arItem["DISPLAY_PROPERTIES"]["FZ54_IN"]["VALUE"]?></div><?}?>
			<?if ($arItem["DISPLAY_PROPERTIES"]["EGAIS"]["VALUE"] == "Да") {?><div class="egais_block">ЕГАИС и 54ФЗ</div><?}?>
		</div>
		<div class="ok_main_line">
			<div class="main_foto">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt=""></a>
			</div>
			<div class="main_info">
				<h2><?=$arItem["NAME"]?></h2>
				<p><?=$arItem["PREVIEW_TEXT"]?></p>
				<?if ($arItem["DISPLAY_PROPERTIES"]["PRICE_IN"]["VALUE"]) {?><span><?=$arItem["DISPLAY_PROPERTIES"]["PRICE_IN"]["VALUE"]?> р</span><?}?>
			</div>
		</div>
		<div class="ok_button_line">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="left_but">Смотреть</a> <a onclick="OpenForm<?if ($arItem['DISPLAY_PROPERTIES']['SPEC_LINK']['VALUE']) {?>New<?}?><?=$arItem['ID']?>();yaCounter25873994.reachGoal('form_order'); return true;" class="right_but">Заказать</a>
		</div>
	</div>
	<script>
		function OpenForm<?=$arItem['ID']?>() {
		$('form[name=ONLINE_BILL]').addClass('js-form-address');
		$("body").addClass('body_stop');
		$('#modal').css('display', 'block');
		product_online_till_add('<?=$name?>');
			//$('input[name=form_text_70]').val('<?=$arItem["NAME"]?>:1');
		}
		function OpenFormNew<?=$arItem['ID']?>() {
		$('form[name=ONLINE_BILL]').addClass('js-form-address');
		$('form[name=ONLINE_BILL]').attr('action', '/catalog/online-till/send.php');
		$('.send_button').attr('name', '');
		$("body").addClass('body_stop');
		$('#modal').css('display', 'block');
		product_online_till_add('<?=$name?>');
		}
	</script>
<?endforeach;?>
<script>
	var array_product = [<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
	<?$name = str_replace('"', '', $arItem["NAME"]);?>
	<?$price = str_replace(' ', '', $arItem["DISPLAY_PROPERTIES"]["PRICE_IN"]["VALUE"]);?><?if ($key == 0) {?>['<?=$name?>', '<?=$price?>']<?}else{?>, ['<?=$name?>', '<?=$price?>']<?}?><?endforeach;?>];
</script>
</div>