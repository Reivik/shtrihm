<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="current-date">События на <?=getOneDay($arParams["DATE"])?></div>
<?if(!empty($arResult["ITEMS"])):?>
	<div class="aside-news-list">
		<?$i = 0;?>
		<?foreach($arResult["ITEMS"] as $event):?>
			<?if($i < 3):?>
				<?$i++;?>
				<article>
					<time><?=getDateText($event["DATE_ACTIVE_FROM"], $event["DATE_ACTIVE_TO"])?></time>
					<h2><a href="<?echo $event["DETAIL_PAGE_URL"] ? $event["DETAIL_PAGE_URL"] : "/partners_info/calendar/" ?>" title="<?=$event["NAME"]?>"><?=$event["NAME"]?></a></h2>
				</article>
			<?endif;?>
		<?endforeach;?>
		<div class="all"><a href="/partners_info/events/">Все события</a></div>
	</div>
<?else:?>
	<div class="aside-news-list">На эту дату событий не найдено.</div>
<?endif;?>