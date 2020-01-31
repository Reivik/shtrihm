<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
	<div class="aside">
		<div class="aside-news-list block-title">
			<div class="title"><?=GetMessage("TITLE")?></div>
			<div class="block-content">
				<?foreach($arResult["ITEMS"] as $item):?>
						<article>
							<time><?=$item["DATE"]?></time>
							<h2><a href="<?=$item["DETAIL_PAGE_URL"]?>" title="<?=$item["NAME"]?>"><?=$item["NAME"]?></a></h2>
						</article>
				<?endforeach;?>
				<div class="all"><a href="/partners_info/achievements/"><?=GetMessage("ALL_NEWS")?></a></div>
			</div>
		</div>
	</div>
<?endif;?>