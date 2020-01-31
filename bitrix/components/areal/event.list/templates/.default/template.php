<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>	
	<h2>Ещё мероприятия</h2>
	<?foreach($arResult["ITEMS"] as $event):?>
		<?if($i < 6):?>
			<div class="event_list <?if(($i+1)%2 == 0):?> last <?endif;?>">
				<time><?=getDateText($event["DATE_ACTIVE_FROM"], $event["DATE_ACTIVE_TO"])?></time><br />
				<a href="<?=$event["DETAIL_PAGE_URL"]?>" title="<?=$event["NAME"]?>"><?=$event["NAME"]?></a>
			</div>
			<?$i++;?>
		<?endif;?>
	<?endforeach;?>
	<div class="clear"></div>
	<div class="all"><a href="/partners_info/events/">Все мероприятия</a></div>
<?endif;?>