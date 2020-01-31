<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="block-title">
	<div class="title"><?=GetMessage("TITLE")?></div>
	<div class="block-content">
		<?if(!empty($arResult["ITEMS_LIST"])):?>
			<?$k=0;?>
			<?foreach($arResult["ITEMS_LIST"] as $item):?>
				<?if($k < 3):?>
					<article>
						<time><?=$item["DATE"]?></time>
						<h2><a href="<?=$item["DETAIL_PAGE_URL"]?>" title="<?=$item["NAME"]?>"><?=$item["NAME"]?></a></h2>
					</article>
					<?$k++;?>
				<?endif;?>
			<?endforeach;?>
			<div class="clear"></div>
			<div class="all_list">
				<a href="/press_center/news/" title="<?=GetMessage("ALL_NEWS")?>"><?=GetMessage("ALL_NEWS")?></a>
			</div>
		<?else:?>
			<p><?=GetMessage("NO_ITEMS")?></p>
		<?endif;?>
	</div>
</div>	