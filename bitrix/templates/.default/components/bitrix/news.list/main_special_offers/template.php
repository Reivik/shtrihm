<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["ITEMS"]) < 1):?>
	<?return;?>
<?endif;?>
<div class="block special">
	<div class="blockCont">
		<h2>Специальные предложения</h2>
		<ul>
			<?foreach($arResult["ITEMS"] as $item):?>
			<li>
				<div class="photo">
					<a href="<?=$item["DETAIL_PAGE_URL"]?>" title="<?=$item["NAME"]?>">
						<?if($item["PREVIEW_PICTURE"]):?>
							<img src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$item["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$item["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$item["NAME"]?>" title="<?=$item["NAME"]?>" />
						<?else:?>
							<img src="/images/no_photo_59.jpg" alt="<?=$item["NAME"]?>" title="<?=$item["NAME"]?>" />
						<?endif;?>
					</a>
				</div>
				<h3><a href="<?=$item["DETAIL_PAGE_URL"]?>" title="<?=$item["NAME"]?>"><?=$item["NAME"]?></a></h3>
				<p><?=$item["PREVIEW_TEXT"]?></p>
			</li>
			<?endforeach;?>
		</ul>
		<div class="showMore"><a class="showMoreLink" href="#" title="Показать еще">Показать еще</a></div>
	</div>
</div>