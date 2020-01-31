<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="aside news_subscribe">
	<div class="block-title">
		<div class="block-content">
			<form action="<?=$arResult["FORM_ACTION"]?>" class="subscribe_form">
				<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
					<input type="hidden" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>" />
				<?endforeach;?>
				<div class="inputContainerr">
					<input type="text" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?=GetMessage("subscr_form_email_title")?>" placeholder="<?=GetMessage("subscr_form_email_title")?>" />
				</div>
				<input type="submit" class="inpBtnn" name="OK" value="Подписаться на новости" />
				<div class="clear"></div>
			</form>
		</div>
	</div>
</div>
