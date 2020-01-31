<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="reg_page">
	<div class="partner_banner till_banner">
		<div class="partner_banner_info no_margin">
			<h1>ОНЛАЙН-КАССЫ</h1>
			<p>Комплексное предложение включает в себя современный кассовый аппарат и фискальный накопитель на 13 месяцев</p>
		</div>
	</div>
	<div class="till_block hit_block">
		<h2 class="sect_title">Хит продаж</h2>
		<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<?$name = str_replace('"', '', $arItem["NAME"]);?>
		<?if ($arItem["DISPLAY_PROPERTIES"]["FZ54_IN"]["VALUE"] == "Хит") {?>
		<div class="till_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="till_pict">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>"></a>
			</div>
			<div class="till_info">
				<h3><?=$arItem["NAME"]?></h3>
				<span class="till_type">Онлайн-касса</span>
				<div class="till_price">
					Розничная цена: <span><?=$arItem["DISPLAY_PROPERTIES"]["PRICE_IN"]["VALUE"]?> р</span>
				</div>
				<div class="till_text">
					<?=$arItem["PREVIEW_TEXT"]?>
				</div>
				<div class="till_buttons">
					<?if ($arItem["DISPLAY_PROPERTIES"]["EGAIS"]["VALUE"] == "Да") {?><div class="till_egais">
						ЕГАИС и 54-ФЗ
					</div><?}?>
					<a onclick="OpenForm<?if ($arItem['DISPLAY_PROPERTIES']['SPEC_LINK']['VALUE']) {?>New<?}?><?=$arItem['ID']?>();yaCounter25873994.reachGoal('form_order'); return true;" class="button_popup">Заказать</a>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="button_popup bottom_button">Смотреть</a>
				</div>
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
		<?}?>
		<?endforeach;?>
	</div>
	<div class="till_block other_block">
		<h2 class="sect_title">Оптимальное и готовое решение</h2>
		<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<?$name = str_replace('"', '', $arItem["NAME"]);?>
		<?if ($arItem["DISPLAY_PROPERTIES"]["FZ54_IN"]["VALUE"] != "Новинка" && $arItem["DISPLAY_PROPERTIES"]["FZ54_IN"]["VALUE"] != "Хит") {?>
		<div class="till_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="till_pict">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>"></a>
			</div>
			<div class="till_info">
				<h3><?=$arItem["NAME"]?></h3>
				<span class="till_type">Онлайн-касса</span>
				<div class="till_price">
					Розничная цена: <span><?=$arItem["DISPLAY_PROPERTIES"]["PRICE_IN"]["VALUE"]?> р</span>
				</div>
				<div class="till_text">
					<?=$arItem["PREVIEW_TEXT"]?>
				</div>
				<div class="till_buttons">
					<?if ($arItem["DISPLAY_PROPERTIES"]["EGAIS"]["VALUE"] == "Да") {?><div class="till_egais">
						ЕГАИС и 54-ФЗ
					</div><?}?>
					<a onclick="OpenForm<?if ($arItem['DISPLAY_PROPERTIES']['SPEC_LINK']['VALUE']) {?>New<?}?><?=$arItem['ID']?>();yaCounter25873994.reachGoal('form_order'); return true;" class="button_popup">Заказать</a>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="button_popup bottom_button">Смотреть</a>
				</div>
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
		<?}?>
		<?endforeach;?>
	</div>
	<div class="till_block nov_block">
		<h2 class="sect_title">Новинка</h2>
		<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<?$name = str_replace('"', '', $arItem["NAME"]);?>
		<?if ($arItem["DISPLAY_PROPERTIES"]["FZ54_IN"]["VALUE"] == "Новинка") {?>
		<div class="till_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="till_pict">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>"></a>
			</div>
			<div class="till_info">
				<h3><?=$arItem["NAME"]?></h3>
				<span class="till_type">Онлайн-касса</span>
				<div class="till_price">
					Розничная цена: <span><?=$arItem["DISPLAY_PROPERTIES"]["PRICE_IN"]["VALUE"]?> р</span>
				</div>
				<div class="till_text">
					<?=$arItem["PREVIEW_TEXT"]?>
				</div>
				<div class="till_buttons">
					<?if ($arItem["DISPLAY_PROPERTIES"]["EGAIS"]["VALUE"] == "Да") {?><div class="till_egais">
						ЕГАИС и 54-ФЗ
					</div><?}?>
					<a onclick="OpenForm<?if ($arItem['DISPLAY_PROPERTIES']['SPEC_LINK']['VALUE']) {?>New<?}?><?=$arItem['ID']?>();yaCounter25873994.reachGoal('form_order'); return true;" class="button_popup">Заказать</a>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="button_popup bottom_button">Смотреть</a>
				</div>
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
		<?}?>
		<?endforeach;?>
	</div>
<script>
	var array_product = [<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
	<?$name = str_replace('"', '', $arItem["NAME"]);?>
	<?$price = str_replace(' ', '', $arItem["DISPLAY_PROPERTIES"]["PRICE_IN"]["VALUE"]);?><?if ($key == 0) {?>['<?=$name?>', '<?=$price?>']<?}else{?>, ['<?=$name?>', '<?=$price?>']<?}?><?endforeach;?>];
</script>
</div>