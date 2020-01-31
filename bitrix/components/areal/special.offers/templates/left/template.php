<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if(count($arResult["SPECIALS"]) > 0):?>
	<div class="aside special_offers">
		<div class="block-title">
			<div class="title"><?=GetMessage("OFFER_TITLE")?></div>
			<div class="block-content">
				<?if(!empty($arResult["SPECIALS"])):?>
					<?foreach($arResult["SPECIALS"] as $key => $item):?>	
						<?if($key < $arParams["COUNT_IN_LINE"]):?>
							<article>
								<?if($item["DATE_ACTIVE_FROM"]):?><time><?=$item["DATE_ACTIVE_FROM"]?> - <?=$item["DATE_ACTIVE_TO"]?></time><?endif;?>
								<h2><a href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$item["NAME"]?></a></h2>
							</article>
						<?endif;?>
					<?endforeach;?>
					<div class="clear"></div>
					<div class="all_list">
						<a href="/press_center/special_offers/" title="<?=GetMessage("ALL_OFFERS")?>"><?=GetMessage("ALL_OFFERS")?></a>
					</div>
				<?endif;?>
			</div>
		</div>
	</div>
<?endif;?>

<?/*if(count($arResult["SPECIALS"]) > 0):?>
	<div class="block-title special_offers">
		<div class="title"><?=GetMessage("OFFER_TITLE")?></div>
		<div class="block-content">
			<?foreach($arResult["SPECIALS"] as $key => $item):?>
				<?if($key < $arParams["COUNT_IN_LINE"]):?>
					<article>
						<?if($item["DATE_ACTIVE_FROM"]):?><time><?=$item["DATE_ACTIVE_FROM"]?> - <?=$item["DATE_ACTIVE_TO"]?></time><?endif;?>
						<h2><a href="<?=$item["DETAIL_PAGE_URL"]?>"><?=$item["NAME"]?></a></h2>
					</article>
				<?endif;?>
			<?endforeach;?>
			<div class="clear"></div>
			<div class="all_list">
				<a href="/special_offers/" title="<?=GetMessage("ALL_OFFERS")?>"><?=GetMessage("ALL_OFFERS")?></a>
			</div>
		</div>
	</div>	
<?endif;*/?>