<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if(count($arResult["ITEMS"]) > 0):?>
	<div class="block-title special_offers vebinar">
		<div class="title">Популярные вебинары</div>
		<div class="block-content">
			<?foreach($arResult["ITEMS"] as $key => $item):?>
				<article>
					<h2><a href="/player.php?id=<?=$item["ID"]?>" onclick="window.open(this.href, this.target,'width=<?=$item["VIDEO"]["width"]?>,height=<?=$item["VIDEO"]["height"]?>,scrollbars=0');return false;" title="Смотреть"><?=$item["NAME"]?></a></h2>
					<div class="vebinar_info">
						<?if(!empty($item["PREVIEW_PICTURE"]["src"])):?>
							<img src="<?=$item["PREVIEW_PICTURE"]["src"]?>" width="<?=$item["PREVIEW_PICTURE"]["width"]?>" height="<?=$item["PREVIEW_PICTURE"]["height"]?>" title="<?=$item["NAME"]?>" />
						<?else:?>
							<img src="/design/images/no-photo/pic85x64.png" width="85" height="64" title="<?=$item["NAME"]?>" />
						<?endif;?>
						Ведущий: <?=$item["LEADING"]?>
					</div>
				</article>
			<?endforeach;?>
			<div class="clear"></div>
		</div>
	</div>	
<?endif;?>