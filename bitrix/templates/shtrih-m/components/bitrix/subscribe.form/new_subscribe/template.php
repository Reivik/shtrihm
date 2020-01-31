<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
	.block-subs {width:100%;margin-top:40px;background:url("/design/images/shadow.png") repeat-x scroll 0 100% transparent;
    padding: 0 0 10px;}
	.subs-title {font-size:16px;line-height:20px;color:#0b0b0b;text-transform:uppercase;}
</style>
	<div class="block-subs">
		<div class="blockCont" style="background:#eaeaea;">
		<div class="subs-title"><?=GetMessage("TITLE")?></div>
		<div class="block-content">
			<form action="<?=$arResult["FORM_ACTION"]?>" class="subscribe_form" style="padding:5px 0;">
				<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
					<input type="hidden" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>" />
				<?endforeach;?>
				<div class="inputContainer" style="width:79%;float:left;height: 29px;padding:0;">
					<input type="text" style="padding:0 10px;width:auto;" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?=GetMessage("subscr_form_email_title")?>" placeholder="<?=GetMessage("subscr_form_email_title")?>" />
				</div>
				<input type="submit" class="inpBtn" style="clear:none;margin-left:2%;width:18%;" name="OK" value="<?=GetMessage("subscr_form_button")?>" />
				<!-- a href="/press_center/news/rss/" title="RSS" target="_blank" class="rss_link"><img src="/design/images/rss_small.png" title="RSS" alt="RSS" /></a -->
				<div class="clear"></div>
			</form>
		</div>
	</div>
</div>



<?/*
<div class="aside news_subscribe">
	<div class="block">
		<div class="blockCont">
			<div class="pointer"></div>
			<div class="title">
				<h2><?=GetMessage("TITLE")?></h2>
			</div>
			<form action="<?=$arResult["FORM_ACTION"]?>" class="subscribe_form">
				<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
					<input type="hidden" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>" />
				<?endforeach;?>
				<div class="inputContainer">
					<input type="text" name="sf_EMAIL" size="20" value="<?=$arResult["EMAIL"]?>" title="<?=GetMessage("subscr_form_email_title")?>" placeholder="<?=GetMessage("subscr_form_email_title")?>" />
				</div>
				<input type="submit" class="inpBtn" name="OK" value="<?=GetMessage("subscr_form_button")?>" />
				<a href="/press_center/news/rss/" title="RSS" target="_blank" class="rss_link"><img src="/design/images/rss_small.png" title="RSS" alt="RSS" /></a>
				<div class="clear"></div>
			</form>
		</div>
	</div>
</div>*/?>
