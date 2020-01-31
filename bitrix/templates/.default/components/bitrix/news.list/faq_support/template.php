<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"]) > 0):?>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="answer_faq">
			<h3><?=$arItem["DISPLAY_PROPERTIES"]["QUESTION"]["VALUE"]["TEXT"]?></h3>
			<p><?=$arItem["DISPLAY_PROPERTIES"]["ANSWER"]["~VALUE"]["TEXT"]?></p>
		</div>
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?else:?>
	<p>По Вашему запросу не найдено подходящей информации. Попробуйте изменить параметры фильтра.</p>
<?endif;?>
